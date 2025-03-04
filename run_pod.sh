#!/bin/bash

APP_NAME=apcascat
IMAGE_NAME="$APP_NAME/$APP_NAME-app"
POD_NAME=$APP_NAME"_pod"
DB_VOLUME=$APP_NAME"_mysql_data"
DB_PORT=3406
APP_PORT=8090
APP_PORT_HTTPS=449
SERVER_NAME=http://localhost # Used by Caddyfile in frankenphp

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
    -p $APP_PORT:80
    # \
    # -p $APP_PORT_HTTPS:443 \
    # -p $APP_PORT_HTTPS:443/udp

# Check if the image exists
if ! podman images --format "{{.Repository}}" | grep -q "^$IMAGE_NAME$"; then
    echo -e "\nImage $IMAGE_NAME not found, building it now..."
    podman build -t "$IMAGE_NAME" .
else
    echo -e "\nImage $IMAGE_NAME already exists, skipping build..."
fi

# Start the App Container inside the Pod
echo "Starting App container..."
podman run -d --pod "$POD_NAME" --name app \
    -e SERVER_NAME=$SERVER_NAME \
    $IMAGE_NAME

# Start MySQL Container inside the Pod
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
podman ps -a