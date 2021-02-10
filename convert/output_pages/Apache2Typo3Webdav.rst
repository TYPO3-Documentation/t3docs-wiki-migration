.. include:: /Includes.rst.txt

====================
Apache2 TYPO3 WebDAV
====================

Configuring Apache2/WebDAV for TYPO3
====================================

This HowTo describes the installation and configuration for WebDAV usage
on a Linux `Debian <https://wiki.typo3.org/Category:Debian>`__
[deprecated wiki link] (sarge) system. All software used and required is
also available for Windows. So this tutorial should be pretty much the
same.

What you get (after working through this)
-----------------------------------------

When completing the steps below, you will be able to upload files into
the file /typo3/fileadmin folder using the WebDAV protocol (Webfolders
when we talk about Windows). It is possible to map the WebDAV root
folder directly to the fileadmin folder (while allowing public access to
some subfolders) or to some subfolder. The goal of this is to allow easy
document exchange while (optionally) password protecting everything. The
users, passwords and groups will be administred using TYPO3 users and
groups. Access will be configured using Apache2 .htaccess files. Access
can be granted to backend, frontend users or to groups using the names
of the groups.

What you dont get
-----------------

The WebDAV support comes from the apache webserver. So you will not get
a clean and proper integration into TYPO3. Uploaded or modified files
will not be recognized by TYPO3 (or not in any case). Also TYPO3 will
not support versioning on the files. But the WebDAV protocol itself may
offer enough versioning for you.

Requirements
============

-  (quite) some knowledge on configuring an Apache2 Webserver
-  some knowledge on MySQL (and SQL)
-  a working TYPO3 installation (tested on v4.0), but this installtation
   does mainly depend on everything else below
-  MySQL v5 (when using MySQL v4 you will not be able to use the group
   athentication)
-  Debian 3.1 (sarge), It may also run on Apache2 on Windows (try, tell
   me :) )
-  A running Apache2 Webserver (tested with 2.0.xx)

Apache2 configuration
=====================

`Apache <https://wiki.typo3.org/Category:Apache>`__ [deprecated wiki
link]

You will have to install and configure the WebDAV modules and the
MySQL-Auth module: First we will make sure we got the recent package
list:

::

   # apt-get update

Then we will install the MySQL Auth modules:

::

   # apt-get install libapache2-mod-auth-mysql

The WebDAV modules are already around. We may need to activate them.
Modules can be activated (installed into Apache2) using:

::

   # a2enmod auth_mysql
   # a2enmod dav_fs 
   # a2enmod dav

Just type *a2enmod* to get a list of available modules. Modules can be
disabled using *a2dismod*. Restart Apache2:

::

   # apache2ctl configtest
   # apache2ctl restart

Users for Apache 1.x may use the older modules like
libapache-mod-auth-mysql (not tested). On Windows find the *LoadModule*
line in the apache.conf file and remove the #.

Creating Additional MySQL Views
===============================

`MySQL <https://wiki.typo3.org/Category:MySQL>`__ [deprecated wiki link]

Welcome to the tricky part. Later on this step will allow us to
configure the apache2-auth_module to use the users and groups from
Typo3. Typo3 stores its users and groups in different tables:
*be_users*, *fe_users*, *be_groups* and *fe_groups*. Sadly the groups
are referenced as unique ids within the users table. So if we want to
grant acces for the group 'WebDAV-Members', we would have to remember
the unique id, which is not the best solution - remembering numbers can
be dangerous as well.

So we will create database-views. And this is the main reason MySQL v5
is required. Views are a new feature and not available in earlier
versions.

Whats a view? Short version: it looks and behaves (almost) like a table.
But in fact it's a SQL statement that dynamically fills the content. It
allows simplified queries on complex data structures or in our case: the
*apache2-auth_module* tool we use to authenticate users is not that
flexible. So the view will represent a structure the module can use.

We will create three views:

-  a view for backend users and their group memberships,
-  a view for frontend users and their group memberships (We will
   encrypt the passwords so they look like backend passwords, so the
   view containing both looks smoother.) and
-  a view containing both (may not be perfect if you have backend and
   frontend users with the same username!)

Creating a view for backend users
---------------------------------

Use a database tool (the phpMyAdmin extension, SQLYog, MySQLFront,
DBVis... what ever you prefer) and create the following views into the
same database where the Typo3 (*be_users*...) tables are located. Simply
execute the following SQL statement:

.. container::

   `SQL <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_SQL>`__
   [deprecated wiki link]

