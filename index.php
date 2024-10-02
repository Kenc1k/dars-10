<?php

include "db.php";
include "students.php";

$db = new database();
$product = new students($db->getConnection());

$limit = 5; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch paginated students
$products = $product->getPaginated($limit, $offset);
$total_records = $product->getCount();
$total_pages = ceil($total_records / $limit);

// Handle delete request
if (isset($_GET['delete_id'])) {
    $product->delete($_GET['delete_id']);
    header("Location: index.php?page=" . $page); // Redirect back to the current page
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container-md">
        <a class="navbar-brand" href="add_student.php">Add student</a>
    </div>
</nav>

<table class="table table-bordered" width="80%" align="center">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Familiya</th>
            <th>Ism</th>
            <th>Manzil</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($products as $product) { ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['familiya'] ?></td>
                    <td><?= $product['ism'] ?></td>
                    <td><?= $product['manzil'] ?></td>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?= $product['image'] ?>" alt="Student Image" style="width:100px; height:auto;">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?delete_id=<?= $product['id'] ?>&page=<?= $page ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
           <?php }
        ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
