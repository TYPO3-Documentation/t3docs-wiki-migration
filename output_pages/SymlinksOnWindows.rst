.. include:: /Includes.rst.txt
.. highlight:: php

===================
Symlinks on Windows
===================

<< Back to `Installation basics <typo3-installation-basics>`__ or
`Windows <windows>`__

Introduction
============

Yes! Windows users can use symlinks too. For Windows versions NT, 2000,
XP and 2003 use Junction program to create symlinks. Windows 7, 2008 and
newer have their own program mklink.

Using mklink
============

You don't need to download anything. Program mklink is in your Windows.

In this example Apache web root directory is D:\wamp\www. Here we have
TYPO3 sources and developped sites.

::

   2013-02-24  17:46    <DIR>          typo3_src-6.0.2
   2013-03-06  21:36    <DIR>          typo3_src-4.5.24
   2013-03-08  09:07    <DIR>          www.client10.local
   2013-03-08  09:07    <DIR>          www.client11.local
   2013-03-08  09:07    <DIR>          www.client12.local

Now we will symlink client11 to TYPO3 version 4.5.24. This was done
using Polish version of Windows 7 but on other languages it looks
similar.

::

   d:\wamp\www\www.client11.local>mklink /d typo3_src ..\typo3_src-4.5.24
   łącze symboliczne utworzone dla typo3_src <<===>> ..\typo3_src-4.5.24

   d:\wamp\www\www.client11.local>mklink /d typo3 typo3_src\typo3
   łącze symboliczne utworzone dla typo3 <<===>> typo3_src\typo3

   d:\wamp\www\www.client11.local>mklink /d t3lib typo3_src\t3lib
   łącze symboliczne utworzone dla t3lib <<===>> typo3_src\t3lib

   d:\wamp\www\www.client11.local>mklink index.php typo3_src\index.php
   łącze symboliczne utworzone dla index.php <<===>> typo3_src\index.php

Note that making symlink to index.php we don't use "/D" parameter.

Let's check.

::

   2013-03-08  09:11    <DIR>          .
   2013-03-08  09:11    <DIR>          ..
   2013-03-08  09:08    <DIR>          fileadmin
   2013-03-08  09:11    <SYMLINKD>     t3lib [typo3_src\t3lib]
   2013-03-08  09:11    <SYMLINKD>     typo3 [typo3_src\typo3]
   2013-03-08  09:10    <SYMLINKD>     typo3_src [..\typo3_src-4.5.24]
   2013-03-08  09:08    <DIR>          typo3conf
   2013-03-08  09:08    <DIR>          typo3temp
   2013-03-08  09:08    <DIR>          uploads
   2013-03-06  12:08                46 clear.gif
   2013-03-06  12:08             4 599 _.htaccess
   2013-03-08  09:11    <SYMLINK>      index.php [typo3_src\index.php]
   2013-03-06  12:08             9 563 INSTALL.txt
   2013-03-06  12:08             8 558 README.txt
   2013-03-06  12:08               241 RELEASE_NOTES.txt

Done.

Using Junction
==============

Download program Junction [outdated link] written by Mark Russnovich
(formerly Sysinternals). Unpack into some directory on the system
variable PATH then you will be able to use it from any directory.

In this example Apache web root directory is D:\wamp\www. Here we have
TYPO3 sources and developped sites.

::

   2013-02-22  21:02    <DIR>          typo3_src-4.5.23
   2012-10-07  11:37    <DIR>          typo3_src-4.7.4
   2011-12-04  10:03    <DIR>          typo3_src-4.5.7
   2013-03-08  08:16    <DIR>          www.client1.local
   2012-06-23  18:07    <DIR>          www.client2.local
   2012-08-09  19:54    <DIR>          www.client3.local
   2011-11-30  22:29            21 237 index.php
   2010-12-31  09:40               190 testmysql.php

Now we will symlink client1 to TYPO3 version 4.5.23.

::

   D:\wamp\www\www.client1.local>junction typo3_src ..\typo3_src-4.5.23

   Junction v1.06 - Windows junction creator and reparse point viewer
   Copyright (C) 2000-2010 Mark Russinovich
   Sysinternals - www.sysinternals.com

   Created: D:\wamp\www\www.client1.local\typo3_src
   Targetted at: D:\wamp\www\typo3_src-4.5.23

   D:\wamp\www\www.client1.local>junction typo3 typo3_src\typo3

   Junction v1.06 - Windows junction creator and reparse point viewer
   Copyright (C) 2000-2010 Mark Russinovich
   Sysinternals - www.sysinternals.com

   Created: D:\wamp\www\www.client1.local\typo3
   Targetted at: D:\wamp\www\www.client1.local\typo3_src\typo3

   D:\wamp\www\www.client1.local>junction t3lib typo3_src\t3lib

   Junction v1.06 - Windows junction creator and reparse point viewer
   Copyright (C) 2000-2010 Mark Russinovich
   Sysinternals - www.sysinternals.com

   Created: D:\wamp\www\www.client1.local\t3lib
   Targetted at: D:\wamp\www\www.client1.local\typo3_src\t3lib

Let's check

::

   D:\wamp\www\www.client1.local>dir
   2013-02-22  21:06    <DIR>          fileadmin
   2013-03-08  08:16    <JUNCTION>     t3lib
   2013-03-08  08:16    <JUNCTION>     typo3
   2013-03-08  08:16    <JUNCTION>     typo3_src
   2013-02-22  21:32    <DIR>          typo3conf
   2013-02-22  21:06    <DIR>          typo3temp
   2013-02-22  21:06    <DIR>          uploads
   2010-10-06  10:39                46 clear.gif
   2010-10-06  10:39             5 548 _.htaccess
   2012-06-16  07:06               118 index.html

Now we have to copy index.php file to the client1 directory.

::

   D:\wamp\www\www.client1.local>copy typo3_src\index.php index.php

Done.

Using Winbolic
==============

If you don't like using the command line to create junctions, you can
use a graphical program called
`Winbolic <http://www.pearlmagik.com/winbolic/>`__ instead. Its GUI
makes it easy to navigate and create or remove NTFS junctions or shell
links.
