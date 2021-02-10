.. include:: /Includes.rst.txt

==========================
Extension Developers Guide
==========================

<< Back to `Developer manuals <overview-developer-manuals>`__ page

`[edit] <https://wiki.typo3.org/wiki/index.php?title=Extension_Developers_Guide&action=edit&section=0>`__
[deprecated wiki link]

Short-name: `XDG <https://wiki.typo3.org/XDG>`__ [deprecated wiki link]

.. container::

   notice - This information is outdated

   .. container::

      Page has not been updated since 2017. The official documentation
      for extension development is located in `TYPO3 Explained »
      Extension
      Development <https://docs.typo3.org/typo3cms/CoreApiReference/latest/ExtensionArchitecture/Index.html>`__

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript.
      `info <https://wiki.typo3.org/Help:Contents#Teamwork_-_draft_review_publish_delete_merge_outdated>`__
      [deprecated wiki link]

Introduction
============

The document **TYPO3 Extension Development** is a
`guide <https://wiki.typo3.org/Category:Guide>`__ [deprecated wiki link]
mainly for extension developers, explaining the basic steps to create an
extension and going further into advanced topics useful for TYPO3
`extension
development <https://wiki.typo3.org/Category:Extension_development>`__
[deprecated wiki link].

What is an extension?
---------------------

`glossary-definition <https://wiki.typo3.org/Category:Glossary-definition>`__
[deprecated wiki link]: An extension is a piece of software that extends
or alters the functionality of TYPO3. Extensions let TYPO3 perform
almost any function you could imagine. TYPO3 is built for flexibility
(it is a CMS *framework*); and it is one of the most flexible CMS
frameworks around.

A wide variety of extensions can be downloaded from the TYPO3 extension
repository ("TER").

Extension types
---------------

Explains the difference between user extensions and core extensions, and
when to use either either of those. Additional types are: Backend
modules, frontend plugins, code libraries, services etc.

Required knowledge
------------------

*Concepts that are required to write extensions. E.g. PHP, databases and
database normalization, TypoScript, OOP etc.*

Extensions for extension developers
-----------------------------------

Extension Builder
^^^^^^^^^^^^^^^^^

| The `Extension Builder <extension-builder>`__ helps you develop
  extensions based on
  `Extbase <https://forge.typo3.org/projects/typo3v4-mvc/wiki>`__ [not
  available anymore] and
  `Fluid <http://flow.typo3.org/documentation/manuals/fluid/>`__ [not
  available anymore].
| It can be downloaded from
  `extension_builder <https://extensions.typo3.org/extension/extension_builder/>`__.

The most important resources are:

-  the `Extension Builder wiki page <extension-builder>`__
-  the `Extension Builder TYPO3 Forge
   project <https://forge.typo3.org/projects/show/extension-extension_builder>`__
   [not available anymore].

Extension Development Evaluator
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The extension
`extdeveval <https://extensions.typo3.org/extension/extdeveval/>`__
provides an API reference for extensions and a link list to
documentation.

T3DEV Developer Extension
-------------------------

A newer extension for developers that integrates better in TYPO3 >=4.2.
`t3dev <https://extensions.typo3.org/extension/t3dev/>`__

Show TYPO3 Info
^^^^^^^^^^^^^^^

`sg_showdoku <https://extensions.typo3.org/extension/sg_showdoku/>`__

Kickstarter
^^^^^^^^^^^

`kickstarter <https://extensions.typo3.org/extension/kickstarter/>`__

Kickstarter MVC (lib/div)
'''''''''''''''''''''''''

`kickstarter__mvc <https://extensions.typo3.org/extension/kickstarter__mvc/>`__
is an add-on for the
`kickstarter <https://extensions.typo3.org/extension/kickstarter/>`__.
It generates MVC-style frontend plugins based on the (deprecated)
lib/div libraries `lib <https://extensions.typo3.org/extension/lib/>`__.
See `Kickstarter_team#Kickstarter MVC
(lib/div) <https://wiki.typo3.org/Kickstarter_team#Kickstarter_MVC_.28lib.2Fdiv.29>`__
[deprecated wiki link]

The TYPO3 architecture
======================

*TODO.* Explains the overall architecture of TYPO3, possibly accompanied
by diagrams. The "why" of things is also very important here.
Pre/post-processing issues, the role (and boundaries!) of Typoscript,
the philosophy behind the architecture, the TCA etc.

Extension Maintenance
=====================

Local extensions
----------------

The local extensions usually resides in the ``typo3conf/ext/``
directory.

| *Pros*
| Extensions in the local scope will **not be overwritten** when
  updating the TYPO3 Installation. It is recommended to put most
  extensions into local scope.

| *Cons*
| When multiple TYPO3 installations share one ``typo3_src/`` directory,
  it can be a waste of space when every instance has its own copies of
  extensions in local scope.

Global extensions
-----------------

The global extensions (on standard TYPO3 installations) usually reside
in the ``typo3/ext`` directory.

