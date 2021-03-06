<?php
require_once __DIR__ . '/resource/mysql.php';
$place = $_POST['place'];
try {
    $pdo = new PDO($db_host_super, $db_user, $db_password, [PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
} catch(PDOException $e) {
  //todo  
    die($e->getMessage());
}

$StageTT = $pdo->prepare('SELECT ID, name, member, DATE_FORMAT(time, \'%Y%m%d%H%i%S\') AS ntime, DATE_FORMAT(time, \'%m-%d %H:%i\') AS dtime, place FROM tt WHERE place = ? ');
$StageTT->bindValue(1,$place,PDO::PARAM_STR);
$StageTT->execute();

header("Content-Type: application/json; charset=utf-8");
$cnt = 0;

foreach($StageTT as $row) {
    $cnt++;
    echo json_encode($row);
    if (count($StageTT) == $cnt) echo ",";
}

exit();
?>
