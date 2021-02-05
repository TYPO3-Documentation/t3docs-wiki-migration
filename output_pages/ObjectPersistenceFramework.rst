.. include:: /Includes.rst.txt
.. highlight:: php

============================
Object Persistence Framework
============================

.. container::

   This page belongs to the Extension coordination team [outdated wiki
   link] (category ECT [outdated wiki link])

.. container::

   This page belongs to the Object Persistence Framework project
   (category Project [outdated wiki link])

Object Persistance Frameworks - Mapping Object Models into Relational Databases
===============================================================================

NB: These notes were written in the context of a search for a
persistence framework suitable for integrating with the standard
extension development coordination team for the TYPO3 content management
system. An understanding of the lib [outdated wiki link]/div extension
and TCA meta data is useful to following this discussion.

Other Frameworks
----------------

Object persistence frameworks come in many flavours. There are many
difficulties in providing an API to map Object Oriented code models into
a relational database tedneward.com [outdated wiki link] often grouped
under the title object impedance mismatch. Mapping inheritence trees
against one/many tables, complex joins, primary key mapping are all
problems that are arguably better implemented by hand possibly using the
SQL query language directly. The key question I hope to answer for
myself is "What is an appropriate/useful/usable API for an object
persistence framework". The target audience (typo3 extension developers)
for such an API includes a wide range of software development experience
so simplicity is high on the list of criteria.

Some of the core problems listed in tedneward.com [outdated wiki link]
are -

-  Mapping inheritence hierarchies against database tables.
-  Bidirectionality of relationships. Object models are typically one
   directional a parent holds references to children but the children do
   hold references to the parent. Relational models are typically
   bidirectional as the relationship is expressed in a way that can be
   queried from the point of view of the child or the parent.
-  Entity Identity - database models typically identify a primary key.
   Object models have no such requirement unless it is imposed.
-  Concurrency - by creating an unattached copy of database stored
   information in memory, it is difficult to prevent concurrent changes
   to the database particularly when the object model provides caching
   support.
-  Searching - API's for querying a database quickly become more complex
   and verbose that using SQL directly.
-  Partial loading - the cost of loading all fields (rather than those
   required for the current view/action) from a database table into
   memory can be significant. This is particularly problematic when
   loading from related tables.

Looking for other frameworks [outdated wiki link], some of the open
source PHP object persistence frameworks include - ado_db Active
Reccords [outdated wiki link], tcaObjects [outdated wiki link], Propel
[outdated wiki link], CakePHP [outdated wiki link], PEAR DB_DataObject
[outdated wiki link] th. There are also ideas to be found in the typo3
TCEMAIN, and T3LIB_DB classes and the admin_interface extension to name
just a few. This discussion is deliberately limited to simple PHP
frameworks. There are many advanced implementations of object
persistence frameworks (including JSR-170) that provide enterprise level
features such as versioning and model event notifications.

Uniform across the sampled frameworks is the ability to call save, load,
search, delete on an object that maps to a single database table. This
functionality is gained by extending a base class that provides generic
implementations of these functions. Typically meta data is required to
describe the database table structure/object model mapping.

More interesting is the variable levels of support for relationships
between database tables. Some frameworks provide assistance in querying
related tables, some also provide save and or delete support for related
tables. Typically support for relationships maps directly to the way
that relationships are handled at the database level so you see function
names like addJoin or have objects like MMRelationship. Due to the
complexities of object persistence, total transparency is not an option.
The most variability between frameworks occurs in the amount of
abstraction provided to simplify managing relationships. Object side
storage of relationships is twofold. In a relational model, foreign keys
used to join the tables may be stored in the parent or the child or even
in a MM join table. This key data may be loaded directly when the table
containing the key is pulled into memory. Additionally, the full data
for the related table may be stored in the parent object. API functions
for managing relationships need access to the raw key data. Another
question is support or requirement of database support for transactions.

| 
| Looking in a bit more depth at some existing frameworks.

ado_db Active Record [5]
^^^^^^^^^^^^^^^^^^^^^^^^

