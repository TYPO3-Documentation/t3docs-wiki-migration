.. include:: /Includes.rst.txt

=====
Fluid
=====

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript.
      `info <https://wiki.typo3.org/Help:Contents#Teamwork_-_draft_review_publish_delete_merge_outdated>`__
      [deprecated wiki link]

.. container::

   notice - This information is outdated

   .. container::

      This page is related to the outdated TYPO3 version 6.2 and is no
      longer being updated. For information about Fluid for newer
      versions, see
      https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Fluid/Index.html

Also see `FluidSyntax <fluidsyntax>`__.

+-----------------------------------+-----------------------------------+
| **Fluid / Extbase**               |                                   |
| | Extbase is a backport of some   |                                   |
|   features of Flow (the PHP       |                                   |
|   framework on which TYPO3 Neos   |                                   |
|   will be built) to TYPO3 CMS.    |                                   |
| | With Fluid, the new templating  |                                   |
|   system, all the code for the    |                                   |
|   view logic moves to the         |                                   |
|   template.                       |                                   |
+-----------------------------------+-----------------------------------+
| *current version:*                |                                   |
+-----------------------------------+-----------------------------------+
| `TYPO3                            | Extbase/Fluid 6.2                 |
| 6.2 <https://wiki.                |                                   |
| typo3.org/wiki/index.php?title=TY |                                   |
| PO3_6.2&action=edit&redlink=1>`__ |                                   |
| [not available anymore]           |                                   |
+-----------------------------------+-----------------------------------+
| *earlier releases:*               |                                   |
+-----------------------------------+-----------------------------------+
| `TYPO3                            | Extbase/Fluid 6.1                 |
| 6.1 <https://wiki.                |                                   |
| typo3.org/wiki/index.php?title=TY |                                   |
| PO3_6.1&action=edit&redlink=1>`__ |                                   |
| [not available anymore]           |                                   |
+-----------------------------------+-----------------------------------+
| `TYPO3                            | Extbase/Fluid 6.0                 |
| 6.0 <https://wiki.                |                                   |
| typo3.org/wiki/index.php?title=TY |                                   |
| PO3_6.0&action=edit&redlink=1>`__ |                                   |
| [not available anymore]           |                                   |
+-----------------------------------+-----------------------------------+
| `TYPO3                            | Extbase/Fluid 4.7                 |
| 4.7 <https://wiki.                |                                   |
| typo3.org/wiki/index.php?title=TY |                                   |
| PO3_4.7&action=edit&redlink=1>`__ |                                   |
| [not available anymore]           |                                   |
+-----------------------------------+-----------------------------------+
| `TYPO3                            | Extbase/Fluid 1.4                 |
| 4.6 <https://wiki.                |                                   |
| typo3.org/wiki/index.php?title=TY |                                   |
| PO3_4.6&action=edit&redlink=1>`__ |                                   |
| [not available anymore]           |                                   |
+-----------------------------------+-----------------------------------+
| `TYPO3                            | Extbase/Fluid 1.3                 |
| 4.5 <https://wiki.                |                                   |
| typo3.org/wiki/index.php?title=TY |                                   |
| PO3_4.5&action=edit&redlink=1>`__ |                                   |
| [not available anymore]           |                                   |
+-----------------------------------+-----------------------------------+
| `TYPO3                            | Extbase/Fluid 1.2                 |
| 4.4 <https://wiki.                |                                   |
| typo3.org/wiki/index.php?title=TY |                                   |
| PO3_4.4&action=edit&redlink=1>`__ |                                   |
| [not available anymore]           |                                   |
+-----------------------------------+-----------------------------------+
| `TYPO3                            | Extbase/Fluid 1.0                 |
| 4.3 <https://wiki.                |                                   |
| typo3.org/wiki/index.php?title=TY |                                   |
| PO3_4.3&action=edit&redlink=1>`__ |                                   |
| [not available anymore]           |                                   |
+-----------------------------------+-----------------------------------+
| *Ressources:*                     |                                   |
|                                   |                                   |
| -  `Fluid                         |                                   |
|    Guide                          |                                   |
| <https://docs.typo3.org/typo3cms/ |                                   |
| ExtbaseGuide/Fluid/Index.html>`__ |                                   |
| -  `Extbase Documentation on      |                                   |
|    Typo3                          |                                   |
|    Forge <h                       |                                   |
| ttps://forge.typo3.org/projects/t |                                   |
| ypo3v4-mvc/wiki/Documentation>`__ |                                   |
|    [not available anymore]        |                                   |
| -  `Flow                          |                                   |
|    Manuals <http://               |                                   |
| flow.typo3.org/documentation/>`__ |                                   |
|    [not available anymore]        |                                   |
| -  `FluidSyntax <fluidsyntax>`__  |                                   |
| -  `Fluid Inline                  |                                   |
|    No                             |                                   |
| tation <fluid-inline-notation>`__ |                                   |
| -  `T3Doc/Fluidtemplate by        |                                   |
|    exam                           |                                   |
| ple <fluidtemplate-by-example>`__ |                                   |
+-----------------------------------+-----------------------------------+

