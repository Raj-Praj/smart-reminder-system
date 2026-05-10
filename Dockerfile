FROM php:8.2-cli

WORKDIR /app

# Install mysqli + dependencies
RUN docker-php-ext-install mysqli

COPY . .

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000"]