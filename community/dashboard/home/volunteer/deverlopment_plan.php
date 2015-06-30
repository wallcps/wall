<style>
    .bootstrap-tagsinput{
        width:100%;
    }
    .tooltip-inner {
        width: 160px !important;
    }
    .snkeyword{
        padding-left: 23px;
    }
</style>


<?php 
    $dev_plan1 = mysqli_query($db,"select * from com_volunteer_dev_plan where title = 'Introduction' and com_id= ".$com_id.";");
    $dev_plan2 = mysqli_query($db,"select * from com_volunteer_dev_plan where title = 'Goal' and com_id= ".$com_id.";");

    $data_pro_social_need = mysqli_query($db,"select * from messages inner join proj_social_needs on messages.msg_id = proj_social_needs.msg_id inner join projects on proj_social_needs.sn_pid =projects.proj_id inner join community on community.com_id = projects.com_id where community.com_id = 8 limit 5");
    /* Add New Social Need */ 
    if(isset($_POST['submit_new_sn']))
    {
        $com_id = $_POST['com_id'];
        $new_sn_title = $_POST['new_sn_title'];
        $new_sn_summary = $_POST['new_sn_summary'];
        $new_sn_content = $_POST['new_sn_content'];
        $new_sn_keyword = $_POST['new_sn_keyword'];
        
        $target_dir1 = "images/commnunities/social_need/";
        //for id card..........
        $temp1 = explode(".",$_FILES["new_sn_pic"]["name"]);
        $filename1 = rand(1,99999) . '.' .end($temp1); 
        $target_file1 = $target_dir1 . basename($filename1);
        //move_uploaded_file($_FILES["new_sn_pic"]["tmp_name"],$target_file1);
        
        move_uploaded_file($_FILES["new_sn_pic"]["tmp_name"],$target_file1);
        
        if($_FILES["new_sn_pic"]["tmp_name"]==''){
            $filename1='';
        }        
        
        //mysqli_query($db,"INSERT INTO com_social_need(title,introduction,content,keywords,image,com_id) VALUES('$new_sn_title','$new_sn_summary','$new_sn_content','$new_sn_keyword','$filename1',$com_id)");
        
        $cate_id = 5;
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
        $group_id = $_GET['gid'];
	
	mysqli_query($db,"INSERT INTO messages (msg_title,message, uid_fk, ip,created,group_id_fk,cate_id) VALUES ('$new_sn_title','$new_sn_content','$uid','$ip','$time','$group_id','$cate_id')") or die(mysqli_error($db));
        
        $b= mysqli_query($db,"SELECT msg_id FROM messages WHERE uid_fk='$uid' ORDER BY msg_id DESC LIMIT 1") or die(mysqli_error($db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$msg_id=$data['msg_id'];
        
        mysqli_query($db,"INSERT INTO com_social_need (msg_id,introduction,content,com_id, keywords, image) VALUES ('$msg_id','$new_sn_summary','$new_sn_content','$com_id','$new_sn_keyword','$filename1')") or die(mysqli_error($db));
        
    }
    
    /* Edit Social Need */ 
    if(isset($_POST['submit_edit_sn']))
    {
        $sn_id              = $_POST['edit_sn_id'];
        $msg_id             = $_POST['edit_msg_id'];
        $sn_title           = $_POST['edit_sn_title'];
        $sn_summary         = $_POST['edit_sn_summary'];
        $sn_content         = $_POST['edit_sn_content'];
        $sn_keyword         = $_POST['edit_sn_keyword'];
        $old_sn_pic         = $_POST['old_sn_pic'];
        
        $target_dir1 = "images/commnunities/social_need/";
        //for id card..........
        $temp1 = explode(".",$_FILES["edit_sn_pic"]["name"]);
        $filename1 = rand(1,99999) . '.' .end($temp1); 
        $target_file1 = $target_dir1 . basename($filename1);
        //move_uploaded_file($_FILES["new_sn_pic"]["tmp_name"],$target_file1);
        
        move_uploaded_file($_FILES["edit_sn_pic"]["tmp_name"],$target_file1);
        
        if($_FILES["edit_sn_pic"]["tmp_name"]==''){
            $filename1=$old_sn_pic;
        }        
        
        mysqli_query($db,"UPDATE com_social_need INNER JOIN messages ON messages.msg_id = com_social_need.msg_id SET messages.msg_title='$sn_title',com_social_need.introduction='$sn_summary',com_social_need.content='$sn_content',com_social_need.keywords='$sn_keyword',com_social_need.image='$filename1' WHERE messages.msg_id='$msg_id'");
        
    }
    
    
    //description of social need in community..........
    $des_com_social_need = mysqli_query($db,"SELECT * FROM com_social_need_des WHERE com_id ='$com_id' ");
        foreach ($des_com_social_need as $value) { 
            $decom_social_need = $value['description'];
            $decom_social_need_id = $value['id'];
        } 
    /* End of Add new Social Need*/
            
    //data need and spirations.......
    $data_need_and_as = mysqli_query($db,"SELECT * FROM com_need_and_aspirations WHERE com_id = '$com_id'");
    foreach ($data_need_and_as as $value) { 
        $des_need_and_aspri = $value['description'];
        $des_need_and_aspri_id = $value['id'];
    } 
    
    //data cps audit........
    $data_cps_audit_des = mysqli_query($db,"SELECT * FROM com_cps_audit_des WHERE com_id = '$com_id'");
    foreach ($data_cps_audit_des as $value) { 
        $des_cps_audit_des = $value['description'];
        $des_cps_audit_des_id = $value['id'];
    } 
    
    // add program and plan........
    if(isset($_POST['submit_new_pp'])){
        $sn_id = $_POST['snid'];
        $new_pp_title = $_POST['new_pp_title'];
        $new_pp_introduction = $_POST['new_pp_introduction'];
        $new_pp_keyword = $_POST['new_pp_keyword'];
        $new_pp_content = $_POST['new_pp_content'];
        
        $target_dir1 = "images/commnunities/program_plan/";
        //for id card..........
        $temp1 = explode(".",$_FILES["new_pp_pic"]["name"]);
        $filename1 = rand(1,99999) . '.' .end($temp1); 
        $target_file1 = $target_dir1 . basename($filename1);
        //move_uploaded_file($_FILES["new_sn_pic"]["tmp_name"],$target_file1);
        
        move_uploaded_file($_FILES["new_pp_pic"]["tmp_name"],$target_file1);
        
        if($_FILES["new_pp_pic"]["tmp_name"]==''){
            $filename1='';
        }        
        
        mysqli_query($db,"INSERT INTO com_program_and_plan(title,introduction,content,keyword,image,com_social_need_id) VALUES('$new_pp_title','$new_pp_introduction','$new_pp_content','$new_pp_keyword','$filename1',$sn_id)");
        
    }

?>
<div class="text" style="margin-top:-10px;">
    <p style="font-size: 23px;font-weight: bold;">Introduction</p>
    <hr style="margin:-6px;" />
    <div class="media">
        <div class="media-left media-middle">
            <a href="#">
                <img width="100px" src="<?php echo $base_url; ?>images/commnunities/introduction.png">
            </a>
        </div>
        <div class="media-body">
        <?php foreach ($dev_plan1 as $dev_plan) { ?>
            <h4 class="media-heading" style="font-weight:bold;"><?php echo $dev_plan['title']; ?></h4>
            <span class="edit-icon" ><a href="" data-toggle="modal" data-target='#title'><i class="glyphicon glyphicon-edit"></i></a></span>
            <p style="text-align:justify;"><?php echo $dev_plan['description'] ; ?></p>
        </div>
        <!--<p class="text-right text-primary"><i class="glyphicon glyphicon-minus-sign"></i> Minimize</p>-->
    </div>
</div>
<div class="modal fade" id="title" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Edit Introduction</h4>
            </div>
            <div class="modal-body" id="editor_1">
                <textarea class="des"  style="height:150px; width:100%;" name="des" id="des1"><?php echo $dev_plan['description'] ; ?></textarea>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                    <button id="<?php echo $dev_plan['id'] ; ?>" name="save" class="btn btn-sm btn-primary update-des1">Update</button>
                </div>
        </div>
    </div>
</div>
<?php } ?>
<div style="clear:both"></div>
<div class="text">
<?php 
    $docs = mysqli_query($db, "SELECT * FROM com_welcome_doc WHERE com_id = '$com_id'");
 ?>
    <div class="doc">
    <h4>Theory of change dashboard</h4>
    <span class="edit-icon" ><a href="" data-toggle="modal" data-target='#docs'><i class="glyphicon glyphicon-edit"></i></a></span>
        <?php 
            foreach ($docs as $doc) {
                $document = $doc['content'];
                if ($document) {
                    echo $document;
                }
                else{
                    echo "<h4>(Embeded From Google Doc)</h4>";
                } 
         ?>
            <div class="modal fade" id="docs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Embbeded your Google Doc here</h4>
                        </div>
                        <div class="modal-body" id="editor_2">
                            <textarea class="embad_doc" style="height:150px; width:100%;" name="document" id="document"><?php echo $document ; ?></textarea>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                <button id="<?php echo $doc['id'] ; ?>" name="save_doc" class="btn btn-sm btn-primary update_doc1">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?> 
    </div>
</div>
<div style="clear:both"></div>
<div class="text">
    <div class="media">
        <div class="media-left media-middle">
            <a href="#">
                <img width="100px" src="<?php echo $base_url; ?>images/commnunities/goal_360.png">
            </a>
        </div>
        <div class="media-body">
        <?php foreach ($dev_plan2 as $dev_plan22) { ?>
            <h4 class="media-heading" style="font-weight:bold;"><?php echo $dev_plan22['title']; ?></h4>
            <span class="edit-icon" ><a href="" data-toggle="modal" data-target='#goals'><i class="glyphicon glyphicon-edit"></i></a></span>
            <p style="text-align:justify;"><?php echo $dev_plan22['description']; ?></p>
        </div>
        <p class="text-right text-primary"><i class="glyphicon glyphicon-plus-sign"></i> Read More</p>
    </div>
</div>
<div class="modal fade" id="goals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Edit Introduction</h4>
            </div>
            <div class="modal-body" id="editor_3">
                <textarea class="goals" style="height:150px; width:100%;" name="des2" id="des2"><?php echo $dev_plan22['description'] ; ?></textarea>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                    <button id="<?php echo $dev_plan22['id'] ;?>" name="save" class="btn btn-sm btn-primary update-des2">Update</button>
                </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="row text">
    <div role="tabpanel" class="tab-pane" id="pro_socailneed">
        <span style="font-size: 24px; ">Needs And Aspirations</span> <span class="text-right"><a href="" data-toggle="modal" data-target="#edit_pro_social_need"><i class="glyphicon glyphicon-edit" style="float:right;"></i></a></span><hr style="margin-top: 0px;"/>
        <div class="modal fade" id="edit_pro_social_need" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Edit Needs And Aspirations</h4>
                        </div>
                        <div class="modal-body" id="editor_4">
                            <textarea class="des_need_and_aspri" name="des_need_and_aspri" id="des_need_and_aspri"  style="width:540px; height:200px;"><?php echo $des_need_and_aspri; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary update_des_need_and_aspri" id="<?php echo $des_need_and_aspri_id; ?>" name="update_des_need_and_aspri" value="Save" />
                        </div>

                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <img width="100px" src="<?php echo $base_url; ?>images/commnunities/introduction.png">
        </div>
        
        <div class="col-lg-10 text-style">
            <p><?php echo $des_need_and_aspri; ?></p>
            <?php foreach ($data_pro_social_need as $value) {?>
            <div class="row aspiration-text">
                <div class="col-lg-3">
                    <a href="">
                        <img class="social-image" src="<?php echo 'images/commnunities/social_need/' . $socil_need_data['image']; ?>">
                    </a>
                        <!-- <img src="images/commnunities/asp-chadrent.jpg" class="social-image"> -->
                </div>
                <div class="col-lg-9">
                    <h4 class="media-heading"><a href=""><?php echo $value['msg_title']; ?></a></h4>
                    <p>text</p>
                    <p>Keywords : </p><br/>
                    <div>
                        <a href="">
                            <button id="" class="btn btn-social">Get Involved</button>
                        </a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;

                       
                            
                        <button id="<?php echo $sn_id; ?>" class="btn btn-social" onclick="FollowProject(<?php echo $groupID ?>)">Like</button>
                        
                    </div>

                    &nbsp;
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</div>

<div class="row text">
    <div role="tabpanel" class="tab-pane" id="socailneed">
        <span style="font-size: 24px; ">Social Needs</span> <span class="text-right"><a href="" data-toggle="modal" data-target="#edit_social_need"><i class="glyphicon glyphicon-edit" style=""></i></a></span><hr style="margin-top: 0px;"/>
        <p class="text-right"><button style="margin-top: -110px;" id="sn_btn" class="btn btn-primary btn-xs btn-add-new" data-toggle="modal" data-target="#add_new_sn">Add Social Need</button></p>
        <div class="modal fade" id="edit_social_need" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Edit Description Social Need</h4>
                    </div>
                    <div class="modal-body" id="editor_5">
                        <textarea class="des_socical_need" name="des_socical_need" id="des_socical_need"  style="width:540px; height:200px;"><?php echo $decom_social_need; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="button" class="btn btn-primary update_decom_social_need" id="<?php echo $decom_social_need_id; ?>" name="update_decom_social_need" value="Save" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <img width="95px" src="<?php echo $base_url; ?>images/commnunities/socail-need.png">
        </div>
        
        <div class="col-lg-10 text-style">
            <p><?php echo $decom_social_need; ?></p>
            <?php 
                $data_social_need = mysqli_query($db, "SELECT com_social_need.*, messages.msg_title as title FROM com_social_need inner join messages ON com_social_need.msg_id = messages.msg_id  WHERE com_id='$com_id' ORDER BY id DESC limit 10");
                foreach ($data_social_need as $socil_need_data) {
                    
            ?>
            <div class="row aspiration-text">
                <div class="col-lg-3">
                        <img class="social-image" src="<?php echo 'images/commnunities/social_need/' . $socil_need_data['image']; ?>">
                        <p class="snkeyword"><b><?php echo "#".str_replace(",","<br/> #",$socil_need_data['keywords']); ?></b></p><br/>
                        <!-- <img src="images/commnunities/asp-chadrent.jpg" class="social-image"> -->
                </div>
                <div class="col-lg-9">
                    <h4 class="media-heading"><a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=social_need_detail&sn_id=<?php echo $socil_need_data['id']; ?>"><?php echo $socil_need_data['title']; ?></a></h4>
                    <div class="text-right edit-icon" style="margin-right: 20px;"><i id="<?php echo $socil_need_data['id']; ?>" class="glyphicon glyphicon-trash text-danger delete_social_need" data-toggle="tooltip" data-placement="top" title="Delete social Need"></i> <a href=""  data-toggle="modal" data-target="#edit_sn<?php echo $socil_need_data['id']; ?>"><i data-toggle="tooltip" title="Edit social Need" class="glyphicon glyphicon-edit edit_social_need" id="<?php echo $socil_need_data['id']; ?>"></i></a> <a href=""  data-toggle="modal" data-target="#add_new_pp"><i id="<?php echo $socil_need_data['id']; ?>" data-toggle="tooltip" data-placement="top" title="Add New Program & Plan"  class="glyphicon glyphicon-plus-sign text-success add_pp"></i></a></div>
                    <p><?php echo $socil_need_data['introduction']; ?> <a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=social_need_detail&sn_id=<?php echo $socil_need_data['id']; ?>"><span class="text-primary">Read more</span></a></p>
                    <p><b>Solution :</b> 
                    <?php
                    $snid_1 = $socil_need_data['id'];
                        $data_program_and_plan = mysqli_query($db, "SELECT * FROM com_program_and_plan WHERE com_social_need_id='$snid_1' ORDER BY id DESC limit 10");
                        foreach ($data_program_and_plan as $pp) {
                            echo $pp['title']." , ";
                        }
                    ?>
                    </p>
                    <div>
                        <button id="<?php echo $sn_id; ?>" class="btn btn-social" onclick="FollowProject(<?php echo $groupID ?>)">Follow</button>
                        <a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer&volunteer=opportunity&snid=<?php echo $socil_need_data['id']; ?>">
                            <button id="" class="btn btn-social">Get Involved</button>
                        </a>
                    </div>

                    &nbsp;
                </div>
            </div>
            
            <!-- Edit Social Need -->

            <div class="modal fade" id="edit_sn<?php echo $socil_need_data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" enctype='multipart/form-data' action="">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Edit Social Need </h4>
                            </div>

                            <div class="modal-body" id="editor_<?php echo $socil_need_data['id']; ?>">    
                                <input type="hidden" id="edit_sn_id" name="edit_sn_id" value="<?php echo $socil_need_data['id']; ?>">
                                <input type="hidden" id="edit_msg_id" name="edit_msg_id" value="<?php echo $socil_need_data['msg_id']; ?>">
                                <input type="hidden" id="old_sn_pic" name="old_sn_pic" value="<?php echo $socil_need_data['image']; ?>">
                                <span>What is the title ?</span><br/><br/>
                                <input type="text" name="edit_sn_title" id="edit_sn_title" class="form-control" required="" value="<?php echo $socil_need_data['title']; ?>"><br/>
                                <span>What are keywords ?</span><br/><br/>
                                <input type="text" id="edit_sn_keyword" name='edit_sn_keyword' class="form-control" data-role="tagsinput" placeholder="Keyword" required="" value="<?php echo $socil_need_data['keywords']; ?>"/><br/>
                                <span>What is the summary text?</span><br/><br/>
                                <textarea name="edit_sn_summary" id="edit_sn_summary"  class="edit_sn_summary" style="width:100%; height:100px;" placeholder="Summary Text"><?php echo $socil_need_data['introduction']; ?></textarea>
                                <span>What is the content text?</span><br/><br/>
                                <textarea name="edit_sn_content" id="edit_sn_content_<?php echo $socil_need_data['id']; ?>"  class="edit_sn_editoreditor_<?php echo $socil_need_data['id']; ?>" style="width:100%; height:100px;" placeholder="Content"><?php echo $socil_need_data['content']; ?></textarea>
                                <br/><span>Please upload image</span><br/><br/>
                                <input type="file" name="edit_sn_pic" id="edit_sn_pic" style="display:inline;" accept="image/*">
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
                                <button id="submit-edit-social-need_<?php echo $socil_need_data['id']; ?>" data_id="<?php echo $socil_need_data['id']; ?>" name="submit_edit_sn" class="btn btn-primary save">Save</button>
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

<!-- cps audit -->
<div class="row text">
    <div role="tabpanel" class="tab-pane" id="pro_socailneed">
        <span style="font-size: 24px; ">CPS Audit</span> <span class="text-right"><a href="" data-toggle="modal" data-target="#edit_com_cps_audit"><i class="glyphicon glyphicon-edit" style="float:right;"></i></a></span><hr style="margin-top: 0px;"/>
        <div class="modal fade" id="edit_com_cps_audit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Edit Description CPS Audit</h4>
                        </div>
                        <div class="modal-body">
                            <textarea name="com_cps_audit_des" id="com_cps_audit_des"  style="width:540px; height:200px;"><?php echo $des_cps_audit_des; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="button" class="btn btn-primary update_com_cps_audit_des" id="<?php echo $des_cps_audit_des_id; ?>" name="update_com_cps_audit_des" value="Save" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <img width="100px" src="<?php echo $base_url; ?>images/commnunities/introduction.png">
        </div>
        
        <div class="col-lg-10 text-style">
            <p><?php  echo $des_cps_audit_des; ?></p>
        </div>
    </div>
</div>
<div class="text text-center">
<?php 
    $docs1 = mysqli_query($db, "SELECT * FROM com_audit_doc WHERE com_id = '$com_id'");
 ?>
    <div class="doc">
    <h4>Theory of change dashboard</h4>
    <span class="edit-icon" ><a href="" data-toggle="modal" data-target='#docs1'><i class="glyphicon glyphicon-edit"></i></a></span>
        <?php 
            foreach ($docs1 as $doc1) {
                $document1 = $doc1['content'];
                if ($document1) {
                    echo $document1;
                }
                else{
                    echo "<h4>(Embeded From Google Doc)</h4>";
                } 
         ?>
            <div class="modal fade" id="docs1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Embbeded your Google Doc here</h4>
                        </div>
                        <div class="modal-body">
                            <textarea style="height:150px; width:100%;" name="des" id="document1"><?php echo $document1 ; ?></textarea>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                <button id="<?php echo $doc['id'] ; ?>" name="save_doc" class="btn btn-sm btn-primary update_doc2">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?> 
    </div>
</div>
<div style="clear:both"></div>
<a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer_now"><button class="btn invole " style="  margin-right: 2%; margin-left: 30%;">Volunteer Now</button></a>
<a  href="#" data-toggle="modal" data-target=".send_mail_to_cps_admin"><button class="btn invole " >Inquire Here</button></a>
<a href="http://www.facebook.com/share.php?u=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>&title=[TITLE]"><button class="btn invole" style="margin-left:2%;"><i class="fa fa-facebook"></i>&nbsp;&nbsp; Tell a friend</button></a>
<br>
<br>

<!-- Add New Social Need -->
<div class="modal fade" id="add_new_sn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype='multipart/form-data' action="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Add New Social Need </h4>
                </div>

                <div class="modal-body" id="social-need-editor">      
                    <span>What is the title ?</span><br/><br/>
                    <input type="text" name="new_sn_title" id="sn_title" class="form-control" placeholder="Title" required=""/><br/>
                    <span>What are keywords ?</span><br/><br/>
                    <input type="text" style="width:100%;" id="sn_keyword" name='new_sn_keyword' class="form-control" data-role="tagsinput"  value="" placeholder="Keyword" required=""/><br/>
                    <span>What is the summary text?</span><br/><br/>
                    <textarea name="new_sn_summary" id="new_sn_summary"  class="new_sn_summary" style="width:100%; height:100px;" placeholder="Content"></textarea>
                    <span>What is the content text ?</span>
                    <textarea name="new_sn_content" id="add_sn_content"  class="sn_editor" style="width:100%; height:100px;" placeholder="Content"></textarea>
                    <br/><span>Please upload image</span><br/><br/>
                    <input type="file" name="new_sn_pic" id="new_sn_pic" style="display:inline;" accept="image/*">
                    <br/>
                    <div id="webcam_container" class='border'>
                        <div id="webcam" ></div>
                        <div id="webcam_preview"></div>
                        <div id='webcam_status'></div>
                        <div id='webcam_takesnap'></div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="submit-social-need" name="submit_new_sn"  class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<!-- End Popup -->

<!-- add program and plan  -->
<div class="modal fade" id="add_new_pp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype='multipart/form-data' action="" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Add New Program And Plan</h4>
                </div>

                <div class="modal-body" id="editor_pp">      
                    <input type="hidden" name="snid" id="snid"/>
                    <input type="text" name="new_pp_title" id="new_pp_title" class="form-control" placeholder="Title" required=""/><br/>
                    <input type="text" style="width:100%;" id="new_pp_keyword" name='new_pp_keyword' class="form-control" data-role="tagsinput"  value="" placeholder="Keyword" required=""/><br/>
                    <textarea name="new_pp_introduction" id="new_pp_introduction"  class="new_pp_introduction" style="width:100% !important; height:100px;" placeholder="Content"></textarea>
                    <textarea name="new_pp_content" id="new_pp_content"  class="new_pp_content" style="width:100% !important; height:100px;" placeholder="Content"></textarea>
                    <input type="file" name="new_pp_pic" id="new_pp_pic" style="display:inline;" accept="image/*">
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



 <script type="text/javascript">
     
    $(document).ready(function(){
 
        qy210(".sn_editor").Editor();
        qy210(".des_socical_need").Editor();
        var social_need = document.getElementById('editor_5').getElementsByClassName('Editor-editor');
        social_need[0].innerHTML = $("#des_socical_need").val();

        //goads.......
        qy210(".des_need_and_aspri").Editor();
        var goals = document.getElementById('editor_4').getElementsByClassName('Editor-editor');
        goals[0].innerHTML = $("#des_need_and_aspri").val();

        //goads.......
        qy210(".goals").Editor();
        var goals = document.getElementById('editor_3').getElementsByClassName('Editor-editor');
        goals[0].innerHTML = $("#des2").val();

        //for embade document..........
        qy210(".embad_doc").Editor();
        var des = document.getElementById('editor_2').getElementsByClassName('Editor-editor');
        des[0].innerHTML = $("#document").val();

        qy210(".des").Editor();
        var des = document.getElementById('editor_1').getElementsByClassName('Editor-editor');
        des[0].innerHTML = $("#des1").val();


        $('#submit-social-need').click(function(){
            document.getElementById("add_sn_content").value += $("#social-need-editor .Editor-editor").html();
        });

        $('.update-des1').click(function(){
            var id = $(this).attr('id');
            var content = $("#editor_1 .Editor-editor").html();

            $.ajax({
                type:'POST',
                url:'<?php echo $base_url; ?>community/ajax_community.php',
                data:{
                   content      :content,
                   id           : id,
                   dev_plan  :'dev_plan',
                },
                success:function(data){
                    location.reload();
                },error:function(data){
                    alert(data);
                }
            });
        });



        $('.update-des2').click(function(){
            var id = $(this).attr('id');
            var content = $("#editor_3 .Editor-editor").html();

            $.ajax({
                type:'POST',
                url:'<?php echo $base_url; ?>community/ajax_community.php',
                data:{
                   content      :content,
                   id           : id,
                   dev_plan2  :'dev_plan2',
                },
                success:function(data){
                    location.reload();
                },error:function(data){
                    alert(data);
                }
            });
        });

        $('.update_des_need_and_aspri').click(function(){
            var content = $("#editor_4 .Editor-editor").html();
            var id = $(this).attr('id');
            $.ajax({
                type:'POST',
                url:'<?php echo $base_url; ?>community/ajax_community.php',
                data:{
                   data             :content,
                   id               : id,
                   need_and_Asp     :'need_and_Asp',
                },
                success:function(data){
                    location.reload();
                },error:function(data){
                    alert(data);
                }
            });
        });

        $('.update_decom_social_need').click(function(){
            var content = $("#editor_5 .Editor-editor").html();
            var id = $(this).attr('id');
            $.ajax({
                type:'POST',
                url:'<?php echo $base_url; ?>community/ajax_community.php',
                data:{
                   data             :content,
                   id               : id,
                   edit_social      :'edit_social',
                },
                success:function(data){
                    location.reload();
                },error:function(data){
                    alert(data);
                }
            });
        });

        //update community cps audit description.........
        $('.update_com_cps_audit_des').click(function(){
            var content1 = $("#com_cps_audit_des").val();
            var id1 = $(this).attr('id');
            $.ajax({
                type:'POST',
                url:'<?php echo $base_url; ?>community/ajax_community.php',
                data:{
                   data             :content1,
                   id               : id1,
                   edit_cps_audit   :'edit_cps_audit',
                },
                success:function(data){
                    location.reload();
                },error:function(data){
                    alert(data);
                }
            });
        });
    $('.update_doc1').click(function(){
            var id = $(this).attr('id');
            var content = $("#editor_2 .Editor-editor").html();

            $.ajax({
                type:'POST',
                url:'<?php echo $base_url; ?>community/ajax_community.php',
                data:{
                   content      :content,
                   id           : id,
                   doc_welcome  :'doc_welcome',
                },
                success:function(data){
                    location.reload();
                },error:function(data){
                    alert(data);
                }
            });
        });
    $('.update_doc2').click(function(){
            var id = $(this).attr('id');
            var content = $('#document1').val();

            $.ajax({
                type:'POST',
                url:'<?php echo $base_url; ?>community/ajax_community.php',
                data:{
                   content      :content,
                   id           : id,
                   doc_audit  :'doc_audit',
                },
                success:function(data){
                    location.reload();
                },error:function(data){
                    alert(data);
                }
            });
        });

        //data tooltip....
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        }) 


        //code text editor......
        $(".edit_social_need").click(function(){
            var id = $(this).attr("id");
            qy210(".edit_sn_editoreditor_"+id).Editor();
            var ele1 = document.getElementById('editor_'+id).getElementsByClassName('Editor-editor');
            ele1[0].innerHTML = $("#edit_sn_content_"+id).val();
        });

        $(".save").click(function(){
            var id = $(this).attr("data_id");
            var content = $("#editor_"+id+" .Editor-editor").html();
            $("#edit_sn_content_"+id).val(content);
        });

        //delete social need..........
        $(".delete_social_need").css("cursor","pointer");
        $(".delete_social_need").click(function(){
           var id = $(this).attr("id");
           var con = confirm("Do you want to delete this social need ?");
           if(con){
               $.ajax({
                    type:'POST',
                    url:'<?php echo $base_url; ?>community/ajax_community.php',
                    data:{
                       id                   : id,
                       delete_social_need   :'delete_social_need',
                    },
                    success:function(data){
                        location.reload();
                    },error:function(data){
                        alert(data);
                    }
                });
           }else{
               return false;
           }
           
        });
        
        //add social need id for program plan......
           $(".add_pp").click(function(){
                var id = $(this).attr("id");
                $("#snid").val(id);
           });
           
        //text editor for add program and plan.........
        qy210(".new_pp_content").Editor();
        var pp = document.getElementById('editor_pp').getElementsByClassName('Editor-editor');
        pp[0].innerHTML = $("#new_pp_content").val();
        
        $("#submit_new_pp").click(function(){
            var content = $("#editor_pp .Editor-editor").html();
            $("#new_pp_content").val(content);
        });
    });
    
        
</script>