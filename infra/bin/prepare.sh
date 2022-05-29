#!/bin/sh
# Prepare infrastructures.
#   - S3 bucket
#   - ECR repository

# Constants
usage="Usage: ${0} create|update|delete"
app_name=reservation-system-studies

bucket_stack_name=${app_name}-cfn-templates-bucket
bucket_name=${app_name}-cfn-templates
bucket_template_file=./infra/cfn/templates/s3.cfn.yml

ecr_stack_name=${app_name}-ecr-repos
ecr_repos_name=${app_name}
ecr_template_file=./infra/cfn/templates/ecr.cfn.yml

# Parameters
if [ $# -ne 1 ]; then
    echo "${usage}"
    exit 1
fi
action=${1}

# CFn
if [ "${action}" = "create" ] || [ "${action}" = "update" ]; then
    aws cloudformation ${action}-stack \
        --stack-name ${bucket_stack_name} \
        --template-body file://${bucket_template_file} \
        --parameters \
            ParameterKey=BucketName,ParameterValue=${bucket_name}
    aws cloudformation ${action}-stack \
        --stack-name ${ecr_stack_name} \
        --template-body file://${ecr_template_file} \
        --parameters \
            ParameterKey=RepositoryName,ParameterValue=${ecr_repos_name}
elif [ "${action}" = "delete" ]; then
    aws cloudformation delete-stack \
        --stack-name ${bucket_stack_name}
    aws cloudformation delete-stack \
        --stack-name ${ecr_stack_name}
else
    echo "${usage}"
    exit 1
fi
