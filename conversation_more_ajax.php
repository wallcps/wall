 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest comment 
include_once 'includes.php';
if(isSet($_POST['last_time']))
{
$last_time=mysqli_real_escape_string($db,$_POST['last_time']);
include('conversation_load.php');
}
?>
