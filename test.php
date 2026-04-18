<?php
$hash = '$2y$10$Qf7x0g2u7Qk3g0Qx1p8F3u5Qx0u5Uu5Qx0u5Uu5Qx0u5Uu5Qx0u5u';

if (password_verify("password", $hash)) {
    echo "OK: password corretta";
} else {
    echo "ERRORE: password NON valida";
}
?>
