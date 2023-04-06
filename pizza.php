<?php
// 데이터베이스 연결 정보
$host = "localhost";
$user = "root";
$password = "Seulhee1402!";
$dbname = "pizza";

// 데이터베이스 연결
$conn = mysqli_connect($host, $user, $password, $dbname);

// 연결 확인
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// POST 요청이 들어온 경우
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 각각의 피자 비율을 POST 데이터에서 가져와서 MySQL 데이터베이스에 업데이트
    $pepperoni = $_POST['pepperoni'];
    $cheese = $_POST['cheese'];
    $potato = $_POST['potato'];
    $hawaiian = $_POST['hawaiian'];
    $sweetpotato = $_POST['sweetpotato'];
	$sql = "INSERT INTO `pizza`(`id`, `flavor`, `count`) VALUES ('[value-1]','[value-2]','[value-3]')";

	// $sql = "INSERT INTO pizza (flavor) VALUES ('pepperoni'), ('cheese'), ('potato'), ('hawaiian'), ('sweetpotato')";
}

// MySQL 데이터베이스에서 저장된 피자 비율 데이터 가져오기
$sql = "SELECT * FROM pizza";
$result = mysqli_query($conn, $sql);
$pizza = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        array_push($pizza, [$row['flavor'], $row['count']]);
    }
}

// MySQL 데이터베이스 연결 종료
mysqli_close($conn);
?>

<html>
  
  <head>
    <div id="piechart" style="width: 900px; height: 50px;"></div>

    <!-- 각각의 피자 비율을 입력받는 폼 -->
    <form method="post">
    	페퍼로니 피자: <input type="number" name="pepperoni" value="<?php echo $pizza[0][1]; ?>"><br>
        치즈 피자: <input type="number" name="cheese" value="<?php echo $pizza[1][1]; ?>"><br>
        포테이토 피자: <input type="number" name="potato" value="<?php echo $pizza[2][1]; ?>"><br>
        하와이안 피자: <input type="number" name="hawaiian" value="<?php echo $pizza[3][1]; ?>"><br>
        고구마 피자: <input type="number" name="sweetpotato" value="<?php echo $pizza[4][1]; ?>"><br>
        <input type="submit" value="저장">
    </form>
  </head>
</html>
