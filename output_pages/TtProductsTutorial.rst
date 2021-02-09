.. include:: /Includes.rst.txt

====================
Tt products tutorial
====================

This is step by step tutorial on running simple shop with `Tt
products <tt-products>`__
`Extension <https://wiki.typo3.org/Extension>`__ [deprecated wiki link].

*Note: This tutorial was written for version 2.5.2 of the extension, but
it should reflect last version available. Therefore if you find that any
changes are needed, please correct the text and update the version
above. Also any questions or just remarks where the text is unclear are
welcomed. Either post
on*\ `talkpage <https://wiki.typo3.org/Talk:Tt_products_tutorial>`__\ *[deprecated
wiki link] or make the change yourself. Some more complicated steps have
links to pages where you can get more information.*

Follow these steps:

-  `Install
   extension <https://wiki.typo3.org/wiki/index.php?title=Install_extension&action=edit&redlink=1>`__
   [not available anymore] tt_products.
-  On the server find the file
   ``<Extensions directory [not available anymore]>/tt_products/template/products_template.tmpl``
   and copy it to
   ``fileadmin [not available anymore]/products_template.tmpl`` file.
-  `Create new
   page <https://wiki.typo3.org/wiki/index.php?title=Create_new_page&action=edit&redlink=1>`__
   [not available anymore] with name *Online shop*.
-  `Create an extension
   template <https://wiki.typo3.org/wiki/index.php?title=Create_an_extension_template&action=edit&redlink=1>`__
   [not available anymore] for the page *Online shop* and put line
   ``plugin.tt_products.file.templateFile = fileadmin/products_template.tmpl``
   to its constants and `include static
   template <https://wiki.typo3.org/wiki/index.php?title=Include_static_(from_extensions)&action=edit&redlink=1>`__
   [not available anymore] *Shop system Old style (tt_products)* to this
   new template.
-  `Insert
   plugin <https://wiki.typo3.org/wiki/index.php?title=Insert_plugin&action=edit&redlink=1>`__
   [not available anymore] *Products* to *Online shop* and select
   Product: list to display. (Insert content element - plugin...)
-  `Create System
   folder <https://wiki.typo3.org/wiki/index.php?title=Create_System_folder&action=edit&redlink=1>`__
   [not available anymore] page *Articles* under the page *Online shop*.
-  `Edit
   properties <https://wiki.typo3.org/wiki/index.php?title=Edit_page_properties&action=edit&redlink=1>`__
   [not available anymore] of *Online shop* and `Set General record
   storage <https://wiki.typo3.org/wiki/index.php?title=Set_General_record_storage&action=edit&redlink=1>`__
   [not available anymore] to *Articles*.
-  `Add new
   record <https://wiki.typo3.org/wiki/index.php?title=Add_new_record&action=edit&redlink=1>`__
   [not available anymore] of type Product category to *Articles* page
   with name T-shirts.
-  `Add new
   record <https://wiki.typo3.org/wiki/index.php?title=Add_new_record&action=edit&redlink=1>`__
   [not available anymore] of type Article to *Articles* page with name
   *Plain T-shirt* giving it Category T-shirts, price 10 and maybe some
   text or picture. You must fill in the product's 'In Stock (pcs)'
   field, or no item will be shown.
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
