.. include:: /Includes.rst.txt

================================
Extension Development, Debugging
================================

<< Back to `Extension Development <extension-development>`__ page

`[edit] <https://wiki.typo3.org/wiki/index.php?title=Extension_Development,_Debugging&action=edit&section=0>`__
[deprecated wiki link]

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript.
      `info </Help:Contents#Teamwork_-_draft_review_publish_delete_merge_outdated>`__
      [deprecated wiki link]

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

Tipps on debugging
==================

Debug TYPO3
-----------

See also the `Extension Developers Guide <extension-developers-guide>`__

-  In ``typo3conf/LocalConfiguration.php``, set ``[FE][debug] = 1`` and
   ``[SYS][devIPmask]`` to e.g. *"192.*,169.*,127.0.0.1"*. Then use the
   extended `debug </Category:Debug>`__\ *[deprecated wiki link]()*
   function of the Extension
   `cc_debug <https://extensions.typo3.org/extension/cc_debug/>`__. On
   your TYPO3 site you will see a bomb
   ([`[1] <http://jambage.com/wiki/CC-Debug.png>`__]) in the upper right
   corner if there is debug output by the currently running PHP script.

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       // show the variable together with the line number and file name
       debug($variable, 'Variable name/description', __LINE__, __FILE__);

Alternatively you can use the extension
`beko_debugster <https://extensions.typo3.org/extension/beko_debugster/>`__
or `fh_debug <https://extensions.typo3.org/extension/fh_debug/>`__.
These will also work if there are HTML or JavaScript errors on a page.

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       // display the variable
       debugster($variable, 'Variable name/description');

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       // show the stack trace of the current function
       $tmp = t3lib_div::debug_trail();
       debug($tmp, 'stack trace in className::methodName', __LINE__, __FILE__);
       // Replace 'className' with the name of the class and 'methodName' with the name of the method from where you call <tt>debug()</tt>.

       // If you want to add devLog functionality to your applications, simply write lines like this:
       if (TYPO3_DLOG) {
         \TYPO3\CMS\Core\Utility\GeneralUtility::devLog('some message', 'extension_key');
         // (…used to be »t3lib_div::devLog(), you may still see this in older examples)
         // …if you want debug data use this
         \TYPO3\CMS\Core\Utility\GeneralUtility::devLog('some message', 'extension_key', 0, $dataArray);
       }

| The devlog-function itself provides only an interface for logging but
  no implementation to store the logs. So you need an extension save the
  log message to a desired place.
| The `devlog <https://extensions.typo3.org/extension/devlog/>`__
  extension provides development logging/debugging functionality and
  stores the logs into a MySQL table by default. The
| `rlmp_filedevlog <https://extensions.typo3.org/extension/rlmp_filedevlog/>`__
  logs messages into a text file (by default to ``debug.log`` of your
  web server home directory, e.g. at /var/www/html/ - do not forget to
  allow write access for the ``httpd`` user).

You have to activate the ``devlog`` functionality on your system as
well, by adding the following line to
``typo3conf/LocalConfiguration.php``:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       $TYPO3_CONF_VARS['SYS']['enable_DLOG'] = true;

``error_log()``
^^^^^^^^^^^^^^^

You can write to the (system) error log using:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       error_log('text', 0);
       error_log('postition A: $content='.$content, 3, '/usr/local/htdocs/typo3/error_log');

and view the entries of the log file. (Linux: ``/var/log/messages``,
``/var/log/apache2/error_log`` or ``/var/log/httpd/error_log``).

You can modify the ``error_log = syslog`` settings in ``/etc/php.ini``.

| If you supply a third parameter to ``error_log()``, it will write that
  log entry to this file only.

To show the contents of arrays, you use ``foreach`` loops:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       foreach ($menuItems as $key => $menuItem) {
          if (is_array($menuItem)) {
              error_log ('-- tx_commerce_cm1 menuItem['.$key.'] --', 0);
              foreach ($menuItem as $k1=>$v1) {
                  error_log ('['.$k1.']='.$v1,0);
              }
          } else {
              error_log ('-- tx_commerce_cm1 menuItem['.$key.'] = '.$menuItem, 0);
          }
       }

Or use these lines with ``var_dump()``:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       ob_start();
       print_r($myComplexArray);
       $debugOut = ob_get_contents();
       ob_end_clean();
       error_log ('$myComplexArray = '.$debugOut);

How to debug SQL
----------------

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
       $GLOBALS['TYPO3_DB']->exec_UPDATEquery( 'xxx', 'yyy', 'zzz');
       t3lib_div::devLog('[write message in english here]'.$GLOBALS['TYPO3_DB']->debug_lastBuiltQuery , 'extension key');

Use
`debug_mysql_db <https://extensions.typo3.org/extension/debug_mysql_db/>`__
to debug SQL queries, measure query execution time and hide unnecessary
PHP warning messages.

How to debug TypoScript
-----------------------

See `TypoScript
Reference <https://docs.typo3.org/typo3cms/TyposcriptReference/>`__,
section
`stdWrap <https://docs.typo3.org/typo3cms/TyposcriptReference/Functions/Stdwrap/Index.html>`__.

At the end of the table you will see three ``stdWrap`` options which
enable various debug modes:

-  debug boolean

Passes output through ``htmlspecialchars()``. Useful for debugging which
value ``stdWrap`` actually ends up with while you're constructing a
website with TypoScript.

-  debugFunc boolean

Prints the content using the ``debug()`` function. Set to value "2"
(well, it's not \*quite\* a boolean;)) the content will be printed in a
table - looks nicer. Example:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

       marks.MENU_TITLE = TEXT
       marks.MENU_TITLE.field = title
       marks.MENU_TITLE.stdWrap.debugFunc = 2
       marks.MENU_TITLE.stdWrap.wrap = title at position 1 |

-  debugData boolean

Prints the current data-array, $cObj->data, directly to browser. This is
where ".field" gets its data from.

A trick that's extremely useful while developing is simply build an
extension template (``+ext``) for the specific page you want to debug;
so that you can manipulate your TypoScript code as you want without
affecting other pages. Once you've finished debugging, delete the
extension template.

-  debugItemConf boolean

Outputs the configuration arrays for each menu item, using the
``debug()``-function. Useful to debug ``optionSplit`` things and such.
Applies to GMENU, TMENU, IMGMENU.

An example:

.. container::

   `TS
   TypoScript </wiki/Help:Contents#Syntax-Highlighting_for_TypoScript>`__
   [deprecated wiki link]

.. container::

   ::

       temp.L2menuItems = HMENU
       temp.L2menuItems.entryLevel = 1
       temp.L2menuItems.1 = TMENU
       temp.L2menuItems.1.debugItemConf = 1
