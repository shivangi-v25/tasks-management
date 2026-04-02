<?php 
include 'db.php';
session_start();


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = $conn->prepare("select * from task where id=?");
    $result->bind_param("i", $id);
    $result->execute();
    $res = $result->get_result()->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $status = $_POST["status"];
    $sdate = $_POST["sdate"];

    
    $sql = $conn->prepare("update task set name=?, description=?, status=?, sdate=? where id=?");
    $sql->bind_param("ssssi", $name, $desc, $status, $sdate, $id);
    
    if ($sql->execute()) {
        header("location:index.php");
    } else {
        header("location:edit.php");
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Edit Task</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        
        <style>
            body {
                background-color: #f8f9fa;
                font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            }
            .navbar {
                background: #212529 !important;
            }
            .edit-card {
                max-width: 500px;
                margin: 50px auto;
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border: none;
            }
            .form-label {
                font-weight: 600;
                color: #495057;
            }
            .form-control:focus, .form-select:focus {
                border-color: #198754;
                box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
            }
            .btn-update {
                font-weight: 600;
                padding: 10px 20px;
                border-radius: 8px;
                transition: transform 0.2s;
            }
            .btn-update:active {
                transform: scale(0.98);
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark shadow">
                <div class="container">
                    <a class="navbar-brand fw-bold" href="index.php">TASKS</a>
                    <div class="collapse navbar-collapse" id="navmenu">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link text-info" href="Analyze.php">Analyze</a>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center ms-3">
                            <span class="btn btn-outline-light btn-sm me-2"><?php echo $_SESSION["name"] ?? "Guest"; ?></span>
                            <a href="register.php" class="btn btn-primary btn-sm me-2">Register</a>
                            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="container">
            <div class="edit-card p-4 p-md-5">
                <form action="" method="post">
                    <h4 class="text-dark mb-4 text-center fw-bold border-bottom pb-3">Edit Task Details</h4>
                    
                    <div class="mb-3">
                        <label class="form-label">Task Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            value="<?= $res["name"] ?? '' ?>"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="desc" rows="3"><?= $res["description"] ?? '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option selected><?= $res["status"] ?? 'Select Status' ?></option>
                            <option value="pending">pending</option>
                            <option value="Inprogress">Inprogress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Date</label>
                        <input
                            type="date"
                            class="form-control"
                            name="sdate"
                            value="<?= $res["sdate"] ?? '' ?>"
                        />
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-update">Update Task</button>
                        <a href="index.php" class="btn btn-link text-muted mt-2 text-decoration-none text-center small">Cancel </a>
                    </div>
                </form>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    </body>
</html>