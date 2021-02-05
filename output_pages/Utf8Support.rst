.. include:: /Includes.rst.txt
.. highlight:: php

=============
UTF-8 support
=============

<< Back to Help, tips and troubleshooting [outdated wiki link] page

[edit] [outdated wiki link]

.. container::

   notice - Note

   .. container::

      This page has been updated for TYPO3 6.2.

.. container::

   notice - Note

   .. container::

      If a step is not understandable, you can note that here [outdated
      wiki link].

Introduction
============

On this page we collect information about the old but still current
UTF-8 [outdated wiki link] topic. There are many options to set and
check.

A good start is to make sure that everything in the chain is using UTF-8
encoding, starting with ``apache.conf``, ``php.ini``, ``my.cnf`` and
ending with the TYPO3 settings.

In some cases not all settings are necessary and everything will run
fine without certain changes.

But at least you have a checklist about possible character encoding
problems and fixes. :)

General Settings
================

File system
-----------

The content of all files in the TYPO3 root folder and below is handled
as UTF-8 by TYPO3; so you should make sure that it really is. You should
check your HTML-Templates and CSS files for special chars like umlauts.
If they are displayed incorrectly, you should fix that by saving the
file in UTF-8 format.

When editing such files only use editors which can save files in UTF-8
format.

**Attention:** Do not save the files in UTF-8 format *with Byte Order
Mark (BOM)*. Saving them as UTF-8 with BOM can cause `different
problems <https://forge.typo3.org/issues/22954>`__, e.g. thumbnails in
the BE will no longer be shown. Save the files as UTF-8 without BOM
instead.

Apache: ``vhost.conf``
----------------------

::

    AddDefaultCharset utf-8

According to the `Apache
docs <https://httpd.apache.org/docs/2.4/mod/core.html#adddefaultcharset>`__,
this setting specifies the charset a browser should use when displaying
a page. You can set this in ``vhost.conf`` or in ``.htaccess``. The
first one will be faster. It should overwrite the value of the meta tag
in the page (although not all browsers respect that).

You can check that by inspecting the HTTP header data, for example using
the Firefox extension Firebug. You should see a line saying
``Content-Type: text/html; charset=utf-8``>.

PHP: ``php.ini``
----------------

::

    default_charset = "utf-8"

With that setting, stand-alone scripts will use this charset too. (By
default, this value is empty.)

PHP extensions that should be enabled
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

::

    extension=php_mbstring.so

You can choose either ``iconv`` or ``mbstring`` to do charset
conversions. They are much faster than the PHP implementation that comes
with TYPO3.

Comparisons of these methods show that ``mb_string`` seems to be the
best choice.

**Warning:** Do not enable ``mbstring.func_overload``. While it's
generally useful in UTF-8 setups, it conflicts with TYPO3's internal
character set handling in ``CharsetConverter``.

No matter which of the two extensions you use, you should make sure that
it's configured to use UTF-8. You can check that in ``phpinfo()`` and
correct the settings in ``php.ini`` or ``.htaccess``, if needed.

To use the extension, you also need to modify ``LocalConfiguration.php``
(see below).

MySQL: ``my.cnf``
-----------------

The following will set the system variables for character set and
collations for the whole MySQL server. **Be careful with this setting!**
It will also affect existing databases (which maybe don't use UTF-8, but
something else; for example latin1). So only set this when only UTF-8
databases are supposed to be on the server. TYPO3 makes sure that
``'SET NAMES utf8;'`` is sent to the database automatically (see below).
(If you don't set this option, but still want to use the SQL command
line client, you should use ``--character-set-server=utf8`` when
connecting to a UTF-8 database.)

::

    [mysqld]
    character-set-server = utf8

.. container::

   notice - Note

   .. container::

      Prior to MySQL 5.5.3, default_character_set could be used to
      achieve the same effect:
      ::

         [mysqld]
         default_character_set = utf8

      With MySQL 5.5.3 however, this setting has been removed!

Info on dropping support of default_character_set in MySQL 5.5.3
[outdated link]

TYPO3 settings
==============

