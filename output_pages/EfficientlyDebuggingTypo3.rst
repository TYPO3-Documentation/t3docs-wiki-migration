.. include:: /Includes.rst.txt

===========================
Efficiently Debugging TYPO3
===========================

.. container::

   **Content Type:** `HowTo <https://wiki.typo3.org/Category:HowTo>`__
   [deprecated wiki link].

This page describes how efficiently debugging TYPO3. If you need a PHP
editor / IDE, please refer to `Comparison of PHP Editors for TYPO3
development <ide-for-typo3>`__.

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript.
      `info <https://wiki.typo3.org/Help:Contents#Teamwork_-_draft_review_publish_delete_merge_outdated>`__
      [deprecated wiki link]

PDT and Zend Server Community Edition
=====================================

Installing and Configuring
--------------------------

-  Just download and install the `Zend Zerver
   CE <http://www.zend.com/de/products/server-ce/downloads>`__.

-  After that log into the Zend Server CE Admin Interface under
   **http://<yourhost>:10081** and make sure the Zend Debugger is turned
   on under "Server Setup / Components".
-  Insert your clients' PC/Mac IP or an IP range into the
   "zend_debugger.allow_hosts" and "zend_debugger.allow_tunnel" fields.
-  Set "zend_debugger.expose_remotely" to 2.

-  Click on the "Restart PHP" button in the lower right corner of the
   dialogue.

Configuring your projects
^^^^^^^^^^^^^^^^^^^^^^^^^

-  Add an empty "dummy.php" file to the web-root of each of your TYPO3
   projects (where index.php resides) and make it writeable.
-  I add it when initializing a new TYPO3 project so its getting
   deployed on the webservers automatically. Be sure to have it in

each projects' web root on the webserver.

Configure Zend Studio
^^^^^^^^^^^^^^^^^^^^^

-  Back in Zend Studio go to "Preferences" and under "PHP/Debug/PHP
   Debugger:" choose "Zend Debugger".
-  click on "configure" right of it and choose "Zend Debugger" in the
   list.
-  In the "Zend Debugger seetings" dialogue check the upper checkbox.
-  Leave the ports to default (Debug Port: 10137, Broadcast Port: 20080)
   and insert the IP of the machine running Zend Server CE under "Client
   Host/IP".
-  You can leave the dummy file name to "dummy.php".

-  Go Back to "PHP/Debug" and configure a "PHP Server".
-  Under "Server" choose the Base URL , the URL you can reach your
   project on the webserver. I leave the "local Web Root" blank and
   configure a path mapping:
-  Be sure to set the "path mapping" right, so you get a connection
   between the path to your projects web root on the machine running
   Zend Server CE and your local projects' web root.

-  In "Zend Server" sheet you can enable Zend Server integration and
   check "use default url" and insert your Admin interface password
   under "Authentification" .
-  Under "Tunneling" check "enable" and "Automatically connect on
   startup".

-  Back in "PHP/Debug" choose your PHP executable and check "Enable CLI
   Debug".
-  I also choose "break on first line".

-  As final step you have to define a "Debug configuration". With these
   configurations you can define different entry points (php-files)
   within your project.
-  For TYPO3 Frontend debugging i choose the "index.php" and for Backend
   debugging i choose "typo3/backend.php".

-  For defining Debug configurations leave the preferences and click on
   the down-arrow next to the Bug icon in the upper taskbar.
-  In the "Debug configurations" dialogue click on the "PHP Web
   Application" treenode on the left and hit the "New" button above the
   tree view.

-  In the "Server" sheet on the right select "Zend Debugger" as "Server
   Debugger" and your pre-configured "PHP-Server".
-  You can now hit "Test debugger" and it should prompt you with a
   "Success" message. If you get a timeout error message, be sure that
   the ip of "Client Host/IP" is right.
-  You can also try to restart Zend Studio and your Zend Server CE
   apache component and try "Test debugging" again.

-  In the "File" section you have to point to the entry file on your
   local machine where debugging should start. You can go there with the
   "Browse" button.

-  Under "URL" I uncheck the "Auto generate" checkbox and add
   "/index.php" or "/backend.php" .
-  TIPP: You can also debug any frontend page at this point by adding
   i.e. "/index.php?id=<yourPID>" in this field !!

-  In the sheet "Advanced" make sure you check "Open in browser" and
   "Debug all pages".
-  Under "Source location" choose "Local copy if ...".

-  You can enable Javascript debugging under the corresponding sheet.

-  Under "Common" sheet make sure "Allocate console" and "Launch in
   background" is checked.

