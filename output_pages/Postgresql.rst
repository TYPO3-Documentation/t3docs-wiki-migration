.. include:: /Includes.rst.txt

==========
PostgreSQL
==========

What do I need for PostgreSQL?
==============================

.. _postgresql-1:

PostgreSQL
----------

TYPO3 makes use of a few features only found in `PostgreSQL
9.0 <http://www.postgresql.org/>`__ and newer. It is recommended that
you use the latest released major version. You can install the
PostgreSQL DBMS package included in your Linux Distribution, use one of
the `pre-built binary packages <http://www.postgresql.org/download/>`__
provided by the PostgreSQL team or use the EnterpriseDB provided
`downloads <http://www.enterprisedb.com/products-services-training/pgdownload>`__.

PHP
---

PHP 5.5+ with support for PostgreSQL. All major Linux distributions
include the required drivers, as should
`MAMP <https://www.mamp.info/en/>`__ and
`XAMPP <https://www.apachefriends.org/index.html>`__.

TYPO3
-----

It is advised to use the latest development master as a lot of work is
happening on the `DBAL <https://wiki.typo3.org/Category:DBAL>`__
[deprecated wiki link] at the moment. If you need to use released
version TYPO3 7.3 or later is advised.

How do I configure my system
============================

.. _php-1:

PHP
---

You must install at least one of these extensions by adding them to your
php.ini.

-  pgsql
-  pdo_pgsql

e.g.

Unix:

::

   ; configuration for php PostgreSQL module
   extension=pgsql.so
   extension=pdo_pgsql.so

Windows:

::

   ; configuration for php PostgreSQL module
   extension=php_pgsql.dll
   extension=php_pdo_pgsql.dll

.. _typo3-1:

TYPO3
-----

The current installer supports using the
`DBAL <https://wiki.typo3.org/Category:DBAL>`__ [deprecated wiki link]
during first install. Most
`PostgreSQL <https://wiki.typo3.org/Category:PostgreSQL>`__ [deprecated
wiki link] installations are set up to connect using a TCP/IP network
connection with user authentication, if you can't connect using the
socket it is advisable to switch the connection type.

.. _postgresql-2:

PostgreSQL
----------

The database should be create with a UTF-8 collation, for example by
using the following command: **createdb typo3 -EUTF-8**. After the
database has been created the MySQL compatibility operators need to be
installed. The necessary SQL dump is included with the TYPO3 source and
can be found at
**typo3/sysext/dbal/res/postgresql/postgresql-compatibility.sql**.

Development
===========

For core development and reviewing patches a
`box <https://github.com/yabawock/packer-typo3>`__ for
`Vagrant <https://www.vagrantup.com/>`__ can be used. To get started use
the following **Vagrantfile**:

Create a Vagrantfile
--------------------

::

    Vagrant.configure(2) do |config|
      config.vm.box = 'mojocode/typo3'
      config.vm.box_url = 'http://vagrant-boxes.mojocode.de/typo3/' [not available anymore]
      config.vm.box_version = '~> 1.0'
      config.vm.box_check_update = true
      config.vm.network 'private_network', ip: '192.168.144.120'
      config.vm.synced_folder 'Web', '/var/www'
      config.vm.provider 'virtualbox' do |vb|
        vb.memory = 2048
        vb.cpus   = 2
      end
    end 

Install TYPO3 sources
---------------------

Add a TYPO3 first install setup in a subdirectory called **Web** in the
same directory where the Vagrantfile is.

Provision the virtual machine
-----------------------------

::

    $ vagrant up
    

Create a database
-----------------

::

    $ vagrant ssh
    $ createdb typo3 -EUTF-8
    

Perform TYPO3 first install
---------------------------

Open http://postgresql.local.typo3.org/ [not available anymore] in your
browser and configure TYPO3 with PostgreSQL.

**Database connection parameters**

::

   Parameter                     | Value
   _________________________________________
   User                          | vagrant
   Password                      | vagrant
   Host                          | 127.0.0.1
   Port                          | 5432
   Database                      | typo3
