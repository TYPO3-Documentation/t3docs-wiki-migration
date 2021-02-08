.. include:: /Includes.rst.txt

===========
Tt products
===========

<< Back to `Extension manuals </Overview_Extension_manuals>`__
[deprecated wiki link] page

`[edit] <https://wiki.typo3.org/wiki/index.php?title=Tt_products&action=edit&section=0>`__
[deprecated wiki link]

| 

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript.
      `info </Help:Contents#Teamwork_-_draft_review_publish_delete_merge_outdated>`__
      [deprecated wiki link]

| 

=========================
The future of tt_products
=========================

This page serves as a central point to discuss the addons and
corrections to tt_products. The general conversation is done on the
multilingual (German, English, French, Italian) `TYPO3
Forum <http://jambage.com/kontakt/forum.html>`__. You can also write an
email to Franz Holzinger. You can report issues and raise pull requests
also at `Github
tt_products <https://github.com/franzholz/tt_products/issues>`__ .

The extension tt_products is Open Source. Every programmer is invited to
contribute his piece of code to the shop extension or to a separate
extension with additional features which is based on hooks of
tt_products. Nobody should create or use a fork.

You can get the latest version of tt_products and a much improved
mbi_products_categories extensions including `hook </Category:Hook>`__
[deprecated wiki link]s for mm-categories in the shop of
http://ttproducts.de. This sponsoring is needed to get the bugs fixed,
questions answered and new features implemented and well tested. This
development work cannot continue without regularly received payments.
This is a fundraising where the contributors and sponsors will get the
code in advance. The currently developed extension code will be
published on the TYPO3 TER under GPL as free after some years of funds
collection.

| Info sites:
| `German tt_products.de site <http://ttproducts.de>`__
| `tt products Tutorial <tt-products-tutorial>`__

| Books:
| `Der
  TYPO3-Webshop <http://www.fosdoc.de/downloads/OSP_typo3webshop.pdf>`__
| `TYPO3 4.2
  E-Commerce <https://www.packtpub.com/design-build-feature-rich-online-store-using-typo3-4-2-e-commerce/book>`__

| 
| Video: `adding & editing products with
  tt_products <http://www.youtube.com/watch?v=IQFDvgVJDXA>`__

`Franz Holzinger </User:Franzholz>`__ [deprecated wiki link] is the
maintainer of
`tt_products <https://extensions.typo3.org/extension/tt_products/>`__
since version 2.0.0.

====
News
====

19th December 2018: TYPO3 >= 8.7.21, >= 7.6.32 and >= 6.2.40: You must
set
**$GLOBALS['TYPO3_CONF_VARS']['FE']['enableRecordRegistration']=true**
in the Install Tool or in the file LocalConfiguration.php .

29th March 2017: Upload of version 2.8.15 into the TYPO3 TER which
supports all TYPO3 8.x versions and all lower versions until 4.5.

4th November 2016: Upload of version 2.8.13 into the TYPO3 TER which
supports all TYPO3 7.x versions.

10th March 2016: Make the source code available at
`Github <https://github.com/franzholz/tt_products>`__.

18th August 2015: Upload of version 2.7.22 into the TYPO3 TER. Show the
order HTML in the order record of the TYPO3 backend.

25th July 2015: Upload of version 2.7.20 into the TYPO3 TER. Ready for
TYPO3 7.4

3rd June 2015: Upload of version 2.7.18 into the TYPO3 TER. Ready for
TYPO3 7.2

11th April 2015: Upload of version 2.7.17 into the TYPO3 TER. Added all
the XML files from tt_products 2.11.0 to make them available for the
Translation Server.

17th October 2014: Upload of version 2.7.12 into the TYPO3 TER. Ready
for TYPO3 6.2 and PHP 5.5.

8th September 2012: Upload of version 2.7.4 into the TYPO3 TER. Bug fix:
add missing method getSingleExcludeList

10th June 2012: Upload of version 2.7.3 into the TYPO3 TER. This version
works with TYPO3 4.7.x. Support for hierarchy tiers to filter products
in the products list. It contains a workaround to set the page title in
the products single view. It needs sr_feuser_register 2.5.x if you want
to use the date of birth.

15th August 2011: Upload of version 2.7.2 into the TYPO3 TER. This
version works with TYPO3 4.5.x. The TYPO3 backend can be configured in a
way that only some fields of the tt_products tables are visible and
used.

21th Mach 2011: Upload of version 2.7.1 into the TYPO3 TER. This add tax
rate markers to the price sums.

20th December 2010: Upload of version 2.7.0 into the TYPO3 TER. This
contains the possibility to have dynamicly changed prices on the display
if another product variant is selected.

