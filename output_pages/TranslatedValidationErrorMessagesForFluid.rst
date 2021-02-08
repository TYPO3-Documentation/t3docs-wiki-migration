.. include:: /Includes.rst.txt

==============================================
Translated validation error messages for Fluid
==============================================

The Problem
===========

Right now, all strings in a validator are hard-coded. This means, if
there is any error in validation, there is an english error message
displayed. Currently, there is no standard way to translate this error
message.

The pragmatic solution
======================

All errors also have an **error code**, which is a long number unique to
each error. The idea is that we will use this error number as the
identifier for the locallang file. This solution with the error number
is kinda ugly, but it works :-) We will work on a more robust solution
built right into FLOW3 / Extbase.

Please create a partial called @formErrors.html@ which contains the
following contents: (This is taken and adapted from the Blog Example)

::

   <f:form.validationResults for="{for}">
       <div >
           <!-- {error.code} -->
           <f:translate key="error.{error.code}">{error.message}</f:translate>
           <f:if condition="{error.propertyName}">
               <p>
                   <strong>{error.propertyName}</strong>:
                   <f:for each="{error.errors}" as="errorDetail">
                       <!-- {errorDetail.code} -->
                       <f:translate key="error.{errorDetail.code}">{errorDetail.message}</f:translate>
                   </f:for>
               </p>
           </f:if>
       </div>
   </f:form.validationResults>

Inside the *Resources/Private/Language/locallang.xml* of your extension,
create language keys with the following form:

::

   <label index="error.1242859509">Validation Error ...</label>

Now, you can call the just created partial like the following to output
an error message:

::

   <f:render partial="formErrors" arguments="{for: 'blog'}" />

Instead of blog in the above snippet, you can use the following things:

-  **Empty string**: Then, all error messages are displayed.
-  *blog* or a similar object: All validation errors for this \*object\*
   are displayed.
-  *blog.title* or a similar property path: All validation errors for
   this **property** are displayed.

Individual error messages
=========================

If you want to face the user with more individual error messages
considere taking the property name into account. E.g:

::

   <f:translate key="error.{error.propertyName}.{errorDetail.code}">{errorDetail.message}</f:translate>

First error only
================

If you have a bunch of validators for a certain parameter e.g. :

::

   @validate $zip notEmpty, regularExpression(regularExpression="/^[0-9]{5}$/")

And don't want to bother the user with someting like: "Zip code is
empty, Zip code is invalid"

You could just display only the first validation error for a certain
property by:

::

   <f:form.validationResults>
       <f:translate key="error.{error.errors.0.code}" />
   </f:form.validationResults>
