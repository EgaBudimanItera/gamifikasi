Feature: Leaderboard
  As a siswa
  I want to melihat peringkat
  So that termotivasi bersaing

  Scenario: Melihat leaderboard kelas
    Given siswa berada di kelas
    When siswa membuka leaderboard kelas
    Then peringkat ditampilkan berdasarkan XP

  Scenario: Melihat leaderboard sekolah
    Given siswa berada di sekolah
    When siswa membuka leaderboard sekolah
    Then peringkat seluruh sekolah ditampilkan
