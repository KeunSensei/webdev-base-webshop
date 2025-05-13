<?php
    include('../core/header.php');


    if(isset($_POST['submit']) && $_POST['submit'] != "") {

        doMes();

        if($_POST['password'] != $_POST['password2']) {
            noticeRij('error');
            exit();
        }
        $password_new = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query1 = $con->prepare("INSERT INTO admin_user (email, password) VALUES (?,?);");
        if ($query1 === false) {
            noticeRij('error');
            echo mysqli_error($con);
        }
        $query1->bind_param('ss',$_POST['email'],$password_new);
        if ($query1->execute() === false) {
            noticeRij('error');
            echo mysqli_error($con);
        } else {
            noticeRij('ok');
        }
        $query1->close();
    }else{
?>
<form action="<?= CURHREF;?>" method="post">
    <input type="text" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password2" placeholder="Password (repeat)" required>
    <input type="submit" name="submit" value="Add User">
</form>

<?php
    }//afsluiten post check

    include('../core/footer.php');
?>