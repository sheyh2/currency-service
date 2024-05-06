#!make

default: help

build: ## run docker compose build
	docker compose --env-file="www/.env" build

ps: ## docker compose ps
	docker compose ps

up: ## docker compose up
	docker compose --env-file="www/.env" up -d

down: ## docker compose down
	docker compose --env-file="www/.env" down

down-volumes: ## docker compose down with volumes
	docker compose --env-file="www/.env" down --volumes

restart: ## docker compose restart
	docker compose --env-file="www/.env" restart

artisan:
	docker compose --env-file="www/.env" exec backend php artisan $(cmd)

composer:
	docker compose --env-file="www/.env" exec backend composer $(cmd)

# makefile help
help:
	@echo "usage: make [command]"
	@echo ""
	@echo "available commands:"
	@sed \
    		-e '/^[a-zA-Z0-9_\-]*:.*##/!d' \
    		-e 's/:.*##\s*/:/' \
    		-e 's/^\(.\+\):\(.*\)/$(shell tput setaf 6)\1$(shell tput sgr0):\2/' \
    		$(MAKEFILE_LIST) | column -c2 -t -s :
