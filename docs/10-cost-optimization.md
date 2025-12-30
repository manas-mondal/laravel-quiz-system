# 10 — Cost Optimization

## 1. Purpose & Scope

This section outlines the cost-conscious design decisions implemented in Quizify’s early-stage production deployment. The goal is to minimize monthly cloud costs while maintaining stability and performance appropriate for a single-instance environment.

All strategies documented here are based on current implementation — not theoretical best practices.

## 2. Cost-Saving Architecture Decisions

Core decisions reducing AWS cost footprint:

-   **Single EC2 instance on Elastic Beanstalk** — no autoscaling groups (avoids multi-instance billing)
-   **No Application Load Balancer (ALB)** — removes LB charges and TLS termination cost at AWS level
-   **No NAT Gateway** — avoids one of the highest recurring AWS network costs in ap-south-1
-   **RDS Multi-AZ disabled** — reduced cost with trade-off in automatic failover
-   **Cloudflare HTTPS termination** — avoids certificate management and cost on AWS side
-   **Tailwind delivered via CDN** — no local asset build pipeline required
-   **No S3 storage** — no object storage or CloudFront cost yet
-   **No EFS volumes** — avoids persistent network filesystem billing
-   **Manual database migrations** — avoids managed migration infrastructure or pipelines

**Summary:** Every avoided component prevents recurring costs without limiting future scalability.

## 3. Current Cost Profile

Quizify currently operates within AWS 12-month free-tier credits for EC2 + RDS, so no direct charges are billed at this stage.

```
Estimated monthly value without free tier: ~ $18–26 / month
Actual billed: $0 (covered under AWS free tier credits)
```

**Main contributors (if billed normally):**

-   EC2 t3.micro compute hours
-   RDS db.t4g.micro storage + snapshots
-   Data transfer from EB origin (reduced by Cloudflare caching)

**Note:** After free tier expires, EC2 + RDS become primary cost drivers.

## 4. Intentional Cost Avoidance

The following components are intentionally excluded at this stage:

-   Multi-instance auto scaling
-   Application Load Balancer (ALB)
-   Multi-AZ RDS configuration
-   NAT Gateway
-   AWS Secrets Manager or Parameter Store usage
-   S3 static asset storage
-   CloudWatch metric alarms and streaming log ingestion
-   Private NAT networking topology
-   Blue-Green deployment environments

These decisions lower cost but trade reliability and automation.

## 5. Traffic & Bandwidth Optimization

-   **Cloudflare caching** reduces bandwidth usage and protects EC2 origin
-   **Minimal static assets** — no uploads yet → minimal storage + transfer cost
-   **Tailwind via CDN** — avoids extra build artifacts and reduces asset load size
-   **Optimized query patterns** — avoids unnecessary DB round-trips

## 6. Development vs Production Split

| Environment          | Strategy                                | Cost Impact                    |
| -------------------- | --------------------------------------- | ------------------------------ |
| Local development    | Multi-container Docker, MySQL container | No AWS usage                   |
| CI testing           | SQLite & migrations                     | No external DB cost            |
| Deployment frequency | Manual approval before deploy           | Fewer rebuilds & compute usage |

## 7. Storage & Log Handling

-   **Logs stored on instance short-term** — growth minimal at current usage scale
-   **Cleanup performed manually when needed**
-   **No media uploads** — costs avoided until S3 integration becomes necessary

## 8. Scaling Strategy (When Costs Become Acceptable)

Future enhancements expected to increase spend as demand grows:

-   Enable ALB for native HTTPS + HA
-   Use Multi-AZ RDS for failover resilience
-   Auto scaling for increased load
-   Enable SSM Parameter Store / Secrets Manager
-   Transition assets to S3 + CloudFront
-   Add CloudWatch alarms and log pipelines

These changes move the architecture from **“low-cost stable” → “production-grade scalable.”**

## 9. Cost vs Reliability Trade-offs

| Decision            | Benefit                    | Trade-off                                 |
| ------------------- | -------------------------- | ----------------------------------------- |
| Single EC2 instance | Minimized compute cost     | Downtime during deployments; no failover  |
| No ALB              | Removes LB + TLS cost      | No blue-green / zero-downtime rollout     |
| No Multi-AZ         | Lower DB cost              | No automatic failover if AZ outage occurs |
| Manual migrations   | Zero pipeline cost         | Requires operational discipline           |
| No NAT Gateway      | Saves major recurring cost | Limits private networking options         |

**Accepting early-stage cost optimization means tolerating occasional downtime and increased operational responsibility.**

## 10. Future Cost Optimization Opportunities

-   Rotate logs to prevent storage bloat
-   Apply snapshot retention policy to reduce storage cost
-   Offload historical quiz data archives
-   Introduce queues to reduce peak CPU usage
-   Evaluate Lambda for scheduled tasks to avoid EC2 usage spikes
-   Migrate secrets to Parameter Store standard tier for ~$0 monthly

## 11. Summary

Quizify maintains low operational cost through a minimal AWS footprint, prioritizing affordability during the early phase without blocking future scaling. Trade-offs are transparent and consciously managed, enabling gradual upgrades as traffic and funding grow.
