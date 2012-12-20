<?php
    require_once 'header.php';

    $host = new Users();
    $host->notLogedin();

    if (isset($_POST['addhost'])) {

        $hostname = $_POST['hostname'];
        $domainorip = $_POST['domainorip'];
        $port = $_POST['port'];
        $ispublic = $_POST['ispublic'];
        $userid = $_SESSION['userid'];

        if (isset($hostname) && !empty($hostname)) {
            if (isset($domainorip) && !empty($domainorip)) {
                if (isset($port) && !empty($port)) {
                    $host->addHost($userid, $hostname, $domainorip, $port, $ispublic);
                } else {
                    Main::setMessage("host.php", "Please make sure you have inputted the correct port number!", "alert-error");
                }
            } else {
                Main::setMessage("host.php", "Please make sure to have putted the correct Hostname or IP", "alert-error");
            }
        } else {
            Main::setMessage("host.php", "Please make sure to have putted the correct Host Name!", "alert-error");
        }
    }

?>
<form class="form-horizontal" style="padding-left: 30px;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="control-group">
        <label class="control-label" for="inputHostname">Host Name</label>

        <div class="controls">
            <input type="text" name="hostname" class="input-xlarge" id="inputHostname" placeholder="Host Name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputDomainOrIP">Domain or IP</label>

        <div class="controls">
            <input type="text" name="domainorip" class="input-xlarge" id="inputDomainOrIP" placeholder="Domain or IP">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPort">Port</label>

        <div class="controls">
            <input type="text" name="port" class="input-xlarge" id="inputPort" placeholder="Port">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="isPublic">Is Public Host?</label>

        <div class="controls">
            <label class="radio">
                <input type="radio" name="ispublic" class="input-xlarge" value="0" id="isPublic" checked> No
            </label>
            <label class="radio">
                <input type="radio" name="ispublic" class="input-xlarge" value="1" id="isPublic"> Yes
            </label>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" name="addhost" class="btn input-xlarge">Add Host</button>
        </div>
    </div>
</form>
<?php require_once 'footer.php';