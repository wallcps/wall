<?php 
    if (isset($_POST['submit_volunteer_now'])){

        $fname          = $_POST['fname'];
        $lname          = $_POST['lname'];
        $gender         = $_POST['gender']==1?"Male":"Female";
        $dob            = $_POST['dob'];
        $country        = $_POST['usr_country'];
        $nationality    = $_POST['nationality'];
        $email          = $_POST['email'];
        $phone          = $_POST['usr_phone']." ".$_POST['phone'];
        $mailing        = $_POST['mailing'];
        $q1             = $_POST['q1'];
        $q2             = $_POST['q2'];
        $q3             = $_POST['q3'];
        $q4             = $_POST['q4'];
        $q5             = $_POST['q5'];

        $subject = 'Want To Volunteer';
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
        $message .= "<tr style='background: #eee;'><td><strong>Full Name:</strong> </td><td>" . strip_tags($fname)." ". strip_tags($lname) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Gender:</strong> </td><td>" . strip_tags($gender) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Date Of Birth:</strong> </td><td>" . strip_tags($dob) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Country:</strong> </td><td>" . strip_tags($country) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Nationality:</strong> </td><td>" . strip_tags($nationality) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Email :</strong> </td><td>" . strip_tags($email) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Phone :</strong> </td><td>" . strip_tags($phone) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Mailing Address :</strong> </td><td>" . strip_tags($mailing) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>How would you like to support us? :</strong> </td><td>" . strip_tags($q1) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>If you would like to volunteer/visit us, when can you com? :</strong> </td><td>" . strip_tags($q2) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>What would you like to do? :</strong> </td><td>" . strip_tags($q3) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Why are you interesting in coming? :</strong> </td><td>" . strip_tags($q4) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Is there anything else that you would to ask or tell us? :</strong> </td><td>" . strip_tags($q5) . "</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Sent From Community Name:</strong> </td><td>" . strip_tags($com_name) . "</td></tr>";

        $message .= "</table>";
        $message .= "</body></html>";
        mail($to,$subject,$message,$headers);
        
        echo '<script>window.location = "'.$base_url.'community.php?gid='.$gid.'&com=dashboard&tab=welcome";</script>';
       
    }

?>

<div class="text">
    <h3 class="text-center">Please give us your persional information !</h3>
    <h4 style="font-weight:bold;">Basic Information</h4>
    <hr>
    <?php
    $com_admin = mysqli_query($db, "SELECT * FROM users WHERE users.uid = '$uid'");
    foreach ($com_admin as $value) {
        ?>

    <form method="post" class="form-horizontal" action="">
            <div style="padding-left:10%;">
                <div class="form-group">
                    <span class="form-control-span col-xs-3">First Name:</span>
                    <div class="col-xs-8">
                        <input class="text- form-control" value="<?php echo $value['first_name']; ?>" name="fname" type="text"/>
                    </div>
                </div>
                <div class="form-group">
                    <span class="form-control-span col-xs-3">Last Name:</span>

                    <div class="col-xs-8">
                        <input class="text- form-control" name="lname" type="text" value="<?php echo $value['last_name']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <span class="form-control-span col-xs-3">Gender:</span>
                    <div class="col-xs-8">
                        <select class="form-control" name="gender">
                            <option value="1" <?php echo $value['gender'] == 1 ? "selected" : "" ?>>Male</option>
                            <option value="2" <?php echo $value['gender'] == 2 ? "selected" : "" ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <span class="form-control-span col-xs-3">Date of Birth:</span>
                    <div class="col-xs-8">
                        <input class="text- form-control" name="dob" type="date" value="<?php echo $value['birthday']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <span class="form-control-span col-xs-3">Country:</span>
                    <div class="col-xs-8">
                        <input class="text- form-control" value="<?php echo $value['country']; ?>" name="country" type="text"/>
                    </div>
                </div>
                <div class="form-group">
                    <span class="form-control-span col-xs-3">Nationality:
                    </span>
                    <div class="col-xs-8">
                        <input type="text" name="nationality" class="text- form-control" value="<?php echo $value['nationality'] ?>">

                    </div>
                </div>
                <div class="form-group">
                    <span class="form-control-span col-xs-3">Email Address:</span>
                    <div class="col-xs-8">
                        <input class="text- form-control" name="email" type="email" value="<?php echo $value['email']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <span class="form-control-span col-xs-3">Phone Number:</span>
                    <div class="col-xs-2">
                        <input type="text" name="usr_phone" id="inputCode" class="text-input form-control" style=" float: left;" value="<?php echo $_POST['usr_phone']; ?>" AUTOCOMPLETE='OFF'/>
                    </div>
                    <div class="col-xs-6">
                        <input class="text- form-control" name="phone" type="text" value="<?php echo $value['phone'] ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <span class="form-control-span col-xs-3">Mailing Address:</span>
                    <div class="col-xs-8">
                        <textarea style="height:80px;width:100%;" name="mailing"><?php echo $value['address'] ?></textarea>
                    </div>
                </div>
            </div>
            <h4 style="font-weight:bold;">Support us</h4>
            <hr>
            <div style="padding-left:2%;">
                <div class="form-group">
                    <div class="col-xs-11">
                        <span>How would you like to support us?</span>
                    </div>
                    <div class="col-xs-11">
                        <input type="text" class="form-control" name="q1" placeholder="E.g Visit us, Donate us, Volunteer with us">
                    </div>
                </div>
            </div>

            <h4 style="font-weight:bold;">Volunteer/Visit us </h4>
            <hr>
            <div class="form-group"style="padding-left:2%;">
                <div class="col-xs-11">
                    <span>If you would like to volunteer/visit us, when can you come?</span>
                </div>
                <div class="col-xs-11">
                    <textarea style="height:80px;width:100%;" name="q2"></textarea>
                </div>
            </div>
            <div class="form-group"style="padding-left:2%;">
                <div class="col-xs-11">
                    <span>What would you like to do?</span>
                </div>
                <div class="col-xs-11">
                    <textarea style="height:80px;width:100%;" name="q3"></textarea>
                </div>
            </div>
            <div class="form-group"style="padding-left:2%;">
                <div class="col-xs-11">
                    <span>Why are you interesting in coming?</span>
                </div>
                <div class="col-xs-11">
                    <textarea style="height:80px;width:100%;" name="q4"></textarea>
                </div>
            </div>
            <h4 style="font-weight:bold;">Other Information</h4>
            <hr>
            <div class="form-group"style="padding-left:2%;">
                <div class="col-xs-11">
                    <span>Is there anything else that you would like to ask or tell us?</span>
                </div>
                <div class="col-xs-11">
                    <textarea style="height:80px;width:100%;" name="q5"></textarea>
                </div>
            </div>

            <div class="form-group" style="padding-left:10%;">
                <input type="checkbox">
                <span>I want to receive more volunteer opportunities from CPS</span>

            </div>
            <div style="padding-left:30%;">
                <input type="submit" class="btn btn-primary btn_v" value="Submit" name="submit_volunteer_now">
                <input type="reset" class="btn btn-danger btn_v" style="background-color:#FF359A !important; color:#fff !important;" value="Reset" name="reset">
                <a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=home"><input type="button" class="btn btn_v btn_back" style="background-color:#fff !important; border:1px solid #ccc;" value="Back" name="back"></a>
            </div>


        </form>
<?php } ?>
</div>
<style type="text/css">
    .btn_v{
        margin: 0px 30px 0px 0px;
        padding-left: 5%;
        padding-right: 5%;
    }
    .btn_back:hover{
        color:black;
    }
</style>