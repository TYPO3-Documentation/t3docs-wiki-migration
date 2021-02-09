.. include:: /Includes.rst.txt

===================
Alt text for images
===================

.. container::

   **Content Type:** `HowTo <https://wiki.typo3.org/Category:HowTo>`__
   [deprecated wiki link].

.. _alt-text-for-images-1:

Alt text for images
===================

Providing alt texts for images - simple (one image only) - TEXT and
IMGTEXT

.. container::

   ::

      tt_content.image.20.1.alttext.field = imagecaption
      tt_content.textpic.20.1 < tt_content.image.20.1

Providing alt text for images - advanced (more images) - TEXT and
IMGTEXT

::

   tt_content.image.20.1.alttext.cObject = TEXT
   tt_content.image.20.1.alttext.cObject {
       field = imagecaption
       listNum = 0
       listNum.splitChar = 10
       override.cObject = TEXT
       override.cObject {
           listNum.stdWrap.data = register:IMAGE_NUM
           listNum.splitChar = 10
           }
       trim = 1
       }
   tt_content.textpic.20.1 < tt_content.image.20.1
