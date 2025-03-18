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



    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Login To Dashboard</title>
  </head>
  <body>



    <!-- Box Login -->
    <section class="box-login">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-6 reverse-login">
            <center>
              <img src="../asset/img/logo.jpg" width="100px" alt="">
            </center><br>

            <h2 style="color: #83af4f; font-weight: 600; text-align: center; font-size: 25px; text-transform: uppercase;">
              Log In Panel Adz-Dzikro Loa Janan
            </h2>

            <?php
            if (isset($_GET['error'])) {
                echo "<center><p style='color:red;'>Username atau password salah!</p></center>";
            }
            ?>


            <div class="row justify-content-center" style="margin-top: 40px;">
              <div class="col-lg-8">
                <form action="authenticate.php" method="post">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username" required>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                        <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                      </svg>
                    </span>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password" required>
                  </div>

                  <div class="input-group mb-3">
                    <input type="submit" value="Log In" class="btn btn-login">
                  </div>
                </form>
              </div>
            </div>


            <div class="row justify-content-center gy-5" style="margin-top: 50px;">
              <div class="col-lg-12" style="text-align: center;">
                <span style="color: #000; font-size: 13px;">
                  Developed By Idrus Bumi Tekno 
                  &copy; <script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Box Login -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="../asset/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>