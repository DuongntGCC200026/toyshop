<div class="container mt-5">
    <div class="row">
        <div class="col-sm-3">
            <h3>PRODUCTS</h3>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action py-2">All</a>
                <a href="?page=SearchProduct&&gender=man" class="list-group-item list-group-item-action py-2">MAN</a>
                <a href="?page=SearchProduct&&gender=woman" class="list-group-item list-group-item-action py-2">WOMAN</a>
            </div>
            <hr class="d-sm-none">

            <h3 class="mt-5">CATEGORIES</h3>
            <div class="list-group list-group-flush">
                <?php
                $res = mysqli_query($conn, "SELECT * FROM category");
                if (!$res) {
                    die("Invalid query:  " . mysqli_error($conn));
                }
                while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                ?>
                    <a href="?page=SearchProduct&&id=<?php echo $row['CategoryID'] ?>" class="list-group-item list-group-item-action py-2"><?php echo $row['CategoryName']; ?></a>
                <?php
                }
                ?>
            </div>
            <hr class="d-sm-none">
        </div>
        <div class="col-sm-9">
            <div class="row">
                <?php
                if (isset(($_GET['id']))) {
                    $id = $_GET['id'];
                    $No = 1;
                    $res = mysqli_query($conn, "SELECT * FROM product WHERE CategoryID = '$id'");
                    if (!$res) {
                        die("Invalid query:  " . mysqli_error($conn));
                    }
                    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                        if ($No <= 6) {
                ?>
                            <div class="col-sm-4 mt-5 mb-5">
                                <div class='container-fluid'>
                                    <div class=" mx-auto col-md-6 col-10" id="card">
                                        <img class='mx-auto' id="img-thumbnail" src="Images/<?php echo $row['Image'] ?>" width="200px" height="250px" />
                                        <div class=" text-center mx-auto" id="card-body">
                                            <div class='cvp'>
                                                <h5 class="card-title font-weight-bold mt-3"><?php echo $row['ProductName'] ?></h5>
                                                <p class="card-text"><?php echo $row['Price'] ?>$</p>
                                                <a href="?page=ViewPro&&id=<?php echo $row['ProductID']; ?>" class="btn px-auto" id="details"><i class="bi bi-eye"></i> view details</a><br />
                                                <a href="?page=PersonalCart&&id=<?php echo $row['ProductID'] ?>" class="btn px-auto" id="cart"><i class="bi bi-cart-check"></i> ADD TO CART</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                            $No++;
                        }
                    }
                }
                ?>
                <?php
                if (isset(($_GET['gender']))) {
                    $gender = $_GET['gender'];
                    $No = 1;
                    $res = mysqli_query($conn, "SELECT * FROM product WHERE SmallDes = '$gender'");
                    if (!$res) {
                        die("Invalid query:  " . mysqli_error($conn));
                    }
                    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                        if ($No <= 6) {
                ?>
                            <div class="col-sm-4 mt-5 mb-5">
                                <div class='container-fluid'>
                                    <div class=" mx-auto col-md-6 col-10" id="card">
                                        <img class='mx-auto' id="img-thumbnail" src="Images/<?php echo $row['Image'] ?>" width="200px" height="250px" />
                                        <div class=" text-center mx-auto" id="card-body">
                                            <div class='cvp'>
                                                <h5 class="card-title font-weight-bold mt-3"><?php echo $row['ProductName'] ?></h5>
                                                <p class="card-text"><?php echo $row['Price'] ?>$</p>
                                                <a href="?page=ViewPro&&id=<?php echo $row['ProductID']; ?>" class="btn px-auto" id="details"><i class="bi bi-eye"></i> view details</a><br />
                                                <a href="?page=PersonalCart&&id=<?php echo $row['ProductID'] ?>" class="btn px-auto" id="cart"><i class="bi bi-cart-check"></i> ADD TO CART</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                            $No++;
                        }
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>