| *Pros*
| When multiple TYPO3 installations share one ``typo3_src/`` directory,
  it can be beneficial to install often needed or default extensions in
  global scope in certain cases.

| *Cons*
| When updating, the folder ``typo3/`` containing the backend will be
  fully replaced including the extensions in global scope.

Upgrading
---------

Practices that are involved with keeping your server clean and safe for
upgrading (i.e. avoiding breaking things by modifying an existing
extension and then upgrading it), some things about dependencies, how to
manually install extensions etc.

PHP Compatibility
-----------------

Things to keep in mind when installing extensions on the server (like
the register_globals thing, explaining the distribution's .htaccess file
that sets PHP flags, PHP version compatibility, etc.)

TYPO3 Compatibility
-------------------

Each new TYPO3 version brings changes to its predecessor. Extension
developers must consider those changes and decide which TYPO3 versions
an extension will support. The library extension div2007 brings a lot of
functions and a backwards class map to support backwards compatibility
for TYPO3 4.5. It contains a copy of the original t3lib_div library.

Programming Extensions
======================

(note: probably better to not rely on the kickstarter here, it's more
educative to learn from scratch if you really want to learn about
extension writing, and that's why someone reads this guide after all)

One base for all - Or one for many at least
-------------------------------------------

(Explains when and how you should inherit from ``tslib_pibase``, and how
your extension will be '`hook <https://wiki.typo3.org/Category:Hook>`__
[deprecated wiki link]ed' at runtime. Please extend!)

When Kasper Skårhøj put the idea of extensions for TYPO3 into reality,
he delivered a PHP class which can serve as a basis for frontend
plugins. This class is called ``tslib_pibase``, derived from
``plugin base``. It's not required to use this class. If you code your
own version, this class gives you a good example for the required API.

Whenever you create a new frontend plugin with TYPO3's kickstarter
wizard, you will find a working hello world example in the extension's
directory. This sample code already uses pi_base and maybe you have been
using it at some point without really taking notice of it.

By the way - the file which contains pi_base is part of the CMS
extension and located in
``typo3/sysext/cms/tslib/class.tslib_pibase.php``. Have a look at this
file right now, it is well commented and provides some vital features
for your own plugins.

The file ``class.tslib_pibase.php`` contains the parent class
``tslib_pibase``, providing an API with the most basic methods for
frontend plugins. It contains;

-  **Init functions**, to initialize ``$pivars`` for example,
-  **Link functions**, to create various kinds of links,
-  **Listing, browsing, searching functions**, for working with database
   records,
-  **Stylesheet and CSS functions**,
-  **Database and query functions**,
-  **FlexForms related functions**,
-  **Various functions**, e.g.: ``pi_RTEcssText()``.

A full listing of all the functions can be found at the top of the file.

When you write a plugin class, derive from this class. This will save
you a lot of work if you plan to work with anything in the list above.
Of course, you can also write your own functions.

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      require_once(PATH_tslib.'class.tslib_pibase.php');

      class tx_photoblog_pi1 extends tslib_pibase {
        // Your functions go here
      }

The nice thing about this setup is that you can write your own
implementation of a function. Your plugin will then use your
implementation instead of the one in ``tslib_pibase``. So if you, for
example, don't like the way ``pi_setPiVarDefaults()`` behaves, you can
write your own.

**When using the kickstarter, your new extension class will
automatically be derived from ``tslib_pibase``.**

Things you must use
-------------------

Explains which parts of the TYPO3 API are mandatory to use in order to
work correctly with TYPO3 or "system-intense" extensions of TYPO3 (like
RealURL).

TYPO3\CMS\Core\Utility\GeneralUtility (formerly named t3lib_div)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

makeInstance()
''''''''''''''

To instantiate an object, use the ``new`` operator only in concert with
``makeInstanceClass()`` or substitute it by ``makeInstance()``. e.g.

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $request = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Http\HttpRequest');

ObjectManager->get()
''''''''''''''''''''

In Extbase context you should use an instance of
\\TYPO3\CMS\Extbase\Object\ObjectManager (which is already available as
a class variable in the Controller) and call

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $myModel = $this->objectManager->get('VendorName\SomeExtensionKey\Domain\Model\MyModel');

getUserObj()
''''''''''''

Should not be used anymore!

Typolinks in FE-plugins
^^^^^^^^^^^^^^^^^^^^^^^

Only links which are generated with the ``typolink`` function work
properly in all situtations. This is necessary for the support of
Realurl, CoolURI, for frames, languages, proper caching, result browser
and a lot more.

You can use the ``typolink`` function directly or indirectly.

Directly calling the typolink function
''''''''''''''''''''''''''''''''''''''

-  `typolink
   API <https://typo3.org/api/typo3cms/class_t_y_p_o3_1_1_c_m_s_1_1_frontend_1_1_content_object_1_1_content_object_renderer.html#ab9a4e1df5b1663cb431045866cf555ce>`__
   [not available anymore]
-  `Parameter reference
   (TSref) <https://docs.typo3.org/typo3cms/TyposcriptReference/Functions/Typolink/Index.html>`__

Please set up a page to show how this is done and link it.

Indirect calls to the typolink function
'''''''''''''''''''''''''''''''''''''''

-  ``tslib_pibase``

   -  ``$this->pi_getPageLink()`` for internal links (parameter: id)
   -  ``$this->pi_linkToPage()`` for internal links (parameters: title,
      id)

-  `lib <https://extensions.typo3.org/extension/lib/>`__

   -  The class tx_lib_link of the extension
      `lib <https://extensions.typo3.org/extension/lib/>`__

See

-  details
   `article <https://typo3.org/documentation/article/using-links-in-frontend-plugins/>`__
   [not available anymore] of Robert Lemke
-  `advanced considerations about links and
   caching <http://t3flyers.wordpress.com/2006/09/11/a-quick-guide-to-proper-caching-with-tslib_pibase-episode-1/>`__
   [not available anymore] by Elmar Hinz
-  other wiki-pages about realurl

Discussion: ``tslib_pibase`` vs. other options
''''''''''''''''''''''''''''''''''''''''''''''

Usage of the the ``typolink`` function is not trivial. On the other
hand, the indirect functions of ``tslib_pibase`` are cryptic and you
have to learn multiple of them. Each of that functions is limited in its
range of use. You should consider this if you build a simple extension
with typical links.

The class ``tx_lib_link`` also doesn't match all use cases, estimated
95%. Inheritance of an own class is an option for the remaining 5%.

You should consider to learn the direct use of the ``typolink``
function, if you program extensions often. You have only to learn one
function one time and it works for all use cases.

Things you can use
------------------

If you are programming a `Frontend
Plugin <https://wiki.typo3.org/wiki/index.php?title=Types_of_user_extensions_(XDG)&action=edit&redlink=1>`__
[not available anymore], the main API functions for that are in
``tslib_pibase`` (``tslib/class.tslib_pibase.php``) and ``tslib_cObj``
(``class.tslib_content.php``).

tslib_cObj
^^^^^^^^^^

Description of how to use the API functions of the class ``tslib_cObj``.

Common to those functions is the way parameters are passed to it.

Normally PHP functions get their configuration as several distinct
parameters, like:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      doSomething($parameter);

The trick about the ``tslib_cObj`` API functions is that they always
expect an associative array ``$conf`` to be passed to it which contains
the parameters.

The following example shows a valid ``$conf`` array for the ``IMAGE``
function:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $conf = array(
          'file' => 'fileadmin/my_image.jpg',
          'alttext' => 'This image is an example!',
      );

The great thing about this is that all possible parameters are
documented in the TSref.

More to come here.

Example:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $conf = array(
          'parameter' => 'http://www.typo3.org 230x450:resizable=0,location=1',
          'title' => 'Title-Tag: Link to typo3.org',
          'ATagParams.' => array(
              'append' => 'TEXT',
              'append.' => array(
              'value' => '  ',
              ), 
          ),
      );
      $content .= $this->cObj->typolink('linktext', $conf);

``tslib_pibase``
^^^^^^^^^^^^^^^^

Description of the class ``tslib_pibase``

**!! To ensure future compatibility of your extension we highly
recommend not to use pi_base any more, but the Extbase framework which
also has an Extension Builder Manual**

Finding classes/functions
-------------------------

This is a suggestion of an approach when working with TYPO3 classes, but
you don't know where the function (method) you are looking for is
located and how it is called:

-  Read the `TYPO3 Core
   APIs <https://docs.typo3.org/typo3cms/CoreApiReference/>`__
   documentation and find the chapter about `High Priority
   Functions <https://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/MainClasses/HighPriorityFunctions/Index.html>`__
   [not available anymore].
-  Install the
   `extdeveval <https://extensions.typo3.org/extension/extdeveval/>`__
   extension (extdeveval). It's a must for developers and gives you a
   nice API documentation for most of the important classes.
-  Have a look at the `full API
   documentation <https://typo3.org/documentation/api>`__ [not available
   anymore]. Or use doxygen to generate your own version from source.
-  Debugging ``$GLOBALS`` can give some insight...
-  If you want to get more information on a certain function, study the
   source/use a debugger to find out how something is done in another
   ext/functionality. Have a closer look on how the function is called:

::

   t3lib_extMgm::extRelPath($_EXTKEY)
                            ^------ the extension-key ;)
                 ^------ the functions name, search for that in the file
         ^------ it is class.t3lib_extmgm.php
   ^----- it's in folder 't3lib' (t3lib = TYPO3 Library)

Read the description of the function ``extRelPath()`` in file
``class.t3lib_extmgm.php``.

Types of user extensions
------------------------

Backend
^^^^^^^

All kind of BE-related extensions for extending or replacing backend
functions. The extensions in this category do not create a new link in
the main menu on the left side, they implement or extend functions of
other backend areas. For example, an extension extending the clickmenu
with more items or an extension implementing a new RTE should be put in
this section.

Backend Modules
^^^^^^^^^^^^^^^

A backend module is an extension that has a link in the main menu below
one of the main menu items "web", "file", "doc", "tools" or "help".
Backend modules are usually closed sections of their own, this means
their functions are not used anywhere else. Examples: visitor tracking
system, AWStats, Backup

Frontend
^^^^^^^^

This is a category for extensions that influence and alter the frontend
output in general like parsers.

Frontend Plugins
^^^^^^^^^^^^^^^^

Frontend plugins are listed as pluggable content elements in the TYPO3
backend. While most other content elements display a **single** content
entry of ``tt_content``, the range of the functionality of plugins is
broad. Often they display **multiple** entries of other tables than
``tt_content`` in form of a combination of a list view and a details
view.

One extension can contain more than one frontend plugin. While the
kickstarter creates them as folders named ``pi1``, ``pi2`` and so on, it
is a good habit to choose more telling names for the folders.

Clickmenu items
^^^^^^^^^^^^^^^

A clickmenu item is added to the BE clickmenu.

Miscellaneous
^^^^^^^^^^^^^

Mostly some libaries.

Services
^^^^^^^^

Templates
^^^^^^^^^

Examples
^^^^^^^^

Skins
^^^^^

Skins for the TYPO3 backend.

Required extension files
------------------------

Most of the content of this list is taken from `T3Doc/TYPO3 Core
APIs <https://wiki.typo3.org/T3Doc/TYPO3_Core_APIs>`__ [deprecated wiki
link]: "files and locations".

All these files are either marked (optional) or (required).

Documentation about the **file layout/structure** of a typo3 extension:

-  `TYPO3 Core documentation: File system conventions / Extension
   directory
   structure <https://docs.typo3.org/typo3cms/CodingGuidelinesReference/FileSystemConventions/ExtensionDirectoryStructure/Index.html>`__
   [not available anymore]
-  `Fluid-based extension directory layout by
   example <https://forge.typo3.org/projects/typo3v4-mvc/repository>`__
   [not available anymore]

``ext_emconf.php`` *(required)*
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The term "emconf" stands for "Extension Manager/Repository config file".
This file holds general information about the extension in an array
called ``$EM_CONF[$_EXTKEY]``. It is automatically written by the
Extension Manager when extensions are imported from the repository.

**If this file is missing, the Extension Manager won't find the
extension.**

``ext_localconf.php`` (optional)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Addition to ``LocalConfiguration.php`` which is included if it is found.
Should contain additional configuration of
``$GLOBALS['TYPO3_CONF_VARS']`` and may include additional PHP class
files. All ``ext_localconf.php`` files of included extensions are
included right after the ``typo3conf/LocalConfiguration.php`` file has
been included and the database constants are defined. Therefore you
cannot setup database name, username, password in ``ext_localconf.php``
files, since at this point these database constants are already defined.

``ext_tables.sql`` *(optional)*
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This file contains SQL statements to update or create tables for your
extension in the TYPO3 database.

This file should contain a table structure dump of the tables used by
the extension. It is used for evaluation of the database structure and
is therefore important to check and update the database when an
extension is enabled. If you add additional fields (or depend on certain
fields) to existing tables, you can also put them here. In that case,
insert a ``CREATE TABLE`` structure for that table, but remove all lines
except the ones defining the fields you need. The ``ext_tables.sql``
file may not necessarily be dumpable directly to MySQL (because of the
semi-complete table definitions allowed defining only required fields,
see above). But the EM or Install Tool can handle this. The only very
important thing is that the syntax of the content is exactly like MySQL
made it so that the parsing and analysis routines of the EM don't get
confused.

``ext_tables.php`` *(optional)*
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This file works hand in hand with the above by telling TYPO3 how to
display and handle the data from the SQL file.

It contains additions to ``tables.php`` and is included if found. Should
contain configuration of tables, modules, backend styles etc. Everything
which can be done in an ``ext_tables.php`` file is allowed here. All
``ext_tables.php`` files of loaded extensions are included right after
the ``tables.php`` file in the order they are defined in the global
array ``$GLOBALS['TYPO3_LOADED_EXT']``. Thus a general
``ext_tables.php`` file in ``typo3conf/`` may overrule any settings made
by loaded extensions. You should not use this file for setting up
``$GLOBALS['TYPO3_CONF_VARS']``. See ``ext_localconf.php``.

``ext_tables_static+adt.sql`` *(optional)*
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Static SQL tables and their data. If the extension requires static data
you can dump it into a SQL file of this name. Example for dumping MySQL
data from the shell (assuming you are in the extension directory):

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      mysqldump --password=[password] [database name] [tablename] --add-drop-table > ./ext_tables_static.sql

``--add-drop-table`` adds ``DROP TABLE`` statements, so that any data is
inserted into a fresh table. You can also drop the table content using
the EM in the backend.

**The table structure of static tables needs to be in the ext_tables.sql
file as well - otherwise an installed static table will be reported as
being in excess in the EM!**

``locallang_db.php`` *(optional)*
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The language file with translations for every row. Used for displaying
them in the backend.

``locallang.php`` *(optional)*
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The language file with translations for the extension scripts.

``ext_typoscript_setup.txt`` *(optional)*
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Contains `TypoScript <https://wiki.typo3.org/Category:TypoScript>`__
[deprecated wiki link] for the extension.

``ext_icon.gif`` *(optional)*
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The extension icon displayed in the EM.

Extending an extension
----------------------

*Actions that are required to extend an extension, and the implications
this has for future compatibility. A case study would be useful here.*
Core `hook <https://wiki.typo3.org/Category:Hook>`__ [deprecated wiki
link]s: How you would extend the core by requesting a hook from the core
devs?

If you want to extend an existing extension TCA:

-  Set up a simple extension with the kickstarter.
-  In ``ext_tables.php``, add these lines to the top:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      if (!defined ('TYPO3_MODE')) {
          die ('Access denied.');
      }

      $GLOBALS['TCA']['tt_news']['columns']['bodytext']['config']['rows'] = 15;

-  In BE > System > Configuration > Menu $GLOBALS['TCA'] (Table
   configuration array), you can select the changes and copy this
   configuration to ``ext_table.php``.

*Remark:* Be careful with this. To have this work, your new extension
containing this must be after ``tt_news`` in
``$GLOBALS['TYPO3_CONF_VARS']['EXT']['extListArray']`` (in
``typo3conf/LocalConfiguration.php``). Updating, installing and
uninstalling extensions can mess up this order.

*Remark:* The extensions are in proper order in
``$GLOBALS['TYPO3_CONF_VARS']['EXT']['extListArray']`` as long as the
dependencies are declared in ``ext_emconf.php``. These dependencies
might be lost during upload, due to a current bug of the TER.

Quality standards
-----------------

*Explains the reviewing guidelines which are the official standard for a
quality extension. How to get that Cohiba?*

Common practices
================

Security
--------

-  `security_check <https://extensions.typo3.org/extension/security_check/>`__
   - This extension makes some
   `security <https://wiki.typo3.org/Category:Security>`__ [deprecated
   wiki link] checks on your TYPO3 installation. It does \*not\* check
   the code.
-  `Inside TYPO3 - Security in
   TYPO3 <https://docs.typo3.org/typo3cms/InsideTypo3Reference/CoreArchitecture/SecurityInTypo3/Index.html>`__
   [not available anymore]
-  Database: `Cleaning
   functions <https://wiki.typo3.org/XDG#Security_-_Cleaning_functions>`__
   [deprecated wiki link], `quoting
   function <https://wiki.typo3.org/XDG#Security_-_quoting_function>`__
   [deprecated wiki link]
-  `40+ Steps to Improve Your TYPO3
   Security <https://t3terminal.com/blog/typo3-security/>`__

Handling user data
------------------

*Examples along with descriptions on how to handle incoming
``GET``/``POST`` data.*

Dealing with Typoscript
-----------------------

*Explains when to use Typoscript for your extensions and how to read it
in the extensions.*

**Warning:** You will only be able to understand this chapter if you
have read the documentation `TypoScript Syntax and In-depth
Study <https://docs.typo3.org/typo3cms/TyposcriptSyntaxReference/>`__
[not available anymore].

Handling file uploads
---------------------

*Examples of dealing with file uploads in extensions.*

Using sessions
--------------

Sessions are a mechanism to carry user data (parameters) along the web
site visit without having to post them over and over again. The data is
available as long as the session is valid, usually until all browser
windows are closed.

Since TYPO3 instantiates a session automatically, you can use this
existing session to read/write data into it. However, you must first
understand that sessions in frontend and backend are handled
differently.

The routine on the other hand is always the same.

-  Recover your data from the session
-  Add values (possibly into an array that holds all the session data)
-  Save your data to the session

.. _backend-1:

Backend
^^^^^^^

In backend modules, session data is retrieved like this:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $sessionData = $GLOBALS['BE_USER']->getSessionData('tx_myextension');

You can store your own data as follows:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $sessionData['somevalue'] = "Hello World";

To save the data to the session in the end:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['BE_USER']->setAndSaveSessionData('tx_myextension', $sessionData);

Storing data across the session
'''''''''''''''''''''''''''''''

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       $GLOBALS['BE_USER']->uc['name of setting'] = $value;
       $GLOBALS['BE_USER']->overrideUC();
       $GLOBALS['BE_USER']->writeUC();

See
http://api.typo3.org/typo3cms/current/html/class_t_y_p_o3_1_1_c_m_s_1_1_core_1_1_authentication_1_1_backend_user_authentication.html
[not available anymore]

.. _frontend-1:

Frontend
^^^^^^^^

In frontend modules, sessions are handled slightly differently:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_myextension_mykey');

Modify the data:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $sessionData['somevalue'] = "Hello World";

And save it to the session:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_myextension_mykey', $sessionData);
      $GLOBALS['TSFE']->fe_user->storeSessionData();

Using the database
------------------

.. _introduction-1:

Introduction
^^^^^^^^^^^^

The `DBAL <https://wiki.typo3.org/Category:DBAL>`__ [deprecated wiki
link] consists of the class ``t3lib_DB`` in ``$GLOBALS['TYPO3_DB']``. It
offers methods to build queries for creating, retrieving, updating and
deleting (CRUD) records from tables in the db: ``INSERTquery()``,
``SELECTquery()``, ``UPDATEquery()`` and ``DELETEquery()``; and to
execute such queries and retrieve the result handle (a PHP resource):
``exec_INSERTquery``, ``exec_SELECTquery()``, ``exec_UPDATEquery()`` and
``exec_DELETEquery()``. This handle and the result set it represents can
be browsed by methods in the class. These methods will be familiar to
people knowing the PHP MySQL functions; for example, the PHP function
``mysql_num_rows`` has an equivalent in the ``t3lib_DB`` method
``sql_num_rows()``, ``mysql_fetch_assoc()`` in ``sql_fetch_assoc()`` and
so on.

Many-to-many relations
^^^^^^^^^^^^^^^^^^^^^^

There are methods for retrieving many-to-many relations from tables that
adhere to the TYPO3 way of MM relations.

*Parameter help:*

-  Use ``$mm_table`` together with ``$local_table`` or
   ``$foreign_table`` to select over two tables. Or use all three tables
   to select the full MM relation.
-  The ``JOIN`` is done with ``[$local_table].uid`` <->
   ``[$mm_table].uid_local`` / ``[$mm_table].uid_foreign`` <->
   ``[$foreign_table].uid``
-  The functions are can work on MM relations between tables adhering to
   the MM format as used by TCE (TYPO3 Core Engine). See the section on
   ``$GLOBALS['TCA']`` in `Inside
   TYPO3 <https://docs.typo3.org/typo3cms/InsideTypo3Reference>`__ for
   more details.

Function Overview
^^^^^^^^^^^^^^^^^

Query execution
'''''''''''''''

-  ``exec_INSERTquery($table, $fields_values)``
-  ``exec_UPDATEquery($table, $where, $fields_values)``
-  ``exec_DELETEquery($table, $where)``
-  ``exec_SELECTquery($select_fields, $from_table, $where_clause, $groupBy=, $orderBy=, $limit=)``
-  ``exec_SELECT_mm_query($select, $local_table, $mm_table, $foreign_table, $whereClause=, $groupBy=, $orderBy=, $limit=)``

::

   Creates and executes a SELECT query, selecting fields ($select) from two or three joined tables.

-  ``exec_SELECT_queryArray($queryParts)``
-  ``exec_SELECTgetRows($select_fields, $from_table, $where_clause, $groupBy=, $orderBy=, $limit=, $uidIndexField=)``

To get the last inserted id, you can use:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_DB']->sql_insert_id();

Query building
''''''''''''''

-  ``INSERTquery($table, $fields_values)``
-  ``UPDATEquery($table, $where, $fields_values)``
-  ``DELETEquery($table, $where)``
-  ``SELECTquery($select_fields, $from_table, $where_clause, $groupBy=, $orderBy=, $limit=)``
-  ``listQuery($field, $value, $table)``
-  ``searchQuery($searchWords, $fields, $table)``

Helper functions
''''''''''''''''

-  ``quoteStr($str, $table)``
-  ``cleanIntArray($arr)``
-  ``cleanIntList($list)``
-  ``stripOrderBy($str)``
-  ``stripGroupBy($str)``
-  ``splitGroupOrderLimit($str)``

SELECT
^^^^^^

As an example, let's try to select the fields ``uid``, ``name`` and
``email`` from the ``tt_address`` table. We only want to select records
with a certain pid contained in the variable ``$id``.

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, name, email', 'tt_address', 'pid='.$id);

This will return a record set with all the ``tt_address`` records in the
folder with uid ``$id``. Actually, the DBAL will *not* check the
``WHERE`` clause (``pid=$id``) for SQL-injection, and if ``$id`` is
fetched from the browser, it is a good idea to put it through
``intval()`` since it is supposed to be an integer.

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, name, email', 'tt_address', 'pid='.intval($id));

You should use the ``enableFields()`` method to exclude entries which
have been deleted, are hidden or have been scheduled using {start, end}
time. ``enableFields()`` returns a string for your ``WHERE`` clause:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $where = 'pid='.intval($id);
      $where .= $this->cObj->enableFields('tt_address');
      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, name, email', 'tt_address', $where);

If you don't already have a ``WHERE`` clause, you will get a wrong SQL
statement ("``SELECT * FROM tt_address WHERE AND ...``"), so you have to
strip the leading AND in this case:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $where = preg_replace('/^ AND/', '', $where);

But it's more efficient to change
"``SELECT * FROM tt_address WHERE AND ...``" to
"``SELECT * FROM tt_address WHERE 1=1 AND ...``" with

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $where = '1=1'.$where;

and change "``SELECT * FROM tt_address WHERE OR ...``" to
"``SELECT * FROM tt_address WHERE 1=0 OR ...``" with

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $where = '1=0'.$where;

To escape strings for SQL, TYPO3 has a method which should be used in
place of the standard PHP function ``addslashes()``:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_DB']->quoteStr($string,$table); // returns string

The result set can now be browsed like this:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
          do_something_with_the_data($row);
      }

