

<?php 
include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    
$name=$_POST["name"];
$pass=$_POST["pass"];
$sql=$conn->prepare("select password from register where username=?");
$sql->bind_param("s",$name);
$sql->execute();
$sql->store_result();
$sql->bind_result($cpass);
if ($sql->fetch()&&password_verify($pass,$cpass)) {
  $_SESSION["name"]=$name;
  header("location:index.php");
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
            <!-- place navbar here -->
        </header>
        <main>


<div
    class="container my-2 bg-secondary p-3 col-4"
>
 <form action="" method="post" class="border border-2 p-2">

 <h3 class="text-center text-light">Login</h3>
<div class="mb-3 my-2">
    <label for="" class="form-label">Username</label>
    <input
        type="text"
        class="form-control"
        name="name"
        id=""
        aria-describedby="helpId"
        placeholder=""
        
    />
</div>

<div class="mb-3 my-2">
    <label for="" class="form-label">Password</label>
    <input
        type="text"
        class="form-control"
        name="pass"
        id=""
        aria-describedby="helpId"
        placeholder=""
        
    />
</div>
<div
    class="container text-center"
>
    <button type="submit" class="btn btn-success btn-sm">Login</button>
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
