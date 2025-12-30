# 04 — Git Branching & CI Workflow

## Purpose

This section defines QUIZIFY’s branching strategy and CI workflow.  
It explains how development work is isolated, validated, and merged into `main`  
to maintain a consistently releasable codebase.

---

## 1. Branching Strategy

QUIZIFY uses a **feature-branch based workflow** with `main` as the default and protected branch.

| Item                        | Value                                                  |
| --------------------------- | ------------------------------------------------------ |
| Default branch              | `main`                                                 |
| Branch source for new work  | `main` (updated before branch creation)                |
| Active development branches | `feature/*`                                            |
| Bug fix branches            | not used (`fix/*` not applied yet)                     |
| Hotfix branches             | not used (`hotfix/*` not applied yet)                  |
| Branch deletion after merge | planned (manual cleanup after merge to keep repo tidy) |

### Naming convention

```
feature/<feature-name>
```

Examples:

```
feature/mcq-improvements
feature/quiz-setup
feature/user-signup
```

---

## 2. Feature Development Lifecycle

Feature development follows a repeatable workflow designed to isolate changes and enforce CI validation before integration.

```
main (update)
   ↓
create feature branch → feature/<name>
   ↓
develop → commit locally
   ↓
push feature branch → CI runs
   ↓
CI passes → open PR to main
   ↓
merge commit into main (after CI success)
   ↓
local main updated via pull
```

> **CI acts as a quality gate before integration into `main`.**

---

## 3. Pull Request & Merge Rules

All changes to `main` pass through pull requests. After protection rules were applied, direct pushes are technically blocked.

| Rule                                 | Status / Behavior                              |
| ------------------------------------ | ---------------------------------------------- |
| Pull request required                | **Yes — all changes flow through PRs**         |
| Direct push to `main`                | **Disallowed — blocked via branch protection** |
| Merge permitted only after CI passes | **Yes — CI is a mandatory quality gate**       |
| Merge method                         | **Merge commit** (keeps full feature history)  |
| PR approval required                 | **Not required** (solo development)            |

### Merge method rationale

`merge commit` is used to retain full feature history, which is valuable for debugging and interview-ready documentation.

---

## 4. Branch Protection Settings

The following settings are enabled on the `main` branch:

-   Require pull request before merging
-   Require status checks to pass before merging
-   Required check: `build` (CI job)
-   Require branches to be up to date before merging
-   Do not allow bypassing the above settings

> Result: **`main` always reflects a deployable state.**

---

## 5. Continuous Integration (CI) Workflow

CI is triggered through GitHub Actions via `ci.yml`.

### Trigger matrix

| Event                 | CI Runs? | Behavior                         |
| --------------------- | -------- | -------------------------------- |
| Push to `feature/*`   | ✔️ Yes   | Run install + migrations + tests |
| Pull request → `main` | ✔️ Yes   | Must pass before merge           |
| Merge into `main`     | ✔️ Yes   | Re-validates stability           |

### Responsibilities performed by CI

-   Composer dependency installation
-   Create transient `.env` for CI execution context
-   **SQLite database setup** (`database.sqlite`)
-   Run migrations with `--force`
-   Execute PHPUnit tests
-   Cache Composer dependencies (performance)
-   Upload PHPUnit logs as artifacts

### Not included in CI

-   Database seeding
-   Code coverage reporting
-   Asset compilation (Tailwind CDN used)

---

## 6. Test Environment

Tests run using a **lightweight SQLite database**, ensuring fast execution during CI.

| Component          | Status         |
| ------------------ | -------------- |
| DB driver          | SQLite         |
| Migrations         | Applied on CI  |
| Seeders            | Not used in CI |
| Coverage reporting | Not included   |

> This setup prioritizes execution speed without altering production database behavior.

---

## 7. Merge Outcome & Post-Merge Workflow

After a feature merges into `main`, the branch is considered complete and local development continues from an updated `main`:

1. CI validates `main`
2. Developer checks out `main` locally
3. Updates local state using `git pull`
4. Creates new feature branch for the next task

```
git checkout main
git pull

# next task
git checkout -b feature/<next-feature>
```

---

## 8. Example End-to-End Flow

```
feature/quiz-setup → push → CI pass → PR → merge commit → CI pass on main → local pull → next feature
```

---

## 9. Why This Matters

This workflow ensures:

-   **Controlled integration** through feature isolation
-   **Main branch stability** via enforced CI
-   **Traceable history** through merge commits
-   **Predictable development** for future CI/CD extension

> QUIZIFY’s branching and CI design demonstrates production-aligned practices that demonstrate disciplined workflow management,even in a single-developer environment.

---

## Status Summary

| Area             | Status                    |
| ---------------- | ------------------------- |
| Branch isolation | ✔️ Achieved               |
| PR-only merges   | ✔️ Enforced               |
| CI as gate       | ✔️ Enforced               |
| Main stability   | ✔️ Maintained             |
| Cleanup strategy | Planned (branch deletion) |

---

## Next steps (planned)

-   Automatically delete feature branches after merge
-   Add code coverage reporting
-   Integrate CD workflow (documented separately in section `08-ci-cd-pipeline`)

---

**End of Section — 04 Git Branching & CI Workflow QUIZIFY Documentation**
