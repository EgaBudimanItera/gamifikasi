Feature: User Login
  As a pengguna
  I want to login menggunakan email dan password
  So that saya dapat mengakses sistem

  Scenario: Login berhasil
    Given pengguna berada di halaman login
    And pengguna memiliki akun valid
    When pengguna memasukkan email dan password yang benar
    And pengguna mengklik tombol "Login"
    Then pengguna diarahkan ke dashboard sesuai peran
    And token autentikasi tersimpan

  Scenario: Login gagal
    Given pengguna berada di halaman login
    When pengguna memasukkan password yang salah
    Then sistem menampilkan pesan error
    And pengguna tetap di halaman login
