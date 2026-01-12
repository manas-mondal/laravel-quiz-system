# 12 — Future Improvements

> This section builds on limitations documented in **[11 — Known Limitations](./11-known-limitations.md)**.

## 1. Purpose & Scope

This section outlines planned improvements that build upon **identified limitations (Section 11)** and align with the project's **roadmap and architectural goals**. These improvements are prioritized based on **impact, feasibility, and staged maturity**, ensuring Quizify evolves while maintaining stability.

---

## 2. Relationship to Section 11 — Known Limitations

Each improvement proposed here directly corresponds to one or more limitations documented in **Section 11 — Known Limitations**. Future enhancements are not reactive fixes but **deliberate steps** to strengthen scalability, security, maintainability, and user experience.

---

## 3. Improvement Areas by Domain

### 3.1 Architecture & Infrastructure

_Improvements in this domain enhance core platform readiness for availability and scaling._

-   Enable **Application Load Balancer (ALB)** and **multi-instance scaling** to increase availability
-   Introduce **blue-green deployments** for safer releases
-   **Restrict direct EB ingress**, enforcing Cloudflare-only traffic
-   Migrate SSH-based access to **AWS SSM Session Manager**
-   Upgrade Elastic Beanstalk platform runtime from **Amazon Linux 2 to Amazon Linux 2023 (AL2023)** as part of scheduled platform maintenance.

### 3.2 Deployment & Operations

_Enhances release safety, operational reliability, and controlled rollouts._

-   Automate migrations with **pre-deploy DB snapshot** safeguards
-   Add **rollback automation** for application and schema consistency
-   Introduce **pre-deploy smoke tests** within CI to validate runtime

### 3.3 Security & Secrets

_Strengthens credentials handling and system hardening against unauthorized access._

-   Move secrets management to **AWS SSM Parameter Store or Secrets Manager**
-   Restrict or fully remove **public SSH**, replacing with session-based access
-   Add **Cloudflare WAF/Firewall rules** for targeted protection
-   Encrypt contact messages & sensitive fields where applicable

### 3.4 Database & Storage

_Improves data durability, performance, and archival strategies._

-   Store generated/static assets in **S3 + CloudFront**
-   Enable **Multi-AZ RDS** for failover resilience when cost feasible
-   Add **archival rules** for old attempts/results
-   Improve **database indexing** to support analytics performance

### 3.5 Performance & Scalability

_Optimizes throughput and responsiveness under increased workload._

-   Introduce **Redis caching** and **queue workers** for background tasks
-   Execute expensive operations asynchronously via workers
-   Expand question datasets with **randomization & pagination**
-   Apply **query-level caching** when relevant

### 3.6 CI/CD Maturity

_Increases automation, testing confidence, and deployment flow efficiency._

-   Add **test coverage reporting** and static analysis tooling
-   Enable **automated deploy-after-approval**, completing CD
-   Implement **AWS credential auto-rotation**
-   Introduce **environment matrix testing** (multiple PHP versions)

### 3.7 User Experience

_Improves interaction quality, accessibility, and engagement features._

-   Add **accessibility options** and **dark mode** for inclusive design
-   Improve certificate **viewing & sharing workflows**
-   Introduce **leaderboards / achievements** for user engagement
-   Add **localized UI support** for international users

### 3.8 Observability & Monitoring

_Provides visibility into health, performance, and failure modes._

-   Enable **CloudWatch logs streaming** and structured logging
-   Add **CloudWatch alarms** for CPU, memory & availability alerts
-   Centralize error tracking with **Sentry or similar tooling**
-   Define **log retention policies** to control storage overhead

---

## 4. Priority Roadmap

| Priority | Time Frame  | Planned Items                                                                              |
| -------- | ----------- | ------------------------------------------------------------------------------------------ |
| High     | 0–3 months  | Secrets management, ingress hardening, SSM access, pre-deploy migration safety, monitoring |
| Medium   | 3–6 months  | Blue-green deployments, Redis caching, CI/CD maturity additions, indexing improvements     |
| Low      | 6–12 months | Localization, gamification, UX enhancements, Multi-AZ DB, asset migration to S3            |

---

## 5. Sequencing Rationale

Future improvements are intentionally staged to **protect stability while enabling sustainable growth**. Immediate priorities strengthen safety and operational reliability; mid-term work enhances automation and scalability; long-term enhancements improve user experience and resilience. This roadmap ensures that **limitations are addressed progressively**, without disrupting the single-instance cost-optimized environment.

---

These enhancements establish a structured path from early-stage constraints to production-grade maturity.

**END — 12-future-improvements.md**
