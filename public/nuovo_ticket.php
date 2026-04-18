<?php
require_once("../includes/db.php");
require_once("../includes/auth.php");

richiedi_login();

$messaggio = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titolo = trim($_POST["titolo"]);
    $categoria = trim($_POST["categoria"]);
    $priorita = trim($_POST["priorita"]);
    $descrizione = trim($_POST["descrizione"]);

    if ($titolo !== "" && $descrizione !== "") {
        $tickets = leggi_csv(__DIR__ . "/../data/ticket.csv");

        // Genera ID incrementale
        $id = count($tickets) + 1;

        $nuovo_ticket = array(
            $id,
            $titolo,
            $categoria,
            $priorita,
            "Aperto",
            $_SESSION["username"],
            date("Y-m-d H:i")
        );

        aggiungi_csv(__DIR__ . "/../data/ticket.csv", $nuovo_ticket);

        $messaggio = "Ticket creato con successo.";
    } else {
        $messaggio = "Compila tutti i campi obbligatori.";
    }
}

include("../includes/header.php");
?>

<h2>Nuovo Ticket</h2>

<?php if ($messaggio !== ""): ?>
    <p><?php echo htmlspecialchars($messaggio); ?></p>
<?php endif; ?>

<form method="post" action="nuovo_ticket.php">
    <label>Titolo:</label><br>
    <input type="text" name="titolo" required><br><br>

    <label>Categoria:</label><br>
    <select name="categoria">
        <option value="Laboratorio">Laboratorio</option>
        <option value="Rete">Rete</option>
        <option value="Software">Software</option>
        <option value="Manutenzione">Manutenzione</option>
        <option value="Altro">Altro</option>
    </select><br><br>

    <label>Priorità:</label><br>
    <select name="priorita">
        <option value="Bassa">Bassa</option>
        <option value="Media">Media</option>
        <option value="Alta">Alta</option>
    </select><br><br>

    <label>Descrizione:</label><br>
    <textarea name="descrizione" rows="5" cols="40" required></textarea><br><br>

    <button type="submit">Crea Ticket</button>
</form>

<?php include("../includes/footer.php"); ?>