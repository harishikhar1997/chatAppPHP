<?php
session_start();
require_once "../connect.php";



$draw = $_REQUEST['draw'];
$row1 = $_REQUEST['start'];
$rowperpage = $_REQUEST['length']; // Rows display per page
$columnIndex = $_REQUEST['order'][0]['column']; // Column index
$columnName = $_REQUEST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_REQUEST['order'][0]['dir']; // asc or desc
$searchValue = $_REQUEST['search']['value']; // Search value


if($searchValue=='' || empty($searchValue))
{
	$keyword='';
}
else{
	$keyword=$searchValue;
}

$sql2="SELECT count(user_id) AS num_rows FROM users WHERE role='subscriber' AND (username LIKE '%".$keyword."%' OR role LIKE '%".$keyword."%' OR last_activity LIKE '%".$keyword."%') ";
$result2=$conn->query($sql2);
//print_r($result2);die();
while($r=$result2->fetch_assoc()){
	$tot=$r["num_rows"];
}

$sql="SELECT * FROM users WHERE role='subscriber' AND (username LIKE '%".$keyword."%' OR role LIKE '%".$keyword."%' OR last_activity LIKE '%".$keyword."%') ORDER BY '".$columnName."' ".$columnSortOrder." limit ".$rowperpage." OFFSET ".$row1." ";

$result = $conn->query($sql);

$data=array();
while($row = $result->fetch_assoc()){
	$user_id = $row["user_id"];
	$activity = $row["activity"];
	$currStatus = $row["currStatus"];
	if($activity==1){
		$a="active";
	}
	else{
		$a="inactive";
	}

	if($currStatus==1){
		$b="online";
	}
	else{
		$b="offline";
	}
	$data[] = array(
				$row["user_id"],
				$row["username"],
				$row["password"],
				$row["last_activity"],
				"$b",
				"<img src='".$row["file_name"]."'>",
				$row["role"],
				"$a",
				"<a href='forms-basic.php?id=".base64_encode(convert_uuencode($user_id))." '><i class='fa fa-edit' style='font-size:20px'></i></a> | <button style='border:none;background:none;cursor:pointer;' class='delete' onClick='btnDel(".$user_id.") '><i class='fa fa-trash' style='font-size:20px'></i></button>"
			);
}

$results['draw'] = $draw;
$results['recordsTotal'] = $tot;
$results['recordsFiltered'] = $tot;
$results['data'] = $data;

echo json_encode($results);die;

?>

















<!-- "action"=>"<a href='edit.php?id='.base64_encode(convert_uuencode($row["user_id"])).''>Edit</a> |
									<a class='delete' id='del' href='delete.php?id='".$row["user_id"]."''>Delete</a>" -->