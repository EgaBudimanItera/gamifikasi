# USULAN PENELITIAN TESIS

## PENGEMBANGAN MODEL REQUIREMENT ENGINEERING DAN EXECUTABLE BEHAVIOR-DRIVEN DEVELOPMENT UNTUK SISTEM GAMIFIKASI PEMBELAJARAN ADAPTIF SISWA SMP KELAS VII

---

Diajukan sebagai salah syarat untuk Kolokium
Magister Ilmu Komputer

**[NAMA PENELITI]**
[NPM]

Pembimbing:
Dr. [Nama Pembimbing], M.Kom.

PROGRAM STUDI MAGISTER ILMU KOMPUTER
FAKULTAS TEKNIK DAN ILMU KOMPUTER
UNIVERSITAS TEKNOKRAT INDONESIA
BANDAR LAMPUNG
2026

---

## A. JUDUL

**PENGEMBANGAN MODEL REQUIREMENT ENGINEERING DAN EXECUTABLE BEHAVIOR-DRIVEN DEVELOPMENT UNTUK SISTEM GAMIFIKASI PEMBELAJARAN ADAPTIF SISWA SMP KELAS VII**

---

## B. RINGKASAN

Sistem pembelajaran konvensional masih menghadapi tantangan penurunan motivasi siswa, keterlambatan penyelesaian tugas, dan rendahnya partisipasi aktif dalam kegiatan kelas. Gamifikasi telah terbukti efektif meningkatkan motivasi melalui elemen seperti XP, level, badge, streak, dan leaderboard (Deterding et al., 2011). Namun, mekanisme personalisasi berbasis NPC Mentor Affinity dan kolaborasi berbasis guild belum banyak dieksplorasi secara terintegrasi dalam konteks gamifikasi pendidikan untuk siswa SMP di Indonesia.

Penelitian ini bertujuan mengembangkan model Requirement Engineering dan Executable Behavior-Driven Development (BDD) untuk sistem gamifikasi pembelajaran adaptif (EduQuest) yang ditujukan bagi siswa SMP kelas VII. Sistem ini mengintegrasikan sekitar 60 functional requirements yang dikelompokkan dalam modul-modul inti: Authentication, Master Data, Learning, Gamification, Engagement, NPC Mentor Affinity, Guild Collaborative Reward, Quest System, Gamified Retrieval Quiz, dan Material Reading. Metode yang digunakan adalah Design Science Research (DSR) dengan tahapan Problem Identification, Objectives Definition, Design & Development, Demonstration, Evaluation, dan Communication. Requirement Engineering diterapkan melalui identifikasi kebutuhan, User Story, Acceptance Criteria, dan Behavior-Driven Development (BDD) scenarios yang terhubung melalui traceability matrix.

Tiga kontribusi utama penelitian ini adalah: (1) Adaptive Gamified Learning Requirement Model (AGLRM) — model requirement engineering yang menghubungkan kebutuhan stakeholder pendidikan dengan spesifikasi sistem gamifikasi adaptif; (2) Requirement–BDD Traceability Model — keterlacakan penuh dari kebutuhan hingga pengujian otomatis; dan (3) NPC Mentor Affinity Score (MAS) dan Guild Collaborative Reward sebagai konsep desain adaptif dan kolaboratif yang didefinisikan pada level requirement. Mekanisme pendukung meliputi XP & Level, Badge, Streak, Leaderboard, Gamified Retrieval Quiz, dan Material Reading.

Instrumen evaluasi meliputi SUS (usability), UEQ (user experience), dan Gamification Engagement Questionnaire. Sampel penelitian adalah 30–40 siswa SMP kelas VII selama 4–6 minggu. Hasil yang diharapkan: (1) model requirement engineering gamifikasi adaptif untuk SMP, (2) model traceability Requirement–BDD, dan (3) evaluasi usability serta engagement pengguna.

---

## C. PENDAHULUAN

### 1. Latar Belakang

Pendidikan merupakan pilar utama dalam pembangunan sumber daya manusia yang berkualitas. Di era digital, perkembangan teknologi informasi telah membawa perubahan signifikan dalam dunia pendidikan. Kurikulum Merdeka yang diterapkan oleh Kementerian Pendidikan Indonesia menekankan pendekatan pembelajaran berpusat pada siswa, memberikan fleksibilitas bagi guru untuk mengembangkan kreativitas dalam proses belajar mengajar [1].

Namun demikian, dalam praktiknya, guru dan siswa masih menghadapi berbagai tantangan. Siswa SMP kelas VII berada dalam fase transisi dari pendidikan dasar ke pendidikan menengah, di mana mereka perlu beradaptasi dengan lingkungan belajar baru, mata pelajaran yang lebih beragam, dan ekspektasi akademik yang lebih tinggi. Usia 12–13 tahun merupakan periode kritis di mana motivasi intrinsik siswa rentan menurun akibat transisi sekolah, perubahan tubuh, dan tuntutan sosial yang meningkat [13]. Siswa sering kali mengalami penurunan motivasi belajar, keterlambatan dalam menyelesaikan tugas, dan partisipasi yang rendah dalam kegiatan kelas.

