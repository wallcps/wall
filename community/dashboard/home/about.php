<div class="btn_slide">
    <a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=health&tab=volunteer_now"><button class="btn invole " style="  margin-right: 4%; margin-left: 20%;">Volunteer Now</button></a>
    <a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=health&tab=volunteer_now"><button class="btn invole " >Inquire Here</button></a>
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
<div class="village_name text">
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
                <button class="btn invole " >Get Involved</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn invole"><i class="fa fa-facebook"></i>&nbsp;&nbsp; Tell a friend</button>
        </div>
</div>
 <div style="clear:both"></div>
<div class="text" style="  margin-top: -10px;">
    <p style="font-weight: bold;font-size: 22px;">About Us</p>
    <hr style="margin:-8px;" />
    <div class="media">
        <div class="media-left media-middle">
            <a href="#">
                <img width="100px" src="<?php echo $base_url; ?>images/commnunities/introduction.png">
            </a>
        </div>
        <div class="media-body">
            <?php
            $data_about = mysqli_query($db, "SELECT * FROM com_tab_about WHERE title='Introduction' AND com_id='$com_id'");
            foreach ($data_about as $value) {
                ?>
                <h4 class="media-heading" style="font-weight: bold;"><?php echo $value['title']; ?>
                    <?php if($group_owner_id==$uid){ ?>
                    <a href="" data-toggle="modal" data-target="#edit_intro"><i class="glyphicon glyphicon-edit" style="float:right;"></i></a>
                    <?php } ?>
                </h4>
                <p><?php echo $value['description']; ?></p>
                <!-- Popup Edit Introduction -->
                <div class="modal fade" id="edit_intro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Edit Introduction</h4>
                            </div>
                            <div class="modal-body">
                                <textarea name="desc" id="desc" style="width:100%; height:150px;"><?php echo $value['description']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="<?php echo $value['id']; ?>" name="update_intro" class="btn btn-primary update_text">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <p class="text-right text-primary"><i class="glyphicon glyphicon-minus-sign"></i> Minimize</p>
    </div>
</div>
<div class="text text-center">
    <h4>Theory of change dashboard</h4>
    <h4>(Embeded From Google Doc)</h4>
</div>
<div class="text">
    <div class="media">
        <div class="media-left media-middle">
            <a href="#">
                <img width="100px" src="<?php echo $base_url; ?>images/commnunities/goal_360.png">
            </a>
        </div>
        <div class="media-body">
            <?php
            $data_about = mysqli_query($db, "SELECT * FROM com_tab_about WHERE title = 'Goals' and com_id = '$com_id'");
            foreach ($data_about as $value) {
                ?>
                <h4 class="media-heading" style="font-weight:bold;"><?php echo $value['title']; ?>
                    <?php if($group_owner_id==$uid){ ?>
                    <a href="" data-toggle="modal" data-target="#edit_goal"><i class="glyphicon glyphicon-edit" style="float:right;"></i></a>
                    <?php } ?>
                </h4>
                <p><?php echo $value['description']; ?></p>
                <!-- Popup Edit Introduction -->
                <div class="modal fade" id="edit_goal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Edit Introduction</h4>
                                </div>
                                <div class="modal-body">
                                    <textarea name="desc1" id="desc1" style="width:100%; height:150px;"><?php echo $value['description']; ?></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button id="<?php echo $value['id']; ?>" name="submit_goals" class="btn btn-primary update_goals">Save</button>
                                </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <p class="text-right text-primary"><i class="glyphicon glyphicon-plus-sign"></i> Read More</p>
    </div>
</div>
 <a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=health&tab=volunteer_now"><button class="btn invole " style="  margin-right: 2%; margin-left: 30%;">Volunteer Now</button></a>
       <a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=health&tab=volunteer_now"><button class="btn invole " >Inquire Here</button></a>
       <a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=health&tab=volunteer_now"><button class="btn invole" style="margin-left:2%;"><i class="fa fa-facebook"></i>&nbsp;&nbsp; Tell a friend</button></a>
       <br>
       <br>
<script type="text/javascript" src="<?php echo $base_url; ?>js/com_slidshow/wowslider.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>js/com_slidshow/script.js"></script>

 <script>
    $('.update_text').click(function(){
        var desc = $('#desc').val();
        var id  = $(this).attr('id');
        $.ajax({
            type:'POST',
            url:'<?php echo $base_url; ?>community/ajax_community.php',
            data:{
               desc    :desc,
               id      :id,
               update   :'Introduction',
               update_type  :'edit_com_about_intro',
            },
            success:function(data){
                location.reload();
            },error:function(data){
                alert(data);
            }
        });
    });
    $('.update_goals').click(function(){
        var desc = $('#desc1').val();
        var id  = $(this).attr('id');
        $.ajax({
            type:'POST',
            url:'<?php echo $base_url; ?>community/ajax_community.php',
            data:{
               desc    :desc,
               id      :id,
               update_type  :'edit_com_about_intro',
            },
            success:function(data){
                location.reload();
            },error:function(data){
                alert(data);
            }
        });
    });
</script>