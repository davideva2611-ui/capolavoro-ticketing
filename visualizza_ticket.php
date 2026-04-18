<?php
require_once("../includes/db.php");
require_once("../includes/auth.php");

richiedi_login();

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$tickets = leggi_csv(__DIR__ . "/../data/ticket.csv");
$ticket_trovato = null;

foreach ($tickets as $ticket) {
    if (intval($ticket[0]) === $id) {
        $ticket_trovato = $ticket;
        break;
    }
}

include("../includes/header.php");
?>

<h2>Dettagli Ticket</h2>

<?php if ($ticket_trovato === null): ?>
    <p>Ticket non trovato.</p>
<?php else: ?>

    <p><strong>ID:</strong> <?php echo htmlspecialchars($ticket_trovato[0]); ?></p>
    <p><strong>Titolo:</strong> <?php echo htmlspecialchars($ticket_trovato[1]); ?></p>
    <p><strong>Categoria:</strong> <?php echo htmlspecialchars($ticket_trovato[2]); ?></p>
    <p><strong>Priorità:</strong> <?php echo htmlspecialchars($ticket_trovato[3]); ?></p>
    <p><strong>Stato:</strong> <?php echo htmlspecialchars($ticket_trovato[4]); ?></p>
    <p><strong>Creato da:</strong> <?php echo htmlspecialchars($ticket_trovato[5]); ?></p>
    <p><strong>Data:</strong> <?php echo htmlspecialchars($ticket_trovato[6]); ?></p>

    <br>

    <a href="gestisci_ticket.php?id=<?php echo urlencode($ticket_trovato[0]); ?>">Gestisci Ticket</a>

<?php endif; ?>

<?php include("../includes/footer.php"); ?>