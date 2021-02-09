.. include:: /Includes.rst.txt

========
Composer
========

.. container::

   For TYPO3 versions 8.7 and above, please see:

   -  `Installation & Upgrade Guide » Install TYPO3 via
      composer <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/QuickInstall/Composer/Index.html>`__
      for installing TYPO3 with Composer
   -  `Installation & Upgrade Guide » Migrate TYPO3 Project to
      Composer <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/MigrateToComposer/Index.html>`__
      for migrating from non-Composer project to Composer
   -  `TYPO3 Explained »
      composer.json <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ExtensionArchitecture/ComposerJson/Index.html>`__
      for extension developers
   -  `TYPO3 Explained »
      Autoloading <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Autoloading/Index.html>`__
      for extension developers

.. container::

   notice - This information is outdated

   .. container::

      The content of this page is partially outdated.

TYPO3 Ecosystem and Composer Ecosystem
======================================

TYPO3 Extensions
----------------

TYPO3 has the concept of extensions since very early versions. The TYPO3
core consists of a couple of selected extensions and there are many
third party extensions available in the `TYPO3 Extension
Repository <https://extensions.typo3.org/>`__. TYPO3 extensions' meta
data and installation instructions are defined in a ``ext_emconf.php``
file. Extensions are identified by the *extension key* which can consist
of alphanumerical characters and underscores. Extensions reside in the
``typo3conf/ext/`` directory in a folder matching the extension key e.g.
extension ``news`` will reside in the folder ``typo3conf/ext/news``.

Composer Packages
-----------------

In the Composer Ecosystem everything is (called) a package. The central
package repository for Composer packages is
`Packagist <http://packagist.org>`__. Composer packages' meta data and
installation instructions are defined in a ``composer.json`` file.
Composer packages have a unique name, which has two parts. It starts
with the vendor, followed by a slash, followed by a package name. All
packages downloaded by composer are placed in the so called *vendor*
directory e.g. the package ``symfony/console`` will reside in the folder
``vendor/symfony/console``

All these differences would normally make it impossible to package TYPO3
and extensions by using composer. To work around these limitations, two
things were introduced:

#. composer.typo3.org composer repository for TER extensions
#. The TYPO3 composer installers

composer.typo3.org
------------------

.. container::

   notice - Note

   .. container::

      The role of composer.typo3.org has changed. It is now deprecated.
      You can still use it as a fallback for extensions not yet
      published on Packagist, but it is recommended to publish your
      (public) extensions on https://packagist.org/. See
      https://get.typo3.org/misc/composer/repository

This is a composer package repository which makes all TER extensions
installable via composer if https://composer.typo3.org is added to the
root composer.json as additional composer repository. This is done by
regularly checking the contents of the TER (basically all ext_emconf.php
info from all extensions in each version is fetched from within the
extensions.xml file) and is transformed into a Composer readable package
information format.

With that service, extensions can be installed via composer, even if
they do not have their own composer.json file.

Since Composer requires packages to have a vendor prefix, all extensions
downloadable from composer.typo3.org have the prefix ``typo3-ter/``
followed by the extension key, where the underscores are replaced by a
dash. This means that e.g. the extension ``tt_news`` is available as
``typo3-ter/tt-news``. The code which does the composer package
information from TER extension information is `available on
Github <https://github.com/TYPO3/CmsComposerPackageGenerator>`__

TYPO3 Composer installers
-------------------------

.. container::

   notice - Note

   .. container::

      Since the "`TYPO3 subtree
      split <https://usetypo3.com/typo3-subtree-split-and-composer.html>`__",
      it is possible to install TYPO3 system extensions as individual
      packages. So, instead of requiring ``typo3/cms``, you can require
      ``typo3/cms-core``, ``typo3/cms-backend`` etc. It is recommended
      to install individual packages now because it gives you more
      flexibility and it is often not necessary to install the entire
      TYPO3 core.

