.. include:: /Includes.rst.txt

==================
INCLUDE TYPOSCRIPT
==================

.. container::

   **Content Type:** `HowTo </Category:HowTo>`__ [deprecated wiki link].

.. container::

   notice - Newer documentation available

   .. container::

      Since TYPO3 9, it is recommended to use @import instead of
      INCLUDE_TYPOSCRIPT. See `TYPO3 Explained » TypoScript Syntax »
      Includes <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/TypoScriptSyntax/Syntax/Includes.html>`__

Purpose
=======

With INCLUDE_TYPOSCRIPT you can include external files to

-  constants
-  setup
-  pageTS

Examples:

-  <INCLUDE_TYPOSCRIPT:
   source="FILE:fileadmin/customer-page/constants.txt">
-  <INCLUDE_TYPOSCRIPT: source="FILE:EXT:my_extension/pagets.txt">

Link-Format: no white space
===========================

There should never be a white space within the quotation marks, not even
after the word 'FILE:' Examples:

-  wrong: <INCLUDE_TYPOSCRIPT: source=
   "FILE:fileadmin/customer-page/constants.txt">
-  wrong: <INCLUDE_TYPOSCRIPT: source="
   FILE:fileadmin/customer-page/constants.txt">
-  wrong: <INCLUDE_TYPOSCRIPT: source="FILE:
   fileadmin/customer-page/constants.txt">
-  correct: <INCLUDE_TYPOSCRIPT:
   source="FILE:fileadmin/customer-page/constants.txt">

There should never be a white space or special character within the path
or name of the file. Examples:

-  wrong: <INCLUDE_TYPOSCRIPT: source="FILE:fileadmin/customer
   page/constants_1.txt">
-  wrong: <INCLUDE_TYPOSCRIPT:
   source="FILE:fileadmin/customer-page/constants 1.txt">
-  wrong: <INCLUDE_TYPOSCRIPT:
   source="FILE:fileadmin/customer-page/constants_müller_1.txt">
-  correct: <INCLUDE_TYPOSCRIPT:
   source="FILE:fileadmin/customer-page/constants-mueller-1.txt">
-  correct: <INCLUDE_TYPOSCRIPT:
   source="FILE:fileadmin/customer_page/constants_mueller_1.txt">

File-Format
===========

The files should be unicode utf-8 without BOM.

Unicode UTF-8 preferred
-----------------------

The file(s) you want to include

-  should be saved in Unicode UTF-8-format
-  may be simple ascii (7bit) without containing any special characters
   (umlauts, symbols)

Never user ANSI (MS-Windows-standard) or any ISO-formats. My experience:
if you use simple ascii and insert a single "ü" anywhere, the whole file
does not work anymore. To produce the file, use an UTF-8-capable
text-editor.

No Unicode-BOM
--------------

Most editors add a marker at the beginning of an UTF-8-file, saying
"this file is unicode". The marker is most of the times not visible, it
is called BOM. In a couple of occurrences the Unicode-BOM caused
problems for TYPO3 to recognize the file correctly. So tell your editor
not to insert it.

Line-Break
----------

It does not matter whether the line-break is <CR> or <CR><LF>.
Unix/Linux and DOS formats are OK. [Maybe somebody could add here
whether MAC-format is OK as well.]
