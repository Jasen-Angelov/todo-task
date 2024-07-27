# Laravel React Todo App

This is a simple Todo application built with Laravel for the backend and React for the frontend. The application uses Laravel Sail for local development.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Running the Application](#running-the-application)
- [API Endpoints](#api-endpoints)
- [Running Tests](#running-tests)
- [File Structure](#file-structure)
- [License](#license)

## Requirements

- Docker
- Docker Compose

## Installation

1. **Copy the `.env` file:**

    ```bash
    cp .env.example .env
    ```

2. **Build the Docker containers:**

    ```bash
    ./vendor/bin/sail build --no-cache
    ```

3. **Start Sail:**

    ```bash
    ./vendor/bin/sail up -d
    ```

4. **Install dependencies:**

    ```bash
    ./vendor/bin/sail composer install
    ./vendor/bin/sail npm install
    ```

5. **Generate an application key:**

    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

6. **Run the database migrations:**

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

## Running the Application

1. **Start the Docker containers:**

    ```bash
    ./vendor/bin/sail up -d
    ```

2. **Build the frontend assets:**

    ```bash
    ./vendor/bin/sail npm run build
    ```

3. **Access the application:**

   Open your browser and go to [http://localhost](http://localhost).

## API Endpoints

Here are the available API endpoints for the Todo application:

- `GET /api/todos` - Fetch all todos
- `POST /api/todos` - Create a new todo
- `DELETE /api/todos/{id}` - Delete a todo

## Running Tests

To run the tests, use the following command:

```bash
./vendor/bin/sail artisan test

