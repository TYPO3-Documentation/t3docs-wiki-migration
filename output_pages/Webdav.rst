.. include:: /Includes.rst.txt
.. highlight:: php

======
WebDAV
======

.. container::

   This page belongs to the WebDAV integration project (category Project
   [outdated wiki link])

Current Project Members
=======================

-  Karsten Dambekalns, karsten@typo3.org
-  Andreas Förthner [outdated link], andreas.foerthner@netlogix.de
-  Daniel Schiffner [outdated wiki link]
-  Clemens Kalb, clemens.kalb@netlogix.de
-  Marc Bastian Heinrichs, typo3@mbh-web.de
-  Christophe Balisky [outdated link], cbalisky@metaphore.fr

Tentatively
-----------

-  Mario Matzulla

| 
| Those named above: please (re)move your name as you see fit. If you
  like, add your email address.

| i would prefer everybody creating an account and making use of the
  "signature" button to link to his user-page
| --Daniel Schiffner [outdated wiki link] 11:15, 14 October 2006 (CEST)

I would love people to make use of shift and capitalize letters, as well
as use proper punctuation. Sounds like nitpicking, but makes things
easier to read. Thanks. --k-fish [outdated wiki link] 09:48, 6 November
2006 (CET)

Communication
=============

Right now we are only few, so maybe writing emails with everyone in copy
is good enough. If not we could ask for a mailing list/newsgroup.

Wishlist
========

For a first usable version:

-  Basic WebDAV support for fileadmin
-  Access to the page tree as a folder structure
-  Access to template records as constants.txt and setup.txt

Afterwards:

-  ...

Implementation suggestion
=========================

The basis for WebDAV integration is to be a basic WebDAV server
extension based on the PEAR WebDAV implementation. It can be extended
through services that provide specific ways of exposing certain record
types or specific data through WebDAV. Services for file access in the
fileadmin and basic template handling should be provided with the base
extension.

Based on this, every extension could provide a service to render it's
content as some file that can be handled through WebDAV, as seems
appropriate. An extension could of course also have the sole purpose of
exposing some content via WebDAV.

Existing Implementation
=======================

extension meta_ftpd implements webdav and ftp support for filemounts and
webmounts.

--------------

Just some of my thoughts:

Let it be as abstract as possible, so that we can use it for any kind of
data we want to deliver via WebDAV. That's why we wanted to have an
"abstract" server extension and the concrete methods of
interpreting/delivering data should be implemented in various services.
(That's basically the point Karsten already mentioned) At the moment we
should concentrate on the server part. To design a strong concept that
should give us the mentioned flexibility.

I have some very vague imaginations about this, that came to me, when I
heard the TYPO3 5.0 talk from Karsten and Robert at the t3con. The
direction of the content repository conecpt (or at least the object
model ideas of it) could perhaps fit our needs. Is it possible to define
objects with some meta data to render them in a tree structure of a
WebDAV client? Perhaps this would be possible. Any comments? Any
concrete ideas?

Another topic would be versioning. The WebDAV standard principally
includes that. How can we connect this with the TYPO3 versioning system?
Do we want that? Or how should we design the server to be able to
implement this in a second step.

One basic thing, we also should keep in mind ist, to develop something
that can smoothly be integrated in the new 5.0 architecture. I think
especially Karsten will be able to comment on this.

So just another point. I had some troubles with our test-server, so I
wasn't able to test anything in the last two weeks. Perhaps I can do
this on weekend. I hope I can tell you some more stuff in the next two
weeks.

Feel free to comment, criticise or whatever.

--Andreas Förthner [outdated link] 19:49, 23 October 2006 (CEST)

Sounds very interesting! I added a relations-section for you and put in
the ContentRepository-project. You easily can add more projects, what
are relating to WebDAV, too. For example Users Addresses [outdated wiki
link] could be a candidate. --Daniel Brüßler [outdated wiki link] 20:50,
23 October 2006 (CEST)

Roadmap
=======

none, yet...

Tasks
=====

-  Create API documentation from the PEAR WebDAV sources, official docs
   don't exist.

| 
| I started playing around with the Pear package, trying to get it up
  running. First you have to use
| *pear install -f HTTP_WebDAV_Server*
| as there is no stable version, just RC3. After that you can include
  the package with
| *require_once('HTTP/WebDAV/Server/Filesystem.php');*

--Daniel Schiffner [outdated wiki link] 20:29, 14 October 2006 (CEST)

now that i had a short look at the Pear sourcecode, it seams that a
whole bunch of methods has not been implemented right now, looks like
lots of work

--Daniel Schiffner [outdated wiki link] 20:27, 14 October 2006 (CEST)

Of course it is not implemented, this is not what it was intended to be.
It provides an abstract class that handles the lowlevel protcol stuff.
Everything above this must be implemented by us, and of course this is a
good thing, because then we are able to develop a class that perfectly
fits our needs.

--Andreas Förthner [outdated link] 19:49, 23 October 2006 (CEST)

| 
| **First ideas for an API**

Sorry for being so quiet in the last weeks, there where just too many
thing to do. But now I have written my ideas down an can proudly present
them to you. Here is what I think the WebDAV support could look like.

We have one central server extension (this is what I will call "server")
that will provide the general dav interface and many services that can
promote their data to the client (this is perhaps most likely some
filebrowser addon in your os) via the server.

We will have the following things to serve:

Every data item must be structured in a filesystem tree with directories
and files. This might be kind of difficult, but that's why we're
here ;-) For the filesystem (fileadmin most likely) this is no problem,
but what about the pagetree and especially the content or other records
on the pages? Ok, let's see... What we can see for now is, that there
are some completely independent trees: filesystem and pagetree - maybe
there are many more. This is the first thing we have to define. My idea
is to have the server as a general registration point, where
root-services (why, root? you'll see later...) can register new trees.
These trees are served just next to each other in the root of our dav
directory tree. These services are responsible for the directory
structure, e.g. the fileadmin dirs or the pages, let's call them nodes,
in a more general way. To put data in our nodes, we will use files as
this is the only way to serve data via dav. But there are many different
file types, or database records, or whatever, that need complete
different ways of handling. So my idea is to create sub-services to our
root-service, that can register new "filetypes" and then let the
root-service ask his sub-services to fill the nodes. Let's summarize
this: We have a WebDAV server, that does the lowlevel stuff.
Root-services register filetrees at the server to serve a node
(directory) structure. The files in the nodes (the data) come from
sub-services that can register filtypes at their root-service.

An example of a basic client - server communication to make this clear:

Client: PROPFIND /some/dir/

Server:

-  The appropriate root-service is asked for the directory structure.
-  The root-service asks its sub-services to fill the requested node
   with files/data.
-  The root-service passes the results to the server.
-  The server compiles the data and sends it back to the client.

Now we can look at our data, great. Now the part of working with this
data/files:

In this case we have to implement the dav protocol with its functions.

-  MKCOL: create a new node, the appropriate root-service which is
   responsible for the current tree has to handle this.
-  PROPFIND (now on a file, not a directory): the appropriate
   sub-service has to give us some additional information about the
   data/file
-  PROPPATCH: pass the data to the appropriate sub-service to update its
   metadata for the file.
-  COPY, MOVE: yeah, does what it says, the appropriate sub-service has
   to handle this one, too.
-  LOCK, UNLOCK: the dav protocol lets us lock/unlock our data, I think
   the sub-service should handle this, too.

For all this the server and the root-services have to know which
root-service or sub-service handles the given request. For the
root-services this is relatively easy, because it's given by the
directory path. But what about the sub-services? Perhaps we can
distinguish them by filenames? I don't know if this is the best idea,
but I didn't have a better one for now. So any ideas are welcome.

| 
| Principally the WebDAV standard also includes versioning, but I think
  this is beyond our scope at the moment. I think we will integrate it
  when the TYPO3 5.0 CR gives us versioning support ;-)

