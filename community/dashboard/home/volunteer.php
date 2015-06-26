<div class="btn_slide">
    <a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer_now"><button class="btn invole " style="  margin-right: 4%; margin-left: 20%;">Volunteer Now</button></a>
    <a  href="#" data-toggle="modal" data-target=".send_mail_to_cps_admin"><button class="btn invole " >Inquire Here</button></a>
</div>  

<div id="wowslider-container1">

    <div class="ws_images">
        <ul>
            <?php
            $slide_data = mysqli_query($db, "SELECT * FROM com_slideshow WHERE com_id = '$com_id'");
            foreach ($slide_data as $value) {
                ?>
                <li>
                <center><p class="header_cover" style="  font-size: 28px;font-weight: bold;padding: 20px;">LOREM CONSECTETUR ADIPSCING ELTLOREM</p></center>
                <img src="<?php echo $base_url; ?>images/com_slideshows/<?php echo $value['file_name']; ?>"  title="<?php echo $value['slide_des']; ?>" id=""/>
                </li>
            <?php } ?>
        </ul>
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
    </div>
    <div class="map">
        <?php echo $map; ?>
        <a  href="#" data-toggle="modal" data-target=".send_mail_to_cps_admin"><button class="btn invole v_name_btn" >Get Involved</button></a>
        <a href="http://www.facebook.com/share.php?u=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>&title=[TITLE]"><button class="btn invole" ><i class="fa fa-facebook"></i>&nbsp;&nbsp; Tell a friend</button></a>

    </div>
</div>
<div style="clear:both"> </div>
<?php if ($group_owner_id == $uid) { ?>
    <div class="volunteer_menu">
        <?php
        if (isset($_GET['volunteer'])) {
            $volunteer = $_GET['volunteer'];
        } else {
            $volunteer = "deverlopment_plan";
        }
        ?>
        <ul class="menu_volunteer">
                <!--<li class='<?php echo $volunteer == "home" ? "active" : ""; ?>'><a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=health&tab=volunteer&volunteer=home"><i class="glyphicon glyphicon-home"></i></a></li>-->
            <li class='<?php echo $volunteer == "deverlopment_plan" ? "active" : ""; ?>'><a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer&volunteer=deverlopment_plan">Our Development Plan</a></li>
            <li class='<?php echo $volunteer == "opportunity" ? "active" : ""; ?>'><a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer&volunteer=opportunity">Volunteer Opportunities</a></li>
            <li class='<?php echo $volunteer == "important_info" ? "active" : ""; ?>'><a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer&volunteer=important_info">Important <br> Info</a></li>
        </ul>
    </div>
<?php } else if ($_GET['gid']) { ?>
    <div class="volunteer_menu">
        <?php
        if (isset($_GET['volunteer'])) {
            $volunteer = $_GET['volunteer'];
        } else {
            $volunteer = "deverlopment_plan";
        }
        ?>
        <ul class="menu_volunteer">
                <!--<li class='<?php echo $volunteer == "home" ? "active" : ""; ?>'><a href="<?php echo $base_url; ?>community_follow.php?gid=<?php echo $gid; ?>&tab=volunteer&volunteer=home"><i class="glyphicon glyphicon-home"></i></a></li>-->
            <li class='<?php echo $volunteer == "deverlopment_plan" ? "active" : ""; ?>'><a href="<?php echo $base_url; ?>community_follow.php?gid=<?php echo $gid; ?>&tab=volunteer&volunteer=deverlopment_plan">Our Development Plan</a></li>
            <li class='<?php echo $volunteer == "opportunity" ? "active" : ""; ?>'><a  href="<?php echo $base_url; ?>community_follow.php?gid=<?php echo $gid; ?>&tab=volunteer&volunteer=opportunity">Volunteer Opportunities</a></li>
            <li class='<?php echo $volunteer == "important_info" ? "active" : ""; ?>'><a  href="<?php echo $base_url; ?>community_follow.php?gid=<?php echo $gid; ?>&tab=volunteer&volunteer=important_info">Important<br><br> Info</a></li>
        </ul>

    </div>
<?php } ?>
<div style="clear:both"></div>
<br>
<div class="">
    <?php
    if (isset($_GET['volunteer'])) {
        $page = $_GET['volunteer'];
    } else {
        $page = "deverlopment_plan";
    }
    include("volunteer/" . $page . ".php");
    ?>
</div>
<script type="text/javascript" src="<?php echo $base_url; ?>js/com_slidshow/wowslider.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>js/com_slidshow/script.js"></script>