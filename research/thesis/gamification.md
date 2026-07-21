# USULAN PENELITIAN TESIS

## PENGEMBANGAN SISTEM GAMIFIKASI PEMBELAJARAN ADAPTIF BERBASIS WEB UNTUK SISWA SMP KELAS VII MENGGUNAKAN PENDEKATAN REQUIREMENT ENGINEERING, USER STORY, DAN BEHAVIOR-DRIVEN DEVELOPMENT

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

**PENGEMBANGAN SISTEM GAMIFIKASI PEMBELAJARAN ADAPTIF BERBASIS WEB UNTUK SISWA SMP KELAS VII MENGGUNAKAN PENDEKATAN REQUIREMENT ENGINEERING, USER STORY, DAN BEHAVIOR-DRIVEN DEVELOPMENT**

---

## B. RINGKASAN

Sistem pembelajaran konvensional masih menghadapi tantangan penurunan motivasi siswa, keterlambatan penyelesaian tugas, dan rendahnya partisipasi aktif dalam kegiatan kelas. Gamifikasi telah terbukti efektif meningkatkan motivasi melalui elemen seperti XP, level, badge, streak, dan leaderboard (Deterding et al., 2011). Namun, mekanisme personalisasi berbasis NPC Mentor Affinity dan kolaborasi berbasis guild belum banyak dieksplorasi secara terintegrasi dalam konteks gamifikasi pendidikan untuk siswa SMP di Indonesia.

Penelitian ini bertujuan mengembangkan sistem gamifikasi pembelajaran adaptif berbasis web (EduQuest) untuk siswa SMP kelas VII. Sistem ini mengintegrasikan sekitar 60 functional requirements yang dikelompokkan dalam modul-modul inti: Authentication, Master Data, Learning, Gamification, Engagement, NPC Mentor Affinity, Guild Collaborative Reward, Quest System, Gamified Retrieval Quiz, dan Material Reading. Metode yang digunakan adalah quasi-experimental dengan desain one-group pretest-posttest. Requirement Engineering diterapkan melalui identifikasi requirements, User Story, Acceptance Criteria, dan Behavior-Driven Development (BDD) scenarios yang terhubung melalui traceability matrix.

Tiga kontribusi utama penelitian ini adalah: (1) NPC Mentor Affinity Score (MAS) — sistem skor hubungan siswa–mentor yang memengaruhi probabilitas kemunculan quest adaptif; (2) Guild Collaborative Reward — sistem kolaborasi berbasis guild dengan kontribusi XP anggota dan reward kolektif; dan (3) Requirement–BDD Traceability Model — keterlacakan penuh dari kebutuhan hingga pengujian otomatis. Mekanisme pendukung meliputi XP & Level, Badge, Streak, Leaderboard, Gamified Retrieval Quiz, dan Material Reading.

Instrumen evaluasi meliputi SUS (usability), UEQ (user experience), dan Gamification Engagement Questionnaire. Sampel penelitian adalah 30–40 siswa SMP kelas VII selama 4–6 minggu. Hasil yang diharapkan: (1) prototipe sistem gamifikasi adaptif untuk SMP, (2) model traceability Requirement–BDD, dan (3) evaluasi usability serta engagement pengguna.

---

## C. PENDAHULUAN

### 1. Latar Belakang

Pendidikan merupakan pilar utama dalam pembangunan sumber daya manusia yang berkualitas. Di era digital, perkembangan teknologi informasi telah membawa perubahan signifikan dalam dunia pendidikan. Kurikulum Merdeka yang diterapkan oleh Kementerian Pendidikan Indonesia menekankan pendekatan pembelajaran berpusat pada siswa, memberikan fleksibilitas bagi guru untuk mengembangkan kreativitas dalam proses belajar mengajar [1].

Namun demikian, dalam praktiknya, guru dan siswa masih menghadapi berbagai tantangan. Siswa SMP kelas VII berada dalam fase transisi dari pendidikan dasar ke pendidikan menengah, di mana mereka perlu beradaptasi dengan lingkungan belajar baru, mata pelajaran yang lebih beragam, dan ekspektasi akademik yang lebih tinggi. Usia 12–13 tahun merupakan periode kritis di mana motivasi intrinsik siswa rentan menurun akibat transisi sekolah, perubahan tubuh, dan tuntutan sosial yang meningkat [13]. Siswa sering kali mengalami penurunan motivasi belajar, keterlambatan dalam menyelesaikan tugas, dan partisipasi yang rendah dalam kegiatan kelas. Di sisi lain, guru kesulitan dalam memantau progres belajar dan engagement siswa secara real-time.

Gamifikasi, yaitu penerapan elemen-elemen permainan dalam konteks non-permainan, telah terbukti efektif dalam meningkatkan motivasi dan keterlibatan pengguna dalam berbagai bidang, termasuk pendidikan [2]. Elemen gamifikasi seperti Experience Points (XP), level, badge, streak, dan leaderboard dapat memberikan insentif intrinsik dan ekstrinsik yang mendorong siswa untuk lebih aktif dalam proses pembelajaran [3]. Lampropoulos & Sidiropoulos (2024) melalui studi longitudinal 3 tahun membuktikan bahwa gamifikasi meningkatkan hasil belajar secara signifikan [10].

Namun demikian, sebagian besar sistem gamifikasi pendidikan yang ada bersifat statis — mekanisme reward dan tantangan tidak berubah berdasarkan profil dan perilaku individu siswa. Dicheva et al. (2015) dalam systematic mapping study menemukan bahwa penelitian gamifikasi pendidikan masih banyak berfokus pada mekanisme points, leaderboards, dan badges tanpa personalisasi adaptif [8]. NPC (Non-Player Character) sebagai mentor virtual dapat memberikan quest kontekstual yang disesuaikan dengan progres dan kemampuan siswa. Mekanisme affinity antara siswa dan mentor memungkinkan adaptivitas: semakin dekat hubungan siswa dengan mentor, semakin menantang dan berharga quest yang diberikan. Di sisi lain, guild sebagai komunitas belajar kolaboratif mendorong siswa untuk saling mendukung dan berkontribusi bersama [23].

Penelitian ini bertujuan untuk mengembangkan model gamifikasi pada sistem pembelajaran berbasis web yang mendukung Kurikulum Merdeka untuk siswa SMP kelas VII, dengan menggunakan pendekatan Requirement Engineering, User Story, dan Behavior-Driven Development (BDD). Sistem yang dikembangkan, yang disebut EduQuest, mengintegrasikan berbagai mekanisme gamifikasi termasuk NPC Mentor Affinity, Guild Collaborative Reward, XP, level, badge, streak, quest, leaderboard, gamified retrieval quiz, dan material reading.

### 1.1 Data Urgensi Nasional

Permasalahan rendahnya motivasi dan engagement siswa dalam pembelajaran bukan sekadar masalah lokal, melainkan memiliki urgensi nasional berdasarkan data resmi berikut:

| No | Data | Sumber | Temuan |
|----|------|--------|--------|
| 1 | Asesmen Nasional (AN) 2023 — Capaian rata-rata nasional | Kemendikbudristek | Capaian rata-rata siswa SMP di bawah 50% pada sebagian besar mata pelajaran inti |
| 2 | PISA 2022 — Skor literasi membaca Indonesia | OECD | Indonesia berada di peringkat ke-68 dari 81 negara, skor 359 (bawah rata-rata OECD 476) |
| 3 | PISA 2022 — Skor literasi matematika Indonesia | OECD | Skor 366, peringkat ke-70 dari 81 negara |
| 4 | Survei Kepuasan Belajar Daring 2022 | Kemendikbudristek | 62% siswa SMP merasa pembelajaran daring tidak interaktif dan membosankan |
| 5 | Indeks Pembangunan Pendidikan (IPD) 2024 | UNESCO | Indonesia peringkat 92 dari 191 negara dalam hal kualitas pendidikan |
| 6 | Angka Putus Sekolah SMP 2023 | BPS | Rata-rata angka putus sekolah SMP nasional sekitar 0,31% per tahun |

Data di atas menunjukkan bahwa rendahnya motivasi dan engagement siswa merupakan masalah sistemik yang membutuhkan solusi inovatif berbasis teknologi. Gamifikasi adaptif berbasis NPC dan guild kolaboratif merupakan pendekatan yang relevan untuk mengatasi permasalahan ini.

### 2. Kondisi Awal Sekolah

Berdasarkan observasi awal dan wawancara dengan guru mata pelajaran di SMP mitra di wilayah Bandar Lampung, diperoleh gambaran kondisi sebagai berikut:

| Aspek | Kondisi Saat Ini | Target yang Diharapkan |
|-------|-----------------|----------------------|
| Partisipasi aktif siswa | Hanya 40–50% siswa aktif bertanya atau menjawab selama pembelajaran | Minimal 70% siswa berpartisipasi aktif |
| Konsistensi penyelesaian tugas | Rata-rata 30% tugas dikumpulkan tepat waktu; 25% siswa terlambat lebih dari 3 hari | Minimal 80% tugas tepat waktu |
| Interaksi kolaboratif antar siswa | Siswa jarang bekerja sama secara spontan; diskusi kelompok sering didominasi oleh 1–2 siswa | Minimal 60% siswa berkontribusi dalam kerja kelompok |
| Motivasi belajar intrinsik | Siswa lebih termotivasi oleh nilai daripada pemahaman materi | Siswa termotivasi oleh proses belajar dan pencapaian personal |
| Penggunaan teknologi pembelajaran | Guru menggunakan Google Classroom hanya untuk distribusi materi tanpa elemen engagement | Sistem dengan gamifikasi yang meningkatkan engagement |

Wawancara dengan guru mata pelajaran (n=3) mengungkapkan bahwa: (a) siswa kelas VII cenderung kehilangan motivasi setelah 2–3 minggu pertama, (b) tidak ada mekanisme personalisasi yang menyesuaikan tantangan dengan kemampuan individual, dan (c) kolaborasi siswa terjadi secara parsial tanpa insentif terstruktur. Kondisi ini menjadi landasan empiris pengembangan sistem gamifikasi adaptif EduQuest.

