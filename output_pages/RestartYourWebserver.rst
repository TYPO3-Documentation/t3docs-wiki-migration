.. include:: /Includes.rst.txt

======================
Restart your webserver
======================

.. container::

   error - This page is a candidate for deletion

   .. container::

      **Reason: Page is not TYPO3 specific, is outdated and the
      information can be found elsewhere, e.g. on Stack Overflow or on
      documentation pages for specific Webserver**
      If you disagree with its deletion, please explain why at `Category
      talk:Candidates for speedy
      deletion </wiki/index.php?title=Category_talk:Candidates_for_speedy_deletion&action=edit&redlink=1>`__
      [not available anymore] or improve the page and remove the
      ``{{delete}}`` tag.

      This notice should remain for a minimum of 1 week after it was
      placed on the page. If a discussion is still ongoing, it should
      remain until a consensus is reached or a decision has been made
      about the removal, after which the page will either be deleted or
      this notice removed.

      Remember to check `what links
      here </Special:WhatLinksHere/Restart_your_webserver>`__
      [deprecated wiki link] and the `the page
      history <https://wiki.typo3.org/wiki/index.php?title=Restart_your_webserver&action=history>`__
      [deprecated wiki link] before deleting.

======
Apache
======

Httpd
=====

.. _apache-1:

Apache
======

SuSE Distribution
-----------------

#. **Start** Apache with *rchttpd start*
#. **Shutdown** Apache with *rchttpd stop*
#. **Restart** Apache with *rchttpd restart*
#. **Get status** with *rchttpd status*

Apachectl
=========

#. Start - apachectl start
#. Stop - apachectl stop
#. Restart - apachectl restart
#. **Graceful Restart - apachectl graceful**

===========================================
IIS Microsoft's Internet Information Server
===========================================

As for the Apache server, there are several ways to start, stop and
restart Microsoft's Internet Information Server IIS.

DOS box
=======

Using a DOS shell you might start and stop any given services by simply
typing

``C:\ net stop "Service Name"``

``C:\ net start "Service Name"``

*Please note: ``Service Name`` is language dependent - you have to
figure out yourself what service name the IIS service has on your
system! Normally, ``w3svc`` is a good guess. A list with all service
names is displayed by simply typing ``net start``*

*Please also note: Use the double quotes if ``Service Name`` contains
whitespace!*

MMC (Microsoft Management Console)
==================================

The Management Console is meant for administrators and provides a
graphical interface for various server administration tasks. The MMC is
a general tool which can be customized for your needs. Customization
means that the administrator may load one or more so-called Snap-In's
into the MMC and save his configuration to a MSC file (Microsoft Common
Console Document).

#. Select Start, Run and type ``%systemroot%\system32\inetsrv\iis.msc``
#. This command opens the Microsoft Management Console MMC with the IIS
   Snap-In preloaded
#. Click on the Webserver you want to configure
#. Use the stop, start or restart button in the toolbar to control the
   service

inetmgr.exe
===========

Basically, this program is a shortcut for the MMC with the preloaded IIS
Snap-In.

#. Select Start, Run and type ``inetmgr``
#. Procede like in the MMC section

services.msc
============

services.msc is another way to control system services like the IIS

#. Select Start, Run and type ``services.msc``
#. This opens the MMC with the system services Snap-In pre-loaded
#. Locate the IIS service in the right window and single click it
#. Use the start, stop or restart button in the toolbar to control the
   service
#. Double clicking the service in the right window gives you additional
   configuration options:

-  Boot time start options
-  Service failure behaviour
-  ...
