<?php
$page = $_GET["page"] ?? "books";
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Biblioteca Digital</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <nav class="main-header navbar navbar-dark bg-dark">

            <a class="nav-link" data-widget="pushmenu"><i class="fas fa-bars"></i></a>

        </nav>

        <aside class="main-sidebar sidebar-dark-primary">

            <a class="brand-link text-center">Biblioteca</a>

            <div class="sidebar">

                <ul class="nav nav-pills nav-sidebar flex-column">

                    <li class="nav-item">
                        <a href="index.php?page=books" class="nav-link <?php if ($page == "books")
                            echo 'active'; ?>">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Libros</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?page=authors" class="nav-link <?php if ($page == "authors")
                            echo 'active'; ?>">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Autores</p>
                        </a>
                    </li>

                </ul>

            </div>

        </aside>

        <div class="content-wrapper p-3">

            <?php

            if ($page == "books")
                include "views/books.php";
            if ($page == "authors")
                include "views/authors.php";

            ?>

        </div>

    </div>

    <!-- JQUERY  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ADMIN LTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <?php if ($page == "books") { ?>
        <script src="js/books.js"></script>
    <?php } ?>

    <?php if ($page == "authors") { ?>
        <script src="js/authors.js"></script>
    <?php } ?>


</body>

</html>