### 3. Rumusan Masalah

Berdasarkan latar belakang yang telah diuraikan, rumusan masalah dalam penelitian ini adalah:

1. Bagaimana memodelkan kebutuhan sistem gamifikasi pembelajaran adaptif untuk siswa SMP kelas VII menggunakan pendekatan Requirement Engineering?
2. Bagaimana menerjemahkan kebutuhan sistem ke dalam User Story, Acceptance Criteria, dan skenario Behavior-Driven Development yang dapat diuji secara otomatis?
3. Bagaimana mengimplementasikan mekanisme NPC Mentor Affinity dan Guild Collaborative Reward pada sistem pembelajaran berbasis web?
4. Bagaimana usability dan user engagement siswa SMP terhadap sistem gamifikasi yang dikembangkan?

### 4. Pertanyaan Penelitian (Research Questions)

Berdasarkan rumusan masalah di atas, penelitian ini merumuskan tiga pertanyaan penelitian:

#### RQ1
Bagaimana Requirement Engineering dapat digunakan untuk memodelkan kebutuhan sistem gamifikasi pembelajaran adaptif bagi siswa SMP kelas VII?

#### RQ2
Bagaimana User Story, Acceptance Criteria, dan skenario Behavior-Driven Development dapat membentuk model traceability yang dapat diuji secara otomatis?

#### RQ3
Bagaimana mekanisme NPC Mentor Affinity dan Guild Collaborative Reward memengaruhi usability dan user engagement siswa SMP kelas VII?

**Pemetaan Research Question:**

| Research Question | Metode | Sumber Data | Teknik Analisis |
|---|---|---|---|
| RQ1 | Requirement Engineering | Stakeholder interview, dokumen kurikulum | Analisis kebutuhan |
| RQ2 | BDD & Traceability | User Story, BDD scenarios | Traceability analysis |
| RQ3 | Quasi-experimental | SUS, UEQ, Engagement, system logs | Paired t-test / Wilcoxon |

### 5. Tujuan Penelitian

Tujuan penelitian ini adalah mengembangkan dan memvalidasi model sistem gamifikasi pembelajaran adaptif berbasis web untuk siswa SMP kelas VII menggunakan pendekatan Requirement Engineering, User Story, dan Behavior-Driven Development.

Tujuan khusus penelitian:

1. Mengidentifikasi kebutuhan sistem gamifikasi pembelajaran adaptif untuk siswa SMP kelas VII.
2. Menyusun User Story dan Acceptance Criteria berdasarkan kebutuhan sistem.
3. Membangun skenario BDD yang dapat diuji secara otomatis.
4. Mengimplementasikan mekanisme NPC Mentor Affinity dan Guild Collaborative Reward.
5. Mengevaluasi usability dan engagement pengguna terhadap sistem yang dikembangkan.

### 6. Manfaat Penelitian

#### 6.1 Manfaat Akademik
- Memberikan kontribusi ilmiah dalam bidang Requirement Engineering dan Gamifikasi di pendidikan.
- Menjadi referensi bagi peneliti lain yang tertarik dengan topik serupa, khususnya terkait penerapan NPC Mentor Affinity dan Guild Collaborative Reward dalam gamifikasi pendidikan.
- Menghasilkan artefak penelitian (User Story, BDD, Traceability Matrix) yang dapat direplikasi.
- Memperkaya kajian tentang integrasi mekanisme personalisasi dan kolaborasi dalam satu sistem gamifikasi.

#### 6.2 Manfaat Praktis
- Membantu guru dalam memotivasi siswa melalui mekanisme gamifikasi yang adaptif dan kolaboratif.
- Membantu siswa SMP kelas VII dalam memantau progres belajar mereka melalui mentor virtual dan komunitas belajar.
- Menyediakan solusi teknologi yang dapat diterapkan di sekolah-sekolah menengah pertama.
- Memberikan model implementasi gamifikasi adaptif untuk pengembang sistem pendidikan.

### 7. Kerangka Teoritis (State of the Art)

Penelitian ini dibangun di atas beberapa landasan teori dan penelitian terdahulu:

**Gamifikasi dalam Pendidikan.** Deterding et al. (2011) mendefinisikan gamifikasi sebagai penerapan elemen desain permainan dalam konteks non-permainan [2]. Saleem et al. (2022) dalam systematic review menemukan bahwa elemen gamifikasi paling umum adalah points, leaderboards, badges, dan levels [3]. Lampropoulos & Sidiropoulos (2024) melalui studi longitudinal 3 tahun membuktikan bahwa gamifikasi meningkatkan hasil belajar secara signifikan [10].

**Teori Motivasi.** Self-Determination Theory (SDT) menjelaskan tiga kebutuhan psikologis dasar: autonomi, kompetensi, dan relasionalitas [11]. NPC Mentor Affinity memenuhi relasionalitas melalui hubungan siswa–mentor. Guild Collaborative Reward memenuhi relasionalitas melalui kolaborasi antar anggota. Flow Theory menjelaskan kondisi optimal saat tantangan seimbang dengan kemampuan [12]. Mekanisme adaptif NPC menjaga keseimbangan ini.

**Personalisasi dan Adaptivitas.** Sistem gamifikasi yang adaptif mampu menyesuaikan tantangan dan reward berdasarkan kemampuan dan progres individu siswa. NPC Mentor Affinity memungkinkan sistem untuk memberikan quest yang sesuai dengan level kemampuan siswa, menciptakan pengalaman belajar yang personal dan menantang [8].

**Kolaborasi Berbasis Guild.** Guild dalam konteks gamifikasi pendidikan berfungsi sebagai kelompok belajar kecil yang mendorong kolaborasi, saling mendukung, dan berkontribusi bersama. Mekanisme guild XP dan guild reward menciptakan insentif kolaboratif yang memperkuat engagement siswa [23].

**Requirement Engineering.** Sommerville (2016) mendefinisikan RE sebagai proses sistematis untuk mendokumentasikan kebutuhan sistem [14]. Lucassen et al. (2016) mengembangkan Quality User Story framework dengan 13 kriteria kualitas [15].

**BDD.** Nascimento et al. (2020) menunjukkan bahwa BDD meningkatkan kolaborasi tim dan kualitas requirement [16]. García et al. (2023) melalui systematic mapping study memvalidasi efektivitas BDD dari 166 papers [17].

**Retrieval Practice dan Gamified Retrieval Quiz.** Roediger & Butler (2011) dalam studi kognitif menunjukkan bahwa praktik pengambilan kembali informasi dari memori (*retrieval practice*) secara signifikan meningkatkan retensi jangka panjang dibandingkan hanya membaca ulang materi (*re-reading*) [6]. Mekanisme ini dikenal sebagai *testing effect* — semakin sering seseorang mengambil kembali informasi dari memori, semakin kuat jalur akses memori tersebut. Gamified Retrieval Quiz dalam EduQuest dirancang berdasarkan prinsip ini: setelah siswa membaca materi (Material Reading), mereka diminta untuk segera mengerjakan kuis singkat yang memaksa mereka mengambil kembali informasi dari memori. Dengan pendekatan ini, kuis bukan sekadar penilaian, melainkan merupakan bagian integral dari proses pembelajaran yang memperkuat retensi materi. Gamifikasi (XP, streak, ranking) berfungsi sebagai motivasi ekstrinsik yang mendorong siswa untuk konsisten melakukan retrieval practice.

### 7.1 Landasan Teori Adaptivitas

EduQuest menggunakan pendekatan **rule-based adaptive mechanism** dalam mengontrol adaptivitas sistem, bukan machine learning. Artinya, keputusan adaptif (quest mana yang ditampilkan, seberapa sulit quest tersebut, dan reward apa yang diberikan) ditentukan oleh aturan (rules) yang didefinisikan berdasarkan konteks perilaku siswa, bukan oleh model prediktif yang dilatih dari data historis.

Karakteristik rule-based adaptive yang diterapkan dalam EduQuest:

| Karakteristik | Implementasi dalam EduQuest |
|---------------|----------------------------|
| **Input condition** | MAS level, quest completion rate, reading time, guild activity |
| **Rule definition** | Threshold MAS [0, 5, 15, 30, 50] → level 1–5 |
| **Output action** | Quest difficulty (easy/medium/hard/legendary), reward amount, NPC dialogue |
| **Deterministic** | Hasil yang sama untuk kondisi input yang sama |
| **Interpretable** | Aturan dapat dipahami dan dimodifikasi oleh pengembang/guru |

Pendekatan ini memiliki beberapa keunggulan dalam konteks penelitian tesis S2:
1. **Transparansi** — Aturan adaptif dapat dijelaskan dan divalidasi oleh stakeholder (guru, peneliti).
2. **Kontrol** — Pengembang dapat memodifikasi aturan tanpa perlu melatih ulang model.
3. **Replikasi** — Peneliti lain dapat mereplikasi mekanisme adaptif dengan memahami aturan yang didefinisikan.
4. **Skalabilitas** — Aturan dapat diperluas untuk mata pelajaran atau konteks sekolah lain tanpa perubahan arsitektur inti.

Referensi teori adaptivitas yang mendasari:
- **Rule-Based Adaptive Systems** — Brusilovsky (2001) mendefinisikan sistem adaptif sebagai sistem yang dapat menyesuaikan perilakunya berdasarkan model pengguna. Dalam konteks pendidikan, aturan adaptif diturunkan dari profil pembelajar [27].
- **Personalized Learning Systems** — Sampson et al. (2019) menjelaskan bahwa personalisasi dalam e-learning dapat dicapai melalui aturan berbasis konteks yang menyesuaikan konten dengan profil siswa [28].
- **Adaptive Educational Systems** — Peter & Kinshuk (2022) mengkategorikan sistem adaptif pendidikan menjadi: adaptif konten (menyesuaikan materi), adaptif antarmuka (menyesuaikan tampilan), dan adaptif navigasi (menyesuaikan jalur belajar) [29].
- **Context-Aware Reward Mechanism** — Dalam gamifikasi, reward yang kontekstual (bukan statis) meningkatkan motivasi karena siswa merasa reward yang diberikan benar-benar relevan dengan usaha mereka [30].

