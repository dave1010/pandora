#!/bin/bash

# Get the absolute path of this script
DIR=$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)

# Loop over directories in the mounts directory and mount them
MOUNTS=""
for dir in $(ls -d $DIR/mounts/*/ 2>/dev/null); do
    MOUNTS+="-v $(realpath $dir):/pandora/$(basename $dir):ro "

# Run the Docker container
docker run -d -p 8000:8000 -v /var/run/docker.sock:/var/run/docker.sock $MOUNTS pandora