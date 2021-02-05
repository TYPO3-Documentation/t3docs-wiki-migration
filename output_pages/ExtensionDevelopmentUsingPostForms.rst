.. include:: /Includes.rst.txt
.. highlight:: php

=======================================
Extension Development, using POST Forms
=======================================

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

POST Forms
==========

Here I want to explain the programming of POST-Forms with the Typo3
functions in class tslib_pibase. First of all every form variable in the
HTML-Template must have the name of the extension class. Then, if the
form is submitted you can find all form variables in the incoming array
$this->piVars. more TYPO3 3.8.0 Documentation [outdated link]

Default configuration of $this->piVars in class tslib_pibase (the array
is empty when check the first time in the extension):

<php>

::

   Array (        
    // This is the incoming array by name $this->prefixId merged between POST and GET, POST taking precedence. 
    // Eg. if the class name is 'tx_myext' then the content of this array will be whatever comes into &tx_myext[...]=...
    'pointer' => ,                        // Used as a pointer for lists
   'mode' => ,                           // List mode
   'sword' => ,                          // Search word
   'sort' => ,                           // [Sorting column]:[ASC=0/DESC=1]
   )

</php>

**HINT**: $this->piVars is also used to make typolinks with the
functions pi_linkTP_keepPIvars and pi_linkTP_keepPIvars_url from the
class tslib_pibase.

Example:

Your HTML-Template looks like this:

::

   <form action="###FORM_ACTION###" name="tx_myext" method="post">
    <input type="text" name="tx_myext[title]" value="">
    <input type="text" name="tx_myext[text]" value="">
    <input type="submit" name="Submit">
   </form>

(###FORM_ACTION### should be generated with TYPO3 API)

If the form is submitted, the incoming array $this->piVars looks like
this:

<php>

::

   Array
   (
      [title] => O'reilly
      [text] => Is your name O'reilly?
   )

</php>

| Now you can send the incoming data back to the browser, of course
  escaping it properly:

<php>

::

   function main($content,$conf) {
      echo ' '.htmlspecialchars($this->piVars['title']).' ';
      echo htmlspecialchars($this->piVars['text']);
   }

</php>

Frontend plugin forms with checkboxes
=====================================

I haven't seen any explicit discussion of this topic so I'll add my own
solution for creating a form with checkboxes. They should look like

::

   <input type="checkbox" name="tx_myplugin_pi1[arg1][val1]" value="val1" />
   <input type="checkbox" name="tx_myplugin_pi1[arg1][val2]" value="val2" />
   <input type="checkbox" name="tx_myplugin_pi1[arg1][val3]" value="val3" />

Your FE Plugin can then expect the checkboxes to arrive as an array in
the piVars. If you give the inputs all the same name, then it looks like
the piVars includes at most one selected value.
