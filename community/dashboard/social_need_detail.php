<style>
    .edit-icon {
        float: right;
        margin-top: 17px;
        position: relative;
    }
    
</style>

<?php
$sn_id = $_GET['sn_id'];
//$msg_id=$data['msg_id'];
$msg_id = $Wall->Get_Msg_id($sn_id);
$omsg_id = $msg_id;

$data = $Wall->Project_Announcement_Test($msg_id);
//echo $sn_id.''.$msg_id;
$orimessage = $data['message'];
$message = htmlcode($orimessage);
$time = $data['created'];
$mtime = date("c", $time);
$username = $data['username'];
$uploads = $data['uploads'];
$msg_uid = $data['uid_fk'];
//$like_count=$data['like_count'];
$comment_count = $data['comment_count'];
$share_uid = $data['share_uid'];
$share_ouid = $data['share_ouid'];
$like_uid = $data['like_uid'];
$like_ouid = $data['like_ouid'];
$msg_group_id = $data['group_id_fk'];
$group_msg_uid = $msg_uid;
/* Group Details */
$group_text = '';
$msg_group_owner_id = '0';
$share_status = 'Get Involved';
?>




<?php
$sn_id = $_GET['sn_id'];
//$msg_id=$data['msg_id'];
$msg_id = $Wall->Get_Msg_id($sn_id);
$omsg_id = $msg_id;
// $announcement=$Wall->Project_Announcement($groupID, $uid,$msg_id);
//echo $sn_id.''.$msg_id;
$orimessage = $data['message'];
$message = htmlcode($orimessage);
$time = $data['created'];
$mtime = date("c", $time);
$username = $data['username'];
$uploads = $data['uploads'];
$msg_uid = $data['uid_fk'];
//$like_count=$data['like_count'];
$comment_count = $data['comment_count'];
$share_uid = $data['share_uid'];
$share_ouid = $data['share_ouid'];
$like_uid = $data['like_uid'];
$like_ouid = $data['like_ouid'];
$msg_group_id = $data['group_id_fk'];
$group_msg_uid = $msg_uid;
/* Group Details */
$group_text = '';
$msg_group_owner_id = '0';
if ($msg_group_id) {
    $groupDetails = $Wall->Group_Details($msg_group_id);
    $msg_group_name = $groupDetails['group_name'];
    $msg_group_owner_id = $groupDetails['group_owner_id'];
    $msg_group_name = nameFilter($msg_group_name, 25);
    $group_text = 'posted in <b><a href="' . $base_url . 'group.php?gid=' . $msg_group_id . '">' . $msg_group_name . '</a></b>';
    $group_msg_uid = $Wall->User_ID($username);
}

$share_count = 0;
$like_count = 0;
$shareKey = 0;
$omsg_id = $msg_id;

if ($like_uid != $like_ouid) {
    $like_count = $data['like_count'];
    $omsg_id = 's' . $msg_id;
    $shareKey = 1;
}

if ($share_uid != $share_ouid) {
    $share_count = $data['share_count'];
    $omsg_id = 's' . $msg_id;
    $shareKey = 1;
}

$style = '';
$border = '';

if ($like_ouid > 0) {
    $style = 'stShareImg';
    $border = 'stShareBorder';
    $datanew = $Wall->User_Details($like_ouid);
    $username = $datanew['username'];
}


if ($share_ouid > 0) {
    $style = 'stShareImg';
    $border = 'stShareBorder';
    $datanew = $Wall->User_Details($share_ouid);
    $username = $datanew['username'];
}



/* Like Check */
$like = $Wall->Like_Check($msg_id, $uid);
if ($like) {
    $like_status = 'Like';
} else {
    $like_status = 'Unlike';
}
/* Share Check */
$share = $Wall->Share_Check($msg_id, $uid);
if ($share) {
    $share_status = 'Get Involved';
} else {
    $share_status = 'Unshare';
}


/* User Avatar */
$face = $Wall->User_Profilepic($msg_uid, $base_url, $upload_path);
/* End Avatar */

if ($like_count > 0) {
    $shareuid = $Wall->Like_Msg($msg_id);
    if ($shareuid) {
        $datanew = $Wall->User_Details($shareuid);
        $susername = $datanew['username'];
    }
}

if ($share_count > 0) {
    $shareuid = $Wall->Share_Msg($msg_id);
    if ($shareuid) {
        $datanew = $Wall->User_Details($shareuid);
        $susername = $datanew['username'];
    }
}

