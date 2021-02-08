.. include:: /Includes.rst.txt

============================
FLUIDTEMPLATE Content Object
============================

.. container::

   notice - Newer documentation available

   .. container::

      `TypoScript Reference:
      FLUIDTEMPLATE <https://docs.typo3.org/m/typo3/reference-typoscript/master/en-us/ContentObjects/Fluidtemplate/Index.html>`__

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

The TypoScript Content Object **FLUIDTEMPLATE** works similar to the
regular `TEMPLATE
cObject <https://docs.typo3.org/typo3cms/TyposcriptReference/ContentObjects/Template/Index.html>`__,
but instead of the marker and subpart based templates it expects Fluid
style templates.

**Note:** Currently the extensions **Fluid** and **Extbase** have to be
installed for this Content Object to work.

Usage
=====

Using this Content Object is as simple as:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      10 = FLUIDTEMPLATE
      10.file = fileadmin/templates/MyTemplate.html

With the *variables* key you are able to set values that will be
available within your Fluid template:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      10 = FLUIDTEMPLATE
      10 {
          file = fileadmin/templates/MyTemplate.html
          variables {
              foo = TEXT
              foo.value = Hello World!
          }
      }

Reference
=========

Further properties of the FLUIDTEMPLATE cObject are:

-  *layoutRootPath* - relative or absolute path to the folder that
   contains Fluid layouts
-  *partialRootPath* - relative or absolute path to the folder that
   contains Fluid partials
-  *format* - default format that will be used for links (defaults to
   **html**)

Furthermore you can specify the default plugin values that are mainly
used to search layouts/partials (if layoutRootPath/partialRootPath have
not been specified) and to resolve extension/controller in Fluid links.
Available extbase properties are:

-  *extbase.pluginName*
-  *extbase.controllerExtensionName*
-  *extbase.controllerName*
-  *extbase.controllerActionName*

**Note:** All properties of the FLUIDTEMPLATE cObject support
`stdWrap <https://docs.typo3.org/typo3cms/TyposcriptReference/Functions/Stdwrap/Index.html>`__

A fully fledged example
=======================

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      10 = FLUIDTEMPLATE
      10 {
          file = MyTemplate.html
          file.wrap = fileadmin/templates/ |
          layoutRootPath = fileadmin/templates/layouts
          partialRootPath = fileadmin/templates/partials
          format = xml
          extbase {
              pluginName = SomePlugin
              controllerExtensionName = SomeExtension
              controllerName = SomeController
              controllerActionName = someAction
          }
          variables {
              title = TEXT
              title.value = Some Title
              mainNavigation < lib.mainNavigation
          }
      }

The corresponding Fluid template (fileadmin/templates/MyTemplate.html)
could look like this:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      <f:layout name="Default" />

      <f:section name="header">
          <f:render partial="GraphicalHeader" arguments="{header: title}" />
      </f:section>
      <f:section name="body">
          <div id="mainNavigation">
              <f:format.html>{mainNavigation}</f:format.html>
          </div>
          <div id="content">
              <f:format.html>{data.bodytext}</f:format.html>
          </div>
      </f:section>

Fluid Standalone View
=====================

The FLUIDTEMPLATE content object internally uses the **Fluid Standalone
View**, which can also be used by your own code if you need to render
Fluid (f.e. to render an e-mail text), as in the following example:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $view = t3lib_div::makeInstance('Tx_Fluid_View_StandaloneView');
      $view->setTemplatePathAndFilename('foo/Bar.html');
      $view->assign('key', 'value');
      print $view->render();
