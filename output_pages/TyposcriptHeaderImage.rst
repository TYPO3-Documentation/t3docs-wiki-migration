.. include:: /Includes.rst.txt
.. highlight:: php

=======================
TypoScript Header Image
=======================

::

   lib.headerImageXXX = IMAGE
   lib.headerImageXXX.file {
           import =  uploads/media/
           import.field = media
           import.listNum = 0
           width.field = imagewidth
           width.wrap = |m
           height.field = imageheight
           height.wrap = |m
           treatIdAsReference = 1
       }
   }

::

   lib.headerImage = COA
   lib.headerImage {
      10 = IMAGE
      10 {
          file {
              import =  uploads/media/
              import.field = media
              import.listNum = 0
              width.field = imagewidth
              width.wrap = |m
              height.field = imageheight
              height.wrap = |m
              treatIdAsReference = 1
           }
       }
   }

::

   lib.headerImageSlide = COA
   lib.headerImageSlide {
      10 = IMAGE
      10 {
          file {
              import =  uploads/media/
              import.data [outdated link] = levelmedia:-1, slide
              import.listNum = 0
              width.field = imagewidth
              width.wrap = |m
              height.field = imageheight
              height.wrap = |m
              treatIdAsReference = 1
           }
       }
   }

::

   lib.headerImageText = COA
   lib.headerImageText {
     10 = IMG_RESOURCE
     10.file.import {
       cObject = TEXT
       cObject.value = dummy.gif
       cObject.override {
         required = 1
         data [outdated link] = levelmedia: -1, slide
         wrap = uploads/media/|
         listNum = 0
       }
     }
   }
   lib.headerImageText.wrap = <br>Text<br><img src=" | ">

::

   lib.headerImageGifBuilder = IMAGE
   lib.headerImageGifBuilder.file = GIFBUILDER
   lib.headerImageGifBuilder.file {
           XY = [10.w] , [10.h]
           10 = IMAGE
           10.file.import = uploads/media/
           10.file.import.data = levelmedia:1, slide
           10.file.import.listNum = 0     
   }

::

   lib.headerImageCOA = COA
   lib.headerImageCOA {
          10 = IMAGE
          10.file = GIFBUILDER
          10.file {
                      XY = [10.w],[10.h]
                      10 = IMAGE
                      10.file.import = uploads/media/
                      10.file.import.data = levelmedia:1, slide
                      10.file.import.listNum = 0
              }
          }
    }

::

   lib.headerImageBeginner = IMAGE
   lib.headerImageBeginner.file = GIFBUILDER
   lib.headerImageBeginner.file {
      XY = [10.w],[10.h]
      quality = 100
      10 = IMAGE
      10.file.import {
        cObject = TEXT
        cObject.value = dummy.gif 
        cObject.override {
          required = 1
          data = levelmedia: -1, slide
          wrap = uploads/media/|
          listNum = 0 
        }
      10.file.width = [10.w]
      10.offset = 0,0
     }
    }
   }

::

   page = PAGE
   page.1 < lib.headerImageXXX 
   page.1.wrap = <br>XXX<br>|
   page.5 < lib.headerImage
   page.5.wrap = <br>Standard<br>|
   page.10 < lib.headerImageSlide
   page.10.wrap = <br>Slide<br>|
   page.20 < lib.headerImageText
   page.25 < lib.headerImageGifBuilder
   page.25.wrap = <br>Gifbuilder<br>|
   page.30 < lib.headerImageCOA
   page.30.wrap = <br>COA<br>|
   page.35 < lib.headerImageBeginner
   page.35.wrap = <br>Beginner<br>|
