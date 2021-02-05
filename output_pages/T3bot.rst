.. include:: /Includes.rst.txt
.. highlight:: php

=====
T3Bot
=====

General information about Slack: Slack [outdated wiki link]

Hi, I am Botty
==============

I am in some channels on `slack <http://typo3.slack.com>`__, feel free
to invite me into your channel.

Commands
========

-  **@botty help**: shows global help

Review Command
--------------

I can talk with `review.typo3.org <https://review.typo3.org>`__ try the
following commands:

command prefix: **review:**

-  **review:help**: shows this help
-  **review:count [PROJECT=Packages/TYPO3.CMS]**: shows the number of
   currently open reviews for [PROJECT]
-  **review:random**: shows a random open review
-  **review:show <Ref-ID> [<Ref-ID-2>, [<Ref-ID-n>]]\***: shows the
   review by given change number(s)
-  **review:user <username> [PROJECT=Packages/TYPO3.CMS]**: shows the
   open reviews by given username for [PROJECT]
-  **review:query <searchQuery>**: shows the results for given
   <searchQuery>, max limit is 50
-  **review:merged <YYYY-MM-DD>**: shows a count of merged patches on
   master since given date

Forge Command
-------------

I can talk with `forge.typo3.org <https://forge.typo3.org>`__ try the
following commands:

command prefix: **forge:**

-  **forge:help**: shows this help
-  **forge:show <Issue-ID>**: shows the issue by given <Issue-ID>

Util Command
------------

command prefix: **util:**

-  **util:help**: shows this help
-  **util:coin <options>**: coin toss with <options> (separate by comma)

Beer Command
------------

I can give someone a beer, try the following commands:

command prefix: **beer:**

-  **beer:help**: shows this help
-  **beer:stats <username>**: show beer counter for <username>
-  **beer:for <username>**: give <username> a T3Beer
-  **beer:all**: show all beer counter
-  **beer:top10**: show TOP 10

Tell Command (Private Message Service)
--------------------------------------

I can tell someone about a review, issue or simple send a message. The
idea is to deliver a notification to the user, if the users online
status change to active. To use this feature, send me **direct
message**:

-  **/msg @botty tell <@username> You are a very nice person :)** I will
   send <@username> the message: "You are a very nice person :)" after
   the user is online again the next time.
-  **/msg @botty tell <@username> about review:12345** I will send
   <@username> a message with details about the gerrit review 12345.
-  **/msg @botty tell <@username> about forge:12345** I will send
   <@username> a message with details about the forge issue 12345.

**This feature works only, if you talk to me in a direct chat!**

Gerrit Hooks
============

Gerrit talk to Botty on merged patches and new pushed patchsets. In this
cases, Botty sends a notification to the following channels:

+---------------------+-----------------------------------------------+
| Channel             | Notification, Description                     |
+---------------------+-----------------------------------------------+
| #typo3-cms-coredev  | Notification for merged patches               |
+---------------------+-----------------------------------------------+
| #cms-ad-hoc-reviews | Notification about new patchsets, but only    |
|                     | the first patchset                            |
+---------------------+-----------------------------------------------+
| #rst-updates        | Notification about added, deleted and changed |
|                     | rst files                                     |
+---------------------+-----------------------------------------------+

Wishlist
========

Please create an issue on
`github <https://github.com/NeoBlack/T3Bot/issues>`__.

Links
=====

-  `Homepage of Botty <http://www.t3bot.de>`__
-  `Github repository <https://github.com/NeoBlack/T3Bot>`__
-  General information about Slack: Slack [outdated wiki link]
-  `Register for Slack <https://my.typo3.org/about-mytypo3org/slack/>`__
