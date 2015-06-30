<?php

class Wall_Updates
{

private $db;

public function __construct($db)
{
	$this->db = $db;
}
// recruitment
// recruitment
public function Update_recruitment($pro_id,$recruitment_des, $image_path){
    $recruitment_des = mysqli_real_escape_string($this->db,$recruitment_des);
    $image_path = mysqli_real_escape_string($this->db,$image_path);
    mysqli_query($this->db,"UPDATE projects SET recruit_text='$recruitment_des',recruit_image='$image_path' WHERE proj_id='$pro_id'") or die(mysqli_error($this->db));
    return true;
    // UPDATE projects SET contact_intro='$contacts_des',contact_img='$image_path' WHERE proj_id='$pro_id'
}

public function Update_recruitment2($pro_id,$recruitment_des){
    $recruitment_des = mysqli_real_escape_string($this->db,$recruitment_des);
    mysqli_query($this->db,"UPDATE projects SET recruit_text='$recruitment_des' WHERE proj_id='$pro_id'") or die(mysqli_error($this->db));
   // UPDATE projects SET contact_intro='$contacts_des' WHERE proj_id='$pro_id'
    return true;
}
/* Website Configurations */
public function Get_Configurations()
{
	$query=mysqli_query($this->db,"SELECT applicationName,applicationDesc,forgot,newsfeedPerPage,friendsPerPage,photosPerPage,groupsPerPage,adminPerPage,notificationPerPage, uploadImage,bannerWidth, profileWidth,gravatar,friendsWidgetPerPage FROM configurations WHERE con_id='1' ")or die(mysqli_error($this->db));
    $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

 // start of contact us page
public function Update_contact($pro_id,$contact_des, $image_path){
    $contacts_des = mysqli_real_escape_string($this->db,$contact_des);
    $image_path = mysqli_real_escape_string($this->db,$image_path);
    mysqli_query($this->db,"UPDATE projects SET contact_intro='$contacts_des',contact_img='$image_path' WHERE proj_id='$pro_id'") or die(mysqli_error($this->db));
    return true;
}
public function Update_contact2($pro_id, $contact_des){
	$contacts_des = mysqli_real_escape_string($this->db,$contact_des);
    mysqli_query($this->db,"UPDATE projects SET contact_intro='$contacts_des' WHERE proj_id='$pro_id'") or die(mysqli_error($this->db));
    return true;
}
// the end contact us page
/* Intro Tour Check */
public function Tour($uid)
{
	$query=mysqli_query($this->db,"UPDATE users SET tour='1' WHERE uid='$uid' ")or die(mysqli_error($this->db));
    $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

function checkalreadyfollowproject($uid,$gid){
     return $query = mysqli_query($this->db,"SELECT DISTINCT project_involvement.id as id FROM project_involvement INNER JOIN groups ON project_involvement.group_id = groups.group_id WHERE uid='$uid' AND groups.group_id='$gid'
        UNION    
        SELECT projects.proj_id as id FROM projects INNER JOIN groups ON projects.group_id = groups.group_id WHERE uid_fk='$uid' AND groups.group_id='$gid' LIMIT 1");
    
}


public function groupOwnerEmail($gid){
	$query=mysqli_query($this->db,"SELECT email FROM users INNER JOIN groups ON groups.uid_fk = users.uid WHERE groups.group_id='$gid' limit 1");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}



/*Username Check for Oauth users*/
public function usernameCheck($uid)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$query=mysqli_query($this->db,"SELECT username FROM users WHERE uid='$uid'");
	if(mysqli_num_rows($query)==1)
	{
		$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
		return $row['username'];
	}
	else
	{
		return false;
	}
}
public function User_Details_UserFullName ($username){
	$username=mysqli_real_escape_string($this->db,$username);
	$query=mysqli_query($this->db,"SELECT first_name,last_name FROM users WHERE username='$username'");
	if(mysqli_num_rows($query)==1)
	{
		$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
		return $data;
	}
	else
	{
		return false;
	}
}
/*Username Check for Oauth users*/
public function usernameUpdate($uid,$username)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$username=mysqli_real_escape_string($this->db,$username);
	$query=mysqli_query($this->db,"SELECT uid FROM users WHERE username='$username'");
	if(mysqli_num_rows($query)==0)
	{
	$time=time();
		mysqli_query($this->db,"UPDATE users SET username='$username' WHERE uid = '$uid'");
		/*Friend Page Entry*/
		mysqli_query($this->db,"INSERT INTO friends(friend_one,friend_two,role,created)VALUES('$uid','$uid','me','$time')");
		return $uid;
	}
	else
	{
		return false;
	}
}

/*User Login Check*/
public function Login_Check($value,$type)
{
	$username_email=mysqli_real_escape_string($this->db,$value);
	if($type)
	{
		$query=mysqli_query($this->db,"SELECT uid FROM users WHERE username='$username_email' AND statu='1' ");
	}
	else
	{
		$query=mysqli_query($this->db,"SELECT uid FROM users WHERE email='$username_email' ");
	}
	return mysqli_num_rows($query);
}

/* User ID  Check*/
public function User_ID($username)
{
	$username=mysqli_real_escape_string($this->db,$username);
	$query=mysqli_query($this->db,"SELECT uid FROM users WHERE username='$username' AND status='1'");
	if(mysqli_num_rows($query)==1)
	{
		$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
		return $row['uid'];
	}
	else
	{
		return false;
	}
}

/* User Details*/
public function User_Details($uid)
{
        $username = mysqli_real_escape_string($this->db,$uid);
        $query=  mysqli_query($this->db,"SELECT uid,tour,username,first_name,last_name,birthday,country,address,bio,email,friend_count,profile_pic,conversation_count,updates_count,profile_bg,group_count,profile_pic_status,profile_bg_position,verified,notification_created,photos_count,name AS full_name, phone, skills, interest FROM users WHERE uid='$uid' AND status='1'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

public function userEmail($uerid){
        
	$query=mysqli_query($this->db,"SELECT email FROM users WHERE uid='$uerid' limit 1");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

public function manageTab($project_id){
        
	$query=mysqli_query($this->db,"SELECT tab_home as home, tab_ourwork as ourwork, tab_ourteam as ourteam, tab_beneficiaries as beneficiaries,tab_recruitment as recruitment,tab_support as support,tab_contact as contact
            FROM projects WHERE group_id='$project_id' limit 1");
        $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

public function upateTab($id){
    
    $tab_home           = $_POST['tab_home'];
    $tab_ourwork        = $_POST['tab_ourwork'];
    $tab_ourteam        = $_POST['tab_ourteam'];
    $tab_beneficiary    = $_POST['tab_beneficiary'];
    $tab_recruitment    = $_POST['tab_recruitment'];
    $tab_support        = $_POST['tab_support'];
    $tab_contact        = $_POST['tab_contact'];
    
    mysqli_query($this->db,"UPDATE groups SET tab_home='$tab_home',tab_ourwork='$tab_ourwork',tab_ourteam='$tab_ourteam',tab_beneficiaries='$tab_beneficiary',tab_recruitment='$tab_recruitment',tab_support='$tab_support',tab_contact='$tab_contact' WHERE group_id='$id'");
    //mysqli_query($this->db,"UPDATE groups SET tab_home='$tab_home',tab_ourwork='$tab_ourwork',tab_ourteam='$tab_ourteam',tab_beneficiaries='$tab_beneficiary' WHERE group_id='$id'");
    return true;
        
}

/*User Profile Picture */
public function User_Profilepic($uid,$base_url,$upload_path)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$query = mysqli_query($this->db,"SELECT email,profile_pic,profile_pic_status FROM `users` WHERE uid='$uid'") or die(mysqli_error($this->db));
	$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
	if($row['profile_pic_status'])
	{
	/*User Uploaded Picture */
	if(!empty($row['profile_pic']))
	{
		$profile_pic_path=$base_url.$upload_path;
		$data= $profile_pic_path.$row['profile_pic'];
		return $data;
	}
	else
	{
		$data=$base_url."wall_icons/default.png";
		return $data;
	}

	}
	else
	{
		/*Gravator Image*/
		$email=$row['email'];
		$lowercase = strtolower($email);
		$imagecode = md5( $lowercase );
		$data="http://www.gravatar.com/avatar/".$imagecode."?d=mm&s=230";
		return $data;
	}
}


/*User Settings*/
public function Update_Settings($full_name,$uid,$p_status,$aboutme)
{
	$full_name=mysqli_real_escape_string($this->db,$full_name);
	$aboutme=mysqli_real_escape_string($this->db,$aboutme);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$p_status=mysqli_real_escape_string($this->db,$p_status);
	if(strlen($full_name)>0)
	{
		mysqli_query($this->db,"UPDATE users SET name='$full_name',profile_pic_status='$p_status',bio='$aboutme' WHERE uid='$uid'");
		return true;
	}
}

/*User Full Name*/
public function UserFullName($username)
{
	$username=mysqli_real_escape_string($this->db,$username);
	$query = mysqli_query($this->db,"SELECT name FROM `users` WHERE username='$username' AND status='1'") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	if($data['name'])
	{
		$name=$data['name'];
		$str_length = strlen($name);
		if($str_length > 25)
		{
			$name= substr($name, 0, 25) . "..." ;
		}
		return ucfirst($name);
	}
	else
	{
		return ucfirst($username);
	}
}

/*Change Password*/
public function Change_Password($oldpassword, $newpassword, $cpassword,$uid)
{
	$oldpassword=mysqli_real_escape_string($this->db,$oldpassword);
	$md5_oldpassword=md5($oldpassword);
	$newpassword=mysqli_real_escape_string($this->db,$newpassword);
	$md5_newpassword=md5($newpassword);
	$cpassword=mysqli_real_escape_string($this->db,$cpassword);
	$md5_cpassword=md5($cpassword);
	$uid=mysqli_real_escape_string($this->db,$uid);
	if($newpassword==$cpassword)
	{
		$query=mysqli_query($this->db,"SELECT uid FROM users WHERE uid='$uid' AND password='$md5_oldpassword'");
		if(mysqli_num_rows($query)>0)
		{
			$query=mysqli_query($this->db,"UPDATE users SET password='$md5_newpassword' WHERE uid='$uid'") or die(mysqli_error($this->db));
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}


/*User Group Search  */
public function User_Group_Search($searchword)
{
	$q=mysqli_real_escape_string($this->db,$searchword);
	$query=mysqli_query($this->db,"(SELECT username as name,uid as id,bio as aboutme, 0 as face,'user' as type FROM users WHERE status='1' AND username LIKE '%$q%' OR name LIKE '%$q%' ORDER BY uid DESC)
	UNION
	(SELECT group_name as name,group_id as id, group_desc as aboutme, group_pic as face, type as type FROM groups WHERE group_name LIKE '%$q%' or group_desc LIKE '%$q%' ORDER BY group_id ) LIMIT 8 ");

	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
            $data[]=$row;
	}
	return $data;
}

/*Status User Check*/
public function Status_User($msgid)
{
	$msgid=mysqli_real_escape_string($this->db,$msgid);
	$query=mysqli_query($this->db,"SELECT username FROM messages M, users U WHERE  M.uid_fk=U.uid and M.msg_id='$msgid' AND U.status='1'");
	if(mysqli_num_rows($query)>0)
	{
		$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
		return $row['username'];
	}
	else
	{
		return false;
	}
}

/* Status Msg Id Check*/
public function Status_ID($msgid)
{
	$msgid=mysqli_real_escape_string($this->db,$msgid);
	$query=mysqli_query($this->db,"SELECT msg_id FROM messages M, users U WHERE  M.uid_fk=U.uid and M.msg_id='$msgid' AND U.status='1'");
	if(mysqli_num_rows($query)>0)
	{
		$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
		return $row['msg_id'];
	}
	else
	{
		return false;
	}
}

/* Share*/
public function Share($msg_id,$uid)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$uid=mysqli_real_escape_string($this->db,$uid);

	$q=mysqli_query($this->db,"SELECT share_id FROM message_share WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
	if(mysqli_num_rows($q)==0)
	{
		$q=mysqli_query($this->db,"SELECT uid_fk FROM messages WHERE msg_id='$msg_id'");
		$r=mysqli_fetch_array($q,MYSQLI_ASSOC);
		$ouid=$r['uid_fk'];
		$time=time();
		$query=mysqli_query($this->db,"INSERT INTO message_share (msg_id_fk,uid_fk,ouid_fk,created) VALUES('$msg_id','$uid','$ouid','$time')");
		$q=mysqli_query($this->db,"UPDATE messages SET share_count=share_count+1 WHERE msg_id='$msg_id'") or die(mysqli_error($this->db));
		return true;
	}
	else
	{
		return false;
	}
}

/* Unshare*/
public function Unshare($msg_id,$uid)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$q=mysqli_query($this->db,"SELECT share_id FROM message_share WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
	if(mysqli_num_rows($q)>0)
	{
		$query=mysqli_query($this->db,"DELETE FROM message_share WHERE msg_id_fk='$msg_id' and uid_fk='$uid'");
		$q=mysqli_query($this->db,"UPDATE messages SET share_count=share_count-1 WHERE msg_id='$msg_id'") or die(mysqli_error($this->db));
		return true;
	}
	else
	{
		return false;
	}
}

/*Share Message*/
public function Share_Msg($msg_id)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$query=mysqli_query($this->db,"SELECT uid_fk FROM message_share WHERE msg_id_fk='$msg_id' ORDER BY share_id DESC  LIMIT 1 ");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['uid_fk'];
}

/*Share Message*/
public function Like_Msg($msg_id)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$query=mysqli_query($this->db,"SELECT uid_fk FROM message_like WHERE msg_id_fk='$msg_id' ORDER BY like_id DESC  LIMIT 1 ");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['uid_fk'];
}

/*Like Check*/
public function Like($msg_id,$uid)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$q=mysqli_query($this->db,"SELECT like_id FROM message_like WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
	if(mysqli_num_rows($q)==0)
	{
		$q=mysqli_query($this->db,"SELECT uid_fk FROM messages WHERE msg_id='$msg_id'");
		$r=mysqli_fetch_array($q,MYSQLI_ASSOC);
		$ouid=$r['uid_fk'];
		$time=time();

		$query=mysqli_query($this->db,"INSERT INTO message_like (msg_id_fk,uid_fk,ouid_fk,created) VALUES('$msg_id','$uid','$ouid','$time')");
		$q=mysqli_query($this->db,"UPDATE messages SET like_count=like_count+1 WHERE msg_id='$msg_id'") or die(mysqli_error($this->db));
		$g=mysqli_query($this->db,"SELECT like_count FROM messages WHERE msg_id='$msg_id'");
		$d=mysqli_fetch_array($g,MYSQLI_ASSOC);
		return $d['like_count'];
	}
	else
	{
	return false;
	}
}

/*Unlike*/
public function Unlike($msg_id,$uid)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$q=mysqli_query($this->db,"SELECT like_id FROM message_like WHERE uid_fk='$uid' and msg_id_fk='$msg_id' ");
	if(mysqli_num_rows($q)>0)
	{
		$query=mysqli_query($this->db,"DELETE FROM message_like WHERE msg_id_fk='$msg_id' and uid_fk='$uid'");
		$q=mysqli_query($this->db,"UPDATE messages SET like_count=like_count-1 WHERE msg_id='$msg_id'") or die(mysqli_error($this->db));
		$g=mysqli_query($this->db,"SELECT like_count FROM messages WHERE msg_id='$msg_id'");
		$d=mysqli_fetch_array($g,MYSQLI_ASSOC);
		return $d['like_count'];
	}
	else
	{
		return false;
	}
}

/*Comment Like */
public function Comment_Like($com_id,$uid)
{
	$com_id=mysqli_real_escape_string($this->db,$com_id);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$q=mysqli_query($this->db,"SELECT clike_id FROM comment_like WHERE  uid_fk='$uid' and com_id_fk='$com_id' ");
	if(mysqli_num_rows($q)==0)
	{
		$q=mysqli_query($this->db,"SELECT M.uid_fk FROM messages M, comments C WHERE M.msg_id=C.msg_id_fk AND C.com_id='$com_id'");
		$r=mysqli_fetch_array($q,MYSQLI_ASSOC);
		$ouid=$r['uid_fk'];
		$time=time();
		$query=mysqli_query($this->db,"INSERT INTO comment_like (com_id_fk,uid_fk,ouid_fk,created) VALUES('$com_id','$uid','$ouid','$time')");
		$q=mysqli_query($this->db,"UPDATE comments SET like_count=like_count+1 WHERE com_id='$com_id'") or die(mysqli_error($this->db));
		$g=mysqli_query($this->db,"SELECT like_count FROM comments WHERE com_id='$com_id'");
		$d=mysqli_fetch_array($g,MYSQLI_ASSOC);
		return $d['like_count'];
	}
	else
	{
		return false;
	}
}
/*Comment Like Check*/
public function Comment_Like_Check($com_id,$uid)
{
	$com_id=mysqli_real_escape_string($this->db,$com_id);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$q=mysqli_query($this->db,"SELECT clike_id FROM comment_like WHERE  uid_fk='$uid' and com_id_fk='$com_id' ");
	if(mysqli_num_rows($q)==0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

/*Comment Unlike Check*/
public function Comment_Unlike($com_id,$uid)
{
	$com_id=mysqli_real_escape_string($this->db,$com_id);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$q=mysqli_query($this->db,"SELECT clike_id FROM comment_like WHERE uid_fk='$uid' and com_id_fk='$com_id' ");
	if(mysqli_num_rows($q)>0)
	{
		$query=mysqli_query($this->db,"DELETE FROM comment_like WHERE com_id_fk='$com_id' and uid_fk='$uid'");
		$q=mysqli_query($this->db,"UPDATE comments SET like_count=like_count-1 WHERE com_id='$com_id'") or die(mysqli_error($this->db));
		$g=mysqli_query($this->db,"SELECT like_count FROM comments WHERE com_id='$com_id'");
		$d=mysqli_fetch_array($g,MYSQLI_ASSOC);
		return $d['like_count'];
	}
	else
	{
		return false;
	}
}

/*Like Users*/
public function Like_Users($msg_id)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$q=mysqli_query($this->db,"SELECT like_id FROM message_like WHERE msg_id_fk='$msg_id' ");
	if(mysqli_num_rows($q)>0)
	{
		$query=mysqli_query($this->db,"SELECT U.username FROM message_like M, users U WHERE U.uid=M.uid_fk AND M.msg_id_fk='$msg_id' AND U.status='1' LIMIT 3");
		while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			$data[]=$row;
		}
		return $data;
	}
}

/*Share Validate Check*/
public function Share_Check($msg_id,$uid)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$q=mysqli_query($this->db,"SELECT share_id FROM message_share WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
	if(mysqli_num_rows($q)==0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

/*Like Validate Check*/
public function Like_Check($msg_id,$uid)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$q=mysqli_query($this->db,"SELECT like_id FROM message_like WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
	if(mysqli_num_rows($q)==0)
	{
		return true;
	}
	else
	{
		return false;
	}
}



/* Status Updates   	*/
public function Status_Update($msgid)
{
	$query = mysqli_query($this->db,"SELECT M.msg_id,M.msg_title, M.uid_fk, M.message, M.created,M.like_count,M.comment_count,M.share_count, U.username,M.uploads FROM messages M, users U  WHERE U.status='1' AND M.uid_fk=U.uid and M.msg_id='$msgid'") or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/*Comments*/
public function Comments($msg_id,$second_count)
{
	$msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$query='';
	if($second_count)
	{
	$query="limit $second_count,2";
	}

	$query = mysqli_query($this->db,"SELECT C.com_id, C.uid_fk, C.comment, C.created,C.like_count, U.username FROM comments C, users U WHERE U.status='1' AND C.uid_fk=U.uid and C.msg_id_fk='$msg_id' order by C.com_id asc $query") or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	$data[]=$row;
	if(!empty($data))
	{
	return $data;
	}
}

/*Insert Update*/
public function Insert_Update($uid,$title,$keyword,$update,$uploads,$group_id,$cate_id)
{
	$group_id=mysqli_real_escape_string($this->db,$group_id);
	$update=mysqli_real_escape_string($this->db,$update);
	$msg_title =mysqli_real_escape_string($this->db,$title);
	$msg_keyword =mysqli_real_escape_string($this->db,$keyword);
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	if(empty($group_id))
	{
	$query = mysqli_query($this->db,"SELECT msg_id,message,created FROM `messages` WHERE uid_fk='$uid' order by msg_id desc limit 1") or die(mysqli_error($this->db));
	}
	else
	{
	$query = mysqli_query($this->db,"SELECT msg_id,message,created FROM `messages` WHERE uid_fk='$uid' and group_id_fk='$group_id' order by msg_id desc limit 1") or die(mysqli_error($this->db));
	}

	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

	if ($update!=$result['message'] && $time!=$result['created'])
	{
	$uploads_array=explode(',',$uploads);
	$uploads=implode(',',array_unique($uploads_array));

	if(empty($group_id))
	{
	$query = mysqli_query($this->db,"INSERT INTO `messages` (msg_title,msg_keyword,message, uid_fk, ip,created,uploads,cate_id) VALUES ('$msg_title','$msg_keyword','$update', '$uid', '$ip','$time','$uploads','$cate_id')") or die(mysqli_error($this->db));
	$v = mysqli_query($this->db,"UPDATE `users` SET updates_count=updates_count+1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	$newquery = mysqli_query($this->db,"SELECT M.group_id_fk,M.msg_id, M.uid_fk, M.message, M.created,M.uploads,M.like_count,M.comment_count,M.share_count, U.username FROM messages M, users U where M.uid_fk=U.uid and M.uid_fk='$uid' order by M.msg_id desc limit 1 ");
	$result = mysqli_fetch_array($newquery,MYSQLI_ASSOC);
	}
	else
	{
	$query = mysqli_query($this->db,"INSERT INTO `messages` (msg_title,msg_keyword,message, uid_fk, ip,created,uploads,group_id_fk,cate_id) VALUES ('$msg_title','$msg_keyword','$update', '$uid', '$ip','$time','$uploads','$group_id','$cate_id')") or die(mysqli_error($this->db));
	$v = mysqli_query($this->db,"UPDATE `groups` SET group_updates=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	$newquery = mysqli_query($this->db,"SELECT M.group_id_fk,M.msg_id, M.uid_fk, M.message, M.created,M.uploads,M.like_count,M.comment_count,M.share_count, U.username FROM messages M, users U where M.uid_fk=U.uid and M.uid_fk='$uid' order by M.msg_id desc limit 1 ");
	$result = mysqli_fetch_array($newquery,MYSQLI_ASSOC);
	}


	return $result;
	}
	else
	{
	return false;
	}
}

/*Delete update*/
public function Delete_Update($uid,$msg_id,$group_id)
{
  $msg_id=mysqli_real_escape_string($this->db,$msg_id);
	$group_id=mysqli_real_escape_string($this->db,$group_id);
    echo "groupid".$group_id;
	if(!empty($group_id))
	{

	$query=mysqli_query($this->db,"SELECT group_id FROM `groups` WHERE group_id = '$group_id' and uid_fk='$uid'") or die(mysqli_error($this->db));
	$msg_num=mysqli_num_rows($query);
	}
	else
	{
	$query=mysqli_query($this->db,"SELECT msg_id FROM `messages` WHERE msg_id = '$msg_id' and uid_fk='$uid'") or die(mysqli_error($this->db));
  $msg_num=mysqli_num_rows($query);
	}


	if($msg_num)
	{
	mysqli_query($this->db,"DELETE FROM `message_like` WHERE msg_id_fk = '$msg_id'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"DELETE FROM `comments` WHERE msg_id_fk = '$msg_id'") or die(mysqli_error($this->db));

	/*Start Delete Upload Images*/
	$q=mysqli_query($this->db,"SELECT uploads FROM `messages` WHERE msg_id = '$msg_id'") or die(mysqli_error($this->db));
	$row=mysqli_fetch_array($q,MYSQLI_ASSOC);
	if(strlen($row['uploads'])>1)
	{
	$s = explode(",", $row['uploads']);
	$i=1;
	$f=count($s);
	foreach($s as $a)
	{
	$query = mysqli_query($this->db,"SELECT image_path FROM user_uploads WHERE id='$a'") or die(mysqli_error($this->db));
	$newdata = mysqli_fetch_array($query,MYSQLI_ASSOC);

	if($newdata)
	{
	$final_image="uploads/".$newdata['image_path'];
	if(empty($group_id))
	{
	mysqli_query($this->db,"DELETE FROM user_uploads WHERE id='$a'") or die(mysqli_error($this->db));
  }
	unlink($final_image);
	}
	$i=$i+1;
	}
	}
	/* End */
	mysqli_query($this->db,"DELETE FROM `messages` WHERE msg_id = '$msg_id'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"UPDATE `users` SET updates_count=updates_count-1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	return true;
	}

}

public function Insert_Aspiration($uid,$title,$content,$picture,$group_id,$com_id)
{
	$title=mysqli_real_escape_string($this->db,$title);
	$content=mysqli_real_escape_string($this->db,$content);
	$picture =mysqli_real_escape_string($this->db,$picture);
        $cate_id = 5;
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	
	$query = mysqli_query($this->db,"INSERT INTO `messages` (msg_title,message, uid_fk, ip,created,group_id_fk,cate_id) VALUES ('$title','$content','$uid','$ip','$time','$group_id','$cate_id')") or die(mysqli_error($this->db));
	$v = mysqli_query($this->db,"UPDATE `groups` SET group_updates=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	
        $b= mysqli_query($this->db,"SELECT msg_id FROM messages WHERE uid_fk='$uid' ORDER BY msg_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$msg_id=$data['msg_id'];
        if(strlen($picture)>0){
            $new_query = mysqli_query($this->db,"INSERT INTO `aspiration` (msg_id, community_id, image) VALUES ('$msg_id','$com_id','$picture')") or die(mysqli_error($this->db));
        }else{
            $new_query = mysqli_query($this->db,"INSERT INTO `aspiration` (msg_id, community_id) VALUES ('$msg_id','$com_id')") or die(mysqli_error($this->db));
        }
        return true;

}

public function Insert_Social_Need($uid,$title,$content,$short_content,$keyword,$picture,$group_id,$proj_id)
{
	$title=mysqli_real_escape_string($this->db,$title);
	$content=mysqli_real_escape_string($this->db,$content);
	$short_content=mysqli_real_escape_string($this->db,$short_content);
    $keyword =mysqli_real_escape_string($this->db,$keyword);
	$picture =mysqli_real_escape_string($this->db,$picture);
    $cate_id = 2;
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	
	$query = mysqli_query($this->db,"INSERT INTO `messages` (msg_title,message ,short_message, uid_fk, ip,created,group_id_fk,cate_id) VALUES ('$title','$content','$short_content','$uid','$ip','$time','$group_id','$cate_id')") or die(mysqli_error($this->db));
	$v = mysqli_query($this->db,"UPDATE `groups` SET group_updates=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	
        $b= mysqli_query($this->db,"SELECT msg_id FROM messages WHERE uid_fk='$uid' ORDER BY msg_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$msg_id=$data['msg_id'];
        if(strlen($picture)>0){
            $new_query = mysqli_query($this->db,"INSERT INTO `proj_social_needs` (msg_id, sn_pid, sn_keywords, sn_image) VALUES ('$msg_id','$proj_id','$keyword','$picture')") or die(mysqli_error($this->db));
        }else{
            $new_query = mysqli_query($this->db,"INSERT INTO `proj_social_needs` (msg_id, sn_pid, sn_keywords) VALUES ('$msg_id','$proj_id','$keyword')") or die(mysqli_error($this->db));
        }
        return true;

}

public function Insert_Program_Plan($uid,$title,$content,$keyword,$picture,$group_id,$proj_id, $sn_id)
{
	$title=mysqli_real_escape_string($this->db,$title);
	$content=mysqli_real_escape_string($this->db,$content);
        $keyword =mysqli_real_escape_string($this->db,$keyword);
	$picture =mysqli_real_escape_string($this->db,$picture);
        $cate_id = 3;
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	
	$query = mysqli_query($this->db,"INSERT INTO `messages` (msg_title,message, uid_fk, ip,created,group_id_fk,cate_id) VALUES ('$title','$content','$uid','$ip','$time','$group_id','$cate_id')") or die(mysqli_error($this->db));
	$v = mysqli_query($this->db,"UPDATE `groups` SET group_updates=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	
        $b= mysqli_query($this->db,"SELECT msg_id FROM messages WHERE uid_fk='$uid' ORDER BY msg_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$msg_id=$data['msg_id'];
        if(strlen($picture)>0){
            $new_query = mysqli_query($this->db,"INSERT INTO `proj_program` (msg_id, prog_pid, prog_keywords, prog_image) VALUES ('$msg_id','$proj_id','$keyword','$picture')") or die(mysqli_error($this->db));
        }else{
            $new_query = mysqli_query($this->db,"INSERT INTO `proj_program` (msg_id, prog_pid, prog_keywords) VALUES ('$msg_id','$proj_id','$keyword')") or die(mysqli_error($this->db));
        }
        $c= mysqli_query($this->db,"SELECT prog_id FROM proj_program WHERE msg_id='$msg_id' ORDER BY msg_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data2=mysqli_fetch_array($c,MYSQLI_ASSOC);
	$prog_id=$data2['prog_id'];
        $query2 = mysqli_query($this->db,"INSERT INTO `social_need_prog_plan` (sn_id, prog_id) VALUES ('$sn_id','$prog_id')") or die(mysqli_error($this->db));
        return true;

}

public function Insert_Outcome($uid,$title,$content,$keyword,$picture,$group_id,$proj_id, $pp_id)
{
	$title=mysqli_real_escape_string($this->db,$title);
	$content=mysqli_real_escape_string($this->db,$content);
        $keyword =mysqli_real_escape_string($this->db,$keyword);
	$picture =mysqli_real_escape_string($this->db,$picture);
        $cate_id = 4;
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	
	$query = mysqli_query($this->db,"INSERT INTO `messages` (msg_title,message, uid_fk, ip,created,group_id_fk,cate_id) VALUES ('$title','$content','$uid','$ip','$time','$group_id','$cate_id')") or die(mysqli_error($this->db));
	$v = mysqli_query($this->db,"UPDATE `groups` SET group_updates=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	
        $b= mysqli_query($this->db,"SELECT msg_id FROM messages WHERE uid_fk='$uid' ORDER BY msg_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$msg_id=$data['msg_id'];
        if(strlen($picture)>0){
            $new_query = mysqli_query($this->db,"INSERT INTO `proj_outcomes` (msg_id, outcome_pid, outcome_keywords, outcome_image) VALUES ('$msg_id','$proj_id','$keyword','$picture')") or die(mysqli_error($this->db));
        }else{
            $new_query = mysqli_query($this->db,"INSERT INTO `proj_outcomes` (msg_id, outcome_pid, outcome_keywords) VALUES ('$msg_id','$proj_id','$keyword')") or die(mysqli_error($this->db));
        }
        $c= mysqli_query($this->db,"SELECT outcome_id FROM proj_outcomes WHERE msg_id='$msg_id' ORDER BY msg_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data2=mysqli_fetch_array($c,MYSQLI_ASSOC);
	$outcome_id=$data2['outcome_id'];
        $query2 = mysqli_query($this->db,"INSERT INTO `prog_plan_outcome` (prog_id, outcome_id) VALUES ('$pp_id','$outcome_id')") or die(mysqli_error($this->db));
        return true;

}

public function Get_Com_Aspiration($community_id){
        $query=mysqli_query($this->db,"SELECT A.msg_id, M.msg_title, M.message, A.image from aspiration A INNER JOIN messages M on A.msg_id = M.msg_id where M.cate_id = '5' AND A.community_id = '$community_id'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/*Image Upload*/
public function Image_Upload($uid, $image,$group_id)
{
	$upload_path="uploads/";
	$img_src = $upload_path.$image;
	$imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
	$img_base = base64_encode($imgbinary);
	$ids = 0;

	if(empty($group_id))
	{
	$group_id='0';
	}

	$query = mysqli_query($this->db,"INSERT INTO user_uploads (image_path,uid_fk,group_id_fk)VALUES('$image' ,'$uid','$group_id')") or die(mysqli_error($this->db));
	$ids = mysql_insert_id();
	return $ids;
}

/*get Image Upload*/
public function Get_Upload_Image($uid,$image)
{
	if($image)
	{
	$query = mysqli_query($this->db,"SELECT id,image_path from user_uploads WHERE image_path='$image'") or die(mysqli_error($this->db));
	}
	else
	{
	$query = mysqli_query($this->db,"SELECT id,image_path FROM user_uploads WHERE uid_fk='$uid' order by id desc ") or die(mysqli_error($this->db));
	}
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $result;
}

/*Background Image Upload*/
public function ProfileBG_Image_Upload($uid, $image)
{
	mysqli_query($this->db,"UPDATE users SET profile_bg='$image' WHERE uid='$uid'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"INSERT INTO user_uploads (image_path,uid_fk,image_type) VALUES ('$image','$uid','1')") or die(mysqli_error($this->db));
	$query = mysqli_query($this->db,"SELECT uid,profile_bg FROM users WHERE uid='$uid'") or die(mysqli_error($this->db));
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $result;
}

/*Profile Image Upload*/
public function Profile_Image_Upload($uid, $image)
{
	mysqli_query($this->db,"UPDATE users SET profile_pic='$image',profile_pic_status='1' WHERE uid='$uid'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"INSERT INTO user_uploads (image_path,uid_fk,image_type) VALUES ('$image','$uid','2')") or die(mysqli_error($this->db));
	$query = mysqli_query($this->db,"SELECT uid,profile_pic FROM users WHERE uid='$uid'") or die(mysqli_error($this->db));
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $result;
}

/*Id Image Upload*/
public function Get_Upload_Image_Id($id)
{
	$query = mysqli_query($this->db,"SELECT image_path FROM user_uploads WHERE id='$id'") or die(mysqli_error($this->db));
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $result;
}

/*Insert Comments*/
public function Insert_Comment($uid,$msg_id,$comment)
{
	$comment=mysqli_real_escape_string($this->db,$comment);
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	$query = mysqli_query($this->db,"SELECT com_id,comment FROM `comments` WHERE uid_fk='$uid' and msg_id_fk='$msg_id' order by com_id desc limit 1 ") or die(mysqli_error($this->db));
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

	if ($comment!=$result['comment'])
	{
	$query = mysqli_query($this->db,"INSERT INTO `comments` (comment, uid_fk,msg_id_fk,ip,created) VALUES (N'$comment', '$uid','$msg_id', '$ip','$time')") or die(mysqli_error($this->db));
	mysqli_query($this->db,"UPDATE messages SET comment_count=comment_count+1 WHERE msg_id='$msg_id'") or die(mysqli_error($this->db));
	$newquery = mysqli_query($this->db,"SELECT C.com_id, C.uid_fk, C.comment, C.msg_id_fk, C.created, U.username FROM comments C, users U where C.uid_fk=U.uid and C.uid_fk='$uid' and C.msg_id_fk='$msg_id' order by C.com_id desc limit 1 ");
	$result = mysqli_fetch_array($newquery,MYSQLI_ASSOC);
	return $result;
	}
	else
	{
	return false;
	}
}

/*Delete Comments*/
public function Delete_Comment($uid, $com_id)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$com_id=mysqli_real_escape_string($this->db,$com_id);
	$q=mysqli_query($this->db,"SELECT M.uid_fk FROM comments C, messages M WHERE C.msg_id_fk = M.msg_id AND C.com_id='$com_id'");
	$d=mysqli_fetch_array($q,MYSQLI_ASSOC);
	$oid=$d['uid_fk'];
	if($uid==$oid)
	{
	$query = mysqli_query($this->db,"DELETE FROM `comments` WHERE com_id='$com_id'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"UPDATE messages SET like_count=like_count-1 WHERE msg_id='$msgid'") or die(mysqli_error($this->db));
	return true;
	}
	else
	{
	$query = mysqli_query($this->db,"DELETE FROM `comments` WHERE uid_fk='$uid' and com_id='$com_id'") or die(mysqli_error($this->db));
	return true;
	}
}

/*Save BG Position*/
public function Save_BG_Position($typeid,$type,$position,$uid)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$typeid=mysqli_real_escape_string($this->db,$typeid);
	$type=mysqli_real_escape_string($this->db,$type);
	$position=mysqli_real_escape_string($this->db,$position);

	if($type=='u')
	{
	/*User Check*/
	if($typeid==$uid)
	{
	mysqli_query($this->db,"UPDATE users SET profile_bg_position='$position' WHERE uid='$uid'") or die(mysqli_error($this->db));
	return true;
	}
	}
	else
	{
	$q=mysqli_query($this->db,"SELECT group_id FROM groups WHERE group_id='$typeid' AND uid_fk='$uid'");
	$num=mysqli_num_rows($q);
	if($num>0)
	{

	mysqli_query($this->db,"UPDATE groups SET group_bg_position='$position' WHERE group_id='$typeid' AND uid_fk='$uid'") or die(mysqli_error($this->db));
	return true;
	}
	}
}


/*Delete images*/
public function Delete_Image($uid, $pid,$upload_path)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$com_id=mysqli_real_escape_string($this->db,$pid);
	$query=mysqli_query($this->db,"SELECT id,image_path FROM user_uploads U WHERE id='$pid' AND uid_fk='$uid'");
	$num=mysqli_num_rows($query);
	if($num>0)
	{
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	$final_image=$upload_path.$data['image_path'];
	unlink($final_image);

	$q=mysqli_query($this->db,"SELECT uploads,msg_id FROM messages WHERE uid_fk='$uid' AND uploads!=0 AND  uploads LIKE '%$pid%';");
	$d=mysqli_fetch_array($q,MYSQLI_ASSOC);
	$msgid=$d['msg_id'];
	$str = $d['uploads'];

	$tmp = explode(",", $str);
	$key = array_search($pid, $tmp);
	if($key)
	$tmp[$key] = null;
	$tmp = array_filter($tmp);
	$newSet = implode(",",$tmp);
	$newSet=(string)$newSet;

	if($newSet==$str)
	{
	$pattern = '/(\,)?'.$pid.'(\,)?/i';
	$newSet=preg_replace($pattern, '', $str);
	}

	if(strlen($newSet)==0)
	$newSet='0';

	mysqli_query($this->db,"UPDATE messages SET uploads='$newSet' WHERE msg_id='$msgid' and uid_fk='$uid'") or die(mysqli_error($this->db));
	$query = mysqli_query($this->db,"DELETE FROM user_uploads WHERE id='$pid' AND uid_fk='$uid'") or die(mysqli_error($this->db));
	return true;
	}

}

/*Friend List*/
public function Welcome_Friends($uid)
{
	$query=mysqli_query($this->db,"SELECT U.username, U.uid, U.bio FROM users U WHERE U.status='1' AND U.uid<>'$uid'  ORDER BY RAND()  LIMIT 5")or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/*Friend List*/
public function Friends_List($uid, $page, $offset, $rowsPerPage)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$page=mysqli_real_escape_string($this->db,$page);
	$offset=mysqli_real_escape_string($this->db,$offset);
	$rowsPerPage=mysqli_real_escape_string($this->db,$rowsPerPage);

	if($page)
	{
	$con=$offset.",".$rowsPerPage;
	}
	else
	{
	$con=$rowsPerPage;
	}

	$query=mysqli_query($this->db,"SELECT '' as status,U.username, U.uid, U.bio FROM users U, friends F WHERE U.status='1' AND U.uid=F.friend_two AND F.friend_one='$uid' AND F.role='fri' ORDER BY F.friend_id DESC LIMIT $con")or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/*Friend Valid Check*/
public function Friends_Check($uid,$fid)
{
	$query=mysqli_query($this->db,"SELECT role FROM friends WHERE friend_one='$uid' AND friend_two='$fid'") or die(mysqli_error($this->db));
	$num=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $num['role'];
}

/*Friends count*/
public function Friends_Check_Count($uid,$fid)
{
	$query=mysqli_query($this->db,"SELECT friend_id FROM friends WHERE friend_one='$uid' AND friend_two='$fid'") or die(mysqli_error($this->db));
	$num=mysqli_num_rows($query);
	return $num;
}

/*Add Friend*/
public function Add_Friend($uid,$fid)
{
	$fid=mysqli_real_escape_string($this->db,$fid);
	$q=mysqli_query($this->db,"SELECT friend_id FROM friends WHERE friend_one='$uid' AND friend_two='$fid' AND role='fri'");
	if(mysqli_num_rows($q)==0)
	{
	$time=time();
	$query=mysqli_query($this->db,"INSERT INTO friends(friend_one,friend_two,role,created) VALUES ('$uid','$fid','fri','$time')") or die(mysqli_error($this->db));
	$query=mysqli_query($this->db,"UPDATE users SET friend_count=friend_count+1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	return true;
	}
}

/*Remove Friend*/
public function Remove_Friend($uid,$fid)
{
	$fid=mysqli_real_escape_string($this->db,$fid);
	$q=mysqli_query($this->db,"SELECT friend_id FROM friends WHERE friend_one='$uid' AND friend_two='$fid' AND role='fri'");
	if(mysqli_num_rows($q)==1)
	{
	$query=mysqli_query($this->db,"DELETE FROM friends WHERE friend_one='$uid' AND friend_two='$fid'") or die(mysqli_error($this->db));
	$query=mysqli_query($this->db,"UPDATE users SET friend_count=friend_count-1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	return true;
	}
}

/*Photos List*/
public function Photos_List($uid, $page, $offset, $rowsPerPage,$photos_of)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$page=mysqli_real_escape_string($this->db,$page);
	$offset=mysqli_real_escape_string($this->db,$offset);
	$rowsPerPage=mysqli_real_escape_string($this->db,$rowsPerPage);

	if($page)
	{
	$con=$offset.",".$rowsPerPage;
	}
	else
	{
	$con=$rowsPerPage;
	}

	if($photos_of)
	{
	$query=mysqli_query($this->db,"SELECT id,image_path FROM user_uploads WHERE  uid_fk='$uid' AND group_id_fk='0' AND image_type>'0' ORDER BY id DESC LIMIT $con")or die(mysqli_error($this->db));
	}
	else
	{
	$query=mysqli_query($this->db,"SELECT id,image_path FROM user_uploads WHERE  uid_fk='$uid' AND group_id_fk='0' AND image_type='0' ORDER BY id DESC LIMIT $con")or die(mysqli_error($this->db));
	}

	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/*Photos count*/
public function Photos_Check_Count($uid,$fid)
{
	$query=mysqli_query($this->db,"SELECT id FROM user_uploads WHERE uid_fk='$uid'") or die(mysqli_error($this->db));
	$num=mysqli_num_rows($query);
	return $num;
}

/*Photos List*/
public function Group_Photos_List($group_id, $page, $offset, $rowsPerPage)
{

	$group_id=mysqli_real_escape_string($this->db,$group_id);
	$page=mysqli_real_escape_string($this->db,$page);
	$offset=mysqli_real_escape_string($this->db,$offset);
	$rowsPerPage=mysqli_real_escape_string($this->db,$rowsPerPage);

	if($page)
	{
	$con=$offset.",".$rowsPerPage;
	}
	else
	{
	$con=$rowsPerPage;
	}

	$query=mysqli_query($this->db,"SELECT id,image_path,uid_fk FROM user_uploads WHERE  group_id_fk='$group_id' ORDER BY id DESC LIMIT $con")or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/*Photos count*/
public function Group_Photos_Check_Count($uid,$fid)
{
	$query=mysqli_query($this->db,"SELECT id FROM user_uploads WHERE uid_fk='$uid' and group_id_fk='$group_id'") or die(mysqli_error($this->db));
	$num=mysqli_num_rows($query);
	return $num;
}


/*Profile Views Insert*/
public function Profile_Viewed($uid,$view_uid)
{
	$time=time();
	$q=mysqli_query($this->db,"SELECT uid_fk FROM profile_views WHERE uid_fk='$uid' AND view_uid_fk='$view_uid'");
	if(mysqli_num_rows($q)>0)
	{
	$query=mysqli_query($this->db,"UPDATE profile_views SET created='$time' WHERE uid_fk='$uid' AND view_uid_fk='$view_uid' ORDER BY created DESC") or die(mysqli_error($this->db));
	}
	else
	{
	$query=mysqli_query($this->db,"INSERT INTO profile_views (uid_fk,view_uid_fk,created) VALUES ('$uid','$view_uid','$time')") or die(mysqli_error($this->db));
	}
}

/*Profile Views List*/
public function Profile_Viewed_List($uid,$count)
{
	$q=mysqli_query($this->db,"SELECT U.uid,U.username FROM profile_views P,users U WHERE P.view_uid_fk='$uid' AND P.uid_fk=U.uid AND U.status='1' ORDER BY created DESC LIMIT $count");
	while($row=mysqli_fetch_array($q,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	if(!empty($data))
	{
	return $data;
	}
}


/*Conversations*/
public function Conversation_Single($user_one,$conversation_uid)
{
	$user_one=mysqli_real_escape_string($this->db,$user_one);
	$query=mysqli_query($this->db,"SELECT u.uid,c.c_id,u.username,u.email,c.time
	FROM conversation c, users u
	WHERE CASE
	WHEN c.user_one = '$user_one'
	THEN c.user_two = u.uid
	WHEN c.user_two = '$user_one'
	THEN c.user_one= u.uid
	END
	AND (
	c.user_one ='$user_one'
	OR c.user_two ='$user_one'
) AND u.status='1' AND u.uid='$conversation_uid' ");

	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	if(!empty($data))
	{
	return $data;
	}

}

/* Converstaions */
public function Conversation($user_one,$last_time,$conversation_uid)
{
	/* More Records*/
	$morequery="";
	if($last_time)
	{
	$morequery=" and c.time<'".$last_time."' ";
	}
	/* More Button End*/

	$user_one=mysqli_real_escape_string($this->db,$user_one);

	$query=mysqli_query($this->db,"SELECT DISTINCT u.uid,c.c_id,u.username,u.email,c.time
	FROM conversation c, users u, conversation_reply r
	WHERE CASE
	WHEN c.user_one = '$user_one'
	THEN c.user_two = u.uid
	WHEN c.user_two = '$user_one'
	THEN c.user_one= u.uid
	END
	AND (
	c.user_one ='$user_one'
	OR c.user_two ='$user_one'
) AND u.status='1' AND c.c_id=r.c_id_fk AND u.uid<>'$conversation_uid'
	$morequery ORDER BY c.time DESC Limit 10");

	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	if(!empty($data))
	{
	return $data;
	}
}

/*Insert Conversation Reply*/
public function Conversation_List($c_id,$uid)
{
	$user_one=mysqli_real_escape_string($this->db,$uid);
	$c_id=mysqli_real_escape_string($this->db,$c_id);
	$query= mysqli_query($this->db,"SELECT R.cr_id,R.time,R.reply,R.user_id_fk,R.read_status FROM conversation_reply R WHERE R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 1") or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	if(!empty($data))
	{
	return $data;
	}
}

/*Insert Conversation Reply*/
public function Conversation_Updates($c_id,$uid,$last,$conversation_uid)
{
	$c_id=mysqli_real_escape_string($this->db,$c_id);
	$query= mysqli_query($this->db,"SELECT R.cr_id, U.conversation_count FROM users U, conversation_reply R WHERE R.user_id_fk=U.uid AND U.status='1' AND R.c_id_fk='$c_id'") or die(mysqli_error($this->db));
	$g=mysqli_num_rows($query);
	$second_count=$g-20;
	$squery='';

	if($second_count && $g>20)
	{
	$x_count=$second_count.',';
	}

	/* More Records*/
	$morequery="";
	if($last)
	{
	$morequery=" and R.cr_id<'".$last."' ";
	$x_count='';
	}

	$q= mysqli_query($this->db,"SELECT R.cr_id,R.time,R.reply,R.user_id_fk FROM conversation_reply R WHERE R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$k=mysqli_fetch_array($q,MYSQLI_ASSOC);
	$o_uid=$k['user_id_fk'];
	$r=mysqli_fetch_array($query,MYSQLI_ASSOC);

	if($conversation_uid)
	{
	if($o_uid!=$uid)
	{
	mysqli_query($this->db,"UPDATE conversation_reply SET read_status='0' WHERE c_id_fk='$c_id' ORDER BY cr_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$sql=mysqli_query($this->db,"SELECT conversation_count from users WHERE uid='$uid'");
	$vv=mysqli_fetch_array($sql,MYSQLI_ASSOC);
	$conversation_count=$vv['conversation_count'];

	if($conversation_count>0)
	{
	mysqli_query($this->db,"UPDATE users SET conversation_count=conversation_count-1 WHERE uid='$uid' ") or die(mysqli_error($this->db));
	}
	}
	}

	$query= mysqli_query($this->db,"SELECT R.cr_id,R.time,R.reply,U.uid,U.username,U.email,U.conversation_count FROM users U, conversation_reply R WHERE R.user_id_fk=U.uid and R.c_id_fk='$c_id' $morequery ORDER BY R.cr_id ASC LIMIT $x_count 20") or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	if(!empty($data))
	{
	return $data;
	}

}

/*Insert Conversation Reply*/
public function Conversation_Insert($user_one,$user_two)
{
	$user_one=mysqli_real_escape_string($this->db,$user_one);
	$user_two=mysqli_real_escape_string($this->db,$user_two);
	if($user_one!=$user_two)
	{
	if($user_one>0 && $user_two>0 )
	{
	$q= mysqli_query($this->db,"SELECT c_id FROM conversation WHERE (user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one') ") or die(mysqli_error($this->db));
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	if(mysqli_num_rows($q)==0)
	{
	$query = mysqli_query($this->db,"INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')") or die(mysqli_error($this->db));

	$q=mysqli_query($this->db,"SELECT c_id FROM conversation WHERE user_one='$user_one' ORDER BY c_id DESC limit 1");
	$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
	return $v['c_id'];
	}
	else
	{
	$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
	return  $v['c_id'];
	}
	}
	}
}

/*Insert Conversation Reply*/
public function ConversationReply_Insert($reply,$cid,$uid)
{
	$reply=mysqli_real_escape_string($this->db,$reply);
	$cid=mysqli_real_escape_string($this->db,$cid);
	$uid=mysqli_real_escape_string($this->db,$uid);
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	if($uid>0 && $cid>0)
	{
	mysqli_query($this->db,"INSERT INTO conversation_reply (user_id_fk,reply,ip,time,c_id_fk) VALUES ('$uid',N'$reply','$ip','$time','$cid')") or die(mysqli_error($this->db));
	$time=time();
	mysqli_query($this->db,"UPDATE conversation SET time='$time' WHERE c_id='$cid'") or die(mysqli_error($this->db));
	$q=mysqli_query($this->db,"SELECT if(user_one = '$uid',user_two,user_one) AS uid FROM conversation where c_id = '$cid' ") or die(mysqli_error($this->db));
	$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
	$o_uid=$v['uid'];
	if($o_uid!=$uid)
	{
	$g=mysqli_query($this->db,"SELECT read_status FROM conversation_reply WHERE c_id_fk='$cid' and user_id_fk='$uid' ORDER BY cr_id DESC LIMIT 1,1") or die(mysqli_error($this->db));
	$h=mysqli_fetch_array($g,MYSQLI_ASSOC);
	if($h['read_status']==0 || $h['read_status']='' )
	{
	mysqli_query($this->db,"UPDATE users SET conversation_count=conversation_count+1 WHERE uid='$o_uid'") or die(mysqli_error($this->db));
	}
	}
	$q=mysqli_query($this->db,"SELECT R.cr_id,R.time,R.reply,U.uid,U.username,U.email FROM users U, conversation_reply R WHERE R.user_id_fk=U.uid and R.c_id_fk='$cid' ORDER BY R.cr_id DESC");
	$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
	return $v;
	}
}

/*Delete Conversation Reply*/
public function Delete_Conversation($uid, $c_id)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$c_id=mysqli_real_escape_string($this->db,$c_id);
	$q = mysqli_query($this->db,"SELECT c_id FROM conversation WHERE c_id = '$c_id' and (user_one='$uid' or user_two='$uid')") or die(mysqli_error($this->db));
	if(mysqli_num_rows($q)>0)
	{
	$g=mysqli_query($this->db,"SELECT read_status,user_id_fk FROM conversation_reply WHERE c_id_fk='$c_id'  ORDER BY cr_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$h=mysqli_fetch_array($g,MYSQLI_ASSOC);
	$vid=$h['user_id_fk'];
	if($h['read_status']==1  )
	{
	$q=mysqli_query($this->db,"SELECT if(user_one = '$vid',user_two,user_one) AS uid FROM conversation where c_id = '$c_id' ") or die(mysqli_error($this->db));
	$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
	$o_uid=$v['uid'];

	mysqli_query($this->db,"UPDATE users SET conversation_count=conversation_count-1 WHERE uid='$o_uid'") or die(mysqli_error($this->db));
	}
	mysqli_query($this->db,"DELETE FROM `conversation_reply` WHERE c_id_fk = '$c_id'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"DELETE FROM `conversation` WHERE c_id = '$c_id'") or die(mysqli_error($this->db));
	}
	return true;
}

/* Get Dashboard Information */
public function Get_Dashboard_Info(){
        $query=mysqli_query($this->db,"SELECT teach_n_learn, sustain_project, volunteer_better,want_volunteer FROM dashboard WHERE id='1' LIMIT 1");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Update Dashboard Information */
public function Update_Volunteer_Better($p){
        $p = mysqli_real_escape_string($this->db,$p);
	mysqli_query($this->db,"UPDATE dashboard SET volunteer_better='$p' WHERE id='1'") or die(mysqli_error($this->db));
	return true;
}

/* Update Dashboard Information */
public function Update_Sustain_Project($p){
        $p = mysqli_real_escape_string($this->db,$p);
	mysqli_query($this->db,"UPDATE dashboard SET sustain_project='$p' WHERE id='1'") or die(mysqli_error($this->db));
	return true;
}

/* Get Teach and Learn */
public function Get_Teach_n_Learn(){
        $query=mysqli_query($this->db,"SELECT id, title, url, image_path FROM teach_n_learn");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

public function Get_Teach_n_Learn_Content($id){
        $query=mysqli_query($this->db,"SELECT id, title, url, image_path FROM teach_n_learn WHERE id = '$id'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Steps for sustaining projects*/
public function Get_Steps_Sustain_Project(){
        $query=mysqli_query($this->db,"SELECT id, title, content, image_path FROM sustain_project");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

public function Get_Steps_Sustain_Project_Content($id){
        $query=mysqli_query($this->db,"SELECT id, title, content, image_path FROM sustain_project WHERE id = '$id'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

public function Update_Teach_Learn($p){
        $p = mysqli_real_escape_string($this->db,$p);
	mysqli_query($this->db,"UPDATE dashboard SET teach_n_learn='$p' WHERE id='1'") or die(mysqli_error($this->db));
	return true;
}

public function Update_TL_Content_1($id, $title, $url, $image_path){
    $id = mysqli_real_escape_string($this->db,$id);
    $title = mysqli_real_escape_string($this->db,$title);
    $url = mysqli_real_escape_string($this->db,$url);
    $image_path = mysqli_real_escape_string($this->db,$image_path);
    mysqli_query($this->db,"UPDATE teach_n_learn SET title='$title', url='$url', image_path='$image_path' WHERE id='$id'") or die(mysqli_error($this->db));
    return true;
}

public function Update_TL_Content_2($id, $title, $url){
    $id = mysqli_real_escape_string($this->db,$id);
    $title = mysqli_real_escape_string($this->db,$title);
    $url = mysqli_real_escape_string($this->db,$url);
    mysqli_query($this->db,"UPDATE teach_n_learn SET title='$title', url='$url' WHERE id='$id'") or die(mysqli_error($this->db));
    return true;
}

public function Update_Step_Content_1($id, $title, $content, $image_path){
    $id = mysqli_real_escape_string($this->db,$id);
    $title = mysqli_real_escape_string($this->db,$title);
    $content = mysqli_real_escape_string($this->db,$content);
    $image_path = mysqli_real_escape_string($this->db,$image_path);
    mysqli_query($this->db,"UPDATE sustain_project SET title='$title', content='$content', image_path='$image_path' WHERE id='$id'") or die(mysqli_error($this->db));
    return true;
}

public function Update_Step_Content_2($id, $title, $content){
    $id = mysqli_real_escape_string($this->db,$id);
    $title = mysqli_real_escape_string($this->db,$title);
    $content = mysqli_real_escape_string($this->db,$content);
    mysqli_query($this->db,"UPDATE sustain_project SET title='$title', content='$content' WHERE id='$id'") or die(mysqli_error($this->db));
    return true;
}


/* Get Volunteer Better */
public function Get_Volunteer_Better(){
        $query=mysqli_query($this->db,"SELECT id, logo_path, title FROM volunteer_better");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/* Get Each Volunteer Better */
public function Get_Each_Volunteer_Better($id){
        $query=mysqli_query($this->db,"SELECT id, logo_path, title FROM volunteer_better WHERE id='$id'") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

public function Update_Vol_Better_1($id, $title, $logo_path){
    $id = mysqli_real_escape_string($this->db,$id);
    $title = mysqli_real_escape_string($this->db,$title);
    $logo_path = mysqli_real_escape_string($this->db,$logo_path);
    mysqli_query($this->db,"UPDATE volunteer_better SET title='$title', logo_path='$logo_path' WHERE id='$id'") or die(mysqli_error($this->db));
    return true;
}

public function Update_Vol_Better_2($id, $title){
    $id = mysqli_real_escape_string($this->db,$id);
    $title = mysqli_real_escape_string($this->db,$title);
    mysqli_query($this->db,"UPDATE volunteer_better SET title='$title' WHERE id='$id'") or die(mysqli_error($this->db));
    return true;
}

/* Get dashboard slideshow post */
public function Get_Dashboard_Slideshow_Post(){
        $query=mysqli_query($this->db,"SELECT id, content, reference FROM dashboard_slideshow_post");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/* Get Each dashboard slideshow post */
public function Get_Each_Dashboard_Slideshow_Post($id){
        $query=mysqli_query($this->db,"SELECT content, reference FROM dashboard_slideshow_post WHERE id='$id'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Update Each Slideshow */
public function Update_Dashboar_Slideshow_Post($id, $content, $reference){
        $id=mysqli_real_escape_string($this->db,$id);
        $content=mysqli_real_escape_string($this->db,$content);
        $reference=mysqli_real_escape_string($this->db,$reference);
	mysqli_query($this->db, "UPDATE dashboard_slideshow_post SET content='$content', reference='$reference' where id='$id'") or die(mysqli_error($this->db));
        return true;        
}

/* Delete Dashboard Slideshow Post */
public function Delete_Dashboar_Slideshow_Post($id)
{
	$id=mysqli_real_escape_string($this->db,$id);
	$query = mysqli_query($this->db,"DELETE FROM `dashboard_slideshow_post` WHERE id='$id'") or die(mysqli_error($this->db));
	return true;
}

/* Add New Slideshow Post */
public function Add_New_Dashboard_Slideshow_Post($content, $reference){
        $content=mysqli_real_escape_string($this->db,$content);
        $reference=mysqli_real_escape_string($this->db,$reference);
	mysqli_query($this->db, "INSERT INTO dashboard_slideshow_post (content, reference) VALUES ('$content', '$reference')") or die(mysqli_error($this->db));
	return true;
}

/* CPS Admin Post*/
public function Get_CPS_Admin_Post(){
        $query=mysqli_query($this->db,"SELECT id, content, reference FROM cps_admin_post");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/* Get Each CPS Admin Post */
public function Get_Each_CPS_Admin_Post($id){
        $query=mysqli_query($this->db,"SELECT content, reference FROM cps_admin_post WHERE id='$id'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Update Each CPS Admin Post */
public function Update_CPS_Admin_Post($id, $content, $reference){
        $id=mysqli_real_escape_string($this->db,$id);
        $content=mysqli_real_escape_string($this->db,$content);
        $reference=mysqli_real_escape_string($this->db,$reference);
	mysqli_query($this->db, "UPDATE cps_admin_post SET content='$content', reference='$reference' where id='$id'") or die(mysqli_error($this->db));
        return true;        
}

/* Delete CPS Admin Post */
public function Delete_CPS_Admin_Post($id)
{
	$id=mysqli_real_escape_string($this->db,$id);
	$query = mysqli_query($this->db,"DELETE FROM `cps_admin_post` WHERE id='$id'") or die(mysqli_error($this->db));
	return true;
}

/* Add New CPS Admin Post */
public function Add_New_CPS_Admin_Post($content, $reference){
        $content=mysqli_real_escape_string($this->db,$content);
        $reference=mysqli_real_escape_string($this->db,$reference);
	mysqli_query($this->db, "INSERT INTO cps_admin_post (content, reference) VALUES ('$content', '$reference')") or die(mysqli_error($this->db));
	return true;
}

/* Get Each CPS Admin Post */
public function Get_Each_Image_Guide_Volunteer($id){
        $query=mysqli_query($this->db,"SELECT image_path FROM image_guide_volunteer WHERE id='$id'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

public function Update_Image_Guide($id, $image_path){
    $image_path = mysqli_real_escape_string($this->db,$image_path);
    mysqli_query($this->db,"UPDATE image_guide_volunteer SET image_path='$image_path' WHERE id='$id'") or die(mysqli_error($this->db));
    return true;
}


/* Group Details*/
public function Group_Details($groupid)
{
	$groupid=mysqli_real_escape_string($this->db,$groupid);
	$query=mysqli_query($this->db,"SELECT group_id,group_name,uid_fk as group_owner_id,group_created,group_desc,group_pic,group_bg,group_count,group_updates,group_bg_position, type FROM groups WHERE group_id='$groupid' AND status='1'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}


/* Group Details - By Type 1:Project, 2:Community, 3:Organization */
public function User_Group_Details($uid, $type)
{
	$query=mysqli_query($this->db,"SELECT DISTINCT groups.group_id,groups.group_name,groups.uid_fk as group_owner_id,group_created,group_desc,group_pic,group_bg,group_count,group_updates,group_bg_position, type FROM groups INNER JOIN project_involvement ON project_involvement.group_id = groups.group_id WHERE project_involvement.uid='$uid' AND groups.status='1'  AND project_involvement.aprove = 1 AND deleted = 0
            UNION 
            SELECT DISTINCT groups.group_id,groups.group_name,groups.uid_fk as group_owner_id,group_created,group_desc,group_pic,group_bg,group_count,group_updates,group_bg_position, type FROM groups WHERE groups.uid_fk='$uid' AND type='$type' ORDER BY group_id DESC 
            ");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}


public function User_Community_Details($uid,$type){
    $query=mysqli_query($this->db,"SELECT group_id,group_name,uid_fk as group_owner_id,group_created,group_desc,group_pic,group_bg,group_count,group_updates,group_bg_position, type FROM groups WHERE status='1' AND type='$type'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

public function User_Ngo_Details($uid,$type){
    $query=mysqli_query($this->db,"SELECT group_id,group_name,uid_fk as group_owner_id,group_created,group_desc,group_pic,group_bg,group_count,group_updates,group_bg_position, type FROM groups WHERE status='1' AND type='$type'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

public function All_Community_count($uid,$type){
    $query=mysqli_query($this->db,"SELECT COUNT(group_id) as total_group FROM groups WHERE status='1' AND type='$type'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['total_group'];
}

public function All_Ngo_count($uid,$type){
    $query=mysqli_query($this->db,"SELECT COUNT(group_id) as total_group FROM groups WHERE status='1' AND type='$type'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['total_group'];
}



/* List All Group Details - By Type 1:Project, 2:Community, 3:Organization */
public function All_Group_Details($type)
{
	$query=mysqli_query($this->db,"SELECT group_id,group_name,uid_fk as group_owner_id,group_created,group_desc,group_pic,group_bg,group_count,group_updates,group_bg_position, type FROM groups WHERE status='1' AND type='$type'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

public function User_Group_Count($uid, $type)
{
	$query=mysqli_query($this->db,"SELECT COUNT(*) as total_group FROM(
SELECT DISTINCT groups.group_id FROM groups INNER JOIN project_involvement ON project_involvement.group_id = groups.group_id WHERE project_involvement.uid='$uid' AND groups.status='1'  AND project_involvement.aprove = 1 AND deleted = 0
            UNION 
            SELECT DISTINCT groups.group_id FROM groups WHERE groups.uid_fk='$uid' AND type='$type') as total_group");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['total_group'];
}
/* Get All Social Needs keywords */
public function Get_Social_Needs_keywords(){
    $query=mysqli_query($this->db, 
            "SELECT LCASE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(all_tags, ',' ,numbers.`num`), ',', -1))) AS one_tag, COUNT(*) AS cnt
              FROM (
                SELECT
                  GROUP_CONCAT(NULLIF(sn_keywords, '') separator ',') AS all_tags,
                  LENGTH(GROUP_CONCAT(NULLIF(sn_keywords, '') SEPARATOR ',')) - LENGTH(REPLACE(GROUP_CONCAT(NULLIF(sn_keywords, '') SEPARATOR ','), ',', '')) + 1 AS count_tags
                FROM proj_social_needs
              ) t
              JOIN numbers ON numbers.`num` <= t.count_tags
              GROUP BY one_tag
              ORDER BY cnt DESC;  ");
    while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
	$data[]=$row;
    }
    return $data;
}

/* Count Social Needs keywords */
public function Count_Social_Needs_keywords(){
    $query=mysqli_query($this->db, 
            "SELECT
                  LENGTH(GROUP_CONCAT(NULLIF(sn_keywords, '') SEPARATOR ',')) - LENGTH(REPLACE(GROUP_CONCAT(NULLIF(sn_keywords, '') SEPARATOR ','), ',', '')) + 1 AS count_tags
                FROM proj_social_needs ");
   $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
    return $data['count_tags'];
}


/* Get Social Needs keywords */
public function Get_Project_Social_Needs_keywords($pid){
    $query=mysqli_query($this->db, 
            "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(all_tags, ',' ,numbers.`num`), ',', -1) AS one_tag, COUNT(*) AS cnt
              FROM (
                SELECT
                  GROUP_CONCAT(NULLIF(sn_keywords, '') separator ',') AS all_tags,
                  LENGTH(GROUP_CONCAT(NULLIF(sn_keywords, '') SEPARATOR ',')) - LENGTH(REPLACE(GROUP_CONCAT(NULLIF(sn_keywords, '') SEPARATOR ','), ',', '')) + 1 AS count_tags
                FROM proj_social_needs where sn_pid = '$pid'
              ) t
              JOIN numbers ON numbers.`num` <= t.count_tags
              GROUP BY one_tag
              ORDER BY cnt DESC;  ");
    while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
	$data[]=$row;
    }
    return $data;
}

/* Search result - Project */
public function Discover_Project($condition){
    $condition=mysqli_real_escape_string($this->db,$condition);
    $query=mysqli_query($this->db, 
    "select * from (
        select G.group_id, G.group_name,  G.group_pic, P.start_date, P.end_date, P.proj_intro, P.location, (
        SELECT GROUP_CONCAT(NULLIF(sn_keywords, '') SEPARATOR ',') AS all_tags FROM proj_social_needs
        WHERE sn_pid = G.group_id) as keywords from groups G INNER JOIN projects P where G.group_id = P.group_id) discover
        where keywords LIKE '$condition' "
    );
//    while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
//    {
//	$data[]=$row;
//    }
//    return $data;
    return $query;
}

/* Get All Project Languages */
public function Get_Project_Langauges(){
    $query=mysqli_query($this->db, 
            "SELECT LCASE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(all_tags, ',' ,numbers.`num`), ',', -1))) AS one_tag, COUNT(*) AS cnt
              FROM (
                SELECT
                  GROUP_CONCAT(NULLIF(proj_lang, '') separator ',') AS all_tags,
                  LENGTH(GROUP_CONCAT(NULLIF(proj_lang, '') SEPARATOR ',')) - LENGTH(REPLACE(GROUP_CONCAT(NULLIF(proj_lang, '') SEPARATOR ','), ',', '')) + 1 AS count_tags
                FROM projects
              ) t
              JOIN numbers ON numbers.`num` <= t.count_tags
              GROUP BY one_tag
              ORDER BY cnt DESC;  ");
    while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
	$data[]=$row;
    }
    return $data;
}

/* Count Project Lanaguges */
public function Count_Project_Languages(){
    $query=mysqli_query($this->db, 
            "SELECT
                  LENGTH(GROUP_CONCAT(NULLIF(proj_lang, '') SEPARATOR ',')) - LENGTH(REPLACE(GROUP_CONCAT(NULLIF(proj_lang, '') SEPARATOR ','), ',', '')) + 1 AS count_tags
                FROM projects ");
   $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
    return $data['count_tags'];
}

/* Get the end date of the projects */
public function Get_All_Project_Dates(){
    $query=mysqli_query($this->db, "SELECT end_date, COUNT(*) AS 'total' FROM projects GROUP BY end_date ");
   while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
	$data[]=$row;
    }
    return $data;
}

//get project following........
public function getProject_follow($uid){
    $query=mysqli_query($this->db,"SELECT groups.group_id as project_id,groups.group_name as project_name,groups.group_pic as image from group_users inner join groups on group_users.group_id_fk = groups.group_id WHERE group_users.uid_fk='$uid' AND groups.status='1' AND group_users.status='1' AND groups.type='1' AND groups.uid_fk !='$uid'");
    return $query;    
}

//get community following........
public function getCommunity_follow($uid){
    $query=mysqli_query($this->db,"SELECT groups.group_id as project_id,groups.group_name as project_name,groups.group_pic as image from group_users inner join groups on group_users.group_id_fk = groups.group_id WHERE group_users.uid_fk='$uid' AND groups.status='1' AND group_users.status='1' AND groups.type='2' AND groups.uid_fk !='$uid'");
    return $query;    
}

//get project participate........
public function getProject_participate($uid){
    $query=mysqli_query($this->db,"SELECT groups.group_id as project_id,groups.group_name as project_name,groups.group_pic as image from group_users inner join groups on group_users.group_id_fk = groups.group_id WHERE group_users.uid_fk='$uid' AND groups.status='1' AND group_users.status='1' AND groups.type='1' AND groups.uid_fk ='$uid'");
    return $query;    
}


/* Projetc Details*/
public function Project_Details($groupid)
{
	$groupid=mysqli_real_escape_string($this->db,$groupid);
	$query=mysqli_query($this->db,"SELECT proj_id, group_id,start_date,end_date,location,proj_intro, com_id, proj_lang, contact_email, social_need, program, outcome FROM projects WHERE group_id='$groupid'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Community Details*/
public function Community_Details($comid)
{
	$comid=mysqli_real_escape_string($this->db,$comid);
	$query=mysqli_query($this->db,"SELECT com_id, group_id, com_title, com_desc, location FROM community WHERE com_id='$comid'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

public function Community_Details_by_gid($gid)
{
	$query=mysqli_query($this->db,"SELECT com_id, group_id, com_title, com_desc, com_overview, com_factsheet, factsheet_title,factsheet_url, factsheet_img, theory_change_intro, theory_change_goal, theory_change_url, aspiration, location FROM community WHERE group_id='$gid'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Add Project Social Need */
public function Add_Social_Need($sn_title, $sn_content,$sn_keywords, $group_id, $uid){
        $sn_title=mysqli_real_escape_string($this->db,$sn_title);
        $sn_content=mysqli_real_escape_string($this->db,$sn_content);
        $sn_keywords=mysqli_real_escape_string($this->db,$sn_keywords);
	mysqli_query($this->db, "INSERT INTO proj_social_needs (sn_title, sn_content, sn_keywords, sn_pid, sn_uid) VALUES ('$sn_title', '$sn_content', '$sn_keywords', '$group_id', '$uid')") or die(mysqli_error($this->db));
	return true;
}

/* Get Project Social Need */
public function Get_Social_Need($sn_id){
        $sn_id=mysqli_real_escape_string($this->db,$sn_id);
        $query=mysqli_query($this->db,"SELECT sn_title, sn_content, sn_keywords, sn_pid FROM proj_social_needs WHERE sn_id='$sn_id'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Update Project Social Need */
public function Update_Social_Need($sn_id, $sn_title, $sn_content,$sn_keywords){
        $sn_title=mysqli_real_escape_string($this->db,$sn_title);
        $sn_content=mysqli_real_escape_string($this->db,$sn_content);
        $sn_keywords=mysqli_real_escape_string($this->db,$sn_keywords);
        // UPDATE users SET group_count=group_count+1 WHERE uid='$uid'
	mysqli_query($this->db, "UPDATE proj_social_needs SET sn_title='$sn_title', sn_content='$sn_content', sn_keywords='$sn_keywords' where sn_id='$sn_id'") or die(mysqli_error($this->db));
        return true;
        
}

/* Delete Project Social Need */
public function Delete_Social_Need($sn_id)
{
	$sn_id=mysqli_real_escape_string($this->db,$sn_id);
	$query = mysqli_query($this->db,"DELETE FROM `proj_social_needs` WHERE sn_id='$sn_id'") or die(mysqli_error($this->db));
	return true;
}

/* Update Project Program/Plan */
public function Add_Program_or_Plan($prog_title, $prog_content,$prog_keywords, $group_id, $uid){
        $prog_title=mysqli_real_escape_string($this->db,$prog_title);
        $prog_content=mysqli_real_escape_string($this->db,$prog_content);
	mysqli_query($this->db, "INSERT INTO proj_program (prog_title, prog_content, prog_keywords, prog_pid, prog_uid) VALUES ('$prog_title', '$prog_content', '$prog_keywords', '$group_id', '$uid')") or die(mysqli_error($this->db));
	return true;
}

/* Get Project Program/Plan */
public function Get_Program_or_Plan($prog_id){
        $prog_id=mysqli_real_escape_string($this->db,$prog_id);
        $query=mysqli_query($this->db,"SELECT prog_title, prog_content, prog_keywords, prog_pid FROM proj_program WHERE prog_id='$prog_id'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Update Project Program/Plan */
public function Update_Program_or_Plan($prog_id, $prog_title, $prog_content,$prog_keywords){
        $prog_title=mysqli_real_escape_string($this->db,$prog_title);
        $prog_content=mysqli_real_escape_string($this->db,$prog_content);
        $prog_keywords=mysqli_real_escape_string($this->db,$prog_keywords);
        // UPDATE users SET group_count=group_count+1 WHERE uid='$uid'
	mysqli_query($this->db, "UPDATE proj_program SET prog_title='$prog_title', prog_content='$prog_content', prog_keywords='$prog_keywords' where prog_id='$prog_id'") or die(mysqli_error($this->db));
        return true;        
}

/* Delete Project Program/Plan*/
public function Delete_Program_or_Plan($prog_id)
{
	$prog_id=mysqli_real_escape_string($this->db,$prog_id);
	$query = mysqli_query($this->db,"DELETE FROM `proj_program` WHERE prog_id='$prog_id'") or die(mysqli_error($this->db));
	return true;
}

/* Update Beneficiary */
public function Update_Beneficiary_1($ben_com_id, $title, $desc, $location, $language, $pic_path){
    $title = mysqli_real_escape_string($this->db,$title);
    $desc = mysqli_real_escape_string($this->db,$desc);
    $location = mysqli_real_escape_string($this->db,$location);
    $language = mysqli_real_escape_string($this->db,$language);
    $pic_path = mysqli_real_escape_string($this->db,$pic_path);
    mysqli_query($this->db,"UPDATE community SET com_title='$title', com_desc='$desc', location='$location', language='$language', com_img='$pic_path' WHERE com_id='$ben_com_id'") or die(mysqli_error($this->db));
    return true;
}
// update beneficairy map
public function Update_Beneficiary_Map($ben_com_id,$ben_map){
	//$ben_map = mysqli_real_escape_string($this->db,$ben_map);
	mysqli_query($this->db,"UPDATE community SET theory_change_url='$ben_map' WHERE com_id='$ben_com_id'") or die(mysqli_error($this->db));;
	return true;
}
// the end of beneficairy map

public function Update_Beneficiary_2($ben_com_id, $title, $desc, $location, $language){
    $title = mysqli_real_escape_string($this->db,$title);
    $desc = mysqli_real_escape_string($this->db,$desc);
    $location = mysqli_real_escape_string($this->db,$location);
    $language = mysqli_real_escape_string($this->db,$language);
    mysqli_query($this->db,"UPDATE community SET com_title='$title', com_desc='$desc', location='$location', language='$language' WHERE com_id='$ben_com_id'") or die(mysqli_error($this->db));
    return true;
}


/* Update Project Intro */
public function Add_temp_community($com_name, $com_add, $com_lang, $uid){
        $group_name = mysqli_real_escape_string($this->db,$com_name);
        $com_add = mysqli_real_escape_string($this->db,$com_add);
        $com_lang = mysqli_real_escape_string($this->db,$com_lang);
        $time = time();
        $type = 2;
        $ip=$_SERVER['REMOTE_ADDR'];
	mysqli_query($this->db, "INSERT INTO groups(group_name, uid_fk, group_created, group_ip, type) VALUES ('$group_name', '$uid', '$time', '$ip', '$type')") or die(mysqli_error($this->db));
	$b= mysqli_query($this->db,"SELECT group_id FROM groups WHERE uid_fk='$uid' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$group_id=$data['group_id'];
	mysqli_query($this->db,"INSERT INTO community(group_id, location, language) VALUES ('$group_id', '$com_add', '$com_lang')") or die(mysqli_error($this->db));
        
	if($group_id)
	{
            mysqli_query($this->db,"INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES ('$uid','$group_id','$time')") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE groups SET group_count=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE users SET group_count=group_count+1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	}
        $c = mysqli_query($this->db,"SELECT com_id FROM community WHERE group_id='$group_id' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data_com = mysqli_fetch_array($c,MYSQLI_ASSOC);
	$com_id=$data_com['com_id'];
        return $com_id;	
}

/* Update Project Intro */
public function Add_temp_organization($org_name, $org_add, $org_web, $uid){
        $group_name = mysqli_real_escape_string($this->db,$org_name);
        $org_add = mysqli_real_escape_string($this->db,$org_add);
        $org_web = mysqli_real_escape_string($this->db,$org_web);
        $time = time();
        $type = 3;
        $ip=$_SERVER['REMOTE_ADDR'];
	mysqli_query($this->db, "INSERT INTO groups(group_name, uid_fk, group_created, group_ip, type) VALUES ('$group_name', '$uid', '$time', '$ip', '$type')") or die(mysqli_error($this->db));
	$b= mysqli_query($this->db,"SELECT group_id FROM groups WHERE uid_fk='$uid' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$group_id=$data['group_id'];
	mysqli_query($this->db,"INSERT INTO organizations(group_id, location, website) VALUES ('$group_id', '$org_add', '$org_web')") or die(mysqli_error($this->db));
        
	if($group_id)
	{
            mysqli_query($this->db,"INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES ('$uid','$group_id','$time')") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE groups SET group_count=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE users SET group_count=group_count+1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	}
	$c = mysqli_query($this->db,"SELECT org_id FROM organizations WHERE group_id='$group_id' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data_org = mysqli_fetch_array($c,MYSQLI_ASSOC);
	$org_id=$data_org['org_id'];
        return $org_id;		
}

public function Get_community_id($gid){
        $c = mysqli_query($this->db,"SELECT com_id FROM community WHERE group_id='$gid' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data = mysqli_fetch_array($c, MYSQLI_ASSOC);
	$com_id = $data['com_id'];
        return $com_id;	
}

public function Get_organization_id($gid){
        $c = mysqli_query($this->db,"SELECT org_id FROM organizations WHERE group_id='$gid' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data = mysqli_fetch_array($c,MYSQLI_ASSOC);
	$org_id = $data['org_id'];
        return $org_id;		
}

/* Add Project Outcome */
public function Add_Outcome($outcome_title, $outcome_content,$outcome_keywords, $group_id, $uid){
        $outcome_title=mysqli_real_escape_string($this->db,$outcome_title);
        $outcome_content=mysqli_real_escape_string($this->db,$outcome_content);
	mysqli_query($this->db, "INSERT INTO proj_outcomes (outcome_title, outcome_content, outcpme_keywords, outcome_pid, outcome_uid) VALUES ('$outcome_title', '$outcome_content', '$outcome_keywords', $group_id', '$uid')") or die(mysqli_error($this->db));
	return true;
}

/* Get Project Program/Plan */
public function Get_Outcome($outcome_id){
        $outcome_id=mysqli_real_escape_string($this->db,$outcome_id);
        $query=mysqli_query($this->db,"SELECT outcome_title, outcome_content, outcome_keywords, outcome_pid FROM proj_outcomes WHERE outcome_id='$outcome_id'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Update Project Outcome */
public function Update_Outcome($outcome_id, $outcome_title, $outcome_content,$outcome_keywords){
        $outcome_title=mysqli_real_escape_string($this->db,$outcome_title);
        $outcome_content=mysqli_real_escape_string($this->db,$outcome_content);
        $outcome_keywords=mysqli_real_escape_string($this->db,$outcome_keywords);
        // UPDATE users SET group_count=group_count+1 WHERE uid='$uid'
	mysqli_query($this->db, "UPDATE proj_outcomes SET outcome_title='$outcome_title', outcome_content='$outcome_content', outcome_keywords='$outcome_keywords' where outcome_id='$outcome_id'") or die(mysqli_error($this->db));
        return true;        
}

/* Delete Project Outcome*/
public function Delete_Outcome($outcome_id)
{
	$outcome_id=mysqli_real_escape_string($this->db,$outcome_id);
	$query = mysqli_query($this->db,"DELETE FROM `proj_outcomes` WHERE outcome_id='$outcome_id'") or die(mysqli_error($this->db));
	return true;
}


/* Get Project Social Needs */
public function Get_Project_Social_Need($proj_id){	
        $query=mysqli_query($this->db,"SELECT SN.sn_id, SN.msg_id, M.msg_title, M.message,M.short_message,SN.sn_keywords, SN.sn_image from proj_social_needs SN INNER JOIN messages M on SN.msg_id = M.msg_id where M.cate_id = '2' AND SN.sn_pid = '$proj_id'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

public function Get_Project_Prog_Plan($proj_id){	
        $query=mysqli_query($this->db,"SELECT PP.prog_id, PP.msg_id, M.msg_title, M.message, PP.prog_keywords, PP.prog_image from proj_program PP INNER JOIN messages M on PP.msg_id = M.msg_id where M.cate_id = '3' AND PP.prog_pid = '$proj_id'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

public function Get_Project_Outcomes($proj_id){	
        $query=mysqli_query($this->db,"SELECT O.outcome_id, O.msg_id, M.msg_title, M.message, O.outcome_keywords, O.outcome_image from proj_outcomes O INNER JOIN messages M on O.msg_id = M.msg_id where M.cate_id = '4' AND O.outcome_pid = '$proj_id'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

public function Get_Each_SN_Program_Plan($sn_id){	
        $query=mysqli_query($this->db,"SELECT PP.prog_id, PP.msg_id, M.msg_title, M.message, PP.prog_keywords, PP.prog_image from proj_program PP INNER JOIN messages M on PP.msg_id = M.msg_id INNER JOIN social_need_prog_plan SN_PP on SN_PP.prog_id = PP.prog_id WHERE SN_PP.sn_id = '$sn_id' ORDER BY PP.prog_id DESC");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}


/* Get Project Program/Plan */
public function Get_Project_Program($groupID){	
        $query=mysqli_query($this->db,"SELECT prog_id, prog_title, prog_content, prog_keywords FROM proj_program WHERE prog_pid = '$groupID' ORDER BY prog_id DESC")or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/* Get Project Outcomes */
public function Get_Project_Outcome($groupID){	
        $query=mysqli_query($this->db,"SELECT outcome_id, outcome_title, outcome_content, outcome_keywords FROM proj_outcomes WHERE outcome_pid = '$groupID' ORDER BY outcome_id DESC")or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/* Get Community Partners */
public function Get_Com_Partners($com_id){	
        $query=mysqli_query($this->db,"SELECT id, title, logo_path, url FROM community_partners WHERE com_id = '$com_id' ORDER BY id ASC")or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/* Get Community Projects */
public function Get_Com_Projects($com_id){	
        $query=mysqli_query($this->db,"select G.group_id, G.group_name, G.group_pic, P.proj_intro From groups G INNER JOIN projects P where G.group_id = P.group_id AND type = 1 AND P.com_id = '$com_id'") or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/* Get Community Partner by ID*/
public function Get_Each_Com_Partners($id){	
        $query=mysqli_query($this->db,"SELECT id, com_id, title, logo_path, url FROM community_partners WHERE id = '$id' LIMIT 1")or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

/* Add New Partner */
public function Add_New_Partner($com_id, $title, $url, $logo_path){
        $title=mysqli_real_escape_string($this->db,$title);
        $url=mysqli_real_escape_string($this->db,$url);
        $logo_path=mysqli_real_escape_string($this->db,$logo_path);
	mysqli_query($this->db, "INSERT INTO community_partners (com_id, title, url, logo_path) VALUES ('$com_id', '$title', '$url', '$logo_path')") or die(mysqli_error($this->db));
	return true;
}

public function Update_Com_Partner($id, $title, $url, $logo_path){
        $title=mysqli_real_escape_string($this->db,$title);
        $url=mysqli_real_escape_string($this->db,$url);
        $logo_path=mysqli_real_escape_string($this->db,$logo_path);
        mysqli_query($this->db,"UPDATE community_partners SET title='$title', url='$url', logo_path='$logo_path' WHERE id='$id'") or die(mysqli_error($this->db));
        return true;
}

public function Update_Com_Partner_2($id, $title, $url){
        $title=mysqli_real_escape_string($this->db,$title);
        $url=mysqli_real_escape_string($this->db,$url);
        mysqli_query($this->db,"UPDATE community_partners SET title='$title', url='$url' WHERE id='$id'") or die(mysqli_error($this->db));
        return true;
}

public function Update_Com_Factsheet($com_id, $title, $content, $url, $img){
        $title=mysqli_real_escape_string($this->db,$title);
        $content=mysqli_real_escape_string($this->db,$content);
        $url=mysqli_real_escape_string($this->db,$url);
        $img=mysqli_real_escape_string($this->db,$img);
        mysqli_query($this->db,"UPDATE community SET factsheet_title='$title', com_factsheet='$content', factsheet_url='$url', factsheet_img='$img' WHERE com_id='$com_id'") or die(mysqli_error($this->db));
        return true;
}

public function Update_Com_Factsheet_2($com_id, $title, $content, $url){
        $title=mysqli_real_escape_string($this->db,$title);
        $content=mysqli_real_escape_string($this->db,$content);
        $url=mysqli_real_escape_string($this->db,$url);
        mysqli_query($this->db,"UPDATE community SET factsheet_title='$title', com_factsheet='$content', factsheet_url='$url' WHERE com_id='$com_id'") or die(mysqli_error($this->db));
        return true;
}


/* Delete Community Partner */
public function Delete_Com_Partner($partner_id)
{
	$partner_id=mysqli_real_escape_string($this->db,$partner_id);
	$query = mysqli_query($this->db,"DELETE FROM `community_partners` WHERE id='$partner_id'") or die(mysqli_error($this->db));
	return true;
}
/* Update Project Intro */
public function Update_Proj_Intro($proj_intro,$group_id){
        $proj_intro = mysqli_real_escape_string($this->db,$proj_intro);
	mysqli_query($this->db,"UPDATE projects SET proj_intro='$proj_intro' WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	return true;
}

/* Update Project Languages */
public function Update_Proj_Lang($proj_lang,$group_id){
	mysqli_query($this->db,"UPDATE projects SET proj_lang='$proj_lang' WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	return true;
}

/* Update Project Contact Email */
public function Update_Proj_Email($email,$group_id){
        $email = mysqli_real_escape_string($this->db,$email);
	mysqli_query($this->db,"UPDATE projects SET contact_email='$email' WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	return true;
}

/* Update Project Dates */
public function Update_Proj_Dates($start_date, $end_date,$group_id){
        $stat_date = mysqli_real_escape_string($this->db,$start_date);
        $end_date = mysqli_real_escape_string($this->db,$end_date);
	mysqli_query($this->db,"UPDATE projects SET start_date='$start_date', end_date='$end_date' WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	return true;
}

/* Update Paragrapgh Social Need */
public function Update_Para_Social_Need($social_need,$group_id){
        $social_need = mysqli_real_escape_string($this->db,$social_need);
	mysqli_query($this->db,"UPDATE projects SET social_need='$social_need' WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	return true;
}

/* Update Paragrapgh Social Need */
public function Update_Para_Program($program,$group_id){
        $program = mysqli_real_escape_string($this->db,$program);
	mysqli_query($this->db,"UPDATE projects SET program='$program' WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	return true;
}

/* Update Paragrapgh Social Need */
public function Update_Para_Outcome($outcome,$group_id){
        $outcome = mysqli_real_escape_string($this->db,$outcome);
	mysqli_query($this->db,"UPDATE projects SET outcome='$outcome' WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	return true;
}

public function Update_Com_Desc($com_desc,$com_id){
        $com_desc = mysqli_real_escape_string($this->db,$com_desc);
	mysqli_query($this->db,"UPDATE community SET com_desc='$com_desc' WHERE com_id='$com_id'") or die(mysqli_error($this->db));
	return true;
}

public function Update_Com_Overview($com_overview,$com_id){
        $com_overview = mysqli_real_escape_string($this->db,$com_overview);
	mysqli_query($this->db,"UPDATE community SET com_overview='$com_overview' WHERE com_id='$com_id'") or die(mysqli_error($this->db));
	return true;
}

public function Update_Theory_of_Change($com_id, $intro, $goal, $url){
        $intro = mysqli_real_escape_string($this->db,$intro);
        $goal = mysqli_real_escape_string($this->db,$goal);
        $url = mysqli_real_escape_string($this->db,$url);
	mysqli_query($this->db,"UPDATE community SET theory_change_intro='$intro', theory_change_goal='$goal', theory_change_url='$url' WHERE com_id='$com_id'") or die(mysqli_error($this->db));
	return true;
}

/* Group Details*/
public function Group_Status_Check($uid,$groupid)
{
	$query=mysqli_query($this->db,"SELECT status FROM group_users WHERE group_id_fk='$groupid' AND uid_fk='$uid'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['status'];
}


/* Block Group Details*/
public function Group_Member_Block($uid,$memberID,$group_id,$type)
{
	$memberID=mysqli_real_escape_string($this->db,$memberID);
	$groupid=mysqli_real_escape_string($this->db,$group_id);
	$type=mysqli_real_escape_string($this->db,$type);

	$query=mysqli_query($this->db,"SELECT group_id FROM groups WHERE group_id='$groupid' AND uid_fk='$uid' AND status='1'");
	if(mysqli_num_rows($query))
	{

  if($type)
	$data=mysqli_query($this->db,"UPDATE group_users SET status='0' WHERE group_id_fk='$groupid' AND uid_fk='$memberID'");
	else
	$data=mysqli_query($this->db,"UPDATE group_users SET status='1' WHERE group_id_fk='$groupid' AND uid_fk='$memberID'");

	return $data;
  }
}

/* Get verified code */
public function verify_code($id){
        $q= mysqli_query($this->db,"SELECT verification_code FROM users WHERE uid='$id' LIMIT 1") or die(mysqli_error($this->db));
        $data=mysqli_fetch_array($q,MYSQLI_ASSOC);
        $code=$data['verification_code'];
        return $code;
        
}

/* Update status */
public function verify_status($id){
        $q= mysqli_query($this->db,"UPDATE users SET user_status='approved' WHERE uid='$id'") or die(mysqli_error($this->db));
}

/* Update verify code */
public function update_verify_code($id, $code){
        $q= mysqli_query($this->db,"UPDATE users SET verification_code='$code' WHERE uid='$id'") or die(mysqli_error($this->db));
}

/* Verify username */
public function existing_username($name){
        $q= mysqli_query($this->db,"SELECT uid FROM users WHERE username like '$name' LIMIT 1") or die(mysqli_error($this->db));
        if(mysqli_num_rows($q)==0){
            return 0;
        }else{
            $data=mysqli_fetch_array($q,MYSQLI_ASSOC);
            $uid=$data['uid'];
            return $uid;
        }
}

/* Verify Email address */
public function existing_mail($mail){
        $q= mysqli_query($this->db,"SELECT uid FROM users WHERE email like '$mail' LIMIT 1") or die(mysqli_error($this->db));
        if(mysqli_num_rows($q)==0){
            return 0;
        }else{
            $data=mysqli_fetch_array($q,MYSQLI_ASSOC);
            $uid=$data['uid'];
            return $uid;
        }
}

/* Verify Community (type=2) & Organization (type=3)*/
public function existing_group($name, $type){
        $q= mysqli_query($this->db,"SELECT group_id FROM groups WHERE group_name like '$name' AND type = '$type' LIMIT 1") or die(mysqli_error($this->db));
        if(mysqli_num_rows($q)==0){
            return 0;
        }else{
            $data=mysqli_fetch_array($q,MYSQLI_ASSOC);
            $group_id=$data['group_id'];
            return $group_id;
        }
}

/* Verify Community */
public function existing_community($name, $address){
        $name = mysqli_real_escape_string($this->db,$name);
        $address = mysqli_real_escape_string($this->db,$address);
        $type = 2;
        $q= mysqli_query($this->db,"SELECT G.group_id FROM groups G, community C WHERE G.group_name like '$name' AND C.location like '$address' AND G.type = '$type' LIMIT 1") or die(mysqli_error($this->db));
        if(mysqli_num_rows($q)==0){
            return 0;
        }else{
            $data=mysqli_fetch_array($q,MYSQLI_ASSOC);
            $group_id=$data['group_id'];
            return $group_id;
        }
}

/* Verify Organization */
public function existing_organization($name, $address){
        $name = mysqli_real_escape_string($this->db,$name);
        $address = mysqli_real_escape_string($this->db,$address);
        $type = 3;
        $q= mysqli_query($this->db,"SELECT G.group_id FROM groups G, organizations O WHERE G.group_name like '$name' AND O.location like '$address' AND G.type = '$type' LIMIT 1") or die(mysqli_error($this->db));
        if(mysqli_num_rows($q)==0){
            return 0;
        }else{
            $data=mysqli_fetch_array($q,MYSQLI_ASSOC);
            $group_id=$data['group_id'];
            return $group_id;
        }
}

/* Verify URL */
public function existing_url($url){
        $q= mysqli_query($this->db,"SELECT group_id FROM projects WHERE proj_url like '$url' LIMIT 1") or die(mysqli_error($this->db));
        if(mysqli_num_rows($q)==0){
            return 0;
        }else{
            $data=mysqli_fetch_array($q,MYSQLI_ASSOC);
            $group_id=$data['group_id'];
            return $group_id;
        }
}
/* Verify Organization */

/*Create Group*/
public function Create_Group($group_name,$group_desc,$uid)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$group_name=mysqli_real_escape_string($this->db,$group_name);
	$group_desc=mysqli_real_escape_string($this->db,$group_desc);
	$q= mysqli_query($this->db,"SELECT group_id FROM groups WHERE group_name='$group_name' ") or die(mysqli_error($this->db));
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
	if(mysqli_num_rows($q)==0)
	{
	$query = mysqli_query($this->db,"INSERT INTO groups(group_name,group_desc,uid_fk,group_created,group_ip) VALUES ('$group_name','$group_desc','$uid','$time','$ip')") or die(mysqli_error($this->db));
	$b= mysqli_query($this->db,"SELECT group_id FROM groups WHERE uid_fk='$uid' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$group_id=$data['group_id'];
	if($group_id)
	{
		$time=time();
	mysqli_query($this->db,"INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES ('$uid','$group_id','$time')") or die(mysqli_error($this->db));
	mysqli_query($this->db,"UPDATE groups SET group_count=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"UPDATE users SET group_count=group_count+1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	}
	return $group_id;
	}
	else
	{
	return 0;
	}
}

/*Create Project*/
//$proj_name, $uid, $proj_start_date, $proj_end_date, $proj_url, $usr_role, $target_file, $proj_com_id, $proj_org_id
public function Create_Project($group_name, $uid, $start_date, $end_date, $url, $usr_role, $proj_lang, $skills, $target_file, $proj_com_id, $proj_org_id)
{
	$group_name = mysqli_real_escape_string($this->db,$group_name);
        $proj_lang = mysqli_real_escape_string($this->db,$proj_lang);
        $skills = mysqli_real_escape_string($this->db,$skills);
        $start_date=mysqli_real_escape_string($this->db,$start_date);
        $end_date=mysqli_real_escape_string($this->db,$end_date);
        $url=mysqli_real_escape_string($this->db,$url);
	$location=mysqli_real_escape_string($this->db,$location);
	$target_file=mysqli_real_escape_string($this->db,$target_file);
	$q= mysqli_query($this->db,"SELECT group_id FROM groups WHERE group_name='$group_name' ") or die(mysqli_error($this->db));
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
        $g_type = 1;
	if(mysqli_num_rows($q)==0)
	{
            mysqli_query($this->db,"INSERT INTO groups(group_name,uid_fk,group_created,group_ip,type) VALUES ('$group_name','$uid','$time','$ip','$g_type')") or die(mysqli_error($this->db));
            $b= mysqli_query($this->db,"SELECT group_id FROM groups WHERE uid_fk='$uid' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
            $data=mysqli_fetch_array($b,MYSQLI_ASSOC);
            $group_id=$data['group_id'];
            $c= mysqli_query($this->db,"SELECT email FROM users WHERE uid='$uid' LIMIT 1") or die(mysqli_error($this->db));
            $data_email=mysqli_fetch_array($c,MYSQLI_ASSOC);
            $email = $data_email['email'];
            mysqli_query($this->db,"INSERT INTO projects(group_id, start_date, end_date, proj_url, file, usr_role, proj_lang, skills, contact_email, com_id, org_id) VALUES ('$group_id','$start_date','$end_date','$url','$target_file','$usr_role','$proj_lang','$skills','$email', '$proj_com_id','$proj_org_id')") or die(mysqli_error($this->db));
           
            $time=time();
            mysqli_query($this->db,"INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES ('$uid','$group_id','$time')") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE groups SET group_count=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE users SET group_count=group_count+1 WHERE uid='$uid'") or die(mysqli_error($this->db));
           
            return $group_id;
	}
	else
	{
            return 0;
	}
}

/*Create Community*/
public function Create_Community($group_name,$group_desc,$uid, $location, $language, $usr_role, $type, $capacity)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$group_name=mysqli_real_escape_string($this->db,$group_name);
	$group_desc=mysqli_real_escape_string($this->db,$group_desc);
	$q= mysqli_query($this->db,"SELECT group_id FROM groups WHERE group_name='$group_name' ") or die(mysqli_error($this->db));
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
        $g_type = 2;
	if(mysqli_num_rows($q)==0)
	{
	$query = mysqli_query($this->db,"INSERT INTO groups(group_name,group_desc,uid_fk,group_created,group_ip, type) VALUES ('$group_name','$group_desc','$uid','$time','$ip', '$g_type')") or die(mysqli_error($this->db));
        $b= mysqli_query($this->db,"SELECT group_id FROM groups WHERE uid_fk='$uid' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$group_id=$data['group_id'];
        $query2 = mysqli_query($this->db,"INSERT INTO community(group_id, location, language, role) VALUES ('$group_id', '$location', '$language', '$usr_role')") or die(mysqli_error($this->db));
        
	if($group_id)
	{
            $time=time();
            mysqli_query($this->db,"INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES ('$uid','$group_id','$time')") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE groups SET group_count=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE users SET group_count=group_count+1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	}
	return $group_id;
	}
	else
	{
	return 0;
	}
}

/*Create Organization*/
public function Create_Organization($group_name,$group_desc,$uid, $location, $website, $usr_role, $contact, $type, $status)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$group_name=mysqli_real_escape_string($this->db,$group_name);
	$group_desc=mysqli_real_escape_string($this->db,$group_desc);
	$q= mysqli_query($this->db,"SELECT group_id FROM groups WHERE group_name='$group_name' ") or die(mysqli_error($this->db));
	$time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
        $g_type = 3;
	if(mysqli_num_rows($q)==0)
	{
	$query = mysqli_query($this->db,"INSERT INTO groups(group_name,group_desc,uid_fk,group_created,group_ip, type) VALUES ('$group_name','$group_desc','$uid','$time','$ip', '$g_type')") or die(mysqli_error($this->db));
        $b= mysqli_query($this->db,"SELECT group_id FROM groups WHERE uid_fk='$uid' ORDER BY group_id DESC LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($b,MYSQLI_ASSOC);
	$group_id=$data['group_id'];
        $query2 = mysqli_query($this->db,"INSERT INTO organizations(group_id, location, type, website, role, contact, sending_status) VALUES ('$group_id', '$location', '$type', '$website', '$usr_role', '$contact', '$status')") or die(mysqli_error($this->db));
        
	if($group_id)
	{
            $time=time();
            mysqli_query($this->db,"INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES ('$uid','$group_id','$time')") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE groups SET group_count=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
            mysqli_query($this->db,"UPDATE users SET group_count=group_count+1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	}
	return $group_id;
	}
	else
	{
	return 0;
	}
}

/*Create Group*/
public function Update_Group($group_name,$group_desc,$uid,$group_id)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$group_id=mysqli_real_escape_string($this->db,$group_id);
	$group_name=mysqli_real_escape_string($this->db,$group_name);
	$group_desc=mysqli_real_escape_string($this->db,$group_desc);
	mysqli_query($this->db,"UPDATE groups SET group_name='$group_name',group_desc='$group_desc' WHERE group_id='$group_id' and uid_fk='$uid'") or die(mysqli_error($this->db));
	return true;
}


/*Create Group*/
public function Update_Group_Desc($group_desc,$uid,$group_id)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$group_id=mysqli_real_escape_string($this->db,$group_id);
	$group_desc=mysqli_real_escape_string($this->db,$group_desc);
	mysqli_query($this->db,"UPDATE groups SET group_desc='$group_desc' WHERE group_id='$group_id' and uid_fk='$uid'") or die(mysqli_error($this->db));
	return true;
}

/*Group Followers*/
public function Group_Followers($group_id, $page, $offset, $rowsPerPage)
{
	$page=mysqli_real_escape_string($this->db,$page);
	$offset=mysqli_real_escape_string($this->db,$offset);
	$rowsPerPage=mysqli_real_escape_string($this->db,$rowsPerPage);

	if($page)
	{
	$con=$offset.",".$rowsPerPage;
	}
	else
	{
	$con=$rowsPerPage;
	}

	$query=mysqli_query($this->db,"SELECT DISTINCT U.username,U.bio, U.uid, U.email, role FROM users U INNER JOIN project_involvement ON U.uid = project_involvement.uid WHERE project_involvement.aprove = 1 AND deleted = 0 AND project_involvement.group_id='$group_id'
            UNION
            SELECT DISTINCT U.username,U.bio, U.uid, U.email, count(*)+1 as role FROM users U INNER JOIN groups ON groups.uid_fk = U.uid WHERE groups.group_id = '$group_id' ORDER BY role DESC
                LIMIT $con")or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/*Profile Updates  */
public function Group_Updates($group_id,$lastid,$perpage,$moreCheck)
{
   if($moreCheck)
	{
	$perpage=$perpage+1;
	}

	/* More Button*/
	$morequery="";
	if($lastid)
	{
	$morequery=" and M.created<'".$lastid."' ";
	}


	/* More Button End*/
	$query = mysqli_query($this->db,"SELECT
	DISTINCT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U, group_users G
	WHERE U.status='1' AND M.uid_fk=U.uid AND G.uid_fk=U.uid AND G.status='1' AND M.group_id_fk='$group_id' $morequery ORDER BY created DESC LIMIT $perpage") or die(mysqli_error($this->db));


	if($moreCheck)
	{
	$data=mysqli_num_rows($query);
	}
	else
	{
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	}
	return $data;
}

/* Project Announcement */
public function Project_Announcement($group_id,$uid)
{
  

	$query = mysqli_query($this->db,"SELECT
	DISTINCT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U, group_users G
	WHERE U.status='1' AND M.uid_fk=U.uid AND G.uid_fk=U.uid AND G.status='1' AND M.group_id_fk='$group_id' AND M.uid_fk = '$uid' AND M.cate_id = 1 ORDER BY created DESC") or die(mysqli_error($this->db));

	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}


// get latest annnounment ....
public function get_latest_Announcement($group_id,$uid)
{
	$query = mysqli_query($this->db,"SELECT
	DISTINCT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U, group_users G
	WHERE U.status='1' AND M.uid_fk=U.uid AND G.uid_fk=U.uid AND G.status='1' AND M.group_id_fk='$group_id' AND M.uid_fk = '$uid' AND M.cate_id = 1 ORDER BY M.msg_id DESC limit 1") or die(mysqli_error($this->db));

	return $query;
}


// get  ....
public function get_socialNeet($group_id,$uid,$cate)
{
	$query = mysqli_query($this->db,"SELECT
	DISTINCT M.msg_id,M.msg_title,M.msg_keyword, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U, group_users G
	WHERE U.status='1' AND M.uid_fk=U.uid AND G.uid_fk=U.uid AND G.status='1' AND M.group_id_fk='$group_id' AND M.uid_fk = '$uid' AND M.cate_id = '$cate' ORDER BY M.msg_id DESC") or die(mysqli_error($this->db));

	return $query;
}

// get second annnounment ....
public function get_second_Announcement($group_id,$uid)
{
	$query = mysqli_query($this->db,"SELECT
	DISTINCT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U, group_users G
	WHERE U.status='1' AND M.uid_fk=U.uid AND G.uid_fk=U.uid AND G.status='1' AND M.group_id_fk='$group_id' AND M.uid_fk = '$uid' AND M.cate_id = 1 ORDER BY M.msg_id DESC limit 1,1") or die(mysqli_error($this->db));

	return $query;
}

// get third annnounment ....
public function get_Third_Announcement($group_id,$uid)
{
	$query = mysqli_query($this->db,"SELECT
	DISTINCT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U, group_users G
	WHERE U.status='1' AND M.uid_fk=U.uid AND G.uid_fk=U.uid AND G.status='1' AND M.group_id_fk='$group_id' AND M.uid_fk = '$uid' AND M.cate_id = 1 ORDER BY M.msg_id DESC limit 2,1") or die(mysqli_error($this->db));

	return $query;
}

/*Group Add Friend*/
public function Group_Add($uid,$group_id)
{
	$group_id=mysqli_real_escape_string($this->db,$group_id);
	$q=mysqli_query($this->db,"SELECT group_user_id FROM group_users WHERE uid_fk='$uid' AND group_id_fk='$group_id'");
	if(mysqli_num_rows($q)==0)
	{
	$time=time();
	mysqli_query($this->db,"INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES ('$uid','$group_id','$time')") or die(mysqli_error($this->db));
	mysqli_query($this->db,"UPDATE groups SET group_count=group_count+1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"UPDATE users SET group_count=group_count+1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	return true;
	}
}

/*Group Remove Friend*/
public function Group_Remove($uid,$group_id)
{
	$group_id=mysqli_real_escape_string($this->db,$group_id);
	$q=mysqli_query($this->db,"SELECT group_user_id FROM group_users WHERE uid_fk='$uid' AND group_id_fk='$group_id'");
	if(mysqli_num_rows($q)==1)
	{
	$query=mysqli_query($this->db,"DELETE FROM group_users WHERE uid_fk='$uid' AND group_id_fk='$group_id'") or die(mysqli_error($this->db));
	$query=mysqli_query($this->db,"UPDATE groups SET group_count=group_count-1 WHERE group_id='$group_id'") or die(mysqli_error($this->db));
	$query=mysqli_query($this->db,"UPDATE users SET group_count=group_count-1 WHERE uid='$uid'") or die(mysqli_error($this->db));
	return true;
	}
}

/*Group Valid Check*/
public function Group_Edit_Check($uid,$group_id)
{
$group_id=mysqli_real_escape_string($this->db,$group_id);
	$query=mysqli_query($this->db,"SELECT group_id FROM groups WHERE uid_fk='$uid' AND group_id='$group_id'") or die(mysqli_error($this->db));
	$num=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $num['group_id'];
}
/*Group Delete*/
public function Group_Delete($uid,$group_id)
{
$q=mysqli_query($this->db,"SELECT group_id FROM groups WHERE uid_fk='$uid' AND group_id='$group_id'");
if(mysqli_num_rows($q)==1)
{
mysqli_query($this->db,"DELETE FROM messages WHERE group_id_fk='$group_id'")or die(mysqli_error($this->db));
mysqli_query($this->db,"DELETE FROM group_users WHERE group_id_fk='$group_id'")or die(mysqli_error($this->db));
mysqli_query($this->db,"DELETE FROM user_uploads WHERE group_id_fk='$group_id'")or die(mysqli_error($this->db));
mysqli_query($this->db,"DELETE FROM groups WHERE group_id='$group_id'")or die(mysqli_error($this->db));
}
}

/*Group Valid Check*/
public function Group_Check($uid,$group_id)
{
	$query=mysqli_query($this->db,"SELECT group_user_id FROM group_users WHERE uid_fk='$uid' AND group_id_fk='$group_id'") or die(mysqli_error($this->db));
	$num=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $num['group_user_id'];
}

/*Group Valid Check*/
public function Group_Follower_Check($uid,$group_id)
{
	$query=mysqli_query($this->db,"SELECT F.uid_fk FROM groups G,group_users F WHERE G.group_id=F.group_id_fk AND F.uid_fk='$uid' AND F.group_id_fk='$group_id'") or die(mysqli_error($this->db));
	$num=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $num['uid_fk'];
}

/*Group count*/
public function Group_Check_Count($uid,$group_id)
{
	$query=mysqli_query($this->db,"SELECT group_user_id FROM group_users WHERE uid_fk='$uid' AND group_id_fk='$group_id' AND status='1'") or die(mysqli_error($this->db));
	$num=mysqli_num_rows($query);
	return $num;
}

/*Group List*/
public function Groups_List($uid, $page, $offset, $rowsPerPage,$otherGroups)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$page=mysqli_real_escape_string($this->db,$page);
	$offset=mysqli_real_escape_string($this->db,$offset);
	$rowsPerPage=mysqli_real_escape_string($this->db,$rowsPerPage);

	if($page)
	{
	$con=$offset.",".$rowsPerPage;
	}
	else
	{
	$con=$rowsPerPage;
	}
    if($otherGroups)
	{
	$query=mysqli_query($this->db,"SELECT DISTINCT G.group_id, G.uid_fk, G.group_name, G.group_desc, G.group_pic FROM groups G WHERE G.status='1' AND G.group_id<>'$otherGroups' ORDER BY RAND() DESC LIMIT $con")or die(mysqli_error($this->db));
	}
	else
	{
	$query=mysqli_query($this->db,"SELECT DISTINCT G.group_id, G.uid_fk, G.group_name, G.group_desc, G.group_pic FROM groups G, group_users F WHERE G.status='1' AND F.status='1' AND G.group_id=F.group_id_fk AND F.uid_fk='$uid' ORDER BY G.group_id DESC LIMIT $con")or die(mysqli_error($this->db));
	}
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/* CPS My Group List*/
public function My_Groups_List($uid, $page, $offset, $rowsPerPage,$otherGroups)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$page=mysqli_real_escape_string($this->db,$page);
	$offset=mysqli_real_escape_string($this->db,$offset);
	$rowsPerPage=mysqli_real_escape_string($this->db,$rowsPerPage);

   /* if($otherGroups)
	{
	$query=mysqli_query($this->db,"SELECT DISTINCT G.group_id, G.uid_fk, G.group_name, G.group_desc, G.group_pic FROM groups G WHERE G.status='1' AND G.group_id<>'$otherGroups' ORDER BY RAND() DESC LIMIT $con")or die(mysqli_error($this->db));
	}
	else
	{*/
	$query=mysqli_query($this->db,"SELECT DISTINCT group_id, uid_fk, group_name, group_desc, group_pic FROM groups WHERE status='1' AND uid_fk = $uid ORDER BY group_id DESC LIMIT 2")or die(mysqli_error);
//	}
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/* CPS Following Group List*/
public function Following_Groups_List($uid, $page, $offset, $rowsPerPage,$otherGroups)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$page=mysqli_real_escape_string($this->db,$page);
	$offset=mysqli_real_escape_string($this->db,$offset);
	$rowsPerPage=mysqli_real_escape_string($this->db,$rowsPerPage);

   /* if($otherGroups)
	{
	$query=mysqli_query($this->db,"SELECT DISTINCT G.group_id, G.uid_fk, G.group_name, G.group_desc, G.group_pic FROM groups G WHERE G.status='1' AND G.group_id<>'$otherGroups' ORDER BY RAND() DESC LIMIT $con")or die(mysqli_error($this->db));
	}
	else
	{*/
	$query=mysqli_query($this->db,"SELECT DISTINCT G.group_id, G.group_name, G.group_desc, G.group_pic FROM groups G, group_users F WHERE G.status='1' AND F.status='1' AND G.group_id = F.group_id_fk AND F.uid_fk=$uid AND F.uid_fk != G.uid_fk ORDER BY G.group_id DESC LIMIT 2")or die(mysqli_error($this->db));
//	}
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/*Group Image Upload*/
public function Group_Image_Upload($uid, $image,$groupID)
{
	mysqli_query($this->db,"UPDATE groups SET group_pic='$image' WHERE group_id='$groupID' AND uid_fk='$uid'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"INSERT INTO user_uploads(image_path,uid_fk,group_id_fk,image_type) VALUES ('$image','$uid','$groupID','1')") or die(mysqli_error($this->db));
	$query = mysqli_query($this->db,"SELECT group_id,group_pic FROM groups WHERE group_id='$groupID' AND uid_fk='$uid'") or die(mysqli_error($this->db));
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $result;
}

/*Group Background Image Upload*/
public function GroupBG_Image_Upload($uid, $image,$groupID)
{
	mysqli_query($this->db,"UPDATE groups SET group_bg='$image' WHERE  group_id='$groupID' AND uid_fk='$uid'") or die(mysqli_error($this->db));
	mysqli_query($this->db,"INSERT INTO user_uploads(image_path,uid_fk,group_id_fk,image_type) VALUES ('$image','$uid','$groupID','2')") or die(mysqli_error($this->db));
	$query = mysqli_query($this->db,"SELECT group_id,group_bg FROM groups WHERE  group_id='$groupID' AND uid_fk='$uid'") or die(mysqli_error($this->db));
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $result;
}

/* Template Update*/
public function Template_Order()
{

$query=mysqli_query($this->db,"SELECT t_id,t_name,t_file,t_order FROM template ORDER BY t_order ASC")or die(mysqli_error($this->db));
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
$data[]=$row;
}
return $data;
}

/* Advertisments*/
public function Advertisments()
{

$query=mysqli_query($this->db,"SELECT a_title,a_desc,a_url,a_img FROM advertisments WHERE status='1' ORDER BY a_id DESC")or die(mysqli_error($this->db));
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
$data[]=$row;
}
return $data;
}




/*Last Login Update*/
public function Notification_Created_Update($uid)
{
	$time=time();
	$query=mysqli_query($this->db,"UPDATE users SET notification_created='$time' WHERE uid='$uid'") or die(mysqli_error($this->db));
	return true;
}
/*Notifications*/
public function Notifications($uid,$lastid,$notifications_perpage)
{
	$morequery="";
	if($lastid)
	{
            $morequery=" and S.created<'".$lastid."' ";
            $morequery_friend=" and F.created<'".$lastid."' ";
            $morequery_group=" and X.created<'".$lastid."' ";
            $morequery_group_status=" and M.created<'".$lastid."' ";
	}
	$uid=mysqli_real_escape_string($this->db,$uid);



	$query=mysqli_query($this->db,"(SELECT DISTINCT M.msg_id as msg_id, S.uid_fk, S.ouid_fk as ouid_fk , M.group_id_fk,M.message, S.created, '0' as type
	FROM
	messages M, users U, friends F, message_share S
	WHERE
	F.friend_one='$uid' AND
	U.uid = F.friend_one AND
	U.status='1' AND
	F.friend_two != S.ouid_fk AND
	S.uid_fk  = F.friend_two AND
	M.uid_fk = S.ouid_fk AND F.role='fri' AND
	S.msg_id_fk = M.msg_id AND S.uid_fk<>'$uid' $morequery GROUP BY M.msg_id)
	UNION

	(SELECT DISTINCT '0' as msg_id, F.friend_one as uid_fk, '0' as ouid_fk , '0' as group_id_fk, '0' as message, F.created, '3' as type
	FROM users U, friends F
	WHERE F.friend_two='$uid' AND U.uid = F.friend_one AND U.status='1' AND F.role='fri' $morequery_friend)
	UNION

	(SELECT
	DISTINCT '0' as msg_id, X.uid_fk as uid_fk, '0' as ouid_fk , X.group_id_fk as group_id_fk, '0' as message, X.created, '4' as type
	FROM users U, groups G, group_users X
	WHERE G.uid_fk=U.uid AND G.group_id=X.group_id_fk AND U.uid='$uid' AND X.uid_fk<>'$uid' AND X.status='1' AND U.status='1' $morequery_group)
	UNION
  
        (SELECT
        DISTINCT M.msg_id as msg_id, M.uid_fk as uid_fk, '0' as ouid_fk , M.group_id_fk as group_id_fk, M.message as message, M.created, '5' as type
        FROM users U, messages M,group_users G
        WHERE G.uid_fk=U.uid AND G.group_id_fk=M.group_id_fk AND U.uid='$uid' AND M.uid_fk<>G.uid_fk AND G.status='1' AND U.status='1' $morequery_group_status)

        UNION
	(SELECT DISTINCT M.msg_id  as msg_id, S.uid_fk, S.ouid_fk as ouid_fk, M.group_id_fk,M.message, S.created, '1' as type
	FROM
	messages M, users U, friends F,message_like S
	WHERE
	F.friend_one='$uid' AND
	U.uid = F.friend_one AND
	U.status='1' AND
	F.friend_two != S.ouid_fk AND
	S.uid_fk  = F.friend_two AND
	M.uid_fk = S.ouid_fk AND F.role='fri' AND
	S.msg_id_fk = M.msg_id AND S.uid_fk<>S.ouid_fk AND S.uid_fk<>'$uid' $morequery  GROUP BY M.msg_id)

	UNION
	(SELECT DISTINCT M.msg_id  as msg_id, S.uid_fk, M.uid_fk as ouid_fk, M.group_id_fk,M.message, S.created, '2' as type
	FROM
	messages M, users U, friends F,comments S
	WHERE
	F.friend_one='$uid' AND
	U.uid = F.friend_one AND
	U.status='1' AND
	F.friend_two != S.uid_fk AND
	M.uid_fk = '$uid' AND F.role='fri' AND
	S.msg_id_fk = M.msg_id  AND S.uid_fk<>'$uid' $morequery  GROUP BY M.msg_id)
	ORDER BY created DESC LIMIT $notifications_perpage") or die(mysqli_error($this->db));
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

/*Notifications*/
public function Notifications_Count($uid,$created)
{
	$uid=mysqli_real_escape_string($this->db,$uid);
	$created=mysqli_real_escape_string($this->db,$created);


	$query=mysqli_query($this->db,"(SELECT DISTINCT M.msg_id, S.uid_fk, S.ouid_fk, M.group_id_fk,M.message, S.created, '0' as type
	FROM
	messages M, users U, friends F,message_share S
	WHERE
	F.friend_one='$uid' AND
	U.uid = F.friend_one AND
	U.status='1' AND
	F.friend_two != S.ouid_fk AND
	S.uid_fk  = F.friend_two AND
	M.uid_fk = S.ouid_fk AND F.role='fri' AND
	S.msg_id_fk = M.msg_id AND S.uid_fk<>'$uid' AND S.created>'$created' GROUP BY M.msg_id)
	UNION
	(SELECT DISTINCT '1' as msg_id, F.friend_one as uid_fk, '1' as ouid_fk , '1' as group_id_fk, '1' as message, F.created, '3' as type
	FROM users U, friends F
	WHERE F.friend_two='$uid' AND U.uid = F.friend_one AND U.status='1' AND F.role='fri' AND F.created>'$created' )
	UNION
	(SELECT DISTINCT M.msg_id, S.uid_fk, S.ouid_fk, M.group_id_fk,M.message, S.created, '1' as type
	FROM
	messages M, users U, friends F,message_like S
	WHERE
	F.friend_one='$uid' AND
	U.uid = F.friend_one AND
	U.status='1' AND
	F.friend_two != S.ouid_fk AND
	S.uid_fk  = F.friend_two AND
	M.uid_fk = S.ouid_fk AND F.role='fri' AND
	S.msg_id_fk = M.msg_id AND S.uid_fk<>S.ouid_fk AND S.uid_fk<>'$uid' AND S.created>'$created' GROUP BY M.msg_id)
	UNION
	(SELECT
	DISTINCT '0' as msg_id, X.uid_fk as uid_fk, '0' as ouid_fk , X.group_id_fk as group_id_fk, '0' as message, X.created, '4' as type
	FROM users U, groups G, group_users X
	WHERE G.uid_fk=U.uid AND G.group_id=X.group_id_fk AND U.uid='$uid' AND X.uid_fk<>'$uid' AND X.status='1' AND U.status='1' AND X.created>'$created')
	UNION
	(SELECT
	DISTINCT M.msg_id as msg_id, M.uid_fk as uid_fk, '0' as ouid_fk , M.group_id_fk as group_id_fk, M.message as message, M.created, '5' as type
	FROM users U, messages M,group_users G
	WHERE G.uid_fk=U.uid AND G.group_id_fk=M.group_id_fk AND U.uid='$uid' AND M.uid_fk<>G.uid_fk AND G.status='1' AND U.status='1' AND M.created>'$created')

	UNION
	(SELECT DISTINCT M.msg_id, S.uid_fk, M.uid_fk as ouid_fk, M.group_id_fk,M.message, S.created, '2' as type
	FROM
	messages M, users U, friends F,comments S
	WHERE
	F.friend_one='$uid' AND
	U.uid = F.friend_one AND
	U.status='1' AND
	F.friend_two != S.uid_fk AND
	M.uid_fk = '$uid' AND F.role='fri' AND
	S.msg_id_fk = M.msg_id  AND S.uid_fk<>'$uid' AND S.created>'$created' GROUP BY M.msg_id)
	ORDER BY created DESC") or die(mysqli_error($this->db));
	return mysqli_num_rows($query);
}


/*Profile Updates  */
public function Updates($uid,$lastid,$perpage,$moreCheck)
{

/* More Total Check */
if($moreCheck)
{
$perpage=$perpage+1;
}


/* More Button*/
$morequery="";
if($lastid)
{
$morequery_share=" and S.created<'".$lastid."' ";
$morequery_like=" and L.created<'".$lastid."' ";
$morequery=" and M.created<'".$lastid."' ";
}
/* More Button End*/

$v=mysqli_query($this->db,"SELECT share_id FROM message_share");
$w=mysqli_query($this->db,"SELECT like_id FROM message_like");
if(mysqli_num_rows($v) || mysqli_num_rows($w))
{



$query=mysqli_query($this->db,"SELECT DISTINCT msg_id, uid_fk, message, created, like_count,comment_count,share_count, username,uploads,
share_uid,share_ouid, like_uid,  like_ouid FROM(SELECT DISTINCT M.msg_id, M.uid_fk, M.message, S.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads,
S.uid_fk as share_uid,S.ouid_fk as share_ouid,'0' AS like_uid, '0' as like_ouid
FROM
messages M, users U, message_share S
WHERE
M.uid_fk=U.uid AND
U.status='1' AND
S.msg_id_fk=M.msg_id AND
S.uid_fk='$uid' $morequery_share group by msg_id
UNION ALL
SELECT DISTINCT M.msg_id, M.uid_fk, M.message, L.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads,
'0' as share_uid,'0' as share_ouid, L.uid_fk as like_uid,L.ouid_fk as like_ouid
FROM
messages M, users U, message_like L
WHERE
M.uid_fk=U.uid AND
U.status='1' AND
L.msg_id_fk=M.msg_id AND L.uid_fk<>L.ouid_fk AND
L.uid_fk='$uid' $morequery_like group by msg_id
UNION ALL
SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid, '0' AS like_uid, '0' as like_ouid
FROM messages M, users U
WHERE
U.status='1' AND
M.uid_fk=U.uid AND
M.uid_fk='$uid' AND M.group_id_fk='0'  $morequery group by msg_id)t GROUP BY msg_id ORDER BY created DESC LIMIT $perpage");
}
else
{
$query = mysqli_query($this->db,"SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U  WHERE U.status='1' AND M.uid_fk=U.uid AND M.uid_fk='$uid' AND M.group_id_fk='0' $morequery ORDER BY M.msg_id DESC LIMIT $perpage") or die(mysqli_error($this->db));
}

if($moreCheck)
{
$data=mysqli_num_rows($query);
}
else
{
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
$data[]=$row;
}
}
return $data;


}


/* Friends_Updates   */
public function Friends_Updates($uid,$lastid,$perpage,$moreCheck)
{
/* More Total Check */
if($moreCheck)
{
$perpage=$perpage+1;
}

/* More Button*/
$morequery="";
if($lastid)
{
$morequery_share=" and S.created<'".$lastid."' ";
$morequery_like=" and L.created<'".$lastid."' ";
$morequery=" and M.created<'".$lastid."' ";
}
/*More Button End*/
$v=mysqli_query($this->db,"SELECT share_id FROM message_share");
$w=mysqli_query($this->db,"SELECT like_id FROM message_like");

if(mysqli_num_rows($v) || mysqli_num_rows($w))
{
$query=mysqli_query($this->db,"SELECT DISTINCT msg_id, uid_fk,group_id_fk,message, created, like_count,comment_count,share_count, username,uploads, share_uid,share_ouid , like_uid,like_ouid
FROM
(SELECT DISTINCT M.msg_id, M.uid_fk,M.group_id_fk,M.message, S.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, S.uid_fk as share_uid,S.ouid_fk as share_ouid , '0' as like_uid,'0' as like_ouid
FROM
messages M, users U, friends F,message_share S
WHERE
F.friend_one='$uid' AND
U.uid = F.friend_one AND
U.status='1' AND
F.friend_two != S.ouid_fk AND
S.uid_fk  = F.friend_two AND
M.uid_fk = S.ouid_fk AND F.role='fri' AND
S.msg_id_fk = M.msg_id $morequery_share group by msg_id
UNION ALL
SELECT DISTINCT M.msg_id, M.uid_fk,M.group_id_fk,M.message, L.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads,'0' AS share_uid, '0' as share_ouid , L.uid_fk as like_uid,L.ouid_fk as like_ouid
FROM
messages M, users U, friends F,message_like L
WHERE
F.friend_one='$uid' AND
U.uid = F.friend_one AND
U.status='1' AND
F.friend_two != L.ouid_fk AND
L.uid_fk  = F.friend_two AND
M.uid_fk = L.ouid_fk AND F.role='fri' AND L.uid_fk<>L.ouid_fk AND
L.msg_id_fk = M.msg_id $morequery_like group by msg_id
UNION ALL
SELECT DISTINCT M.msg_id, M.uid_fk, M.group_id_fk, M.message, M.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid, '0' as like_uid,'0' as like_ouid
FROM
messages M, users U, friends F
WHERE F.friend_one='$uid' AND U.status='1' AND M.uid_fk=U.uid AND M.uid_fk = F.friend_two
AND M.group_id_fk='0' $morequery group by msg_id
UNION ALL
SELECT DISTINCT M.msg_id, M.uid_fk, M.group_id_fk, M.message, M.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid, '0' as like_uid,'0' as like_ouid
FROM
messages M, users U, group_users G
WHERE G.uid_fk='$uid'
AND U.status='1'
AND M.group_id_fk = G.group_id_fk AND G.status='1' AND M.uid_fk=U.uid $morequery group by M.msg_id )t GROUP BY msg_id ORDER BY created DESC  LIMIT $perpage") or die(mysqli_error($this->db));
}
else
{
$query = mysqli_query($this->db,"SELECT DISTINCT M.msg_id, M.uid_fk,M.group_id_fk, M.message, M.created, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid, '0' as like_uid,'0' as like_ouid
FROM messages M, users U, friends F  WHERE U.status='1' AND M.uid_fk=U.uid AND  M.uid_fk = F.friend_two
AND F.friend_one='$uid' $morequery ORDER BY M.msg_id DESC LIMIT $perpage") or die(mysqli_error($this->db));
}

if($moreCheck)
{
$data=mysqli_num_rows($query);
}
else
{
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
$data[]=$row;
}
}
return $data;
}
public function Get_Volunteer_Content(){

	$query=mysqli_query($this->db,"SELECT id,decription FROM image_guide_volunteer WHERE id = '4'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

public function Update_Each_Volunteer($id, $p, $image){
        $p = mysqli_real_escape_string($this->db,$p);
        $image = mysqli_real_escape_string($this->db,$image);
        if(strlen($image)>0){
            mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p', image_path='$image' WHERE id='$id'") or die(mysqli_error($this->db));
        }else{
            mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p' WHERE id='$id'") or die(mysqli_error($this->db));
        }
	
	return true;
}

public function Update_Volunteer_1($text_one_volunteer){
   $text_one_volunteer = mysqli_real_escape_string($this->db,$text_one_volunteer);
	mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$text_one_volunteer' WHERE id='4'") or die(mysqli_error($this->db));
	return true;

}
public function Get_Volunteer_Content_two(){
	$query=mysqli_query($this->db,"SELECT id,decription FROM image_guide_volunteer WHERE id = '5'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}
public function Update_Volunteer_2($p){
   $p = mysqli_real_escape_string($this->db,$p);
	mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p' WHERE id='5'") or die(mysqli_error($this->db));
	return true;
}
public function Get_Volunteer_Content_three(){
	$query=mysqli_query($this->db,"SELECT id,decription FROM image_guide_volunteer WHERE id = '1'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}
public function Update_Volunteer_3($p, $image){
        $p = mysqli_real_escape_string($this->db,$p);
        $image = mysqli_real_escape_string($this->db,$image);
        if(strlen($image)>0){
            mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p', image_path='$image' WHERE id='1'") or die(mysqli_error($this->db));
        }else{
            mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p' WHERE id='1'") or die(mysqli_error($this->db));
        }
	
	return true;
}
public function Get_Volunteer_Content_four(){
	$query=mysqli_query($this->db,"SELECT id,decription FROM image_guide_volunteer WHERE id = '2'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}
public function Update_Volunteer_4($p, $image){
        $p = mysqli_real_escape_string($this->db,$p);
        $image = mysqli_real_escape_string($this->db,$image);
        if(strlen($image)>0){
            mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p', image_path='$image' WHERE id='2'") or die(mysqli_error($this->db));
        }else{
            mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p' WHERE id='2'") or die(mysqli_error($this->db));
        }
	//mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p' WHERE id='2'") or die(mysqli_error($this->db));
	return true;
}
public function Get_Volunteer_Content_five(){
	$query=mysqli_query($this->db,"SELECT id,decription FROM image_guide_volunteer WHERE id = '3'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}
public function Update_Volunteer_5($p, $image){
        $p = mysqli_real_escape_string($this->db,$p);
        $image = mysqli_real_escape_string($this->db,$image);
        if(strlen($image)>0){
            mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p', image_path='$image' WHERE id='3'") or die(mysqli_error($this->db));
        }else{
            mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p' WHERE id='3'") or die(mysqli_error($this->db));
        }
	//mysqli_query($this->db,"UPDATE image_guide_volunteer SET decription='$p' WHERE id='3'") or die(mysqli_error($this->db));
	return true;
}
public function User_Project_Follow($uid)
{
	$query = mysqli_query($this->db,"SELECT projects.proj_id,groups.group_id,group_name,group_pic,groups.uid_fk as group_owner_id FROM group_users INNER JOIN groups ON groups.group_id = group_users.group_id_fk INNER JOIN projects ON projects.group_id = groups.group_id WHERE group_users.uid_fk = '$uid' AND group_users.status='1' ORDER BY projects.proj_id DESC");
	while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$data[]=$row;
	}
	return $data;
}
public function Project_Follow_Count($uid)
{
	$query=mysqli_query($this->db,"SELECT COUNT(projects.proj_id) as total_project FROM group_users INNER JOIN groups ON groups.group_id = group_users.group_id_fk INNER JOIN projects ON projects.group_id = groups.group_id WHERE group_users.uid_fk = '$uid'");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['total_project'];
}

public function Update_want_Volunteer($p){
        $p = mysqli_real_escape_string($this->db,$p);
	mysqli_query($this->db,"UPDATE dashboard SET want_volunteer='$p' WHERE id='1'") or die(mysqli_error($this->db));
	return true;
}

/* CPS Admin Post*/
public function Get_Project_News($uid){
        $query=mysqli_query($this->db,"select msg_id, msg_title, message, created, group_name, group_id, cate_id from messages M INNER JOIN groups G on G.group_id = M.group_id_fk WHERE M.uid_fk = '$uid' AND (M.cate_id = '1' OR M.cate_id = '2') ORDER BY created DESC LIMIT 10");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}

public function Update_Manage_Projects($uid, $p1_gid, $p2_gid, $p3_gid, $p4_gid){
         $query=mysqli_query($this->db,"select id from manage_projects WHERE uid = '$uid' LIMIT 1");
         $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
         $id=$data['id'];
         if($id){
             mysqli_query($this->db,"UPDATE manage_projects SET p1_gid='$p1_gid', p2_gid='$p2_gid',p3_gid='$p3_gid',p4_gid='$p4_gid' WHERE id='$id'") or die(mysqli_error($this->db));
         }else{
             mysqli_query($this->db,"INSERT INTO manage_projects(uid, p1_gid, p2_gid, p3_gid, p4_gid) VALUES('$uid','$p1_gid','$p2_gid','$p3_gid', '$p4_gid')");
         }
         return true;
}

public function Get_Manage_Projects($uid){
        $query=mysqli_query($this->db,"select * from manage_projects WHERE uid = '$uid' LIMIT 1");
        $data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
        return $data;
}

public function Get_Last_Message($gid){
        $query=mysqli_query($this->db,"select * from messages WHERE group_id_fk = '$gid' AND (cate_id = '1' OR cate_id = '2') ORDER BY created DESC LIMIT 1");
        $data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
        return $data;
}

public function Count_Project_Nitification($gid){
        $query=mysqli_query($this->db,"select count(*) as msg_count from messages WHERE group_id_fk = '$gid' AND (cate_id = '1' OR cate_id = '2')");
        $data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
        return $data['msg_count'];
}
// start of the profile saorin
public function User_Group_Details_Owner($uid, $type)
{
	$query=mysqli_query($this->db,"SELECT group_id,group_name,uid_fk,group_pic,type FROM groups WHERE uid_fk='$uid' AND status='1' AND type='$type'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}
public function Project_Follow_Count_Own($uid){

	$query=mysqli_query($this->db,"SELECT pro_id,groups.group_id,group_name,group_pic,uid as group_owner_id FROM projects INNER JOIN project_follow ON projects.proj_id = project_follow.pro_id INNER JOIN groups ON groups.group_id = projects.group_id WHERE uid = '$uid'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}
public function Community_Follow_Count_Own($uid){

	$query=mysqli_query($this->db,"SELECT groups.group_id,group_name,group_pic,uid as group_owner_id FROM community INNER JOIN follow_communities ON community.com_id = follow_communities.com_id INNER JOIN groups ON groups.group_id = community.group_id WHERE uid = '$uid'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}
public function Participation_Group_Details($uid, $type)
{
	$query=mysqli_query($this->db,"SELECT group_id,group_name,uid_fk as group_owner_id,group_pic,type FROM groups WHERE uid_fk='$uid' AND status='1' AND type='$type'");
	while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$data[]=$row;
	}
	return $data;
}
// the end of profile

/* Get Project Social Needs */
public function Get_Project_Social_Need_By_ID($sn_id){	
        $query=mysqli_query($this->db,"SELECT SN.sn_id, SN.msg_id, M.msg_title, M.message, SN.sn_keywords, SN.sn_image from proj_social_needs SN INNER JOIN messages M on SN.msg_id = M.msg_id where M.cate_id = '2' AND SN.sn_id = '$sn_id' LIMIT 1");
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
        return $data;
}

/* Update Project Social Need */
public function Update_Each_Social_Need($sn_id, $sn_title, $sn_content,$sn_keywords, $sn_image){
        $sn_title=mysqli_real_escape_string($this->db,$sn_title);
        $sn_content=mysqli_real_escape_string($this->db,$sn_content);
        $sn_keywords=mysqli_real_escape_string($this->db,$sn_keywords);
        $sn_image=mysqli_real_escape_string($this->db,$sn_image);
        
        if(strlen($sn_image)>0){
            mysqli_query($this->db, "UPDATE proj_social_needs SET sn_keywords='$sn_keywords', sn_image='$sn_image' where sn_id='$sn_id'") or die(mysqli_error($this->db));
        }else{
            mysqli_query($this->db, "UPDATE proj_social_needs SET sn_keywords='$sn_keywords' where sn_id='$sn_id'") or die(mysqli_error($this->db));
        }
        $query=mysqli_query($this->db,"select msg_id from proj_social_needs WHERE sn_id = '$sn_id' LIMIT 1");
        $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
        $msg_id=$data['msg_id'];
	mysqli_query($this->db, "UPDATE messages SET msg_title='$sn_title', message='$sn_content' where msg_id='$msg_id'") or die(mysqli_error($this->db));
        return true;    
}

/* Update Project Social Need */
public function Update_Each_Prog_Plan($prog_id, $prog_title, $prog_content,$prog_keywords, $prog_image){
        $prog_title=mysqli_real_escape_string($this->db,$prog_title);
        $prog_content=mysqli_real_escape_string($this->db,$prog_content);
        $prog_keywords=mysqli_real_escape_string($this->db,$prog_keywords);
        $prog_image=mysqli_real_escape_string($this->db,$prog_image);
        
        if(strlen($prog_image)>0){
            mysqli_query($this->db, "UPDATE proj_program SET prog_keywords='$prog_keywords', prog_image='$prog_image' where prog_id='$prog_id'") or die(mysqli_error($this->db));
        }else{
            mysqli_query($this->db, "UPDATE proj_program SET prog_keywords='$prog_keywords' where prog_id='$prog_id'") or die(mysqli_error($this->db));
        }
        $query=mysqli_query($this->db,"select msg_id from proj_program WHERE prog_id = '$prog_id' LIMIT 1");
        $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
        $msg_id=$data['msg_id'];
	mysqli_query($this->db, "UPDATE messages SET msg_title='$prog_title', message='$prog_content' where msg_id='$msg_id'") or die(mysqli_error($this->db));
        return true;    
}

/* Update Project Outcome */
public function Update_Each_Outcome($outcome_id, $outcome_title, $outcome_content,$outcome_keywords, $outcome_image){
        $outcome_title=mysqli_real_escape_string($this->db,$outcome_title);
        $outcome_content=mysqli_real_escape_string($this->db,$outcome_content);
        $outcome_keywords=mysqli_real_escape_string($this->db,$outcome_keywords);
        $outcome_image=mysqli_real_escape_string($this->db,$outcome_image);
        
        if(strlen($outcome_image)>0){
            mysqli_query($this->db, "UPDATE proj_outcomes SET outcome_keywords='$outcome_keywords', outcome_image='$outcome_image' where outcome_id='$outcome_id'") or die(mysqli_error($this->db));
        }else{
            mysqli_query($this->db, "UPDATE proj_outcomes SET outcome_keywords='$outcome_keywords' where outcome_id='$outcome_id'") or die(mysqli_error($this->db));
        }
        $query=mysqli_query($this->db,"select msg_id from proj_outcomes WHERE outcome_id = '$outcome_id' LIMIT 1");
        $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
        $msg_id=$data['msg_id'];
	mysqli_query($this->db, "UPDATE messages SET msg_title='$outcome_title', message='$outcome_content' where msg_id='$msg_id'") or die(mysqli_error($this->db));
        return true;    
}

public function check_cps_admin($uid){
		$query=mysqli_query($this->db,"SELECT uid FROM cps_admin WHERE uid = '$uid' LIMIT 1") or die(mysqli_error($this->db));
		$num=mysqli_num_rows($query);
		if($num>0){
			return true;
		}else{
			return false;
		}
}

public function check_group_admin($uid, $gid){
		$query=mysqli_query($this->db,"SELECT uid FROM group_admin WHERE uid = '$uid' AND group_id= '$gid' LIMIT 1") or die(mysqli_error($this->db));
		$num=mysqli_num_rows($query);
		if($num>0){
			return true;
		}else{
			return false;
		}
}

public function Project_Announcement_Test($msgid)
{
	$query = mysqli_query($this->db,"SELECT
	DISTINCT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U, group_users G
	WHERE U.status='1' AND M.msg_id= '$msgid' AND M.cate_id = 2 LIMIT 1") or die(mysqli_error($this->db));

	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
        return $data;
}

public function Get_Msg_id($sn_id)
{
	$query = mysqli_query($this->db,"SELECT msg_id from proj_social_needs where sn_id='$sn_id' LIMIT 1") or die(mysqli_error($this->db));

	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
    return $data['msg_id'];
}

public function Get_Project_Social_Need_Message_ID($sn_id,$msg_id){
  $query=mysqli_query($this->db,"SELECT SN.sn_id, SN.msg_id, M.msg_title, M.message, SN.sn_keywords, SN.sn_image from proj_social_needs SN INNER JOIN messages M on SN.msg_id = M.msg_id where M.cate_id = '2' AND SN.sn_id = '$sn_id' AND SN.msg_id ='$msg_id' LIMIT 1");
  $data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
        return $data;
}

// start of program plan in socoai need 
public function Get_Msg_Pro_Id($pp_id)
{
	$query = mysqli_query($this->db,"SELECT msg_id from proj_program where prog_id='$pp_id' LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
    return $data['msg_id'];
}

public function Get_Project_Prog_Plan_Each($pp_id,$msg_id){	
    $query=mysqli_query($this->db,"SELECT PP.prog_id, PP.msg_id, M.msg_title, M.message, PP.prog_keywords, PP.prog_image from proj_program PP INNER JOIN messages M on PP.msg_id = M.msg_id 
WHERE M.cate_id = '3' AND PP.prog_id = '$pp_id' AND PP.msg_id='$msg_id' LIMIT 1");
    $data = mysqli_fetch_array($query,MYSQLI_ASSOC);
    return $data;
}
public function Project_Announcement_Program_Plan($msgid)
{
	$query = mysqli_query($this->db,"SELECT
	DISTINCT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U, group_users G
	WHERE U.status='1' AND M.msg_id= '$msgid' AND M.cate_id = 3 LIMIT 1") or die(mysqli_error($this->db));

	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
        return $data;
}
// the end of program plan in socail need

// start of outcome
public function Get_Msg_Out_Id($oc_id){ 
	$query = mysqli_query($this->db,"SELECT msg_id from proj_outcomes where outcome_id='$oc_id' LIMIT 1") or die(mysqli_error($this->db));
	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
    return $data['msg_id'];
}

public function Get_Project_Outcome_Each($oc_id,$msg_id){	
        $query=mysqli_query($this->db,"SELECT O.outcome_id, O.msg_id, M.msg_title, M.message, O.outcome_keywords, O.outcome_image from proj_outcomes O INNER JOIN messages M on O.msg_id = M.msg_id where M.cate_id = '4' AND O.outcome_id = '$oc_id' AND O.msg_id=  '$msg_id' LIMIT 1");
		$data = mysqli_fetch_array($query,MYSQLI_ASSOC);
		return $data;
}
public function Project_Announcement_Outcome($msgid)
{
	$query = mysqli_query($this->db,"SELECT
	DISTINCT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
	FROM messages M, users U, group_users G
	WHERE U.status='1' AND M.msg_id= '$msgid' AND M.cate_id = 4 LIMIT 1") or die(mysqli_error($this->db));

	$data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
        return $data;
}

public function Check_Project_Follower($uid,$gid){
		$query=mysqli_query($this->db,"SELECT group_user_id, status FROM group_users WHERE uid_fk = '$uid' AND group_id_fk= '$gid' LIMIT 1") or die(mysqli_error($this->db));
		$num=mysqli_num_rows($query);
		$data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
		if($num>0){
			if($data['status']>0){
				return false;
			}else{
				 mysqli_query($this->db,"UPDATE group_users SET status = '1' where group_id_fk = '$gid' AND uid_fk = '$uid'") or die(mysqli_error($this->db));
				return true;
			}
		}else{
			$time=time();
            mysqli_query($this->db,"INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES ('$uid','$gid','$time')") or die(mysqli_error($this->db));
			return true;
		}
}

public function Check_Unfollow_Project($uid,$gid){
		$query=mysqli_query($this->db,"SELECT group_user_id, status FROM group_users WHERE uid_fk = '$uid' AND group_id_fk= '$gid' LIMIT 1") or die(mysqli_error($this->db));
		$num=mysqli_num_rows($query);
		$data=mysqli_fetch_array($query,MYSQLI_ASSOC);   
		if($num>0){
			if($data['status']==0){
				return false;
			}else{
				 mysqli_query($this->db,"UPDATE group_users SET status = '0' where group_id_fk = '$gid' AND uid_fk = '$uid'") or die(mysqli_error($this->db));
				return true;
			}
		}else{
			return true;
		}
}
public function Get_Extra_Info_Announcement($msg_id){
	$query = mysqli_query($this->db,"SELECT cate_id, group_id_fk FROM messages WHERE msg_id= '$msg_id' LIMIT 1") or die(mysqli_error($this->db));
	$data = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data;
}

public function Get_SN_ID($msg_id){
	$query = mysqli_query($this->db,"SELECT sn_id FROM proj_social_needs where msg_id= '$msg_id' LIMIT 1") or die(mysqli_error($this->db));
	$data = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['sn_id'];
}

public function Get_Prog_ID($msg_id){
	$query = mysqli_query($this->db,"SELECT prog_id FROM proj_program where msg_id= '$msg_id' LIMIT 1") or die(mysqli_error($this->db));
	$data = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['prog_id'];
}

public function Get_Outcome_ID($msg_id){
	$query = mysqli_query($this->db,"SELECT outcome_id FROM proj_outcomes where msg_id= '$msg_id' LIMIT 1") or die(mysqli_error($this->db));
	$data = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['outcome_id'];
}
/* Forgot Password */
public function Check_Email($email, $password){
	$email=mysqli_real_escape_string($this->db,$email);
	$password = mysqli_real_escape_string($this->db,$password);
	$md5_password=md5($password);
	$q=mysqli_query($this->db,"SELECT uid FROM users WHERE email='$email' LIMIT 1");
	
	if(mysqli_num_rows($q)==0)
	{
         	return 0;
	}else{
			
			mysqli_query($this->db,"UPDATE users SET password = '$md5_password' where email = '$email'") or die(mysqli_error($this->db));
            return 1;

    }
}
public function Check_Current_Password($uid, $password){
    $password=mysqli_real_escape_string($this->db,$password);
    $md5_password=md5($password);
    $q=mysqli_query($this->db,"SELECT * FROM users WHERE uid='$uid' AND password = '$md5_password' LIMIT 1");
    if(mysqli_num_rows($q)==0)
    {
            return false;
    }else{
           return true;

   }
}

public function Update_Password($uid, $password){
    $password=mysqli_real_escape_string($this->db,$password);
    $md5_password=md5($password);
    mysqli_query($this->db,"UPDATE users SET password = '$md5_password' where uid = '$uid'") or die(mysqli_error($this->db));
    return true;
}

public function Get_Project_Location($gid){
    $query = mysqli_query($this->db,"SELECT location FROM projects where group_id= '$gid' LIMIT 1") or die(mysqli_error($this->db));
    $data = mysqli_fetch_array($query,MYSQLI_ASSOC);
    return $data['location'];
}

public function Get_Com_Location($gid){
    $query = mysqli_query($this->db,"SELECT location FROM community where group_id= '$gid' LIMIT 1") or die(mysqli_error($this->db));
    $data = mysqli_fetch_array($query,MYSQLI_ASSOC);
    return $data['location'];
}

public function Get_Org_Location($gid){
    $query = mysqli_query($this->db,"SELECT location FROM organizations where group_id= '$gid' LIMIT 1") or die(mysqli_error($this->db));
    $data = mysqli_fetch_array($query,MYSQLI_ASSOC);
    return $data['location'];
}

public function Get_User_Country($uid){
    $query = mysqli_query($this->db,"SELECT country FROM users where uid= '$uid' LIMIT 1") or die(mysqli_error($this->db));
    $data = mysqli_fetch_array($query,MYSQLI_ASSOC);
    return $data['country'];
}
public function Get_NameID_Organization($group_id){
 // $query = mysqli_query($this->db,"SELECT group_id,group_name FROM groups  INNER JOIN projects  ON projects.group_id = projects.org_id WHERE projects.group_id = '$group_id'");
	$query = mysqli_query($this->db,"SELECT projects.proj_id,groups.group_id,group_name,group_pic FROM groups INNER JOIN projects ON groups.group_id = projects.group_id INNER JOIN organizations ON organizations.org_id = projects.org_id WHERE groups.group_id='$group_id' limit 1");
   $data = mysqli_fetch_array($query,MYSQLI_ASSOC);
   return $data;
}
// organization
public function Update_organization($group_id,$org_des, $image_path){
    $organization_des = mysqli_real_escape_string($this->db,$organization_des);
    $image_path = mysqli_real_escape_string($this->db,$image_path);
    mysqli_query($this->db,"UPDATE groups SET group_name='$org_des',group_pic='$image_path' WHERE group_id='$group_id'") or die(mysqli_error($this->db));
    return true;
    // UPDATE projects SET contact_intro='$contacts_des',contact_img='$image_path' WHERE proj_id='$pro_id'
}

public function Update_organization2($group_id,$org_des){
    $organization_des = mysqli_real_escape_string($this->db,$organization_des);
    mysqli_query($this->db,"UPDATE groups SET group_name='$org_des' WHERE group_id='$group_id'") or die(mysqli_error($this->db));
   // UPDATE projects SET contact_intro='$contacts_des' WHERE proj_id='$pro_id'
    return true;
}

public function Promote_Project_Admin($uid, $groupID){
	$query = mysqli_query($this->db,"UPDATE project_involvement SET role = '1' where uid = '$uid' AND group_id = '$groupID'") or die(mysqli_error($this->db));
	return true;
}

public function check_status_project($gid, $uid){
	$query = mysqli_query($this->db,"SELECT count(*) as proj_role FROM groups where group_id= '$gid' AND uid_fk = '$uid' LIMIT 1") or die(mysqli_error($this->db));
	$data = mysqli_fetch_array($query,MYSQLI_ASSOC);
	$role = -1;
	
	if($data['proj_role']>0){
		$role = 2;
	}else{
		$query2 = mysqli_query($this->db,"SELECT role from project_involvement where uid = '$uid' AND group_id = '$gid' AND aprove = '1' AND deleted = '0' LIMIT 1") or die(mysqli_error($this->db));
		$data2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
		if(sizeof($data2)>0){
			$role = $data2['role'];
		}
	}
	return $role;
}

public function Unfollow_Project($uid, $gid){
	mysqli_query($this->db,"UPDATE group_users SET status = '0' where group_id_fk = '$gid' AND uid_fk = '$uid'") or die(mysqli_error($this->db));
	return true;
}

public function Check_Status_Follow_Project($uid, $gid){
	$query = mysqli_query($this->db,"SELECT status FROM group_users where group_id_fk = '$gid' AND uid_fk = '$uid' LIMIT 1") or die(mysqli_error($this->db));
	$data = mysqli_fetch_array($query,MYSQLI_ASSOC);
	return $data['status'];
}


}
?>