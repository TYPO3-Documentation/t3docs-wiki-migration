.. include:: /Includes.rst.txt

==========
GIFBUILDER
==========

Masking semi-transparent images (Logos) onto other images
=========================================================

You can use the GIFBUILDER to overlay an image with another image using
a transparency mask. You probably know PNG24. This file format supports
an "alpha" channel (matte called in ImageMagick) which is another
channel besides RGB and defines "how transparent" each pixel is.

The GDLib (even version 2) currently doesn't support it properly to
overlay such an image over another one. The results are not very nice.
But there is the possibility to use ImageMagick for this task.

In TYPO3 this is not done with a single image containing RGB and alpha
channel to overlay but rather two separate images: The RGB image itself
(overlay image) and 8-bit grayscale image defining the alpha-channel
(Mask image).

To generate such an overlayed image with the GIFBUILDER you have to use
code like the following:

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

        lib.test = IMAGE
        lib.test {
          file = GIFBUILDER
          file {
              XY = 1024,768
              format = jpg
              quality = 88
              10 = IMAGE
              10.file = fileadmin/backimage.jpg
        
              15 = IMAGE
              15.offset = 420,18
              15.file = fileadmin/overlay.png
              15.mask = fileadmin/mask.png
        #      15.mask = fileadmin/mask_i.png
          }
        }

You will need a background image. Here "backimage.jpg". For example:

|A Background Image|

Then you will need an image to overlay over the original. It should have
no alpha channel. The background doesn't care when it gets masked away
by the mask.

|A overlay image|

And as last thing you will need the transparency mask. It depends on
your Image Magick version and setting wether the black or the white
areas will be completely transparent or not. Here is an example of an
image mask and inversion of it:

|A normal mask|

And here the inversed:

|Description|

The resulting masked image will look like:

|image1|

You can create the mask from a colored file using the ImageMagick
command "-colorspace GRAY". You can negate it by adding the command
"-negate". But this tasks can also be done with every better image
manipulation tool (Gimp i.e.).

How to create a mask from an Alpha-Layer PNG
============================================

If your designer supplies you with a Photoshop file with transparency
mask (or a PNG) you will have to extract the alpha channel information
out of the image. I don't know how this works in Photoshop but I can
explain the required steps for GIMP:

#. Open the alpha-layer PNG

#. Right click on Image (RCI) > Layer > Mask > Add Layer Mask: Select
   "Layer's alpha channel"

#. In the Layers Dialog you see a little black/white thumb next to the
   Layer's thumb now. Click on the thumb of the colored image to select
   working on the image and not on the layer mask.
#. Select everything (CTRL-A) cut everything (CTRL-K)

#. Fill the image with Black or White (only the masked regions will show
   up colored - the alpha layer mask)

#. Insert a new layer and color it opposite of the filling (black or
   white). Move the layer tothe correct position so it is below the just
   filled regions.

#. Now you should have a black white image containing the mask from the
   alpha layer.

#. You can invert the mask after you have flattened it using "Filters >
   Colors > Value Invert"

| 
| You can also use ImageMagick to separate the mask from the image.
  Tested with IM v6.

To extract the mask as greyscale 8-bit PNG, use the following command

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

        convert alphaLayerPng.png  -channel matte -separate +channel -negate png8:mask.png

To get the image without the alpha channel use the following command:

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

        convert alphaLayerPng.png  +matte image.png

.. container::

   notice - Note

   .. container::

      If you know how it works for IM 4 or 5 you are invited to add it
      here.

Creating (semi-transparent) Boxes with transparent Text
=======================================================

Using the GIFBUILDER you can also create images from photos and insert a
box which could probably be semi-transparent so the background shines
through, And insert some "transparent" letters which will let the
background image shine through into the box.

Here's an example. It is just done with an simple IMAGE cObject but
could also get used for GMENUs for example. Then you could retrieve the
background image from the media field for example.

