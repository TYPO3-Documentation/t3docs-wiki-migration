.. include:: /Includes.rst.txt

.. _logging:

==================
Blueprints/Logging
==================

`<- Back to blueprints overview <https://wiki.typo3.org/Blueprints>`__
[deprecated wiki link]

Blueprint: Logging API
======================

+----------------------+----------------------------------------------+
| Proposal             | Creating and implementing a new concept for  |
|                      | logging events in TYPO3 CMS                  |
+----------------------+----------------------------------------------+
| Owner/Starter        | Steffen Müller                               |
+----------------------+----------------------------------------------+
| Participants/Members | Markus Klein, Alexander Schnitzler, Helmut   |
|                      | Hummel                                       |
+----------------------+----------------------------------------------+
| Status               | Draft, **Discussion**, Voting Phase,         |
|                      | Accepted, Declined, Withdrawn                |
+----------------------+----------------------------------------------+
| Current Progress     | Unknown, Started, Good Progress, Bad         |
|                      | Progress, Stalled, **Review Needed**         |
+----------------------+----------------------------------------------+
| Topic for Gerrit     |                                              |
+----------------------+----------------------------------------------+

Target Versions/Milestones
--------------------------

-  TYPO3 10.x

Goals / Motivation
------------------

Motivation back in 2014 and earlier:

A new Logging API has been introduced with TYPO CMS 6.0. This new API is
different from the old API in the following ways:

#. It is extendable for two main components: LogWriters and
   LogProcessors. LogWriters define the target where to write a
   LogRecord. LogProcessors enrich the LogRecord with additional data.
   LogWriters and LogProcessors can be customized and even new ones can
   be added.
#. Both LogWriters and LogProcessors can be configured through
   $TYPO3_CONF_VARS['LOG'] without touching the PHP code itself. Each
   Logger has its's distinct name so it can be configured independently.
   Inheritance helps to keep the amount of configuration low.

The motivation for this blueprint is to describe a concept, how this API
shall be used in the TYPO3 CMS core.

Motivation in 2018:

#. Use an existing PSR-3 compatible library if possible to reduce TYPO3
   specific code for such a standard feature.
#. Enhance the possibilities of the logging to include an additional
   dimension for filtering e.g. by security-related log messages

What could be the purposes of Logging in a CMS?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The following is a collection of use cases from the current logging
implementation, as well as new ideas:

-  **Monitoring the system** as a whole or a specific component, for
   example application performance, what triggered the clearing of the
   cache etc.
-  Providing information for **Development**, for example **debugging**
   or **deprecation**
-  Classical PHP **error logging**, which notices about errors, warning
   etc. caused by programming code
-  **Tracking security** incidents, policy violations, fraudulent
   activity, e.g. brute force login attempts
-  **Process logging**: who touched the content and when?
-  **Learning** how the system works

Some user stories
^^^^^^^^^^^^^^^^^

(Stories from the perspective of an integrator)

#. I want to collect all security related logs of TYPO3 core in a
   dedicated log file.
#. I want to collect all errors of TYPO3 including extensions in a
   combined log file.
#. I want to have debug-logs of extension XY in a dedicated log file.
#. I want my big conference extension to log errors and permission
   violations into a dedicated file each.
#. I want to combine security related logs of extensions and core in a
   dedicated file.
#. I want to combine stories 1 to 5 freely

Concept
-------

PSR-3 provides us with the basic foundation of the concept.

Definition of terms
^^^^^^^^^^^^^^^^^^^

The two key terms of PSR-3 are: - Severity/Level: "How important is the
log entry?" - Context: Arbitrary additional information for the log
entry. Technically an array of data. (Predefined/reserved is only the
"exception" data)

