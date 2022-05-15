#!/bin/sh
# Deploy application services.

# Constants
usage="Usage: ${0} create|update|delete HOSTED_ZONE_ID [DOCKER_IMAGE_TAG]"
stack_name=reservation-system-studies-app
template_file=./infra/cfn/templates/app.cfn.yml

# Parameters
if [ $# -lt 1 ] && [ $# -gt 3 ]; then
    echo "${usage}"
    exit 1
fi
action=${1}
hostedZoneId=${2}
dockerImageTag=${3:-latest}

# CFn
if [ "${action}" = "create" ] || [ "${action}" = "update" ]; then
    # Get the hosted zone name by ID.
    hostedZoneName=$(aws route53 get-hosted-zone --id "${hostedZoneId}" | jq -r '.HostedZone.Name' | sed -e 's/.$//')
    if [ -z "${hostedZoneName}" ]; then
        echo "Invalid hosted zone ID: ${hostedZoneId}"
        exit 1
    fi
    echo "HostedZoneName: ${hostedZoneName}"

    aws cloudformation ${action}-stack \
        --stack-name ${stack_name} \
        --template-body file://${template_file} \
        --capabilities CAPABILITY_NAMED_IAM \
        --parameters \
            ParameterKey=HostedZoneId,ParameterValue="${hostedZoneId}" \
            ParameterKey=HostedZoneName,ParameterValue="${hostedZoneName}" \
            ParameterKey=DockerImageTag,ParameterValue="${dockerImageTag}"
elif [ "${action}" = "delete" ]; then
    aws cloudformation delete-stack \
        --stack-name "${stack_name}"
else
    echo "${usage}"
    exit 1
fi
