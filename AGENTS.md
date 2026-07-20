# AGENTS — EduQuest Multi-Agent Workflow

## AGENT 1 — SYSTEM ARCHITECT

Mission: Merancang arsitektur sistem yang scalable, aman, dan mudah dipelihara.

Responsibilities:

* Monorepo structure
* API architecture
* Database architecture
* Authentication flow
* Deployment strategy
* Docker environment

Deliverables:

* architecture.md
* erd.png
* api-overview.md
* docker-compose.yml

---

## AGENT 2 — REQUIREMENT ENGINEER

Mission: Menghasilkan seluruh artefak penelitian RPL.

Responsibilities:

* 40 functional requirements
* 40 user stories
* 40 acceptance criteria
* 40 BDD scenarios
* Traceability matrix
* Requirement validation

Deliverables:

* /research/requirements/
* /research/user-stories/
* /research/bdd/
* traceability-matrix.xlsx

---

## AGENT 3 — BACKEND ENGINEER

Mission: Membangun REST API Laravel 10 production-ready.

Responsibilities:

* Migration
* Model
* Controller
* Service layer
* Repository pattern
* Validation
* API Resource
* Authentication
* Error handling

Deliverables:

* /backend
* Postman collection
* PHPUnit tests

---

## AGENT 4 — GAMIFICATION ENGINEER

Mission: Membangun engine gamifikasi modular.

Responsibilities:

* XP calculation
* Level algorithm
* Badge rule engine
* Streak engine
* Quest engine
* Leaderboard engine
* Reward scheduler

Deliverables:

* /backend/app/Services/Gamification/
* gamification-rules.json
* unit tests

---

## AGENT 5 — FRONTEND ENGINEER

Mission: Membangun UI modern, mobile-first, dan accessible.

Responsibilities:

* Authentication pages
* Student dashboard
* Teacher dashboard
* Leaderboard UI
* Quest UI
* Badge gallery
* Progress visualization
* Responsive design

Deliverables:

* /frontend
* Component library

---

## AGENT 6 — QA & BDD ENGINEER

Mission: Menjamin keterhubungan requirement dengan testing.

Responsibilities:

* Gherkin feature files
* Playwright E2E tests
* Coverage report
* Regression testing
* Traceability verification

Deliverables:

* /tests/bdd/
* /tests/e2e/
* coverage-report.html

---

## AGENT 7 — RESEARCH ANALYST

Mission: Menyiapkan data dan analisis untuk tesis.

Responsibilities:

* SUS instrument
* UEQ instrument
* Engagement instrument
* Reliability analysis
* Statistical testing
* Result visualization
* Thesis chapter drafting

Deliverables:

* /research/instruments/
* /research/analysis/
* /research/thesis/

---

## AGENT 8 — DOCUMENTATION WRITER

Mission: Menyusun dokumentasi teknis dan akademik yang konsisten.

Responsibilities:

* README
* Installation guide
* API documentation
* Deployment guide
* Architecture explanation
* Research methodology documentation

Deliverables:

* README.md
* INSTALL.md
* API.md
* DEPLOYMENT.md
* RESEARCH_METHOD.md

---

## Collaboration Rules

1. Requirement Engineer defines requirements first.
2. System Architect validates architecture against requirements.
3. Backend and Frontend Engineers implement approved requirements only.
4. QA Engineer creates BDD scenarios for every requirement.
5. Research Analyst maintains traceability between FR, User Story, Acceptance Criteria, BDD, and Test Case.
6. Documentation Writer updates documentation after every major milestone.

---

## Definition of Done

A feature is DONE only when:

* Requirement exists
* User Story exists
* Acceptance Criteria exists
* BDD scenario exists
* Backend implemented
* Frontend implemented
* Automated test passes
* Documentation updated
* Traceability matrix updated
