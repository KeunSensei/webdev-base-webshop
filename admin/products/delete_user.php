<?php
    include('../core/header.php');

    if(isset($_GET['delete']) && $_GET['delete'] != "") {
        $query1 = $con->prepare("DELETE FROM admin_user WHERE admin_user_id = ?;");
        if ($query1 === false) {
            noticeRij('error');
            echo mysqli_error($con);
        }
        $query1->bind_param('i',$_GET['delete']);
        if ($query1->execute() === false) {
            noticeRij('error');
            echo mysqli_error($con);
        } else {
            noticeRij('delete');
        }
        $query1->close();
    }

    include('../core/footer.php');
?>