31th March 2009: Better English and new French and Spanish translations
for the example marker template.

| 29th December 2008: The extension addons_tt_products has been
  published in TER. It contains the example shop templates and icons.
  The multiple language shop template contains only markers which are
  substituted by the texts from the file marker/locallang.xml
  (tt_products 2.8.0) or from TypoScript setup. Join this team to
  develop a common shop template usable for all languages.

The next things that have already been implemented into tt_products
2.8.0 are

-  change of all product attributes on the display with the change of a
   variant select box

In tt_products 2.8.0 you will have

-  Graduated prices which can be entered individually for each product
-  Multiple variants can be entered on the article side.
-  You can assign articles chosen from a group box to products . Each
   article can be assigned to more than one product even with an
   additional price. Support for IRRE.
-  Multi language text markers for the shop template
   (addons_tt_products)
-  Demo shops at http://demo.ttproducts.de [not available anymore] and
   http://www.ttproducts.net [not available anymore] .

| Send me any error messages per email or to the forum at
  http://jambage.com .

======================
Recommended extensions
======================

The following extensions can be combined with tt_products to get more
features.

-  mbi_products_categories to have many hiearchical categories for a
   product (see
   `www.ttproducts.de <http://www.ttproducts.de/tt_products_ext.html>`__)
-  transactor extension for payment gateways like PayPal, Saferpay and
   Concardis
-  agency extension for FE user registration
-  addons_tt_products extension for basket icons and example shop
   template files
-  static_info_tables extenson for country selector box
-  static_info_tables_taxes extension for taxes out of a country table:

::

    UIDstore = 2       ... uid of the fe_users record with the data of the store
    UIDstoreGroup = 2  ...  the UIDstore FE user must be a member of this comma separated list of group ids

-  patch10011 for a possibility to check the basket content and the
   shipping country in a TypoScript condition
-  taxajax extension for dynamic changes of the output when clicking on
   the variant selector box
-  tcpdfbill_tt_products to automatically generate a PDF bill and send
   it with each order attached to the order confirmation email.
-  tsparser to have an enhanced constants editor which does not add many
   zero constants which are already existent by default.
-  voucher to deal with voucher codes
-  (given up) myDashboard for several lists: a most recent order list,
   newest products, out of stock, few on stock

=====================
Patches for TYPO3 6.2
=====================

Unfortunately TYPO3 6.2 introduces bugs and misses some features. You
should apply these patches from forge.typo3.org:

-  

   #. 63047 TreeView with non pages isInWebMount wrong parameter because
      of Bugfix #18797

-  https://review.typo3.org/#/c/38917/

======
Wanted
======

