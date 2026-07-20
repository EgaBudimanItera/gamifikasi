Feature: Assignment Submission
  As a siswa
  I want to submit jawaban tugas
  So that saya menyelesaikan tugas

  Scenario: Submit jawaban teks
    Given siswa sedang login
    And tugas tersedia
    When siswa mengisi jawaban teks
    And siswa mengklik "Kumpulkan"
    Then jawaban tersimpan dengan status "pending"
    And XP awal submission diberikan

  Scenario: Submit jawaban melewati deadline
    Given siswa sedang login
    And tugas sudah melewati deadline
    When siswa mengumpulkan jawaban
    Then jawaban tersimpan tanpa bonus XP awal
