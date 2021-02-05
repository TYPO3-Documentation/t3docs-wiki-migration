.. include:: /Includes.rst.txt
.. highlight:: php

==============================
TS/CSS: Typo3 TypoScript Setup
==============================

This code initializes the page...

::

   page = PAGE
   page.typeNum = 0

This code tells Typo3 to look at our HTML Template file:
fileadmin/templates/blanknew.htm

::

   page.10 = TEMPLATE
   page.10.template = FILE
   page.10.template.file = fileadmin/templates/blanknew.htm

This code lets us drop whatever extra HTML (defined in
fileadmin/templates/footer.txt) we want into the footer area. You may
prefer to add the details of your layout via your primary template
file... but you might also consider using this principle to plug in
specific modules of code to meet your specifications.

::

   page.10.marks.FOOTER_GOES_HERE = FILE
   page.10.marks.FOOTER_GOES_HERE.file = fileadmin/templates/footer.txt

In the interest of modularity, I also set up my dynamic menu TypoScript
code as an external file.

::

   page.10.marks.MENU_GOES_HERE  = HMENU
   <INCLUDE_TYPOSCRIPT: source="FILE: fileadmin/templates/menu.txt">

The actual dynamic menu code (found in menu.txt) goes like this...

::

    # First level menu-object, textual
    page.10.marks.MENU_GOES_HERE.1 = TMENU
    page.10.marks.MENU_GOES_HERE.1 {

::

    # Level 1: Normal state properties
    NO.allWrap = <div > | </div>
    NO.stdWrap.htmlSpecialChars = 1

::

    # Level 1: Enable active state and set properties:
    ACT = 1
    ACT.stdWrap.htmlSpecialChars [outdated link] = 1
    ACT.allWrap [outdated link] = <div > | </div>

    # Level 1: Enable Spacer Menu Item (no link)
    SPC = 1
    SPC.doNotShowLink = 0
    SPC.doNotLinkIt = 1
    SPC.allWrap = <div > | </div>

    }

Additional levels of the menu can also be added, by expanding the
menu.txt file. For example, level 2 would look like this...

::


     # Second level menu-object, textual
     page.10.marks.MENU_GOES_HERE.2 = TMENU
     page.10.marks.MENU_GOES_HERE.2 {

     # Level 2: Normal state properties
     NO.allWrap = <div > | </div>
     NO.stdWrap.htmlSpecialChars = 1

     # Level 2: Enable active state and set properties:
     ACT = 1
     ACT.stdWrap.htmlSpecialChars = 1
     ACT.allWrap = <div > | </div>
    
     # Level 2: Enable Spacer Menu Item (no link)
     SPC = 1
     SPC.doNotShowLink = 0
     SPC.doNotLinkIt = 1
     SPC.allWrap = <div > | </div>
    
     }

Now we're almost there! This segment tells Typo3 where to put the
regular page content. Note: This can be done manually, by placing
tt_content -- but that approach won't render some extensions (e.g.
cmw_linklist or th_ultracards)

::

   page.10.marks.CONTENT_GOES_HERE < styles.content.get

Finally, this code will allow us to add whatever CSS we want through one
or more external stylesheets...

::

   page.includeCSS {
    file1 = fileadmin/templates/stylesheet1.css
    file11 = fileadmin/templates/stylesheet2.css
    file12 = fileadmin/templates/stylesheet3.css
   }

That's it!

Back to: Running with TypoScript and CSS [outdated wiki link]
=============================================================

Back to: My first TYPO3 site [outdated wiki link]
-------------------------------------------------