Gamifikasi, yaitu penerapan elemen-elemen permainan dalam konteks non-permainan, telah terbukti efektif dalam meningkatkan motivasi dan keterlibatan pengguna dalam berbagai bidang, termasuk pendidikan [2]. Elemen gamifikasi seperti Experience Points (XP), level, badge, streak, dan leaderboard dapat memberikan insentif intrinsik dan ekstrinsik yang mendorong siswa untuk lebih aktif dalam proses pembelajaran [3]. Lampropoulos & Sidiropoulos (2024) melalui studi longitudinal 3 tahun membuktikan bahwa gamifikasi meningkatkan hasil belajar secara signifikan [10].

Namun demikian, sebagian besar sistem gamifikasi pendidikan yang ada bersifat statis — mekanisme reward dan tantangan tidak berubah berdasarkan profil dan perilaku individu siswa. Dicheva et al. (2015) dalam systematic mapping study menemukan bahwa penelitian gamifikasi pendidikan masih banyak berfokus pada mekanisme points, leaderboards, dan badges tanpa personalisasi adaptif [8]. NPC (Non-Player Character) sebagai mentor virtual dapat memberikan quest kontekstual yang disesuaikan dengan progres dan kemampuan siswa. Mekanisme affinity antara siswa dan mentor memungkinkan adaptivitas: semakin dekat hubungan siswa dengan mentor, semakin menantang dan berharga quest yang diberikan. Di sisi lain, guild sebagai komunitas belajar kolaboratif mendorong siswa untuk saling mendukung dan berkontribusi bersama [23].

Dari perspektif rekayasa perangkat lunak, permasalahan utama adalah bagaimana memodelkan kebutuhan sistem gamifikasi adaptif ini sedemikian rupa sehingga dapat ditelusuri (traceable) dari level kebutuhan stakeholder hingga level pengujian otomatis. Requirement Engineering konvensional sering kali menghasilkan dokumen yang terpisah dari implementasi dan pengujian, menciptakan kesenjangan (gap) antara apa yang dibutuhkan pengguna dan apa yang diuji oleh pengembang. Behavior-Driven Development (BDD) menawarkan pendekatan alternatif di mana requirement dinyatakan dalam format yang dapat dieksekusi secara otomatis, namun integrasi BDD dengan requirement engineering dalam konteks gamifikasi pendidikan masih jarang diteliti.

Penelitian ini bertujuan untuk mengembangkan model Requirement Engineering dan Executable BDD untuk sistem gamifikasi pembelajaran adaptif, dengan NPC Mentor Affinity dan Guild Collaborative Reward sebagai studi kasus konsep desain. Model ini dirancang agar dapat direplikasi pada sistem gamifikasi pendidikan lainnya.

### 1.1 Data Urgensi Nasional

| No | Data | Sumber | Temuan |
|----|------|--------|--------|
| 1 | Asesmen Nasional (AN) 2023 — Capaian rata-rata nasional | Kemendikbudristek | Capaian rata-rata siswa SMP di bawah 50% pada sebagian besar mata pelajaran inti |
| 2 | PISA 2022 — Skor literasi membaca Indonesia | OECD | Indonesia berada di peringkat ke-68 dari 81 negara, skor 359 (bawah rata-rata OECD 476) |
| 3 | PISA 2022 — Skor literasi matematika Indonesia | OECD | Skor 366, peringkat ke-70 dari 81 negara |
| 4 | Survei Kepuasan Belajar Daring 2022 | Kemendikbudristek | 62% siswa SMP merasa pembelajaran daring tidak interaktif dan membosankan |
| 5 | Indeks Pembangunan Pendidikan (IPD) 2024 | UNESCO | Indonesia peringkat 92 dari 191 negara dalam hal kualitas pendidikan |
| 6 | Angka Putus Sekolah SMP 2023 | BPS | Rata-rata angka putus sekolah SMP nasional sekitar 0,31% per tahun |

### 2. Kondisi Awal Sekolah

| Aspek | Kondisi Saat Ini | Target yang Diharapkan |
|-------|-----------------|----------------------|
| Partisipasi aktif siswa | Hanya 40–50% siswa aktif bertanya atau menjawab selama pembelajaran | Minimal 70% siswa berpartisipasi aktif |
| Konsistensi penyelesaian tugas | Rata-rata 30% tugas dikumpulkan tepat waktu; 25% siswa terlambat lebih dari 3 hari | Minimal 80% tugas tepat waktu |
| Interaksi kolaboratif antar siswa | Siswa jarang bekerja sama secara spontan; diskusi kelompok sering didominasi oleh 1–2 siswa | Minimal 60% siswa berkontribusi dalam kerja kelompok |
| Motivasi belajar intrinsik | Siswa lebih termotivasi oleh nilai daripada pemahaman materi | Siswa termotivasi oleh proses belajar dan pencapaian personal |
| Penggunaan teknologi pembelajaran | Guru menggunakan Google Classroom hanya untuk distribusi materi tanpa elemen engagement | Sistem dengan gamifikasi yang meningkatkan engagement |

Wawancara dengan guru mata pelajaran (n=3) mengungkapkan bahwa: (a) siswa kelas VII cenderung kehilangan motivasi setelah 2–3 minggu pertama, (b) tidak ada mekanisme personalisasi yang menyesuaikan tantangan dengan kemampuan individual, dan (c) kolaborasi siswa terjadi secara parsial tanpa insentif terstruktur.

### 3. Rumusan Masalah

