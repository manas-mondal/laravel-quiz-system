# 07 — Deployment Strategy

## 1. Purpose & Scope

This section documents **how Quizify is deployed to production**, including deployment flow, triggering mechanisms, responsibilities, safety measures, and rollback expectations.

It focuses on **operational deployment strategy**, not technical implementation details.

**Included**

-   Deployment lifecycle & triggers
-   Preconditions and post-deployment steps
-   Rollback options & limitations

**Not included**

-   CI/CD internals → see **08 — CI/CD Pipeline**
-   Container runtime & architecture → see **05 — Production Architecture**
-   AWS service descriptions → see **06 — AWS Infrastructure**

---

## 2. Deployment Goals

The deployment strategy exists to ensure:

-   **Production stability** during updates on a single-container environment
-   **Consistency between application code and database schema**
-   **Safe deployments with limited resources** (free-tier, single instance)
-   **Rollback awareness** when migrations could break compatibility
-   **Controlled release workflow** instead of direct pushes to production

---

## 3. Deployment Lifecycle

| Stage                | Description                                                   |
| -------------------- | ------------------------------------------------------------- |
| Development complete | Feature finished locally                                      |
| Merge to `main`      | Only after PR review                                          |
| CI validation        | Tests + build checks must pass                                |
| Deployment trigger   | Manual approval from GitHub Actions or manual `eb deploy`     |
| Deployment to EB     | Code packaged & uploaded to Elastic Beanstalk                 |
| Manual DB migrations | Performed after deployment to avoid breaking early-stage data |
| Smoke testing        | Basic verification of stability and functionality             |

---

## 4. Deployment Entry Points

| Deployment Path                     | Who triggers                         | Notes                                |
| ----------------------------------- | ------------------------------------ | ------------------------------------ |
| Manual CLI deploy                   | Developer from WSL using `eb deploy` | Default & reliable                   |
| GitHub Actions manual approval      | Developer approves workflow run      | Adds CI validation before deployment |
| Direct auto-deploy without approval | **Not enabled**                      | Deferred until stability validated   |

**Current approach:**

> _Deployments are semi-automated — CI must pass, but deployments require explicit approval to maintain safety._

---

## 5. Deployment Modes

| Mode                                  | Description                       | Current | Planned         |
| ------------------------------------- | --------------------------------- | ------- | --------------- |
| Manual CLI deploy                     | Developer runs `eb deploy`        | ✔       | —               |
| CI-triggered deploy (manual approval) | Deploy when `main` updated        | ✔       | Full auto later |
| Fully automated CD                    | Deploy after CI without approval  | ✖       | Future          |
| Blue-green deployment                 | Staged rollout to new environment | ✖       | Future          |
| Zero-downtime migrations              | Non-blocking schema changes       | ✖       | Future          |

---

## 6. Deployment Preconditions

Before deploying, confirm:

-   Latest code is **merged into `main`**
-   **CI checks have passed**
-   **Elastic Beanstalk environment variables are up-to-date**
-   **No pending breaking migrations without DB snapshot**
-   Application container **builds successfully locally**
-   **RDS connectivity** is stable

Deployment should be **paused** if:

-   A migration renames or drops columns without snapshot
-   Production hotfix is pending
-   Unreviewed schema changes exist

---

## 7. Deployment Commands

### Main deployment steps

```bash
git checkout main
git pull
eb deploy quizify-env
```

> `eb init` is required only on first setup, not for every deployment.

### Post-deployment commands (manual)

```bash
php artisan migrate --force
php artisan config:cache        # optional, conservative usage
php artisan queue:restart       # if queues added later
```

---

## 8. Post-Deployment Verification

After deployment:

-   Application loads successfully
-   Login, registration, quiz flow, certificate verification work
-   Database reads & writes behave normally
-   No fatal errors in logs
-   SSL / Cloudflare does not serve outdated assets
-   Quick functional test using a known certificate ID

> Minimal test window is **30–90 seconds after container restart**.

---

## 9. Rollback Strategy

| Action                     | Method                                             |
| -------------------------- | -------------------------------------------------- |
| Roll back application code | Redeploy previous Elastic Beanstalk version        |
| Roll back to stable commit | Checkout older commit → redeploy                   |
| Roll back database         | **Manual RDS snapshot restore** (no auto rollback) |

**Notes**

-   DB rollback is **not automated**, so migrations must be deployed cautiously.
-   Breaking schema changes require **manual snapshot creation before deployment**.

---

## 10. Responsibilities & Permissions

| Action                          | Role                     |
| ------------------------------- | ------------------------ |
| Merge pull requests             | Developer                |
| Trigger deployments             | Developer                |
| Modify EB environment variables | Developer                |
| Run manual migrations           | Developer (high caution) |

> Separation of duties may be introduced when the team grows.

---

## 11. Deployment Constraints

Current deployment constraints due to early-stage architecture:

-   **Single EC2 instance** → brief downtime during deployment
-   **Manual migrations** → protects data but slows deployments
-   **SSH access occasionally required**
-   **Application state & DB schema must remain aligned**
-   **Rolling / blue-green not in use**

---

## 12. Planned Enhancements

Future improvements aligned with project maturity:

-   Pre-deploy **DB snapshot + automated migrations**
-   **Full blue-green deployments** to eliminate downtime
-   **Multi-instance environment** with load balancing
-   **SSM integration** to remove direct SSH usage
-   Built-in **HTTPS termination** at load balancer
-   **Pre-deploy smoke tests** inside CI pipeline

---

## 13. Summary

> _Quizify uses a semi-automated deployment workflow: code is validated through CI, then deployed to Elastic Beanstalk with explicit approval to protect production stability. Database migrations remain manual to avoid data loss in early-stage constraints. The strategy balances safety and speed, while laying a clear path toward blue-green deployment and automated migrations in future releases._
