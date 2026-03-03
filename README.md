# task-manager-vanilla-php


# Task Manager REST API

## Overview

This project is a simple Task Management REST API built using Vanilla PHP and PDO.

The goal of this project is to demonstrate clean architecture, secure database handling, authentication, and structured commit history.

## Tech Stack

- PHP (Vanilla)
- PDO
- MySQL
- HTML (Basic frontend)
- CSS

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