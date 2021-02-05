.. include:: /Includes.rst.txt
.. highlight:: php

====================================
Documentation changes in 4.4 and 4.5
====================================

.. container::

   This page belongs to the Core Team [outdated wiki link] (category
   Core Team [outdated wiki link])

.. container::

   notice - Note

   .. container::

      What you find on this page is what we changed in the official
      documents. It does not make sense to correct any mistakes here -
      if you found one, please use the `according bug
      trackers <https://forge.typo3.org/projects/typo3cms-documentation>`__
      instead to inform us! Thank you!

======================
TSref (doc_core_tsref)
======================

Changes for TYPO3 4.5
=====================

`23677: TYPO3 Core - [Feature] Add SVG support for all browsers [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23677>`__
----------------------------------------------------------------------------------------------------------------------------------------------

Steffen,

TSref: SVG (new cObj)

-  Property: width
-  Data type: int /stdWrap
-  Description: width of SVG
-  default: 600

-  Property: height
-  Data type: int /stdWrap
-  Description: height of SVG
-  default: 400

-  Property: src
-  Data type: file resource /stdWrap
-  Description: SVG file resource
-  default:

-  Property: value
-  Data type: XML /stdWrap
-  Description: SVG raw XML. When src is defined the file will be loaded
   and value is ignored.
-  default:

-  Property: noscript
-  Data type: text /stdWrap
-  Description: Output if SVG output is not possible
-  default:

-  Property: stdWrap
-  Data type: ->stdWrap

Example:

::

   10 = SVG
   10 {
    width = 600
    height = 600
    value (
         <rect x="100" y="100"   fill="white" stroke="black" stroke-/>
         <line x1="0" y1="200" x2="700" y2="200" stroke="red" stroke-/>
         <polygon points="185 0 125 25 185 100" transform="rotate(135 125 25)" />
         <circle cx="190" cy="150" r="40" stroke="black" stroke- fill="yellow"/>
    )
    noscript.cObject = TEXT
    noscript.cObject.value = no svg rendering possible, use a browser
   }

TSref: CONFIG, add in javascriptLibs:

::

    #load SVG library
   SVG = 1
    #add SVG debug
   SVG.debug = 1
    #force render with flash
   SVG.forceFlash = 1

The above already includes "stdWrap everywhere" `24065: TYPO3 Core -
Optimize stdWrap usage for TypoScript content element SVG [Closed;
assigned to Steffen Kamper] <https://forge.typo3.org/issues/24065>`__

`23744: TYPO3 Core - A new TypoScript cObject: FLUIDTEMPLATE [Closed; assigned to Benni Mack] <https://forge.typo3.org/issues/23744>`__
---------------------------------------------------------------------------------------------------------------------------------------

Benni,

Documentation for feature #23744 - FLUID-Template To be insterted as new
cObject in TSref / FLUIDTEMPLATE:

The TypoScript object FLUIDTEMPLATE works in a similar way as the
regular "marker"-based TEMPLATE object. However, it does not use marker
or subparts, but allows Fluid-style variables with curly braces.

Note: The extensions "Fluid" and "Extbase" need to be installed for
this.

FLUIDTEMPLATE

-  Property: file
-  Data type: string+stdWrap
-  Description: the FLUID template file

-  Property: layoutRootPath
-  Data type: filepath+stdWrap

-  Property: partialRootPath
-  Data type: filepath+stdWrap

-  Property: format
-  Data type: keyword+stdWrap
-  Description: Sets the format of the current request
-  Default: html

-  Property: extbase.pluginName
-  Data type: string+stdWrap

-  Property: extbase.controllerExtensionName
-  Data type: string+stdWrap

-  Property: extbase.controllerName
-  Data type: string+stdWrap

-  Property: extbase.controllerActionName
-  Data type: string+stdWrap

-  Property: variables
-  Data type: array of cObjects
-  Description: the keys are the variable names in Fluid, reserved
   variables are "data" and "current", which are filled automatically
   with the current dataset.

-  Proerty: stdWrap
-  Data type: ->stdWrap

| 
| an example would be:

::

   10 = FLUIDTEMPLATE
   10 {
     file = fileadmin/templates/MyTemplate.html
     partialRootPath = fileadmin/templates/partial/
     variables {
        mylabel = TEXT
        mylabel.value = Label from TypoScript coming
     }
   }

the fluid template (fileadmin/templates/MyTemplate.html) could then look
like this:

{mylabel}
---------

::

   <f:format.html>{data.bodytext}</f:format.html>

The above already includes "stdWrap everywhere" `23897: TYPO3 Core -
Optimize stdWrap usage for TypoScript content element FLUIDTEMPLATE
[Closed] <https://forge.typo3.org/issues/23897>`__

`14894: TYPO3 Core - stdWrap.age should differenciate between singular/plural [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/14894>`__
----------------------------------------------------------------------------------------------------------------------------------------------------------

Susanne,

Change description of stdWrap->age: From: If you set this property with
a non-integer, it's used to format the four units. This is the default
value: " min\| hrs\| days\| yrs"

To: If you set this property with a non-integer, it is used to format
the eight units. The first four values are the plural values and the
last four are singular. This is the default string: " min\| hrs\| days\|
yrs\| min\| hour\| day\| year"

Set another string if you want to change the units. You may include the
"-signs. They are removed anyway, but they make sure that a space which
you might want between the number and the unit stays.

Example:

::

   libdate = TEXT
   libdate.data = page:tstamp
   libdate.age = " Minuten | Stunden | Tage | Jahre | Minute | Stunde | Tag | Jahr"

`15288: TYPO3 Core - Ellipse Gifbuilder Function [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/15288>`__
-----------------------------------------------------------------------------------------------------------------------------

Susanne,

TSref: GIFBUILDER, new section ELLIPSE

-  Property: dimensions
-  Data type: x,y,w,h +calc
-  Description: Dimensions of a filled ellipse.

x,y is the offset. w,h is the dimensions. Dimensions of 1 will result in
1-pixel wide lines!

-  Property: color
-  Data type: GraphicColor
-  Description: fill-color

-  Example:

::

    file = GIFBUILDER
    file {
      XY = 200,200
      format = jpg
      quality = 100
      10 = ELLIPSE
      10.dimensions = 100,100,50,50
      10.color = red
    }

[tsref:->GIFBUILDER.(GBObj).ELLIPSE]

`16209: TYPO3 Core - additional wrap for mailform.radio [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/16209>`__
------------------------------------------------------------------------------------------------------------------------------------

Susanne,

TSref Section "FORM":

radioInputWrap ->stdWrap Wraps the input element and label of a radio
button.

`20497: TYPO3 Core - New options noRescale and resoultionFactor for getImgResource() [Closed; assigned to Benni Mack] <https://forge.typo3.org/issues/20497>`__
---------------------------------------------------------------------------------------------------------------------------------------------------------------

Added by Benni, text by Stefan Geith

To be insterted to Properties-Table in TSref / Functions / imgResource:

-  Property: noScale
-  Data type: boolean
-  Description: If set, the image itself will never be scaled. Only
   width and height are calculated according to the other properties, so
   that image is \_displayed\_ resizedly, but original file is used. Can
   be used for creating PDFs or printing of pages, where the original
   file could provide much better quality than a rescaled one.

::

   Example:
    // Could e.g. have 1600 x 1200 pixels
    file = test.jpg 
    file.width = 240m
    file.height = 240m
    file.noScale = 1
   This example results in an image tag like the following. Note that src="test.jpg" is the _original_ file:
    <img src="test.jpg"   />

-  Default: 0

`22279: TYPO3 Core - Add .numberFormat function to stdWrap [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/22279>`__
-----------------------------------------------------------------------------------------------------------------------------------------

