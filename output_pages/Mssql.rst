.. include:: /Includes.rst.txt
.. highlight:: php

=====
Mssql
=====

Keep in mind
============

Microsoft SQL Server is a proprietary, closed-source product, that is
not in the Free Software spirit of the GPL and TYPO3. For discussions
about the Pros and Cons see other web-pages, not here.

What do I need for Microsoft SQL Server (mssql)?
================================================

Note: this description so far goes for connecting an remote MSSQL Server
via ODBC

MS SQL Server
-------------

TYPO3 was tested under MSSQL 2000 and MSSQL 2005, see also
http://en.wikipedia.org/wiki/MSSQL

make sure your DB user for php scripts have proper permissions,
especially to create tables. There will be helper tables for generating
the auto_increment values.

PHP
---

PHP with support for ODBC. There are several PHP extensions that connect
directly to an MS SQL server, but this is untested yet.

TYPO3
-----

Use TYPO3 4.0.1 or later.

DBAL
----

You must manually install and configure the DBAL extension before
entering the TYPO3 installer.

Hint: Do not use the 1-2-3 mode, but edit LocalConfiguration.php
manually, see documentation of DBAL

How do I configure my system
============================

.. _php-1:

PHP
---

You must install ODBC by adding them to your php.ini, if it´s not
installed yet. Note that (on windows, apache2) MySQL and ODBC support is
built in, so no dll is needed for it.

| 
| in the ODBC section you can set some preferences if you want: e.g.
  Windows: [ODBC]

odbc.default_db = Not yet implemented

odbc.default_user = Not yet implemented

odbc.default_pw = Not yet implemented

Allow or prevent persistent links.

odbc.allow_persistent = On

Check that a connection is still valid before reuse.

odbc.check_persistent = On

Maximum number of persistent links. -1 means no limit.

odbc.max_persistent = -1

Maximum number of links (persistent + non-persistent). -1 means no
limit.

odbc.max_links = -1

Handling of LONG fields. Returns number of bytes to variables. 0 means

passthru.

odbc.defaultlrl = 4096

Handling of binary data. 0 means passthru, 1 return as is, 2 convert to
char.

See the documentation on odbc_binmode and odbc_longreadlen for an
explanation

of uodbc.defaultlrl and uodbc.defaultbinmode

odbc.defaultbinmode = 1

**in the MSSQL section you have to set some additional preferences for
handling fields** with datatype text:

Valid range 0 - 2147483647. Default = 4096.

mssql.textlimit = 2147483647

Valid range 0 - 2147483647. Default = 4096.

mssql.textsize = 2147483647

.. _typo3-1:

TYPO3
-----

**Do not** enter the TYPO3 installer before you have done the manual
configuration described below. It's not possible to use 1-2-3 install
wizard to connect to an MSSQL server!

Install ADOdb and DBAL
^^^^^^^^^^^^^^^^^^^^^^

As you need this extensions before you have access to the back-end you
must install these extensions manually.

Simply edit LocalConfiguration.php and add ``adodb`` and ``dbal`` to
$TYPO3_CONF_VARS['EXT']['extListArray'].

Configure DBAL
^^^^^^^^^^^^^^

Edit LocalConfiguration.php and add these lines.

::

   $TYPO3_CONF_VARS['EXTCONF']['dbal']['handlerCfg'] = array (
    '_DEFAULT' => array (
     'type' => 'adodb',
     'config' => array (
     'driver' => 'odbc_mssql'
     )
    ),
   );

Configure DB access
^^^^^^^^^^^^^^^^^^^

Create a System-DSN to access the Database.

Edit LocalConfiguration.php and add these lines.

::

   $TYPO3_CONF_VARS['DB']['username'] = 'user';
   $TYPO3_CONF_VARS['DB']['password'] = 'pwd';
   $TYPO3_CONF_VARS['DB']['host'] = 'MSSQL';//name of odbc handler on local machine
   $TYPO3_CONF_VARS['DB']['database'] = 'notneeded'; //is configured in odbc handler

Note: Of course you must use the name and password of your system. The
values above are only examples. You can also replace 'notneed' by the
default-database in Mssql you set in your odbc handler. This is the
target-database that will contain typo3 tables on your MSSQL server.

Create TYPO3 tables
^^^^^^^^^^^^^^^^^^^

