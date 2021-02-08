.. include:: /Includes.rst.txt

==================
Tt products marker
==================

Markers
=======

Use the extension fh_debug and insert a debug line into your file
class.tx_ttproducts_basket_view.php to see your example values of the
markers.

::

    debug ($markerArray, '$markerArray');

General Single Markers
----------------------

Additional text markers
^^^^^^^^^^^^^^^^^^^^^^^

You can add multiple additional texts to each product together with a
marker suffix, e.g. "MYMARKER". The contents of the text has the marker

::

   ###PRODUCT_TEXT_MYMARKER###

.

The title has the marker

::

   ###PRODUCT_TEXT_MYMARKER_TITLE###

Errors and Messages Markers
^^^^^^^^^^^^^^^^^^^^^^^^^^^

These and many more markers are stored in the file
tt_products/marker/locallang.xml and the language file
tt_products/marker/de.locallang.xml.

::

      <label index="basket_goto">Go to shopping cart.</label>
      <label index="basket_into">Into the shopping cart.</label>
      <label index="basket_into_input_type">Send</label>
      <label index="basket_mini_empty">Shopping cart is empty</label>

More language files can be found in the extension addons_tt_products. In
the meantime they are already copied to the TYPO3 translation server.
See the tt_products setup.txt file for some markers with address and
account information which you must overwrite for your shop.

Use the setup

::

      plugin.tt_products.marks {
         basket_goto = Go to the basket
         mymarker = my self defined marker content
      }

to fill in the contents of the marker **###MYMARKER###**. Use the
language specific conditions around it to support multiple languages:

::

      [globalVar = GP:L = 1]

Select Box
^^^^^^^^^^

-  selector for a delivery address (pick_store):

::

   ###DELIVERY_STORE_SELECT###

Form Url Markers
^^^^^^^^^^^^^^^^

These markers are generally used as the destination of a form.

::

     <form method="post" action="###FORM_URL###">
     ...
     </form>

-  ###FORM_URL### (url is determined by the used plugin)
-  ###FORM_URL_AGB### (PIDagb, agb page)
-  ###FORM_URL_BASKET### (PIDbasket, basket page)
-  ###FORM_URL_BILLING### (PIDbilling, billing page)
-  ###FORM_URL_CURRENT### (the url of the current page)
-  ###FORM_URL_DELIVERY### (PIDdelivery, delivery page)
-  ###FORM_URL_FINALIZE### (PIDfinalize, finalize page)
-  ###FORM_URL_INFO### (PIDinfo, info page)
-  ###FORM_URL_MEMO### (PIDmemo, memo page)
-  ###FORM_URL_PAYMENT### (PIDpayment, payment page)
-  ###FORM_URL_SEARCH### (PIDsearch, search page)
-  ###FORM_URL_THANKS### (PIDthanks, order thanks page)
-  ###FORM_URL_TRACKING### (PIDtracking, tracking page)
-  ###FORM_URL_USER1### (PIDuser1, 1 .. 5 user defined page)

All markers have been encoded by the htmlspecialchars function. If you
need the original value, then you must use the '_VALUE' postfix. E.g.

::

   ###FORM_URL_BASKET_VALUE###

Hint: There exists no marker ###FORM_URL_SINGLE### based on
pidItemDisplay. This is because this setup can be complex and turn out
to be different for every product. Use the marker ###URL_ITEM### in item
lists instead.

Item Single Markers
-------------------

Product
^^^^^^^

::

   ###PRODUCT_<fieldname>###

<fieldname> is the name of the database table field in capital letters.
see image, price

Use this marker scheme also for articles "ARTICLE", categories
"CATEGORY", front end users "FEUSER" and orders "ORDER". Open the file
ext_tables.sql of tt_products to see all the field names which
correspond to a marker. You get the meanings of each field if you open
the record from the backend module LIST menu of TYPO3.

E.g. ###ARTICLE_TITLE###

###CATEGORY_SUBTITLE###

###ORDER_TRACKING_NO###

Article
^^^^^^^

::

   ###ARTICLE_<fieldname>###

see product

