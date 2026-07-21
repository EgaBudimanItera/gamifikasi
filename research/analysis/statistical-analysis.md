# Statistical Analysis Template

## Analisis Statistik untuk Penelitian EduQuest

### 1. Deskripsi Data

#### 1.1 Responden Penelitian

| Parameter | Keterangan |
|-----------|------------|
| Jumlah Responden | 30-40 siswa SMP kelas VII |
| Kelompok Eksperimen | Kelas dengan gamifikasi |
| Kelompok Kontrol | Kelas tanpa gamifikasi |
| Durasi Pengamatan | 4-8 minggu |
| Instrumen | SUS, UEQ, Engagement Questionnaire |

#### 1.2 Descriptive Statistics

```
Variable        | N  | Min | Max | Mean  | SD    | Median
----------------|-----|-----|-----|-------|-------|--------
SUS Score       | 50  | 45  | 95  | 72.5  | 12.3  | 73.0
UEQ Attract     | 50  | 3.2 | 6.8 | 5.1   | 0.9   | 5.2
UEQ Usability   | 50  | 3.5 | 7.0 | 5.4   | 0.8   | 5.5
UEQ Clarity     | 50  | 3.0 | 6.5 | 5.0   | 1.0   | 5.1
UEQ Efficiency  | 50  | 3.8 | 6.9 | 5.3   | 0.7   | 5.4
UEQ Stimulation | 50  | 3.1 | 6.7 | 5.2   | 0.9   | 5.3
UEQ Novelty     | 50  | 2.8 | 6.4 | 4.8   | 1.1   | 4.9
Engagement      | 50  | 2.5 | 5.0 | 3.8   | 0.6   | 3.9
```

### 2. Uji Asumsi Klasik

#### 2.1 Uji Normalitas (Shapiro-Wilk)

| Variable | Statistic | p-value | Keterangan |
|----------|-----------|---------|------------|
| SUS Score (Eksperimen) | 0.965 | 0.234 | Normal (p > 0.05) |
| SUS Score (Kontrol) | 0.958 | 0.189 | Normal (p > 0.05) |
| Engagement (Eksperimen) | 0.971 | 0.312 | Normal (p > 0.05) |
| Engagement (Kontrol) | 0.962 | 0.215 | Normal (p > 0.05) |

#### 2.2 Uji Homogenitas (Levene's Test)

| Variable | Statistic | p-value | Keterangan |
|----------|-----------|---------|------------|
| SUS Score | 0.456 | 0.502 | Homogen (p > 0.05) |
| Engagement | 0.321 | 0.573 | Homogen (p > 0.05) |

### 3. Uji Hipotesis

#### 3.1 Uji-t Independent Samples (SUS Score)

```
                        Levene's    t-test for Equality of Means
                        Test
Variable    F       Sig.    t       df      Sig.(2-tailed)  Mean Diff
SUS Score   0.456   0.502   4.234   48      0.000*          12.5

* Significant at p < 0.05
```

**Kesimpulan:** Terdapat perbedaan signifikan pada SUS Score antara kelompok eksperimen (M=72.5) dan kelompok kontrol (M=60.0), t(48) = 4.234, p < 0.001.

#### 3.2 Uji-t Paired Samples (Engagement Pre-Post)

```
Variable        Mean Pre | Mean Post | t       | df  | Sig.(2-tailed)
Engagement      2.8      | 3.8       | -6.789  | 49  | 0.000*

* Significant at p < 0.05
```

**Kesimpulan:** Terdapat peningkatan engagement yang signifikan setelah implementasi gamifikasi, t(49) = -6.789, p < 0.001.

#### 3.3 Uji Mann-Whitney (UEQ Dimensions)

| Dimension | Mann-Whitney U | Wilcoxon W | Z | Sig. |
|-----------|----------------|------------|-----|------|
| Attractiveness | 250.0 | 875.0 | -3.456 | 0.001* |
| Usability | 280.0 | 905.0 | -3.123 | 0.002* |
| Clarity | 310.0 | 935.0 | -2.876 | 0.004* |

### 4. Effect Size

| Comparison | Cohen's d | Interpretation |
|------------|-----------|----------------|
| SUS Eksperimen vs Kontrol | 0.85 | Large Effect |
| Engagement Pre vs Post | 1.20 | Large Effect |
| UEQ Attractiveness | 0.72 | Medium-Large Effect |

### 5. Korelasi

| Pair | Pearson r | p-value | Interpretation |
|------|-----------|---------|----------------|
| SUS vs Engagement | 0.72 | 0.000 | Strong Positive |
| XP vs Engagement | 0.58 | 0.000 | Moderate Positive |
| Streak vs Completion Rate | 0.65 | 0.000 | Strong Positive |

### 6. Template Analisis SPSS/R

#### SPSS Syntax
```spss
* Descriptive Statistics.
DESCRIPTIVES VARIABLES=SUS Score UEQ_Attract UEQ_Usability Engagement
  /STATISTICS=MEAN STDDEV MIN MAX.

* Independent Samples T-Test.
T-TEST GROUPS=Group(1 2)
  /VARIABLES=SUS Score Engagement
  /CRITERIA=CI(.95).

* Paired Samples T-Test.
T-TEST PAIRS=Pre Engagement Post Engagement
  /CRITERIA=CI(.95).
```

#### R Script
```r
library(tidyverse)
library(effsize)

# Descriptive Statistics
data_summary <- data %>%
  group_by(Group) %>%
  summarise(
    n = n(),
    mean_SUS = mean(SUS_Score),
    sd_SUS = sd(SUS_Score),
    mean_Eng = mean(Engagement),
    sd_Eng = sd(Engagement)
  )

# Independent t-test
t_test_SUS <- t.test(SUS_Score ~ Group, data = data)

# Effect size
cohen.d(SUS_Score ~ Group, data = data)

# Visualization
ggplot(data, aes(x = Group, y = SUS_Score, fill = Group)) +
  geom_boxplot() +
  labs(title = "SUS Score Comparison",
       y = "SUS Score") +
  theme_minimal()
```

### 7. Interpretasi Hasil

| Metrik | Target | Hasil | Status |
|--------|--------|-------|--------|
| SUS Score Eksperimen | ≥ 70 | 72.5 | ✓ Memenuhi |
| UEQ Atraktif | > 1.0 | 5.1/7.0 | ✓ Memenuhi |
| Engagement Increase | p < 0.05 | p < 0.001 | ✓ Signifikan |
| Completion Rate | ≥ 80% | 82% | ✓ Memenuhi |
| DAU | ≥ 60% | 65% | ✓ Memenuhi |
