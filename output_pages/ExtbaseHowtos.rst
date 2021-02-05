.. include:: /Includes.rst.txt
.. highlight:: php

==============
Extbase HowTos
==============

.. container::

   **Content Type:** HowTo [outdated wiki link].

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript. info [outdated wiki link]

Extbase snippets
================

Getting into MVC can be complicated when you're starting out. This is a
collection of useable code snippets and example code to get into
extbase/FLOW3.

Accessing GET/POST vars
-----------------------

If you already wrote extensions for TYPO3, you'll probably know that
every GET/POST variable sent with the prefix "tx_myextension_pi1" will
be available in ``$this->piVars`` of the plugin "pi1" of "myextension".
In extbase, those "piVars" are accessed by using:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $this->request->getArguments()

or

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

       $this->request->getArgument('variable')

So, if you have a variable called "tx_myextension_pi1[show]", you can
retrieve it by one of the following two ways:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

       $args = $this->request->getArguments();
       $showUid = $args['show'];

or in a simpler way:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

       // Notice that the method is not called "getArgumentS" (plural noun) but "getArgument" (singular noun)
       $showUid = $this->request->getArgument('show');

The latter form allows you to directly retrieve a variable from within
the first level of the GET/POST var sub-array for your extension.

getArgument() will throw an error if no corresponding GET/POST variable
has been sent. To test for the existence of a GET/POST variable use:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $this->request->hasArgument('variable')

Accessing cObj->data
--------------------

If you have extension development experience, you'll surely have used
``$this->cObj`` or ``$this->cObj->data`` to access the data of the
currently rendered content element/plugin. When using extbase, there is
no ``$this->cObj`` object available. You have to retrieve the data of
the current plugin like this:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $cObjData = $this->request->getContentObjectData();

``$cObjData`` will then contain the same data as ``$this->cObj->data``
would have when programming traditional plugins.

**Since Extbase 1.4 this is marked deprecated**, use the
configurationManager instance instead:

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

      $this->configurationManager->getContentObject();

The view. Or: Using fluid templates
-----------------------------------

When you work with old-school TYPO3 HTML templates, you simply have to
insert markers like "###HEADER###" or subparts defined by constructs
like

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

       < !-- ###CONTENT_AREA### begin -->
       This will get replaced by the subpart contents
       < !-- ###CONTENT_AREA### -->

This kind of templating is quite different from what Fluid works like.
Fluid is a templating language capable of loops, conditions, includes,
etc. This permits you to put quite a bit of flexibility in rendering
templates; so you do not need hundreds of differente templates and
markers if a simple

block should be shown or not just depending on the contents of a simple
variable. If you know templating engines like
`Smarty <http://www.smarty.net/>`__, you will get into using Fluid very
quickly. So what does such a Fluid template look like? The below is a
simple example

.. container::

   XML / HTML [outdated wiki link]

.. container::

   ::

       <f:if condition="{card.cardNumber}">
          <f:then>
              Your card has a balance of {balance} &euro;
          </f:then>
       
          <f:else>
              No card number submitted!
          </f:else>
       </f:if>

The tags "<f:if>", "<f:then>" and "<f:else>" and their respective
closing tags are, of course, not HTML tags; but Fluid XML tags. You can
validate Fluid templates using an XML validator.

How to assign view variables (like "card" in the example above) to the
template is well explained in the existing `Fluid
documentation <https://git.typo3.org/TYPO3v4/CoreProjects/MVC/doc_extbase.git/tree/HEAD:/Documentation/Manual/en>`__.

Including other resources
^^^^^^^^^^^^^^^^^^^^^^^^^

It is currently not possible to include another Fluid or HTML template
using a TYPO3 Location (e.g. "EXT:") or file system path. All template
associated stuff is stored in subdirectories of the extension's
directory:

::

   Resources/Private/Layout/
   Resources/Private/Templates/$CONTROLLER$/
   Resources/Private/Partials/

So what are those directories for? When you are coding your own extbase
extension, you'll often start with defining controllers and their
actions. When you have to code the view for your extension and you have
a controller named "Contacts", you'll have to create a template in
"Resources/Private/Templates/Contacts/" - this corresponds to an own
directory of templates for each controller. Inside this directory, you
have to create a template for each action you have defined. So if you
have defined the actions "list" and "detail", you'd create corresponding
templates named "list.html" and "detail.html" in that directory.

The other two directories, "Partials" and "Layout", are used for
reusable template snippets ("partials") and super-templates called
"layouts".

Why this? This is easy to explain. If you start doing more complex
templates you'll soon recognize the need for reusing pieces of the
template at different locations. So if you have a block showing some
information about a user visiting your site, and you want to have this
block in the list and detail view it would come handy to put this in
some sort of template snippet repository for you extension and include
it if needed. This is what the "Partials" folder is for. Assume you
create a file name "userInfo.html" in the Partials directory having the
following content:

.. container::

   XML / HTML [outdated wiki link]

.. container::

   ::

       <div class="userInfo">
         Your username is: {user.username}
       </div>

You can include this snippet at other locations of your templates by
using the following statement:

.. container::

   XML / HTML [outdated wiki link]

.. container::

   ::

       <f:render partial="userInfo" arguments="{user: userRecord}"/>

The arguments parameter defines which parameters should get passed to
the partial. In this case you have a variable name "user" available in
the partial which will have the contents of the "userRecord" variable as
seen in the scope of the main template. You can pass all arguments to a
partial if you use ``arguments="{_all}"``.

The third directory "Layout" can get used to apply a layout to each
template being used. To use this feature you have to put the contents of
your template "detail.html" into "section" tags and add a tag defining
the layout to use at the top of your template. This should look like in
the following example:

.. container::

   XML / HTML [outdated wiki link]

.. container::

   ::

       <f:layout name="default" />
       
       <f:section name="contactData">
           <div class="block">
             Name: {contact.firstname} {contact.lastname}
             Phone: {contact.phone}
           </div>
       </f:section>
       
       <f:section name="orderAddress">
           <div class="block">
            Street: {order.street}
            ZIP-City: {order.zip} {order.city}
          </div>
       </f:section>
       
       <f:section name="billingAddress">
          <div class="block">
            Street: {billing.street}
            ZIP-City: {billing.zip} {billing.city}
          </div>
       </f:section>

What happens then, is that Fluid will start using the file
"Layouts/default.html" as super-template above the "detail.html"
template. Every <f:section> tag will get loaded into an internal buffer
and will not be visible in the output by default. You then have to
define which sections should get display in the output by referencing
them in the "Layouts/default.html" file:

.. container::

   XML / HTML [outdated wiki link]

.. container::

   ::

       <h1>Contact detail</h1>
       
       <f:render section="contactData" />
       <f:render section="orderAddress" />
       <f:render section="billingAddress" />

By simply omitting one of the <f:render> tags you could create a second
layout of this blocks without redefining everything.

.. container::

   Question:
   UNCLEAR: How can I use different layouts from within the same
   "Templates/Controller/action.html" file? Is something like
   ``"<f:layout name={useLayout} />"`` required?

   .. container::

   *Please remove "{{Question}}" when the problem is solved. See all
   questions [outdated wiki link].*
