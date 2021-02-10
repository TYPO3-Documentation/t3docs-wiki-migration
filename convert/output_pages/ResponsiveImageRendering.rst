.. include:: /Includes.rst.txt

==========================
Responsive Image Rendering
==========================

With TYPO3 CMS 6.2 LTS image rendering went responsive. Here you will
find a fully functional example:

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      30 = IMAGE
      30 {
         file = fileadmin/imagefilenamename.jpg
         file.width = 100
         layoutKey = default
         layout {
            default {
               element = <img src="###SRC###"   ###PARAMS### ###ALTPARAMS### ###BORDER### ###SELFCLOSINGTAGSLASH###>
               source =
            }
            srcset {
               element = <img src="###SRC###" srcset="###SOURCECOLLECTION###" ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###>
               source = |*|###SRC### ###SRCSETCANDIDATE###,|*|###SRC### ###SRCSETCANDIDATE###
            } 
            picture {
               element = <picture>###SOURCECOLLECTION###<img src="###SRC###" ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###></picture>
               source = <source src="###SRC###" media="###MEDIAQUERY###" ###SELFCLOSINGTAGSLASH###>
            }
            data {
               element = <img src="###SRC###" ###SOURCECOLLECTION### ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###>
               source.noTrimWrap = | data-###DATAKEY###="###SRC###"|
            }
         }
         sourceCollection {
            small {
               width = 200
               srcsetCandidate = 800w
               mediaQuery = (min-device-width: 800px)
               dataKey = small
            }
            smallHires {
               if.directReturn = 1
               width = 300
               pixelDensity = 2
               srcsetCandidate = 800w 2x
               mediaQuery = (min-device-width: 800px) AND (foobar)
               dataKey = smallHires
               pictureFoo = bar
            }
         }
      }
      40 < 30
      40.layoutKey = data
      50 < 30
      50.layoutKey = picture
      60 < 30
      60.layoutKey = srcset

This results in the following HTML-Code:

::


   <html>
   <img src="fileadmin/_processed_/imagefilenamename_595cc36c48.png"      alt=""  border="0" />
   <img src="fileadmin/_processed_/imagefilenamename_595cc36c48.png" data-small="fileadmin/_processed_/imagefilenamename_595cc36c48.png" data-smallRetina="fileadmin/_processed_/imagefilenamename_42fb68d642.png"    alt="" />
   <picture><source src="fileadmin/_processed_/imagefilenamename_595cc36c48.png" media="(max-device-width: 600px)" /><source src="fileadmin/_processed_/imagefilenamename_42fb68d642.png" media="(max-device-width: 600px) AND (min-resolution: 192dpi)" /><img src="fileadmin/_processed_/imagefilenamename_595cc36c48.png"    alt="" /></picture>
   <img src="fileadmin/_processed_/imagefilenamename_595cc36c48.png" srcset="fileadmin/_processed_/imagefilenamename_595cc36c48.png 600w,fileadmin/_processed_/imagefilenamename_42fb68d642.png 600w 2x" alt="" />
   </html>
