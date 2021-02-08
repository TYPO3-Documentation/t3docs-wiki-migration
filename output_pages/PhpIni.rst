.. include:: /Includes.rst.txt

.. _php-ini:

=======
Php.ini
=======

{draft}

.. container::

   error - This page is a candidate for deletion

   .. container::

      **Reason: No reason given**
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
      here </Special:WhatLinksHere/Php.ini>`__ [not available anymore]
      and the `the page
      history <https://wiki.typo3.org/wiki/index.php?title=Php.ini&action=history>`__
      [deprecated wiki link] before deleting.

============================
How to find the php.ini file
============================

General
=======

The most simple and portable way to find the
`php.ini </Category:Php.ini>`__ [deprecated wiki link] file that's
actually being used is to use ``phpinfo()``.

Since there may be more than one file named ``info.php``, this avoids
the case where you edit a ``info.php`` that is not really used by PHP.

**Be aware that the settings in php.ini usually apply to all PHP
processes. You can configure this per vhost, but it requires manual
work. So whatever you do to your php.ini file, will apply to ALL other
apps, websites and projects that also run on this computer / server and
use the same PHP version.**

Howto
-----

Create a file in your web root (for example ``info.php``) with this
content:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      <?php phpinfo();

Now open this page in your browser, and look for the line
**Configuration File (php.ini) Path** in the first block of output
telling you which php.ini is loaded.

Unix
====

Using ``find``
--------------

You can use the find program to find all the ``php.ini`` files on your
system.

.. container::

   `Shell
   Script </wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      find / -name "php.ini"

Using ``locate``
----------------

You can use the locate program to find all the ``php.ini`` files in the
locate database (which may not always be up to date).

.. container::

   `Shell
   Script </wiki/Help:Contents#Syntax-Highlighting_for_shellScript>`__
   [deprecated wiki link]

.. container::

   ::

      locate php.ini

Conventional locations
----------------------

As with most configuration files, ``php.ini`` should reside in ``/etc``.

Gentoo
^^^^^^

Example locations:

-  /etc/php/apache2-php5.2/php.ini
-  /etc/php/apache2-php5.3/php.ini
-  /etc/php/cgi-php5.3/php.ini
-  /etc/php/cli-php5.3/php.ini
-  /etc/php/fpm-php5.3/php.ini
