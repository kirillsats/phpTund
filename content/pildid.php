<h2>
    PHP – Töö pildifailidega
</h2>
<fieldset>
    <legend><h2><a href="https://www.metshein.com/unit/php-pildifailidega-ulesanne-14/">Töö pildifailidega</a></h2></legend>
    <!-- Vorm pildi valimiseks -->
    <form method="post" action="">
        <select name="pildid">
            <option value="">Vali pilt</option>
            <?php
            // Avame pildikausta
            $kataloog = 'img'; // Määrame kausta tee
            $asukoht=opendir($kataloog); // Avame kausta
            // Loeme kausta faile
            while($rida = readdir($asukoht)){
                // Jätame välja . ja .. kataloogid
                if($rida!='.' && $rida!='..'){
                    // Kuvame iga faili valikuvariandina
                    echo "<option value='$rida'>$rida</option>\n";
                }
            }
            ?>
        </select>
        <input type="submit" value="Vaata"> <!-- Nupp vormi saatmiseks -->
    </form>

    <!-- Vorm juhusliku pildi kuvamiseks -->
    <form method="post">
        <input name="random" type="submit" value="random picture"> <!-- Nupp juhusliku pildi kuvamiseks -->
    </form>
</fieldset>

<?php
// Maksimaalsed pildi suurused
$max_laius = 120;
$max_korgus = 90;

// Massiiv, kus on juhuslike piltide nimed
$pildimassiiv = array(
    "bob.jpg", "spongeBob.jpg", "pingvin.jpg"
);

// Valime massiivist juhusliku pildi
$randinteger = rand(0,2);
$randpilt = $pildimassiiv[$randinteger];

// Kuvame juhusliku pildi maksimaalsete mõõtmetega
echo '<img src="img/' . $randpilt . '" alt="Random Picture" width="' . $max_laius . '" height="' . $max_korgus . '">';

// Kui kasutaja on valinud pildi, siis töötleme selle
if(!empty($_POST['pildid'])){
    $pilt = $_POST['pildid']; // Saame valitud pildi nime
    $pildi_aadress = 'img/'.$pilt; // Loome pildi täistee
    $pildi_andmed = getimagesize($pildi_aadress); // Saame pildi mõõdud ja vormingu

    $laius = $pildi_andmed[0];
    $korgus = $pildi_andmed[1];
    $formaat = $pildi_andmed[2];
    $max_laius = 120;
    $max_korgus = 90;

    // Arvutame skaleerimise suhte, et säilitada proportsioonid
    if($laius <= $max_korgus && $korgus <= $max_korgus){
        $ratio = 1; // Kui pilt on väiksem kui maksimaalsed mõõdud, ei muudame seda
    } elseif($laius > $korgus){
        // Kui pilt on laiem kui kõrge, arvutame skaleerimisfaktori laiuse järgi
        $ratio = $max_laius / $laius;
    } else {
        // Kui pilt on kõrgem kui lai, arvutame skaleerimisfaktori kõrguse järgi
        $ratio = $max_korgus / $korgus;
    }

    // Arvutame uued mõõdud, korrutades algmõõdud skaleerimisfaktoriga
    $pisi_laius = round($laius * $ratio);
    $pisi_korgus = round($korgus * $ratio);

    // Kuvame originaalpildi andmed
    echo '<h3>Originaal pildi andmed</h3>';
    echo "Laius: $laius<br>";
    echo "Kõrgus: $korgus<br>";
    echo "Formaat: $formaat<br>";

    // Kuvame uue pildi andmed, kus on arvutatud uued mõõdud
    echo '<h3>Uue pildi andmed</h3>';
    echo "Arvutamise suhe: $ratio <br>";
    echo "Laius: $pisi_laius<br>";
    echo "Kõrgus: $pisi_korgus<br>";
    echo "<img width='$pisi_laius' src='$pildi_aadress'><br>";
}


?>