### 8. Research Gap

Tabel berikut menyajikan analisis penelitian terdahulu untuk mengidentifikasi celah penelitian (research gap) yang akan diisi oleh penelitian ini:

| Penelitian | Gamifikasi Pendidikan | NPC Adaptif / Mentor | Guild Kolaboratif | Traceability RE–BDD |
|---|:---:|:---:|:---:|:---:|
| Deterding et al. (2011) | ✓ | ✗ | ✗ | ✗ |
| Dicheva et al. (2015) | ✓ | ✗ | ✗ | ✗ |
| Hamari et al. (2014) | ✓ | ✗ | ✗ | ✗ |
| Saleem et al. (2022) | ✓ | ✗ | ✗ | ✗ |
| Lampropoulos & Sidiropoulos (2024) | ✓ | ✗ | ✗ | ✗ |
| Nascimento et al. (2020) | ✗ | ✗ | ✗ | ✓ |
| García et al. (2023) | ✗ | ✗ | ✗ | ✓ |
| Sommerville (2016) | ✗ | ✗ | ✗ | ✓ |
| **Penelitian ini** | **✓** | **✓** | **✓** | **✓** |

Berdasarkan tabel di atas, terlihat bahwa penelitian gamifikasi pendidikan selama ini berfokus pada mekanisme dasar seperti points, badges, dan leaderboards tanpa integrasi personalisasi NPC atau kolaborasi guild. Di sisi lain, penelitian RE dan BDD belum diintegrasikan ke dalam konteks gamifikasi pendidikan.

**Belum ditemukan penelitian yang mengintegrasikan NPC Mentor Affinity, Guild Collaborative Reward, dan traceability Requirement Engineering–BDD dalam satu sistem gamifikasi pembelajaran adaptif untuk siswa SMP kelas VII.** Penelitian ini mengisi celah tersebut melalui pengembangan prototipe EduQuest dan evaluasi dampaknya terhadap usability serta engagement siswa.

### 9. Komparasi dengan Platform Pembelajaran yang Ada

Tabel berikut membandingkan fitur EduQuest dengan platform pembelajaran populer yang sudah digunakan di sekolah:

| Fitur | Google Classroom | Quizizz | EduQuest (Penelitian Ini) |
|-------|:---:|:---:|:---:|
| Distribusi materi | ✓ | ✓ | ✓ |
| Penugasan & pengumpulan | ✓ | ✗ | ✓ |
| Quiz interaktif | ✗ | ✓ | ✓ |
| XP & Level System | ✗ | ✗ | ✓ |
| Badge & Streak | ✗ | ✓ (部分) | ✓ |
| Leaderboard | ✗ | ✓ | ✓ |
| NPC Mentor Affinity (MAS) | ✗ | ✗ | **✓ (Novel)** |
| Guild Collaborative Reward | ✗ | ✗ | **✓ (Novel)** |
| Quest adaptif berbasis MAS | ✗ | ✗ | **✓ (Novel)** |
| Material Reading tracking | ✗ | ✗ | ✓ |
| Traceability RE–BDD | ✗ | ✗ | **✓ (Novel)** |
| Analytics Dashboard guru | ✓ (dasar) | ✓ (dasar) | ✓ (detail: NPC + guild) |

Kontribusi utama EduQuest yang membedakannya dari platform yang sudah ada adalah: (1) NPC Mentor Affinity yang memungkinkan personalisasi quest berdasarkan hubungan siswa–mentor, (2) Guild Collaborative Reward yang mendorong kolaborasi terstruktur, dan (3) traceability Requirement–BDD yang memastikan setiap fitur dapat diuji dan ditelusuri.

---

## D. METODOLOGI

### 1. Jenis Penelitian

Penelitian ini menggunakan desain **quasi-experimental** dengan pendekatan kuantitatif dan dukungan observasi penggunaan sistem. Evaluasi dilakukan melalui perbandingan pre-test dan post-test pada kelompok yang sama (**one-group pretest-posttest design**). Jenis penelitian termasuk dalam kategori **Applied Research** yang menghasilkan prototipe sistem sebagai artefak utama.

### 2. Populasi dan Sampel

- **Populasi:** Siswa SMP kelas VII di wilayah Bandar Lampung
- **Sampel:** 30–40 siswa dari 1–2 kelas
- **Teknik Sampling:** Purposive sampling
- **Kriteria inklusi:** Siswa aktif yang memiliki akses internet dan perangkat
- **Kriteria eksklusi:** Siswa yang tidak bersedia memberikan informed consent

### 3. Mata Pelajaran

Sistem difokuskan pada mata pelajaran SMP kelas VII:

- Informatika
- Matematika
- Bahasa Indonesia
- IPA

### 4. Lokasi Penelitian

Penelitian dilaksanakan di sekolah menengah pertama (SMP) mitra di wilayah Bandar Lampung, pada kelas VII dengan mata pelajaran Informatika, Matematika, Bahasa Indonesia, dan IPA.

### 5. Tahapan Penelitian

Tahapan penelitian terdiri dari 6 langkah:

**Tahap 1 — Problem Identification & Motivation**
Identifikasi masalah: rendahnya motivasi dan engagement siswa SMP kelas VII dalam pembelajaran konvensional. Studi literatur tentang gamifikasi, NPC mentor, guild, dan gamified retrieval quiz dalam pendidikan.

**Tahap 2 — Define Objectives for a Solution**
Definisi artefak: sistem gamifikasi EduQuest dengan sekitar 60 FR dalam modul-modul utama. Kriteria keberhasilan: SUS ≥ 70, UEQ > 0, engagement p < 0.05.

**Tahap 3 — Design & Development**
Requirement Engineering: User Story, Acceptance Criteria, BDD scenarios. Desain database, API, UI/UX. Implementasi backend (Laravel 10) dan frontend (Next.js 15).

**Tahap 4 — Demonstration**
Penerapan prototipe pada studi kasus: 30–40 siswa SMP kelas VII menggunakan sistem selama 4–6 minggu.

**Tahap 5 — Evaluation**
Evaluasi menggunakan SUS, UEQ, Gamification Engagement Questionnaire. Analisis data menggunakan SPSS/R.

**Tahap 6 — Communication**
Penulisan laporan tesis, publikasi artefak penelitian.

### 6. Metode Pengumpulan Data

#### Data Primer
1. **Pre-test:** Pengisian instrumen (SUS, UEQ, Engagement) sebelum penggunaan sistem.
2. **Treatment:** Penggunaan sistem EduQuest selama 4–6 minggu, termasuk NPC Mentor, Guild System, Quest System, Gamified Retrieval Quiz, dan Material Reading.
3. **Post-test:** Pengisian instrumen setelah penggunaan sistem.
4. **System logs:** Data penggunaan sistem dari backend (login, XP earned, NPC interaction, guild activity, quest completion, material reading time, adaptive quiz participation).

#### Data Sekunder
1. Dokumen kurikulum dan RPP sebagai dasar materi pembelajaran.
2. Database siswa dari sekolah mitra.

### 7. Instrumen Penelitian

#### 7.1 System Usability Scale (SUS)
SUS terdiri dari 10 pernyataan dengan skala Likert 1-5. Skor SUS dihitung dengan rumus:
```
SUS Score = (Σ Konversi Skor) × 2.5
```
Kriteria: ≥ 68 = above average, ≥ 80 = good, ≥ 90 = excellent.

#### 7.2 User Experience Questionnaire (UEQ)
UEQ menilai 6 dimensi: Attractiveness, Clarity, Efficiency, Stimulation, Novelty, dan Usability. Skala 1-7 untuk setiap item.

#### 7.3 Gamification Engagement Questionnaire
Instrumen yang menggabungkan dimensi-dimensi engagement gamifikasi:

- **Competition:** Seberapa besar motivasi kompetisi siswa (leaderboard, gamified retrieval quiz ranking).
- **Collaboration:** Seberapa aktif siswa berkolaborasi di guild (kontribusi XP, guild quest).
- **Narrative Attachment:** Seberapa kuat ikatan siswa dengan NPC mentor (Mentor Affinity Score).
- **Exploration:** Seberapa besar motivasi siswa mengeksplorasi konten dan quest.
- **Continued Intention:** Kesiapan siswa untuk terus menggunakan sistem.

### 8. Operasionalisasi Variabel User Engagement

User Engagement dalam penelitian ini diukur menggunakan tiga dimensi utama berdasarkan model Fredricks et al. (2004) dan disesuaikan dengan konteks gamifikasi:

| Dimensi | Definisi | Indikator Terukur | Instrumen |
|---------|----------|-------------------|-----------|
| **Behavioral Engagement** | Partisipasi aktif siswa dalam aktivitas pembelajaran | Frekuensi login, jumlah quest diselesaikan, waktu aktif dalam sistem, frekuensi check-in harian, jumlah guild quest yang diikuti | System logs |
| **Emotional Engagement** | Respons afektif siswa terhadap sistem dan proses belajar | Skor Narrative Attachment (ikatan dengan NPC mentor), Collaboration satisfaction (kepuasan kolaborasi guild), Continued Intention (niat melanjutkan) | Gamification Engagement Questionnaire |
| **Cognitive Engagement** | Keterlibatan mental siswa dalam proses belajar | Skor Exploration (eksplorasi konten), rata-rata skor quiz, kedalaman baca materi (waktu > 3 menit), frequency adaptive quest completion | System logs + kuesioner |

Pengukuran ketiga dimensi ini dilakukan pada pre-test dan post-test, serta didukung oleh data longitudinal dari system logs selama periode treatment 4–6 minggu.

### 9. Variabel Penelitian

