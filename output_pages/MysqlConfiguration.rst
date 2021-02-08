.. include:: /Includes.rst.txt

===================
MySQL configuration
===================

<< Back to `Installation
manual </Typo3_Installation_Basics#Before_you_start>`__ [deprecated wiki
link]

Introduction
============

This page contains some information about setting up MySQL and a new
database. Just the basics: prepare for installation, settings, rights
management.

Basic security steps
====================

The first thing to do after finishing your `MySQL </Category:MySQL>`__
[deprecated wiki link] `installation </Category:Installation>`__
[deprecated wiki link], is to protect it against unauthorized access.
This is absolutely neccessary, if you're sitting in front of a multiuser
system or you're on a network.

Set up a password for the MySQL admin
-------------------------------------

Password protection is always a good idea. The MySQL admin username is
*root*. You can easily set up the MySQL root password with mysqladmin.
Choose a good one ;-)

::

   spock@enterprise:/# mysqladmin password password

*[Note] mysqladmin doesn't prompt anything, if the password has been set
up successfully.*

Turn off TCP/IP listener
------------------------

If you do not want anyone to connect to your database from the network,
turn off the TCP/IP listener of MySQL. This is useful in most cases,
when the database and the webserver is on the same host. You can safely
use UNIX sockets instead.

First, check if MySQL is listening on TCP/IP (provided that the daemon
is running...)

::

   spock@enterprise:/# netstat -lp

There are two sections, one starting with "Active Internet connections"
and one with "Active UNIX domain sockets".

::

   Active Internet connections
   tcp        0      0 *:mysqld                  *:*                     LISTEN     3306/mysqld
   (...)
   Active UNIX domain sockets 
   unix  2      [ ACC ]     STREAM     LISTENING     228995971 27361/mysqld        /var/run/mysqld/mysqld.sock

If mysqld can be found in the first section, your MySQL daemon is
listening on TCP/IP.

How to turn it off?

-  stop mysqld (on Debian you can do this with /etc/init.d/mysql stop)
-  Insert the following line in /etc/mysql/my.cnf:

::

   skip-networking 

-  start mysqld (Debian: /etc/init.d/mysql start)

Prepare MySQL for the TYPO3 installation
========================================

Usually, you need to have a fresh database and a user before you
1-2-3-install TYPO3. Here's an example.

Set up a new database
---------------------

To create a new database, mysqladmin is our prefered tool:

::

   spock@enterprise:/# mysqladmin -u root -p create databasename

To authenticate as root, use your MySQL root password. That's all for
this step.

Set up a new mysql user
-----------------------

Use the mysql client to connect to the administration database:

::

   spock@enterprise:/# mysql -u root -p mysql

After typing the (MySQL) root-password, you're in the interactive mode
of the MySQL client. There's a prompt at the bottom of the screen. Now
setup a new user, which is allowed to connect to the new database via
localhost by typing:

::

   mysql> GRANT ALL ON databasename.* TO username@localhost IDENTIFIED BY 'password';

Remember those three values once the TYPO3 1-2-3 install tool will ask
for them. To get back to your shell, just type:

::

   mysql> quit

Then reload the grant tables:

::

   spock@enterprise:/# mysqladmin -u root -p reload

To see if everything went well, try to login to the DB:

::

   spock@enterprise:/# mysql -u username -p databasename

After entering the password, the mysql client should welcome your brand
new MySQL user.

Relations
=========

-  Project `Performance tuning <performance-tuning>`__

| 
| << Back to `Installation
  manual </Typo3_Installation_Basics#Before_you_start>`__ [deprecated
  wiki link]
