test: ; docker run -itv $(shell pwd):/app contacthub vendor/bin/phpunit
build: ; docker build -t contacthub .
coverage: ; docker run -itv $(shell pwd):/app contacthub vendor/bin/phpunit --coverage-text
shell: ; docker run -itv $(shell pwd):/app contacthub /bin/bash

.PHONY: build test coverage
