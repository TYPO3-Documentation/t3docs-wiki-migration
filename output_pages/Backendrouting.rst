.. include:: /Includes.rst.txt
.. highlight:: php

=========================
Blueprints/BackendRouting
=========================

<- Back to blueprints overview [outdated wiki link]

==========================
Blueprint: Backend Routing
==========================

+----------------------+----------------------------------------------+
| Proposal             | Implement basic routing for the TYPO3        |
|                      | Backend                                      |
+----------------------+----------------------------------------------+
| Owner/Starter        | Benni Mack                                   |
+----------------------+----------------------------------------------+
| Participants/Members | Benni Mack, Helmut Hummel                    |
+----------------------+----------------------------------------------+
| Status               | Draft, Discussion, Voting Phase,             |
|                      | **Accepted**, Declined, Withdrawn            |
+----------------------+----------------------------------------------+
| Current Progress     | Unknown, Started, Good Progress, Bad         |
|                      | Progress, Stalled, Review Needed, **DONE**   |
+----------------------+----------------------------------------------+
| Topic for Gerrit     | {{{gerrit_topic}}}                           |
+----------------------+----------------------------------------------+

Target Versions/Milestones
==========================

-  Started during TYPO3 CMS 7.1 development, should be included until
   CMS 7 LTS.

Motivation
==========

This page explains the concepts and details about the Routing principles
in the TYPO3 Backend, which should be introduced with TYPO3 CMS 7.

Until TYPO3 CMS 7 there are several ways to register any type of page /
output:

-  mod.php (backend modules registered as dispatched modules, but also
   possible for other documents like “move_el”)
-  Separate entry points (index.php / login, logout.php, element
   browser)
-  ajax.php
-  navigation frames

All of them include init.php which sets up the base bootstrap for the
Backend. Any other pages can still run the bootstrap set up on their
own. When linking to a module, the method BackendUtility::getModuleUrl()
is used as the main instance and used throughout the core.

Current Implementation Status
=============================

All modules in the TYPO3 CMS Core have been moved to the dispatched
version called mod.php. All standalone files have been moved to be using
mod.php, ajax.php and index.php. All “separate” entry points like the
element browser or the thumbnail view have been moved to behave like a
“module”. This way, all of these entry points are protected by a token
and are using mod.php.

In an effort to fetch more data out of the global scope the TYPO3 system
gained a single method “run” inside the Bootstrap which uses different
Request Handlers to dispatch depending on certain options.

Now there is a safe and single entry point for common usage - this is
handled at exactly two places now:

-  BackendUtility::getModuleUrl()
-  mod.php / BackendModuleDispatcher.

However, all code is handled now as a module, although the definition of
other functionalities are not modules:

-  Login page / Logout logic
-  Show Item
-  Wizards
-  Form to move a file / renaming a file

A module (or submodule) is something that will be shown in module menu
and has some access information, but the entry points are basically part
of simple routing to pages / documents of the backend, we will now call
“routes”.

Concept / Goal
==============

Modules will be an extended version of a route, and be treated on
different places, exactly like an AJAX call, but the smallest portion
they share are:

-  an identifier of a route, so it can be called by its name when
   referencing to this route
-  a path pattern, which is usually something like “/login” or
   “/wizards/move"
-  a controller / action method that is called upon calling the route.

This is what is called a **Route**.

When looking at other implementations of Routing like TYPO3 Flow and
Symfony Routing Component we took the best parts and applied it to the
current situation.

Instead of moving everything to a module we decided to change the basic
handling of routing and put the special treatment for modules and ajax
on top at a later point.

The main goal is to route everything (!) of the backend through the
backend routing component and through one single entry point. This way,
a lot of files within the typo3/*php directly will become obsolete.
Additionally, all routing information, including the module information,
which was previously located in ext_tables.php is now put into the same
place, this way the registration and logic can be encapsulated and
cached separately. The following steps need to be taken in order to
achieve that:

#. The basic routing architecture is put into place for index.php. Any
   route is then routed via index.php?route=…&token=… which is then
   resolved to a controller / action.
#. All non-modules are migrated from addModulePath to use the Routing
   architecture with a proper fallback mechanism for
   backwards-compatibility.
#. The module architecture with mod.php should be unified with the
   generic RequestHandler.
#. Module registration is streamlined to use the Routing Architecture
   for registration as well.
#. AJAX registration is streamlined to use the Routing Architecture for
   registration as well.

The routing is used for the backend only, thus reducing the registration
overhead in an non-cached frontend call as the ext_tables.php is not as
polluted anymore.

Implementation Details
======================

The Routing component is using the very basic feature set which is
similar to Symfony’s Routing Component. The Backend Routing is set up at
the time of the bootstrap for every Backend request within the
RequestHandlers just before ext_tables.php is included. The Router, the
main object is instantiated here and injected into BackendUtility for
now as this is the place where the URLs need to be generated.

At this point of initialization, the Router gets filled with Routes that
are registered inside Configuration/Backend/Routes.php of any installed
Package. This is cached in a system cache on first backend hit. See
EXT:backend/Configuration/Backend/Routes.php for implementation details.

When typo3/index.php is then called, the Router checks the GET parameter
“route” against the registered routes. If found the RequestHandler
proceeds by using the “controller” information put inside the Route
configuration and calls a method on a PHP class. If no GET parameter is
found, then the RequestHandler works just as before.

The Router has a collection of Routes, which is used to match against a
path info string (see ->match()), and also used to create URLs from
available routes (see generate()).

Risks
=====

Issues and reviews
------------------

-  https://review.typo3.org/#/c/37476/

External links for clarification of technologies
================================================

-  https://github.com/symfony/Routing
