.. include:: /Includes.rst.txt
.. highlight:: php

===================
My first TYPO3 site
===================

<< Back to `Help, tips and troubleshooting <overview-miscellaneous>`__
page

[edit] [outdated wiki link]

.. container::

   notice - This information is outdated

   .. container::

.. container::

   notice - Note

   .. container::

      My goal is to help the documentation team by being a "guinea pig"
      of sorts. In other words, I will be **reflecting on my early
      experiences... challenges and successes... so that the
      documentation might be improved**.

Like many, I have struggled with getting TYPO3 set up. Aside from the
inherent technical issues, I've found the documentation confusing. There
is just so much documentation information that it can be hard to find
what you need when you need it. I hope that my efforts here will help us
to simplify the process for other newbies like me.

**I am partial to HTML/CSS formatting and no frames.**

--chrispy [outdated wiki link]

Overall documentation
=====================

Overall, I wonder if the documentation process is slowed down
significantly by focusing on large, complete documents. As a newbie, the
long documents are useful and important. But what I really feel I need
are more shorter documents that help me get a handle on how TYPO3 works
bit by bit. These shorter documents would be quick to produce, focus on
specific issues/needs, and direct the newbie user to more detailed
documentation that might be useful. These short documents would
especially help a newbie to make informed decisions about where to
invest their energy on the learning curve.

Installation
============

A detailed step-by-step introduction to installing TYPO3 is available in
the official `Installation and Upgrade
Guide <https://docs.typo3.org/typo3cms/InstallationGuide/>`__!

Since the settings for image magic or other settings on installation may
have to be altered on installation to get it 100%, the pages may not
appear correctly (mostly the graphical menu) and until you clear the
cache the pre adjustment to the settings will be displayed on the pages
(from the cache), this will save your sanity and loads of time, messing
with settings that have been set correctly, but the cache has the old
settings applied to the pages you are currently viewing.

If you have ANY problems with your page display (it does not display
like it should) and are trying to solve an issue, ALWAYS clear the
cache!! Then only, start spending time to fix what really must be a
problem.

The Install Tool has very useful to configure ImageMagick/GraphicsMagick
properly.

Templates: Getting off the ground
=================================

Aside from incidental installation challenges, my first major
frustration was with templates. Having "successfully" installed the
dummy package, I expected to be able to add content and see my new site
live. However, before I had any successful content, I had to wade
through the various types of templating that are possible. This was very
frustrating and overwhelming -- and could have easily been a place where
I would give up.

Once I got the templates functional, I was easily able to build a large
text-focused content website! That was what helped me to get and stay
really committed to TYPO3. I knew/know there was/is a lot more to learn.
But with that first site functional, I would then be able to make
progress gradually as my time allowed.

Possible solution? [outdated wiki link]

TemplaVoila
-----------

Since I knew HTML/CSS design already, I ended up working with
TemplaVoila for my first successful site(s). I initially felt that
TypoScript was too intimidating without more accessible documentation
and this was the first thing I felt I could make any progress with. Here
are some of my notes and reference material for that...

-  Running with TemplaVoila [outdated link]

**Disadvantages**: As I tweaked my layout in my HTML template file and
reloaded, the site would sometimes crash. I would have to run through
the TemplaVoila mapping process again to get the site back up. Moving to
external stylesheets avoided a good bit of this, but still any shift in
the primary HTML would run the risk of crashing the system. In addition,
depending on TemplaVoila meant that the whole realm of TypoScript
continued to be a fog to me. The same thing that was an advantage at
first, eventually became a liability as I became more and more
interested in extensions that require TypoScript setup.

Other options
-------------

`Modern Template Building, Part
1 <https://docs.typo3.org/typo3cms/extensions/doc_tut_templselect/>`__

`Modern Template Building, Part
2+3 <https://docs.typo3.org/typo3cms/extensions/doc_tut_templselect2/>`__

-  Static Templates

Likewise, I never worked much with these. Many are based in frames,
which I had no interest in.

