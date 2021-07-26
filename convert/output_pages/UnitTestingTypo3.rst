.. include:: /Includes.rst.txt

==================
Unit Testing TYPO3
==================

.. container::

   warning - No longer maintained

   .. container::

      This document was transferred to the official TYPO3 CMS
      documentation (new URL:
      https://docs.typo3.org/typo3cms/CoreApiReference/Testing/Index.html).
      This wiki page is now obsolete and will not get any additional
      updates.

Unit testing in TYPO3 8
=======================

Setup and run tests:

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      git clone git@github.com:typo3/typo3.git
      cd TYPO3.CMS
      composer install
      ./bin/phpunit -d memory_limit=1G -c vendor/typo3/testing-framework/Resources/Core/Build/UnitTests.xml

You can also call testfunctions directly by inserting the filtered
testing file, function name and testclass

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      ./bin/phpunit -c vendor/typo3/testing-framework/Resources/Core/Build/UnitTests.xml **filepath** --filter **function** **testclass**

Creating a full code coverage report of unit tests into a directory on
the parent level to prevent showing it up in Git

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

       ./bin/phpunit -d memory_limit=1G --coverage-html ../typo3-code-coverage/ -c vendor/typo3/testing-framework/Resources/Core/Build/UnitTests.xml

Unit testing since TYPO3 6.2
============================

.. container::

   warning - Message

   .. container::

      Do not use the TYPO3 extension "phpunit", it is broken until
      https://forge.typo3.org/issues/64720 [not available anymore] is
      solved

With TYPO3 CMS version 6.2 the unit test execution and its required
setup was streamlined. See
`Blueprints/StandaloneUnitTests <https://wiki.typo3.org/Blueprints/StandaloneUnitTests>`__
[deprecated wiki link] for more details.

`composer <https://getcomposer.org/>`__ should be available on the
system already, see its documentation for installation details.

Setup and run tests:

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      git clone git@github.com:typo3/typo3.git
      cd TYPO3.CMS
      composer install
      ./bin/phpunit -c typo3/sysext/core/Build/UnitTests.xml

Test for cross dependencies in unit tests
-----------------------------------------

Cross dependencies may occur, if you write tests that depend (willingly
or not) on the earlier execution of another test (e.g setting locals
without reseting them after finished test). To reveal such cases you can
use the phpunit-randomizer, that executes all test in a random order.

Install the randomizer using composer.

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      composer require fiunchinho/phpunit-randomizer --dev

Using the randomizer works in a similar way as the normal phpunit.

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      ./bin/phpunit-randomizer -c components/testing_framework/Resources/Core/Build/UnitTests.xml --order rand

Mind the parameter "--order rand". After running the command once,
you'll be provided with a seed (e.g. 1234) by the randomizer. Adding
this seed to the randomizer command reproduces the same order.

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      ./bin/phpunit-randomizer -c components/testing_framework/Resources/Core/Build/UnitTests.xml --order rand:1234

This way you are be able to reproduce the same order (within the same
git commit) over and over again to remove all test failures caused by
cross dependencies.

Unit Testing on Windows
-----------------------

For Unit Testing on Windows use the Windows shell (cmd.exe) - do not use
the git shell, because it does not have the Environment Variables set.
This leads to OPENSSL_CONF not being set which makes the RsaAuth-Tests
fail.

Normal windows users are not allowed to create symbolic links, the tests
will fail with "symlink(): Cannot create symlink, error code(1314)". You
either have to set the according rights (see
https://wiki.typo3.org/Flow_Installation_Hints#Symbolic_Links [not
available anymore]) or start the Windows shell as Administrator
(Right-click => Open as administrator). On Windows Home the second
option is your only choice because secpol.msc is not available there
(polsedit doesn't seem to work).

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      .\bin\phpunit.bat -c components/testing_framework/Resources/Core/Build/UnitTests.xml

To run a certain test, just append the test class:

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      .\bin\phpunit.bat -c components/testing_framework/Resources/Core/Build/UnitTests.xml typo3/sysext/form/Tests/Unit/Filter/StripNewLinesFilterTest.php

There currently is a bug in xampp with a wrong path to OPENSSL_CONF:
https://community.apachefriends.org/f/viewtopic.php?f=16&t=69986 [not
available anymore]

