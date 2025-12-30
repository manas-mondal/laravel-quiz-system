# 01 – Development Environment

## Section Goal

This document describes the **local development environment** used to build **QUIZIFY**.  
It focuses strictly on **factual configuration**, **design decisions**, and **local-only tooling**.
⚠️ This section intentionally excludes:

-   Production setup
-   AWS / Elastic Beanstalk details
-   Deployment or CI/CD logic
-   Application-level code or business logic

---

## 1. Host Machine & WSL Setup

### Host Operating System

-   **Windows 11**

### Windows Subsystem for Linux (WSL)

-   **WSL Version:** WSL 2
-   **Linux Distribution:** Ubuntu (default WSL distribution)
-   **Installation Method:** Microsoft Store

> The exact Ubuntu version is not critical to the setup and is therefore omitted.

This setup provides a stable Linux environment on Windows, enabling native Docker and PHP workflows without relying on Windows-based runtimes.

---

## 2. Docker Setup (Local Only)

### Docker Runtime

-   **Docker Desktop:** Installed with WSL 2 backend enabled
-   **Docker Backend:** WSL 2

### Docker Compose

-   **Compose Command:** `docker compose` (v2)

This configuration ensures Docker containers run inside the WSL Linux kernel, providing near-native performance and consistency with production-like environments.

---

## 3. Local Project Structure (High-Level)

The local project root contains:

-   `Dockerfile.local` – PHP-FPM runtime for local development
-   `docker-compose.yml` – Multi-container local environment definition
-   `.env.example`
-   `.env` – Local-only environment configuration (ignored via `.gitignore`)

### Framework Version

-   **Laravel Framework:** 12.x

---

## 4. Local Docker Architecture

The local development environment uses a **multi-container Docker architecture** to separate concerns and improve developer productivity.

### Docker Services (Exact)

Total services: **4**

#### 4.1 `app`

-   **Purpose:** Laravel application runtime
-   **Runtime:** PHP 8.2 (PHP-FPM)
-   **Image:** Built from `Dockerfile.local`
-   **Container Name:** `laravel_app`
-   **Source Code:** Bind-mounted (`./` → `/var/www/html`)
-   **Depends on:** `mysql`

This container runs Laravel and Composer-related commands during development.

#### 4.2 `web`

-   **Purpose:** Web server / reverse proxy
-   **Image:** `nginx:stable-alpine`
-   **Container Name:** `laravel_web`
-   **Port Mapping:** `8000 → 80` (local only)
-   **Configuration:** Custom Nginx configuration
-   **Depends on:** `app`

This container handles HTTP requests and forwards PHP execution to the PHP-FPM container.

#### 4.3 `mysql`

-   **Purpose:** Local development database
-   **Image:** `mysql:8.0`
-   **Container Name:** `laravel_mysql`
-   **Database Name:** `laravel_quiz`
-   **Storage:** Named Docker volume (`dbdata`)
-   **Network Scope:** Internal only (no port exposed to host)

The database is accessible only within the Docker network.

#### 4.4 `phpmyadmin`

-   **Purpose:** Local database inspection and management
-   **Image:** `phpmyadmin/phpmyadmin`
-   **Container Name:** `laravel_phpmyadmin`
-   **Port Mapping:** `8080 → 80`
-   **Connectivity:** Internal connection to `mysql`

This service is enabled strictly for local development convenience.

---

## 5. Local Networking & Access

-   **Application URL:** http://localhost:8000
-   **phpMyAdmin URL:** http://localhost:8080
-   **MySQL Access:** Internal Docker network only

All services communicate through a custom Docker bridge network.

---

## 6. Source Code Mounting & Hot Reload

-   Application source code is **bind-mounted** into the `app` and `web` containers
-   No application code is baked into Docker images
-   Code changes are reflected immediately without rebuilding containers

This setup prioritizes rapid feedback during development.

---

## 7. Environment Configuration (Local Only)

### `.env` Usage

-   Local configuration is defined in a dedicated `.env` file
-   `.env` is **never committed to Git** (`.gitignore` enforced)

### Database Configuration

-   Database connection uses the Docker service name (`DB_HOST=mysql`)
-   Credentials are scoped strictly to the local environment

### Sessions, Cache & Queue

-   **Session Driver:** database
-   **Cache Driver:** file
-   **Queue Driver:** sync
-   **Filesystem Disk:** local

Redis, background workers, or asynchronous infrastructure are intentionally not used to keep the local environment lightweight and aligned with the project scope.

### Mail Configuration

-   Local environment uses **real SMTP (Gmail SMTP)**
-   No mail-catching tools (Mailhog / Mailpit) are configured

### AWS Services

-   No AWS credentials are used locally
-   No cloud services (S3, IAM, etc.) are accessed in development

---

## 8. Local Development Workflow

### Starting the Environment

```bash
docker compose up -d
```

### First-Time Setup (One-Time)

Run these commands inside the `app` container during initial local setup:

```bash
# inside the app container
composer install
php artisan key:generate
php artisan migrate
```

These steps are required only once when setting up the project locally.

---

## 9. Design Rationale (Local Environment)

A multi-container architecture is intentionally used in the local environment to:

-   Isolate responsibilities: separate application runtime, web server, and database.
-   Reflect real-world service boundaries: mirrors modern infrastructure practices.
-   Improve productivity: enhances debugging, clarity, and developer feedback.

> This setup is optimized for development convenience rather than production simplicity.

---

## 10. Local vs Production Philosophy (High-Level)

-   **Local Environment:** Uses a multi-container setup to maximize flexibility and ease of development.
-   **Production Environment:** Uses a single-container setup for simplicity, stability, and cost efficiency.

This separation is intentional and aligns with the different goals of development and production environments.