#### Variabel Independen
| No | Variabel | Deskripsi |
|----|----------|-----------|
| 1 | NPC Mentor Affinity | Kekuatan hubungan siswa–mentor yang memengaruhi quest adaptif |
| 2 | Guild Collaborative Reward | Kolaborasi guild dengan kontribusi XP dan reward kolektif |
| 3 | Quest System | Quest kontekstual berdasarkan materi yang dipelajari |
| 4 | XP & Level System | Sistem poin dan progres level siswa |

#### Variabel Dependen
| No | Variabel | Instrumen |
|----|----------|-----------|
| 1 | User Engagement | Gamification Engagement Questionnaire |
| 2 | Task Completion Rate | System logs (quest selesai / total quest) |
| 3 | Reading Participation | System logs (waktu baca, quiz score) |
| 4 | Learning Motivation | Pre-post test |
| 5 | Usability | SUS Questionnaire |

### 10. Hipotesis Penelitian

Berdasarkan pertanyaan penelitian dan desain quasi-experimental, berikut adalah hipotesis yang akan diuji pada tingkat signifikansi α = 0.05:

#### H0-1
Tidak terdapat perbedaan signifikan tingkat user engagement siswa sebelum dan sesudah menggunakan sistem EduQuest.

#### H1-1
Terdapat peningkatan signifikan tingkat user engagement siswa setelah menggunakan sistem EduQuest.

#### H0-2
Tidak terdapat perbedaan signifikan skor usability (SUS) sebelum dan sesudah penggunaan sistem.

#### H1-2
Terdapat peningkatan signifikan skor usability (SUS) setelah penggunaan sistem.

#### H0-3
Tidak terdapat hubungan signifikan antara Mentor Affinity Score dan tingkat penyelesaian quest.

#### H1-3
Terdapat hubungan positif signifikan antara Mentor Affinity Score dan tingkat penyelesaian quest.

Pengujian hipotesis dilakukan pada α = 0.05. H0 ditolak jika p-value < 0.05.

### 11. Pengolahan Data

#### 11.1 Statistik Deskriptif
Menghitung mean, median, modus, standar deviasi, dan frekuensi distribusi untuk semua variabel.

#### 11.2 Uji Asumsi Klasik
- **Uji Normalitas:** Shapiro-Wilk test (α = 0.05)
- **Uji Homogenitas:** Levene's test (α = 0.05)

#### 11.3 Uji Hipotesis
- **Uji-t:** Paired samples t-test untuk data normal (α = 0.05)
- **Wilcoxon Signed Rank Test:** Untuk data tidak normal (α = 0.05)
- **Effect Size:** Cohen's d untuk mengukur besarnya efek

#### 11.4 Analisis Korelasi
- **Pearson:** Korelasi antara NPC affinity frequency dan task completion rate
- **Spearman:** Korelasi antara guild activity dan engagement level

### 12. Kriteria Keberhasilan Sistem

Indikator keberhasilan implementasi sistem EduQuest ditentukan melalui lima metrik terukur berikut:

| Aspek | Indikator | Target | Sumber Data |
|-------|-----------|--------|-------------|
| Usability | System Usability Scale (SUS) | ≥ 70 (above average) | Kuesioner post-test |
| User Experience | UEQ Attractiveness | ≥ 0.8 | Kuesioner post-test |
| Engagement | Quest Completion Rate | ≥ 70% quest diselesaikan | System logs |
| Retensi | 14-day Streak Retention | ≥ 50% siswa mempertahankan streak ≥ 14 hari | System logs |
| Kualitas RPL | BDD Pass Rate | ≥ 90% skenario BDD lulus otomatis | CI/CD test report |

**Narasi:**

Kelima indikator di atas merupakan kriteria keberhasilan yang digunakan untuk menentukan apakah implementasi sistem EduQuest telah memenuhi target kualitas yang ditetapkan. Indikator **usability** (SUS ≥ 70) memastikan antarmuka sistem dapat digunakan dengan baik oleh siswa SMP. Indikator **user experience** (UEQ Attractiveness ≥ 0.8) memastikan pengalaman pengguna secara keseluruhan bersifat positif dan menarik. Indikator **engagement** (Quest Completion Rate ≥ 70%) menunjukkan bahwa siswa cukup termotivasi untuk menyelesaikan quest yang diberikan oleh NPC mentor. Indikator **retensi** (14-day Streak Retention ≥ 50%) memastikan bahwa setidaknya separuh siswa mampu mempertahankan penggunaan sistem secara konsisten selama dua minggu. Indikator **kualitas RPL** (BDD Pass Rate ≥ 90%) menjamin bahwa implementasi sistem sesuai dengan spesifikasi perilaku yang telah didefinisikan melalui skenario BDD.

**Pernyataan Keterbatasan Klaim:** Penelitian ini mengevaluasi pengaruh penggunaan sistem EduQuest secara keseluruhan terhadap usability dan user engagement, sehingga tidak dimaksudkan untuk mengisolasi pengaruh masing-masing komponen gamifikasi secara terpisah. Temuan mengenai NPC Mentor Affinity dan Guild Collaborative Reward bersifat deskriptif dan korelasional, bukan kausal.

### 13. Pemetaan Quest terhadap Kurikulum Merdeka

Quest dalam sistem EduQuest bukan sekadar elemen permainan, melainkan representasi aktivitas pembelajaran yang secara langsung terhubung dengan Capaian Pembelajaran (CP) dan Tujuan Pembelajaran (TP) Kurikulum Merdeka. Pemetaan berikut menunjukkan bahwa setiap quest dirancang berdasarkan kebutuhan nyata kurikulum:

| Mata Pelajaran | Capaian Pembelajaran (CP) | Tujuan Pembelajaran (TP) | Quest EduQuest | Bukti Penilaian |
|---|---|---|---|---|
| **Informatika** | Pemahaman tentang sistem bilangan dan representasi data | Siswa dapat menjelaskan konsep representasi bilangan biner dan heksadesimal | Quest "Konversi Bilangan": siswa menyelesaikan serangkaian latihan konversi biner→desimal→heksadesimal dengan NPC mentor | Skor quiz pasca-quest, jumlah percobaan, waktu penyelesaian |
| **Matematika** | Pemahaman bangun datar dan kalkulasi luas | Siswa dapat menghitung luas dan keliling berbagai bangun datar | Quest "Bangun Datar大师": siswa menjelajahi soal-soal bertahap tentang luas segitiga, jajar genjang, dan trapesium | Quiz adaptif (3 level kesulitan), urutan penyelesaian, akurasi jawaban |
| **Bahasa Indonesia** | Keterampilan membaca teks deskriptif dan naratif | Siswa dapat mengidentifikasi struktur dan unsur teks deskriptif | Quest "Analisis Teks Deskriptif": siswa membaca materi interaktif lalu menjawab pertanyaan pemahaman | Reading duration (> 3 menit), skor comprehension quiz, kualitas jawaban uraian |
| **IPA** | Pemahaman siklus air dan peran air dalam kehidupan | Siswa dapat menjelaskan proses dan tahapan siklus air | Quest "Siklus Air": siswa menyelesaikan simulasi interaktif dan menjawab soal pemahaman | Quiz post-simulation, guild discussion contribution, accuracy rate |

**Catatan Penting:**

1. **Quest ≠ Game.** Setiap quest dalam EduQuest merupakan pembungkus aktivitas pembelajaran nyata. Siswa tidak bermain, melainkan menyelesaikan tugas pembelajaran yang dikemas dalam format quest.
2. **NPC ≠ Cheat.** NPC mentor tidak memberikan jawaban, melainkan memberikan petunjuk dan mengarahkan siswa untuk menemukan jawaban sendiri melalui eksplorasi materi.
3. **Keterkaitan langsung.** Setiap quest dapat ditelusuri (traceable) kembali ke CP dan TP tertentu dalam Kurikulum Merdeka, sehingga memastikan bahwa penggunaan sistem selaras dengan tujuan pembelajaran.
4. **Asesmen autentik.** Bukti penilaian berupa data sistem logs (waktu, skor, frekuensi) yang dikumpulkan secara otomatis, bukan hanya ujian akhir.

### 14. Arsitektur Pengumpulan Data Penelitian

Sistem EduQuest dirancang dengan arsitektur event-based analytics yang merekam seluruh aktivitas siswa secara otomatis untuk keperluan analisis penelitian. Diagram berikut menunjukkan alur pengumpulan data:

```
┌──────────────────┐
│  User Action     │   (login, check-in, quest completion, reading,
│  (Siswa/Sistem)  │    quiz participation, guild contribution, MAS change)
└────────┬─────────┘
         ↓
┌──────────────────┐
│  Event Logger    │   Merekam setiap aksi dengan timestamp, user ID,
│  (Backend API)   │   tipe aksi, dan metadata terkait
└────────┬─────────┘
         ↓
┌──────────────────┐
│  Analytics DB    │   Menyimpan event logs dalam format terstruktur
│  (MySQL)         │   (user_activity_logs, quest_attempts, guild_logs)
└────────┬─────────┘
         ↓
┌──────────────────┐
│  Engagement      │   Menghitung metrik engagement:
│  Metrics Engine  │   - Quest completion rate
│  (Laravel Job)   │   - Streak retention rate
└────────┬─────────┘   - Guild contribution score
         ↓
┌──────────────────┐
│  Research        │   Export dataset untuk analisis di SPSS/R:
│  Dataset Export  │   - Pre-test/post-test scores
│  (CSV/JSON)      │   - System logs aggregated per siswa
└──────────────────┘   - Guild activity summaries
```

**Jenis data yang direkam oleh sistem:**

| No | Event Type | Deskripsi | Format Penyimpanan |
|----|-----------|-----------|-------------------|
| 1 | `login` | Waktu login siswa | timestamp, user_id, device_type |
| 2 | `daily_checkin` | Check-in harian | timestamp, user_id, streak_count |
| 3 | `quest_completion` | Penyelesaian quest | timestamp, user_id, quest_id, score, duration |
| 4 | `reading_duration` | Waktu membaca materi | timestamp, user_id, material_id, duration_seconds |
| 5 | `quiz_participation` | Partisipasi kuis | timestamp, user_id, quiz_id, mode, score, duration |
| 6 | `guild_contribution` | Kontribusi guild | timestamp, user_id, guild_id, xp_contributed |
| 7 | `mas_change` | Perubahan MAS | timestamp, user_id, npc_id, old_value, new_value, trigger |

