<?php
$session_data=$Wall->User_Details($uid);
$session_uid=$session_data['uid'];
$session_username=$session_data['username'];
$session_first_name=$session_data['first_name'];
$session_last_name=$session_data['last_name'];
$username=$session_data['username'];
$session_email=$session_data['email'];
$session_friend_count=$session_data['friend_count'];
$session_photos_count=$session_data['photos_count'];
$session_conversation_count=$session_data['conversation_count'];
$session_update_count=$session_data['updates_count'];
$session_profile_bg=$session_data['profile_bg'];
$session_full_name=htmlcode($session_data['full_name']);
$session_profile_pic=$session_data['profile_pic'];
$session_profile_pic_status=$session_data['profile_pic_status'];
$session_group_count=$session_data['group_count'];
$session_bio=htmlcode(nameFilter($session_data['bio'],40));
$session_profile_bg_position=$session_data['profile_bg_position'];
$session_verified=$session_data['verified'];
$session_tour=$session_data['tour'];
$session_notification_created=$session_data['notification_created'];
$session_face=$Wall->User_Profilepic($uid,$base_url,$upload_path);
$profileface=$session_face;
$notifications_count=$Wall->Notifications_Count($uid,$session_notification_created);

$session_cps_admin = $Wall->check_cps_admin($uid);

?>