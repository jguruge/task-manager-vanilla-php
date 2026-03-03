# task-manager-vanilla-php


# Task Manager REST API

## Overview

This project is a simple Task Management REST API built using Vanilla PHP and PDO.

The goal of this project is to demonstrate clean architecture, secure database handling, authentication, and structured commit history.

## Tech Stack

- PHP (Vanilla)
- PDO
- MySQL
- HTML
- CSS


### Folder Structure

```
task-manager-vanilla-php/
│
├── config/
├── controllers/
├── models/
├── middleware/
├── public/
├── database.sql
├── .env.example
└── README.md
```



## Architecture

The project follows a simple MVC-inspired folder structure:

- config/ – database configuration
- controllers/ – request handling logic
- models/ – database operations
- middleware/ – authentication checks
- public/ – frontend and entry points


## Setup Instructions

1. Clone the repository
2. Import `database.sql` into MySQL
3. Copy `.env.example` to `.env`
4. Configure database credentials
5. Run using XAMPP or any local server

## Environment Variables

- DB_HOST
- DB_NAME
- DB_USER
- DB_PASS
- APP_URL

## Authentication

- User registration uses PHP's password_hash() function to securely store passwords.

- User login verifies password using password_verify().

- Session-based authentication is used to protect dashboard routes.

- Basic browser-based frontend

- Structured MVC-inspired architecture


## Assumptions

- Only authenticated users can access dashboard pages.
- Each user manages their own tasks.
- Database credentials are configured via environment variables.


## Access Application

After setup, open:

http://localhost/task-manager-vanilla-php/public/login.php


