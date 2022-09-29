<?php 
header("Content-Type: application/json");
include_once "../connection.php";

$p = $_SERVER["REQUEST_METHOD"];

switch($p){
	case "GET":
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$q=mysqli_query($conn,"select * from notice where notice_id=$id");
			$rt = mysqli_fetch_assoc($q);
		}else{
			$rt = [];
			$q=mysqli_query($conn,"select * from notice ");
			while($row=mysqli_fetch_assoc($q))
			{
				array_push($rt, $row);
			}
		}
		echo json_encode($rt);
		break;
	case 'POST':
		$data = json_decode(file_get_contents("php://input"),true);
		$user = $data['user'];
		$subject = $data['subject'];
		$desc = $data['description'];
		$q = mysqli_query($conn, "insert into notice (user,subject,Description)values('$user','$subject','$desc')");
		$msg['status']=1;
		$msg['message']='Notice added Successfully';
		$msg['notice'] = $data;
		echo json_encode($msg);
		break;
	default:
		echo "Invalid ";
		break;
}