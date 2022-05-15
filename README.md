# ReservationSystemStudies

![unit_test](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/unit_test.yml/badge.svg)

The reservation system project to learn Laravel.

## Introduction

This is a sample project to learn Laravel.

- PHP 8.1
- Laravel 8

## Development

```sh
# Run services
sail up [-d]
# Unit test
sail test
```

## Deployment

### Preparation

#### Secrets Manager

- `reservation-system-studies-app-env`

| ParameterName | Description |
| --- | --- | --- |
| APP_KEY | env: APP_KEY |
| DB_USERNAME | env: DB_USERNAME |
| DB_PASSWORD | env: DB_PASSWORD |
| DB_DATABASE | env: DB_DATABASE |

#### Creating a base infrastructure

- S3 bucket for CFn templates
- ECR repository

```sh
./infra/cfn/prepare.sh create
```

#### Uploading CFn templates to S3

- Performs [deploy_cfn_template](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/deploy_cfn_templates.yml) workflow

#### Building the docker image for development

- Performs [build_dev_image](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/build_dev_image.yml) workflow

### Deploying the app services with CFn

- Uploading the docker image for production to ECR repository.

When some tag is pushed, a [deploy_service](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/deploy_service.yml) workflow runs and it build and push the docker image of its tag.

- Run the following command.

```sh
./infra/cfn/deploy.sh create|update HOSTED_ZONE_ID
```

### Continuous delivery

This app deploys with GitHub Actions.

Please check a [deploy_service](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/deploy_service.yml) workflow and more workflows.