Category
^^^^^^^^

::

   ###CATEGORY_<fieldname>###

see product

Front End User / Order Address
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

::

   ###FEUSER_<fieldname>###

see product

###FEUSER_TOTAL_DISCOUNT###: (v 3.0.0) The discount assigned to a front
end user or to one of his front end user groups. No other discounts are
included here. The former marker ###FE_USER_TT_PRODUCTS_DISCOUNT### is
deprecated.

Order
^^^^^

::

   ###ORDER_<fieldname>###

see product

In the basket view you have reduced number of markers:

###ORDER_UID### order number: unique id of the order

###ORDER_DATE### order date

###ORDER_TRACKING_NO### tracking number of the order

###ORDER_BILL_NO### bill number (Only available if the bill is generated
automatically.)

Image
^^^^^

Use the constants separateImage=1 to show the product images with their
own markers. Set limitImage=10 to allow 10 different image markers.

###PRODUCT_IMAGE1### Marker for the first image of the product.

###PRODUCT_IMAGE2### Marker for the second image of the product. Change
the number to get the marker for the further product images.

###PRODUCT_IMAGE### Marker for all images of the product. Use the
constants separateImage=0 to show the product images as one single
image.

###ARTICLE_IMAGE1### Marker for the first image of the product which can
be overridden by the image of a chosen article variant.

::

   ###PRODUCT_IMAGE1:D###

Marker for the first image of a product which has its own setup:

::

   conf.tt_products.ALL.image.d {
      ...
   }

Price
^^^^^

There are different markers available. The article markers will be used
for the corresponding product, if no article has been assigned to the
product. tt_products ships with 2 price fields. You can write enhancing
extensions which add many more price fields. For products you can also
add the "PRODUCT_" prefix to each price marker. An article marker will
show the product when no article has been assigned to a product. **If
you use discounts, then you must use the price markers without a PRODUCT
or an ARTICLE prefix.**

-  Calculated with discounts

###TAX###: Tax percentage

###PRICE_TAX### ###PRICE2_TAX###: Gross price with added tax

###PRICE_NO_TAX### ###PRICE2_NO_TAX###: Net price without any tax

###PRICE_ONLY_TAX### ###PRICE2_ONLY_TAX###: Amount of tax

###OLD_PRICE_TAX###: Former gross price with added tax - No discount has
been removed.

###OLD_PRICE_NO_TAX###: Former net price without any tax - No discount
has been removed.

###UNIT_PRICE_TAX###: Gross price per unit with added tax

###UNIT_PRICE_NO_TAX###: Net price per unit without any tax

###WEIGHT_UNIT_PRICE_TAX###: Gross price per weight unit with added tax

###WEIGHT UNIT_PRICE_NO_TAX###: Net price per weight unit without any
tax

###PRICE_TAX_DISCOUNT### ###PRICE2_TAX_DISCOUNT###: Gross amount of a
gained discount

###PRICE_TAX_DISCOUNT_PERCENT### ###PRICE2_TAX_DISCOUNT_PERCENT###:
Percentage of a gained discount

-  Calculated with credit points (v2.13.0)

###PRICE_IF_DISCOUNTED_BY_CREDITPOINTS_TAX###: Gross price reduced by
the value of the creditpoints for this article.

###PRICE_IF_DISCOUNTED_BY_CREDITPOINTS_NO_TAX###: Net price reduced by
the value of the creditpoints for this article.

-  Product

###PRODUCT_PRICE_TAX### ###PRODUCT_PRICE2_TAX###: Gross price and price2
with added tax See calculated price markers. A prefix "PRICE_" must be
added.

-  Article

See calculated price markers. A prefix "ARTICLE_" must be added.

Plugin Specific Single Marker
-----------------------------

Basket
^^^^^^

This includes the following display modes:

-  "Basket: shopping cart, options",
-  "Basket: overview",
-  "Basket: collect addresses",
-  "Basket: order review, payment",
-  "Basket: order confirmation",
-  "Orders: tracking",
-  "Orders: list",
-  "Orders: billing",
-  "Orders: delivery"
-  "Orders: downloads"

