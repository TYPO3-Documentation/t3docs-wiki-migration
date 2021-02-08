.. include:: /Includes.rst.txt

================
Frontend editing
================

.. container::

   **Content Type:** `FAQ </Category:FAQ>`__ [deprecated wiki link].

.. container::

   notice - This information is outdated

   .. container::

**Frontend editing** is a concept which has been implemented in TYPO3
for some time now. The concept simply means that the editing of page
content can be done either directly on the page or at least be initiated
by clicking a link close to the content you wish to edit. This can
simplify the content administration tasks for less technically educated
editors.

Note that technically frontend editing is for backend users only - this
can be to some extent hidden to users using some extensions (references
needed here).

Step by step guide to configuring frontend editing
==================================================

Make sure the extension Frontend Editing (**feedit**) is enable in the
extension manager before doing the following configuration.

**1. Edit the template's SETUP section of your website's root page and
add :**

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

       // Show admin panel
       page.config.admPanel = 1

| 
| **2. Create a backend usergroup that will be allowed to edit this
  website.**

**Advice:** if your run multiple websites in the same TYPO3
installation, create a different usergroup for each website, so that
users which are allowed to edit one website are not allowed to edit
another website if not explicitly added to the other website's
usergroup.

-  Add the following code to the usergroup's
   `TSconfig </Category:TSconfig>`__ [deprecated wiki link] field :

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

       admPanel {
        enable.edit = 1
        module.edit.forceNoPopup = 0
        module.edit.forceDisplayFieldIcons = 1
        module.edit.forceDisplayIcons = 0
        hide = 0
       }

Typoscript reference for these variables can be found here : `TSconfig
Reference <https://docs.typo3.org/typo3cms/TSconfigReference/UserTsconfig/AdmPanel.html>`__

-  Tick "Include Access Lists" check box and properly setup all excluded
   fields so you specify witch form elements can be edited or not by
   users. At first you should enable all elements until frontend editing
   works properly, then later you should carefully remove elements and
   test editing while being logged with a group's member editor profile
   to figure if things still work correctly with the rights removed.

-  Add the root page of the website intended to be edited to the "DB
   Mounts" field and you must make sure the entry you just added is
   selected (background colored) in the list.

-  Add a filemount, you would have previously defined to the "File
   Mounts" field. This filemount is the place where your frontend
   editing users will upload the images and documents they may put on
   the website.

-  Don't forget to save the usergroup just created.

| 
| **3. Switch to the "Web > Access" module. in the top right select box,
  select "permissions", and click on the pencil aside your website's
  root entry.**

-  In the "Owner" field, put the administrator user.
-  In the "Group" field, select the usergroup you just created.
-  Activate all checkboxes for "owner" and "group".
-  In the blank select box at the bottom, select "Set recursively
   (biggest level count number) levels" to apply the rights change to
   all the pages of your website.

| 
| **4. Create a backend user and assign it the usergroup you just
  created.**

| 
| **5. In the "Install tool", section "All configuration", change
  variable [BE][interfaces] to either "frontend", or "backend, frontend"
  (to display a pull down menu with both options)**

| 
| **6. Log out of your backend session, and go
  to**\ http://www.yoursite.com/typo3/\ **[not available anymore] . The
  login form should now include a new select box named "Interface".
  Select the "Frontend" entry, and type the login and password of the
  frontend editing user you just created. You should now see your
  website with all the pencil icons aside the contents.**

Links
=====

-  About configuration of Admin panel using TSconfig
   `[1] <https://docs.typo3.org/typo3cms/TSconfigReference/UserTsconfig/Index.html>`__
   ( see ->admPanel)
