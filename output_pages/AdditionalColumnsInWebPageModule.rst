.. include:: /Includes.rst.txt
.. highlight:: php

=====================================
Additional columns in WEB-Page Module
=====================================

.. container::

   **Content Type:** HowTo [outdated wiki link].

.. container::

   Question:
   For which TYPO3 versions does this Wiki page apply?, Sypets
   2020-04-17

   .. container::

   *Please remove "{{Question}}" when the problem is solved. See all
   questions [outdated wiki link].*

TCA Overrides
=============

Place this code in an extension inside the file
``Configuration/TCA/Overrides/tt_content.php``:

.. container::

   ::

      $GLOBALS['TCA']['tt_content']['columns']['colPos']['config']['items'] = array(
          '3' => array('Kopfzeile', '3'),
          '2' => array('Rechts', '2'),
          '1' => array('Links', '1'),
          '0' => array('Mitte', '0'),
          '4' => array('Fusszeile', '4')
      );

`TCA Reference »
columns <https://docs.typo3.org/m/typo3/reference-tca/master/en-us/Columns/Index.html>`__

Page TSconfig
=============

In your Page TSconfig [outdated wiki link] you have to set this value:

.. container::

   ::

      mod.SHARED.colPos_list = 1,0,2,3,4

(added item no. 4)

`TSconfig Reference »
colPos_list <https://docs.typo3.org/m/typo3/reference-tsconfig/master/en-us/PageTsconfig/Mod.html#colpos-list>`__

TypoScript Setup
================

In order to use the content of that column in a page, you can use this
code in your TypoScript setup field:

.. container::

   ::

      temp.additionalcolumn = CONTENT
      temp.additionalcolumn {
          table = tt_content
          select {
              pidInList = this
              orderBy = sorting
              where = colPos = 4
              languageField = sys_language_uid
          }
      }

This will make the content from column number 4 available in
*temp.additionalcolumn*, which you can then include in the output of
your page.
