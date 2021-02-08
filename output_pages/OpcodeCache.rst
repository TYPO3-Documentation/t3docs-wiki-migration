.. include:: /Includes.rst.txt

============
Opcode Cache
============

Introduction
============

An opcode cache is a system to cache the result of the PHP code
compilation to bytecode. This allows to use the bytecode instead of
compiling on every request. Different opcode cache systems are
available, mostly depending on used PHP version. `List of PHP opcode
cache
systems. <http://en.wikipedia.org/wiki/List_of_PHP_accelerators>`__
Every opcode cache system has its own pitfals, which we want to show
here, so you can configure your system as good as possible and to get
the message "This opcode cache should work correctly and has good
performance." in your TYPO3 installer. Opcode caching systems which
aren't listed here are not supported by TYPO3 CMS.

In general, PHP opcode caches can lead to a massive performance
improvement of bigger PHP frameworks like TYPO3 CMS and can be seen as a
must-have in professional production environments. All existing opcode
cache solutions give a similar performance gain, the differences are
insignificant. But the performance gain between using one and not using
a opcode cache can be a factor of 3 in typical TYPO3 CMS installations.
A well configured PHP environment on decent hardware usually delivers a
full cached TYPO3 CMS frontend page in around 50 milliseconds or less.
Enabling an opcode cache reduces this to 18ms or less! This gain is not
so big for pages that are not delivered from cache, since the actual
calculation time and database stuff has a bigger share than the compile
time of PHP scripts. Still, opcode caches can lead to a massive
performance gain and can make the website and the TYPO3 CMS backend more
snappy.

General opcode cache considerations
===================================

Using opcode cache in CLI
-------------------------

The implementation of opcode cache system is done by using Shared
Memory. This means only the same user from same process have access to
it. The options apc.enable_cli or opcache.enable_cli do not give the
ability to change/reset the opcode cache of the webserver. So for
example package installation via CLI can lead to problems on the website
as the opcode cache do not correlate to the new settings. This issue
isn't easy fixable and an outstanding
`issue <https://forge.typo3.org/issues/57258>`__.

(!) This issue applies to CLI scheduler tasks.

(!) Using ApcBackend, WincacheBackend, XcacheBackend as caching backend
in your TYPO3 CMS installation will lead to the same problem. You can't
change the data from the website.

Using PHP code on an NFS share
------------------------------

NFS Clients normaly are using a transparent cache to the server, so they
don't need to gather directory or file data and content every time. This
leads to the issue that the server do not see every change on the NFS
Server by deployings or in caches. This issue affects not only PHP and
the opcode cache, you need to have this in mind if you use such multi
webserver installations. Disabling the NFS caching resolves this issue,
but slows down your server systems. If you use an opcode cache on such
an installation makes the issue more worse and clearing the opcode cache
may not only help as the NFS Client cache may again deliver outdated
file content. This tends to throw funny issues like "class already
declared" on PHP file changes (eg. after deployment).

In general, it is often better to have all PHP code (typo3/, typo3conf/,
typo3temp/Cache) on local file systems deployed to the single servers,
than to share that on a network filesystem. While this strategy makes
deployment a bit harder, it usually improves performance and reduces
network load.

Also using other systems without the NFS caching issue like DRBD helps.

Opcode caches and PHP file changes
----------------------------------

In a perfect world, opcode caches are fully transparent. That means, if
PHP code is changed that is covered by an opcode cache, the opcode cache
detects this change and invalidates its cache entry of the file. This
works pretty well but it comes with overhead, since the opcode cache
needs to check change times on files on every request. If you need
maximum performance in production, disk load can be reduced by turning
those checks off. If PHP files are changed then, the opcode cache must
be explicitly hinted to invalidate its entries. Most opcode cache
systems default to stat file changes everytime, OPcache defaults to only
every 5 seconds, but this default behavior depends on your distribution.

Opcode caches and symlinked pathes/files
----------------------------------------

Especially APC before 3.1.13 have the issue to detect that a file is the
same one if included with a path which includes a symlink. This may lead
to the issue that it tries to include same class twice which leads to
the fatal error "class already declared". Also APC tends to the issue
that it doesn't clear his cache if you change a file by changing a
symlink, even if the usual file change detections are turned on, and
delivers old opcache data. This seems to happen frequently for double
linked directories, for example if typo3/ is a link to typo3-src which
themself is a link to typo3-src-6.2.4 (this strategy is often used for
nice deployments since it allows to activate a full build by just
changing exactly one symlink). If then typo3/index.php is requested, APC
sometimes struggles to detect those link changes and throws funny
issues. This issue was also reported with older versions of
ZendOptimizerPlus.

Opcode caches and amount of shared memory
-----------------------------------------

To fully benefit from opcode caching, it is important to give the opcode
cache enough shared memory to work with. Typical base configurations
give 32MB or 64MB of RAM, and that is usually not enough for a single
TYPO3 CMS instance. If not enough memory is left, the opcode cache needs
to throw out scripts, so those need to be compiled again if requested.
All opcode caches have some diagnoses scripts to monitor the amount of
used memory. It is advisable to monitor the memory usage and tune the
according memory setting until it fits needs.

Supported opcode caches by TYPO3 CMS LTS versions
=================================================

