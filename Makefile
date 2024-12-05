SHELL=/bin/bash
.DEFAULT_GOAL := help
THIS_FILE := $(lastword $(MAKEFILE_LIST))
OS := `uname -s`
DOCKER_UID := `id -u`
DOCKER_GID := `id -g`

ifeq ($(OS), Darwin)
	DOCKER_UID := 1000
	DOCKER_GID := 1000
endif

.PHONY: help
help: ## Отобразить данное сообщение. Для дополнительной информации загляните в README.md
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: build
build: ## Собрать контейнер, как backend так и frontend (для backend) часть (запускает build)
	@$(MAKE) build-backend
	@$(MAKE) build-db
	@$(MAKE) build-frontend

.PHONY: build-backend
build-backend: ## Собрать контейнер backend, подтянуть все зависимости, подготовить к запуску
	@docker run --rm --interactive --tty \
		--volume ${PWD}:/app \
		-w /app \
		--user ${DOCKER_UID}:${DOCKER_GID} \
		--env-file ./.env \
		composer bash -c "composer install --ignore-platform-reqs --no-scripts"
	@docker compose --env-file .deploy/.env -f docker-compose.yaml pull app
	@docker compose --env-file .deploy/.env -f docker-compose.yaml build --build-arg DOCKER_UID=$(DOCKER_UID) --build-arg DOCKER_GID=$(DOCKER_GID) app

.PHONY: build-db
build-db: ## Собрать контейнер database, подтянуть все зависимости, подготовить к запуску
	@docker compose --env-file .deploy/.env -f docker-compose.yaml pull db
	@docker compose --env-file .deploy/.env -f docker-compose.yaml build db


.PHONY: build-frontend
build-frontend: ## Собрать контейнер frontend, подтянуть все зависимости, подготовить к запуску
	@docker compose --env-file .deploy/.env -f docker-compose.yaml pull webserver
	@docker compose --env-file .deploy/.env -f docker-compose.yaml build webserver

.PHONY: composer-update
composer-update: ## Обновить зависимости composer
	@docker run --rm --interactive --tty \
		--volume ${PWD}:/app \
		--volume ~/.ssh:/root/.ssh \
		--user ${DOCKER_UID}:${DOCKER_GID} \
		--env-file ./.env \
		composer bash -c "composer update --ignore-platform-reqs --no-scripts"

.PHONY: start
start: ## Запускаем контейнеры в интерактивном режиме.
	@echo -e "\033[33mstart\033[0m"
	@DOCKER_UID=${DOCKER_UID} DOCKER_GID=${DOCKER_GID} docker compose --env-file .deploy/.env -f docker-compose.yaml up

.PHONY: start-d
start-d: ## Запускаем контейнеры в фоновом режиме.
	@echo -e "\033[33mstart\033[0m"
	@DOCKER_UID=${DOCKER_UID} DOCKER_GID=${DOCKER_GID} docker compose --env-file .deploy/.env -f docker-compose.yaml up -d
