<style>
    .profile{
        background: white;
        border-radius: 5px;
        padding:40px;
        padding-top: 10px;
        box-shadow: 0px 0px 2px #888888;
    }
    
    .profile .table td{
        border: none;
    }
    
    .profile .table .btn{
        border-radius: 4px;
    }
    .profile .table .img-circle{
        border-radius: 50%;
    }
    .profile .bootstrap-tagsinput{
        border-radius: 0px;
        width:100%;
    }
    
</style>
     <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>css/tooltip/tooltipster.css" />
<script type="text/javascript" src="<?php echo $base_url;?>js/tooltip/jquery.tooltipster.js"></script>
<script>
        $(document).ready(function() {
             $('[data-tooltip="tooltip"]').tooltipster();    
        });
    </script> 
      <script type="text/javascript" src="<?php echo $base_url.'js/popup-window.js' ?>"></script>
      <script  src="<?php echo $base_url; ?>js/lib-scrool/1.6.1.jquery.min.js"></script>
<script type='text/javascript'> var $jq = jQuery.noConflict();</script>
      <script>

  //// hide #back-top first
  $jq(".back-top").hide();
  
  //// fade in #back-top
  $jq(function () {
    $jq(window).scroll(function () {
      if ($jq(this).scrollTop() > 100) {
        $jq('.back-top').fadeIn();
      } else {
        $jq('.back-top').fadeOut();
      }
    });

    //// scroll body to 0px on click
    $jq('.back-top a').click(function () {
      $jq('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });
  });

 </script>







<div class="row">
    <div class="sidebar-left">
        <?php include_once 'block_left_dashboard.php'; ?>
    </div>
    <div class="middle-content" id="top">
    
    <div class="table-form" align="center">

        <div class="text" style="border:1px solid #ccc;height:400px;margin:0 auto;">
    <center>
        <h3>Change Your Password</h3>
        <hr>
      </center>
      <!-- <form method="post" style="width:400px;margin:0 auto;" class="form-contact"> -->
      <form method="post" action="" name="change_password" style="width:300px;margin:0 auto;">
      <div class="rows">
              <div class="col-md-12">
                  <p style="float:left;">Current Password</p>
                  <input type="password" name="current_password" class="input form-control" AUTOCOMPLETE='OFF' required/>
                  <p style="float:left;">New Password</p>
                  <input type="password" name="new_password" class="input form-control" AUTOCOMPLETE='OFF' required/>
                  <!-- <input class="form-control" type="email" name="email" name="email"> -->
                  <p style="float:left;">Confirm Password</p>
                  <input type="password" name="confirm_password" class="input form-control" AUTOCOMPLETE='OFF' required/>
              </div>
              <div><?php echo $pwd_error; ?></div>
     </div>

     <!-- <div class="rows">
              <div class="col-md-12">
                  
              </div>
     </div> -->
    <div class="row" style="float:right;">
       <div class="col-md-12">
        <input type="button" class="btn btn-info" value="Cancel" name="cancel">
        <!-- <input type="submit" class="btn btn-info" value="Submit" name="submit"> -->
        <input type="submit" name="submit-password" class="btn btn-info" value="Submit">
        <div id="button"><br/>
        
        
       </div>
    </div>
    </form>
  </div>
   </div>















     <!-- <table>

    <tr>
    <td  valign='top'>
    
    <div id="loginbox" >
    
    <h4>Change Your Password</h4><br/>
    <form method="post" action="" name="change_password">
    
    Current Password: <input type="password" name="current_password" class="input" AUTOCOMPLETE='OFF' required/><br>
    New Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="new_password" class="input" AUTOCOMPLETE='OFF' required/><br>
    Confirm Password: <input type="password" name="confirm_password" class="input" AUTOCOMPLETE='OFF' required/>
    
    <div><?php //echo $pwd_error; ?></div>
    <div>
    </div>
    <div id="button"><br/>
    <input type="submit" name="submit-password" class="btn btn-primary" value="SUBMIT">
    
    </div>
    
    </form>
    
    </div>
    </td>

	</tr></table> -->
    </div><br/><br/>
    
    </div>
    <div class="sidebar-right-dabshoard">
        <?php include_once 'block_right.php'; ?>
        <p class="back-top">
            <a href="#top"><span></span></a>
        </p>
    </div>
</div>