In general I would like to have the WebDAV interface for the current
version 4, but also ready for the coming version 5.0 where it's already
on the roadmap. So I will try to follow the actual development for the
5.0 branch and try to develop our extension also in the view of it.

| 
| Yeah, this was pretty long, but I hope we now have a basis we can
  discuss on and perhaps can start implementing in the next weeks. So
  please give me feedback, this is your chance to bring your thoughts
  in.

Ok, I think I'll have a beer now... ;-)

--Andi [outdated link] 21:53, 20 November 2006 (CET)

Sponsoring
==========

as i can speak for myself, i am a poor student and would welcome any
sponsorship for this project ;-) feel free to contact me about that or
go here:
`wishlist <http://www.amazon.de/gp/registry/registry.html/ref=em-si-html_viewall/028-0565586-8857361?id=LL1PYTGP2Z3O>`__

--Daniel Schiffner [outdated wiki link] 20:58, 13 October 2006 (CEST)

Relations
=========

**relating projects** (edit this [outdated wiki link], *in alphabetical
order*)

-  TYPO3 Neos Content Repository [outdated link]
-  maybe a relation to lib/div (can provide data for the MVC Framework
   [outdated wiki link])
-  DAM aka Digital Asset Management [outdated link] - features advanced
   metatagging and categorisation of assets
-  WebDAV, Apache2 Typo3 WebDAV [outdated wiki link] - client - needs
   meta data to render objects in a tree structure

Resources
=========

-  Material related to WebDAV from TYCON3 2005,
   http://projects.fishfarm.de/webdav/ [outdated link]
-  Setting up WebDAV for TYPO3 with external tools [outdated wiki link]
   --k-fish [outdated wiki link] 09:46, 6 November 2006 (CET)
-  PEAR WebDAV implementation,
   http://pear.php.net/package/HTTP_WebDAV_Server/download
-  CalDAV - Calendaring Extensions to WebDAV,
   http://www1.ietf.org/mail-archive/web/ietf-announce/current/msg03007.html
   [outdated link] - might prove interesting at a later stage
-  There is an implementation of a WebDAV server in ezpublish which you
   can download at http://ez.no --Daniel Schiffner [outdated wiki link]
   00:46, 14 October 2006 (CEST)

   -  Might be interesting to look at, but is not usable for us, as it
      depends on a ton of ezpublish libraries. --k-fish [outdated wiki
      link] 09:50, 6 November 2006 (CET)
