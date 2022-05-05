# ReservationSystemStudies

![unit_test](https://github.com/hibara428/ReservationSystemStudies/actions/workflows/unit_test.yml/badge.svg)

The reservation system project to learn Laravel.

## Introduction

This is a sample project to learn Laravel.

- PHP 8.1
- Laravel 8

## Deployment

### Preparation

- S3

```sh
# Creates a S3 bucket for CFn templates.
aws cloudformation create-stack \
  --stack-name reservation-system-studies-cfn-templates-bucket \
  --template-body file://./infra/cfn/templates/s3.cfn.yml \
  --parameters ParameterKey=BucketName,ParameterValue=reservation-system-studies-cfn-templates
# Copies CFn templates to a S3 bucket.
aws s3 cp --recursive --region ap-northeast-1 ./infra/cfn/templates s3://reservation-system-studies/templates
```

- ECR

```sh
# Creates a ECR repository.
aws cloudformation create-stack \
  --stack-name reservation-system-studies-ecr-repos \
  --template-body file://./infra/cfn/templates/ecr.cfn.yml \
  --parameters ParameterKey=RepositoryName,ParameterValue=reservation-system-studies
```

### Deployment

Deploy with GitHub Actions. Please read workflow files in `.github/workflows`.
