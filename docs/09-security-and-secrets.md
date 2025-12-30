# 09 — Security and Secrets

## 1. Purpose & Scope

This section documents the security posture of Quizify, focusing on:

-   runtime secrets handling
-   access control and authentication boundaries
-   infrastructure-level security configurations
-   data protection and storage decisions
-   known limitations and future hardening plans

Out of scope:

-   business logic authorization rules
-   deep threat modeling
-   penetration testing results

---

## 2. Security Principles

Quizify applies the following core security principles:

-   **Least privilege access:** IAM roles and secrets limited to deployment requirements only.
-   **No secrets in source control:** Environment configuration managed outside Git.
-   **Environment-based configuration:** Production configuration stored in Elastic Beanstalk environment properties.
-   **Manual schema migrations:** Database schema changes reviewed and executed manually to avoid destructive updates.
-   **Selective ingress:** Cloudflare IP ranges allowed, with future enforcement planned to restrict public ingress fully.

---

## 3. Secrets Management

### Storage Locations

| Component        | Location                                 | Notes                                                |
| ---------------- | ---------------------------------------- | ---------------------------------------------------- |
| `APP_KEY`        | Elastic Beanstalk environment properties | Injected at runtime; never regenerated during deploy |
| DB credentials   | Elastic Beanstalk environment properties | Not stored in GitHub Actions                         |
| AWS credentials  | GitHub Actions secrets                   | IAM user with programmatic access only               |
| Mail credentials | Elastic Beanstalk environment properties | `MAIL_PASSWORD` hidden in EB console                 |

### Practices

-   `.env` file **not committed to the repository**.
-   `APP_KEY` stored **only in runtime environment**, ensuring stable encryption state across deploys.
-   **GitHub Actions stores only AWS keys**, not application secrets.
-   **Secrets rotation** planned during future security hardening.
-   **Future migration** target: AWS SSM Parameter Store.

---

## 4. Access Control

| Layer              | Enforcement                              | Notes                                              |
| ------------------ | ---------------------------------------- | -------------------------------------------------- |
| User login         | hashed passwords + verification required | email verification required before quiz attempt    |
| Session management | DB-based sessions                        | persist across deployments                         |
| Role layers        | user / creator / admin                   | middleware enforced                                |
| SSH access         | via EC2 instance                         | public access enabled; restriction planned         |
| Cloud ingress      | Cloudflare in place                      | public exposure still allowed; enforcement planned |

> **Email verification is mandatory** before a user can start a quiz, reducing automated abuse risks.

---

## 5. Network Security

### Current State

-   **RDS:** `Publicly accessible = No`
-   **IMDSv2:** enforced (`IMDSv1 Disabled`)
-   **Ingress:** Cloudflare IP ranges allowed, but `0.0.0.0/0` also present
-   **Protocol exposure:** HTTP port 80 permits direct EB access
-   **SSH:** globally accessible; planned transition to AWS SSM Session Manager

### Implication

While Cloudflare proxying protects the application at the domain layer,  
**direct EB endpoint access remains possible**, enabling Cloudflare bypass.

---

## 6. Data Protection

| Data Type                           | Protection            | Notes                                             |
| ----------------------------------- | --------------------- | ------------------------------------------------- |
| Passwords                           | bcrypt hashing        | via `password => hashed` cast in `User` model     |
| Sessions                            | stored in DB          | persistence across deployments                    |
| Contact messages                    | plaintext             | contains non-sensitive fields; encryption planned |
| Certificates                        | generated dynamically | no stored PDF artifacts                           |
| Tokens (email verification / reset) | random strings        | invalidated upon use or completion                |

Sensitive data is **not logged**, and log access is controlled via SSH.

---

## 7. Logging & Monitoring

| Item              | Status               | Notes                            |
| ----------------- | -------------------- | -------------------------------- |
| Log access method | SSH into EB instance | primary debugging approach       |
| EB log streaming  | disabled             | planned activation               |
| Log retention     | default              | no custom lifecycle yet          |
| Alerting          | none                 | CloudWatch alarms not configured |

Future improvement includes enabling CloudWatch metrics and alarms for proactive monitoring.

---

## 8. Known Risks / Limitations

-   **Single-instance Elastic Beanstalk deployment** increases blast radius.
-   **Direct EB access over HTTP** allows Cloudflare bypass.
-   **Public SSH (22)** increases exposure; IP restriction or SSM recommended.
-   **Secrets stored in EB environment properties** rather than centralized store.
-   **Contact messages unencrypted at rest**, though non-sensitive.
-   **Manual database exports** performed instead of automated snapshot pipeline.
-   **No automated alerting or log ingestion** — issues are detected reactively.

---

## 9. Planned Improvements (free-tier viable)

-   Migrate secrets to **AWS SSM Parameter Store (standard tier)**.
-   **Restrict SSH** access or transition to **AWS SSM Session Manager**.
-   Remove public 80/443 exposure to **enforce Cloudflare-only ingress**.
-   Enable **RDS automated snapshots** before schema changes.
-   Enable **CloudWatch log streaming + basic alarms**.
-   Add optional **field-level encryption** for contact messages.
-   Support **presigned S3 URLs** for file uploads if introduced later.

---

## 10. Summary

> **Quizify isolates sensitive runtime configuration in Elastic Beanstalk and IAM-scoped GitHub Actions credentials, avoids committing secrets to Git, and enforces hashed passwords with database-backed sessions. The database is not publicly accessible, IMDSv2 is enforced, and Cloudflare proxying reduces exposure — though ingress hardening is planned to eliminate direct EB access and public SSH. Logging access currently occurs through SSH, with CloudWatch-based monitoring queued for adoption. While early-stage trade-offs remain, the security posture is transparent, controlled, and aligned with a defined upgrade path toward least-privilege and zero-trust principles.**

---
