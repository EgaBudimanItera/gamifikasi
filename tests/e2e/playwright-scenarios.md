# Playwright E2E Scenarios — EduQuest

15+ skenario BDD yang dirancang untuk pengujian otomatis menggunakan Playwright.
Setiap skenario mencakup happy path yang dapat dijalankan secara end-to-end.

---

## Scenario 1: Login Siswa

```gherkin
Feature: Siswa Login
  As a siswa SMP kelas VII
  I want to login ke sistem EduQuest
  So that saya dapat mengakses fitur pembelajaran

  Scenario: Login berhasil dengan kredensial valid
    Given siswa berada di halaman login "http://localhost:3000/login"
    When siswa mengisi email "siswa1@eduquest.test" pada field email
    And siswa mengisi password "password123" pada field password
    And siswa mengklik tombol "Masuk"
    Then siswa diarahkan ke dashboard "/dashboard"
    And nama siswa "Ahmad" ditampilkan di header
    And XP siswa "0" ditampilkan di profil sidebar

  Scenario: Login gagal dengan password salah
    Given siswa berada di halaman login "http://localhost:3000/login"
    When siswa mengisi email "siswa1@eduquest.test" pada field email
    And siswa mengisi password "wrongpassword" pada field password
    And siswa mengklik tombol "Masuk"
    Then siswa tetap di halaman login
    And pesan error "Email atau password salah" ditampilkan
```

---

## Scenario 2: Check-in Harian

```gherkin
Feature: Check-in Harian
  As a siswa yang sudah login
  I want to melakukan check-in harian
  So that saya mendapatkan XP bonus dan mempertahankan streak

  Scenario: Check-in harian berhasil
    Given siswa sedang login dan berada di dashboard
    When siswa mengklik tombol "Check-in Harian"
    Then sistem menampilkan pesan "Check-in berhasil! +10 XP"
    And XP siswa bertambah 10 poin
    And streak siswa bertambah 1 hari
    And tanggal check-in tercatat di sistem

  Scenario: Check-in sudah dilakukan hari ini
    Given siswa sedang login dan sudah check-in hari ini
    When siswa mengklik tombol "Check-in Harian"
    Then tombol check-in disabled dan menampilkan "Sudah check-in hari ini"
```

---

## Scenario 3: Penyelesaian Quest

```gherkin
Feature: Penyelesaian Quest
  As a siswa
  I want to menyelesaikan quest yang tersedia
  So that saya mendapatkan XP dan menaikkan level

  Scenario: Quest berhasil diselesaikan
    Given siswa sedang login dan berada di halaman quest
    And quest "Pelajari Algoritma Sorting" tersedia dengan reward 50 XP
    When siswa mengklik quest "Pelajari Algoritma Sorting"
    And siswa menyelesaikan semua langkah quest
    And siswa mengklik tombol "Selesaikan Quest"
    Then sistem menampilkan pesan "Quest selesai! +50 XP"
    And XP siswa bertambah 50 poin
    And quest berstatus "completed" di sistem
    And badge "Quest Hunter" ter-unlock jika memenuhi syarat

  Scenario: Quest gagal diselesaikan
    Given siswa sedang login dan berada di halaman quest
    When siswa mengklik quest "Pelajari Algoritma Sorting"
    And siswa tidak menyelesaikan semua langkah quest
    And siswa mengklik tombol "Selesaikan Quest"
    Then sistem menampilkan pesan "Quest belum selesai, silakan coba lagi"
    And XP siswa tidak bertambah
```

---

## Scenario 4: Peningkatan MAS (Mentor Affinity Score)

```gherkin
Feature: NPC Mentor Affinity
  As a siswa
  I want to berinteraksi dengan NPC mentor
  So that affinity score saya meningkat dan mendapat quest adaptif

  Scenario: MAS meningkat setelah menyelesaikan quest NPC
    Given siswa sedang login dan berada di halaman NPC
    And NPC "Bu Rina" (Informatika) memiliki affinity level 1
    When siswa mengklik NPC "Bu Rina"
    And siswa menyelesaikan quest "Pelajari Variabel Python" dari NPC
    Then affinity_xp untuk NPC "Bu Rina" bertambah
    And affinity level mungkin naik ke level 2 jika MAS >= 5
    And quest baru dengan tingkat kesulitan lebih tinggi muncul

  Scenario: Quest NPC terkunci jika affinity level rendah
    Given siswa sedang login dan berada di halaman NPC
    And NPC "Bu Rina" memiliki affinity level 1
    When siswa melihat quest "Analisis Kompleksitas Algoritma"
    Then quest tersebut berstatus "terkunci" dengan pesan "Affinity level minimal: 3"
    And tombol "Mulai Quest" disabled
```

