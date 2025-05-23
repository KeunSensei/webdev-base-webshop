<?php
    include('../core/header.php');
?>

<a href="<?= BASEURL_CMS;?>products/add_product.php">Add Product</a><br>

<?php
     $liqry = $con->prepare("SELECT product_id,title,image FROM products WHERE 1;");
        if($liqry === false) {
            echo mysqli_error($con);
        } else{
            $liqry->bind_result($product_id,$title,$image);
            if($liqry->execute()){
                $liqry->store_result();
                while($liqry->fetch()){
                    $product_id = stripslashes($product_id);
                    $title = stripslashes($title);
                    $image = stripslashes($image);
                    echo $title;
                    echo "<img src='".BASEURL."assets/img/".$image."' width='100px' />";
                    echo "<a href='edit_user.php?edit=$product_id'>Edit</a>&nbsp;
                    <a href='delete_user.php?delete=$product_id' onclick=\"return confirm('Weet u zeker dat u dit item wilt verwijderen?')\">Delete</a><br>";
                }
                
            }
            $liqry->close();
        }
?>

<?php
    include('../core/footer.php');
?>