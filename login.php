<?php
require_once("../includes/db.php");
require_once("../includes/auth.php");

$errore = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (login($username, $password) === true) {
        header("Location: dashboard.php");
        exit();
    } else {
        $errore = "Credenziali non valide.";
    }
}

include("../includes/header.php");
?>

<h2>Accesso Utente</h2>

<?php if ($errore !== ""): ?>
    <p style="color:red;"><?php echo htmlspecialchars($errore); ?></p>
<?php endif; ?>

<form method="post" action="login.php">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Accedi</button>
</form>

<?php include("../includes/footer.php"); ?>