.. include:: /Includes.rst.txt

=====================
Fluid Inline Notation
=====================

| 
| For every view helper you have the choice of using the *tag based*
  syntax or the so called *inline notation*.

Here a list of view helper examples and the corresponding inline
notation:

+-----------------------+-----------------------+-----------------------+
| Syntax example        | Tag notation          | Inline notation       |
+-----------------------+-----------------------+-----------------------+
| Variable as parameter | ::                    | ::                    |
|                       |                       |                       |
|                       |    <f:foo argumen     |    {f:foo(arg         |
|                       | t="{someVariable}" /> | ument: someVariable)} |
+-----------------------+-----------------------+-----------------------+
| Variable as tag       | ::                    | ::                    |
| content               |                       |                       |
|                       |    <f:foo>{           |    {som               |
|                       | someVariable}</f:foo> | eVariable -> f:foo()} |
+-----------------------+-----------------------+-----------------------+
| String                | ::                    | ::                    |
|                       |                       |                       |
|                       |    <f:foo arg         |    {f:foo(arg         |
|                       | ument="someString" /> | ument: 'someString')} |
+-----------------------+-----------------------+-----------------------+

ViewHelper as array value
=========================

::

   <f:translate key="{msg_id}" arguments="{1: '{f:format.date(date: record.validend, format: \'d.m.Y H:i:s\')}'}" />

==========================================================
Special precautions for nested inline notation ViewHelpers
==========================================================

Additional nesting levels require more escaped quotation marks!

::

   <f:example arguments="{1: '{f:format.date(date: record.validend, format: \'{f:test(value:\\'nested level 2\\')}\')}'}" />

https://techblog.sitegeist.de/fluid-escaping-nested-inline-viewhelper/

=======================
Things that do not work
=======================

No equivalents
==============

There is no equivalent inline notation for the following syntax:

::

   <f:foo>someString</f:foo>

This does **not work**:

::

   {'foo' -> f:foo()}

============
General info
============

When to use which syntax depends on your taste and the use case.

Usually you want to use the tag syntax for view helpers that render as
html tag (e.g. ``<f:image />``) and the inline notation to render a
variable/string in a special format. Of course you can also nest view
helpers (see `FAQ <extbase-und-fluid-faq>`__).