Constants, Setup, and TSconfig
==============================

Ok, major clarification here. There are three different places where you
can configure TYPO3. In each Template record, there are both Constant
and Setup fields. And in each Page record, you can place TSconfig codes.
I'm sure I lost a lot of time dropping configuration codes into the
wrong places.

In many extensions, there are sample configuration files that download
with the extension. So if there is no documentation (or limited
documentation), you might go looking for those sample setup files.

Videos! Check them out...
=========================

Well, I had heard the videos referenced on the mailing list, but it took
a long time before I figured out that they were available on-line for
free! These look to be a great help at getting started with some basic
aspects of TYPO3. Check them out at Getting Started Videos [outdated
link]. You'll need to view them with Windows Media Player in order to
choose your favorite language. In my initial browing of them, I found a
lot of extensions that I was able to imnplement quickly and easily! Take
the time. You'll be glad you did.

MetaTags and Keywords
=====================

Setting up keywords per page is easy. In the Page Header, make your page
"Advanced" instead of "Standard." This will open up fields where you can
enter your prefered data.

Meanwhile, I'm using the MetaTags, Extended
`metatags <https://extensions.typo3.org/extension/metatags/>`__
extension to make sure I have a good set of MetaTags on my site. The
keywords and description defined for the extension will disappear if
keywords and a description are added manually for a specific page. But
they serve as a default if no such specifics are entered for a page.

Look in /typo3conf/ext/metatags/ after the extension has been installed
for text files indicating what your TypoScript constants and setup
should look like to start with. I don't even bother with the setup and
stick with the constants to give it my global defaults. But I'm sure
there is more that could be done with this.

Site Map and Search
===================

These are built in plug-ins. No extra extensions needed. Very handy for
helping people get around your site more easily.

Indexed Search
--------------

Now if you want a powerful search tool for your site, you'll want to
look into this extension. The documentation is available at
https://docs.typo3.org/typo3cms/extensions/indexed_search.

Site Map
--------

This is a nice way to maintain a dynamic site map very little effort.

Just go to the page where you want your Sitemap to show up. Add a
content element plugin. Choose Menu/SiteMap. It's as easy as that.

There are actually several styles of maps that you can work with for
various purposes...

-  **Sitemap** - This is the one I use on most of my sites. It gives the
   full page tree.
-  **Menu of these pages** -
-  **Menu of subpages (with abstract/+sections)** -
-  **Section index** -
-  **Recently Updated Pages** -
-  **Related pages (based on keywords)** -

Add this code to your template's CONSTANTS field so that links on the
SiteMap will NOT open a new window...

::

   content.pageFrameObj =

MM I found this also works:

::

   tt_content.menu.20.2.1.target =

| 
| == **How to make a SiteMap for a particular part of your site** ==.

First Make a page where you want to put the Sitemap.

Create a content element 'Menu/Sitemap'

Type in a Header for it and choose 'Menu of pages to these subpages'

Select 'Starting point' for the Sitemap

Save and Close

Go to Template Module and select 'Info/Modify'

Edit the 'Setup' Section and add these lines

| 
| **tt_content.menu.20.1.1 = TMENU**

**tt_content.menu.20.1.1.expAll = 1**

**tt_content.menu.20.1.1.NO.allWrap = <p >|</p>**

**
**

**tt_content.menu.20.1.2 < .1**

**tt_content.menu.20.1.2.NO.allWrap = <p >|</p>**

**tt_content.menu.20.1.3 < .1**

**tt_content.menu.20.1.3.NO.allWrap = <p >|</p>**

**
**

**tt_content.menu.20.1.4 < .1**

**tt_content.menu.20.1.4.NO.allWrap = <p >|</p>**

You have to Copy & Paste the last line to match the depth of the tree

Respectively changing the last digit to 5,6,7....

Note: Level 1 (20.1.1) is the starting point of the tree.

