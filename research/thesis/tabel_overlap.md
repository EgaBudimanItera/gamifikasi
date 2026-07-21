# Tabel Anti-Overlap — Refactoring Tesis EduQuest

## Dokumen Asal

`research/thesis/gamification.md` (1.090 baris) — mencampur 3 domain: Requirement Engineering & Design Science, Fullstack Product Engineering, QA Automation & Executable BDD.

## Dokumen Hasil Refactoring

| File | Domain Utama | Ukuran |
|:-----|:-------------|-------:|
| `01_RPL_DSR_EduQuest.md` | RPL / Design Science Research | 35 KB |
| `02_Product_Engineering_EduQuest.md` | Product Engineering | 41 KB |
| `03_QA_Automation_EduQuest.md` | QA Automation | 42 KB |

---

## Tabel Anti-Overlap

| No | Topik | File 1 — RPL/DSR | File 2 — Product Eng | File 3 — QA Automation |
|:--:|:------|:------------------:|:--------------------:|:----------------------:|
| 1 | Requirement Engineering | **UTAMA** | — | traceability saja |
| 2 | Design Science Research | **UTAMA** | — | — |
| 3 | User Story & Acceptance Criteria | **UTAMA** | — | sebagai input |
| 4 | Traceability Matrix | konsep | — | **implementasi** |
| 5 | NPC Mentor Affinity (konseptual) | **UTAMA** | — | — |
| 6 | NPC Mentor Affinity (kode) | — | **implementasi** | — |
| 7 | Guild (konseptual) | **UTAMA** | — | — |
| 8 | Guild (kode) | — | **implementasi** | — |
| 9 | Laravel / Next.js / REST API | — | **UTAMA** | — |
| 10 | Database Design | — | **UTAMA** | — |
| 11 | Deployment / Docker | — | **UTAMA** | — |
| 12 | Performance / Scalability | — | **UTAMA** | — |
| 13 | Security | — | **UTAMA** | — |
| 14 | Gherkin BDD Scenarios | contoh singkat | — | **UTAMA (85+ skenario)** |
| 15 | Playwright Automation | — | — | **UTAMA** |
| 16 | CI/CD Pipeline | — | — | **UTAMA** |
| 17 | Test Coverage Dashboard | — | — | **UTAMA** |
| 18 | Defect Mapping | — | — | **UTAMA** |
| 19 | SUS / UEQ / Engagement | **evaluasi** | — | — |
| 20 | Kurikulum Merdeka | konteks | — | — |
| 21 | Expert Validation | konsep | — | — |

---

## Keterangan

| Simbol | Arti |
|:-------|:-----|
| **UTAMA** | Topik merupakan fokus utama dokumen |
| **implementasi** | Topik dibahas pada level kode dan arsitektur |
| **konsep** | Topik dibahas pada level konseptual/desain |
| **konteks** | Topik disebut sebagai latar belakang, bukan fokus analisis |
| **evaluasi** | Topik digunakan sebagai instrumen evaluasi |
| **sebagai input** | Topik digunakan sebagai masukan, bukan objek studi |
| **traceability saja** | Topik dibahas hanya dalam konteks keterlacakan |
| **contoh singkat** | Topik disebut sebagai ilustrasi, bukan pembahasan mendalam |
| — | Topik tidak dibahas dalam dokumen |
