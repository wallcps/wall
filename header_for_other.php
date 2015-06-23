<?php
if($profile_uid)
{
	/*Timeline Profile Views*/
	if($uid!=$profile_uid)
	{
	$Wall->Profile_Viewed($uid,$profile_uid);
        }
        /*Timeline Profile Values*/
	if(empty($session_profile_bg))
	{
	$margin='margin-top:-160px';
	}
	$timelineBG=$base_url.$upload_path.$session_profile_bg;
	$loginCheck=0;
	if($profile_uid==$uid)
	{
	$loginCheck=1;
	}
	$timeline_pic=$profileface;
	$position=$session_profile_bg_position;
	$timeline_name=$Wall->UserFullName($username);
	$verified=$session_verified;
}
?>

<div id="div-main-menu">
    <?php if($login) { ?>
    <div class="row" id="div-menu-top">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-2">
                    <img src="<?php echo $base_url; ?>images/logo.png"/>
                </div>
                <div class="col-lg-8 search-box">
                <input type="text" class="topbarSearch" id="searchinput" placeholder="Communities, Organizations Projects and Valenteers"  data-step="2" data-intro="Search for Friends and Groups."/>
                <div id="display" ></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 top-menu">
            <ul class="nav navbar-nav navbar-right">
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
                    <a href="<?php echo $base_url.'messages.php';  ?>" data-step="6" data-intro="Your messages."><i class="glyphicon glyphicon-envelope"></i>
                        <?php if($session_conversation_count>0) {
                            echo "<i id='conversation_count' class='msg_count'>$session_conversation_count</i>";
                        }else{
                            echo "<i>0</i>";
                        } ?>
                    </a>

                </li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                <li class="focus-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-globe"></i> English</a>
                    <ul class="dropdown-menu text-center" role="menu" id="dropdown-language">
                        <a href="#">Report a problem</a>
                        <a href="#">Privacy  </a>
                        <a href="#">Setting </a>
                        <a href="<?php echo $base_url.'logout.php'; ?>">Log Out </a>

                    </ul>
                </li>
                <li class="focus-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> Account</a>
                    <ul class="dropdown-menu text-right" role="menu" id="dropdown-account">
                        <li><a href="#">Report a problem</a></li>
                        <li><a href="#">Privacy  </a></li>
                        <li><a href="#">Setting </a></li>
                        <li><a href="<?php echo $base_url.'logout.php'; ?>">Log Out </a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div  id="timelineNav">
        <i id="link-up" class="glyphicon glyphicon-chevron-up arrow-link-main-menu"></i>
        <i id="link-down" class="glyphicon glyphicon-chevron-down arrow-link-main-menu"></i>
        
        <ul class="menu-main">
            
            <li><span class="glyphicon glyphicon-home"></span> Dashboard</li>
            
        </ul>

        <div id="right-menu-main">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <label class="white-text">Viewing as:</label>
                    <select class="view-select">
                        <option value="volunteer">Volunteer</option>
                        <option value="community">Community</option>
                        <option value="organization">Organization</option>
                    </select>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle white-text" data-toggle="dropdown" role="button" aria-expanded="false">Create Listing <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" id="create-list">
                        <li><a href="<?php echo $base_url . 'index.php?p=my_createproject'; ?>">Create a Project &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="glyphicon glyphicon-exclamation-sign text-right"></label></a></li>
                        <li><a href="#">List a Community &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-exclamation-sign text-right"></span></a></li>
                        <li><a href="#">List an Organization <span class="glyphicon glyphicon-exclamation-sign text-right"></span></a></li>
                    </ul>
                </li>

            </ul>
            <!--   <a href="#"  class='wallbutton messageButton'>Language</a>
                <a href="#"  class='wallbutton messageButton'>Create</a>-->
        </div>
    </div>
</div>
<?php } else { ?>
<li><a href="<?php echo $base_url; ?>">Login</a></li>
<li><a href="<?php echo $base_url; ?>">Sign Up</a></li>
<?php	} ?>


<script type="text/javascript">
    $("#link-down").hide();
    $("#timelineNav #link-up").click(function(){
        $("#div-menu-top").slideToggle();
        $("#link-down").slideDown();
        $("#link-up").slideUp();
        $(".div-content").css("margin-top","50px");
        
    });
    $("#timelineNav #link-down").click(function(){
        $("#div-menu-top").slideToggle();
        $("#link-down").slideUp();
        $("#link-up").slideDown();
        $(".div-content").css("margin-top","125px");
        
    });
</script>
