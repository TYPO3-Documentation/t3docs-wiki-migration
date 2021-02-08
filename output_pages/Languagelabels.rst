.. include:: /Includes.rst.txt

==============
LanguageLabels
==============

Label naming conventions
========================

Language Labels in TYPO3 start with LLL: and are used to get text
snippets inside PHP/TS code, without hardcoding them. This enables
translations to other languages. The texts are saved in XML files and
eacht text snippet is identified by it's label there.

-  label should have one prefix and one identifier, separated by a dot.
   E.g. page.deleteButton, page.deleteReally, page.deleteSuccessful

-  all parts have to use studlyCaps

-  select your prefix to group all labels of one functionality together

-  do not use prefixes like "button", "headline" and so one, use
   "page.deleteButtonCancel" instead

-  start your identifier with the subfunction prefixed, if applicable

-  use one file per module, if your labels are specific to this module

-  place your labels in EXT:lang/locallang_misc.php, if they are general
   and could be used in other places, too

-  be explicit, e.g. use "delete" instead of "rm"

Debugging
=========

You may adjust TYPO3's configuration to show language label paths in the
backend.

TYPO3 7 and lower:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $TYPO3_CONF_VARS['BE']['lang']['debug'] = true;

`TYPO3
8.7 <https://docs.typo3.org/typo3cms/extensions/core/Changelog/8.7/Important-71095-AddLanguageDebugModeToAllConfiguration.html>`__
and higher:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $TYPO3_CONF_VARS['BE']['languageDebug'] = true;

Text improvement
================

Please reference texts of TYPO3 Backend here, which have to be improved
(only english texts!).

+-------------+-------------+-------------+-------------+-------------+
| Where       | Old         | New         | Concerns    | LLL         |
+-------------+-------------+-------------+-------------+-------------+
| Page        | | Web>Page  |             | -  explain, | LLL:EXT     |
| module,     |   module    |             |    what the | :cms/layout |
| when no     | | Please    |             |    page     | /locallang. |
| page is     |   click the |             |    module   | xlf:clickAP |
| selected,   |   page      |             |    does     | age_content |
| yet         |   title in  |             |             |             |
|             |   the page  |             | -  be more  |             |
|             |   tree to   |             |    explcit  |             |
|             |   the left  |             |             |             |
|             |   to edit   |             | -  this is  |             |
|             |   page      |             |    the 2nd  |             |
|             |   content.  |             |    page,    |             |
|             |             |             |    which a  |             |
|             |             |             |    new      |             |
|             |             |             |    TYPO3    |             |
|             |             |             |    user     |             |
|             |             |             |    will     |             |
|             |             |             |    see!     |             |
+-------------+-------------+-------------+-------------+-------------+
|             |             |             |             |             |
+-------------+-------------+-------------+-------------+-------------+
