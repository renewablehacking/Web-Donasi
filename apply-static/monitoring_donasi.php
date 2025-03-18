<?php
// File: dashboard.php

require 'koneksi.php';

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../asset/dash.css">
    <link rel="icon" href="../asset/img/logo.jpg">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Viga&display=swap" rel="stylesheet">

    <title>Dasboard | Adz-Dzikro Loa Janan</title>
  </head>
  <body class="body-camouflage">

    <nav class="navbar navbar-expand-lg navbar-color bg-navbar">
      <div class="container">
        <a class="navbar-brand" href="dashboard.php">ADZ LJU</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
          </svg>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Monitoring
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="monitoring_donasi.php">Donasi Pembebasan Lahan</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>





    <!-- Ideal Box -->
    <section class="ideal-box" style="margin-top: 100px !important;">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-6">
            <h5 style="color: #000; font-weight: 600;">
              Approval Data Donatur
            </h5>
          </div>

          <div class="col-lg-6">
            <form>
              <div class="input-group mb-3">
                <input type="search" class="form-control" id="search" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-green" type="button" id="button-addon2">Search</button>
              </div>
            </form>
          </div>

          <div class="col-lg-12">
          <select class="form-select" id="entries" style="width: 100px;">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="-1">Semua</option>
          </select>

          </div>

          <div class="col-lg-12" style="overflow: auto;">
            <table class="table" id="dataTable">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">No Hp</th>
                  <th scope="col">Bank/E-Wallet</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Invoice ID</th>
                  <th scope="col">Times Tamp</th>
                  <th scope="col">Tenggat Waktu</th>
                  <th scope="col">Waktu Approve</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                // Query untuk mengambil data dari tabel users
                $stmt = $pdo->query('SELECT * FROM donasi ORDER BY id desc');
                $donasi = $stmt->fetchAll();
                $no=1;
                foreach ($donasi as $donasi):
                ?>
                <tr>
                  <th scope="row"><?= $no++ ?></th>
                  <td><?= htmlspecialchars($donasi['donatur']) ?></td>
                  <td><?= htmlspecialchars($donasi['hpwa']) ?></td>
                  <td><?= htmlspecialchars($donasi['bank']) ?></td>
                  <td>Rp. <?= number_format($donasi['jumlah'] + $donasi['id'], 0, ',', '.') ?></td>
                  <td>#<?= htmlspecialchars($donasi['id']) ?></td>
                  <td><?= htmlspecialchars($donasi['waktu_apply']) ?></td>
                  <td><?= htmlspecialchars($donasi['tenggat']) ?></td>
                  <td><?= htmlspecialchars($donasi['waktu_approve']) ?></td>
                  <td>

                  <?php if ($donasi['status_approve'] === 'T'): ?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $donasi['id'] ?>">
                      Approve
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop<?= $donasi['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Apakah Anda yakin untuk mengonfirmasi pembayaran ini?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="approve.php" method="post">
                              <input type="hidden" name="id" value="<?= $donasi['id'] ?>">
                              <button type="submit" class="btn btn-green">Approve</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <?php else: ?>
                            <span style="color: green;">Approved</span>
                        <?php endif; ?> | 
                        <form method="POST" action="delete_donasi.php">
                          <input type="hidden" name="id" value="<?= $donasi['id'] ?>">
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                  </td>
                </tr>
                <?php 
                endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- Ideal Box -->

    <!-- Optional JavaScript; choose one of the two! -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("search");
            const table = document.getElementById("dataTable");
            const rows = table.getElementsByTagName("tr");
            const entriesSelect = document.getElementById("entries");
            
            function filterTable() {
                const searchText = searchInput.value.toLowerCase();
                let visibleCount = 0;
                for (let i = 1; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName("td");
                    let rowVisible = false;
                    for (let j = 0; j < cells.length; j++) {
                        if (cells[j].textContent.toLowerCase().includes(searchText)) {
                            rowVisible = true;
                            break;
                        }
                    }
                    rows[i].style.display = rowVisible ? "" : "none";
                    if (rowVisible) visibleCount++;
                }
                updateEntries(visibleCount);
            }
            
            function updateEntries(visibleCount) {
                let maxEntries = parseInt(entriesSelect.value);
                let count = 0;
                for (let i = 1; i < rows.length; i++) {
                    if (rows[i].style.display !== "none") {
                        count++;
                        rows[i].style.display = count <= maxEntries || maxEntries === -1 ? "" : "none";
                    }
                }
            }
            
            searchInput.addEventListener("keyup", filterTable);
            entriesSelect.addEventListener("change", () => updateEntries(rows.length - 1));
        });
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="../asset/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>