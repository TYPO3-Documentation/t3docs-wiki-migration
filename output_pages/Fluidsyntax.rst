.. include:: /Includes.rst.txt
.. highlight:: php

===========
FluidSyntax
===========

| 
| `Fluid <fluid>`__ syntax by example

Variables
=========

In the template's HTML code, simply wrap the variable name into curly
braces to output it:

+-----------------------+-----------------------+-----------------------+
| .. container::        | .. container::        | Output:               |
|                       |                       |                       |
|    PHP Script         |    XML / HTML         | ::                    |
|    [outdated wiki     |    [outdated wiki     |                       |
|    link]              |    link]              |                       |
|                       |                       |   <h1>An example</h1> |
| .. container::        | .. container::        |                       |
|                       |                       |                       |
|    ::                 |    ::                 |                       |
|                       |                       |                       |
|       $               |                       |                       |
| this->view->assign('t |      <h1>{title}</h1> |                       |
| itle', 'An example'); |                       |                       |
+-----------------------+-----------------------+-----------------------+

Arrays and objects
------------------

Use a dot ``.`` to access array keys:

+-----------------------+-----------------------+-----------------------+
| .. container::        | .. container::        | Output:               |
|                       |                       |                       |
|    PHP Script         |    XML / HTML         | ::                    |
|    [outdated wiki     |    [outdated wiki     |                       |
|    link]              |    link]              |    <p>Low, High</p>   |
|                       |                       |                       |
| .. container::        | .. container::        |                       |
|                       |                       |                       |
|    ::                 |    ::                 |                       |
|                       |                       |                       |
|                       |       <p>{            |                       |
|  $this->view->assign( | data.0}, {data.1}</p> |                       |
|           'data',     |                       |                       |
|                       |                       |                       |
|  array('Low', 'High') |                       |                       |
|       );              |                       |                       |
+-----------------------+-----------------------+-----------------------+

This also works for object properties:

+-----------------------+-----------------------+-----------------------+
| .. container::        | .. container::        | Output:               |
|                       |                       |                       |
|    PHP Script         |    XML / HTML         | ::                    |
|    [outdated wiki     |    [outdated wiki     |                       |
|    link]              |    link]              |    <p>Pear: 1.2</p>   |
|                       |                       |                       |
| .. container::        | .. container::        |                       |
|                       |                       |                       |
|    ::                 |    ::                 |                       |
|                       |                       |                       |
|                       |                       |                       |
|  $this->view->assign( |     <p>{product.name} |                       |
|           'product',  | : {product.price}</p> |                       |
|                       |                       |                       |
|       (object) array( |                       |                       |
|                       |                       |                       |
|     'name' => 'Pear', |                       |                       |
|                       |                       |                       |
|        'price' => 1.2 |                       |                       |
|           )           |                       |                       |
|       );              |                       |                       |
+-----------------------+-----------------------+-----------------------+

Accessing dynamic keys/properties
---------------------------------

To access an object property or array key whose name is stored in a
variable, put them in curly braces and ``v:variable.get``:

+-----------------------+-----------------------+-----------------------+
| .. container::        | .. container::        | Output:               |
|                       |                       |                       |
|    PHP Script         |    XML / HTML         | ::                    |
|    [outdated wiki     |    [outdated wiki     |                       |
|    link]              |    link]              |    <p>Pear</p>        |
|                       |                       |                       |
| .. container::        | .. container::        |                       |
|                       |                       |                       |
|    ::                 |    ::                 |                       |
|                       |                       |                       |
|                       |       <p><v:vari      |                       |
|  $this->view->assign( | able.get name="produc |                       |
|           'product',  | t.{labelfield}"/></p> |                       |
|                       |                       |                       |
|       (object) array( |                       |                       |
|                       |                       |                       |
|     'name' => 'Pear', |                       |                       |
|                       |                       |                       |
|        'price' => 1.2 |                       |                       |
|           )           |                       |                       |
|       );              |                       |                       |
|                       |                       |                       |
| $this->view->assign(' |                       |                       |
| labelfield', 'name'); |                       |                       |
+-----------------------+-----------------------+-----------------------+

ViewHelper attributes
=====================

Simple
------

+-----------------------------------+-----------------------------------+
| .. container::                    | .. container::                    |
|                                   |                                   |
|    PHP Script [outdated wiki      |    XML / HTML [outdated wiki      |
|    link]                          |    link]                          |
|                                   |                                   |
| .. container::                    | .. container::                    |
|                                   |                                   |
|    ::                             |    ::                             |
|                                   |                                   |
|                                   |                                   |
|      $this->view->assignMultiple( | Now it is: <f:format.date format= |
|           array(                  | "{format}">{date}</f:format.date> |
|               'date'   => time(), |                                   |
|                                   |                                   |
|         'format' => 'Y-m-d H:i:s' |                                   |
|           )                       |                                   |
|       );                          |                                   |
+-----------------------------------+-----------------------------------+

Objects in HTML attributes
--------------------------

Objects to attributes are JSON-like. Keys are not quoted, unquoted
values are variables, quoted values are used as they are:

+-----------------------+-----------------------+-----------------------+
| .. container::        | .. container::        | Output:               |
|                       |                       |                       |
|    PHP Script         |    XML / HTML         | ::                    |
|    [outdated wiki     |    [outdated wiki     |                       |
|    link]              |    link]              |    1.230e+2           |
|                       |                       |    0.000e+0           |
| .. container::        | .. container::        |                       |
|                       |                       |                       |
|    ::                 |    ::                 |                       |
|                       |                       |                       |
|       $this->view->as |       <f:format       |                       |
| sign('value', 23.42); | .printf arguments="{n |                       |
|                       | umber: value}">%.3e</ |                       |
|                       | f:format.printf><br/> |                       |
|                       |       <f:for          |                       |
|                       | mat.printf arguments= |                       |
|                       | "{number: 'value'}">% |                       |
|                       | .3e</f:format.printf> |                       |
+-----------------------+-----------------------+-----------------------+
