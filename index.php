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
                        <a href="#" class="nav-link menu-link" data-page="books">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Libros</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link menu-link" data-page="authors">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Autores</p>
                        </a>
                    </li>

                </ul>

            </div>

        </aside>

        <div class="content-wrapper p-3" id="contenido">

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

    <script>

        $(document).ready(function () {

            $("#contenido").load("views/books.php", function () {
                $.getScript("js/books.js")
            })

            $(".menu-link").click(function (e) {

                e.preventDefault()

                let page = $(this).data("page")

                $(".menu-link").removeClass("active")
                $(this).addClass("active")

                $("#contenido").load("views/" + page + ".php", function () {

                    if (page === "books") {
                        $.getScript("js/books.js")
                    }

                    if (page === "authors") {
                        $.getScript("js/authors.js")
                    }

                })

            })

        })

    </script>

</body>

</html>