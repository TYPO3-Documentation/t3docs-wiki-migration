.. include:: /Includes.rst.txt

=========================
Rendering reST on Windows
=========================

.. container::

   notice - Newer documentation available

   .. container::

      `Writing Documentation » How to render
      documentation <https://docs.typo3.org/m/typo3/docs-how-to-document/master/en-us/RenderingDocs/Index.html>`__

| 
| We use `Sphinx <http://sphinx.pocoo.org/>`__ [not available anymore]
  as a tool-chain to generate TYPO3 documentation with
  `reStructuredText <http://docutils.sourceforge.net/rst.html>`__
  (commonly abbreviated as reST).

Requirements
============

-  **Python**: used by Sphinx
-  **Sphinx**: main tool used to transform reST (.rst) into HTML or PDF
-  **TYPO3 templates**: official TYPO3 templates for reST

.. container::

   notice - Note

   .. container::

      These three components may be automatically installed and
      configured for you if you use the `TYPO3 extension
      sphinx <https://extensions.typo3.org/extension/sphinx/>`__
      available in TER.

Optional components:

-  **LaTeX**: document preparation system used as intermediate format by
   Sphinx to generate prettier PDF out of reST files

.. container::

   notice - Note

   .. container::

      The documentation of the Sphinx extension comes with a `dedicated
      chapter <https://docs.typo3.org/typo3cms/extensions/sphinx/AdministratorManual/RenderingPdf/Index.html>`__
      [not available anymore] for rendering PDF with LaTeX.

Installing the Components
=========================

This tutorial is based on article
`[1] <http://6109.hidepiy.com/110/the-first-step-of-sphinx-in-windows-xp-orz>`__.

Installing Python
-----------------

Download the Python Windows Installer from
http://www.python.org/download/releases/. The version we tested is
Python 2.7, the 32 bit version ("Windows X86 MSI Installer") even we
were on a 64-bit operating system as the setup tools seemed to have
problem detecting our version of Python :(

Installing the Python Tools
---------------------------

Then download the Python Tools from
http://pypi.python.org/pypi/setuptools#files (choose the .exe for Python
2.7) and execute it. The install wizard should install the Python tools
smoothly (hopefully).

Set Environment variable by opening Control Panel > System > Advanced
system parameters > Environment variables and add

::

   PYTHON_HOME    C:\Python27

and update ``PATH`` to read:

::

   PATH   ...;%PYTHON_HOME%;%PYTHON_HOME%\Scripts;

Of course you should change ``C:\Python27`` to match the install
directory you chose.

Installing graph tools
----------------------

Download the current stable version of Graphviz from
http://graphviz.org/Download_windows.php (at time of writing this was
graphviz-2.28.0.msi). Then execute the msi file to install Graphviz.

Installing Sphinx
-----------------

Great, we're nearly done!

Open a command line (Start > All Programs > Accessories > Command Line)
and execute the following commands:

::

   C:\windows\System32> python --version
      Python 2.7.3

   C:\windows\System32> easy_install pyyaml 
   C:\windows\System32> easy_install sphinx
   C:\windows\System32> easy_install blockdiag
   C:\windows\System32> easy_install sphinxcontrib-blockdiag
   C:\windows\System32> easy_install seqdiag
   C:\windows\System32> easy_install sphinxcontrib-seqdiag
   C:\windows\System32> easy_install actdiag
   C:\windows\System32> easy_install sphinxcontrib-actdiag
   C:\windows\System32> easy_install nwdiag
   C:\windows\System32> easy_install sphinxcontrib-nwdiag

Installing TYPO3 Templates
--------------------------

The TYPO3 templates are available for the time being from a dedicated
Git repository. If you did not yet configure your environment for using
Git, please do so using one of the `Git
Tutorials <https://wiki.typo3.org/wiki/index.php?title=Contribution_Walkthrough_Tutorials&action=edit&redlink=1>`__
[not available anymore].

The template projects is available from
https://wiki.typo3.org/git://git.typo3.org/Documentation/RestTools.git
[not available anymore]. Clone that repository and move into it:

::

   $ git clone https://wiki.typo3.org/git://git.typo3.org/Documentation/RestTools.git [not available anymore]
   $ cd RestTools

Move down one more sub-folder and run the provided installer:

::

   $ cd ./ExtendingSphinxForTYPO3
   $ python setup.py install

This installs the TYPO3 Sphinx theme on your machine. Next time you will
compile your documentation with

::

   C:\> make html

you will have a nicer HTML documentation using the official TYPO3
template.

Installing LaTeX
----------------

Install the full MiKTeX distribution from http://www.miktex.org/. Choose
the "MiKTeX 2.9 Basic Installer", run the installer:

-  Install package on the fly: Ask me first (or "Yes" as you want)

The first time you compile a PDF document from your reST documentation
you will have to allow the download and installation of a few packages.
Alternatively, you could choose to install a full-fledge version of
MiKTeX (but it's a LOT bigger).

First Project with Sphinx
=========================

Please read `our dedicated tutorial <new-rest-project-with-sphinx>`__.
