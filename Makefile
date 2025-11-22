.PHONY: help build up down restart logs clean

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'available targets:'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build: ## Build all microservices
	docker-compose build

up: ## Start all microservices
	docker-compose up -d

down: ## Stop all microservices
	docker-compose down

restart: ## Restart all microservices
	docker-compose restart

logs: ## View logs for all services
	docker-compose logs -f

logs-api-gateway: ## View API Gateway logs
	docker-compose logs -f api-gateway-php api-gateway-nginx

logs-product-service: ## View Product Service logs
	docker-compose logs -f product-service-php product-service-nginx product-db

clean: ## Remove all containers, volumes, and images
	docker-compose down -v --rmi all

ps: ## List running containers
	docker-compose ps

# Individual service commands
api-gateway-shell: ## Access API Gateway PHP container
	docker-compose exec api-gateway-php bash

product-service-shell: ## Access Product Service PHP container
	docker-compose exec product-service-php bash

product-db-shell: ## Access Product Database
	docker-compose exec product-db mysql -u product_user -pproduct_pass product_service

# Database operations
product-db-migrate: ## Run Product Service database migrations
	docker-compose exec product-service-php php bin/console doctrine:migrations:migrate --no-interaction

product-db-create: ## Create Product Service database
	docker-compose exec product-service-php php bin/console doctrine:database:create --if-not-exists
