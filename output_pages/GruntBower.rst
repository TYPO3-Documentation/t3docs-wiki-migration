.. include:: /Includes.rst.txt

===========
Grunt Bower
===========

.. container::

   error - This page is a candidate for deletion

   .. container::

      **Reason: Documentation about contribution to core is maintained
      in the\ **\ `Contribution
      Guide <https://docs.typo3.org/m/typo3/guide-contributionworkflow/master/en-us/Index.html>`__
      If you disagree with its deletion, please explain why at `Category
      talk:Candidates for speedy
      deletion </wiki/index.php?title=Category_talk:Candidates_for_speedy_deletion&action=edit&redlink=1>`__
      [not available anymore] or improve the page and remove the
      ``{{delete}}`` tag.

      This notice should remain for a minimum of 1 week after it was
      placed on the page. If a discussion is still ongoing, it should
      remain until a consensus is reached or a decision has been made
      about the removal, after which the page will either be deleted or
      this notice removed.

      Remember to check `what links
      here </Special:WhatLinksHere/Grunt_Bower>`__ [not available
      anymore] and the `the page
      history <https://wiki.typo3.org/wiki/index.php?title=Grunt_Bower&action=history>`__
      [deprecated wiki link] before deleting.

.. container::

   notice - This information is outdated

   .. container::

Introduction
============

This document gives a quick introduction to both Grunt + Bower, and how
the tools leverage and manage external libraries that are used within
the TYPO3 CMS Core.

Until TYPO3 CMS 7, the existing libraries within typo3/contrib/ were
included in the core, and committed to the Git repository of TYPO3 CMS.
Some libraries only contained the minified files, some depend on other
libraries. With TYPO3 CMS 7, LESS was incorporated to manage StyleSheets
easier. LESS files are processed to become one CSS file which is
delivered to the Core. Additionally, with the switch to RequireJS and
AMD modules the logic for JS is moved out into single components which
are loaded individually by default.

What is it?
===========

-  Grunt is a task-runner tool built with NodeJS and installable with
   npm (Node Package Manager) on a local machine.
-  Bower is a dependency manager like Composer but with the focus for
   Web libraries, libraries which do not incorporate PHP but rather
   CSS/JS etc.

How is it used in the TYPO3 Core?
=================================

The TYPO3 Core leverages both tools for managing versions, dependencies
of frontend-related libraries (CSS/LESS/JS), however not all technology
used needs to be shipped with the Core, thus a "build" process is
triggered to take care of the final files shipped with the TYPO3 Core.
These files are eventually enriched, combined and committed to the TYPO3
Git Repository.

NPM
---

Node Package Manager is required in order to install Bower. Please
ensure that NodeJS is installed on your local system, since NodeJS
brings the "npm" command. NodeJS can be installed following the download
instructions on http://nodejs.org.

To install all the dependent node packages, change to Build folder and
run:

``npm install``

Bower
-----

Bower does one dead-simple job for TYPO3: Fetching web libraries and
puts them into Build/bower_components. The configuration of which
packages are needed is located in Build/bower.json. Libraries like
font-awesome and twitter bootstrap are completely put in this directory
and linked in our custom LESS files in the TYPO3 Core.

To install bower on your local machine call

``npm install bower -g``

on your command line.

Grunt
-----

To install Grunt on your local machine, call

``npm install grunt grunt-cli -g``

on your command line.

Grunt takes care of the following tasks, configured within the file
Build/Gruntfile.js:

Wrapper for Bower
^^^^^^^^^^^^^^^^^

Grunt triggers bower to fetch the libraries mentioned above. This way,
bower does not need to be executed by itself all the time.
``grunt --gruntfile Build/Gruntfile.js bower``

Compiling LESS files
^^^^^^^^^^^^^^^^^^^^

Grunt allows to trigger compilation of LESS files with the following
command ``grunt --gruntfile Build/Gruntfile.js less``

Grunt can automatically rebuild modified files in the TYPO3 Core when
calling ``grunt --gruntfile Build/Gruntfile.js watch``

Copying single components to the typo3/ source
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TYPO3 allows libraries like jQuery and RequireJS to be compressed and
delivered to typo3/sysext/core/Resources/Public/Contrib/ - the files are
defined in Build/Gruntfile.js.

More to come: Minimizing files, compressing resources, combining
JavaScript libraries for the TYPO3 Core.

To trigger the base command, doing the default functionality (download
libraries via bower, re-compiling less, updating the Javascript
libraries to be shipped with the TYPO3 Core), just call:

``grunt --gruntfile Build/Gruntfile.js``

What to do when developing with TYPO3 CMS 7 ?
=============================================

Grunt & Bower are tools to enable web developers to work more easily on
the TYPO3 Core. Thus, only the configuration and the final required
files are moved to the Core. However, when developing with the Core and
modifying these files Grunt and Bower are required now to modify LESS
files and some JavaScript parts of the Core.

Check out the latest master of the TYPO3 Git Repository and run
``composer install`` as usual. You can get composer from
https://getcomposer.org/download/ if needed.

Then make sure to install npm, bower and grunt. Enter the Build
directory and call ``npm install`` to download all required npm packages
for the work needed.

Pull required JavaScript files from external repositories. Enter the
Build directory and launch the command ``bower update``.

Then run the base grunt task ``grunt --gruntfile Build/Gruntfile.js``
from the root directory of the TYPO3 Git Repository.

If you experience an error like this:
``/usr/bin/env: node: No such file or directory`` check for your node
package. On Ubuntu Linux and Linux Mint for example it is named nodejs
and therefor not found. You can prevent the error by linking the nodejs
package to its other name by running
``sudo ln -s /usr/bin/nodejs /usr/bin/node``

If you modify a LESS file, be sure to run
``grunt --gruntfile Build/Gruntfile.js css`` when you haven't set up the
watcher task from Grunt yet.

Troubleshooting
===============

In case of any kind of "magic" errors, try the following:

#. remove ``Build/node_modules``
#. remove ``Build/bower_components``
#. run ``cd Build && npm install && bower install``
#. use one of the grunt task e.g. ``grunt css`` or ``grunt scripts``
