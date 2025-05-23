<?php
    include('../core/header.php');

    if(isset($_GET['edit'])) { $edit = mes($_GET['edit']); } else { $edit = 0; }

    if(isset($_POST['submit']) && $_POST['submit'] != "") {

        doMes();

        if(isset($_POST['password']) && $_POST['password'] != "") {
            if($_POST['password'] != $_POST['password2']) {
                noticeRij('error');
                exit();
            }
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            list($password) = mysqli_fetch_array($con->query("SELECT password FROM admin_user WHERE admin_user_id = '{$edit}' LIMIT 1;"));
        }
        
        $query1 = $con->prepare("UPDATE admin_user SET email = ?, password = ? WHERE admin_user_id = ?;");
        if ($query1 === false) {
            noticeRij('error');
            echo mysqli_error($con);
        }
        $query1->bind_param('sss',$_POST['email'],$password,$edit);
        if ($query1->execute() === false) {
            noticeRij('error');
            echo mysqli_error($con);
        } else {
            noticeRij('ok');
        }
        $query1->close();
    }else{
        $wpqry = $con->prepare("SELECT email FROM admin_user WHERE admin_user_id = ? LIMIT 1;");
        if ($wpqry === false) {
            noticeRij('error');
            trigger_error(mysqli_error($con));
        } else {
            $wpqry->bind_param('i',$edit);
            $wpqry->execute();
            $wpqry->bind_result($email);
            $wpqry->fetch();
            $wpqry->close();
?>
<form action="<?= CURHREF;?>" method="post">
    <input type="text" name="email" placeholder="Email" value="<?= strip($email);?>"required>
    <input type="password" name="password" placeholder="Password" >
    <input type="password" name="password2" placeholder="Password (repeat)" >
    <input type="submit" name="submit" value="Update User">
</form>

<?php
        }//afsluiten wijzig query
    }//afsluiten post check

    include('../core/footer.php');
?>