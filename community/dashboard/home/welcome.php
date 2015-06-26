<?php
$com_welcome_post = mysqli_query($db, "select * from com_tab_welcome  WHERE com_id = '$com_id' AND disabled = 0");
//data community .............    
?>
<style type="text/css">
    .slide_cover{
        position: absolute;
        width: 100%;
        height: auto;
        background-color: #000;
    }
</style>
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
                     <label class="header_cover"><p style="  font-size: 28px;font-weight: bold;float:right;  margin-top: 11px;">LOREM CONSECTETUR ADIPSCING ELTLOREM</p></label>
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
        <p class="body_content"><?php echo $admin_des; ?></p>
    </div>
    <div class="map">
        <?php echo $map; ?>
        <a href="#" data-toggle="modal" data-target=".send_mail_to_cps_admin"><button class="btn invole v_name_btn">Get Involved</button></a>
        <a href="http://www.facebook.com/share.php?u=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>&title=[TITLE]"><button class="btn invole " style="width:45%;"><i class="fa fa-facebook"></i>&nbsp;&nbsp; Tell a friend</button></a>

    </div>
</div>

<div style="clear:both"></div>
<div class="what_can_do text">
    <?php
    $contents = mysqli_query($db, "select * from com_welcome_content where com_id= " . $com_id . ";");
    ?>
    <center>
        <p><h3>What can you do here?</h3>
            <?php if ($group_owner_id == $uid) { ?>
                <span class="edit-icon"><a data-toggle="modal" data-target='#edit_title' href=""><i class="glyphicon glyphicon-edit"></i></a></span>
            <?php } ?>
        </p>
    </center>
    <?php foreach ($contents as $content) { ?>
        <div class="row_content2">
            <h4 style="font-weight:bold;"><?php echo $content['title']; ?></h4>
            <p class="p"><?php echo $content['content']; ?></p>
        </div>

            <div class="modal fade" id="edit_title" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Edit What you can do here</h4>
                        </div>
                        <div class="modal-body" id="editor_1">
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $content['title']; ?>"/>
                            <textarea class="sn_editor" style="height:150px; width:100%;" name="content" id="content"> <?php echo $content['content']; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                            <button id="<?php echo $content['id']; ?>" name="save" class="btn btn-sm btn-primary update-content">Update</button>
                        </div>
                    </div>
                </div>
            </div>
<?php } ?>
</div>
<div class="text">
    <center>
        <p><h3>What can you do here?</h3>
            <?php if ($group_owner_id == $uid) { ?>
                <span class="edit-icon" style="  margin-top: 7px;"><a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=edit_com_welcome"><i class="glyphicon glyphicon-edit"></i></a></span>
<?php } ?>
        </p>
        <p>Ut scelerisque tellus nec ipsum fermentum, eget mollis eros commdo.</p>
    </center>
    <div class="row_container">
        <?php
        foreach ($com_welcome_post as $res) {
            ?>
            <div class="row">
                <div class="row_img">
                    <img src="<?php echo $base_url; ?>images/commnunities/welcome/<?php echo $res['image']; ?>">
                </div>
                <div class="row_content">
                    <h4 style="font-weight: bold;"><?php echo $post_title = $res['title']; ?></h4>
                    <p class="p"><?php echo $post_content = $res['decription']; ?></p>
                </div>
            </div><br/><br/>
<?php } ?>
    </div>
</div>
<a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer_now"><button class="btn invole " style="  margin-right: 2%; margin-left: 30%;">Volunteer Now</button></a>
<a  href="#" data-toggle="modal" data-target=".send_mail_to_cps_admin"><button class="btn invole " >Inquire Here</button></a>
<a href="http://www.facebook.com/share.php?u=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>&title=[TITLE]"><button class="btn invole" style="margin-left:2%;"><i class="fa fa-facebook"></i>&nbsp;&nbsp; Tell a friend</button></a>
<br>
<br>
<!--slidshow communities-->
<script type="text/javascript" src="<?php echo $base_url; ?>js/com_slidshow/wowslider.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>js/com_slidshow/script.js"></script>
<script type="text/javascript">
    
    //text editor......
    qy210(".sn_editor").Editor();
    var ele1 = document.getElementById('editor_1').getElementsByClassName('Editor-editor');
    ele1[0].innerHTML = $("#content").val();
    
    
    
    $('.update-content').click(function (){
        var id = $(this).attr('id');
        var title = $('#title').val();
        var content = $("#editor_1 .Editor-editor").html();
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>community/ajax_community.php',
            data: {
                content: content,
                id: 1,
                title: title,
                welcome: 'welcome',
            },
            success: function (data) {
                location.reload();
            }, error: function (data) {
                alert(data);
            }
        });
    });
</script>