It also includes the

-  sent order confirmation emails
-  generated bill and delivery documents

###DELIVERY_CHECKBOX1_CHECKED###: This is replaced by "checked" if the
basket checkbox no. 1 has been checked before. (v3.0.0)

Item Row
''''''''

###LINE_NO### (v3.0.0):

::

   line number in the list of the items in the basket

.. _price-1:

Price
'''''

You sometimes also have a PRICE2 marker which will give the value for
the second price field. Many more price numbers can be supported by
additional extensions.

###PRICE_GOODSTOTAL_TAX###, ###PRICE2_GOODSTOTAL_TAX###: total sum of
the items with included tax

###PRICE_GOODSTOTAL_NO_TAX###, ###PRICE2_GOODSTOTAL_NO_TAX###: total sum
of the items without any tax

###PRICE_GOODSTOTAL_ONLY_TAX###, ###PRICE2_GOODSTOTAL_ONLY_TAX###: tax
of total sum of the items

###OLD_PRICE_GOODSTOTAL_TAX###: total sum of the items without any
calculated discount

###OLD_PRICE_GOODSTOTAL_NO_TAX###: total sum without any tax of the
items without any calculated discount

###PRICE_DISCOUNT_GOODSTOTAL_TAX###: discount for the total sum of the
items with included tax

###PRICE_DISCOUNT_GOODSTOTAL_NO_TAX###: discount without any tax for the
total sum of the items

###PRICE_TOTAL_TAX###: total sum of the items with shipping, handling
and payment costs with included tax

###PRICE_TOTAL_NO_TAX###: total sum of the items with shipping, handling
and payment costs without any tax

###PRICE_TOTAL_ONLY_TAX###: total tax of the items with shipping,
handling and payment costs

###PRICE_TOTAL_TAX_CENT### : same as ###PRICE_TOTAL_TAX###, however the
value is multiplied by 100 (cents)

###PRICE_TOTAL_TAX_WITHOUT_PAYMENT###: same as ###PRICE_TOTAL_TAX###,
however the payment has not been added

###PRICE_TOTAL_NO_TAX_WITHOUT_PAYMENT###: same as
###PRICE_TOTAL_NO_TAX###, however the payment has not been added

###PRICE_TOTAL_0_TAX###: total sum of the items with shipping, handling
and payment costs with included tax for a reseller price number - e.g.
from price2

###PRICE_VOUCHERTOTAL_TAX###: same as ###PRICE_TOTAL_TAX###, however the
discount from a voucher code has been considered

###PRICE_VOUCHERTOTAL_NO_TAX###: same as ###PRICE_TOTAL_NO_TAX###,
however the discount from a voucher code has been considered

###PRICE_VOUCHERGOODSTOTAL_TAX###: same as ###PRICE_GOODSTOTAL_TAX###,
however the discount from a voucher code has been considered

###PRICE_VOUCHERGOODSTOTAL_NO_TAX###: same as
###PRICE_GOODSTOTAL_NO_TAX###, however the discount from a voucher code
has been considered

###PRICE_VOUCHERTOTAL_TAX_CENT###: same as ###PRICE_TOTAL_TAX_CENT###,
however the discount from a voucher code has been considered

###PRICE_TAXRATE_NAME1###, ###PRICE_TAXRATE_NAME2###: name of taxrate
no. 1, 2

###PRICE_TAXRATE_TAX1###, ###PRICE_TAXRATE_TAX2###: taxrate percentage
no. 1, 2

###PRICE_TAXRATE_TOTAL1###, ###PRICE_TAXRATE_TOTAL2###: total sum of the
items, shipping, payment and handling costs with included tax for
taxrate no. 1, 2

###PRICE_TAXRATE_GOODSTOTAL1###, ###PRICE_TAXRATE_GOODSTOTAL2###: total
sum of the items with included tax for taxrate no. 1, 2

###PRICE_TAXRATE_ONLY_TAX1###, ###PRICE_TAXRATE_ONLY_TAX2###: total sum
of the taxes for the items, shipping, payment and handling costs of
taxrate no. 1, 2

###PRICE_TAXRATE_GOODSTOTAL_ONLY_TAX1###,
###PRICE_TAXRATE_GOODSTOTAL_ONLY_TAX2###: total sum of the taxes for the
items of taxrate no. 1, 2

###NUMBER_GOODSTOTAL###: total number of items

###PRICE_PAYMENT_TAX###: costs for the payment with included tax

###PRICE_PAYMENT_NO_TAX###: costs for the payment without any tax

###PRICE_PAYMENT_ONLY_TAX###: tax for the payment

###PRICE_SHIPPING_TAX###: costs for the shipping with included tax

###PRICE_SHIPPING_NO_TAX###: costs for the shipping without any tax

###PRICE_SHIPPING_ONLY_TAX###: tax for the shipping

###PRICE_HANDLING_10_TAX###: costs for the handling line 10 with
included tax

###PRICE_HANDLING_10_TAX###, ###PRICE_HANDLING_20_TAX###: costs for the
handling line 10, 20 with included tax

###PRICE_HANDLING_10_NO_TAX###, ###PRICE_HANDLING_20_NO_TAX###: costs
for the handling line 10, 20 with without any tax

###PRICE_TAX_DISCOUNT###: discount with included tax

###PRICE_VAT###: calculated tax sum

Product List
^^^^^^^^^^^^

Links
'''''