The base image is the same as above. Below's the result - just see
yourself:

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

       lib.header = IMAGE
       lib.header {
          file = GIFBUILDER
          file {
              XY = 640,480
              format = png
       
              10 = IMAGE
              10.file = fileadmin/backimage.jpg
       
                  # Example 1, Light grey  box (#cccccc) no box transparency
                       20 = IMAGE
                       20 {
                               offset = 50,50
                               XY = [mask.W],40
                               file = GIFBUILDER
                               file {
                                       XY = 400,40
                                          # The color of the Box
                                       backColor = #cccccc
                               }
                               mask = GIFBUILDER
                               mask {
                                       XY = [10.w]+40,40
                                          # The transparency of the box:
                                          # #000000 = fully transparent like the text
                                          # #ffffff = nothing transparent at all
                                       backColor = #ffffff
                                       10 = TEXT
                                       10 {
                                               text = TYPO3 rulez !
                                                  # The transparency of the text.
                                                  # Same rules as above
                                               fontColor = #000000
                                               fontSize = 20
                                               offset = 20,30
                                               fontFile = fileadmin/ALTdragon.ttf
                                       }
                               }
                       }
                       
                          # Example 2, light green box / half transparent
                       30 = IMAGE
                       30 {
                               offset = 50,120
                               XY = [mask.W],40
                               file = GIFBUILDER
                               file {
                                       XY = 400,40
                                       backColor = #66ff66
                               }
                               mask = GIFBUILDER
                               mask {
                                       XY = [10.w]+40,40
                                       backColor = #808080
                                       10 = TEXT
                                       10 {
                                               text = TYPO3 rulez !
                                               fontColor = #000000
                                               fontSize = 20
                                               offset = 20,30
                                               fontFile = fileadmin/ALTdragon.ttf
                                       }
                               }
                       }
       
                          # Example 2, light red box / no box transparency, bold + not antialiased text
                       40 = IMAGE
                       40 {
                               offset = 50,190
                               XY = [mask.W],40
                               file = GIFBUILDER
                               file {
                                       XY = 400,40
                                       backColor = #ff6666
                               }
                               mask = GIFBUILDER
                               mask {
                                       XY = [10.w]+40,40
                                       backColor = #ffffff
                                       10 = TEXT
                                       10 {
                                               text = TYPO3 rulez !
                                               fontColor = #000000
                                               fontSize = 20
                                               offset = 20,30
                                               fontFile = fileadmin/ALTdragon.ttf
                                                  # Bold
                                               iterations = 5
                                                  # Antialiased
                                               antiAlias = 0
                                       }
                               }
                       }              
          }
       }

Creating shadows for images
===========================

You surely once have required to have some shadows around all the images
you insert as content element. This is easily possible using one of the
following two
`TypoScript <https://wiki.typo3.org/Category:TypoScript>`__ [deprecated
wiki link] variants.

Variant 1
---------

Here a background image gets used. The background image (shadow.png)
gets scaled to the width and height of the image and the image gets put
on top of it with an offset of 10,10 pixels:

Constants
^^^^^^^^^

::

   # None required

Setup
^^^^^

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

       tt_content.image.20.1.file >
       tt_content.image.20.1.file = GIFBUILDER
       tt_content.image.20.1.file {
          XY = [10.w],[10.h]
          10 = IMAGE
          10 {
              # Background image
              file.import.override = fileadmin/shadow.png
              file.maxW.field = imagewidth
          }
          # Scale background image
          15 = SCALE
          15.width = [10.w]
          # Background Image is 20 pixel higher than scaled down "real" image
          # Thus it should have "normal" height.
          15.height = [20.h]+20
          # Put real image on top of it
          20 = IMAGE
          20 {
              file.import.current = 1
              file.width.stdWrap = 1
              file.width.stdWrap.field = imagewidth
              # The real image is made 20 pixels more narrow than set in the Content element
              file.width.stdWrap.wrap = |-20
              file.width.prioriCalc = intval
              # Inserted at offset 10,10
              offset = 10,10
          }
       }

Result
^^^^^^

Here a background image with a gradient has been "underlied" under the
image:

|Variant 1|

Variant 2
---------

Here a dark box get's created bottom-right of the final image locations
and get's blurred. This simulates a shadow. Then the image get's placed
on top of it.

.. _constants-1:

Constants
^^^^^^^^^

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

       lib.shadowIntensity = #999999

.. _setup-1:

Setup
^^^^^

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

       tt_content.image.20.1.file >
       tt_content.image.20.1.file = GIFBUILDER
       tt_content.image.20.1.file {
          XY = [10.w]+20,[10.h]+20
          # The background color of the image/content
          backColor = #ffffff
          # Create a "dummy" image from the real image which is 20 pixel
          # smaller than the set width.
          10 = IMAGE
          10 {
              file.import.current = 1
              file.width.stdWrap = 1
              file.width.stdWrap.field = imagewidth
              file.width.stdWrap.wrap = |-20
              file.width.prioriCalc = intval
              offset = 10,10
          }
          # Draw a black/gray box over the dummy image
          20 = BOX
          20.dimensions = 10,10,[10.w],[10.h]
          # You have to set lib.shadowIntensity in your constants.
          20.color = {$lib.shadowIntensity}
          # Blur the black box
          30 = EFFECT
          30.value = blur=99 |
       #   Blur again if required (wider blurred edge/shadow)
       #   31 < .30
          # Put the image on top again at a slightly more left top position.
          50 < .10
          50.offset = 5,5
       }

