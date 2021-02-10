.. include:: /Includes.rst.txt

========
Pagetree
========

.. container::

   This page belongs to the `Core Team <core-team>`__ (category `Core
   Team <https://wiki.typo3.org/Category:Core_Team>`__ [deprecated wiki
   link])

General
=======

In 4.5 we integrated a new page tree based on Ext JS with enhanced
features like drag and drop, inline editing, an improved context menu
and a lot more. The tree was implemented as a `Navigation
Component <https://wiki.typo3.org/wiki/index.php?title=TYPO3Viewport&action=edit&redlink=1>`__
[not available anymore].

Available Options
=================

The following options are available for the new page tree:

-  options.alertPopups

   -  this option is still respected

-  options.pageTree.showPathAboveMounts

   -  [Boolean] Shows the user db mount path above the mount itself
      (useful if you work a lot with user db mounts)

-  options.pageTree.showPageIdWithTitle

   -  [Boolean] Shows the page id as a prefix of the title

-  options.pageTree.showNavTitle

   -  [Boolean] Shows the navigation title instead of the title if
      available

-  options.pageTree.disableIconLinkToContextmenu

   -  [Boolean] Disables the left click on an icon that opens the
      contextmenu

-  options.pageTree.hideFilter

   -  [Boolean] Disable the filter feature in the top panel

-  options.pageTree.showDomainNameWithTitle

   -  [Boolean] Shows the domain name as a suffix of the title if
      available

-  options.contextMenu.table.pages.disableItems

   -  [String] Comma-separated list of items that should be disabled
      from the contextmenu
      (view,disable,enable,edit,info,history,new,cut,copy,pasteInto,pasteAfter,delete,mountAsTreeroot,expandBranch,collapseBranch)

-  options.pageTree.doktypesToShowInNewPageDragArea

   -  [String] Comma-separated list of doktype id's that should be added
      the new node top panel feature (defaults to
      "1,6,4,7,3,254,255,199")

-  options.pageTree.backgroundColor.<pid> = <color>

   -  [Array] List of pages with a dedicated color for permanent
      highlighting in the tree (e.g.
      options.pageTree.backgroundColor.10675 = rgba(255, 0, 0, 0.1))
   -  Available since TYPO3 6.0

Also you can define a global PHP configuration setting to define a
preload limit of nodes for the tree. An huge value will improve the
responsiveness of the tree, but also increases the amounts of executed
queries.

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_CONF_VARS']['BE']['pageTree']['preloadLimit']

Furthermore it's possible to change the maximum title length that is
displayed in the tree. Either by changing the value inside your user
setup or by defining it for all users at once as default or override
value. The latter option must be written into the user/group typoscript.

**Example:**

::

   setup.default.titleLen = 132

How to use the tree JavaScript files in your components
=======================================================

If you want to use the JavaScript files for your own navigation
component, I need to disappoint you: the files were not cleaned up to be
available for general usage. This task needs some bigger cleanups and
modifications to the current code base and will be done for 4.6. The
main goal for 4.5 was to stabilize the page tree.

`24672: TYPO3 Core - Refactor the pagetree javascript files to be usable
by other trees [Rejected] <https://forge.typo3.org/issues/24672>`__

Context menu
============

The implementation of the context menu was completely changed with the
rewrite of the page tree to be easier configurable and more flexible. As
a consequence you will need to rewrite your current context menu actions
to fit the new way. A demo extension can be found attached to the the
following ticket.

`24753: TYPO3 Core - ClickMenu Items from own extensions wont work
anymore [Closed] <https://forge.typo3.org/issues/24753>`__

How to add custom actions
-------------------------

Generally a context menu action just needs to have a configuration entry
in the actions TypoScript array and an extension to the actions
JavaScript object.

The following snippet demonstrates how the new action can be added to
the default user ts config:

**ext_localconf.php**

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       
      $GLOBALS['TYPO3_CONF_VARS']['BE']['defaultUserTSconfig'] .= '
          options.contextMenu {
              table.pages.items {
                  710 = ITEM
                  710 {
                      name = customAction
                      label = LLL:EXT:cmaction/locallang.xml:customAction
                      icon = ' . t3lib_div::locationHeaderUrl(t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif') . '
                      spriteIcon =
                      displayCondition =
                      callbackAction = customAction
                      customAttributes =
                  }
              }
           }
      ';

