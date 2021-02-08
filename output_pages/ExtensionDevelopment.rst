.. include:: /Includes.rst.txt

=====================
Extension Development
=====================

.. container::

   **Content Type:** `HowTo </Category:HowTo>`__ [deprecated wiki link].

<< Back to `Developer manuals <overview-developer-manuals>`__ page

`[edit] <https://wiki.typo3.org/wiki/index.php?title=Extension_Development&action=edit&section=0>`__
[deprecated wiki link]

.. container::

   notice - Newer documentation available

   .. container::

      The official documentation for extension development is located in
      `TYPO3 Explained » Extension
      Development <https://docs.typo3.org/typo3cms/CoreApiReference/latest/ExtensionArchitecture/Index.html>`__

.. container::

   notice - This information is outdated

   .. container::

      This page may contain totally outdated information!

You find all the different `extension
development </Category:Extension_development>`__ [deprecated wiki link]
manuals either by the `extensions <https://extensions.typo3.org/>`__
themself or in the TYPO3 `documentation
matrix <https://docs.typo3.org/typo3cms/>`__ [not available anymore].

A good place to start is the `Extension Developers Guide
(XDG) <extension-developers-guide>`__

Extension development mini how-to
=================================

This is a small how-to showing you how to start developing for TYPO3.

Development environments
------------------------

-  Get a PHP development environment

   -  `PHPStorm <http://www.jetbrains.com/phpstorm/>`__
   -  `Eclipse IDE <http://www.eclipse.org>`__ and `PDT (Eclipse PHP
      Development Tools) <http://www.eclipse.org/pdt/>`__
   -  `PHPEclipse <http://www.phpeclipse.com/>`__ [not available
      anymore]
   -  `PHPEdit <http://www.phpedit.com/>`__
   -  `NetBeans IDE <http://netbeans.org/>`__
   -  `Kate Editor <https://kate-editor.org/>`__

Database development
--------------------

-  Use a tool like `fabFORCE
   DBDesigner4 <http://sourceforge.net/projects/dbdesigner4/>`__ or
   `MySQL
   Workbench <http://dev.mysql.com/downloads/workbench/5.0.html>`__ to
   draw your database tables and the relationships among them.

Documentation
-------------

-  Read the `TYPO3 API
   Documentation <https://typo3.org/documentation/api>`__ [not available
   anymore].
-  `API overview <http://api.typo3.org/>`__
-  Install the
   `extdeveval <https://extensions.typo3.org/extension/extdeveval/>`__

::

or the newer (in development, requires fn_lib extension)
`t3dev <https://extensions.typo3.org/extension/t3dev/>`__. It gives you
the APIs for extensions and a link list to documentation.

-  Search in the `Namazu: Full-Text Search
   Engine <http://lists.typo3.org/cgi-bin/namazu.cgi?idxname=Typo3-english>`__.
-  Follow the `Project Coding
   Guidelines <https://docs.typo3.org/typo3cms/CodingGuidelinesReference/>`__
   [not available anymore]
-  `Extension Development, using
   Flexforms <extension-development-using-flexforms>`__
-  `Backend Programming <backend-programming>`__
-  Translate and document your extension following the `TYPO3.org -
   manual for
   developers <https://docs.typo3.org/typo3cms/extensions/doc_typo3org>`__
   (`How typo3.org
   works <https://docs.typo3.org/typo3cms/extensions/doc_typo3org/>`__)
-  Use the `Documentation template </T3Doc/Documentation_template>`__
   [deprecated wiki link] for your extension documentation
   `Documentation
   template <https://typo3.org/documentation/document-library/core-documentation/doc_template/current/>`__
   [not available anymore]

External resources
------------------

-  Read the `PHP manual <http://www.php.net/manual/en/index.php>`__.

The source code
---------------

-  Get the source code for TYPO3 core: `TYPO3 Content Management
   Framework <http://sourceforge.net/svn/?group_id=20391>`__ [not
   available anymore]
-  Get the source code for TYPO3 extensions: `TYPO3 Extension
   Development Platform <https://forge.typo3.org/projects/extensions>`__
-  Browse the source code for TYPO3 core: `TYPO3 core Git repository
   browser <https://git.typo3.org/Packages/TYPO3.CMS.git>`__
-  Browse the source code for TYPO3 extensions: `TYPO3 extension SVN
   repository
   browser <http://typo3xdev.svn.sourceforge.net/viewvc/typo3xdev/>`__
   [not available anymore]

Classes and functions
---------------------

-  ``$GLOBALS['TSFE']``, the main TypoScript front end class, can be
   found in ``typo3/sysext/cms/tslib/tslib/class.tslib_fe.php``
-  Use ``parseFunc()`` to convert text from input to disallow HTML tags
   or allow only those the from the ``allowTags`` setting.

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       if (is_array($this->conf['parseFunc.'])) {
          $markerArray['###PRODUCT_NOTE###'] = $this->cObj->parseFunc($markerArray['###PRODUCT_NOTE###'], $this->conf['parseFunc.']); 
       }

Flexforms
---------

-  If you wish to use Flexforms in your extension, follow the `Using
   Flexforms <extension-development-using-flexforms>`__ guide.

Multiple Languages
------------------

-  Create XML language files to support multiple languages. Use the
   `locallang-XML translation
   tool <https://extensions.typo3.org/extension/llxmltranslate/>`__ to
   convert php language files into XML and do some cleanings.