Notice: above code won't work inside a TemplaVoila FlexForm for various
reasons (the TS parser crashes at line file.width.stdWrap.wrap = \|-20
and copy instructions like 50 < .10 don't work).

The following code does work inside a TemplaVoila DS:

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

              10 = IMAGE
              10.file = GIFBUILDER
              10.file {
                      XY = [10.w]+20,[10.h]+20
                      backColor = #ffffff
                      10 = IMAGE
                      10{
                              file.import = uploads/tx_templavoila/
                              file.import.current = 1
                              file.import.listNum = 0
                              file.maxW = 161
                              offset = 10,10
                      }
                      
                      20 = BOX
                      20.dimensions = 10,10,[10.w],[10.h]
                      20.color = #CCCCCC
                      
                      30 = EFFECT
                      30.value = blur=99|
                      
                      40=IMAGE
                      40{
                              file.import = uploads/tx_templavoila/
                              file.import.current = 1
                              file.import.listNum = 0
                              file.maxW = 161           
                      }
                      40.offset = 7,7     
              }

.. _result-1:

Result
^^^^^^

Here the result of the blur method. It looks quite good.

|Variant 2|

Notes
-----

The lower method should give better results in case you do not need to
blend a specific background image in.

You can Adjust the blur=99 value to lower values to get smaller blurred
edges. Or you can additionally blur multiple times which will give a
wider blurred/shadow area.

You can change the color set via lib.shadowIntensity Constant to lower
values (more black) to get more intense shadows or to a lighter value
for lighter shadows.

Quality
=======

If you find that
`GIFBUILDER <https://docs.typo3.org/typo3cms/TyposcriptReference/Gifbuilder/Gifbuilder/Index.html>`__
objects' quality is too poor for your needs, here are some suggestions
made on 06.02.21 on the T3 Dev list by JoH that should enable you to
create much better quality images:

-  To get best results you should always set [GFX][gdlib_png]=1 in the
   Install Tool. Otherwise all internal operations will be done with GIF
   which only supports 256 colors. As soon as this option is set, all
   image operations are done internally with PNG images but still using
   256 colors. This is due to the fact that PNG had to be used as a
   replacement for the patented GIF format a few years ago.

-  Never use JPG or GIF as source files for the GIFBUILDER - they always
   contain artefacts that will be multiplied by the rendering process -
   use uncompressed TIF or maybe even AI files instead.

-  Render the images twice the size of the original output size and then
   use the
   `SCALE <https://docs.typo3.org/typo3cms/TyposcriptReference/Gifbuilder/ObjectNames/Index.html#gifbuilder-scale>`__
   function in GIFBUILDER as the last object in the list to scale them
   down to the desired size. (Will render fonts with anti-aliasing even
   without the niceText property of the GIFBUILDER
   `TEXT <https://docs.typo3.org/typo3cms/TyposcriptReference/Gifbuilder/ObjectNames/Index.html#gifbuilder-text>`__
   object enabled as a side effect).

TYPO3 < 4.0.0
-------------

-  For T3 version lower than 4.x use the `KB all
   colors <https://extensions.typo3.org/extension/kb_allcolors/>`__
   extension which enables GIFBUILDER to render images with 24bit colors
   instead of 256 if you have gdlib2 available. (Will be implemented in
   T3 versions 4.x+)

.. _typo3-4.0.0-1:

TYPO3 >= 4.0.0
--------------

-  Starting with TYPO3 4.0 the GIFBUILDER includes the code of the
   kb_allcolors extension which enables TYPO3 to render full color
   images without the need of an extra XCLASSing extension.

-  If you would also like to use truecolor PNG images by using the
   .format=png option in a GIFBUILDER or GMENU option, you will also
   have to set the newly introduced variable [GFX][png_truecolor] in the
   Install Tool. (But note that this will drastically increase the
   filesize of your images (400KB instead of 100KB and similar).

Huge thanks go to Bernhard Kraft who spent days to finally solve this
problem. Great work!

Hints, problem solving etc.
===========================

gdlib > 2
---------

On a recent Ubuntu host (gdlib > 2) I got just a couple of pixels as
result of resizing transparent PNG images. The following was missing in
my localconf.php to get nice images:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $TYPO3_CONF_VARS['GFX']['gdlib_2'] = '1';

(Thomas Meixner)

.. |A Background Image| image:: files/Backimage.jpg
   :target: /File:Backimage.jpg
.. |A overlay image| image:: files/Logo.png
   :target: /File:Logo.png
.. |A normal mask| image:: files/Mask.png
   :target: /File:Mask.png
.. |Description| image:: files/Mask_i.png
   :target: /File:Mask_i.png
.. |image1| image:: files/Result.jpg
   :target: /File:Result.jpg
.. |Variant 1| image:: files/Typo3_shadow1.png
   :target: /File:Typo3_shadow1.png
.. |Variant 2| image:: files/Typo3_shadow2.png
   :target: /File:Typo3_shadow2.png