Collection of `fluid <https://wiki.typo3.org/Category:Fluid>`__ [deprecated wiki link] / `extbase <https://wiki.typo3.org/Category:Extbase>`__ [deprecated wiki link] hints
===========================================================================================================================================================================

Accessing a view helper
-----------------------

Acessing a viewHelper from another viewHelper for instance:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
      $viewHelper = $objectManager->get($viewHelperName);
      $result = $viewHelper->render($param1, $param2);

Including a Fluid plugin through ext_tables.php
-----------------------------------------------

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       /**
        * Register an Extbase PlugIn into backend's list of plugins
        */
       \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
          'Addresses',                    // The name of the extension in UpperCamelCase
          'Pi1',                      // A unique name of the plugin in UpperCamelCase
          'Address Management'              // A title shown in the backend dropdown field
       );

Configure a Fluid plugin through ext_localconf.php
--------------------------------------------------

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       /**
        * Configure the Extbase Dispatcher
        */
       \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
          'Vendor.' . $_EXTKEY,                   // The name of the extension in UpperCamelCase
          'Pi1',                      // A unique name of the plugin in UpperCamelCase
          array(                      
              'Address' => 'index,show',       // The first controller and its first action will be the default 
          ),
          array(
              'Address' => 'index,show',       // An array of non-cachable controller-action-combinations (they must already be enabled)
          )
       );

Accessing TS configuration in the controller
--------------------------------------------

The TS configuration can be accessed through

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $this->settings

Adding AdditionalHeaderdata (for example Stylesheets)
-----------------------------------------------------

Use

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $this->response->addAdditionalHeaderData()

Better is the method (not for uncached actions) to include js or css.

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $GLOBALS['TSFE']->getPageRenderer()->

Example:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $this->response->addAdditionalHeaderData('<link rel="stylesheet" href="' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath('extkey') . 'Resources/Public/Stylesheets/index.css" />');

Accessing the current request (f.e. for retrieving $_GET vars)
--------------------------------------------------------------

You can access the current request with

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $currentRequest = $this->variableContainer->get('view')->getRequest();

If you want to access f.e. a $_GET param use

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $this->variableContainer->get('view')->getRequest()->getArgument('name of the GET var');

or to access all arguments:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $this->variableContainer->get('view')->getRequest()->getArguments();

You can also check if an argument exists with

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $this->variableContainer->get('view')->getRequest()->hasArgument('name of the GET var');

Standard View Helpers
=====================

f:alias
-------

Used to declare one or more variables that will only be valid within the
f:alias tag.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:alias map="{x: foo.bar.baz, y: foo.bar.baz.name}">
         {x.name} or {y}
      </f:alias>

f:base
------

Outputs the base-tag in HTML

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:base />

Output:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <base href="http://example.com/"></base>

f:cObject
---------

you can get output from typoscript based on current data

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:cObject typoscriptObjectPath="lib.calc" data="45 + 34 * 2" />

in conjunction with:

::

   lib.calc = TEXT
   lib.calc {
     current = 1
     prioriCalc = 1
   }

Output:

::

   158 

(as TYPO3 prioriCalc ignores precedence of \* and calculates (45 + 34)
\* 2 )

Example2:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:cObject typoscriptObjectPath="lib.replace_umlauts">Übergröße</f:cObject>

in conjunction with:

::

   lib.replace_umlauts = TEXT
   lib.replace_umlauts {
     current = 1
     stdWrap.replacement {
       1 {
         search = ä
         replace = ae
       }
       2 {
         search = ö
         replace = oe
       }
       3 {
         search = ü
         replace = ue
       }
       4 {
         search = ß
         replace = ss
       }
       5 {
         search = Ä
         replace = Ae
       }
       6 {
         search = ö
         replace = Oe
       }
       7 {
         search = ü
         replace = ue
       }
     }
   }

