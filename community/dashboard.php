<style>
    .title_header{
        background: #2AA9DE;
        color: white;
        padding: 1px 15px;
    }
    .sidebar-left{
        background: white;
        margin-top: 13px;
    }
    .sidebar_content{
        padding: 10px 14px;
    }
    .sidebar_content ul li{
        padding:7px;
        list-style: none;
    }
    #nav-group ul{
        padding: 8px 0px;
    }
    
</style>

<div class="container">

    <div class="sidebar-left">
        <div class="title_header">
            <h5><b>Sidebar title</b></h5>
        </div>
        <div class="sidebar_content">
            <ul>
                <li><a data-toggle="modal" data-target='#coming' href="#"><i class="glyphicon glyphicon-heart">&nbsp;</i>Help</a></li>
                <li><a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=profile"><i class="glyphicon glyphicon-user">&nbsp;</i>Upload Profile</a></li>
                <li><a data-toggle="modal" data-target='#coming' href="#"><i class="glyphicon glyphicon-ok-circle">&nbsp;</i>Post Announcement</a></li>
                <li><a data-toggle="modal" data-target='#coming' href="#"><i class="glyphicon glyphicon-book">&nbsp;</i>Community Document</a></li>
                <!--<li><a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=profile"><i class="glyphicon glyphicon-user">&nbsp;</i>Upload Profile</a></li>
                <li><a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=announcement"><i class="glyphicon glyphicon-ok-circle">&nbsp;</i>Post Announcement</a></li>
                <li><a href="<?php echo $base_url; ?>community.php?gid=<?php echo $gid; ?>&com=dashboard&side=document"><i class="glyphicon glyphicon-book">&nbsp;</i>Community Document</a></li>
                -->
            </ul>
        </div>
    </div>
    <div class="modal fade" id="coming" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" id="editor_1">
                     <h3 class="modal-title text-center" id="exampleModalLabel">Coming Soon</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-content">
        <?php
            if(isset($_GET['side'])){
                $page = $_GET['side'];

            } else {
               $page = "home"; 

            }  
            include("dashboard/".$page.".php");
        ?>
    </div>
    <div class="sidebar-right-dabshoard">
        <?php include_once 'block_right.php'; ?>
    </div>
</div>