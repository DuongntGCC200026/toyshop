<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TD Shop - Toys</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    session_start();
    include_once("Connection.php");
    ?>
    <div class="container" style="background-color:rgb(209, 225, 231);">
        <header>
            <div class="d-flex justify-content-center h-100 col-12">
                <a role="button" href="index.php" class="control text-decoration-none">
                    <img src="Images/pixlr-bg-result.png" alt="LOGO">
                    <span class="ms-4 text-light">TD Shop - Toy</span>
                </a>
            </div>
            <div class="text-white" id="header">
                <div class="productPanel">
                    <div class="product">
                        <div class="productThumb">
                            <img src="Images/1.jpg" alt="">
                            <img src="Images/2.jpg" alt="">
                            <img src="Images/3.png" alt="">
                            <img src="Images/4.jpg" alt="">
                            <img src="Images/5.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <nav class="navbar navbar-light navbar-expand-md bg-light justify-content-md-center justify-content-start">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar2">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-between align-items-center w-100" id="collapsingNavbar2">
                <ul class="navbar-nav mx-auto text-md-center text-left">
                    <li class="nav-item" id="navEl">
                        <a class="nav-link" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item" id="navEl">
                        <a class="nav-link" href="?page=ManagementCate">MANAGEMENT</a>
                    </li>
                    <li class="nav-item" id="navEl">
                        <a class="nav-link" href="?page=AboutUS">ABOUT US</a>
                    </li>
                    
                    <?php
                    if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=PersonalCart" id="btnUser"><i class="bi bi-person-circle"></i> Hi, <?php echo $_SESSION['us'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=Logout" id="btnLogout">LOGOUT <i class="bi bi-box-arrow-right"></i></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=Register" id="btnSignup">REGISTER&nbsp;<i class="bi bi-person-plus"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=Login" id="btnLogin">LOGIN&nbsp;<i class="bi bi-box-arrow-in-right"></i></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
        <?php
        if (isset(($_GET['page']))) {
            $page = $_GET['page'];
            if ($page == "AboutUS") {
                include_once("AboutUS.php");
            } elseif ($page == "Register") {
                include_once("Register.php");
            } elseif ($page == "ManagementPro") {
                include_once("ManagementPro.php");
            } elseif ($page == "ManagementCate") {
                include_once("ManagementCate.php");
            } elseif ($page == "logout") {
                include_once("Logout.php");
            } elseif ($page == "AddCategory") {
                include_once("AddCategory.php");
            } elseif ($page == "UpdateCate") {
                include_once("UpdateCate.php");
            } elseif ($page == "AddProduct") {
                include_once("AddProduct.php");
            } elseif ($page == "UpdatePro") {
                include_once("UpdatePro.php");
            } elseif ($page == "PersonalCart") {
                include_once("PersonalCart.php");
            } elseif ($page == "PersonalInf") {
                include_once("PersonalInf.php");
            } elseif ($page == "ViewPro") {
                include_once("ViewPro.php");
            } elseif ($page == "SearchProduct") {
                include_once("SearchProduct.php");
            } elseif ($page == "WomanProduct") {
                include_once("WomanProduct.php");
            } elseif ($page == "Login") {
                include_once("Login.php");
            } elseif ($page == "Logout") {
                include_once("Logout.php");
            }
        } else {
            include("Content.php");
        }
        ?>

        <!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                    <span style="color: gray;">Get connected with us on social networks:</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="https://www.facebook.com" class="me-4 text-reset" target="_blank" style="display: inline-block;">
                        <i class="bi bi-facebook" style="color: #3B5998;" title="Facebook"></i>
                    </a>
                    <a href="https://twitter.com" class="me-4 text-reset" target="_blank" style="display: inline-block;">
                        <i class="bi bi-twitter" style="color: #1DA1F2;" title="Twitter"></i>
                    </a>
                    <a href="https://gmail.com" class="me-4 text-reset" target="_blank" style="display: inline-block;">
                        <i class="bi bi-google" style="color: rgb(11, 168, 11);" title="Google"></i>
                    </a>
                    <a href="https://www.instagram.com/?hl=en" class="me-4 text-reset" target="_blank" style="display: inline-block;">
                        <i class="bi bi-instagram" style="color: #CD486B;" title="Instagram"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="footer2">
                <div class="container text-center text-md-start mt-0">
                    <!-- Grid row -->
                    <div class="row mt-0 ">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-0 mt-2">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="bi bi-shop"></i>&nbsp;TD - SHOP
                            </h6>
                            <p>
                                The most prestigious perfume selling website in Vietnam.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-0 mt-2" id="footer2">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Products
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">MAN</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">WOMEN</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-0 mt-2">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Category
                            </h6>
                            <?php
                            $res = mysqli_query($conn, "SELECT * FROM category");
                            if (!$res) {
                                die("Invalid query:  " . mysqli_error($conn));
                            }
                            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                            ?>
                                <p>
                                    <a href="?page=SearchProduct&&id=<?php echo $row['CategoryID'] ?>" class="text-reset"><?php echo $row['CategoryName']; ?></a>
                                </p>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-0 mt-2">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Contact
                            </h6>
                            <p><i class="bi bi-house-fill me-3"></i>Can Tho, Vietnam</p>
                            <p><i class="bi bi-envelope me-3"></i>Duongntgcc200026@fpt.edu.vn</p>
                            <p><i class="bi bi-phone me-3"></i>+ 84 375 741 165</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
                <div style="height: 50px;">
                    <p style="text-align: center; font-size: larger;">© 2022 Copyright</p>
                </div>
            </section>
            <!-- Section: Links  -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        </footer>
        <!-- Footer -->
    </div>
</body>

</html>