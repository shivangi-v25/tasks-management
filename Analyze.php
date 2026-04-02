<?php 
include 'db.php';
session_start();

// Fetch task counts
$total = $conn->query("SELECT COUNT(*) as t FROM task")->fetch_assoc()['t'];
$pending = $conn->query("SELECT COUNT(*) as p FROM task WHERE status='pending'")->fetch_assoc()['p'];
$completed = $conn->query("SELECT COUNT(*) as c FROM task WHERE status='Completed'")->fetch_assoc()['c'];
$inprogress = $conn->query("SELECT COUNT(*) as i FROM task WHERE status='Inprogress'")->fetch_assoc()['i'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Task Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f4f9;
        }
        #brand {
            font-weight: 700;
            font-size: 28px;
            color: #ff4d6d;
        }
        .card-dashboard {
            border-radius: 15px;
            transition: transform 0.2s;
        }
        .card-dashboard:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .card-body i {
            font-size: 2.5rem;
        }
        .navbar-brand span {
            color: #ff4d6d;
        }
        footer {
            text-align: center;
            padding: 15px;
            color: #6c757d;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php" id="brand">TASKS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-info" href="Analyze.php">Analyze</a>
                </li>
            </ul>
            <div class="d-flex align-items-center ms-3">
                <span class="btn btn-outline-light me-2"><?= $_SESSION["name"] ?? "Guest" ?></span>
                <a href="register.php" class="btn btn-primary me-2">Register</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</nav>

<!-- Dashboard Cards -->
<div class="container my-5">
    <div class="row g-4">

        <!-- Total Tasks -->
        <div class="col-md-3 col-sm-6">
            <div class="card card-dashboard text-center text-white shadow" style="background: linear-gradient(45deg,#6a11cb,#2575fc);">
                <div class="card-body">
                    <i class="fa-solid fa-list-check"></i>
                    <h5 class="card-title mt-3">Total Tasks</h5>
                    <p class="card-text fs-2"><?= $total ?></p>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="col-md-3 col-sm-6">
            <div class="card card-dashboard text-center text-white shadow" style="background: linear-gradient(45deg,#43e97b,#38f9d7);">
                <div class="card-body">
                    <i class="fa-solid fa-circle-check"></i>
                    <h5 class="card-title mt-3">Completed</h5>
                    <p class="card-text fs-2"><?= $completed ?></p>
                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="col-md-3 col-sm-6">
            <div class="card card-dashboard text-center text-white shadow" style="background: linear-gradient(45deg,#f7971e,#ffd200);">
                <div class="card-body">
                    <i class="fa-solid fa-spinner"></i>
                    <h5 class="card-title mt-3">In Progress</h5>
                    <p class="card-text fs-2"><?= $inprogress ?></p>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="col-md-3 col-sm-6">
            <div class="card card-dashboard text-center text-white shadow" style="background: linear-gradient(45deg,#f00000,#dc281e);">
                <div class="card-body">
                    <i class="fa-solid fa-clock"></i>
                    <h5 class="card-title mt-3">Pending</h5>
                    <p class="card-text fs-2"><?= $pending ?></p>
                </div>
            </div>
        </div>

    </div>
</div>

<footer>
    &copy; <?= date("Y") ?> Task Manager. All rights reserved.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>