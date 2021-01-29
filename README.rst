TYPO3 Wiki Migration
====================

Currently the official TYPO3 documentation is spread across different places. To collect all documentation in one place,
docs.typo3.org, this repository contains the tools and scripts to support the migration of wiki.typo3.org to
docs.typo3.org.

Installation
------------

1. Install `Docker <https://docs.docker.com/get-docker/>`_ and `Docker-Compose <https://docs.docker.com/compose/install/>`_.
2. Build the environment by

   .. code-block:: bash

      # Linux
      make build

      # MacOS and Windows
      docker-compose build --force-rm
      docker-compose run --rm composer-install

Conversion of Wiki Exception Pages
----------------------------------

1. Run conversion script by

   .. code-block:: bash

      # Linux
      make convert

      # MacOS and Windows
      docker-compose run --rm convert-html-to-rst

2. Check folder `output <output>`_ for reST files and edit manually to make them ready for use in docs.typo3.org.

Uninstallation
--------------

Remove the environment from your operating system by

.. code-block:: bash

   # Linux
   make clean

   # MacOS and Windows
   docker-compose down --rmi all --volumes
