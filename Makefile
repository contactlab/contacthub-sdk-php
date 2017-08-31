test: ; docker run -itv $(shell pwd):/app contacthub vendor/bin/phpunit --verbose
build: ; docker build -t contacthub .
coverage: ; docker run -itv $(shell pwd):/app contacthub vendor/bin/phpunit --coverage-text
shell: ; docker run -itv $(shell pwd):/app contacthub /bin/bash
docs: ; docker run -itv $(shell pwd):/app contacthub vendor/bin/phpdoc

.PHONY: build test coverage docs
