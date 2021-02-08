.. include:: /Includes.rst.txt

============================
New reST Project with Sphinx
============================

This tutorial describes how to create a blank Sphinx project for your
own documentation.

-  First of all create a dedicated directory for your documentation
   project
-  Then, from the command-line, type

::

   $ sphinx-quickstart

and follow the wizard:

::

   Welcome to the Sphinx 1.1.3 quickstart utility.
   Please enter values for the following settings (just press Enter to
   accept a default value, if one is given in brackets).

   Enter the root path for documentation.
   > Root path for the documentation [.]: ENTER

   You have two options for placing the build directory for Sphinx output.
   Either, you use a directory "_build" within the root path, or you separate
   "source" and "build" directories within the root path.
   > Separate source and build directories (y/N) [n]: y

   Inside the root directory, two more directories will be created; "_templates"
   for custom HTML templates and "_static" for custom stylesheets and other static
   files. You can enter another prefix (such as ".") to replace the underscore.
   > Name prefix for templates and static dir [_]: ENTER

   The project name will occur in several places in the built documentation.
   > Project name: My First Project
   > Author name(s): Xavier Perseguers

   Sphinx has the notion of a "version" and a "release" for the
   software. Each version can have multiple releases. For example, for
   Python the version is something like 2.5 or 3.0, while the release is
   something like 2.5.1 or 3.0a1.  If you don't need this dual structure,
   just set both to the same value.
   > Project version: 1.0
   > Project release [1.0]: 1.0.0-alpha

   The file name suffix for source files. Commonly, this is either ".txt"
   or ".rst".  Only files with this suffix are considered documents.
   > Source file suffix [.rst]: ENTER

   One document is special in that it is considered the top node of the
   "contents tree", that is, it is the root of the hierarchical structure
   of the documents. Normally, this is "index", but if your "index"
   document is a custom template, you can also set this to another filename.
   > Name of your master document (without suffix) [index]: ENTER

   Sphinx can also add configuration for epub output:
   > Do you want to use the epub builder (y/N) [n]: ENTER

   Please indicate if you want to use one of the following Sphinx extensions:
   > autodoc: automatically insert docstrings from modules (y/N) [n]: ENTER
   ...
   > intersphinx: link between Sphinx documentation of different projects (y/N) [n]: y
   ...

   A Makefile and a Windows command file can be generated for you so that you
   only have to run e.g. `make html' instead of invoking sphinx-build
   directly.
   > Create Makefile? (Y/n) [y]: ENTER
   > Create Windows command file? (Y/n) [y]: ENTER

   Creating file ./source/conf.py.
   Creating file ./source/index.rst.
   Creating file ./Makefile.
   Creating file ./make.bat.

   Finished: An initial directory structure has been created.

   You should now populate your master file ./source/index.rst and create other documentation
   source files. Use the Makefile to build the docs, like so:
      make builder
   where "builder" is one of the supported builders, e.g. html, latex or linkcheck.

Using the TYPO3 Template
========================

HTML Output
-----------

Edit ``source/conf.py`` and search for entries ``html_theme`` and
``html_theme_path`` and put in the full path where you checked out the
`RestTools
project </wiki/index.php?title=Rendering_reST_on_Linux&action=edit&redlink=1>`__
[not available anymore]:

::

   # The theme to use for HTML and HTML Help pages.  See the documentation for
   # a list of builtin themes.
   html_theme = 'typo3sphinx'

   # Add any paths that contain custom themes here, relative to this directory.
   html_theme_path = ['/opt/local/RestTools/ResourcesForSphinxAndDocutils/res/sphinx/themes/']

PDF Output
----------

Edit ``source/conf.py``. For LaTeX output, you need to change the
document class being used, that is the last part of the entry
``latex_documents``:

::

   # Grouping the document tree into LaTeX files. List of tuples
   # (source start file, target name, title, author, documentclass [howto/manual]).
   latex_documents = [
     ('index', 'MyFirstProject.tex', u'My First Project',
      u'Xavier Perseguers', 'typo3manual'),
   ]

That is, **typo3manual** instead of **manual**. The compiler will look
for a class **sphinxtypo3manual**. The full tutorial on how installing
the LaTeX resources is not yet available. If you have some knowledge of
LaTeX, please check out the Makefile within ``RestTools/LaTeX`` and
directory ``RestTools/LaTeX/fonts`` to convert TYPO3 fonts to a suitable
format for LaTeX rendering.