if ($group_msg_uid == $msg_uid) {
    ?>
    <div class="stbody" id="stbody<?php echo $omsg_id; ?>" rel="<?php echo $time; ?>">

        <?php
        $sn_id = $_GET['sn_id'];
        $sn_data = mysqli_query($db, "SELECT com_social_need.*, messages.msg_title as title FROM com_social_need inner join messages ON com_social_need.msg_id = messages.msg_id WHERE id = '$sn_id'");
        foreach ($sn_data as $social_need_data) {

            $date = date_create($social_need_data['modified_date']);
            $sn_id = $social_need_data['id'];
            $sn_msg_id = $social_need_data['msg_id'];
            $sn_title = $social_need_data['title'];
            $sn_summary = $social_need_data['introduction'];
            $sn_content = $social_need_data['content'];
            $sn_keyword = $social_need_data['keywords'];
            $sn_image = $social_need_data['image'];
        }


        // update social need...........
        /* Edit Social Need */ 
    if(isset($_POST['submit_edit_sn']))
    {
        $sn_id              = $_POST['edit_sn_id'];
        $msg_id             = $_POST['edit_msg_id'];
        $sn_title           = $_POST['edit_sn_title'];
        $sn_summary         = $_POST['edit_sn_summary'];
        $sn_content         = $_POST['des_socical_need'];
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
?>
        <div class="sttext full">
            <div class="swamper-image"><img src="<?php echo 'images/commnunities/social_need/' . $social_need_data['image']; ?>"></div>
            <div class="text-right edit-icon" style="margin-right: 20px;">Last updated : <?php echo date_format($date,'d/F/Y'); ?> <a href=""  data-toggle="modal" data-target="#edit_sn"><i data-toggle="tooltip" title="Edit social Need" class="glyphicon glyphicon-edit edit_social_need" id="<?php echo $social_need_data['id']; ?>"></i></a> <i id="<?php echo $social_need_data['id']; ?>" class="glyphicon glyphicon-trash text-danger delete_social_need" data-toggle="tooltip" data-placement="top" title="Delete social Need"></i> </div>
            <div class="swamper-contain text">
                <h4><b>Titile</b>: <?php echo $sn_title; ?></h4>
                <h4>Keyword: <b><?php echo $sn_keyword; ?></b></h4>
                <p>CPS Audit status :</p>
                <p>Sicial need is met by following :</p>
                <h3>Summary</h3>
                <p><?php echo $sn_summary; ?></p>
                <h3>Description</h3>
                <p><?php echo $sn_content; ?></p>
            </div>
            <div class="modal fade" id="edit_sn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" enctype='multipart/form-data' action="">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Edit Social Need</h4>
                            </div>

                            <div class="modal-body" id="editor_1">    
                                <input type="hidden" id="edit_sn_id" name="edit_sn_id" value="<?php echo $social_need_data['id']; ?>">
                                <input type="hidden" id="edit_sn_id" name="edit_msg_id" value="<?php echo $social_need_data['msg_id']; ?>">
                                <input type="hidden" id="old_sn_pic" name="old_sn_pic" value="<?php echo $social_need_data['image']; ?>">
                                <span>What is the title ?</span><br/><br/>
                                <input type="text" name="edit_sn_title" id="edit_sn_title" class="form-control" required="" value="<?php echo $social_need_data['title']; ?>"><br/>
                                <span>What are keywords ?</span><br/><br/>
                                <input type="text" id="edit_sn_keyword" name='edit_sn_keyword' class="form-control" data-role="tagsinput" placeholder="Keyword" required="" value="<?php echo $social_need_data['keywords']; ?>"/><br/>
                                <span>What is the summary text?</span><br/><br/>
                                <textarea name="edit_sn_summary" id="edit_sn_summary"  class="edit_sn_summary" style="width:100%; height:100px;" placeholder="Summary Text"><?php echo $social_need_data['introduction']; ?></textarea>
                                <span>What is the content text?</span><br/><br/>
                                <textarea name="des_socical_need" id="des_socical_need"  class="des_socical_need" style="width:100%; height:100px;" placeholder="Content"><?php echo $social_need_data['content']; ?></textarea>
                                <br/><span>Please upload image</span><br/><br/>
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
                                <button id="submit-edit-social-need_<?php echo $social_need_data['id']; ?>" data_id="<?php echo $social_need_data['id']; ?>" name="submit_edit_sn" class="btn btn-primary save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            if ($like_count > 0) {
                echo "<div class='sttext_share'>";
                if ($shareuid) {
                    ?>
                    <a href='<?php echo $base_url . $susername; ?>'><?php echo $Wall->UserFullName($susername); ?></a>
                    <?php
                }
                if ($like_count > 1) {
                    $like_count = $like_count - 1;
                    echo 'and <span id="like_count' . $omsg_id . '" class="numcount">' . $like_count . '</span> other friends like this. ';
                } else {
                    echo 'like this';
                }
                echo "</div>";
            }

            if ($share_count > 0) {
                echo "<div class='sttext_share'>";
                if ($shareuid) {
                    ?>
                    <a href='<?php echo $base_url . $susername; ?>'><?php echo $Wall->UserFullName($susername); ?></a>
                    <?php
                }
                if ($share_count > 1) {
                    $share_count = $share_count - 1;
                    echo 'and <span id="like_count' . $omsg_id . '" class="numcount">' . $share_count . '</span> other friends shared this. ';
                } else {
                    echo 'shared this';
                }
                echo "</div>";
            }
            ?>
            <div class="sttext_content2">
                <div class="st_like_share">
                    <?php
                    if ($login) {
                        ?>
                        <a href='#' class='like like_button icontext' id='like<?php echo $omsg_id; ?>' title='<?php echo $like_status; ?>' rel='<?php echo $like_status; ?>' data='<?php echo $shareKey ?>'><?php echo $like_status; ?></a>
                        <a href='#' class='commentopen commentopen_button icontext' id='<?php echo $omsg_id; ?>' rel='<?php echo $msg_id; ?>' title='Comment'>Comment </a>
                        <a href='<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&tab=volunteer&volunteer=opportunity&snid=<?php echo $sn_id; ?>' class='share share_button icontext' original-title='<?php echo $share_status; ?>' data='<?php echo $shareKey ?>'><?php echo $share_status; ?></a>
                        <?php if ($uid != $msg_uid) { ?>

                                    <!-- <a href="<?php //echo $base_url;   ?>group.php?gid=<?php // echo $groupID;   ?>&ptab=contents&p=program&sn_id=<?php echo $sn_id; ?>">
                                       <button id="<?php // echo $sn_id;   ?>" class="btn btn-social">Get Involved</button>
                                    </a> -->
                        <?php
                        }
                    } else {
                        ?>
                        <a href='<?php echo $index_url; ?>' class='like icontext' >Like</a>
                        <a href='<?php echo $index_url; ?>' class='commentopen icontext'  title='Comment'>Comment </a>
                        <a href='<?php echo $index_url; ?>' class='share icontext'  title='Share'>Shares</a>
                        <a href="<?php echo $base_url; ?>group.php?gid=<?php echo $groupID; ?>&ptab=contents&p=program&sn_id=<?php echo $sn_id; ?>">
                            <button id="<?php echo $sn_id; ?>" class="btn btn-social">Get Involved</button>
                        </a>

                        <?php
                    }
                    ?>


                    <?php
                    if ($like_count > 0) {
                        $likesuserdata = $Wall->Like_Users($msg_id);
                        if ($likesuserdata) {
                            echo '<div class="likes" id="likes' . $omsg_id . '">';
                            $i = 1;
                            $j = count($likesuserdata);
                            foreach ($likesuserdata as $likesdata) {
                                $you = "likeuser" . $omsg_id;
                                $likeusername = $likesdata['username'];
                                if ($likeusername == $session_username) {
                                    $likeusername = 'You';
                                    $you = "you" . $omsg_id;
                                }

                                echo '<a href="' . $base_url . $likeusername . '" id="' . $you . '">' . $Wall->UserFullName($likeusername) . '</a>';
                                if ($j != $i) {
                                    echo ', ';
                                }
                                $i = $i + 1;
                            }

                            if ($like_count > 3) {
                                $like_count = $like_count - 3;
                                echo ' and <span id="like_count' . $omsg_id . '" class="numcount">' . $like_count . '</span> others like this.';
                            } else {
                                echo ' like this.';
                            }

                            echo '</div>';
                        }
                    } else {
                        echo '<div class="likes" id="elikes' . $omsg_id . '" style="display:none"></div>';
                    }
                    ?>
                </div>
                <div class="commentcontainer" id="commentload<?php echo $omsg_id; ?>">
                    <?php
                    $x = 1;
                    include('ann_cmt_load.php')
                    ?>
                </div>
                <div class="commentupdate" style='display:none' id='commentbox<?php echo $omsg_id; ?>'>
                    <div class="stcommentimg">
                        <img src="<?php echo $session_face; ?>" class='comment_small_face'/>
                    </div>
                    <div class="stcommenttext" style="width:310px;">
                        <form method="post" action="">
                            <textarea name="comment" class="comment" maxlength="200"  id="ctextarea<?php echo $omsg_id; ?>"></textarea>
                            <br />
                            <input type="submit"  value=" Comment "  id="<?php echo $omsg_id; ?>" rel="<?php echo $msg_id; ?>" class="comment_button wallbutton"/>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <?php
    if ($uploads) {
        if ($f >= 2) {
            echo '<script> $("#slider' . $omsg_id . '").livequery(function () {  var H=$("#slider_direction_' . $omsg_id . '").html();  if (H.length>0) {  $("#slider_direction_' . $omsg_id . '").html(""); $("#slider_control_' . $omsg_id . '").html(""); } $(this).leanSlider({directionNav: "#slider_direction_' . $omsg_id . '",controlNav:"#slider_control_' . $omsg_id . '"}); });     </script>';
        }
    }
}
?>



<script>
    $(document).ready(function(){
        // code text editor.....
        qy210(".des_socical_need").Editor();
        var social_need = document.getElementById('editor_1').getElementsByClassName('Editor-editor');
        social_need[0].innerHTML = $("#des_socical_need").val();
    
    });
    
    //code text editor......

    $(".save").click(function(){
        var content = $("#editor_1 .Editor-editor").html();
        $("#des_socical_need").val(content);
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
</script>