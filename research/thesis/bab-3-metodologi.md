# BAB III: METODOLOGI PENELITIAN

## 3.1 Paradigma Penelitian

Penelitian ini menggunakan paradigma **Design Science Research (DSR)** yang berfokus pada penciptaan dan evaluasi artefak teknologi untuk memecahkan masalah identifikasi (Peffers et al., 2007).

## 3.2 Desain Penelitian

### 3.2.1 Jenis Penelitian
Penelitian ini termasuk dalam kategori **Applied Research** dengan pendekatan **mixed methods** (kuantitatif dan kualitatif).

### 3.2.2 Populasi dan Sampel
- **Populasi:** Siswa SMA/SMK kelas XII
- **Sampel:** 30-50 siswa dari 2 kelas
- **Teknik Sampling:** Purposive sampling

### 3.2.3 Variabel Penelitian

| No | Variabel | Tipe | Instrumen |
|----|----------|------|-----------|
| 1 | Usability | Independen | SUS Questionnaire |
| 2 | User Experience | Independen | UEQ Questionnaire |
| 3 | User Engagement | Independen | Engagement Questionnaire |
| 4 | Gamification Effect | Dependenn | Completion Rate, XP Earned |

## 3.3 Instrumen Penelitian

### 3.3.1 System Usability Scale (SUS)
SUS terdiri dari 10 pernyataan dengan skala Likert 1-5. Skor SUS dihitung dengan rumus:
```
SUS Score = (Σ Konversi Skor) × 2.5
```

### 3.3.2 User Experience Questionnaire (UEQ)
UEQ menilai 6 dimensi: Attractiveness, Clarity, Efficiency, Stimulation, Novelty, dan Usability.

### 3.3.3 User Engagement Questionnaire
Instrumen adaptasi dari>User Engagement Scale (UES) yang menilai: Attention, Enjoyment, Gamification Effectiveness, Behavioral Engagement, dan Continued Intention.

## 3.4 Prosedur Pengumpulan Data

### 3.4.1 Tahap Persiapan
1. Pengembangan prototipe sistem EduQuest dengan model relasi data:
   - Guru dapat diassign ke banyak kelas dan banyak mata pelajaran.
   - Siswa terdaftar pada satu kelas.
   - Materi dan tugas di-scope per kelas.
   - Pelacakan detail sumber XP (assignment, login, streak, quest, penalty).
2. Validasi instrumen oleh ahli.
3. Uji coba instrumen (pilot test) pada 5-10 responden.

### 3.4.2 Tahap Pelaksanaan
1. Pre-test: Pengisian instrumen sebelum penggunaan sistem.
2. Treatment: Penggunaan sistem EduQuest selama 4-8 minggu.
3. Post-test: Pengisian instrumen setelah penggunaan sistem.

### 3.4.3 Tahap Analisis
1. Pengolahan data using SPSS/R.
2. Uji asumsi klasik (normalitas, homogenitas).
3. Uji hipotesis (t-test, Mann-Whitney).
4. Perhitungan effect size.

## 3.5 Teknik Analisis Data

### 3.5.1 Analisis Deskriptif
Menghitung mean, median, modus, standar deviasi, dan frekuensi distribusi.

### 3.5.2 Analisis Inferensial
- **Uji Normalitas:** Shapiro-Wilk test (α = 0.05)
- **Uji Homogenitas:** Levene's test (α = 0.05)
- **Uji-t:** Independent samples t-test (α = 0.05)
- **Uji Mann-Whitney:** Untuk data tidak normal
- **Effect Size:** Cohen's d

### 3.5.3 Kriteria Keberhasilan

| Metrik | Target | Kriteria |
|--------|--------|----------|
| SUS Score | ≥ 70 | Good usability |
| UEQ Score | > 1.0 | Positive experience |
| Engagement | p < 0.05 | Significant increase |
| Completion Rate | ≥ 80% | High completion |

## 3.6 Etika Penelitian
1. Mendapatkan persetujuan dari pihak sekolah.
2. Mendapatkan informed consent dari responden.
3. Menjaga kerahasiaan data responden.
4. Tidak menimbulkan kerugian bagi responden.
