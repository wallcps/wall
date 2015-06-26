<style>
    .bootstrap-tagsinput{
        width:100%;
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
        
        mysqli_query($db,"INSERT INTO com_social_need(title,content,keywords,image,com_id) VALUES('$new_sn_title','$new_sn_content','$new_sn_keyword','$filename1',$com_id)");
        
    }
    
    /* Edit Social Need */ 
    if(isset($_POST['submit_edit_sn']))
    {
        $sn_id = $_POST['edit_sn_id'];
        $sn_title = $_POST['edit_sn_title'];
        $sn_content = $_POST['edit_sn_content'];
        $sn_keyword = $_POST['edit_sn_keyword'];
        $old_sn_pic = $_POST['old_sn_pic'];
        
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
        
        mysqli_query($db,"UPDATE com_social_need SET title='$sn_title',content='$sn_content',keywords='$sn_keyword',image='$filename1' WHERE id='$sn_id'");
        
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
            <div class="modal-body">
                <textarea  style="height:150px; width:100%;" name="des" id="des1"><?php echo $dev_plan['description'] ; ?></textarea>
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
<div class="text text-center">
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
                        <div class="modal-body">
                            <textarea style="height:150px; width:100%;" name="des" id="document"><?php echo $document ; ?></textarea>
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
            <span class="edit-icon" ><a href="" data-toggle="modal" data-target='#description'><i class="glyphicon glyphicon-edit"></i></a></span>
            <p style="text-align:justify;"><?php echo $dev_plan22['description']; ?></p>
        </div>
        <p class="text-right text-primary"><i class="glyphicon glyphicon-plus-sign"></i> Read More</p>
    </div>
</div>
<div class="modal fade" id="description" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Edit Introduction</h4>
            </div>
            <div class="modal-body">
                <textarea style="height:150px; width:100%;" name="des" id="des2"><?php echo $dev_plan22['description'] ; ?></textarea>
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
                    <form method="post" action="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Edit Needs And Aspirations</h4>
                        </div>
                        <div class="modal-body">
                            <textarea  name="des_need_and_aspri" id="des_need_and_aspri"  style="width:540px; height:200px;"><?php echo $des_need_and_aspri; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary update_des_need_and_aspri" id="<?php echo $des_need_and_aspri_id; ?>" name="update_des_need_and_aspri" value="Save" />
                        </div>
                    </form>

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
                    <form method="post" action="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Edit Description Social Need</h4>
                        </div>
                        <div class="modal-body">
                            <textarea name="des_socical_need" id="des_socical_need"  style="width:540px; height:200px;"><?php echo $decom_social_need; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="button" class="btn btn-primary update_decom_social_need" id="<?php echo $decom_social_need_id; ?>" name="update_decom_social_need" value="Save" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <img width="100px" src="<?php echo $base_url; ?>images/commnunities/icon/social_need.png">
        </div>
        
        <div class="col-lg-10 text-style">
            <p><?php echo $decom_social_need; ?></p>
            <?php 
                $data_social_neet = mysqli_query($db, "SELECT * FROM com_social_need WHERE com_id='$com_id' ORDER BY id DESC limit 10");
                foreach ($data_social_neet as $socil_need_data) {
            ?>
            <div class="row aspiration-text">
                <div class="col-lg-3">
                    <a href="">
                        <img class="social-image" src="<?php echo 'images/commnunities/social_need/' . $socil_need_data['image']; ?>">
                    </a>
                        <!-- <img src="images/commnunities/asp-chadrent.jpg" class="social-image"> -->
                </div>
                <div class="col-lg-9">
                    <h4 class="media-heading"><a href=""><?php echo $socil_need_data['title']; ?></a></h4>
                    <p><?php echo $socil_need_data['content']; ?></p>
                    <p>Keywords : <?php echo "#".str_replace(","," #",$socil_need_data['keywords']); ?></p><br/>
                    <div>
                        <a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer&volunteer=opportunity&snid=<?php echo $socil_need_data['id']; ?>">
                            <button id="" class="btn btn-social">Get Involved</button>
                        </a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;

                       
                            <a href="" data-toggle="modal" data-target="#edit_sn<?php echo $socil_need_data['id']; ?>"><button class="btn btn-social">Edit</button></a>
                        <button id="<?php echo $sn_id; ?>" class="btn btn-social" onclick="FollowProject(<?php echo $groupID ?>)">Like</button>
                        
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

                            <div class="modal-body" id="edit-social-need-editor">      
                                <input type="hidden" id="edit_sn_id" name="edit_sn_id" value="<?php echo $socil_need_data['id']; ?>">
                                <input type="hidden" id="old_sn_pic" name="old_sn_pic" value="<?php echo $socil_need_data['image']; ?>">
                                <input type="text" name="edit_sn_title" id="edit_sn_title" class="form-control" required="" value="<?php echo $socil_need_data['title']; ?>"><br/>
                                <input type="text" id="edit_sn_keyword" name='edit_sn_keyword' class="form-control" data-role="tagsinput" placeholder="Keyword" required="" value="<?php echo $socil_need_data['keywords']; ?>"/><br/>
                                <textarea name="edit_sn_content" id="edit_sn_content"  class="edit_sn_editor" style="width:100%; height:100px;" placeholder="Content"><?php echo $socil_need_data['content']; ?></textarea>
                                <input type="file" name="edit_sn_pic" id="edit_sn_pic" style="display:inline;">
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
                                <button id="submit-edit-social-need" name="submit_edit_sn" class="btn btn-primary">Save</button>
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

                    <input type="text" name="new_sn_title" id="sn_title" class="form-control" placeholder="Title" required=""/><br/>
                    <input type="text" style="width:100%;" id="sn_keyword" name='new_sn_keyword' class="form-control" data-role="tagsinput"  value="" placeholder="Keyword" required=""/><br/>
                    <textarea name="new_sn_content" id="add_sn_content"  class="sn_editor" style="width:100%; height:100px;" placeholder="Content"></textarea>
                    <input type="file" name="new_sn_pic" id="new_sn_pic" style="display:inline;">
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
                    <button id="submit-social-need" name="submit_new_sn" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<!-- End Popup -->



 <script type="text/javascript">
     
    
     
    qy210(".sn_editor").Editor(); 


    $('#submit-social-need').click(function(){
        document.getElementById("add_sn_content").value += $("#social-need-editor .Editor-editor").html();
    });
     
    $('.update-des1').click(function(){
        var id = $(this).attr('id');
        var content = $('#des1').val();

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
        var content = $('#des2').val();

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
        var content = $("#des_need_and_aspri").val();
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
        var content = $("#des_socical_need").val();
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
        var content = $('#document').val();

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
</script>