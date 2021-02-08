.. include:: /Includes.rst.txt
.. highlight:: php

.. _how-to-create-a-typo3-package:

=================================
FAQ/How to create a TYPO3 package
=================================

.. container::

   **Content Type:** HowTo [outdated wiki link].

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript. info [outdated wiki link]

.. container::

   Todo:
   For which TYPO3 versions is this still relevant? Please add
   clarification - Sypets 2020-04-17

   .. container::

   *Please remove "{{Todo}}" when the problem is solved. See all todos
   [outdated wiki link].*

| 
| This page describes how to create your own TYPO3 package (like **like
  dummy.zip**).

Default database setup
======================

If you want to include default database setup (Pages, Users, Typoscript,
etc. but no media, images or and other files) do the following:

-  unpack a default TYPO3 dummy package (zip including sources or tar.gz

as you prefer.)

-  do a 1-2-3 installation [outdated wiki link] and make all necessary
   adjustments.
-  export the database with all create statements and data to a file
   called ``database.sql`` and put it in ``typo3conf/`` of another fresh
   unzipped package on which you didn't run 1-2-3 (overwriting the
   existing files there).
-  pack the directory where you copied the ``database.sql`` file over
   with your favourite archiver.

| 
| Or you can use the TYPO3-source package, create the necessary folders
  manually and then adapt the typo3conf/localconf.php file manually.

A description how to edit the file can be found here: localconf.php and
$TYPO3_CONF_VARS [outdated link] (The offline version of this document
is much more readable.)

Then do the same steps with your database as described above.

Include Install tool settings
=============================

If you want to also include some settings you've made via the Install
tool, you should take a look at ``localconf.php`` in both of the
unpacked directories. Just include all settings you find as expedient
into the ``localconf.php`` of the not installed version.

Start your package with the Install tool
========================================

If you do not include the database settings (in ``localconfig.php``):

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

       $typo_db_username = 't3_kb_chat';   //  Modified or inserted by TYPO3 Install Tool.
       $typo_db_password = 'xxxxxxx';   //  Modified or inserted by TYPO3 Install Tool.
       $typo_db_host = 'localhost';  //  Modified or inserted by TYPO3 Install Tool.
       $typo_db = 't3_kb_chat_2';

then the install tool will come up.

T3D export and import
=====================

Since TYPO3 3.8.0 you can just use the dummy site for adding a fresh new
site (blank) and then import complete sites using the export and import
function in the context menu (formerly "impexp" extension before it went
into the core).
