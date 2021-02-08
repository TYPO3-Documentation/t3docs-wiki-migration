.. include:: /Includes.rst.txt

=======================
How to upload big files
=======================

.. container::

   **Content Type:** `HowTo </Category:HowTo>`__ [deprecated wiki link].

.. container::

   notice - Reviewer needed

   .. container::

      Change the **{{review}}** marker to **{{publish}}** when all parts
      are reviewed (e.g. TypoScript).
      `info </Help:Contents#Teamwork_-_draft_review_publish_delete_merge_outdated>`__
      [deprecated wiki link]

In TYPO3 it is - by default - impossible to upload files bigger than 10
MB. Here's a short list of actions in order to bypass this limit
`installation </Category:Installation>`__ [deprecated wiki link]:

Modification of the Apache PHP module configuration
===================================================

First, there is a limit on the Apache PHP module configuration (not to
confuse with the php.ini PHP configuration) which can be in
/etc/httpd/conf.d/php.conf or other place depending of your Apache
installation (like /etc/apache2/mods-enabled/php5.conf on Ubuntu). There
you've to change the "LimitRequestBody" the desired size (like "100MB").
If you don't change this you'll probably get a "connection reset" error
message.

Mofification of the Apache SSL configuration
============================================

If your backend module is secured via SSL (always a good idea), then you
might have to adapt what is called the "maximum size for SSL buffer":
add the entry "SSLRenegBufferSize 10486000" somewhere appropriate---for
example into the "<Directory>" section governing access to your typo3
installation in one of your apache config files.

Modification of the PHP configuration
=====================================

The filesize is globally restricted by PHP thus you have to change the
PHP settings to appropriate values to accept bigger files before
changing TYPO3 settings. You can change these values directly via
php.ini or via a .htaccess file:

Entries for `php.ini </Category:Php.ini>`__ [deprecated wiki link]:
-------------------------------------------------------------------

::

    ;;;;;;;;;;;;;;;;;;;
    ; Resource Limits ;
    ;;;;;;;;;;;;;;;;;;;
    
    max_execution_time = 1000     ; Maximum execution time of each script, in seconds
    max_input_time = 1000 ; Maximum amount of time each script may spend parsing request data

::

    ; Maximum size of POST data that PHP will accept.
    post_max_size = 100M

::

    ; Maximum allowed size for uploaded files.
    upload_max_filesize = 100M

Entries for .htaccess file
--------------------------

::

    php_value max_execution_time 1000
    php_value max_input_time 1000
    php_value post_max_size 100M
    php_value upload_max_filesize 100M

| 
| Keep in mind that the server admin could have disallowed changing
  these values via .htaccess.

Edit TYPO3 Configuration (no longer necessary in 7.6.0)
=======================================================

Via Install Tool
----------------

Go to *All Configuration* and search for *[maxFileSize]*. Insert the new
string into the input field and hit the button *Write to
LocalConfiguration.php* afterwards.

Directly via LocalConfiguration.php
-----------------------------------

Add this setting to *LocalConfiguration.php*:

::

    $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'] = '100000';

Notice: These settings have been removed with TYPO3 7.6.0.
https://forge.typo3.org/issues/71110 If the value is still configured it
will be unset.

Modify $GLOBALS['TCA'] parameters
=================================

Several content elements have own restrictions for the maximum upload
size. You can change these values easily by modifying the TCA of these
elements. You can do this in several ways:

-  Open the file *ext_tables.php* or
   *Configuration/TCA/Overrides/tt_content.php* of an already installed
   extension in *typo3conf/ext/*.
-  OR create a new extension and add the code to the file
   *Configuration/TCA/Overrides/tt_content.php*.

| 
| In any case, add the following lines to the file:

::

    // This changes the upload limit for image elements
    $GLOBALS['TCA']['tt_content']['columns']['image']['config']['max_size'] = 100000;
    
    // This changes the upload limit for media elements
    $GLOBALS['TCA']['tt_content']['columns']['media']['config']['max_size'] = 100000;
    
    // This changes the upload limit for multimedia elements (no longer necessary in 7.6.0, except if ext:mediace is installed)
    $GLOBALS['TCA']['tt_content']['columns']['multimedia']['config']['max_size'] = 100000;

Clear extension cache via *Clear cache in typo3conf/*
=====================================================

All right, now you can upload big files!

*(originally written by Mutato of typo3.fr)*
