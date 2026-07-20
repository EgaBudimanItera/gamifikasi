Feature: Streak System
  As a siswa
  I want to menjaga streak login harian
  So that mendapat bonus XP

  Scenario: Streak bertambah saat login
    Given siswa login 6 hari berturut
    When siswa login hari ke-7
    Then streak menjadi 7
    And bonus +100 XP diberikan

  Scenario: Streak direset saat tidak login
    Given siswa memiliki streak 5
    When siswa tidak login sehari
    Then streak direset ke 0