---

## Scenario 5: Guild Contribution

```gherkin
Feature: Guild Collaborative Reward
  As a siswa yang tergabung dalam guild
  I want to berkontribusi XP ke guild
  So that guild saya mencapai target dan mendapat reward bersama

  Scenario: XP siswa otomatis menjadi Guild XP
    Given siswa "Ahmad" tergabung dalam guild "Code Warriors"
    And guild "Code Warriors" memiliki total Guild XP 500
    When siswa "Ahmad" menyelesaikan quest dan mendapatkan 50 XP
    Then Guild XP "Code Warriors" bertambah menjadi 550
    And contributed_xp siswa "Ahmad" bertambah 50

  Scenario: Guild reward diberikan saat target tercapai
    Given guild "Code Warriors" memiliki target 50 quest mingguan
    And guild "Code Warriors" telah menyelesaikan 49 quest minggu ini
    When siswa "Ahmad" menyelesaikan quest ke-50
    Then sistem menampilkan notifikasi "Guild Target Tercapai!"
    And seluruh anggota guild menerima +150 XP
    And guild menerima "Guild Chest"
    And bonus 10% XP selama 24 jam aktif untuk seluruh anggota
```

---

## Scenario 6: Reward Claim

```gherkin
Feature: Reward Claim
  As a siswa
  I want to mengklaim reward yang saya peroleh
  So that reward tersimpan dan dapat digunakan

  Scenario: Claim badge reward
    Given siswa telah menyelesaikan 10 quest
    And badge "Quest Hunter" tersedia untuk diklaim
    When siswa mengklik tombol "Klaim Badge"
    Then badge "Quest Hunter" ditampilkan di profil siswa
    And notifikasi "Badge baru: Quest Hunter!" muncul
    And badge tercatat di tabel user_badges

  Scenario: Claim XP reward dari level up
    Given siswa memiliki XP 950 dan baru naik ke level 3
    When siswa melihat notifikasi "Level Up! Level 3"
    And siswa mengklik tombol "Klaim Level Up Reward"
    Then siswa menerima +50 XP bonus
    Dan reward "Level 3 Pack" ditampilkan di profil
```

---

## Scenario 7: Level Up

```gherkin
Feature: Level Up
  As a siswa
  I want to naik level saat XP mencukupi
  So that saya merasa(progress dan mendapat reward

  Scenario: Level up dari level 1 ke level 2
    Given siswa memiliki level 1 dengan XP 450
    When siswa menyelesaikan quest dan mendapatkan 50 XP lagi
    Then XP siswa menjadi 500
    And level siswa naik ke level 2
    And animasi level up ditampilkan
    And notifikasi "Selamat! Anda naik ke Level 2" muncul
    And XP bonus 50 diberikan

  Scenario: XP tidak cukup untuk level up
    Given siswa memiliki level 2 dengan XP 500
    When siswa menyelesaikan quest dan mendapatkan 25 XP
    Then XP siswa menjadi 525
    And level siswa tetap 2
    Dan progress bar menampilkan 525/750 menuju level 3
```

---

## Scenario 8: Leaderboard Update

```gherkin
Feature: Leaderboard
  As a siswa
  I want to melihat leaderboard kelas dan sekolah
  So that saya termotivasi untuk naik peringkat

  Scenario: Leaderboard kelas menampilkan peringkat terbaru
    Given siswa sedang login dan berada di dashboard
    When siswa mengklik menu "Leaderboard"
    Then leaderboard kelas ditampilkan dengan 30 siswa
    And siswa "Ahmad" berada di peringkat ke-5 dengan XP 1200
    And peringkat diperbarui secara real-time

  Scenario: Siswa naik peringkat setelah menyelesaikan quest
    Given siswa "Ahmad" berada di peringkat ke-5 dengan XP 1200
    When siswa "Ahmad" menyelesaikan quest dan mendapatkan 200 XP
    Then XP siswa menjadi 1400
    And leaderboard diperbarui
    And siswa "Ahmad" berpindah ke peringkat ke-3
```

---

## Scenario 9: Material Reading Progress

