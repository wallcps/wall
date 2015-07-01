<style>
    .form-contact input{
        margin-bottom: 10px !important;
        width:100%;
    }
    .form-contact .btn-submit{
        color:pink;
        background-color: white;
        border:1px solid pink;
        padding:3px 30px;
        width:30px;
    }
    
</style>


<?php
$email_userown = $Wall->userEmail($group_owner_id);
$message_success = '';
//if "email" variable is filled out, send email
if (isset($_POST['submit_contact_cps_admin'])){
    
    $full_name  = $_POST['name'];
    $email      = $_POST['email'];
    $comment    = $_POST['comment'];
    $user_type  = $_POST['user_type'];
    $type_issue  = $_POST['type_issue'];
    
    $subject = 'Community Contact';
    $to = "king.fc168@gmail.com";
    $headers = "From: ".$_REQUEST['email']."\n".
    "CC: ".$ssemail.$email_userown['email']."\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $message = '<html><body>';
    $message .= '<p>Dear Administrator</p>';
    $message .= '<img src="'.$base_url.'/images/email-logo.png" alt="volunteerbetter logo" />';
    $message .= '<h2>Basic Information</h2>';
    $message .= '<table rules="all" style="border-color: #666;width:600px;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($full_name) . "</td></tr>";
    $message .= "<tr style='background: #eee;'><td><strong>Type of issue:</strong> </td><td>" . strip_tags($type_issue) . "</td></tr>";
    $message .= "<tr style='background: #eee;'><td><strong>Type of User:</strong> </td><td>" . strip_tags($user_type) . "</td></tr>";
    $message .= "<tr style='background: #eee;'><td><strong>Text:</strong> </td><td>" . strip_tags($comment) . "</td></tr>";
    
    $message .= "</table>";
    $message .= "</body></html>";
    mail($to,$subject,$message,$headers);

      //Email response
    $message_success = "Your message have been sent to adminitrator. Thank you for contacting us!";
      
}

