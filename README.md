# QUIZIFY — Production-Ready Quiz Platform

<!-- STATUS BADGES -->

![CI Status](https://github.com/manas-mondal/laravel-quiz-system/actions/workflows/ci.yml/badge.svg)
![CD Deploy](https://github.com/manas-mondal/laravel-quiz-system/actions/workflows/cd.yml/badge.svg?branch=main)
![License: MIT](https://img.shields.io/github/license/manas-mondal/laravel-quiz-system)
![Laravel](https://img.shields.io/badge/Laravel-12.x-orange)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![Dockerized](https://img.shields.io/badge/Containerized-Docker-blue)
![Platform: AWS](https://img.shields.io/badge/Platform-AWS%20EB-FF9900?logo=amazonaws&logoColor=white)
[![Live](https://img.shields.io/badge/Live-quizify.space-0a61c3)](https://www.quizify.space/)

> A full‑stack quiz platform demonstrating production‑grade Laravel engineering, AWS deployment, cost‑optimized architecture, and verifiable digital certificates.

🔗 **Live Application:** [https://www.quizify.space/](https://www.quizify.space/)

---

## 🎯 Purpose

QUIZIFY was built to:

-   showcase **real-world production deployment experience**
-   demonstrate **application architecture, DevOps workflows & documentation discipline**
-   provide a **platform for technical interviews & portfolio validation**

QUIZIFY is not a demo — it is **running in production**, backed by AWS, using a deployment flow that scales with maturity.

---

## 🧭 Documentation Index

Complete technical documentation lives in [`docs/`](docs/), organized by topic:

### 📑 Core Documentation

-   **00 — Project Overview** — [docs/00-project-overview.md](docs/00-project-overview.md)
-   **01 — Development Environment** — [docs/01-development-environment.md](docs/01-development-environment.md)
-   **02 — Application Architecture** — [docs/02-application-architecture.md](docs/02-application-architecture.md)
-   **02.1 — Database Schema** — [docs/02.1-database-schema.md](docs/02.1-database-schema.md)
-   **03 — Local Docker Architecture** — [docs/03-local-docker-architecture.md](docs/03-local-docker-architecture.md)

### 🚀 Delivery & Cloud

-   **04 — Git Branching & CI Workflow** — [docs/04-git-branching-ci-workflow.md](docs/04-git-branching-ci-workflow.md)
-   **05 — Production Architecture** — [docs/05-production-architecture.md](docs/05-production-architecture.md)
-   **06 — AWS Infrastructure** — [docs/06-aws-infrastructure.md](docs/06-aws-infrastructure.md)
-   **07 — Deployment Strategy** — [docs/07-deployment-strategy.md](docs/07-deployment-strategy.md)
-   **08 — CI/CD Pipeline** — [docs/08-ci-cd-pipeline.md](docs/08-ci-cd-pipeline.md)

### 🔐 Reliability & Growth

-   **09 — Security & Secrets** — [docs/09-security-and-secrets.md](docs/09-security-and-secrets.md)
-   **10 — Cost Optimization** — [docs/10-cost-optimization.md](docs/10-cost-optimization.md)
-   **11 — Known Limitations** — [docs/11-known-limitations.md](docs/11-known-limitations.md)
-   **12 — Future Improvements** — [docs/12-future-improvements.md](docs/12-future-improvements.md)

### 📝 Summary

-   **13 — Executive Summary** — [docs/13-executive-summary.md](docs/13-executive-summary.md)

> **Tip:** Sections 05 → 12 explain why the architecture looks the way it does.

---

## ⚙️ Technology Overview

| Category           | Tooling                                                              |
| ------------------ | -------------------------------------------------------------------- |
| Framework          | Laravel 12 (MVC)                                                     |
| Language           | PHP 8.2                                                              |
| Frontend           | Blade, Tailwind via CDN                                              |
| Local Dev          | Docker Compose (multi‑container)                                     |
| Production Runtime | Single container (NGINX + PHP‑FPM + Supervisor) on Elastic Beanstalk |
| Database           | MySQL — Local (Docker) / Production (AWS RDS)                        |
| CI/CD              | GitHub Actions — CI validation + CD deploy w/ manual approval        |
| Certificates       | Dynamic rendering with public verification URLs                      |

---

## 🧪 Key Functional Features

-   user authentication + email verification
-   role-based access (**user / creator / admin**)
-   quiz attempts with stored results & scoring
-   **digital certificate generation & verification**
-   admin panel for content lifecycle management

> Certificate verification flow detailed here:
> **05 — Production Architecture** → [docs/05-production-architecture.md](docs/05-production-architecture.md)

---

## 🏗 Architectural Highlights

-   **Session-backed quiz flow** preserves attempt state
-   **Dynamic certificate rendering** avoids file retention complexity
-   **Single-container production runtime** simplifies AWS operations
-   **Manual migration workflow** protects imported schema until stabilization
-   **Clear maturity roadmap** toward HA, autoscaling & S3

---

## 🚀 Deployment Lifecycle Overview

```text
Code → Pull Request → CI validation → Merge to main → Manual approval → CD deploy → Manual migrations → Smoke tests
```

> Deployment risks reduced by: controlled releases, restricted approval, and manual migrations.

---

## 📌 Status

-   **Live in production** — yes
-   **Role support** — user / creator / admin
-   **CI enabled** — yes
-   **CD partially automated** — approval required
-   **Scaling awareness** — roadmap defined

---

## 💼 Executive Snapshot

QUIZIFY is a **production-deployed Laravel platform** demonstrating:

-   practical AWS deployment experience
-   controlled production workflows with CI/CD
-   deliberate trade-offs in cost, scaling & security
-   thorough documentation showing engineering maturity

If you read **only one document**, start here:

➡️ **13 — Executive Summary** — [docs/13-executive-summary.md](docs/13-executive-summary.md)

---

## 📥 Local Development (Quick Start)

```bash
git clone https://github.com/manas-mondal/laravel-quiz-system
cd quizify
cp .env.example .env
# start multi-container environment
make up
# generate app key
make key
```

Full setup steps here:

> **01 — Development Environment** → [docs/01-development-environment.md](docs/01-development-environment.md)

---

## 🤝 Contribution & Licensing

This repository currently reflects **solo development mode** and prioritizes controlled growth.
External contributions may open later as roadmap matures.

Usage permissions defined in:

> **[LICENSE](LICENSE)**

---

## 📫 Contact

For collaboration or interview inquiries:

> **Email:** [manasmondal035@gmail.com](mailto:manasmondal035@gmail.com)

---

**END — README.md**
