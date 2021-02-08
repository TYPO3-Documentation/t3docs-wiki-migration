.. include:: /Includes.rst.txt

======
Backup
======

.. container::

   **Content Type:** `HowTo </Category:HowTo>`__ [deprecated wiki link].

How to backup a TYPO3 installation
==================================

Introduction
------------

With the following steps it is possible to back up and to restore a
TYPO3 installation. Since restoring also is possible on a *different*
server, this guide can also be used to move an installation to a new
server.

Creating the backup
-------------------

Backing up the files
^^^^^^^^^^^^^^^^^^^^

First log in into the server using SSH and change into the directory, in
which TYPO3 is installed.

::

    cd /path/to/your/installation

If possible, for improved safety, stop the Apache webserver.

::

    /etc/init.d/apache stop

Now create an archive of the folder using tar and compress the result
with gzip. In this example, we expect TYPO3 to be installed in the
subfolder cms/.

::

    tar czvf typo3_backup.tar.gz cms

Now this file can be copied to the new server, e.g. using SCP or
"manually" using SFTP/FTP.

Backing up the MySQL database
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Now we back up the MySQL database using the mysqldump tool.

::

    mysqldump -h {host} -u {user} -p{password} {databasename} > typo3_db.sql

(Note: There is *no* space between the -p and the password!)

Now you can copy the file typo3_db.sql to the new server.

Restoring from the backup
-------------------------

Restoring the files
^^^^^^^^^^^^^^^^^^^

First log in to the server using SSH. :-) Then change to the directory,
into which you want to install TYPO3. This directory depends on system
and webserver settings. If possible, for improved safety, the webserver
should be stopped. Now unpack the tar archive to get your files back.

::

    tar xzvf typo3_backup.tar.gz

Restoring the MySQL database
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Now to the database. :-) We first create a new database user and grant
rights *for only this database* to that user. Then we create this
database and fill it with the contents of the database dump.

First, log in to MySQL with the MySQL root account. (The password of the
MySQL root account is not necessarily identical to the password of the
*local* account!)

::

    mysql -u root -p{password}

Now we use the GRANT command to create a new MySQL user and to give him
rights for our new database.

::

    GRANT all privileges on {databasename}.* to {username}@localhost identified by '{password}';
    quit;

Now we log in with the new MySQL user and create the database.

::

    mysql -u {username} -p{password}

Creating the empty database.

::

    create database {databasename};
    quit;

Now we use the mysql command to fill the database with the content of
our dump file.

::

    mysql -u {username} -p{password} {databasename} < typo3_db.sql

| 
| Now we only have to start our webserver again and TYPO3 should be
  working.

Adjustments in TYPO3
^^^^^^^^^^^^^^^^^^^^

We possibly have to adjust the database credentials in TYPO3. That can
be done in the Install Tool, in section Important Actions.

Helpful Links
-------------

-  `7 Best TYPO3 Backup Extensions: How to Backup TYPO3
   Site <https://t3terminal.com/blog/typo3-backup/>`__