.. container::

   ::

       CREATE OR REPLACE VIEW v_be_usergroups AS
       SELECT be_users.username, be_users.password, group_concat(be_groups.title SEPARATOR ',') AS groups, 
              1 AS be_user
       FROM be_groups, be_users
       WHERE FIND_IN_SET(be_groups.uid, be_users.usergroup) > 0
          AND be_users.deleted = 0
          AND be_groups.deleted = 0
       GROUP BY username, password;

Creating a view for frontend users
----------------------------------

Very similar is the front end part: only the clear-text passwords will
be encrypted too and the be_user flag is set to 0.

.. container::

   `SQL <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_SQL>`__
   [deprecated wiki link]

.. container::

   ::

       CREATE OR REPLACE VIEW v_fe_usergroups AS
       SELECT fe_users.username, md5(fe_users.password) as password, 
              group_concat(fe_groups.title SEPARATOR ',') AS groups, 0 AS be_user
       FROM fe_groups, fe_users
       WHERE FIND_IN_SET(fe_groups.uid, fe_users.usergroup) > 0
          AND fe_users.deleted = 0
          AND fe_groups.deleted = 0
       GROUP BY username, password;

Creating a view for both backend and frontend users
---------------------------------------------------

Merge both views to get a big family.

.. container::

   `SQL <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_SQL>`__
   [deprecated wiki link]

.. container::

   ::

       CREATE OR REPLACE VIEW v_merged_usergroups AS
       SELECT * FROM v_be_usergroups
       UNION
       SELECT * FROM v_fe_usergroups;

Some things to notice
---------------------

If you can see the database-view (*show tables;*) a select will show its
data. You should be able to recognize your users. If you add one within
Typo3 the user will automatically apear inside the view. **Note**: Users
that are in no group at will not be visible in the views (the
*group_concat()* function in MySQL will not let them through). So to be
able to access our webfolders, the user must be in at least one group
(which is not that bad, create some *WebDAV* group for e.x.)

Furthermore: the merged view (containing all users) must not contain two
rows with the same username! This will let the apache-auth module fail
to authenticate the users (one user may not have more than one
password).

Some featured bug: if you create a frontend group called 'Members' you
can create a backend group with the same name. These groups cannot be
distinguished! I recommend using different group names anyway. In my
case, this is a nice side-effect, as I can grant access so some folders
to a group, which is then available for both front-end and back-end
users.

As an example: imagine the backend users are people in your company and
they all got backend user accounts. Some customers may get a frontend
user account. To allow easy file exchange you could create a group for
backend and frontend with the same name. Access is then controlled using
that group name.

Configure the authentication using the MySQL views
==================================================

It is somewhat important to notice that there is more than one apache2
module available for mysql authentication. The different modules require
slighltly different settings. This example is for the one installed with
*apt-get* on Debian Sarge (3.1).

There is another module doing the same job at
`sourceforge.org <http://sourceforge.net/projects/modauthmysql>`__. But
its not the one used here. So dont get confused with the manual there.
Expecially the encryption types available for passwords are different.

To proper documentation can be read here:

::

   # cd /usr/share/doc/libapache2-mod-auth-mysql
   # zless USAGE.gz
   # zless DIRECTIVES.gz