You are welcome to join the team to implement your features of
tt_products. (see the tt_products news list. If you have already a
working shop and want to be sure that it will remain compatible to
future versions of TYPO3, help us to achieve this: Give us a full copy
of your TYPO3 tt_products implementation. This is necessary to test it
during the development process.

========
Download
========

TER:
`tt_products <https://extensions.typo3.org/extension/tt_products/>`__

You will find the tt_products 2.9.5 sources (and all older versions)
with the Extension Manager. The official sources with small corrections
(maybe not working) are downloadable from `Github
tt_products <https://github.com/franzholz/tt_products>`__ .

::

   git pull https://github.com/franzholz/tt_products

| Only the latest code of the master of a version specific branch may be
  uploaded into TER.
| See the tt_products manual for upgrade steps from previous versions of
  tt_products.

Newer versions of tt_products are availble and can be ordered from the
website `tt_products.de
Shop <https://www.ttproducts.de/index.php?id=tt_products_ext>`__.

=========
Templates
=========

See the extension addons_tt_products for example shop template files.

=============
Documentation
=============

Marker
======

This is documented on the subpage `tt_products
Marker <tt-products-marker>`__

Installation Instructions
=========================

| Remove your tt_products extension from the Extension Manager, download
  the file above and copy its contents to the local folder
  typo3conf/ext/tt_products or the global typo3/ext/tt_products on your
  server.
| Then use the Extension Manager's "Available extensions to install" and
  add the Shop system again.

*Install Tool*:

[FE][cacheHash][excludedParameters]:

Add these: eID,search,tt_products[search],tt_products[pp]

Categories
==========

You have several setup options to configure the display and the
behaviour of category lists and menues.

Recommendations
===============

Put your recommendations here. Send error messages directly to the
author.

-  Recommendation 1:

If you use PIDthanks then you have to use also the
BASKET_ORDERTHANKS_TEMPLATE used for displaying a thanks page.

-  Recommendation 2:

I had the problem, that when choosing a variant of a product and the
marker ###ARTICLE_NOTE### was used in conjunction with all german
special characters showed up as "?". Setting ['t3lib_cs_convMethod'] =
'recode' and ['t3lib_cs_utils'] = 'recode' solved the problem. It seems
to me that the standard conversion methods used in TYPO3 (used version
was 4.2.8) screwed up a little bit here.

-  Recommendation 3:

No extension is added as suggested for tt_products due to
misunderstanding from some users who thought that these extensions were
required. So here comes the list of suggested extensions: agency,
pmkhtmlcrop, static_info_tables, static_info_tables_taxes, taxajax,
transactor

Hooks
=====

It's much easier to upgrade from one shop-version to the current one,
when addons are added using `hook </Category:Hook>`__ [deprecated wiki
link]s. When a hook exists what is not listed here, then **just add** it
to this page! --`Daniel Brüßler </User:Patchworker>`__ [deprecated wiki
link] 09:45, 21 April 2007 (CEST)

getLinkParams
-------------

example usage: *I need to add certain parameter to the "back to list"
links*

documentation@2007-03-17 - available in the next version (suppose
2.5.3):

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $hookObj->getLinkParams($this,$queryString,$excludeList,$addQueryString,$bUsePrefix,$bUseBackPid,$piVarCat);

You can define your method with the $addQueryString as a reference. Then
you can change the contents.

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      function getLinkParams($excludeList='',&$addQueryString, ...) {
        ...
        $queryString['backPID'] = 0815;
      }

addGlobalMarkers
----------------

example usage: *I need to add "global" content what comes from the
FlexForm or what is defined by TypoScript*

documentation@2007-04-21 - available since version 2.5.2:

You define the method in an extra class:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      class tx_ttproducts_markeradd {
         function addGlobalMarkers(&$markerArray)     {
           $markerArray['###EXT_PRODUCT_YOURNEWMARKER###'] = 'YOURNEWMARKER-content';
           return;
         }
      }

      if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/YOUREXTENSIONKEY/marker/class.tx_ttproducts_markeradd.php']) {
        include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/YOUREXTENSIONKEY/marker/class.tx_ttproducts_markeradd.php']);
      }

      if (defined('TYPO3_MODE')) {
        $TYPO3_CONF_VARS['EXTCONF'][TT_PRODUCTS_EXTkey]['addGlobalMarkers'][] =
          'EXT:ext/YOUREXTENSIONKEY/marker/class.tx_ttproducts_markeradd.php:&tx_ttproducts_markeradd';
      }

and load it in the main class class.tx_ttproducts_pi1 using
**require_once**.

getItemMarkerArray
------------------

You can use the hook at function getItemMarkerArray in
model/class.tx_ttproducts_article_base.php to add markers on a
product/article base.

======================
Migration to TYPO3 9.5
======================

Speaking Url
============

If you have formerly used realurl and want to keep the already existing
links, then you can migrate the speaking urls by this method. Just
execute this SQL:

::

      SELECT CONCAT('UPDATE tt_products SET slug = "',value_alias,'" WHERE uid = ',tt_products.uid,';'), tt_products.uid, slug, value_alias FROM tt_products,tx_realurl_uniqalias WHERE tx_realurl_uniqalias.tablename = 'tt_products' AND tx_realurl_uniqalias.expire=0 AND tt_products.uid = tx_realurl_uniqalias.value_id

Or here is an alternative php script:
`File:Migration-Routing-Enhancer.odt <files/Migration-Routing-Enhancer.odt>`__

Upgrade scripts
===============

Use the tt_products upgrade scripts in the Install Tool if necessary.
Before TYPO3 9 you must do everything by yourself using phpMyAdmin or
another database tool.

#. Upgrade the products to articles relations if you change the
   articleMode from 0 to 1 or 2 in the Extension Manager. useArticles
   must be changed too.
#. If you use the graduated tables then you must once change the renamed
   fields of table tt_products_mm_graduated_price. Rename product_uid
   into uid_local, rename graduated_price_uid into uid_foreign, rename
   productsort into sorting, rename graduatedsort into sorting_foreign
#. The order to product relation fields of table
   sys_products_orders_mm_tt_products have been changed. Rename
   sys_products_orders_uid into uid_local, rename tt_products_uid into
   uid_foreign .

.. _speaking-url-1:

============
Speaking Url
============

Since TYPO3 9.5 the speaking urls are implemented by the Routing
Enhancer. In former versions the extension realurl has been used in most
cases.

Configure the slug extension:

.. container::

   ::

      # Module configuration for extension slug
      module.tx_slug {
          settings{
              additionalTables{
                 tt_products {
                      label = Products
                      slugField = slug
                      titleField = title
                      icon = EXT:tt_products/res/icons/table/tt_products.gif
                  }
              }
          }
      }

