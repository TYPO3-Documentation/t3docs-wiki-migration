.. include:: /Includes.rst.txt

============
Rte htmlarea
============

.. container::

   **Content Type:** `Extension Note </Category:ExtensionNote>`__
   [deprecated wiki link] for the extension htmlArea RTE (rtehtmlarea).
   It is a list of tips indented to supplement the documentation. For
   more information about the extension, see the `extension home
   page <https://extensions.typo3.org/extension/rtehtmlarea>`__

.. container::

   notice - Newer documentation available

   .. container::

      Since TYPO3 8, the system extension
      `rte_ckeditor <https://docs.typo3.org/c/typo3/cms-rte-ckeditor/master/en-us/>`__
      was introduced in the core, replacing the functionality of
      rtehtmlarea

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript.
      `info </Help:Contents#Teamwork_-_draft_review_publish_delete_merge_outdated>`__
      [deprecated wiki link]

========================================
Information about RTE (Rich Text Editor)
========================================

Installation
============

========
TSConfig
========

Configuration
=============

Configure the shown buttons of the RTE in the page's TSConfig (e.g. root
page of your site). Some examples:

*The following TS Config has been tested with Typo3 4.5.0.*

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      # do not convert <br> tags to paragraph <p> tags
      RTE.default.proc.dontConvBRtoParagraph=1

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      # disable right click in RTE (only for tt_content.bodytext field - e.g. for using the browsers context menu)
      RTE.config.tt_content.bodytext.disableRightClick=1

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      # enable only the wanted buttons in the RTE
      RTE.default.showButtons = left, justifyfull, center, right, link, bold, italic, strikethrough, superscript, outdent, indent, pastetoggle, orderedlist, unorderedlist, insertcharacter, removeformat, image, chMode

Linked CSS
----------