To destroy the result set when finished with it, use the method
``sql_free_result()``:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_DB']->sql_free_result($res);

``exec_SELECTquery()`` takes these parameters (taken from the docs in
the source file):

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       /**
        * Creates and executes a SELECT SQL-statement
        * Using this function specifically allow us to handle the LIMIT feature independently of DB.
        * Usage count/core: 340
        *
        * @param   string  List of fields to select from the table. This is what comes right
        *                     after "SELECT ...". Required value.
        * @param   string  Table(s) from which to select. This is what comes right after "FROM ...".
        *                     Required value.
        * @param   string  Optional additional WHERE clauses put in the end of the query. NOTICE: You 
        *                     must escape values in this argument with $this->quoteStr() yourself! DO NOT
        *                     PUT IN GROUP BY, ORDER BY or LIMIT!
        * @param   string  Optional GROUP BY field(s), if none, supply blank string.
        * @param   string  Optional ORDER BY field(s), if none, supply blank string.
        * @param   string  Optional LIMIT value ([begin,]max), if none, supply blank string.
        * @return  pointer     MySQL result pointer / DBAL object
        */
      function exec_SELECTquery($select_fields, $from_table, $where_clause, $groupBy='', $orderBy='', $limit='')

UPDATE
^^^^^^

To update records, use ``exec_UPDATEquery()``. It takes the table name,
``WHERE`` clause and an associative array of field name => value pairs.
The values are run through ``t3lib_DB->quoteStr().``

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_DB']->exec_UPDATEquery('tt_address', 'uid='.intval($uid), array('email' => $email, 'name' => $name));

