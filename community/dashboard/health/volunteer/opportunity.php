<?php 
    $data_com_opport_intro = mysqli_query($db,"select * from com_opportunity_intro where  com_id= ".$com_id.";");
    
?>

<div class="text">
    <h3>Introduction</h3><hr/>
    <div class="media">
        <div class="media-left media-middle">
            <a href="#">
                <img width="100px" src="<?php echo $base_url; ?>images/commnunities/introduction.png">
            </a>
        </div>
        <div class="media-body">
        <?php foreach ($data_com_opport_intro as $data) { ?>
            <h4 class="media-heading"><?php echo $data['title']; ?></h4>
            <span class="edit-icon" ><a href="" data-toggle="modal" data-target='#com_opportunity_into'><i class="glyphicon glyphicon-edit"></i></a></span>
            <p style="text-align:justify;"><?php echo $data['description'] ; ?></p>
        </div>
        <!--<p class="text-right text-primary"><i class="glyphicon glyphicon-minus-sign"></i> Minimize</p>-->
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