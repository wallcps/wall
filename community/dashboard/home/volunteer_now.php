<div class="text">
	<h3 class="text-center">Please give us your persional information</h3>
	<h4 style="font-weight: bold;">Basic Information</h4>
	<hr>
	<?php 
	$com_admin= mysqli_query($db,"SELECT * FROM users WHERE users.uid = '$uid'");
	foreach($com_admin as $value){
	
	?>

	<form method="post" class="form-horizontal">
		<div style="padding-left:10%;">
			<div class="form-group">
	      		<span class="form-control-label col-xs-3">First Name:</span>
	            <div class="col-xs-8">
	                <input class="text- form-control" value="<?php echo $value['first_name']; ?>" name="fname" type="text"/>
	            </div>
	        </div>
	        <div class="form-group">
	      		<span class="form-control-label col-xs-3">Last Name:</span>
	            
	            <div class="col-xs-8">
                        <input class="text- form-control" name="lname" type="text" value="<?php echo $value['last_name']; ?>"/>
	            </div>
	        </div>
	        <div class="form-group">
	      		<span class="form-control-label col-xs-3">Gender:</span>
	            <div class="col-xs-8">
	                <select class="form-control" name="gender">
                            <option value="1" <?php echo $value['gender']==1?"selected":"" ?>>Male</option>
                            <option value="2" <?php echo $value['gender']==2?"selected":"" ?>>Female</option>
	                </select>
	            </div>
	        </div>
	        <div class="form-group">
	      		<span class="form-control-label col-xs-3">Date of Birth:</span>
	            <div class="col-xs-8">
                        <input class="text- form-control" name="dob" type="date" value="<?php echo $value['birthday']; ?>"/>
	            </div>
	        </div>
	        <div class="form-group">
	      		<span class="form-control-label col-xs-3">Country:</span>
	            <div class="col-xs-8">
	                	<?php include_once 'country_list.php';?>
	            </div>
	        </div>
	        <div class="form-group">
	      		<span class="form-control-label col-xs-3">Nationality:</span>
	            <div class="col-xs-8">
	                <select class="usr_country form-control text-input form-control" name="usr_country">
                            <?php 
                            foreach ($country_list as $country_data) {
                                if($_POST['usr_country'] == $country_data)
                                {
                                    $sel = 'selected = "selected"'; 
                                }
                                else
                                {
                                    $sel = " ";
                                }
                                echo '<option value="'.$country_data.'" ' .$sel . ' >'.$country_data.'</option>';

                            }
                            ?>
                        </select>
	            </div>
	        </div>
	        <div class="form-group">
	      		<span class="form-control-label col-xs-3">Email Address:</span>
	            <div class="col-xs-8">
	                <input class="text- form-control" name="email" type="email"/>
	            </div>
	        </div>
	        <div class="form-group">
	      		<span class="form-control-label col-xs-3">Phone Number:</span>
	            <div class="col-xs-2">
	            	<input type="text" name="usr_phone" id="inputCode" class="text-input form-control" style=" float: left;" value="<?php echo $_POST['usr_phone'];?>" AUTOCOMPLETE='OFF'/>
	            </div>
	            <div class="col-xs-6">
	                <input class="text- form-control" name="phone" type="text"/>
	            </div>
	        </div>
	        <div class="form-group">
	      		<span class="form-control-label col-xs-3">Mailing Address:</span>
	            <div class="col-xs-8">
                <textarea style="height:80px;width:100%;" name="mailing"></textarea>
            	</div>
	        </div>
        </div>
        <h4  style="font-weight: bold;">Support us</h4>
		<hr>
		<div style="padding-left:2%;">
			<div class="form-group">
	            <div class="col-xs-11">
	                <span>How would you like to support us?</span>
	            </div>
	            <div class="col-xs-11">
	                <input type="text" class="form-control" name="q1" placeholder="E.g Visit us, Donate us, Volunteer with us">
	            </div>
	        </div>
	    </div>
        <h4  style="font-weight: bold;">Volunteer/Visit us </h4>
		<hr>
		<div class="form-group"style="padding-left:2%;">
            <div class="col-xs-11">
                <span>If you would like to volunteer/visit us, when can you come?</span>
            </div>
            <div class="col-xs-11">
                <textarea style="height:80px;width:100%;" name="q2"></textarea>
            </div>
        </div>
        <div class="form-group"style="padding-left:2%;">
            <div class="col-xs-11">
                <span>What would you like to do?</span>
            </div>
            <div class="col-xs-11">
                <textarea  style="height:80px;width:100%;" name="q3"></textarea>
            </div>
        </div>
        <div class="form-group"style="padding-left:2%;">
            <div class="col-xs-11">
                <spna>Why are you interesting in coming?</span>
            </div>
            <div class="col-xs-11">
                <textarea style="height:80px;width:100%;" name="q4"></textarea>
            </div>
        </div>
        <h4 style="font-weight:bold;">Other Information</h4>
		<hr>
		<div class="form-group"style="padding-left:2%;">
            <div class="col-xs-11">
                <span>Is there anything else that you would to ask or tell us?</span>
            </div>
            <div class="col-xs-11">
                <textarea style="height:80px;width:100%;" name="q5"></textarea>
            </div>
        </div>
        <div class="form-group" style="padding-left:10%;">
        	<input type="checkbox">
        	<span>I want to receive more volunteer opportunities from CPS</span>
        </div>
        <div style="padding-left:30%;">
        	<input type="submit" class="btn btn-primary btn_v" value="Submit" name="save">
	        <input type="reset" class="btn btn-danger btn_v" style="background-color:pink !important; color:#fff !important;" value="Reset" name="reset">
	        <input type="submit" class="btn btn_v" style="background-color:#fff !important; border:1px solid #ccc;" value="Back" name="back">
        </div>
        
	</form>
	<?php } ?>
</div>
<style type="text/css">
	.btn_v{
     margin: 0px 30px 0px 0px;
	  padding-left: 5%;
	  padding-right: 5%;
	}
</style>