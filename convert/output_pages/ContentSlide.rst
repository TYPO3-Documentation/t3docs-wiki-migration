.. include:: /Includes.rst.txt

=============
Content Slide
=============

Content Sliding
===============

This article is about how to let a content-element "slide" through the
rootline to the actual pages (this is for standard method only... not
TV). This means that you insert a Content-Element for example in the
Right-Column of your Root-Page and it gets inherited to all subpages.

If you place another Content-Element (CE) into the right column on one
of the subpages this CE will substitute the element from the root-page
and in this part of the page tree the later CE will get shown.

Note that content does not slide through Sysfolders.

This also supports a few other nifty features like "collecting" all
elements till the rootpage and display them all together. It is also
possible to give a count value how many levels T3 will try to "slide
up". So you could for example always display the combined elements of
this and the parent page.

Property reference
------------------

See
https://docs.typo3.org/typo3cms/TyposcriptReference/ContentObjects/Content/Index.html.

Examples
--------

Example 1
^^^^^^^^^

This first example simply enables content-sliding for the right-column
wherever you use it:

::

   styles.content.getRight.slide = -1

The second example enable also collecting of elements.

::

   styles.content.getRight.slide = -1
   styles.content.getRight.slide {
     collect = -1
     # collectReverse = 1
   }

This example collects only the current and the parent page.

::

   styles.content.getRight.slide = -1
   styles.content.getRight.slide {
     collect = 2
     # collectReverse = 1
   }

If you want more example or have a special requirement write a mail to
me: kraftb@kraftb.at

--------------

`Bernhard
Kraft <https://wiki.typo3.org/wiki/index.php?title=User:Oldkraftb&action=edit&redlink=1>`__
[not available anymore] 14:30, 22 Mar 2006 (CET) [www.think-open.at]

Example 2
^^^^^^^^^

The above examples were too confusing for me. This helped to understand
it:

::

     sidebar < styles.content.getRight
     sidebar.slide = -1

(In Typo3 4.2 is this seemingly the only working Syntax.)

--------------

`Szabolcs
Feczak <https://wiki.typo3.org/wiki/index.php?title=User:OldFeczo&action=edit&redlink=1>`__
[deprecated wiki link] 13:30, 08 August 2007 (AU/Sydney)

| 
| ...the Manual:
  https://docs.typo3.org/typo3cms/extensions/kb_tv_cont_slide/
