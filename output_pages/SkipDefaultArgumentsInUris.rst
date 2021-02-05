.. include:: /Includes.rst.txt
.. highlight:: php

==============================
Skip default arguments in URIs
==============================

.. container::

   notice - Newer documentation available

   .. container::

      `Extbase Reference > Registration of Frontend
      Plugins <https://docs.typo3.org/m/typo3/book-extbasefluid/master/en-us/b-ExtbaseReference/Index.html#features>`__

| This feature is part of Extbase 1.4, that will be included in TYPO3
  4.6

From version 1.4 on you can configure Extbase to skip the URI arguments
for controller and action if they are equal to the respective default in
the target plugin.

**NOTE:** This only works reliably, if you do not modify the default
controller / actions of a plugin via FlexForms!

| You can enable the feature with following TypoScript configuration:

::

      plugin.tx_yourextension {
         features {
            skipDefaultArguments = 1
         }
      }

You can enable the feature globally, but make sure that all installed
Extbase extensions are compatible with that setting:

::

      config.tx_extbase {
         features {
           skipDefaultArguments = 1
         }
      }
