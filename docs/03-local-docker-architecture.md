# 03 — Local Docker Architecture

## Purpose

This document describes the local Docker architecture used during QUIZIFY development. It explains how the environment is structured, why components are separated, and how services interact in a development context (no production/deployment details).

---

## 1. Architecture Rationale

Docker provides a reproducible, isolated development environment that avoids host dependency conflicts and ensures consistent behavior across machines. A multi-container layout is adopted locally to reflect real-world separation of concerns:

-   PHP-FPM (`app`) — executes Laravel code
-   Nginx (`web`) — reverse proxy and static asset serving
-   MySQL (`mysql`) — persistent data store
-   phpMyAdmin (`phpmyadmin`) — browser DB UI for convenience

Benefits: clear boundaries, fast PHP hot-reload, and parity with containerized production patterns.

---

## 2. Roles & Boundaries

| Service      | Responsibility                                | Runs Inside            | Reason for Separation                 |
| ------------ | --------------------------------------------- | ---------------------- | ------------------------------------- |
| `app`        | PHP-FPM runtime, Laravel execution, Artisan   | PHP 8.2 (custom build) | Enables hot reload & isolates runtime |
| `web`        | Reverse proxy, static assets, request routing | Nginx                  | Separation of concerns & routing      |
| `mysql`      | Database engine                               | MySQL 8.0              | Persistent storage via volume         |
| `phpmyadmin` | Browser-based DB management UI                | phpMyAdmin             | Developer convenience only            |

Why separate `app` and `web`: hot reload of PHP remains fast without restarting Nginx; lower coupling and closer alignment with production service boundaries.

Why DB is internal only: reduces attack surface and enforces access through application layer or phpMyAdmin.

---

## 3. Service Interactions

Local networking uses a bridge network (`laravelnet`) so containers reach each other by service name.

| Interaction            | Hostname | Port | Protocol |
| ---------------------- | -------- | ---- | -------- |
| `web` → `app`          | `app`    | 9000 | FastCGI  |
| `app` → `mysql`        | `mysql`  | 3306 | TCP      |
| `phpmyadmin` → `mysql` | `mysql`  | 3306 | TCP      |

Flow summary:
web --> app:9000 --> mysql:3306  
phpmyadmin --> mysql:3306

---

## 4. Docker Compose (relevant parts)

```yaml
services:
    app:
        build:
            context: .
            dockerfile: Dockerfile.local
        volumes:
            - ./:/var/www/html
        depends_on:
            - mysql
        networks:
            - laravelnet

    web:
        image: nginx:stable-alpine
        ports:
            - "8000:80"
        volumes:
            - ./:/var/www/html
            - ./docker/local/nginx/default.conf:/etc/nginx/conf.d/default.conf:ro
        depends_on:
            - app
        networks:
            - laravelnet

    mysql:
        image: mysql:8.0
        environment:
            MYSQL_DATABASE: laravel_quiz
            MYSQL_ROOT_PASSWORD: root
        volumes:
            - dbdata:/var/lib/mysql
        networks:
            - laravelnet

    phpmyadmin:
        image: phpmyadmin/phpmyadmin
        ports:
            - "8080:80"
        depends_on:
            - mysql
        networks:
            - laravelnet

volumes:
    dbdata:

networks:
    laravelnet:
        driver: bridge
```

---

## 5. Volumes & Code Mount Strategy

-   MySQL persistence: `dbdata` named volume retains database across restarts.
-   Code mount: `./:/var/www/html` applied to `app` and `web` so source changes reflect immediately without container rebuilds.

---

## 6. Hot Reload & Asset Workflow

| Feature                           | Status                |
| --------------------------------- | --------------------- |
| PHP code changes auto-reflect     | ✔ Yes                 |
| Rebuild required for dependencies | ✔ Yes (Composer only) |
| Node/Vite locally                 | ✖ No                  |
| Tailwind                          | ✔ Used via CDN        |

Hot reload keeps development fast while avoiding Node/Vite overhead.

---

## 7. Request Lifecycle (containerized)

Browser
→ Nginx (web)
→ FastCGI
→ PHP-FPM (app)
→ Laravel Kernel
→ Database Query (mysql)
← Response
← Response
← Browser renders output

This mirrors Laravel’s internal lifecycle executed across containers.

---

## 8. Ports & Access

| Service     | Local URL             | Exposed | Notes                        |
| ----------- | --------------------- | ------- | ---------------------------- |
| Laravel App | http://localhost:8000 | Yes     | Routed via Nginx             |
| phpMyAdmin  | http://localhost:8080 | Yes     | Dev-only convenience         |
| MySQL       | (internal)            | No      | Accessible only from network |

---

## 9. Local vs Production

| Environment | Architecture     | Reasoning                                     |
| ----------- | ---------------- | --------------------------------------------- |
| Local       | Multi-container  | Fast iteration, clear service boundaries      |
| Production  | Single container | Cost and resource constraints (AWS Free Tier) |

Design supports future horizontal scaling without rewriting architecture.

---

## 10. Images, Build Strategy & Caching

-   `app` built from `Dockerfile.local` (PHP + extensions + Composer).
-   Base images: `nginx`, `mysql`, `phpmyadmin`.
-   Dependencies installed via `composer install` inside the container.
-   No local static asset build pipeline — Tailwind served via CDN to keep the dev environment lightweight.

---

## 11. Developer Workflows

First-time setup:

```bash
docker compose up -d
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

Daily usage:

```bash
docker compose up -d
docker compose exec app php artisan migrate
```

---

## 12. Known Local Limitations

| Limitation                | Reason                       |
| ------------------------- | ---------------------------- |
| No HTTPS locally          | Simplicity for dev           |
| No Redis or queues        | Not required for current use |
| No mail previewer         | Uses real SMTP               |
| MySQL not host-accessible | Internal-only for security   |
| Node/Vite not used        | CDN-based assets used        |

---

**END — 03-local-docker-architecture.md**
