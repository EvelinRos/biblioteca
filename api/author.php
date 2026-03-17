<?php

require_once "../config/database.php";

header("Content-Type: application/json");

$action = $_GET["action"] ?? "";

switch ($action) {

    case "list":

        $stmt = $myPDO->query("
            SELECT id_author, name_author 
            FROM author 
            ORDER BY name_author ASC
        ");

        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;


    case "create":

        $id = $_POST["id_author"] ?? "";
        $name = $_POST["name_author"] ?? "";

        if ($id == "" || $name == "") {
            echo json_encode([
                "status" => "error",
                "message" => "Datos incompletos"
            ]);
            exit;
        }

        $stmt = $myPDO->prepare("
            SELECT COUNT(*) 
            FROM author 
            WHERE id_author=?
        ");
        $stmt->execute([$id]);

        if ($stmt->fetchColumn() > 0) {

            echo json_encode([
                "status" => "error",
                "message" => "El ID del autor ya existe"
            ]);
            exit;
        }

        $stmt = $myPDO->prepare("
            INSERT INTO author(id_author,name_author)
            VALUES(?,?)
        ");

        $stmt->execute([$id, $name]);

        echo json_encode(["status" => "success"]);
        exit;


    case "update":

        $id = $_POST["id_author"] ?? "";
        $name = $_POST["name_author"] ?? "";

        $stmt = $myPDO->prepare("
            UPDATE author
            SET name_author=?
            WHERE id_author=?
        ");

        $stmt->execute([$name, $id]);

        echo json_encode(["status" => "success"]);
        exit;


    case "delete":

        try {

            $id = $_POST["id_author"] ?? "";

            $stmt = $myPDO->prepare("
            SELECT COUNT(*) 
            FROM book 
            WHERE id_author=?
        ");
            $stmt->execute([$id]);

            if ($stmt->fetchColumn() > 0) {

                echo json_encode([
                    "status" => "error",
                    "message" => "El autor tiene libros asociados."
                ]);
                exit;

            } else {

                $stmt = $myPDO->prepare("
                DELETE FROM author 
                WHERE id_author=?
            ");
                $stmt->execute([$id]);

                echo json_encode([
                    "status" => "success"
                ]);
            }

        } catch (Exception $e) {

            echo json_encode([
                "status" => "error",
                "message" => "Error al eliminar el autor."
            ]);
        }

        exit;
}