SHELL := /bin/bash

BRANCH ?= $$(git rev-parse --abbrev-ref HEAD 2> /dev/null)

.PHONY: env build convert clean

env:
	@echo "UID=$$(id -u)" > .env
	@echo "GID=$$(id -g)" >> .env

build:
	@echo "Build TYPO3 Wiki migration environment [branch: $(BRANCH)]"
	@docker-compose build --force-rm
	@docker-compose run --rm composer-install

convert: env
	@echo "Convert TYPO3 Wiki HTML files into reST files"
	@docker-compose run --rm convert-html-to-rst

clean:
	@echo "Remove TYPO3 Wiki migration environment"
	@docker-compose down --rmi all --volumes