The numeric value "710" means that the action should be added after the
history action that has the numeric value "700". If there would be
another action with a value between this range, it would be shown before
your new one. The contained properties don't need to be defined all.

-  name

   -  Name of the action to be excludable (see options in this wiki
      page)

-  label

   -  Language label of the action

-  icon

   -  Image that should be shown at the left of the action

-  spriteIcon

   -  Sprite icon key that can be used to add a sprite icon instead of a
      single image

-  displayCondition

   -  Condition that is parsed and decides if the action should be shown
      for the node

-  callbackAction

   -  Javascript callback action that should be triggered after a click
      on the action in the contextmenu

-  customAttributes

   -  Typoscript array of custom attributes that can be used for your
      actions

Afterwards you need to extend the "TYPO3.Components.PageTree.Actions"
JavaScript with your defined callback action. The JavaScript file needs
to be included with the ``t3lib_pageRenderer`` singleton.

.. container::

   `JavaScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_JavaScript>`__
   [deprecated wiki link]

.. container::

   ::

      Ext.onReady(function() {
          Ext.apply(TYPO3.Components.PageTree.Actions, {
              customAction: function(node, tree) {
                  TYPO3.Cmaction.CustomAction.helloWorld(
                      node.attributes.nodeData,
                      function(response) {
                          Ext.MessageBox.alert('Custom Action', response);
                      },
                      this
                  );
              }
          });
      });

The defined callback will call an `Ext.Direct <extdirect>`__ method that
returns a specific string. The parameters for the callback function are:

-  node

   -  Tree node (node.attributes.nodeData containts lot's of information
      about the node)

-  tree

   -  Tree instance (for interactions with the tree)

-  contextItem

   -  The called context menu item (contextItem.customAttributes
      contains the defined custom attributes)

Add the following code to your ``ext_localconf.php`` to include a custom
script that is called while loading the backend. This script can include
the JavaScript file described above.

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_CONF_VARS']['typo3/backend.php']['additionalBackendItems'][] = t3lib_extMgm::extPath('cmaction', 'backend_ext.php');

**backend_ext.php**

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      if (is_object($TYPO3backend)) {
          $pageRenderer = $GLOBALS['TBE_TEMPLATE']->getPageRenderer();
          $path = t3lib_extMgm::extRelPath('cmaction');
          $pageRenderer->addJsFile($path . 'customAction.js');
      }

Have a look at the mentioned demo example how you can work with the node
in your Ext.Direct data provider. The usage of Ext.Direct is explained
on `another wiki page <extdirect>`__.

Option "displayCondition"
^^^^^^^^^^^^^^^^^^^^^^^^^

The ``displayCondition`` property has a special syntax that is similar
to a PHP ``if`` condition. You can use the logical operators ``&&`` and
``||`` to chain the conditions. For the comparison of return values in
the condition you can use the operators ``=``, ``>=`` and ``<=``. The
return values are provided by methods of the node class
``t3lib_tree_pagetree_Node``. If an array is returned, you can access an
index by using the ``|`` operator. If this sounds tricky, look at the
existing conditions in the file ``t3lib/config_default.php`` and at the
example below.

Example:

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      displayCondition = getRecord|hidden = 1 && canBeDisabledAndEnabled != 0

This condition would call the ``getRecord()`` method that returns the
complete record array of the page. The index hidden of this array is
checked if it's true and is afterwards chained with an ``&&`` ("AND")
operator to the next condition, which checks whether a node can be
disabled and enabled, and returns a boolean value. If it's true, the
condition matches. If both conditions evaluate to true, the context
action is displayed.

Predefined callback action to open a custom URL
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There exists a predefined callback action that you can use to open a
defined URL inside the content frame. It's called
"openCustomUrlInContentFrame" and needs a defined custom attribute named
"contentUrl". The keyword ###ID### is automatically replaced with the
selected page id.

**Example**

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      720 = ITEM
      720 {
          name = customAction2
          label = LLL:EXT:cmaction/locallang.xml:customAction2
          icon = ' . t3lib_div::locationHeaderUrl(t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif') . '
          spriteIcon =
          displayCondition =
          callbackAction = openCustomUrlInContentFrame
          customAttributes.contentUrl = mod.php?M=web_WorkspacesWorkspaces&id=###ID###
      }
