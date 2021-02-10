.. include:: /Includes.rst.txt

==================================================
Default Orderings and Query Settings in Repository
==================================================

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

Default Orderings TYPO3 > 6.2
=============================

Order by sorting (or any other field)

::

   class FooRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

       // Order by BE sorting
       protected $defaultOrderings = array(
           'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
       );

   }

Default Orderings TYPO3 4.5 - 4.7 (extbase 1.3-4.5)
===================================================

It is now possible to change the default orderings of a repository
without you having to modify the query by setting the
*$defaultOrderings* property of your Repository to a non-empty array:

::

   class Tx_MyExtension_Domain_Repository_FooRepository extends Tx_Extbase_Persistence_Repository {
       protected $defaultOrderings = array(
           'title' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
           'date' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
       );
   }

This will change the default ordering for all queries created by this
repository. Of course you can override the ordering by calling
*$query->setOrderings()* in your custom finder method. For TYPO3/Extbase
6.x this is the syntax you need inside the Repository class:

::

   protected $defaultOrderings = array(
       'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
       'date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
   );

Default Query Settings TYPO3 4.5 - 4.7 (extbase 1.3-4.5)
========================================================

You are most likely familiar with the TCA control setting enablecolumns,
as well as the flags hidden and delete, that change the way records
display in the TYPO3 backend. Extbase follows the same rules. The
default Extbase Select query will append limitation clauses and limit
the resulting records to valid ones for the current plugin/module
context:

::

   AND hidden = 0
   AND deleted = 0
   AND (starttime = 0 OR starttime >= currentTimestamp)
   AND (endtime = 0 OR endtime < currentTimestamp)
   AND pid = 42
   AND sys_language_uid IN (0, 1)

Until TYPO3/Extbase 4.7 there were the following options to limit your
query result regarding the TCA constraints:

::

   class Tx_MyExtension_Repository_ExampleRepository extends Tx_Extbase_Persistence_Repository {

       // Example for repository wide settings
       public function initializeObject() {
           /** @var $defaultQuerySettings Tx_Extbase_Persistence_Typo3QuerySettings */
           $defaultQuerySettings = $this->objectManager->get('Tx_Extbase_Persistence_Typo3QuerySettings');
           // go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details

           // don't add the pid constraint
           $defaultQuerySettings->setRespectStoragePage(FALSE);
           // don't add fields from enablecolumns constraint
           $defaultQuerySettings->setRespectEnableFields(FALSE);
           // don't add sys_language_uid constraint
           $defaultQuerySettings->setRespectSysLanguage(FALSE);
           $this->setDefaultQuerySettings($defaultQuerySettings);
       }

       // Example for a function setup changing query settings
       public function findSomething() {
           $query = $this->createQuery();
           // don't add the pid constraint
           $query->getQuerySettings()->setRespectStoragePage(FALSE);
           // the same functions as shown in initializeObject can be applied.
           return $query->execute();
       }
   }

As of TYPO3 4.7 you had the option to drop the storagePid constraint and
drop the enablecolumns constraint as a whole. But with the built in
functions there was no way to retrieve deleted records or fetch hidden
ones, if their start- and endtime is still valid. This has changed.

Default Orderings and Query Settings TYPO3 6.0 - 6.2 (extbase 6.0 - 6.2)
========================================================================

From TYPO3/Extbase 6.0 you have more possibilities, here is how to do
it:

::

   namespace <Vendor>\<Extkey>\Domain\Repository;
   class ExampleRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

       // Example for repository wide settings
       public function initializeObject() {
           /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
           $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
           // go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details

           // don't add the pid constraint
           $querySettings->setRespectStoragePage(FALSE);
           // set the storagePids to respect
           $querySettings->setStoragePageIds(array(1, 26, 989));

           // don't add fields from enablecolumns constraint
           // this function is deprecated!
           $querySettings->setRespectEnableFields(FALSE);

           // define the enablecolumn fields to be ignored
           // if nothing else is given, all enableFields are ignored
           $querySettings->setIgnoreEnableFields(TRUE);       
           // define single fields to be ignored
           $querySettings->setEnableFieldsToBeIgnored(array('disabled','starttime'));

           // add deleted rows to the result
           $querySettings->setIncludeDeleted(TRUE);

           // don't add sys_language_uid constraint
           $querySettings->setRespectSysLanguage(FALSE);

           // perform translation to dedicated language
           $querySettings->setSysLanguageUid(42);
           $this->setDefaultQuerySettings($querySettings);
       }
       // Example for a function setup changing query settings
       public function findSomething() {
           $query = $this->createQuery();
           // don't add the pid constraint
           $query->getQuerySettings()->setRespectStoragePage(FALSE);
           // the same functions as shown in initializeObject can be applied.
           return $query->execute();
       }
   }

Here you can check on the default values shipped with Extbase:

::

   respectStoragePage = TRUE
   storagePageIds = array() (meaning: it is empty ;) )
   ignoreEnableFields = FALSE
   enableFieldsToBeIgnored = array()
   includeDeleted = FALSE
   sysLanguageUid = 0
   respectSysLanguage = TRUE

For the language handling you can rely on extbase to handle this
properly by itself. Interfere only in the rare cases the built in
mechanisms can not handle you very complex setup. Happy coding with this
nice additions to the QuerySettings Pool.
