<?php
    include('../core/header.php');


    if(isset($_POST['submit']) && $_POST['submit'] != "") {

        doMes();


        $filename = $_FILES['image']['name'];
        // $fullpath_filename = BASEURL."assets/img/".$filename;
        $tmp_name = $_FILES['image']['tmp_name'];
        

        $type = pathinfo($tmp_name, PATHINFO_EXTENSION);
        $data = file_get_contents($tmp_name);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        prettyDump(__DIR__);exit();
        
        move_uploaded_file($_FILES['image']['tmp_name'], OWNURL."assets/img/".$filename);


        if(isset($_POST['title']) && $_POST['title'] == ''){
            echo "Vul een waarde in van title";
        }
        //Dit is een /"blaat/"
        //Dit is een &quote;blaat&quote;

        //&euro; €
        //&nbsp; <spatie>
        //<input type="text" value="Dit is een /"blaat/" " />
        $query1 = $con->prepare("INSERT INTO products (title,price,description, image) VALUES (?,?,?,?);");
        if ($query1 === false) {
            // noticeRij('error');
            echo mysqli_error($con);
        }
        $query1->bind_param('ssss',$_POST['title'],$_POST['price'],$_POST['description'],$filename);
        if ($query1->execute() === false) {
            // noticeRij('error');
            echo mysqli_error($con);
        } else {
            echo "OK gelukt";
            // noticeRij('ok');
        }
        $query1->close();
    }else{
?>
<form action="<?= CURHREF;?>" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="price" placeholder="Price" >
  
    <textarea name="description" id=""></textarea>
    <input type="file" name="image" id="">
    <input type="submit" name="submit" value="Add Product">
</form>

<?php
    }//afsluiten post check

    include('../core/footer.php');
?>