Data yang terkumpul digunakan untuk membentuk dataset penelitian yang dianalisis menggunakan SPSS/R meliputi:
- **Pre-test/post-test scores** — data instrumen SUS, UEQ, dan Engagement Questionnaire.
- **System logs aggregated per siswa** — total waktu aktif, jumlah quest selesai, rata-rata skor quiz, panjang streak.
- **Guild activity summaries** — kontribusi XP per anggota, frekuensi guild quest, jumlah guild reward yang diperoleh.

### 15. Narasumber

1. **Siswa SMP kelas VII** — pengguna utama sistem (30–40 responden).
2. **Guru mata pelajaran** — memberikan materi dan mengevaluasi kualitas soal.
3. **Admin sekolah** — memberikan akses data siswa dan izin penelitian.
4. **Dosen pembimbing** — arahan metodologi penelitian.

### 16. Keterbatasan Penelitian

Desain one-group pretest-posttest memiliki beberapa ancaman validitas internal yang perlu diakui, antara lain **novelty effect** (pengaruh kebaruan yang membuat siswa lebih antusias di awal), **history effect** (peristiwa eksternal yang memengaruhi selama periode penelitian), dan **maturation effect** (perubahan alami pada siswa selama 4–6 minggu).

Untuk meminimalkan bias tersebut, penelitian ini menggunakan beberapa strategi mitigasi:
1. **System logs longitudinal** — data penggunaan sistem dikumpulkan selama periode 4–6 minggu sehingga perubahan perilaku penggunaan dapat diamati secara berkelanjutan, bukan hanya pada titik pre-test dan post-test.
2. **Observasi partisipatif** — pengamatan terhadap aktivitas siswa selama periode treatment untuk mendeteksi perubahan perilaku yang tidak terduga.
3. **Durasi treatment cukup panjang** — 4–6 minggu dirasakan cukup panjang untuk mengurangi efek novelty, karena siswa mulai terbiasa dengan sistem setelah minggu pertama.

Meskipun demikian, penelitian ini tidak mengklaim kausalitas yang kuat karena tidak ada kelompok kontrol. Temuan penelitian dipandang sebagai bukti awal (preliminary evidence) yang membutuhkan replikasi dengan desain yang lebih kuat pada penelitian selanjutnya.

### 17. Ruang Lingkup Klaim

Untuk menghindari overclaim dan memastikan transparansi akademik, ruang lingkup klaim dalam penelitian ini dibagi menjadi tiga kategori:

#### 17.1 Klaim yang Diuji Langsung
Klaim ini didukung oleh data empiris dari instrumen SUS, UEQ, Engagement Questionnaire, dan system logs:
- Sistem EduQuest memiliki usability yang baik (SUS ≥ 70)
- Penggunaan sistem EduQuest meningkatkan user engagement siswa (p < 0.05)
- Task completion rate siswa meningkat selama periode treatment
- Siswa menunjukkan partisipasi aktif dalam guild dan NPC quest

#### 17.2 Klaim yang Bersifat Konseptual
Klaim ini didukung oleh desain sistem dan literatur, namun tidak diuji secara empiris dalam penelitian ini:
- NPC Mentor Affinity Score (MAS) memungkinkan personalisasi quest berdasarkan profil belajar siswa
- Guild Collaborative Reward mendorong kolaborasi antar siswa melalui insentif terstruktur
- Model Requirement–BDD Traceability memastikan keterlacakan dari kebutuhan hingga pengujian

#### 17.3 Klaim yang Menjadi Peluang Penelitian Lanjutan
Klaim ini membutuhkan penelitian dengan desain yang lebih kuat (misalnya quasi-experimental dengan kelompok kontrol atau experimental):
- Efektivitas MAS terhadap hasil belajar kognitif siswa
- Pengaruh guild collaboration terhadap motivasi intrinsik jangka panjang
- Perbandingan efektivitas gamifikasi adaptif (EduQuest) dengan gamifikasi statis (Google Classroom)
- Efektivitas BDD sebagai pendekatan pengujian dalam proyek gamifikasi pendidikan
- Replikasi model pada mata pelajaran lain (Matematika, IPA, Bahasa Indonesia) dan jenjang sekolah lain (SMA)

### 18. Threats to Validity

Ancaman validitas dalam penelitian ini dikategorikan ke dalam empat kategori berikut:

#### 18.1 Validitas Internal

| Ancan | Deskripsi | Strategi Mitigasi |
|-------|-----------|-------------------|
| Novelty effect | Siswa lebih antusias karena menggunakan sistem baru | Durasi treatment 4–6 minggu; analisis log longitudinal menunjukkan pola penggunaan stabil setelah minggu ke-2 |
| History effect | Peristiwa eksternal selama treatment memengaruhi hasil | Observasi partisipatif; pencatatan peristiwa yang terjadi selama periode penelitian |
| Maturation effect | Perubahan alami pada siswa selama 4–6 minggu | Pre-test dan post-test dilakukan pada waktu yang cukup berdekatan; fokus pada engagement, bukan hasil belajar kognitif |
| Selection bias | Sampel bukan random dari populasi besar | Purposive sampling dengan kriteria inklusi/eksklusi yang jelas; deskripsi sampel yang rinci |

#### 18.2 Validitas Eksternal

| Ancaman | Deskripsi | Strategi Mitigasi |
|---------|-----------|-------------------|
| Sampel terbatas | Hanya 30–40 siswa dari 1–2 SMP di Bandar Lampung | Dokumentasi konteks sekolah secara detail agar replikasi dapat dilakukan |
| Generalisasi | Temuan belum tentu berlaku di sekolah lain | Penelitian lanjutan dengan sampel lebih besar dan lokasi berbeda |
| Konteks spesifik | Mata pelajaran terbatas pada 4 mata pelajaran SMP | Ekspansi mata pelajaran pada penelitian selanjutnya |

#### 18.3 Validitas Konstruk

| Ancaman | Deskripsi | Strategi Mitigasi |
|---------|-----------|-------------------|
| Instrumen tidak valid | Pengukuran tidak mengukur apa yang seharusnya | Menggunakan instrumen yang telah tervalidasi secara internasional (SUS, UEQ) |
| Adaptasi bahasa | Terjemahan instrumen dapat mengubah makna | Expert judgment oleh 2–3 ahli untuk validasi konten |
| Construct validity | Engagement sulit diukur secara objektif | Menggunakan multi-instrumen: kuesioner + system logs |

#### 18.4 Validitas Reliabilitas

| Ancaman | Deskripsi | Strategi Mitigasi |
|---------|-----------|-------------------|
| Skor tidak konsisten | Instrumen menghasilkan skor yang berbeda pada pengukuran berulang | Uji reliabilitas menggunakan Cronbach's Alpha; nilai α ≥ 0.70 dianggap reliabel |
| Error pengukuran | Kesalahan dalam pengumpulan data | Training bagi enumerator; validasi data sebelum analisis |

### 19. Alur Penelitian

Alur penelitian:

```
Input: Kebutuhan stakeholder (guru, siswa, admin SMP)
  ↓
Proses:
  1. Elicitation → ~60 Functional Requirements
  2. User Story Mapping → User Stories
  3. BDD Scenario Writing → BDD Scenarios
  4. Traceability Matrix → FR→US→AC→BDD
  5. Prototyping → Laravel 10 + Next.js 15
  6. Testing → Unit test, BDD test, E2E test
  7. Deployment → Pilot testing di SMP mitra
  8. Evaluation → Pre-test, Treatment (4-6 minggu), Post-test
Output: Prototipe sistem + evaluasi + artefak penelitian
```

### 20. Etika Penelitian
1. Mendapatkan persetujuan dari pihak sekolah.
2. Mendapatkan informed consent dari responden (siswa SMP) dan wali.
3. Menjaga kerahasiaan data responden.
4. Tidak menimbulkan kerugian bagi responden.
5. Memastikan sistem gamifikasi tidak menimbulkan tekanan psikologis berlebihan pada siswa.

### 21. Etika Gamifikasi Pendidikan

Sistem EduQuest dirancang dengan prinsip etika gamifikasi pendidikan sebagai berikut:

1. **Reward selalu terkait aktivitas akademik.** Seluruh XP, badge, dan level yang diperoleh siswa berasal dari aktivitas belajar yang terukur: penyelesaian quest, pembacaan materi, pengerjaan quiz, dan partisipasi dalam guild quest. Tidak ada reward yang diberikan tanpa aktivitas akademik yang mendasarinya.

2. **Tidak ada transaksi atau monetisasi.** Sistem tidak menyediakan fitur pembelian item, top-up, atau transaksi apapun. Seluruh reward diperoleh melalui usaha belajar siswa. Tidak ada elemen pay-to-win yang dapat menciptakan ketidakadilan antar siswa.

3. **Quest dibatasi tujuan pembelajaran.** Quest yang diberikan oleh NPC mentor selalu terkait dengan kurikulum mata pelajaran SMP (Informatika, Matematika, Bahasa Indonesia, IPA). Tidak ada quest yang bersifat hiburan semata atau tidak terkait dengan capaian pembelajaran.

4. **NPC berfungsi sebagai fasilitator belajar.** NPC mentor dirancang sebagai pemandu belajar yang mendorong eksplorasi materi, bukan sebagai pengganti guru. NPC tidak memberikan jawaban langsung, melainkan mengarahkan siswa untuk menemukan jawaban melalui quest dan diskusi.

5. **Tidak ada mekanisme yang menimbulkan kecanduan.** Sistem tidak menggunakan mekanisme withdraw penalty, notification spam, atau daily login bonus yang memaksa. Siswa bebas menggunakan sistem kapan saja tanpa tekanan.

