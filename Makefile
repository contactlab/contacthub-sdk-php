build: ; docker build -t contacthub .
test: ; docker run -itv $(shell pwd):/app contacthub vendor/bin/phpunit
coverage: ; docker run -itv $(shell pwd):/app contacthub vendor/bin/phpunit --coverage-text

.PHONY: build test coverage
