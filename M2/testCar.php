<?php
require(__DIR__ . "/partials/nav.php");
?>



<?php
    if(isset($_GET['carid'])){
        $id= $_GET['carid'];
        echo "<h2>CarID $id</h2>";
        $db = getDB();
    $stmt = $db->prepare("SELECT make, model, year, id from Cars where id=:carid");
    try{
        
        $r = $stmt->execute([":carid"=>$id]);
        if ($r) {
            $cars = $stmt->fetchALL(PDO::FETCH_ASSOC);
            //echo var_export($cars);
            foreach($cars as $car){
                echo '<tr>';
                echo '<td>' . $car['make'] . '</td>';
                echo '<td>' . $car['model'] . '</td>';
                echo '<td>' . $car['year'] . '</td>';
                echo '<td> <input type="button" onclick="delete_car('. $car['id'] .  ')" value="delete" /> </td>';
                echo '</tr>';
            }
        }
    
        }catch(Exception $e){
            echo var_export($e);
        }

    }else{
        echo 'error carid not provided';
    }
    
?>