A composer.json file was added to the TYPO3 git repository and the
repository was registered on Packagist with the name ``typo3/cms``. This
means that requiring ``typo3/cms`` as composer package would be easy,
but setting up everything to have a familiar directory structure
(including all symlinks) would be up to every user. Also the TYPO3 core
and the extensions would be placed in the vendor directory, where they
would be inaccessible for TYPO3.

To tackle these differences in the folder structure and to be able to
download and extract ``*.t3x`` extension packages, the
``typo3/cms-composer-installers`` composer package was created and added
to ``typo3/cms`` as dependency. So every time you require ``typo3/cms``
with composer, the installers are also downloaded.

``typo3/cms-composer-installers`` acts as a composer plugin which
handles installation, update and deletion of composer packages of the
`types <https://getcomposer.org/doc/04-schema.md#type>`__
``typo3-cms-framework`` and ``typo3-cms-extension``. The first type is
used as type for ``typo3/cms``, the latter type for all TYPO3 extensions
(on composer.typo3.org).

The installer does four things:

#. It downloads and extracts extensions (as t3x from the TER) into the
   typo3conf/ext/ directory
#. It puts the TYPO3 sources into a specified directory (typo3_src by
   default)
#. It establishes symlinks to the typo3 directory and the index.php file
#. It establishes a symlink from vendor/autoload.php within the TYPO3
   sources directory to the real autoload.php of Composer (a wrapper
   script is created if symlinking is not possible), this allows you to
   use arbitrary vendor directories

TYPO3 7LTS and later
====================

In general there are two options to use TYPO3 in a project.

#. Composer Mode
#. Classic Mode (Non Composer Mode)

**Composer Mode** means, that the ``typo3/cms`` package is installed via
the composer command line utility
`Composer <https://getcomposer.org/>`__. In order for this to work you
need a composer.json file in the root of your project, which describes
your project and its dependencies (TYPO3 sources, Extensions and their
versions). As a simple starting point there are example projects
(distribution) that you can use to kickstart your project. However, you
will have to learn and understand the content of the composer.json file
in order to have full control over your project. See below for more
details on the process of installation.

The TYPO3 Extension manager module must **NOT** be used to fetch or
update extensions in **Composer Mode**, therefore the download and
update functionality is disabled. It is only possible to activate
extensions and change extension settings.

.. container::

   notice - Note

   .. container::

      Changing of extension settings is no longer done in the Extension
      Manager since TYPO3 9. It is done in "Settings > Extension
      Configuration".

**Classic Mode (Non Composer Mode)** means, that the TYPO3 sources are
`fetched as a tarball <https://typo3.org/download/>`__ and symlinked
into (or used as) the document root. Alternatively the sources can be
`fetched via git <https://git.typo3.org/Packages/TYPO3.CMS.git>`__, but
a ``composer install`` is then required before they are ready to be used
in a symlinked setup like described above.

.. container::

   warning - Message

   .. container::

      Cloning the typo3 source repository and doing a composer install
      will lead to an installation in "Classic Mode" as you are adding
      the dependencies of TYPO3 but the typo3 package itself is **NOT**
      a dependency of your project.

Composer Mode
-------------

Installation
^^^^^^^^^^^^

``composer create-project typo3/cms-base-distribution`` could be used to
kickstart your composer.json from an example (distribution). However it
is not always updated with the latest TYPO3 version. Therefor we rather
recommend to use a custom, minimum distribution composer.json like this:

.. container::

   `JavaScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_JavaScript>`__
   [deprecated wiki link]

.. container::

   ::

      {
        "repositories": [
          { "type": "composer", "url": "https://composer.typo3.org/" }
        ],
        "name": "my-vendor/my-typo3-cms-distribution",
        "require": {
          "typo3/cms": "^8.0"
        }
      }

.. container::

   notice - Note

   .. container::

      You only need the repositories section, if you wish to install
      third party extensions from TER. If all the extensions you need
      are available on Packagist, you do not need this.

.. container::

   notice - Note

   .. container::

      As already mentioned above in the note about the `subtree
      split <https://usetypo3.com/typo3-subtree-split-and-composer.html>`__,
      it is possible to install each system extension individually since
      TYPO3 8.7.7. Since TYPO3 9, it is mandatory. You can use the
      `Composer Helper <https://get.typo3.org/misc/composer/helper>`__
      to help you select the core system extensions you need.

