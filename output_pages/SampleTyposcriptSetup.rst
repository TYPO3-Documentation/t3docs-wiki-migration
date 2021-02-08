.. include:: /Includes.rst.txt
.. highlight:: php

.. _sample-typoscript-setup:

================================
Tutorial/Sample TypoScript Setup
================================

.. container::

   notice - This information is outdated

   .. container::

      While some details may still apply in specific situations, this
      page was written for packages of TYPO3 that are no longer current.

| 
| This example starts with the setup of various plugins / setting .. see
  below for the minimum typoscript ..

::

   #
   # open links in same window
   #
   tt_content.text.20.parseFunc.tags.link.typolink.target = ""

::

   #
   # Configure search-engine friendly, static looking URLs with a title in in ... 
   # .. remember to set up the correct .htaccess url-rewriting mod as well!
   # 
   config.simulateStaticDocuments = 1
   config.simulateStaticDocuments_addTitle = 30

::

   #
   # Clean up the HTML a bit:
   #
   # remove static javascript code and include it as a temp-file
   #
   config.removeDefaultJS = external

   # remove static css code and include it as a temp-file
    
   config.inlineStyle2TempFile = 1

::

   #
   # remove unneccessary space around the headers
   #
   lib.stdheader.10.stdWrap.wrap >
   tt_content.stdWrap.spaceAfter = 0
   tt_content.stdWrap.spaceBefore = 0
   lib.stdheader.stdWrap.space = 0

::

   #
   # Split image captions - when using multiple images, each line of the caption is used for just one picture
   #
   tt_content.image.20.captionSplit = 1
   tt_content.image.20.caption >
   tt_content.textpic.20.captionSplit = 1
   tt_content.textpic.20.caption >

::

   # 
   # Configuring the languages and language dependencies
   # 
   # German language, sys_language.uid = 0 (Default)
   #
   config.linkVars = L(0-10)
   config.sys_language_uid = 0
   config.language = de
   config.locale_all = de_DE
   styles.content.lastUpdate.strftime = %e. %B %Y

   #
   # English language, sys_language.uid = 1
   #
   [globalVar = GP:L = 1]
   config.sys_language_uid = 1
   config.language = en
   config.locale_all = english
   styles.content.lastUpdate.strftime = %B %e, %Y
   [global]

::

   #
   # Language-selector (you need to have the languageMenu.php - script; 
   # have a look at the Typo3/Tips section of this wiki)
   #
   temp.languageMenu = PHP_SCRIPT
   temp.languageMenu.file = fileadmin/templates/scripts/languageMenu.php

::

   #
   # PLUGIN-BEGIN: Page Title Changer (mf_pagetitle)
   # Modify the page-title (whats displayed in the browser-window) - prefix each pagename with "My-Site ::" 
   #
   includeLibs.pagetitle = typo3conf/ext/mf_pagetitle/pagetitle.php
   plugin.mf_pagetitle.title = My-Site :: {page:title}
   config.titleTagFunction = user_pagetitle_class->changetitle
    
   # PLUGIN-END: Page Title Changer (mf_pagetitle)

::

   # 
   # PLUGIN-BEGIN: Different Linklayout (dh_linklayout)
   # 
   includeLibs.dh_linklayout = EXT:dh_linklayout/class.tx_dhlinklayout.php

   tt_content.text.20.parseFunc {
     tags.link.typolink.userFunc = tx_dhlinklayout->main
     tags.link.typolink.userFunc {
      linkImgExt.file = {$plugin.tx_dhlinklayout.linkImgExt.file}
      linkImgExt.wrap = {$plugin.tx_dhlinklayout.linkImgExt.wrap}
       aTagParamsExt = {$plugin.tx_dhlinklayout.aTagParamsExt}
       linkImgInt.file = {$plugin.tx_dhlinklayout.linkImgInt.file}
       linkImgInt.wrap = {$plugin.tx_dhlinklayout.linkImgInt.wrap}
       aTagParamsInt = {$plugin.tx_dhlinklayout.aTagParamsInt}
       linkImgMailto.file = {$plugin.tx_dhlinklayout.linkImgMailto.file}
       linkImgMailto.wrap = {$plugin.tx_dhlinklayout.linkImgMailto.wrap}
       aTagParamsMailto = {$plugin.tx_dhlinklayout.aTagParamsMailto}
     }
     tags.typolist.default.parseFunc.tags.link.typolink.userFunc < .tags.link.typolink.userFunc
   }
   lib.stdheader.stdWrap.typolink.userFunc < tt_content.text.20.parseFunc.tags.link.typolink.userFunc

   # PLUGIN-END: Different Linklayout (dh_linklayout)

::

   # 
   # PLUGIN-BEGIN: Searchbox for Indexed Search Engine (macina_searchbox) 
   # 
   # Enable indexing (for indexed search engine) 
   #
   page.config.index_enable = 1

   # clear cache at mindnight - resolves some issues with page start/stop not working correctly 
   page.config.cache_clearAtMidnight = 1

   # configure the searchbox-form (if you want to put it on your page-template)

   plugin.tx_macinasearchbox_pi1 {

     # pid of the page containg the search result plugin content 
     pidSearchpage = 32

     # template file
     templateFile = fileadmin/templates/searchbox.html
   }

   # PLUGIN-END: Searchbox for Indexed Search Engine (macina_searchbox)

| 
| **Now the essention TS code for the menu and content areas and
  template definition:**

::

   # 
   # Top-Navigation (first level)
   # 

   temp.topnav = HMENU
   temp.topnav.wrap = <div > | </div>
   temp.topnav.1 = TMENU
   temp.topnav.1 {

        NO.allWrap =  <div > | </div>
        expAll = 1
        ACT = 1
        ACT.allWrap =  <div > | </div>
         SPC = 1
         SPC.allWrap = <div _SPC> | </div>
   }

::

   # 
   # Left-Navigation (second level)
   # 

   temp.leftnav = HMENU
   temp.leftnav.entryLevel = 1
   temp.leftnav.wrap = <div > | </div>
    temp.leftnav.1 = TMENU
    temp.leftnav.1 {
    
         NO.allWrap =  <nowiki><div > | </div>
        expAll = 1
        ACT = 1
        ACT.allWrap =  <div > | </div>
         SPC = 1
         SPC.allWrap = <div _SPC> | </div>
   }

::

   #
   # Template content object (assemble parts)
   #

   temp.mainTemplate = TEMPLATE
   temp.mainTemplate {

     template = FILE
     template.file = fileadmin/templates/page.html
     workOnSubpart = DOCUMENT_BODY
     
     subparts.TOPNAV < temp.topnav
     subparts.LEFTNAV < temp.leftnav
     subparts.CONTENT_NORMAL < styles.content.get 

   }

::

   #
   # Default PAGE object:
   #

   page = PAGE
   # we add a cutom stylesheet, too (as the default html head section will be replaced)
   page.stylesheet = fileadmin/templates/css/std.css
   page.typeNum = 0
   page.10 < temp.mainTemplate

   # maybe add some additional headers .. choose numbers > 200 just to be sure ..
   page.headerData.200 = TEXT
    page.headerData.200.value=<link rel="alternate" type="application/rss+xml" title="Newsticker" href="http://netzroller-online.de/news.rss
