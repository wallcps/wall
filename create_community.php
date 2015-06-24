<?php 
	ob_start("ob_gzhandler");
	error_reporting(0);
	include_once 'includes/db.php';
    session_start();
    $user_id = $_SESSION['uid'];
    if (isset($_POST['save'])) {
        $com_name = $_POST['name'];
        $address = $_POST['address'];
        $language = $_POST['language'];
        $role = $_POST['position'];
        $map = $_POST['map'];
        $desc = $_POST['introduction'];
    //upload community image
        $target_dir1 = "uploads";
        //for id card..........
        $temp1 = explode(".",$_FILES["update_pic_com"]["name"]);
        $filename1 = rand(1,99999) . '.' .end($temp1);
        $target_file1 = $target_dir1 . basename($filename1);
        
        //conditions cannot null.....
        if($_FILES['update_pic_com']['tmp_name'] == ''){
            echo 'false';
        }else{
            move_uploaded_file($_FILES["update_pic_com"]["tmp_name"],$target_file1)
            if(mysqli_query($db,"insert into groups (group_id,group_name,group_desc,uid_fk,group_pic) values(null,".$com_name.",".$desc.",".$user_id.",".$filename1.")")){
                $groups_id = mysqli_query($db,"select group_id from groups where uid_fk = '$user_id' ");
                foreach ($groups_id as $group_id) {
                    $group = $group_id['group_id'];
                    mysqli_query($db,"insert into community (com_id,location,language,role,map) values ()");
                }
            }
            else{
                echo "fail";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <?php
    	include("js.php");
    ?>
    <style type="text/css">
    	.container{
    		width: 860px;
    		height: auto;
    	}	
    </style>
</head>
<body>
<div class="container">
	<div class="text">
		<center>
		<h2 style="color:pink;">Create a Page for Your Community!</h2>
		<p>Duis eleifend facilisis diam, id mollis ante tincidunt nec. Nullalac inia, elit non eleifend iaculis, neque nisl sus cipit lorem</p>
		</center>
		<hr>
	<form action="" method="POST" enctype="multipart/form-data" style="width:850px;" class="form-contact">
		<h3>Community Information</h3>
		<br>
		<div class="row">
            <div class="col-md-6">
                <p>What is your community name ?<span style="color:red;">*</span> </p>
            </div>
            <div class="col-md-6">
                <input class="text- form-control" name="name" type="text" placeholder="E.g. Codingate" required=""/>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-6">
                <p>What is your community address ? <span style="color:red;">*</span></p>
            </div>
            <div class="col-md-6">
                <textarea  name="address" style="height:70px; width:100%;margin-bottom:0px;" required="" placeholder="E.g. No.17 Street 604 Toul Kork District, Phnom Penh, Cambodia"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            	<p>Which languages are spoken ?<span style="color:red;">*</span></p>
            </div>
            <div class="col-md-6">
            	<input class="text- form-control" name="language" required="" type="text" placeholder="E.g. English Chiness Khmer" required=""/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            	<p>What is your position in community ?<span style="color:red;">*</span></p>
            </div>
            <div class="col-md-6">
            	<input class="text- form-control" name="position" type="text" placeholder="E.g. Leader Teacher co-leader" required=""/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>What is community location in Google Map ? </p>
            </div>
            <div class="col-md-6">
                <textarea style="height:70px; width:100%; margin-bottom:0px;"  name="map" placeholder="E.g. https://www.google.com.kh/maps/place/Codingate/@11.573362,104.892621,17z/data=!3m1!4b1!4m2!3m1!1s0x310951761b0efa99:0x83be8a97765e155?hl=en"></textarea>
            </div>
        </div>
        <div class="row">
	        <div class="col-md-6">
                <p>What is community Introduction ? </p>
            </div>
            <div class="col-md-6">
                <textarea  style="height:70px; width:100%" name="introduction" placeholder="E.g. Tags:cartoon wallpapers HD, featured, funny cartoon sayings, funny minions quotes, funny momment cartoons, miniones quotes 2014, minions funny pictures, ..."></textarea>
            </div>
	    </div>
	    <div class="row">
	        <div class="col-md-6">
                <p>Do you have your community image ? </p>
            </div>
            <div class="col-md-6">
           		<input type="file" name="doc">
            </div>
	    </div>
	    <input type="submit" name="save" value="Show my Community" style="margin-left:40%;" class=" btn btn-xs btn-submitbtn-info btn-cps">
	</form>
	</div>
</div>
	
</body>
</html>