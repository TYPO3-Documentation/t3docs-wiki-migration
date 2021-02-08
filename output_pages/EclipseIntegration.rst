.. include:: /Includes.rst.txt

===================
Eclipse Integration
===================

<< Back to `Projects </Projects>`__ [deprecated wiki link] page

`[edit] <https://wiki.typo3.org/wiki/index.php?title=Eclipse_Integration&action=edit&section=0>`__
[deprecated wiki link]

.. container::

   notice - This information is outdated

   .. container::

Summarize all features / plugins that are needed for the whole
development process with Eclipse. The idea is a 100% use of Eclipse for
development work if a developer wants to use it.

-  `Eclipse </Category:Eclipse>`__ [deprecated wiki link] Core
-  Eclipse Web Tools Project
-  PHPEclipse or Xored TruStudio Foundation

| 
| Current Eclipse Integration Project Page:
  `dev3.org <http://www.dev3.org/>`__ [not available anymore]

Debugging on the Mac with PHPEclipse
====================================

**NOTE: This guide is for somewhat older versions of PHP and dbg. New
sources for dbg are available, but the instructions shouldn't differ too
much.**

On my Mac the dbg binaries are:
/Library/WebServer/Documents/typo3/typo3conf/ext/ and the file is
/pi1/class.tx_cwtcommunity_pi1.php or similar. Both combined should give
you the absolute path to your php file that you want to debug.

Now, let's get started with `Mac OS X </Category:Mac_OS_X>`__
[deprecated wiki link]: You can use the Apache that comes with every Mac
and the PHP (5.0.4, 5.0.5 should work fine, too) and mysql binaries from
entropy.ch. I downloaded the mac binaries for mysql from the mysql
website and it worked fine. Now, download the PHP 5.0.5 source (I used
5.0.4, so these directions work for this version for sure, there
shouldn't be a problem for 5.0.5 though) from the PHP website and untar
it to your Desktop or anywhere else. I will assume it's some folder on
the Desktop. Now, make sure you have the developer tools installed so
you can compile stuff. Go to the terminal, change to the php folder on
your desktop, and configure php with the default options.

.. container::

   `Shell
   Script </wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

       ./configure --prefix=/Users/Christoph/Desktop/phpbinary/ --without-mysql
       make
       make install

You might have to use sudo if you get some permission denied errors. Now
you have some basic PHP binaries that you can compile dbg with. Download
the dbg source module (no need to get the CLI version) from
http://dd.cron.ru/dbg/downloads.php [not available anymore]. Untar into
some folder on the Desktop. Return to your terminal and change into the
just created folder with the dbg source in it. You need to change the
deferphpize script now to make it work. Don't worry, it's not too
complicated. Open the script in your favorite text editor. One of the
first lines points to the phpize binary. Change that path from

.. container::

   `Shell
   Script </wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

       phpize=${phpize:-"/usr/local/bin/phpize"}

to

.. container::

   `Shell
   Script </wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

       phpize=${phpize:-"/Users/christoph/Desktop/phpbinary/bin/phpize"}

Now, there are some switch case statements that check for the platform
used. Mac isn't included, so you need to change two lines: Around line
22, change:

::

   Linux|SunOS)

to

::

   Linux|SunOS|Darwin)

and again close to the end, change:

::

   Linux)

to

::

   Linux|Darwin)

You pretty much let the script to the same thing it would do on Linux.

Now run ./deferphpize and it should create a dbg.so file in your dgb
source folder in a subfolder called modules. Copy that file to your PHP
extension dir (it tells you that directory on the phpinfo page. It might
not be defined in the entropy.ch binaries, just change it in
`php.ini </Category:Php.ini>`__ [deprecated wiki link] to whereever you
like. I have mine in /usr/local/php5/ext/. The rest of the instructions
are the same as outlined in the phpeclipse wiki, see above for a link.
You can now delete the dbg source folder, php source folder and binary
folder from the Desktop, together with all the downloaded files if you
want. I saved an extra copy of dbg.so in my Documents folder, in case I
should need it later.

I hope these instructions help you guys to get debugging to work in
Eclipse with phpeclipse on the Mac.

Debugging on Windows with PHPEclipse
====================================

For Windows use, there are very good instructions available on the
`phpeclipse wiki <http://www.phpeclipse.com/>`__ [not available
anymore]. Make sure to use the latest version, 1.1.8. The dbg binaries
for Windows are said to work under PHP 5.0.5 and 5.0.4 and earlier using
the dbg binaries for 5.0.3. I am using 5.0.4 I think and all works well.
Also, the most common reason for breakpoints not working even though
DebugBreak() does, is a wrong remote sourcepath. Make sure it's correct.