###URL_ITEM###: link to the product single view (v3.0.0)

Page Browser
''''''''''''

###CURRENT_PAGE###: current page number

###TOTAL_PAGES###: total number of pages

###BROWSE_LINKS###: page browser

Other
'''''

###IMAGE_BASKET###: (basket icon image)

###HIDDENFIELDS###: (hidden entry fields will show up here)

Content Object Markers
----------------------

External extensions can be called by special markers with underlying
TypoScript. These markers are only valid inside of the subpart
###ITEM_SINGLE_DISPLAY### or inside of the subpart ###ITEM_SINGLE###
which is itself inside of several other subparts.

Ratings
^^^^^^^

The ratings extension provides the rating of each product.

###RATING###: ratings extension

Comments
^^^^^^^^

The tt_board extension provides the commenting of each product.

###COMMENT###: tt_board extension

Subpart Markers
===============

A subpart marker has the following format

::

     <!-- ###EXAMPLE_SUBPART_MARKER### begin -->
     Here comes the example text which only shows up inside of the example subpart marker.
     <!-- ###EXAMPLE_SUBPART_MARKER### end -->

Plugin Specific Subpart Markers
-------------------------------

Basket to Finalize Main Subparts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

###BASKET_TEMPLATE###: (Basket: shopping cart, options)

###BASKET_INFO_TEMPLATE###: (Basket: collect addresses)

###BASKET_OVERVIEW_TEMPLATE###: (Basket: overview)

###BASKET_PAYMENT_TEMPLATE###: (Basket: order review, payment)

###BASKET_ORDERCONFIRMATION_TEMPLATE###: (Basket: order confirmation if
no ###BASKET_ORDERTHANKS_TEMPLATE### is available. This part will be
stored for the tracking. It is sent as an email, if
###EMAIL_HTML_TEMPLATE### missing.)

###BASKET_ORDERTHANKS_TEMPLATE###: (Basket: order confirmation)

###BASKET_ORDERCONFIRMATION_NOSAVE_TEMPLATE###: (Basket: order
confirmation. This part will not be stored for the tracking.)

###BASKET_ORDERXML_TEMPLATE###: (Basket: order confirmation will
generate a XML file)

###EMAIL_PLAINTEXT_TEMPLATE###: (Basket: order confirmation email in
plain text format sent to customer or also to shop.)

###EMAIL_PLAINTEXT_TEMPLATE_SHOP###: (Basket: order confirmation email
in plain text format sent to shop.)

###EMAIL_HTML_TEMPLATE###: (Basket: order confirmation email in HTML
format sent to customer or also to shop.)

###EMAIL_HTML_TEMPLATE_SHOP###: (Basket: order confirmation email in
HTML format sent to shop.)

###TRACKING_TEMPLATE###: (Tracking: Part of the complete order)

###BILL_TEMPLATE###: (Orders: billing)

###DELIVERY_TEMPLATE###: (Orders: delivery)

###BILL_PDF_HEADER_TEMPLATE###: (attach PDF: header of billing)

###BILL_PDF_TEMPLATE###: (attach PDF: main part of billing)

###BILL_PDF_FOOTER_TEMPLATE###: (attach PDF: footer of billing)

###DELIVERY_PDF_HEADER_TEMPLATE###: (attach PDF: header of delivery)

###DELIVERY_PDF_TEMPLATE###: (attach PDF: main part of delivery)

###DELIVERY_PDF_FOOTER_TEMPLATE###: (attach PDF: footer of delivery)

Basket internal
^^^^^^^^^^^^^^^

###MESSAGE_MINQUANTITY_ERROR###: Error message subpart if less than the
minimum quantity of a product has been put into the basket

###MESSAGE_MAXQUANTITY_ERROR###: Error message subpart if more than the
maximum quantity of a product has been put into the basket

###MESSAGE_ERROR###: Error message subpart shown if an error message has
been generated.

###MESSAGE_NO_ERROR###: Error message subpart shown if no error message
has been generated.

###CHECKBOX1_CHECKED###: If the basket checkbox no. 1 with the name
"recs[delivery][checkbox1]" has been checked. (v3.0.0)

Basket Single Item
''''''''''''''''''

###IS_DOWNLOAD###: If a download object with an assigned FAL record has
been related to a product and a combination of both has been put into
the basket. (v3.0.0)

.. _product-list-1:

Product List
^^^^^^^^^^^^

###ITEM_LIST_RELATED_TEMPLATE###: (Products: related products) replaces
###PRODUCT_RELATED_UID###

###ITEM_LIST_ACCESSORY_TEMPLATE###: (Products: related accessory
products) replaces ###PRODUCT_ACCESSORY_UID###

###ITEM_LIST_RELATED_BY_SYSTEMCATEGORY_TEMPLATE###: (Products: related
products by system category. v2.12.0) replaces
###PRODUCT_RELATED_SYSCAT###

###MEMO_TEMPLATE###: (Products: memo)

###ITEM_LIST_DOWNLOADS_TEMPLATE###: (Orders: downloads)

Single Item
'''''''''''

