# Laravel Docker

A Docker setup to streamline local development and testing of the Laravel framework.

## Prerequisites

Ensure the following tools are installed before proceeding:

### Install Docker

```sh
sudo apt-get update
sudo apt-get install -y \
  ca-certificates \
  curl \
  gnupg \
  lsb-release

curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io
```

### Install Docker Compose

```sh
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

### Install Make

```sh
sudo apt-get update
sudo apt-get install -y make
```

## Setup Instructions

### 1. Build the project containers

```sh
make build
```

### 2. Access the container shell

```sh
make bash
```

### 3. Create a new Laravel project

```sh
make create-project
```

Visit [http://localhost:8989](http://localhost:8989) in your browser.

### 4. Install project dependencies

```sh
composer install
```

### 5. Generate the Laravel application key (if required)

```sh
php artisan key:generate
```

### 6. Run database migrations

```sh
php artisan migrate
```

### 7. Install the Laravel module package via Composer

```sh
composer require jamacio/module-laravel
```

Learn more about the Laravel module: [https://github.com/jamacio/module-laravel](https://github.com/jamacio/module-laravel)

## Additional Commands

- Start the containers:

```sh
make up
```

- Stop the containers:

```sh
make stop
```

- Remove the containers:

```sh
make down
```

- Rebuild the containers:

```sh
make build
```

- View container logs:

```sh
make watch
```
