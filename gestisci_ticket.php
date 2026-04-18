<?php
require_once("../includes/db.php");
require_once("../includes/auth.php");

richiedi_login();

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$tickets = leggi_csv(__DIR__ . "/../data/ticket.csv");
$ticket_trovato = null;
$indice = -1;

foreach ($tickets as $i => $ticket) {
    if (intval($ticket[0]) === $id) {
        $ticket_trovato = $ticket;
        $indice = $i;
        break;
    }
}

$messaggio = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && $ticket_trovato !== null) {
    $nuovo_stato = trim($_POST["stato"]);

    $tickets[$indice][4] = $nuovo_stato;

    scrivi_csv(__DIR__ . "/../data/ticket.csv", $tickets);

    $messaggio = "Stato aggiornato con successo.";
}

include("../includes/header.php");
?>

<h2>Gestisci Ticket</h2>

<?php if ($ticket_trovato === null): ?>
    <p>Ticket non trovato.</p>
<?php else: ?>

    <?php if ($messaggio !== ""): ?>
        <p><?php echo htmlspecialchars($messaggio); ?></p>
    <?php endif; ?>

    <p><strong>ID:</strong> <?php echo htmlspecialchars($ticket_trovato[0]); ?></p>
    <p><strong>Titolo:</strong> <?php echo htmlspecialchars($ticket_trovato[1]); ?></p>
    <p><strong>Stato attuale:</strong> <?php echo htmlspecialchars($ticket_trovato[4]); ?></p>

    <form method="post" action="gestisci_ticket.php?id=<?php echo urlencode($ticket_trovato[0]); ?>">
        <label>Nuovo stato:</label><br>
        <select name="stato">
            <option value="Aperto">Aperto</option>
            <option value="In lavorazione">In lavorazione</option>
            <option value="Chiuso">Chiuso</option>
        </select><br><br>

        <button type="submit">Aggiorna</button>
    </form>

<?php endif; ?>

<?php include("../includes/footer.php"); ?>