<?php session_start();
require_once "config.php";
include("auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)); ?> | Web App</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .pt-20 {
            padding-top: 20px;
        }

        .pt-30 {
            padding-top: 30px;
        }

        .table-ports thead tr th {
            background-color: #c45911;
            color: #ffffff;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row pt-20">
<!--        <div class="col-md-4">
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Your Network</span>
                <input type="text" class="form-control form-group-lg" id="yourNetwork">
            </div>
        </div>-->
        <div class="col-md-6"></div>
        <div class="col-md-4">
            <div class="input-group input-group-lg pull-right">
                <span class="input-group-addon">IP Address</span>
                <input type="text" class="form-control" id="yourIP">
            </div>
        </div>
        <div class="col-md-2">
            <a href="logout.php" class="btn btn-warning pull-right btn-lg">logout</a>
        </div>
    </div>
    <div class="row pt-20">
        <div class="col-md-4">
            <h1>Devices</h1>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="input-group input-group-lg pull-right">
                <span class="input-group-addon">MAC Address</span>
                <input type="text" class="form-control" id="yourMAC">
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered text-center" id="deviceTable">
                <thead class="bg-primary">
                <tr>
                    <th class="text-center">IP Address</th>
                    <th class="text-center">MAC Address</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $loggedInUserId = $_SESSION["id"];
                $devices = mysqli_query($link, "SELECT * FROM device WHERE user_id = $loggedInUserId");
                while ($device = mysqli_fetch_array($devices)) { ?>
                    <tr class="bg-info dataRow">
                        <td><?php echo $device['ip_address']; ?></td>
                        <td><?php echo $device['mac_address']; ?></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Ports</h1>
            <table class="table table-bordered text-center table-ports">
                <thead>
                <tr>
                    <th class="text-center">Port Number</th>
                    <th class="text-center">State</th>
                    <th class="text-center">Service</th>
                    <th class="text-center">Product</th>
                    <th class="text-center">Version Number</th>
                </tr>
                </thead>
                <tbody id="portsTable">

                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#deviceTable tr.dataRow').click(function (event) {
            $('#deviceTable tr.dataRow').css('background-color','#d9edf7');
            $(this).css('background-color','#f4af80');
            var tableData = $(this).children("td").map(function () {
                return $(this).text();
            }).get();
            var ipAddress = tableData[0];
            var macAddress = tableData[1];

            $("#yourIP").val(ipAddress);
            $("#yourMAC").val(macAddress);

            $.ajax({
                url: "fetchPorts.php",
                method: "POST",
                data: {ipAddress: ipAddress},
                success: function (data) {
                    $('#portsTable').html(data);
                }
            });
        });
    });
</script>
</body>
</html>



