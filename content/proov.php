<?php
echo "Tere hommikust";
echo "<br>";
$muutuja='PHP on skriptikeel';
echo "<strong>";
echo $muutuja;
echo "</strong>";
// Tekstifunktsioonid
echo "<h2>Tekstifunktsioonid</h2>";
$tekst = 'Esmaspäev on neljas november';
echo $tekst;
// Kõik tähed on suured

echo "<br>";
echo mb_strtoupper($tekst); // для эстонских букы нужна преписка "mb_"
// Kõik tähed on väiksed
echo "<br>";
echo mb_strtolower($tekst);
echo "<br>";
// Iga sõna algab suure tähega
echo ucwords($tekst);
echo "<br>";
// Teksti pikkus
echo "Teksti pikkus - ".strlen($tekst);
echo "<br>";

//Eraldame esimesed 5 tähte
echo "Esimesed 5 tähte - ".substr($tekst, 0, 5);
echo "<br>";
// Leiame on positsiooni
$otsing = 'on';
echo "On asukoht lauses on ".strpos($tekst, $otsing);
echo "<br>";

//eralda esimene sõna kuni $otsing
echo substr($tekst, 0, strpos($tekst, $otsing));
echo "<br>";

//eralda peale
echo substr($tekst, strpos($tekst, $otsing));
echo "<br>";
echo "<h2>Kasutame veebis kasutavaid näidised</h2>";


//sõnade arv lauses
echo "Sõnade arv lauses - ".str_word_count($tekst);
echo "<br>";
//teksti kärpimine - выборка текста
$tekst2 = '        Põhitoetus võetakse ära 11.11 kui võilgneused ei ole parandatud.';

echo trim($tekst2, "P, ");
echo "<br>";
echo ltrim($tekst2);
echo "<br>";
echo rtrim($tekst2);
echo "<br>";
// tekst kui massiiv
$tekst3 = 'Taiendav info opilasele kohta';
/*echo $tekst3[0]; 				//T
echo '<br>';
echo $tekst3[5];*/ //n

echo "1.täht - ".$tekst3[0];
echo "<br>";

//kolmas sõna
$sona = str_word_count($tekst3, 1);
print_r($sona);
echo "Kolmas sõna - ".$sona[2];

