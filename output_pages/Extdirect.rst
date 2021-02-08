.. include:: /Includes.rst.txt
.. highlight:: php

=========
ExtDirect
=========

.. container::

   This page belongs to the `Core Team <core-team>`__ (category Core
   Team [outdated wiki link])

TYPO3 and Ext.Direct
====================

What is Ext.Direct?
-------------------

   "Ext Direct is a platform and language agnostic technology to remote
   server-side methods to the client-side. Ext Direct allows for
   seamless communication between the client-side of an Ext JS
   application and all popular server platforms."

   | 
   | *Source:*\ `Ext.Direct product
     page <http://www.sencha.com/products/extjs/extdirect>`__

This means that you don't need to care about the complexity of the call
itself, the request information's like the URL and other boring stuff.
It's just like calling a simple function with the usual parameters and a
callback function. Let's compare the old fashioned way of creating a
server-side request in MooTools and with Ext.Direct to demonstrate this
concept.

| 
| **MooTools Request**

.. container::

   JavaScript [outdated wiki link]

.. container::

   ::

        new Request({
          method: 'get',
          url: 'ajax.php?ajaxID=TYPO3_Backend_MyModule_doSomething&amp;parameter1=someValue',
          data: { do: 1 },
          onComplete: function(response) {
              alert(response);
          }
        }).send();

**Ext.Direct Request**

.. container::

   JavaScript [outdated wiki link]

.. container::

   ::

        TYPO3.Backend.MyModule.doSomething('someValue', function(response, options) {
          alert(response);
        });

How to use Ext.Direct?
----------------------

Note: You can find an unfortunatly outdated demo extension attached at
the `RFC <https://forge.typo3.org/issues/23414>`__ inside the TYPO3 bug
tracker.

At the beginning we need to add our JavaScript object name / class
reference pairs, that should be used on the client-side. We can do that
inside the ``ext_localconf.php`` of your extension. The method
"registerExtDirectComponent" has two more parameters to define the
access level of your Ext.Direct code for the Backend! The third one can
delimit the access to special modules and the fourth could be used to
define admin only access.

**``ext_localconf.php``**

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        [...]
          // since versions 4.3.12, 4.4.9, 4.5.4 and 4.6
        t3lib_extMgm::registerExtDirectComponent(
          'TYPO3.Demo.Test',
          'typo3conf/ext/extdirecttest/class.tx_extdirecttest_test.php:tx_ExtDirectTest_test'
        );

            // use this code for older versions (deprecated)
        //$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ExtDirect']['TYPO3.Demo.Test'] =
        // 'typo3conf/ext/extdirecttest/class.tx_extdirecttest_test.php:tx_ExtDirectTest_test';
        
        $GLOBALS['TYPO3_CONF_VARS']['typo3/backend.php']['additionalBackendItems'][] =
          t3lib_extMgm::extPath('extdirecttest', 'backend_ext.php');
        [...]

As you can see, we also have registered an additional backend item that
creates and injects our own JavaScript code into the TYPO3 backend.

The following example demonstrates, how you generate the Ext.Direct code
yourself to create the API, how to call your own component on the
client-side and how to set the JavaScript scope for the callback
function (fourth parameter).

