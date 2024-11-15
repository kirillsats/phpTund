

<!--Исправить ссылки, поиск, оформить, чтобы данные открывались и записывались через xml , а не скрипт-->



<?php
// Загрузка XML-файла
$inim = simplexml_load_file("TARpv23.xml");

// Функция поиска по фамилии
function otsingPerekonnanimiJargi($paring)
{
    global $inim;
    $paringVastus = array();
    foreach ($inim->opilane as $opilane) {
        if (substr(strtolower($opilane->Perekonnanimi), 0, strlen($paring)) == strtolower($paring)) {
            array_push($paringVastus, $opilane);
        }
    }
    return $paringVastus;
}

// Функция для получения данных о студенте по имени
function getStudentDetails($nimi) {
    global $inim;
    foreach ($inim->opilane as $opilane) {
        if ($opilane->Nimi == $nimi) {
            return $opilane;
        }
    }
    return null;
}
?>

<?php
if (!empty($_POST['otsing'])) {
    $paringVastus = otsingPerekonnanimiJargi($_POST['otsing']);

    // Если найден хотя бы один результат
    if (count($paringVastus) > 0) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Nimi</th>";
        echo "<th>Perekonnanimi</th>";
        echo "</tr>";

        // Для каждого найденного студента выводим только имя и фамилию
        foreach ($paringVastus as $opilane) {
            echo "<tr>";
            echo "<td>" . $opilane->Nimi . "</td>";
            echo "<td>" . $opilane->Perekonnanimi . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        // Если нет результатов
        echo "Ei leitud ühtegi vastet.";
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <title>TARpv23 rühm</title>
    <script>
        function showDetails(nimi, silmad, perekonnanimi, Veebisait) {
            // Показываем детальную информацию о студенте
            var details = "Nimi: " + nimi + "<br>Silmad: " + silmad + "<br>Perekonnanimi: " + perekonnanimi + "<br>Veebisait: <a href='" + Veebisait + "' target='_blank'>" + Veebisait + "</a>";
            document.getElementById("details").innerHTML = details;
            // Показываем блок с детальной информацией
            document.getElementById("info").style.display = 'block';
            // Скрываем список студентов
            document.getElementById("studentList").style.display = 'none';
        }
    </script>
</head>
<body>
<h2>TARpv23 rühm</h2>

<form method="post" action="?">
    <label for="otsing">Otsing</label>
    <input type="text" id="otsing" name="otsing" placeholder="Perekonnanimi">
    <input type="submit" value="OK">
</form>
<br><br>

<div id="details" style="display: none;"></div> <!-- Блок с детальной информацией о выбранном студенте -->

<?php
if (!empty($_GET['nimi'])) {
    // Если получен параметр 'nimi', показываем данные только этого студента
    $nimi = $_GET['nimi'];
    $student = getStudentDetails($nimi);
    if ($student) {
        echo "<div>";
        echo "<h3>Info $nimi jaoks </h3>";
        echo "Nimi: " . $student->Nimi . "<br>";
        echo "Silmad: " . $student->Silmad . "<br>";
        echo "Perenimi: " . $student->Perekonnanimi . "<br>";
        echo "Veebisait: <a href='" . $student->Veebisait . "' target='_blank'>" . $student->Veebisait . "</a>";
        echo "</div>";
    } else {
        echo "Student ei leitud.";
    }
} else {
    // Если параметр 'nimi' не передан, показываем список студентов
    echo "<div id='studentList'>";
    echo "<table border='1'>";
    echo "<tr><th>Nimi</th>";
    echo "</tr>";
    foreach ($inim->opilane as $opilane) {
        $nimi = $opilane->Nimi;
        echo "<tr>";
        echo "<td><a href='?nimi=$nimi'>$nimi</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}
?>
</body>
</html>