``LocalConfiguration.php``
--------------------------

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

       // For GIFBUILDER support
       // Set it to 'mbstring' or 'iconv'
       $TYPO3_CONF_VARS['SYS']['t3lib_cs_convMethod'] = 'mbstring';
       $TYPO3_CONF_VARS['SYS']['t3lib_cs_utils'] = 'mbstring';

Note: You can also use ``iconv`` instead of ``mbstring``. Though
``mbstring`` isn't compiled into PHP by default (whereas ``iconv`` is),
```mbstring`` is much faster than
``iconv`` <http://replay.waybackmachine.org/20090221171406/http://dokeoslead.wordpress.com/2008/10/05/mbstring-vs-iconv-benchmarking/>`__.

.. container::

   notice - Note

   .. container::

      ``$TYPO3_CONF_VARS['SYS']['multiplyDBfieldSize']`` has been
      removed in TYPO3 6.0. In older versions, if your database's
      encoding was UTF-8, do **not** set
      ``$TYPO3_CONF_VARS['SYS']['multiplyDBfieldSize']``. It was only
      needed if your database was latin1-encoded but the content was
      UTF-8. When using UTF-8 database encoding, it was not needed and
      only wasted space.

.. container::

   notice - Note

   .. container::

      ``$TYPO3_CONF_VARS['BE']['forceCharset']`` has been removed. With
      a system with UTF-8 encoding, as we are creating it on this page,
      you do **not** need this setting. Should you still have it in your
      ``LocalConfiguration.php`` file, you should remove it.

Issues with ``$TYPO3_CONF_VARS['SYS']['setDBinit']``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. container::

   notice - Note

   .. container::

      In older versions of TYPO3,
      ``$TYPO3_CONF_VARS['SYS']['setDBinit']`` has been used to send the
      command ``SET NAMES utf8;`` to the database during initialization.
      This is not required any more; TYPO3 now automatically takes care
      that the according MySQL variables are set correctly. If you now
      set ``SET NAMES utf8;`` in
      ``$TYPO3_CONF_VARS['SYS']['setDBinit']``, this command will be
      removed automatically!

``$TYPO3_CONF_VARS['SYS']['setDBinit']`` contains commands, separated by
newlines, that are sent to the database right after connecting. Ignored
by the DBAL extension, except for the 'native' type. Please note that
each command in ``[setDBinit]`` is an SQL statement and thus needs to be
terminated with a semicolon.

In short: In order to get a working UTF-8 system, you do not have to
change ``$TYPO3_CONF_VARS['SYS']['setDBinit']`` at all.

``SET NAMES utf8;``
'''''''''''''''''''

``SET NAMES utf8;`` is equivalent to the following three statements:

.. container::

   SQL [outdated wiki link]

.. container::

   ::

       SET character_set_client = utf8; 
       SET character_set_results = utf8; 
       SET character_set_connection = utf8;

More information in the `official MySQL
docs <http://dev.mysql.com/doc/refman/5.7/en/charset-connection.html>`__.

TYPO3 automatically takes care that these variables are set as
described; you do not need to additionally set ``SET NAMES utf8;``.

If you check your database using phpMyAdmin and find umlauts in new
content being shown as two garbled characters, each international
character most likely is stored as two separate, garbled latin1 chars.
If this happens to you, you *cannot* just add the above statement any
more. Your output for the new content will be broken. Instead you have
to correct the newly added special chars first. This is done most easily
by just deleting the content, setting the variables as described above
and re-entering it.

``SET NAMES utf8;`` and ``SET SESSION character_set_server=utf8;``
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

In some configurations a setting for the session is needed, too:

.. container::

   SQL [outdated wiki link]

.. container::

   ::

       SET NAMES utf8;
       SET SESSION character_set_server=utf8;

It seems like the setting for ``character_set_server`` is only needed to
`create the DB with the right character
set <http://dev.mysql.com/doc/refman/5.7/en/charset-server.html>`__. So
you don't need it at all, if you already created your DB and if it
already uses UTF-8 as character set.

Don't use ``SET CHARACTER SET utf8;``
'''''''''''''''''''''''''''''''''''''

**Warning!** The following can create character set problems in TYPO3
that are hard to solve. **Avoid using this directive**:

.. container::

   SQL [outdated wiki link]

.. container::

   ::

       SET CHARACTER SET utf8;

