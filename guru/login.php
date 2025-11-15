<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- boxicons v2.1.4 -->
    <link rel="stylesheet" href="../lib/boxicons/css/boxicons.min.css">

    <!-- css -->
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/keyframes.css">

    <title>Login</title>
</head>

<body>
    <section class="card-container">
        <div class="overlay-side">
            <div class="sidetext">
                <h1>Selamat Datang di SRINFO!</h1>
                <p>Akses Sistem Informasi Sekolah</p>
                <a href="../index.php" class="btn-back">Kembali</a>
            </div>
        </div>

        <!-- form part -->
        <div class="form-part">

            <div class="sign-card">
                <div class="head">
                    <h1>Login !</h1>
                    <p>"Akses sistem informasi sekolah sesuai dengan kebutuhan Anda."</p>
                </div>

                <div class="logo-img">
                    <img src="../assets/logo-ssri.png" alt="">
                </div>
            </div>

            <!-- form -->
            <form id="registerForm" action="proses-login.php" method="post">

                <div class="input-group">
                    <label>
                        <i class='bx bxs-user'></i>
                        <h2>Username</h2>
                    </label>

                    <input type="text" id="name" placeholder="Masukkan Username Anda !" name="username" required>
                </div>

                <div class="input-group">
                    <label>
                        <i class='bx bxs-key'></i>
                        <h2>Password</h2>
                    </label>

                    <input type="password" id="password" placeholder="Masukkan Password Anda !" name="password" required>
                </div>

                <button type="submit">Login</button>

            </form>

        </div>
    </section>

    <!-- popup-custom -->

    <section class="popup false" id="false">
        <div class="popup-container">
            <div>
                <i class='bx bxs-error'></i>
            </div>
            <div class="ket">
                <h1>Login Gagal!</h1>
                <p>Cek Username atau Password Anda!</p>
                <a href="login.php">Oke</a>
            </div>
        </div>
    </section>


    <!-- <script src="js/login.js"></script> -->
    <script src="../js/switchMode.js"></script>
</body>

</html>