
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
    $data_com_opport_intro = mysqli_query($db,"select * from com_opportunity_intro where  com_id= ".$com_id.";");
    
    
    $snid = $_GET['snid'];
    
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
        
        $cate_id = 6;
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	$group_id = $_GET['gid'];
        
	mysqli_query($db,"INSERT INTO messages (msg_title,message, uid_fk, ip,created,group_id_fk,cate_id) VALUES ('$new_pp_title','$new_pp_content','$uid','$ip','$time','$group_id','$cate_id')") or die(mysqli_error($db));
        
        $b= mysqli_query($db,"SELECT msg_id FROM messages WHERE uid_fk='$uid' ORDER BY msg_id DESC LIMIT 1") or die(mysqli_error($db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$msg_id=$data['msg_id'];
        
        mysqli_query($db,"INSERT INTO com_program_and_plan (msg_id,introduction,content,com_social_need_id, keywords, image) VALUES ('$msg_id','$new_pp_introduction','$new_pp_content','$sn_id','$new_pp_keyword','$filename1')") or die(mysqli_error($db));
        
    }
    
    /* Edit Social Need */ 
    if(isset($_POST['submit_edit_pp']))
    {
        $pp_id              = $_POST['edit_pp_id'];
        $msg_id             = $_POST['edit_msg_id'];
        $pp_title           = $_POST['edit_pp_title'];
        $pp_summary         = $_POST['edit_pp_summary'];
        $pp_content         = $_POST['edit_pp_content'];
        $pp_keyword         = $_POST['edit_pp_keyword'];
        $old_pp_pic         = $_POST['old_pp_pic'];
        
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
        
        mysqli_query($db,"UPDATE com_program_and_plan INNER JOIN messages ON messages.msg_id = com_program_and_plan.msg_id SET messages.msg_title='$pp_title',com_program_and_plan.introduction='$pp_summary',com_program_and_plan.content='$pp_content',com_program_and_plan.keywords='$pp_keyword',com_program_and_plan.image='$filename1' WHERE messages.msg_id='$msg_id'");
        
    }
?>

<div class="text" style="margin-top:-10px;">
    <p style="font-size: 23px;font-weight: bold;">Introduction</p>
 <?php if ($group_owner_id == $uid) { ?>
    <span class="edit-icon" style="  top: -9px;" ><a href="" data-toggle="modal" data-target='#com_opportunity_into'><i class="glyphicon glyphicon-edit"></i></a></span>
<?php } ?>
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
            <div class="modal-body" id="editor_1">
                <textarea class="update_com_opport_intro" style="height:150px; width:100%;" name="update_com_opport_intro" id="update_com_opport_intro"><?php echo $data['description'] ; ?></textarea>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                    <button id="<?php echo $data['id'] ; ?>" name="update_com_opport" class="btn btn-sm btn-primary update_com_opport">Update</button>
                </div>
        </div>
    </div>
</div>
<?php } ?>
<?php if($login){ ?>
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
                if($_GET['snid']){
                    $data_program_and_plan = mysqli_query($db, "SELECT com_program_and_plan.*, messages.msg_title as title FROM com_program_and_plan inner join messages ON com_program_and_plan.msg_id = messages.msg_id  WHERE com_social_need_id='$snid' ORDER BY id DESC limit 10");
                }else{
                   $data_program_and_plan = mysqli_query($db, "SELECT * FROM com_program_and_plan  ORDER BY id DESC limit 10");
                }
                foreach ($data_program_and_plan as $data_pp){
            ?>
            <div class="row aspiration-text">
                <div class="col-lg-3">
                    <img class="social-image" src="<?php echo 'images/commnunities/program_plan/' . $data_pp['image']; ?>">
                    <p class="snkeyword"><b><?php echo "#".str_replace(",","<br/> #",$data_pp['keywords']); ?></b></p><br/>

                        <!-- <img src="images/commnunities/asp-chadrent.jpg" class="social-image"> -->
                </div>
                <div class="col-lg-9">
                    <h4 class="media-heading"><a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=deverlopment_plan&pp_id=<?php echo $data_pp['id']; ?>"><?php echo $data_pp['title']; ?></a></h4>
                <?php if ($group_owner_id == $uid) { ?>
                    <div class="text-right edit-icon" style="margin-right: 20px;"><i id="<?php echo $data_pp['id']; ?>" class="glyphicon glyphicon-trash text-danger delete_social_need" data-toggle="tooltip" data-placement="top" title="Delete program and Plan"></i> <a href=""  data-toggle="modal" data-target="#edit_pp<?php echo $data_pp['id']; ?>"><i data-toggle="tooltip" title="Edit Program and Plan" class="glyphicon glyphicon-edit edit_pp" id="<?php echo $data_pp['id']; ?>"></i></a> </div>
                <?php } ?>
                    <p><?php echo $data_pp['introduction']; ?> <a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=deverlopment_plan&pp_id=<?php echo $data_pp['id']; ?>"><span class="text-primary">Read more</span></a></p>
                    <div>
                        <a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=create_project&pp=<?php echo $data_pp['id']; ?>">
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
                                <h4 class="modal-title" id="exampleModalLabel">Edit Social Need </h4>
                            </div>

                            <div class="modal-body" id="editor_<?php echo $data_pp['id']; ?>">    
                                <input type="hidden" id="edit_pp_id" name="edit_pp_id" value="<?php echo $data_pp['id']; ?>">
                                <input type="hidden" id="edit_msg_id" name="edit_msg_id" value="<?php echo $data_pp['msg_id']; ?>">
                                <input type="hidden" id="old_pp_pic" name="old_pp_pic" value="<?php echo $data_pp['image']; ?>">
                                <span>What is the title ?</span><br/><br/>
                                <input type="text" name="edit_pp_title" id="edit_pp_title" class="form-control" required="" value="<?php echo $data_pp['title']; ?>"><br/>
                                <span>What are keywords ?</span><br/><br/>
                                <input type="text" id="edit_pp_keyword" name='edit_pp_keyword' class="form-control" data-role="tagsinput" placeholder="Keyword" required="" value="<?php echo $data_pp['keywords']; ?>"/><br/>
                                <span>What is the summary text?</span><br/><br/>
                                <textarea name="edit_pp_summary" id="edit_pp_summary"  class="edit_pp_summary" style="width:100%; height:100px;" placeholder="Summary Text"><?php echo $data_pp['introduction']; ?></textarea>
                                <span>What is the content text?</span><br/><br/>
                                <textarea name="edit_pp_content" id="edit_pp_content_<?php echo $data_pp['id']; ?>"  class="edit_pp_editor_<?php echo $data_pp['id']; ?>" style="width:100%; height:100px;" placeholder="Content"><?php echo $data_pp['content']; ?></textarea>
                                <br/><span>Please upload image</span><br/><br/>
                                <input type="file" name="edit_pp_pic" id="edit_pp_pic" style="display:inline;" accept="image/*">
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
                                <button id="submit-edit-social-need_<?php echo $data_pp['id']; ?>" data_id="<?php echo $data_pp['id']; ?>" name="submit_edit_pp" class="btn btn-primary save">Save</button>
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

<?php } ?>

<!-- add program and plan  -->

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
                    <span>What is the title ?</span><br/><br/>
                    <input type="text" name="new_pp_title" id="new_pp_title" class="form-control" placeholder="Title" required=""/><br/>
                    <span>What are keywords ?</span><br/><br/>
                    <input type="text" style="width:100%;" id="new_pp_keyword" name='new_pp_keyword' class="form-control" data-role="tagsinput"  value="" placeholder="Keyword" required=""/><br/>
                    <span>What is the summary text?</span><br/><br/>
                    <textarea name="new_pp_introduction" id="new_pp_introduction"  class="new_pp_introduction" style="width:100% !important; height:100px;" placeholder="Content"></textarea>
                    <span>What is the content text ?</span>
                    <textarea name="new_pp_content" id="new_pp_content"  class="new_pp_content" style="width:100% !important; height:100px;" placeholder="Content"></textarea>
                    <br/><span>Please upload image</span><br/><br/>
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

       <a  href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer_now"><button class="btn invole " style="  margin-right: 2%; margin-left: 30%;">Volunteer Now</button></a>
       <a  href="#" data-toggle="modal" data-target=".send_mail_to_cps_admin"><button class="btn invole " >Inquire Here</button></a>
       <a target="_blank" href="http://www.facebook.com/share.php?u=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>&title=[TITLE]"><button class="btn invole" style="margin-left:2%;"><i class="fa fa-facebook"></i>&nbsp;&nbsp; Tell a friend</button></a>
       <br>
       <br>
<script>
    
    //code text editor..........
    qy210(".update_com_opport_intro").Editor();
    var ele1 = document.getElementById('editor_1').getElementsByClassName('Editor-editor');
    ele1[0].innerHTML = $("#update_com_opport_intro").val();
    
    //update community cps audit description.........
    $('.update_com_opport').click(function(){
        var content1 = $("#editor_1 .Editor-editor").html();
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
    
    //text editor for add program and plan.........
    qy210(".new_pp_content").Editor();
    var pp = document.getElementById('editor_pp').getElementsByClassName('Editor-editor');
    pp[0].innerHTML = $("#new_pp_content").val();

    $("#submit_new_pp").click(function(){
        var content = $("#editor_pp .Editor-editor").html();
        $("#new_pp_content").val(content);
    });
    
    //data tooltip....
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    }) 
    
    
    //code text editor......
    $(".edit_pp").click(function(){
        var id = $(this).attr("id");
        qy210(".edit_pp_editor_"+id).Editor();
        var ele1 = document.getElementById('editor_'+id).getElementsByClassName('Editor-editor');
        ele1[0].innerHTML = $("#edit_pp_content_"+id).val();
    });

    $(".save").click(function(){
        var id = $(this).attr("data_id");
        var content = $("#editor_"+id+" .Editor-editor").html();
        $("#edit_pp_content_"+id).val(content);
    });
    
</script>