6. **Data siswa dilindungi.** Seluruh data penggunaan sistem bersifat anonim dalam analisis dan hanya diakses oleh peneliti dan guru yang berwenang.

### 22. Penutup Metodologi

Dengan kombinasi Requirement Engineering, User Story, Acceptance Criteria, Executable BDD, event-based analytics, dan evaluasi usability serta engagement, penelitian ini tidak hanya menghasilkan prototipe EduQuest, tetapi juga menyediakan model rekayasa perangkat lunak yang dapat direplikasi untuk pengembangan sistem gamifikasi pembelajaran adaptif pada konteks SMP. Pendekatan methodologis ini memastikan bahwa setiap tahap pengembangan dapat ditelusuri dari kebutuhan sekolah hingga evaluasi dampak terhadap siswa, sehingga menghasilkan bukti yang kredibel dan transparan untuk penelitian tesis S2.

---

## E. KONTRIBUSI PENELITIAN DAN MEKANISME ADAPTIF

Penelitian ini memiliki tiga kontribusi utama yang membedakannya dari penelitian gamifikasi pendidikan sebelumnya. Bagian ini menjelaskan secara detail masing-masing kontribusi beserta mekanisme teknisnya.

### 1. NPC Mentor Affinity Score (MAS)

#### 1.1 Definisi
NPC Mentor Affinity Score (MAS) adalah skor numerik yang mengukur kekuatan hubungan antara siswa dan mentor virtual (NPC). MAS menentukan seberapa dekat siswa dengan mentor dan memengaruhi kualitas serta tingkat kesulitan quest yang diberikan.

#### 1.2 Faktor Peningkatan MAS
MAS meningkat berdasarkan empat faktor utama:

| Faktor | Bobot | Deskripsi |
|--------|-------|-----------|
| Penyelesaian quest | 50% | Setiap quest yang diselesaikan menambah MAS |
| Konsistensi belajar | 20% | Login harian dan check-in streak |
| Ketepatan waktu | 15% | Quest diselesaikan sebelum deadline |
| Performa akademik | 15% | Skor quiz dan tugas yang tinggi |

#### 1.3 Formula MAS

```
MAS_baru = MAS_lama + (Quest × 0.50) + (Konsistensi × 0.20) + (Ketepatan × 0.15) + (Performa × 0.15)
```

Contoh perhitungan:
- Siswa menyelesaikan 2 quest (+100 XP) → Quest = 10
- Login 5 hari berturut-turut → Konsistensi = 5
- Quest diselesaikan 2 hari sebelum deadline → Ketepatan = 3
- Skor quiz 85/100 → Performa = 8.5
- MAS_baru = MAS_lama + (10 × 0.50) + (5 × 0.20) + (3 × 0.15) + (8.5 × 0.15)
- MAS_baru = MAS_lama + 5.0 + 1.0 + 0.45 + 1.275 = MAS_lama + 7.725

#### 1.4 Mekanisme Adaptif
Semakin tinggi MAS siswa, semakin besar peluang munculnya quest dengan:
- **Reward lebih tinggi** — quest di quest harder memberikan lebih banyak XP
- **Tingkat kesulitan lebih tinggi** — soal yang lebih menantang dan kompleks
- **Tantangan lebih personal** — quest yang disesuaikan dengan topik yang belum dikuasai siswa

#### 1.5 Perbedaan XP dan Mentor Affinity Score

XP (Experience Points) dan MAS (Mentor Affinity Score) merupakan dua mekanisme yang saling melengkapi namun memiliki fungsi yang berbeda secara fundamental:

| Aspek | XP (Experience Points) | Mentor Affinity Score (MAS) |
|-------|------------------------|----------------------------|
| **Tujuan** | Mengukur progress global siswa di seluruh sistem | Mengukur kekuatan hubungan spesifik dengan satu NPC mentor |
| **Cakupan** | Akumulasi dari seluruh aktivitas (quest, quiz, reading, check-in) | Hanya dari aktivitas terkait NPC tertentu (quest domain, interaksi mentor) |
| **Pengaruh** | Menentukan level siswa dan peringkat di leaderboard | Menentukan quest adaptif dan personalisasi untuk domain tertentu |
| **Sifat** | Universal — berlaku untuk semua aktivitas dan semua mentor | Kontekstual — spesifik untuk satu siswa dan satu mentor |
| **Analogi** | Seperti total poin kumulatif dalam satu game | Seperti tingkat kepercayaan dengan satu karakter NPC |

**MAS merupakan profil personalisasi pembelajaran, bukan sekadar poin tambahan.** XP memberikan gambaran seberapa jauh siswa telah berjalan dalam keseluruhan sistem, sementara MAS memberikan gambaran seberapa dalam hubungan siswa dengan mentor pada domain tertentu. Seorang siswa dapat memiliki XP tinggi secara keseluruhan tetapi MAS rendah dengan mentor tertentu jika belum banyak berinteraksi dengan mentor tersebut. Kombinasi keduanya memungkinkan sistem untuk memberikan pengalaman belajar yang personal dan adaptif.

Threshold MAS untuk level affinity:

| Level | MAS Required | Deskripsi |
|-------|-------------|-----------|
| 1 | 0 | Baru bertemu |
| 2 | 5 | Mulai akrab |
| 3 | 15 | Dipercaya |
| 4 | 30 | Mentor dekat |
| 5 | 50 | Mentor terbaik |

#### 1.6 Contoh Implementasi dalam kode
```php
// NpcService.php — Affinity level calculation
$thresholds = [0, 5, 15, 30, 50];
$level = 1;
foreach ($thresholds as $index => $threshold) {
    if ($this->affinity_xp >= $threshold) {
        $level = $index + 1;
    }
}
```

### 2. Guild Collaborative Reward System

#### 2.1 Mekanisme
Guild Collaborative Reward System adalah sistem kolaborasi berbasis guild (kelompok kecil 3–5 siswa) di mana kontribusi XP individual otomatis menjadi Guild XP. Sistem ini menciptakan insentif kolaboratif yang mendorong siswa untuk saling mendukung dan berkontribusi bersama.

Mekanisme utama:
- **XP Contribution:** Setiap XP yang diperoleh anggota guild otomatis menambah Guild XP
- **Guild Target:** Guild memiliki target mingguan yang harus dicapai bersama
- **Reward Distribution:** Jika target tercapai, seluruh anggota menerima reward
- **Guild Chest:** Reward kolektif berupa XP bonus, badge, atau item khusus

#### 2.2 Contoh Skenario

**Target:** 50 quest selesai dalam satu minggu oleh seluruh anggota guild.

**Reward jika target tercapai:**
- +150 XP untuk seluruh anggota
- Guild Chest (mengandung random reward)
- Bonus 10% XP selama 24 jam

**Manfaat:**
- Mendorong gotong royong antar anggota
- Menciptakan rasa memiliki dan tanggung jawab bersama
- Memperkuat engagement melalui reward kolektif
- Mendorong kompetisi sehat antar guild

#### 2.3 Implikasi Terhadap Engagement
Guild Collaborative Reward memenuhi kebutuhan **relasionalitas** dalam Self-Determination Theory [11]. Siswa merasa menjadi bagian dari komunitas yang saling mendukung, yang meningkatkan motivasi intrinsik untuk terus belajar.

### 3. Requirement–BDD Traceability Model

#### 3.1 Definisi
Model keterlacakan kebutuhan dari User Story → Acceptance Criteria → BDD Scenario → Implementasi → Test Case. Model ini memastikan setiap kebutuhan sistem dapat dilacak dari definisi hingga pengujian otomatis.

#### 3.2 Manfaat
- Memastikan tidak ada kebutuhan yang terlewat (completeness)
- Memudahkan validasi bahwa implementasi sesuai requirement (correctness)
- Mempercepat proses regression testing saat ada perubahan
- Menjadi artefak penelitian yang dapat direplikasi oleh peneliti lain

#### 3.3 Contoh Traceability

| Requirement | User Story | Acceptance Criteria | BDD Scenario | Test Case |
|-------------|-----------|---------------------|-------------|-----------|
| NPC-07 (Affinity calculation) | US-21 (Siswa melihat affinity level) | AC-21 (Affinity level ditampilkan) | BDD-21 (Affinity naik setelah quest) | TC-21 (Unit test affinity calc) |
| GUILD-03 (Guild XP contribution) | US-34 (XP anggota jadi guild XP) | AC-34 (Guild XP bertambah) | BDD-34 (Guild reward jika target tercapai) | TC-34 (Unit test guild XP) |
| QUEST-05 (Adaptive quest generation) | US-28 (Quest muncul berdasarkan affinity) | AC-28 (Quest sesuai level affinity) | BDD-28 (Quest harder muncul di affinity tinggi) | TC-28 (Unit test quest generation) |

#### 3.4 BDD Automation Pipeline — Executable Specification

BDD dipilih sebagai pendekatan utama dalam penelitian ini karena kemampuannya menjembatani kesenjangan komunikasi antara **guru** (sebagai stakeholder pendidikan), **analis sistem** (sebagai perancang requirement), dan **pengembang** (sebagai implementer). Melalui skenario perilaku yang ditulis dalam bahasa alami (Gherkin), seluruh pemangku kepentingan dapat memahami dan memvalidasi kebutuhan sistem tanpa perlu pemahaman teknis pemrograman. Pendekatan ini memastikan bahwa requirement yang dihasilkan benar-benar mencerminkan kebutuhan pembelajaran di sekolah, bukan hanya kebutuhan teknis pengembang.

Dalam penelitian ini, BDD didefinisikan sebagai **Executable Specification** — spesifikasi perilaku sistem yang dapat dijalankan secara otomatis, bukan sekadar dokumentasi statis. Setiap skenario Gherkin berfungsi sebagai:
1. **Dokumentasi** — semua pemangku kepentingan dapat membaca dan memahami perilaku sistem.
2. **Spesifikasi** — menjadi acuan formal tentang bagaimana sistem harus berperilaku.
3. **Test case** — setiap skenario dapat dieksekusi oleh Playwright sebagai pengujian otomatis.