We will map the WebDAV folder into
*/webroot/apache/typo3-dummy/fileadmin/webdav*. Your website would then
be available from */webroot/apache/typo3-dummy/*. You can actually map
this folder directly to the fileadmin folder! It is important to
configure the templates, stylesheets and images folder as public folders
(see below), so no access popup is shown to your website visitors.

Configure the WebDAV folder in Apache2
======================================

You can put this into your *httpd.conf* or create a new site or add it
to your existing files:

::

   <Location /fileadmin/webdav/>
          # enable WebDAV for this folder:
          DAV On

          php_admin_flag engine off

          AllowOverride All
          allow from all
          Options +Indexes
   </Location>

We additionally create a subdomain (virtual host) to allow easy access
using the Windows webfolders feature:

::

   <VirtualHost webdav.yourdomain.ch:80>
          DocumentRoot /webroot/apache/typo3-dummy/fileadmin/webdav
          ServerName wwebdav.yourdomain.ch
          <Directory "/webroot/apache/typo3-dummy/fileadmin/webdav">
                  DAV On

                  php_admin_flag engine off

                  AllowOverride All
                  allow from all
                  Options +Indexes
          </Directory>
   </VirtualHost>

Hints and notes on Windows Webfolders
-------------------------------------

The subdomain we created is mainly used to prevent Windows users to
encounter problems when accessing it. There are several known bugs on
this. A good overview of work-arounds can be found
`here <http://ulihansen.kicks-ass.net/aero/webdav/index.html>`__. A
short summary: Webfolders looking like
http://mydomain.ch/fileadmin/webdav/\ *[not available anymore]* may not
be accessible. To overcome that there seem to be several workarounds:

-  use a subdomain that points to that folder
-  add a port number to the link
-  add a # sign at the end of the resource link
   (http://mydomain.ch/fileadmin/webdav/#\ *[not available anymore]*)
-  use an `SSL <https://wiki.typo3.org/Category:SSL>`__ [deprecated wiki
   link] resource, https:// (and be aware of the restrictions if you
   have only one ip address for your server and are already using it, it
   will be difficult to use another virtual host, see `Apache2 SSL
   FAQ <https://httpd.apache.org/docs/2.4/ssl/ssl_faq.html#vhosts>`__
   for some infos in this)
-  use another client (like webdrive) or another operating system
-  be creative in some other way

Creating SSL certificates is pretty easy using the
*apache2-ssl-certificate* command.

Depending on your configuration you may need to insert an
*AllowOverride* option for your apache web-root folder. This will enable
the parsing of the *.htaccess* files (in case that part isnt working).
We do another Apache2 restart:

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

       # apache2ctl configtest
       Syntax OK
       # apache2ctl restart

To test if the webdav thing works you may use the command line client:
*cadaver*

.. container::

   `Shell
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

       # apt-get install cadaver
       # cadaver http://webdav.yourdomain.ch/

No authentication information is requested yet from the server. We will
add this now.

Creating access files
=====================

There is yet another kind of bug: this time within the apache webdav
module. It will list the *.htaccess* files. Although these files are not
readable in any case, there is a workaround too: symbolic links. This
will work for authentication and the webdav module will not list the
*.htaccess* files.

We have used */webroot/apache/typo3-dummy/fileadmin/webdav* as our
webdav folder. We will create the used authentication files somewhere
else. It is strongly recommended to put these files in a folder which is
not visible from the web! In the case above I would suggest somthing
like */webroot/apache/access*

We will create different files, so we can re-use them by adding a
symbolic link within the folder we want to secure:

::

   # cd /webroot/apache/typo3-dummy/fileadmin/webdav
   # ln -s /webroot/apache/access/typo3_be_users_only.txt .htaccess

An *ls -la* will show the link: *.htaccess ->
/webroot/apache/access/typo3_be_users_only.txt*

Example file for backend-users:
-------------------------------

So. Lets tell apache to authenticate the users using our newly created
views:

::

   # nano /webroot/apache/access/typo3_auth_be.txt

And fill the file with: (insert the correct MySQL settings of your Typo3
configs)

::

      # MySql Authentication on TYPO3 BackendUser-Table:
      AuthName "WebDAV Auth (Typo3)"
      AuthType Basic

      Auth_MySQL_Host localhost
      Auth_MySQL_Port 3306
      Auth_MySQL_Username typo3MySQLuser
      Auth_MySQL_Password typo3MysqlPassword
      Auth_MySQL_DB typo3MySQLDatabaseName

      Auth_MySQL_Password_Table v_be_usergroups
      Auth_MySQL_Password_Field password
      Auth_MySQL_Username_Field username
      Auth_MySQL_Group_Table v_be_usergroups
      Auth_MySQL_Group_Field groups

      Auth_MySQL_Encryption_Types PHP_MD5
      Auth_MySQL_Password_Clause " AND be_user=1"

      Auth_MySQL_Non_Persistent on
      Auth_MySQL_Empty_Passwords off
      
      AuthBasicAuthoritative Off     
      AuthUserFile /dev/null

      Auth_MySQL on

      require valid-user

      IndexOptions FancyIndexing FoldersFirst SuppressDescription NameWidth=* VersionSort

After you created the soft-link in your webdav folder accessing it via
WebDAV or directly via http:// in your browser should bring up the
authentication window. Every backend-user can login (require
valid-user).

Example file for frontend-users:
--------------------------------

