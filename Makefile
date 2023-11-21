ROOT_DIR:=$(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))
SHELL = /bin/sh
CURRENT_UID := $(shell id -u)
CURRENT_GID := $(shell id -g)
##@ Help

.PHONY: help
help:  ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make command [...argumets] \033[36m\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

##@ syntax checks
cache: ## warm laravel cache
	./vendor/bin/sail artisan route:cache
	./vendor/bin/sail artisan view:cache
pint_test: ## Run laravel pint in test mode
	./vendor/bin/sail pint --test
pint: ## Run laravel pint in test mode
	./vendor/bin/sail pint
phpcs: ## Run phpcs
	./vendor/bin/sail php ./vendor/bin/phpcs
phpcbf: ## Run auto-fixing phpcs errors
	./vendor/bin/sail php ./vendor/bin/phpcbf
syntax_test_php: cache pint_test phpcs ## Run all php syntax check test
syntax_fix_php: pint phpcbf ## Run all auto syntax fixing comands

##@ Manage client containers
prepare: ## Prepare client containers and enviroment
	docker run --rm \
		-u "$(CURRENT_UID):$(CURRENT_GID)" \
		-v $(ROOT_DIR):/var/www/html \
		-w /var/www/html \
		laravelsail/php82-composer:latest \
		composer install --ignore-platform-reqs \
		&& cp ./.env.example .env
build: ## Build client containers and enviroment
	./vendor/bin/sail build --no-cache
up: ## Start client containers
	./vendor/bin/sail up -d
install: ## Install dependencies
	./vendor/bin/sail composer install
	./vendor/bin/sail artisan key:generate
	./vendor/bin/sail artisan jwt:secret
migrate: ## Run migrations
	./vendor/bin/sail artisan migrate:fresh
seed: ## Build client containers and enviroment with seeders
	./vendor/bin/sail artisan db:seed
scout: ## Sync scout models
	./vendor/bin/sail artisan scout:sync-index-settings
	./vendor/bin/sail artisan scout:import-all -m

upgrade: ## Upgrade client containers and enviroment
	./.env.example .env
	./vendor/bin/sail down
	./vendor/bin/sail up -d
	./vendor/bin/sail composer update
	./vendor/bin/sail composer upgrade
	./vendor/bin/sail artisan key:generate
	./vendor/bin/sail artisan jwt:secret
	./vendor/bin/sail artisan migrate
	./vendor/bin/sail artisan db:seed
	./vendor/bin/sail artisan scout:sync-index-settings
	./vendor/bin/sail artisan scout:import-all -m
	./vendor/bin/sail pint

aio: prepare build up install migrate seed scout pint ## Build, install and migrate client containers and enviroment
