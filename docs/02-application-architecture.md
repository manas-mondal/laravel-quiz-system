# 02 — Application Architecture

## Purpose

A concise, high-level overview of QUIZIFY’s internal architecture. Focus is on responsibilities, component interactions, and application flow without exposing implementation code or deployment specifics.

---

## Table of contents

1. Application layer overview
2. Routing strategy
3. Database schema
4. Authentication & authorization
5. Core domain modules
6. Quiz attempt flow (conceptual)
7. Result evaluation & certificates
8. Certificate verification
9. Admin panel architecture
10. Creator role (limited access)
11. Contact & communication flow
12. Data integrity & constraints
13. Error handling & feedback
14. SEO & URL design
15. Architectural summary

---

## 1. Application layer overview

QUIZIFY follows Laravel’s MVC pattern and separates concerns across layers:

-   Models: persistent entities (users, quizzes, categories, questions, attempts, certificates, messages).
-   Controllers: request handling, validation, state transitions, and orchestration.
-   Blade views: UI for public, authenticated, and admin surfaces.

Responsibility domains:

-   User-facing: quiz participation, result review, certificate access, messages.
-   Admin: content lifecycle (categories, quizzes, questions), message review.
-   Shared services: email delivery, certificate rendering, reusable layout components.

Primary operation is request-driven with session-backed quiz state and database persistence for results and certificates.

---

## 2. Routing strategy

Routes defined in web.php and logically grouped:

-   Public routes: landing, quiz browsing, certificate verification.
-   Authenticated routes: quiz attempts, user history, messaging.
-   Admin routes: content management (restricted by role).

Access enforced via middleware (auth, verified, role:admin, role:creator). The site is page-driven; there is no public REST API at this stage.

---

## 3. Database schema (reference)

> 🔗 Detailed entity relationships, schema diagrams, and table responsibilities are documented separately in:  
> **[02.1 — Database Schema](./02.1-database-schema.md)**

---

## 4. Authentication & authorization

Built on Laravel authentication features:

-   Registered accounts, email verification (required to attempt quizzes), password reset via token links.
-   Session-managed authentication.

Role model:

-   User: attempt quizzes and access certificates.
-   Creator: create quizzes, categories, and questions with limited modification rights.
-   Admin: full content and configuration control.

Unauthorized requests redirect to appropriate pages (login, dashboard) with clear guidance.

---

## 5. Core domain modules (high level)

-   User: account lifecycle, attempts, results, certificate retrieval.
-   Category: organizes quizzes; top-level content grouping.
-   Quiz: metadata, requirements and progress rules; guests can view but must verify and authenticate to attempt.
-   Question / MCQ: stores questions and choices; sequential progression enforced to maintain integrity.

---

## 6. Quiz attempt flow (conceptual)

Flow (stateful and order-dependent):

1. User selects a quiz.
2. Session initialized (current index, counts).
3. Question rendered with choices.
4. User submits answer → stored.
5. If next question exists → continue; otherwise compute results and determine certificate eligibility.

Quiz navigation is intentionally stateful and linear to prevent manipulation.

---

## 7. Result evaluation & certificate logic

-   Results computed after all questions complete.
-   Passing threshold: ≥ 70% to qualify for a certificate.
-   Certificates referenced by a unique certificate ID linking user and quiz.
-   Certificates are rendered dynamically (no static PDF storage) to allow regeneration and verification without storage overhead.

---

## 8. Certificate verification system

-   Public verification page validates certificate IDs and returns user, quiz, and achievement metadata.
-   Invalid IDs produce structured error responses.
-   Certificates include a QR code that links to the verification URL.
-   Verification URLs are shareable but intentionally not indexed for SEO.

---

## 9. Admin panel architecture

-   Integrated into the same Laravel application and protected by role-based middleware.
-   Admin capabilities: manage categories, quizzes, questions, and view contact submissions.
-   Business logic remains internal; the panel provides content lifecycle controls without exposing implementation internals.

---

## 10. Creator role (limited access)

-   Can add quizzes, categories, and questions.
-   Restricted from deleting critical or admin-owned records and from system configuration.
-   Enables collaborative content creation while limiting system-wide impact.

---

## 11. Contact & communication flow

-   Contact form is visible to visitors; submission requires login to reduce spam.
-   Messages stored in DB and emailed to admins.
-   Admins review and manage messages in the admin panel.

---

## 12. Data integrity & constraints

-   Entities linked via foreign keys (e.g., user → attempt → certificate).
-   Strict user-quiz linkage prevents cross-contamination of attempt data.
-   Certificates use unique identifiers for authenticity and traceability.
-   Deletions are permanent (no soft deletes) to preserve data cleanliness.

---

## 13. Error handling & user feedback

-   Inline form validation with contextual messages.
-   Unauthorized actions redirect with explanatory guidance.
-   Navigation violations (backtracking or skipping during attempts) produce warnings and controlled redirects to preserve state integrity.

---

## 14. SEO & URL design

-   User-facing URLs use readable slugs for clarity and shareability.
-   Certificate verification URLs are shareable but not SEO-targeted.
-   Core interactive features remain behind authentication to avoid accidental indexing.

---

## 15. Architectural summary

QUIZIFY is designed for clarity, security, and maintainability:

-   Clear domain responsibilities and MVC alignment.
-   Stateful, session-backed quiz interaction with strict progression rules.
-   Role-based access control for content and system management.
-   Dynamic certificate rendering and public verification without permanent file storage.
-   Scalable architecture with straightforward paths for future enhancements (APIs, background jobs, soft deletes).

---

**END — 02-application-architecture.md**
