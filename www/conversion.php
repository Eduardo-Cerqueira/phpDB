<?php
require 'src/db.php';

// Récupération des données du formulaire
$amount = $_POST['amount'];
$from_currency = $_POST['from_currency'];
$to_currency = $_POST['to_currency'];

// Récupération du taux de conversion
$rate = get_exchange_rate($from_currency, $to_currency);


// Début de la transaction
$conn->begin_transaction();

// Mise à jour de la devise d'origine
$stmt = $conn->prepare("UPDATE accounts SET balance = balance - ? WHERE currency = ?");
$stmt->bind_param("ds", $amount, $from_currency);
$stmt->execute();

// Vérification de la mise à jour réussie
if ($conn->affected_rows == 0) {
    $conn->rollback();
    die("Error: insufficient funds");
}

// Ajout de la devise cible
$converted_amount = $amount * $rate;
$stmt = $conn->prepare("UPDATE accounts SET balance = balance + ? WHERE currency = ?");
$stmt->bind_param("ds", $converted_amount, $to_currency);
$stmt->execute();

// Commit de la transaction
$conn->commit();

$conn->close();

function get_exchange_rate($from, $to) {
    // Récupération du taux de conversion depuis une API externe ou une source de données
    return 0.5;
}
