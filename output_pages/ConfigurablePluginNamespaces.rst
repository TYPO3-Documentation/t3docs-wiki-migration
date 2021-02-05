.. include:: /Includes.rst.txt
.. highlight:: php

==============================
Configurable Plugin Namespaces
==============================

This feature came in with Extbase 1.3 , included in TYPO3 4.5 LTS.

By default each Extbase plugin has a unique URI prefix to avoid
collisions with other plugins on your website. This so called plugin
namespace usually has the format *tx_<yourextension>_<yourplugin>*.

Since Extbase 1.3 it is possible to override this namespace. This comes
in handy if want to interact with 3rd party extensions, for example with
EXT:news:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      plugin.tx_myplugin.view.pluginNamespace = tx_news

This sets the plugin namespace of all your plugins inside the extension
to "tx_news", making it possible to directly access tt_news parameters
in your controller:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      /**
       * @param integer $tx_news tx_news Article uid
       * @return void
       */
      public function yourAction($tt_news) {
              // interact with $tt_news uid
      }

This even works with automatic mapping to Domain Models:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      /**
       * @param \Vendor\MyPlugin\Domain\Model\NewsArticle $news News Article
       * @return void
       */
      public function yourAction(\Vendor\MyPlugin\Domain\Model\NewsArticle $news) {
              // interact with $news object
      }

You can also override the plugin namespace for a single instance by
adding the section **<view.pluginNamespace>** to your plugin FlexForm.

If plugin.tx_$pluginSignature.view.pluginNamespace is set, this value is
returned, otherwise "tx_<extensionname>_<pluginname>".