::

      # MySql Authentication on TYPO3 FrontendUser-Table:
      AuthName "WebDAV Auth (Typo3 fe)"
      AuthType Basic
      
      Auth_MySQL_Host localhost
      Auth_MySQL_Port 3306
      Auth_MySQL_Username typo3MySQLuser
      Auth_MySQL_Password typo3MysqlPassword
      Auth_MySQL_DB typo3MySQLDatabaseName
      
      Auth_MySQL_Password_Table v_fe_usergroups
      Auth_MySQL_Password_Field password
      Auth_MySQL_Username_Field username
      Auth_MySQL_Group_Table v_fe_usergroups
      Auth_MySQL_Group_Field groups
      
      Auth_MySQL_Encryption_Types PHP_MD5
      Auth_MySQL_Password_Clause " AND be_user=0"
      
      Auth_MySQL_Non_Persistent on
      Auth_MySQL_Empty_Passwords off
      
      AuthBasicAuthoritative Off 
      AuthUserFile /dev/null
      
      Auth_MySQL on
      
      Require valid-user
      
      IndexOptions FancyIndexing FoldersFirst SuppressDescription NameWidth=* VersionSort

Example file for certain groups only
------------------------------------

The above files will authenticate backend or frontend users. If you want
to restrict access to a certain folder to a certain group you only need
to add another require line:

::

      # authenticate all users with an account:
      Require valid-user
      # restrict access to group named 'Members'
      Require group Members

If you have multiple groups for this folder:

::

      # allow access to groups 'Members' and 'Moderators'
      Require group Members Moderators

Example file for a public folders
---------------------------------

WebDAV is an extension to the HTTP. Normally browsers use GET requests
to retrieve all documents and images for your website. WebDAV introduces
more commands (methods) to HTTP.

WebDAV cannot be turned off for a subfolder with apache2. I would not
consider this a bug. So we need a little trick here too.

To allow browsers to read the files with no authentication we do not
restrict the standard HTTP methods GET and OPTIONS: create a file like

::

   <LimitExcept GET OPTIONS>
          require valid-user
   </LimitExcept>

and soft-link it to a *.htaccess* file (for example to allow public
access to your images or stylesheet folders).

| 
| For more information on WebDAV and its methods see

-  `WebDAV home <http://www.webdav.org/>`__
-  `Apache Mod Dav
   Docs <https://httpd.apache.org/docs/2.4/mod/mod_dav.html>`__

Enjoy :-)
=========

You should be ready to rock.

Questions and Feedback
======================

If you got some feedback or questions you may find my at
`typo3.net <http://www.typo3.net/forum/list/list_post//53197/?page=1>`__
[not available anymore] (I will watch that thread) or write something on
the discussion page (sorry no email, I'm some poor spam victim).

Some tools that allow mapping of a driveletter to the WebDAV folder
===================================================================

-  `Webdrive <http://webdrive.com/products/webdrive/index.html>`__
   (Shareware)
-  NetDrive (Novel), free but no longer available from Novel.

However you can still obtain a copy from either:

http://www.loyola.edu/5555/netdrive/installingnetdrive/

or:

http://downloads.lansa.co.uk/other/Novel%20Netdrive/ [not available
anymore]

If all else fails, give your searchengine a try

MS Office will allow you to open and save documents directly via
webfolders. Also eclipse has a WebDAV plugin.

Windows Vista
-------------

After several failures to get Windows XP to connect to a WebDav folder
with no help of third party tools windows Vista brings new features.
Vista by default will not allow unencrypted passwords to be sent, even
if the connection is SSL encrypted. So a registry change has to be made.
Go to:

::

   HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\WebClient\Parameters

and change the value of

::

   BasicAuthLevel

to "2". Then restart the pc (the setting will not be read until then).
If the key is not there create a new "DWORD (32-Bit)".

Once this is done a simple command will connect the folder to a drive
letter:

::

   net use w: http://webdav.yourserver.org/ [not available anymore] * /user:USERNAME

Choose any free driveletter instead of w. The "*" will ask you for a
password.

::

   net help use

Will write out some additional parameters for the command.

Relations
=========

**relating projects** (`edit
this <https://wiki.typo3.org/Template:NavigationContentRepository>`__
[deprecated wiki link], *in alphabetical order*)

-  `TYPO3 Neos Content
   Repository <https://wiki.typo3.org/wiki/index.php?title=TYPO3_Neos_Content_Repository&action=edit&redlink=1>`__
   [not available anymore]
-  maybe a relation to lib/div (can provide data for the `MVC
   Framework <mvc-framework>`__)
-  `DAM aka Digital Asset
   Management <https://wiki.typo3.org/wiki/index.php?title=Dam&action=edit&redlink=1>`__
   [not available anymore] - features advanced metatagging and
   categorisation of assets
-  `WebDAV <webdav>`__, `Apache2 Typo3
   WebDAV <https://wiki.typo3.org/Apache2_Typo3_WebDAV>`__ [deprecated
   wiki link] - client - needs meta data to render objects in a tree
   structure
