.. include:: /Includes.rst.txt

.. _css-html-template:

=====================
TS/CSS: HTML Template
=====================

The HTML file can be this simple. It can be simpler... or it can be much
more complex. That's up to you. This example will look to TypoScript to
substitute a dynamic menu, footer content, and (of course) Typo3
Content...

::


   <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
   <HTML>
   <BODY>

   <DIV id=page>
       ###CONTENT_GOES_HERE###

       <DIV id=footer>
           ###FOOTER_GOES_HERE###
       </DIV>

   </DIV>

   <DIV id=menu>
      ###MENU_GOES_HERE###
   </DIV>

   </BODY>
   </HTML>

NEXT: `TS/CSS: Typo3 Template Setup <css-typo3-template-setup>`__
=================================================================

Back to: `Running with TypoScript and CSS <running-with-typoscript-and-css>`__
------------------------------------------------------------------------------

Back to: `My first TYPO3 site <my-first-typo3-site>`__
------------------------------------------------------
