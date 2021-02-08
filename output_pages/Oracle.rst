.. include:: /Includes.rst.txt

======
Oracle
======

.. container::

   notice - This information is outdated

   .. container::

.. container::

   error - This page is a candidate for deletion

   .. container::

      **Reason: No reason given**
      If you disagree with its deletion, please explain why at `Category
      talk:Candidates for speedy
      deletion </wiki/index.php?title=Category_talk:Candidates_for_speedy_deletion&action=edit&redlink=1>`__
      [not available anymore] or improve the page and remove the
      ``{{delete}}`` tag.

      This notice should remain for a minimum of 1 week after it was
      placed on the page. If a discussion is still ongoing, it should
      remain until a consensus is reached or a decision has been made
      about the removal, after which the page will either be deleted or
      this notice removed.

      Remember to check `what links
      here </Special:WhatLinksHere/Oracle>`__ [deprecated wiki link] and
      the `the page
      history <https://wiki.typo3.org/wiki/index.php?title=Oracle&action=history>`__
      [deprecated wiki link] before deleting.

What do I need for Oracle?
==========================

.. _oracle-1:

Oracle
------

Hint: Use `Oracle 10g Express
Edition <http://www.oracle.com/technology/products/database/xe/index.html>`__
for toying around. It's free and comes with a nice GUI installer.

PHP
---

PHP with support for Oracle. There are several PHP extensions that
connect you to an `Oracle </Category:Oracle>`__ [deprecated wiki link]
server.

Hint: Via Oracle's `XE
pages <http://www.oracle.com/technology/products/database/xe/index.html>`__
you can get a copy of "Zend Core for Oracle" which bundles everything
you need including Apache. This version of PHP is known to work
out-of-the-box. You may experience Apache crashes (only on Windows?)
when you use the binaries available from httpd.apache.org and php.net.
Seems like the crashs on windows actually dont appear when using PHP 4+.

Do not use 5.1.6, it does not manage to read data stored in BLOBs,
5.2-latest from CVS (27.10.2006) does not have this problem.

TYPO3
-----

Use TYPO3 4.0.3 or later. TYPO3 4.0 doesn't handle some of Oracle's
peculiarities. It will not work without manual changes to TYPO3's PHP
code and the database layout.

DBAL
----

You must manually install and configure the DBAL extension before
entering the TYPO3 installer.

Hint: Do not use the 1-2-3 mode, but edit LocalConfiguration.php
manually.

How do I configure my system
============================

.. _php-1:

PHP
---

You must install one of these extensions by adding them to your php.ini.

-  php_oci8
-  php_ora (deprecated)
-  php_pdo (PHP 5.1)

e.g.

Unix:

::

   ; OCI8
   extension=php_oci8.so

Windows:

::

   ; Ora
   extension=php_ora.dll

::

   ; PDO
   extension=php_pdo.dll
   extension=php_pdo_oci.dll

.. _typo3-1:

TYPO3
-----

**Do not** enter the TYPO3 installer before you have done the manual
configuration described below. It's not possible to use 1-2-3 install
wizard to connect to an Oracle server!

Install ADOdb and DBAL
^^^^^^^^^^^^^^^^^^^^^^

`ADOdb </Category:ADOdb>`__\ *[deprecated wiki link]
and*\ `DBAL </Category:DBAL>`__\ *[deprecated wiki link]*

There a two possible ways

1) As you need this extensions before you have access to the back-end
you must install these extensions manually. Copy directories, located in
"\typo3\sysext\", named "adodb" and "dbal" into "\typo3conf\ext\"

2) Just make sure to have "adodb" and "dbal" in "\typo3\sysext\". This
should work too as in some cases (tried T3 v4.03 ) copying the files to
"\typo3conf\ext\" makes the system not finding the required extensions.

Simply edit LocalConfiguration.php and add ``adodb`` and ``dbal`` to
$TYPO3_CONF_VARS['EXT']['extListArray'].

Configure DBAL
^^^^^^^^^^^^^^

Edit LocalConfiguration.php and add these lines.

::

   $TYPO3_CONF_VARS['EXTCONF']['dbal']['handlerCfg'] = array (
    '_DEFAULT' => array (
     'type' => 'adodb',
     'config' => array(
      'driver' => 'oci8',
     )
    ),
   );

Also add ``adodb`` and ``dbal`` to
$TYPO3_CONF_VARS['EXT']['extListArray'].

Other possible driver types are 'oracle' (best for Oracle 7, won't work
with Oracle 10g) or 'pdo_oci' (experimental PHP extension).

Configure DB access
^^^^^^^^^^^^^^^^^^^

Edit LocalConfiguration.php and add these lines.

::

   $typo_db_username = 'user';
   $typo_db_password = 'pwd';
   $typo_db_host = 'localhost';
   $typo_db = 'SIDorServicename';

Unlike MySQL you don't connect to a server and select a DB. You connect
as a user and use the default schema. To do this you can either enter
the SID or the name of the service ('XE' when you use 10g XE). You must
set the hostname and the service name in $typo_db_host and $typo_db.
It's not possible to set them in one as //hostname/servicename (which
means you cannot change the default port of 1521 using a service name).

Note: Of course you must use the name and password of your system. The
values above are only examples.

Create TYPO3 tables
^^^^^^^^^^^^^^^^^^^

Edit the the following files and remove "``ENGINE=InnoDB``" from the
table creation scripts:

-  ``ext_tables.sql`` in ``/typo3/sysext/cms``
-  ``tables.sql`` in ``/t3lib/stddb``

After you have done everything as described you can use the TYPO3
installer as usual. So go to the 'Database analyzer' and use 'COMPARE'
to create the necesssary tables, columns and indices.

