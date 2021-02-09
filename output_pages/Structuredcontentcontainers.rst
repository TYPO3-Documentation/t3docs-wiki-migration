.. include:: /Includes.rst.txt

.. _structuredcontentcontainers:

======================================
Blueprints/StructuredContentContainers
======================================

`<- Back to blueprints overview <https://wiki.typo3.org/Blueprints>`__
[deprecated wiki link]

Blueprint: Grouped and nested content structures in the page module
===================================================================

+----------------------+----------------------------------------------+
| Proposal             | The core must provide structured content     |
|                      | elements which are configurable similar to   |
|                      | backend layouts out of the box               |
+----------------------+----------------------------------------------+
| Owner/Starter        | Jo Hasenau                                   |
+----------------------+----------------------------------------------+
| Participants/Members | -                                            |
+----------------------+----------------------------------------------+
| Status               | Draft, Discussion, Voting Phase,             |
|                      | **Accepted**, Declined, Withdrawn            |
+----------------------+----------------------------------------------+
| Current Progress     | Unknown, Started, **Good Progress**, Bad     |
|                      | Progress, Stalled, Review Needed             |
+----------------------+----------------------------------------------+
| Topic for Gerrit     | {gerrit_topic}                               |
+----------------------+----------------------------------------------+

Target Versions/Milestones
--------------------------

-  To be defined

Goals / Motivation
------------------

Some history
^^^^^^^^^^^^

In the early days of TYPO3 we had a simple two level approach to
structure content and other records in the page and the list module. The
main structure usually was created by some pages, that could be real
pages or just folders containing other records. On the second level
there were records of different tables without additional structure.

The only exception was the **table tt_content and its field colPos**,
that offered at least one additional option to structure content
elements more granular. By default there were **4 columns, left, normal,
right and border**. But you could easily extend them by adding more
columns and respective labels. Each of these columns was still shown
side by side though. Nesting content was no option by default, but you
could create some new fields and add them via TCA to be able to connect
certain content element types with other records of different tables.
Still you had to edit these records separately, which was quite
cumbersome.

This concept was drastically changed by two different developments:
**TemplaVoila (TV) and Inline Relational Record Editing (IRRE)**.
**TemplaVoila** broke up the default structures of the page module
completely and made it possible to tie them to the structures of
XML-files in most of the cases created semi-automatically from HTML
files with a point and click interface. On the other hand **IRRE** has
made it possible to relate records with each other while still being
able to edit each of them within just one go - namely “inline”. As a by
product of TemplaVoila we got the so called **Flexforms**, which are
based on similar XML-structures containing even larger amounts of
virtual fields, which are then saved to the database within just one
flexform field.

Since TYPO3 version 4.5 there is another option available, that takes
over the structuring part on the page as the first level of the TYPO3
content structures - it’s called **Backend Layouts and makes use of a
TSconfig like array instead of XML**. The layout is assigned to pages
and respective branches of the pagetree by a relation to the uid of a
layout record only, while the actual structure comes from this layout
record and is not saved within a field of the page itself. The advantage
is, that you can **easily change the structure** even while having huge
amounts of pages without having to migrate the XML field values in the
database. And you can use **basic queries to collect information** via
SQL joins instead of having to parse comma separated lists of uid values
out of XML structures.

Since TYPO3 6.2 it is even possible to create **configuration files for
these structures** instead of layout records in the database. These
configurations are collected via a **data provider**, which makes it
possible to use a naming scheme for layouts instead of auto incremented
record uids. This way you can **easily exchange backend layouts**
between different systems without having to map old uid values to new
ones. And of course this enables people to use their favorite
**versioning tools to manage these files** in a professional manner.

The current state for that first level is close to being feature
complete. It is still providing the default columns out of the box to
stay as backwards compatible as possible, but you can easily create even
very complex page structures with the backend layout wizard. Some
features, which have been available with TemplaVoila, are still missing
though. First of all the so called **“unused elements” - a virtual
column** containing all those elements, that have no matching column in
the currently selected backend layout. And it is not possible yet to
define which types of content elements are **allowed in certain
columns** of the backend layout.

Limitations, problems and demands of the current state
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

While using the backend layouts works quite comfortable for most of the
TYPO3 users nowadays, there are still some problems we have to tackle.
Especially when it comes to more complex page structures, which you
might know from the famous “one pagers” that are widely used as landing
pages or simple websites, the current solution quickly shows its
limitations.

As soon as you want to make use of **lots of different combinations** of
numbers of rows and columns, you will have to **increase the number of
layouts** to choose from to an almost unmanageable amount. Of course you
could be more restrictive and decide which of the possible variants you
find necessary, but this on the other hand would **limit the
flexibility** for the editors. So you will always find yourself in the
middle of a questionable compromise situation.

But there will be another problem, when you want to move elements within
the same page or maybe even from one page to another. Since the
structure provided by the TYPO3 core currently is limited to pages only,
you **can not move larger groups** of content elements but just single
elements, which makes the job of moving or copying a row of i.e. 4
elements to another place quite time consuming. Additionally the amount
of time wasted with these actions **will grow exponentially with the
complexity of the page structures** and the number of elements you want
to actually be able to change at once. Especially **from an
accessibility point of view this hurts** a lot, since it is already hard
enough to handle the backend when you just have a keyboard and/or a
screenreader but no mouse available.