According to the `official
docs <http://dev.mysql.com/doc/refman/5.7/en/charset-connection.html>`__
this sets the same variables as ``SET NAMES``, but possibly to other
values:

.. container::

   SQL [outdated wiki link]

.. container::

   ::

       SET character_set_client = utf8;
       SET character_set_results = utf8;
       SET collation_connection = @@collation_database;

That way ``character_set_connection`` is set to the value of
``character_set_database``, too, causing problems:

If ``character_set_connection`` is not "utf8", your transferred UTF-8
encoded data will be UTF-8-encoded *again*. Together with the data you
already had in the database before, you will get a mix of old correctly
encoded data and new incorrectly double-encoded data.

The textual data in your database should be displayed correctly in tools
like phpMyAdmin. When you use ``SET CHARACTER SET utf8;``, then see
wrong characters inside TYPO3 and proceed to "correcting" these errors
from inside TYPO3, you will destroy the characters in your database and
end up with garbled text. `More information on that
problem. <https://forge.typo3.org/issues/16178>`__

TypoScript setup
----------------

Make sure that ``config.renderCharset`` is set to the right value. Since
TYPO3 4.7 it defaults to "utf-8", which is exactly what you want it to
be. ``config.metaCharset`` will default to ``"utf-8"``, too. So if you
want UTF-8 output, you don't need to change these options.

*Note:* When you set ``config.renderCharset``, ``config.metaCharset``
will be set to the same value by default. When you set both values,
TYPO3 will use ``renderCharset`` internally and convert the *generated*
page right before delivering it to the browser.

`More information in the TypoScript
Reference <https://docs.typo3.org/typo3cms/TyposcriptReference/Setup/Config/Index.html>`__.

To avoid problems with accents of PHP generated date strings, configure
your locale, preferably defining not only the language, but also the
charset:

.. container::

   TS TypoScript [outdated wiki link]

.. container::

   ::

      config.locale_all = de_DE.utf-8

.. container::

   TS TypoScript [outdated wiki link]

.. container::

   ::

      config.locale_all = fr_FR.utf-8

Extensions
==========

*Collect extension related information here.*

Lowercasing/uppercasing text in extensions
------------------------------------------

To work with strings in TYPO3 extensions, use the methods in
``CharsetConverter``:

-  UPPERCASING a string:

   .. container::

      PHP Script [outdated wiki link]

   .. container::

      ::

         $value = $GLOBALS['LANG']->csConvObj->conv_case($GLOBALS['LANG']->charSet, $value, 'toUpper');

-  lowercasing a string:

   .. container::

      PHP Script [outdated wiki link]

   .. container::

      ::

         $value = $GLOBALS['LANG']->csConvObj->conv_case($GLOBALS['LANG']->charSet, $value, 'toLower');

-  string length:

   .. container::

      PHP Script [outdated wiki link]

   .. container::

      ::

         $length = $GLOBALS['LANG']->csConvObj->strlen($GLOBALS['LANG']->charSet, $string);

RealURL
-------

One problem is that RealURL might not be able to understand a page title
if it is in unusual (i.e. not roman) characters. For example, with a
page title in Japanese, I found that the title was not interpreted and
the page was rendered as ``jp.html``. Using the Navigation title solves
this problem (to follow on the example, setting "home" as the Navigation
title, my page was then rendered as ``jp/home.html``).

TemplaVoila
-----------

Make sure that your templates are saved in UTF-8. It is possible that
you have to map them again.

Further information
===================

Database
--------

Database charset
^^^^^^^^^^^^^^^^

Use UTF-8 in the database. The right collation will make sure that
database sorting functions work correctly.

Problem with indeces
''''''''''''''''''''

You might encounter this error:

::

    SQL=Specified key was too long; max key length is 1000 bytes:

This particular problem might occur when you are using UTF-8 encoding.
UTF-8 uses up to 3 bytes per character, and the maximum index length is
1000 bytes, so the effective maximum index is 1000/3 = 333 characters.

If this error occurs, you should check which part of TYPO3 added the
index: If it was added by the TYPO3 Core itself, report the bug at
`forge.typo3.org <https://forge.typo3.org/projects/typo3cms-core/issues>`__.
If it was set by an extension, report it to the extension author in
`forge.typo3.org <https://forge.typo3.org/>`__ or whereever their
bugtracker is located. If there is no bugtracker for the extension,
maybe sending a mail to the extension author helps.

