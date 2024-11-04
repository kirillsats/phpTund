<?php
echo "Mõistatus. Europaa riik";
// 6 подсказок при помощи текстовых функций
// выводить список <ul>/<ol>
$riik= 'Estonia';
echo "<ol>";
echo "<li> Esimene täht riigis on - ".substr($riik,0,1)."</li>";
echo "<br>";
echo "<li> esimene täht lõpust on - ".substr($riik,6,1)."</li>";
echo "<br>";
echo "<li> Nime pikkus: " . strlen($riik) . "</li>";
echo "<br>";
echo "<li> Esimene kaks tähte: " . substr($riik, 0, 2) . "</li>";
echo "<br>";
echo "<li> Viimased kaks tähte: " . str_repeat('*', strlen($riik) - 2) . substr($riik, -2) . "</li>";
echo "<br>";
echo "<li> Selline riik asub Bakti riikides: " . str_repeat('*', strlen($riik)) . "</li>";
echo "</ol>";