````

INSERT
^^^^^^

````

Inserting records is similar to updating records, except there is no
``WHERE`` clause.

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_address', array('name' => $name, 'email' => $email));

````

When inserting a record, you can use ``sql_insert_id()`` to retrieve the
id of the latest inserted record.

````

DELETE
^^^^^^

````

You can delete records with ``exec_DELETEquery()``. It takes two
arguments, the table to delete from, and the ``WHERE`` clause to select
which records to delete.

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_DB']->exec_DELETEquery('tt_address', 'uid='.intval($uid));

````

Again, make sure the input parameters are sanitized by running them
through intval() or similar, to prevent SQL injection.

````

Debugging
^^^^^^^^^

````

One drawback of using the
`DBAL <https://wiki.typo3.org/Category:DBAL>`__ [deprecated wiki link]
is that all database errors, like malformed queries, will look like they
originated from the t3lib_db class. To
`debug <https://wiki.typo3.org/Category:Debug>`__ [deprecated wiki link]
DBAL invocations, set the following flag:

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_DB']->debugOutput = true;

````

This will save all *built* queries (not necessarily executed) in the
``$debug_lastBuiltQuery`` member variable. When ``$debugOutput`` is set,
all errors are output by ``echo`` (at least in the MySQL implementation
of DBAL).

