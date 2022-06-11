#!/bin/sh
# Deploy application services.
# We suposed to use this for first deployment. In daily deployment, please use GitHub Actions workflow.

# Constants
usage="Usage: ${0} create|update|delete [DOCKER_IMAGE_TAG]"
app_name=reservation-system-studies

stack_name=${app_name}-app
template_file=./infra/cfn/app.cfn.yml

# Parameters
if [ $# -lt 1 ] && [ $# -gt 2 ]; then
    echo "${usage}"
    exit 1
fi
action=${1}
docker_image_tag=${2:-latest}

# CFn
if [ "${action}" = "create" ] || [ "${action}" = "update" ]; then
    aws cloudformation ${action}-stack \
        --stack-name ${stack_name} \
        --template-body file://${template_file} \
        --capabilities CAPABILITY_NAMED_IAM \
        --parameters \
            ParameterKey=DockerImageTag,ParameterValue="${docker_image_tag}"
elif [ "${action}" = "delete" ]; then
    aws cloudformation delete-stack \
        --stack-name "${stack_name}"
else
    echo "${usage}"
    exit 1
fi
