#!/bin/sh
# Prepare infrastructures.
#   - S3 bucket
#   - ECR repository

aws cloudformation create-stack \
  --stack-name reservation-system-studies-cfn-templates-bucket \
  --template-body file://./infra/cfn/templates/s3.cfn.yml \
  --parameters ParameterKey=BucketName,ParameterValue=reservation-system-studies-cfn-templates
aws cloudformation create-stack \
  --stack-name reservation-system-studies-ecr-repos \
  --template-body file://./infra/cfn/templates/ecr.cfn.yml \
  --parameters ParameterKey=RepositoryName,ParameterValue=reservation-system-studies
