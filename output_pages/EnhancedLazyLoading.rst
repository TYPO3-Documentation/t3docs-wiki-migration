.. include:: /Includes.rst.txt
.. highlight:: php

=====================
Enhanced Lazy Loading
=====================

.. container::

   notice - This information is outdated

   .. container::

      This feature was never released in any core version. The
      corresponding `patch <https://review.typo3.org/#/c/32286/>`__ is
      currently abandoned, and there is noone working on it at the
      moment.

In 2014 budget from the
`workpackages <https://forge.typo3.org/issues/55070>`__ was used to
(start) rework of extbase's lazyLoading mechanism.

How to use
==========

The new, enhanced lazyLoading strategy is enabled by default. You can
disable it via TypoScript. If you want to disable it system-wide, just
set

::

   config.tx_extbase.persistence.enhancedLazyLoadingStrategy = 0

In most cases this should not make sense. If you experience performance
drops in certain situations, you can disable it on a per-extension or
even a per-plugin base.

::

   plugin.tx_blogexample.persistence.enhancedLazyLoadingStrategy = 0

Problems tackled
================

LazyLoadingProxy not extending the represented object
-----------------------------------------------------

The old lazy loading approach relied on a generic "LazyLoadingProxy",
which was shipped with Extbase. As it was not generated on the fly, it
did not extend the class it was representing, thus creating fatal PHP
errors, when given as an argument to a method that was protected
throught a typehint.

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      public function setBlog(Blog $blog)

::

   Argument 1 passed to [...]::setBlog() must be an instance of [...]\Blog, instance of TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy given

This led to developers massively self-resolving lazyLoading using

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      if ($this->parent instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
       $this->parent->_loadRealInstance();
      }

which is real bad design.

To solve this, we now generate the ProxyClasses on the fly and store
them in the caching framework. The LazyProxy can now be used
transparently, passes typehints and resolves itself when called.
In-depth information on that topic can be found in the "corresponding
forge-ticket":https://forge.typo3.org/issues/60460.

Resolving lazyLoadingProxy leading to one database-query per object
-------------------------------------------------------------------

When multiple entities (like posts) contained a lazyLoading property of
the same type (like author), the property would be resovled upon
request, meaning you got a hundred database queries, resolving the
author for each post - one at a time. To solve this, we now register all
lazyLoading properties within their corresponding type. As soon as the
first object is to be resolved, all objects of that type (like authors)
will be fetched in one single database-query and mapped into their
places. Of course only the child objects of mapped parents will be
fetched, thus working together with limit and offset in your query.

Extbase's persistence not using repositories
--------------------------------------------

Extbase used it's own logic (generated queryObject) to fetch related
records. There was no way to adjust things like "include hidden", "do
not inlcude deleted" and respect of storagePid and language. To solve
this, we now always call a repository to fetch child records. The
className of the repository is guessed from the type of the desired
object. If no repository is found, extbase uses it's own
*genericRepository*.

Architectual changes
====================

Extbase's repositories
----------------------

To stay completely compatible, we moved all functionality from
*Repository* to *GenericRepository* and made *Repository* an Extension.
*Repository* uses code in *\__construct()* to determine the recordType
from the className. This obviously would not work for an
GenericRepository. In *GenericRepository* extbase (and you) can set the
type of objects via an method argument.

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $repository = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\GenericRepository', $this->objectManager, '[...]\Blog');

Nothing was changed in the conventional use of *Repository*.

[!!!][BREAKING] findByUid now returns a QueryResult, findByIdentifier to be used
--------------------------------------------------------------------------------

In a bad fashion, extbase implemented a custom findByUid() method in the
repository. While **all** other findBy*()-methods returned a
QueryResult, this method returned an object directly. This was
intransparent. Additionally there was no clear distinction between
findByUid() and findByIdentifier(). The behaviour changed multiple times
throughout the last releases. We got rid of findByUid(). This is now
implemented through the magic findBy*()-method and returns a QueryResult
as expected. To fetch a single object, just use findOneByUid(), like you
would do with every other property too. To allow some special behaviour
when fetching certain objects, findByIdentifier() is implemented. By
default it does not respect storagePage and language-constraints. You
can modify that behaviour in your own repository. Extbase will always
use findByIdentifier() from your repository to fetch related objects,
thus allowing you to easily modify it's behaviour from your extension.

Known problems
==============

LazyObjectStorage
-----------------

At this moment, lazyObjectStorages are still implemented in the old
fashion. TYPO3 different ways of storing relationships in the database
(especially remote table lookup using *foreign_field*) make it hard (to
impossible) to determine which child relates to which parent, when
fetching multiple lazyObjectStorages at once. As the relation
information is not stored in the parent but rather in the child object
this would result in multiple iterations. As this killed performance, we
left this to feature implementation ideas. LazyObjectStorages will work
the way they always did, they will just not benefit from any of the
performance gain.

Performance drops
-----------------

In certain (what we believe are few) situations, it might not make sense
to fetch all objects at once. Imagine you've got a news list-view,
having custom markup for the first item. While you might want to display
the tags for the first news article, you might want to skip them for the
following. This would be a case, where it would make sense to disable
the new lazyLoading strategy.

More information
================

If you want to read up, this are
`the <https://forge.typo3.org/issues/59917>`__
`forge <https://forge.typo3.org/issues/55169>`__
`issues <https://forge.typo3.org/issues/60460>`__.

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript. info [outdated wiki link]
