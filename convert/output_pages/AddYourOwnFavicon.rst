.. include:: /Includes.rst.txt

====================
Add your own favicon
====================

.. container::

   **Content Type:** `HowTo <https://wiki.typo3.org/Category:HowTo>`__
   [deprecated wiki link].

.. container::

   notice - Note

   .. container::

      See page.shortcutIcon in `TypoScript Template
      Reference <https://docs.typo3.org/m/typo3/reference-typoscript/master/en-us/Setup/Page/Index.html#shortcuticon>`__

It's quite simple to add your own favorite icon (favicon) to a TYPO3 web
site. It should work for most web browsers, except some older versions
of Internet Explorer ( what else did you expect... :-) ).

Create and upload the favicon
=============================

The first thing to do, it to create your own favicon. There are many
decriptions and applications to help you do that, one of them is
http://www.chami.com/html-kit/services/favicon/

When your favicon is ready, you should upload it to your web site. It is
suggested that you put it in the ``fileadmin`` directory, for example
``fileadmin/files/favicon.ico``.

Insert and test the favicon
===========================

In the next step you go to your site's template:
``Web -> Template -> [main page] -> Info/modify -> Setup``

There you add the following code:

::

    page.shortcutIcon = fileadmin/files/favicon.ico

Finish up by emtying the web browser cache and go to your web site. If
everything was alright, you now should have your favicon showing up in
the web browser. If not, try to reload the page and/or empty the browser
cache once again. If it's still not showing up, maybe something went
wrong...?
