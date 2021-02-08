.. include:: /Includes.rst.txt

.. _fluidtemplate-by-example:

==============================
T3Doc/Fluidtemplate by example
==============================

.. container::

   notice - Reviewer needed

   .. container::

      Change the **{{review}}** marker to **{{publish}}** when all parts
      are reviewed (e.g. TypoScript).
      `info </Help:Contents#Teamwork_-_draft_review_publish_delete_merge_outdated>`__
      [deprecated wiki link]

A simple Template
=================

This is a very simple example for integrating a one column Pagelayout
with title and menu For the start you create a TYPO3 page (rootlevel
flag on) and a Template-Record inside.

Starting the template in Babysteps
----------------------------------

Set up a page – Typoscript for Beginners
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This is for very Beginners. If you are familiar to Typoscript, jump
this. In the setup-field of the Template-Record you create a Page-Object
and some text-output:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      page = PAGE
      page.5 = TEXT
      page.5.value = This is a Heading

Now in frontend you see your Text: "This is a Heading"

In the second Step we will add CMS-Content to our Page:

In the Template you add the static template "CSS styled content".

And we will also add a CSS-Stylesheet.

Then change your Typoscript:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      page = PAGE
      page.includeCSS {
       # don't forget to upload the css-file into your fileadmin/projectTemplate/ Folder
       file1 = fileadmin/projectTemplate/mystylesheet1.css
      }
      page.5 = TEXT
      page.5.value = <h1>This is the heading of your Website</h1>
      page.10 < styles.content.get

In your page, create Contentelements in the "Normal" column and they are
now rendered in your Website, and css is included. For very simple
websites you might even get along like this, but as soon as we want to
create more complex HTML-layouts, pure typoscript-Templates are too
confusing. we are ...

Ready for Fluidtemplate
-----------------------

We will now create a Fluidtemplate in Typoscript and one first
Template-File.

In the fileadmin folder we create a Project-Template folder – let's call
it projectTemplate, and inside this folder we create a HTML file
index.html

fileadmin/projectTemplate/index.html:

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <h1>My Heading</h1>
      <div class="container">later we see content here</div>

Notice: you MUST write valid xml here or you'll get an error.

and again we change our Typoscript-Template:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      page = PAGE
      page.10 = FLUIDTEMPLATE
      page.10 {
        file = fileadmin/projectTemplate/index.html
      }

In frontend we see the content of our Template. You may find the
complete reference of
`FLUIDTEMPLATE <https://docs.typo3.org/typo3cms/TyposcriptReference/ContentObjects/Fluidtemplate/Index.html>`__.

To fill it with our Contentelements we will add Fluid variables in
Typoscript:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      page = PAGE
      page.10 = FLUIDTEMPLATE
      page.10 {
        file = fileadmin/projectTemplate/index.html
        variables {
          content < styles.content.get
          contentRight < styles.content.getRight
          #variables are nothing but Typoscript-Objects
          sometext = TEXT
          sometext.value = Here's some text.
        }
      }
      #we also create a typoscript-menu
      lib.menu = HMENU
      lib.menu{
        1 = TMENU
        1.NO.wrapItemAndSub = <li>|</li>
      }

and set the variables in our fileadmin/projectTemplate/index.html:

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <h1>{sometext}</h1>
      <div class="container">{content}</div>

First use of Viewhelpers
^^^^^^^^^^^^^^^^^^^^^^^^

So far, but not so good:

In Frontend "sometext" looks normal, but what happened to our
Contentelements??? All messed up with &lg;, >, ....

We again need to do something and add a viewhelper to the
content-variable

fileadmin/projectTemplate/index.html:

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <h1>{sometext}</h1>
      <div class="container">
        <f:format.raw>{content}</f:format.raw>
      </div>

Notice: there are two ways of syntax in Fluid:

-  xml-Syntax like <f:format.raw>{content}</f:format.raw>
-  inline-Syntax like {content->f:format.raw()}

Both will result in the same Output.

Let's also add the menu (don't forget to create subpages to your Page).

We don't need the menu as a variable, we have the cObject-viewhelper

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <h1>{sometext}</h1>
      <ul id="nav"><f:cObject typoscriptObjectPath="lib.menu" /></ul>
      <div class="container">
        <f:format.raw>{content}</f:format.raw>
      </div>

Viewhelpers with arguments (first challenge)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For a more complex example of viewhelpers we will now crop the
content-text:

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <h1>{sometext}</h1>
      <div class="container">
        <f:format.crop maxCharacters="70">
          <f:format.raw>{content}</f:format.raw>
        </f:format.crop>
      </div>

So we use the f:format.crop viewhelper with the argument
maxCharacters="70" .

in Inline-Syntax:

{content->f:format.raw()->f:format.crop(maxCharacters:70)}

Notice the Difference and never forget the ()...

Finding out more about Viewhelpers
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Quick reference / Cheatsheet: `Fluid <fluid>`__

The definitive ViewHelper Reference is here (it also contains
viewHelpers which are only relevant for extension).
`[1] <https://docs.typo3.org/flow/TYPO3FlowDocumentation/stable/TheDefinitiveGuide/PartV/FluidViewHelperReference.html>`__
[not available anymore]

Taking Page-Data from the {data}-Object
---------------------------------------

