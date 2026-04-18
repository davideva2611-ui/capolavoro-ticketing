<?php
// auth.php
// Gestione autenticazione e sessioni

session_start();

function login($username, $password)
{
    $utenti = leggi_csv(__DIR__ . "/../data/utenti.csv");

    foreach ($utenti as $utente) {
        $user = $utente[0];
        $pass = $utente[1];
        $ruolo = $utente[2];

        if ($username === $user && password_verify($password, $pass) === true) {
            $_SESSION["username"] = $username;
            $_SESSION["ruolo"] = $ruolo;
            return true;
        }
    }

    return false;
}

function logout()
{
    session_unset();
    session_destroy();
}

function utente_loggato()
{
    if (isset($_SESSION["username"]) === true) {
        return true;
    }

    return false;
}

function ruolo_utente()
{
    if (isset($_SESSION["ruolo"]) === true) {
        return $_SESSION["ruolo"];
    }

    return null;
}

function richiedi_login()
{
    if (utente_loggato() === false) {
        header("Location: login.php");
        exit();
    }
}
?>