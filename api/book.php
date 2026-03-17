<?php

require_once "../config/database.php";

header("Content-Type: application/json");

$action = $_GET["action"] ?? "";

switch ($action) {

    case "list":

        $sql = "
            SELECT 
                b.id_book,
                b.title,
                b.id_author,
                a.name_author, 
                b.isbn
            FROM book b
            LEFT JOIN author a 
                ON b.id_author = a.id_author
            ORDER BY b.title ASC
        ";

        $stmt = $myPDO->query($sql);

        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;


    case "create":

        $id = $_POST["id_book"] ?? "";
        $title = $_POST["title"] ?? "";
        $author = $_POST["id_author"] ?? "";
        $isbn = $_POST["isbn"] ?? "";

        if ($id == "" || $title == "" || $author == "" || $isbn == "") {
            echo json_encode([
                "status" => "error",
                "message" => "Datos incompletos."
            ]);
            exit;
        }

        $stmt = $myPDO->prepare("
            SELECT COUNT(*) 
            FROM book 
            WHERE id_book=?
        ");
        $stmt->execute([$id]);

        if ($stmt->fetchColumn() > 0) {

            echo json_encode([
                "status" => "error",
                "message" => "El ID del libro ya existe."
            ]);
            exit;
        }

        $stmt = $myPDO->prepare("
            INSERT INTO book(id_book,title,id_author,isbn)
            VALUES(?,?,?,?)
        ");

        $stmt->execute([$id, $title, $author, $isbn]);

        echo json_encode(["status" => "success"]);
        exit;


    case "update":

        $id = $_POST["id_book"] ?? "";
        $title = $_POST["title"] ?? "";
        $author = $_POST["id_author"] ?? "";
        $isbn = $_POST["isbn"] ?? "";

        $stmt = $myPDO->prepare("
        UPDATE book
        SET title=?, id_author=?, isbn=?
        WHERE id_book=?
        ");

        $stmt->execute([$title, $author, $isbn, $id]);

        echo json_encode(["status" => "success"]);

        exit;


    case "delete":

        try {

            $id = $_POST["id_book"] ?? "";

            $stmt = $myPDO->prepare("
            DELETE FROM book
            WHERE id_book=?
        ");

            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {

                echo json_encode([
                    "status" => "success"
                ]);

            } else {

                echo json_encode([
                    "status" => "error",
                    "message" => "Libro no encontrado."
                ]);

            }

        } catch (PDOException $e) {

            echo json_encode([
                "status" => "error",
                "message" => "Error al eliminar: " . $e->getMessage()
            ]);

        }

        exit;
}