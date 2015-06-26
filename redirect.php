<?php
if($result)
{
$_SESSION['login']=true;
$_SESSION['userSession']=$result;
$_SESSION['uid']=$result;
$uid=$_SESSION['uid'];

$usernameOauth=$Wall->usernameCheck($uid);
if($usernameOauth)
{
$home=$base_url.'login.php';
echo "<script>window.location.href='".$home."'</script>";
}
else
{
$username=$base_url.'login.php';
echo "<script>window.location.href='".$username."'</script>";	
}

}
?>