#!/bin/bash

# Get the absolute path of this script
DIR=$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)

# Build the Docker image
docker build -t pandora $DIR

# TODO make executeable