<?php
    require "../util/dbconfig_dydgh.php";

    

    

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>상세정보</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles_detailview.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column">
<?php


$m_id = $_GET['m_id'];
$sql = "SELECT * FROM member";
$resultset = $conn->query($sql);
$rows = $resultset->fetch_array();





    $c_id = $_GET['c_id'];
    $sql="SELECT * FROM car WHERE c_id=  ".$c_id;
    $result=$conn->query($sql);
    $row = $result->fetch_assoc();

   
    ?>
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container px-5">
                    <a class="navbar-brand" href="./list.php">중고차사이트</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="./list.php">Home</a></li>
                         
                           
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page Content-->
            <section class="py-5">
                <div class="container px-5">
                    <h1 class="fw-bolder fs-5 mb-4"><?=$row['c_name']?></h1>
                    <div class="card border-0 shadow rounded-3 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row gx-0">
                                <div class="col-lg-6 col-xl-5 py-lg-5">
                                    <div class="p-4 p-md-5">
                                       
                                        <div class="h2 fw-bolder"><?=$row['c_name']?></div>
                                        <table>
   
    
    <tr><th>차종</th><td><?=$row['c_name']?></td></tr>
    <tr><th>크기</th><td><?=$row['c_size']?></td></tr>
    <tr><th>년도</th><td><?=$row['c_date']?></td></tr>
    <tr><th>연료</th><td><?=$row['c_energy']?></td></tr>
    <tr><th>가격</th><td><?=$row['c_price']?></td></tr>
    <tr> <th>회사</th><td><?=$row['c_model']?></td></tr>
        

       </table>
       <a href="buy.php?c_id=<?=$row['c_id']?>&m_id=<?=$m_id?>">구매</a>
    <a href="update.php?c_id=<?=$row['c_id']?>&m_id=<?=$m_id?>">수정</a>
    <a href="delete.php?c_id=<?=$row['c_id']?>&m_id=<?=$m_id?>">삭제</a>
    
                                        
                                          
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-7"><div class="bg-featured-blog" style="background-image: url('../dydgh/uploadfiles/<?=$row['uploadfile']?>')"></div></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>


          <?php
           $result->close();
           $resultset->close();
           ?>


        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">dydgh &copy; Your Website 2021</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="#!">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Terms</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts_detailview.js"></script>
    </body>
</html>