?>
    <?php 
    // $contactus= $Wall->Project_Contact($proj_id);
    // $contact_descr = $contactus['contact_intro'];
    // $proj_id = $contactus['proj_id'];
    // echo $proj_id;
    // echo $contact_descr;
    ?>
    <?php

    if(isset($_POST['submit_com_pic'])){
        $old_image = $_POST['old_image'];
        $target_dir1 = "uploads/contact/";
        //for id card..........
        $temp1 = explode(".",$_FILES["update_pic_com"]["name"]);
        $filename1 = rand(1,99999) . '.' .end($temp1);
        $target_file1 = $target_dir1 . basename($filename1);
        
        //conditions cannot null.....
        if($_FILES['update_pic_com']['tmp_name'] == ''){
            echo 'false';
        }else{
            if(move_uploaded_file($_FILES["update_pic_com"]["tmp_name"],$target_file1)){
               $fileDelete =  $target_dir1.$old_image;
                unlink($fileDelete);
            } 
            else{
                echo " fail";
            } 
            mysqli_query($db," UPDATE com_contact_pic set image = '".$filename1."' where com_id = ".$com_id);
        }
        
    }
    $imgs = mysqli_query($db,"SELECT image FROM com_contact_pic WHERE com_id = '$com_id'");
        foreach ($imgs as $img) {
             $image = $img['image'];
        }
     $result = mysqli_query($db,"SELECT proj_id,contact_intro,contact_img FROM projects WHERE group_id = '$groupID'");
        foreach ($result as $value) {
            $pro_id = $value['proj_id'];
            $contact_decr = $value['contact_intro'];
            $contact_img = $value['contact_img'];
          

        }
    
    
    ?>
    
    <!-- start of -->
    <div>
                <a href="" style="top: 60px;position: absolute;" data-toggle="modal" data-target="#edit_pic"><i style="font-size: 35px;" class="glyphicon glyphicon-camera" original-title="Edit Contact Picture" data-toggle="modal"></i></a>
                    <!-- <i class="glyphicon glyphicon-pencil custom-file-input" data-toggle="modal" data-target="#edit_name" original-title="edit name"></i> -->
                    <div class="modal fade" id="edit_pic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Edit Community Picture</h4>
                                </div>
                                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="text-center"><img width="300px" src="<?php echo $base_url; ?>uploads/contact/<?php echo $image; ?>"/></div><br/>
                                        <input name="update_pic_com" id="com_pic" type="file" value="<?php echo $picture; ?>" accept="image/*"/>
                                        <input type="hidden" name="old_image" value="<?php echo $image; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit_com_pic" name="submit_com_pic" class="btn btn-sm btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        <img style="  width: 99.5%;" src="<?php echo $base_url; ?>uploads/contact/<?php echo $image;?>">
        <div class="contact_title">
            <h2 style="  padding-top: 10px;text-align: center;">Contact</h2>
        </div>
    </div>
    <div class="village_name">
        <div class="village_img">
                <img src="<?php echo $base_url; ?>uploads/<?php echo $picture; ?>">
        </div>
        <div class="content">
                <span class="title"><?php echo $com_name; ?></span>
                <br><br>
                <p class="address"><i class="glyphicon glyphicon-map-marker"></i> <?php echo $location; ?></p>
                <p class="body_content"><?php echo $des; ?></p>
                <p class="body_content"><?php echo $admin_des; ?></p>
        </div>
        <div class="map">
                <?php echo $map; ?>
                <a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer_now" ><button class="btn invole v_name_btn" >Get Involved</button></a>
                <a target="_blank" href="http://www.facebook.com/share.php?u=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>&title=[TITLE]"><button class="btn invole v_name_btn" ><i class="fa fa-facebook"></i>&nbsp;&nbsp; Tell a friend</button></a>
        </div>
    </div>
     <div style="clear:both"></div>
     <div class="block-right">
         <!-- <p class="text-right"><a href="" data-toggle="modal" data-target="#modal_contact"><i class="glyphicon glyphicon-edit"></i></a></p> -->
          
    <div class="modal fade" id="modal_contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" enctype='multipart/form-data' action="">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Edit Contact</h4>
            </div>
            <div class="modal-body">
                <!-- Image:  <input type="file" name="<?php //echo 'tl_image_'.$content_id; ?>" id="<?php //echo 'tl_image_'.$content_id; ?>" style="display:inline;"> -->
                <input type="file" id="contact_image" name="contact_image" value="<?php echo $contact_img; ?>"/><br/>
                <textarea id="recruitment_des" name="contact_descr" class="text-editor" style="width:540px; height:200px;"><?php echo $contact_decr; ?></textarea>
                
            </div>
            <div class="modal-footer">
                <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                <button id="submit_contact" name="submit_contact" class="btn btn-sm btn-primary update-profile">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<!-- the end of edit recrument -->
   <p class="text-right"></p>
<div class="text" style="margin-top:-10px;">
    <div><p><?php echo $contact_decr; ?></p></div> 
    <p style="font-size: 22px;font-weight: bold; margin-top:-15px;">Queries</p>
    <hr style="margin-top:-6px;">
    <form method="post" enctype='multipart/form-data' action="">
    <center>
        <p class="text-center" style="width:70%;" >Thank you for your interest in us. Please use this form to contact us</p>
    </center>
         <div class="text">
            <?php if($message_success!=''){ ?><p class="alert alert-success" style="text-align: center;"><?php echo $message_success; ?></p><?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <span>Please tell us who you are</span>
                    <select class="form-control contact" name="user_type">
                        <option>e.g Community, Visitor...</option>
                        <option>Community</option>
                        <option>Visitor</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <span>Please select type of issue</span>
                    <select class="form-control contact" name="type_issue">
                        <option>e.g Service, Complain...</option>
                        <option>Service</option>
                        <option>Complain</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <span>Please tell us your name</span>
                    <input class="form-control contact" name="name"  placeholder="Name" required="" value="<?php echo $session_first_name.' '.$session_last_name; ?>"/>
                </div>
                <div class="col-md-6">
                    <span>Please enter your email address</span>
                    <input class=" form-control contact" name="email"  value="<?php echo $session_email; ?>" type="email" placeholder="Email" required=""/>
                </div>
            </div>
            <div class="form_contact">
                <span>Please drop your message here </span>
                <textarea style="height: 150px;" class="form-control contact" name="comment" rows="15" cols="40" placeholder="Message" required=""></textarea><br />
            </div>

        </div>
        <button id="submit_contact_cps_admin" type="submit" style="  width: 20%;margin-top: -35px;float: right; margin-right: 17px;" name="submit_contact_cps_admin" class="btn btn-primary">Submit</button>

    </form>
</div>
<style type="text/css">
    .contact{
        margin-top: 15px;
    }
</style>