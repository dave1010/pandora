Symlink dirs here before starting the container.

docker-run.sh will then mount them into /pandora/WORKDIR

From your project's parent directory:

ln -s $PWD/your-project /path/to/pandora/MOUNTS/