Output:

::

   Uebergroesse

http://www.t3node.com/blog/combining-fluid-viewhelpers-and-typoscript-in-typo3-5-basic-examples/
[not available anymore]

f:comment
---------

Write a comment that does not get outputted in the final HTML.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:comment>
      This partial expects the following parameters:
      - "datum": Single data object with a "value" property
      - "key": Name of datum
      </f:comment>

f:count
-------

Counts the number of elements in an array

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:count subject="{myarray}" />

Output: 5

Example for usage in condtions:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:if condition="{myarray -> f:count()} > 3">

      // do something

      </f:if>

f:cycle
-------

If used inside a for-loop will rotate the values given.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:for each="{0:1, 1:2, 2:3, 3:4}" as="foo">
        <f:cycle values="{0: '..', 1: '--', 2: 'xx'}" as="cycle">
          {cycle}
        </f:cycle>
      </f:for>

Output: ..--xx..

Usage: Use to create Zebra-Styles, Rotating Templates, ...

f:debug
-------

Debugs the content inside the tag, Outputs the title in front

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:debug title="Debug of MyArray">{myarray}</f:debug>
      <f:debug title="All available variables">{_all}</f:debug>

To modify the depth of an object's properties, use the ``maxDepth``
attribute. It defaults to 8:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:debug maxDepth="3">{data}</f:debug>

By default, the dump is positioned above all elements on the page, and
on the top left. To show it at the place ``f:debug`` is called at,
activate "inline":

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:debug inline="true">{data}</f:debug>

.. container::

   warning - Message

   .. container::

      ``<f:debug>`` does not output properties of plain stdClass objects
      in TYPO3 < 6.2.5

f:for
-----

Traverses an Array wholy

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

       <ul>
          <f:for each="{shoppinglist}" as="food" key="number" iteration="itemIteration">
            <li class="item{f:if(condition: itemIteration.isFirst, then: 'first-child')}">{number}: {food}</li>
          </f:for>
       </ul>

Output:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      </ul>
        <li class="item first-child">4: apples</li>
        <li class="item">3: choclate</li>
        <li class="item">25: beer</li>
        <li class="item">10: frozen pizza</li>
      </ul>

| 
| Available iterator values:
| **itemIteration.index** (0 based index of the iteration)
| **itemIteration.cycle** (the same as index, but starting from 1)
| **itemIteration.total** (total number of items)
| **itemIteration.isFirst** (TRUE for the first item in the iteration)
| **itemIteration.isLast** (TRUE for the last item in the iteration)
| **itemIteration.isOdd** (TRUE for odd cycles 1,3,5,...)
| **itemIteration.isEven** (TRUE for even cycles 2,4,6,...)

f:form
------

Outputs a HTML form. The data is submitted via POST request (you can
change that by setting ``method="get"``).

Inside the form you can use `form
fields <https://wiki.typo3.org/Fluid#form_fields>`__ [deprecated wiki
link] (see below).

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form action="...">...</f:form>
      <f:form action="..." controller="..." package="..." enctype="multipart/form-data"> ... </f:form>

A form to change the properties of a domain object. This binds the
values to the form fields.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form action="..." name="customer" object="{customer}">
        <f:form.hidden property="id" />
        <f:form.textfield property="name" />
      </f:form>

form fields
-----------

f:form.checkbox
^^^^^^^^^^^^^^^

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.checkbox name="myCheckBox" value="someValue" />
      Output: <input type="checkbox" name="myCheckBox" value="someValue" />

You can also perfom simple boolean operations.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.checkbox name="myCheckBox" value="someValue" checked="{object.value} == 5" />
      Output: <input type="checkbox" name="myCheckBox" value="someValue" checked="checked" /> (depending on {object})

Bind to an object property

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.checkbox property="interests" value="TYPO3" />
      Output: <input type="checkbox" name="user[interests][]" value="TYPO3" checked="checked" /> (depending on property "interests")

f:form.errors
^^^^^^^^^^^^^

Iterates through errors of the request

