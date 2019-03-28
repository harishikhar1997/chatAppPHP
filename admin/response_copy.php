<?php
session_start();
require_once "../connect.php";



// $results_new = array();
// $sql="SELECT * FROM users WHERE role='subscriber'";
// $result = $conn->query($sql);
// while($row = $result->fetch_assoc()){
// 	$data = [$row["user_id"],$row["username"],$row["password"],$row["last_activity"],				$row["currStatus"],$row["file_name"],$row["role"],$row["activity"],"<a href='edit.php?id='.base64_encode(convert_uuencode(".$row["user_id"]."''))>Edit</a> | <a class='delete' id='del' href='delete.php?id='".$row["user_id"]."''>Delete</a>"
// 			];
// }


// // $data = [1,"sdfsdf","sdfsd","fsdf","sdfsdf","sdfsdf","fsdf","dfsdf","sdfsdf"];

// $results_new['draw'] = $_REQUEST['draw'];
// $results_new['recordsTotal'] = count($result);
// $results_new['recordsFiltered'] = count($result);
// $results_new['data'][] = $data;

// echo json_encode($results_new);die;






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

$sql="SELECT * FROM users WHERE role='subscriber' AND (username LIKE '%".$keyword."%' OR role LIKE '%".$keyword."%' OR last_activity LIKE '%".$keyword."%') ORDER BY '".$columnName."' ".$columnSortOrder." limit ".$row1.",".$rowperpage." ";
$result = $conn->query($sql);

$data=array();
while($row = $result->fetch_assoc()){
	$data[] = array(
				$row["user_id"],
				$row["username"],
				$row["password"],
				$row["last_activity"],
				$row["currStatus"],
				$row["file_name"],
				$row["role"],
				$row["activity"],
				"<a href='edit.php?id='.base64_encode(convert_uuencode(".$row["user_id"]."''))>Edit</a> | <a class='delete' id='del' href='delete.php?id='".$row["user_id"]."''>Delete</a>"
			);
}

$results = array(
					"draw" => intval($draw),
					"TotalRecords" => count($result),
          "TotalFilterRecords" => count($result),
          "Data" => $data 
        );

echo json_encode($results);die;

?>

















<!-- "action"=>"<a href='edit.php?id='.base64_encode(convert_uuencode($row["user_id"])).''>Edit</a> |
									<a class='delete' id='del' href='delete.php?id='".$row["user_id"]."''>Delete</a>" -->