-  single table persistence

tcaObjects [6]
^^^^^^^^^^^^^^

-  tcaObject and tcaObject_field for relationships
-  relationship support incomplete
-  dependant on TCA

PearDB_DataObject
^^^^^^^^^^^^^^^^^

-  PEAR DB_DataObject [outdated wiki link] provides insert/update/delete
   to a single database table
-  provides find() which queries by example(values of current object
   properties) and by addition of criteria using addWhere()
-  provides for direct SQL query
-  multiple search result iteration directly on the dataobject using
   while (fetch())
-  explicit query field support through selectAdd(field1,field2)
-  related table support for queries provided by addJoin(),
   getLink('value'), getLinks(). Meta data is required for the getLink
   functions to describe the join conditions which can be placed in a
   configuration file or added explicity using addJoin.

Propel
^^^^^^

-  uses an XXXPeer::doSelect() method to implement search queries and
   passes Criteria objects to the Peer to limit results. Query by
   example is not supported.
-  uses an XML based meta data format
-  provides getXXXField to load full data for related tables
-  provides XXXPeer::doSelectJoinOtherTable() to load related table data
   en masse
-  automatic save of related objects stored inside a parent based on
   meta data is supported
-  onupdate and ondelete triggers can be provided in meta data to allow
   automatic delete of related records.

CakePHP
^^^^^^^

-  CakePHP [outdated wiki link] is the most extensive and provides code
   to manage relational concepts
-  requires definition of a class for each database table
-  uses configuration by convention to provide functionality without
   explicit definition of all the details where the naming of databases
   and variables and classes follows the naming guidelines
-  relationships are configured by adding the variables
   $hasOne,$hasMany,$belongsTo,$hasAndBelongsToMany containing arrays
   where each key maps to another array storing configuration for the
   relationship
-  the standard find/delete methods are sensitive to the defined
   relationships implementing auto load/delete of related records
-  the standard save method does not cascade across relationships. You
   must explicity call save on the parent and then call save on all
   related tables
-  the base model class has hook functions to allow customisation
   before/after the standard save/find/delete functions
-  behavior can be controlled by adding the variables $transactional
   (use transactions for multiple relation queries if possible),
   $recursive=integer (how many levels of related objects should load by
   default)
-  validation is configured in the model variable $validate and is
   called automatically before save
-  the find/load methods return arrays of data. The data is not stored
   in the calling model object. These arrays of data are structured with
   a key for the main table and a key for each of the relations

eg Array (

::

      [User] => Array
          (
              [id] => 25
              [first_name] => John
              [last_name] => Anderson
              [username] => psychic
              [password] => c4k3roxx
          )

::

      [Profile] => Array
          (
              [id] => 4
              [name] => Cool Blue
              [header_color] => aquamarine
              [user_id] = 25
          )

)

Questions
---------

-  Some (of many) questions raised by the summary -
-  What software implementation of the data structure for the model
   class?
-  In what code structures should this data be provided - arrays, object
   trees
-  How to define the relationships?
-  What structure for the relational data within the class models?
-  What level of support for relationships? -
   save/load/delete/recursion/dependance/validation
-  When is most efficient to load related records? Load on demand? In
   bulk (all related from same table)?
-  To what extent are relational database concepts visible in the API?
-  How is a search query configured so that it is easier to use than raw
   SQL?
-  How simple can the API be?
-  Should the API depend on TCA style metadata configuration?

Discussion
----------

-  Save, load, delete and search are the basic methods commonly used in
   object persistence frameworks.
-  Storage of database data inside model records is easily reflected
   when stored as an array with an object wrapper.

load

-  Functions for load/search should create an object model including
   classes extended from tx_lib_model to maintain customised functions
   against the reloaded data structure.
-  Conversion of the field/relationship data to and from an array format
   is vital for interacting with other components, for example the view.
-  An object model for relationships that describes relational concepts
   is easier to understand based on experience with sql
-  A factory pattern can simplify using the relationship functionality
   by reducing it to a configuration array.
