# BAB III: METODOLOGI PENELITIAN

## 3.1 Paradigma Penelitian

Penelitian ini menggunakan desain **quasi-experimental** dengan pendekatan kuantitatif dan dukungan observasi penggunaan sistem. Evaluasi dilakukan melalui perbandingan pre-test dan post-test pada kelompok yang sama (**one-group pretest-posttest design**). Jenis penelitian termasuk dalam kategori **Applied Research** yang menghasilkan prototipe sistem sebagai artefak utama. Artefak yang dikembangkan mencakup prototipe sistem EduQuest untuk siswa SMP kelas VII dengan sekitar 60 functional requirements.

## 3.2 Desain Penelitian

### 3.2.1 Jenis Penelitian
Penelitian ini termasuk dalam kategori **Applied Research** dengan desain **one-group pretest-posttest**. Tidak ada kelompok kontrol eksplisit — evaluasi dilakukan melalui perbandingan pre-test dan post-test pada kelompok yang sama.

### 3.2.2 Populasi dan Sampel
- **Populasi:** Siswa SMP kelas VII di wilayah Bandar Lampung
- **Sampel:** 30–40 siswa dari 1–2 kelas
- **Teknik Sampling:** Purposive sampling
- **Kriteria inklusi:** Siswa aktif yang memiliki akses internet dan perangkat
- **Kriteria eksklusi:** Siswa yang tidak bersedia memberikan informed consent

### 3.2.3 Mata Pelajaran
Sistem difokuskan pada mata pelajaran SMP kelas VII:
- Informatika
- Matematika
- Bahasa Indonesia
- IPA

### 3.2.4 Variabel Penelitian

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

## 3.3 Instrumen Penelitian

### 3.3.1 System Usability Scale (SUS)
SUS terdiri dari 10 pernyataan dengan skala Likert 1-5. Skor SUS dihitung dengan rumus:
```
SUS Score = (Σ Konversi Skor) × 2.5
```
Kriteria: ≥ 68 = above average, ≥ 80 = good, ≥ 90 = excellent.

### 3.3.2 User Experience Questionnaire (UEQ)
UEQ menilai 6 dimensi: Attractiveness, Clarity, Efficiency, Stimulation, Novelty, dan Usability. Skala 1-7 untuk setiap item.

### 3.3.3 Gamification Engagement Questionnaire
Instrumen yang menggabungkan dimensi-dimensi engagement gamifikasi:
- **Competition:** Seberapa besar motivasi kompetisi siswa (leaderboard, adaptive challenge quiz ranking).
- **Collaboration:** Seberapa aktif siswa berkolaborasi di guild (kontribusi XP, guild quest).
- **Narrative Attachment:** Seberapa kuat ikatan siswa dengan NPC mentor (Mentor Affinity Score).
- **Exploration:** Seberapa besar motivasi siswa mengeksplorasi konten dan quest.
- **Continued Intention:** Kesiapan siswa untuk terus menggunakan sistem.

## 3.4 Prosedur Pengumpulan Data

### 3.4.1 Tahap Persiapan
1. Pengembangan prototipe sistem EduQuest dengan fitur:
   - NPC Mentor Affinity Score (MAS)
   - Guild Collaborative Reward
   - Quest System kontekstual
   - XP & Level System
   - Badge & Streak
   - Adaptive Challenge Quiz (class & guild mode)
   - Material Reading dengan tracking
   - Analytics Dashboard
2. Validasi instrumen oleh ahli.
3. Uji coba instrumen (pilot test) pada 5–10 responden.

### 3.4.2 Tahap Pelaksanaan
1. **Pre-test:** Pengisian instrumen (SUS, UEQ, Engagement) sebelum penggunaan sistem.
2. **Treatment:** Penggunaan sistem EduQuest selama 4–6 minggu.
3. **Post-test:** Pengisian instrumen setelah penggunaan sistem.
4. **System logs:** Data penggunaan sistem dari backend.

### 3.4.3 Tahap Analisis
1. Pengolahan data menggunakan SPSS/R.
2. Uji asumsi klasik (normalitas, homogenitas).
3. Uji hipotesis (paired t-test, Wilcoxon Signed Rank Test).
4. Perhitungan effect size (Cohen's d).
5. Analisis korelasi antara NPC affinity, guild activity, dan engagement.

## 3.5 Teknik Analisis Data

### 3.5.1 Statistik Deskriptif
Menghitung mean, median, modus, standar deviasi, dan frekuensi distribusi untuk semua variabel.

### 3.5.2 Uji Asumsi Klasik
- **Uji Normalitas:** Shapiro-Wilk test (α = 0.05)
- **Uji Homogenitas:** Levene's test (α = 0.05)

### 3.5.3 Uji Hipotesis
- **Uji-t:** Paired samples t-test untuk data normal (α = 0.05)
- **Wilcoxon Signed Rank Test:** Untuk data tidak normal (α = 0.05)
- **Effect Size:** Cohen's d untuk mengukur besarnya efek

### 3.5.4 Analisis Korelasi
- **Pearson:** Korelasi antara NPC affinity frequency dan task completion rate
- **Spearman:** Korelasi antara guild activity dan engagement level

### 3.5.5 Kriteria Keberhasilan

| Metrik | Target | Kriteria |
|--------|--------|----------|
| SUS Score | ≥ 70 | Good usability |
| UEQ Score | > 0 | Positive experience |
| Engagement | p < 0.05 | Significant increase |
| Task Completion Rate | ≥ 80% | High completion |
| NPC Quest Completion | ≥ 70% quest diselesaikan | High NPC engagement |
| Guild Activity | ≥ 70% siswa aktif di guild | High guild engagement |
| Material Reading | ≥ 80% materi dibaca > 3 menit | High reading engagement |
| Learning Motivation | p < 0.05 | Significant increase |

## 3.6 Alur Penelitian

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

## 3.7 Keterbatasan Penelitian

Desain one-group pretest-posttest memiliki beberapa ancaman validitas internal yang perlu diakui, antara lain **novelty effect** (pengaruh kebaruan yang membuat siswa lebih antusias di awal), **history effect** (peristiwa eksternal yang memengaruhi selama periode penelitian), dan **maturation effect** (perubahan alami pada siswa selama 4–6 minggu).

Untuk meminimalkan bias tersebut, penelitian ini menggunakan beberapa strategi mitigasi:
1. **System logs longitudinal** — data penggunaan sistem dikumpulkan selama periode 4–6 minggu sehingga perubahan perilaku penggunaan dapat diamati secara berkelanjutan, bukan hanya pada titik pre-test dan post-test.
2. **Observasi partisipatif** — pengamatan terhadap aktivitas siswa selama periode treatment untuk mendeteksi perubahan perilaku yang tidak terduga.
3. **Durasi treatment cukup panjang** — 4–6 minggu dirasakan cukup panjang untuk mengurangi efek novelty, karena siswa mulai terbiasa dengan sistem setelah minggu pertama.

Meskipun demikian, penelitian ini tidak mengklaim kausalitas yang kuat karena tidak ada kelompok kontrol. Temuan penelitian dipandang sebagai bukti awal (preliminary evidence) yang membutuhkan replikasi dengan desain yang lebih kuat pada penelitian selanjutnya.

## 3.8 Etika Penelitian
1. Mendapatkan persetujuan dari pihak sekolah.
2. Mendapatkan informed consent dari responden (siswa SMP) dan wali.
3. Menjaga kerahasiaan data responden.
4. Tidak menimbulkan kerugian bagi responden.
5. Memastikan sistem gamifikasi tidak menimbulkan tekanan psikologis berlebihan pada siswa.
