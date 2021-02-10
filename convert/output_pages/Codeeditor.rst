.. include:: /Includes.rst.txt

==========
Codeeditor
==========

.. container::

   This page belongs to the javascript-based Code-Editor with
   syntax-highlighting (TS, PHP, HTML, CSS,...) project (category
   `Project <https://wiki.typo3.org/Category:Project>`__ [deprecated
   wiki link])

What's it about
===============

We are developing a `Text
Editor <https://wiki.typo3.org/Category:Text_Editor>`__ [deprecated wiki
link] -- based on JavaScript -- to improve the way you can edit files
and templates in the TYPO3-backend. The most important feature is to
integrate syntax highlighting for
`TypoScript <https://wiki.typo3.org/Category:TypoScript>`__ [deprecated
wiki link] in the template module.

Features
========

already implemented (beta1)
---------------------------

-  Syntax-Highlighting for TS
-  line numbers
-  fullscreen mode (very helpful while editing a large piece of
   TypoScript)
-  code-snippets (try "/*" or "/co" followed by a tab)
-  code-completion (auto close braces like { ( [ )
-  integrated in the template modul (setup, constants and "Edit the
   whole template record")
-  hit CTRL-S to save the code (via Ajax, so no page-reload is
   required!)

next to do (for the release beta2)
----------------------------------

-  find and fix up a name:

   -  [STRIKEOUT:t3codepress]
   -  **t3editor** +1
   -  [STRIKEOUT:t3paul]
   -  [STRIKEOUT:t3pest (proffesional editor for sources and text)?]
   -  [STRIKEOUT:(TSedit)] *it's not only for TypoScript, so TSedit
      wouldn't fit very well*
   -  T3dit (3 often replace "E" in 1337-speak) ;) +1
   -  T3ditor (a mix from T3editor et T3dit)
   -  [STRIKEOUT:T3E]
   -  T3ddy
   -  ComplEditor
   -  (**please add your suggestions here**)

-  fix some bugs and smaller issues

   -  (a list should placed here...)

-  find a way to include the editor-javascript globally in the backend,
   so it can be used in different places

   -  get a class-file which can do all relevant stuff
   -  relocate the relevant code into an own sysext

-  perhaps we can provide a demo-installation for testing
-  [STRIKEOUT:as base use a \*patched\* codepress (so we can use always
   the current codepress release)]
-  start an own fork of codepress, based on the currenty latest version
   (0.9.5)
-  the user need the possibility to disable the editor,

   -  per BE-User
   -  on demand (like the RTE)
   -  simple textarea as fallback

-  get some feedback and wishes from the possible users

next to do (for the release rc1)
--------------------------------

-  fix bugs (are there still bugs in there?)
-  integration in fileadmin as default editor (remove tab.js)
-  integration in template > ressorces
-  try to fix the linenumber-image-thingy
-  write a comprehensible documentation

nice to have
------------

-  try to fix the line-number issue (it a basic codepress-problem, see
   below)
-  (insert some more fancy stuff here)

underlying techniques
=====================

[STRIKEOUT:Codepress -- a javascript-based editor]
--------------------------------------------------

[STRIKEOUT:As base for the editor we are using
the]\ `Codepress-Editor <http://codepress.org/>`__\ [STRIKEOUT:(]\ `SF-Project <http://sourceforge.net/projects/codepress/>`__\ [STRIKEOUT:)
It's working great for IE6+ and Firefox. But there are still some things
we are missing or like to solve in Codepress:]

-  linenumbers are tricked: it's an image lying in the background

   -  the problems with it are: it can't resize with the text and it's
      limited to 1500 lines

-  tabs (e.g. for indentions) are very large.
-  copy-n-paste from codepress to an other application don't work very
   well (the codepress-author is currently working on this)
-  localization is not solved very nice (it's need to talk with the
   TYPO3 localization)
-  missing support for Opera and Safari
-  ...

We decided to make an own fork of the codepress library. There are
various resons for this:

-  we need to do some major changes in the codepress library to get it
   work with TYPO3 (eg localization)
-  the author of codepress decided to remove some features in the latest
   version, which we don't want to miss (eg the fullscreen-mode)

[STRIKEOUT:We hope our changes can reflux into the future versions of
codepress.]

As Codepress don't fit our needs, we decide to write an own
javascript-based editor. We looked at, and get inspired by:

-  `Codepress <http://codepress.org/>`__
-  `Editarea <http://www.cdolivet.net/editarea/>`__
-  `Codeide <http://www.codeide.com/>`__
-  http://marijn.haverbeke.nl/highlight/story.html
-  http://marijn.haverbeke.nl/highlight/index.html

Prototype
---------

As the [Prototype-Framework http://www.prototypejs.org] is already
available in TYPO3, we use it to do some javascript-stuff (like
Ajax-Calls).

Releases
========

-  beta 1

On 13.05.2007 we released a first beta on
`typo3-unleashed.net/codepress <http://www.typo3-unleashed.net/codepress>`__
[not available anymore] as a patch against the TYPO3core-SVN-Version and
an already patched corepackage. Download it, try it and send us your
feedback!

Roadmap and coming releases
===========================

[STRIKEOUT:\* mid of juli: release beta2 (as patch agains the current
TYPO3-SVN)]

-  

   -  get a full featured and full integrated editor in the
      template-modul for Typoscript

[STRIKEOUT:\* end of august: release rc1 (as patch agains the current
TYPO3-SVN)]

-  

   -  get the editor available in all useful places like
      Template-Resources, fileadmin, Ext-Manager, ...

-  end of august: release alpha1 of t3editor, the new javascript-based
   editor

   -  Features:

      -  linenumbers
      -  can replace the setup-textarea in the template module
      -  can be turned of (like the RTE)
      -  prepared for syntax highlighting (very basic)
      -  prepared for multi linguism (very basic)
      -  ...

-  ...

more informations, links and contact
====================================

To get in contact with us, you can send us a mail to
codepress(at)typo3-unleashed(dot)net

Further informations and release announcements you can find on
`typo3-unleashed.net/codepress <http://www.typo3-unleashed.net/codepress>`__
[not available anymore]

Current Project Members
=======================

-  `Thomas Hempel <https://wiki.typo3.org/User:Matrikz>`__ [deprecated
   wiki link] <thomas(at)typo3-unleashed(dot)net>
-  `Tobias Liebig <https://wiki.typo3.org/User:Etobi.de>`__ [deprecated
   wiki link] <tobias(at)work(dot)de>

Wishlist
========

you can help us, if you send us any kind of

-  feedback, ideas, wishes, ...
-  donations, sponsoring, ...
