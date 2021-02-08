.. include:: /Includes.rst.txt

======================================
Extension Development, using Flexforms
======================================

.. container::

   **Content Type:** `HowTo </Category:HowTo>`__ [deprecated wiki link].

.. container::

   notice - Newer documentation available

   .. container::

      `TYPO3
      Explained:FlexForms <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/FlexForms/Index.html>`__

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

================
Before You Start
================

Create Your Extension
=====================

At this point of the `extension
development </Category:Extension_development>`__ [deprecated wiki link],
you are ready to begin and you'll need to create your extension. I
recommend using the Extension Kickstarter but to each his/her own. If
you want to be able to do anything with your new and shiny flexform,
**make sure you configure your extension to have at least one 'frontend
plugin'.**

After you have your base layout for your front end extension, you'll
need to make a few changes. For this reason, **make sure** you have
finalized all changes with the kickstarter as it will overwrite all
changes we need to make!

===================================================
Configure the Extension for configuration in the BE
===================================================

Modify ext_tables.php
=====================

You'll need to edit ext_tables.php in the main directory of your
extension.

By default you'll have a file that looks similar to this one (with the
exception that this module does not have any database tables to ensure
simple demonstration):

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       <?php
       if (!defined ('TYPO3_MODE'))    die ('Access denied.');
       // you can exclude some fields form backend-rendering - it have nothing to do with your extension
       $TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';
       // your plugin is added to the Plugin-List
       t3lib_extMgm::addPlugin(Array('LLL:EXT:/locallang_db.php:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');
       // 
       t3lib_extMgm::addStaticFile($_EXTKEY,"pi1/static/","A Sample Flexform Plugin");
       // you can add an backend-wizard like the formular or table-wizard
       if (TYPO3_MODE=="BE")   $TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_sampleflex_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_sampleflex_pi1_wizicon.php';
       ?>

You'll need to add a couple of lines as marked at the end of the lines
(not needed for "totally new content element type"):

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       <?php
       if (!defined ('TYPO3_MODE'))    die ('Access denied.');
       $TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';
       
      // you add pi_flexform to be renderd when your plugin is shown
       $TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform';                  // new!

       t3lib_extMgm::addPlugin(Array('LLL:EXT:/locallang_db.php:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');
       t3lib_extMgm::addStaticFile($_EXTKEY,"pi1/static/","A Sample Flexform Plugin");

       // now, add your flexform xml-file
       t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:'.$_EXTKEY.'/flexform_ds_pi1.xml');            // new!

       if (TYPO3_MODE=="BE")   $TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_sampleflex_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_sampleflex_pi1_wizicon.php';
       ?>

If you try to add the plugin as as "totally new content element type"
instead of a ordinary entry in the plugin list, following change has to
be made in ext_tables.php:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       // $TCA['tt_content']['types'][$_EXTKEY.'_pi1']['showitem']='CType;;4;button;1-1-1, header;;3;;2-2-2'; // old
       $TCA['tt_content']['types'][$_EXTKEY.'_pi1']['showitem']='CType;;4;button;1-1-1, header;;3;;2-2-2,pi_flexform;;;;1-1-1'; // new!
       $TCA['tt_content']['columns']['pi_flexform']['config']['ds'][','.$_EXTKEY.'_pi1'] = 'FILE:EXT:'.$_EXTKEY.'/flexform_ds_pi1.xml'; // new!

These extra lines add the Flexform XML (located in the file
**EXT:sampleflex/flexform_ds_pi1.xml**) to our extension allowing us to
use flexforms with our plugin.

Creating flexform_ds_pi1.xml
============================

You can create the flexform manually or let it be generated by the
extension `T3Dev <https://extensions.typo3.org/extension/t3dev/>`__.
When changing an existing flexform XML file or want to create it from
scratch you should know something about its structure. Follow the lines
below to get a basic understanding.

Create the file *flexform_ds_pi1.xml* in the above mentioned directory
of your extension. It must be properly formatted XML, so be careful
about the tag opening/closing. In the examples below we use text and
captions references to the file 'locallang_db.php'. This is the 'old
style' of handling localisation. You can change 'locallang_db.php' to
'locallang_db.xml' if you want to use the modern style. Note: T3dev is
generating the flexform with 'locallang_db.php', so find and replace
could help ;-).

An Example flexform_ds_pi1.xml
------------------------------

A sample *flexform_ds_pi1.xml* looks like:

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

       <T3DataStructure>
        <meta>
              <langDisable>1</langDisable>
        </meta>
        <sheets>
         <sDEF>
          <ROOT>
           <TCEforms>
            <sheetTitle>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.sheet_general</sheetTitle>
           </TCEforms>
           <type>array</type>
            <el>
             <pages>
              <TCEforms>
               <exclude>1</exclude>
               <label>LLL:EXT:lang/locallang_general.php:LGL.startingpoint</label>
               <config>
                <type>group</type>
                <internal_type>db</internal_type>
                <allowed>pages</allowed>
                <size>3</size>
                <maxitems>22</maxitems>
                <minitems>0</minitems>
                <show_thumbs>1</show_thumbs>
               </config>
              </TCEforms>
             </pages>
             <recursive>
              <TCEforms>
               <label>LLL:EXT:lang/locallang_general.php:LGL.recursive</label>
               <config>
                <type>select</type>
                <items type="array">
                 <numIndex index="0" type="array">
                  <numIndex index="0"></numIndex>
                  <numIndex index="1"></numIndex>
                 </numIndex>
                 <numIndex index="1" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.1</numIndex>
                  <numIndex index="1">1</numIndex>
                  </numIndex>
                 <numIndex index="2" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.2</numIndex>
                  <numIndex index="1">2</numIndex>
                 </numIndex>
                 <numIndex index="3" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.3</numIndex>
                  <numIndex index="1">3</numIndex>
                 </numIndex>
                 <numIndex index="4" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.4</numIndex>
                  <numIndex index="1">4</numIndex>
                 </numIndex>
                 <numIndex index="5" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.5</numIndex>
                  <numIndex index="1">250</numIndex>
                 </numIndex>
                </items>
                <minitems>0</minitems>
                <maxitems>1</maxitems>
                <size>1</size>
               </config>
              </TCEforms>
             </recursive>
            </el>
           </ROOT>
          </sDEF>
          <display>
           <ROOT>
            <TCEforms>
             <sheetTitle>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.sheet_display</sheetTitle>
            </TCEforms>
            <type>array</type>
            <el>
             <disable_rte>
              <TCEforms>
               <label>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.disable_rte</label>
               <config>
                <type>check</type>
               </config>
              </TCEforms>
             </disable_rte>
            </el>
           </ROOT>
          </display>
          <error>
           <ROOT>
            <TCEforms>
             <sheetTitle>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.sheet_error</sheetTitle>
            </TCEforms>
            <type>array</type>
            <el>
             <show_errors>
              <TCEforms>
               <label>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.show_errors</label>
               <config>
                <type>check</type>
               </config>
              </TCEforms>
             </show_errors>
             <prepend_text>
              <TCEforms>
               <label>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.prepend_text</label>
               <config>
                <type>input</type>
                <size>30</size>
               </config>
              </TCEforms>
             </prepend_text>       
            </el>
           </ROOT>
          </error>
         </sheets>
       </T3DataStructure>

Brief Overview
--------------

Let's dissect this XML and go over some of the parts.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

       <T3DataStructure>
        <sheets>

All of our sheets go inside this (*<sheets>*) tag. Sheets are tabs which
allow different pages to be displayed to further separate our
configuration options. This allows us to separate the general
configuration options such as Starting Point from display configuration
options such as Disabling the RTE.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

         <sDEF>
          <ROOT>

This is the default sheet, aka the *General* tab.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

           <TCEforms>

We need to assign a label for the tab. We need to ensure future
capabilities, so we are using the builtin language features.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

            <sheetTitle>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.sheet_general</sheetTitle>
           </TCEforms>
           <type>array</type>
            <el>

The following is one option on that page. This specific field overrides
the default starting point, which is just groovy! It opens a new window
allowing for record lookup similar to the default behavior of *Starting
Point*.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

             <pages>
              <TCEforms>
               <exclude>1</exclude>
               <label>LLL:EXT:lang/locallang_general.php:LGL.startingpoint</label>
               <config>
                <type>group</type>
                <internal_type>db</internal_type>
                <allowed>pages</allowed>
                <size>3</size>
                <maxitems>22</maxitems>
                <minitems>0</minitems>
                <show_thumbs>1</show_thumbs>
               </config>
              </TCEforms>
             </pages>

The following option allows us to specify the recursive style to use
when looking for records in our starting point. It is a selector box
with pre-defined options.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

             <recursive>
              <TCEforms>
               <label>LLL:EXT:lang/locallang_general.php:LGL.recursive</label>
               <config>
                <type>select</type>
                <items type="array">
                 <numIndex index="0" type="array">
                  <numIndex index="0"></numIndex>
                  <numIndex index="1"></numIndex>
                 </numIndex>
                 <numIndex index="1" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.1</numIndex>
                  <numIndex index="1">1</numIndex>
                  </numIndex>
                 <numIndex index="2" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.2</numIndex>
                  <numIndex index="1">2</numIndex>
                 </numIndex>
                 <numIndex index="3" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.3</numIndex>
                  <numIndex index="1">3</numIndex>
                 </numIndex>
                 <numIndex index="4" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.4</numIndex>
                  <numIndex index="1">4</numIndex>
                 </numIndex>
                 <numIndex index="5" type="array">
                  <numIndex index="0">LLL:EXT:cms/locallang_ttc.php:recursive.I.5</numIndex>
                  <numIndex index="1">250</numIndex>
                 </numIndex>
                </items>
                <minitems>0</minitems>
                <maxitems>1</maxitems>
                <size>1</size>
               </config>
              </TCEforms>
             </recursive>
            </el>
           </ROOT>
          </sDEF>

**Note : this will create a duplicate starting point dialog box since
the TCA already shows one by default.**

In order to get rid of the TCA starting point dialog and only have the
flexform one displayed, proceed as is :

In your **ext_tables.php** file, look for this line :

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

          $TCA["tt_content"]["types"]["list"]["subtypes_excludelist"][$_EXTKEY."_pi1"]="layout,select_key";

This is a comma separated list of fields to hide

add the following field to be hidden : pages (not needed for "totally
new content element type")

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

          $TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';

Then hit the link "Clear cache in typo3conf/" (above "Clear FE cache" in
the modules columun of the Typo3 interface) and reload your flexform.
The TCA startingpoint should now have disapeared.

</sDEF> marks the end of our *General* sheet. We could use one sheet for
the entire config, however, we want to separate a few options by placing
them on their own sheet. So, we create another sheet for the display.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

          <display>
           <ROOT>
            <TCEforms>
             <sheetTitle>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.sheet_display</sheetTitle>
            </TCEforms>
            <type>array</type>
            <el>
             <disable_rte>
              <TCEforms>
               <label>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.disable_rte</label>
               <config>
                <type>check</type>
               </config>
              </TCEforms>
             </disable_rte>
            </el>
           </ROOT>
          </display>

Let's add an additional sheet for dealing with errors... For this one,
while the format is the same, we also require a **Checkbox** and a
**String Input** on this sheet.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

          <error>
           <ROOT>
            <TCEforms>
             <sheetTitle>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.sheet_error</sheetTitle>
            </TCEforms>
            <type>array</type>
            <el>
             <show_errors>
              <TCEforms>
               <label>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.show_errors</label>
               <config>
                <type>check</type>
               </config>
              </TCEforms>
             </show_errors>
             <prepend_text>
              <TCEforms>
               <label>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.prepend_text</label>
               <config>
                <type>input</type>
                <size>30</size>
               </config>
              </TCEforms>
             </prepend_text>       
            </el>
           </ROOT>
          </error>

This is the end of our sheets, so we'll close the opening tags, save and
continue our efforts!

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

         </sheets>
       </T3DataStructure>

A Note from the Author:

::

   There are several different types of elements you can insert into pages such as color selectors,
   database selectors, etc.  These are basic examples.  If you require more complex or further options,
   please read the appropriate manuals.  Link to each are located at the end of this document.

Dynamic Data in Flexforms
=========================

You can add data dynamically to your flexforms, e.g. you could prefill a
list of options according to the output of a function. For this you just
add something like the following to you flexform.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

       <dynField>
         <TCEforms>
          <label>LLL:EXT:sampleflex/locallang_db.php:sampleflex.pi_flexform.dynField</label>
          <config>
           <type>select</type>
            <itemsProcFunc>tx_sampleflex_addFieldsToFlexForm->addFields</itemsProcFunc>
          </config>
          </TCEforms>
       </dynField>

You can now create a file class.tx_sampleflex_addFieldsToFlexForm.php in
your extension directory and include it in ext_tables.php as

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       include_once(t3lib_extMgm::extPath($_EXTKEY).'class.tx_sampleflex_addFieldsToFlexForm.php');

The function tx_sampleflex_addFieldsToFlexForm->addFields looks like
this.

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       class tx_sampleflex_addFieldsToFlexForm {
        function addFields ($config) {
          $optionList = array();
          // add first option
          $optionList[0] = array(0 => 'option1', 1 => 'value1');
          // add second option
          $optionList[1] = array(0 => 'option2', 1 => 'value2');
          $config['items'] = array_merge($config['items'],$optionList);
          return $config;
        }
       }

Now you will see 'option1' and 'option2' in the list, you can select
from in the backend.

**Note : Your class name has to start with 'tx_' or it won't work**

Display conditions and dynamic reloading of form
================================================

In FlexForms you can use a specal tag, that emulates $TCA[ctrl']['type']
to reload the form after changing a field (onChange)

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

          <onChange>reload</onChange>

You can then add a special condition tag to all FlexForm fields which
expects a certain value of the type field. (displayCondition)

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <displayCond>FIELD:myField:=:myValue</displayCond>

*The current field is only displayed if the field myField is set to the
value "myValue".*

Note: The tags on same level/sheet. If <langChildren> is enabled, then
the value of other fields on same level is taken from the same language.

| 
| The field-values of the FlexForm-parent record are prefixed with
  "parentRec.". These fields can be used like every other field (since
  TYPO3 4.3).

This example would require the header-field of the FlexForm-parent
record to be true, otherwise the FlexForm field is not displayed (works
only within FlexForm datastructure definitions):

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

        <displayCond>FIELD:parentRec.header:REQ:true</displayCond>

See The TYPO3 API for a list of "displayCond" modifiers:
https://typo3.org/documentation/document-library/core-documentation/doc_core_api/4.3.0/view/4/2/#id2520197
[not available anymore]

| 
| **Test example:**

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <T3DataStructure>
        <meta>
              <langDisable>1</langDisable>
        </meta>
        <sheets>
         <sDEF>
          <ROOT>
           <TCEforms>
            <sheetTitle>LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.sheet_general</sheetTitle>
           </TCEforms>
           <type>array</type>
            <el>
             <myField>
              <TCEforms>
               <label>myField</label>
               <onChange>reload</onChange>
               <config>
                <type>select</type>
                <items type="array">
                 <numIndex index="0" type="array">
                  <numIndex index="0"></numIndex>
                  <numIndex index="1"></numIndex>
                 </numIndex>
                 <numIndex index="1" type="array">
                  <numIndex index="0">My Value 1</numIndex>
                  <numIndex index="1">myValue1</numIndex>
                  </numIndex>
                 <numIndex index="2" type="array">
                  <numIndex index="0">My Value 2</numIndex>
                  <numIndex index="1">myValue2</numIndex>
                 </numIndex>
                </items>
                <minitems>0</minitems>
                <maxitems>1</maxitems>
                <size>1</size>
               </config>
              </TCEforms>
             </myField>
             <myOtherField>
              <TCEforms>
               <label>This field is only visible if "myField=myValue1"</label>
               <displayCond>FIELD:myField:=:myValue1</displayCond>
               <config>
                <type>input</type>
               </config>
              </TCEforms>
             </myOtherField>
            </el>
           </ROOT>
          </display>
         </sheets>
       </T3DataStructure>

Modifying the Language Data
===========================

We now need to configure our language file *locallang_db.php* so that
our labels (ie.
**LLL:EXT:sampleflex/locallang_db.php:tt_content.pi_flexform.sheet_error**)
are rendered properly.

Aside from any additional fields you may have, the following example
sets all of our flexform labels properly. I only speak one language, so
I create only the default language. If you know multiple languages, go
ahead and fill them out accordingly.

A sample *EXT:sampleflex/locallang_db.php*

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       <?php
       $LOCAL_LANG = Array (
              'default' => Array (
                      'tt_content.list_type_pi1' => 'Sample Flexform Plugin',
                      'tt_content.pi_flexform.sheet_general' => 'General Settings',
                      'tt_content.pi_flexform.sheet_display' => 'Display Settings',
                      'tt_content.pi_flexform.sheet_error' => 'Error Handling Settings',
                      'tt_content.pi_flexform.disable_rte' => 'Disable the Rich Text Editor',
                      'tt_content.pi_flexform.show_errors' => 'Show Errors',
                      'tt_content.pi_flexform.prepend_text' => 'Text to prepend errors with',
              ),
       );
       ?>

Theoretically we should now be able to insert our new plugin into a page
and have a flexform for the configuration in the backend!

Configuration for new format multilang file *locallang_db.xml*

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

       <?xml version="1.0" encoding="utf-8" standalone="yes" ?>
       <T3locallang>
          <meta type="array">
              <type>database</type>
              <description>Language labels for database tables/fields belonging to extension 'sampleflex'</description>
          </meta>
          <data type="array">
              <languageKey index="default" type="array">
                  <label index="tt_content.list_type_pi1">Sample Flexform Plugin</label>
                  <label index="tt_content.pi_flexform.sheet_general">General Settings</label>
                  <label index="tt_content.pi_flexform.sheet_display">Display Settings</label>
                  <label index="tt_content.pi_flexform.sheet_error">Error Handling Settings</label>
                  <label index="tt_content.pi_flexform.disable_rte">Disable the Rich Text Editor</label>
                  <label index="tt_content.pi_flexform.show_errors">Show Errors</label>
                  <label index="tt_content.pi_flexform.prepend_text">Text to prepend errors with</label>
              </languageKey>
          </data>
       </T3locallang>

=========================================
Programming Your Plugin for the FE output
=========================================

Accessing Flexform Options
==========================

If all went well, you should be able to configure your plugin with a
flexform. The question now is, "How do I access that information from my
plugin?"

For me, I stopped configuring plugins with setup/constants, so I create
a new variable **$lConf** in my plugin class to store the data. This
allows me to use TypoScript Setup/Constants if I really need to use
them. I wrote my own function for handling/parsing the Flexform data and
inserting it into my **$this->lConf** array.

**Warning: This might not work if you use template_file as there are
several keys by that name in the array!**

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      /**
       * initializes the flexform and all config options ;-)
       */
      function init(){
          $this->pi_initPIflexForm(); // Init and get the flexform data of the plugin
          $this->lConf = array(); // Setup our storage array...
          // Assign the flexform data to a local variable for easier access
          $piFlexForm = $this->cObj->data['pi_flexform'];
          // Traverse the entire array based on the language...
          // and assign each configuration option to $this->lConf array...
          foreach ( $piFlexForm['data'] as $sheet => $data ) {
              foreach ( $data as $lang => $value ) {
                  foreach ( $value as $key => $val ) {
                      $this->lConf[$key] = $this->pi_getFFvalue($piFlexForm, $key, $sheet);
                  }
              }
          }
      }

While there are other methods of handling the flexform options, I like
handling them myself. You could just as easily add the following to any
function (including the main function) and handle it appropriately:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       ...
       ...
       $this->pi_initPIflexForm(); // Init and get the flexform data of the plugin
       ...
       ...

The line above stores all of the flexform options in the array
**$this->cObj->data['pi_flexform']**. You can access the data stored in
that array either directly, or by using the
**$this->pi_getFFvalue($this->cObj->data['pi_flexform'], "key_name",
"sheet_name")** function. By using the **init()** function above, I get
an array similar to the standard **$this->conf**, which allows me to
easily migrate my existing plugin from the TypoScript Setup/Constant
method to flexforms.

**Note**

Here is an example on how to access the flexform data in a
multi-language installation:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $piFlexForm = $this->cObj->data['pi_flexform'];
              
      $index = $GLOBALS['TSFE']->sys_language_uid;
       
      $sDef = current($piFlexForm['data']);       
      $lDef = array_keys($sDef);
       
      $flexFormValuesArray['department'] = $this->pi_getFFvalue($piFlexForm, 'department', 'sDEF', $lDef[$index]);

The same example but with arrays:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $index = $GLOBALS['TSFE']->sys_language_uid;
      $sDef = current($piFlexForm['data']);
      $lDef = array_keys($sDef);
      foreach ( $piFlexForm['data'] as $sheet => $data ) {
          foreach ($data[$lDef[$index]] as $key => $val ) {
              $this->lConf[$key] = $this->pi_getFFvalue($piFlexForm, $key, $sheet,$lDef[$index]);
          }
      }

Accessing Flexform Values in ExtBase Extensions
===============================================

Using the ExtBase way of programming you have to be aware of the fact
that all your Flexform items are prefixed with 'settings.' so that the
values in the controller can be read with $this->settings.

.. container::

   `XML /
   HTML </wiki/Help:Contents#Syntax-Highlighting_for_HTML%20and%20XML>`__
   [deprecated wiki link]

.. container::

   ::

      <T3DataStructure>
        <ROOT>
          <type>array</type>
            <el>
          <settings.itemName>
            <TCEforms>
              <label>Configuration options for xxx</label>
              <config>
                <type>select</type>
                    <items type="array">
                      <numIndex index="0" type="array">
                        <numIndex index="0"></numIndex>
                        <numIndex index="1"></numIndex>
                      </numIndex>
                    </items>
              </config>
                </TCEforms>
          </settings.itemName>
            </el>
         </ROOT>
      </T3DataStructure>

The values can be read with $this->settings['itemName']

===========
Final Notes
===========

You'll need to decide how you want to handle your flexform data, but you
should have very little problem getting the data at this point. If you
need to continue using the standard Setup/Constant method, I recommend
reading the link at the end entitled: **Merge plugin TS configuration
with flexform configuration**.

===========================
Existing/finished documents
===========================

You find all the different extension manuals either by the
`extensions <https://extensions.typo3.org/>`__ themself or in the TYPO3
`documentation matrix <https://docs.typo3.org/typo3cms/>`__ [not
available anymore].

Existing References
===================

-  `Merge plugin TS configuration with flexform
   configuration. <https://docs.typo3.org/typo3cms/extensions/api_macmade/DeveloperApi/Php5Classes/TxApimacmadeFlexform/Index.html>`__
   [not available anymore]
-  `EXT: Library for Frontend
   plugins <https://docs.typo3.org/typo3cms/extensions/sg_zfelib/>`__