**DEPRECATED:** This ViewHelper is not available anymore in TYPO3 6.2.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <ul class="errors">
        <f:form.errors>
          <li>{error.code}: {error.message}</li>
        </f:form.errors>
      </ul>

      Output:
      <ul>
        <li>1234567890: Validation errors for argument "newBlog"</li>
      </ul>

f:form.hidden
^^^^^^^^^^^^^

Renders an ``<input type="hidden" ...>`` tag.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.hidden name="myHiddenValue" value="42" />

      Output:
      <input type="hidden" name="myHiddenValue" value="42" />

f:form.password
^^^^^^^^^^^^^^^

Creates a textbox for password input.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.password name="myPassword" />

      Output:
      <input type="password" name="myPassword" value="default value" />

f:form.radio
^^^^^^^^^^^^

Creates a radio button

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.radio name="myRadioButton" value="someValue" />

      Output: <input type="radio" name="myRadioButton" value="someValue" />

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.radio name="myRadioButton" value="someValue" checked="{object.value} == 5" />

      Output: <input type="radio" name="myRadioButton" value="someValue" checked="checked" /> (depending on {object})

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.radio property="newsletter" value="1" /> yes
      <f:form.radio property="newsletter" value="0" /> no

      Output:
      <input type="radio" name="user[newsletter]" value="1" checked="checked" /> yes
      <input type="radio" name="user[newsletter]" value="0" /> no
      (depending on property "newsletter")

f:form.select
^^^^^^^^^^^^^

Renders a ``<select>`` dropdown list. The simplest way is to supply an
associative array, where the key is used as option key and the value as
human-readable name.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.select name="paymentOptions" options="{payPal: 'PayPal', visa: 'Visa Card'}" />

To preselect a value simply specify the attribute ``value="..."``. In
this example: ``value="visa"``. If it is a multi-select box
(``multiple="true"``), then *value* can be an array, too.

**Binding to domain objects**

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.select name="users" options="{userArray}" optionValueField="id" optionLabelField="firstName" />

In this example *userArray* is an array of "User" domain objects with no
array key. ``$user->getId()`` and ``$user->getFirstName()`` is used to
retrieve the key and the display name. The *value* attribute in this
case would expect a "User" domain object.

f:form.submit
^^^^^^^^^^^^^

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.submit name="mySubmit" value="Send Mail" />

      Output: <input type="submit" name="mySubmit" value="Send Mail" />

f:form.textarea
^^^^^^^^^^^^^^^

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.textarea cols="20" rows="5" name="myTextArea" value="This is shown inside the textarea" />

      Output: <textarea cols="20" rows="5" name="myTextArea">This is shown inside the textarea</textarea>

f:form.textbox
^^^^^^^^^^^^^^

**DEPRECATED:** use
`f:form.textfield <https://wiki.typo3.org/Fluid#f:form.textfield>`__
[deprecated wiki link] instead!

f:form.textfield
^^^^^^^^^^^^^^^^

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.textfield name="myTextBox" value="some value" />

      Output: <input type="text" name="myTextBox" value="some value" />

f:form.upload
^^^^^^^^^^^^^

Generates an ``<input type="file">`` element. Make sure to set
``enctype="multipart/form-data"`` on the form!

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:form.upload name="file" />

      Output: <input type="file" name="file" />

format
------

f:format.crop
^^^^^^^^^^^^^

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.crop maxCharacters="17" append="&nbsp;[...]">This is some very long text</f:format.crop>

f:format.currency
^^^^^^^^^^^^^^^^^

Formats a number to resemble a currency.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.currency currencySign="€" decimalSeparator="," thousandsSeparator=".">1234.56</f:format.currency>

Output: 1.234,56 €

f:format.date
^^^^^^^^^^^^^

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.date format="d.m.Y - H:i:s">+1 week 2 days 4 hours 2 seconds</f:format.date>

Usage with unix timestamps:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.date format="d.m.Y - H:i:s">@{your_timestamp}</f:format.date>

See also: `PHP Manual
date <http://php.net/manual/en/function.date.php>`__

**Be aware:** as the php function date() is not capable of localisation
you have no chance to get local named times (weekday, month)

Since Feb 2013 the functionality of this viewhelper is extended: you can
use strftime-format-strings (recognized by the usage of '%' in the
format-string) and use localisation for weekdays and month.

See also: `PHP Manual
strftime <http://php.net/manual/en/function.strftime.php>`__

