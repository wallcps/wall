
<style>
    .bootstrap-tagsinput{
        width:100% !important;
    }
</style>

<?php 
    $data_com_opport_intro = mysqli_query($db,"select * from com_opportunity_intro where  com_id= ".$com_id.";");
    
    
    $snid = $_GET['snid'];
    
    if(isset($_POST['submit_new_pp'])){
        $sn_id = $_POST['snid'];
        $new_pp_title = $_POST['new_pp_title'];
        $new_pp_keyword = $_POST['new_pp_keyword'];
        $new_pp_content = $_POST['new_pp_content'];
        
        $target_dir1 = "images/commnunities/program_and_plan/";
        //for id card..........
        $temp1 = explode(".",$_FILES["new_pp_pic"]["name"]);
        $filename1 = rand(1,99999) . '.' .end($temp1); 
        $target_file1 = $target_dir1 . basename($filename1);
        //move_uploaded_file($_FILES["new_sn_pic"]["tmp_name"],$target_file1);
        
        move_uploaded_file($_FILES["new_pp_pic"]["tmp_name"],$target_file1);
        
        if($_FILES["new_pp_pic"]["tmp_name"]==''){
            $filename1='';
        }        
        
        mysqli_query($db,"INSERT INTO com_program_and_plan(title,content,keyword,image,com_social_need_id) VALUES('$new_pp_title','$new_pp_content','$new_pp_keyword','$filename1',$sn_id)");
        
    }
    
    /* Edit program and plan */ 
    if(isset($_POST['submit_edit_pp']))
    {
        $pp_id = $_POST['edit_pp_id'];
        $pp_title = $_POST['edit_pp_title'];
        $pp_content = $_POST['edit_pp_content'];
        $pp_keyword = $_POST['edit_pp_keyword'];
        $old_pp_pic = $_POST['old_pp_pic'];
        
        $target_dir1 = "images/commnunities/program_plan/";
        //for id card..........
        $temp1 = explode(".",$_FILES["edit_pp_pic"]["name"]);
        $filename1 = rand(1,99999) . '.' .end($temp1); 
        $target_file1 = $target_dir1 . basename($filename1);
        //move_uploaded_file($_FILES["new_sn_pic"]["tmp_name"],$target_file1);
        
        move_uploaded_file($_FILES["edit_pp_pic"]["tmp_name"],$target_file1);
        
        if($_FILES["edit_pp_pic"]["tmp_name"]==''){
            $filename1=$old_pp_pic;
        }        
        
        mysqli_query($db,"UPDATE com_program_and_plan SET title='$pp_title',content='$pp_content',keyword='$pp_keyword',image='$filename1' WHERE id='$pp_id'");
        
    }
?>

