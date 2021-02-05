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
      make exceptions

      # MacOS and Windows
      docker-compose run -e "SCOPE=exceptions" --rm convert

2. Check and adapt file `map_of_failed_urls.php <output_exceptions/map_of_failed_urls.php>`_ for
   outdated links which should be mapped to valid urls. Run the script after adaption again.
3. Check file `warnings.txt <output_exceptions/warnings.txt>`_ for conversion warnings which should
   be handled.
4. Edit reST files of folder `output_exceptions <output_exceptions>`_ manually to make them ready for use in
   docs.typo3.org.

Conversion of Wiki Pages
------------------------

1. Run conversion script by

   .. code-block:: bash

      # Linux
      make pages

      # MacOS and Windows
      docker-compose run -e "SCOPE=pages" --rm convert

2. Check and adapt file `map_of_failed_urls.php <output_pages/map_of_failed_urls.php>`_ for outdated links which
   should be mapped to valid urls. Run the script after adaption again.
3. Check file `warnings.txt <output_pages/warnings.txt>`_ for conversion warnings which should be handled.
4. Edit reST files of folder `output_pages <output_pages>`_ manually to make them ready for use in docs.typo3.org.

Uninstallation
--------------

Remove the environment from your operating system by

.. code-block:: bash

   # Linux
   make clean

   # MacOS and Windows
   docker-compose down --rmi all --volumes
