<?php
// contact.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam    = trim($_POST['naam'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $bericht = trim($_POST['bericht'] ?? '');

    if (!$naam || !$email || !$bericht || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo 'Ongeldige invoer.';
        exit;
    }

    // E-mail sturen
    $to = 'overvloed.bouw@gmail.com';
    $subject = 'Nieuw contactformulier bericht';
    $message = "Naam: $naam\nE-mail: $email\nBericht:\n$bericht";
    $headers = "From: $email\r\nReply-To: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo 'Bericht succesvol verzonden!';
    } else {
        http_response_code(500);
        echo 'E-mail kon niet worden verzonden.';
    }
} else {
    http_response_code(405);
    echo 'Alleen POST toegestaan.';
}
?>
