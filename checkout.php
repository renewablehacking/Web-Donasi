<?php 

session_start();
require 'apply-static/koneksi.php';

date_default_timezone_set('Asia/Makassar');


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="asset/style.css">
    <link rel="icon" href="asset/img/logo.jpg">



    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Donasi | Yayasan Adz-Dzikro Loa Janan</title>
  </head>
  <body>


    <?php 

    
    if (isset($_GET['TransactionIdentity'])) {
      $TransactionIdentity = $_GET['TransactionIdentity'];

      // Query untuk mengambil data berdasarkan TransactionIdentity dengan binding parameter
      $stmt = $pdo->prepare("SELECT * FROM donasi WHERE TransactionIdentity = :TransactionIdentity");
      $stmt->execute([':TransactionIdentity' => $TransactionIdentity]);

      // Ambil hasilnya
      $data = $stmt->fetch(PDO::FETCH_ASSOC);

      // Cek apakah data ditemukan
      if ($data) {

    ?>
    <!-- CheckOut -->
    <section class="checkout">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-6 runder">
            <h5 class="heading-checkout">Halo <?php echo htmlspecialchars($data['donatur']) ?></h5>
            <p class="check-paragraph">
              Terimakasih banyak untuk pemesanannya, data pemesanan <?php echo htmlspecialchars($data['donatur']) ?> sudah kami terima
            </p>


            <?php 

            // **Tampilkan Status Pembayaran**
            if ($data['status_approve'] === 'Y') {
                echo '<h5 style="color: green; font-weight: bold;">Sudah Dibayar!</h5>';
            } else {
                echo '<h5 style="color: red; font-weight: bold;">Belum Dibayar!</h5>';
            }
            
            ?>
            <h5 style="color: #000; font-size: 15px; font-weight: 600; margin-top: 30px;">Cek Pesanana Anda</h5>
            <br>
            <div class="boxer-under">
              <div class="row justify-content-center gy-5">
                <div class="col-6 col-lg-8">
                  <span style="font-weight: 500; color: #000; font-size: 14px;">Produk yang anda beli</span>
                </div>
                <div class="col-6 col-lg-4">
                  <span style="font-weight: 500; color: #000; font-size: 14px;">Biaya</span>
                </div>
              </div>
            </div>

            <div class="boxer-under2">
              <div class="row justify-content-center gy-5">
                <div class="col-6 col-lg-8">
                  <div class="row justify-content-center">
                    <div class="col-lg-4">
                      <img src="asset/img/banner.jpeg" width="50" alt="">
                    </div>
                    <div class="col-lg-8">
                      <span style="color: #000; font-size: 13px;">Invoice ID: <?php echo htmlspecialchars($data['id']) ?></span><br>
                      <span style="color: #000; font-size: 13px;">Pembebasan Lahan Yayasan Pendidikan Islam Adz-Dzikro Loa Janan</span>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-4">
                  <span style="color: #000; font-size: 14px;">Rp. <?= number_format($data['jumlah'] + $data['id'], 0, ',', '.') ?></span>
                </div>
              </div>
            </div>


            <div class="boxer-under">
              <div class="row justify-content-center gy-5">
                <div class="col-6 col-lg-8">
                  <span style="font-weight: 500; color: #000; font-size: 14px;">Total</span>
                </div>
                <div class="col-6 col-lg-4">
                  <span style="font-weight: 500; color: #000; font-size: 14px;">Rp. <?= number_format($data['jumlah'] + $data['id'], 0, ',', '.') ?></span>
                </div>
              </div>
            </div>



            <?php 
            $tenggat_js = strtotime($data['tenggat']) * 1000;
            ?>
            <div class="box-under3">
              <div class="row justify-content-center gy-5">
                <div class="col-lg-12 text-center">
                  <h5 style="color: #000; font-size: 15px; font-weight: 500;">Segera lakukan pembayaran dalam waktu</h5><br>
                  <span style="color: #000; font-size: 20px; font-weight: 600;" id="hours"></span><span> : </span>
                  <span style="color: #000; font-size: 20px; font-weight: 600;" id="minutes"></span><span> : </span>
                  <span style="color: #000; font-size: 20px; font-weight: 600;" id="seconds"></span><br>
                  <span style="color: #000; font-size: 14px; font-weight: 500;">Jam <span>:</span> </span>
                  <span style="color: #000; font-size: 14px; font-weight: 500;">Menit <span>:</span> </span>
                  <span style="color: #000; font-size: 14px; font-weight: 500;">Detik</span><br><br>
                  <?php 
                  // Set locale ke Bahasa Indonesia
                  setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesian', 'ID');
                  $datetime = new DateTime($data['tenggat']);
                  // Array untuk mengganti nama hari dan bulan ke Bahasa Indonesia
                  $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
                  'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
                  $bulan = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April',
                  'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus',
                  'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];

                  // Format waktu
                  $hari_ini = $hari[$datetime->format('l')]; // Konversi nama hari
                  $bulan_ini = $bulan[$datetime->format('F')]; // Konversi nama bulan
                  $formatted_time = "Sebelum $hari_ini, " . $datetime->format('d') . " $bulan_ini " . $datetime->format('Y H:i') . " WITA";
                  ?>
                  <h5 style="color: #000; font-size: 13px; font-weight: 300;">(<?php echo htmlspecialchars($formatted_time) ?>)</h5>
                </div>
              </div>
            </div>
            <script>
            // Ambil waktu tenggat dari PHP
            var deadline = <?php echo $tenggat_js; ?>;

            function updateCountdown() {
                var now = new Date().getTime(); // Waktu sekarang
                var timeLeft = deadline - now;  // Selisih waktu

                if (timeLeft > 0) {
                    var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    document.getElementById("hours").textContent = String(hours).padStart(2, '0');
                    document.getElementById("minutes").textContent = String(minutes).padStart(2, '0');
                    document.getElementById("seconds").textContent = String(seconds).padStart(2, '0');
                } else {
                    document.getElementById("hours").textContent = "00";
                    document.getElementById("minutes").textContent = "00";
                    document.getElementById("seconds").textContent = "00";
                    document.getElementById("hours").style.color = "gray";
                    document.getElementById("minutes").style.color = "gray";
                    document.getElementById("seconds").style.color = "gray";
                }
            }

            // Perbarui setiap detik
            setInterval(updateCountdown, 1000);
            updateCountdown(); // Jalankan pertama kali langsung
        </script>


            <div class="box-under4">
              <div class="row justify-content-center gy-5">
                <div class="col-lg-12">
                  <h5 style="color: #000; font-weight: 600; font-size: 15px;">Silahkan Transfer Ke</h5><br>
                </div>
              </div>
            </div>


            <script>
                  function copyText() {
                      var textToCopy = document.getElementById("textToCopy").innerText;

                      // Gunakan API Clipboard modern
                      navigator.clipboard.writeText(textToCopy).then(() => {
                          // Tampilkan notifikasi berhasil
                          var notif = document.getElementById("copyNotif2");
                          notif.style.display = "inline";
                          setTimeout(() => notif.style.display = "none", 2000); // Hilangkan setelah 2 detik
                      }).catch(err => {
                          console.error("Gagal menyalin teks: ", err);
                      });
                  }
              </script>
            <div class="boxer-under">
              <div class="row justify-content-center gy-5">
                <div class="col-4 col-lg-4">
                  <span style="color: #000; font-size: 14px;">Nomor Rekening</span>
                </div>
                <div class="col-4 col-lg-4">
                <?php 

                // Nomor Rekening / QRCode
                if ($data['bank'] === "Bank Syari'ah Indonesia") {
                    echo '<span style="font-weight: 500; color: #000; font-size: 14px;" id="textToCopy">7206760634</span>';
                }

                if ($data['bank'] === "Uang Tunai") {
                    echo '<span style="font-weight: 500; color: #000; font-size: 14px;" id="textToCopy">Jl. Manunggal GG.Arjuna RT.022 Loa Janan Ulu</span>';
                }
                
                ?>
                <span id="copyNotif2" style="display: none; color: green;">✅</span>
                </div>
                <div class="col-4 col-lg-4">
                  <span style="font-weight: 600; color: orange; font-size: 14px; cursor: pointer;" onclick="copyText()">Copy</span>
                </div>
              </div>
            </div>

            <div class="boxer-under2">
              <div class="row justify-content-center gy-5">
                <div class="col-4 col-lg-4">
                  <span style="color: #000; font-size: 14px;">Ke Bank</span>
                </div>

                <div class="col-4 col-lg-4">
                  <span style="color: #000; font-size: 14px; font-weight: 600;">
                  <?php 
                  if ($data['bank'] === "Bank Syari'ah Indonesia") {
                    echo "Bank Syari'ah Indonesia a.n Yayasan Pendidikan Islam Adz-Dzikro";
                  }

                  if ($data['bank'] === "Uang Tunai") {
                    echo "Uang Tunai Langsung Ke Alamat Tertera!";
                  }
                  ?>
                  </span>
                </div>

                <div class="col-4 col-lg-4">
                  <?php 
                  if ($data['bank'] === "Bank Syari'ah Indonesia") {
                    echo '<img src="asset/img/bsi.png" width="50" alt="">';
                  }

                  if ($data['bank'] === "Uang Tunai") {
                    echo '<img src="asset/img/tunai.png" width="50" alt="">';
                  }
                  ?>
                </div>
              </div>
            </div>

            <div class="boxer-under">
              <div class="row justify-content-center gy-5">
                <div class="col-4 col-lg-4">
                  <span style="color: #000; font-size: 14px;">Total Biaya</span>
                </div>
                <script>
                  function copyText2() {
                      var textToCopy2 = document.getElementById("textToCopy2").innerText;

                      // Gunakan API Clipboard modern
                      navigator.clipboard.writeText(textToCopy2).then(() => {
                          // Tampilkan notifikasi berhasil
                          var notif = document.getElementById("copyNotif");
                          notif.style.display = "inline";
                          setTimeout(() => notif.style.display = "none", 2000); // Hilangkan setelah 2 detik
                      }).catch(err => {
                          console.error("Gagal menyalin teks: ", err);
                      });
                  }
              </script>
                <div class="col-4 col-lg-4">
                  <span style="font-weight: 500; color: #000; font-size: 14px;" id="textToCopy2">Rp. 
                    <?php $formatted = number_format($data['jumlah'] + $data['id'], 0, ',', '.');
                    // Pisahkan 3 digit terakhir
                    $mainPart = substr($formatted, 0, -4); // Semua angka kecuali 3 digit terakhir
                    $lastThree = substr($formatted, -3); // 3 digit terakhir
                    echo $mainPart . '.<span style="color: orange; font-size: 14px; font-weight: 500;">' . $lastThree . '</span>'; ?></span>
                    <span id="copyNotif" style="display: none; color: green;">✅</span>
                </div>
                <div class="col-4 col-lg-4">
                  <span style="font-weight: 600; color: orange; font-size: 14px; cursor: pointer;" onclick="copyText2()">Copy</span>
                </div>
              </div>
            </div>

            <div class="box-under10">
              <div class="row justify-content-center gy-5">
                <div class="col-lg-12">
                  <p style="color: rgb(102, 43, 1); font-size: 12px; text-align: center;">
                    <b>Penting!</b> Mohon transfer sampai 3 digit terakhir yaitu <b>Rp. <?php echo $mainPart . '.<span style="color: rgb(255, 255, 255);">' . $lastThree . '</span>'; ?></b> Karena sistem kami tidak bisa mengenali pembayaran Anda bila jumlahnya tidak sesuai
                  </p>
                </div>
              </div>
            </div>



            <div class="box-under4">
              <div class="row justify-content-center gy-5">
                <div class="col-lg-12">
                  <h5 style="color: #000; font-weight: 600; font-size: 15px;">Catatan</h5><br>
                  <ul>
                    <li style="color: #000; font-size: 13px;">
                      Setelah melakukan konfirmasi pembayaran, verifikasi pesanan Anda akan kami proses dalam 60 menit dan selambat-lambatnya 1x24 jam.
                    </li><br>
                    <li style="color: #000; font-size: 13px;">
                      Pembayaran diatas jam 21.00 WIB akan di proses hari berikutnya.
                    </li><br>
                    <li style="color: #000; font-size: 13px;">
                      Data pembelian dan petunjuk pembayaran juga sudah kami kirim ke email Anda, silakan cek email dari kami di inbox, promotion, dan atau di folder Spam.
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="box-under11">
              <div class="row justify-content-center gy-5">
                <div class="col-lg-12">
                  <p style="color: #000; font-size: 14px;">
                    <b>Wajib:</b> Setelah melakukan transfer pembayaran, harap mengkonfirmasi pembayaran Anda melalui halaman ini:
                  </p>
                  <?php 
                  $donatur = htmlspecialchars($data['donatur']);
                  $hpwa = htmlspecialchars($data['hpwa']);
                  $invoice = htmlspecialchars($data['id']);
                  $jumlah = number_format($data['jumlah'] + $data['id'], 0, ',', '.');
                  $bank = htmlspecialchars($data['bank']);
                  $waktu_apply = htmlspecialchars($data['waktu_apply']);
                  $TransactionIdentity = htmlspecialchars($data['TransactionIdentity']);
                  // Format pesan WhatsApp
                  $pesan = "Assalamu'alaikum wr wb %0A"
                  . "Ketua/Jajaran Yayasan Pendidikan Adz-Dzikro Loa Janan %0A%0A"
                  . "Saya,%0A"
                  . "Donatur: $donatur %0A"
                  . "No. Hp: $hpwa %0A"
                  . "No. Invoice: $invoice %0A%0A"
                  . "Akan/Telah Berdonasi dengan%0A"
                  . "Jumlah: Rp. $jumlah %0A"
                  . "Ke Rekening: $bank %0A"
                  . "Waktu: $waktu_apply %0A%0A"
                  . "Transaction Identity: https://donasi-adzikro.idrusbumitekno.my.id/checkout.php?TransactionIdentity=$TransactionIdentity";

                  $pesan_encoded = urlencode($pesan);
                  $wa_link = "https://wa.me/6285238606473?text=$pesan_encoded";
                  ?>
                  <a href="https://wa.me/6285238606473?text=<?php echo $pesan; ?>" class="btn btn-green">Konfirmasi Pembayaran</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- CheckOut -->

    <?php 

    } else {
      echo "<p>Data tidak ditemukan.</p>";
    }
    } else {
    echo "<p>ID tidak valid.</p>";
    }
    
    ?>





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

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>