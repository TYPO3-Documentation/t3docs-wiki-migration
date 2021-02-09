.. include:: /Includes.rst.txt

=======
Cooluri
=======

.. container::

   **Content Type:** `Extension
   Documentation <https://wiki.typo3.org/Category:ExtensionDocumentation>`__
   [deprecated wiki link] (find more extensions in the `Extension
   Repository <https://extensions.typo3.org/extension/%7B%7B%7Bterkey%7D%7D%7D>`__
   [not available anymore])
   Using the Wiki for extension documentation is no longer recommended.
   You should add the documentation in the git repository of your
   extension and render it on docs.typo3.org or on the Git hoster, e.g.
   GitHub, see `How to document an
   extension <https://docs.typo3.org/m/typo3/docs-how-to-document/master/en-us/WritingDocForExtension/Index.html>`__
   and `Publish your
   extension <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ExtensionArchitecture/PublishExtension/Index.html>`__.

.. container::

   +-----------------------------------+-----------------------------------+
   | **Extension detail information**  |                                   |
   | `CoolURI <https://extensions      |                                   |
   | .typo3.org/extension/CoolURI/>`__ |                                   |
   +-----------------------------------+-----------------------------------+
   |                                   | This extension will offer you     |
   |                                   | nicer URLs.                       |
   +-----------------------------------+-----------------------------------+
   | **documentation state**           | `needs a                          |
   |                                   | review                            |
   |                                   | <https://wiki.typo3.org/Category: |
   |                                   | Needs_a_review>`__\ **[deprecated |
   |                                   | wiki link]** |document state      |
   |                                   | list|                             |
   |                                   | `licence                          |
   |                                   | OCL <http:/                       |
   |                                   | /www.opencontent.org/openpub/>`__ |
   +-----------------------------------+-----------------------------------+
   | **forgeproject**                  |                                   |
   +-----------------------------------+-----------------------------------+
   | **mailinglist**                   |                                   |
   +-----------------------------------+-----------------------------------+
   | usergroups                        | |list of usergroups| forAdmins,   |
   |                                   | forIntermediates                  |
   +-----------------------------------+-----------------------------------+
   | author(s)                         | Jan Bednarik                      |
   +-----------------------------------+-----------------------------------+
   | TER category                      | fe                                |
   +-----------------------------------+-----------------------------------+
   | dependency                        | NONE                              |
   +-----------------------------------+-----------------------------------+

<< Back to `Extension
manuals <https://wiki.typo3.org/Overview_Extension_manuals>`__
[deprecated wiki link] page

`[edit] <https://wiki.typo3.org/wiki/index.php?title=Cooluri&action=edit&section=0>`__
[deprecated wiki link]

.. container::

   notice - Open Content License

   .. container::

      This document is published under the `Open Content
      License <http://www.opencontent.org/openpub/>`__
      The content is related to TYPO3 - a GNU/GPL CMS/Framework
      available from `typo3.org <http://typo3.org>`__

Introduction
============

The CoolURI extension is for getting nicer URLs within your TYPO3
installation.

What does it do?
----------------

It will transform all parameters and options to your favorite directory
names.

Users manual
============

For the users manual please have a look at the extension page for
`cooluri <https://extensions.typo3.org/extension/cooluri/>`__.

Installation
============

TYPO3 Extension
---------------

#. First open the Extension Manager at the Admin tools section of TYPO3.
#. Import `cooluri <https://extensions.typo3.org/extension/cooluri/>`__
   extension online from repository or via upluad from a local filebase.
#. Afterwards install the extension.
#. Now `cooluri <https://extensions.typo3.org/extension/cooluri/>`__
   should be listed as a 'loaded' extension.
#. Furthermore your typo3conf/LocalConfiguration.php of TYPO3 should
   contain
   ``$TYPO3_CONF_VARS['EXT']['extListArray'] = '... ... ... cooluri'``
#. ``cd typo3conf/ext/cooluri/cooluri/``
#. ``cp CoolUriConf.xml_default CoolUriConf.xml``

.htaccess
---------

#. Go to your TYPO3 installation directory
#. cp \_.htaccess .htaccess

-  If you want to get access to some special directories (e.g.
   my_special) outside your TYPO3 CMS but within this path you must
   adjust the .htaccess like the following:

::

   vi .htaccess
   ###RewriteRule ^(typo3|t3lib|tslib|fileadmin|typo3conf|typo3temp|uploads|showpic\.php|favicon\.ico)/ - [L]
   RewriteRule ^('''my_special'''|typo3|t3lib|tslib|fileadmin|typo3conf|typo3temp|uploads|showpic\.php|favicon\.ico)/ - [L]

your URLs
---------

-  Extend your root-TypoScript

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      page.config.simulateStaticDocuments = 0
      page.config.tx_cooluri_enable = 1
      # my_basedomain
      page.config.baseURL = http://my_basedomain/
      # optional: redirect old links to the new once
      page.config.redirectOldLinksToNew = 1

#. Clear all caches of TYPO3
#. Go to Admin tools / CoolURI
#. Select 'Delete/Update all'
#. Delete everythink and start again
#. Now start testing and look afterwards at 'Cached links' which should
   contain a transformation matrix now.

FAQ
===

Subdirectory
------------

-  If your TYPO3 installation is in a **subdirectory** of the webserver
   and NOT in the root directory you must do the following additional
   task:

#. Edit first your root-TypoScript and change

   .. container::

      `TS
      TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
      [deprecated wiki link]

   .. container::

      ::

         page.config.baseURL = http://my_basedomain/my_subdirectory/typo3/

#. Go to 'Admin tools / CoolURI / New link'
#. Enter URI like: ``my_subdirectory/typo3/``
#. Enter Parameters like: ``id=1``
#. Mark 'Sticky (won't be updated)' as selected
#. Save new URI
#. Got to 'Cached links' and check if ``my_subdirectory/typo3/ id=1`` is
   listed
#. Now accessing your TYPO3 frontend (e.g.
   http://my_basedomain/my_subdirectory/typo3/ [not available anymore])
   without adding 'index.php' should work.

Hide pathsegments
-----------------

-  Hide some pathsegments of your template TYPO3 tree.

#. Go to Template
#. Select the entry to hide
#. Edit page properties
#. If Type is not 'Standard' select it temporary
#. Now you can mark ``Exclude this page from middle of a page path``
#. If necessary change your template type back to the original setting
#. I don't know why this entry is not visible at a 'Shortcut' type!?!
#. Clear cache
#. Delete CoolURI data and start again

.. |document state list| image:: files/Info.gif
   :target: /Template:Extension
.. |list of usergroups| image:: files/Usergroups.gif
   :target: /File:Usergroups.gif