<div class="text" style="margin-top:-10px;">
    <p style="font-size: 23px;font-weight: bold;">Introduction</p>
    <span class="edit-icon" style="  top: -9px;" ><a href="" data-toggle="modal" data-target='#com_opportunity_into'><i class="glyphicon glyphicon-edit"></i></a></span>
    <hr style="margin:-6px;"/>
    <br>
    <p style="font-size: 20px;font-weight: bold;">Introduction</p>
    <div class="row">
        <div class="col-lg-10-12">
        <?php foreach ($data_com_opport_intro as $data) { ?>
            <h4 class="media-heading"><?php echo $data['title']; ?></h4>
            
            <p style="text-align:justify;"><?php echo $data['description']; ?></p>
        </div>
    </div>
</div>

<div class="modal fade" id="com_opportunity_into" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Edit Introduction</h4>
            </div>
            <div class="modal-body">
                <textarea style="height:150px; width:100%;" name="update_com_opport_intro" id="update_com_opport_intro"><?php echo $data['description'] ; ?></textarea>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                    <button id="<?php echo $data['id'] ; ?>" name="update_com_opport" class="btn btn-sm btn-primary update_com_opport">Update</button>
                </div>
        </div>
    </div>
</div>
<?php } ?>
<div style="clear:both"></div>
<div class="row text">
    <div role="tabpanel" class="tab-pane">
        <span style="font-size: 24px; ">Programs And Plans</span><hr/>
        <?php if($snid){ ?><p class="text-right"><button style="margin-top: -110px;" id="sn_btn" class="btn btn-primary btn-xs btn-add-new" data-toggle="modal" data-target="#add_new_pp">Add Program and plan</button></p><?php } ?>
        
        <div class="col-lg-2">
            <img width="100px" src="<?php echo $base_url; ?>images/commnunities/icon/social_need.png">
        </div>
        
        <div class="col-lg-10 text-style">
            <p><?php echo $decom_social_need; ?></p>
            <?php 
                $data_program_and_plan = mysqli_query($db, "SELECT * FROM com_program_and_plan WHERE com_social_need_id='$snid' ORDER BY id DESC limit 10");
                foreach ($data_program_and_plan as $data_pp){
            ?>
            <div class="row aspiration-text">
                <div class="col-lg-3">
                    <a href="">
                        <img class="social-image" src="<?php echo 'images/commnunities/program_plan/' . $data_pp['image']; ?>">
                    </a>
                        <!-- <img src="images/commnunities/asp-chadrent.jpg" class="social-image"> -->
                </div>
                <div class="col-lg-9">
                    <h4 class="media-heading"><a href=""><?php echo $data_pp['title']; ?></a></h4>
                    <p><?php echo $data_pp['content']; ?></p>
                    <p>Keywords : <?php echo "#".str_replace(","," #",$data_pp['keyword']); ?></p><br/>
                    <div>
                        <a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer&volunteer=opportunity&snid=<?php echo $socil_need_data['id']; ?>">
                            <button id="" class="btn btn-social">Get Involved</button>
                        </a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;

                       
                            <a href="" data-toggle="modal" data-target="#edit_pp<?php echo $data_pp['id']; ?>"><button class="btn btn-social">Edit</button></a>
                        <button id="<?php echo $sn_id; ?>" class="btn btn-social" onclick="FollowProject(<?php echo $groupID ?>)">Like</button>
                        
                    </div>

                    &nbsp;
                </div>
            </div>
            
            <!-- Edit Social Need -->

            <div class="modal fade" id="edit_pp<?php echo $data_pp['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" enctype='multipart/form-data' action="">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Edit Program And Plan </h4>
                            </div>

                            <div class="modal-body">      
                                <input type="hidden" id="edit_pp_id" name="edit_pp_id" value="<?php echo $data_pp['id']; ?>">
                                <input type="hidden" id="old_pp_pic" name="old_pp_pic" value="<?php echo $data_pp['image']; ?>">
                                <input type="text" name="edit_pp_title" id="edit_pp_title" class="form-control" required="" value="<?php echo $data_pp['title']; ?>"><br/>
                                <input type="text" id="edit_pp_keyword" name='edit_pp_keyword' class="form-control" data-role="tagsinput" placeholder="Keyword" required="" value="<?php echo $data_pp['keyword']; ?>"/><br/>
                                <textarea name="edit_pp_content" id="edit_pp_content"  class="edit_sn_editor" style="width:100%; height:100px;" placeholder="Content"><?php echo $data_pp['content']; ?></textarea>
                                <input type="file" name="edit_pp_pic" id="edit_pp_pic" style="display:inline;">
                                <br/>
                                <div id="webcam_container" class='border'>
                                    <div id="webcam" ></div>
                                    <div id="webcam_preview"></div>
                                    <div id='webcam_status'></div>
                                    <div id='webcam_takesnap'></div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="submit_edit_pp" name="submit_edit_pp" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 

            <!-- End Popup -->
            <?php } ?>

        </div>
    </div>
</div>



<!-- add program and plan  -->
<div class="modal fade" id="add_new_pp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype='multipart/form-data' action="" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Add New Program And Plan</h4>
                </div>

                <div class="modal-body" id="social-need-editor">      
                    <input type="hidden" name="snid" value="<?php echo $snid; ?>"/>
                    <input type="text" name="new_pp_title" id="new_pp_title" class="form-control" placeholder="Title" required=""/><br/>
                    <input type="text" style="width:100%;" id="sn_keyword" name='new_sn_keyword' class="form-control" data-role="tagsinput"  value="" placeholder="Keyword" required=""/><br/>
                    <textarea name="new_pp_content" id="new_pp_content"  class="new_pp_content" style="width:100% !important; height:100px;" placeholder="Content"></textarea>
                    <input type="file" name="new_pp_pic" id="new_pp_pic" style="display:inline;">
                    <div id="webcam_container" class='border'>
                        <div id="webcam" ></div>
                        <div id="webcam_preview"></div>
                        <div id='webcam_status'></div>
                        <div id='webcam_takesnap'></div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="submit_new_pp" name="submit_new_pp" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
       <a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer_now"><button class="btn invole " style="  margin-right: 2%; margin-left: 30%;">Volunteer Now</button></a>
       <a  href="#" data-toggle="modal" data-target=".send_mail_to_cps_admin"><button class="btn invole " >Inquire Here</button></a>
       <a  href="#"><button class="btn invole" style="margin-left:2%;"><i class="fa fa-facebook"></i>&nbsp;&nbsp; Tell a friend</button></a>
       <br>
       <br>
<script>
    //update community cps audit description.........
    $('.update_com_opport').click(function(){
        var content1 = $("#update_com_opport_intro").val();
        var id1 = $(this).attr('id');
        $.ajax({
            type:'POST',
            url:'<?php echo $base_url; ?>community/ajax_community.php',
            data:{
               data             :content1,
               id               : id1,
               edit_com_opport   :'edit_com_opport',
            },
            success:function(data){
                location.reload();
            },error:function(data){
                alert(data);
            }
        });
    });
    
</script>