Feature: XP and Level System
  As a siswa
  I want to mendapatkan XP dan naik level
  So that saya termotivasi belajar

  Scenario: Mendapat XP dari tugas
    Given siswa menyelesaikan tugas
    When tugas dinilai selesai
    Then siswa mendapat +50 XP
    Dan total_xp bertambah

  Scenario: Level naik saat XP cukup
    Given siswa memiliki 99 XP dan level 1
    When total_xp menjadi 100
    Then level berubah menjadi 2

  Scenario: Login harian memberikan XP
    Given siswa belum login hari ini
    When siswa melakukan check-in
    Then siswa mendapat +10 XP