.. container::

   warning - Message

   .. container::

      The following information is (partially) outdated for TYPO3
      version 9 and above

Doing a ``composer install`` will result in the following directory
structure:

::

   drwxr-xr-x   vendor
   -rw-r--r--   composer.json
   -rw-r--r--   composer.lock
   lrwxr-xr-x   index.php -> typo3_src/index.php
   lrwxr-xr-x   typo3 -> typo3_src/typo3
   drwxr-xr-x   typo3_src

For security reasons it is however not recommended to have the vendor
directory and the TYPO3 sources directory in the document root.

Because of that it is possible (and highly recommended) to add
configuration to put the web root ``typo3/cms`` package elsewhere after
a composer installation. The configuration must be added to the extra
section of the root composer.json like that:

.. container::

   `JavaScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_JavaScript>`__
   [deprecated wiki link]

.. container::

   ::

      {
        "repositories": [
          { "type": "composer", "url": "https://composer.typo3.org/" }
        ],
        "name": "my-vendor/my-typo3-cms-distribution",
        "require": {
          "typo3/cms": "^8.0"
        },
        "extra": {
          "typo3/cms": {
            "cms-package-dir": "{$vendor-dir}/typo3/cms",
            "web-dir": "web"
          }
        }
      }

.. container::

   notice - Note

   .. container::

      With the TYPO3 subtree split (recommended since v8 and mandatory
      since v9), cms-package-dir no longer has any effect. For more
      information, see this
      `issue <https://github.com/TYPO3-Documentation/TYPO3CMS-Guide-Installation/issues/159>`__.