-  Create overlay tables which contain only the fields which need
   translations. Use the `Table
   Library <https://extensions.typo3.org/extension/table/>`__ to create
   SQL queries which hides the language overlay tables to the developer.

UNIX
----

-  Use this command line to search for a pattern in many files under
   \*nix

.. container::

   `Shell
   Script </wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

       cd directory-of-sources
       find . -name '*.php' -exec grep -ni 'your search string' {} \; -ls

It is more trickier if you want to search for ``$GLOBALS['TSFE']`` in
all PHP files:

.. container::

   `Shell
   Script </wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

       find . -name '*.php'  -exec  grep "\$GLOBALS\['TSFE'\]"  {}  \; -ls

-  Or, ``man grep`` and see if your installed grep can do something
   like:

.. container::

   `Shell
   Script </wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

       grep -rniH --include '*php' 'your search string' directory-of-sources

-  The `Linux cheat sheet <linux-cheat-sheet>`__ lists some commands for
   frequent tasks under Linux (most of these should also work under
   other flavors of Unix)

Database
--------

To access the database, use the Database Abstraction Layer.
`DBAL </Category:DBAL>`__ [deprecated wiki link]

To enable database access debug output, open
``typo3/t3lib/class.t3lib_db.php`` and change the line:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       var $debugOutput = false;

to

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       var $debugOutput = true;

To see detailed information about the created SQL, you can drop
``error_log()`` calls into the function, e.g. ``SELECTquery()``. The
following change will write all generated database statements into the
``error_log`` file:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       function debug($func) {
          error_log($this->debug_lastBuiltQuery, 0);
       }

You can also configure TYPO3 to output failed database queries to the
browser.

-  Either by using the Install Tool: In the section 'All Configuration',
   set ``[SYS][sqlDebug] = 1``
-  Or in ``typo3conf/LocalConfiguration.php`` or somewhere in the code
   of your own extensions: ``$TYPO3_CONF_VARS['SYS']['sqlDebug'] = 1;``

Global variables
----------------

Important global variables are:

-  BE_USER
-  LANG
-  BACK_PATH
-  TYPO3_CONF_VARS
-  TSFE

</php>

Use libraries and APIs
----------------------

*please add the ones you like. --*\ `Daniel
Brüßler </User:Patchworker>`__\ *[deprecated wiki link] 11:03, 4 June
2007 (CEST)*

-  `meta_feedit <https://extensions.typo3.org/extension/meta_feedit/>`__
-  `rlmp_dateselectlib <https://extensions.typo3.org/extension/rlmp_dateselectlib/>`__
   date selector, calendar javascript
-  `rgfolderselector <https://extensions.typo3.org/extension/rgfolderselector/>`__
   folder selector field for the backend
-  `div <https://extensions.typo3.org/extension/div/>`__
   Static methods for extensions. It has copies of itself as div<year>
   for each year in order to allow many versions of it at a time.

Caching issues
--------------

-  read how to manage the `cache </Category:Cache>`__ [deprecated wiki
   link] - `Caching and The Mysteries Of
   &cHash <https://typo3.org/documentation/article/the-mysteries-of-chash/>`__
   [not available anymore]
-  How to avoid the no_cache parameter? `Proper
   Caching <http://t3flyers.wordpress.com/2006/09/11/a-quick-guide-to-proper-caching-with-tslib_pibase-episode-1/>`__
   [not available anymore]

-  Generally you have to use the extension variable like
   'tx_myext_pi_name[variable]'.
-  You can also define standalone parameters e.g. for 'begin_at',
   'offset' and similars for which the cHash parameter will get created
   using these functions:

   -  ``tslib_pibase::pi_getPageLink()``
   -  ``t3lib_div::cHashParams()``
   -  ``tslib_fe::makeCacheHash()``

Blocking errors
---------------

-  If TYPO3 stops working due to your coding, just view the entries of
   the log file. (*nix: ``/var/log/messages``,
   ``/var/log/httpd/error_log``, ...) and search for the string 'PHP
   Fatal error'.

HTML output into a file
-----------------------

To debug errors, it would be useful if TYPO3 also saves the HTML output
into a file. Modify the printContent output function to save each page
into the file ``typo3.log``.

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      # typo3/alt_main.php:
       /**
       * Outputs the accumulated content to screen and into a file
       *
       * @return   void
       */
       function printContent() {
        echo $this->content;
        $handle = fopen(t3lib_div::getIndpEnv('TYPO3_DOCUMENT_ROOT').'/typo3conf/','wb');
        fwrite ($handle, $this->content);
        fclose($handle);
       }

Standards
---------

Take care of standards to make all TYPO3 extensions look very similar.
This helps that others can easier understand your extensions and find
the files in it. `Standardization </Standardization>`__ [deprecated wiki
link]. These are the current recommendations. And you are invited to
make your own proposals. All things which are needed in several
extensions should be defined by the same names. So the setup for one
extensions could be used 1:1 for another extension as well.

Send patches
------------

-  `Get your patches into TYPO3 or an
   extension <https://typo3.org/documentation/article/bugfixes-and-patches/>`__
   [not available anymore]
-  `Email template for Core
   developers <https://typo3.org/teams/core/core-mailinglist-rules/>`__
   [not available anymore]

Help
----

-  `Developer
   list <https://typo3.org/documentation/mailing-lists/dev-list-archive>`__
   [not available anymore]
