<?php
include '../conn.php';

if (isset($_POST['tambah'])) {
    $namaCourse = htmlspecialchars($_POST['namaCourse']);
    $deskSingkat = htmlspecialchars($_POST['deskSingkat']);
    $emailMentor = htmlspecialchars($_POST['emailMentor']);

    // Check if the mentor email exists in the users table
    $checkMentor = "SELECT * FROM users WHERE email='$emailMentor' AND roles='mentor'";
    $resultMentor = mysqli_query($conn, $checkMentor);

    if (mysqli_num_rows($resultMentor) > 0) {
        // Insert course data into the course table
        $query = "INSERT INTO course (namaCourse, deskSingkat, emailMentor) VALUES ('$namaCourse', '$deskSingkat', '$emailMentor')";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Kursus Berhasil Ditambahkan');
                    document.location.href = 'admin-daftar-kursus.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Kursus Gagal Ditambahkan');
                    document.location.href = 'admin-tambah-kursus.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Email Mentor Tidak Ditemukan');
                document.location.href = 'admin-tambah-kursus.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            border: none;
            outline: none;
            box-sizing: border-box;
        }
        body {
            display: flex;
        }
        .sidebar {
            position: sticky;
            top: 0;
            left: 0;
            bottom: 0;
            width: 130px;
            height: 100vh;
            padding: 0 1.7rem;
            color: white;
            overflow: hidden;
            transition: all 0.5s linear;
            background: #2f73b8;
        }
        .sidebar:hover {
            width: 250px;
            transition: 0.5s;
        }
        .logo {
            height: 80px;
            padding: 16px;
        }
        .menu {
            height: 88%;
            position: relative;
            list-style: none;
            padding: 0;
        }
        .menu li {
            padding: 1rem;
            margin: 8px;
            border-radius: 8px;
            transition: all 0.5s ease-in-out;
        }
        .menu li:hover, .active {
            background: rgb(255, 255, 255);
        }
        .menu a {
            color: black;
            font-size: 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .menu a span {
            overflow: hidden;
        }
        .menu a i {
            font-size: 1.2rem;
        }
        .logout {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }
        .main--content {
            position: relative;
            background: rgb(255, 255, 255);
            width: 100%;
            padding: 1rem;
        }
        .header--wrapper img {
            width: 50px;
            height: 50px;
            cursor: pointer;
            border-radius: 50%;
        }
        .header--wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border-radius: 10px;
            padding: 10px 1rem;
            margin-bottom: 1rem;
        }
        .header--title {
            color: black;
        }
        .form--container {
            background: #2f73b8;
            border-radius: 10px;
            padding: 2rem;
        }
    </style>
    <title>Admin</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="admin-dashboard.php">
                    <i class="fas fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admin-kelola-mentor.php">
                    <i class="fas fa-user"></i>
                    <span>Mentor</span>
                </a>
            </li>
            <li class="active">
                <a href="admin-daftar-kursus.php">
                    <i class="fas fa-star"></i>
                    <span>Kursus</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fas fa-book"></i>
                    <span>Materi</span>
                </a>
            </li>
            <li class="logout">
                <a href="">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <h2>Tambah Kursus</h2>
            </div>
        </div>
        <div class="form--container">
            <h1 class="text-center pb-3">Form Tambah Kursus</h1>
            <form action="" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="namaCourse" placeholder="Nama Kursus" required>
                    <label for="floatingInput">Nama Kursus</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="floatingTextarea" name="deskSingkat" placeholder="Deskripsi Singkat" required></textarea>
                    <label for="floatingTextarea">Deskripsi Singkat</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" name="emailMentor" placeholder="Email Mentor" required>
                    <label for="floatingInput">Email Mentor</label>
                </div>
                <button type="submit" name="tambah" class="btn btn-success" style="float: right;">Tambah</button>
                <a href="admin-daftar-kursus.php" class="btn btn-success" style="float: left;">Kembali</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>