.. include:: /Includes.rst.txt
.. highlight:: php

===========================
Page Header with Gifbuilder
===========================

.. container::

   **Content Type:** FAQ [outdated wiki link].

Page Header with Gifbuilder - Page Header with Gifbuilder (Text from Subtitle, Picture from File)
=================================================================================================

Function in /var/www/website/typo3conf/localconf.php for single spaced/double spaced output
-------------------------------------------------------------------------------------------

Use of \| for double spaced output. E.g. Subtitle of advanced page type:
"This is the double spaced \| header text"

::

   function user_headerchecksubtitle () {
           global $TSFE;
             foreach ($TSFE->rootLine as $page) { #if the page has no subtitle, check for subtitle in rootline
               if ($page["subtitle"]<>"") {
                   if (strchr($page["subtitle"],'|')) { #check for | in subtitle
                      return true;
                   } else {
                      return false;
                   }
               }
             }
   }

Setup Typoscript Template configuration GifBuilder depending on single spaced/double spaced subtitle
----------------------------------------------------------------------------------------------------

::

   # Configuration Page Header
   [userFunc = user_headerchecksubtitle()]
   lib.header = COA
   lib.header {
   10 = IMAGE
   10.alttext.data = page:subtitle // page:title
   10.file = GIFBUILDER
   10.file {
     XY = 605,60
     format = jpeg
     quality = 100
     10 = IMAGE
   # define in constants of ts template the path to a default picture. E.g. fileadmin/main/image/defaultheader.jpg
     10.file = {$pageheaderdefaultimage}
     10.file.import.data = levelfield :-1, media, slide
     10.file.import = uploads/media/
     10.file.import.listNum = 0
     10.file.import.override.field = media 
     10.offset = 0,0
     20 = TEXT
     20.text.data = levelfield :-1, subtitle, slide
     20.fontFile =  fileadmin/main/fonts/UNIVERB.TTF
     20.fontSize = 32
     20.text.listNum=0
     20.text.listNum.splitChar = |
     20.offset = -10,25
     20.fontColor = #FFFFFF
     20.align = right
     20.niceText = 1
     20.antiAlias = 1
     20.shadow {
           color = black
           offset = 2,3
           blur = 50
           opacity = 50
           intensiy = 80
           }
     20.outline {
           thickness =  1,0
           color = black
           }
     30 < lib.header.10.file.20
     30.text.listNum=1
     30.offset = -10,51
     }
   # additional HTML Header (not visible with CSS)
   20 = TEXT
   20.data = page:subtitle // page:title 
   20.wrap = <h1 >|</h1>
   }
   [else]
   lib.header = COA
   lib.header {
   10 = IMAGE
   10.alttext.data = page:subtitle // page:title 
   10.file = GIFBUILDER
   10.file {
     XY = 605,60
     format = jpeg
     quality = 100
     10 = IMAGE
   # define in constants of ts template the path to a default picture. E.g. fileadmin/main/image/defaultheader.jpg
     10.file = {$pageheaderdefaultimage} 
     10.file.import.data = levelfield :-1, media, slide
     10.file.import = uploads/media/
     10.file.import.listNum = 0
     10.file.import.override.field = media 
     10.offset = 0,0
     20 = TEXT
     20.text.data = levelfield :-1, subtitle, slide
     20.fontFile =  fileadmin/main/fonts/UNIVERB.TTF
     20.fontSize = 36
     20.fontColor = #FFFFFF
     20.align = right
     20.offset = -10,43
     20.niceText = 1
     20.antiAlias = 1
     20.shadow {
           color = black
           offset = 2,3
           blur = 50
           opacity = 50
           intensiy = 80
           }
     20.outline {
           thickness =  1,0
           color = black
           }

     }
   # additional HTML Header (not visible with CSS)
   20 = TEXT
   20.data = page:subtitle // page:title 
   20.wrap = <h1 >|</h1>
   }
   [global]

Load your header picture with the option "Files:" of the advanced page
typ
