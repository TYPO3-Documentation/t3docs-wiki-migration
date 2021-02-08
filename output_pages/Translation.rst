.. include:: /Includes.rst.txt

.. _translation:

============
Translations
============

.. container::

   This page belongs to the TYPO3 Core & Extensions Translation project
   (category `Project </Category:Project>`__ [deprecated wiki link])

.. container::

   notice - Note

   .. container::

      **Current translation process:** The most important extensions are
      available on the translation server. After a translation has been
      done there, the official translations will be updated on TER in
      the evening. Create a task on the
      `Forge <https://forge.typo3.org/projects/show/team-translation>`__
      if you want to have an extension added to the translation server.

Projects
========

-  `Support for XLIFF </Support_for_XLIFF>`__ [deprecated wiki link] is
   available in TYPO3 4.6. To be able to use XLIFF, a new `Translation
   Server <http://translation.typo3.org>`__ based on Pootle has been set
   up.

A `very good page with information about localization management with
XLIFF <http://xavier.perseguers.ch/tutoriels/typo3/articles/managing-localization-files.html>`__
[not available anymore] has been set up by Xavier Perseguers.

Translation Workflow
====================

There are 3 different groups of users:

-  language administrator
-  team members
-  everyone else with a typo3.org user account

The task for "language administrator"
-------------------------------------

-  add new translators to his team
-  have a final decision in translation conflicts
-  remove translators that do not follow the common terminology
-  normal tasks that belong to each "team member"

The task of "team members"
--------------------------

-  translate the core and extensions that are available on the
   translation sever
-  set the common terminology
-  accept (merge) translations sent by users, who are no team members
   ("everyone else with a typo3.org user account")

Possibilities of "everyone else"
--------------------------------

-  Propose translations for changed or missing (new) labels
-  respect the common terminology

Originally based on `"process of translating TYPO3 (core and
extensions)" by Kasper <https://typo3.org/extensions/translate/>`__ [not
available anymore].

Translation process
===================

Here is a short overview. The following sections will go more in detail.

Just visit the `translation server <http://translation.typo3.org/>`__
and propose translations for texts which you think are incorrect.
Translation team members will review your proposals and choose a fitting
version based on the common vocabulary for the language. If you would
like to do more and engage yourself for a longer time, you can become a
translation team member. If you want to become a team member, you have
to do the following: Login on `typo3.org <http://typo3.org>`__ and then
visit the translation server. Afterwards write an e-mail to the
`language administrator of your language <#Translation_Teams>`__
[deprecated wiki link]. He can make you member of the translation team
for your language so that you can do your translation work.

Extensions available for translation
------------------------------------

The translation server is not only a place to translate the language
files of the TYPO3 core: We can also translate
`extension </Category:Extension>`__ [deprecated wiki link]s there. Right
now only manually added extensions can be translated. If your extension
is not on the list and you would like it to be, please file a "task"
issue in the `Forge
bugtracker <https://forge.typo3.org/projects/show/team-translation>`__
or request for admission via `translators mailing
list <http://lists.typo3.org/cgi-bin/mailman/listinfo/typo3-project-documentation>`__.

Best practice
-------------

| Before you start to translate you **MUST** be familiar with the part
  of the Core/the extension before you can translate it correctly.
  Always try to see the words and sentences you are about to translate
  in their proper context. The more familiar you are with that part of
  the Core/the extension the better your translation will be.
| A great help **to see where a certain text is used** is the extension
  `translationhelper <https://extensions.typo3.org/extension/translationhelper/>`__.

-  Install it in your TYPO3 installation and in the extension
   configuration activate the "Show label" setting.
-  Then reload the backend.
-  You will then see the labels for each and every string that is taken
   from a locallang file. That way you know where a certain string is
   used.
-  If you have ideas how to improve the extension, you can add a new
   issue to the issue tracker of the `project on
   forge <https://forge.typo3.org/projects/extension-translationhelper>`__.

It is important that you follow the *common vocabulary* as described on
your team page.

Using Pootle
============