This will result in the following directory structure: (If you change
these settings, you need to clean up (e.g. via
``rm -rf index.php typo3 typo3_src`` before doing another
``composer install``)

::

   drwxr-xr-x   vendor
   drwxr-xr-x   web
   -rw-r--r--   composer.json
   -rw-r--r--   composer.lock

And the web directory looks like this:

::

   lrwxr-xr-x   index.php -> ../vendor/typo3/cms/index.php
   lrwxr-xr-x   typo3 -> ../vendor/typo3/cms/typo3

The ``typo3/cms`` package resides in the vendor folder, which will be
the default configuration option soon. The web folder for now still has
symlinks to the typo3 folder and the typo3conf folder will also be
present there after setting up TYPO3. But at least the vendor directory
and the composer.json and composer.lock files are outside the document
root, which already is an improvement.

Class Loading
^^^^^^^^^^^^^

In Composer Mode all class loading information must be provided by each
of the installed extensions **or** the root package. If TYPO3 extensions
are not installed by composer, e.g. because they are directly committed
to the root package or a new package is kickstarted, class loading
information needs to be provided, otherwise no classes can be loaded for
these extensions/ packages.

E.g. if you have a site extension directly committed to your root
package, you must include the class loading information in the root
package like that:

.. container::

   `JavaScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_JavaScript>`__
   [deprecated wiki link]

.. container::

   ::

      {
        "repositories": [
          { "type": "composer", "url": "https://composer.typo3.org/" }
        ],
        "name": "my-vendor/my-typo3-cms-distribution",
        "require": {
          "typo3/cms": "8.x-dev"
        },
        "autoload": {
          "psr-4": {
            "MyVendor\\MySitePackage\\": "typo3conf/ext/my_site_package/Classes"
          }
        }
      }

Extension Manager
^^^^^^^^^^^^^^^^^

In Composer Mode functionality of the Extension Manager is limited. It
will not be possible to download Extensions from TER, upload extension
packages or update extensions. It will only be possible to list,
activate and configure extensions.

Installing, updating, removing extensions and the TYPO3 core is
exclusively allowed by using the composer commands.

Extension composer.json
^^^^^^^^^^^^^^^^^^^^^^^

The composer name of an extension should have dashes "-" instead of
underscores "_" (like the TYPO3 extension key). It is therefore required
to add a replace section with the first value to contain the TYPO3
extension key.

.. container::

   `JavaScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_JavaScript>`__
   [deprecated wiki link]

.. container::

   ::

      {
          "name": "vendorname/my-extension",
          "type": "typo3-cms-extension",
          "description": "An example extension",
          "license": "GPL-2.0-or-later",
          "require": {
              "typo3/cms-core": "^9.5 || ^10.1"
          },
          "replace": {
              "vendorname/my-extension": "self.version",
              "typo3-ter/my-extension": "self.version"
          },
          "extra": {
              "typo3/cms": {
                  "extension-key": "my_extension"
              }
          },
          "autoload": {
              "psr-4": {
              "Vendorname\\MyExtension\\": "Classes/"
          }
      }

.. container::

   notice - Note

   .. container::

      For TYPO3 versions 9.5 and above, you can find a sample
      composer.json and description in `TYPO3
      Explained <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ExtensionArchitecture/ComposerJson/Index.html>`__.
      Use the version selector to choose the TYPO3 version you are
      using, there may be small differences.

Classic Mode
------------

.. _installation-1:

Installation
^^^^^^^^^^^^

Installation works exactly the same as know from previous TYPO3
versions. The only difference is, that if the TYPO3 sources are cloned
from the git repository, a ``composer install --no-dev`` needs to be
performed in the sources directory every time the sources are updated
from the git repository. This ensures that all third party dependencies
are loaded. This step is done before packaging the tarball releases, so
no such action is required when using these.

.. _class-loading-1:

Class Loading
^^^^^^^^^^^^^

The TYPO3 class loader has been removed in favor of the composer class
loader, which also takes care of finding files for a given class name in
**Classic Mode**. This has several implications for admins, integrators
and developers:

#. ext_autoload.php files are **NOT** evaluated any more!
#. There is **NO** runtime evaluation of class files any more. This
   means a big performance boost and a more robustness during runtime.
#. Extension class loading information is only written and updated,
   every time an extension is activated or deactivated.
#. If no additional class loading information is found in extension meta
   data, the **COMPLETE** extension directory is scanned for class
   files. **ALL** found classes are then made available for class
   loading. This also means that adding classes during development, will
   only be found once the class loading information is updated.
#. PSR-4 compatible class loading information can be specified in a
   composer.json of the extension to ease development of extensions. It
   is recommended to do this in a composer.json file delivered by the
   extension. Alternatively this can be done similarly in the
   `"autoload" section in the
   ext_emconf.php <https://docs.typo3.org/typo3cms/extensions/core/7.6/singlehtml/Index.html#feature-68700-autoload-definition-can-be-provided-in-ext-emconf-php>`__
   [not available anymore].
#. The class loading information of extensions will end up in
   ``typo3temp/autoload``. Do **NOT** delete this directory, especially
   not in production environments. It contains vital information for
   your TYPO3 installation. If you need to update the class loading
   information, do it from command line
   ``php typo3/cli_dispatch.phpsh extbase extension:dumpclassloadinginformation``

Composer cheatsheet for common scenarios
========================================

Composer warning after updating composer.json file
--------------------------------------------------

**ANY** change in composer.json, ​\ **MUST**\ ​ also change the
composer.lock file, as the composer.lock file incorporates a hash over
the composer.json file content. You can perform
``composer update --lock`` if only minor things are changed (e.g.
homepage or description). If dependencies are added or removed, please
use ``composer update``,
``composer remove package/name --update-with-dependencies`` for that,
which will update the composer.lock automatically.

Be ready for production
-----------------------

Before deploying your code in production, don't forget to optimize the
autoloader: ``composer dump-autoload --classmap-authoritative``

This could also be used while installing packages with the
``--classmap-authoritative`` option. Without the optimization, you may
notice a performance loss.

TYPO3 6.2.x
===========

.. container::

   warning - Message

   .. container::

      This TYPO3 version comes with limited composer support. If you
      want to use composer for your TYPO3 installations, it is highly
      recommended to upgrade to TYPO3 7LTS

Basic TYPO3 Composer Distribution
---------------------------------

TYPO3 can be required as package in any root composer.json
(distribution). The composer package name of the complete TYPO3 sources
is ``typo3/cms``

The recommended base for your TYPO3 distribution is
``typo3/cms-base-distribution`` The ``"repositories"`` section in the
composer.json of this distribution is required if you want to have
access to all TER extensions as composer packages. See
https://composer.typo3.org for details.

The ``"vendor-dir": "Packages/Libraries"`` configuration is required for
advanced class loading capabilities.

Recommended minimum example composer.json:

.. container::

   `JavaScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_JavaScript>`__
   [deprecated wiki link]

.. container::

   ::

      {
        "repositories": [
          { "type": "composer", "url": "https://composer.typo3.org/" }
        ],
        "name": "my-vendor/my-typo3-cms-distribution",
        "config": {
          "vendor-dir": "Packages/Libraries",
          "bin-dir": "bin"
        },
        "require": {
          "typo3/cms": "6.2.x-dev"
        }
      }

Doing a ``composer install`` will result in the following directory
structure, which is **not changeable** for TYPO3 6.2.x!

::

   -rw-r--r--   .gitignore
   drwxr-xr-x   Packages
   drwxr-xr-x   bin
   -rw-r--r--   composer.json
   -rw-r--r--   composer.lock
   lrwxr-xr-x   index.php -> typo3_src/index.php
   lrwxr-xr-x   typo3 -> typo3_src/typo3
   drwxr-xr-x   typo3_src

**IMPORTANT:** This means the TYPO3 sources are downloaded or cloned
into a typo3_src folder and index.php file and typo3 directory are set
up as symlinks. This directory will then serve as document root
directory of your installation.

.. _class-loading-2:

Class Loading
-------------

To improve the reliability of TYPO3 6.2.x the `composer class
loader <composerclassloader>`__ was added to TYPO3 6.2.10. Classes of
all required TYPO3 extensions will be loaded by the composer class
loader since that version.

Advanced Class Loading Setup
----------------------------

It is possible to require any third party composer package in your root
composer.json, but TYPO3 normally will not make the classes of these
packages available. However even since TYPO3 6.2.10 it is possible to
have classes of all composer packages available if the
``TYPO3_COMPOSER_AUTOLOAD`` **environment variable** is set in your web
server (or on the command line). If this is done, all classes of
composer packages can be automatically loaded in your TYPO3
installation.

Besides that, you can specify class loading information for extensions
and the core in your root composer.json, with the benefit of e.g. a more
reliable deployment, since the old class loader will not be in charge
any more.

Helpful Links
=============

official documentation:

-  `Installation & Upgrade Guide » Install TYPO3 via
   composer <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/QuickInstall/Composer/Index.html>`__
   for installing TYPO3 with Composer
-  `Installation & Upgrade Guide » Migrate TYPO3 Project to
   Composer <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/MigrateToComposer/Index.html>`__
   for migrating non-Composer project to Composer
-  `TYPO3 Explained »
   composer.json <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ExtensionArchitecture/ComposerJson/Index.html>`__
   for extension developers
-  `TYPO3 Explained »
   Autoloading <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Autoloading/Index.html>`__
   for extension developers

Tools:

-  `Composer Helper <https://get.typo3.org/misc/composer/helper>`__

Wiki

-  `ComposerClassLoader <composerclassloader>`__
-  see also:

community blogs:

-  `GOOD PRACTICES IN TYPO3
   PROJECTS <https://usetypo3.com/good-practices-in-projects.html>`__
   (use TYPO3 blog)
-  `10 Resources to Learn TYPO3
   Composer <https://t3terminal.com/blog/learn-typo3-composer/>`__
   (t3terminal blog)
-  `The Best Guide to TYPO3
   Composer <https://t3terminal.com/blog/guide-typo3-composer/>`__
   (t3terminal blog)
-  `THE TYPO3 SUBTREE SPLIT AND
   COMPOSER <https://usetypo3.com/typo3-subtree-split-and-composer.html>`__
   (use TYPO3 blog)
