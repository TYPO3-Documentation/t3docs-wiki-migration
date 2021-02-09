.. include:: /Includes.rst.txt

===========
Multidomain
===========

.. container::

   notice - Newer documentation available

   .. container::

      Since TYPO3 9, it is possible configure multiple domains with the
      `Site
      module <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/SiteHandling/Index.html>`__

Introduction
============

You need the following in order to have the same result as described in
this HowTo:

-  Typo3 version 4.2.x
-  Multiple domains pointing to the same TYPO3
   `installation <https://wiki.typo3.org/Category:Installation>`__
   [deprecated wiki link].

In this How To I'll explain how to set-up a multi domain managed website
with **domain1** functioning as a portal to **domain2** and **domain3**.
Just to make it nice and comprehensive I chose to set-up my example so
that the "portal **domain1**" already has a navigation for **domain2**
and **domain3**.

| 
| I.e. A user starts at **domain1** and can go to **domain2**-page1
  directly with only one click.

STEP 1 - setting up the Pagetree
================================

Your Website tree in the Backend should look as follows:

-  Globe Icon (id-0)

   -  **domain1** (id-1)
   -  **domain2** (id-2)

      -  **domain2**-page1 (id-3)
      -  **domain2**-page2 (id-4)

   -  **domain3** (id-5)

      -  **domain3**-page1 (id-6)
      -  **domain3**-page2 (id-7)

**domain1**,\ **domain2** and **domain3** all should have a TEMPLATE for
a new site (not an extension template)

STEP 2 - Creating the domain records
====================================

Create the Domain records. As easy as it sounds.

I did it like this:

-  click the Icon in the pagetree from **domain1**
-  choose new
-  in the right window choose the "domain" record
-  in the field "domain" type in your domain name :
   www.\ **domain1**.tld

now repeat these steps for **domain2** and **domain3**

Be sure to make sure that you don't enter the domain with http:// or /
as it will not work. For example the website http://www.example.com/
should be entered as www.example.com and http://test.example.com [not
available anymore] should be entered as test.example.com

STEP 3 - Typoscripting
======================

SETUP for domain2 and domain3
-----------------------------

Setup the typoscript for **domain2** and **domain3** are as usual. Here
is my setup:

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      page = PAGE
      page.stylesheet = fileadmin/templates/css/style_domain2.css
      page.10 = TEMPLATE
      page.10 {
         template = FILE
         template.file = fileadmin/templates/main_domain2.html
         workOnSubpart = DOKUMENT
         marks.NAVI = HMENU
         marks.NAVI {
            1 = TMENU
            1 {
              ... use your favourite code here
            }
         }
         marks.CONTENT < styles.content.get
      }

I have the same code for **domain3** only changes are:

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      page.stylesheet = fileadmin/templates/css/style_domain3.css

      and

      template.file = fileadmin/templates/main_domain3.html

SETUP for domain1
-----------------

Now important part. The Typoscript SETUP for domain1

.. container::

   `TS
   TypoScript <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

      config.typolinkCheckRootline = 1

      page = PAGE
      page.stylesheet = fileadmin/templates/css/style_domain1.css

      page.10 = TEMPLATE
      page.10 {
         template = FILE
         template.file = fileadmin/templates/main_domain1.html
         workOnSubpart = DOKUMENT

         marks.NAVI_DOMAIN2 = HMENU
         marks.NAVI_DOMAIN2 {
         special = directory
         //setting the special value to the root of domain2
         special.value = 2  
         1 = TMENU
         1 {
            ... use your favourite code here
         }

         marks.NAVI_DOMAIN3 = HMENU
         marks.NAVI_DOMAIN3 {
         special = directory
         //setting the special value to the root of domain3
         special.value = 5  
         1 = TMENU
         1 {
            ... use your favourite code here
            }
         }

         marks.CONTENT < styles.content.get
      }

| 
| The most important line here is the first line
  **config.typolinkCheckRootline = 1**.

This will not work in typo3 4.1.x![To be clarified: Is this meant to
tell us "This will work only in Typo3 versions starting from 4.2", or,
in other words: "Typo 4.1.x and lower are not supported"?]

This will let Typo3 check if the page which is chosen from the
navigation belongs to the rootline the user is at. If this is not the
case it will try to find the closest "root".
