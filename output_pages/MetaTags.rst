.. include:: /Includes.rst.txt

.. _meta-tags:

=============
Faq/Meta Tags
=============

.. container::

   **Content Type:** `FAQ <https://wiki.typo3.org/Category:FAQ>`__
   [deprecated wiki link].

<< back to `FAQ <faq>`__

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

Meta Tags with TYPO3
====================

Install Extension
-----------------

Configuration
~~~~~~~~~~~~~

Constants
^^^^^^^^^

::

   plugin.meta > plugin.meta { 
     description =  
     keywords = 
     robots = 
     copyright = 
     email = 
     author = 
     language = 
     distribution = 
     rating = 
     revisit = 
     includeGlobal = 0 
   }

Setup
^^^^^

Without Frames
''''''''''''''

::

   plugin.meta.global.description = 
   plugin.meta.global.keywords = 
   plugin.meta.flags.useSecondaryDescKey = 0 
   plugin.meta.flags.alwaysGlobalDescription = 1 
   plugin.meta.flags.alwaysGlobalKeywords = 1 
   plugin.meta.flags.DC = 0

   page.headerData.999 < plugin.meta 

With Frames
'''''''''''

::

   plugin.meta.global.description = 
   plugin.meta.global.keywords = 
   plugin.meta.flags.useSecondaryDescKey = 0 
   plugin.meta.flags.alwaysGlobalDescription = 1 
   plugin.meta.flags.alwaysGlobalKeywords = 1 
   plugin.meta.flags.DC = 0

   frameset.headerData.999 < plugin.meta
