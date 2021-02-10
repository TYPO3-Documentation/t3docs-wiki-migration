.. include:: /Includes.rst.txt

====================================
Backend user group permission system
====================================

What's it all about?
====================

This document is about a system of backend user groups useful for larger
sites with quite some authors.

The systems consists of

#. a *"basic_editor" user group* defining rights given to all authors
   who should write new pages without the permission to make them public
#. a *"basic_chief_editor" user group* with all the rights given to the
   "basic editors" and additional rights for "chief editors"
#. a *"domain" user group per customer* linking the users in the "basic
   editor" and "basic chief editor" groups to a special site

The "basic_editor" user group
=============================

::

    Modules
      web, web_list, web_layout, web_view
      file, file_list, file_images
      user, user_task, user_actions, user_setup

::

    Tables (listing)
      Internal note    (Aim: Reading guiding notes from "chief editors" for pages)

::

    Tables (modify)
      Page
      Pagecontent

::

    Page types
      Advanced ( Special? Advanced is not listed)

::

    Allowed excludefields
      Page: Type
      Page: Keywords (,)
      Page: Abstract
      Pagecontent: Type
      Pagecontent: Before
      Pagecontent: After
      Pagecontent: Width (pixels)
      Pagecontent: Height (pixels)
      Pagecontent: Link
      Pagecontent: Click-enlarge
      Pagecontent: Quality

::

    No DB mounts, no File Mounts

The "basic_chief_editor" user group
===================================

::

    Modules
      web_perm
      web_func

::

    Tables (listing)

::

    Tables (modify)
      Internal note

::

    Page types
      External URL
      Shortcut
      Not in menu
      Spacer

::

    Allowed excludefields
      Page: Hide page
      Page: Start
      Page: Stop
      Page: Access
      Page: Include subpages
      Page: Select template (when using Modern Template Building)
      Page: Select content area template (when using Modern Template Building)
      Pagecontent: Hide
      Pagecontent: Start
      Pagecontent: Stop
      Pagecontent: Access

::

    No DB mounts, no File Mounts

::

    Sub groups
      basic_editor

The "domain" user group
=======================

::

    DB Mount
      Rootlevel page of the specific customer

::

    File mount
      Fileadmin folder of the specific customer

::

    Annotation: You may want to split this into a File mount for editors and a File mount for chief editors ...

Putting it together
===================

::

    Max Sampleman should be an editor for domain xyz.com
      1. Create a new backend user Max Mustermann
      2. Select the groups
        xyz_com (=domain group)
        basic_editor

::

    Jenni Samplewoman should be a chief editor for domain xyz.com
      1. Create a new backend user Jenni Samplewoman
      2. Select the groups
        xyz_com (=domain group)
        basic_chief_editor

::

    Make sure the pages of your tree for a domain have the right group permissions assigned in the "Web > Access" module.

What is missing here?
=====================

::

      User TypoScript entries
      User groups for special purposes
        e.g. activate guestbook entries

Documentation Links
===================

are there some?

Typo3 `User Management <http://www.infolagret.se/index.php?id=594>`__ -
infolagret.se
