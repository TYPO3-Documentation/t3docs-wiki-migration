TYPO3 Wiki Migration
====================

Currently the official TYPO3 documentation is spread across different places. To collect all documentation in one place,
docs.typo3.org, this repository contains the tools and scripts to support the migration of wiki.typo3.org to
docs.typo3.org.

Installation
------------

1. Install Docker and Docker-Compose.
2. Build the environment by

   ::

      # Linux
      make build
      # MacOS and Windows
      docker-compose build --force-rm
      docker-compose run --rm composer-install

Conversion of Wiki Exception Pages
----------------------------------

1. Copy TYPO3 wiki exception HTML pages to folder `/source</source>`__.
2. Run conversion script by

   ::

      # Linux
      make convert
      # MacOS and Windows
      docker-compose run --rm convert-html-to-rst

3. Check folder `/target</target>`__ for reST files - ready for use in docs.typo3.org.
