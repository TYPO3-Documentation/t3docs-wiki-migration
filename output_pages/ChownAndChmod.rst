.. include:: /Includes.rst.txt
.. highlight:: php

===============
Chown and Chmod
===============

.. container::

   error - This page is a candidate for deletion

   .. container::

      **Reason: Information not TYPO3 specific, can be found elsewhere**
      If you disagree with its deletion, please explain why at Category
      talk:Candidates for speedy deletion [outdated link] or improve the
      page and remove the ``{{delete}}`` tag.

      This notice should remain for a minimum of 1 week after it was
      placed on the page. If a discussion is still ongoing, it should
      remain until a consensus is reached or a decision has been made
      about the removal, after which the page will either be deleted or
      this notice removed.

      Remember to check what links here [outdated wiki link] and the the
      page history [outdated wiki link] before deleting.

=====
Chown
=====

This is an important Linux [outdated wiki link] Linux shell-command
[outdated wiki link]. german-users: see the
`linuxwiki <http://linuxwiki.de>`__

Chown means **change owner** but it can do more than that. Let's look at
a directory listing that you get under a Linux/Unix/Mac OS X
distribution. As an example we use the TYPO3 source directory, here we
use the Debian installation example.

::

   cd /var/www/typo3/latest
    ls -l

The output looks something like this:

::

   -rw-r--r--     1 root      root      27015 May 11 15:14 ChangeLog
   -rw-r--r--     1 root      root      18007 May 11 15:14 GPL.txt
   -rw-r--r--     1 root      root        459 May 11 15:14 LICENSE.txt
   -rw-r--r--     1 root      root        647 May 11 15:14 Package.txt
   -rw-r--r--     1 root      root        403 May 11 15:14 README.txt
   -rw-r--r--     1 root      root      56300 May 11 15:14 TODO.txt
   drwxr-xr-x    16 root      root       4096 May 11 15:14 misc
   drwxr-xr-x     7 root      root       4096 May 11 15:14 t3lib
   lrwxrwxrwx     1 root      root         22 Jul  4 20:03 tslib -> typo3/sysext/cms/tslib
   drwxr-xr-x     1 root      root       4096 May 11 15:14 typo3

You see two columns with root. The first (from the left) is the owner of
the file or directory and the second is the group. In this case owner
and group is the same, therefore only root has any access to files and
directories.

Sometimes TYPO3 needs write access for the webserver to a certain file
or directory so that the webserver has write permissions.

In that case you'll have to change either the owner or the group to the
webserver. Most of the time you want to change the group to the
webserver and leave the owner root.

You change the group of the directory **typo3** to the webserver by
executing a chown.

::

   chown -R :www-data typo3

The -R means that you change a directory (typo3 is a directory) and the
colon indicates if you change the owner or the group. In our case, name
on the right of the colon, the group is changed. If you just wrote
www-data the owner would have been changed. You can, of course, change
owner and group at the same time (e.g. root:www-data).

Look at the line with the directory typo3 again:

::

   drwxr-xr-x     1 root      www-data   4096 May 11 15:14 typo3

Www-data is the webserver user of apache by default. Your user might be
different, that doesn't matter. Just make sure you change it to the
right owner or group when you need to.

The revert the change just type

::

   chown -R :root typo3

Chmod
=====
