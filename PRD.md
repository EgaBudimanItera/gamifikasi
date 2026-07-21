# PRD — EduQuest Gamified Learning Platform

## Product Overview

EduQuest adalah platform pembelajaran berbasis web yang menerapkan gamifikasi untuk meningkatkan motivasi, keterlibatan, dan ketepatan penyelesaian tugas siswa SMP kelas VII pada Kurikulum Merdeka.

Produk ini dikembangkan sebagai artefak penelitian untuk tesis Magister Rekayasa Perangkat Lunak dengan fokus pada Requirement Engineering, User Story, dan Behavior-Driven Development (BDD).

## Research Context

### Judul Tesis

Model Gamification Requirement Engineering Berbasis User Story dan Behavior-Driven Development untuk Sistem Pembelajaran Kurikulum Merdeka

### Metodologi

Design Science Research (DSR)

### Tujuan Penelitian

* Mengidentifikasi kebutuhan sistem gamifikasi pendidikan.
* Memodelkan kebutuhan menggunakan User Story.
* Menerjemahkan kebutuhan menjadi skenario BDD.
* Mengevaluasi usability dan engagement sistem.

## Problem Statement

Sekolah menghadapi masalah:

* Siswa terlambat mengumpulkan tugas.
* Partisipasi kelas rendah.
* Motivasi belajar menurun.
* Guru kesulitan memantau progres belajar.
* Sistem pembelajaran tidak memberikan feedback instan.

## Target Users

### Siswa

* Usia 15–18 tahun
* Menggunakan smartphone setiap hari
* Menyukai reward visual dan kompetisi

### Guru

* Mengelola materi, tugas, dan penilaian
* Memantau progres dan engagement siswa

### Admin

* Mengelola data sekolah dan pengguna

## Core Features

### Authentication

* Login
* Logout
* Reset password
* Role-based access

### Data Master & Relasi

* Kelola sekolah
* Kelola tahun ajaran
* Kelola kelas & tingkatan
* Kelola mata pelajaran
* **Penugasan guru ke kelas & mapel** (1 guru — banyak kelas & mapel)
* **Pendaftaran siswa ke kelas** (1 siswa — 1 kelas)
* Scope materi & tugas per kelas (tidak global per mapel)

### Learning Management

* Kelola materi (discope per kelas)
* Kelola tugas (discope per kelas)
* Upload jawaban
* Penilaian dan feedback

### Gamification

* XP
* Level
* Badge
* Streak
* Quest
* Leaderboard
* Reward notification
* Progress bar

### Analytics

* Dashboard guru
* Dashboard siswa
* Completion rate
* Engagement score
* Aktivitas pengguna

## Functional Requirements (40)

### Authentication

FR-01 Login
FR-02 Logout
FR-03 Reset password
FR-04 Manajemen peran
FR-05 Pembatasan akses

### Master Data

FR-06 Kelola siswa
FR-07 Kelola guru
FR-08 Kelola kelas
FR-09 Kelola mata pelajaran
FR-10 Kelola tahun ajaran

### Learning

FR-11 Buat materi
FR-12 Edit materi
FR-13 Publikasi materi
FR-14 Buat tugas
FR-15 Edit tugas
FR-16 Atur deadline
FR-17 Upload jawaban
FR-18 Penilaian tugas
FR-19 Feedback tugas
FR-20 Revisi tugas

### Gamification

FR-21 Pemberian XP
FR-22 Pengurangan XP
FR-23 Perhitungan level
FR-24 Pemberian badge
FR-25 Pemberian streak
FR-26 Reset streak
FR-27 Pembuatan quest
FR-28 Penyelesaian quest
FR-29 Leaderboard kelas
FR-30 Leaderboard sekolah

### Engagement

FR-31 Notifikasi reward
FR-32 Progress bar
FR-33 Daily challenge
FR-34 Weekly challenge

### Analytics & Audit

FR-35 Dashboard guru
FR-36 Dashboard siswa
FR-37 Statistik penyelesaian
FR-38 Statistik engagement
FR-39 Audit aktivitas
FR-40 Ekspor laporan

## Non-Functional Requirements

* Response time < 3 detik
* Mobile responsive
* Secure authentication
* Audit logging
* Daily backup
* WCAG AA accessibility

## Gamification Rules

* Tugas selesai: +50 XP
* Submit sebelum deadline: +20 XP
* Login harian: +10 XP
* Streak 7 hari: +100 XP
* Streak 30 hari: +500 XP
* Top 3 mingguan: badge reward

### Level Formula

level = floor(sqrt(total_xp / 100)) + 1

## Technology Stack

### Frontend

* Next.js 15
* TypeScript
* Tailwind CSS
* shadcn/ui

### Backend

* Laravel 10
* PHP 8.1
* Laravel Sanctum API

### Database

* MySQL 8

### Testing

* Playwright
* PHPUnit

### DevOps

* Docker Compose
* GitHub Actions

## Required Research Artifacts

Sistem harus menghasilkan:

* 40 Functional Requirements
* 40 User Stories
* 40 Acceptance Criteria
* 40 BDD Scenarios
* Traceability Matrix
* SUS Questionnaire
* UEQ Questionnaire
* User Engagement Questionnaire
* Statistical Analysis Template
* Draft BAB 1–3 tesis

## Success Metrics

### Product

* Completion rate ≥ 80%
* Daily active users ≥ 60%
* Session duration ≥ 10 menit

### Research

* SUS ≥ 70
* UEQ > 1.0
* Peningkatan engagement signifikan (p < 0.05)

## Deliverables

### Technical

* Source code
* API documentation
* Database schema
* Docker deployment
* Test coverage report

### Academic

* Requirement catalog
* User story catalog
* BDD catalog
* Traceability matrix
* Evaluation results
* Thesis draft
