.. include:: /Includes.rst.txt
.. highlight:: php

==================
T3lib http Request
==================

TODO: Migrate this docu to docs.typo3.org. See [ERROR: Cannot get
content for issue "47257"].

The class ``t3lib_http_Request`` is a wrapper for the `HTTP_Request2
PEAR
package <http://pear.php.net/manual/en/package.http.http-request2.php>`__.
It is shipped with TYPO3 Core since Version 4.6 and offers an object
oriented API to perform HTTP requests and is easy to adapt to individual
needs.

Basic Usage
===========

This is how a basic request looks like:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $request = t3lib_div::makeInstance('t3lib_http_Request', 'https://typo3.org/');
      $result = $request->send();
      $content = $result->getBody();

An example from linkvalidator
=============================

For linkvalidator a browser like link checking is needed. To keep the
traffic low, HEAD is tried first.

Some servers do not allow HEAD (e.g. Amazon) which makes it necessary to
recheck with GET in such a case. As linkvalidator does not care about
the content, we tell the server to only send the first 1024 bytes.

| 
| Additionally the request can run into a redirect loop which might be
  the result of a config error (``loop.philippgampe.info`` or
  ``ping.philippgampe.info``). In such a case an exception is thrown
  after five (this is the default) redirects. As linkvalidator is about
  helping the user, it needs to find out what goes wrong. Therefore the
  code is encapsulated with a try/catch clause and the exception number
  40 gets special treatment.

To avoid cookie loops (Server A wants to see a cookie from server B
first), cookies are observed too.

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        // Set configuration
      $config = array(
          'follow_redirects' => TRUE,
          'strict_redirects' => TRUE,
      );
          /** @var t3lib_http_Request|HTTP_Request2 $request  */
      $request = t3lib_div::makeInstance('t3lib_http_Request', $url, 'HEAD', $config);
          // Observe cookies
      $request->setCookieJar(TRUE);
      try {
              /** @var HTTP_Request2_Response $response  */
          $response = $request->send();
              // HEAD was not allowed, now trying GET
          if (isset($response) && $response->getStatus() === 405) {
              $request->setMethod('GET');
              $request->setHeader('Range', 'bytes=0-1024');
                  /** @var HTTP_Request2_Response $response  */
              $response = $request->send();
          }
      }
      catch (Exception $e) {
          $isValidUrl = FALSE;
              // we hit a redirect loop
          if ($e->getCode() === 40) {
                  // Parse the exception for more information
              $trace = $e->getTrace();
              $traceUrl = $trace[0]['args'][0]->getUrl()->getUrl();
              $traceCode = $trace[0]['args'][1]->getStatus();
              $errorParams['errorType'] = 'loop';
              $errorParams['location'] = $traceUrl;
              $errorParams['errorCode'] = $traceCode;
          } else {
              $errorParams['errorType'] = 'exception';
          }
          $errorParams['message'] = $e->getMessage();
      }

As you can see, the catch block is longer than the try block ;)

A longer example
================

This is a more complex example:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      /** @var HTTP_Request2|t3lib_http_Request $request */
      $request = t3lib_div::makeInstance('t3lib_http_Request', 'https://typo3.org/');
      $request->setAdapter('curl');
      $request->setConfig(array('use_brackets' => true));
      /** @var NET_URL2 $url */
      $url = $request->getUrl();
      $url->setQueryVariables(array(
          'package_name' => array('HTTP_Request2', 'Net_URL2'),
          'status'       => 'Open'
      ));
      $url->setQueryVariable('cmd', 'display');
      /** @var HTTP_Request2_Response $result */
      $result = $request->send();
      $content = $result->getBody();
      $request->setUrl('https://review.typo3.org/');
      $request->setAuth('username','password', 'basic');
      $request->setConfig('follow_redirects', true);
      $request->setHeader('Accept-Charset', 'utf-25');
      $request->setHeader(array(
          'Connection' => 'close',
          'Referer'    => 'http://localhost/'
      ));
      $request->setHeader('User-Agent', null);
      $request->addCookie('CUSTOMER', 'TYPO3-USER');
      /** @var HTTP_Request_Response $anotherresult */
      $anotherresult = $request->send();
      $cookies = $anotherresult->getCookies();
      $headers = $anotherresult->getHeaders();
      $anotherContent = $anotherresult->getBody();

The longer example explained
----------------------------

#. Create an instance of ``t3lib_http_Request``.

#. Use the cURL adapter. The default adapter is 'socket'. There is is
   third adapter called 'mock' that can be used for testing.

#. Require the `usage of PHP array
   brackets <http://pear.php.net/manual/en/package.http.http-request2.config.php>`__
   in the generated query string of the request.

#. Get the internal ``NET_Url2`` instance.

#. Define some query variables. This can be either an array,

#. or a key-value pair. Afterwards the URL looks like this:

   ::

      https://typo3.org/?package_name[0]=HTTP_Request2&package_name[1]=Net_URL2&status=Open&cmd=display

#. Send the request to the server. The response is returned wrapped in
   an instance of ``HTTP_Request2_Response``.

#. Get the body of the response. This is the complete HTTP body. If the
   response was send encoded or compressed, it is automatically decoded
   and decompressed.

#. It is possible to reuse the instance of ``t3lib_http_Request``. The
   method ``setUrl()`` will set a new URL the same way as the first was
   defined via the constructor.

#. Authentication is handled transparently if credentials are provided.

#. The same way it is possible to directly set a key and its value for
   query variables, it is possible to define a config value.
   ``follow_redirects`` will follow location headers up to the maximum
   defined value.

#. The ``setHeader()`` method behaves exactly as the ``setConfig()``
   method. It accepts both an array and a key-value pair.

#. Setting a header to ``null`` removes it from the request.

#. Adding cookies is as easy as adding headers and config options.

#. Sending the request is always done the same way.

#. All cookies can be saved to an array for later use (e.g.
   ``setCookie($cookies)``)

#. The very same is possible for all headers.

#. Finally get the content of the second request.
