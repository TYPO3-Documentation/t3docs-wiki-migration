.. include:: /Includes.rst.txt
.. highlight:: php

=============
WikiMigration
=============

Wiki Migration to docs.typo3.org
================================

This describes how migration of **some pages** from wiki.typo3.org to
docs.typo3.org could be done. (This does not mean that everything will
and must be migrated!)

General information
===================

-  Wiki Coordination [outdated wiki link]
-  Overview of the Wiki [outdated wiki link] (contains some information
   about types of pages, categories, number of pages etc.)

What should be migrated?
========================

-  information that is duplicate in https://wiki.typo3.org [outdated
   wiki link] + https://docs.typo3.org
-  information that fits in an existing manual on https://docs.typo3.org

Here are some issues with lists of Wiki pages that have already been
identified and could be moved:

-  https://github.com/TYPO3-Documentation/TYPO3CMS-Guide-HowToDocument/issues/43
-  https://github.com/TYPO3-Documentation/TYPO3CMS-Guide-Extbase/issues/139
-  https://github.com/TYPO3-Documentation/TYPO3CMS-Guide-ContributionWorkflow/issues/58

How to migrate?
===============

-  review information in Wiki. Is there any content that should be
   saved: move it to an existing manual on docs.typo3.org
-  is the text up to date and still relevant?
-  take care not to bloat existing content: keep it short and to the
   point, make it easy for people to find relevant information. We do
   not have to consider every edge case!

When you are done migrating
===========================

-  remove existing content in Wiki page, but keep the page
-  **add a link to new content**

Example: The content on this page was moved to the
[https://docs.typo3.org/m/typo3/guide-contributionworkflow/master/en-us/
Official TYPO3 Contribution Guide - Core Development]

-  Add the {{delete}} tag: this marks the page as a candidate for
   removal

Where can I ask questions?
==========================

-  Come to Slack channel **#typo3-wiki** (`Register for
   Slack <https://my.typo3.org/about-mytypo3org/slack/>`__ to talk about
   Wiki
-  Get help for writing for docs.typo3.org in **#typo3-documentation**
   Slack channel.
