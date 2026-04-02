
<?php 
include 'db.php';
session_start();

if (isset($_GET["id"])) {
  $id=$_GET["id"];
$result=$conn->prepare("select * from task where id=?");
$result->bind_param("i",$id);
$result->execute();
$res=$result->get_result()->fetch_assoc();

}


if ($_SERVER["REQUEST_METHOD"]==="POST") {
    
$name=$_POST["name"];
$desc=$_POST["desc"];
$status=$_POST["status"];
$sdate=$_POST["sdate"];

$sql=$conn->prepare("insert into task(name,description,status,sdate) values(?,?,?,?)");
$sql->bind_param("ssss",$name,$desc,$status,$sdate);
if ($sql->execute()) {
  header("location:index.php");
}
else{
    header("location:edit.php");
}

}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
          <nav
            class="navbar navbar-expand-sm navbar-light bg-secondary"
          >
            <div class="container">
                <a class="navbar-brand text-light " href="#">Task</a>
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                   
                  
                    </ul>
                    <form class="d-flex my-2 my-lg-0" action="logout.php">
                    <a
                        name=""
                        id=""
                        class="btn btn-primary"
                        href="register.php"
                        role="button"
                        >Register</a
                    >
                    
                        <button
                            class="btn btn-danger my-2 my-sm-0 ms-3"
                            type="submit"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>
          </nav>
          
        </header>
        <main>

<div
    class="container my-2 bg-secondary p-3 col-4"
>
 <form action="" method="post">
<div class="mb-3 my-2">
    <label for="" class="form-label">Name</label>
    <input
        type="text"
        class="form-control"
        name="name"
        id=""
        aria-describedby="helpId"
        placeholder=""
        value="<?=$res["name"]?>"
    />
</div>


<div class="mb-3">
    <label for="" class="form-label">Description</label>
    <textarea class="form-control" name="desc" id="" rows="3"><?=$res["description"]?></textarea>
</div>

<div class="mb-3">
    <label for="" class="form-label">Status</label>
    <select
        class="form-select form-select-lg"
        name="status"
        id=""
    >
        <option selected><?=$res["status"]?></option>
        <option value="pending">pending</option>
        <option value="Inprogress">Inprogress</option>
        <option value="Completed">Completed</option>
    </select>
</div>

<div class="mb-3">
    <label for="" class="form-label">Date</label>
    <input
        type="date"
        class="form-control"
        name="sdate"
        id=""
        aria-describedby="helpId"
        placeholder=""
        value="<?=$res["sdate"]?>"
    />
    
</div>
<div
    class="container text-center"
>
    <button type="submit" class="btn btn-success btn-sm">update</button>
</div>

 </form>
</div>



        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
