FROM docker:latest

RUN apk add --no-cache \
    curl \
    php82 \
    php82-curl

WORKDIR /pandora

COPY . .

CMD [ "php82", "-S", "0.0.0.0:8000", "lib/router.php" ]