Pipeline BDD sebagai Executable Specification:

```
Requirement Engineering (FR)
    ↓
User Story (US)
    ↓
Acceptance Criteria (AC)
    ↓
Gherkin Scenario (.feature)
    ↓
Step Definitions (Playwright)
    ↓
CI/CD Execution (GitHub Actions)
    ↓
Test Report (HTML + Coverage)
```

**Contoh Eksekusi BDD:**

Gherkin Feature:
```gherkin
Feature: NPC Affinity Progression

  Scenario: Affinity meningkat setelah quest selesai
    Given siswa memiliki MAS 10
    When siswa menyelesaikan quest Informatika
    Then MAS bertambah 5 poin
    And level affinity diperbarui
```

Padanan Playwright (ringkas):
```typescript
test('Affinity meningkat setelah quest selesai', async ({ page }) => {
  // Given
  await loginAsSiswa(page, 'siswa1@test.com');
  const masSebelum = await getAffinityXp(page, 'Bu Rina');
  expect(masSebelum).toBe(10);

  // When
  await page.click('[data-testid="quest-informatika"]');
  await page.click('[data-testid="selesaikan-quest"]');

  // Then
  const masSesudah = await getAffinityXp(page, 'Bu Rina');
  expect(masSesudah).toBe(15);
  const level = await getAffinityLevel(page, 'Bu Rina');
  expect(level).toBe(2);
});
```

**Manfaat BDD Executable:**
- Memastikan setiap requirement memiliki test case yang dapat dijalankan
- Regression testing otomatis saat ada perubahan kode
- Bukti otomatis bahwa implementasi sesuai dengan spesifikasi
- Mengurangi biaya pengujian manual

#### 3.5 Peta Kontribusi Penelitian

Alur berikut menunjukkan hubungan antara artefak RPL dan evaluasi pengguna dalam penelitian ini:

```
Requirement Engineering
    ↓
User Story & Acceptance Criteria
    ↓
BDD Executable (Gherkin → Playwright)
    ↓
Adaptive Quest Engine (Laravel 10 Backend)
    ↓
NPC Mentor Affinity (Personalisasi)
    ↓
Guild Collaborative Reward (Kolaborasi)
    ↓
Usability & Engagement Evaluation (SUS + UEQ + Engagement)
```

Setiap tahap dalam alur di atas menghasilkan artefak yang dapat diverifikasi dan ditelusuri (traceable). Requirement Engineering menghasilkan FR yang diterjemahkan menjadi User Story. User Story dioperasionalisasikan menjadi BDD Scenarios yang dijalankan secara otomatis. Hasil implementasi (NPC Affinity, Guild Reward) dievaluasi menggunakan instrumen yang valid secara psikometri.

### 4. Benang Merah Penelitian

Diagram berikut menunjukkan benang merah (thread) yang menghubungkan seluruh komponen penelitian dari masalah hingga evaluasi:

```
┌─────────────────────────────────────────────────────────────────┐
│  MASALAH SEKOLAH                                                │
│  (Rendahnya partisipasi, konsistensi tugas, dan interaksi       │
│   kolaboratif siswa kelas VII berdasarkan observasi awal)        │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│  REQUIREMENT ENGINEERING                                        │
│  (Elicitation → ~60 Functional Requirements)                    │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│  USER STORY & ACCEPTANCE CRITERIA                               │
│  (FR → US → AC dalam bahasa stakeholder)                        │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│  BDD EXECUTABLE                                                 │
│  (Gherkin Scenario → Playwright Test → CI/CD)                    │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│  IMPLEMENTASI EDUQUEST (Laravel 10 + Next.js 15)                │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
          ┌────────────┴────────────┐
          ↓                         ↓
┌──────────────────┐    ┌──────────────────────────┐
│ NPC Mentor       │    │ Guild Collaborative       │
│ Affinity (MAS)   │    │ Reward                    │
│ [Personalisasi]  │    │ [Kolaborasi]              │
└────────┬─────────┘    └──────────┬───────────────┘
         └────────────┬────────────┘
                      ↓
┌─────────────────────────────────────────────────────────────────┐
│  EVALUASI USABILITY & ENGAGEMENT                                │
│  (SUS + UEQ + Gamification Engagement + System Logs)            │
│  Paired t-test / Wilcoxon → Hasil Penelitian                    │
└─────────────────────────────────────────────────────────────────┘
```

Benang merah ini memastikan bahwa setiap keputusan desain dalam EduQuest dapat ditelusuri kembali ke masalah nyata di sekolah, dan setiap hasil evaluasi dapat dikaitkan kembali dengan requirement yang telah didefinisikan sebelumnya.

### 5. Kontribusi yang Dapat Direplikasi

Model yang dikembangkan dalam penelitian ini dirancang agar dapat diterapkan pada platform pembelajaran lain di luar EduQuest. Diagram berikut menunjukkan alur kontribusi yang dapat direplikasi:

```
┌─────────────────────────────────────────────────────────────────┐
│  REQUIREMENT ENGINEERING                                        │
│  (Elicitation → FR → User Story → Acceptance Criteria)          │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│  USER STORY                                                     │
│  (FR → US dalam bahasa stakeholder)                             │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│  ACCEPTANCE CRITERIA                                            │
│  (US → AC dalam bahasa terukur)                                 │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│  EXECUTABLE BDD                                                 │
│  (Gherkin → Playwright → Test Report otomatis)                  │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│  RULE-BASED ADAPTIVE ENGINE                                     │
│  (Aturan adaptif berdasarkan profil siswa: MAS, quest, reading) │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
          ┌────────────┴────────────┐
          ↓                         ↓
┌──────────────────┐    ┌──────────────────────────┐
│ NPC Affinity     │    │ Guild Reward              │
│ [Personalisasi]  │    │ [Kolaborasi]              │
└────────┬─────────┘    └──────────┬───────────────┘
         └────────────┬────────────┘
                      ↓
┌─────────────────────────────────────────────────────────────────┐
│  REUSABLE GAMIFIED LEARNING MODEL                               │
│  (Dapat diterapkan pada platform lain: Moodle, Canvas, dsb.)   │
└─────────────────────────────────────────────────────────────────┘
```

**Catatan Replikasi:** Model ini bersifat domain-independent. Rule-based adaptive mechanism (MAS, guild reward) dapat diadaptasi untuk: (a) mata pelajaran lain dengan memodifikasi NPC dan quest sesuai kurikulum, (b) jenjang sekolah lain (SMA, SD) dengan menyesuaikan threshold MAS dan guild size, (c) platform LMS lain (Moodle, Canvas) dengan mengintegrasikan modul gamifikasi sebagai plugin. Keterlacakan RE–BDD memastikan bahwa setiap modifikasi dapat ditelusuri dan divalidasi secara otomatis.

---

## F. KLASIFIKASI REQUIREMENT

Sistem dirancang menggunakan sekitar 60 functional requirements yang dikelompokkan ke dalam tiga kategori:

### 1. Core Requirements (FR-01 s/d FR-46)
Kebutuhan inti yang wajib ada agar sistem dapat berfungsi:

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
Kebutuhan pendukung yang meningkatkan kualitas sistem:

| Modul | FR Range | Deskripsi |
|-------|----------|-----------|
| Gamified Retrieval Quiz | FR-47–FR-52 | Quiz berbasis kelas dan guild, timer, ranking |
| Material Reading | FR-53–FR-56 | Baca materi, progress tracking, quiz pasca-bacaan |

### 3. Future Requirements (FR-57 s/d FR-63)
Kebutuhan untuk pengembangan selanjutnya:

| Modul | FR Range | Deskripsi |
|-------|----------|-----------|
| Analytics Dashboard | FR-57–FR-59 | Statistik guru, export, monitoring real-time |
| Competitive Quiz Mode | FR-60–FR-62 | Mode kompetisi antar siswa |
| Knowledge Synthesis Mechanism | FR-63 | Mekanisme sintesis pengetahuan |

---

## G. HASIL YANG DIHARAPKAN

### 1. Artefak Penelitian

Penelitian ini menghasilkan tiga artefak utama:

#### Artefak 1 — Adaptive Gamified Learning System (EduQuest)
Prototipe sistem gamifikasi pembelajaran adaptif berbasis web untuk siswa SMP kelas VII dengan fitur: NPC Mentor Affinity, Guild Collaborative Reward, Quest System, XP & Level, Badge, Streak, Leaderboard, Gamified Retrieval Quiz, Material Reading, dan Analytics Dashboard.

#### Artefak 2 — Requirement–BDD Traceability Model
Model keterlacakan kebutuhan dari User Story → Acceptance Criteria → BDD Scenario → Implementasi → Test Case. Model ini memastikan setiap kebutuhan sistem dapat dilacak dari definisi hingga pengujian otomatis.

#### Artefak 3 — Evaluation Dataset
Data usability dan engagement siswa SMP terhadap sistem gamifikasi adaptif, termasuk data SUS, UEQ, Gamification Engagement Questionnaire, dan system logs.

### 2. Kontribusi Teoritis

**Kontribusi utama penelitian ini bukan hanya pengembangan aplikasi EduQuest, melainkan penyusunan Model Requirement Engineering–BDD untuk Sistem Gamifikasi Pembelajaran Adaptif berbasis NPC dan Kolaborasi Guild yang dapat direplikasi pada konteks sekolah dan platform pembelajaran lain.**

Secara spesifik, kontribusi teoritis penelitian ini terdiri dari:

1. **Model Integrasi Personalisasi dan Kolaborasi dalam Gamifikasi Pendidikan.** Penelitian ini mengusulkan model integrasi NPC Mentor Affinity (personalisasi) dan Guild Collaborative Reward (kolaborasi) dalam satu sistem gamifikasi pendidikan.