1. Bagaimana memodelkan kebutuhan sistem gamifikasi pembelajaran adaptif untuk siswa SMP kelas VII menggunakan pendekatan Requirement Engineering berbasis Design Science Research?
2. Bagaimana membangun model traceability yang menghubungkan User Story, Acceptance Criteria, dan skenario Behavior-Driven Development sehingga setiap kebutuhan dapat ditelusuri hingga pengujian otomatis?
3. Bagaimana utility dan usability artefak requirement model terhadap pengguna SMP kelas VII dievaluasi dalam kerangka Design Science Research?

### 4. Pertanyaan Penelitian (Research Questions)

#### RQ1
Bagaimana memodelkan kebutuhan sistem gamifikasi pembelajaran adaptif bagi siswa SMP kelas VII menggunakan Requirement Engineering dan Design Science Research?

#### RQ2
Bagaimana membangun model traceability Requirement–BDD yang menghubungkan User Story, Acceptance Criteria, dan skenario BDD sehingga setiap kebutuhan memiliki test case yang dapat dieksekusi secara otomatis?

#### RQ3
Bagaimana utility dan usability artefak model requirement terhadap pengguna SMP kelas VII dievaluasi menggunakan instrumen SUS, UEQ, dan Gamification Engagement Questionnaire?

**Pemetaan Research Question:**

| Research Question | Metode | Sumber Data | Teknik Analisis |
|---|---|---|---|
| RQ1 | Design Science Research + Requirement Engineering | Stakeholder interview, dokumen kurikulum, observasi | Analisis kebutuhan + artifact design |
| RQ2 | BDD & Traceability Analysis | User Story, BDD scenarios, traceability matrix | Traceability completeness analysis |
| RQ3 | Quasi-experimental (one-group pretest-posttest) | SUS, UEQ, Engagement, system logs | Paired t-test / Wilcoxon, effect size |

### 5. Tujuan Penelitian

Tujuan penelitian ini adalah mengembangkan dan mengevaluasi model Requirement Engineering dan Executable Behavior-Driven Development untuk sistem gamifikasi pembelajaran adaptif berbasis web untuk siswa SMP kelas VII, menggunakan kerangka Design Science Research.

Tujuan khusus penelitian:

1. Mengidentifikasi kebutuhan sistem gamifikasi pembelajaran adaptif untuk siswa SMP kelas VII melalui elicitation stakeholder dan analisis kurikulum.
2. Menyusun User Story dan Acceptance Criteria berdasarkan kebutuhan sistem yang teridentifikasi.
3. Membangun model traceability Requirement–BDD yang menghubungkan User Story, Acceptance Criteria, dan skenario BDD.
4. Mendefinisikan konsep NPC Mentor Affinity Score (MAS) dan Guild Collaborative Reward sebagai artefak desain pada level requirement.
5. Mengevaluasi utility artefak model dan usability sistem terhadap pengguna SMP kelas VII.

### 6. Manfaat Penelitian

#### 6.1 Manfaat Akademik
- Memberikan kontribusi ilmiah dalam bidang Requirement Engineering dan Gamifikasi di pendidikan melalui kerangka Design Science Research.
- Menjadi referensi bagi peneliti lain yang tertarik dengan topik serupa, khususnya terkait integrasi Requirement Engineering dan BDD dalam gamifikasi pendidikan.
- Menghasilkan artefak penelitian (User Story, BDD, Traceability Matrix) yang dapat direplikasi.
- Memperkaya kajian tentang model requirement gamifikasi adaptif berbasis NPC dan guild kolaboratif.

#### 6.2 Manfaat Praktis
- Menyediakan model requirement engineering yang dapat digunakan oleh pengembang sistem gamifikasi pendidikan.
- Membantu guru dalam memahami kebutuhan sistem gamifikasi melalui User Story dan BDD dalam bahasa alami.
- Memberikan model traceability yang memastikan setiap fitur sistem dapat ditelusuri dari kebutuhan hingga pengujian.

---

## D. TINJAUAN PUSTAKA

### 1. Gamifikasi dalam Pendidikan

Deterding et al. (2011) mendefinisikan gamifikasi sebagai penerapan elemen desain permainan dalam konteks non-permainan [2]. Saleem et al. (2022) dalam systematic review menemukan bahwa elemen gamifikasi paling umum adalah points, leaderboards, badges, dan levels [3]. Lampropoulos & Sidiropoulos (2024) melalui studi longitudinal 3 tahun membuktikan bahwa gamifikasi meningkatkan hasil belajar secara signifikan [10]. Dicheva et al. (2015) dalam systematic mapping study mengidentifikasi bahwa penelitian gamifikasi pendidikan masih banyak berfokus pada mekanisme dasar tanpa personalisasi adaptif [8].

### 2. Teori Motivasi

Self-Determination Theory (SDT) menjelaskan tiga kebutuhan psikologis dasar: autonomi, kompetensi, dan relasionalitas [11]. NPC Mentor Affinity memenuhi relasionalitas melalui hubungan siswa–mentor. Guild Collaborative Reward memenuhi relasionalitas melalui kolaborasi antar anggota. Flow Theory menjelaskan kondisi optimal saat tantangan seimbang dengan kemampuan [12].

### 3. Requirement Engineering

Sommerville (2016) mendefinisikan Requirement Engineering sebagai proses sistematis untuk mendokumentasikan kebutuhan sistem [14]. Lucassen et al. (2016) mengembangkan Quality User Story framework dengan 13 kriteria kualitas [15]. Dalam konteks gamifikasi pendidikan, requirement engineering harus mampu menangkap kebutuhan yang bersifat adaptif dan kolaboratif.

