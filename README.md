# ReservationSystemStudies

![unit_test](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/unit_test.yml/badge.svg)

The reservation system project to learn Laravel.

## Introduction

This is a sample project to learn Laravel.

- PHP 8.1
- Laravel 8

## Deployment

### Preparation

### Base infrastructures creation

```sh
# S3 bucket and ECR repos creation
./infra/cfn/prepare.sh
```

### CFn templates uploading

- Performs `deploy_cfn_template` workflow

### Testing

- Performs `build_dev_image` workflow
- Performs `unit_test` workflow

### Deployment

This app deploys with GitHub Actions. Please check a `deploy_service` workflow and more.