After you have done everything as described you can use the TYPO3
installer as usual. The Install Tool is located in 'typo3/install/'. So
go to the 'Database analyzer' and use 'COMPARE' to create the necesssary
tables, columns and indices. In the report select all options
(radio-buttons) altering things like fields types & more.... The tables
are then created in Mssql in the default database you chose while
defining your odbc handler. If not already done, create an admin user
(and password) now for the backend (You're still in the 'Database
analyzer').

An option is to start whole system up with mysql and then transfer mysql
database to MS SQL with tools like
`[1] <http://www.convert-in.com/sql2mss.htm>`__

MS SQL
------

make sure default values for lots of fields are 0 or NOT NULL flag is
disabled, if you have this problem, the error messages will guide you :)

either IDENTITY_INSERT must be on or primary key field (via alter
table): set identity (Identitätsspezifikation) to NO. this will allow
TYPO3 to insert the uid´s received through helper tables (DBAL forces
this)

Unresolved issues
=================

It seems as if the pagetree is not properly displayed when using MSSQL:

::

    * https://forge.typo3.org/issues/16781 (Typo3 Bugtracker, workaround posted there)
    * http://www.typo3.net/forum/list/list_post//43371/?page=1 [outdated link] (German)

Tips and Tricks
===============

Make sure your extensions use proper sql statements, e.g.

WHERE uid='3' instead of WHERE u

WHERE HIDDEN=0 instead of WHERE NOT HIDDEN

Using ODBC is somtetimes resulting in lost connections to the DB if it
has to be restarted (might happen quite often during development), even
if DB is up again. In this case, try to set [SYS][no_pconnect] = 1 in
Install Tool

Note: this page ist just initially entered, so please try the suggested
steps here and alter them with your resulting experience.

Using TemplaVoila: You have to edit ext_tables.php in line 194 and
change

'foreign_table_where' => 'AND
tx_templavoila_tmplobj.pid=###STORAGE_PID### AND
tx_templavoila_tmplobj.datastructure="###REC_FIELD_tx_templavoila_ds###"
AND tx_templavoila_tmplobj.parent=0 ORDER BY
tx_templavoila_tmplobj.sorting',

to

'foreign_table_where' => 'AND
tx_templavoila_tmplobj.pid=###STORAGE_PID### AND
tx_templavoila_tmplobj.datastructure=###REC_FIELD_tx_templavoila_ds###
AND tx_templavoila_tmplobj.parent=0 ORDER BY
tx_templavoila_tmplobj.sorting',

also for line 229 you have to remove quotes around
###REC_FIELD_tx_templavoila_next_ds###

--Abezet [outdated wiki link] 09:43, 29 August 2006 (CEST)

Problem: Treeleven shows only two levels
----------------------------------------

For more infos about this bug see: https://forge.typo3.org/issues/16781
There is a problem using Typo3 & MSSQL. There are only shown 2 levels in
the pagetree. It's also not possible to set shortcuts deeper than two
levels (and maybe some other problems).

Here is a solution that seems to work:

::

        -----[open File]-----------------------
        \t3lib\class.t3lib_treeview.php
         
        -----[search]--------------------------
        if ($depth>1 && $this->expandNext($newID) && !$row['php_tree_stop']) {
         
        -----[replace with]--------------------
        // Bugfix: Problem with more than 2 levels in treeview when using a MSSQL Database
        // Daniel Flandorfer (info(at)flanisoft.at) - 02.2007
        // see: https://forge.typo3.org/issues/16781
           $depth=6; // ATTENTION: if you need more than 6 levels adjust this value!
        // removed && $this->expandNext($newID)
           if ($depth>1 && !$row['php_tree_stop']) {
        // Bugfix-End: Problem with more than 2 levels in treeview when using a MSSQL Database
         
        -----[save file]-----------------------

Patch: Pagetree only shows two levels (by Felix Eckhofer / Studio9)
-------------------------------------------------------------------

Attached is a patch against DBAL that fixes this issue. The problem was
that adodb does not support ADODB_FETCH_BOTH for mssql and therefore
\*always\* returns an assoc array. I fixed it by converting between
assoc array and numeric array dynamically and that seems to work just
fine.

In case the upload here does not work you may access the patch using
this URL: http://studio9.tribut.de/class.ux_t3lib_db.MSSQL.patch
[outdated link] [^]

best regards