See also the `Extension Development <extension-development>`__ mini
howto.

````

Security - input sanitizing functions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

````

The DBAL will check some of the variables, but when writing extension,
you are responsible for making sure that there are no SQL injection
exploits. Several helper functions exist for this. Use ``intval`` when
you know that the field is supposed to be an integer. DBAL offers two
other functions for cleaning lists and arrays of integers:

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_DB']->cleanIntList($list);
      $GLOBALS['TYPO3_DB']->cleanIntArray($arr);

````

They will make sure that the list or array only contains integers.

````

Security - quoting function
^^^^^^^^^^^^^^^^^^^^^^^^^^^

````

To escape strings, use the method ``quoteStr()`` of the DBAL. This
escapes your string according to which table you want to insert into. In
the MySQL implementation it is equivalent to calling ``addslashes()``,
but ``quotestr()`` is preferred as it is not database dependent.

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_DB']->quoteStr($str, $table);

````

Handling user authentication
----------------------------

````

*Examples on what exactly should happen for e.g. logging a user into
TYPO3.*

````

Constants
---------

````

To set the relative path from your script to the TYPO3 folder of your
installation in your extensions, use the ``BACK_PATH`` constant.

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $this->backPath = $GLOBALS['BACK_PATH'];

````

Set your own ``PATH_xxx`` constants in the ``ext_localconf.php`` file of
your extension.

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      if (!defined('PATH_txcommerce')) {
          define('PATH_txcommerce', t3lib_extMgm::extPath('commerce'));
      }
      if (!defined('PATH_txcommerce_rel')) {
          define('PATH_txcommerce_rel', t3lib_extMgm::extRelPath('commerce'));
      }

