.. include:: /Includes.rst.txt
.. highlight:: php

====================
Tt products tutorial
====================

This is step by step tutorial on running simple shop with `Tt
products <tt-products>`__ Extension [outdated wiki link].

*Note: This tutorial was written for version 2.5.2 of the extension, but
it should reflect last version available. Therefore if you find that any
changes are needed, please correct the text and update the version
above. Also any questions or just remarks where the text is unclear are
welcomed. Either post on talkpage [outdated wiki link] or make the
change yourself. Some more complicated steps have links to pages where
you can get more information.*

Follow these steps:

-  Install extension [outdated link] tt_products.
-  On the server find the file
   ``<Extensions directory [outdated link]>/tt_products/template/products_template.tmpl``
   and copy it to ``fileadmin [outdated link]/products_template.tmpl``
   file.
-  Create new page [outdated link] with name *Online shop*.
-  Create an extension template [outdated link] for the page *Online
   shop* and put line
   ``plugin.tt_products.file.templateFile = fileadmin/products_template.tmpl``
   to its constants and include static template [outdated link] *Shop
   system Old style (tt_products)* to this new template.
-  Insert plugin [outdated link] *Products* to *Online shop* and select
   Product: list to display. (Insert content element - plugin...)
-  Create System folder [outdated link] page *Articles* under the page
   *Online shop*.
-  Edit properties [outdated link] of *Online shop* and Set General
   record storage [outdated link] to *Articles*.
-  Add new record [outdated link] of type Product category to *Articles*
   page with name T-shirts.
-  Add new record [outdated link] of type Article to *Articles* page
   with name *Plain T-shirt* giving it Category T-shirts, price 10 and
   maybe some text or picture. You must fill in the product's 'In Stock
   (pcs)' field, or no item will be shown.
-  Add also records and articles in other languages if you have setup
   multiple languages.

Now the basic shop implementation should be running on *Online shop*
page. You should see the Plain T-shirt icon with Qty input field and
*Put into basket* button. It is not possible to look at your basket nor
finish the order, but as least it is something. More to follow:

-  Add more records of type Article to *Articles* page to Category
   T-shirts, with some price and text.
-  Create new page *Basket* under *Online shop* and put the the
   *Products* plugin to it. This time select *Basket: contents*.
