.. include:: /Includes.rst.txt
.. highlight:: php

.. _cached-files-in-typo3temp:

==============================
FAQ/Cached files in typo3temp/
==============================

<< Back to `FAQ <faq>`__

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

.. _cached-files-in-typo3temp-1:

Cached files in typo3temp/
==========================

TYPO3 caches files (merged configuration data, scripts, ...) in
``typo3conf/``. This directory looks like this:

::

   -rw-r--r--    1 httpd    httpd       27501 Jan 29 18:35 temp_CACHED_ps2d95_ext_localconf.php
   -rw-r--r--    1 httpd    httpd       83513 Jan 29 18:35 temp_CACHED_ps2d95_ext_tables.php

There can be more than just these files, because of multiple paths,
symlinks or just old files.

You can at any time remove these files and on the next website request
they will be regenerated. These files simply contain all
``ext_tables.php`` and ``ext_localconf.php`` files from the installed
extensions concatenated in the order they are loaded. Therefore,
including one of these files would be the same as including potentially
hundreds of PHP-files; and concatenating them saves a few on each
request.

But that also means that changes to these files don't persist and, when
you make changes to the original
``ext_tables.php``/``ext_localconf.php`` files, you will have to delete
these files.
