.. include:: /Includes.rst.txt

===============
Deprecation Log
===============

.. container::

   notice - Newer documentation available

   .. container::

      `TYPO3 Explained »
      Deprecations <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Deprecation/Index.html>`__

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

Since TYPO3 4.3, deprecated functions are logged to a file called
"deprecation log file" under *./typo3conf* called
*deprecation_xxxxxxx.log*.

   "A deprecation log has been introduced to track calls to
   deprecated/outdated methods in the TYPO3 Core. Developers have to
   make sure to adjust their code to avoid using this old functionality
   since deprecated methods will be removed in future TYPO3 releases!
   The information can be found in
   /typo3conf/deprecation_[hash-value].log The install tool has a
   setting "enableDeprecationLog" that allows one to disable the logging
   of deprecation messages since the file might grow quite fast
   depending on the extensions installed."

A lot of extension can fail in newer TYPO3 versions. The goal of this
wiki page is to describe TYPO3 extensions that might be affected in
future.

*Please add your
extensions*\ `below <#Affected_extensions>`__\ *[deprecated wiki link].*

How to enable and disable the deprecation log
=============================================

Method 1: Install Tool
----------------------

In "All Configuration", search for "enableDeprecationLog". Possible
settings are listed. An empty field disables the deprecation log. Save
the settings by clicking the button "Write to LocalConfiguration.php".

Method 2: *LocalConfiguration.php*
----------------------------------

Edit *./typo3conf/LocalConfiguration.php* and set an empty string for
``enableDeprecationLog``:

.. container::

   ::

      $TYPO3_CONF_VARS['SYS']['enableDeprecationLog'] = '';

Then, delete the *temp_CACHED_...* files to make the change effective.

Affected extensions
===================

tcdirectmail 2.0.3
------------------

In the deprecation log, messages like this one appear:

::

   01-06-10 14:16: t3lib_div::fixed_lgd_pre() - since TYPO3 4.1 - Use either fixed_lgd() or fixed_lgd_cs() (with negative input value for $chars) - tx_tcdirectmail_module1->main#1066 
   // t3lib_div::fixed_lgd_pre#136 
   // t3lib_div::logDeprecatedFunction#562 (b/class.t3lib_div.php#561) 
   01-06-10 14:16: t3lib_div::fixed_lgd() - since TYPO3 4.1 - Works ONLY for single-byte charsets! Use t3lib_div::fixed_lgd_cs() instead - tx_tcdirectmail_module1->main#1066 
   // t3lib_div::fixed_lgd_pre#136 
   // t3lib_div::fixed_lgd#564 
   // t3lib_div::logDeprecatedFunction#535 (b/class.t3lib_div.php#534) 

The question is: should this be fixed by the extension maintainer? The
developer of this extension does no longer maintain it; nor can be
reached by his email address.

This is a dire situation as this is the only TYPO3 direct mail extension
that is able to send out periodic (e.g. bi-weekly) newsletters.
