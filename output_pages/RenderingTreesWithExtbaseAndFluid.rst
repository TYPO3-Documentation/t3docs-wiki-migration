.. include:: /Includes.rst.txt

======================================
Rendering trees with Extbase and Fluid
======================================

.. container::

   notice - This information is outdated

   .. container::

      The information on this page may be partly outdated

Imagine you have a domain model "Category". Each category can have sub
categories - so it is a hierarchical dependency. Now you want to render
that category tree with Fluid. Here's what you can do:

SomeController.php
==================

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $categories = array(
          array(
              'title' => 'Category 1',
              'subCategories' => array(
                  array(
                      'title' => 'Category 1a'
                  ),
                  array(
                      'title' => 'Category 2b'
                  ),
                  array(
                      'title' => 'Category 1c',
                      'subCategories' => array(
                          array(
                              'title' => 'Category 1ca'
                          )
                      )
                  )
              )
          ),
          array(
              'title' => 'Category 2',
          ),
          array(
              'title' => 'Category 3',
              'subCategories' => array(
                  array(
                      'title' => 'Category 3a',
                      'subCategories' => array(
                          array(
                              'title' => 'Category 3aa'
                          ),
                          array(
                              'title' => 'Category 3ab'
                          )
                      )
                  ),
                  array(
                      'title' => 'Category 3b'
                  ),
              )
          ),
      );
      $this->view->assign('categories', $categories);

NOTE: This could of course also be an object with the properties "title"
and "subCategories"

SomeTemplate.html
=================

::

   <f:render section="categoryList" arguments="{categories: categories}" />

   <f:section name="categoryList">
       <ul>
           <f:for each="{categories}" as="category">
               <li>
                   {category.title}
                   <f:if condition="{category.subCategories}">
                       <f:render section="categoryList" arguments="{categories: category.subCategories}" />
                   </f:if>
               </li>
           </f:for>
       </ul>
   </f:section>

Rendering trees in the Backend
==============================

If you want to render trees in TCE forms in the backend, you can make
use of the "tree" render mode that is available since TYPO3 v 4.5:

::

   [...]
   'category' => array (
       'label' => 'category',
       'config' => array (
           'type' => 'select',
           'renderMode' => 'tree',
           'treeConfig' => array(
               'parentField' => 'parent'
           ),
       ),
   ),
   [...]
