#!/bin/bash

PROJECT_NAME="apcascat"
POD_NAME=$PROJECT_NAME"_pod"
DB_VOLUME=$PROJECT_NAME"_mysql_data"
DB_PORT=3406
APP_PORT=8090
APP_PORT_HTTPS=449

# Check if the pod already exists
if podman pod exists "$POD_NAME"; then
    echo -e "Pod $POD_NAME already exists, recreating pod..."
    podman pod stop "$POD_NAME"
    podman pod rm "$POD_NAME"
fi

# Create the Pod
echo -e "\nCreating pod $POD_NAME..."
podman pod create --name "$POD_NAME" \
    -p $DB_PORT:3306 \
    -p $APP_PORT:80 \
    -p $APP_PORT_HTTPS:443 \
    -p $APP_PORT_HTTPS:443/udp

# Start MySQL Container
echo "Starting MySQL container..."
podman run -d --pod "$POD_NAME" --name db \
    -e MYSQL_ROOT_PASSWORD=root \
    -e MYSQL_DATABASE=apcascat_db \
    -e MYSQL_USER=apcascat_user \
    -e MYSQL_PASSWORD=apcascat_pass \
    -v $DB_VOLUME:/var/lib/mysql \
    docker.io/mysql:8.4

# Show running pods and containers
echo -e "\nPod and containers are running:"
podman pod ps