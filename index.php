<?php 
include 'db.php';
session_start();

// Fetch tasks based on filter
if (isset($_GET['status']) && $_GET['status'] != "") {
    $status = $_GET['status'];
    $stmt = $conn->prepare("SELECT * FROM task WHERE status=?");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM task");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $name=$_POST["name"];
    $desc=$_POST["desc"];
    $status=$_POST["status"];
    $sdate=$_POST["sdate"];

    $sql=$conn->prepare("INSERT INTO task(name,description,status,sdate) VALUES(?,?,?,?)");
    $sql->bind_param("ssss",$name,$desc,$status,$sdate);
    $sql->execute();
    header("location:index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Task Manager</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <style>
        body {
            background-color: #f8f9fa;
        }
        #brand {
            font-weight: 700;
            font-size: 28px;
            color: #ff4d6d;
        }
        .task-card {
            transition: transform 0.2s;
        }
        .task-card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .status-badge {
            font-weight: bold;
            font-size: 0.9rem;
        }
        .navbar-brand span {
            color: #ff4d6d;
        }
        .filter-checkbox label {
            cursor: pointer;
            user-select: none;
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
                <span class="btn btn-outline-light me-2"><?php echo $_SESSION["name"] ?? "Guest"; ?></span>
                <a href="register.php" class="btn btn-primary me-2">Register</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</nav>

<!-- Main Container -->
<div class="container my-4">

    <!-- Add Task Form -->
    <div class="card shadow mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Task</h5>
        </div>
        <div class="card-body">
            <form action="" method="post" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Task Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" required>
                        <option selected disabled>Select one</option>
                        <option value="pending">Pending</option>
                        <option value="Inprogress">Inprogress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="desc" rows="3" required></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="sdate" required>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success">Add Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Filter Checkboxes -->
    <div class="mb-4">
        <h5 class="text-secondary">Filter by Status</h5>
        <form method="GET" class="filter-checkbox d-flex gap-3">
            <label>
                <input type="checkbox" name="status" value="pending" onchange="this.form.submit()"
                    <?= (isset($_GET['status']) && $_GET['status']=="pending") ? "checked" : "" ?>> Pending
            </label>
            <label>
                <input type="checkbox" name="status" value="Inprogress" onchange="this.form.submit()"
                    <?= (isset($_GET['status']) && $_GET['status']=="Inprogress") ? "checked" : "" ?>> Inprogress
            </label>
            <label>
                <input type="checkbox" name="status" value="Completed" onchange="this.form.submit()"
                    <?= (isset($_GET['status']) && $_GET['status']=="Completed") ? "checked" : "" ?>> Completed
            </label>
        </form>
    </div>

    <!-- Task Cards -->
    <div class="row g-4">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-md-4 col-sm-6">
                <div class="card task-card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['name'] ?></h5>
                        <p class="card-text"><?= $row['description'] ?></p>
                        <span class="badge 
                            <?= $row['status']=='Completed'?'bg-success':
                               ($row['status']=='Inprogress'?'bg-warning text-dark':'bg-danger') ?>
                        status-badge"><?= $row['status'] ?></span>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted"><?= date("d M, Y", strtotime($row['sdate'])) ?></small>
                        <div>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<footer>
    &copy; <?= date("Y") ?> Task Manager. All rights reserved.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>