+----------------+----------------+----------------+----------------+
|                | 6.2 LTS (PHP   | 7 LTS (PHP     | 8 LTS (PHP 7.0 |
|                | 5.3.7 - 5.5.x) | 5.5.x - 7.0.x) | - 7.1.x)       |
+----------------+----------------+----------------+----------------+
| OPcache        | >=7.0.0        | >=7.0.0        | >=7.0.0        |
+----------------+----------------+----------------+----------------+
| APC            | >= 3.1.7       | No             | No             |
+----------------+----------------+----------------+----------------+
| WinCache       | >=1.1.0        | >=1.3.5.0      | No             |
+----------------+----------------+----------------+----------------+
| XCache         | >=1.3.0        | >=3.1.0        | No             |
+----------------+----------------+----------------+----------------+
| eAccelerator   | Yes, but not   | No             | No             |
|                | recommended.   |                |                |
+----------------+----------------+----------------+----------------+
| Zend           | >=6.0.0        | No, see        | No             |
| Optimizer+     |                | OPcache        |                |
+----------------+----------------+----------------+----------------+

What does the messages mean in installer
========================================

No PHP opcode cache loaded
--------------------------

You do not have an opcode cache system installed or activated. If you
want better performance for your website, then you should use one. The
best choice is APC for PHP version 5.3 and 5.4 or OPcache for PHP 5.5
onwards.

This opcode cache is marked as malfunctioning by the TYPO3 CMS Team.
--------------------------------------------------------------------

This will be shown if an opcode cache system is found and activated,
which is known to have "too much" errors and won't be supported by TYPO3
CMS and TYPO3 NEOS (no bugfixes, security fixes or anything else). This
will happen with:

-  APC before 3.1.7
-  eAccelerator

This opcode cache may work correctly but has medium performance.
----------------------------------------------------------------

This will be shown if an opcode cache system is found and activated,
which has some nitpicks. For example we cannot clear the cache for one
file (which we changed) but only can reset the complete cache itself.
This will happen with:

-  OPcache before 7.0.2 (Shouldn't be out in the wild.)
-  APC before 3.1.1 and some mysterious configuration combinations. See
   APC.
-  XCache
-  ZendOptimizerPlus

This opcode cache should work correctly and has good performance.
-----------------------------------------------------------------

Well it seems that all is ok and working. Maybe you can tweak something
more but this is out of our knowledge of your user scenario.

OPcache
=======

This opcode caching system comes mostly with your PHP 5.5 (or newer)
installation. It is derived from Zend Optimizer+ and maintained by the
PHP developers.

Never set
---------

Do not set opcache.save_comments and opcache.load_comments to false.
Some internet pages mention this speeds up the website, but the code
information which will be removed with this options is needed by Extbase
and Fluid and therefore for TYPO3 CMS and TYPO3 NEOS.

Optimization
------------

On live systems you can set the option opcache.validate_timestamps to
false to gain a speedup. This prevents the cache from looking up every
opcache.revalidate_freq seconds if there is a changed PHP file. If you
update your system or an extension you should use the "clear opcode
cache" button in the install tool to clear the complete opcode cache so
the new files will be used.

Please open an issue report if you experience issues with the
PhpCacheBackend and option opcache.validate_timestamps set to false.

APC
===

APC is the most used opcode caching system in the time of PHP 5.3/5.4.
It is more or less replaced by OPcache for PHP 5.5.

.. _never-set-1:

Never set
---------

Do not set apc.file_update_protection to something else then 0. If it is
set, APC will try to validate the age of the file we try to delete from
opcode cache. As a newly created file won't be older then 0 seconds this
will fail. So if this is configured we will clear the complete cache
instead of only the file.

Do not set apc.stat to 0 without setting apc.canonicalize to 1, else it
will use the code path of apc.file_update_protection and we will fail to
clear the cache of one file. So if this is configured we will clear the
complete cache instead of only the file.

.. _optimization-1:

Optimization
------------

On live systems you can set the option apc.stat to 0 to gain a speedup.
This prevents that the cache looks every time if there is a changed PHP
file. If you update your system or an extension you should use the
"clear opcode cache" button in the install tool to clear the complete
opcode cache so the new files will be used.

(!) You should also set apc.canonicalize to 1 else you will hit an issue
described above.

Please open an issue report if you experience issues with the
PhpCacheBackend and option opcache.validate_timestamps set to false.

WinCache
========

No issues reported yet.

XCache
======

.. _never-set-2:

Never set
---------

Do not set xcache.admin.enable_auth as this option isn't supported by
TYPO3 and so we can't clear the cache.

eAccelerator
============

The eAccelerator is very old and unmaintained. You should upgrade to a
newer version of PHP and use one of the opcode caching systems from
above.

Needed compile option
---------------------

The eAccelerator extension needed to be compiled with the flag
"--with-eaccelerator-doc-comment-inclusion" else we have no doc
comments. Some internet pages mention this speeds up the website, but
the code information which will be removed with this options is needed
by Extbase and Fluid and therefore for TYPO3 CMS and NEOS.

Zend Optimizer+
===============

.. _never-set-3:

Never set
---------

Do not set zend_optimizerplus.save_comments to false. Some internet
pages mention this speeds up the website, but the code information which
will be removed with this options is needed by Extbase and Fluid and
therefore for TYPO3 CMS and NEOS.
