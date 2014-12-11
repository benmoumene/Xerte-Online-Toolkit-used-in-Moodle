<?php
session_start();

echo file_get_contents("page_top");
$success = true;
// First try if we have access to the db
$mysql_connect_id = mysql_connect($_SESSION['DATABASE_HOST'], $_POST['account'], $_POST['accountpw']);
if(!$mysql_connect_id) {
    ?>
    <p>Sorry, the attempt to connect to MySql on the host <?php echo $_SESSION['DATABASE_HOST']; ?> has failed using account <?php echo $_POST['account']; ?>. MySQL reports the following error -</p>
    <p class="error">
        <?php echo mysql_error(); ?>
    </p><br />
    <p>The account <?php echo $_POST['account']; ?> must already exist, and have access to database <?php echo $_SESSION['DATABASE_NAME'];?></p>
<?php
    $success = false;
}
if ($success)
{
    $query = "USE " .  $_SESSION['DATABASE_NAME'];
    $query_response = mysql_query($query);
    if(!$query_response){
?>
    <p>Sorry, the attempt to open database <?php echo $_SESSION['DATABASE_NAME'];?> using account <?php echo $_POST['account']; ?> failed. MySQL reports the following error -</p>
    <p class="error">
    <?php echo mysql_errno($mysql_connect_id) . " - " . mysql_error($mysql_connect_id); ?><br />
    </p><br />
    <p>The account <?php echo $_POST['account']; ?> must already exist, and have access to database <?php echo $_SESSION['DATABASE_NAME'];?></p>
<?php
        $success = false;
    }
}
if ($success)
{
    $res = mysql_query("insert  into " . $_SESSION['DATABASE_PREFIX'] . "sitedetails(site_id) VALUES (999)");
    if ($res === false)
    {
        $success = false;
    }
    else
    {
        $res = mysql_query("delete from " . $_SESSION['DATABASE_PREFIX'] . "sitedetails where site_id=999");
        if ($res === false)
        {
            $success=false;
        }
    }
    if (!$success)
    {
?>
        <p>Sorry, the attempt to insert and delete records in MySql on the host <?php echo $_SESSION['DATABASE_HOST']; ?> has failed using account <?php echo $_POST['account']; ?>. MySQL reports the following error -</p>
        <p class="error">
            <?php echo mysql_error(); ?>
        </p><br />
        <p>The account <?php echo $_POST['account']; ?> exists, but does not have enough privileges to access database <?php echo $_SESSION['DATABASE_NAME'];?></p>
<?php
        // Remove record as DBA
        mysql_close($mysql_connect_id);
        $mysql_connect_id = mysql_connect($_SESSION['DATABASE_HOST'], $_SESSION['MYSQL_DBA'], $_SESSION['MYSQL_DBAPASSWORD']);
        mysql_select_db($_SESSION['DATABASE_NAME']);
        $res = mysql_query("delete from " . $_SESSION['DATABASE_PREFIX'] . "sitedetails where site_id=999");
    }
    mysql_close($mysql_connect_id);
}
if ($success)
{

    $buffer = file_get_contents("database.txt");

    $buffer = str_replace("DATABASE_HOST", $_SESSION['DATABASE_HOST'],$buffer);
    $buffer = str_replace("DATABASE_NAME", $_SESSION['DATABASE_NAME'],$buffer);
    $buffer = str_replace("DATABASE_PREFIX", $_SESSION['DATABASE_PREFIX'],$buffer);
    $buffer = str_replace("DATABASE_USERNAME",$_POST['account'],$buffer);
    $buffer = str_replace("DATABASE_PASSWORD",$_POST['accountpw'],$buffer);
    if (file_put_contents('../database.php', $buffer) === false)
    {
        die("database.php could not be created");
    }

?>

    <h2 style="margin-top:15px">
    Admin Password Setup Page
    </h2>
    <p>
    Your Xerte Online Toolkits database configuration has been successfully created.
    </p>
    <p>
    Now please create an admin username and password for the site
    </p>
    <p>
    <form action="page3.php" method="post" onSubmit="javascript:
                if(document.getElementById('account').value==''||document.getElementById('password').value==''){
                    alert('Please set a username and password');
                    return false;
                }
                return true;" enctype="multipart/form-data">
        <label for="account">Admin account name</label><br /><br /><input type="text" width="100" name="account" id="account" /><br /><br />
        <label for="password">Admin account password</label><br /><br /><input type="password" width="100" name="password" id="password"/><br /><br />
        <button type="submit">Next</button>
    </form>
    </p>
<?php
}
else
{
?>
    <h2 style="margin-top:15px">
        Using given MySQL account failed!
    </h2>
    <p>
        Your Xerte Online Toolkits database configuration file is not created! Please investigate the error messages and return to the previous page by pressing the button below!
    </p>
    <p>
    <form action="page2.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="host" value="<?php echo $_SESSION['DATABASE_HOST'];?>"/>
        <input type="hidden" name="database_name" value="<?php echo $_SESSION['DATABASE_NAME'];?>"/>
        <input type="hidden" name="database_prefix" value="<?php echo $_SESSION['DATABASE_PREFIX'];?>"/>
        <input type="hidden" name="database_created" value="1" />
        <input type="hidden" name="account" value="<?php echo $_POST['account'];?>"/>
        <input type="hidden" name="accountpw" value="<?php echo $_POST['accountpw'];?>"/>
        <button type="submit">Previous</button>
    </form>
    </p>

<?php
}
?>
</div>
</body>
</html>