### 4. Behavior-Driven Development

Nascimento et al. (2020) menunjukkan bahwa BDD meningkatkan kolaborasi tim dan kualitas requirement [16]. García et al. (2023) melalui systematic mapping study memvalidasi efektivitas BDD dari 166 papers [17]. BDD menjembatani kesenjangan komunikasi antara stakeholder non-teknis (guru, siswa) dan pengembang melalui skenario perilaku dalam bahasa alami (Gherkin).

### 5. Personalisasi dan Adaptivitas

Brusilovsky (2001) mendefinisikan sistem adaptif sebagai sistem yang dapat menyesuaikan perilakunya berdasarkan model pengguna [27]. Peter & Kinshuk (2022) mengkategorikan sistem adaptif pendidikan menjadi: adaptif konten, adaptif antarmuka, dan adaptif navigasi [29]. NPC Mentor Affinity Score (MAS) merepresentasikan mekanisme rule-based adaptive.

### 6. Kolaborasi Berbasis Guild

Guild dalam konteks gamifikasi pendidikan berfungsi sebagai kelompok belajar kecil yang mendorong kolaborasi [23]. Guild Collaborative Reward memenuhi kebutuhan relasionalitas dalam SDT [11].

### 7. Design Science Research

Hevner et al. (2004) mendefinisikan DSR sebagai paradigma penelitian yang bertujuan menghasilkan artefak inovatif [24]. Peffers et al. (2007) mengembangkan metodologi DSR dengan enam tahapan [19]. Baskerville et al. (2026) memperbarui metodologi evaluasi DSR melalui MEDS [25].

### 8. Landasan Teori Adaptivitas

EduQuest menggunakan pendekatan **rule-based adaptive mechanism**, bukan machine learning.

| Karakteristik | Implementasi dalam EduQuest |
|---------------|----------------------------|
| **Input condition** | MAS level, quest completion rate, reading time, guild activity |
| **Rule definition** | Threshold MAS [0, 5, 15, 30, 50] → level 1–5 |
| **Output action** | Quest difficulty (easy/medium/hard/legendary), reward amount, NPC dialogue |
| **Deterministic** | Hasil yang sama untuk kondisi input yang sama |
| **Interpretable** | Aturan dapat dipahami dan dimodifikasi oleh pengembang/guru |

---

## E. RESEARCH GAP

| Penelitian | Gamifikasi Pendidikan | Requirement Engineering | Traceability RE–BDD | NPC Adaptif (Konseptual) | Guild Kolaboratif (Konseptual) | DSR |
|---|:---:|:---:|:---:|:---:|:---:|:---:|
| Deterding et al. (2011) | ✓ | ✗ | ✗ | ✗ | ✗ | ✗ |
| Dicheva et al. (2015) | ✓ | ✗ | ✗ | ✗ | ✗ | ✗ |
| Hamari et al. (2014) | ✓ | ✗ | ✗ | ✗ | ✗ | ✗ |
| Saleem et al. (2022) | ✓ | ✗ | ✗ | ✗ | ✗ | ✗ |
| Lampropoulos & Sidiropoulos (2024) | ✓ | ✗ | ✗ | ✗ | ✗ | ✗ |
| Sommerville (2016) | ✗ | ✓ | ✗ | ✗ | ✗ | ✗ |
| Nascimento et al. (2020) | ✗ | ✗ | ✓ | ✗ | ✗ | ✗ |
| García et al. (2023) | ✗ | ✗ | ✓ | ✗ | ✗ | ✗ |
| Lucassen et al. (2016) | ✗ | ✓ | ✗ | ✗ | ✗ | ✗ |
| Peffers et al. (2007) | ✗ | ✗ | ✗ | ✗ | ✗ | ✓ |
| Hevner et al. (2004) | ✗ | ✗ | ✗ | ✗ | ✗ | ✓ |
| **Penelitian ini** | **✓** | **✓** | **✓** | **✓** | **✓** | **✓** |

**Belum ditemukan penelitian yang mengintegrasikan Requirement Engineering, Executable BDD, NPC Mentor Affinity (sebagai konsep desain), Guild Collaborative Reward (sebagai konsep desain), dan traceability Requirement–BDD dalam satu model gamifikasi pembelajaran adaptif untuk siswa SMP kelas VII menggunakan kerangka Design Science Research.**

---

## F. DESAIN PENELITIAN (DESIGN SCIENCE RESEARCH)

### 1. Paradigma Penelitian

Penelitian ini menggunakan **Design Science Research (DSR)** sebagai paradigma utama (Hevner et al., 2004 [24]; Peffers et al., 2007 [19]).

### 2. Tahapan DSR

#### Tahap 1 — Problem Identification & Motivation
- Rendahnya motivasi dan engagement siswa SMP kelas VII.
- Tidak adanya mekanisme personalisasi dan kolaborasi terstruktur.
- Kesenjangan antara requirement stakeholder pendidikan dan spesifikasi teknis.
- Tidak adanya model traceability requirement–pengujian otomatis.

