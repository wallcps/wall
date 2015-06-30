<?php 
	ob_start("ob_gzhandler");
	error_reporting(0);
	include_once 'includes/db.php';

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
    <?php 
         session_start();
       // $user_id = $_SESSION['uid'];
         $user_id = 103;
            if (isset($_POST['save'])) {
                 $com_name = $_POST['name'];
                 $address = $_POST['address'];
                 $language = $_POST['language'];
                 $role = $_POST['position'];
                 $map = $_POST['map'];
                 $desc = $_POST['introduction'];
            //upload community image
                 $target_dir1 = "uploads/";
                //for id card..........
                $temp1 = explode(".",$_FILES["pic_com"]["name"]);
                $filename1 = rand(1,99999) . '.' .end($temp1);
                $target_file1 = $target_dir1 . basename($filename1);
                //conditions cannot null.....
                if($_FILES['pic_com']['tmp_name'] == ''){
                    echo 'false';
                }else{
                    move_uploaded_file($_FILES["pic_com"]["tmp_name"],$target_file1);
                    if(mysqli_query($db,"insert into groups (group_name,uid_fk,group_pic) values('$com_name','$user_id','$filename1')")){
                        $groups_id = mysqli_query($db,"select group_id from groups where uid_fk = '$user_id' ");
                        foreach ($groups_id as $group_id) {
                             $group = $group_id['group_id'];
                            if(mysqli_query($db,"insert into community (group_id,location,language,role,map) values ('$group','$address','$language','$role','$map')")){
                                $coms_id = mysqli_query($db,"select com_id from community where group_id = '$group' ");
                                foreach ($coms_id as $com_id) {
                                    $comId = $com_id['com_id'];     
                                        if(mysqli_query($db,'insert into com_slideshow (slide_des,file_name,com_id) values ("Description of slideshow about community page","default_com_pic.jpg",'.$comId.')')){
                                            echo "alert('com_slideshow ok')";
                                        }else{
                                            echo "alert('com_slideshow no')";
                                        }

                                        if(mysqli_query($db,"insert into com_welcome_content (title,content,com_id) values ('Lorem isum sed sapien pellen','Duis eleifend facilisis diam, id mollis ante tincidunt nec. Nullalac inia, elit non eleifend iaculis, neque nisl suscipit lorem, at ornare lectus metus. Nunc rhoncus sapien sed eros pellen tesques, quis convallis quam accusan','$comId')"))
                                        {
                                            echo "alert('com_welcome_content ok')";
                                        }
                                        else{
                                            echo "alert('com_welcome_content no')";
                                        }
                                        if(mysqli_query($db,"insert into com_tab_welcome (com_id,title,decription,image) values ('$comId','Volunteer','Duis eleifend facilisis diam, id mollis ante tincidunt nec. Nullalac inia, elit non eleifend iaculis, neque nisl suscipit lorem, at ornare lectus metus. Nunc rhoncus sapien sed eros pellen tesques, quis convallis quam accusan','59738.png')('$comId','Turish','Duis eleifend facilisis diam, id mollis ante tincidunt nec. Nullalac inia, elit non eleifend iaculis, neque nisl suscipit lorem, at ornare lectus metus. Nunc rhoncus sapien sed eros pellen tesques, quis convallis quam accusan','696.jpg')('$comId','Donate','Duis eleifend facilisis diam, id mollis ante tincidunt nec. Nullalac inia, elit non eleifend iaculis, neque nisl suscipit lorem, at ornare lectus metus. Nunc rhoncus sapien sed eros pellen tesques, quis convallis quam accusan','68420.png')"))
                                        {
                                            echo "alert('com_tab_welcome ok')";
                                        }
                                        else{
                                            echo "alert('com_tab_welcome no')";
                                        }
                                        if(mysqli_query($db,"insert into com_tab_about (title,description,com_id) values ('Goals','Duis ante turpis, venenatis ut justo commodo, gravida vaximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at... ','$comId')('Introduction','Duis ante turpis, venenatis ut justo commodo, gravida vaximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at... ','$comId')"))
                                        {
                                            echo "alert('com_tab_about ok')";
                                        }
                                        else{
                                            echo "alert com_tab_about no";
                                        }
                                        if(mysqli_query($db,"insert into com_about_doc (content,com_id) values ('<iframe src='https://docs.google.com/document/d/1xIdP9m2a4O-43WXgQcjsaEeufjOkHDHhDMMyzyoeLaw/pub?embedded=true'></iframe>','$comId')")){
                                            echo "alert('com_about_doc ok')";
                                        }
                                        else{
                                            echo "alert('com_about_doc no')";
                                        }
                                        if(mysqli_query($db,"insert into com_welcome_doc (content,com_id) values ('<iframe src='https://docs.google.com/document/d/1xIdP9m2a4O-43WXgQcjsaEeufjOkHDHhDMMyzyoeLaw/pub?embedded=true'></iframe>','$comId')"))
                                        {
                                            echo "alert('com_welcome_doc ok')";
                                        }
                                        else{
                                            echo "alert('com_welcome_doc no')";
                                        }
                                        if(mysqli_query($db,"insert into com_audit_doc (content,com_id) values ('<iframe src='https://docs.google.com/document/d/1xIdP9m2a4O-43WXgQcjsaEeufjOkHDHhDMMyzyoeLaw/pub?embedded=true'></iframe>','$comId')"))
                                        {
                                            echo "alert('com_audit_doc ok')";
                                        }
                                        else{
                                            echo "alert('com_audit_doc no')";
                                        }
                                        if(mysqli_query($db,"insert into com_volunteer_dev_plan (title,description,com_id) values ('Introduction','Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')('Goal','Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')"))
                                        {
                                            echo "alert('com_volunteer_dev_plan ok')";
                                        }
                                        else{
                                            echo "alert('com_volunteer_dev_plan no')";
                                        }
                                        if(mysqli_query($db,"insert into com_need_and_aspirations (description,com_id) values ('Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')"))
                                        {
                                            echo "alert('com_need_and_aspirations ok')";
                                        }
                                        else{
                                            echo "alert('com_need_and_aspirations no')";
                                        }
                                        if(mysqli_query($db,"insert into com_cps_audit_des (description,com_id) values ('Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')"))
                                        {
                                            echo "alert('com_cps_audit_des ok')";
                                        }
                                        else{
                                            echo "alert('com_cps_audit_des no')";
                                        }
                                        if(mysqli_query($db,"insert into com_opportunity_intro (description,com_id) values ('Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')"))
                                        {
                                            echo "alert('com_opportunity_intro ok')";
                                        }
                                        else{
                                            echo "alert('com_opportunity_intro no')";
                                        }
                                        if(mysqli_query($db,"insert into com_volunteer_important_info (title,description,com_id) values ('Eat','Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')('Sleep','Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')('Safety','Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')('Travel Information','Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')('Cost & Availability','Duis ante turpis, venenatis ut justo commodo, gravida maximus quam. Nulla at felis massa. Ut dictum vulputate diam, id consequat mi congue at. Proin molestie sit amet turpis non tin cidunt. Nulla tincidunt vestibulum est ac dictum. Maecenas porta si amet tortor at blandit. Suspendisse et venenatis mi.','$comId')"))
                                        {
                                            echo "alert('com_volunteer_important_info ok')";
                                        }
                                        else{
                                            echo "alert('com_volunteer_important_info no')";
                                        }
                                }
                                echo "success";
                            }
                            else{
                                echo "fail insert to com";
                            }

                        }
                    }

                    else{
                        echo " fail insert to group<br>";
                    }
                }
            }
     ?>