A few terms, which will be used subsequently: - Name: Identifies a
logger "Where (in which component) did this incident occur?" in a
hierarchical manner (PHP namespace-based usually) - Type: "What is the
type of the incident?" (Most prominently "Security" and "Deprecation") -
Processor: A class that enriches a log entry with additional information
(e.g. request information, login user, etc). - Handler: A class that
moves a log entry to its final target destination (e.g. a file,
database, log-server). - Formatter: A class that formats a given log
entry into a string representation. - Target: A definition of this term
will be provided blow, please read on.

Bits an pieces
^^^^^^^^^^^^^^

As an application is about to create a log entry, it has to deal with
various classes to achieve this.

PSR-3 predefines a good portion of this API already. That is: Log level
/ Severity and basic methods of a Logger class (**log()**, **alert()**,
etc.).

To achieve the user stories laid out above, we need a bit more than
that.

First off, we want to structure the log entries in order to make these
filterable by this structure. The current logging implementation in the
TYPO3 core uses the fully qualified class name by default to structure
things. This allows for a hierarchical structure, which allow for
filtering based on the components of the namespace of a class, which
usually comprises "TYPO3 entities" like extensions and vendor names.
This property of a log entry is covered by its name.

Second, we want to be able to filter log entries by some kind of topic
or type. We consider the example of "security-related" log entries. We
might want to filter these independent of their structure (imposed by
their name). This property of a log entry is covered by its type.

Third, it might be very helpful to have additional information with a
log entry about the condition it was created in. So called "Processors"
may mangle a log entry by adding additional data (eg. the HTTP request
URL) to its context.

Fourth, a log entry must ultimately find a place to rest. That can be
any destination like a simple file, some logging service, a chat-client
or even a combination of all. So called "Handlers" are responsible to
transfer a log entry to the final destination.

Fifth, a log entry (seen as a bunch of structured data) needs to be
transformed (or converted) to some other representation (mostly a
string) in order to be consumed by whatever final destination a log
entry will end up. So called "Formatters" cover this job and take care
of transforming a log entry to some representation a handler deal with.

The pieces laid out in this chapter are ultimately part of the Logging
API, which offers those functionalities or may be extended by
third-party code. E.g. consider a dedicated Handler that pushes log
entries to your custom crafted ticket-service.

The "name" and "type" as well as the modifications done by a processor
are data which are **part of** a log entry, whereas the Formatters and
Handlers are tools which **deal with** a log entry.

Configuration - the Targets
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Clearly there needs to be configuration, which glues those "dealers"
together. The integrator of a system is responible to set up an adequate
log handling, which fits the project. This can be simple log file
storage all the way to a central logging cluster service with advanced
monitoring and alerting.

In order to allow for all these scenarios another term is introduced,
which we call "Target". A target is a set of rules (lets call them
"matches") paired with processors and handlers.

The basic idea is that the logging framework evaluates the list of
defined targets for each log entry, by checking whether the log entry
matches the rules for this target. The matches of a target is so to say
the selection filter which answers the question: "Which log entries does
the target care about?"

This concept allows to define arbitrary scenarios, just name one
example: - Send me an email whenever a security related event occurs
that has at least severity "critical". - Send all log entries to the
local rsyslog daemon. - Send all shopping cart (ext:cart) related log
messages to our business tracking service (some cloud service).

Implementation
--------------

Current situation
^^^^^^^^^^^^^^^^^

At present (07/2019) we have the existing Logging API of TYPO3 at hand
as well as some very popular projects like monolog. Both projects are
PSR-3 compatible and are hence candidates for usage. Neither of those
fulfills all the requirements outlined above.

Our own API has the hierarchical naming out of the box, monolog does
not. Monolog ships tons of Formatters and Handlers (alias writers in
TYPO3), TYPO3 only a few (no Formatters at all). TYPO3 allows for
fine-grained configuration based on the naming schema.

Our proposal
^^^^^^^^^^^^

We propose to take the monolog library as a basis to implement the new
Logging API of TYPO3. **BUT** we mostly use the "dealers" from there. We
still have to implement the naming, types and targets by ourselves.