You can work around this issue temporarily by simply removing the index
from the field.

Note: Using indeces that big anyway is not recommended and shows bad DB
design.

GIFBUILDER: Use Unicode font files
----------------------------------

If you use ``GIFBUILDER`` to create text (e.g. in a menu), make sure to
use an Unicode font file [outdated link]

If there still are problems with broken special chars in these images,
you should make sure that the configuration for ``mbstring`` or
``iconv`` (the one which you have chosen in the Install Tool) is set to
UTF-8. You can check that in ``phpinfo()`` and correct the settings in
``php.ini`` or in your web server settings, if needed.

HTML Tidy
---------

If HTML entities like &nbsp; show up as ? in the browser, you can
install the extension
`tidy <https://extensions.typo3.org/extension/tidy/>`__ from TER and add
the ``-utf8`` option to the ``path`` variable in the extension
configuration of tidy, e.g.:

::

   path = tidy -i --quiet true --tidy-mark true -wrap 0 -raw -utf8

Convert an already existing database to UTF-8
---------------------------------------------

Possibility 1
^^^^^^^^^^^^^

.. container::

   notice - Note

   .. container::

      This has been tested and works.

Jigal van Hemert wrote a `script to convert a MySQL database to
UTF-8 <http://www.typo3coder.nl/fileadmin/downloads/db_utf8_fix.zip>`__.
This script converts all columns, tables and the setting for the whole
database to UTF-8.

Jigal writes:

   Read the following very carefully, because you have to make a few
   adjustments depending on the situation:

   -  Always backup your database.
   -  The script was intended for the situation in which UTF-8 encoded
      data is stored in Latin-1 (or other charsets) tables; as was
      common in 2008. You can recognize this by looking into phpMyAdmin.
      Watch for characters with accents (diacriticals) that are shown as
      weird double-character combinations; for example, instead of "Ali
      Gökgöz and Gültekin Tarcan", text shows as "Ali GÃ¶kgÃ¶z and
      GÃ¼ltekin Tarcan". If this doesn't apply to your situation,
      comment out lines 108 - 123 (line numbers for the file with the
      date "26-10-2011" in one of the first lines). If you use a version
      of the script that does not have a change date in one of the first
      lines, the script is most probably of an older version; in which
      case the lines to be commented out are 97 - 107.
   -  In line 19, the constant ``SIMULATE`` is set to ``true``. This
      activates "dry-run" mode, that is, the tables are not really
      converted, it's only printed what \*would\* happen. After you
      executed the script at least once and there are no errors, you can
      set this constant to ``false``.
   -  Save the script into a subdirectory of the TYPO3 installation, for
      example inside ``fileadmin/``. It is designed to run from a
      subdirectory so it can pick up the database connection data from
      ``localconf.php``.
   -  Run the script from your browser:
      ``http://example.com/fileadmin/db_utf8_fix.php [outdated link]``.
      It shows each found table and prints a dot after the table name
      for each column it has converted.

   Columns/tables already in UTF-8 encoding won't be touched.

Jigal's script however needs to be slightly adapted in order to work
with TYPO3 6.0 and newer. On line 23, ``localconf.php`` is included in
order to pick up the database connection data:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      require_once ('../typo3conf/localconf.php');

This line needs to be replaced by a reference to
``LocalConfiguration.php`` and the required parameters need to be
retrieve from the configuration array:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $typo3_LocalConf = require_once ('../typo3conf/LocalConfiguration.php');

      $typo_db = $typo3_LocalConf['DB']['database'];
      $typo_db_host = $typo3_LocalConf['DB']['host'];
      $typo_db_username = $typo3_LocalConf['DB']['username'];
      $typo_db_password = $typo3_LocalConf['DB']['password'];

Possibility 2
^^^^^^^^^^^^^

Dump your database, modifiy the dumped file and import it again.

.. container::

   notice - Note

   .. container::

      If you do it that way, you might get broken special chars inside
      TYPO3. See below for more information.

| 
| Requirements:

-  Shell access to your Unix server
-  ``sed`` installed on the server

For this example we assume:

-  hostname: ``domain.com``
-  database: ``typo3``

This example is for \*nix users. If your working on a Windows PC, you
can do the same using
`PuTTY <http://www.chiark.greenend.org.uk/~sgtatham/putty/>`__. Enter
the hostname in the field "Host Name (or IP adress)" and click on
"Open". Then enter your ssh username, press enter and enter the password
(which will not be displayed) and press enter. You should now be
connected to the server.

Linux users connect to the server via ssh typing

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      ssh -l (user) domain.com

Create a backup of the database (if things go wrong...)

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      mysqldump -u (user) -p(pass) --max_allowed_packet=10000000 typo3 > typo3_backup.sql

Dump database (without the table ``typo3.sys_refindex``. This prevents
the following error: *"SQL=Specified key was too long; max key length is
1000 bytes*. *You have to rebuild the reference index afterwards!*)

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      mysqldump -u (user) -p(pass) --max_allowed_packet=10000000 --ignore-table=typo3.sys_refindex  typo3  > typo3_utf8.sql

Now modifiy the dump:

Newer versions of MySQL (at least 5.0) also save the collation for each
column seperately. You have to convert all of them:

First convert all occurences of
``"DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci"`` (use the
character set which you have written in your file) in ``typo3_utf8.sql``
to ``"DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci"``:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

       sed  -e 's/DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci/DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci/g' -i "" typo3_utf8.sql

Then convert all occurences of "COLLATE latin1_german1_ci" (use the
charset you have written in your file) to "COLLATE utf8_general_ci":

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

       sed  -e 's/COLLATE latin1_german1_ci/COLLATE utf8_general_ci/g' -i "" typo3_utf8.sql

Import database:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

       mysql -u (user) -p(pass) --default-character-set=utf8  typo3 < typo3_utf8.sql

Alter character set and collation for the whole database:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

       mysql -u (user) -p(pass) -e "ALTER DATABASE typo3 DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci"

Broken special chars?
'''''''''''''''''''''

If the result of the above mentioned is that special chars are displayed
incorrectly in TYPO3 (a small black box with a question mark in it
instead of the special char), the following might help:

Create a new database. Make sure that it uses UTF-8 as default charset
and ``utf8_general_ci`` as collation:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      mysql -u [username] -p[password] -e "ALTER DATABASE [newdb] DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;"

Then import the dump into that database **without** using ``sed`` to
replace the occurences of latin1 (or what you have) with UTF-8.

The result will be that the tables and columns in your database still
use latin1 (or what you had before).

This might be a problem, e.g. when you now add new tables to this
database, they will use UTF-8 as charset, because the database is set to
UTF-8. This will lead to a mix of both charsets in your DB.

Possibility 3
^^^^^^^^^^^^^

This might be the way to go for german speaking users with a Unix
server:

`A way similar to possibility 2 is recommended by t3n
(german). <http://t3n.de/magazin/mysql-typo3-utf-8-umstellen-tipps-wechsel-latin1-utf-8-220945/3/>`__

Basically they make the dump and replace the charset and collation
statements.

Then they use iconv on the dumped file to convert the signs inside:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

       iconv -f iso-8859-1 -t utf8 dump.sql > dump-iconv.sql

Hint: The names of the charset's may differ from platform to platform.
Use this to find supported charset names:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      iconv -l

After that they import the file using the switch
--default-character-set=utf8:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

       mysql -u USER -p PASSWORT -h HOST --default-character-set=utf8 DB < dump-iconv.sql

Note 1
''''''

\|If you did that and get umlauts displayed correctly, but ß (sz-lig)
and € (euro) displayed wrongly inside TYPO3, you should specify CP1252
as the origin charset to the iconv command like that:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      iconv -f CP1252 -t utf8 dump.sql > dump-iconv.sql

Note 2
''''''

If DB collations are set to *utf8_general_ci*, it is possible that your
data gets double UTF-8-encoded, as TYPO3 sends UTF-8 encoded data to the
DB server, but the DB server has no additional information on the
connection and defaults to Latin1 - thus it converts the data again. To
solve this, use the following command, which converts your data back to
correctly encoded UTF-8:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      iconv -f UTF-8 -t ISO-8859-1 dump.sql > dump-iconv.sql
      # if error occures try:
      # iconv -f UTF-8 -t ISO-8859-1//TRANSLIT dump.sql > dump-iconv.sql
      # or even:
      # iconv -f UTF-8 -t ISO-8859-1//TRANSLIT//IGNORE dump.sql > dump-iconv.sql

Note 3
''''''

If you tried to use ``iconv`` and it threw an error like "cannot
convert", try this command which attempts to translate given strings for
which there is no representation in the target charset:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      iconv -f iso-8859-1//TRANSLIT -t utf8 dump.sql > dump-iconv.sql

If this still doesn't work, as a workaround there is the possibility to
ignore these characters silently:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      iconv -f iso-8859-1//TRANSLIT//IGNORE -t utf8 dump.sql > dump-iconv.sql

Possibility 4
^^^^^^^^^^^^^

`Source (in German) <http://www.slicewise.net/?id=47>`__. Tested on
Debian Lenny, MySQL 5.0.51, TYPO3 4.5.

Convert database to utf8
''''''''''''''''''''''''

For the database do:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      echo "ALTER DATABASE mydb CHARACTER SET utf8 COLLATE utf8_general_ci;" | mysql
      mysqldump --default-character-set=latin1 --databases mydb > a.sql
      cp a.sql b.sql
      sed -i 's/DEFAULT CHARSET=latin1/DEFAULT CHARSET=utf8/g' b.sql
      sed -i 's/CHARACTER SET latin1/CHARACTER SET utf8/g' b.sql
      <*>
      grep -v character_set_client <b.sql > c.sql
      mysql --default-character-set=utf8 < c.sql

Your data should display correctly when you use a MySQL console.

Troubleshooting:
''''''''''''''''