The only thing that`s left to do is formating the SiteMap with CSS or
whatever you like.

Posted by: D.Kamenov from Bulgaria on 03.Apr.2006

Spacers, Targets, and Tricks
============================

Spacers
-------

The page type "Spacer" found in your page header can be very useful for
adding a no-link item to your dynamic menu. However, the "Spacer" type
has to be enabled through TypoScript (for each menu level where you want
it). For my TS/CSS format at level 1, the code looks like this...

::


    page.10.marks.MENU_GOES_HERE.1.SPC = 1
    page.10.marks.MENU_GOES_HERE.1.SPC.doNotShowLink = 0
    page.10.marks.MENU_GOES_HERE.1.SPC.doNotLinkIt = 1
    page.10.marks.MENU_GOES_HERE.1.SPC.allWrap = <div > | </div>

See also my `Running with TypoScript and
CSS <running-with-typoscript-and-css>`__ where this code is included in
context. The code will need to be slightly different if you are using
TemplaVoila or another template approach.

Targets
-------

There are various TypoScript constants which control what target frame
is used for new pages... for internal links, external links, search
results, mail form acknowledgement pages, site map links. Different
constants apply if you are not using "CSS Styled Content," but these are
constants I include in the template:

::

   # sitemap links should open in the same window .. (CSS)
   content.pageFrameObj = 

   # makes search results and mailform "thank you" open in same window (CSS)
   PAGE_TARGET =

Cleaning Up CSS Code
--------------------

TYPO3 extensions can end up adding a lot of CSS code into each page,
depending on how globally you set up the extensions. This nice little
Setup item tells TYPO3 to throw all of that automatically generated CSS
into a temporary CSS file and keeps your HTML file more readable.

::

   # remove static css code and include it as a temp-file
   config.inlineStyle2TempFile = 1

Front end edit
--------------

When you are logged in to the back end (BE), but looking at the front
end (FE), you can edit page content without going back into the Admin
interface. You just need to activate the FE admin panel by adding Setup
item in your template.

::

   ## enable frontend edit
   config.admPanel = 1

Email Form
==========

The "Special Content Elements" chapter of the videos was just randomly
running in the background while I was downloading the other chapters. I
accidentally learned just how easy the **Mail Form** is to setup!!

It's a built in feature and I found it positively simple to set up. Very
powerful tool.

Use this code (in your template's CONSTANTS field) to open the "thank
you" page open in same window (CSS)

::

   PAGE_TARGET =

Site Backup
===========

Another essential component is a backup system for your site. You'll
need to back up both critical directories on the server, as well as the
MySQL databases.

See `Backup <backup>`__ for details about how to backup a TYPO3
installation!

Statistics
==========

-  You can use tools like Piwik and the
   `piwikintegration <https://extensions.typo3.org/extension/piwikintegration/>`__
   extension.

Accessibility, Validation, Compliance
=====================================

-  Alttext for Images
-  **XHTML (vs. HTML) Validation**

::

   page.config.doctype = html5

-  CSS Validation

News, Lists, etc
================

-  ah_list
-  tt_news - I've had to fight with this quite a bit -- but in the end,
   it was worth it. See entire section(s) below on setup details. There
   is a tt_news mailing list at news.typo3.org
-  mini-news
-  MOC knowledgebase

Using tt_news
-------------

