.. include:: /Includes.rst.txt

===========
QueryResult
===========

This feature is part of Extbase 1.3, included in TYPO3 4.5 LTS.

**This might be a breaking change for you**

Before Extbase 1.3, a call of $query->execute() inside a repository
immediately executed the query and returned the result as array. Now,
queries are executed lazily at the first moment where you really need
them.

As a result $query->execute() returns an object of type
*Tx_Extbase_Persistence_QueryResultInterface*, which behaves like an
array, meaning you can loop over the query result like:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $results = $query->execute();
      foreach($results as $result) {
      // ...
      }

The Fluid code is the same still, too:

::

   <f:if condition="{results}">
       <f:for each="{results}" as="result">
           {result.foo}
       </f:for>
   </f:if>

However, due to an inconsistency of PHP, the *array_()\** methods, and
some iteration methods like *current()* do **not** work on objects which
implement *ArrayAccess* -- that's the reason why the QueryResult
refactoring is a breaking change.

Upgrade Instructions
====================

You can work around this issue like this: Before (in your controller):

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $results = $this->myRepository->findAll();
      $firstResult = current($results);

Now:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $results = $this->myRepository->findAll();
      $firstResult = $results->getFirst();

This will also improve performance and reduce memory consumption. You
can also use the *findOneBy*()* methods of the Repository.

If you used PHPs *array_*()* functions on the result, you'll probably
have to adjust your code as well: Before (in your repository):

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      public function findAll($offset, $limit) {
          $query = $this->createQuery();
          $allResults = $query->execute();
          return array_slice($allResults, $offset, $limit);
      }

Now:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      public function findAll($offset, $limit) {
          $query = $this->createQuery();
          return $query
              ->setOffset($offset)
              ->setLimit($limit)
              ->execute();
      }

If you really need the result as array, you can convert the
@QueryResult@ like this:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $query->execute()->toArray();

If you need to get query instantly, you can get *QueryResult* clone like
this:

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $query->execute()->getQuery();

The Class
=========

From the class description:

public class\_ Tx_Extbase_Persistence_QueryResult A lazy result list
that is returned by Query::execute()

**getQuery**

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      public Tx_Extbase_Persistence_QueryInterface getQuery()

Returns a clone of the query object

**getFirst**

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      public object getFirst()

Returns the first object in the result set

**count**

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      public integer count()

Returns the number of objects in the result

**toArray**

.. container::

   `PHP Script </wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      public array toArray()

Returns an array with the objects in the result set

But you should try to avoid that at least for result sets that you pass
to Fluid via *$this->view->assign()* as that would break support for
(some) widgets.

Note: To implement pagination in your Extbase/Fluid extension, have a
look at the **paginate** widget, that is shipped with Fluid 1.3.0. That
will take over the part of rewriting the query for you.
