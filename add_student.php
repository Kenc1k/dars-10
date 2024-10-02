<?php

include "db.php";      
include "students.php"; 

if(isset($_POST['back'])){
    header('location: index.php');
}
$db = new database();
$product = new students($db->getConnection());

if (isset($_POST['ok'])) {
    $product->familiya = $_POST['familiya'];
    $product->ism = $_POST['ism'];
    $product->manzil = $_POST['manzil'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/"; 

        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        $newFileName = time() . '.' . $imageFileType;
        $target_file = $target_dir . $newFileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $product->image = $target_file; 
        } else {
            echo "<div class='alert alert-danger'>Error uploading file.</div>";
        }
    } else {
        $product->image = "";
    }

    $result = $product->getCount();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .form-control {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Add Student</h2>
    <form action="add_student.php" method="post" enctype="multipart/form-data">
        <input type="text" name="familiya" class="form-control" placeholder="Familiya">
        <input type="text" name="ism" class="form-control" placeholder="Ism" >
        <input type="text" name="manzil" class="form-control" placeholder="Manzil" >
        <input type="file" name="image" class="form-control" >
        <input type="submit" name="ok" class="btn btn-primary" value="Saqlash">
        <input type="submit" name="back" class="btn btn-secondary" value="Back">
    </form>
</div>

</body>
</html>