Pootle is a professional Translation Tool which enables users to edit
the localization of TYPO3. It contains all XLIFF files (in
local/global/system extension folders) and provides an editing interface
for each one of them.

Before you start
----------------

-  When you are in Pootle, visit the project called "Tutorial". The
   Tutorial will give you hints on what to take care of when you
   translate texts. The result will be that we get a better quality of
   the translated texts.
-  Follow the *common vocabulary* as described on your team page.
-  Don't translate everything! Some terms which lie close to the heart
   of TYPO3 **should not be translated** to facilitate the reading of
   the English (official) documentation.

+----------------------+----------------------+----------------------+
| *Do not translate    |                      |                      |
| these terms*         |                      |                      |
+----------------------+----------------------+----------------------+
| **English**          | **Comments**         | **Author**           |
+----------------------+----------------------+----------------------+
| TypoScript           |                      | dfeyer               |
+----------------------+----------------------+----------------------+
| TypoScript "Setup"   | `Result of this      | Stucki, Ingmar,      |
|                      | discussion           | Christian Hennecke   |
|                      | (german) <http://    |                      |
|                      | lists.typo3.org/pipe |                      |
|                      | rmail/typo3-translat |                      |
|                      | ion-german/2010-Febr |                      |
|                      | uary/000059.html>`__ |                      |
+----------------------+----------------------+----------------------+
| (TypoScript)         | Is kind of an        |                      |
| "Template"           | official "brand".    |                      |
+----------------------+----------------------+----------------------+
| TemplaVoilà          |                      | dfeyer               |
+----------------------+----------------------+----------------------+
| RTE                  |                      | dfeyer               |
+----------------------+----------------------+----------------------+
| Backend              |                      | king76               |
+----------------------+----------------------+----------------------+
| BE                   | as an abbreviation   | mschwemer            |
|                      | for Backend          |                      |
+----------------------+----------------------+----------------------+
| Frontend             |                      | king76               |
+----------------------+----------------------+----------------------+
| Cache / caching      |                      | mschwemer            |
+----------------------+----------------------+----------------------+
| Flexform             |                      | mschwemer            |
+----------------------+----------------------+----------------------+
| Hook                 |                      | mschwemer            |
+----------------------+----------------------+----------------------+
| Marker               |                      | mschwemer            |
+----------------------+----------------------+----------------------+
| Mime Type            |                      | mschwemer            |
+----------------------+----------------------+----------------------+
| CommandController    | Extbase              | mschwemer            |
|                      | CommandController    |                      |
|                      | (Schedule)           |                      |
+----------------------+----------------------+----------------------+

If you think there is a good, well known and often used extension that
can go to that list, you can propose to translate it in the mailing
list.

Make your Settings
------------------

You can use the Pootle settings to choose the items to be displayed in
your Dashboard and to choose additional languages to show during the
translation process.

Navigate to the right file
--------------------------

On the Pootle main page choose the language you want to translate. In
the projects overview you can see the status of the available (system)
extensions. Afterwards choose the project (sysext or ext) which you want
to translate.

Inside you have the different XLIFF files of the extension. These files
contain the texts.

Use the "Translate" tab to translate all or only missing texts.

Alternativelly you can choose the "Check" tab to do different checks.
You can e.g. go through all labels with wrong punctuation or with wrong
bracket count and so on.

Translate texts
---------------

Pootle offers you a convenient user interface which shows you the
English original text of the different labels. Click on the number in
front of a label to be able to edit it.

Depending on your role you can then make proposals for text changes or
apply such changes directly. Note how Pootle provides a list of common
terms, which are part of the English text. Next to each English text you
have the correct translation for these terms. Just have a look at the
column "Terminology" left to the translation field.

Another possibility is to upload XLIFF files, which contains
translations to add them to the official files.

Next steps
----------

The texts will be packaged once a day. They can be fetched using the
Extension Manager and will be placed in your TYPO3 installation in the
folder typo3conf/l10n.