#### Tahap 2 — Define Objectives for a Solution
Artefak yang dihasilkan:
1. **AGLRM** — model requirement engineering untuk gamifikasi adaptif.
2. **Requirement–BDD Traceability Model** — keterlacakan dari User Story hingga BDD executable.
3. **NPC MAS specification** — spesifikasi konseptual personalisasi.
4. **Guild Reward specification** — spesifikasi konseptual kolaboratif.

Kriteria keberhasilan: SUS ≥ 70, UEQ ≥ 0.8, Quest Completion ≥ 70%, BDD Pass Rate ≥ 90%, Traceability completeness ≥ 100%.

#### Tahap 3 — Design & Development
1. **Elicitation** — wawancara stakeholder, analisis kurikulum, observasi.
2. **Analysis & Specification** — pengelompokan ~60 FR ke dalam modul.
3. **User Story & Acceptance Criteria** — penerjemahan FR ke bahasa stakeholder.
4. **BDD Scenario Writing** — penulisan skenario Gherkin yang dapat dieksekusi.
5. **Traceability Matrix** — matriks keterlacakan FR → US → AC → BDD → Test Case.

#### Tahap 4 — Demonstration
Studi kasus: 30–40 siswa SMP kelas VII menggunakan sistem selama 4–6 minggu.

#### Tahap 5 — Evaluation
1. **Utility artefak** — evaluasi traceability, kualitas User Story, kejelasan BDD.
2. **Usability & engagement** — SUS, UEQ, Gamification Engagement Questionnaire.

#### Tahap 6 — Communication
Penulisan laporan tesis dan publikasi artefak penelitian.

### 3. Alur Benang Merah Penelitian

```
Masalah Sekolah → DSR Framework → Requirement Engineering
    → User Story & Acceptance Criteria → BDD Executable
    → Traceability Matrix
    → NPC MAS [Konsep Desain] + Guild Reward [Konsep Desain]
    → Evaluasi (SUS + UEQ + Engagement + System Logs)
```

---

## G. KONTRIBUSI PENELITIAN DAN MEKANISME ADAPTIF

### 1. Adaptive Gamified Learning Requirement Model (AGLRM)

AGLRM mengintegrasikan:
1. **Stakeholder Analysis** — kebutuhan dari guru, siswa, admin, pengembang.
2. **Functional Requirements Mapping** — ~60 FR ke dalam modul.
3. **User Story & Acceptance Criteria** — format yang dipahami stakeholder non-teknis.
4. **BDD Scenarios** — formalisasi perilaku ke skenario eksekusi.
5. **Traceability Matrix** — FR → US → AC → BDD → Test Case.

### 2. NPC Mentor Affinity Score (MAS) — Konsep Desain

#### 2.1 Definisi
MAS adalah skor numerik yang mengukur kekuatan hubungan antara siswa dan mentor virtual.

#### 2.2 Faktor Peningkatan MAS

| Faktor | Bobot | Deskripsi |
|--------|-------|-----------|
| Penyelesaian quest | 50% | Setiap quest yang diselesaikan menambah MAS |
| Konsistensi belajar | 20% | Login harian dan check-in streak |
| Ketepatan waktu | 15% | Quest diselesaikan sebelum deadline |
| Performa akademik | 15% | Skor quiz dan tugas yang tinggi |

#### 2.3 Formula MAS

```
MAS_baru = MAS_lama + (Quest × 0.50) + (Konsistensi × 0.20) + (Ketepatan × 0.15) + (Performa × 0.15)
```

#### 2.4 Threshold MAS untuk Level Affinity

| Level | MAS Required | Deskripsi |
|-------|-------------|-----------|
| 1 | 0 | Baru bertemu |
| 2 | 5 | Mulai akrab |
| 3 | 15 | Dipercaya |
| 4 | 30 | Mentor dekat |
| 5 | 50 | Mentor terbaik |

#### 2.5 Perbedaan XP dan MAS

| Aspek | XP | MAS |
|-------|-----|-----|
| **Tujuan** | Progress global seluruh sistem | Hubungan spesifik dengan satu NPC |
| **Cakupan** | Seluruh aktivitas | Aktivitas terkait NPC tertentu |
| **Pengaruh** | Level dan leaderboard | Quest adaptif dan personalisasi |
| **Sifat** | Universal | Kontekstual |

**MAS merupakan profil personalisasi pembelajaran, bukan sekadar poin tambahan.**

### 3. Guild Collaborative Reward — Konsep Desain

#### 3.1 Mekanisme
- **XP Contribution:** XP individual otomatis menjadi Guild XP.
- **Guild Target:** Target mingguan yang harus dicapai bersama.
- **Reward Distribution:** Seluruh anggota menerima reward jika target tercapai.
- **Guild Chest:** Reward kolektif berupa XP bonus, badge, atau item khusus.

#### 3.2 Contoh Skenario
**Target:** 50 quest selesai dalam satu minggu.
**Reward:** +150 XP seluruh anggota, Guild Chest, Bonus 10% XP 24 jam.

#### 3.3 Implikasi Terhadap Engagement
Guild Collaborative Reward memenuhi kebutuhan relasionalitas dalam SDT [11].

### 4. Requirement–BDD Traceability Model

#### 4.1 Definisi
Keterlacakan: User Story → Acceptance Criteria → BDD Scenario → Implementasi → Test Case.

#### 4.2 Contoh Traceability

