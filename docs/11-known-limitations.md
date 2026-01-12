# 11 — Known Limitations

## 1. Purpose

This section documents the **current constraints and trade-offs** within Quizify’s early-stage implementation.
The goal is to clearly communicate **what is intentionally limited today**—based on cost, safety, and development priorities—while enabling future improvements without redesign.

These are **not architectural mistakes**; they are **transparent and deliberate boundaries** aligned with the project’s phase and resources.

---

## 2. Application-Level Limitations

-   No public REST API; all functionality is UI-driven.
-   Soft deletes are not implemented—deletions are permanent.
-   Certificate generation is dynamic; PDFs are re-rendered instead of being stored.
-   Quiz feature set is intentionally minimal (e.g., no timers, randomization, or question banks).
-   No leaderboard or user-to-user interaction features.
-   Admin workflows are direct; moderation or approval pipelines are not introduced.

---

## 3. Architecture & Infrastructure Limitations

-   **Single-instance Elastic Beanstalk deployment** provides stability but causes brief downtime during releases and lacks redundancy.
-   **No load balancer or blue-green deployment**; zero-downtime deployment is not enabled at this stage.
-   **Autoscaling is disabled** to prioritize cost control.
-   **HTTPS termination occurs at Cloudflare**, not natively within AWS.
-   **Direct access to the EB endpoint remains technically possible**, allowing Cloudflare bypass until ingress is fully restricted.
-   **Log streaming and retention via CloudWatch are not yet configured**, making log access primarily instance-based.
-   **Operational access occasionally requires SSH**; transition to AWS SSM Session Manager is planned.
-   **Elastic Beanstalk currently runs on an Amazon Linux 2–based platform**, which is aligned with AWS support at the time of deployment; migration to Amazon Linux 2023 (AL2023) is planned as part of ongoing platform maintenance.

---

## 4. Database & Storage Limitations

-   **RDS Multi-AZ deployment is disabled**, meaning failover requires manual action.
-   **Database migrations are executed manually post-deploy**, increasing operational responsibility.
-   **Attempt and result data are retained indefinitely**; no archival or retention policy is defined.
-   **No indexing strategy is optimized for analytics workloads**.
-   **Contact form messages are stored as plaintext**, although they contain non-sensitive content.
-   **No persistent user uploads**; S3 integration is planned but not yet required.

---

## 5. Security Limitations

-   **Cloudflare ingress is not yet enforced at the network level**, allowing direct EB access over HTTP.
-   **Secrets are stored in Elastic Beanstalk environment properties**, not in a centralized secret store.
-   **SSH access remains publicly reachable**, though limited and monitored; migration to SSM is pending.
-   **Automated alerting and intrusion monitoring are not active**; issue detection is currently reactive.

---

## 6. CI/CD Limitations

-   **Deployments require manual approval**, keeping CD semi-automated to protect production data.
-   **Database migrations are not automated** due to imported schema and safety considerations.
-   **Post-deployment smoke tests are manual**; automated runtime validation is planned.
-   **Code coverage and static analysis are not part of CI**, prioritizing runtime validation first.

---

## 7. User Experience Limitations

-   **Dark mode and accessibility-focused UI options are not implemented**.
-   **Custom error pages (403 / 404 / 500)** are not defined; framework defaults are used.

---

## 8. Performance Limitations

-   **No caching layer** (Redis/Memcached) is introduced yet, as current scale does not require it.
-   **Background queues are not used**, keeping request handling synchronous.
-   **CDN-based media or upload handling is not configured**, as there are no persistent uploads today.
-   **Deployments rebuild the container image**, leading to slower release cycles than incremental updates.

---

## 9. Operational Limitations

-   **Monitoring and alerting are reactive**; metrics and alarms are not configured.
-   **Log retrieval is manual**, and long-term centralized retention is not in place.
-   **Rollbacks require EB version selection plus optional database snapshot restoration** when schema changes are involved.
-   **No automated cleanup or archival strategy** for historical operational data.

---

## 10. Future Mitigation Paths

These limitations have clear and planned upgrade paths detailed in:

-   `12-future-improvements.md`
-   `13-executive-summary.md`
-   `07-deployment-strategy.md` (rollback and migration safety)

Limitations reflect **strategic prioritization**, not neglect.

---

## 11. Summary

> **Quizify intentionally balances cost, safety, and simplicity in its current stage.**
> It runs as a single-container deployment with manual migrations, reactive monitoring, and controlled release workflows.
> These limitations are known, documented, and paired with clear upgrade paths, demonstrating architectural awareness—not oversights.

---

**END — 11-known-limitations.md**