If errors occur while loading data try to display the corresponding
statement by setting MySQL to very verbose:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      mysql -v -v --default-character-set=utf8 < c.sql

For errors like this:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      CREATE TABLE `sys_registry` (
        `uid` int(11) unsigned NOT NULL auto_increment,
        `entry_namespace` text NOT NULL,
        `entry_key` text NOT NULL,
        `entry_value` blob,
        PRIMARY KEY  (`uid`),
        UNIQUE KEY `entry_identifier` (`entry_namespace`(256),`entry_key`(127))
      ) ENGINE=InnoDb DEFAULT CHARSET=utf8

      ERROR 1071 (42000) at line 1333: Specified key was too long; max key length is 767 bytes
      Bye

Here you should resize your index above at <*> by adding another sed
line:

.. container::

   Shell Script [outdated wiki link]

.. container::

   ::

      sed -i 's/`entry_namespace`(256)/`entry_namespace`(127)/g' b.sql

Note
''''

The maximum key length with latin1 is

-  for InnoDb: 767.
-  for MyIsam: 1000

The maximum key length with utf8 is

-  for InnoDb: 767/3
-  for MyIsam: 1000/3

Possibility 5
^^^^^^^^^^^^^

Try the extension
`toolbox_utf8 <https://forge.typo3.org/projects/extension-toolbox_utf8>`__
and give feedback.

Documentation could be found in `forge wiki of the
project <https://forge.typo3.org/projects/extension-toolbox_utf8/wiki>`__

Possibility 6
^^^^^^^^^^^^^

The extension
`smoothmigration <https://extensions.typo3.org/extension/smoothmigration/>`__
comes with an upgrade module, which can upgrade a non-UTF-8 database to
UTF-8.

TYPO3 specific links about charset conversion
=============================================

-  http://www.typo3-media.com/blog/article/utf8-and-typo3-updated.html

German
------

-  http://ducrot.wordpress.com/2010/06/04/utf-8-umstellung-oder-reparatur-eines-vorhandenen-typo3-systems/

Misc. links about charset conversion
====================================

-  http://dev.mysql.com/doc/refman/5.7/en/charset-convert.html [outdated
   link] Charset conversion with MySQL
-  http://m.tacker.org/blog/64.script-to-convert-wordpress-content-encoding.html
   [outdated link] Useful charset conversion PHP script
-  http://dev.mysql.com/doc/refman/5.7/en/charset.html

.. _german-1:

German
------

-  http://linuxwiki.de/tcs How to change file encodings using TCS
