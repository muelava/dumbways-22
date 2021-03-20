<?php

$conn = mysqli_connect("localhost", "root", "", "dumbways22");

$author = mysqli_query($conn, "SELECT *FROM author");
$course = mysqli_query($conn, "SELECT *FROM course");
$content = mysqli_query($conn, "SELECT *FROM content");

// $ = mysqli_fetch_assoc($course);




// add author;
if (isset($_POST["addAuthor"])) {

    $nama = $_POST["nama"];

    $query = "INSERT INTO author VALUES ('','$nama')";
    $result = mysqli_query($conn, $query);
    echo "<script>alert('Successfull Add Author'); document.location.href = 'B.php'</script>";

    return mysqli_affected_rows($conn);
}


// add content
if (isset($_POST["addContent"])) {

    $name = $_POST["name"];
    $videoLink = $_POST["videoLink"];
    $type = $_POST["type"];
    $idCourse = $_POST["idCourse"];

    $query = "INSERT INTO content VALUES ('','$name','$videoLink','$type','$idCourse')";
    $result = mysqli_query($conn, $query);
    echo "<script>alert('Successfull Post Content'); document.location.href = 'B.php'</script>";

    return mysqli_affected_rows($conn);
}


// add course
if (isset($_POST["addCourse"])) {

    $name = $_POST["name"];
    $thumbnail = $_POST["thumbnail"];
    $idAuthor = $_POST["idAuthor"];
    $duration = $_POST["duration"];
    $description = $_POST["description"];

    $query = "INSERT INTO course VALUES ('','$name','$thumbnail','$idAuthor','$duration','$description')";
    $result = mysqli_query($conn, $query);
    echo "<script>alert('Succesfull post Course!'); document.location.href = 'B.php'</script>";

    return mysqli_affected_rows($conn);
}



?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Dumbways Batch 22</title>
</head>

<body>

    <div class="container sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand  text-danger fw-bold" href="#">DUMBWASY-COURSE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="#addCourse">Add Course</a>
                        <a class="nav-link" href="#addAuthor">Add Author</a>
                        <a class="nav-link" href="#addContent">Add Content</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- container -->
    <div class="container mt-5">
        <div class="row g-0">
            <?php foreach ($course as $crs) :

                $id = $crs['id_author'];
                $author2 = mysqli_query($conn, " SELECT *FROM author WHERE id = '$id'");
                foreach ($author2 as $aut) :
            ?>
                    <div class="card bg-secondary m-2" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-item-center">
                                <h5 class="card-title"><?= $crs['name']; ?></h5>
                                <p class="card-text">Author : <?= $aut["nama"]; ?></p>
                            </div>
                            <p class="card-title"><?= $crs['description']; ?></p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary text-center">Detail</a>
                            </div>
                        </div>
                    </div>
            <?php endforeach;
            endforeach; ?>
        </div>
    </div>



    <div class="container mt-5">
        <h2 id="addAuthor">Add Author</h2>
        <form action="" method="POST" class="w-50 m-auto">
            <div class="mb-3">
                <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" required>
            </div>

            <button type="submit" class="btn btn-primary" name="addAuthor">Submit</button>
        </form>

        <h2 id="addContent">Add Content</h2>
        <form action="" method="POST" class="w-50 m-auto">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Nama" name="name" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Video Link" name="videoLink" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Type" name="type" required>
            </div>

            <input type="hidden" class="form-control" name="idCourse" value="2">

            <button type="submit" class="btn btn-primary" name="addContent">Submit</button>
        </form>

        <h2 id="addCourse">Add Course</h2>
        <form action="" method="POST" class="w-50 m-auto">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Nama" name="name" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Thumbnail" name="thumbnail" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Duration" name="duration" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Description" name="description" required>
            </div>

            <input type="hidden" class="form-control" name="idAuthor" value="1">

            <button type="submit" class="btn btn-primary" name="addCourse">Submit</button>
        </form>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("a").on('click', function(event) {

                if (this.hash !== "") {
                    event.preventDefault();

                    var hash = this.hash;

                    $('html, body').animate({
                        scrollTop: $(hash).offset().top - 50,
                    }, 800, function() {

                        window.location.hash = hash;
                    });
                }
            });
        });
    </script>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</body>

</html>