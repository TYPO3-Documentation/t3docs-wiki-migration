.. include:: /Includes.rst.txt
.. highlight:: php

=============
RFC Structure
=============

Common Principles
=================

From: ftp://ftp.isi.edu/in-notes/rfc2223.txt [outdated link]

First Page
==========

Please see the front page of this memo for an example of the front page
heading. On the first page there is no running header. The top of the
first page has the following items:

Network Working Group

::

   The traditional heading for the group that founded the RFC
   series.  This appears on the first line on the left hand side
   of the heading.

Request for Comments: nnnn

::

   Identifies this as a request for comments and specifies the
   number.  Indicated on the second line on the left side.  The
   actual number is filled in at the last moment before
   publication by the RFC Editor.

Author

::

   The author's name (first initial and last name only) indicated
   on the first line on the right side of the heading.

Organization

::

   The author's organization, indicated on the second line on the
   right side.

Date

::

   This is the Month and Year of the RFC Publication. Indicated on
   the third line on the right side.

Updates or Obsoletes

::

   If this RFC Updates or Obsoletes another RFC, this is indicated
   as third line on the left side of the heading.

Category

::

   The category of this RFC, one of: Standards Track, Best Current
   Practice, Informational, or Experimental.  This is indicated on
   the third (if there is no Updates or Obsoletes indication) or
   fourth line of the left side.

Other Numbers

::

   Other numbers in the RFC series of notes include the subseries
   of FYI (For Your Information) [4], BCP (Best Current Practice)
   [5], and STD (Standard) [6].  These are placed on the left
   side.

Title

::

   The title appears, centered, below the rest of the heading.
   Periods or "dots" in the titles are not allowed.

If there are multiple authors and if the multiple authors are from
multiple organizations the right side heading may have additional lines
to accommodate them and to associate the authors with the organizations
properly.

Status Section
==============

Each RFC must include on its first page the "Status of this Memo"
section which contains two elements: (1) a paragraph describing the type
of the RFC, and (2) the distribution statement.

Introduction Section
====================

Each RFC should have an Introduction section that (among other things)
explains the motivation for the RFC.

Examples:

-  Discussion

::

   (The purpose of this RFC is to focus discussion on particular
              problems)

-  Interest

::

   (This RFC is being distributed to members of the
              community in order to solicit their reactions to the
              proposals contained in it.)

-  Status Report

::

   (In response to the need for maintenance of current
              information about the status and progress of various
              projects in the Internet community, this RFC is issued for
              the benefit of community members)

References Section
==================

Nearly all RFCs contain citations to other documents, and these are
listed in a References section near the end of the RFC. There are many
styles for references, and the RFCs have one of their own. Please follow
the reference style used in recent RFCs. See the reference section of
this RFC for an example. Please note that for protocols that have been
assigned STD numbers, the STD number must be included in the reference.

In many standards track documents several words are used to signify the
requirements in the specification. These words are often capitalized.
BCP 14, RFC 2119 [3], defines these words as they should be interpreted
in IETF documents.

Security Considerations Section
===============================

All RFCs must contain a section near the end of the document that
discusses the security considerations of the protocol or procedures that
are the main topic of the RFC.

Author's Address Section
========================

Each RFC must have at the very end a section giving the author's
address, including the name and postal address, the telephone number,
(optional: a FAX number) and the Internet email address.
