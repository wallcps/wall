 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest update 
include_once 'includes.php';
if(isSet($_POST['uid']))
{
$uid=$_POST['uid'];
$gid = $_POST['gid'];
$data=$Wall->Promote_Project_Admin($uid, $gid);
if($data){
	echo "This User has promoted to be Admin!";
}else{
	echo "Sorry, this user cannot be promoted to be Admin!";
}
}
?>
