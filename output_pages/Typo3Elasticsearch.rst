.. include:: /Includes.rst.txt
.. highlight:: php

.. _typo3-elasticsearch:

===================
TYPO3.ElasticSearch
===================

**TYPO3.ElasticSearch** is a Flow package that use ElasticSearch to
handle indexing and advanced searching for your Flow or Neos project.

**Status of the project**: development, no stable release currently

Roadmap
=======

Before releasing the version 1.0, we need to define the current Roadmap.

+-------------+-------------+-------------+-------------+------------+
| Feature     | Status      | Owner       | Priority    | Complexity |
+-------------+-------------+-------------+-------------+------------+
| Rename      | required    | Dominique   | ASAP        | --         |
| TYPO3.El    |             | Feyer       |             |            |
| asticSearch |             |             |             |            |
| to          |             |             |             |            |
| Flowpack.El |             |             |             |            |
| asticSearch |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| Moving      | maybe / to  | --          | --          | --         |
| project to  | be discuss  |             |             |            |
| Github ?    |             |             |             |            |
| with a      |             |             |             |            |
| mirror to   |             |             |             |            |
| gi          |             |             |             |            |
| t.typo3.org |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| TY          | required    | Sebastian   | After       | --         |
| PO3.TYPO3CR |             | K.          | T3CONDE ... |            |
| Indexing    |             |             |             |            |
| support     |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| TYPO3.Neos  | required    | Robert L.   | ASAP,       | --         |
| full text   |             |             | octobrer    |            |
| search      |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| Repository  | in progress | Dominique   | --          | --         |
| and Query   |             | Feyer       |             |            |
| support for |             |             |             |            |
| Doctrine    |             |             |             |            |
| entity      |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| Configure   | done        | --          | --          | --         |
| indexing by |             |             |             |            |
| annotation  |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| Configure   | needed      | --          | --          | --         |
| indexing by |             |             |             |            |
| YAML        |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| Backend     | no, but we  | --          | --          | --         |
| Abstraction | need to     |             |             |            |
|             | provide a   |             |             |            |
|             | standard    |             |             |            |
|             | interface   |             |             |            |
|             | for basic   |             |             |            |
|             | search      |             |             |            |
|             | feature     |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| RAW search  | done        | --          | --          | --         |
| query       |             |             |             |            |
| (simple     |             |             |             |            |
| array       |             |             |             |            |
| serialized  |             |             |             |            |
| to JSON)    |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| ES style    | needed      | --          | --          | --         |
| Repository  |             |             |             |            |
| (one        |             |             |             |            |
| repository  |             |             |             |            |
| = multiple  |             |             |             |            |
| enti        |             |             |             |            |
| ty/document |             |             |             |            |
| type        |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| Flow / EEL  | needed      | --          | --          | --         |
| query       |             |             |             |            |
| support     |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+
| Content     | needed      | --          | --          | --         |
| Security    |             |             |             |            |
| Support     |             |             |             |            |
+-------------+-------------+-------------+-------------+------------+

TYPO3.TYPO3CR Indexing support
==============================

-  Full page (HTML content) indexing based on HTTP component
-  HTTP component preprocess raw HTML to extract indexable parts
-  Internal HTTP header to control/extend indexing

Rename TYPO3.ElasticSearch to Flowpack.ElasticSearch
====================================================

Required, because the package is not an official association backed
project. We can use the Flowpack incubator for that package.

Moving project to Github ? with a mirror to git.typo3.org
=========================================================

Why ? Maybe we can use it to test some workflow with Github, and offer
more visibility to the project.

.. _typo3.typo3cr-indexing-support-1:

TYPO3.TYPO3CR Indexing support
==============================

Sebastian will try to work on a nice support for Node indexing. Every
node in a single index, with some advanced indexing field configuration
preset (small text, tease, long text, ...). As always sane default must
be provided.

TYPO3.Neos full text search
===========================

Based on HTTP component, configured with internal HTTP headers to add
feature, like node type tagging, expire, ...

Repository and Query support for Doctrine entity
================================================

The current WIP is on Gerrit: https://review.typo3.org/#/c/20167/

The main idea is to offer a nice API to query ES, but not to support all
type of queries. Advanced query can always be done directly with JSON,
and the ES API is to rich to abstract everything.

Configure indexing by YAML
==========================

Configuring indexes by Annotation is not enougth, we need to be able to
index entity from external package, or having more than one index for a
specific entity. Will add some ElasticSearch.yaml configuration for
that.

Backend Abstraction
===================

We don't need / wont and abtracted backend. This difference between each
backend are to important to implement it in a easy way. And we wont to
support event advanced features, not available in Solr backend, per
exemple.

BasicSearchBackendInterface
---------------------------

To allow more higher level backage to use different type of backend, we
need to define a basic search interface to allow some query like "full
text in all fields", "full text in specific field", ... This interface
need to be defined ASAP

External links
==============

-  Forge:
   https://forge.typo3.org/projects/show/package-typo3-elasticsearch
-  Official ElasticSearch website: http://www.elasticsearch.org/
