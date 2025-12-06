#!/usr/bin/make

DOCKER_PHP_IMAGE = php:8.4-alpine
DOCKER_IMG_NAME = demo-php-app
DOCKER_RUN = docker run --rm -ti -v "$(CURDIR):/app" -w /app

.PHONY: *

check-image:
	@if [ -z "$$(docker images -q $(DOCKER_IMG_NAME))" ]; then \
		echo "Docker image '$(DOCKER_IMG_NAME)' not found. Please run 'make docker-build' to build the image."; \
		exit 1; \
	fi

# Docker
docker-build:
	docker build -f Dockerfile --build-arg from=$(DOCKER_PHP_IMAGE) -t $(DOCKER_IMG_NAME) .

docker-rm-image:
	$(MAKE) check-image
	docker rmi -f $(DOCKER_IMG_NAME)

# Deps
composer-install: 
	$(MAKE) check-image
	$(DOCKER_RUN) $(DOCKER_IMG_NAME) sh -c "composer install --prefer-dist --no-interaction"

# Linters
csfixer-lint:
	$(MAKE) check-image
	$(DOCKER_RUN) $(DOCKER_IMG_NAME) sh -c "composer run csfixer:lint"

csfixer-fix:
	$(MAKE) check-image
	$(DOCKER_RUN) $(DOCKER_IMG_NAME) sh -c "composer run csfixer:fix"

# Rector
rector-lint:
	$(MAKE) check-image
	$(DOCKER_RUN) $(DOCKER_IMG_NAME) sh -c "composer run rector:lint"

rector-fix:
	$(MAKE) check-image
	$(DOCKER_RUN) $(DOCKER_IMG_NAME) sh -c "composer run rector:fix"

# App
run:
	$(MAKE) check-image
	$(DOCKER_RUN) -p 8000:8000 $(DOCKER_IMG_NAME)
