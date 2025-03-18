<?php 
session_start();

require 'apply-static/koneksi.php';


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="asset/img/logo.jpg">
    <link rel="stylesheet" href="asset/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Donasi - Yayasan Adz-Dzikro Loa Janan</title>
  </head>
  <body>

    <!-- Banner -->
    <section class="banner">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-6">
            <img src="asset/img/banner.jpeg" alt="" class="img-fluid"><br>
            <h5>Pembebasan Lahan Yayasan Adz-Dzikro Loa Janan</h5>
          </div>
        </div>
      </div>
    </section>
    <!-- Banner -->


    <!-- Rangger -->
    <section class="rangger">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-6">
            <h5>Perkembangan Donasi</h5>
            <span>Target Donasi: Rp. 600.000.000</span>
            <?php 
            // Ambil total jumlah dari kolom "jumlah" dalam tabel "donasi"
            $sql = "SELECT SUM(jumlah) as total_dana FROM donasi WHERE status_approve = 'Y'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            $total_dana = $result['total_dana'] ?? 0;

            // Tetapkan nilai total target dana (100%)
            $total_target = 600000000;

            // Hitung persentase dana yang terkumpul
            $persentase = ($total_dana / $total_target) * 100;
            ?>
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo number_format($persentase, 2); ?>%;" aria-valuenow="<?php echo $total_dana; ?>" aria-valuemin="0" aria-valuemax="600000000"></div>
            </div><br>
            <center><span>Total Terkumpul: Rp. <?php echo number_format($total_dana, 0, ',', '.'); ?></span></center>
          </div>
        </div>
      </div>
    </section>
    <!-- Rangger -->




    <!-- Bilah Navigasi -->
    <section class="bilah-navigasi">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-6">
            <ul class="nav justify-content-center nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Deskripsi</button>
              </li>
              <?php 
              $sql = "SELECT COUNT(*) FROM donasi WHERE status_approve = 'Y'";
              $stmt = $pdo->query($sql);
              $jumlahApprove = $stmt->fetchColumn();
              ?>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="donate-tab" data-bs-toggle="tab" data-bs-target="#donate" type="button" role="tab" aria-controls="donate" aria-selected="false">Donatur (<?php echo $jumlahApprove; ?>)</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <p style="text-align: center; font-size: 14px;">
                  <h5 style="text-align: center; font-size: 14px; font-weight: 600; color: #000;">Pembebasan Lahan Yayasan Pendidikan Islam Adz-Dzikro Loa Janan</h5>
                </p>

                <p style="color: #000; font-size: 13px;">
                  Pembebasan lahan untuk pondok pesantren sangat penting untuk memperluas fasilitas dan meningkatkan kualitas pendidikan agama yang disediakan. Lahan yang cukup akan memungkinkan pondok pesantren untuk menambah jumlah gedung pendidikan, asrama, perpustakaan, dan fasilitas lainnya yang dibutuhkan. Dengan adanya lahan yang memadai, pondok pesantren dapat menampung dan mendidik lebih banyak santri dengan lebih baik.
                </p>

                <p style="color: #000; font-size: 13px;">
                  Selain itu, pembebasan lahan penting untuk menghadapi perkembangan penduduk dan meningkatkan akses pendidikan agama. Dengan jumlah penduduk yang terus bertambah, dibutuhkan lebih banyak sarana pendidikan agama yang dapat membimbing para santri dalam memahami ajaran agama dengan baik. Dalam hal ini, pembebasan lahan menjadi langkah krusial untuk menjawab kebutuhan tersebut.
                </p>

                <p style="color: #000; font-size: 13px;">
                  Yuk bersedekah mulai Rp 10.000 , Semoga Allah memberikan Pahala Mengalir, Aamiin. Cukup dengan cara:
                </p>

                <p style="color: #000; font-size: 13px;">
                  <ol>
                    <li style="color: #000; font-size: 13px;">
                      Masukan nominal donasi
                    </li>
                    <li style="color: #000; font-size: 13px;">
                      Masukan Data Anda Sebagai Donatur
                    </li>
                    <li style="color: #000; font-size: 13px;">
                      Pilih metode pembayaran dan transfer ke no. rekening yang tertera
                    </li>
                    <li style="color: #000; font-size: 13px;">
                      Klik ” PROSES SEKARANG”
                    </li>
                  </ol>
                </p>

                <p style="color: #000; font-size: 13px;">
                  nb : Termasuk 10% Infak Operasional
                </p>
              </div>
              <div class="tab-pane fade" id="donate" role="tabpanel" aria-labelledby="donate-tab">
                <h5 style="color: #000; font-size: 16px; font-weight: bold;">20 Donatur Terbaru</h5>
                <?php 

                // Ambil 20 data terbaru dari tabel "donasi" dengan status_approve = 'Y'
                  $sql = "SELECT * FROM donasi WHERE status_approve = 'Y' ORDER BY id DESC LIMIT 20";
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute();
                  $donations = $stmt->fetchAll();
                
                ?>
                <?php foreach ($donations as $index => $donation): ?>
                <?php if ($index == 0): ?>
                    <div class="donate-box donate-set-bg donate-top">
                <?php elseif ($index % 2 == 0): ?>
                    <div class="donate-box donate-set-bg">
                <?php else: ?>
                    <div class="donate-box">
                <?php endif; ?>
                  <span style="color: #000; font-size: 14px;"><?= htmlspecialchars($donation['donatur']) ?></span><br>
                  <p style="text-align: right;">
                    <span style="text-align: right; font-size: 15px; color: #000; font-weight: 500;">Rp. <?= number_format($donation['jumlah'], 0, ',', '.') ?></span>
                  </p>
                  <span style="text-align: left; color: #83af4f; font-size: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                    </svg> 
                    <span id="time-display<?= htmlspecialchars($donation['id']) ?>"></span>
                    <script>
                      function timeElapsed(timestamp) {
                        const now = new Date();
                        const time = new Date(timestamp);
                        const diff = Math.floor((now - time) / 1000); // Selisih dalam detik

                        if (diff < 60) {
                            return `${diff} detik yang lalu`;
                        } else if (diff < 3600) {
                            return `${Math.floor(diff / 60)} menit yang lalu`;
                        } else if (diff < 86400) {
                            return `${Math.floor(diff / 3600)} jam yang lalu`;
                        } else {
                            return `${Math.floor(diff / 86400)} hari yang lalu`;
                        }
                    }

                    function updateTime() {
                        const timestamp = "<?= htmlspecialchars($donation['waktu_approve']) ?>"; // Ganti dengan timestamp dari database
                        document.getElementById("time-display<?= htmlspecialchars($donation['id']) ?>").textContent = timeElapsed(timestamp);
                    }

                    // Panggil fungsi saat halaman dimuat
                    document.addEventListener("DOMContentLoaded", updateTime);
                    </script>
                  </span>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Bilah Navigasi -->



    <!-- Donasi -->
    <section class="donasi">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-6">
            <div class="set-bg radius-border">
              <p style="text-align: center;">
                <span style="color: #000; font-weight: 600; font-size: 14px;">Pengisian Donasi</span>
              </p>
            </div>
            <div class="non-set-bg" style="text-align: center;">
              <div class="row justify-content-center">
                <div class="col-lg-2">
                  <img src="asset/img/banner.jpeg" style="width: 50px;" alt="">
                </div>
                <div class="col-lg-10">
                  <span style="color: #000; font-weight: 600; font-size: 13px;">Pembebasan Lahan Yayasan Pendidikan Islam Adz-Dzikro Loa Janan</span>
                </div>
              </div>
                <div class="row justify-content-center gy-5" style="margin-top: 10px;">
                  <div class="col-6 col-md-3">
                    <input type="radio" class="btn-check" id="total-one" value="10000" name="pilihan">
                    <label class="btn btn-outline-danger" for="total-one">Rp. 10.000</label>
                  </div>
                  <div class="col-6 col-md-3">
                    <input type="radio" class="btn-check" id="total-two" value="20000" name="pilihan">
                    <label class="btn btn-outline-danger" for="total-two">Rp. 20.000</label>
                  </div>
                  <div class="col-6 col-md-3">
                    <input type="radio" class="btn-check" id="total-three" value="50000" name="pilihan">
                    <label class="btn btn-outline-danger" for="total-three">Rp. 50.000</label>
                  </div>
                  <div class="col-6 col-md-3">
                    <input type="radio" class="btn-check" id="total-four" value="100000" name="pilihan">
                    <label class="btn btn-outline-danger" for="total-four">Rp. 100.000</label>
                  </div>
                  <div class="col-6 col-md-3">
                    <input type="radio" class="btn-check" id="total-five" value="200000" name="pilihan">
                    <label class="btn btn-outline-danger" for="total-five">Rp. 200.000</label>
                  </div>
                  <div class="col-6 col-md-3">
                    <input type="radio" class="btn-check" id="total-nine" value="500000" name="pilihan">
                    <label class="btn btn-outline-danger" for="total-nine">Rp. 500.000</label>
                  </div>
                  <div class="col-6 col-md-3">
                    <input type="radio" class="btn-check" id="total-seven" value="1000000" name="pilihan">
                    <label class="btn btn-outline-danger" for="total-seven">Rp. 1000.000</label>
                  </div>
                  <div class="col-6 col-md-3">
                    <input type="radio" class="btn-check" id="total-eight" name="pilihan" value="0">
                    <label class="btn btn-outline-danger" for="total-eight">Jumlah Lainnya</label>
                  </div>
                </div>

                <form action="donate_added.php" method="post">
                  <?php 
                  if (empty($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                }
                
                  ?>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="row justify-content-center gy-5" style="margin-top: 5px;">
                  <div class="col-lg">
                    <div class="input-group mb-3">
                      <span class="input-group-text bg-danger">Rp</span>
                      <input type="text" id="hasilPilihan" class="form-control" name="totalBayar" required>
                      <span class="input-group-text">,00</span>
                    </div>
                  </div>
                </div>
            </div>

            <div class="non-set-bg" style="border-top: 1px solid #eaeaea;">
              <span style="color: #76c61c; font-size: 14px; font-weight: 600;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg> Secure 100%
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Donasi -->




    <!-- Donatur -->
    <section class="donatur">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-6">
            <div class="set-bg radius-border">
              <p style="text-align: center;">
              <span style="color: #000; font-size: 14px; font-weight: 500;">Info Donatur</span>
              </p>
            </div>

            <div class="non-set-bg">
              <span style="color: #000; font-size: 13px;">Isi data-data di bawah untuk informasi akses di website ini.</span>
              <h5 style="font-size: 15px; color: #000; margin-top: 30px; font-weight: 600;">Informasi Pribadi</h5><br>

                <div class="mb-3">
                  <label for="inputName" class="form-label">Nama <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="inputName" name="donatur" placeholder="Nama Anda Sebagai Donatur" required>
                </div>
                <br>
                <div class="mb-3">
                  <label for="inputPhone" class="form-label">No. Hp / WhatsApp <span style="color: red;">*</span></label><br>
                  <span style="color: #000; font-size: 12px;">Kami Menggunakan Kontak Anda Sebagai Keperluan Konfirmasi Administrasi</span><br><br>
                  <input type="number" class="form-control" id="inputPhone" name="hpwa" placeholder="Kontak Anda" required>
                </div>
                
                <div style="margin-top: 60px;">
                  <h5 style="color: #000; font-size: 15px;">Pilih Metode Pembayaran <span style="color: red;">*</span></h5><br>
                </div>

                <div style="margin-top: 20px;">
                  <div class="row gy-5">
                    <div class="col-6 col-lg-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="nama_bank" id="bsi" required value="Bank Syari'ah Indonesia">
                        <label class="form-check-label" for="bsi">
                          <img src="asset/img/bsi.png" class="img-fluid" alt="">
                        </label>
                      </div>
                    </div>
                    <div class="col-6 col-lg-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="nama_bank" id="tunai" required value="Uang Tunai">
                        <label class="form-check-label" for="tunai">
                          <img src="asset/img/tunai.png" class="img-fluid" alt="">
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div style="margin-top: 100px;">
                  <div class="row justify-content-center gy-5" style="border-top: 1px solid #eaeaea;">
                    <div class="col-6 col-lg-6">
                      <span style="color: #000; font-weight: 600; font-size: 14px;">Total Donasi</span><br><br>
                      <span style="color: rgb(205, 133, 0); font-weight: 600; font-size: 20px;">Rp. <span id="teksTampil"></span></span>
                    </div>
                    <div class="col-6 col-lg-6">
                      <input type="submit" value="Proses Sekarang" class="btn btn-donatur">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Donatur -->



    <!-- Footer -->
    <section class="footer">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-12" style="text-align: center;">
            <span style="color: #fff; font-size: 14px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
              </svg> Data Pribadi Anda Aman
            </span><br>

            <span style="color: #fff; font-size: 13px;">
              Sistem Kami Dilindungi Oleh Badan Siber dan Sandi Negara
            </span>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <script>
      // Ambil semua radio button
      const radioButtons = document.querySelectorAll('input[name="pilihan"]');

      // Ambil input text
      const inputText = document.getElementById('hasilPilihan');

      const teksPilihan = document.getElementById('teksPilihan');

      const teksTampil = document.getElementById('teksTampil');


      inputText.addEventListener('input', function() {
          // Hapus semua karakter selain angka
          let nilai = this.value.replace(/[^0-9]/g, '');

          // Format nilai dengan titik sebagai pemisah ribuan
          // nilai = new Intl.NumberFormat('id-ID').format(nilai);

          // Set nilai yang sudah diformat kembali ke input
          this.value = nilai;

          teksTampil.textContent = this.value;
      });

      // Tambahkan event listener untuk setiap radio button
      radioButtons.forEach(radio => {
          radio.addEventListener('change', function() {
              // Isi input text dengan nilai radio button yang dipilih
              inputText.value = this.value;
              teksPilihan.textContent = this.value;
          });
      });
  </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>