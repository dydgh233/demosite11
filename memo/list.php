<!-- 
  파일명 : oo_user_loginsuccess.php
  최초작업자 : swcodingschool
  최초작성일자 : 2021-12-28
  업데이트일자 : 2021-12-28
  
  기능: 
  oo_user_registform.html 회원가입화면에서 입력된 값을 받아, validation 후
  users 테이블에 사용자 가입 데이터를 추가한다.
-->

<?php
// db연결 준비
require "../util/dbconfig.php";

// 로그인한 상태일 때만 이 페이지 내용을 확인할 수 있다.
require_once '../util/loginchk.php';
if ($chk_login) {
  $username = $_SESSION['username'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/style3.css">
</head>

<body>
  <h6>현재 로그인된 사용자는 <?= $username ?>님...</h6>

  <h1>메모장 목록</h1>
  <br><br>
  <?php


  // ===========================================
  // 여기부터 pagination용 추가
  // 1. 페이지를 $_GET을 이용하여 전달 받는다. 없으면 현재 $page = 1이다.
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
  }

  // 2. 페이지당 보여줄 리스트 갯수값을 정한다.
  $total_records_per_page = 3;

  // 3. OFFSET을 계산하고 앞/뒤 페이지 등의 변수를 설정한다.
  $offset = ($page_no - 1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = 2;


  // 4. 전체 페이지 수를 계산한다.
  $sql = "SELECT COUNT(*) AS total_records FROM memo";
  $resultset = $conn->query($sql);
  $result = mysqli_fetch_array($resultset);
  $total_records = $result['total_records'];
  $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1;

  // 다음은 pagination을 위해 기존 코드 수정
  // $sql = "SELECT * FROM memo";
  $sql = "SELECT * FROM memo LIMIT " . $offset . ", " . $total_records_per_page;
  $resultset = $conn->query($sql);



  if ($resultset->num_rows > 0) {

    echo "<table><tr><th>id</th><th>제목</th></tr>";

    while ($row = $resultset->fetch_assoc()) {

      echo "<tr><td>" . $row['id'] . "</td><td>" . $row['title'] . "</td><td><a href='detailview.php?id=" . $row['id'] . "'>내용확인</a></tr>";
    }
    echo "</table>";
  }

  ?>

  <div class="box1">
    <a href="createform.html">new</a>
  </div>
  <div class="box2">
    <a href="../index.php">메인으로</a>
  </div>




</body>

<footer>


<ul class="pagination">
  <?php if($page_no > 1){
  echo "<li><a href='?page_no=1'>First Page</a></li>";
  } ?>
      
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no > 1){
  echo "href='?page_no=$previous_page'";
  } ?>>Previous</a>
  </li>
<?php
  
	for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
	if ($counter == $page_no) {
	echo "<li class='active'><a>$counter</a></li>";	
	        }else{
        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                }
        }
?>

  <li <?php if($page_no >= $total_no_of_pages){
  echo "class='disabled'";
  } ?>>
  <a <?php if($page_no < $total_no_of_pages) {
  echo "href='?page_no=$next_page'";
  } ?>>Next</a>
  </li>

  <?php if($page_no < $total_no_of_pages){
  echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
}
  } ?>
  </ul>
</footer>

</html>