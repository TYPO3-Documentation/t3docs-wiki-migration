.. include:: /Includes.rst.txt
.. highlight:: php

======================
Webspace vs. Webserver
======================

<< back [outdated wiki link]

=================
What is Webspace?
=================

Webspace is the most commonly used synonym for shared webspace or shared
webserver. It basically means that you are running your website on a
server that is shared with other websites – sometimes hundreds. It is
also used as a term exclusively for people who don't have their own
infrastructure and rent that space on an external server.

You could be a webdesigner who provides that service to a customer. You
could also make a business by selling those webspaces directly to end
user (customer) or webdesigners, agencies etc. but instead of investing
in an infrastructure yourself you rent severeal webspaces from a hoster
as a reseller. Regardless if you are reselling webspaces or renting one
webspace directly from the hoster, every website is set up in its own
space that you normally connect to with ftp to upload your website. Only
within that space you have the freedom to up- and download and run
scripts (sometimes only in one preconfigured directory). The rest of the
webserver is unavailable to you since there are other customers (from
the hosters point of view) running their website on and as you want some
privacy. As an example we could use the directory structure of a
webserver to show how webspace works, e.g. the root directory of a
webserver on Debian linux is

::

   /var/www

If you are familiar with windows just imagine a directory called

::

   c://documents/webserver/

In the case of one customer renting one webspace on that webserver he
would have his own directory, e.g.

::

   /var/www/web123

Web123 would be created by an administration programm running on the
webserver (e.g. Confixx) that automatically allocates a space and unique
identifier. Within that directory this customer can upload his website
and run it. What he cannot do is access anything outside his allocated
space. In the case of the reseller it works the same way. The reseller
creates a new web by given the administration programm the information
to set up a new web. In comparison with the customer with only one
website, the reseller has additional configuration possibilities to
handle severeal websites. He can of course access all the webs that were
created with his account.

Normally resellers buy a certain amount of webspaces. You can have
webspaces as low as 10 or 15 up to 50 etc. That's why resellers are
often webdesigner, web agencies, that want to work with a enviroment
they are used to.

==================
Webspace and TYPO3
==================

Important for TYPO3 is the fact that regardless if you are a reseller or
rent a webspace directly from a hoster, you don't have root access to
your webserver where your webspace is running on. As mentioned above you
are only allowed inside your specific directory and you have no
influence on the kind of installation that is done on the webserver your
webspace is set up.

Outdated installations
======================

What happens is that because sometimes there are several hundred
websites running on one webserver the hoster is hesitating to upgrade
even the simplest installations like PHP and MySQL to a more current and
stable version. This is because it has happened that after upgrading
several websites wouldn't run anymore because of incompatibilities and
quite often just bad programming.

To get a hoster to upgrade even one step up on your current PHP version
is going to be tough. It also has been known that the same hoster,
running different webservers, has updated one webserver but not the
other one(s). That's what you see in endless forum discussion – and
sometimes in the mailinglist of TYOP3 too – when you read something like
this: I don't know why you have a problem, it's working just fine with
me, you must do something wrong... Just to find out that one website is
running on webwerver20 with the updated versions and the other one on
webserver3 with outdated installations.

Memory
======

The other issue that arises with TYPO3 is the memory for PHP. In most
cases with webspaces it is set up to 8 MB. Current TYPO3 version
recommend 25 MB and more. People find it the hardest to convince their
hoster to increase memory usage as it affects all the webspace users.

ImageMagick and others
======================

TYPO3 uses several tools among which ImageMagick is hardly ever
installed on webspace servers. Again, in order for you to install
ImageMagick you need root access or special permission to do so within
your webspace.

There is light at the end of the tunnel
=======================================

Regardless of many problems that can arise with webspace there are more
and more hosters who become aware of TYPO3 and are willing to set up the
webserver for an appropriate use. The problem here is if you are
accostumed to one hoster that doesn't provide TYPO3 support you end up
switching to one that does and either have to handle two or more hosters
or eventually switch all your websites to the one that does.

==================
Your own webserver
==================

A far more flexible solution is to have your own webserver. Naturally
there with more freedom comes more responsibilities that can be
overwhelming if you're not familiar with LAMP, WAMP, MAMP (Mac OS X,
Apache, MySQL, PHP) etc.

Still, you might want to find out if your hoster that runs your
webspace, assuming you are renting one or are a reseller, also provides
webservers to rent. If you are considering renting a webserver you might
want to read the next chapter. I'll share our experience with hosting,
starting five years ago and how we progressed through the different
stages. For right now, just some information in a nutshell.

Power
=====

One really good thing about a webserver is that you don't always need
the latest and best hardware. Especially with Linux even older computers
serve the websites in accurate speed. Considering that most websites
don't have a lot of user access you can even afford a few high traffic
websites on the same server.

Service contract
================

It might be valuable for you to get a service contract, especially in
the beginning. Ask for the specs on the service contract to find out
what it includes. In most cases it will something like

-  Security updates
-  Major udpates of the operating system
-  Major updates of your adminitration programm (X-Unitconf, Confixx
   etc)
-  Little help here and there with the configuration or installation of
   modules etc.
-  Free e-mail support.

You will be still responsible for the management of the server, upgrade
to newer version (minor, bug fixes) of your modules and especially the
backup.

Managed server
==============

This certainly is the top of the class maintenance you can get from a
external hoster. Saying it with the words of my hoster: Your server is
like one of our own. They take care of everything. If there is a crash,
they take care of it. If something is broken, they take care of it. If
your server is down they run faster than you can say: 'My server is
down'.

Of course such a service is pricy and as my hoster adivces, safe the
money, have a service contract and if something happens, pay the labor.
If you trust your hoster, listen to him. His experience with his
equipment is the key to a good running webserver.

Backup
======

Although very important, hosting providers tend not to care so much
about backups, at least if it's not their own server.

One way to have a bit more security if you rent a webserver is to have a
second harddisc installed and a backup program set up on the server.
Don't think that your hosting provider takes care of it by himself. Ask
him and invest the money. It's worth it.

============================
Your own webserver and TYPO3
============================

With root access you'll have the whole system to yourself and therefore
no problem to install anything you want. Yet, as being responsible for
your webserver more than with webspace you might need help and actually
ask for it just to make sure you keep your webserver secure. Ripping a
hole in your system is just too easy, especially if you're not a server
specialist. Have a professional by your side. That can be a techy that
works for your hoster or somebody external you know. Consider the fact
that they need root access if they really should be able to help you.
You have to lay the whole system open to them.
