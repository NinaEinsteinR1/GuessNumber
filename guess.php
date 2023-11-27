<?php
session_start();

// Check if a new game needs to be started
if (!isset($_SESSION['number'])) {
    $_SESSION['number'] = rand(1, 10); // Génère un nombre entre 1 et 10
    $_SESSION['attempts'] = 0;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guess = (int) $_POST['guess'];
    $_SESSION['attempts']++;

    if ($guess === $_SESSION['number']) {
        $message = "Bravo ! Vous avez deviné le nombre en " . $_SESSION['attempts'] . " tentatives.";
        unset($_SESSION['number']); // Start a new game next request
    } else if ($guess < $_SESSION['number']) {
        $message = "Le nombre est plus grand. Essayez encore.";
    } else {
        $message = "Le nombre est plus petit. Essayez encore.";
    }
}

include 'index.html';
?>
