.PHONY: *

ifeq ($(OS),Windows_NT) # is Windows_NT on XP, 2000, 7, Vista, 10...
    detected_OS := Windows
else
    detected_OS := $(shell uname)  # same as "uname -s"
endif

var_test_path:=$(shell php -r "echo sys_get_temp_dir();")/com.github.norma-uy.normacmsbundle/tests/var/test

## —— Help ————————————————————————————————————
help: ## Show help
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' Makefile | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Tests ———————————————————————————————————
tests: ## Run tests
	rm -rf $(var_test_path)/cache/*
	php vendor/bin/simple-phpunit -v
tests-coverage: ## Generate test coverage
	rm -rf $(var_test_path)/cache/*
	XDEBUG_MODE=coverage php vendor/bin/simple-phpunit --coverage-html=$(var_test_path)/coverage/
tests-coverage-view-in-browser: ## Open the generated HTML coverage in your default browser
ifeq ($(detected_OS),Windows)
	explorer "file://$(var_test_path)/coverage/index.html"
else
	sensible-browser "file://$(var_test_path)/coverage/index.html"
endif

## —— Development —————————————————————————————
install: ## Initially build the package before development
	composer update
	yarn install

build: ## Rebuild assets after changes in JS or SCSS
	yarn build
