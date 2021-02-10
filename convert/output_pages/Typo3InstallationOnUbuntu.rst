.. include:: /Includes.rst.txt

============================
TYPO3 Installation on Ubuntu
============================

Just a few steps to a succesful **installation of TYPO3 6.2 on a pure,
freshly installed Ubuntu 14.04**:

Install TYPO3 package
=====================

Even if synaptic does not install the most recent version of TYPO3, it's
very useful to do a

::

   sudo apt-get install typo3

as all the necessary packages like apache, mysql, php, imagemagick,
etc... are installed too. Also, some useful other settings are made ...

Anyway, what's the problem is, that when using the package nowadays, in
/etc/typo3-dummy/apache.conf there is an alias "cms" defined. So a
directory named "cms" in /var/www is useless because the alias takes
precedence. For me it was the easiest way to choose another name for the
directory - say "content".

Configure Apache
================

With

::

   sudo gedit /etc/php5/apache2/php.ini 

open the config file of Apache. Add

::

   extension=mysql.so
   extension=gd.so

and change

::

   memory_limit = 256M 
   upload_max_filesize = 10M
   post_max_size = 10M

Configure MySQL
===============

During package installation you've been asked for a new mySQL admin
password. Use this now instead of youradminpassword to create a database
for TYPO3 - say the name for the db will be TYPO3:

::

   sudo mysqladmin -pyouradminpassword create TYPO3

Afterwards start the mysql command line with:

::

   mysql -u root -p

and grant all rights to a new user - say typo3 with password typo3:

::

   mysql> grant all privileges on TYPO3.* to typo3@localhost identified by 'typo3';
   mysql> flush privileges; 
   mysql> quit

Restart Apache
==============

::

   sudo /etc/init.d/apache2 restart

Import newest TYPO3 version
===========================

As mentioned, an older version is installed via synaptic. So you have to
get the latest one by yourself:

::

   cd /usr/share/typo3
   sudo wget https://prdownloads.sourceforge.net/typo3/typo3_src-6.2.26.tar.gz
   sudo tar xzf typo3_src-6.2.26.tar.gz
   sudo chown root:www-data -R typo3_src-6.2.26
   sudo chmod -R 775 typo3_src-6.2.26

The last two lines alter the owner information and access rights so that
apache can properly access the files.

Copy the package to www directory
=================================

Synaptic imports the package to /var/lib. We copy it to /var/www/content
(there is another way with an apache redirection but to me it seems
easier and clearer to copy it into the www directory):

::

   cd /var/www
   sudo mkdir content
   sudo cp -R -f /var/lib/typo3-dummy/* content

And we have to correct the symlink to the newest source:

::

   cd content
   sudo rm typo3_src
   sudo ln -s /usr/share/typo3/typo3_src-6.2.26 typo3_src

Also create a special file so the start of the install tool won't fail:

::

   sudo touch typo3conf/ENABLE_INSTALL_TOOL

Change owner and rights:

::

   cd ..
   sudo chown root:www-data -R content
   sudo chmod -R 775 content

Be aware NOT to use "cms" as this is an defined alias and any content
will be ignored by apache. Use "content" instead!

Installing a distribution
=========================

Congratulations, you've installed TYPO3. Access the Install Tool via

::

   http://localhost/content/typo3/install [not available anymore]

to set all the neccessary details (esp. database user, database name,
backend admin, backend password) as described elsewhere.

For testing and learning you can use the Introduction Package.

If accurately adhering to web standards is especially important to you
(e.g. as required for government bodies in the European Union), you
might want to try the Government Package.

Just choose the Distribution you'd like to use and hit "Install".
Clicking on

.. container::

   notice - Note

   .. container::

      The installation process of a Distribution can take a *long* time.
      On a current laptop I had to wait around 100 minutes for the
      introduction package to finish installing. Do not abort this
      process - be patient!

If you want to build your website from scratch, just go ahead without
using a Distribution. You can then start with a completely empty
installation of TYPO3.

You've done it
==============

Start the backend with

::

   http://localhost/content/typo3 [not available anymore]

to start implementing your breathtaking site ;-)
