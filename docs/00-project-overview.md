# 00 — Project Overview

## Overview

**Quizify** is a production-ready, web-based quiz platform where users can attempt quizzes, receive auto-evaluated results, and earn **verifiable digital certificates**.  
The platform runs in a **live production environment**, demonstrating real-world architecture, deployment practices, and operational reliability on AWS.

Quizify intentionally balances **practical functionality + scalable foundations**, making it suitable as an **interview and portfolio project** that reflects industry expectations.

---

## Live Application

The application is publicly accessible at:  
🔗 **https://www.quizify.space/**

---

## Why This Project Was Built

Quizify was developed to demonstrate:

-   **Full-stack product ownership** — from architecture to deployment
-   **Production environment decision-making** (cost, safety, scalability)
-   **Hands-on CI/CD experience** with GitHub Actions + AWS Elastic Beanstalk
-   **Real user workflows**, not simulated prototypes

> This project represents not just “building an app,” but **running one** — with real deployments, certificates, migrations, and operational discipline.

---

## Target Users

| Role                | Capabilities                                                            |
| ------------------- | ----------------------------------------------------------------------- |
| **Guest**           | Browse quizzes, categories, verify certificates                         |
| **Registered User** | Attempt quizzes, resume progress, view history, access certificates     |
| **Creator**         | Add/manage quizzes & questions (limited permissions)                    |
| **Admin**           | Full system management: users, quizzes, categories, questions, messages |

Roles map directly to implementation — see: **02 — Application Architecture**

---

## Key Features

-   Public browsing of categories & quizzes
-   User registration + email verification
-   Password reset & secure login
-   Sequential question flow with answer recording
-   Auto-evaluated results & certificate generation
-   **QR-based certificate verification with unique IDs**
-   Resume incomplete quiz attempts
-   Role-based access control (User / Creator / Admin)
-   Admin dashboard for content & contact management
-   Contact system with email notifications
-   Responsive UI & SEO-friendly URLs

> Feature set is intentionally focused to maintain **clarity + reliability** during early-stage production.

---

## Technology Stack (High-Level)

| Layer                | Technology                           |
| -------------------- | ------------------------------------ |
| **Framework**        | Laravel 12                           |
| **Database**         | MySQL (local Docker / AWS RDS)       |
| **Containerization** | Docker                               |
| **Hosting**          | AWS Elastic Beanstalk                |
| **Domain + HTTPS**   | Cloudflare                           |
| **CI/CD**            | GitHub Actions                       |
| **Local Dev**        | Docker Compose multi-container setup |

> For detailed architecture see: **05 — Production Architecture** & **06 — AWS Infrastructure**

---

## Status

| Area                      | Status                     |
| ------------------------- | -------------------------- |
| Production deployment     | ✔ Live                     |
| CI validation             | ✔ Enabled                  |
| Semi-automated deployment | ✔ Manual approval required |
| Automated migrations      | ❌ Deferred for safety     |
| Scaling to multi-instance | 🔜 Roadmap item            |

---

**END — 00-project-overview.md**
