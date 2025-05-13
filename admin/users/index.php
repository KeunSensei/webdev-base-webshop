<?php
    include('../core/header.php');
?>

<a href="<?= BASEURL_CMS;?>users/add_user.php">Add User</a><br>

<?php
     $liqry = $con->prepare("SELECT admin_user_id,email,password FROM admin_user WHERE 1;");
        if($liqry === false) {
            echo mysqli_error($con);
        } else{
            $liqry->bind_result($adminId,$email,$dbHashPassword);
            if($liqry->execute()){
                $liqry->store_result();
                while($liqry->fetch()){
                    $adminId = stripslashes($adminId);
                    $email = stripslashes($email);
                    $dbHashPassword = stripslashes($dbHashPassword);
                    echo $email;

                    echo "<a href='edit_user.php?edit=$adminId'>Edit</a>&nbsp;
                    <a href='delete_user.php?delete=$adminId' onclick=\"return confirm('Weet u zeker dat u dit item wilt verwijderen?')\">Delete</a><br>";
                }
                
            }
            $liqry->close();
        }
?>

<?php
    include('../core/footer.php');
?>