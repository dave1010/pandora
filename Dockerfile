FROM php:7.4-cli

WORKDIR /pandora

COPY . .

CMD [ "php", "-S", "0.0.0.0:8000", "-t", "public" ]

# TODO: get the git author things from the parent's Dockerfile

# TODO: ask Dave to consider if we should switch to a different user

# TODO: switch to the latest official PHP container