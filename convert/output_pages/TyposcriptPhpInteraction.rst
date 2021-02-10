.. include:: /Includes.rst.txt

.. _typoscript-php-interaction:

============================
TypoScript - PHP Interaction
============================

About
=====

Some of you might have wondered all the time how TYPO3 / Typoscript and
PHP interact with each other. As TYPO3 is a very massive framework this
is really a good question which can't get explained just with a few
words. If you would have to describe someone what TypoScript (TS) is you
could do that by saying:

TypoScript is a descriptive language which defines how a website in
TYPO3 gets rendered. The TS gets parsed and interpreted by PHP. TS
consists of TS objects each of which has its own properties and
functionality and is built up in a tree-like manner. The TS tree gets
traversed via PHP methods (most of them can be found in
*tslib/class.tslib_content*) and depending on the cObjects (TypoScript
objects) which get used very different tasks can get achieved to render
the final content of a page.

In the rest of this document, I will try to explain shortly, how
TypoScript fits into TYPO3 and what it's intentions are.

TypoScript representation in PHP
================================

When you have worked a little bit with TYPO3 and TS, you will surely
know that a piece of TS-code looks somewhat like this:

::

   10 = TEXT
   10.field = title
   10.wrap = <strong> | </strong>
   10.if [not available anymore].isTrue.field = title

Those few lines of TS would output the title of a page/tt_content
element (depending on the actual "context") wrapped in <strong> tags but
only if (``.if``) the current title is set. Otherwise even the
``<strong>``-tags would not be rendered.

When such a structure get's loaded into PHP now, it has to get
represented somehow. As TS builds up tree structures by using the "."
(dot) separation operator the PHP structure also has to represent a
tree. Normally, when you write an FE plugin (**TS is not available in
the BE**), you have a main method which looks like:

::

   function main($content, $conf) {

In this ``$conf`` array you will now find the complete "subtree" of
**plugin.tx_myext_pi1** or whatever your plugin is called. So let us say
we have a TS like:

::

   plugin.tx_myext_pi1 {
     myText = TEXT
     myText {
       field = title
       wrap = <strong> | </strong>
       if.isTrue.field = title
     }
   }

Note that it makes no difference wheter you write:

::

     myText = TEXT
     myText {
       field = title

or what would be the other possibility:

::

     myText = TEXT
     myText.field = title

If you use the brace operator "**{**" it is the same as if you would add
all following properties with an dot operator "**.**" to the specific TS
object.

If you have a look at this TS in your "main()" method using print_r:

::

   print_r($conf)

Now you find out that TS get's parsed into an array by assigning the
"value" of a TS-key/object directly to the same key in an array. And
assigning all "subproperties" of a key to a PHP-array key named
"subkey." - The key of the value with an dot appended.

So the $conf array of the above TS will look like:

::

   $conf = array(
     'myText' => 'TEXT'
     'myText.' => array(
       'field' => 'title'
       'wrap' => '<strong> | </strong>'
       'if.' => array(
         'isTrue.' => array(
           'field' = 'title'
         )
       )
     )
   )

You can build such array "on your own" and then pass them to the TS
rendering methods or you could also just define the appropriate TS in
your TypoScript Template and then use the required subtrees from the
$conf array.

The complete TS tree
====================

If you somewhen want to access some TS variable from elsewhere then your
"local" $this->conf or $conf variable (outside from
plugin.tx_myext_pi1.) you can access **$GLOBALS['TSFE']->tmpl->setup**
which contains the complete TS-tree for the current page.

So if you do a:

::

   print_r($GLOBALS['TSFE']->tmpl->setup['lib.']['parseFunc_RTE.']);

you will get a PHP-tree printout of the complete RTE parsefuncs for
example.

TypoScript interpretation from PHP
==================================

When TYPO3 starts to render the page it simply looks if there is a
"PAGE" TS-cObject on the rootlevel of the TSFE->tmpl->setup variable
which has its ".type" value set to the type currently requested.

| 
| tslib/class.tslib_fe.php (line 1673):

::

          $this->sPre = $this->tmpl->setup['types.'][$this->type];  // toplevel - objArrayName
          $this->pSetup = $this->tmpl->setup[$this->sPre.'.'];

When it finds such a variable it simply calls the a TypoScript
ContentArray rendering method:

| 
| tslib/class.tslib_pagegen.php (line 342):

::

        $pageContent = $GLOBALS['TSFE']->cObj->cObjGet($GLOBALS['TSFE']->pSetup);

The COA method
--------------

This method of a "->cObj" object: **->cObjGet** allows also an extension
programmer to render a so called COA array - which is an TS array of TS
objects each one having a arbitrary number. The numbers decide in which
order the cObjects get rendered.

Such an COA array looks like:

::

   plugin.tx_myext_pi1 {
     myCOA {
       10 = TEXT
       10.field = title
       10.stripHtml = 1
        
       20 = TEXT
       20.field = bodytext
       20.parseFunc = < lib.parseFunc_RTE
     }
   }

where "myCOA" would be the COA (Content Objects Array). Using the
knowledge from above that you will be able to access this variable in
$conf in your FE-plugin and also (possibly) knowing that you can also
access **$this->cObj->** in your FE-plugin - which is a copy of the
original cObj you could easily come yourself to the conclusion that you
could do something like:

::

   $myContent = $this->cObj->cObjGet($conf['myCOA.']);

To render the contents of the above myCOA TS array (note that here
"$conf['myCOA.']" the dot "." is used ("myCOA.") !!! - so the contents
(subtree) of the myCOA array get passed to cObjGet.

The cObj method
---------------

Sometimes you do not want that you have to define such a whole COA when
you simply want to render a single image or text. So what is the way to
render a simple TS object like this one:

::

   plugin.tx_myext_pi1 {
     myImg = IMAGE
     myImg {
       file.import = uploads/tx_myext/
       file.import.field = image
       file.maxW = 400
     }
   }

To render such a "single" cObject there is a special method which you
can find in **tslib/class.tslib_content.php** which also contains all
other TypoScript Object rendering methods.

When you have a look at how the above COA's get rendered (in method
->cObjGet) you will find the line:

tslib/class.tslib_content.php (line 423):

::

            $content.=$this->cObjGetSingle($theValue,$conf,$addKey.$theKey);  // Get the contentObject

What here is done is that simply the type of the object
(TEXT/IMAGE/COA/CONTENT/RECORDS/PAGE/etc.) is passed as the first
parameter of the method and the configuration sub-array/tree as second
parameter. The third parameter is not mandatory but eases debugging.

So when we want to render our above TS we would have to do the following
call in your FE-plugin:

::

   $myImgCode = $this->cObj->cObjGetSingle($conf['myImg'], $conf['myImg.']);

Again note where the dot "." is used and where not. You could also call
the method with "IMAGE" hardcoded:

::

   $myImgCode = $this->cObj->cObjGetSingle('IMAGE', $conf['myImg.']);

Which would force the user of your extension to place TS-code for an
IMAGE TS-Object into the TS-key ".myImg". But this rather only inhibits
more functionality of your extension and you should have real good
reasons for doing this.

The stdWrap mystery
-------------------

Another "mysterious" companion of this tslib_content.php monster is the
often seen and mostly never really understood miracle of ".stdWrap".
Some TYPO3 damaged people even start to jump up and run away from their
computers if they see that some TS-value has "stdWrap" properties.

As each cObject has it's own specific "functionality" (It does
something, IMAGE cares about pictures, PAGE cares about <head> and
stuff) stdWrap is also somehow just like a cObject. But instead of
defining some object of specific type stdWrap is a method which is used
in some (a lot) of places in TypoScript.

Whenever the programmer of some TS-Objects (mostly Kasper) or someone
who extended those objects thought that it would be a clever idea that a
TS-Programmer (T3 Administrator) should be able to "generate" a value
somehow he passed the respective TS key(s) through stdWrap.

Let's have a look for example at the "CONTENT" cObject. From the
documentation on typo3.org about CONTENT cObjects
(`CONTENT <https://typo3.org/documentation/document-library/core-documentation/doc_core_tsref/current/view/8/9/>`__
[not available anymore]) you can see that it has a property "select"
(`select <https://typo3.org/documentation/document-library/core-documentation/doc_core_tsref/current/view/5/5/>`__
[not available anymore]) which again has subproperties.

Two of those subproperties are "uidInList" and "pidInList". When you
look at the datatype they have you see that "pidInList" has /stdWrap.
This means that the contents of "pidInList" (and "pidInList.") get
passed trough stdWrap. This is again done with a function call similar
to the above for cObjGetSingle:

tslib/class.tslib_content.php (line 6540):

::

      $conf['pidInList'] = trim($this->stdWrap($conf['pidInList'],$conf['pidInList.']));

Here the 'pidInList' value and 'pidInList.' sub-array of the $conf array
(which at this place contains only the "select." subtree) get passed to
the stdWrap method. Whenever this happens you can do a lot of possible
things with the value which get's generated. For an overview over all
the possiblities just take look at the stdWrap definition at typo3.org
(`stdWrap <https://typo3.org/documentation/document-library/core-documentation/doc_core_tsref/current/view/5/1/>`__
[not available anymore])

I guess the reason why Kasper has inserted a picture from the code of
stdWrap there is that you should simply look up what stdWrap does
exactly in which order directly in the code (cause the order of how
stdWrap performs the specific actions is not defined by the order in the
TS but rather hardcoded).

You can find the stdWrap method in tslib/class.tslib_content.php (line
3133)

So what can you do now with this stdWrap. If you had a look at the
stdWrap documentation on typo3.org you could have found out that it has
as ".field" property. You have surely used this often - and you should
know that in (mostly?) all cases when you can do something like:

::

   bla.whatever.field = title

that "bla.whatever" is of type "stdWrap" and you can also use all other
stdWrap properties instead of (or in conjunction with) ".field"

And what exactly get's done in stdWrap can't get described in this
little document. If you know how this TS-PHP Array is built up and know
a little bit of PHP you will surely find your way in the stdWrap method,
understand how it works and get your job done. All after all it simply
checks if specific subkeys are set and when they are set different
actions get performed with the defined values.

Accessing data
--------------

You possibly wondered already where stdWrap get's its data from when you
use ".field = title". It will then fill the "current" value of the
stdWrap value with the contents of the "title" field - but of which
"title" field you may ask.

When the page rendering gets started an initial $cObj is instanciated in
$GLOBALS['TSFE']->cObj. This cObj is "started" with the contentes/row
from the currently viewed page (with all languages and workspaces
overlaid).

tslib/class.tslib_fe.php (line 3404):

::

      $this->cObj->start($this->page,'pages');

$this->page of TSFE (in which class this happens) contains the current
page record and when the $cObj->start($data) method is called with an
"one-dimensional" array before usage then the cObj internal variable
**this->data** gets set to the passed array. Whenever you now access
some fields from within TS-Objects rendered by this cObject (**remember:
TS-Objects get rendered by PHP-cObjects**) then just $this->data is
accessed:

function getFieldVal() tslib/class.tslib_content.php (line 4752):

::

          if (strcmp($this->data[$k],)) return $this->data[$k];

So when you want to access you own records in your extension when you
let them get rendered by own TS you will have to do something like:

::

   $this->cObj->start($myRow, 'tx_mytable_images');
   $myImgCode = $this->cObj->cObjGetSingle($conf['myImg'], $conf['myImg.']);

And if you then use appropriate TS code like:

::

   plugin.tx_myext_pi1 {
     myImg = IMAGE
     myImg {
       file.import = uploads/tx_myext/
       file.import.field = tx_myimagefield
   # Also possible (remove above 2 lines):
   #    file.import.dataWrap = uploads/tx_myext/{ field : tx_myimagefield }
       file.maxW = 400
     }
   }

You will import the field which is found in the field "tx_myimagefield"
in the row $myRow.

Note that you can not only use the values from the $this->data array of
$cObj with .field but also with the { field : bla } construct of
.dataWrap

A bigger view
=============

When you now have a look at the TS-Tree using the TypoScript Object
Browser in the Web > Template module you will find out that there is a
root-level object called "tt_content".

This root-level TS object consists of a main "CASE" cObject and a lot of
small sub-CObjects. The purpose of this cObject is to render a complete
element from tt_content.

Internally just the $row from tt_content get's loaded into the $cObj
using the ->start($row) method and then "tt_content/tt_content." get
rendered. The TS-code in "tt_content." uses the values found in the
current ->data array using ".fields" and other constructs to render the
complete Content-Element.

In fact the above thing: Rendering a list of records - is again
implemented by a TS-cObject. The so called "CONTENT" object. This
"CONTENT" object simply fetches rows from the database (we used this
also in the above example to explain stdWrap) and then renders them
using a TS cObj.

If you take a look at how "styles.content.get" is defined for example
you will notice what is done here:

typo3/sys ext/css_styled_content/static/setup.txt (line 10):

::

   styles.content.get = CONTENT
   styles.content.get {
     table = tt_content
     select.orderBy = sorting
     select.where = colPos=0
     select.languageField = sys_language_uid
   }

And if you read the documentation about the CONTENT cObject on typo3.org
(`CONTENT <https://typo3.org/documentation/document-library/core-documentation/doc_core_tsref/4.6.0/view/1/7/#id2635332>`__
[not available anymore]) you will note that when no "renderObj" is
given. To cite typo3.org :

ok... you will not notice it because this information is missing in this
place. But if you look at the RECORDS cObject
(`RECORDS <https://typo3.org/documentation/document-library/core-documentation/doc_core_tsref/4.6.0/view/1/7/#id2635539>`__
[not available anymore]) you'll find there:

::

   If this is NOT defined, the rendering of the records is done with the toplevel-object [tablename] - just like the cObject, CONTENT!

Meaning: You can set ".renderObj" of CONTENT to

::

   10 = CONTENT
   10.table = tt_content
   10.select.uidInList = 123
   # This lines important:
   10.renderObj = TEXT
   10.renderObj.field = header

Which will result in letting the header field of tt_content element 123
get rendered. And as in the case of "styles.content.get" renderObj is
not defined it get's done with the top-level cObject named after the
table - and we already know that there is a huge CASE statement named
"tt_content".

So you should now have a little bit more overview of how content gets
rendered in TYPO3.

--------------

`Bernhard
Kraft <https://wiki.typo3.org/wiki/index.php?title=User:Oldkraftb&action=edit&redlink=1>`__
[not available anymore] 16:00, 25 Jun 2006 (CET) [www.think-open.at]