-  Support in save/load/delete/search for relationships should be
   complete(include child records) and configurable(eg whether or not to
   delete child records when relationship is removed) to at least one
   level of recursion.
-  Meta data for the model should be independant of the TCA but easily
   derived from it.
-  Transaction support for parent level database access should be
   enabled if possible.
-  Search functionality should be automatically configured (against the
   model meta data) based on convention for incoming
   parameters/criteria.

Proposal
--------

A sample typo3 extension that implements the following ideas is
available at http://svn.syntithenai.com/svn/t3ext/persistence [outdated
link]

Create an object persistence library starting with tx_lib_model
(extending tx_lib_object) such that data is stored in the internal array
so set/get and iteration come from object and save/load/delete come from
model. The model could be used as follows

::

    eg
    $model->set('name',joe);
    $model->save();

The model data can easily be accessed in bulk as a reference to the
internal array of the model \_iterator object using the getArrayCopy()
and exchangeArray() functions.

Meta data required to generate queries in the model is stored as class
variables (with getter/setter methods) in the model instance.

::

    eg
    $model->setTable('fe_users');
    $model->setPrimaryKey('uid'); 

or

::

    $model->configureFromArray(array('table'=>'fe_users','primaryKey'=>'uid')) // Allowance for bulk set of meta data from array is useful.

or

::

    $controller=$this;
    $initialData=mysql_get_row($res);
    $configurationArray=array('table'=>'fe_users','primaryKey'=>'uid');
    $model=new tx_lib_model($controller,$initialData,$configurationArray);

A typo3 specific tx_lib_tcaModel extends model and overrides
save/load/.. to set defaults/fake delete/derive configuration from the
global TCA variable. The TCA model extracts fields from the global TCA
and also relationships for the configured table on initialisation (with
table name) or when the table name is set. TCA types select, radio and
inline are converted to relationships.

Models with different data structures can be created as extended classes
that provide defaults for the meta data or simply by configuring the
model. Models with complex requirements for save/load/delete/set/get/...
can extend and implement custom methods.

::

   eg
   class tx_hithere_event extends tx_lib_model { 
       var $table='tx_hithere_event';
       function getDaysUntil() {}
   }

Relationships
^^^^^^^^^^^^^

The base object has an array of relationships. Each relationship is a
subclass of tx_lib_modelRelationshipBase (which is extended by
tx_lib_modelKeyInChildRelationship, tx_lib_modelKeyInParentRelationship
and tx_lib_modelMMRelationship). Typically a
tx_lib_modelRelationshipFactory would determine the correct relationship
class to instantiate based on an array of configuration when defining
the model. Similarly to core model objects, relationship. meta data is
stored as class variables. Data is stored in a class variable "data".

::

   eg 
   $modelConfig['table']='tx_partner_main';
   $modelConfig['fieldList']='uid,first_name,last_name';   
   $modelConfig['primaryKey']='uid';
   $contactInfo['table']='tx_partner_contact_info';
   $contactInfo['fieldList']='uid,remarks,email,number';
   $contactInfo['childKey']='uid_foreign';
   $modelConfig['relationships']['contact_info']=$contactInfo;
   $modelName = tx_div::makeInstanceClassName('tx_lib_model');
   $model=new $modelName($this,array(),$modelConfig);
   // model is good to go with load/save/delete support for this relationship
   The relationship shown here would be created as a "key in child" relationship by the factory.

::

   By removing childKey and adding parentKey it would be interpreted as a "key in parent" relationship
   $status['parentKey']='uid';
   optionally to force deletion of child records when no longer referenced by the parent.
   $status['isDependant']=true;
   optionally childPrimaryKey can be set explicitly
   $status['childPrimaryKey']='uid';

::

   By adding mmTable, childMMKey, parentMMKey and childPrimaryKey it would be interpreted as an MM relationship.
   $hobbies['mmTable']='tx_partner_main_hobbies_mm';
   $hobbies['parentMMKey']='uid_local';
   $hobbies['childMMKey']='uid_foreign';
   $hobbies['fieldList']='hb_descr';
   $hobbies['childPrimaryKey']='uid';

