<?php
$autod = simplexml_load_file("autod.xml"); /*подгружает данные*/
//otsingu funktsioon
function otsingAutonubriJargi($paring)
{
    global $autod;
    $paringVastus=array();
        foreach ($autod->auto as $auto)
        {
            if(substr(strtolower($auto->autonumber),0,strlen($paring)) == strtolower($paring)){
                array_push($paringVastus,$auto);
            }
        }
        return $paringVastus;
}
?>
<!Doctype html>
<html lang="et">
<head>
    <title>Autode andmed xml failist</title>
</head>
<body>
<h2>Autode andmed xml failist</h2>

<div>
    Esimene auto andmed:
    <?php
    echo $autod->auto[0]->mark;
    echo ", ";
    echo $autod->auto[0]->autonumber;
    echo ", ";
    echo $autod->auto[0]->omanik;
    echo ", ";
    echo $autod->auto[0]->v_aasta;
    ?>
</div>
<!--otsing -->
<form method="post" action="?">
    <label for="otsing">Otsing</label>
    <input type="text" id="otsing" name="otsing" placeholder="autonumber">
    <input type="submit" value="OK">
</form>
<br>
<br>
<?php
    if(!empty($_POST['otsing'])) {
        $paringVastus = otsingAutonubriJargi($_POST['otsing']);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Otsing</th>";
        echo "<th>Autonumber</th>";
        echo "<th>Omanik</th>";
        echo "<th>Väljastamise Aasta</th>";
        echo "</tr>";

        foreach ($paringVastus as $auto) {
            echo "<tr>";
            echo "<td>$auto->mark</td>";
            echo "<td>$auto->autonumber</td>";
            echo "<td>$auto->omanik</td>";
            echo "<td>$auto->v_aasta</td>";
            echo "</tr>";
        }
        echo "</table>";
    }else{
?>
<table border="1">
    <tr>
        <th>Mark</th>
        <th>Autonumber</th>
        <th>Omanik</th>
        <th>Väljastamise aasta</th>
    </tr>

        <?php
        foreach ($autod as $auto) {
            echo "<tr>";
            echo "<td>$auto->mark</td>";
            echo "<td>$auto->autonumber</td>";
            echo "<td>$auto->omanik</td>";
            echo "<td>$auto->v_aasta</td>";
            echo "</tr>";
        }
        ?>
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 50%;
            border: 10px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</table>
<?php
    }
?>
</body>
</html>



