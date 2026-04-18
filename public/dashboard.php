<?php
require_once("../includes/db.php");
require_once("../includes/auth.php");

richiedi_login();

$tickets = leggi_csv(__DIR__ . "/../data/ticket.csv");

include("../includes/header.php");
?>

<h2>Dashboard</h2>

<p>Elenco Ticket</p>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Titolo</th>
        <th>Categoria</th>
        <th>Priorità</th>
        <th>Stato</th>
        <th>Azioni</th>
    </tr>

    <?php foreach ($tickets as $ticket): ?>
        <tr>
            <td><?php echo htmlspecialchars($ticket[0]); ?></td>
            <td><?php echo htmlspecialchars($ticket[1]); ?></td>
            <td><?php echo htmlspecialchars($ticket[2]); ?></td>
            <td><?php echo htmlspecialchars($ticket[3]); ?></td>
            <td><?php echo htmlspecialchars($ticket[4]); ?></td>
            <td>
                <a href="visualizza_ticket.php?id=<?php echo urlencode($ticket[0]); ?>">Apri</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include("../includes/footer.php"); ?>