```gherkin
Feature: Material Reading
  As a siswa
  I want to membaca materi dan melihat progress
  So that saya tahu seberapa jauh saya sudah belajar

  Scenario: Membaca materi dan progress tercatat
    Given siswa sedang login dan berada di halaman materi
    When siswa mengklik materi "Pengenalan Algoritma"
    And siswa membaca materi selama 5 menit
    And siswa menutup halaman materi
    Then progress baca siswa tercatat 50% (5 dari 10 menit)
    And waktu baca tercatat di sistem
    And XP reading bertambah sesuai durasi

  Scenario: Kuis pasca-bacaan setelah selesai membaca
    Given siswa telah menyelesaikan 100% baca materi "Pengenalan Algoritma"
    When siswa mengklik tombol "Mulai Kuis"
    Then 5 soal kuis ditampilkan
    And siswa menjawab semua soal
    And skor kuis 80/100 ditampilkan
    And +80 XP reading quiz diberikan
```

---

## Scenario 10: Adaptive Quest Generation

```gherkin
Feature: Adaptive Quest Generation
  As a siswa dengan affinity level tinggi
  I want to mendapat quest yang lebih menantang
  So that saya tidak bosan dan terus berkembang

  Scenario: Quest adaptif muncul berdasarkan MAS tinggi
    Given siswa "Ahmad" memiliki affinity level 4 dengan NPC "Bu Rina"
    When siswa membuka halaman quest NPC "Bu Rina"
    Then quest dengan difficulty "hard" dan "legendary" ditampilkan
    And quest "hard" memberikan 100 XP
    And quest "legendary" memberikan 200 XP

  Scenario: Quest adaptif muncul berdasarkan MAS rendah
    Given siswa "Budi" memiliki affinity level 1 dengan NPC "Bu Rina"
    When siswa membuka halaman quest NPC "Bu Rina"
    Then quest dengan difficulty "easy" dan "medium" ditampilkan
    And quest "easy" memberikan 25 XP
    And quest "medium" memberikan 50 XP
```

---

## Scenario 11: Quick Quiz Liga — Class Mode

```gherkin
Feature: Quick Quiz Liga (Class Mode)
  As a siswa
  I want to mengikuti quiz cepat kelas
  So that saya dapat berkompetisi dengan teman sekelas

  Scenario: Join quiz kelas dan submit jawaban
    Given sesi quiz kelas "Matematika Dasar" aktif dengan 5 soal dan waktu 5 menit
    When siswa mengklik tombol "Gabung Quiz"
    Then timer countdown 5:00 dimulai
    And 5 soal ditampilkan satu per satu
    When siswa menjawab semua soal dalam waktu 3 menit
    And siswa mengklik tombol "Submit"
    Then skor 80/100 ditampilkan
    And peringkat 3 dari 15 siswa ditampilkan
    And +24 XP diberikan (30 × 0.8)
```

---

## Scenario 12: Quick Quiz Liga — Guild Mode

```gherkin
Feature: Quick Quiz Liga (Guild Mode)
  As a anggota guild
  I want to mengikuti quiz guild
  So that guild saya naik peringkat

  Scenario: Guild quiz dengan bonus XP
    Given siswa tergabung dalam guild "Code Warriors"
    And sesi quiz guild "Algoritma" aktif dengan 10 soal dan waktu 15 menit
    When siswa mengklik tombol "Gabung Guild Quiz"
    Then timer countdown 15:00 dimulai
    And 10 soal ditampilkan
    When siswa menjawab 8 dari 10 soal benar
    And siswa mengklik tombol "Submit"
    Then skor 80/100 ditampilkan
    And +60 XP diberikan (75 × 0.8)
    And guild XP bertambah 60
```

---

## Scenario 13: Profil Siswa dan Statistik

```gherkin
Feature: Profil Siswa
  As a siswa
  I want to melihat profil dan statistik saya
  So that saya tahu perkembangan belajar saya

  Scenario: Melihat profil lengkap
    Given siswa sedang login
    When siswa mengklik menu "Profil"
    Then profil siswa ditampilkan dengan:
      | Field | Nilai |
      | Nama | Ahmad Fauzi |
      | Level | 3 |
      | XP | 1200 |
      | Streak | 7 hari |
      | Badge | 5 badge |
      | Guild | Code Warriors |
    And grafik progress 30 hari terakhir ditampilkan
```

---

## Scenario 14: Guru Dashboard — Monitoring

