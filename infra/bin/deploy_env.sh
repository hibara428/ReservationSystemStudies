#!/bin/sh
# Deploy the app infrastructure.

# Constants
usage="Usage: ${0} create|update|delete APP_KEY [HOSTED_ZONE_NAME]"
app_name=reservation-system-studies

stack_name=${app_name}-env
bucket_name=${app_name}-cfn-templates
template_file=./infra/cfn/env.cfn.yml

# Parameters
if [ $# -lt 2 ] && [ $# -gt 4 ]; then
    echo "${usage}"
    exit 1
fi
action=${1}
app_key=${2}
hosted_zone_name=${3:-ckitbara.info}

# CFn
if [ "${action}" = "create" ] || [ "${action}" = "update" ]; then
    # Get the hosted zone ID.
    hosted_zone_id=$(aws route53 list-hosted-zones-by-name --dns-name "${hosted_zone_name}." | jq -r ".HostedZones[0].Id" | cut -d / -f 3)
    if [ -z "${hosted_zone_name}" ]; then
        echo "Invalid hosted zone ID: ${hosted_zone_id}"
        exit 1
    fi
    # Copy CFn template files.
    aws s3 cp --recursive ./infra/cfn/templates s3://${bucket_name}/templates
    # Deploy with CFn template.
    aws cloudformation ${action}-stack \
        --stack-name ${stack_name} \
        --template-body file://${template_file} \
        --capabilities CAPABILITY_NAMED_IAM \
        --parameters \
            ParameterKey=HostedZoneId,ParameterValue="${hosted_zone_id}" \
            ParameterKey=HostedZoneName,ParameterValue="${hosted_zone_name}" \
            ParameterKey=AppKey,ParameterValue="${app_key}"
elif [ "${action}" = "delete" ]; then
    aws cloudformation delete-stack \
        --stack-name "${stack_name}"
else
    echo "${usage}"
    exit 1
fi