````

Debugging PHP code
------------------

````

The debug() function
^^^^^^^^^^^^^^^^^^^^

````

(``$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask']`` in
``LocalConfiguration.php`` must be set for this to work)

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      debug($variable . ' ' . __FILE__);

````

More comfortable debugging
''''''''''''''''''''''''''

````

Use this to get more information when debugging. This example includes
SQL information (``$GLOBALS['TYPO3_DB']->debug_lastBuiltQuery``):

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      ob_start();

      $GLOBALS['TYPO3_DB']->debugOutput = true;
      $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;

      /* your query and code here */
      debug(
          array(  
              'class: ' => __CLASS__,
              'method: ' => __METHOD__,
              'function: ' => __FUNCTION__,
              // what to debug
              $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery,
          ),
          'Debug data: ', __LINE__, __FILE__, 5
      );

````

Krumo
^^^^^

````

Useful for debugging code using the `MVC Framework <mvc-framework>`__
``lib/div``, as ``cc_debug`` doesn't work properly in conjunction with
``lib/div``. Get it from http://krumo.sourceforge.net/

````

-  Copy the krumo folder into the extension directory.
-  Modify ``ext_localconf.php``:

````

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      if (TYPO3_MODE === 'FE'){
          set_include_path(get_include_path().PATH_SEPARATOR.t3lib_extMgm::extPath('yourextension').'krumo/');
          require_once('class.krumo.php');
      }

