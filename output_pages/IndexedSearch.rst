.. include:: /Includes.rst.txt
.. highlight:: php

==============
Indexed search
==============

.. container::

   **Content Type:** Extension Note [outdated wiki link] for the
   extension Indexed search (indexed_search).
   It is a list of tips indented to supplement the documentation. For
   more information about the extension, see the `extension home
   page <https://docs.typo3.org/c/typo3/cms-indexed-search/master/en-us/>`__

.. container::

   error - This page is a candidate for deletion

   .. container::

      **Reason: No reason given**
      If you disagree with its deletion, please explain why at Category
      talk:Candidates for speedy deletion [outdated link] or improve the
      page and remove the ``{{delete}}`` tag.

      This notice should remain for a minimum of 1 week after it was
      placed on the page. If a discussion is still ongoing, it should
      remain until a consensus is reached or a decision has been made
      about the removal, after which the page will either be deleted or
      this notice removed.

      Remember to check what links here [outdated wiki link] and the the
      page history [outdated wiki link] before deleting.

Useful Files
============

-  typo3/sysext/indexed_search/pi/indexed_search.tmpl

::

    * change the look of the search box and results here

-  typo3/sysext/indexed_search/pi/class.tx_indexedsearch.php

::

       -this is the class that controls what fills the template file (indexed_search.tmpl)
       -here is an order of operations i followed for a search:
         ``doSearch( ) 
             calls getResultRows( ) - gets the rows from the db. returns array.
             calls getDisplayResults( ) - makes html from db rows.

legend: \`\` = function useful to customize

XHTML 1.1-compatible and accessible template
============================================

This is a draft [outdated wiki link] of a table-less, XHTML
1.1-compatible (**currently** it is XHTML 1.0 strict) and accessible
template (and the corresponding CSS) for **indexed-search**. Please be
aware that the spaces (& nbsp ;) defined in the template have been
stripped off by the wiki. To get the original template, please see
`15878: TYPO3 Core - table-less XHTML 1.1-ready template [Closed;
assigned to Michael Stucki] <https://forge.typo3.org/issues/15878>`__.

HTML template
-------------

