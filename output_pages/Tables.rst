.. include:: /Includes.rst.txt

======
Tables
======

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript.
      `info </Help:Contents#Teamwork_-_draft_review_publish_delete_merge_outdated>`__
      [deprecated wiki link]

A reference of tables and their fields used in the TYPO3-core.

pages
=====

Every page in TYPO3 has row in the pages table.

+-----------------------+-----------------------+-----------------------+
| **Field name**        | **Type**              | **Value**             |
+-----------------------+-----------------------+-----------------------+
| l18n_cfg              | Bitmask               | Controls the          |
|                       |                       | visibility of this    |
|                       |                       | page in when when a   |
|                       |                       | translation does not  |
|                       |                       | exists. **Values:**   |
|                       |                       |                       |
|                       |                       | +---+-------------+   |
|                       |                       | | 1 | Hide        |   |
|                       |                       | |   | default     |   |
|                       |                       | |   | t           |   |
|                       |                       | |   | ranslation. |   |
|                       |                       | +---+-------------+   |
|                       |                       | | 2 | Hide when   |   |
|                       |                       | |   | no          |   |
|                       |                       | |   | translation |   |
|                       |                       | |   | exists.     |   |
|                       |                       | +---+-------------+   |
+-----------------------+-----------------------+-----------------------+

tt_content
==========

Content elements linked to the pages table with the "pid" entry.

cf_cache_pages_tags
===================

tag e.g., pageId_23 identifier ... hash (used in the cf_cache_pages
table)

cf_cache_pages
==============

contains the cache in the column "content" and is referenced by
identifier (identifier of cf_cache_pages_tags) expires ... date when
cache entry expires

cf_cache_pagesection_tags
=========================

tag e.g., pageId_23 identifier ... has (used in cf_cache_pagesection
table)

cf_cache_pagesection
====================

identifier ... same as in cf_cache_pagesection_tags table content ...
cache content expires ... date when cache entry expires