**NOTE:** You have to empty the folders typo3temp/llxml and
typo3temp/Cache/Data/t3lib_l10n and remove the .zip files in typo3temp/
**before** you use the Extension Manager and update the translations. If
you only fetch the new translations in the EM there is no guarantee that
they will be used.

Translation internals, how does it work?
========================================

In TYPO3 the translations are saved inside .XLIFF files.

Such a language file could look like this (this is the file from the
sysext impexp):

::

      <?xml version="1.0" encoding="UTF-8"?>
      <xliff version="1.0">
         <file source-language="en" datatype="plaintext" original="messages" date="2011-10-17T20:22:33Z" product-name="impexp">
            <header/>
            <body>
               <trans-unit >
                  <source>Show details of all presets</source>
               </trans-unit>
            </body>
         </file>
      </xliff>

Here are more information about the `structure of XLIFF
files <http://docs.oasis-open.org/xliff/v1.2/os/xliff-core.html>`__.

Our XLIFF guru dfeyer can surely tell you, how Pootle is working with
these files.

Making hardcoded labels translatable
====================================

Some texts in TYPO3 modules are hardcoded and not translatable yet. The
goal is to change that.

.. container::

   notice - Note

   .. container::

      You want to help us?
      Then go here:

      `Hardcoded </Hardcoded>`__ [deprecated wiki link]

Labels not needed for TYPO3 terminology
=======================================

With the `Terminology Project </Translations/Terminology_Project>`__
[deprecated wiki link] we have built a Terminology list for TYPO3! This
list is now used for the Terminology hints, when you translate on the
`Translation Server <http://translation.typo3.org>`__.

Inside that terminology there are some labels that are not really needed
for TYPO3. `See this
page </Translations/Terminology_Project/Words_to_remove>`__ [deprecated
wiki link].

locallang_common.xlf
====================

Since TYPO3 4.3 we have a "locallang_common.xliff"-file which contains
all the daily used labels. This file should be used for core and
extensions.

The advantages having a file like this are:

-  one place for common labels
-  reduce work for translators (translators don't need to translate
   'Yes' for 20th time)
-  keep translation consistent
-  avoid translation failures

What labels does it contain?
----------------------------

Here you can see labels for locallang_common.xlf and other translation
files.

https://github.com/TYPO3/TYPO3.CMS/tree/master/typo3/sysext/core/Resources/Private/Language

How to use it
-------------

You can use the labels using the normal syntax to include a
language-label:

::

   $GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_common.xlf:yes');

Translation Teams
=================

Translation teams have been formed for the following languages:

-  `Bahasa Indonesia </Bahasa-Translation-Team>`__ [deprecated wiki
   link]
-  `Bulgarian </Bulgarian-Translation-Team>`__ [deprecated wiki link]
-  `Brazilian Portuguese </Brazilian-Translation-Team>`__ [deprecated
   wiki link]
-  `Czech </Czech-Translation-Team>`__ [deprecated wiki link]
-  `Croatian </Croatian-Translation-Team>`__ [deprecated wiki link]
-  `Danish </Danish-Translation-Team>`__ [deprecated wiki link]
-  `Dutch </Dutch-Translation-Team>`__ [deprecated wiki link]
-  `Estonian </Estonian-Translation-Team>`__ [deprecated wiki link]
-  `Filipino </Filipino-Translation-Team>`__ [deprecated wiki link]
-  `French </French-Translation-Team>`__ [deprecated wiki link]
-  `Galician </Galician-Translation-Team>`__ [deprecated wiki link]
-  `German </German-Translation-Team>`__ [deprecated wiki link]
-  `Greek </Greek-Translation-Team>`__ [deprecated wiki link]
-  `Hebrew </Hebrew-Translation-Team>`__ [deprecated wiki link]
-  `Hungarian </Hungarian-Translation-Team>`__ [deprecated wiki link]
-  `Italian </Italian-Translation-Team>`__ [deprecated wiki link]
-  `Khmer </Khmer-Translation-Team>`__ [deprecated wiki link]
-  `Latvian </Latvian-Translation-Team>`__ [deprecated wiki link]
-  `Polish </Polish-Translation-Team>`__ [deprecated wiki link]
-  `Romanian </Romanian-Translation-Team>`__ [deprecated wiki link]
-  `Russian </Russian-Translation-Team>`__ [deprecated wiki link]
-  `Slovak </Slovak-Translation-Team>`__ [deprecated wiki link]
-  `Slovenian </Slovenian-Translation-Team>`__ [deprecated wiki link]
-  `Spanish </Spanish-Translation-Team>`__ [deprecated wiki link]
-  `Swedish </Swedish-Translation-Team>`__ [deprecated wiki link]
-  `Thai </Thai-Translation-Team>`__ [deprecated wiki link]
-  `Japanese </Japanese-Translation-Team>`__ [deprecated wiki link]
-  `Turkish </Turkish-Translation-Team>`__ [deprecated wiki link]

