.. include:: /Includes.rst.txt

.. _fce:

===============
TemplaVoila/FCE
===============

<< Back to `Administrators <overview-administrator-manuals>`__ page

`[edit] <https://wiki.typo3.org/wiki/index.php?title=TemplaVoila/FCE&action=edit&section=0>`__
[deprecated wiki link]

| This is the continuing part of the `Futuristic Template
  Building <https://wiki.typo3.org/wiki/index.php?title=TemplaVoila/FTB1&action=edit&redlink=1>`__
  [not available anymore] document.

.. container::

   warning - Merge

   .. container::

      This page should be **merged** with the page `The content of this
      page was imported from the TER-extension - check the changes and
      update the original
      document <https://wiki.typo3.org/wiki/index.php?title=The_content_of_this_page_was_imported_from_the_TER-extension_-_check_the_changes_and_update_the_original_document&action=edit&redlink=1>`__
      [not available anymore]

Flexible Content Elements
=========================

Now you have seen how TemplaVoila provides a point'n'click interface to
templating the overall structure of a TYPO3 based website. And why not
take this concept to other levels!

A natural extension is that a new kind of content element is born - a
content element of the type "Flexible Content" - or "Flexible Content
Element" (FCE).

This kind of element has an arbitrary amount of data fields using
FlexForms and Data Structures. On top of it all it is rendered in the
frontend using Template Objects.

For our example here there is a template file which contains a set of
templates for such "Flexible Content Elements"; template_ce.html. It
looks like this inside:

| 
| https://typo3.org/typo3temp/pics/09fd152afa.png [outdated image]

The idea is that a single file contains small templates for numerous
Flexible Content Elements - this is to save space and present them in a
"natural environment".

Creating a basic Flexible Content Element (FCE)
===============================================

First we will create a Flexible Content Element (FCE) with a Header,
Text, Image and a link.

The first step is - like with the page template - to go to the File >
Filelist module, click the template file, select "TemplaVoila" and then
begin to build the Data Structure that fits our needs. We will do so
here as well.

**Hint:** If you experience that old mapping information is shown to you
in the module, then just press "Clear all" and it will be gone.

The ROOT element
----------------

When mapping the ROOT element you will have to choose differently than
the <body> tag for once. Because in this case the container element is
not the <body> tag but the