::

   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <title>indexed_search template</title>

       <!-- Example CSS which can be included in your template -->
       <style type="text/css">
           /*********************
           *** indexed_search ***
           **********************/
           /* Align the form fields and labels */
           div.tx-indexedsearch-searchbox label {
               margin-right:1em;
               width:10em;
               float:left;
               }
           /* Floating items to the right */
           span.tx-indexedsearch-result-count,
           span.tx-indexedsearch-percent {
               font-size:0.9em;
               letter-spacing:0;
               font-weight:normal;
               margin-top:-1.2em;
               float:right;
               }
           /* Align result info */
           dt.tx-indexedsearch-text-item-size,
           dd.tx-indexedsearch-text-item-size,
           dt.tx-indexedsearch-text-item-crdate,
           dd.tx-indexedsearch-text-item-crdate,
           dt.tx-indexedsearch-text-item-mtime,
           dt.tx-indexedsearch-text-item-path {
               margin-left:0;
               float:left;
               }
           /* Reset margin of the last element in the result info */
           dd.tx-indexedsearch-path {
               margin-left:0;
               }
           /* Result browser */
           div#content ul.browsebox li {
               list-style:none;
               margin-bottom:1em;
               margin-right:1em;
               float:left;
               }
           /* Clear the result browser float */
           div#content div.tx-indexedsearch-res {
               clear:both;
               }
       </style>
   </head>

   <body>
   <h1>indexed_search template</h1>


   <h2>TEMPLATE_SEARCH_FORM</h2>
   <p><em>Template for the search form.</em></p>
   <!-- ###SEARCH_FORM### begin -->
       <div >
           <form action="###ACTION_URL###" method="post">
               <div>
                   <input type="hidden" name="tx_indexedsearch[_sections]" value="0" />
                   <input type="hidden" name="tx_indexedsearch[_freeIndexUid]" value="_" />
                   <input type="hidden" name="tx_indexedsearch[pointer]" value="0" />
                   <input type="hidden" name="tx_indexedsearch[type]" value="###HIDDEN_VALUE_TYPE###" />
                   <input type="hidden" name="tx_indexedsearch[ext]" value="###HIDDEN_VALUE_EXT###" />
               </div>

               <fieldset>
                   <legend>Search form</legend>
                   <div >
                       <label for="tx-indexedsearch-searchbox-sword">###FORM_SEARCHFOR###</label>
                           <input type="text" name="tx_indexedsearch[sword]" value="###SWORD_VALUE###"   /> 
                   </div>
                   <!-- ###ADDITONAL_KEYWORD### begin -->
                       <input type="hidden" name="tx_indexedsearch[sword_prev]" value="###SWORD_PREV_VALUE###" />
                       <input type="checkbox" name="tx_indexedsearch[sword_prev_include]" value="1" ###SWORD_PREV_INCLUDE_CHECKED### />###ADD_TO_CURRENT_SEARCH###.
                   <!-- ###ADDITONAL_KEYWORD### end -->

                   <!-- ###SEARCH_FORM_EXTENDED### begin -->
                       <!-- ###SELECT_SEARCH_FOR### begin -->
                       <div >
                           <label for="tx-indexedsearch-selectbox-type">###FORM_MATCH###</label>
                               <!-- ###SELECT_SEARCH_TYPE### begin -->
                                   <select name="tx_indexedsearch[type]"  >###SELECTBOX_TYPE_VALUES###</select> 
                               <!-- ###SELECT_SEARCH_TYPE### end -->

                               <!-- ###SELECT_SEARCH_DEFOP### begin -->
                                   <select name="tx_indexedsearch[defOp]"  >###SELECTBOX_DEFOP_VALUES###</select>
                               <!-- ###SELECT_SEARCH_DEFOP### end -->
                       </div>
                       <!-- ###SELECT_SEARCH_FOR### end -->

                       <!-- ###SELECT_SEARCH_IN### begin -->
                       <div >
                           <label for="tx-indexedsearch-selectbox-media">###FORM_SEARCHIN###</label>
                               <!-- ###SELECT_SEARCH_MEDIA### begin -->
                                   <select name="tx_indexedsearch[media]"  >###SELECTBOX_MEDIA_VALUES###</select> 
                               <!-- ###SELECT_SEARCH_MEDIA### end -->

                               <!-- ###SELECT_SEARCH_LANG### begin -->
                                   <select name="tx_indexedsearch[lang]"  >###SELECTBOX_LANG_VALUES###</select>
                               <!-- ###SELECT_SEARCH_LANG### end -->
                       </div>
                       <!-- ###SELECT_SEARCH_IN### end -->

                       <!-- ###SELECT_SECTION### begin -->
                       <div >
                           <label for="tx-indexedsearch-selectbox-sections">###FORM_FROMSECTION###</label>
                               <select name="tx_indexedsearch[sections]"  >###SELECTBOX_SECTIONS_VALUES###</select>
                       </div>
                       <!-- ###SELECT_SECTION### end -->

                       <!-- ###SELECT_FREEINDEXUID### begin -->
                       <div >
                           <label for="tx-indexedsearch-selectbox-freeIndexUid">###FORM_FREEINDEXUID###</label>
                               <select name="tx_indexedsearch[freeIndexUid]"  >###SELECTBOX_FREEINDEXUIDS_VALUES###</select>
                       </div>
                       <!-- ###SELECT_FREEINDEXUID### end -->

                       <!-- ###SELECT_ORDER### begin -->
                       <div >
                           <label for="tx-indexedsearch-selectbox-order">###FORM_ORDERBY###</label>
                               <select name="tx_indexedsearch[order]"  >###SELECTBOX_ORDER_VALUES###</select> 
                               <select name="tx_indexedsearch[desc]"  >###SELECTBOX_DESC_VALUES###</select>
                       </div>
                       <!-- ###SELECT_ORDER### end -->

                       <!-- ###SELECT_RESULTS### begin -->
                       <div >
                           <label for="tx-indexedsearch-selectbox-results">###FORM_ATATIME###</label>
                               <select name="tx_indexedsearch[results]"  >###SELECTBOX_RESULTS_VALUES###</select>
                       </div>
                       <!-- ###SELECT_RESULTS### end -->

                       <!-- ###SELECT_GROUP### begin -->
                       <div >
                           <label for="tx-indexedsearch-selectbox-group">###FORM_STYLE###</label>
                               <select name="tx_indexedsearch[group]"  >###SELECTBOX_GROUP_VALUES###</select>

                               <!-- ###SELECT_EXTRESUME### begin -->
                                   <input type="hidden" name="tx_indexedsearch[extResume]" value="0" />
                                   <input type="checkbox" value="1" name="tx_indexedsearch[extResume]" ###EXT_RESUME_CHECKED### /> ###FORM_EXTRESUME###
                               <!-- ###SELECT_EXTRESUME### end -->
                       </div>
                       <!-- ###SELECT_GROUP### end -->
               <!-- ###SEARCH_FORM_EXTENDED### end -->
                       <div >
                           <input type="submit" name="tx_indexedsearch[submit_button]" value="###FORM_SUBMIT###"   />
                       </div>
                   </fieldset>

           </form>
           <p>###LINKTOOTHERMODE###</p>
       </div>
   <!-- ###SEARCH_FORM### end -->
   <br /><br />


   <h2>TEMPLATE_RULES</h2>
   <p><em>Template for displaying the search rules.</em></p>
   <!-- ###RULES### begin -->
       <div >
           <h2>###RULES_HEADER###</h2>
           <p>###RULES_TEXT###</p>
       </div>
   <!-- ###RULES### end -->
   <br /><br />


   <h2>TEMPLATE_RESULT_SECTION_LINKS</h2>
   <p><em>Template for the section links in section mode.</em></p>
   <!-- ###RESULT_SECTION_LINKS### begin -->
       <div >
           <ol>
               ###LINKS###
           </ol>
       </div>
   <!-- ###RESULT_SECTION_LINKS### end -->

   <!-- ###RESULT_SECTION_LINKS_LINK### begin -->
               <li>###LINK###</li>
   <!-- ###RESULT_SECTION_LINKS_LINK### end -->
   <br /><br />


   <h2>TEMPLATE_SECTION_HEADER</h2>
   <p><em>Template for the section title in section mode.</em></p>
   <!-- ###SECTION_HEADER### begin -->
       <div  >
           <h2 >###SECTION_TITLE### <span >###RESULT_COUNT### ###RESULT_NAME###</span></h2>
       </div>
   <!-- ###SECTION_HEADER### end -->
   <br /><br />


   <h2>TEMPLATE_RESULT_OUTPUT</h2>
   <p><em>Template for the search result list.</em>
   If you need Alt-Tags you might want to replace ###ICON### by the static html code:
   <img src="typo3/sysext/indexed_search/pi/res/pages.gif"   alt="Seiten Icon" /></p>
   <!-- ###RESULT_OUTPUT### begin -->
       <div >
           <!-- ###HEADER_ROW### begin -->
               <h3><span >###ICON###</span> <span >###RESULT_NUMBER###</span> <span >###TITLE###</span> <span >###RATING###</span></h3>
           <!-- ###HEADER_ROW### end -->

           <!-- ###ROW_LONG### begin -->
               <p >###DESCRIPTION###</p>
               <dl >
                   <dt >###TEXT_ITEM_SIZE### </dt><dd >###SIZE###, </dd>
                   <dt >###TEXT_ITEM_CRDATE### </dt><dd >###CREATED###, </dd>
                   <dt >###TEXT_ITEM_MTIME### </dt><dd >###MODIFIED###</dd>
                   <dt >###TEXT_ITEM_PATH### </dt><dd >###PATH###</dd>
               </dl>
           <!-- ###ROW_LONG### end -->

           <!-- ###ROW_SHORT### begin -->
               <p >###DESCRIPTION###</p>
           <!-- ###ROW_SHORT### end -->

           <!-- ###ROW_SUB### begin -->
               <p >###TEXT_ROW_SUB###</p>
           <!-- ###ROW_SUB### end -->
       </div>
   <!-- ###RESULT_OUTPUT### end -->
   <br /><br />


   </body>
   </html>

Issues
------

Currently none. If you finde any issues, please post them here!

--------------

King76 - 02 march 2007

Hi !

1. Good job, but : <legend>Search form</legend> is not translate ;-(

2. So, please move that :

::

   <div >
    <input type="submit" name="tx_indexedsearch[submit_button]" value="###FORM_SUBMIT###"   />
   </div>
   </fieldset>

after SUBPART : ###SEARCH_FORM_EXTENDED### because SUBMIT BUTTON is
HIDE ;)

3. Replace :

::

   <input type="hidden" name="tx_indexedsearch[type]" value="###HIDDEN_VALUE_TYPE###" />
   <input type="hidden" name="tx_indexedsearch[ext]" value="###HIDDEN_VALUE_EXT###" />

by :

::

   <!-- ###HIDDEN_FIELDS### begin -->
    <input type="hidden" name="###HIDDEN_FIELDNAME###" value="###HIDDEN_VALUE###" />
   <!-- ###HIDDEN_FIELDS### end -->

--------------
