.. include:: /Includes.rst.txt

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
|    `PHP               |    `XML /             | ::                    |
|    S                  |    HTML </            |                       |
| cript </wiki/Help:Con | wiki/Help:Contents#Sy |                       |
| tents#Syntax-Highligh | ntax-Highlighting_for |   <h1>An example</h1> |
| ting_for_PHP-Code>`__ | _HTML%20and%20XML>`__ |                       |
|    [deprecated wiki   |    [deprecated wiki   |                       |
|    link]              |    link]              |                       |
|                       |                       |                       |
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
|    `PHP               |    `XML /             | ::                    |
|    S                  |    HTML </            |                       |
| cript </wiki/Help:Con | wiki/Help:Contents#Sy |    <p>Low, High</p>   |
| tents#Syntax-Highligh | ntax-Highlighting_for |                       |
| ting_for_PHP-Code>`__ | _HTML%20and%20XML>`__ |                       |
|    [deprecated wiki   |    [deprecated wiki   |                       |
|    link]              |    link]              |                       |
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
|    `PHP               |    `XML /             | ::                    |
|    S                  |    HTML </            |                       |
| cript </wiki/Help:Con | wiki/Help:Contents#Sy |    <p>Pear: 1.2</p>   |
| tents#Syntax-Highligh | ntax-Highlighting_for |                       |
| ting_for_PHP-Code>`__ | _HTML%20and%20XML>`__ |                       |
|    [deprecated wiki   |    [deprecated wiki   |                       |
|    link]              |    link]              |                       |
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
|    `PHP               |    `XML /             | ::                    |
|    S                  |    HTML </            |                       |
| cript </wiki/Help:Con | wiki/Help:Contents#Sy |    <p>Pear</p>        |
| tents#Syntax-Highligh | ntax-Highlighting_for |                       |
| ting_for_PHP-Code>`__ | _HTML%20and%20XML>`__ |                       |
|    [deprecated wiki   |    [deprecated wiki   |                       |
|    link]              |    link]              |                       |
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
|    `PHP                           |    `XML /                         |
|                                   |    HTML                           |
|   Script </wiki/Help:Contents#Syn |  </wiki/Help:Contents#Syntax-High |
| tax-Highlighting_for_PHP-Code>`__ | lighting_for_HTML%20and%20XML>`__ |
|    [deprecated wiki link]         |    [deprecated wiki link]         |
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
|    `PHP               |    `XML /             | ::                    |
|    S                  |    HTML </            |                       |
| cript </wiki/Help:Con | wiki/Help:Contents#Sy |    1.230e+2           |
| tents#Syntax-Highligh | ntax-Highlighting_for |    0.000e+0           |
| ting_for_PHP-Code>`__ | _HTML%20and%20XML>`__ |                       |
|    [deprecated wiki   |    [deprecated wiki   |                       |
|    link]              |    link]              |                       |
|                       |                       |                       |
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