Sebastian Michaelsen

TSref: 1.5 Function / stdWrap (before date), new function numberFormat

-  Data type: ->numberFormat
-  Description: Format a float value to any number format you need (e.g.
   useful for prices).

| 
| TSref: 1.5 Functions, new section numberFormat

With this property you can format a float value and display it as you
want, for example as a price. It is a wrapper for the number_format()
function of PHP. You can define how many decimals you want and which
separators you want for decimals and thousands.

Table of properties:

-  Property: decimals
-  Data type: integer
-  Description: Number of decimals the formatted number will have.
   Defaults to 0, so that your input will in that case be rounded up or
   down to the next integer.

-  Property: dec_point
-  Data type: string
-  Description: Character that divides the decimals from the rest of the
   number. Defaults to "."

-  Property: thousands_sep
-  Data type: string
-  Description: Character that divides the thousands of the number.
   Defaults to ",", set an empty value to have no thousands separator.

Examples:

::

   lib.myPrice = TEXT
   lib.myPrice {
     value = 0.8
     numberFormat {
       decimals = 2
       dec_point = ,
     }
     noTrimWrap = || €|
   }
   # Will result in "0,80 €"

::

   lib.carViews = CONTENT
   lib.carViews {
     table = tx_mycarext_car
     select.pidInList = 42
     renderObj = TEXT
     renderObj {
       field = views
       numberFormat.thousands_sep = .
       numberFormat.decimals = 3
     }
   }
   # Will result in something like "2.055"

`23528: TYPO3 Core - Allow easy use of lightbox style image enlargement in the frontend [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/23528>`__
--------------------------------------------------------------------------------------------------------------------------------------------------------------------

Susanne,

Functions -> imageLinkWrap:

-  Change datatype of JSwindow to "boolean /stdWrap"

Add property:

-  Property: directImageLink
-  Data type: boolean
-  Description: If true, a link to the generated image file will be
   returned directly (showpic.php is not used)

Add property:

-  Property: linkParams
-  Data type: typolink
-  Description: Allows the manipulation of the generated typolink if
   JSwindow is not used.

Example:

::

   linkParams.ATagParams.dataWrap =   rel="{$styles.content.imgtext.linkWrap.lightboxRelAttribute}"

`23533: TYPO3 Core - TSConfig needs conditions for current page (backend) [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/23533>`__
------------------------------------------------------------------------------------------------------------------------------------------------------

Susanne,

Add to "Condition reference", new condition "page":

page

Syntax:

[page|[field] = value]

This condition checks values of the current page record. While you can
achieve the same with TSFE:[field] conditions in the frontend, this
condition is usable in both backend and frontend.

Example:

With this condition you can do things depending on the layout field:

[page|layout = 1]

`23760: TYPO3 Core - Let typolink honour secure filelink configuration [Closed; assigned to Ernesto Baschny] <https://forge.typo3.org/issues/23760>`__
------------------------------------------------------------------------------------------------------------------------------------------------------

Stan,

In function "typolink", add the following new property (after
"addQueryString"):

-  Property: jumpurl
-  Data type: boolean
-  Description: Decides if the link should call the script with the
   jumpurl parameter in order to register any clicks in the stat. This
   works the same as "filelink.jumpurl", see more details there.

Example:

::

   typolink.jumpurl = 1
   typolink.jumpurl.secure = 1
   typolink.jumpurl.secure.mimeTypes = list of mimetypes, syntax [ext] = [mimetype]

`23844: TYPO3 Core - No possibility to completely disable the preview info box -> introduce new config setting [Closed; assigned to Jeff Segars] <https://forge.typo3.org/issues/23844>`__
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Jeff,

TSref - section "CONFIG"

-  Property: disablePreviewNotification
-  Data type: boolean
-  Description: Disables the "preview" notification box completely.
-  default: 0

`24059: TYPO3 Core - Add basic support for RDFa in core (semantic web) [Closed; assigned to Jochen Rau] <https://forge.typo3.org/issues/24059>`__
-------------------------------------------------------------------------------------------------------------------------------------------------

Jochen Rau:

Add the line

"xhtml+rdfa_10" for XHTML+RDFa 1.0 doctype.

to the description of TLO CONFIG->doctype

Resulting list of doctypes:

"xhtml_trans" for XHTML 1.0 Transitional doctype.

"xhtml_frames" for XHTML 1.0 Frameset doctype.

"xhtml_strict" for XHTML 1.0 Strict doctype.

"xhtml_basic" for XHTML basic doctype.

"xhtml_11" for XHTML 1.1 doctype.

"xhtml+rdfa_10" for XHTML+RDFa 1.0 doctype.

"xhtml_2" for XHTML 2 doctype.

"html5" for HTML5 doctype.

"none" for NO doctype at all.

---

Add the following property to the description of TLO CONFIG

-  Property: namespaces

-  Data type: array of strings
-  Description: This property enables you to add xml namespaces (xmlns)
   to the html tag. This is especially useful if you want to add RDFa or
   microformats to your html.

Example:

::

   config.namespaces.dc = http://purl.org/dc/elements/1.1/
   config.namespaces.foaf = http://xmlns.com/foaf/0.1/

The configuration will result in a html tag like

::

   <html xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:foaf="http://xmlns.com/foaf/0.1/">

`24443: TYPO3 Core - getBrowserInfo should recognize iOS and android for easier mobile optimization [Closed; assigned to Ernesto Baschny] <https://forge.typo3.org/issues/24443>`__
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Andy,

Add the following browsers to the "Values and comparison" table of
browsers (browser \| identification):

::

   Mozilla Firefox | firefox
   Apple Safari | safari
   Google Chrome | chrome

| 
| Add the following systems to the "Values and comparison" table of
  systems (system \| identification):

::

   Android | android
   Chrome OS | chrome
   OpenBSD/NetBSD/FreeBSD | unix_bsd
   iOS | iOS
   Windows 2000 | win2k
   Windows XP | winXP
   Windows Vista | winVista
   Windows 7 | win7

| 
| Add the following text and corresponding table (system \|
  identification), e.g. after the Example of matching systems:

Note that for backwards compatibility, some systems are also matched by
more generic strings. It is recommended to use the new identifiers
documented above, but those are valid, too:

::

   System | Generic but valid identification
   Android | linux
   Chrome OS | linux
   iOS | mac
   Windows 2000 | winNT
   Windows XP | winNT
   Windows Vista | winNT
   Windows 7 | winNT

`24545: TYPO3 Core - Rename config.doctype value "html_5" to "html5" [Closed; assigned to Steffen Gebert] <https://forge.typo3.org/issues/24545>`__
---------------------------------------------------------------------------------------------------------------------------------------------------

Sebastian M.

Apply the following changes to 1.6 Setup -> "CONFIG" -> doctype: Replace
"html_5" with "html5" and add the Note "In TYPO3 4.4 the keyword for
HTML5 is "html_5". This spelling is deprecated since TYPO3 4.5."

`25317: TYPO3 Core - Typolink fails to link between two non-default page types [Closed] <https://forge.typo3.org/issues/25317>`__
---------------------------------------------------------------------------------------------------------------------------------

Ernesto Baschny,

Document on "CONFIG"->linkVars that one should \*not\* include "type"
parameter in the linkVars list (e.g. "config.linkVars = type"), as this
can result in unexpected behaviour. See above mentioned bug report.

stdWrap everywhere
------------------

Following is a list of the properties, to which stdWrap has been added.
It is ordered by their appearance in TSref.

The patches were made by Joey.

