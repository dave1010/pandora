#!/bin/bash

# Get the absolute path of this script
DIR=$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)

# Loop over directories in the mounts directory and mount them
MOUNTS=""
for dir in $(ls -d $DIR/mounts/*/ 2>/dev/null); do
    MOUNTS+="-v $(realpath $dir):/pandora/$(basename $dir):ro "
done;

# Run the Docker container
docker run -d -p 8000:8000 -v $(pwd):/pandora -v /var/run/docker.sock:/var/run/docker.sock $MOUNTS pandora

# TODO can this run with sh instead of bash?
# TODO make executeable
# TODO is it set to read only mounting? we probably want write too
# TODO add some helpful output for the user
# TODO get Dave to test the mount behaviour is working
