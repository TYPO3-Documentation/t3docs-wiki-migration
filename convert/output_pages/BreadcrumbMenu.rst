.. include:: /Includes.rst.txt

===============
Breadcrumb menu
===============

.. container::

   **Content Type:** `HowTo <https://wiki.typo3.org/Category:HowTo>`__
   [deprecated wiki link].

Breadcrumb menu - Assign different page data to a breadcrumb menu
=================================================================

Breadcrumb menu can show other page data than main menu

::

   lib.breadcrumb=COA
   lib.breadcrumb {
   10 = HMENU
   10 {
    special = rootline
    special.range = 0|-1
    # "not in menu pages" should show up in the breadcrumbs menu
    includeNotInMenu = 1
    1 = TMENU
        # no unneccessary scripting.
        1.noBlur = 1
        # Current item should be unlinked
        1.CUR = 1
        1.target = _self
        1.wrap = <div > | </div>
        1.NO {
            stdWrap [not available anymore].field = title
            ATagTitle.field = nav_title // title
            linkWrap = ||*|  > |*|
            }
        # Current menu item is unlinked
        1.CUR {
            stdWrap.field = title
            linkWrap = ||*|  > |*|
            doNotLinkIt = 1
            }
       }
   }