</head>
<body>
<div class="container">
	<div class="text">
		<center>
		<h2 style="color:pink;">Create a Page for Your Community!</h2>
        <p>Proin at condimentum elit, quis ornare mauris. Vivamus sit amet velit massa. Curabitur vitae velit tortor. Donec ut facilisis urna</p>
		</center>
		<hr>
	<form method="post" style="width:850px;" enctype="multipart/form-data" class="form-contact" >
		<h4>Community Information</h4>
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
                <textarea  name="address" style="height:70px; width:100%;margin-bottom:0px; padding: 0px 10px;" required="" placeholder="E.g. No.17 Street 604 Toul Kork District, Phnom Penh, Cambodia"></textarea>
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
                <textarea style="height:70px; width:100%; margin-bottom:0px;  padding: 0px 10px;"  name="map" placeholder="E.g. https://www.google.com.kh/maps/place/Codingate/@11.573362,104.892621,17z/data=!3m1!4b1!4m2!3m1!1s0x310951761b0efa99:0x83be8a97765e155?hl=en"></textarea>
            </div>
        </div>
        <div class="row">
	        <div class="col-md-6">
                <p>What is community Introduction ? </p>
            </div>
            <div class="col-md-6">
                <textarea  style="height:70px; width:100%; padding: 0px 10px;" name="introduction" placeholder="E.g. Tags:cartoon wallpapers HD, featured, funny cartoon sayings, funny minions quotes, funny momment cartoons, miniones quotes 2014, minions funny pictures, ..."></textarea>
            </div>
	    </div>
	    <div class="row">
	        <div class="col-md-6">
                <p>Do you have your community Image ? <span style="color:red;">*</span> </p>
            </div>
            <div class="col-md-6">
           		<input type="file" name="pic_com">
            </div>
	    </div>
	    <input type="submit" name="save" value="Show my Community" style="margin-left:40%;" class=" btn btn-xs btn-submitbtn-info btn-cps">
	</form>
	</div>
</div>
	
</body>
</html>