<?php

if($_GET['p']){
        $page = $_GET['p'];
    }  else {
        $page = '';
    }


if($_GET['com']){
        $page = $_GET['com'];
    }  else {
        $page = '';
    }
    
    
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
        $message .= "<tr style='background: #eee;'><td><strong>Community Name:</strong> </td><td>" . strip_tags($com_name) . "</td></tr>";

        $message .= "</table>";
        $message .= "</body></html>";
        mail($to,$subject,$message,$headers);

          //Email response
        $message_success = "Your message have been sent to adminitrator. Thank you for contacting us!";

    }
?>

<div id="div-main-menu">
    <div id="div-menu-top">
        <div class="header_left">
            <div>
                <div class="logo">
                    <img src="<?php echo $base_url; ?>images/logo.png"/>
                </div>
                <div class="search-box">
                <input type="text" class="topbarSearch" id="searchinput" placeholder="Communities, Organizations Projects and Valenteers"  data-step="2" data-intro="Search for Friends and Groups."/>
                <div id="display" ></div>
                </div>
            </div>
        </div>
        <div class="header_right top-menu">
            <ul class="notivication_menu clearfix" role="navigation">
                <li class="li-notification">
                    <a href="#" id="notificationLink" data-step="5" data-intro="Notifications."><i class="glyphicon glyphicon-bell"></i>
                        <?php
                        if($notifications_count>0){
                            echo "<i id='conversation_count' class='not_count'>$notifications_count</i>";
                        }else{
                            echo "<i>0</i>";
                        } 
                        ?>
                    </a>
                    <?php include_once 'block_notification.php'; ?>
                </li>

                <li class="li-notification">
                  
                    <!--<a href="<?php //echo $base_url.'messages.php';  ?>" data-step="6" data-intro="Your messages."><i class="glyphicon glyphicon-envelope"></i-->
                        <?php //if($session_conversation_count>0) {
                            //echo "<i id='conversation_count' class='msg_count'>$session_conversation_count</i>";
                        //}else{
                            //echo "<i>0</i>";
                        //} ?>
                    <!--</a>-->

                </li>
             
                <li><a href="#" data-toggle="modal" data-target=".send_mail_to_cps_admin"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                <li class="focus-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-globe"></i> English</a>
                    
                </li>
                <li class="focus-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> Account</a>
                    <ul class="dropdown-menu text-right" role="menu" id="dropdown-account">
                        <li><a href="#" data-toggle="modal" data-target=".send_mail_to_cps_admin">Report a problem</a></li>
                        <li><a href="#">Privacy  </a></li>
                        <li><a href="#">Setting </a></li>
                        <li><a href="<?php echo $base_url.'logout.php'; ?>">Log Out </a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div  id="timelineNav-full">
    <div  id="timelineNav">
        <i id="link-up" class="glyphicon glyphicon-chevron-up arrow-link-main-menu"></i>
        <i id="link-down" class="glyphicon glyphicon-chevron-down arrow-link-main-menu"></i>
        
        <ul class="menu-main">
            
            <li <?php echo ($page == 'dashboard') ? "class='active'" : ""; ?>>
                <?php echo $arrow_updates ?>
                <a href='<?php echo $base_url . 'community.php?gid='.$gid.'&com=dashboard'; ?>'><span class="glyphicon glyphicon-home"></span>Dashboard</a></li>
            <li <?php echo ($page == 'booking') ? "class='active'" : ""; ?>>
                <?php echo $arrow_profile ?>
                <a href='<?php echo $base_url . 'community.php?gid='.$gid.'&com=booking'; ?>'><span class="glyphicon glyphicon-user"></span> Booking</a></li>
            <li <?php echo ($page == 'project') ? "class='active'" : ""; ?>>
                <?php echo $arrow_discover ?>
                <a href='<?php echo $base_url . 'community.php?gid='.$gid.'&com=project'; ?>'><span class="glyphicon glyphicon-globe"></span> Project</a></li>
        </ul>

        <div id="right-menu-main">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <label class="white-text">Viewing as:</label>
                    <select class="view-select" onChange="window.location.href=this.value" disabled="">
                        <!--<option value="volunteer">Volunteer</option>-->
                        <option value="<?php echo $base_url; ?>community/community.php?com=dashboard">Community</option>
                        <!--<option value="organization">Organization</option>-->
                    </select>
                </li>

            </ul>
            <!--   <a href="#"  class='wallbutton messageButton'>Language</a>
                <a href="#"  class='wallbutton messageButton'>Create</a>-->
        </div>
    </div>
    </div>
</div>



<!-- Popup send email to CPS admin  -->

<div class="modal fade send_mail_to_cps_admin" id="send_mail_to_cps_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype='multipart/form-data' action="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel"> Contact CPS Admin </h4>
                </div>

                <div class="modal-body">
                    <label class="alert alert-heading">Thank you for your interest in us. Please use this form to contact us</label>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Please tell us who you are</span>
                            <select class="form-control contact">
                                <option>e.g Community, Visitor...</option>
                                <option>Community</option>
                                <option>Visitor</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <span>Please tell us who you are</span>
                            <select class="form-control contact">
                                <option>e.g Service, Complain...</option>
                                <option>Service</option>
                                <option>Complain</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Please tell us your name</span>
                            <input name="name" class="form-control contact" placeholder="Name" required="" value="<?php echo $session_first_name.' '.$session_last_name; ?>"/>
                        </div>
                        <div class="col-md-6">
                            <span>Please inter your email address</span>
                            <input class="text- form-control contact" name="email"  value="<?php echo $session_email; ?>" type="email" placeholder="Email" required=""/>
                        </div>
                    </div>
                    <div class="form_contact">
                        <span>Please drop your message here </span>
                        <textarea style="height: 150px;" class="form-control contact" name="comment" rows="15" cols="40" placeholder="Message" required=""></textarea><br />
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="submit_contact_cps_admin" name="submit_contact_cps_admin" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- End Popup -->



<script type="text/javascript">
    $("#link-down").hide();
    $("#timelineNav #link-up").click(function(){
        $("#div-menu-top").slideToggle();
        $("#link-down").slideDown();
        $("#link-up").slideUp();
        $(".div-content").css("margin-top","10px");
        
    });
    $("#timelineNav #link-down").click(function(){
        $("#div-menu-top").slideToggle();
        $("#link-down").slideUp();
        $("#link-up").slideDown();
        $(".div-content").css("margin-top","10px");
        
    });
</script>