````

-  Clear caches.

````

XDebug
^^^^^^

````

See http://xdebug.org/docs/display

Can be used to remote debug PHP code. There are `several
IDE's/debuggers <http://xdebug.org/docs/remote>`__ that support XDebug.

````

debug_mysql_db
^^^^^^^^^^^^^^

````

A very useful extension for SQL debugging in either Backend or Frontend
is
`debug_mysql_db <https://extensions.typo3.org/extension/debug_mysql_db/>`__.

````

Structural practices
====================

````

Coding conventions
------------------

````

TYPO3 Coding Standards
^^^^^^^^^^^^^^^^^^^^^^

````

Make sure to read the `TYPO3 coding
guidelines <https://docs.typo3.org/typo3cms/CodingGuidelinesReference/>`__
[not available anymore]. When developing TYPO3 core code, the style
guide *must* be followed. When you write your own extensions, you
*should* follow it.

````

General code guidelines
^^^^^^^^^^^^^^^^^^^^^^^

````

*This section is incomplete. Maybe it's better to directly link to
the*\ `TYPO3 Coding
Guidelines <https://docs.typo3.org/typo3cms/CodingGuidelinesReference/>`__\ *[not
available anymore] here.*

````

-  XHTML (transitional)/CSS compliance:

   -  Use quotes for attribute values
   -  Close your tags:

