<?php
// db.php
// Funzioni per leggere e scrivere file CSV in modo sicuro

function leggi_csv($percorso)
{
    $righe = array();

    if (file_exists($percorso) === true) {
        $file = fopen($percorso, "r");

        if ($file !== false) {
            while (($dati = fgetcsv($file, 1000, ";")) !== false) {
                $righe[] = $dati;
            }
            fclose($file);
        }
    }

    return $righe;
}

function scrivi_csv($percorso, $righe)
{
    $file = fopen($percorso, "w");

    if ($file !== false) {
        foreach ($righe as $riga) {
            fputcsv($file, $riga, ";");
        }
        fclose($file);
    }
}

function aggiungi_csv($percorso, $riga)
{
    $file = fopen($percorso, "a");

    if ($file !== false) {
        fputcsv($file, $riga, ";");
        fclose($file);
    }
}
?>