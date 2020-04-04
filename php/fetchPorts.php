<?php

require_once 'config.php';

$output = '';
if (isset($_POST["ipAddress"])) {
    $ipAddress = $_POST["ipAddress"];

    $query = "SELECT * FROM ports WHERE ip_address = '$ipAddress'";

    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
        <tr class="bg-warning">
        <td>'.$row["port_no"].'</td><td>'.$row["state"].'</td><td>'.$row["service"].'</td><td>'.$row["product"].'</td><td>'.$row["version_no"].'</td>
        </tr>';
        }
        echo $output;
    } else {
        $output = '<tr><td colspan="5">No ports were found.</td></tr>';
        echo $output;
    }
}