-  You have to include a tt_news template from your main template record
   (or tt_news simply won't render). Focusing on CSS, this means in your
   main template record, you should select "CSS-based tmpl (tt_news)"
   from the "Include static (from extensions)" field. It won't help if
   this is done from an extension template. It has to be from the main
   template.

-  Use the \**\* file that comes with tt_news as a starting place for
   developing your own tt_news template. I don't usually use the tt_news
   user interface to select a tt_news template. Instead, I use the
   following in page template setup field to enable my own tt_news
   template.

::

   ## Setup tt_news extension for AS
   plugin.tt_news.templateFile = fileadmin/templates/AS_ttnews.html

-  This turns off all the automatic wraps, which I don't understand and
   thus get in my way. Instead, I define my own wraps through the
   template.

::


   # Turn off tt_news <p> wraps
   plugin.tt_news.general_stdWrap.parseFunc.nonTypoTagStdWrap.encapsLines.nonWrappedTag =

-  These are simple constants that I have found useful enough to include
   as a standard part of my tt_news setup. They adust how many items can
   be placed on one page before rolling into a multiple page browsing
   format.

::

   plugin.tt_news.latestLimit = 10
   plugin.tt_news.limit = 10

-  Categories for tt_news have to be set up in the system folder. And a
   tt_news LISTing, for example, won't render unless the system folder
   is NOT hidden.

Using tt_news as a random quote generator
-----------------------------------------

-  This information [outdated link] may help in the configuration of a
   random tt_news generator.

Setting up multiple users
=========================

Multiple Back End (BE) users and Front End (FE) editing
-------------------------------------------------------

My next big frustration was over trying to give someone else the ability
to edit content, without making them an administrator. Obviously, this
is a key reason for using a CMS instead of just designing pages myself.
I was looking through the various documentation. It looked like it
should be so easy to do what I wanted to do. It took me a long time to
finally guess that I needed to install another extension in order to
empower the admin panel discussed in the documentation (see also
Frontend editing [outdated link]). With the right extension installed
(this was either
`feuser_admin <https://extensions.typo3.org/extension/feuser_admin/>`__
or `beuser <https://extensions.typo3.org/extension/beuser/>`__, I
think), suddenly it all worked like the documentation said it would! But
the documentation never seemed to point towards checking on this.

Password protected pages and Front End (FE) Users
-------------------------------------------------

User (group and name) records must be placed in a SysFolder. This code
was essential (in constants in page template for login element)...

::

    ## Determine System Folder for User Groups and User Names
    styles.content.loginform.pid = 422

Giving Front End (FE) Users Back End (BE) Editing power
-------------------------------------------------------

BE-login simulation for FE-users (simulatebe)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This extension will allow FE users to login at the front end and be
immediately able to use the Front End (FE) editing features described
above.

-  See above sections for establishing FE users and BE users.
-  Install simulatebe through the extension repository
-  Add this code to your template setup field

::

   page.headerData.10 < plugin.tx_simulatebe_pi1
   plugin.tx_simulatebe_pi1.allow = 1

-  Make sure the page header on the page with the login content element
   is marked with the General Storage Folder pointing to the folder with
   the FE usernames and usergroups in it

-  Edit the username you want to give FE-editing access. Near the bottom
   of the page, there is a field called "Related Backend User." Select
   the BE user you want linked to this item.

Note: *This extension simulate BE login in order to empower FE editing,
but does not give FE users access to the Backend itself.*

Note: *This extension works with the standard login box (built into the
CMS), but not with the New Front End Login Box (newloginbox) extension.*
It works if you run both extension. (constants:
styles.content.loginform.pid = 8(sysfolder feuser)

Miscellaneous Enhancements
==========================

-  **Save and New (stfl_saveandnew)** - Easy to install through the
   extension repository (TER) and makes sure that you have a "save and
   new" button everywhere you might want one.
-  **TER update check (ter_update_check)** - Easy to install through the
   extension repository (TER) and makes upgrading your currently loaded
   extensions automatically. This saves having to scan the whole
   extension repository (TER) manually. I imagine the automation could
   cause some trouble on occassion, so it's something to be careful of

Multiple Domains
================

It turns out that multiple domain handling is built into TYPO3, which is
very cool. There is a basic documentation page in the Getting Started
tutorial [outdated link]

A comprehensive tutorial/howto can be found here `The multidomain
wiki <multidomain>`__

-  When it says the additional domain has to be directed to the TYPO3
   installation, this means the domain has to be **parked** at the
   location of the TYPO3 root directory. In my experience, it seems that
   domain forwarding, domain redirection, and .htaccess manipulation are
   not sufficient for TYPO3 to pick up the additional domain.
-  Beyond that just add the domain record in TYPO3 to the root page of
   the additional site pages. TYPO3 does the rest. But it does help to
   include a domain record for both (for instance) mydomain.com and
   www.mydomain.com
-  It did get a little bit more tricky when I started using various
   plugins on the additional websites. For instance, the sitemap gave a
   map of my entire TYPO3 installation when I only wanted the particular
   domain included. This was resolved by adding a new site template to
   the root page of the particular site pages. Similarly, the Search
   plugin can be restricted through this means. (I'm still not sure
   exactly how this all work though... I'm not clear yet on the
   difference between the new site template and the extension template.
   I couldn't get the navigation menu to work right under one new site
   template. And I couldn't get the Search plugin to work right without
   an extension template in another domain. I haven't quite sorted this
   all out yet.
-  It would be good to have some real world examples of how many sites
   can be hosted like this, and also what limitations there are (ie,
   extension installation)

Real URL
========

I finally buckled down and got the basic installation of RealURL to work
for me. I didn't know any .htaccess stuff before this.

-  There is an .htaccess file included in the TYPO3 installation that
   was pretty much ready to go. But it was named \_.htaccess, so I had
   to rename it to .htaccess for it to become active.
-  There also is a simple TypoScript configuration set of a few commands
   - see A Wiki page about RealURL test and error [outdated link].

Choosing extensions
===================

I've had a couple of sidetracks that seemed unnecessary. One was trying
to figure what extensions were relevant and most useful for posting news
type stories. Another was starting to think about what extensions I
might want to install to handle more image and multimedia type material.

Sylvain mentioned a new review process will happen soon. Subscribe to
the new `typo3-project-extrev Mailing
list <http://lists.typo3.org/cgi-bin/mailman/listinfo/typo3-project-extrev>`__
to be in touch with that).

Meanwhile, here are notes on my own meanderings:

-  **Multimedia**

   -  **Video/Sound** - It seems like the built-in multimedia content
      element can handle a lot of things. I'm not sure why there are
      seperate extensions for QuickTime, Flash, ,etc
   -  **Images** - I'm working to figure out which extensions are most
      useful for a simple web of images.

      -  **Photo Book** - This setup pretty quickly and easily for me,
         but it is really, really slow the first time you view a new
         page. It lets you load a large batch of new images all at once,
         by directory. You can easily setup a hierarchy of folders/books
         through your upload folders. Default image is the first full
         size picture (not thumbnails). You can add comments per picture
         and/or per directory from the front end easily (though not so
         quick on first load due to new page generation lag time). This
         can also be done through .txt files behind the scenes, which
         may be faster for bypassing multiple page generation. **In the
         end, this is the image extension that I settled on.**
      -  **Gallery** - Getting this setup took a little bit more work,
         but it looks more flexible to structure. I got slowed down
         getting the directory syntax right. The manual [outdated link]
         should say more about that! This thread [outdated link] helped
         me figure out that I did not need to include fileadmin in the
         directory notation since it is the default. This is slow to
         load the first time also. It lets you load a large batch of new
         images all at once, by directory. This starts you out at an
         index page.
      -  **WS Gallery** - With this one, you have to load each image one
         at a time, including the caption. But it automatically provides
         an index of smaller images that click through to a full size
         image.

-  **Ads/banners/classified**

| 
| **Documentation Suggestion:**

-  **I would really hope for some place in the documentation for
   reflective notes on extensions.** For instance, a place where the
   various extensions relating to multimedia content were examined
   indicating what they are useful for. A different place in that area
   might examine the different extensions dealing with
   news/articles/etc. Without such guides, the extension repository just
   becomes so confusing to sort through! Such a decision-making guide
   data could help newbie adminstrators to navigate the massive
   extension repository more effectively and then focus on the main
   learning curve of typoscript, etc.

I'm not even talking about reviews of extensions, per se. Certainly not
detailed ones. But something to help me make sense out of all the
options that exist. I would be glad to help compile some of this
information from others, but I don't know the extensions well enough to
create the content myself.

-  I had some trouble with the **Guest Book** (tt_guest) even though it
   looked easy. I could add entries from the backend, but the POSTFORM
   frontend part of the page would not come up. Turns out there is a
   common issue with running this extension with the
   **css_styled_content** extension (related to templates) -- turns out
   this problem would impact any of the **tt\_ extensions** such as
   tt_news, tt_board, etc!! I found the various advice on this issue to
   be cryptic. It took me a while, but this thread [outdated link]
   finally led me to make the correction. (from extension manager,
   select "css_styled_content", select "edit files" from the drop down
   menu, select "edit file" next to "static/setup.txt", and then add the
   line "styles.content.mailform < tt_content.mailform.20" right before
   the section titled/documented as "CType: search", save the file)

-  I had been fighting with News (tt_news) though that might have been
   because of the TT-CSS conflict. But **mini-news** setup pretty
   quickly. When I started to really work with it, this thread [outdated
   link] helped me figure out why the front teaser link had stopped
   working (can't use system folders for news items... they have to be
   in a page with the mininews archive content installed).

**Documentation suggestion**

-  There is a simple adjustment that can resolve this CSS-TT conflict,
   but it was really hard to figure out what the fix was. I was finally
   able to parse this thread [outdated link] from the developers list. I
   don't know why an adjustment hasn't been made to css_styled_content
   directly (maybe a technical reason?), but this important adjustment
   seems like it deserves it's own explanation page. (Does it already
   exist in the wiki?)

RTE
===

Meanwhile, my main user had not been upgrading her browser software. The
built-in TYPO3 Rich Text Editor (RTE) didn't function when editing
through TYPO3 on her computer (though it worked fine on my computer). In
researching this, I realized that the built-in RTE is only built to work
with Microsoft Internet Explorer (MSIE) version 5.0 and up. Apparently
there are some work-around RTE options available for other browsers, but
it appears that nothing is as stable as the MSIE version yet.

The varaious RTEs all transform your code as they store it in the
database. So if you are trying to add your own HTML codes, you could run
into some trouble with codes getting altered or deleted. This drove me
pretty crazy, and sometimes still does! I've moved to the feature-rich
"htmlArea RTE" (rtehtmlarea) extension. You have to uninstall the
default "Rich Text Editor" (rte) to avoid conflicts.

I also add this code to my template's SETUP field to disable some of the
code transformations.

::

   lib.parseFunc_RTE.nonTypoTagStdWrap.encapsLines.remapTag >

On a side note, RTE will not currently work in Internet Explorer 7 or
FireFox 2.

TSConfig Constants
==================

While fighting with one of the setup processes, I finally had a
realization about one aspect of TypoScript. I had thought that you have
to find information about the various configuration constants in the
documentation somewhere (and was frustrated when I rarely found that
information). But actually, it can be much easier than that!!

-  When there is a TSConfig field (for example, when editing a user or
   page header), there is an icon to the right of the field marked with
   TS and an open book. Clicking on that icon brings up a nice index of
   the available constants. Very useful.
-  Later I discovered that the initial page of the Template tool has a
   drop down menu where you can select "TypoScript Object Browser" or a
   "Constant Editor" which can allow you to view and adjust various
   setting in an orgnized manner. Various settings for each installed
   plugin show up here.

Weird Things I've run into
==========================

-  My RTEhtmlarea popup for adding a hyperlink, comes up with the site
   home page instead of the hyperlink selection interface. Turns out
   that my file permissions on RTEhtmlarea were set too generously. PHP
   security settings prevent execution of a file marked with public
   write permissions. Resolved by reducing permissions.
-  SESSION ID keeps popping up in my URL lines. It's just ugly. I added
   these lines in a php.ini file in the root of my typo3 installation

::

   php_value session.use_only_cookies 1 
   php_value session.use_trans_sid 0

Note: I originally had them in an .htaccess file, but when I changed
servers that no longer worked. Putting them in a php.ini [outdated wiki
link] file is better anyhow.