.. container::

   tag which has been wrapped around each FCE for convenience and order:
   | 
   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/10000000000001F2000001477FE33D1E.png
     [outdated image]

   .. rubric:: Child elements
      :name: child-elements

   Then you create the fields you need in the DS:

   | 
   | https://typo3.org/typo3temp/pics/b73ce023f0.png [outdated image]

   For each of these we have been a bit too lazy to supply good mapping
   instructions, rules and sample data. This is what happens... :-)

   We have a few comments though:

   -  **Fieldnames:** Notice the "Link Title" field - that has become a
      field name "field_94bd82" which is random. AVOID THIS! Rather
      delete such an entry and use carefully designed names. In
      particular, REUSE those fieldnames across your collections of FCEs
      since that enhances the internal compatibility.
   -  **Editing Types:** For each fieldname we have selected an Editing
      Type. The Editing Types are presets which defines what default
      configuration the element will get in the DS. An example we
      already know was how to set editing type to "Content Element" or
      "TypoScript Object Path".
      We want to comment on those we have set here:
   -  **Header:** The Editing Type is "Header field" - this will be the
      same as plain input although it might allow for a
      `typolink <https://docs.typo3.org/typo3cms/TyposcriptReference/Functions/Typolink>`__
      [not available anymore]
   -  **Bodytext:** The Editing Type is "Text area for bodytext"
   -  **Image:** The Editing Type is "Image field". Another option was
      "Image field, fixed W+H" but selecting "Image field" will allow us
      to insert an image and if TemplaVoila's logic can figure it out it
      will detect the current width of the image and use that as fixed
      width - that is nice!
   -  **Link title:** Plain input.
   -  **Link URL:** The Editing Type is "Link field" - this will make a
      little box with a link selector wizard which lets us select a link
      as usual. It will also preset the TypoScript needed to make the
      link.

   After mapping is in place it looks like this:

   | 
   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/1000000000000201000000C7BCCBB594.png
     [outdated image]

   Then click "Save" and press "Create TO and DS" button:

   | 
   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/10000000000001250000007B1CA96288.png
     [outdated image]

   .. rubric:: Adding a Flexible Content Element to a page
      :name: adding-a-flexible-content-element-to-a-page

   This is done by Web > Page of course by clicking the "New" icon. At
   some point this will lead you to a wizard! For now you will just get
   a plain element created straight away:

   | 
   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/1000000000000203000000A40EDF9FF6.png
     [outdated image]

   Now, edit this element, select the Type "Flexible Content". This will
   ask you to save which you do. Now you can select a Data Structure.
   When that is done you save again and you will see this form:

   | https://typo3.org/typo3temp/pics/26e04d5ab7.png [outdated image]

   Now, select the Template Object used for the Data Structure - as you
   did for page templates! - and fill in the form with content. You can
   preview immediately with "Save Document and View":

   | https://typo3.org/typo3temp/pics/f57c405373.png [outdated image]

   Result:

   | 
   | https://typo3.org/typo3temp/pics/5671c778da.png [outdated image]

   .. rubric:: Something we forgot
      :name: something-we-forgot

   It turns out that we forgot to add possible header parts to the TO
   record. Lets do that:

   | 
   | https://typo3.org/typo3temp/pics/64c3740c2b.png [outdated image]

   This time we avoid the two first stylesheet definitions because they
   are just a part of the main template which happens to wrap these
   examples of elements; no need to select them again - even though it
   wouldn't make any difference since they are automatically detected as
   included if they are *exactly* the same.

   Then, the last stylesheet is not included either - we happen to know
   that it contains styles which are *only* active for the last
   template.

   .. rubric:: Adding image parameters
      :name: adding-image-parameters

   Another problem is that the image tag of the image has *not* been
   preserved but re-generated by TYPO3. And in that process we lost a
   few attributes, in particular ' align="right" style="margin-left:
   10px; margin-right: 5px;"'

   These can be added again by editing the Data Structure - which will
   reveal something - to us very appealing - namely, TypoScript:

   | 
   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/10000000000001F3000000D35668E105.png
     [outdated image]

   Here we just modify the code listing with a single line (the one
   highlighted above):

   .. container::

      `TS
      TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
      [deprecated wiki link]

   .. container::

      ::

          10.params = align="right" style="margin-left: 10px; margin-right: 5px;"

   That does it and the image is now displayed correctly:

   | 
   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/10000000000001A70000011D539F348F.png
     [outdated image]

   .. rubric:: The link
      :name: the-link

   Another note to this example is that the header and the image has
   automatically picked up the data from the link URL field as link
   source - this is just the default behavior, you can of course remove
   and customize it all - in the Data Structure of this FCE:

   .. container::

      `XML /
      HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
      [deprecated wiki link]

   .. container::

      ::

          <T3DataStructure>

   NOT RENDERED: *TEXT:SECTION*

   .. rubric:: No "Flexible content" occurence in "new content element"
      :name: no-flexible-content-occurence-in-new-content-element

   When going to "Homepage" and selected "green iconpage", clik on
   "create new record" but no choice in "Flexible content" So create
   "Regular text element" and change after .. the type .. Anybody knows
   why?Date: **10-02-2004 11:04** by **dieter**

   .. rubric:: XML and Mapping field_94b82
      :name: xml-and-mapping-field_94b82

   XML is almost unreadable because of to wide tab indent settings. How
   to change? Same for xml-printout on page 55. Tab setting of 2 would
   be fine. Page 49, "Child elements": Mapping for Items
   Root..field_image are clear, but give a hint which field to map for
   field_94b82 and field_linkurl.

   .. rubric:: Creating a "grid" Content Element
      :name: creating-a-grid-content-element

   With TemplaVoila you might not even need to consider a two-column
   layout of a page for something you add on the page template level -
   you can just as well integrate it with a content element being the
   placeholder for two columns. This is the case in the next example:

   | 
   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/10000000000001A60000010C07F38D89.png
     [outdated image]

   The mapping process is the same as above, just remember to clear the
   old mapping first...:

   | https://typo3.org/typo3temp/pics/4a99cc458e.png [outdated image]

   For each field we chose "Content Element" for Editing type.

   Then we save:

   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/10000000000001300000007A424C2711.png
     [outdated image]

   On the page from before we can now create a new FCE based on the DS
   "FCE - 2 Columns":

   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/10000000000001E7000000BCAAB1B15A.png
     [outdated image]

   Of course this will yield a form like this with two form fields ...

   | https://typo3.org/typo3temp/tx_terdoc/documentscache/d/o/doc_tut_ftb1-1.0.1/docbook/pictures/10000000000001EF0000012CC31A12C4.png
     [outdated image]

   ... which we will leave over to the Web > Page module to fill in:

   | 
   | (BUT remember to set the "Template Object" field!!!)

   | 
   | https://typo3.org/typo3temp/pics/90521cc2e8.png [outdated image]

   Of course we will move the current element into one of the columns as
   shown above (Click #1, then #2) and the result is:

   | 
   | https://typo3.org/typo3temp/pics/12e7174440.png [outdated image]

   .. rubric:: Forgot the template?
      :name: forgot-the-template

   It is very easy to forget to set the TO value after having set the DS
   value. If you forget it you just get a blank spot - which is rather
   confusing.

   .. rubric:: What's td for field_ce_right
      :name: whats-td-for-field_ce_right

   https://typo3.org/doc.0.html?&tx_extrepmgm_pi1 [not available
   anymore][extUid]=1332&tx_extrepmgm_pi1[tocEl]=4138&cHash=0691c16591
   Not clear how to select Inner for field_ce_right and field_ce_left.
   The td's are there in the template, but no tag-icons are displayed
   for these.. Added later: ok, got it, disambiguate sentence "The
   mapping process is the same...." by adding something: this time,
   select the of the "Two column view" as the root. I cleared all, but
   reselected the "This is the header" div "same as before".

   .. rubric:: Creating an alternative template for the 2-columns FCE
      :name: creating-an-alternative-template-for-the-2-columns-fce

   You have done this before with the main page template - created an
   alternative TO. This basically works by creating just a TO and not a
   DS along. So instead of going to the File > Filelist module and
   starting TemplaVoila's mapping engine from there you should just go
   to the sysFolder, create a TO record, set the template filename and
   map it:

   | 
   | https://typo3.org/typo3temp/tx_oodocs_ab70533360.png [outdated
     image]

   Then to and map the TO:

   | 
   | https://typo3.org/typo3temp/tx_oodocs_3c3d8a7a19.png [outdated
     image]

   Don't forget to include the custom style section:

   | 
   | https://typo3.org/typo3temp/tx_oodocs_6dac39a109.png [outdated
     image]

   Then, press "Save".

   You might want to add icons for the TO and DS just like you did for
   the page templates.

   .. rubric:: Using the Alternative template
      :name: using-the-alternative-template

   Now, edit the "2 Column" content element you have created:

   | 
   | https://typo3.org/typo3temp/tx_oodocs_ae73a3de88.png [outdated
     image]

   Then you see that there are now two templates for the "FCE - 2
   columns" data structure:

   | 
   | https://typo3.org/typo3temp/tx_oodocs_4f8b987c75.png [outdated
     image]

   | https://typo3.org/typo3temp/tx_oodocs_c82af41d22.png [outdated
     image]

   We have also added DS and TO icons here. The DS icons still convey
   the overall concept of the possibilities of the element while we have
   communicated the difference in the background color of the two
   templates for the TOs.

   .. rubric:: Creating an alternative template for the 2-columns FCE
      :name: creating-an-alternative-template-for-the-2-columns-fce-1

   Use "Storage Folder" instead of "sysFolder"

   .. rubric:: Content Element with repetitive data objects
      :name: content-element-with-repetitive-data-objects

   The next example is a little more advanced. The most trivial thing is
   basically the two images and the bodytext. But the header is a
   *graphical header* and below the two fixed images you see a list of
   links *repeated*, even with optional titles in between:

   | 
   | https://typo3.org/typo3temp/tx_oodocs_d51a7bcd55.png [outdated
     image]

   So we can express the data structure that is needed like this:

   -  1 Header - graphical
   -  1 Bodytext
   -  2 Images
   -   ? number of a) Title text *or* b) text-link with image bulleT

   .. rubric:: Mapping the DS and TO
      :name: mapping-the-ds-and-to

   In the File > Filelist module you select TemplaVoila for the template
   file "template_ce.html" and for the ROOT element you map to the

   .. container::

      tag of the block:
      | https://typo3.org/typo3temp/tx_oodocs_86c040f77e.png [outdated
        image]

      Then you create the Header element:

      | 
      | https://typo3.org/typo3temp/tx_oodocs_1b9a4fd034.png [outdated
        image]

      Notice that the header DS element has two significant attributes:

      -  **Fieldname:** It (re-)uses the field name "field_header" -
         thus striving for compliance with other Flexible Content
         Elements (so you can change type of Data Structure without
         loosing the current header information)
      -  **Editing Type:** It uses "Header field, Graphical" - and it
         will try to read image information about the current graphical
         title for the template and use as much information from that as
         possible in order to provide some default GIFBUILDER
         configuration. More details later...
      -  **Mapping rules:** Maps only to <img> tags.

      Do the mapping and you should see:

      | 
      | https://typo3.org/typo3temp/tx_oodocs_0ee1baf325.png [outdated
        image]

      Now, create the elements for bodytext and the two images
      (fieldnames could be "image1" and "image2") by following the way
      you did with the cases in previous chapters:

      | 
      | https://typo3.org/typo3temp/tx_oodocs_50199032a9.png [outdated
        image]

      .. rubric:: Creating the repeatable data objects
         :name: creating-the-repeatable-data-objects

      For the list of links you have to think a few minutes about what
      is required to create this; We have *two basic kinds*; a Title
      element (#1) and a Link element (#2). We want to be able to create
      *any number* of these elements in *any order:*

      | https://typo3.org/typo3temp/tx_oodocs_9ba15319c1.png [outdated
        image]

      In order to realize the involved complexity of templating look at
      this screenshot:

      | 
      | https://typo3.org/typo3temp/tx_oodocs_2639c9dc5c.png [outdated
        image]

      -  **The two inner data objects:** When we are going to do
         templating for the *inner data objects* (Title and Link
         elements) we will map templates from only *one* of the examples
         provided for each (#2 and #3 above) - the additional examples
         below play no role.
      -  **Structure of each inner data object:** Obviously the Title
         element will have at least a "Title" field. Likewise the Link
         element will have at least a "Link title" and "Link URL" field
         - ergo, we have to define each data object as a *collection* of
         fields which go together - this is handled by the DS element
         type called "container".

      | https://typo3.org/typo3temp/tx_oodocs_4f1ab6f813.gif [outdated
        image]

      -  **The container element:** Finally, we have to remember that
         the dynamic content has to go into the overall container
         element of this section (#1). This means we have to create an
         element for this container element so such a substitution can
         occur. This is handled by the DS element type called "section"
         (array + section flag set).

      | https://typo3.org/typo3temp/tx_oodocs_7fdfbfa446.gif [outdated
        image]

      **Creating the "section" DS element:**

      In the mapping process we first create a "section" DS element:

      | 
      | https://typo3.org/typo3temp/tx_oodocs_16efc804e5.png [outdated
        image]

      Notice that such a "Section" element (SC) must be created by first
      creating a "Container" element (CO) and then re-editing and
      selecting the flag "Make this container a SECTION!". See above.

      Now, do the mapping by clicking the

      .. container::

         tag which the designer has gently wrapped the link list in:
         | 
         | https://typo3.org/typo3temp/tx_oodocs_95fb8da8b9.png
           [outdated image]

         Select the "INNER" mapping mode. After doing that you will see
         the Link container section and a field to add DS elements on a
         *new level* in the structure!

         | https://typo3.org/typo3temp/tx_oodocs_c174b9c7e5.png
           [outdated image]

         Create the field "field_do_title" ("do" for "Data Object").
         This time, make it a "Container for elements" (but do *not*
         re-edit and check the section flag of course).

         | https://typo3.org/typo3temp/tx_oodocs_bfd996c378.png
           [outdated image]

         And the same for "field_do_link":

         | https://typo3.org/typo3temp/tx_oodocs_12d82abad1.png
           [outdated image]

         The result should be:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_5d38f5844d.png
           [outdated image]

         Now, for each of the two "data objects" - or "Containers for
         elements" - you create a Title field (for the "Title element")
         and Link title / Link URL fields for the "Link element". In the
         case of the Link URL field you should select the DS Element
         type "Attribute" (since you want to map it to the attribute of
         an <a>tag; <a href="">). The result will be:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_dc59c04da9.png
           [outdated image]

         .. rubric:: Mapping the hierarchical structure
            :name: mapping-the-hierarchical-structure

         | Then you begin to map. For the "[CO] Title element" you map
           it into the tag which apparently is the "container" tag for
           the text:
           https://typo3.org/typo3temp/tx_oodocs_5a6772f0aa.png
           [outdated image]
         | Notice: In this case you want to make an "OUTER" mode mapping
           - since you want to include the <p> tags in the Title element
           container:
           https://typo3.org/typo3temp/tx_oodocs_e1c34c9dc8.png
           [outdated image]
         | Now, you do the same for the Link element, also clicking the
           <p> tag which contains the whole data object:
           https://typo3.org/typo3temp/tx_oodocs_a41efe23ad.png
           [outdated image]
         | Do the same as for the Title element regarding mapping mode;
           make sure to select "OUTER" (which includes the <p> tag as a
           part of the section. Finally, map the header, titles and
           links attributes (as you have done before):
           https://typo3.org/typo3temp/tx_oodocs_7b120e6d5b.png
           [outdated image]
         | For "Link header", click the <p> tag:
           https://typo3.org/typo3temp/tx_oodocs_2415c8bfe9.png
           [outdated image]
         | For "Link title", click the <a> tag:
           https://typo3.org/typo3temp/tx_oodocs_47c8c7d668.png
           [outdated image]
         | For "Link URL" click the <a> (like above) and select the
           "ATTRIBUTE href":
           https://typo3.org/typo3temp/tx_oodocs_c083af916d.png
           [outdated image]
         | The mapping is complete and you should see this result:
           https://typo3.org/typo3temp/tx_oodocs_34bdc3bd28.png
           [outdated image]
         | Now, save the DS and TO you have build. Click the Save button
           and then enter a new name:
           https://typo3.org/typo3temp/tx_oodocs_2963103869.png
           [outdated image]

         .. rubric:: Creating a content element using the new DS / TO
            :name: creating-a-content-element-using-the-new-ds-to

         Well, create a Flexible Content Elements with the Data
         Structure "Header/Text/2xImage/XxLinks" (you might have found a
         better name by now!):

         | https://typo3.org/typo3temp/tx_oodocs_d13652b292.png
           [outdated image]

         After saving the element you will see this form:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_43b624b019.png
           [outdated image]

         We have filled in the form with dummy content as you can see.
         For the Header, Bodytext and the two image fields you see
         nothing new really - except the amazing fact that this totally
         improvised data structure is impossible without adding fields
         to the database but solely with a Data Structure definition
         saving the content into XML... :-)

         But there are two things you should notice especially;

         -  

            #. 1: *Make sure* to select the Template Object - as always!
            #. 2: At the bottom of the form you will see a selector box
               representing our "Section" element - the overall
               container for the link section.

         .. rubric:: Creating multiple data objects in random order and
            amount
            :name: creating-multiple-data-objects-in-random-order-and-amount

         Open the "Link section container" selector. What you see is the
         two "data objects"; "Title element" and "Link element":

         | https://typo3.org/typo3temp/tx_oodocs_699248f3f5.png
           [outdated image]

         For each time you add one of these elements you have to save
         the form. And unfortunately the handling of the order is not
         that flexible at the moment; you are currently working on beta
         version of FlexForms.

         After creating some elements you will see this:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_30b8282199.png
           [outdated image]

         The interface is still a little confusing visually but we will
         soon improve it. Anyways, you can clearly see that we have
         created a link header and two links.

         All you need now is to view the element in the frontend. Should
         look like this:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_632d4b0794.png
           [outdated image]

         As you can see the links are there... :-)

         .. rubric:: Creating a "pseudo-record" list
            :name: creating-a-pseudo-record-list

         This example is basically another example of hierarchical data
         structures. This is your second chance to practice and
         understand the principles from the former case with "repetitive
         data objects".

         In this case we will implement this design as a single content
         element:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_2345c8a550.png
           [outdated image]

         We can express the data structure that is needed like this:

         -  1 Header
         -  1 Description
         -   ? number of "movie-element" consisting of
         -  Title
         -  Description
         -  Link URL
         -  Image (fixed dimensions)

         Contrary to the former element where we had either a title or a
         link as data objects we have only one type here; the
         "movie-element".

         Let's begin the creating of the Data Structure (DS) / first
         Template Object (TO).

         .. rubric:: Creating the DS / TO
            :name: creating-the-ds-to

         The ROOT element of the DS is mapped to the DIV tag which has
         been placed there for that purpose. The header and description
         fields are mapped to the <h1> and <em> tags respectively.

         | `[1] <https://typo3.org/typo3temp/tx_oodocs_5488b0d2c0.png>`__
           [not available anymore]

         The DS looks like this now:

         | 
         | `[2] <https://typo3.org/typo3temp/tx_oodocs_ebf6d2cda8.png>`__
           [not available anymore]

         (Notice, the all have INNER mode which is the most typical when
         mapping content into HTML).

         Next steps is to create a new Section element in the data
         structure. Remember the process; First create a "Container"
         type element, then edit the settings and check the "Section"
         flag. The Data Structure should look like this now:

         | 
         | `[3] <https://typo3.org/typo3temp/tx_oodocs_05fac888fe.png>`__
           [not available anymore]

         Now, map the two elements. The Section element (field_list)
         must be mapped to the inside of the HTML element which should
         wrap around the repeated movie elements inside. When we click
         the Map button we see this:

         | 
         | `[4] <https://typo3.org/typo3temp/tx_oodocs_577afc946d.png>`__
           [not available anymore]

         Normally, mapping to the <table> tag would be a good choice
         (#1) since that wraps the table rows which are repeatable.
         However we would loose the header row then! Bummer! So instead
         you map the Section element to the *second* <tr> tag (#2 -
         first content row) and in the Action selector you select the
         last of the RANGE types:

         | 
         | `[5] <https://typo3.org/typo3temp/tx_oodocs_88867b5a3a.png>`__
           [not available anymore]

         This actually means that your mapping will span over several
         HTML elements on the same level effectively cutting out all the
         table rows except the header row! Cool, eh!

         Next, you are going to map the movie element (field_movie_el)
         and again you will have to use the RANGE action for mapping
         since each movie element must contain two table rows; the
         spacer row above the element and the element row itself. That
         is no problem though, using the technique from before:

         | 
         | `[6] <https://typo3.org/typo3temp/tx_oodocs_6ffaeeb54e.png>`__
           [not available anymore]

         After clicking the first row, you select the range to be the
         next row:

         | 
         | `[7] <https://typo3.org/typo3temp/tx_oodocs_cdf9d10fd5.png>`__
           [not available anymore]

         The result of the mapping looks like this:

         | 
         | `[8] <https://typo3.org/typo3temp/tx_oodocs_1d726124c6.png>`__
           [not available anymore]

         Finally, you create the four field types inside the movie
         element:

         | 
         | `[9] <https://typo3.org/typo3temp/tx_oodocs_5a064fd836.png>`__
           [not available anymore]

         Editing Types used:

         #. The Title element (field_title) was a "Plain input field"
         #. The Description element (field_description) was a "Text area
            for bodytext"
         #. The Link URL field (field_linkurl) was a "Link field" (and
            notice the DS element type is "Attribute"!)
         #. The Icon Image field (field_image) was a "Image field, fixed
            WxH"

         Each element should be mapped according to this (match the
         numbers with above list!):

         | `[10] <https://typo3.org/typo3temp/tx_oodocs_772be5a7eb.png>`__
           [not available anymore]

         Mapping #1 and #2 is the INNER type (content should go INTO the
         tag), mapping #3 is fixed to OUTER (no other options for an
         image tag) and mapping #4 is an attribute, should be the "href"
         of the <a> tag. Result looks like:

         | 
         | `[11] <https://typo3.org/typo3temp/tx_oodocs_616f5f2de9.png>`__
           [not available anymore]

         Except the fact that I have been too lazy to provide mapping
         instructions (important information for someone who is going to
         map a second TO) and sample data this looks good. Now click
         "Save", give it a name and that's it.

         | `[12] <https://typo3.org/typo3temp/tx_oodocs_1af73f9116.png>`__
           [not available anymore]

         .. rubric:: Testing the new Content Element
            :name: testing-the-new-content-element

         Create a new content element of the "Flexible Content" type and
         select "Movie listing" as Data Structure. Then fill it in with
         content - and don't forget to select the template object as
         well!

         | https://typo3.org/typo3temp/tx_oodocs_a4b2707e55.png
           [outdated image]

         In the frontend you will see something like this:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_88c79acce7.png
           [outdated image]

         .. rubric:: Fixing the stylesheet
            :name: fixing-the-stylesheet

         One final thing - we forgot to include any special parts of the
         header for this element - apparently the styles does not match
         the ones in the template file. So enter TemplaVoila by clicking
         the icon of the Template Object:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_40457eb048.png
           [outdated image]

         Then select "Select HTML header parts" and click the checkbox
         at the last stylesheet (which apparently is specially designed
         for this particular content element!)

         | https://typo3.org/typo3temp/tx_oodocs_c06e897add.png
           [outdated image]

         Clear cache and check the frontend again; this fixes the
         problem... :-)

         | https://typo3.org/typo3temp/tx_oodocs_24b5011eb5.png
           [outdated image]

         .. rubric:: Creating a pseudo-record
            :name: creating-a-pseudo-record

         Editing types used:

         Number 3 and 4 are inconsistently used between figure and list.

         .. rubric:: Working with TypoScript inside of Data Structures
            :name: working-with-typoscript-inside-of-data-structures

         When you map an element from a Data Structure to a position in
         HTML it is expect that some dynamic content is inserted in that
         position at render time. There are various ways of determine
         the output:

         -  By default the field content is inserted directly. Possibly
            configured with a few available flags like
            "htmlspecialchars()" processing, integer conversion or
            passing to stdWrap function (known from TypoScript)
         -  Alternatively, you can enter a TypoScript content object
            array (COA) which will be executed. This can be used for
            building menus, graphics or just plain processing if you
            please. In this way you work with TypoScript in the context
            where it is used.
         -  Alternatively, you can also call a TypoScript object path
            from the main TypoScript Template of your website. This
            means you keep your TypoScript at a central place.

         .. rubric:: Default pass-through of content
            :name: default-pass-through-of-content

         In this example the content of the field "field_paragraph" is
         processed only by htmlspecialchars() because the <HSC> tag is
         set in line 106:

         ::

              98:                   <field_paragraph>
              99:                           <tx_templavoila>
             100:                                   <title>Paragraph</title>
             101:                                   <sample_data>
             102:                                           <n0></n0>
             103:                                   </sample_data>
             104:                                   <eType>text</eType>
             105:                                   <proc>
             106:                                           <HSC>1</HSC>
             107:                                   </proc>
             108:                           </tx_templavoila>
            ...
             117:                   </field_paragraph>

         The options for default processing in the <proc> tag applies to
         all content (even that coming from TypoScript or TypoScript
         Object path tags) outputted and the options are:

         -  <int> (boolean) - Forcing to integer before output
         -  <HSC> (boolean) - Passing through the PHP function
            "htmlspecialchars()" which will provide protection for use
            of HTML and XSS attacks.
         -  <stdWrap> (array) - stdWrap processing

         .. rubric:: TypoScript object path
            :name: typoscript-object-path

         .. rubric:: Image processing
            :name: image-processing

         You can also use the <TypoScript> tag to perform processing on
         the values.

         Before writing TypoScript you will need to know that

         -  The value of the tag in the context of that TypoScript is
            found as the "current value" in TypoScript.
         -  The value of all tags in the Data Structure from the same
            level is found in the internal data array and can be
            addressed with the ".field" attribute of stdWrap

         ::

               9:                   <field_image>
              10:                           <tx_templavoila>
              11:                                   <title>Image</title>
              12:                                   <tags>img</tags>
              13:                                   <TypoScript>
              14: 10 = IMAGE
              15: 10.file.import = uploads/tx_templavoila/
              16: 10.file.import.current = 1
              17: 10.file.import.listNum = 0
              18: 10.file.maxW = 266
              19:                                   </TypoScript>
              20:                           </tx_templavoila>
            ...' '  35:                   </field_image>

         In the example above you can see how the field "field_image"
         from the Data Structure is processed as if it contains an
         image. The TypoScript configures the path of the image (line
         15), loads the "current" value (line 16) and selects the first
         image in the list (should there be more than one) (line 17) and
         finally the maximum width is set to 266 (line 18)

         When you select "Editing Types" during the kickstarting process
         of DS/TOs this kind of default TypoScript configurations is
         what you get! You can always edit the Data Structure and change
         them to whatever you need them to do!

         Another example using config.absRefPrefix:

         ````

         ````
         ::

            <TypoScript_constants>
                                                        <absrefprefix>{$config.absRefPrefix}</absrefprefix>
                                                </TypoScript_constants>
                                                   <TypoScript><![CDATA[
              10 = COA
              10.if.isTrue.field=field_image
              
              10 {
               20 = IMG_RESOURCE
               20 {
                 file.import = uploads/tx_templavoila/
                 file.import.field = field_image
                 file.import.listNum = 0    
                 stdWrap.wrap = background-image:url({$absrefprefix}|); background-repeat: no-repeat;
               }
               
              30 = TEXT
               30 {
                 
                 wrap=min-height:|px; 
                 data =TSFE:lastImgResourceInfo|1     
               }        
             
                   
              
              }
                   
                                                   ]]></TypoScript>

         ````

         .. rubric:: Graphical headers
            :name: graphical-headers

         Now comes a more complicated example. The code here combines
         two fields into one rendering of a graphical headline where the
         content of both fields will show up.

         Lets look at the code listing:

         ::

              36:                   <field_header>
              37:                           <tx_templavoila>
              38:                                   <title>Header1</title>
              39:                                   <sample_data>
              40:                                           <n0>Lorem Ipsum Dolor</n0>
              41:                                   </sample_data>
              42:                                   <tags>img</tags>
              43:                                   <TypoScript_constants>
              44:                                           <textColor>black</textColor>
              45:                                           <text2Color>{$_CONSTANTS.colorSet.gray7}</text2Color>
              46:                                           <backColor>{$_CONSTANTS.colorSet.white}</backColor>
              47:                                   </TypoScript_constants>
              48:                                   <TypoScript>
              49: 10 = IMAGE
              50: 10.file = GIFBUILDER
              51: 10.file {                           
              52:   XY = 200,45
              53:   backColor = {$backColor}
              54:
              55:   10 = TEXT
              56:   10.text.current = 1
              57:   10.text.case = upper
              58:   10.fontColor = {$textColor}
              59:   10.fontFile =  {$TSconst.font_bold}
              60:   10.niceText = 1
              61:   10.offset = {$textPosition}
              62:   10.fontSize = 20        
              63:
              64:   20 = TEXT
              65:   20.text.field = field_header2
              66:   20.text.case = upper
              67:   20.fontColor = {$text2Color}
              68:   20.fontFile =  {$TSconst.font_light}
              69:   20.niceText = 1
              70:   20.offset = {$text2Position}
              71:   20.fontSize = 18
              72: }
              73:                                                           </TypoScript>
              74:                           </tx_templavoila>
              75:                           <TCEforms>
              76:                                   <config>
              77:                                           <type>input</type>
              78:                                           <size>48</size>
              79:                                           <eval>trim</eval>
              80:                                   </config>
              81:                                   <label>Header (colored)</label>
              82:                           </TCEforms>
              83:                   </field_header>
              84:                   <field_header2>
              85:                           <type>no_map</type>
              86:                           <tx_templavoila>
              87:                                   <title>Header2</title>
              88:                           </tx_templavoila>
              89:                           <TCEforms>
              90:                                   <config>
              91:                                           <type>input</type>
              92:                                           <size>48</size>
              93:                                           <eval>trim</eval>
              94:                                   </config>
              95:                                   <label>Subheader (gray)</label>
              96:                           </TCEforms>
              97:                   </field_header2>

         The two fields are "field_header" and "field_header2".

         -  Notice how the "<type>" of "field_header2" is set to
            "no_map" - this is done because this field in the Data
            Structure exists only for backend input to support the
            rendering of "field_header" which is mapped to the HTML
            template!
         -  In line 55 and 64 a "TEXT" GIFBUILDER is created, one for
            each field.
         -  In line 56 the "current value" is loaded for the first TEXT
            object - thus getting the value of "field_header"
         -  In line 65 the value of the field "field_header2" is fetched
            by the ".field" attribute of TypoScript - we can do that
            because all values of the tags on the same level as
            "field_header" is found internally in cObj->data array

         .. rubric:: TypoScript Constants in Data Structures
            :name: typoscript-constants-in-data-structures

         In the above example you can also see how certain values in the
         TypoScript code comes from *constants* (lines 53, 58, 59, 61,
         67, 68 and 70). This is as we know it from TypoScript Template
         records - but the constants are coming from the *local scope*
         of this TypoScript code! That means only the constants defined
         by the tags in line 44-46 can be used! That means {$textColor},
         {$text2Color}, {$backColor}

         **Constants in Constants**

         In line 43-47 you can also see that some of these constants are
         referring back to other values, for example
         "{$_CONSTANTS.colorSet.white}" - these values are object paths
         pointing to the TypoScript Template *Setup field* (*not* the
         Constants field!)

         In this case those value would be found in the TypoScript
         Object Tree at these positions:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_fc4fff470a.png
           [outdated image]

         These values are set by first setting this in the Constants
         field of the TypoScript Template record:

         ::

            # Define color sets:
            colorSet.gray1 = #B4B3B3
            colorSet.gray2 = #333333
            colorSet.gray3 = #eeeeee
            colorSet.gray4 = #F7F7F7
            colorSet.gray5 = #555555
            colorSet.gray6 = #444444
            colorSet.gray7 = #828282
             
            colorSet.red = #E80C0E
            colorSet.orange = #FF7200
            colorSet.TO1 = #BA3957
            colorSet.TO2 = #217EA1
            colorSet.TO3 = #849724
            colorSet.TO4 = #608375
            colorSet.TO5 = #7469A4
            colorSet.TO6 = #96AA00
            colorSet.white = #FFFFFF
             
            # Define font sets:
            font.light = EXT:user_3dsplm/fonts/FRANGWC_.TTF
            font.medium = EXT:user_3dsplm/fonts/FRANGMC_.TTF
            font.bold = EXT:user_3dsplm/fonts/FRANGDC_.TTF

         Then in the Setup field of the Template Record you will find
         these lines:

         ::

            # Moving constants into the Setup scope (for use from PHP scripts and Template Objects)
            _CONSTANTS.colorSet {
              gray1 = {$colorSet.gray1}
              gray2 = {$colorSet.gray2}
              gray3 = {$colorSet.gray3}
              gray4 = {$colorSet.gray4}
              gray5 = {$colorSet.gray5}
              gray6 = {$colorSet.gray6}
              gray7 = {$colorSet.gray7}
              red = {$colorSet.red}
              orange = {$colorSet.orange}
              TO1 = {$colorSet.TO1}
              TO2 = {$colorSet.TO2}
              TO3 = {$colorSet.TO3}
              TO4 = {$colorSet.TO4}
              TO5 = {$colorSet.TO5}
              TO6 = {$colorSet.TO6}
              white = {$colorSet.white}
            }
            _CONSTANTS.font {
              light = {$font.light}
              medium = {$font.medium}
              bold = {$font.bold}
            }

         **Constants directly from the Setup field**

         Finally in line 59 and 68 the constant has a special prefix,
         "TSconst." and when that is found the constant is a reference
         to the object path "plugin.tx_templavoila_pi1.[constant]", thus
         in this case "plugin.tx_templavoila_pi1.TSconst.font_bold"

         | https://typo3.org/typo3temp/tx_oodocs_edc9b30dd3.png
           [outdated image]

         These values were also set from constants in the TypoScript
         Template record (see above):

         ::

            plugin.tx_templavoila_pi1.TSconst {
              font_light = {$font.light}
              font_medium = {$font.medium}
              font_bold = {$font.bold}
              color_red = {$colorSet.red}
              color_white = {$colorSet.white}
              color_gray4 = {$colorSet.gray4}
            }

         These options might seem a bit confusing but the implementation
         is like this for performance reasons. You will most likely
         think that the logic is to set object paths from the TypoScript
         Constants field, not the Setup field. However this is not
         possible at render-time since constants are substituted in
         TypoScript at parse time (and that result is cached).

         Therefore if you want to channel TypoScript Constants into your
         Data Structures you should set the constants in object paths
         (like "_CONSTANTS.colorSet.white") from where you can insert
         them into the constants defined in <TypoScript_constants>

         .. rubric:: Overriding values from Template Objects
            :name: overriding-values-from-template-objects

         Mainly, processing instructions of all kinds are stored in the
         Data Structures. However if can be necessary to override some
         of these values from the Template Objects. That is easily done
         by setting alternative values for the tags inside the
         <tx_templavoila> tag of a Data Structure using the "Local
         Processing (XML)" field of Template Objects:

         | 
         | https://typo3.org/typo3temp/tx_oodocs_40d60b3958.png
           [outdated image]

         The XML content looks like this in color markup:

         ::

               1: <T3DataStructure>
               2:   <ROOT>
               3:           <el>
               4:                   <field_header>
               5:                           <tx_templavoila>
               6:                                   <TypoScript_constants>
               7:                                           <textXY>266,50</textXY>
               8:                                           <textColor>{$_CONSTANTS.colorSet.TO3}</textColor>
               9:                                           <textPosition>0,21</textPosition>
              10:                                           <text2Position>0,42</text2Position>
              11:                                   </TypoScript_constants>
              12:                                   <TypoScript>
              13: 10 = IMAGE
              14: 10.file = GIFBUILDER
              15: 10.file {                           
              16:   XY = {$textXY}
              17:   backColor = {$backColor}
              18:
              19:   10 = TEXT
              20:   10.text.current = 1
              21:   10.text.case = upper
              22:   10.fontColor = {$textColor}
              23:   10.fontFile =  EXT:user_3dsplm/fonts/FRANGDC_.TTF
              24:   10.niceText = 1
              25:   10.offset = {$textPosition}
              26:   10.fontSize = 18
              27:
              28:   20 = TEXT
              29:   20.text.field = field_header2
              30:   20.text.case = upper
              31:   20.fontColor = {$text2Color}
              32:   20.fontFile =  EXT:user_3dsplm/fonts/FRANGWC_.TTF
              33:   20.niceText = 1
              34:   20.offset = {$text2Position}
              35:   20.fontSize = 18
              36: }
              37:                                   </TypoScript>
              38:                           </tx_templavoila>
              39:                   </field_header>
              40:           </el>
              41:   </ROOT>
              42: </T3DataStructure>

         Notice that all values overriding the Data Structure is at the
         *exact same location* of the XML structure as they are in the
         Data Structure XML!

         In this example lines 7- 10 overrides the constants with other
         colors.

         Further the TypoScript is even changed (although that is
         usually not needed if you use constants correctly) in lines 13
         - 36

         .. rubric:: Loading and restoring TypoScript register values
            :name: loading-and-restoring-typoscript-register-values

         Assume that you are creating a page template with two areas of
         content of differing width. Normally you set one global setting
         for the maximum image width in the Constants setup of your
         templates:

         ::

            styles.content.imgtext.maxW = 600
            styles.content.imgtext.maxWInText = 300

         However, you want to override this value when content is
         rendered inside the smaller of the two columns (since that was
         designed for secondary content.

         This is easily done by a small modification to the field in the
         Data Structure which renders the content elements inside:

         ::

              13:                   <field_ce_right>
              14:                           <tx_templavoila>
              15:                                   <title>Right Column</title>
            ...
              20:                                   <TypoScript>
              21:
              22: 5 = LOAD_REGISTER
              23: 5.maxImageWidthInText = 100
              24: 5.maxImageWidth = 180
              25:
              26: 10= RECORDS
              27: 10.source.current=1
              28: 10.tables = tt_content
              29:
              30: 15 = RESTORE_REGISTER
              31:
              32:                                           </TypoScript>
              33:                           </tx_templavoila>
            ...
              46:                   </field_ce_right>

         In this example line 26-28 is what you normally find as preset
         TypoScript rendering when you select the Editing Type "Content
         Elements". Line 22-24 on the other hand is manually inserted
         and will load the internal registers with values that will
         override the settings from the Constants while rendering
         content inside this column. Line 30 makes sure to restore the
         old state again.

         .. rubric:: Using CDATA
            :name: using-cdata

         When editing TypoScript in Data Structures you might quickly
         find it very useful to wrap the content in CDATA tags to avoid
         parsing of the content. This is true especially when you enter
         HTML codes for wrapping etc.

         Using the CDATA tags looks like this (line 13 and 17):

         ::

              12:                                   <TypoScript>
              13: <![CDATA[</font>
              14: 10 = TEXT</font>
              15: 10.current = 1</font>
              16: 10.wrap =  | </font>
              17:] ]></font>
              18:                                   </TypoScript>

         The alternative looks like this (using the HTML entities < and
         > for < and >):

         ::

              12:                                   <TypoScript>
              13: 10 = TEXT
              14: 10.current = 1
              15: 10.wrap = >b< | >/b<
              16:                                   </TypoScript>

         .. rubric:: Default pass-through of content
            :name: default-pass-through-of-content-1

         To make a "Textarea for bodytext" respond to paragraphs you
         need to use the stdWrap option in the DS definition, and where
         the doc says the value for is an (array), this means the
         options are separated on separate lines.

         **Code Listing:**\ <field_bodytext type="array">

         ::

            <tx_templavoila type="array">
            <title>Body text</title>
            <sample_data type="array">
            <numIndex index="0">field_bodytext</numIndex>
            </sample_data>
            <eType>text</eType>
            <proc type="array">
            <HSC type="integer">1</HSC>
            <stdWrap>
            br=1
            debug=1
            </stdWrap>
            </proc>
            </tx_templavoila>
            <TCEforms type="array">
            <config type="array">
            <type>text</type>
            <cols>48</cols>
            <rows>5</rows>
            </config>
            <label>Body text</label>
            </TCEforms>
            </field_bodytext>

         .. rubric:: Hints about mapping
            :name: hints-about-mapping

         The mapping from TemplaVoila is designed to work without
         nothing but pure HTML. However if you rearrange elements in the
         HTML source and wants to do a re-mapping you might find that
         everything fails. Therefore it is a good idea to "tag"
         cornerstone elements with an "id" attribute or class attribute.
         These are a part of the "HTML-path" which is used to identify
         an element in a template. And if you use ids at strategically
         good places (like the wrapping

         .. container::

            elements in the template_ce.html) you will come a long way.
            .. rubric:: Cached templates
               :name: cached-templates

            Also notice; if a template file changes or even is deleted,
            the Template Objects will still work since they *cache* a
            parsed version of the mapped template in the moment you save
            them! Therefore they are very robust and only missing
            images, stylesheets etc. used by the templates will break.

            Other features than mandatory caching will come later.

            .. rubric:: ToDo of TemplaVoila
               :name: todo-of-templavoila

            The todo list is in the extension, doc/TODO.txt

            However here are a few major things which does not work
            fully yet:

            -  Web > Page module - lots to do. Ask Robert.
            -  Mapping will fail if you map an attribute which is in a
               tag containing others. There might be other bugs as well,
               slightly confusing.
            -  Mapping may fail if you map ANY HTML file - the file
               should be nested correctly etc. Generally, the HTML must
               be clean. But we want to improve those parts so it can
               accept more "lousy" HTML as well...
            -  Documentation!