Unit Testing with PhpStorm
--------------------------

Select *vendor/autoload.php* as custom autoloader and
typo3/sysext/core/Build/UnitTest.xml as default configuration file.
http://confluence.jetbrains.com/display/PhpStorm/PHPUnit+Installation+via+Composer+in+PhpStorm

Functional testing
==================

For information about functional testing see
`https://wiki.typo3.org/Functional_testing <https://wiki.typo3.org/wiki/index.php?title=Functional_testing&action=edit&redlink=1>`__
[not available anymore]

Unit testing below TYPO3 CMS 6.2
================================

1. Install the extension
`phpunit <https://extensions.typo3.org/extension/phpunit/>`__ from
`TER <https://extensions.typo3.org/>`__. Alternatively you can also use
git to checkout the
`latest <https://git.typo3.org/TYPO3CMS/Extensions/phpunit.git>`__
version of *phpunit*. 2. Create a backend user name *cli_phpunit* to
allow running task from shell.

On top of that, some systems require special *PHP* extensions, like
*xdebug* which is required to generate the *code coverage* report.

On *rpm* based systems, like *Fedora* and *RHEL*, you need the packages
*php-process* and *php-posix* in addition to the normal list of *PHP*
extensions.

Integrating phpunit into your IDE
---------------------------------

There are several *IDE* which can run *phpunit* test. Unfortunately this
does not work that easy on *TYPO3*, because most *TYPO3* functions
required a fully bootstrapped framework to function. This requires to
pull up *TYPO3* prior to running any tests. This task is done by the
extension *phpunit*, thus all request must be routed trough the
*phpunit* e.g. via the *cli* interface.

::

    ./typo3/cli_dispatch.phpsh phpunit

-  `PhpStorm <using-the-phpunit-extension-for-typo3-cms-in-phpstorm>`__
-  *your IDE*

Hints
-----

-  If using data providers, any code in the providers should be avoided.
   Especially time calculations are not a good idea, if tests are
   grunalar to seconds or minutes. Reason for that is, that all data
   provider data is calculated at the very beginning of a whole run. So,
   if you run 4000 tests in 2 minutes, there will be time offsets. See
   for example issue `40515: TYPO3 Core - Fix scheduler tests for travis
   [Closed] <https://forge.typo3.org/issues/40515>`__ on that.
   Furthermore, if additional initialization is done in setUp(), they
   won't hit depending calculations in dataProviders. If for example a
   dataProvider uses strtotime() and setUp() sets a specific timezone,
   the strtotime() will be executed \*before\* setUp() is called, and
   thus not take the different timezone setting of setUp() into account.

Using PHPUnit via CLI and MAMP (or any other php binary that is not located in your default path)
-------------------------------------------------------------------------------------------------

Make aliases for php and phpunit (preferably place it in ``~/.profile``
so that it will be available every time you open a terminal window

::

   alias php="/Applications/MAMP/bin/php/php5.4.19/bin/php"
   alias phpunit="typo3conf/ext/phpunit/Composer/vendor/bin/phpunit"

Then you can execute core unit or functional test just by doing (you
have to be in your TYPO3 installation directory):

::

   phpunit -c typo3/sysext/core/Build/UnitTests.xml
   phpunit -c typo3/sysext/core/Build/FunctionalTests.xml

The phpunit TYPO3 extension must be located in typo3conf/ext/ for this
to work of course.

Additional Resources
====================

`Unit Testing of TYPO3
extensions <http://elmars-typo3-knowledge-collection.readthedocs.io/en/latest/Extensions/UnitTesting/Index.html>`__
