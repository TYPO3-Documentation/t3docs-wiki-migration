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
      SCOPE=exceptions docker-compose run --rm convert

2. Check and adapt file `_map_of_failed_urls.php <output_exceptions/_map_of_failed_urls.php>`_ for
   outdated links which should be mapped to valid urls. Run the script after adaption again.
3. Check file `_warnings.txt <output_exceptions/_warnings.txt>`_ for conversion warnings which should
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
      SCOPE=pages docker-compose run --rm convert

2. Check and adapt file `_map_of_failed_urls.php <output_pages/_map_of_failed_urls.php>`_ for outdated links which
   should be mapped to valid urls. Run the script after adaption again.
3. Check file `_warnings.txt <output_pages/_warnings.txt>`_ for conversion warnings which should be handled.
4. Edit reST files of folder `output_pages <output_pages>`_ manually to make them ready for use in docs.typo3.org.

Developing
----------

Debug the conversion script by prepending the Xdebug specific environment variables ``XDEBUG_CONFIG`` and
``PHP_IDE_CONFIG`` to define the interaction with your IDE.

.. code-block:: bash

   # Linux
   XDEBUG_CONFIG="idekey={idekey}" PHP_IDE_CONFIG="serverName={serverName}" make (exceptions|pages)
   # e.g.
   XDEBUG_CONFIG="idekey=PHPSTORM" PHP_IDE_CONFIG="serverName=t3docs-wiki-migration" make exceptions

   # MacOS and Windows
   XDEBUG_CONFIG="idekey={idekey}" PHP_IDE_CONFIG="serverName={serverName}" SCOPE="(exceptions|pages)" docker-compose run --rm convert
   # e.g.
   XDEBUG_CONFIG="idekey=PHPSTORM" PHP_IDE_CONFIG="serverName=t3docs-wiki-migration" SCOPE="exceptions" docker-compose run --rm convert

Xdebug is configured to communicate via port 9000.

Uninstallation
--------------

Remove the environment from your operating system by

.. code-block:: bash

   # Linux
   make clean

   # MacOS and Windows
   docker-compose down --rmi all --volumes
