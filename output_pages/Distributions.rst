.. include:: /Includes.rst.txt
.. highlight:: php

=============
Distributions
=============

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript. info [outdated wiki link]

.. container::

   notice - This information is outdated

   .. container::

Make your own TYPO3 Distribution
================================

Until TYPO3 6.2 distributions has been built as a new package, starting
from 6.2 a distribution can be built from extensions.

Prerequisites
=============

-  register an extension key (will be yourkey in the examples)
-  built an extension
-  set dependencies in EXT:yourkey/ext_emconf.php (see example below)
-  put files, which should be initially imported into
   EXT:yourkey/Initialisation/Files they will be copied to
   fileadmin/yourkey on the very first install of the extension
-  create EXT:yourkey/Initialisation/data.t3d if you want to import
   something into the database during installation
-  upload your extension into the TER
-  install your distribution

.. container::

   ::

      <?php
      $EM_CONF[$_EXTKEY] = array(
          'title' => 'title',
          'description' => 'description',
          'category' => 'distribution',
          'author' => 'your name',
          'author_email' => 'yourmail@typo3.org',
          'author_company' => '',
          'shy' => '',
          'priority' => '',
          'module' => '',
          'state' => 'beta',
          'internal' => '',
          'uploadfolder' => '0',
          'createDirs' => '',
          'modify_tables' => '',
          'clearCacheOnLoad' => 0,
          'lockType' => '',
          'version' => '0.3',
          'constraints' => array(
              'depends' => array(
                  'extbase' => '6.2',
                  'fluid' => '6.2',
                  'typo3' => '6.2',
                  'news' => '2.2',
              ),
              'conflicts' => array(
              ),
              'suggests' => array(
              ),
          ),
      );
      ?>

Example Distributions
=====================

These packages will be released soon after availability of TYPO3 6.2 LTS

-  Governmentpackage
-  Introduction Package

Related issues
==============

-  https://forge.typo3.org/issues/51537
-  https://forge.typo3.org/issues/51466
-  https://forge.typo3.org/issues/51437
