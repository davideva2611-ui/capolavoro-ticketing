<?php
// header.php
// Intestazione HTML comune

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Sistema Ticketing</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<header>
    <h1>Sistema di Gestione Ticket</h1>

    <?php if (isset($_SESSION["username"]) === true): ?>
        <p>Utente: <?php echo htmlspecialchars($_SESSION["username"]); ?> (<?php echo htmlspecialchars($_SESSION["ruolo"]); ?>)</p>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="nuovo_ticket.php">Nuovo Ticket</a>
            <a href="logout.php">Logout</a>
        </nav>
    <?php endif; ?>
</header>

<hr>