.. include:: /Includes.rst.txt

=============
Accessibility
=============

.. container::

   This page belongs to the Accessibility-Team (category
   `AccessibilityTeam </Category:AccessibilityTeam>`__ [deprecated wiki
   link])

Useful things
=============

To get an overview of accessibility related bugs in the bugtracker on
https://forge.typo3.org/projects/typo3cms-core/issues just enter the
keyword accessibility into the search field.

ToDos
=====

This is a list of things that are still missing to make TYPO3 a CMS for
accessible websites. The points on the list should be extended with the
names of the developers who can solve the problems, the estimated budget
necessary to pay them for their work and after that the list should be
presented to the edu/marketing team for budget decisions.

Identifying changes in language
-------------------------------

-  **RTE:**

   -  Possibility to mark words in a language that is different from the
      one defined in the page header:
      http://www.w3.org/TR/WCAG10-HTML-TECHS/#changes-in-lang
   -  If this is done automatically by some kind of parser, it should be
      dependant on the current language
   -  should be possible(manually) with rtehtmlarea's quicktag plugin,
      afair that supports the XML:lang "attribute"?
   -  see extension Akronymmanager in Alpha state:
      https://extensions.typo3.org/extension/sb_akronymmanager/

-  **Menus:**

   -  page titles in HMENUS should be marked according to the current
      page language

Provide a text equivalent for every non-text element
----------------------------------------------------

::

    - http://www.w3.org/TR/WCAG10-TECHS/#def-d-link

Add TITLE to Standard-Link-Funktion
-----------------------------------

The standard link popup should have a field to enter a link title
(title="...")

Generate valid (X)HTML output
-----------------------------

-  *RTE*

   -  enable nested ul-list in RTE

      -  current code:<ul><li>1st level entry no. 1</li><ul><li>2nd
         level entry no. 1</li></ul><li>1st level entry no. 2</li></ul>
      -  correct code:<ul><li>1st level entry no. 1<ul><li>2nd level
         entry no. 1</li></ul></li><li>1st level entry no. 2</li></ul>
      -  Christopher has already reported this in the bug-tracker:
         https://forge.typo3.org/issues/14317

   -  enable abbreviation and acronym wraps ( see extension
      Akronymmanager in Alpha state:
      https://extensions.typo3.org/extension/sb_akronymmanager/ )

-  *make form generation valid*

   -  name attribute not allowed in xhtml strict, hidden input elements
      must be within a block element - within the stdWrap of the form
      etc.

-  *CSS Styled Content*

   -  improving for better validation - id attributes everywhere with
      name attributes, also an id must not start with a number etc.

-  *Check your code and content*

   -  There is a good extension available to do page validation with the
      w3c validation service. The extension is called 'Page Validator'
      (sf_validator).

-  *Other*

   -  finish CSS styled imagetext
   -  create a set of TemplaVoila! flexible content elements to allow
      definition lists and other tags not supported by standard content
      elements

Raise the awareness for the accessibility topic
-----------------------------------------------

-  Provide built in documentation and links to WAI guidelines in the
   backend

Force accessibility input
-------------------------

There should be a parameter like "forceAccessibility" to validate user
input according to accessibility needs and require correct input. A.e.
entering alt for every graphic is required, title for every link is
required...

Alting every graphic isn't required at all, only graphical element that
bring information to the context of the page is required. That mean,
that if a graphical element, is place on a page only tu make it nicer to
look this element should be alted with an empty string eg : alt="". in
this case, user-agent that speak the content of the page avoir to
describe graphical elements that do not give more information to the
content of the page