###LINK_ITEM###: link to the item (product) single view

Category and Items
''''''''''''''''''

###ITEM_CATEGORY_AND_ITEMS###: repeated part in the list view: category
with all products from this category. Only the following format for
integrated subparts is supported:

<!-- ###ITEM_CATEGORY_AND_ITEMS### --><!-- ###ITEM_CATEGORY### begin
--><!-- ###ITEM_CATEGORY### end --><!-- ###ITEM_LIST### begin --><!--
###ITEM_SINGLE### begin--> <!-- ###ITEM_SINGLE### end --><!--
###ITEM_LIST### end --><!-- ###ITEM_CATEGORY_AND_ITEMS### end -->

.. _page-browser-1:

Page Browser
''''''''''''

###LINK_NEXT### next products page

###LINK_PREV### next products page

###LINK_BROWSE### browser framework area with special browser markers
(###BROWSE_LINKS###). It is recommended to activate the former pi_base
browser which comes with the extension div2007:
"plugin.tt_products.conf.tt_products.LIST.view.browser = div2007".

Article List
^^^^^^^^^^^^

###ITEM_LIST_RELATED_ARTICLES_TEMPLATE### (Products: related articles)

###ARTICLE_LIST_TEMPLATE### (Articles: list)

Product Single
^^^^^^^^^^^^^^

###ITEM_SINGLE_DISPLAY### (Products: single view)

###ITEM_SINGLE_DISPLAY_RECORDINSERT### (Products: single inserted
product)

Category Single
^^^^^^^^^^^^^^^

###CATEGORY_SINGLE_DISPLAY### (Categories: single)

Search Form
^^^^^^^^^^^

###ITEM_SEARCH### (Products: search)

