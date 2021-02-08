.. include:: /Includes.rst.txt

.. _viewhelper:

==================
Extbase/ViewHelper
==================

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

.. container::

   notice - Newer documentation available

   .. container::

      `Extbase / Fluid book » Developing a custom
      ViewHelper <https://docs.typo3.org/m/typo3/book-extbasefluid/master/en-us/8-Fluid/8-developing-a-custom-viewhelper.html>`__

How to create a Fluid Viewhelper.

Class
=====

Create the following file:

::

   myExt/Classes/ViewHelpers/LinkViewHelper.php

In this example we do create a simple ViewHelper for rendering the link
wizard in fluid.

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      namespace Vendor\Myext\ViewHelpers;
      /**
       * Copyright notice
       * [...]
       */

      use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

      /**
       * Class LinkViewHelper
       *
       * @package Vendor\Myext\ViewHelpers
       */
      class LinkViewHelper extends AbstractViewHelper {

          /**
        * @param string $url
        * @return string
        */
          public function render($url) {

              /** @var $contentObject \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer */
              $contentObject = $GLOBALS['TSFE']->cObj;

              return $contentObject->getTypoLink_URL($url);

          }

      }

Use in fluid
============

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      {namespace myhelper=Vendor\Myext\ViewHelpers}

      // Used "h-r-e-f" instead "href" since the typo3 wiki doesn't accepts <a> tags for reasons of safety
      <a h-r-e-f="{myhelper:link(url: '{linkUrlFromTCA}')}">Testlink</a>