```gherkin
Feature: Guru Dashboard
  As a guru
  I want to memantau progress dan engagement siswa
  So that saya dapat memberikan intervensi yang tepat

  Scenario: Guru melihat statistik kelas
    Given guru "Pak Budi" sedang login
    When guru mengklik menu "Dashboard"
    Then statistik kelas ditampilkan:
      | Metrik | Nilai |
      | Total Siswa | 30 |
      | Rata-rata XP | 850 |
      | Quest Completion Rate | 75% |
      | Guild Active Rate | 80% |
    And grafik engagement 7 hari terakhir ditampilkan

  Scenario: Guru melihat detail NPC affinity siswa
    Given guru "Pak Budi" sedang login
    When guru mengklik menu "NPC Analytics"
    Then tabel NPC affinity untuk seluruh siswa ditampilkan
    And rata-rata affinity per NPC ditampilkan
    And siswa dengan affinity rendah ditandai kuning
```

---

## Scenario 15: Error Handling — Network Error

```gherkin
Feature: Error Handling
  As a siswa
  I want to mendapat pesan error yang jelas
  So that saya tahu harus berbuat apa

  Scenario: Network error saat submit jawaban
    Given siswa sedang mengerjakan quest
    When koneksi internet terputus
    And siswa mengklik tombol "Submit"
    Then pesan error "Koneksi terputus, silakan coba lagi" ditampilkan
    And jawaban siswa tersimpan sementara di localStorage
    When koneksi pulih dan siswa mengklik "Submit" lagi
    Then jawaban berhasil disimpan

  Scenario: Session expired
    Given siswa sedang login selama 2 jam
    When token autentikasi expired
    And siswa mengakses halaman baru
    Then siswa diarahkan ke halaman login
    And pesan "Sesi telah berakhir, silakan login kembali" ditampilkan
```

---

## Scenario 16: NPC Encounter (Random Encounter)

```gherkin
Feature: NPC Random Encounter
  As a siswa yang sedang membaca materi
  I want NPC mentor muncul secara acak
  So that saya mendapat quest baru secara mengejutkan

  Scenario: NPC muncul setelah membaca materi
    Given siswa sedang membaca materi "Pengenalan Python"
    When siswa menyelesaikan bacaan (100% progress)
    Then ada 33% kemungkinan NPC "Bu Rina" muncul sebagai random encounter
    And dialog NPC ditampilkan: "Hei Ahmad! Kamu sudah selesai membaca. Aku punya quest baru untukmu!"
    And tombol "Terima Quest" dan "Nanti Saja" ditampilkan

  Scenario: Siswa menolak quest NPC
    Given NPC "Bu Rina" muncul sebagai random encounter
    When siswa mengklik tombol "Nanti Saja"
    Then dialog NPC menutup
    And quest tidak ditambahkan ke daftar quest siswa
    And encounter tercatat di sistem
```

---

## Scenario 17: Guild Management

```gherkin
Feature: Guild Management
  As a siswa
  I want to membuat atau bergabung guild
  So that saya bisa belajar bersama teman

  Scenario: Membuat guild baru
    Given siswa sedang login dan belum tergabung dalam guild
    When siswa mengklik tombol "Buat Guild"
    And siswa mengisi nama guild "Python Heroes"
    And siswa mengklik tombol "Buat"
    Then guild "Python Heroes" dibuat
    And siswa menjadi leader guild
    Dan guild dapat menampung maksimal 5 anggota

  Scenario: Bergabung ke guild yang ada
    Given siswa sedang login dan belum tergabung dalam guild
    When siswa mencari guild "Code Warriors"
    And siswa mengklik tombol "Gabung"
    Then siswa tergabung dalam guild "Code Warriors"
    And jumlah anggota bertambah 1
    And siswa dapat melihat anggota guild lainnya
```

---

## Catatan Implementasi Playwright

### Struktur File Test
```
tests/e2e/
├── login.spec.ts
├── checkin.spec.ts
├── quest.spec.ts
├── npc-affinity.spec.ts
├── guild.spec.ts
├── reward.spec.ts
├── level-up.spec.ts
├── leaderboard.spec.ts
├── reading.spec.ts
├── adaptive-quest.spec.ts
├── quick-quiz.spec.ts
├── profile.spec.ts
├── guru-dashboard.spec.ts
├── error-handling.spec.ts
├── npc-encounter.spec.ts
├── guild-management.spec.ts
└── fixtures/
    ├── auth.fixture.ts
    └── test-data.ts
```

### Setup Required
```typescript
// playwright.config.ts
import { defineConfig } from '@playwright/test';

export default defineConfig({
  testDir: './tests/e2e',
  timeout: 30000,
  retries: 2,
  use: {
    baseURL: 'http://localhost:3000',
    headless: true,
    viewport: { width: 1280, height: 720 },
    screenshot: 'only-on-failure',
  },
  projects: [
    { name: 'chromium', use: { browserName: 'chromium' } },
  ],
});
```