Example usage of the new API
''''''''''''''''''''''''''''

.. container::

   ::

      // $this->logger holds an instance of Logger::class with the (default) name, which is the current class
      $this->logger->warning('Failed login by {username}.', ['type' => Logger::TYPE_SECURITY, 'username' => 'klein']);

This is the default usage as PSR-3 purports, extended by the additional
data "type".

Example configuration
'''''''''''''''''''''

The following example shows the configuration for three targets: - "log
everything to file" - "security related stuff to dedicated file" -
"alerts from ext:cart to mail" target

.. container::

   ::

      $GLOBALS['TYPO3_CONF_VARS']['LOG'] = [
          // defines the available processors with a clear identifier
          'processors' => [
              'web' => [
                  // required
                  'class' => WebProcessor::class,
                  // any further options for this processor
              ],
          ],
          // defines all available handlers with a clear identifier
          'handlers' => [
              'default' => [
                  // required
                  'class' => StreamHandler::class,            
                  'minimum-severity' => Severity::INFO,
                  // all other options as applicable to the class used
                  // if no formatters are defined the default one of the handler is used
                  'formatters' => [
                      LineFormatter::class => [],
                  ],
                  'file-name' => 'typo3_default.log',
              ],
              'securityhandler' => [
                  'class' => StreamHandler::class,
                  'minimum-severity' => Severity::WARNING,            
                  'file-name' => 'typo3_security.log',
              ],
              'cartmailhandler' => [
                  'class' => NativeMailerHandler::class,
                  'minimum-severity' => Severity::ALERT,            
                  'to' => 'me@example.com',
                  'subject' => 'Cart alert'
              ],
          ],
          // defines which processors and handlers should be called for a log entry based on the matching criteria
          'targets' => [
              // name of this target
              'security-errors' => [
                  // multiple match criteria sets are possible, if one of them matches the associated processors and handlers are executed
                  'matches' => [
                      // multiple types means an OR condition, one of the types must match
                      // empty array or not specifying this element means "any type"
                      'types' => [
                          Logger::TYPE_SECURITY,
                      ],
                      // multiple channels means that one of the must match
                      // empty array or not specifying this element means "all channels"
                      'channels' => [],
                  ],
                  // the identifiers of processors to apply
                  'processors' => [
                      'web',
                  ],
                  // the identifiers of handlers to run
                  'handlers' => [
                      'securityhandler',
                  ],
              ],
              'all-logs' => [
                  'matches' => [],
                  'handlers' => [
                      'default',
                  ],
              ],
              'shop-alerts' => [
                  'matches' => [
                      'channels' => [
                          'Reelworx.Cart',
                      ],
                  ],
                  'processors' => [
                      'web',
                  ],
                  'handlers' => [
                      'cartmailhandler',
                  ],
              ],
          ],
      ];

Migration
^^^^^^^^^

As the "type" information for a log entry is optional, there is no need
to migrate existing code, as the existing TYPO3 API is already PSR-3
compatible.

The configuration part can be automatically migrated by the silent
upgrade service.

Example migration for a configuration:

Old config:

.. container::

   ::

      $GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::DEBUG][\TYPO3\CMS\Adminpanel\Log\InMemoryLogWriter::class] = [];

New config:

.. container::

   ::

      $GLOBALS['TYPO3_CONF_VARS']['LOG'] = [
          'handlers' => [
              'inmemory' => [
                  'class' => \TYPO3\CMS\Adminpanel\Log\InMemoryLogWriter::class,            
                  'minimum-severity' => Severity::DEBUG,
              ],
          ],
          'targets' => [
              'all-to-memory' => [
                  'matches' => [],
                  'handlers' => [
                      'inmemory',
                  ],
              ],
          ],
      ];

Risks
-----

Issues and reviews
~~~~~~~~~~~~~~~~~~

Dependencies upon other Blueprints
----------------------------------

External links for clarification of technologies
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
