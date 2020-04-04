<?php include("header.php"); ?>
<?php include("auth.php"); ?>
<div class="row">
    <div class="col-md-12" style="margin-bottom: 30px;">
        <h1>Ports</h1>
        <form action="">
            <label for="ipAddress">Select IP Address</label>
            <select onchange="this.form.submit()" name="ipAddress" class="form-control" id="ipAddress">
                <option value="" disabled selected>-- Select IP Address --</option>
                <?php
                $loggedInUserId = $_SESSION["id"];
                $devices = mysqli_query($link, "SELECT * FROM device WHERE user_id = '$loggedInUserId'");
                while ($device = mysqli_fetch_array($devices)) { ?>
                    <option value="<?php echo $device['ip_address']; ?>"><?php echo $device['ip_address']; ?></option>
                <?php } ?>
            </select>
        </form>
    </div>
    <?php if (isset($_GET['ipAddress'])) {
        $ip = $_GET['ipAddress'];

        ?>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Port Number</th>
                    <th>State</th>
                    <th>Service</th>
                    <th>Product</th>
                    <th>Version Number</th>
                </tr>
                </thead>
                <tbody>
                <?php $devices = mysqli_query($link, "SELECT * FROM ports WHERE ip_address = '$ip'");
                while ($device = mysqli_fetch_array($devices)) { ?>
                    <tr>
                        <td><?php echo $device['port_no']; ?></td>
                        <td><?php echo $device['state']; ?></td>
                        <td><?php echo $device['service']; ?></td>
                        <td><?php echo $device['product']; ?></td>
                        <td><?php echo $device['version_no']; ?></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
<?php include("footer.php"); ?>