Tracking
^^^^^^^^

###TRACKING_DISPLAY_INFO### (The main subpart for the tracking which
contains subsections)

###TRACKING_ENTER_NUMBER### (Displays form for entering the tracking
number or the admin code)

###TRACKING_EMAILNOTIFY_TEMPLATE### (Email notification for changes in
the tracking status)

###TRACKING_TEMPLATE###: see Basket

Orders
^^^^^^

###ORDERS_LIST_TEMPLATE###

Downloads
^^^^^^^^^

###DOWNLOAD_LIST_TEMPLATE###

Category Lists
^^^^^^^^^^^^^^

###ITEM_CATLIST_TEMPLATE### (Categories: list)

###ITEM_CATEGORY_SELECT_TEMPLATE### (Categories: select)

###ITEM_CATEGORY_MENU_TEMPLATE### (Categories: menu)

DAM Category Lists
^^^^^^^^^^^^^^^^^^

###ITEM_DAMCATLIST_TEMPLATE### (DAM Categories: list)

###ITEM_DAMCATSELECT_TEMPLATE### (DAM Categories: select)

###ITEM_DAMCATMENU_TEMPLATE### (DAM Categories: menu)

Address Lists
^^^^^^^^^^^^^

###ITEM_ADLIST_TEMPLATE### (Addresses: list)

###ITEM_ADDRESS_SELECT_TEMPLATE### (Addresses: select)

###ITEM_ADDRESS_MENU_TEMPLATE### (Adresses: menu)

Specials
^^^^^^^^

###BASKET_ORDERCONFIRMATION_NOSAVE_TEMPLATE###

###EMAIL_NEWUSER_TEMPLATE### (Basket: order confirmation. Notification
email for automatically created FE user in plain text format.)

###EMAIL_HTML_SHELL### (Basket: order confirmation. Template for the
generation of the order confirmation email in HTML format.)

###BILL_PDF_HEADER_TEMPLATE###

###BILL_PDF_TEMPLATE###

###BILL_PDF_FOOTER_TEMPLATE###

###TRANSACTOR_FORM_TEMPLATE### (Basket: order review, paymen. Used as a
base for extensions based on the Trasactor API)

General Subpart Markers
-----------------------

Errors and Messages Subparts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

###MEMO_NOT_LOGGED_IN### (If the MEMO list requires a login and when no
FE user is logged in)

###MEMO_EMPTY### (If no products have been put to the MEMO list)

###ITEM_SEARCH_EMPTY### (If the search does not find anything)

###ITEM_LIST_EMPTY### (If the filtered product list has no result.)

###ITEM_ADLIST_TEMPLATE_EMPTY### (If the filtered address list has no
result.)

###BASKET_OVERVIEW_EMPTY### (If the basket is empty and the overview
plugin is active.)

###BASKET_TEMPLATE_EMPTY### (If the basket is empty and the basket
plugin is active.)

###BASKET_REQUIRED_INFO_MISSING### (If a required field for the order
has not been given.)

###TRACKING_WRONG_NUMBER### (If the given tracking number is invalid.)

###ERROR_TEMPLATE### (If a general internal error has occurred)

###BASKET_TEMPLATE_NOT_LOGGED_IN### (If the basket is only shown to
logged in FE users and no user is logged in.)

###BASKET_TEMPLATE_MINPRICE_ERROR### (If the basket's minimum price sum
has not been reached.)

Special Features
^^^^^^^^^^^^^^^^

###FE_GROUP_1_TEMPLATE### (If a FE user is logged in which is a member
of the FE group with id 1)

###LOGIN_TEMPLATE### (If any FE user is logged)

###NOLOGIN_TEMPLATE### (If no FE user is logged)

Product, Article and Front End User
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This can be the item part inside of the list view or single view. All
subpart markers are in capital letters. For articles use the form
###ARTICLE_...### instead of ###PRODUCT_...### and for the current front
end user (only tt_products >= 2.12.0) the prefix is FEUSER which results
in ###FEUSER_...### .

-  Conditional subpart marker

