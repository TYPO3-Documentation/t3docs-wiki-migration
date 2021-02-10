.. include:: /Includes.rst.txt

===========
ReST Syntax
===========

.. container::

   notice - Newer documentation available

   .. container::

      `Writing
      Documentation <https://docs.typo3.org/m/typo3/docs-how-to-document/master/en-us/Index.html>`__
      not only includes the `reST cheat
      sheet <https://docs.typo3.org/m/typo3/docs-how-to-document/master/en-us/WritingReST/CheatSheet.html>`__
      but also some common conventions in the `Documentation content
      style
      guide <https://docs.typo3.org/m/typo3/docs-how-to-document/master/en-us/GeneralConventions/Index.html>`__
      which should be used for documentation on docs.typo3.org. `How to
      render
      documentation <https://docs.typo3.org/m/typo3/docs-how-to-document/master/en-us/RenderingDocs/Index.html>`__
      contains information about rendering with Docker.

reStructured Text
=================

reST is a plain text file format. You may use a special syntax to
produce different formats, like ``*italic*`` for *emphasis*. Most of the
reST syntax is described in this document.

Furthermore you may want to read those guides:

-  Brief introduction to reStructuredText (reST) concepts and syntax, as
   well as conventions for TYPO3 documentation:
   https://docs.typo3.org/typo3cms/drafts/github/xperseguers/RstPrimer/
   [not available anymore]
-  A more general reference:
   http://docutils.sourceforge.net/docs/user/rst/quickref.html

Structure of a single reST file
===============================

The files just contain text. Write it and that's it. New paragraphs in
the output are created by an empty line between two paragraphs in your
reST file.

reST documents are using the extension (ending) .rst. If you happen to
include other files, such as when centralizing directives or
substitutions (see below), you should use another file extension, such
as .txt to prevent uncessary warnings.

Basics:

-  We use UTF-8 with BOM as encoding.
-  Indentation: we currently use spaces to indent text.

**Note:** In reST, the indentation of a block of lines often is
important. The exact number of spaces, which are used to indent a block
of text, does not matter. But what *does* matter, is that all lines of
the block are indented with **exactly the same** number of spaces.

Apart from just writing text, you have many possiblities to style it.
The most important ones are listed on this page.

Escaping characters
-------------------

If you want to use a character, which would create some special reST
markup, with its normal meaning, you must escape it with a prepended
"\".

E.g. surrounding text with "*" signs normally makes it show up in
italics. By escaping the special characters "*" you make the stars
normal text characters.

::

   \*non-italic\*

Formatting your output
----------------------

Headlines
^^^^^^^^^

You can make text a headline by over- and or underlining the line with
the text.

Two rules:

-  If under- and overline are used, their length must be identical
-  The length of the underline must be at least as long as the title
   itself

In the following example you see the headlines we use:

::


   ==================
   Headline 1 (title)
   ==================

   Headline 2
   ==========

   Headline 3
   ----------

   Headline 4
   ^^^^^^^^^^

   Headline 5
   """"""""""

   Headline 6
   ~~~~~~~~~~

The hierarchical order of the headlines is the one you create. That
means: There is no fixed syntax, which tells you, that e.g. minus signs
below a line always are a headline of type 3. If you write your document
and Sphinx finds this style of headline as the second style in your
document, it will make this and the following headlines of this style to
headlines of type 2.

See
http://docutils.sourceforge.net/docs/ref/rst/restructuredtext.html#sections

Empty paragraphs
^^^^^^^^^^^^^^^^

Empty paragraphs can be added with a pipe:

::

   First paragraph. Lorem ipsum dolor...

   |

   This is a second paragraph. Upon rendering it will have a blank line in front of it, as indicated by the "|" marker.

Code blocks
^^^^^^^^^^^

You can use the following syntax to insert multiple lines of code:

::

   ::

       mod.web_list {
           deniedNewTables = tt_news,tt_content
       }

(Yes, the two colons and the empty line after them must be there.)

Inline styles
^^^^^^^^^^^^^

You can use the following styles to adjust the appearance of some words:

::

   This word is in *italics*.
   The next word is **bold**.
   Now follow some ``fixed-space literals``.

Apart from that there are many other possible inline styles; see
http://docutils.sourceforge.net/docs/user/rst/quickref.html#inline-markup

If you need some of those "markup-creating characters", but do not want
them to create special markup, you must escape them by prepending a "\",
e.g. This word is not in \\*italics\*.

Adding classes (= "roles")
^^^^^^^^^^^^^^^^^^^^^^^^^^

You can give some words or a complete line a special class. This class
can then be used to apply a special layout, e.g. via CSS. You need to do
two things:

-  First you have to define a role with the ".. role::" directive.
-  Then you can use this role in your document.

We use the roles, which you see in the following example.

E.g.

::

   .. role::   typoscript(code)
   .. role::   ts(typoscript)
      :class:  typoscript
   .. role::   php(code)
   .. highlight:: guess

   Now the roles are defined and can be used. Let's go:

   Here comes TypoScript: :typoscript:`page.headerData.10 = TEXT`

   The words above do not only get the class "typoscript",
   but also the class "code", because the role "typoscript" is based on the role "code".
   So the text gets the classes "code typoscript" attached.

   Here comes more TypoScript: :ts:`page.headerData.10 = TEXT`

   Produces the same output as the role "typoscript". The role "ts" is an abbreviation for the role "typoscript".

   This is PHP code: :php:`$a = '';`

See
http://docutils.sourceforge.net/docs/ref/rst/directives.html#custom-interpreted-text-roles

Links
^^^^^

Links to the same reST project
''''''''''''''''''''''''''''''

For a link in the same project you need two things:

-  A label to link to. E.g. ".. \_my-reference-label:".
-  And a reference, which links to the label. References can be created
   using the :ref: role.

**Note** that label names must be unique throughout the *entire*
documentation project!

See http://sphinx.pocoo.org/markup/inline.html [not available anymore]

Links to a headline
                   

If you place a label directly before a section title, you can reference
to it with :ref:`label-name`.

E.g.

::

   .. _my-reference-label:

   Section to cross-reference
   ==========================

   This is the text of the section.

   It refers to the section itself, see :ref:`my-reference-label`.

The :ref: role will then generate a link to the section.

The link title will be "Section to cross-reference". If you want to have
another link title, you can supply an *explicit title* and reference
target. E.g. :ref:`title <my-reference-label>\` will refer to
*my-reference-label*, but the link text will be *title*.

This works just as well when section and reference are in different
source files.

Links to other places in the same project
                                         

Labels that aren’t placed directly in front of a headline can still be
referenced to, but you must give the link an explicit title, using this
syntax: :ref:`Link title <label-name>`.

Links to another reST project
'''''''''''''''''''''''''''''

Creating links to another reST project (cross linking) is possible with
an addition to Sphinx called Intersphinx.

E.g.

-  in the TyposcriptReference let the label ":ref:`stdWrap`" be defined.
-  in the ``Settings.cfg`` of another project a link to the
   TyposcriptReference may be part of the Intersphinx Mapping:

::

   [intersphinx_mapping]

   # These are common mappings. Uncomment only what you really use!

   # t3api         = https://typo3.org/api/typo3cms/
   # t3cgl         = https://docs.typo3.org/typo3cms/CodingGuidelinesReference/
   # t3coreapi     = https://docs.typo3.org/typo3cms/CoreApiReference/
   # t3editors     = https://docs.typo3.org/typo3cms/EditorsTutorial/
   # t3extbasebook = https://docs.typo3.org/typo3cms/ExtbaseFluidBook/
   # t3fal         = https://docs.typo3.org/typo3cms/FileAbstractionLayerReference/
   # t3inside      = https://docs.typo3.org/typo3cms/InsideTypo3Reference/
   # t3install     = https://docs.typo3.org/typo3cms/InstallationGuide/
   # t3l10n        = https://docs.typo3.org/typo3cms/FrontendLocalizationGuide/
   # t3security    = https://docs.typo3.org/typo3cms/SecurityGuide/
   # t3services    = https://docs.typo3.org/typo3cms/Typo3ServicesReference/
   # t3skinning    = https://docs.typo3.org/typo3cms/SkinningReference/
   # t3start       = https://docs.typo3.org/typo3cms/GettingStartedTutorial/
   # t3tca         = https://docs.typo3.org/typo3cms/TCAReference/
   # t3templating  = https://docs.typo3.org/typo3cms/TemplatingTutorial/
   # t3ts45        = https://docs.typo3.org/typo3cms/TyposcriptIn45MinutesTutorial/
   # t3tsconfig    = https://docs.typo3.org/typo3cms/TSconfigReference/
   # t3tsref       = https://docs.typo3.org/typo3cms/TyposcriptReference/
   # t3tssyntax    = https://docs.typo3.org/typo3cms/TyposcriptSyntaxReference/

In case of the PHP API, you have to link to:
``t3api = https://typo3.org/api/typo3cms/ [not available anymore]``

Here is a list of the official prefixes and the projects they point to:

============ ================================
Prefix       Document
t3api        PHP API via Doxygen
t3coreapi    Core API Reference
t3cgl        Coding Guidelines Reference
t3editors    Tutorial for Editors
t3fal        File Abstraction Layer Reference
t3inside     Inside TYPO3
t3install    Installation Guide
t3l10n       Frontend Localization Guide
t3security   Security Guide
t3services   TYPO3 Services
t3skinning   Skinning Reference
t3start      Getting Started Tutorial
t3tca        TCA Reference
t3templating Templating Tutorial
t3ts45       TypoScript in 45 Minutes
t3tsconfig   TSconfig Reference
t3tsref      Typoscript Reference (tsref)
t3tssyntax   Typoscript Syntax Reference
============ ================================

Then you can reference stdWrap in this other project with

::

   :ref:`My stdWrap linktext <t3tsref:stdWrap>`

To create this kind of link you do neither need to know, in which file
the referenced label is to be found nor at which place exactly.

See http://sphinx.pocoo.org/ext/intersphinx.html [not available anymore]

External links
''''''''''''''

You can create links by setting the link text and the target URL behind
each other, surrounded by backticks and with a following underline.

E.g.

::

   This is a paragraph that contains `a link <http://example.com/>`_.

This construct offers easy authoring and maintenance of hyperlinks, but
at the expense of general readability. **Do not use it!** Inline URIs,
especially long ones, inevitably interrupt the natural flow of text.

**The use of the following construct is strongly recommended**:

::

   This is a paragraph that contains `a link`_.

   .. _a link: http://example.com/

Tables
^^^^^^

There are several ways in reST to insert a table: As *simple table* or
with the *.. container:: table-row* directive or with the
*t3-field-list-table* directive.

Simple table
''''''''''''

Simple tables are good, if you have a short table and if the content in
the table rows itself is rather short.

E.g.

::

   ============   ======================================================
   Severity       Meaning
   ============   ======================================================
   Critical       This is a critical error. You should take the steps
                  needed to fix the problem as soon as possible.
   High           This is an important error.
   ============   ======================================================

Above and below the table header and below the whole table you have to
create horizontal borders made up of "=" characters. The borders in
these three lines must be identical. The table content must be indented
so that that it is standing inside the table columns; there may be no
text inside the column margins.

Note: The content in the first table column cannot contain linebreaks
(the linebreak would then create the next table row).

Tables for more complex content
'''''''''''''''''''''''''''''''

If you have more content in the table or if the whole table is longer,
you should not use a simple table. (There you would have to adjust the
spaces in between over and over again, which is really annoying.)

In these cases you should better use a definition list with *..
container:: table-row* directives for each table row. Another option
then is to use the directive *t3-field-list-table*. For details see the
according sections below.

Directives
----------

Certain lines in rst files do not just display (styled) text, but have a
special meaning. The most important ones of these lines are so called
directives. They begin with two dots, then follows exactly one space,
then the name of the directive and then two colons. A directive can
maximally consist of four parts: Its name is necessary. Parameter,
options and body are optional. The general directive syntax is:

::

   .. directive:: parameter
      :option1:
      :option2:

      body lorem ipsum trala
      body lorem ipsum trala

| 
| E.g.

::

   .. toctree::

is a directive,

::

   .. include::

is another one.

**Note** that directive options and body both must be indented with the
same number of spaces.

Including other reST files
^^^^^^^^^^^^^^^^^^^^^^^^^^

.. toctree:: directives import other files. Split your text in multiple
files and put them in folders with meaningful names. Then import the rst
files from subfolders with the ".. toctree::" directive.

**Note:** Only files, which are imported using ".. toctree::" become
part of your documentation. If you place a .rst file somewhere in a
folder, but do not import it with a toctree directive anywhere, it will
not become part of the rendered versions of your documentation.

**Note:** If you rename the subfolder, from which you import a file, you
have to adjust the line in the toctree directive accordingly.

E.g.

::

   .. toctree::
      :maxdepth: 5
      :titlesonly:
      :glob:

      Introduction/Index
      Upgrade/Index

The toctree directive above imports the files Introduction/Index.rst and
Upgrade/Index.rst. The folders Introduction/ and Upgrade/ are relative
to the location of the Index.rst file, in which the toctree directive is
noted. In the files Introduction/Index.rst and Upgrade/Index.rst you can
then again use toctree directives to include further files, if you want
to.

The option ":maxdepth: 5" makes sure that up to five levels of headlines
are shown in the table of contents. With ":titlesonly:" only the main
title of each document is added to the table of contents. With ":glob:"
you get a way to use wildcards e.g. to include all files from a
subfolder: You can include all rst files from the folder Directory1/
with Directory1/\* in the body of the directive. The files in this
folder will then be added and displayed in alphabetical order.

Definition Lists
^^^^^^^^^^^^^^^^

We use definition lists for the complex tables with all the single
TypoScript properties. To do so, we use the directive "container".

E.g.

::

   .. container:: table-row

      Property
            Property:

      Data type
            Data type:

      Description
            Description:

      Default
            Default:

   .. container:: table-row

      Property
            mod

      Data type
            ->MOD

      Description
            Options for the backend modules.

            *Notice that these options are merged with settings from User TSconfig
            (TLO: mod) which takes precedence.*

      Default

The "container" directive is the most used directive in many of our
manuals. It is used to display the main content of TSconfig and TSref:
The tables, which we had before, have been replaced; now the content of
each table row is inside one ".. container:: table-row" directive.

The output is a definition list, where the categories "Property", "Data
type" and so on are definition terms; the name of the property and the
other values are definition descriptions.

Here are three lists of commonly used categories/headings:

::

   ['property', 'datatype', 'description', 'default']
   ['datatype', 'examples', 'comment', 'default']
   ['var', 'phptype', 'description', 'default']

If **all** headings of a table are in one of these lists, the reST
parser will automatically transform the definition list into a more
readable format.

This automatic transformation also works, if all headings of a table are
in one of the lists, but only **some** of the possible headings are
present (like only "property" and "description"). In this case the
automatic conversion works as well, as long as the order of the headings
matches the order in the list.

t3-field-list-table
^^^^^^^^^^^^^^^^^^^

If you do not use the table headers, which would allow a special
transformation for definition lists and if you do not want to have an
ordinary definition list as output, you should use the ..
t3-field-list-table directive to create a table. It allows you to create
complex tables, but with simple markup.

E.g.

::

   .. t3-field-list-table::
    :header-rows: 1

    - :File:
            File

      :Description:
            Description

    - :File:
            fe_adminLib.inc

      :Description:
            Main class used to display the frontend administration forms.

            Call it from a USER_INT cObject with 'userFunc =
            user_feAdmin->init'. See the static_templates for examples.

            **Note:** Using the USER_INT cObject allows the script to work
            regardless of the page-cache which is necessary!

    - :File:
            fe_admin_dmailsubscrip.tmpl

      :Description:
            Example template file for subscription to newsletters of users to the
            tt_address table. This template is used by the static_template
            'plugin.feadmin.dmailsubscription'.

First we define that we want to have one header row. Each row then
starts with a "-" (just like a list does). Each row consists of the
different table cells as a field list (":File:" and ":Description:" in
this example). The content for these cells then can be any text (several
paragraphs, with inline markup, with examples...).

The result is rendered as a table.

Images
^^^^^^

Result of the automatic conversion to reST
''''''''''''''''''''''''''''''''''''''''''

All images are saved in the folder Documentation/Images/.

When our reST files were created, images were included the following
way:

#. A rst file, in which an image should be included, begins with the
   line ".. include:: Images.txt".
#. At the place in the rst file, where the image should be displayed,
   something like "|img-1|" is placed. This is a so called "replacement
   text"; see
   http://docutils.sourceforge.net/docs/ref/rst/directives.html#replacement-text
#. The file "Images.txt" in the same folder then holds a line, which
   starts with two dots, one space, this replacement text and then
   points to the image in the Images/ folder:

::

   .. |img-1|      image:: Images/Image1.gif

'*Note:* The above is a relative path to the image. So depending on the
level, on which your Images.txt file is located, you have to adjust the
path by prepending "../"-parts like *.. \|img-1\| image::
../../Images/Image1.gif*.

This replaces "|img-1|" with an image directive, which finally displays
the image.

**However, we do not want to use this kind of inclusion. We want to use
the following construct instead!**

Add an image
''''''''''''

If you want to include an image in your documentation, follow these
steps:

#. Save it in the folder Documentation/Images/, e.g. as Image1.gif.
#. In the rst file, at the place where you want to include the image,
   add the following:

::

   .. figure:: ../../Images/Image1.gif
      :alt: Your alternative text.

'*Note:* The above is a relative path to the image; adapt it as needed.
In front of and after the figure directive there must be one empty line.

This adds your image to the documentation.

Displaying a list of all labels
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

We use labels for (cross-)linking. To be able to get an overview of all
labels in a document, Martin Bless has developed a new
*ref-targets-list* directive. You can use it like so:

::

   Index: Labels for Crossreferencing
   ==================================

   .. ref-targets-list::

It will then display you an alphabetically sorted list of files and the
labels in them.

The labels will be displayed in two different ways, which shows you, how
you can link to them. E.g.:

::

   Functions/Stdwrap/Index

           [0032] :ref:`stdwrap`
           [0039] :ref:`... <stdwrap-examples>`

The first label is a *fully functional label*. You can link to this
label by just writing *:ref:`stdwrap\`* in your document. The linktext
will be created automatically by Sphinx; it will take the headline, in
front of which the label is noted.

The second label is a *non fully functional label*. When you link to
such a label, you additionally have to provide the linktext yourself,
e.g. *:ref:`Link to examples for stdWrap. <stdwrap-examples>\`*.

Comments
--------

A line, which starts with two dots, then a space, a word and then does
*not* have two colons directly behind each other, is a comment. It will
be ignored when the file is rendered. E.g.

::

   .. For your information: This line is a comment.

Our Extension Manual
====================

For additional details see our Extension Manual, which is the successor
of doc_template:
https://github.com/TYPO3-Documentation/TYPO3CMS-Example-ExtensionManual

You can use it as a basis, when you want to start writing your own
documentation in reST syntax.
