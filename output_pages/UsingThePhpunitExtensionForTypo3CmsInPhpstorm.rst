.. include:: /Includes.rst.txt
.. highlight:: php

=====================================================
Using the PHPUnit extension for TYPO3 CMS in PhpStorm
=====================================================

.. container::

   warning - Message

   .. container::

      Using the TYPO3 extension *phpunit* is discouraged and not
      supported by the TYPO3 CMS core. Have a look at
      `Unit_Testing_TYPO3 <unit-testing-typo3>`__ on how to properly
      execute test suites.

============
Introduction
============

To use PHPUnit in TYPO3 CMS, first install the PHPUnit extension
[outdated link]. You can use it on the CLI and the GUI.

Using the builtin PHPUnit test feature with TYPO3 CMS extensions is not
possible out of the box, as far as is known. This guide shows how to
work around that.

=====
Guide
=====

This guide is about running **unit tests**, if you want to run
**functional tests**, please see Functional testing [outdated link]

Step 1
======

First of all, make sure that you can run unit tests via the CLI.

The general command pattern is:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      php --some-php-args /path/to/TYPO3/cli_dispatch.phpsh phpunit --some-phpunit-args path/to/tests/

If that works in your shell, it will work within PhpStorm, too.

If you experience issues, make sure that the extension is installed and
the backend user *\_cli_phpunit* was created.

Step 2
======

In PhpStorm, go to File -> Settings -> External Tools and click on
"Add...". On OS X, go to Preferences -> External Tools.

Step 3
======

-  Give your new external tool a name, e.g.: "TYPO3 PHPUnit Test" and a
   group, e.g.: "phpunit".
-  In "Program", enter: *$PhpExecutable$*.
-  In "Parameters", enter: *$ProjectFileDir$/typo3/cli_dispatch.phpsh
   phpunit $FilePath$* and click "OK".
-  If you would like to assign your new external tool a shortcut key, go
   to step 4. Otherwise go to step 5.

$ProjektFileDir$ is the root of the project, the root folder of a TYPO3
website. If you have different project settings, adjust accordingly.

Step 4
======

-  Go to Preferences -> Keymap.
-  Search for the new external tool, in this case "TYPO3 PHPUnit Test",
   and select it.
-  Click on "Add Keyboard Shortcut..."
-  Assign a key and click "OK".

Step 5
======

Open a file containing unit tests and execute them by either using the
shortcut or selecting the command in the menu: Tools -> "TYPO3 PHPUnit
Test"

=========================================================
Alternative Configuration to run Unit Tests from PhpStorm
=========================================================

NOTE: this was tested under **TYPO3 6.0 in Windows**.

Prerequicities
==============

-  You must have working TYPO3 installation locally.
-  You must have EXT:phpunit installed.
-  You must have '_cli_phpunit' BE user created.
-  Your test cases must extend
   "TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase".
-  You need PHP interpreter configured for your project ("Project
   Settings" -> "PHP"). You may use original from php.net.

Configure PHPUnit to run locally
================================

-  Open "Project Settings" -> "PHP" -> "PHPUnit", choose "Use custom
   loader" and specify path to autoload.php (either use <absolute
   path>\typo3conf\ext\phpunit\Composer\vendor\autoload.php or your
   custome Composer's autoload, which is configured to include phpunit).
-  Go to "Run/Debug Configurations" view (top menu "Run" -> "Edit
   Configurations...").
-  Select your PHPUnit configuration (or create one, if you didn't make
   it yet).
-  Add following "Interpreter options": "<absolute path to your
   project>\typo3\cli_dispatch.phpsh phpunit_ide_testrunner".
-  Run and have fun :)

NOTE: **"Run with code coverage" isn't working yet** with such a method,
so you still need PHPUnit BE module for that.

=========================================
Configuration for one testsuite/test only
=========================================

For running only one test or test suite, you have to add some arguments
to your shell command:

Running one testsuite
=====================

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      php --some-php-args /path/to/TYPO3/cli_dispatch.phpsh phpunit classNameOrTestSuiteName path/to/tests/

Running one test
================

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      php --filter myFancyTestName /path/to/TYPO3/cli_dispatch.phpsh phpunit classNameOrTestSuiteName path/to/tests/

====
TODO
====

Testing one class/method only
=============================

There is a `feature request for PhpStorm to add two other macros for
external tools <http://youtrack.jetbrains.net/issue/WI-4699>`__. One
macro returns the class name around the cursors position. The other
macro returns the method mname around the cursors position. If this
macros will be included you can easily test the current class or even
method = test.

Adding screenshots
------------------
