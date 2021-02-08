.. include:: /Includes.rst.txt
.. highlight:: php

================
Operating System
================

.. container::

   notice - This information is outdated

   .. container::

      While some details may still apply in specific situations, this
      page was written for packages of TYPO3 that are no longer current.

=====================================================
The differences when running TYPO3 on Windows or Unix
=====================================================

This list is a collection of good reasons why Windows is not optimized
for running a webserver, with or without TYPO3. note: This page is not
complete and not all arguments are reasonable or even correct. Read this
page with a wink. I would like to suggest to test the opionions on this
page by yourself to see how it works in real-world.

Historical reasons
==================

Every software component which is required by TYPO3 (including TYPO3
itself) were originally concepted/developed for Unix systems. Windows
compatibility came later and is often botch.

Logging / AWstats
=================

It is not yet possible to create logfiles with TYPO3 that can be used by
AWstats.

Hint: Will be solved in TYPO3 3.8.0

Indexed search can not index external files (PDF, DOC, etc.)
============================================================

You are wrong here, TYPO3 on Windows **can** index external files...
--Clonedyke [outdated wiki link] 16:54, 3 Mar 2005 (CET)

@Clonedyke: I've just seen on mailing lists that this seems not possible
for many people. Maybe a link would be good. --stucki [outdated link]
09:44, 7 Mar 2005 (CET)

No symlinks possible
====================

Symbolic links [outdated wiki link] (symlinks) offer a great possibility
to solve redundancies inside of TYPO3.

Hint: There is a solution called `Junction <symlinks-on-windows>`__
which offers something like symlinks on Windows, however file junctions
are not an integrated solution (but directory junctions are) and
requires an NTFS file system:
http://www.sysinternals.com/ntw2k/source/misc.shtml#junction [outdated
link]

Logfile sizes
=============

There is no tool like logrotate which compresses/deletes logfiles after
a given time.

Clonedyke [outdated wiki link] writes: Apache/IIS are providing
logrotate tools.

File system properties
======================

With Windows NTFS you must defragment your partitions regularily or they
will become slow. Defragmentation under Windows will work only if you
have at least 15% free space on your partition. So you maybe must delete
files before you can start the defragmentation of the files. With UNIX
Filesystems this is not necessary. And on Unix you can choose among a
lot of filesystems even over a network NFS as if they would be on your
local computer (mount the filesystem under a path name of your choice).
You only need to enter the full path containing the server name in the
/etc/fstab file. Under Windows you can use only NTFS or FAT32 from your
local computer. If you want to use the filesystem of another computer
under Windows you need always to use the full name containing the server
name to access the file system.

Security / ImageMagick
======================

(Can someone confirm this?) On a Windows server you have to grant access
to cmd.exe for the IIS in order to use ImageMagick (which is needed for
graphics generation). That is something most administrators won't feel
comfortable with ...

Security
========

On Linux you can build chroot jails for every service, vhost, site,
whatever and allow only shell commands you want to. You can even install
UML (User Mode Linux) or Xen as a system within a system which will then
be on a separate /dev with it's own root system. On Windows you need
extra software to get such security features. All the internet traffic
can get filtered in the Linux kernel with iptables. And you can run
Linux under different security levels of the kernel.

Software configuration
======================

Let's be honest: Why would you want to use Windows? I guess the reason
is mostly that you don't want to learn how to edit config files and
prefer to use the mouse for this.

But there is one thing to consider: Apache, PHP and MySQL are configured
exactly the same way on all platforms. So although you see a mouse you
can still not use it for configuring your server.

However, Linux servers can still be easily configured remote by the
webmin tool which gives you a graphical environment to configure your
webserver with any webbrowser. To configure a windows server you need to
have local access or must buy extra software for remote configuration.
Maybe there are more tools that do the same but bottomline is that this
doesn't turn out to be a cause to use Windows anymore.

[Impi writes:]Terminal Client (Remote Desktop) is included in Windows
Server OS for administrative purposes and can be bought as commercial
products.

Logs / Details
==============

Linux really babbles a lot in it's logs, and they tell you everything.
After Googling you know what to do to solve it, and since it has an open
architecture you can really edit anything. On Windows, everything is
packed into .dlls and .exes so you have to depend on the manufacturer to
release patches. Which usually they do pretty rarely.