-  After hitting "Apply" you can either start debugging with this
   configuration hitting the "Debug" button or close this dialogue and
   choose the configuration by hitting the down-arrow besides the bug
   icon again.

-  Before you debug, you should set breakpoints just above the point in
   the code where you have an error/strange behavior.

You can then step through the performed PHP actions in the auto-opening
debug view -> see Zend Studio documentation for it.

How-to debug
------------

XDebug
======

.. _installing-and-configuring-1:

Installing and Configuring
--------------------------

Assumption: You run XAMPP with PHP 5.2.2 in C:\xampp

**64 bit Notice:** XDebug has problems on 64bit systems. Version working
well on 64bit Win7 with php 5.2.2 is [`XDebug
2.0.0 <http://www.xdebug.org/files/php_xdebug-2.0.0-5.2.2.dll>`__].

For this setup, download the linked .dll file and place it in
C:\xampp\php\ext

Open your php.ini file in C:\xampp\php\php.ini (Make sure this is the
actually used file, older versions of XAMPP used
c:\xampp\apache\bin\php.ini) At the very bottom of that file, **comment
everything in the Zend section** so it is not used anymore. Enter this
information in the XDebug section

::

   [XDebug]
   zend_extension_ts="C:\xampp\php\ext\php_xdebug-2.0.0-5.2.2.dll"
   xdebug.remote_enable=true
   xdebug.remote_host=127.0.0.1
   xdebug.remote_port=9000
   xdebug.remote_handler=dbgp
   xdebug.show_local_vars = 1

and in case you want to use wincachegrind for profiling (warning this is
slow and generates huge amounts of data):

::

   xdebug.profiler_enable=1
   xdebug.profiler_output_dir="C:\xampp\tmp"

(Personally I prefer XHProf for profiling but it does not come in a
windows version right now.)

Restart your Apache server, visit a page with phpinfo() and check if
there is a section on XDebug. If there isn't check your filenames and
locations and if you edit the correct php.ini file.

Configure Eclipse Galileo PDT for Xdebug
========================================

-  Click Run -> Debug Configurations
-  Select "PHP Web Page" and click the icon for "New launch
   configuration"
-  In the "Server" tab, select Server Debugger "XDebug"
-  for the file, browse to your Typo3 index.php
-  Leave URL on auto generate and choose break at first line as you like
   it.
-  Click debug and you are running a debugger.

Regarding the correct paths: Assuming you have your Eclipse Workspace in
c:\web and a typo3 project named www in C:\web\www with your Apache
document root in your workspace directory c:\web. (This means you can
get to your Typo3 website on http://localhost/www [not available
anymore])... You will have to choose the following as debug
configuration:

-  File: /www/index.php
-  Leave URL to auto generate which will use http://localhost/ [not
   available anymore] in the left part and /www/index.php in the right
   one.

Some notes:

-  You can choose a different default browser (e.g. Firefox) by pressing
   "Window -> Web Browser"
-  You can set Breakpoints by double-clicking in the left border of the
   editor window (where TODO or FIXME marks are shown)
-  Sometimes, the debug session does not stop any more, then you simply
   have to end the web launch and start it again.
-  When debugging Cron Scripts, you can select the debug configuration
   "PHP Script" using the executable at c:\xampp\php\php.exe

Configure NetBeans 6.8 for debugging
====================================

-  Install xdebug as explained before.
-  In the project listing of NetBeans, right-click on the project which
   you want to debug, and open "Properties". This opens the Project
   Properties dialog.
-  Then, modify the "Run Configuration" as follows:

   -  Run as: Local web site
   -  Project URL: **[Base URL to your TYPO3 instance]**, like
      http://localhost/typo3/ [not available anymore]
   -  Index File: (leave blank)
   -  Arguments: (leave blank)

-  Now click on "Advanced", and set the "Debug URL" to "Ask Every Time".
-  That's basically it :-)

To use debugging, do the following:

-  Set a breakpoint inside the project you just set up, and click debug
   in the main toolbar.
-  Now, a popup opens where you can enter the URL of the website which
   should be called. Enter the URL which triggers the desired
   functionality.
-  Your browser opens and starts loading. Now, go back to NetBeans, and
   see that it is waiting on a break point for your attention :-)
-  Happy debugging!

.. _how-to-debug-1:

How-to debug
------------

Further Reading
===============

-  `Extension Development,
   Debugging <extension-development-debugging>`__

`debug <https://wiki.typo3.org/Category:Debug>`__ [deprecated wiki link]
