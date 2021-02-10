.. include:: /Includes.rst.txt

================
Hook programming
================

Using TYPO3 Hooks
=================

.. container::

   notice - Newer documentation available

   .. container::

      Since TYPO3 10, the core uses `PSR-14
      Events <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Hooks/EventDispatcher/Index.html>`__,
      see also `List of Core PSR-14
      Events <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Hooks/Events/Index.html>`__

.. container::

   error - This page is a candidate for deletion

   .. container::

      **Reason: No reason given**
      If you disagree with its deletion, please explain why at `Category
      talk:Candidates for speedy
      deletion <https://wiki.typo3.org/wiki/index.php?title=Category_talk:Candidates_for_speedy_deletion&action=edit&redlink=1>`__
      [not available anymore] or improve the page and remove the
      ``{{delete}}`` tag.

      This notice should remain for a minimum of 1 week after it was
      placed on the page. If a discussion is still ongoing, it should
      remain until a consensus is reached or a decision has been made
      about the removal, after which the page will either be deleted or
      this notice removed.

      Remember to check `what links
      here <https://wiki.typo3.org/Special:WhatLinksHere/Hook_programming>`__
      [not available anymore] and the `the page
      history <https://wiki.typo3.org/wiki/index.php?title=Hook_programming&action=history>`__
      [deprecated wiki link] before deleting.

For `extension <https://wiki.typo3.org/Category:Extension>`__
[deprecated wiki link] programmers.

Hooks are places in TYPO3 code where registered user-defined functions,
so called *callbacks*, are called..

Usage of a `hook <https://wiki.typo3.org/Category:Hook>`__ [deprecated
wiki link]:

#. Either the hook already exists in the core of TYPO3 and you can just
   register a callback.
#. Or it doesn't exist:

   -  Thus you should identify its position in the code and insert it so
      the hook can call your code.
   -  Then, as stated in 1., you register your callback.
   -  In order to have a hook become permanent, you'll have to justify
      its necessity and ask for its inclusion into the official TYPO3
      source code.

Hook references
===============

-  In *TYPO3 Core Engine*, a way too short hook description

   -  https://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/Hooks/Index.html

-  The extension dmc_hooklist (downloadable in TER) can show you a list
   of most of the hooks available.
-  https://typo3.org/documentation/article/how-to-use-existing-hooks-in-your-own-extension/
   [not available anymore] How to use

Registered hooks in your installation
=====================================

You will find all registered core hooks in
``$TYPO3_CONF_VARS['SC_OPTIONS']`` (check the backend module *Admin
tools->Configuration* for that).

You will find all registered hooks for extensions you will find in
``$TYPO3_CONF_VARS['EXTCONF'][ extension_key ][ sub_key ]``
