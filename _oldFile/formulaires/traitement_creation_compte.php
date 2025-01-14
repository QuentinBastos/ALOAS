<?php

    require_once "../include/pdo.php";

    $username = $_POST["ID"];

    $password = $_POST["mdp"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO Admin (ID, MotDePasse) VALUES (?, ?)");

    $stmt->bindParam(1, $username);

    $stmt->bindParam(2, $hashedPassword);

    $stmt->execute();

    header("location: /index");