With Fluidtemplate we do not need to prepare Pagetitle etc. in
Typoscript, we can add them directly using the {data}-Variable. This
variable contains page-Information ( debug it to check out the whole
thing. you can easily do this in fluid like this: )

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:debug title="Data-Variable">{data}</f:debug>
      <!-- this will render the page-title: -->
      <h1>{data.title}</h1>

Conditions
----------

In Fluid, you can add basic functionality to a template by using the
f:if-Viewhelper

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:if condition="{contentRight}">
        <aside class="rightcol">{contentRight->f:format.raw()}</aside>
      </f:if>

If needed you can write a if-then-else-logic, find out more here:
`Fluid <fluid>`__

Structure your code with partials
=================================

let's add some more content from the data-Object in some Sidebar-Boxes:

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <div class="box box-blue">
        <h3>Abstract</h3>
        <div class="contains">
          {data.abstract->f:format.html()}
        </div>
      </div>
      <div class="box box-red">
        <h3>Subpages</h3>
        <div class="contains">
          <f:cObject typoscriptObjectPath="lib.subMenu" />
        </div>
      </div>

We realize this is nearly the same HTML-Structure that we use twice
here. Fluid gives us the possibility clean up our HTML-code, by the use
of Partials.

So we create a new folder inside our Template-Folder in fileadmin and
call this folder "Partials". Inside the Partials-Folder we create a new
html-file "Colorbox.html" and fill it with our Box-Structure. something
like:

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <div class="box box-{boxColor}">
        <h3>{boxHeader}</h3>
        <div class="contains">
          {boxContent}
        </div>
      </div>

Next we tell the Typoscript-Template where to find the Partials-Folder:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      page = PAGE
      page.10 = FLUIDTEMPLATE
      page.10 {
        file = fileadmin/projectTemplate/index.html
        partialRootPath = fileadmin/projectTemplate/Partials/
        variables {
          content < styles.content.get
       ...

Now finally we can use our Partial in
fileadmin/projectTemplate/index.html

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <!-- we replace the code above -->
      <f:render partial="Colorbox" arguments="{boxHeader : 'Abstract', boxContent : '{data.abstract->f:format.html()}', boxColor : 'blue'}" />
      <f:render partial="Colorbox" arguments="{boxHeader : 'Subpages', boxContent : '{f:cObject(typoscriptObjectPath:'lib.subMenu')->f:format.raw()}', boxColor : 'red'}" />

Notice: Partials are kind of stupid. Unlike your template-file they
don't recognize {data} or the variables from Typoscript, but only the
arguments you pass them in the render-tag.

The Layout-Switch
=================

So far we have a working Fluidtemplate. Some weeks later your Client
calls to order the same website for her brench in another town. You
might copy the Fluidtemplate-file and do just some changes there like
you maybe have done in the times of "Modern Template Building", but
think of the future, adding the same changes to all these files – and
you don't need to because Fluid offers you the concept of Layouts.

The Principle
-------------

To understand the layout-concept, imagine your basic template containing
a tag which Layout to use, and some Fragments to be composed in the
Layout. Then you have the Layout containing some composition-markup and
well-wrapped, the Sections from your Basic Template. It looks like this:

Example
-------

Typoscript:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      page.10 {
        file = fileadmin/projectTemplate/index.html
        partialRootPath = fileadmin/projectTemplate/Partials/
        layoutRootPath = fileadmin/projectTemplate/Partials/
        settings.layout = Nuremberg 
        #settings works from TYPO3 6.1 - otherwise do it the variables-way
        variables {
          content < styles.content.get
      ...

Template: fileadmin/projectTemplate/index.html

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:layout name="{settings.layout}" />

      <f:section name="topMenu">
        <ul id="nav"><f:cObject typoscriptObjectPath="lib.menu" /></ul>
      </f:section>

      <f:section name="content">
      {content->f:format.raw()}
      </f:section>

      <f:section name="contentRight">
        <f:if condition="{contentRight}">
          <aside class="rightcol">{contentRight->f:format.raw()}</aside>
        </f:if>
      </f:section>

      <f:section name="pageInfoBoxes">
        <f:render partial="Colorbox" arguments="{boxHeader : 'Abstract', boxContent : '{data.abstract->f:format.html()}', boxColor : 'blue'}" />
        <f:render partial="Colorbox" arguments="{boxHeader : 'Subpages', boxContent : '{f:cObject(typoscriptObjectPath:'lib.subMenu')->f:format.raw()}', boxColor : 'red'}" />
      </f:section>

Layout: fileadmin/projectTemplate/Layouts/Nuremberg.html

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <header>
        <h1>
          <f:link.page pageUid="2" title="Nuremberg Shop">Nuremberg Shop</f:link.page>
        </h1>
        <f:render section="topMenu" />
      </header>
      <div class="row">
        <div class="span8">fileadmin/.../Layouts/
          <f:render section="content"/>
        </div>
        <div class="span4">
          <f:if condition="contentRight">
            <f:then><f:render section="contentRight"/></f:then>
            <f:else><f:render section="pageInfoBoxes"/></f:else>
          </f:if>
        </div>
      </div>
      <footer>
      <!-- here some stuff for footer... -->
      </footer>
