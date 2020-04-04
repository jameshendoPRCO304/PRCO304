<?php include("header.php"); ?>
<?php include("auth.php"); ?>
<div class="row">
    <div class="col-md-12">
        <h1>Devices</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>IP Address</th>
                <th>MAC Address</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $loggedInUserId = $_SESSION["id"];
            $devices = mysqli_query($link, "SELECT * FROM device WHERE user_id = '$loggedInUserId'");
            while ($device = mysqli_fetch_array($devices)) { ?>
                <tr>
                    <td><?php echo $device['ip_address'];?></td>
                    <td><?php echo $device['mac_address'];?></td>

                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<?php include("footer.php"); ?>

