<?php 
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
}
$com_welcome_post = mysqli_query($db,"select * from com_tab_welcome where id=".$post_id);
  foreach ($com_welcome_post as $res) {
                $post_id = $res['id'];
                $post_title = $res['title'];
                $post_content = $res['decription'];
                $post_img = $res['image'];
                $disabled = $res['disabled'];
} ?>
<?php

if (isset($_POST['save_edit_post'])){
        
        $target_dir1 = "images/commnunities/welcome/";
        //for id card..........
        $temp1 = explode(".",$_FILES["update_pic_welcom"]["name"]);
        $filename1 = rand(1,99999) . '.' .end($temp1);
        $target_file1 = $target_dir1 . basename($filename1);
        
        //conditions cannot null.....
        if($_FILES['update_pic_welcom']['tmp_name'] == ''){
            $filename1=$_POST['old_pic'];
        }else{
            move_uploaded_file($_FILES["update_pic_welcom"]["tmp_name"],$target_file1);
        }
    
        $com_welcome_post = mysqli_query($db,"update com_tab_welcome set title='".htmlspecialchars($_POST['post_title'],ENT_QUOTES)."' ,decription='".addslashes($_POST['post_content'])."',image='$filename1',disabled='".$_POST['disabled']."' where id=".$_POST['post_id']);
       echo '<script>window.location = "'.$base_url.'community.php?gid='.$gid.'&com=dashboard&tab=edit_com_welcome";</script>';
       die();        
    }
    ?>

<div id="div-whole" class="text">  
    <h3 class="text-center text-pink">Edit Your Post </h3><br>
    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post_title" class="control-label col-xs-2">Title :</label>
             <div class="col-xs-8">
                 <input type="text" class="form-control" name='post_title'  value="<?php echo $post_title; ?>"/>
             </div>
         </div>
        <div class="form-group" id="editor_1">
            <label for="post_content" class="control-label col-xs-2">Content :</label>
             <div class="col-xs-8">
                 <textarea name="post_content" id="post_content" class="sn_editor" style="width:90%; height:200px; margin-bottom:10px;"><?php echo $post_content; ?></textarea>
             </div>
         </div>
        <div class="form-group">
            <label for="post_content" class="control-label col-xs-2">Disabled :</label>
                <div class="col-xs-8">
                    <select class="form-control" name="disabled">
                        <option value="0" <?php echo $disabled==0?'selected':'' ?>>No</option>
                        <option value="1" <?php echo $disabled==1?'selected':'' ?>>Yes</option>
                    </select>
                </div>
         </div>
         <div class="form-group">
            <label for="post_content" class="control-label col-xs-2">Image :</label>
                <div class="col-xs-4">
                    <input name="update_pic_welcom" id="update_pic_welcom" type="file"  accept="image/*"/>
                    <input name="old_pic" id="old_pic" type="hidden" value="<?php echo $post_img; ?>"/>
                </div>
         </div>
        <div class="form-group text-right">
            <div class="col-xs-10">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <input type="submit" class="wallbutton" id="save_edit_post" name="save_edit_post" value="Save" />
                <input type="reset" class="wallbutton" value="Clear"/>
            </div>
        </div>
    </form>
</div>

<script>
    //text editor......
    qy210(".sn_editor").Editor();
    var ele1 = document.getElementById('editor_1').getElementsByClassName('Editor-editor');
    ele1[0].innerHTML = $("#post_content").val();
    
    $('#save_edit_post').click(function(){
        document.getElementById("post_content").value= $("#editor_1 .Editor-editor").html();
        });
</script>