````

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <p>Creating paragraph number one is simple.</p>
      <p>Starting a new paragraph after number one is just as easy.</p>

````

-  Code guidelines:

   -  Comment all functions and classes fully, including parameters and
      return values
   -  Classes must have ``@package``/``@subpackage`` PHPdoc annotations,
      contain a function index and have the CVS keyword "$Id$" in the
      header comment of the document.
   -  *Please* **use english** words or abbreviations for class/function
      names, variables, comments, database table and field names, ...
   -  Prevent XSS and SQL injection by using
      ``htmlspecialchars(), t3lib_DB->quoteStr()``, ``intval()`` etc.
      approbiately.

````

File names
^^^^^^^^^^

````

-  File names must be all lowercase.

````

Handling content
----------------

````

*Examples of how to use template
markers,*\ `TemplaVoila <https://wiki.typo3.org/Category:TemplaVoila>`__\ *[deprecated
wiki
link],*\ `Smarty <https://wiki.typo3.org/Category:Smarty>`__\ *[deprecated
wiki link] etc.*

````

Writing larger extensions
-------------------------

````

*Suggestions on how to structure your code when writing larger
extensions (explanation of Front Controller style structures).*

````

Porting third party applications to TYPO3
-----------------------------------------

````

*Things to keep in mind when porting third party applications to TYPO3
such as database migration, user integration, etc.*

````

Accessibility
-------------

````

*Hints on accessible forms and more.*

````

Documentation
=============

````

Documentation is key! Please provide a documentation to every extension
with basic information like author, installation guide, configuration
(description of TSconfig or TypoScript keys), usefull links (repository,
forge), changelog, etc.

The documentation used to be written as an OpenOffice .sxw file, stored
in ``doc/manual.sxw``. This format is deprecated however.

*Sphinx* is the official format for official TYPO3 documentation
nowdays. Unlike OpenOffice, it is a plain text file format, based on
*reST* (reStructuredText).

A guide on how to add documentation to an extension is available on the
TYPO3 documentation platform:
https://docs.typo3.org/typo3cms/CoreApiReference/latest/ExtensionArchitecture/Documentation/Index.html

A brief introduction to reStructuredText (reST) concepts and its syntax,
as well as a list of examples is available at
https://docs.typo3.org/typo3cms/drafts/github/xperseguers/RstPrimer/
[not available anymore]