`23921: TYPO3 Core - Optimize stdWrap usage for TypoScript content element HTML [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23921>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

diff [outdated link]

TSref: HTML

-  Property: stdWrap
-  Data type: ->stdWrap

| 
| (The property "value" already had stdWrap before.)

So now it's possible to use 2 times stdWrap, one with "value" and one
with "stdWrap".

`24063: TYPO3 Core - Optimize stdWrap usage for TypoScript content element TEXT [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24063>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: TEXT

Only optimizsation of when to call stdWrap; no new stdWrap anywhere.

`23891: TYPO3 Core - Optimize stdWrap usage for TypoScript content element COA [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23891>`__, `23892: TYPO3 Core - Optimize stdWrap usage for TypoScript content element COA_INT [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23892>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: COA, COA_INT

-  Property: wrap
-  Data type: wrap /stdWrap

-  Property: includeLibs
-  Data type: list of resources /stdWrap
-  Description: (This property is used only if the object is COA_INT!,
   See introduction.)

This is a comma-separated list of resources that are included as
PHP-scripts (with include_once() function) if this script is included.
This is possible to do because any include-files will be known before
the scripts are included. That's not the case with the regular
PHP_SCRIPT cObject.

`23896: TYPO3 Core - Optimize stdWrap usage for TypoScript content element FILE [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23896>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

diff [outdated link]

TSref: FILE

-  Property: file
-  Data type: resource/stdWrap
-  Desription: If the resource is jpg,gif,jpeg,png the image is inserted
   as an image-tag. Al other formats is read and inserted into the
   HTML-code.

The maximum filesize of documents to be read is set to 1024 kb
internally!

-  Property: linkWrap
-  Data type: linkWrap/stdWrap
-  Description: (before ".wrap")

-  Property: wrap
-  Data type: wrap/stdWrap

-  Property: stdWrap
-  Data type: ->stdWrap

`23969: TYPO3 Core - Optimize stdWrap usage for TypoScript content element IMAGE [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/23969>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: IMAGE

No new stdWrap. But other missing stdWrap parameters will be added by
another RFC changing the behaviour of cObj->cImage.

`23970: TYPO3 Core - Optimize stdWrap usage for TypoScript content element IMG_RESOURCE [Closed; assigned to Ernesto Baschny] <https://forge.typo3.org/issues/23970>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: IMG_RESOURCE

No new stdWrap anywhere, but same as above: Other missing stdWrap
parameters will be added by another RFC changing the behaviour of
cObj->cImage.

`23888: TYPO3 Core - Optimize stdWrap usage for TypoScript content element CLEARGIF [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23888>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

diff [outdated link]

TSref: CLEARGIF

-  Property: wrap
-  Data type: wrap/stdWrap

-  Property: stdWrap
-  Data type: ->stdWrap

`23890: TYPO3 Core - Optimize stdWrap usage for TypoScript content element CONTENT [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23890>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

diff [outdated link]

TSref: CONTENT

-  Property: slide
-  Data type: integer /stdWrap
-  Description: If set and no content element is found by the select
   command, then the rootLine will be traversed back until some content
   is found.

Possible values are “-1” (slide back up to the siteroot), “1” (only the
current level) and “2” (up from one level back). Use -1 in combination
with collect.

-  

   -  .collect (int/stdWrap): If set, all content elements found on
      current and parent pages will be collected. Otherwise, the sliding
      would stop after the first hit. Set this value to the amount of
      levels to collect on, or use “-1” to collect up to the siteroot.
   -  .collectFuzzy (boolean/stdWrap): Only useful in collect mode. If
      no content elements have been found for the specified depth in
      collect mode, traverse further until at least one match has
      occurred.
   -  .collectReverse (boolean/stdWrap): Change order of elements in
      collect mode. If set, elements of the current page will be at the
      bottom.

-  Property: wrap
-  Data type: wrap/stdWrap
-  Description: Wrap the whole content story ...

`23972: TYPO3 Core - Optimize stdWrap usage for TypoScript content element RECORDS [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/23972>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: RECORDS

`nonsense
example <http://lists.typo3.org/pipermail/typo3-team-core/2010-November/045829.html>`__

-  Property: tables
-  Data type: list of tables /stdWrap

-  Property: dontCheckPid
-  Data type: boolean /stdWrap

-  Property: wrap
-  Data type: wrap /stdWrap

`23898: TYPO3 Core - Optimize stdWrap usage for TypoScript content element HMENU [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23898>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: HMENU

-  Property: wrap
-  Data type: wrap/stdWrap

And present since TYPO3 4.5.4:

`26483: TYPO3 Core - stdWrap for excludeUidList (HMENU) does not work
[Closed] <https://forge.typo3.org/issues/26483>`__

Roland Waldner:

-  Property: excludeUidList
-  Data type: list of integers /stdWrap

`23895: TYPO3 Core - Optimize stdWrap usage for TypoScript content element CTABLE [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23895>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: CTABLE

-  Property: offset
-  Data type: x,y /stdWrap
-  Description: Offset from upper left corner
-  Default: 0,0

-  Property: tm
-  Data type: ->CARRAY + TDParams /stdWrap
-  Description: top menu

-  Property: lm
-  Data type: ->CARRAY + TDParams /stdWrap
-  Description: left menu

-  Property: rm
-  Data type: ->CARRAY + TDParams /stdWrap
-  Description: right menu

-  Property: bm
-  Data type: ->CARRAY + TDParams /stdWrap
-  Description: bottom menu

-  Property: c
-  Data type: ->CARRAY + TDParams /stdWrap
-  Description: content cell

-  Property: cMargins
-  Data type: margins /stdWrap
-  Description: Distance around the content cell "c"
-  Default: 0,0,0,0

-  Property: cWidth
-  Data type: pixels /stdWrap
-  Description: Width of the content cell "c"

-  Property: tableParams
-  Data type: <TABLE>-params /stdWrap
-  Description:
-  Default: border="0" cellspacing="0" cellpadding="0"

-  Property: stdWrap
-  Data type: ->stdWrap

`24050: TYPO3 Core - Optimize stdWrap usage for TypoScript content element OTABLE [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24050>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

diff [outdated link]

TSref: OTABLE

-  Property: offset
-  Data type: x,y /stdWrap

-  Property: tableParams
-  Data type: <TABLE>-params /stdWrap

-  Property: stdWrap
-  Data type: ->stdWrap

`23889: TYPO3 Core - Optimize stdWrap usage for TypoScript content element COLUMNS [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23889>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: COLUMNS

-  Property: tableParams
-  Data type: <TABLE>-params/stdWrap
-  Description:
-  default: border="0" cellspacing="0" cellpadding="0"

-  Property: TDParams
-  Data type: <TD>-params/stdWrap
-  Description:
-  default: valign="top"

-  Property: rows
-  Data type: int(range:2-20)/stdWrap
-  Description: The number of rows in the columns.
-  default: 2

-  Property: totalWidth
-  Data type: int/stdWrap
-  Description: The total width of the columns + gaps.

`23920: TYPO3 Core - Optimize stdWrap usage for TypoScript content element HRULER [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23920>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: HRULER

-  Property: lineColor
-  Data type: HTML-color /stdWrap

-  Property: spaceLeft
-  Data type: pixels /stdWrap

-  Property: spaceRight
-  Data type: pixels /stdWrap

-  Property: tableWidth
-  Data type: string /stdWrap

| 
| (Senseless) example:

::

   page.15 = HRULER
   page.15.lineColor.field = uid
   page.15.lineColor.wrap = #00|00
   page.15.lineThickness = 2

==== `23974: TYPO3 Core - Optimize stdWrap usage for TypoScript content
element IMGTEXT [Closed; assigned to Steffen
Kamper] <https://forge.typo3.org/issues/23974>`__ TSref: IMGTEXT

-  Property: noStretchAndMarginCells
-  Data type: boolean /stdWrap

==== `23886: TYPO3 Core - Optimize stdWrap usage for TypoScript content
element CASE [Closed; assigned to Steffen
Kamper] <https://forge.typo3.org/issues/23886>`__ TSref: CASE

There where no missing stdWrap parameters so nothing to add.

`23971: TYPO3 Core - Optimize stdWrap usage for TypoScript content element LOAD_REGISTER [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/23971>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: LOAD_REGISTER

Bug descriptiopn only speaks of optimization, not of new stdWrap
anywhere.

RESTORE_REGISTER
^^^^^^^^^^^^^^^^

TSref: RESTORE_REGISTER

Not needed. No issue, no discussion, no entry in ChangeLog

`23981: TYPO3 Core - Optimize stdWrap usage for TypoScript content element FORM [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23981>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: FORM

-  Property: dataArray
-  Data type: (unchanged, but stdWrap for the subproperties:)

   -  dataArray.XXX.required
   -  dataArray.XXX.type
   -  dataArray.XXX.valueArray.YYY.selected
   -  dataArray.XXX.valueArray.YYY.value

-  Property: radioWrap.accessibilityWrap
-  Data type: wrap /stdWrap

-  Property: target
-  Data type: target /stdWrap

-  Property: method
-  Data type: form-method /stdWrap

-  Property: no_cache
-  Data type: string /stdWrap

-  Property: noValueInsert
-  Data type: boolean /stdWrap

-  Property: compensateFieldWidth
-  Data type: double /stdWrap

-  Property: locationData
-  Data type: boolean / string /stdWrap

-  Property: redirect
-  Data type: string /stdWrap

-  Property: goodMess
-  Data type: string /stdWrap

-  Property: badMess
-  Data type: string /stdWrap

-  Property: emailMess
-  Data type: string /stdWrap

-  Property: REQ
-  Data type: boolean /stdWrap

-  Property: REQ.layout
-  Data type: string /stdWrap

-  Property: COMMENT.layout
-  Data type: string /stdWrap

-  Property: CHECK.layout
-  Data type: string /stdWrap

-  Property: RADIO.layout
-  Data type: string /stdWrap

-  Property: LABEL.layout
-  Data type: string /stdWrap

-  Property: hiddenFields.stdWrap
-  Data type: ->stdWrap

-  Property: params
-  Data type: form-element tag parameters /stdWrap

-  Property: params.tagname
-  Data type: ->stdWrap

-  Property: wrapFieldName
-  Data type: wrap /stdWrap

-  Property: noWrapAttr
-  Data type: boolean /stdWrap

-  Property: arrayReturnMode
-  Data type: boolean /stdWrap

-  Property: accessibility
-  Data type: boolean /stdWrap

-  Property: formName
-  Data type: string /stdWrap

-  Property: fieldPrefix
-  Data type: string /stdWrap

-  Property: dontMd5FieldNames
-  Data type: boolean /stdWrap

`24069: TYPO3 Core - Optimize stdWrap usage for TypoScript content element SEARCHRESULT [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24069>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: SEARCHRESULT

-  Property: target
-  Data type: target /stdWrap

-  Property: range
-  Data type: integer /stdWrap

-  Property: renderWrap
-  Data type: wrap /stdWrap

-  Property: noOrderBy
-  Data type: boolean /stdWrap

-  Property: wrap
-  Data type: wrap /stdWrap

`24062: TYPO3 Core - Optimize stdWrap usage for TypoScript content element USER_INT [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24062>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: USER_INT

-  Property: includeLibs
-  Data type: list of resource /stdWrap

The rest of the element the USER element won't get any additional
stdWrap functionality to avoid conflicts with existing setups, that
handle the stdWrap functions within a plugin.

`24051: TYPO3 Core - Optimize stdWrap usage for TypoScript content element PHP_SCRIPT [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24051>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: PHP_SCRIPT

-  Property: file
-  Data type: resource /stdWrap

-  Property: stdWrap
-  Data type: ->stdWrap

`24052: TYPO3 Core - Optimize stdWrap usage for TypoScript content elements PHP_SCRIPT_INT and PHP_SCRIPT_EXT [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24052>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: PHP_SCRIPT_INT, PHP_SCRIPT_EXT

-  Property: file
-  Data type: resource /stdWrap

-  Property: stdWrap
-  Data type: ->stdWrap

`24064: TYPO3 Core - Optimize stdWrap usage for TypoScript content element TEMPLATE [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24064>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: TEMPLATE

-  Property: workOnSubpart
-  Data type: string /stdWrap

-  Property: markerWrap
-  Data type: wrap /stdWrap

-  Property: substMarksSeparately
-  Data type: boolean /stdWrap

-  Property: nonCachedSubst
-  Data type: boolean /stdWrap

-  Property: stdWrap
-  Data type: ->stdWrap

`24048: TYPO3 Core - Optimize stdWrap usage for TypoScript content element MULTIMEDIA [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24048>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: MULTIMEDIA

-  Property: width
-  Data type: integer /stdWrap

-  Property: height
-  Data type: integer /stdWrap

`24032: TYPO3 Core - The content object type EDITPANEL is missing, causing pi_getEditPanel to break. [Closed; assigned to Jeff Segars] <https://forge.typo3.org/issues/24032>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: EDITPANEL

A hidden issue. This issue "added" the cObject EDITPANEL again, which
somehow got lost while refactoring tslib_content. Jeff Segars also
`integrated
stdWrap <http://lists.typo3.org/pipermail/typo3-team-core/2010-November/045994.html>`__.

-  Property: stdWrap
-  Data type: ->stdWrap

| 
| Some other properties have stdWrap (coming from
  typo3/sysext/feedit/view/class.tx_feedit_editpanel.php). This is at
  least the case since TYPO3 4.3 and was not documented. Here is a list:

-  Property: label
-  Data type: string /stdWrap

-  Property: innerWrap
-  Data type: wrap /stdWrap

-  Property: outerWrap
-  Data type: wrap /stdWrap

`24090: TYPO3 Core - Optimize stdWrap usage for GIFBUILDER [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/24090>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSref: GIFBUILDER

-  Property: transparentBackground
-  Data type: boolean /stdWrap

-  Property: reduceColors
-  Data type: posint (1-255) /stdWrap

-  Property: XY
-  Data type: x,y +calc /stdWrap

-  Property: offset
-  Data type: x,y +calc /stdWrap

-  Property: workArea
-  Data type: x,y,w,h + calc /stdWrap

-  Property: maxWidth
-  Data type: pixels /stdWrap

-  Property: maxHeight
-  Data type: pixels /stdWrap

-  TEXT:

   -  Property: maxWidth
   -  Data type: pixels /stdWrap

-  

   -  Property: offset
   -  Data type: x,y +calc /stdWrap

-  

   -  Property: breakWidth
   -  Data type: integer /stdWrap

-  IMAGE:

   -  Property: offset
   -  Data type: x,y +calc /stdWrap

-  BOX:

   -  Property: dimensions
   -  Data type: x,y,w,h +calc /stdWrap

-  ELLIPSE:

   -  Property: dimensions
   -  Data type: x,y,w,h +calc /stdWrap

-  WORKAREA:

   -  Property: set
   -  Data type: x,y,w,h + calc /stdWrap

-  CROP:

   -  Property: crop
   -  Data type: x,y,w,h + calc /stdWrap

-  SCALE:

   -  Property: width
   -  Data type: pixels + calc /stdWrap

-  

   -  Property: height
   -  Data type: pixels + calc /stdWrap

`24089: TYPO3 Core - Optimize stdWrap usage for tslib_content [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/24089>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TSREF, changes to tslib_content affecting different cObjects

This is the patch which was referenced in the issues of IMAGE and
IMG_RESOURCE: There no new stdWrap were added with the two according
RFCs (#23969 and #23970).

But: "other missing stdWrap parameters will be added by another RFC
changing the behaviour of cObj->cImage."

I went through the diff [outdated link] and added stdWrap where it has
been added.

IMAGE

-  Property: linkWrap
-  Data type: linkWrap /stdWrap

IMAGE

-  Property: wrap
-  Data type: wrap /stdWrap

imageLinkWrap

-  Property: sample
-  Data type: boolean /stdWrap

imageLinkWrap

-  Property: width
-  Data type: int (1-1000) /stdWrap

imageLinkWrap

-  Property: height
-  Data type: int (1-1000) /stdWrap

imageLinkWrap

-  Property: effects
-  Data type: see GIFBUILDER / effects. (from stdgraphics-library)

/stdWrap

imageLinkWrap

-  Property: alternativeTempPath
-  Data type: path /stdWrap

imageLinkWrap

-  Property: title
-  Data type: string /stdWrap

imageLinkWrap

-  Property: bodyTag
-  Data type: <tag> /stdWrap

imageLinkWrap

-  Property: wrap
-  Data type: wrap /stdWrap

imageLinkWrap

-  Property: directImageLink
-  Data type: boolean /stdWrap

imageLinkWrap

-  Property: <A>-data:target /stdWrap
-  Data type: target

imageLinkWrap

-  Property: JSwindow.newWindow
-  Data type: boolean /stdWrap

imageLinkWrap

-  Property: JSwindow.altUrl
-  Data type: string /stdWrap

IMAGE

-  Property: emptyTitleHandling
-  Data type: string /stdWrap

FILE

-  Property: emptyTitleHandling
-  Data type: string /stdWrap

| 
| filelink

-  Property: emptyTitleHandling
-  Data type: string /stdWrap

| 
| IMGTEXT

-  Property: emptyTitleHandling
-  Data type: string /stdWrap

filelink

-  Property: icon_image_ext_list
-  Data type: list of image extensions /stdWrap

filelink

-  Property: wrap
-  Data type: wrap /stdWrap

split

-  Property: cObjNum
-  Data type: cObjNum +optionSplit /stdWrap

split

-  Property: wrap
-  Data type: wrap +optionSplit /stdWrap

| 
| makelinks

-  Property: http.wrap
-  Data type: wrap /stdWrap

| 
| makelinks

-  Property: mailto.wrap
-  Data type: wrap /stdWrap

| 
| imgResource

-  Property: noScale
-  Data type: boolean /stdWrap

| 
| typolink

-  Property: wrap
-  Data type: wrap /stdWrap

| 
| select

-  Property: groupBy
-  Data type: SQL-groupBy /stdWrap

select

-  Proerty: orderBy
-  Data type: SQL-orderBy /stdWrap

Changes for TYPO3 4.4
=====================

`20736: TYPO3 Core - HTML5 doctype implementation [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/20736>`__
--------------------------------------------------------------------------------------------------------------------------------

Andy:

Add in config / doctype

::

   html_5 for the HTML5 doctype.

`21053: TYPO3 Core - Support for SSL and absolute Links [Closed; assigned to Oliver Hader] <https://forge.typo3.org/issues/21053>`__
------------------------------------------------------------------------------------------------------------------------------------

Olly, 2010-02-22

TSref: functions/typolink, new property after "parameter"

-  Property: forceAbsoluteUrl
-  Data type: boolean
-  Description: Forces links to internal pages to be absolute, thus
   having a proper URL scheme and domain prepended.

Additional property: .scheme: Defines the URL scheme to be used (https
or http, which is the default value)

::

   Example:
   typolink {
     parameter = 13
     forceAbsoluteUrl = 1
     forceAbsoluteUrl.scheme = https
   }

`22300: TYPO3 Core - Possibility to configure another link paramter for jumpurl filelinks [Closed; assigned to Benni Mack] <https://forge.typo3.org/issues/22300>`__
--------------------------------------------------------------------------------------------------------------------------------------------------------------------

Add the following to chapter 1.5 Functions in section filelink [outdated
link] inside the explanation of the jumpurl property inside "Extra
properties":

-  .parameter = [string/stdWrap]

By default the jumpurl link will use the current pid and typeNum. If you
need alternative values (e.g. for logging) you can specify them here.
For options see typolink.parameter

`22338: TYPO3 Core - Added marker in CONTENT object [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/22338>`__
----------------------------------------------------------------------------------------------------------------------------------

Jigal

New property for CONTENT.select:

-  Property: markers
-  Data type: array of markers
-  Description: The markers defined in this section can be used, wrapped
   in the usual ###markername### way, in any other property of select.

Each value is properly escaped and quoted to prevent SQL injection
problems. This provides a way to safely use external data (e.g. database
fields, GET/POST parameters) in a query.

<markername>.value (value) sets the value directly.

<markername>.commaSeparatedList (bool) If set the value is interpreted
as a comma separated list of values. Each value in the list is
individually escaped and quoted.

(stdWrap properties ...) All stdWrap properties can be used for each
markername

::

   Example:
   page.60 = CONTENT
   page.60 {
     table = tt_content
     select {
       pidInList = 73
       where = header != ###whatever###
       orderBy = ###sortfield###
       markers {
         whatever.data = GP:first
         sortfield.value = sor
         sortfield.wrap = |ting
       }
     }
   }

`22511: TYPO3 Core - getBrowserInfo delivers wrong info [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/22511>`__
--------------------------------------------------------------------------------------------------------------------------------------

SteffenK:

Modify "Condition reference", browser:

The browser condition now delivers reliable information about the client
browser. So now it's possible to make a condition for usage of Firefox,
or even a webkit based browser. This is the list of known browsers:

::

   msie, firefox, webkit, opera, netscape, konqueror, gecko, chrome, safari, seamonkey, navigator, mosaic, lynx, 
   amaya, omniweb, avant, camino, flock, aol

`22603: TYPO3 Core - Condition misses check for no logged in user [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/22603>`__
------------------------------------------------------------------------------------------------------------------------------------------------

SteffenK:

Add to the "Condition reference", loginUser:

Additionally it is possible to match for no FE user being logged in.

::

   Example:
   This matches when no user is logged in:
   [loginUser = ]

============================
TSconfig (doc_core_tsconfig)
============================

.. _changes-for-typo3-4.5-1:

Changes for TYPO3 4.5
=====================

Description of setup.fields.<fieldname>.disabled
------------------------------------------------

Søren Malling:

This can be used in TYPO3 4.3 and newer, but is missing in
doc_core_tsconfig: You can not only set default values or override them
as described above, but beginning with TYPO3 4.3 it is also possible to
hide fields in the module "User tools > User Settings". Also see this
`Buzz
Post <http://buzz.typo3.org/people/soeren-malling/article/remove-fields-from-user-settings-they-will-not-be-needed/>`__.

New section Setup-->fields.

-  Property: setup.fields.<fieldname>.disabled

-  Data type: boolean

-  Description: This setting hides the option with the name <fieldname>
   in the module User Settings.

You can find the names of the fields in the Module "Configuration". Just
browse through the "User Settings" array.

Example:

setup.fields.emailMeAtLogin.disabled = 1

With this example, we hide the "E-mail me when I login" checkbox.

You can also combine setup.fields.<fieldname>.disabled and
setup.override.<fieldname>.

Example:

setup.fields.emailMeAtLogin.disabled = 1 setup.override.emailMeAtLogin =
1

Now the "Email me when i login" field is removed, but the user will
still receive an email when he logs in.

-  Default value: 0

`23433: TYPO3 Core - Rename "Shortcuts" to "Bookmarks" [Closed; assigned to Steffen Gebert] <https://forge.typo3.org/issues/23433>`__, `23943: TYPO3 Core - Apply "bookmarks" naming to UserTS options [Closed; assigned to Steffen Gebert] <https://forge.typo3.org/issues/23943>`__
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

SteffenG:

In the descriptions the word "Shortcuts" was replaced with "Bookmarks".

In doc_core_tsconfig Section: User TSconfig Table: ->OPTIONS

-  Add enableBookmarks with text of enableShortcuts
-  Add bookmarkGroups with text of shortcutGroups
-  Add bookmark_onEditId_dontSetPageTree with text of
   shortcut_onEditId_dontSetPageTree
-  Add bookmark_onEditId_keepExistingExpanded with text of
   shortcut_onEditId_keepExistingExpanded
-  Add mayNotCreateEditBookmarks with text of mayNotCreateEditShortcuts
-  The old options with "shortcut" are depecated. They still are
   included with an according hint.

`23506: TYPO3 Core - Make checkboxes at the bottom of modules hidable [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/23506>`__
--------------------------------------------------------------------------------------------------------------------------------------------------

Susanne:

User TSconfig->OPTIONS add at the end of the table:

-  Property: file_list.enableDisplayBigControlPanel
-  Data type: list of keywords
-  Description: Determines whether the checkbox "Extended view" in the
   filelist module is shown or hidden. If it is hidden, you can
   predefine it to be always activated or always deactivated.

The following values are possible: - activated: The option is activated
and the checkbox is hidden. - deactivated: The option is deactivated and
the checkbox is hidden. - selectable: The checkbox is shown so that the
option can be selected by the user.

-  Default: selectable

-  Property: file_list.enableDisplayThumbnails
-  Data type: list of keywords
-  Description: Determines whether the checkbox "Display thumbnails" in
   the filelist module is shown or hidden. If it is hidden, you can
   predefine it to be always activated or always deactivated.

The following values are possible: - activated: The option is activated
and the checkbox is hidden. - deactivated: The option is deactivated and
the checkbox is hidden. - selectable: The checkbox is shown so that the
option can be selected by the user.

-  Default: selectable

-  Property: file_list.enableClipBoard
-  Data type: list of keywords
-  Description: Determines whether the checkbox "Show clipboard" in the
   filelist module is shown or hidden. If it is hidden, you can
   predefine it to be always activated or always deactivated.

The following values are possible: - activated: The option is activated
and the checkbox is hidden. - deactivated: The option is deactivated and
the checkbox is hidden. - selectable: The checkbox is shown so that the
option can be selected by the user.

-  Default: selectable

--------------

| 
| Section: Page TSconfig Part: ->MOD Table: Web>List (mod.web_list)
  behind the option "showClipControlPanelsDespiteOfCMlayers" add:

-  Property: enableDisplayBigControlPanel
-  Data type: list of keywords
-  Description: Determines whether the checkbox "Extended view" in the
   list module is shown or hidden. If it is hidden, you can predefine it
   to be always activated or always deactivated.

The following values are possible: - activated: The option is activated
and the checkbox is hidden. - deactivated: The option is deactivated and
the checkbox is hidden. - selectable: The checkbox is shown so that the
option can be selected by the user.

-  Default: selectable

-  Property: enableClipBoard
-  Data type: list of keywords
-  Description: Determines whether the checkbox "Show clipboard" in the
   list module is shown or hidden. If it is hidden, you can predefine it
   to be always activated or always deactivated.

The following values are possible: - activated: The option is activated
and the checkbox is hidden. - deactivated: The option is deactivated and
the checkbox is hidden. - selectable: The checkbox is shown so that the
option can be selected by the user.

-  Default: selectable

-  Property: enableLocalizationView
-  Data type: list of keywords
-  Description: Determines whether the checkbox "Localization view" in
   the list module is shown or hidden. If it is hidden, you can
   predefine it to be always activated or always deactivated.

The following values are possible: - activated: The option is activated
and the checkbox is hidden. - deactivated: The option is deactivated and
the checkbox is hidden. - selectable: The checkbox is shown so that the
option can be selected by the user.

-  Default: selectable

`22266: TYPO3 Core - Move checkbox "secondary options" to users module [Closed; assigned to Susanne Moog] <https://forge.typo3.org/issues/22266>`__
---------------------------------------------------------------------------------------------------------------------------------------------------

Susanne: User TSconfig, new property after clipboardNumberPads

-  Property: enableShowPalettes
-  Data type: boolean
-  Description: If true, the checkbox "Show secondary options
   (palettes)" is displayed in content editing forms.
-  Default: 1

`23182: TYPO3 Core - Context menu icons are on the right side [Closed; assigned to Steffen Gebert] <https://forge.typo3.org/issues/23182>`__
--------------------------------------------------------------------------------------------------------------------------------------------

Steffen Gebert: UserTSconfig ->SETUP

Option contextMenu.options.leftIcons

default value changed to 1

`24004: TYPO3 Core - navFrameWidth and navFrameResizable are not respected any more [Closed; assigned to Steffen Gebert] <https://forge.typo3.org/issues/24004>`__
------------------------------------------------------------------------------------------------------------------------------------------------------------------

Steffen Gebert UserTSconfig ->SETUP

Mark options as removed

-  navFrameWidth
-  navFrameResizable

They are not supported/needed anymore with the new Page Tree.

`24041: TYPO3 Core - Implement Inline Relational Record Editing (IRRE) in Workspaces [Closed; assigned to Oliver Hader] <https://forge.typo3.org/issues/24041>`__
-----------------------------------------------------------------------------------------------------------------------------------------------------------------

Olly

TSconfig > User TSconfig > OPTIONS

new entry after property "workspaces.changeStageMode"

-  Property: workspaces.considerReferences
-  Data type: boolean
-  Description: If elements of a dependent structure (e.g. Inline
   Relational Record Editing) shall be swapped, published or sent to a
   stage alone, the accordant parent/child structure is considered
   automatically.
-  Default: 1

`24006: TYPO3 Core - Make FlexForms editable via TSConfig and group access lists [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24006>`__
---------------------------------------------------------------------------------------------------------------------------------------------------------------

Kai Vogel

Section: Page TSconfig Table: ->TCEFORM add at the end of the table:

Property:

::

    [tablename].[field].[dataStructKey].[flexSheet]

Data type:

::

    ->TCEFORM_flexformSheet

Description:

::

    Configuration for the data structure of a field with type "flex".

::

    The [dataStructKey] represents the key of a FlexForm in $TCA[<tablename>]['columns'][<field>]['config']['ds'].
    This key will be splitted into up to two parts and by default the first part will be used as identifier of the FlexForm in TSconfig.
    The second part will override the identifier if it is not empty, "list" or "*".
    For example the identifier of the key "my_ext_pi1,list" will be "my_ext_pi1" and of the key "*,my_CType" it will be "my_CType".

::

    TCEFORM.[tablename].[field].[dataStructKey].[flexSheet] configures a whole FlexForm sheet

Property:

::

    [tablename].[field].[dataStructKey].[flexSheet].[flexField]

Data type:

::

    ->TCEFORM_confObj

Description:

::

    Configuration for the data structure of a field with type "flex".

::

    TCEFORM.[tablename].[field].[dataStructKey].[flexSheet].[flexField] configures a single FlexForm field

::

    Only this TCEFORM_confObj options are available for FlexForm fields:
      * disabled
      * label
      * keepItems
      * removeItems
      * addItems
      * altLabels

::

    Example:

::

    TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField {
      # Remove
      disabled = 1

::

      # Rename
      label = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField

::

      # Remove all items from select but this
      keepItems = item1,item2,item3

::

      # Remove items from select
      removeItems = item1,item2,item3

::

      # Add new items to select
      addItems {
        item1 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item1
        item2 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item2
        item3 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item3
      }

::

      # Rename existing items
      altLabels {
        item1 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item1
        item2 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item2
        item3 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item3
      }
    }

Property:

::

    [tablename].[field].[dataStructKey].[flexSheet].[flexField].config.[key]

Data type:

::

    string / array

Description:

::

    This setting allows to override FlexForm field configuration.

::

    Depending on the $TCA type of the field, the allowed keys are:
      * input:  size, max
      * text:   cols, rows, wrap
      * check:  cols, showIfRTE
      * select: size, autoSizeMax, maxitems, minitems
      * group:  size, autoSizeMax, max_size, show_thumbs, maxitems, minitems, disable_controls

--------------

Section: Page TSconfig Table (new): ->TCEFORM_flexformSheet
Introduction: Properties for the TCEFORM FlexForm sheet configuration
object (see ->TCEFORM section above).

--------------

Section: Page TSconfig Table: ->TCEFORM_flexformSheet add at the end of
the table:

Property:

::

    disabled

Data type:

::

    boolean

Description:

::

    If set, the FlexForm sheet is not rendered. One sheet represents one tab in plugin configuration.

::

    Example:

::

    TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF {
      # The tab with key "sDEF" of the FlexForm plugin configuration is now hidden
      disabled = 1
    }

Property:

::

    title

Data type:

::

    boolean

Description:

::

    Set title of the tab in FlexForm plugin configuration

::

    Example:

::

    TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF {
      # Rename the first tab of the FlexForm plugin configuration
      title = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF
    }

notificationEmail_subject and notificationEmail_body
----------------------------------------------------

Both options are deprecated now. Instead, translated texts are used for
the according texts automatically, if the needed translations have been
downloaded using the Extension Manager.

.. _changes-for-typo3-4.4-1:

Changes for TYPO3 4.4
=====================

`22701: TYPO3 Core - Remove old_backend [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/22701>`__
----------------------------------------------------------------------------------------------------------------------

Steffen Gebert, 2.7.2010:

User TSconfig->OPTIONS

-  property shortcutFrame has been marked as removed in TYPO3 4.4.
-  property mayNotCreateEditShortcuts: Has been updated as it only
   depends on .shortcutFrame in those TYPO3 versions, where
   .shortcutFrame is present.

.. _notificationemail_subject-and-notificationemail_body-1:

notificationEmail_subject and notificationEmail_body
----------------------------------------------------

Page TSconfig->TCEMAIN

-  properties notificationEmail_subject and notificationEmail_body did
   not have a description. According texts were added.

============================
TCA reference (doc_core_tca)
============================

.. _changes-for-typo3-4.4-2:

Changes for TYPO3 4.4
=====================

None

.. _changes-for-typo3-4.5-2:

Changes for TYPO3 4.5
=====================

`23922: TYPO3 Core - [Feature] TCA tree [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23922>`__ -- *2011-04-18 (olly): Updated the documentation*
------------------------------------------------------------------------------------------------------------------------------------------------------------------------

::

   Section: ['columns'][fieldname]['config'] / TYPE: "select"
   Extend the property "renderMode", add new value to "Keywords are" in the description
     * tree - renders the record structure as tree

   Add a new property "treeConfig"
   Description: Configuration if the renderMode is set to "tree". Either childrenField or parentField has to be set - childrenField takes precedence.
   In general the property "foreign_table" of the basic select type must be set to enable the tree.

    Sub-properties:
    * childrenField (string): Field name of the foreign_table that references the uid of the child records (either child
    * parentField (string): Field name of the foreign_table that references the uid of the parent record
    * rootUid (integer, optional): uid of the record that shall be considered as the root node of the tree. In general this might be set by Page TSconfig
    * appearance (array, optional)
      * showHeader (boolean): Whether to show the header of the tree that contains a field to filter the records and allows to expand or collapse all nodes
      * expandAll (boolean): Whether to show the tree with all nodes expanded
      * maxLevels (integer): The maximal amount of levels to be rendered (can be used to stop possible recursions) 
      * nonSelectableLevels (list, default "0"): Comma separated list of levels not be selectable, by default the root node (which is "0") cannot be selected

   Example:
   // Render the General Record Storage Page of pages as tree:
   t3lib_div::loadTCA('pages');
   $tempConfiguration = array(
       'type' => 'select',
       'foreign_table' => 'pages',
       'size' => 10,
       'renderMode' => 'tree',
       'treeConfig' => array(
           'expandAll' => true,
           'parentField' => 'pid',
           'appearance' => array(
               'showHeader' => TRUE,
           ),
       ),
   );
   $TCA['pages']['columns']['storage_pid']['config'] = array_merge(
       $TCA['pages']['columns']['storage_pid']['config'],
       $tempConfiguration
   );

`24361: TYPO3 Core - t3ver_stage should be int(11) instead of tinyint(4) [Closed; assigned to Tolleiv Nietsch] <https://forge.typo3.org/issues/24361>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

t3ver_stage should have the type "int(11)" besides that the meaning
changes since everything > 0 now references an actual "workspace stage"
record. In addition to that it can have the values "0" which still
refers to "edit", "-10" now refers to "ready to publish". Users should
never really use these values to refer to these states, they should use
the constants Tx_Workspaces_Service_Stages::STAGE_EDIT_ID,
Tx_Workspaces_Service_Stages::STAGE_PUBLISH_ID

========================
Core APIs (doc_core_api)
========================

doc_core_api (4.4)
==================

`22000: TYPO3 Core - ExtDirect API [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/22000>`__
-----------------------------------------------------------------------------------------------------------------

Ext Direct Wiki Page [outdated wiki link]

`22319: TYPO3 Core - Add Viewport layout to BE [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/22319>`__
-----------------------------------------------------------------------------------------------------------------------------

Wiki Page [outdated link]

`22642: TYPO3 Core - Rewrite of the debug panel (More Features!, More Stability!, More Usability!) [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/22642>`__
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Wiki Page [outdated link]

doc_core_api (4.5)
==================

`24071: TYPO3 Core - Support for Custom Navigation Components [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/24071>`__
--------------------------------------------------------------------------------------------------------------------------------------------

Wiki Page [outdated link]

Extension Architecture
----------------------

**ext_emconf.php**

[1] [outdated link]

::

   key: docPath
   data type: string
   description: Path to manual.swx. Path is relative to extension directory and has no trailing slash. If not defined, the docPath is "doc"
                Example: 'docPath' => 'ressources/documentation',

`23768: TYPO3 Core - API for Trees and ContextMenus [Closed; assigned to Steffen Kamper] <https://forge.typo3.org/issues/23768>`__
----------------------------------------------------------------------------------------------------------------------------------

| **Pagetree documentation**

| **Tree API UML Diagram**

`UML
Diagram <https://forge.typo3.org/attachments/download/4028/Tree_UML_Diagram__6_.png>`__

| **Context Menu API UML Diagram**

`UML
Diagram <https://forge.typo3.org/attachments/download/4025/ContextMenu_Diagram__1_.png>`__

`23735: TYPO3 Core - Create a new API based on SwiftMailer to replace t3lib_htmlmail [Closed; assigned to Ernesto Baschny] <https://forge.typo3.org/issues/23735>`__
--------------------------------------------------------------------------------------------------------------------------------------------------------------------

Since 4.5 TYPO3 provides a RFC compliant mailing solution, based on
SwiftMailer. In the Install Tool ("All Configuration") several settings
affect the sending process:

-  $TYPO3_CONF_VARS['MAIL'][transport] =

   -  'mail': default and backwards compatible setting. This is the most
      unreliable option. If you are serious about sending mails,
      consider using "smtp" or "sendmail".
   -  'smtp': Sends messages over SMTP. It can deal with encryption and
      authentication. Requires a mail server and configurations in
      transport_smtp_\* settings. Works exactly the same on Windows,
      Unix and MacOS.

      -  [transport_smtp_server]: <server:port> of mailserver to connect
         to. <port> defaults to "25".
      -  [transport_smtp_encrypt]: Connect to the server using
         encryption and TLS. Requires openssl library.
      -  [transport_smtp_username]: If your SMTP server requires
         authentication, the username.
      -  [transport_smtp_password]: If your SMTP server requires
         authentication, the password.

   -  'sendmail': Sends messages by communicating with a locally
      installed MTA - such as sendmail. See setting
      transport_sendmail_command.

      -  [transport_sendmail_command]: The command to call to send a
         mail locally. The default works on most modern UNIX based mail
         server (sendmail, postfix, exim)

   -  'mbox': This doesn't send any mail out, but instead will write
      every outgoing mail to a file adhering to the RFC 4155 mbox
      format, which is a simple text file where the mails are
      concatenated. Useful for debugging the mail sending process and on
      development machines which cannot send mails to the outside.

      -  [transport_mbox_file]: The file where to write the mails into.
         Path must be absolute.

**Creating Mails**

This is how to generate and send a mail in TYPO3 starting with 4.5:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $mail = t3lib_div::makeInstance('t3lib_mail_Message');
      $mail->setFrom(array($email => $name))
           ->setTo(array($email => $name))
           ->setSubject($subject)
           ->setBody($body)
           ->send();

Or if you prefer, don't concatenate the calls:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $mail = t3lib_div::makeInstance('t3lib_mail_Message');
      $mail->setFrom(array($email => $name));
      $mail->setTo(array($email => $name));
      $mail->setSubject($subject);
      $mail->setBody($body);
      $mail->send();

**Adding Attachments**

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        // Create the attachment
          // * Note that you can technically leave the content-type parameter out
      $attachment = Swift_Attachment::fromPath('/path/to/image.jpg', 'image/jpeg');

          // (optional) setting the filename
      $attachment->setFilename('cool.jpg');

          // Attach it to the message
      $mail->attach($attachment);

**Adding Inline Media (e.g. Images)**

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        // Attach the message with a "cid"
      $cid = $mail->embed(Swift_Image::fromPath('image.png'));

          // Create a HTML body refering to it
      $mail->setBody(
          '<html><head></head><body>' .
              '  Here is an image <img src="' . $cid . '" alt="Image" />' .
              '  Rest of message' .
              ' </body></html>',
          'text/html' //Mark the content-type as HTML
      );

**Default Sender**

For mails generated by TYPO3, a configuration option in the Install Tool
allows the user to define a default email sender ("From:").

-  $TYPO3_CONF_VARS['MAIL'][defaultMailFromAddress]
-  $TYPO3_CONF_VARS['MAIL'][defaultMailFromName]

To make use of this setting in your extension, use the following code:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $from = t3lib_utility_Mail::getSystemFrom();
      $mail = t3lib_div::makeInstance('t3lib_mail_Message');
      $mail->setFrom($from);
      ...

**Documentation Details**

For more information about available methods for creating messages,
refer to SwiftMail documentation:

-  http://swiftmailer.org/docs/messages [outdated link]: Content,
   attachments, basic headers
-  http://swiftmailer.org/docs/headers [outdated link]: Adding and
   manipulating complex or custom headers

**Deprecated Methods**

All other ways of sending emails in TYPO3 have been deprecated in 4.5,
since they don't generate RFC conformant emails or don't allow flexible
sending configuration:

-  t3lib_htmlmail: Deprecated.
-  t3lib_utility_Mail::mail(): Deprecated. Calls to it are routed to
   t3lib_mail via a hook, so that the configured transport (e.g. "smtp"
   or "mbox") is also respected for these legacy calls. Please make sure
   you test your mail sending routines before upgrading a production
   site to 4.5!

`24097: TYPO3 Core - Introduce a form protection API [Closed; assigned to Ernesto Baschny] <https://forge.typo3.org/issues/24097>`__
------------------------------------------------------------------------------------------------------------------------------------

The Core now provides a form protection against Cross-Site-Request
Forgery (XSRF/CSRF).

**Using the form protection in the back end**

For each form in the BE (or link that changes some data), create a token
and insert is as a hidden form element. The name of the form element
does not matter; you only need it to get the form token for verifying
it.

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $formToken = t3lib_formprotection_Factory::get()
          ->generateToken('BE user setup', 'edit')
      );
      $this->content .= '<input type="hidden" name="formToken" value="' . $formToken . '" />';

The three parameters $formName, $action and $formInstanceName can be
arbitrary strings, but they should make the form token as specific as
possible. For different forms (e.g. BE user setup and editing a
tt_content record) or different records (with different UIDs) from the
same table, those values should be different.

For editing a tt_content record, the call could look like this:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $formToken = t3lib_formprotection_Factory::get()
          ->generateToken('tt_content', 'edit', $uid);

At the end of the form, you need to persist the tokens. This makes sure
that generated tokens get saved, and also that removed tokens stay
removed:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      t3lib_formprotection_Factory::get()->persistTokens();

In BE lists, it might be necessary to generate hundreds of tokens. So
the tokens do not get automatically persisted after creation for
performance reasons.

When processing the data that has been submitted by the form, you can
check that the form token is valid like this:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      if ($dataHasBeenSubmitted &&
          t3lib_formprotection_Factory::get()->validateToken(
              (string) t3lib_div::_POST('formToken'),
              'BE user setup', 'edit'
          ) ) {
          // processes the data
      } else {
          // no need to do anything here as the BE form protection will create a
          // flash message for an invalid token
      }

Note that validateToken invalidates the token with the token ID. So
calling validate with the same parameters two times in a row will always
return FALSE for the second call.

It is important that the tokens get validated *before* the tokens are
persisted. This makes sure that the tokens that get invalidated by
validateToken cannot be used again.

**Using the form protection in the install tool**

For each form in the install tool (or link that changes some data),
create a token and insert is as a hidden form element. The name of the
form element does not matter; you only need it to get the form token for
verifying it.

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $formToken = $this->formProtection->generateToken('installToolPassword', 'change');
      // then puts the generated form token in a hidden field in the template

The three parameters $formName, $action and $formInstanceName can be
arbitrary strings, but they should make the form token as specific as
possible. For different forms (e.g. the password change and editing a
the configuration), those values should be different.

At the end of the form, you need to persist the tokens. This makes sure
that generated tokens get saved, and also that removed tokens stay
removed:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $this->formProtection()->persistTokens();

When processing the data that has been submitted by the form, you can
check that the form token is valid like this:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      if ($dataHasBeenSubmitted &&
          $this->formProtection()->validateToken(
              (string) $_POST['formToken'],
              'installToolPassword',
              'change')
      ) {
          // processes the data
      } else {
          // no need to do anything here as the install tool form protection will
          // create an error message for an invalid token
      }

Note that validateToken invalidates the token with the token ID. So
calling validate with the same parameters two times in a row will always
return FALSE for the second call.

It is important that the tokens get validated *before* the tokens are
persisted. This makes sure that the tokens that get invalidated by
validateToken cannot be used again.
