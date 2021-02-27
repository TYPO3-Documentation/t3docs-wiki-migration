SHELL := /bin/bash

BRANCH ?= $$(git rev-parse --abbrev-ref HEAD 2> /dev/null)

.PHONY: env build exceptions pages mediawiki clean

env:
	@echo "UID=$$(id -u)" > .env
	@echo "GID=$$(id -g)" >> .env

build:
	@echo "Build TYPO3 Wiki migration environment [branch: $(BRANCH)]"
	@docker-compose build --force-rm
	@docker-compose run --rm composer-install

exceptions: env
	@echo "Convert TYPO3 Wiki exception pages into reST files"
	@docker-compose run -e "SCOPE=exceptions" --rm convert

pages: env
	@echo "Convert TYPO3 Wiki pages into reST files"
	@docker-compose run -e "SCOPE=pages" --rm convert

mediawiki: env
	@echo "Convert MediaWiki pages into reST files"
	@docker-compose run -e "SCOPE=mediawiki" --rm convert

clean:
	@echo "Remove TYPO3 Wiki migration environment"
	@docker-compose down --rmi all --volumes