f:format.html
^^^^^^^^^^^^^

Renders Code through lib.parseFunc_RTE or a custom parsing function. To
be used with RTE input.

f:format.htmlentitiesDecode
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Decode special HTML characters that Fluid encodes by default (&, <, >,
")

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <script type="text/javascript">
          var json = <f:format.htmlentitiesDecode>{jsonVarFromControllerAction}</f:format.htmlentitiesDecode>;
      </script>

f:format.raw
^^^^^^^^^^^^

Outputs an argument/value without any escaping.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.raw>{string}</f:format.raw>

Outputs: Content of ``{string}`` without any escaping.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.raw value="{string}" />

Inline
''''''

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      {string -> f:format.raw()}

f:format.nl2br
^^^^^^^^^^^^^^

Makes <br /> tags out of new lines.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.nl2br>Some text with
      newlines in it.</f:format.nl2br>

Output:

| Some text with
| newlines in it.

f:format.number
^^^^^^^^^^^^^^^

Formats numbers country-specific

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.number decimals="1" decimalSeparator="," thousandsSeparator=".">2345.678</f:format.number>

Output: 2.345,6

f.format.padding
^^^^^^^^^^^^^^^^

Adds whitespace or a user-defined string to a string (using the PHP
str_pad function).

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.padding padLength="10" padString="_">text</f:format.padding>

Output: text_____\_

See also: `PHP Manual
str_pad <http://www.php.net/manual/en/function.str-pad.php>`__

f.format.printf
^^^^^^^^^^^^^^^

Formats a string with the PHP printf function.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:format.printf arguments="{0: 34567890, 1: 'some text'}">We can display %2$s and format numbers like this: %1$.3e</f:format.printf>
      <f:format.printf arguments="{number: 12345}">%d</f:format.printf>

Output:

We can display some text and format numbers like this: 3.456e+7

12345

See also: `PHP Manual
printf <http://www.php.net/manual/en/function.sprintf.php>`__

f:groupedFor
------------

Sorts a multidimensional array in another dimension.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <ul>
         <f:groupedFor each="{0: {name: 'apple', color: 'green'}, 1: {name: 'cherry', color: 'red'}, 2: {name: 'banana', color: 'yellow'}, 3: {name: 'strawberry', color: 'red'}}" as="fruitsOfThisColor" groupBy="color" groupKey="color">
           <li>
             {color} fruits:
             <ul>
               <f:for each="{fruitsOfThisColor}" as="fruit" key="label">
                 <li>{label}: {fruit.name}</li>
               </f:for>
             </ul>
           </li>
         </f:groupedFor>
       </ul>

f:if, f:then, f:else
--------------------

Conditional Output

See
https://docs.typo3.org/typo3cms/ExtbaseGuide/Fluid/ViewHelper/If.html
for more examples.
`BooleanParserTest.php <https://github.com/TYPO3/Fluid/blob/master/tests/Unit/Core/Parser/BooleanParserTest.php>`__
lists allowed constructs.

Examples:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:if condition="{myvar}">
        Displayed if myvar is neither an empty string nor "0".
      </f:if>

      <f:if condition="{myvar}">
        <f:then>
          Displayed if myvar is neither an empty string nor "0".
        </f:then>
        <f:else>
          Displayed if myvar IS an empty string or "0".
        </f:else>
      </f:if>

Inline:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <section class="{f:if(condition: record.show, then: 'visible-record', else: 'hide')}">

Strings
^^^^^^^

Since TYPO3 6.1 a string comparison can easily be done:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:if condition="{myvar} == 'foobar'">
        Displayed if myvar is equal to the string value "foobar"
      </f:if>

Inline notation:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      {f:if(condition:'{variable}==\'foo\'', then:'Hello')}
      {f:if(condition:'{variable}=="foo"', then:'Hello')}

Integers
^^^^^^^^

It is possible, to do some comparance of integer values.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

       <f:if condition="{rank} > 100">
         Will be shown if rank is > 100
       </f:if>
       <f:if condition="{rank} % 2">
         Will be shown if rank % 2 != 0.
       </f:if>
       <f:if condition="{rank} == {k:bar()}">
         Checks if rank is equal to the result of the ViewHelper "k:bar"
       </f:if>

Inline notation:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      {f:if(condition:'{number}==1', then:'Hello')}

Booleans
^^^^^^^^

Simply use integer comparison:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

       <f:if condition="{enable} == 1">
         Feature enabled!
       </f:if>
       <f:if condition="{enable} == 0">
         Feature disabled!
       </f:if>

Inline:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      {f:if(condition: enable, then: 'Feature enabled!')}
      {f:if(condition: '{enable}==0', then: 'Feature disabled!')}

Comparing view helper output
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

It is possible to use the result of another viewhelper as condition for
the if-statement. The double quotes of the inner view helper have to be
changed to single quotes then.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:if condition="<f:count subject='{post.comments}' /> > 0">
        <f:then>
          [...] Display comments here[...]
        </f:then>
        <f:else>
          No Comments found.
        </f:else>
      </f:if>

Logical operators
^^^^^^^^^^^^^^^^^

Concatenating multiple comparisons with AND, OR or NOT is not possible
in ``f:if``. You can use
`v:if <https://fluidtypo3.org/viewhelpers/vhs/master/IfViewHelper.html>`__
[not available anymore] from VHS for that - see the
`examples <https://github.com/FluidTYPO3/vhs/pull/401>`__.

If you only need ``AND``, you can stack all values into an object that
will be compared:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:if condition="{0:myvar, 1:secondvar} == {0:'test', 1:'bar'}">
        Displayed if myvar is "test" AND secondvar is "bar".
      </f:if>

f:image
-------

Renders the Image specified by the src-attribute. The image can be
resized by adding width and/or height attributes (resizing happens on
the fly using an instance of tslib_cObj internally). You can also
specify 'c' or 'm' to the width and height attributes.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:image src="uploads/pics/myImage.png" width="200" height="150" alt="My Image" />

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:image src="{f:uri.resource(path:'Images/myImage.png')}" width="200" height="150" alt="My Image" />

See also `TYPO3 TypoScript Reference:
Functions <https://docs.typo3.org/typo3cms/TyposcriptReference/Functions/Index.html>`__

f:layout
--------

Selects a layout

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:layout name="Main" />

Links
-----

f:link.action
^^^^^^^^^^^^^

Creates a link to an extbase action.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:link.action action="myAction"> Do It! </f:link.action>

Example with arguments:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:link.action action="myAction" controller="MyController" arguments="{argument: argument}">Do It!</f:link.action>

f:link.email
^^^^^^^^^^^^

Email link with spamProtectEmailAddresses-settings.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:link.email email="foo@example.com" />

f:link.external
^^^^^^^^^^^^^^^

Creates an external link.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:link.external uri="http://www.typo3.org" target="_blank">external link</f:link.external>

f:link.page
^^^^^^^^^^^

Creates a Typolink.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

        <f:link.page>Current Page</f:link.page>

        <f:link.page pageUid="23">Contact</f:link.page>

        <f:link.page pageUid="13" additionalParams="{tt_news|news: 13}">Read whole news</f:link.page> (does not work with Fluid 1.3)
        <f:link.page pageUid="13" additionalParams="{tt_news: '{news: 13}'}">Read whole news</f:link.page> (works with Fluid 1.3)

        <f:link.page addQueryString="1" section="top">To Top</f:link.page>

        <f:link.page pageUid="23" pageType="123">Generate PDF</f:link.page>

`f:link.typolink <https://docs.typo3.org/typo3cms/ExtbaseGuide/latest/Fluid/ViewHelper/Link/Typolink.html>`__
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

(only from TYPO3/Fluid 7.0) Creates a Typolink. Useful with link wizard
values: 19 \_blank - "testtitle with whitespace" &X=y

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

        <f:link.typolink parameter="{link}">Linktext</f:link.typolink>

        <f:link.typolink parameter="{link}" target="_blank" class="ico-class" title="some title" additionalParams="&u=b" additionalAttributes="{type:'button'}">
            Linktext
        </f:link.typolink>

f:uri.\*
^^^^^^^^

If you need just the link itself from a link ViewHelper and not the full
link tag, the ViewHelpers <f:uri.action>, <f:uri.email>,
<f:uri.external>, <f:uri.image>, <f:uri.page> should be used. The
arguments are the same as for the ones of <f:link.

Examples:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:uri.action action="myAction" controller="MyController" arguments="{argument: argument}" />
      <f:uri.email email="foo@example.com" />
      <f:uri.page pageUid="23" />

Rendering links from the link wizard
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you are using the link wizard as described
`here <https://docs.typo3.org/typo3cms/TCAReference/AdditionalFeatures/CoreWizardScripts/Index.html#core-wizards-browse-example>`__
you have to use your own View Helper. Example see `here <viewhelper>`__.

f:renderFlashMessages
---------------------

Renders Flash-Messages. *Deprecated. Use <f:flashMessages> instead!*

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:renderFlashMessages />

f:flashMessages
---------------

Renders Flash-Messages. Optional Parameter is "renderMode"

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:flashMessages renderMode="div" />

f:render
--------

Renders the content of a section or a partial.

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:render partial="itemForm" arguments="{item: item}" />

      <f:render section="sectionname" />

See also: `f:section <https://wiki.typo3.org/Fluid#f:section>`__
[deprecated wiki link]

Parameters
^^^^^^^^^^

By default, variables in current scope are not passed to the template
that shall be rendered.

You can provide a list of variables to pass on:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:render partial="itemForm" arguments="{item: item, count: itemCount}" />

or simply pass all parameters to the template:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:render partial="itemForm" arguments="{_all}" />

f:section
---------

With a section you can define a section within a template.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:layout name="layoutname" />
      <f:section name="content">
        //Define Section here
      </f:section>

This section will be called from a layout with

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:render section="sectionname" />

f:switch
--------

Simple view helper that allows you to render content depending on a
given value or expression. It bahaves similar to a basic switch
statement in PHP.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:switch expression="{person.gender}">
        <f:case value="male">Mr.</f:case>
        <f:case value="female">Mrs.</f:case>
        <f:case default="1">unknown gender</f:case>
      </f:switch>

Output: Mr. / Mrs. (depending on the value of {person.gender})

.. container::

   warning - Message

   .. container::

      Up to TYPO3 7.0, ``f:switch`` prevents the template/partial from
      being cached and degrades performance - see `bug
      #64449 <https://forge.typo3.org/issues/64449>`__.

f:translate
-----------

Translate a given key or use the tag body as default.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:translate key="label_recent_posts">Below are the most recent posts:</f:translate>

| 
| The viewhelper supports additional arguments via the
  "arguments"-attribute. These arguments are inserted into the
  translated text with sprintf.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:translate key="author" arguments="{0: authorName}">Written by %s.</f:translate>

If the authorName is "Heinz", this becomes (in default translation):
"Written by Heinz".

| 
| The translate viewhelper has an optional attribute "extensionName"
  which tells the viewhelper from which extension the language files
  will be used, normally from
  EXT:extension_name/Resources/Private/Language/locallang.xlf. This can
  be useful when using language files from another extension, or when
  using the fluid standalone view.

Example:

.. container::

   `XML /
   HTML <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <f:translate key="label_recent_posts" extensionName="blog_example">Below are the most recent posts:</f:translate>

additionalAttributes
====================

Sometimes, you need some HTML attributes which are not part of the
standard. As an example: If you use the Dojo JavaScript framework, using
these non-standard attributes makes life a lot easier.

We think that the templating framework should not constrain the user in
his possibilities -- thus, it should be possible to add custom HTML
attributes as well, if they are needed. Our solution looks as follows:

Every view helper which inherits from AbstractTagBasedViewHelper has a
special argument called additionalAttributes which allows you to add
arbitrary HTML attributes to the tag.

If the link tag from above needed a new attribute called fadeDuration,
which is not part of HTML, you could do that as follows:

::

    <f:link.action ... additionalAttributes="{fadeDuration : 800}">
    Link with fadeDuration set
    </f:link.action>

This attribute is available in all tags that inherit from
TYPO3\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper.

Things that do not work
=======================

Mathematical expessions
-----------------------

Fluid does *not* have a native way to e.g. make sums or products of
numbers and variables. You have to use `external view
helpers <https://fluidtypo3.org/viewhelpers/vhs/master.html>`__ [not
available anymore] like ``<vhs:math.sum>``.

Other resources
===============

-  Fluid manual:
   http://flow.typo3.org/documentation/guide/partiii/templating.html
   [not available anymore]
-  Extbase: https://forge.typo3.org/projects/typo3v4-mvc [not available
   anymore]
-  Talks on T3DD09: http://t3dd09.typo3.org/recordings.html
-  Podcast: https://typo3.org/videos/category/fluid/page-1/ [not
   available anymore]