| Requirement | User Story | Acceptance Criteria | BDD Scenario | Test Case |
|-------------|-----------|---------------------|-------------|-----------|
| NPC-07 (Affinity calculation) | US-21 | AC-21 | BDD-21 | TC-21 |
| GUILD-03 (Guild XP contribution) | US-34 | AC-34 | BDD-34 | TC-34 |
| QUEST-05 (Adaptive quest generation) | US-28 | AC-28 | BDD-28 | TC-28 |

#### 4.3 BDD sebagai Executable Specification

Pipeline:
```
Requirement Engineering (FR) → User Story (US) → Acceptance Criteria (AC)
→ Gherkin Scenario (.feature) → Step Definitions (Playwright)
→ CI/CD Execution → Test Report (HTML + Coverage)
```

Contoh Gherkin:
```gherkin
Feature: NPC Affinity Progression
  Scenario: Affinity meningkat setelah quest selesai
    Given siswa memiliki MAS 10
    When siswa menyelesaikan quest Informatika
    Then MAS bertambah 5 poin
    And level affinity diperbarui
```

---

## H. KLASIFIKASI REQUIREMENT

### 1. Core Requirements (FR-01 s/d FR-46)

| Modul | FR Range | Deskripsi |
|-------|----------|-----------|
| Authentication | FR-01–FR-05 | Login, register, role management, password reset |
| Master Data | FR-06–FR-10 | Sekolah, kelas, mata pelajaran, tahun akademik |
| Learning | FR-11–FR-20 | Materi, tugas, pengumpulan, penilaian |
| Gamification | FR-21–FR-30 | XP, level, badge, streak, leaderboard, quest |
| Engagement | FR-31–FR-34 | Check-in harian, daily challenge, notification |
| NPC Mentor | FR-35–FR-40 | NPC encounter, affinity, quest gating, quest completion |
| Guild | FR-41–FR-46 | Guild management, XP contribution, guild quest |

### 2. Supporting Requirements (FR-47 s/d FR-56)

| Modul | FR Range | Deskripsi |
|-------|----------|-----------|
| Gamified Retrieval Quiz | FR-47–FR-52 | Quiz berbasis kelas dan guild, timer, ranking |
| Material Reading | FR-53–FR-56 | Baca materi, progress tracking, quiz pasca-bacaan |

### 3. Future Requirements (FR-57 s/d FR-63)

| Modul | FR Range | Deskripsi |
|-------|----------|-----------|
| Analytics Dashboard | FR-57–FR-59 | Statistik guru, export, monitoring real-time |
| Competitive Quiz Mode | FR-60–FR-62 | Mode kompetisi antar siswa |
| Knowledge Synthesis Mechanism | FR-63 | Mekanisme sintesis pengetahuan |

---

## I. METODOLOGI

### 1. Jenis Penelitian

Paradigma **Design Science Research (DSR)** dengan evaluasi quasi-experimental (one-group pretest-posttest).

### 2. Populasi dan Sampel

- **Populasi:** Siswa SMP kelas VII di wilayah Bandar Lampung
- **Sampel:** 30–40 siswa dari 1–2 kelas
- **Teknik Sampling:** Purposive sampling

### 3. Instrumen Penelitian

#### 3.1 System Usability Scale (SUS)
10 pernyataan, skala Likert 1-5. Skor = (Σ Konversi Skor) × 2.5. Kriteria: ≥ 68 above average.

#### 3.2 User Experience Questionnaire (UEQ)
6 dimensi: Attractiveness, Clarity, Efficiency, Stimulation, Novelty, Usability. Skala 1-7.

#### 3.3 Gamification Engagement Questionnaire
- **Competition:** Motivasi kompetisi (leaderboard, quiz ranking).
- **Collaboration:** Aktivitas kolaborasi di guild.
- **Narrative Attachment:** Ikatan dengan NPC mentor.
- **Exploration:** Motivasi mengeksplorasi konten.
- **Continued Intention:** Kesiapan melanjutkan penggunaan.

### 4. Variabel Penelitian

#### Variabel Independen
| No | Variabel | Deskripsi |
|----|----------|-----------|
| 1 | NPC Mentor Affinity | Kekuatan hubungan siswa–mentor |
| 2 | Guild Collaborative Reward | Kolaborasi guild dengan XP dan reward |
| 3 | Quest System | Quest kontekstual berdasarkan materi |
| 4 | XP & Level System | Sistem poin dan progres level |

#### Variabel Dependen
| No | Variabel | Instrumen |
|----|----------|-----------|
| 1 | User Engagement | Gamification Engagement Questionnaire |
| 2 | Task Completion Rate | System logs |
| 3 | Reading Participation | System logs |
| 4 | Learning Motivation | Pre-post test |
| 5 | Usability | SUS |

### 5. Hipotesis Penelitian

#### H0-1 / H1-1
Tidak terdapat / Terdapat peningkatan signifikan tingkat user engagement setelah menggunakan EduQuest.

#### H0-2 / H1-2
Tidak terdapat / Terdapat peningkatan signifikan skor usability (SUS) setelah penggunaan sistem.

#### H0-3 / H1-3
Tidak terdapat / Terdapat hubungan positif signifikan antara MAS dan tingkat penyelesaian quest.

α = 0.05. H0 ditolak jika p-value < 0.05.

### 6. Pengolahan Data

