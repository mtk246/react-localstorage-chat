ROOT_DIR:=$(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))
SHELL = /bin/sh
CURRENT_UID := $(shell id -u)
CURRENT_GID := $(shell id -g)
##@ Help

.PHONY: help
help:  ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make command [...argumets] \033[36m\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

##@ Manage client containers
prepare: ## Prepare client containers and enviroment
	docker run --rm \
		-u "$(CURRENT_UID):$(CURRENT_GID)" \
		-v $(ROOT_DIR):/var/www/html \
		-w /var/www/html \
		laravelsail/php80-composer:latest \
		composer install --ignore-platform-reqs \
		&& cp ./.env.example .env
build: ## Build client containers and enviroment
	./vendor/bin/sail build
up: ## Start client containers
	./vendor/bin/sail up -d
install: ## Install dependencies
	./vendor/bin/sail composer install
	./vendor/bin/sail artisan key:generate
migrate: ## Run migrations
	./vendor/bin/sail artisan migrate:fresh
seed: ## Build client containers and enviroment with seeders
	./vendor/bin/sail artisan db:seed

aio: prepare build up install migrate seed ## Build, install and migrate client containers and enviroment