example Yaml file for the routing enhancer with tt_products support:

`File:Yaml ttproducts.odt <files/Yaml_ttproducts.odt>`__

========
Wishlist
========

newly implemented
=================

-  credit card payment via Paypal: Paypal extension can be used together
   with the Payment Library and tt_products

Add your wishes here
====================

what should be implemented in the next step.

-  integration with other backend shop data, for example stock, shipping
   services like Hermes, CRM
-  using rg_slideshow for product pictures would be nice
-  it would be nice if it was possibly to select autorotation of
   highlights and offers. I.e. two 'offers' or 'highlights' displayed on
   the front page – each time the page is updated, the next (or random)
   two 'offers'/'highlights' are displayed. I know 'ke_showproducts'
   have this feature, but it do not allow you to use al the fields of
   tt_products (only 'image' and 'title').

-  XML product feeds, to import products from supplier XML DB.

-  category support by page. Select category when you create an article
   or product and save all products and acticles in one sysfolder.
   Create new page, insert shop, selct list, chose category that is to
   be displayed, or select all

-  it would be nice if multiple price discount percentage user groups
   could be added. Ie. admin adds a user COMPANY 3 to user group 1 and
   this user group has 10% off price (configureable) and prices are
   automatically cut off 10% when he logs in, or even better - under the
   price his discount is displayed as: Your discount: 10%. Then, 10% is
   deducted from total in his basket or total sum. This way it could
   enable nice reseller purchasements or wholesale. It would be
   absolutely GREAT if additionally products or products groups could
   have different discount rates. Ie. Prod group 1 for user group 1
   discount: 8%.

-  Always check if the amount of products is on the stock before making
   an order possible.

-  `Ajax </Category:Ajax>`__ [deprecated wiki link] Shop Search

-  `Ajax </Category:Ajax>`__ [deprecated wiki link] Mini Basket

-  Create a price value where shipping costs nothing

-  Ratings : rate popularity of the product

-  opinions/feedback left by others(registered users) who used the
   product.

-  Possibilitie to have a Main product and from there a link to
   accessoires which you also can buy if you want.

-  Backend module for order processing, product and user administration

-  Possibility to use 4 decimals (0,0231) for wholesale items.

-  Possibility to sell downloadable items, e.g. pictures or software.

-  display error message for wrong entries on the entry page

-  make TMENU usable with the products sysfolder

-  possibility to save automatically if the customer is male or female.

-  More options when showing the variants in single view ex. use radio
   buttons instead of droplist; show variant price next to option. ex.
   SIZE - PRICE

-  would be nice to have this module using Flex and Templavoila, instead
   of traditional TS templating

-  Resize images to a exact size (ex: 150px x 120px) even if they are
   horizontal or vertical sized

=================
Implemented Shops
=================

| Here you can enter the URLs of the shops you have implemented with
  tt_products.
| Please, keep the alphabetical sorting by the URLs.

| 
| `Minishop modified list/put in
  basket <http://www.fernwege.de/einkauf/digitale-karten/index.html,>`__
  [not available anymore]
| `Goldene Zeiten Juweliere <https://www.goldene-zeiten.info>`__
| `KRAMSKI Putter Golfausrüstung <http://www.kramski-putter.com,>`__
  [not available anymore]
| `LignoPlant - Der Pflanzgutshop von
  Lignovis <http://www.lignoplant.com>`__
| `Traditionelle Weihnachtskunst aus dem
  Erzgebirge <http://www.nutcracker-house.com>`__
| `qualitaetsstruempfe.de <http://www.qualitaetsstruempfe.de>`__
| `Schimonski's Kulturkaufhaus <http://www.schimonski.de/>`__
| `Shop für
  Sonnenschutzfolien <http://www.sonnenschutzfolien-shop.de/>`__
| `Silkes Schmuckmuschel <https://www.schmuckmuschel.de>`__
| `tt_products shop <http://www.ttproducts.de>`__
| `Shop für den Orgelbau <http://www.weiblen.de/>`__

===============
TYPO3 Solutions
===============

The records are not shown
=========================

If you use the Fluid Styled Contents and want to insert a tt_products
record as a content element by "Insert records [shortcut]", then you
must put this into the constants:

::

    styles.content.shortcut.tables := addToList(tt_products)

====
Code
====

How shall the code be improved in the future? Please send me your
recommendations. You can also put a link to a patch file here which you
want to be added to the code. Please also add an info to which version
in svn you have written your patch.

-  The function headers shall be completed.

--`Franz Holzinger </User:Franzholz>`__ [deprecated wiki link] 09:20, 12
October 2008 (CEST)