What information do you miss in Windows' logging facility? Have you ever
configured logging for your needs and are you able to do so? --Clonedyke
[outdated wiki link] 17:02, 3 Mar 2005 (CET)

Software installation
=====================

On Linux you can install new software with graphical tools or the
command line tools 'rpm' and 'apt-get'. In many cases you just have to
copy the program and data files to your server. You only need to restart
some services afterwards. The software can be freely downloaded and
updated from a lot of Internet mirrors. You only have to restart, when
you want to change your kernel version.

On Windows you often have to restart your computer after the
installation of new software. You can only start Windows software when
there is an entry in the Registry Database for the application. When the
registry entry has been deleted, you have to reinstall the application
again. To install new Windows software you must in most cases insert a
CD in your CD drive and type in licence numbers. This will get
difficult, if the server is not located at your office. And it is very
difficult to automate this process.

Bolson [outdated link] 00:04, 15 Mar 2005 (CET)

Not entirely correct. If your Windows server installation is made after
the book, you don't need any CD's. And there is no problem with
rebooting from an distance. In two years I have probably restarted my
server 8 to 10 times after installation of software upgrades and
installation. How do you think organisastions with 70 - 100 windows
servers are doing it.

Every time after makeing an update to Windows 2000 Professional it tells
me that I have to restart the computer. And even if I want to change to
Windows XP Professional I would have to reinstall all the software and
drivers. Or is this wrong?

Wrong. I upgraded from 2000 to XP and didn't reinstall anything.

You can run Windows services linked to a user and not as "system".

If you stop a service before upgrading, you generally don't have to
reboot. Many times you will be asked to reboot, but it's not necessary.

I have found there are more similarities between Linux and Windows once
you put a GUI in front of Linux than differences. I think some things
are unnecessarily difficult (i.e. sendmail config) than need be.

If you have a system crash, you can make an update installation with the
Install-CD to repair your system under LINUX to make your system
applications work again. Under Windows 2000 you can try to use your
security floppy, but if this does not help you must make a fresh install
together with a new installation of every software.

Personalised Operating System
=============================

Under linux you can compile your own kernel, which means that you can
adapt the operating system to your needs and your hardware. You cannot
adapt and compile your Windows OS. After the startup of your computer
you can choose among different Linux kernel versions. This advantage
means that in case of a driver problem or after an error coming with a
system update you can change to another kernel version without
deinstallation of the other kernels.

Naming of partitions
====================

| If you build a new harddrive into your Windows 2000 computer, the
  names of your partitions are changed automatically. This is bad,
  because all the installation is done via the system registry database,
  which is very hard to edit. So some of the already installed programs
  might not work any more or a special reparation of your Windows 2000
  system will become necessary.The same problem will occur when you
  remove a harddrive or create new primary partitions.
| Under Linux you do not have this kind of difficulties. Linux does
  never change itself the name under which a partition has been named
  which means mounted. If you use an external tool to resize partitions
  and create new ones among them, you just have to edit the file
  /etc/fstab. And under Linux you can rename more than one partition in
  one step via a script. There is not script command for this in
  Windows.

Multi User
==========

On a Unix machine multiple user can log in via a terminal program and
execute any programs on the server simultaneously. On a Windows machine
only one person can log in at one time.

user and administrator
======================

The Unix machine usually runs with the permissions of a simple user.
When you have to work on it as an administrator, you open a command
shell and change only this to root priviledges. A Windows server instead
has to run always with the rights of an administrator or your have to
log out and log in as an administrator for configuration work. But some
programs will stop running when someone logs out. This is also a
security issue.

Recovery after the Change of Hardware
=====================================

| When you have a big hardware damage and you must change the
  motherboard of your computer you will probably have to buy a new
  processor and another motherboard because you cannot buy the one you
  had before. The LINUX system will autoinstall the needed drivers after
  having started the computer for the first time after the change the
  motherboard. However when you start the Windows 2000 system you will
  end up in a blue screen. This means that you will have to reinstall
  all your software again under Windows 2000.
| The same problems with Windows 2000 you will get when you only want to
  upgrade your current system to other hardware.
