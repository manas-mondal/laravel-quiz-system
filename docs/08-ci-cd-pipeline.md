# 08 — CI/CD Pipeline

## 1. Purpose & Scope

This section documents how **Continuous Integration (CI)** and **Continuous Deployment (CD)** work together in the Quizify project.  
It focuses on **automated validation** (tests, build verification) and **controlled deployment to production**.

### This section covers

-   CI validation workflow for every code change
-   CD workflow deploying to AWS Elastic Beanstalk
-   Approval and manual steps required for safe deployment

### This section does not cover

-   **04 — Git Branching & CI Workflow**
-   **05 — Production Architecture**
-   **07 — Deployment Strategy**

---

## 2. Definitions

| Term                            | Definition                                                                                                                                    |
| ------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------- |
| **CI — Continuous Integration** | Automated validation: dependency installation, environment preparation, migrations, PHPUnit tests, artifact logs. Runs on all branches & PRs. |
| **CD — Continuous Deployment**  | Automated deployment to production **after CI passes and environment approval is granted**.                                                   |
| **Semi-automated deployment**   | Deployment is automated, but **database migrations remain manual** to avoid risk to imported production data.                                 |

> **Why migrations are manual:**  
> Production database was initially populated by external data import.  
> Auto-migrations may cause unexpected schema changes or data loss.

---

## 3. CI/CD Pipeline Overview

Developer Commit  
→ GitHub Actions CI  
→ Composer install, sqlite setup, migrations, tests  
→ Store PHPUnit logs as artifacts  
→ Merge to `main`  
→ GitHub Actions CD (after environment approval)  
→ Deploy to Elastic Beanstalk  
→ **Manual `php artisan migrate --force` on server**

---

## 4. CI Pipeline — Responsibilities

**Workflow:** `.github/workflows/ci.yml`  
**Runs on:** any branch & PR to main

| Step                      | Description                                      |
| ------------------------- | ------------------------------------------------ |
| Checkout code             | Fetch repository                                 |
| Setup PHP                 | PHP 8.2                                          |
| Install dependencies      | `composer install`                               |
| Prepare sqlite test env   | Key generation, `.env` switch, sqlite creation   |
| Prepare storage           | Required Laravel storage paths                   |
| Run migrations            | `php artisan migrate --force` (test schema only) |
| Run tests                 | PHPUnit                                          |
| Cache vendor dependencies | Faster builds                                    |
| Upload PHPUnit logs       | Debug artifacts only                             |

> **Build artifacts are not uploaded** to keep pipeline lightweight for AWS free-tier.

---

## 5. CD Pipeline — Responsibilities

**Workflow:** `.github/workflows/cd.yml`  
**Runs on:** push to `main`

| Requirement       | Status                                             |
| ----------------- | -------------------------------------------------- |
| CI must pass      | ✔ enforced via merge flow                          |
| Deployment branch | `main` only                                        |
| Approval          | Required through GitHub **environment protection** |
| Deployment target | AWS Elastic Beanstalk — `quizify-env`              |

### Automated steps

-   Install & verify EB CLI
-   Initialize Elastic Beanstalk
-   Deploy via `eb deploy quizify-env`

### Manual steps after deployment

-   SSH into instance
-   Run: php artisan migrate --force

---

## 6. Trigger Matrix

| Action                   |  CI Runs   |      CD Runs       | Notes                  |
| ------------------------ | :--------: | :----------------: | ---------------------- |
| Push to `feature/*`      |     ✔      |         ✖          | Dev validation only    |
| PR → `main`              |     ✔      |         ✖          | Must pass before merge |
| Merge to `main`          |     ✔      | ✔ (after approval) | Production deploy      |
| Manual workflow dispatch | ✔ optional |     ✔ optional     | Hotfixes               |

---

## 7. Required Secrets & Credentials

| Secret                  | Location                  | Purpose           |
| ----------------------- | ------------------------- | ----------------- |
| `AWS_ACCESS_KEY_ID`     | GitHub Actions secrets    | EB authentication |
| `AWS_SECRET_ACCESS_KEY` | GitHub Actions secrets    | EB authentication |
| `AWS_REGION`            | GitHub Actions secrets    | Deployment region |
| EB env vars             | Elastic Beanstalk console | Runtime config    |

---

## 8. Pipeline Safety Controls

| Control                       | Purpose                                   |
| ----------------------------- | ----------------------------------------- |
| Environment approval required | Prevent accidental production deployments |
| Manual migrations             | Protect imported production data          |
| No auto-migrate in CI/CD      | Avoid irreversible schema changes         |
| EB version history            | Rollback supported                        |
| CI gating before merge        | Prevents broken deploys                   |
| `main` deploy-only rule       | Controlled release flow                   |

---

## 9. Pipeline Limitations

| Limitation                   | Impact                         |
| ---------------------------- | ------------------------------ |
| Single-instance EB free-tier | Minor downtime during deploy   |
| Manual migrations            | Requires SSH access            |
| No blue-green deployment     | No zero-downtime swaps         |
| Build artifacts not uploaded | Slightly slower deployments    |
| Secrets in GitHub            | Not yet in SSM Parameter Store |

---

## 10. Future Enhancements

| Enhancement                | Benefit                    |
| -------------------------- | -------------------------- |
| DB snapshot + auto-migrate | Safe automated deployments |
| Smoke tests after deploy   | Runtime validation         |
| SSM Parameter Store        | Centralized secrets        |
| Blue-green deployment      | Zero-downtime releases     |
| Coverage reporting         | Visibility & enforcement   |

---

## 11. Summary

**“Quizify uses CI to validate every change and CD to deploy to AWS Elastic Beanstalk. Production deployments require environment approval, while migrations are executed manually to preserve imported data. The pipeline balances automation with safety under free-tier constraints and provides a path toward full automation and zero-downtime releases.”**

---
