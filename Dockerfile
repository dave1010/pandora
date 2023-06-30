FROM docker:latest

RUN apk add --no-cache \
    curl \
    php82 \
    php82-curl

WORKDIR /pandora

COPY . .

CMD [ "php82", "-S", "0.0.0.0:8000", "lib/router.php" ]

# TODO: get the git author things from the parent's Dockerfile

# TODO: ask Dave to consider if we should switch to a different user

# TODO: switch to the latest official PHP container