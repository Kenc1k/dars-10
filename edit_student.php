<?php
include "db.php";
include "students.php";

$db = new database();
$product = new students($db->getConnection());

if(isset($_POST['back'])){
    header('location:index.php');  
}
if (isset($_GET['id'])) {
    $product->id = $_GET['id'];
    $student = $product->getById(); 
} else {
    header("Location: index.php"); 
}

if (isset($_POST['update'])) {
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
        $product->image = $student['image']; 
    }

    $product->update(); 
    header("Location: index.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="text-center">Edit Student</h2>
    <form action="edit_student.php?id=<?= $student['id'] ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="familiya" class="form-control" placeholder="Familiya" value="<?= $student['familiya'] ?>" required>
        <input type="text" name="ism" class="form-control" placeholder="Ism" value="<?= $student['ism'] ?>" required>
        <input type="text" name="manzil" class="form-control" placeholder="Manzil" value="<?= $student['manzil'] ?>" required>
        <input type="file" name="image" class="form-control">
        <input type="submit" name="update" class="btn btn-primary" value="Update">
        <input type="submit" name="back" class="btn btn-secondary" value="back">
    </form>
</div>

</body>
</html>
