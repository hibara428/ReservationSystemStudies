# ReservationSystemStudies

![test](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/test.yml/badge.svg) ![deploy_service](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/deploy_service.yml/badge.svg) ![build_dev_image](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/build_dev_image.yml/badge.svg) ![deploy_cfn_templates](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/deploy_cfn_templates.yml/badge.svg)

The reservation system project to learn Laravel.

## Introduction

This is a sample project to learn Laravel.

- PHP 8.1
- Laravel 9

## Preparation


Creates following resources for development and deployment.

- S3 bucket for CFn templates
- ECR repository

```sh
./infra/bin/prepare.sh create
```

## Development

```sh
# Run services
sail up [-d]
# Unit test
sail test
```

## Deployment

### Prepare production image

When some tag is pushed, the [deploy_service](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/deploy_service.yml) workflow runs and it builds and pushes the docker image of its tag to ECR repository.

### Build base infrastructure

```sh
./infra/bin/deploy_env.sh create|update|delete APP_KEY [HOSTED_ZONE_NAME]
```

### Deploy app (initialize or update)

```sh
./infra/bin/deploy_app.sh create|update|delete [DOCKER_IMAGE_TAG]
```

### Continuous delivery

This app can deploy with GitHub Actions workflows.

Please check the [deploy_service](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/deploy_service.yml) workflow.
