.. include:: /Includes.rst.txt

===============
Accessible menu
===============

.. container::

   **Content Type:** `HowTo <https://wiki.typo3.org/Category:HowTo>`__
   [deprecated wiki link].

.. container::

   notice - This information is outdated

   .. container::

Article about Accessible menus on typo3.org
===========================================

-  https://typo3.org/documentation/article/accessible-menus/ [not
   available anymore]

Accessible menu as an un/ordered list in XHTML
==============================================

This entry is from the online documentation MTB/1 on typo3.org chapter
1.3.6 Creating the menu:

::

   Date: 07-04-2004 03:41 by xlerb
   Menu as unordered list

   Though the sample menu might be designed cleverly to be easily formatted with CSS
   it is not the best design when it comes to accessibility. Try and view the sample page
   without the stylesheet to get a feeling for what a blind person will get
   (from a screen reader): the tree structure of the site/menu is lost, because 
   every menu entry is a similar DIV, different only in the CSS class, but shown
   identical without styling.

   A better aproach is formatting the menu as an un/ordered list in XHTML,
   thus revealing the structure of the site even without any stylesheet.
   See sample code below.

   Code Listing:

   # Construct the main menu as a nested unordered list.
   # It has level1 and level2 entries.
   # All formatting will be done via CSS.
   temp.menu1 = COA
   temp.menu1 {
       # the menu object itself, starting off the site root
     10 = HMENU
     10.entryLevel = 0


       # Level1 entries are simple text menu entries,
       # (formatted via CSS to run down the left side of the page)
     10.1 = TMENU
     10.1 {
         # Don't really like unneccessary scripting.
       noBlur = 1
         # Current item should be unlinked and formatted differently.
       CUR = 1
         # Active items above current item should be formatted differently.
       ACTIFSUB = 1
     }

       # Base formatting of menu entries as list items.
     10.1.NO {
       wrapItemAndSub = <li >|</li>
       ATagParams =
     }

       # Current menu item is unlinked and marked
     10.1.CUR {
       wrapItemAndSub = <li >|</li>
       doNotLinkIt = 1
     }

       # Active items above current to be formatted differently
     10.1.ACTIFSUB {
       wrapItemAndSub = <li >|</li>
     }

       # Wrap the level1 menu inside an unordered list
     10.1.wrap = <ul >|</ul>


       # Level2 entries are simple text menu entries also,
       # (formatted very differently via CSS to run left to right
       # across the page under the header, so you only see the styling
       # classes here.)
     10.2 = TMENU
     10.2 {
       noBlur = 1
       CUR = 1
       ACTIFSUB = 1
     }

       # Same formatting of menu entries as list items.
     10.2.NO {
       wrapItemAndSub = <li >|</li>
       ATagParams =
     }

       # Current menu item is unlinked and marked too
     10.2.CUR {
       wrapItemAndSub = <li >|</li>
       doNotLinkIt = 1
     }

       # Active items above current to be formatted differently as for level1
     10.2.ACTIFSUB {
       wrapItemAndSub = <li >|</li>
     }

       # Wrap the level2 menu inside an unordered list
     10.2.wrap = <ul >|</ul>
   }
