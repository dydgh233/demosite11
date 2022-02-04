<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      .eachcmt {
        border:1px solid gray;
      }
      .cmtcontents {
        width: 80%;
      }
      .cmtupdate{
        display: none;
      }
      .active {
        background-color : red;
      }
    </style>
    <title>Document</title>

</head>
<body>
<?php

  $login_username = "댓글러";
  $conn = new mysqli("localhost", "remind", "remind", "remind");

  $id = $_GET['id'];

  // 2022-01-21 조인질의 처리 예제 보여주기
  // 원래 직원 정보 상세 정보 조회용 질의는 이렇게 구성되었음
  // $sql = "SELECT * FROM employee WHERE id = ".$id;
  // 위 질의를 아래와 같이 수정함
  // 아래 질의에서 주목할 것은 부서명과 부서전화번호 검색이 가능해졌다는 것!
  // 조인을 위해 INNER JOIN절이 추가 되었음을 보는 것... 테이블 이름을 e, d로 별칭 부여한 것!!
  $sql = "SELECT emp_name, emp_number, emp_phone, emp_hiredate, dept_name, dept_phone, emp_address, emp_email
          FROM employee as e
          INNER JOIN department as d
            ON e.emp_deptcode = d.dept_code 
          WHERE id = ".$id;
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
?>
<h1>개인정보 상세 보기</h1>
<!--
  // 2022-01-21 조인에 의한 정보 조회 예제 보여주기 ============================
  // 개인 정보 보여주는 방식도 항목별 한 라인씩 출력되도록 변경함
 -->
 <hr>
<p><b>사원이름:  </b><?=$row['emp_name']?></p>
<p><b>사원번호:  </b><?=$row['emp_number']?></p>
<p><b>부 서 명:  </b><?=$row['dept_name']?></p>  <!-- 바로 이 필드 추가하기 위한 것임!!-->
<p><b>부서전화:  </b><?=$row['dept_phone']?></p> <!-- 바로 이 필드 추가하기 위한 것임!!-->
<p><b>전화번호:  </b><?=$row['emp_phone']?></p>
<p><b>채용일자:  </b><?=$row['emp_hiredate']?></p>
<p><b>사원주소:  </b><?=$row['emp_address']?></p>
<p><b>이 메 일:  </b><?=$row['emp_email']?></p>
<hr>
<a href="update.php?id=<?=$id?>">수정</a>
<a href="delete_process.php?id=<?=$id?>">삭제</a>
<a href="list.php">목록으로</a>
<hr>
<!--여기부터 댓글 처리 -->
<!-- 새 댓글 등록 FORM -->
<form action="comment_process.php" method="POST">
  <input type="hidden" name="writer" value="<?=$login_username?>"><br>
  <input type="hidden" name="emp_id" value="<?=$id?>"><br>
  <input type="text" name="contents"><br>
  <input type="submit" value="저장">
</form>
<hr>
<?php
  // 코멘트 테이블에서 emp_id가 본 글(employess)의 id와 같은 것만 검색
  // 댓글 리스트 처리
  $sql = "SELECT * FROM comment WHERE emp_id= ".$id;
  $resultset = $conn->query($sql);
  while($row = $resultset->fetch_assoc()){
    $cmt_id = $row['cmt_id'];
  ?>
    <div class="eachcmt">
      <p class="cmtwriter"><?=$row['cmt_writer']?></p>
      <p class="cmtcontents"><?=$row['cmt_contents']?></p>
      <a href="cmt_delete_process.php?cmt_id=<?=$cmt_id?>&emp_id=<?=$id?>">삭제</a>
      <button class="accordion">수정</button> &nbsp;&nbsp;&nbsp;
      <div class="cmtupdate">
        <form action="cmt_update_process.php" method="POST">
          <input type="hidden" name="emp_id" value="<?=$id?>">
          <input type="hidden" name="cmt_id" value="<?=$cmt_id?>">
          <label>댓글내용</label>
          <input type="text" name="cmt_contents" value="<?=$row['cmt_contents']?> ">
          <input type="submit" value="수정">
        </form>
      </div>
      
    </div>

    
  <?php
  }
  // resource 반납
  $result->close();
  $resultset->close();
  $conn->close();
?>
<script>
  var acc = document.getElementsByClassName("accordion");
  var i;

  for(i=0; i < acc.length; i++){
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");

      var target = this.nextElementSibling;
      if(target.style.display === "block"){
        target.style.display = "none";
      }else {
        target.style.display = "block";
      }
    });
  }
</script>
</body>
</html>