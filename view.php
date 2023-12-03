<?php
session_start();
include('db.conn.php');
$em = $_SESSION['email'];

$d = date('y-m-d');
$query = $conn->prepare("SELECT * FROM images WHERE email = :em  ORDER BY id DESC");
$query->execute(array(':em' => $em));
$rows = $query->fetchall(PDO::FETCH_ASSOC);

if ($rows) {
   
    foreach($rows as $row){
        $img = $row['img_name'];
    echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode( $row['img_name'] ).'"/>';
    }
} else {
    $img = ''; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Images</title>
</head>
<body>
    <a href=<?php  $img; ?>>link</a>

</body>
</html>
