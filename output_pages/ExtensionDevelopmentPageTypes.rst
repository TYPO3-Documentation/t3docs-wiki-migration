.. include:: /Includes.rst.txt

================================
Extension Development page types
================================

.. container::

   This page belongs to the `Extension coordination
   team <https://wiki.typo3.org/ECT>`__ [deprecated wiki link] (category
   `ECT <https://wiki.typo3.org/Category:ECT>`__ [deprecated wiki link])

page types (type,typeNum) used by extensions
============================================

This page gives an overview of which page types are used by other
extensions already. Although the page type (typeNum) is configurable, it
is advisable to choose a type that is not used by any other extension
yet.

NOTE: some of these typeNums might get obsolete with TYPO3 4.0 where
extensions can `hook <https://wiki.typo3.org/Category:Hook>`__
[deprecated wiki link] up into index.php and take over the rendering of
the page via the eID HTTP GET parameter. But for backwards compatibility
we should try to stick with these reserved typeNums.

News (EXT:tt_news)
==================

100-110 for various XML export formats like RSS, RDF or ATOM. Actually
only 100 is used by default, but users can configure additional XML
formats or different feeds for different categories and thus it is
needed to keep at least a range of 10 page types free.

Sitemgr (EXT:sitemgr)
=====================

157 for indicating that the page is of type customer

TIMTAB (EXT:timtab)
===================

200 for XML-RPC Server, might get opened for other extensions using
XML-RPC if the Server component gets moved into an own extension

AJAX Server (EXT:ajax) (not published yet)
==========================================

500 for `Ajax <https://wiki.typo3.org/Category:Ajax>`__ [deprecated wiki
link] communication

jEdit TypoScript external editing (EXT:jeditvfs)
================================================

761 for XML-RPC service

Photoblog (EXT:photoblog)
=========================

1000 for XML feed service

Atom Feed Publisher (EXT:jl_atom) (not published yet)
=====================================================

2008 for web feeds in Atom format

TYPO3 Podcast Extension (EXT:nbo_podcast)
=========================================

9009 for podcast XML

Category-System (EXT:toi_category)
==================================

201 for Category Pages

Direct Mail (EXT:direct_mail)
=============================

99 for plaintext version of the newsletter

199 for plaintext preview of the newsletter

File Page (EXT:filepage)
========================

157 for file pages. this value is configurable.

Cart (EXT:cart)
===============

181 for "Cart: Cart"

182 for "Cart: Product"

183-185 for some planned features

| 
| PLEASE ADD YOUR EXTENSIONS HERE
