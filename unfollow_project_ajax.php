 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest update 
include_once 'includes.php';
if(isSet($_POST['uid']))
{
$uid=$_POST['uid'];
$gid = $_POST['gid'];
$data=$Wall->Unfollow_Project($uid, $gid);
return $data;
}
?>