Due to the fact that most of the frontend output we are creating is
HTML5 based nowadays, we will be in need for grouping elements anyway.
There are things like **section, header, footer, nav,** and **aside**
now and we will have to provide something else than the usual wraps to
enable editors to make use of them. So there is not just a demand due to
editors and their user experience but also a **technical demand for a
container solution** in the TYPO3 core due to more modern **semantic
concepts** in the underlying markup languages for the frontend output.

Concept
-------

Available solutions for structured container elements
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To get a working solution for structured containers in the TYPO3 core,
we must tackle the issues explained before, **while staying as backwards
compatible and performant as possible**. The solution must be **easily
configurable** and should provide an **improved user experience** while
avoiding to get too distracting or confusing when using these elements
especially in the page module. Taking a look at the existing solutions
in the TER you will see that there are currently just a few relevant
solutions, since most of the others are either outdated, abandoned or
don’t have too many downloads.

Counting the number of downloads, first of all there is of course
**TemplaVoila**, next on the list is **Gridelements**, followed by
**Flux/Fluidcontent**. There once was **jfmulticontent** on the second
position, but it seems the extension is abandoned now. While
**TemplaVoila** provides XML based structures only and is currently
unable to feed the backend layout data provider with a proper
configuration, **Gridelements** makes use of the same configuration and
the same wizard as the original backend layouts and it can use both,
records and files to store the layout configuration.
**Flux/Fluidcontent** is a kind of hybrid, since it uses similar XML
structures as TV does for the storage of configurations, but it can
provide the original core backend layouts also, namely via the built in
dataprovider of the core. As almost anything in the Fluidtypo3
environment, these layouts are created based on fluid. So basically
Fluidtypo3 provides a Fluid layer to configure a Flexform, the backend
structure and the frontend output from within one Fluid file.

Each of the three extensions provides lots of additional features that
are actually not really related to the task of providing structures for
content element containers, **so these features should not be the target
of this blueprint**.

Taking a closer look at other extensions in the TER you will quickly
notice that the **dataprovider** is the key feature for the current
backend layouts of the core, which makes them compatible to almost any
other approach. So one of the goals must be to provide a **rock solid
and performant solution** on the one hand, while still using a
**dataprovider to stay compatible to existing extensions** and making it
easy for their developers to connect to the new structure API providing
their own structures as well. The ideal solution would be **compatible
to each of the current solutions** for structured content and have
m\ **inimum efforts to migrate** existing content. In the end this will
**increase the overall acceptance** of our new official solution.

Features for structured container elements
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Based on the way the current page module is already working and combined
with the experience we have with the mentioned extensions we will need
the following features to provide a working solution for structured
container elements:

Must haves
''''''''''

-  Configurable structures
-  Dataprovider to easily provide structures from within third party
   extensions
-  Same HTML, CSS classes and JS triggers as the current page module
-  Normalized IRRE relations (additionally enables editing of parent and
   children in one go)
-  Unique Aliases instead of UIDs to make container structures
   exchangeable
-  Same configuration syntax as the current configuration of backend
   layouts
-  Works flawlessly with languages, workspaces, export/import, reference
   index
-  Basic functionality of the page module available (D&D, Copy & Paste,
   Move, Create)
-  Wizard to create structures and manage rights with a point and click
   interface
-  Solution for unused elements
-  Recommended default frontend output for each container element
   (regardless of the structure) to at least show children without
   additional wrapping
-  Management for both, container and page structures regarding allowed
   elements and visibility for users

Should haves
''''''''''''

-  No conflicts with extensions like TV, Flux/Fluidcontent or
   Gridelements (provided they are made compatible to that particular
   LTS version of TYPO3 CMS)

Could haves
'''''''''''

-  Resize or toggle areas to avoid confusion within larger content
   structures (maybe even storable per user)
-  Preset of frontend configurations for default containers with basic
   wrapping
-  Custom colors, icons or other design features per layout to help
   users distinguish between different container elements.
-  Extended rights and access management, who may see/edit which element
   types in which area
-  Multi-selection of CEs to move more than one item (but without
   additional container, as it is with EXT:gridelements)

Won’t haves
'''''''''''

-  Flexform for additional fields or other FCE like stuff. (Can still be
   provided by extensions)
-  Drag In Wizard like the one provided by Gridelements (should be
   tackled in another task)
-  Additional comfort features that are actually not related to
   structured containers (should be tackled in another task or provided
   by extensions)
-  Confusing wireframe view with many many nested containers and
   horizontal scrollable Screen

Goals for structural container elements
---------------------------------------

The final goal should be to provide at least the must haves within the
next two versions of TYPO3 CMS.

Implementation Details
----------------------

First we will discuss things on slack and then create user stories on
https://forge.typo3.org/issues/67134 Then we will put up the concept for
decision on http://decisions.typo3.org Finally when we know WHAT we want
to achieve and WHY we actually want it to be like that, we can go for
the details of HOW to implement it.

Risks
-----

Issues and reviews
~~~~~~~~~~~~~~~~~~

-  https://forge.typo3.org/issues/67134 The core must provide structured
   content elements which are configurable similar to backend layouts
   out of the box

Dependencies upon other Blueprints
----------------------------------

Since the original page columns are conflicting already with the way
TYPO3 is sorting/moving content elements in the list module, there will
be even more reasons to take care of
`Blueprints/RecordMoveActions <https://wiki.typo3.org/Blueprints/RecordMoveActions>`__
[deprecated wiki link] as well as soon as there is another level of
content structures. The list module must be made at least "column aware"
and get some bugs fixed, which are partly in the code and partly in the
concept of "move after" actions.

External links for clarification of technologies
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