The installer will list an number of unnecessary ALTER TABLEs which you
may safely ignore. In TYPO3 4.0 DBAL cannot interpret the table
definitions well enough. But see below for further steps to be done in
Oracle.

.. _oracle-2:

Oracle
------

Nothing to configure, but a few things to tweak after the installer has
created all the necessary tables.

To make TYPO3 work with Oracle the following SQL statements are
necessary. Otherwise TYPO3 **won't work**.

Hint: With 10g XE you can use the Oracle Application Express web
application. The default URL is http://localhost:8080/apex [not
available anymore] (assuming you work on the same machine as the
server)..

Add column triggers for 'pages' and 'tt_content'
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TYPO3 will try to insert/change some fields to '' expecting the DB to
use the default like Mysql does. Oracle doesn't do this, so we must
create a workaround.

::

   create or replace trigger "pages_defaults"
   before insert or update on "pages"
   for each row
    when (NEW."fe_group" is null or NEW."fe_group" = '')
   begin
    :NEW."fe_group" := '0';
   end; 

::

   create or replace trigger "tt_content_defaults"
   before insert or update on "tt_content"
   for each row
   when (NEW."fe_group" is null or NEW."fe_group" = '' or NEW."list_type" is null or NEW."list_type" = '')
   begin
   if :NEW."fe_group" is null or :NEW."fe_group" = '' then
    :NEW."fe_group" := '0';
   end if;
   if :NEW."list_type" is null or :NEW."list_type" = '' then
   :NEW."list_type" := '0';
   end if;
   end;

The 4.0.1 release of TYPO3 will include IS NULL when checking against
fe_group --`k-fish </User:K-fish>`__ [deprecated wiki link] 14:00, 6
July 2006 (CEST)

Add index for versioning
^^^^^^^^^^^^^^^^^^^^^^^^

The installer will use an index name which exceeds Oracle's limit of 30
characters for names.

::

   CREATE INDEX "pages_language_overlay_t3void" ON "pages_language_overlay" ("t3ver_oid", "t3ver_wsid")

Pitfalls / Problems / Attention!
================================

DB object names have limited length
-----------------------------------

All Oracle identifiers are limited to 30 characters. There is no option
that lets you change that. This means that Oracle allows only 30
characters for table and column names. You may encounter extensions that
use longer names. Please note that 'identifiers' include 'keys', so if
you have the following table setup:

.. container::

   `SQL </wiki/Help:Contents#Syntax-Highlighting_for_SQL>`__ [deprecated
   wiki link]

.. container::

   ::

       CREATE TABLE tx_cal_exception_ev_group_mm (
         uid_local int(11) unsigned DEFAULT '0' NOT NULL,
         uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
         tablenames varchar(30) DEFAULT '' NOT NULL,
         sorting int(11) unsigned DEFAULT '0' NOT NULL,
         KEY uid_local (uid_local),
         KEY uid_foreign (uid_foreign)
       );

The length of the table name is 28 characters. But because there are two
keys that will be set, Oracle will create two indexes:

-  tx_cal_exception_ev_group_mm_uid_local
-  tx_cal_exception_ev_group_mm_uid_foreign

Both index names are longer than 30 characters and table creation will
fail with the error: ORA-00972: identifier is too long

To solve this, set up a table name mapping before creating the table in
TYPO3 --`k-fish </User:K-fish>`__ [deprecated wiki link] 14:01, 6 July
2006 (CEST)

You can create a table or column name mapping in
typo3conf/LocalConfiguration.php. This is outlined in the dbal
documentation at
`[1] <https://docs.typo3.org/typo3cms/extensions/dbal/Configuration/Mapping/Index.html>`__

::

   text                          | chars
   _____________________________________
   tx_cal_exception_ev_group_mm  | 28
   uid_foreign                   | 11
   _                             |  1 

   gives: tx_cal_exception_ev_group_mm_uid_foreign (40 chars)

In this case we need to shorten the column and table names so much that
a key of shorter than 30 characters will be created. We must take care
to keep the names of the tables unique.

A possible solution is:

::

   text                          | chars
   _____________________________________
   cal_ex_ev_gr_mm               | 15
   uid_foreign                   | 11
   _                             |  1 

   gives: cal_ex_ev_gr_mm_uid_foreign (27 chars)

| 
| Example:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       $TYPO3_CONF_VARS['EXTCONF']['dbal']['mapping'] = array (
          'tx_cal_exception_event_group_mm' => array (
              'mapTableName' => 'cal_ex_ev_gr_mm'
          ),
       );

You will need to go through all your tablename / key combinations and
calculate the resulting index length. If that goes above 30 characters,
you need to cme up with a clever mapping. This should be easily
scriptable though. If you can not come up with a unique table name that
is short enough, you will need to shorten the field values too and add
them to the mapping.

Default values for VARCHAR fields not allowed
---------------------------------------------

It is not allowed to set default values for VARCHAR fields on table
creation. For example, the following CREATE TABLE statement will fail:

::

   CREATE TABLE tx_cal_event (
       uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
       pid int(11) DEFAULT '0' NOT NULL,
       allday tinyint(4) unsigned DEFAULT '0' NOT NULL,
       timezone varchar(5) DEFAULT 'UTC' NOT NULL,
   );

Change the statement to:

::

   CREATE TABLE tx_cal_event (
       uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
       pid int(11) DEFAULT '0' NOT NULL,
       allday tinyint(4) unsigned DEFAULT '0' NOT NULL,
       timezone varchar(5) DEFAULT "" NOT NULL,
   );

Please send bugreports to authors of extensions and explain to them that
they should specify default values in CODE, not in the CREATE TABLE
statements.