To facilitate broader acceptance of TYPO3 in the world we would very
much like to see translation teams for `all of the six UN
languages <http://en.wikipedia.org/wiki/United_Nations>`__. We still
miss:

-  `Arabic </wiki/index.php?title=Arabic-Translation-Team&action=edit&redlink=1>`__
   [not available anymore]
-  `Chinese </Chinese-Translation-Team>`__ [deprecated wiki link]

If you would like to become a member of a translation team, please
contact the administrator for your language. If your language does not
yet have a translation team, then there's an opportunity for you to
become administrator for that language. ;-)

If your language is missing and you are one of your languages'
translators, please create it.

With this code you can add the team-header for a new page:

::

   {{Project|Translations|TYPO3 Core & Extensions Translation|Translation}}[[Category:Translation]]

Wishlist
========

-  We need some more active team members. Translation is important!
-  We must make sure that people stick to the Translation Guidelines,
   common vocabulary (ex. for french "Template" -> "Gabarit", and
   nothing else)

Frequently Asked Questions (FAQ)
================================

Unclear part of speech
----------------------

| **Problem:**
| I want to translate an English text, which can either be a verb or a
  noun. Which translation should I choose?

| **Solution:**
| Translate it as a noun and add into the field "comment by the
  translator" the translation of the verb.

I downloaded new translations, but they are not used
----------------------------------------------------

| **Problem:**
| I updated my translations with the extension manager but I still only
  see the old texts.

| **Solution:**
| You have to make sure that you

-  delete the content of the folder typo3temp/llxml
-  delete the content of the folder typo3temp/Cache/Data/l10n (or
   t3lib_l10n if older than TYPO3 6.2) and
-  remove the .zip files in typo3temp/
-  **Afterwards** use the Extension Manager and update the translations.

Installing Backend Languages manually
-------------------------------------

| **Problem:**
| Is there a way to install backend languages for TYPO3 manually,
  without connectivity to the repository?

| **Solution:**
| You should be able to download translated language files (in XLIFF
  format) from the TYPO3 translation server
  (http://translation.typo3.org/) and manually depoly them in your
  »typo3conf/l10n/<languagekey>«-directory.

Alternatively, you can just set up a second TYPO3 instance, download the
translation files from repository, and just deploy the entire
»typo3conf/l10n«-directory to your other site.

Migrating locallang.xml to locallang.xlf
========================================

Please follow the tutorial at:
http://xavier.perseguers.ch/en/tutorials/typo3/articles/managing-localization-files.html
[not available anymore]

Using this tutorial and EXT:xliff you're able to use xliff from 4.5
until current TYPO3 easily ;) But if you're already using a current
TYPO3 you could run in troubles with EXT:extdeveval which is used in
this tutorial: It's outdated now.

Another very comfortable way to migrate locallang.xml files to
locallang.xlf is to use EXT:lfeditor which contains a conversion tool
allowing for splitting the locallang-data in single language files also.

See https://extensions.typo3.org/extension/lfeditor/ and
https://docs.typo3.org/typo3cms/extensions/lfeditor/MainMenuOptions/General/Index.html
(Manual).