Minimum Requirements for Configuring a model
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

-  In the model,

::

   table is required. 
   fieldList will find a suitable default (*, expanded to database derived list of fields). 
   primaryKey will default to uid.

-  In a relationship,

::

   table is required, 
   childKey or parentKey is required
   fieldList will find a suitable default (*, expanded to database derived list of fields). 

::

   isDependant defaults to true for a "key in child" relationship. false for others.
   childPrimaryKey defaults to uid.

::

   mmTable is required for mm, 
   parentMMKey defaults to uid_local
   childMMKey defaults to uid_foreign

API
^^^

In addition to array tools provided by object, the acceptParameters()
method looks for relationships in a plain array format

::

   eg
   [data][name]='john'
   [data][related_field][43][uid]='72';
   [data][related_field][43][title]='mr';

is wrapped with the object model by creating an address with a
relationship holding a title in its data array. In reverse, getAsArray()
returns an array with field name/relationship keys. Relationship keys
contain an arbitrarily keyed array of subarrays containing the child
model data.

| 
| The load($uid) method fully loads all related records with a single
  query for each relationship. The save($data) method The delete($uid)
  method deletes the parent then deletes MM relations records or removes
  the uid from the parent record and/or, if the isDependant flag is
  true, deletes any of the related records. "key in child" relationships
  do this by default. the search($criteria,$configuration) method treats
  each configuration key as a criteria, searching for a string match in
  any of the comma seperated values found in the subkey fields,
  requiring each whitespace seperated search token in the matching
  criteria key eg searchbyname.fields=first_name,last_name would accept
  criteria $criteria['searchbyname']='john smith' and return all records
  containing john either first or last name and containing smith in
  either first or last name

joins to related tables will be added where the configuration and
criteria indicate the join is required. joins are grouped by the parent
primary key eg searchbyemail.fields=tx_partner_contactinfo.email
Additional join criteria are added to the query to allow searching in
the joined table if criteria matching the searchbyemailkey are found.

References
----------

tedneward.com
^^^^^^^^^^^^^

external link [outdated wiki link] [1]
http://blogs.tedneward.com/PermaLink,guid,33e0e84c-1a82-4362-bb15-eb18a1a1d91f.aspx
[outdated link]

.. _propel-1:

propel
^^^^^^

external link [outdated wiki link] [2]
http://propel.phpdb.org/trac/wiki/Users/Documentation/1.2/Relationships
[outdated link]

cakephp.org-models
^^^^^^^^^^^^^^^^^^

external link [outdated wiki link] [3]
http://www.cakephp.org/chapter/models [outdated link]

pear.php.net-db-dataobject
^^^^^^^^^^^^^^^^^^^^^^^^^^

external link [outdated wiki link] [4]
http://pear.php.net/manual/en/package.database.db-dataobject.php

phplens.com-adodb
^^^^^^^^^^^^^^^^^

external link [outdated wiki link] [5] http://phplens.com/lens/adodb
[outdated link]

webempoweredchurch.org-tcaobj
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

external link [outdated wiki link] [6]
http://svn.webempoweredchurch.org/misc/browser/trunk/tcaobj [outdated
link]

t3ext-persistence
^^^^^^^^^^^^^^^^^

external link [outdated wiki link] [7]
http://svn.syntithenai.com/svn/t3ext/persistence [outdated link]

doctrine
^^^^^^^^

external link [outdated wiki link] [8] http://phpdoctrine.org/

Current Project Members
-----------------------

=============== ========================
*name*          *contact*
Steve Ryan      stever - at -gmail.com
Alexey Boriskin sun.void - at -gmail.com
name            contact
=============== ========================

Wishlist
--------

-  check how it can be connected with lib/div

   -  A: currently working on classes based on lib/div in an extension
      persistence - see persistence [outdated wiki link]
      http://svn.syntithenai.com/svn/t3ext/persistence [outdated link]
