.. include:: /Includes.rst.txt

====================
Dependency Injection
====================

.. container::

   notice - Newer documentation available

   .. container::

      `TYPO3 Explained: Dependency
      Injection <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/DependencyInjection/Index.html>`__
      contains information about Dependency Injection for newer versions
      of TYPO3.

===============================
Dependency Injection in Extbase
===============================

Dependency Injection is a specialization of the „Inversion of control“
software design pattern. It helps to manage dependencies between
objects. The goal is to decouple the objects and make them more flexible
and extendable.

There are numerous ressources that explain dependency injection and
inversion of control:

-  https://msdn.microsoft.com/en-us/library/ff921087.aspx [not available
   anymore]
-  https://en.wikipedia.org/wiki/Dependency_injection

| 
| In simplified terms: You do not create an instance of class B in class
  A, you pass an instance of class B to instance of class A. Thus, class
  A becomes more flexible, because it can work with class B1, B2 or B2.
  You typically acchieve this using interfaces: B is defined as an
  interface and B1, B2 and B3 implement that interface.

In Extbase this mechanism is used as well.

Methods of Depency Injection (DI) in Extbase
============================================

inject method
-------------

Let's give an example:

If my class *MyController* needs another class *LoggingService*, it can
get an instance of the logging service by Dependency Injection, by
specifying the following code:

::


   namespace Vendor\Extname\Controller;

   use Vendor\Extname\Service\LoggingService;

   class MyController 
   {
       /**
        * @var LoggingService
        */
       protected $loggingService;

       /**
        * @param LoggingService $loggingService
        */
       public function injectLoggingService(LoggingService $loggingService) 
           {
           $this->loggingService = $loggingService;
       }
   }

The DI system finds that the class *MyController* has an method whose
name starts with *inject*, and thus passes the logging service to
*MyController*. This is automatically done by the Extbase framework.

@inject annotation
------------------

Since version 4.7, Dependency Injection works with an @inject annotation
and no inject-method is needed anymore.

::

      /**
       * @var \Vendor\Foo\Service\LoggingService
       * @inject
       */
       protected $loggingService;

However, be aware of possible performance implications, see for example
`"Why you should never use @inject in TYPO3
Extbase" <https://gist.github.com/NamelessCoder/3b2e5931a6c1af19f9c3f8b46e74f837>`__.

Constructor Injection
---------------------

Extbase also supports `Constructor
Injection <https://en.wikipedia.org/wiki/Dependency_injection#Constructor_injection>`__.

There, the dependencies are set in the constructor arguments, like in
the following example:

::


   use Vendor\Extname\Service\LoggingService;

   class MyController 
   {
       /**
        * @var LoggingService
        */
       protected $loggingService;

       /**
        * @param LoggingService $loggingService
        */
       public function __construct(LoggingService $loggingService) 
           {
           $this->loggingService = $loggingService;
       }
   }

More Hints
==========

initializeObject() as object lifecycle method
---------------------------------------------

If a method with the name *initializeObject()* exists, it is called
**after all dependencies** have been injected and configured; so you can
use this method for further initialization work.

Creating Prototype Objects through the Object Manager
-----------------------------------------------------

To create prototype objects, use the get() method on the
`ObjectManager <https://api.typo3.org/typo3cms/current/html/class_t_y_p_o3_1_1_c_m_s_1_1_extbase_1_1_object_1_1_object_manager.html>`__
[not available anymore], as in the following example.

**Do not use GeneralUtility::makeInstance anymore!**

::


   use Vendor\Extension\Log\LogFile

   class MyController 
   {

       public function foo() 
           {
           $logFile = $this->objectManager->get(LogFile::class);
       }
   }

**You can also instantiate classes with constructor arguments:**

::

   public function foo() 
   {
       $logFile = $this->objectManager->get(LogFile::class, 'arg1', 'arg2');
   }

**You can also inject prototypes into your classes.**

Programming against interfaces
------------------------------

If a name ends with "...Interface", Extbase DI automatically strips away
the "Interface" from the name, and expects to find a concrete
implementation of that interface.

Programming against interfaces is greatly eased by that: For your core
classes, you should always reference an *interface*, and let the DI
container instanciate the concrete class.

TypoScript configuration
------------------------

Additionally, Extbase DI allows to *replace* certain implementation
classes by other classes through configuration in TypoScript. Let's give
an example, and then you can see the concept:

::

   config.tx_extbase.objects {
       TYPO3\CMS\Extbase\Persistence\Generic\Storage\BackendInterface {
           className = TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbBackend
       }
   }

This essentially means to the DI container: At all places where the code
refers to *BackendInterface*, an object of *Typo3DbBackend* should be
instantiated.

This even works with concrete classes - you can configure the DI to
*replace* them.

This setting could only be configured \*globally\* until version 6.0.
Since version 6.1 it is possible to override that on a per-plugin basis:

::

   plugin.tx_myextension.objects {
       TYPO3\CMS\Extbase\Persistence\Generic\Storage\BackendInterface {
           className = TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbBackend
       }
   }

Links
=====

-  https://daniel-siepmann.de/Posts/2017/2017-08-17-typo3-injection.html
-  https://gist.github.com/NamelessCoder/3b2e5931a6c1af19f9c3f8b46e74f837
