<?php
function __autoload($className){
	include_once("models/$className.php");	
}

$users=new User("localhost","root","","task-manager");

if(!isset($_POST['action'])) {
	print json_encode(0);
	return;
}

if(get_magic_quotes_gpc()){
    $userParams = stripslashes($_POST['user']);
} else {
    $userParams = $_POST['user'];
}

switch($_POST['action']) {
	case 'get_users':
		print $users->getUsers();
	break;
	
	case 'add_user':
		$user = new stdClass;
		$user = json_decode($userParams );
		print $users->add($user);		
	break;
	
	case 'delete_user':
		$user = new stdClass;
		$user = json_decode($userParams );
		print $users->delete($user);		
	break;
	
	case 'update_field_data':
		$user = new stdClass;
		$user = json_decode($userParams );
		print $users->updateValue($user);				
	break;
}

exit();
