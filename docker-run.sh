#!/bin/sh

# Get the absolute path of this script
DIR=$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)

# Loop over directories in the mounts directory and mount them
# change to :ro for read only
MOUNTS=""
for dir in $(ls -d $DIR/MOUNTS/*/ 2>/dev/null); do
    echo Mounting $(realpath $dir) to /pandora/WORKDIR/$(basename $dir)
    MOUNTS+="-v $(realpath $dir):/pandora/WORKDIR/$(basename $dir) "
done;

SOCK="/var/run/docker.sock"

docker run -p 8000:8000 -v $(pwd):/pandora -v $SOCK:$SOCK $MOUNTS -e PANDORA_CONTAINER_PATH=$(pwd) pandora

# TODO: add a script for killing / restarting the container
