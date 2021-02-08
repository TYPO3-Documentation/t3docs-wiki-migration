.. include:: /Includes.rst.txt

==============
External links
==============

.. container::

   **Content Type:** `HowTo </Category:HowTo>`__ [deprecated wiki link].

Marking external links with an image or descriptive text is usually
considered good behaviour usability-wise. In some countries it may even
be required by law to mark external links. There is an extension in the
TER ('dh_linklayout') which does this, but it is quite outdated and I
did discover some bugs with it. But you can achieve the same yourself.

TypoScript
==========

Copy&Paste the following code to your TypoScript Template Setup:

::

   # Mark external links with an image
   lib.parseFunc.tags.link {
     typolink.parameter.append = LOAD_REGISTER
     typolink.parameter.append {
       isExternal {
         cObject = TEXT
         cObject {
           typolink.parameter.data = parameters:allParams
           typolink.returnLast = url
         }
         split {
           token = :
           cObjNum = 1||2
           1 = TEXT
           1.current = 1
         }
       }
     }
     outerWrap.cObject = CASE
     outerWrap.cObject {
       key.data = register:isExternal
       default = TEXT
         default.value = <img  src="fileadmin/system/templates/res/link_int.gif" alt="[Internal]" title="Internal link" /> |
       http = TEXT
         http.value = <img  src="fileadmin/system/templates/res/link_ext.gif" alt="[External]" title="External link" /> |
       mailto = TEXT
         mailto.value = <img  src="fileadmin/system/templates/res/link_mail.gif" alt="[E-Mail]" title="Write an email" /> |
     }
   }
   # Copy the above function to other important places
   lib.parseFunc_RTE.tags.link {
     typolink.parameter.append < lib.parseFunc.tags.link.typolink.parameter.append
     outerWrap < lib.parseFunc.tags.link.outerWrap
   }

Credits and many thanks go to JoH for writing this TypoScript!