**``backend_ext.php``**

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        <?php
        if (is_object($TYPO3backend)) {  
              // calling the API generator with the TYPO3.Demo namespace
          $pageRenderer = $GLOBALS['TBE_TEMPLATE']->getPageRenderer();
          $pageRenderer->addExtDirectCode();

              // Since version 4.5.1 this code should not be added anymore!
          // $pageRenderer->addJsFile('ajax.php?ajaxID=ExtDirect::getAPI&namespace=TYPO3.Demo', NULL, FALSE);
        
          // calling of our own method on the client-side
          $pageRenderer->addExtOnReadyCode('
               TYPO3.Demo.Test.concatenateStrings("Hello", "World!", function(result, options) {
                   if (typeof console == "object") {
                       console.log(result);
                   } else {
                       alert(result);
                   }
               }, this);
           ');
        }
        ?>

The executed method on the client-side will be routed to the registered
class of the following example code.

**``class.tx_extdirecttest_test.php``**

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        <?php
        class tx_ExtDirectTest_test {
          public function concatenateStrings($string1, $string2) {
              return $string1 . ' ' . $string2;
          }
        }
        ?>

How to use Ext.Direct in the frontend?
--------------------------------------

Since version 4.5 of TYPO3, you can use Ext.Direct in your own frontend
code. There are only two differences between the backend and frontend.
First of all, you have no debug console. This means that the debug and
exception messages are written into your browser console or directly
into the document as a fallback. Unfortunatly both variants are not
really beautiful, but they should accomplish the goal to simplify the
coding. As a second difference, you cannot use ``ajax.php`` to call the
``getAPI()`` method, but instead a delivered ``eID`` script.

**Example Code**

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        $pageRenderer = $GLOBALS['TSFE']->getPageRenderer();
        $pageRenderer->loadExtJS();
        $pageRenderer->addExtDirectCode(array(
          'TYPO3.Demo.Test',
        ));
        
          // some calls to functions provided by Ext.Direct
        $pageRenderer->addExtOnReadyCode('
          TYPO3.Demo.Test.concatenateStrings("Frontend", function(result) {
             Ext.Msg.alert("Status", result);
          });
        
          TYPO3.Demo.Test.testException("Frontend", function(result) {
            Ext.Msg.alert("Status2", result);
          });
        
          TYPO3.Demo.Test.testDebug("Frontend", function(result) {
            Ext.Msg.alert("Status3", result);
          });
        ');

Debugging and exception handling
--------------------------------

In version 4.5 of TYPO3 an improved version of Ext.Direct arrived that
added features for an easy debugging of your AJAX driven scripts. Both -
the exception and debug code - are connected to the TYPO3 debug console.
Let's continue with some small examples how you can use the goodies...

Exceptions
^^^^^^^^^^

Currently the router catches any thrown exceptions and returns them to
the client side as exception responses. The possible response types are
defined in the
`specification <http://www.sencha.com/products/extjs/extdirect>`__.

You can throw an exception like it's done everythere in TYPO3. Just use
the ``throw`` keyword and add a useful message.

*Example*

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        class tx_ExtDirectTest_test {
            public function concatenateStrings($string1, $string2) {
                throw new t3lib_error_Exception(
                    t3lib_div::view_array(array('Just a demo exception...', $GLOBALS['TYPO3_DB']))
                );
                return $string1 . ' ' . $string2;
            }
        }

Note that an exception immediately stops the execution of your method.
That causes some additional work on the client side to prevent critical
application errors.

Debugging
^^^^^^^^^

Since version 4.5 of TYPO3, you can debug your Ext.Direct calls. Below
you will find some example code that demonstrates exactly this.
Internally we are just adding the collected debug messages as a string
representation to the RPC call. The messages are converted with
``t3lib_div::view_array`` to an ``debug`` property that is evaluated on
the client side.

*Example*

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        class tx_ExtDirectTest_test2 {
            public function sayHello() {
                $GLOBALS['error']->debug('A simple string');
                debug($GLOBALS['TYPO3_DB']);
                return 'Hello!!!';
            }
        }

Implementation in TYPO3 Core
----------------------------

The `ExtJS <http://www.sencha.com/products/extjs/>`__ developers already
offer several of implementations for different server-side environments
- some of them for PHP - but none of them could be used in TYPO3 without
any additional work.

The first integration work has begun at the
`T3UXW09 <http://t3uxw09.typo3.org/home/>`__ within the team 4 as a
prerequisite of the new page tree. At the mid of January 2010 the
Ext.Direct integration was polished and updated for the core as one of
the first results from the T3UXW09.

As can be seen on the `Ext.Direct web
page <http://www.sencha.com/products/extjs/extdirect>`__, there are a
lot of optional features that could be implemented by the server-side
stack. Our recent version works asynchronous with a programmatic
configuration and a small set of additional features. Any more enhanced
could be implemented in the future by demand. But let's continue the
description of this details inside the next section.

An Ext.Direct server-side stack consists of three parts:

-  Configuration of the client-side components
-  API generator
-  Router that dispatches the incoming calls to the configured
   classes/methods

Configuration
^^^^^^^^^^^^^

The configuration defines the PHP classes (and their methods) that
should be declared as client-side components. This configuration is an
array that is processed at the next level of the stack into a JavaScript
object for Ext.Direct.

A configuration entry consists of a key-value pair. The key contains the
JavaScript object name that is used on the client-side and the value
holds a reference to a PHP class file. The name or location of this
class doesn't play a role on the client-side; it's a simple container.
The following example shows an configuration entry that could be used
inside an extension. Any configuration entries for the TYPO3 backend can
be usually found inside the file ``t3lib/config_default.php``.

**TYPO3.Ajax.ExtDirect**

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ExtDirect']['TYPO3.Ajax.ExtDirect.MyModule'] =
          't3lib/extjs/class.tx_t3lib_extjs_myModule.php:t3lib_ExtJs_MyModule';

The API Generator
^^^^^^^^^^^^^^^^^

The API generator processes the previously explained configuration array
into a JavaScript object for Ext.Direct, that in turn creates the
client-side stubs. Because only the class references have been declared,
the API generator has to use a reflection mechanisms to retrieve the
methods with their parameters. The generator is executed by an Ajax
request.

**Calling the API generator**

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        $pageRenderer->addExtDirectCode();

By default, all available TYPO3 namespaces are included; so the
extension author just needs to add the extension's additional class
references to the configuration array and he can use the methods in his
JavaScript code.

If you want to reduce the namespaces to the ones you use, just call it
like this:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        $pageRenderer->addExtDirectCode(array(
           'mynamespace.app1',
           'mynamespace.app2',
           'mynamespace.app3'
        ));

The Router
^^^^^^^^^^

The router dispatches the incoming calls from the client side back to
the methods inside the configured classes.

**client-side example from above**

.. container::

   JavaScript [outdated wiki link]

.. container::

   ::

      TYPO3.Ajax.ExtDirect.MyModule.doSomething('someValue', function(response, options) {
          alert(response);
      });

**server-side equivalent**

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      class t3lib_ExtJs_MyModule {
          public function doSomething() {
              return 'Hello!';
          }
      }

As can be seen, the class isn't used at the client-side call. Instead,
the defined JavaScript object name that was introduced in the
configuration array is used.

==========================
Core parts using ExtDirect
==========================

-  ExtDirect StateProvider [outdated link]
-  `Pagetree <pagetree>`__
-  Workspaces [outdated link]

===============
Tips And Tricks
===============

How can I add custom GET parameters to each Ext.Direct call?
============================================================

Just do it like this in your javascript controller...

.. container::

   JavaScript [outdated wiki link]

.. container::

   ::

      Ext.onReady(function() {
        for (var providerId in Ext.Direct.providers) {
          var provider = Ext.Direct.providers[providerId];
          provider.url = provider.url +
            '&pageId=' + (TYPO3.settings.MyExt.Settings.pageId || 0) +
            '&showPage=' + (TYPO3.settings.MyExt.Settings.showPage || 0) +
            '&L=' + (TYPO3.settings.MyExt.Settings.languageId || 0);
        }
      });

As you see there are three custom parameters set, named pageId, showPage
and languageId. You can access them in your php code of the Ext.Direct
provider via t3lib_div::_GP(<parameter>).

How can I use Ext.Direct in my ExtBase extensions?
==================================================

Unfortunatly this is a little bit complicated and the provided solution
is a bit expensive, but you can get a working example by installing and
using the extension
`df_tools <https://forge.typo3.org/projects/show/extension-df_tools>`__.
Have a look into the ExtDirect directory, the ViewHelpers and the
templates to see how the integration works.

Note: The same solution is also possible in the frontend, but you will
need some modifications here and there. At least the page id should be
transferred with each Ext.Direct call to get the TSFE configuration. A
working example can be found in the non-TER extension rs_fetsy [outdated
link].

==================================
Avoiding Problems / Known Problems
==================================

ExtDirect: Invalid Security Token!
==================================

With the intruduction of the new CSRF protection, I got permanently
errors with the message "ExtDirect: Invalid Security Token!". After a
lengthy discussion at `24755: TYPO3 Core - Re: issue #24715 - problem
still exists in 4.5.0rc1
[Closed] <https://forge.typo3.org/issues/24755>`__, the found solution
was to simply replace the following line

.. container::

   JavaScript [outdated wiki link]

.. container::

   ::

      Ext.Direct.addProvider(Ext.app.ExtDirectAPI['...API Name...']);

with

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $pageRenderer->addExtDirectCode();
