.. include:: /Includes.rst.txt
.. highlight:: php

======
XCLASS
======

.. container::

   warning - No longer maintained

   .. container::

      This document was transferred to the official TYPO3 CMS
      documentation (new URL:
      https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Xclasses/Index.html).
      This wiki page is now obsolete and will not get any additional
      updates.

.. container::

   This page belongs to the Core Team [outdated wiki link] (category
   Core Team [outdated wiki link])

Introduction
============

XCLASSing is a mechanism in TYPO3 to extend or overwrite classes or
methods of other extensions or of core code with own code. The approach
is limited, because only one class can register as XCLASS for another
one and XCLASSes can break if the substituted code changes because of
upgrades. Still, it is sometimes the only option for a developer to
change a given functionality, if other options like hooks, signals or
the extbase dependency injection mechanisms do not work or do not exist.

.. container::

   notice - Note

   .. container::

      The XCLASS registration changed from TYPO3 CMS 4.7 to 6.0.
      XCLASSes registered in 4.7 will **not** work with 6.0 anymore and
      **must** be adapted. It is possible to support both versions.

Class instantiation in TYPO3 CMS
================================

In general every class instance in core and extensions that stick to the
usual TYPO3 coding structure is always created with the API call
\\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance()
(t3lib_div::makeInstance() before 6.0). The methods takes care of
singletons and also searches for a XCLASS registered for the class that
should be instantiated. The general idea is: If there is an XCLASS
registered for a specific class that should be instantiated, an instance
of the XCLASS is returned by makeInstance(), instead of an instance of
the original class.

Limitations
===========

-  Using XCLASSes is fragile: Neither the core, nor extensions authors
   can guarantee that XCLASSes do not break if the underlying code
   changes (for example during upgrades). Be aware that your XCLASS can
   easily break and has to be maintained and fixed if the underlying
   code changes. If possible, you should use a hook instead of an
   XCLASS. If the given code does not provide a hook for your specific
   problem, you could ask the extension author or the core to implement
   a hook.

-  XCLASSes do **not** work for static classes, static methods or final
   classes (like t3lib_div) by design

-  There can be only **one** XCLASS per base class, but an XCLASS can be
   XCLASS'ed again. Be aware that such a construct is even more fragile
   and not advised.

-  A small number of core classes is required very early during
   bootstrap before configuration and other things are loaded.
   XCLASS'ing those classes will fail if they are singletons, or might
   have funny effects.

Base class code
===============

Usually, a XCLASS should **extend** the orginial class and only
overwrite those methods that need the code change. This lowers the
change that a XCLASS breaks, if the original class is changed in a
different method. As a general goal, any XCLASS should be as
non-intrusive as possible.

Example: You want to XCLASS the FLUIDTEMPLATE content object of TYPO3
CMS 6.0, to add some functionality. In this case a 'settings' array can
be given to fluid (this feature will hopefully be implemented with 6.1).

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      namespace Enet\FxLibrary\Xclass;
      class FluidTemplateContentObject extends \TYPO3\CMS\Frontend\ContentObject\FluidTemplateContentObject {
          /**
        * Overload data set method and additionally set 'settings' array
        *
        * @param array $conf
        * @return void
        */
          protected function assignContentObjectDataAndCurrent(array $conf) {
              parent::assignContentObjectDataAndCurrent($conf);
              $this->addSettingsToView($conf);
          }

          /**
        * Add settings array to view if exists
               * @return void
        */
          protected function addSettingsToView(array $conf) {
              if (is_array($conf['settings.'])) {
                  /** @var $typoScriptService \TYPO3\CMS\Extbase\Service\TypoScriptService */
                  $typoScriptService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\TypoScriptService');
                  $settings = $typoScriptService->convertTypoScriptArrayToPlainArray($conf['settings.']);
                  $this->view->assign('settings', $settings);
              }
          }
      }

XCLASS registration since TYPO3 CMS 6.0
=======================================

Since TYPO3 CMS 6.0, XCLASS'es are registered in a TYPO3_CONF_VARS
sub-array, similar to the dependency injection mechanism in Flow. This
should be done in ext_localconf.php files of extensions. Example of the
FLUIDTEMPLATE XCLASS above:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Frontend\\ContentObject\\FluidTemplateContentObject'] = array(
          'className' => 'Enet\\FxLibrary\\Xclass\\FluidTemplateContentObject',
      );

The array key after 'Objects' is the full class name of the original
class, without leading backslash. It is technically allowed to XCLASS a
not namespaced original class with a namespaced class and vice versa.
So, both the key after 'Objects' and the value of 'className' can be
namespaced or non namespaced classes.

If the class file location of the XCLASS class sticks to the convention,
no additional ext_autoload.php entry is needed to make the system find
the class. Example: The above class should be located at
'Classes/Xclass/FluidTemplateContentObject.php' of extension
'fx_library'.

.. container::

   notice - Note

   .. container::

      It is possible to XCLASS an XCLASS again, even if highly
      discouraged.

Old XCLASS registration for TYPO3 CMS 4.7 and below
===================================================

Every class that can be XCLASSed has to deliver a three line statement
at the end of the class file, after the class definition. If an
extension author forgets or does not maintain those statements,
XCLASSing will not work. Example from t3lib/class.t3lib_userauth.php:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['t3lib/class.t3lib_userauth.php'])) {
          include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['t3lib/class.t3lib_userauth.php']);
      }

An extension can then register as XCLASS of the given class by adding a
row in "ext_localconf.php" like:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['t3lib/class.t3lib_userauth.php'] = t3lib_extMgm::extPath('my_extension') . "path-to-xclass-file";

The class name located in 'path-to-xclass-file' must be identical to the
orginial class, except that it must be prefixed with 'ux_':

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      class ux_t3lib_userauth extends t3lib_userauth {
      ...
      }

.. container::

   notice - Note

   .. container::

      If an extension can deliver the same XCLASS code for 6.0 and 4.7,
      the code should be located in the new namespaced class name, and
      the 'ux_' compatiblity class should just extend as empty class
      from the name spaced version. This might work to TYPO3 versions
      down to 4.5, if PHP 5.3 is used.

See also
========

Class auto loader documentation [outdated wiki link]

Name space documentation [outdated link]

`TYPO3 Core API, Chapter "PHP Class
Extension" <https://docs.typo3.org/typo3cms/CoreApiReference/>`__