2. **Novel Contribution: NPC Mentor Affinity Score (MAS).** Implementasi sistem affinity siswa–mentor yang adaptif, di mana semakin tinggi MAS, semakin menantang dan berharga quest yang diberikan. Mekanisme ini menciptakan pengalaman belajar yang personal dan terstruktur.

3. **Novel Contribution: Guild Collaborative Reward System.** Implementasi sistem reward kolektif berbasis guild, di mana kontribusi XP anggota guild menghasilkan bonus bersama (guild XP, guild chest, bonus XP temporer). Mekanisme ini mendorong kolaborasi intra-guild dan kompetisi inter-guild.

4. **Novel Contribution: Requirement–BDD Traceability Model.** Model keterlacakan kebutuhan yang menghubungkan User Story, Acceptance Criteria, BDD Scenarios, dan Test Cases secara terstruktur dan terautomasi.

### 3. Kontribusi Praktis

1. **Prototipe Sistem EduQuest.** Aplikasi web gamifikasi pendidikan yang siap diterapkan di sekolah-sekolah menengah pertama dengan fitur adaptif dan kolaboratif.

2. **Model Implementasi Gamifikasi Adaptif.** Panduan implementasi gamifikasi adaptif untuk pengembang sistem pendidikan.

3. **Dashboard Guru.** Termasuk analytics NPC mentor, guild statistics, quest statistics, dan material reading statistics untuk memahami engagement siswa secara holistik.

**Kontribusi ilmiah penelitian tetap relevan meskipun implementasi produk mengalami perubahan pada konteks sekolah yang berbeda.**

### 4. Target Publikasi

#### Target Publikasi
Penelitian ditargetkan untuk dipublikasikan pada jurnal nasional terakreditasi SINTA bidang Sistem Informasi, Rekayasa Perangkat Lunak, atau Teknologi Pendidikan.

#### Potensi Artikel Turunan

| No | Artikel | Fokus | Target Jurnal |
|----|---------|-------|---------------|
| 1 | Requirement–BDD Traceability Model | Model traceability RE–BDD untuk sistem gamifikasi adaptif | Jurnal Sistem Informasi / RE |
| 2 | NPC Mentor Affinity dan Engagement Siswa | Efek MAS terhadap engagement siswa SMP | Jurnal Teknologi Pendidikan |
| 3 | Guild Collaborative Reward pada Pembelajaran SMP | Mekanisme kolaborasi guild dan dampaknya terhadap motivasi | Jurnal Gamifikasi / CS Education |

---

## H. JADWAL PENELITIAN

Jadwal penelitian disusun berdasarkan pelaksanaan penelitian dan disesuaikan berdasarkan lama bulan pelaksanaan penelitian (minimal 4 bulan).

### Tabel 1. Jadwal Penelitian

| Bulan | Kegiatan |
|-------|----------|
| **Bulan 1** | Studi literatur, identifikasi kebutuhan, Requirement Engineering (User Story, AC, BDD) |
| **Bulan 2** | Validasi requirement, traceability matrix, desain database, desain API |
| **Bulan 3** | Desain UI/UX, implementasi backend (Laravel 10): authentication, master data, learning, gamification engine |
| **Bulan 4** | Implementasi backend: NPC Mentor Affinity, Guild Collaborative Reward, Quest System, Gamified Retrieval Quiz, Material Reading |
| **Bulan 5** | Implementasi frontend (Next.js 15): dashboard, NPC UI, guild UI, quiz UI, analytics |
| **Bulan 6** | Unit testing, BDD testing, bug fixing, deployment |
| **Bulan 7** | Pilot testing, pre-test, treatment (penggunaan sistem 4–6 minggu) |
| **Bulan 8** | Post-test, analisis data (SPSS/R), penulisan laporan tesis, revisi |

**Catatan:** Jadwal bersifat draf awal dan perlu disesuaikan kembali dengan waktu persetujuan dosen pembimbing serta ketersediaan akses environment testing di sekolah mitra.

---

## I. DAFTAR PUSTAKA

Daftar Pustaka dengan format IEEE.

### Gamifikasi dalam Pendidikan

[1] Kementerian Pendidikan Indonesia, "Kurikulum Merdeka," 2022. [Online]. Available: https://kurikulum.kemdikbud.go.id

[2] S. Deterding, D. Dixon, R. Khaled, and L. Nacke, "From Game Design Elements to Gamefulness: Defining Gamification," in Proc. 15th Int. Acad. MindTrek Conf., 2011, pp. 9-15.

[3] A. N. Saleem, N. M. Noori, and F. Ozdamli, "Gamification Applications in E-Learning: A Literature Review," Technology, Knowledge and Learning, vol. 27, no. 1, pp. 139-159, 2022.

[4] K. J. Topping, "Trends in Peer Learning," Educational Psychology, vol. 25, no. 6, pp. 631-645, 2005.

[5] J. Hamari, J. Koivisto, and H. Sarsa, "Does Gamification Work? A Literature Review of Empirical Studies on Gamification," in Proc. 47th Hawaii Int. Conf. System Sciences, 2014, pp. 3025-3034.

[6] H. L. Roediger and A. C. Butler, "The Critical Role of Retrieval Practice in Long-Term Retention," Trends in Cognitive Sciences, vol. 15, no. 1, pp. 20-27, 2011.

[7] M. Sailer et al., "How Gamification Motivates: An Experimental Study of the Effects of Specific Game Design Elements on Psychological Need Satisfaction," Computers in Human Behavior, vol. 69, pp. 371-380, 2017.

[8] D. Dicheva, C. Dichev, G. Agre, and G. Angelova, "Gamification in Education: A Systematic Mapping Study," Journal of Educational Technology & Society, vol. 18, no. 3, pp. 75-88, 2015.

[9] S. Fiş Erümit and T. Karakuş Yılmaz, "Gamification Design in Education: What Might Give a Sense of Play and Learning?" Technology, Knowledge and Learning, vol. 27, pp. 1039-1061, 2022.

[10] G. Lampropoulos and A. Sidiropoulos, "Impact of Gamification on Students' Learning Outcomes and Academic Performance: A Longitudinal Study," Education Sciences, vol. 14, no. 4, p. 367, 2024.

### Teori Motivasi

[11] E. L. Deci and R. M. Ryan, "Self-Determination Theory: A Macrotheory of Human Motivation, Development, and Health," Canadian Psychology, vol. 49, no. 3, pp. 182-185, 2008.

[12] M. Csikszentmihalyi, Flow: The Psychology of Optimal Experience. New York: Harper & Row, 1990.

[13] L. Festinger, "A Theory of Social Comparison Processes," Human Relations, vol. 7, no. 2, pp. 117-140, 1954.

### Requirement Engineering & BDD

[14] I. Sommerville, Software Engineering, 10th ed. Pearson, 2016.

[15] G. Lucassen, F. Dalpiaz, J. M. E. Van der Werf, and S. Brinkkemper, "Improving Agile Requirements: The Quality User Story Framework and Tool," Requirements Engineering, vol. 21, pp. 383-400, 2016.

[16] N. Nascimento, A. R. Santos, A. Sales, and R. Chanin, "Behavior-Driven Development: A Case Study on Its Impacts on Agile Development Teams," in Proc. IEEE/ACM 42nd Int. Conf. Software Engineering Workshops, 2020, pp. 109-116.

[17] M. García et al., "Behaviour Driven Development: A Systematic Mapping Study," Journal of Systems and Software, vol. 203, p. 111744, 2023.

### Basis Data & Penelitian

[18] E. F. Codd, "A Relational Model of Data for Large Shared Data Banks," Communications of the ACM, vol. 13, no. 6, pp. 377-387, 1970.

[19] K. Peffers, T. Tuunanen, M. A. Rothenberger, and S. Chatterjee, "A Design Science Research Methodology for Information Systems Research," Journal of Management Information Systems, vol. 24, no. 3, pp. 45-77, 2007.

### Usability & UX

[20] J. Brooke, "SUS: A 'Quick and Dirty' Usability Scale," in Usability Evaluation in Industry, 1996, pp. 189-194.

[21] B. Laugwitz, T. Held, and M. Schrepp, "Construction and Evaluation of a User Experience Questionnaire," in HCI and Usability for Education and Work, 2008, pp. 63-76.

[22] H. L. O'Brien, P. Cairns, and M. Hall, "A Practical Approach to Measuring User Engagement with the Refined User Engagement Scale (UES)," International Journal of Human-Computer Studies, vol. 112, pp. 28-39, 2018.

### Pendukung

[23] O. Kode, "Gamification in Education: Review of Challenges and Recommendations for Effective Practice," International Journal on Cybernetics & Informatics, vol. 14, no. 4, pp. 13-28, 2025.

[24] A. R. Hevner, S. T. March, J. Park, and S. Ram, "Design Science in Information Systems Research," MIS Quarterly, vol. 28, no. 1, pp. 75-105, 2004.

[25] R. Baskerville, J. Pries-Heje, and J. R. Venable, "MEDS: Methodology for Evaluation in Design Science," European Journal of Information Systems, 2026.

[26] I. K. Raharjana, D. Siahaan, and C. Fatichah, "User Story Extraction from Natural Language for Requirements Elicitation," Journal of Systems and Software, vol. 200, p. 111634, 2023.

### Adaptivitas dan Personalisasi

[27] P. Brusilovsky, "Adaptive Hypermedia," User Modeling and User-Adapted Interaction, vol. 11, no. 1-2, pp. 87-110, 2001.

[28] D. Sampson, P. Zervas, and S. Sotiriou, "Personalised Learning: Concepts, Technologies and Practices," in Proc. 14th World Conf. Mobile and Contextual Learning, 2019, pp. 1-8.

[29] M. Peter and Kinshuk, "Adaptive Educational Systems: A Review of Contemporary Approaches," Computers & Education, vol. 180, p. 104426, 2022.

[30] S. T. Hamari, "Context-Aware Gamification: A Review of Design Patterns and Techniques," International Journal of Human–Computer Studies, vol. 170, p. 102945, 2023.