###PRODUCT_<FIELD NAME>_<CONDITION 2 CHARACTERS>_<VALUE>###

-  

   -  Field name: name of the field in the table tt_products
   -  Condition: The Javascript 2 character condition.

see the Javascript conditional operators, e.g.
http://de.wikipedia.org/wiki/Vergleichsoperator :

::

   'EQ' => '==', 'NE' => '!=', 'LT' => '<', 'LE' => '<=', 'GT' => '>', 'GE' => '>='

-  

   -  Value: integer value for comparision

-  

   -  Example:

<!-- ###PRODUCT_OFFER_EQ_1### begin --> \**\* AKTION \**\* \**\* Offer
\**\* <!-- ###PRODUCT_OFFER_EQ_1### end -->

<!-- ###PRODUCT_INSTOCK_EQ_0### begin --> Nicht mehr auf Lager! Is not
on stock. <!-- ###PRODUCT_INSTOCK_EQ_0### end -->

<!-- ###PRODUCT_INSTOCK_NE_0### begin --> Ist auf Lager! Is on stock.
<!-- ###PRODUCT_INSTOCK_NE_0### end -->

-  Child subpart marker

###PRODUCT_HAS_<FIELD NAME><NUMBER>###

-  

   -  Field name: name of the field in the table tt_products which has a
      relation to another table.
   -  Number: A counter for the items from 1 to n.

-  

   -  Example:

<!-- ###PRODUCT_HAS_DOWNLOAD_UID1### begin --> \**\* Downloads are
assigned to this product. \**\* <!-- ###PRODUCT_HAS_DOWNLOAD_UID1### end
-->

<!-- ###PRODUCT_HAS_NOTE_UID1### begin --> \**\* This product has some
detailed description. \**\* <!-- ###PRODUCT_HAS_NOTE_UID1### end -->

<!-- ###PRODUCT_HAS_IMAGE1### begin --> \**\* At least one image has
been assigned to this product \**\* <!-- ###PRODUCT_HAS_IMAGE1### end
-->

-  No Child subpart marker

###PRODUCT_HAS_NO_<FIELD NAME>###

-  

   -  Field name: name of the field in the table tt_products which has a
      relation to another table.

-  

   -  Example:

<!-- ###PRODUCT_HAS_NO_DOWNLOAD_UID### begin --> \**\* No downloads are
assigned to this product. \**\* <!-- ###PRODUCT_HAS_NO_DOWNLOAD_UID###
end -->

-  Empty (v2.12.0)

###PRODUCT_<FIELD NAME>_EMPTY###

-  

   -  Field name: name of the field in the table tt_products.

-  

   -  Example:

<!-- ###PRODUCT_NOTE_EMPTY### begin --> \**\* This product no
description. \**\* <!-- ###PRODUCT_NOTE_EMPTY end -->

-  Not empty (v2.12.0)

###PRODUCT_<FIELD NAME>_NOT_EMPTY###

-  

   -  Field name: name of the field in the table tt_products.

-  

   -  Example:

<!-- ###PRODUCT_NOTE_NOT_EMPTY### begin --> \**\* This product has a
description. \**\* <!-- ###PRODUCT_NOTE_NOT_EMPTY end -->

-  with variants (v3.0.0)

###PRODUCT_WITH_VARIANT### The product comes with any of the selectable
variants set.

-  

   -  Example:

<!-- ###PRODUCT_WITH_VARIANT### begin --> \**\* This product has any of
the selectable variants set. \**\* <!-- ###PRODUCT_WITH_VARIANT### end
-->

-  without variants (v3.0.0)

###PRODUCT_WITHOUT_VARIANT### The product comes with none of the
selectable variants set.

-  

   -  Example:

<!-- ###PRODUCT_WITHOUT_VARIANT### begin --> \**\* This product has none
of the selectable variants set. \**\* <!-- ###PRODUCT_WITHOUT_VARIANT###
end -->

-  front end user has discount (v3.0.0)

###FEUSER_HAS_DISCOUNT###: This subpart is only visible if a discount
has been assigned to a front end user or to one of its front end user
groups.