- **Statistik Deskriptif:** mean, median, modus, SD.
- **Uji Normalitas:** Shapiro-Wilk (α = 0.05).
- **Uji Homogenitas:** Levene's test (α = 0.05).
- **Uji-t:** Paired samples t-test (data normal).
- **Wilcoxon Signed Rank Test:** (data tidak normal).
- **Effect Size:** Cohen's d.
- **Korelasi:** Pearson (NPC affinity–task completion), Spearman (guild activity–engagement).

### 7. Kriteria Keberhasilan Artefak DSR

| Aspek | Indikator | Target | Sumber Data |
|-------|-----------|--------|-------------|
| Utility Artefak | Traceability Completeness | 100% FR memiliki path ke BDD | Traceability matrix |
| Kualitas User Story | Quality User Story Score | ≥ 10 dari 13 kriteria | Expert judgment |
| Usability | SUS | ≥ 70 | Kuesioner post-test |
| User Experience | UEQ Attractiveness | ≥ 0.8 | Kuesioner post-test |
| Engagement | Quest Completion Rate | ≥ 70% | System logs |
| Retensi | 14-day Streak Retention | ≥ 50% siswa | System logs |
| Kualitas BDD | BDD Pass Rate | ≥ 90% | CI/CD test report |

### 8. Keterbatasan Penelitian

Ancaman validitas internal: novelty effect, history effect, maturation effect, selection bias. Mitigasi: durasi 4–6 minggu, observasi partisipatif, purposive sampling. Tidak mengklaim kausalitas karena tidak ada kelompok kontrol.

### 9. Ruang Lingkup Klaim

#### 9.1 Klaim yang Diuji Langsung
- SUS ≥ 70, engagement meningkat (p < 0.05), task completion rate meningkat.

#### 9.2 Klaim Konseptual
- NPC MAS memungkinkan personalisasi quest.
- Guild Collaborative Reward mendorong kolaborasi.
- Model RE–BDD Traceability memastikan keterlacakan.

#### 9.3 Peluang Penelitian Lanjutan
- Efektivitas MAS terhadap hasil belajar kognitif.
- Pengaruh guild terhadap motivasi intrinsik jangka panjang.
- Perbandingan gamifikasi adaptif vs statis.

### 10. Threats to Validity

#### 10.1 Validitas Internal
| Ancaman | Mitigasi |
|---------|----------|
| Novelty effect | Durasi 4–6 minggu; analisis log longitudinal |
| History effect | Observasi partisipatif |
| Maturation effect | Fokus pada engagement |
| Selection bias | Purposive sampling dengan kriteria jelas |

#### 10.2 Validitas Eksternal
| Ancaman | Mitigasi |
|---------|----------|
| Sampel terbatas | Dokumentasi konteks agar replikasi dilakukan |
| Generalisasi | Penelitian lanjutan dengan sampel lebih besar |

#### 10.3 Validitas Konstruk
| Ancaman | Mitigasi |
|---------|----------|
| Instrumen tidak valid | Instrumen tervalidasi internasional (SUS, UEQ) |
| Adaptasi bahasa | Expert judgment 2–3 ahli |

#### 10.4 Validitas Reliabilitas
| Ancaman | Mitigasi |
|---------|----------|
| Skor tidak konsisten | Cronbach's Alpha ≥ 0.70 |

### 11. Etika Penelitian
1. Mendapatkan persetujuan pihak sekolah.
2. Informed consent dari siswa dan wali.
3. Menjaga kerahasiaan data responden.
4. Tidak menimbulkan kerugian bagi responden.
5. Sistem tidak menimbulkan tekanan psikologis berlebihan.

### 12. Etika Gamifikasi Pendidikan
1. Reward selalu terkait aktivitas akademik.
2. Tidak ada transaksi atau monetisasi.
3. Quest dibatasi tujuan pembelajaran.
4. NPC sebagai fasilitator belajar, bukan pengganti guru.
5. Tidak ada mekanisme kecanduan.
6. Data siswa dilindungi.

---

## J. HASIL YANG DIHARAPKAN

### 1. Artefak Penelitian

#### Artefak 1 — Adaptive Gamified Learning Requirement Model (AGLRM)
Model requirement engineering untuk sistem gamifikasi adaptif.

#### Artefak 2 — Requirement–BDD Traceability Model
Model keterlacakan dari User Story → AC → BDD → Test Case.

#### Artefak 3 — Evaluation Dataset
Data usability dan engagement siswa SMP.

### 2. Kontribusi Teoritis

1. **Model Integrasi Personalisasi dan Kolaborasi dalam Gamifikasi Pendidikan.**
2. **NPC Mentor Affinity Score (MAS)** — novel contribution.
3. **Guild Collaborative Reward System** — novel contribution.
4. **Requirement–BDD Traceability Model** — novel contribution.

### 3. Target Publikasi

| No | Artikel | Target Jurnal |
|----|---------|---------------|
| 1 | Requirement–BDD Traceability Model | Jurnal Sistem Informasi / RE |
| 2 | NPC Mentor Affinity dan Engagement Siswa | Jurnal Teknologi Pendidikan |
| 3 | Guild Collaborative Reward pada Pembelajaran SMP | Jurnal Gamifikasi / CS Education |

---

## K. JADWAL PENELITIAN

