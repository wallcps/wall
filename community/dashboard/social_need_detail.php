
<style>
    .keywords .bootstrap-tagsinput{
        background-color: #FFF;
        border: 0px solid #CCC;
        box-shadow: none;
    }
</style>

<?php
    $sn_id = $_GET['sn'];
    $sn_data = mysqli_query($db,"SELECT * FROM com_social_need WHERE id = '$sn_id'");
    foreach ($sn_data as $social_need_data) {
        echo $social_need_data['title'];
        $date = date_create($social_need_data['modified_date']);
        
    }

?>
<div class="text">
    <img class="" src="<?php echo 'images/commnunities/social_need/' . $social_need_data['image']; ?>">
    <h4><?php echo $social_need_data['title']; ?></h4>
    <div class="text-right edit-icon" style="margin-right: 20px;">Last updated : <?php echo date_format($date,'d/F/Y'); ?> <a href=""  data-toggle="modal" data-target="#edit_sn"><i data-toggle="tooltip" title="Edit social Need" class="glyphicon glyphicon-edit edit_social_need" id="<?php echo $social_need_data['id']; ?>"></i></a> <i id="<?php echo $social_need_data['id']; ?>" class="glyphicon glyphicon-trash text-danger delete_social_need" data-toggle="tooltip" data-placement="top" title="Delete social Need"></i> </div>
    <p class="keywords">Keywords : <input type="text" id="edit_sn_keyword" name='edit_sn_keyword' class="form-control" data-role="tagsinput" required="" value="<?php echo $social_need_data['keywords']; ?>" disabled/><br/></p><br/>
    <p>CPS Audit status :</p>
    <p>Sicial need is met by following :</p>
    <h3>Summary</h3>
    <p><?php echo $social_need_data['introduction']; ?></p>
    <h3>Description</h3>
    <p><?php echo $social_need_data['content']; ?></p>
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

<script>
    $(document).ready(function(){
        // code text editor.....
        qy210(".des_socical_need").Editor();
        var social_need = document.getElementById('editor_1').getElementsByClassName('Editor-editor');
        social_need[0].innerHTML = $("#des_socical_need").val();
    
    });
</script>