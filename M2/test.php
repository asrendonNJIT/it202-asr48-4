<?php
require(__DIR__ . "/partials/nav.php");
?>

<h2>Cars</h2>

<script>
    console.log("test js");
    function delete_car(id){
        console.log(id);
    }
</script>

<form>
    <div>
        <label for="make">Make</label>
        <input type="text" name="make" required />
    </div>
    <div>
        <label for="model">Model</label>
        <input type="text" name="model" required />
    </div>
    <div>
        <label for="year">Year</label>
        <input type="text" name="year" required />
    </div>
    <input type="submit" value="Add Car" />
</form>

<table>
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
    </tr>


<?php

if(isset($_GET['make']) && isset($_GET['model']) && isset($_GET['year'])){
    $make = $_GET['make'];
    $model = $_GET['model'];
    $year = $_GET['year'];

    $db = getDB();
    $stmt = $db->prepare("INSERT INTO  Cars (make, model, year) values (:make, :model, :year)");
    try {
        $stmt->execute([":make" => $make, ":model" => $model, ":year" => $year]);
        echo "Successfully registered!";
        header("Location: test.php");
    } catch (Exception $e) {
        echo "There was a problem registering";
        "<pre>" . var_export($e, true) . "</pre>";
    }
}



$db = getDB();
$stmt = $db->prepare("SELECT make, model, year, id from Cars");
try{
    
    $r = $stmt->execute();
    if ($r) {
        $cars = $stmt->fetchALL(PDO::FETCH_ASSOC);
        //echo var_export($cars);
        foreach($cars as $car){
            echo '<tr>';
            echo '<td>' . $car['make'] . '</td>';
            echo '<td><a href="testCar.php?carid='.$car['id'].'">' . $car['model'] . '</a></td>';
            echo '<td>' . $car['year'] . '</td>';
            echo '<td> <input type="button" onclick="delete_car('. $car['id'] .  ')" value="delete" /> </td>';
            echo '</tr>';
        }
    }
    
}catch(Exception $e){
    echo var_export($e);
}

?>
</table>