| Bulan | Kegiatan |
|-------|----------|
| **Bulan 1** | Studi literatur, identifikasi kebutuhan, Requirement Engineering (User Story, AC, BDD) |
| **Bulan 2** | Validasi requirement, traceability matrix, desain database, desain API |
| **Bulan 3** | Desain UI/UX, implementasi backend dan frontend |
| **Bulan 4** | Implementasi NPC, Guild, Quest, Quiz, Material Reading |
| **Bulan 5** | Implementasi frontend: dashboard, NPC UI, guild UI, quiz UI, analytics |
| **Bulan 6** | Unit testing, BDD testing, bug fixing, deployment |
| **Bulan 7** | Pilot testing, pre-test, treatment (4–6 minggu) |
| **Bulan 8** | Post-test, analisis data (SPSS/R), penulisan laporan, revisi |

---

## L. DAFTAR PUSTAKA

### Gamifikasi dalam Pendidikan
[1] Kementerian Pendidikan Indonesia, "Kurikulum Merdeka," 2022.
[2] S. Deterding et al., "From Game Design Elements to Gamefulness," Proc. 15th Int. Acad. MindTrek Conf., 2011, pp. 9-15.
[3] A. N. Saleem et al., "Gamification Applications in E-Learning: A Literature Review," Technology, Knowledge and Learning, vol. 27, no. 1, pp. 139-159, 2022.
[4] K. J. Topping, "Trends in Peer Learning," Educational Psychology, vol. 25, no. 6, pp. 631-645, 2005.
[5] J. Hamari et al., "Does Gamification Work?," Proc. 47th Hawaii Int. Conf. System Sciences, 2014, pp. 3025-3034.
[6] H. L. Roediger & A. C. Butler, "The Critical Role of Retrieval Practice," Trends in Cognitive Sciences, vol. 15, no. 1, pp. 20-27, 2011.
[7] M. Sailer et al., "How Gamification Motivates," Computers in Human Behavior, vol. 69, pp. 371-380, 2017.
[8] D. Dicheva et al., "Gamification in Education: A Systematic Mapping Study," J. Educational Technology & Society, vol. 18, no. 3, pp. 75-88, 2015.
[9] S. Fiş Erümit & T. Karakuş Yılmaz, "Gamification Design in Education," Technology, Knowledge and Learning, vol. 27, pp. 1039-1061, 2022.
[10] G. Lampropoulos & A. Sidiropoulos, "Impact of Gamification on Students' Learning Outcomes," Education Sciences, vol. 14, no. 4, p. 367, 2024.

### Teori Motivasi
[11] E. L. Deci & R. M. Ryan, "Self-Determination Theory," Canadian Psychology, vol. 49, no. 3, pp. 182-185, 2008.
[12] M. Csikszentmihalyi, Flow: The Psychology of Optimal Experience. Harper & Row, 1990.
[13] L. Festinger, "A Theory of Social Comparison Processes," Human Relations, vol. 7, no. 2, pp. 117-140, 1954.

### Requirement Engineering & BDD
[14] I. Sommerville, Software Engineering, 10th ed. Pearson, 2016.
[15] G. Lucassen et al., "Improving Agile Requirements: The Quality User Story Framework," Requirements Engineering, vol. 21, pp. 383-400, 2016.
[16] N. Nascimento et al., "Behavior-Driven Development: A Case Study," IEEE/ACM 42nd ICSE Workshops, 2020, pp. 109-116.
[17] M. García et al., "Behaviour Driven Development: A Systematic Mapping Study," J. Systems and Software, vol. 203, p. 111744, 2023.

### Basis Data & Penelitian
[18] E. F. Codd, "A Relational Model of Data," Communications of the ACM, vol. 13, no. 6, pp. 377-387, 1970.
[19] K. Peffers et al., "A Design Science Research Methodology for IS Research," J. Management Information Systems, vol. 24, no. 3, pp. 45-77, 2007.

### Usability & UX
[20] J. Brooke, "SUS: A 'Quick and Dirty' Usability Scale," Usability Evaluation in Industry, 1996, pp. 189-194.
[21] B. Laugwitz et al., "Construction and Evaluation of a User Experience Questionnaire," HCI and Usability, 2008, pp. 63-76.
[22] H. L. O'Brien et al., "A Practical Approach to Measuring User Engagement," Int. J. Human-Computer Studies, vol. 112, pp. 28-39, 2018.

### Pendukung
[23] O. Kode, "Gamification in Education: Review of Challenges," Int. J. Cybernetics & Informatics, vol. 14, no. 4, pp. 13-28, 2025.
[24] A. R. Hevner et al., "Design Science in IS Research," MIS Quarterly, vol. 28, no. 1, pp. 75-105, 2004.
[25] R. Baskerville et al., "MEDS: Methodology for Evaluation in Design Science," European J. Information Systems, 2026.
[26] I. K. Raharjana et al., "User Story Extraction from Natural Language," J. Systems and Software, vol. 200, p. 111634, 2023.

### Adaptivitas dan Personalisasi
[27] P. Brusilovsky, "Adaptive Hypermedia," User Modeling and User-Adapted Interaction, vol. 11, no. 1-2, pp. 87-110, 2001.
[28] D. Sampson et al., "Personalised Learning: Concepts, Technologies and Practices," Proc. 14th World Conf. MCL, 2019, pp. 1-8.
[29] M. Peter & Kinshuk, "Adaptive Educational Systems: A Review," Computers & Education, vol. 180, p. 104426, 2022.
[30] S. T. Hamari, "Context-Aware Gamification: A Review," Int. J. Human–Computer Studies, vol. 170, p. 102945, 2023.
