<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <h3 class=" mt-5">PRODUCTS</h3>
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
            <div class="row mt-5">
                <?php
                $No = 1; 
                $res = mysqli_query($conn, "SELECT ProductID, ProductName, CategoryName, SmallDes, Price, Image FROM product a, category b 
                                                WHERE a.CategoryID = b.CategoryID");
                if (!$res) {
                    die("Invalid query:  " . mysqli_error($conn));
                }
                while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    if ($No <= 6) {
                ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                            <div class='container-fluid'>
                                <div class=" mx-auto col-md-6 col-10" id="card" style="background-color: white;">
                                    <img class='mx-auto' id="img-thumbnail" src="Images/<?php echo $row['Image'] ?>" width="200px" height="250px" />
                                    <div class=" text-center mx-auto" id="card-body">
                                        <div class='cvp'>
                                            <h5 class="card-title font-weight-bold mt-3"><?php echo $row['ProductName'] ?></h5>
                                            <p class="card-text"><?php echo $row['Price'] ?>$</p>
                                            <a href="?page=ViewPro&&id=<?php echo $row['ProductID']; ?>" class="btn px-auto" id="details">view details</a><br />
                                            <form action="?page=PersonalCart" method="POST">
                                                <input type="hidden" name="Quantity" value="1">
                                                <input class="btn px-auto" id="cart" type="submit" name="AddCart" value="ADD TO CART">
                                                <input type="hidden" name="ProName" value="<?php echo $row['ProductName'] ?>">
                                                <input type="hidden" name="CateName" value="<?php echo $row['CategoryName'] ?>">
                                                <input type="hidden" name="Gender" value="<?php echo $row['SmallDes'] ?>">
                                                <input type="hidden" name="Price" value="<?php echo $row['Price'] ?>">
                                                <input type="hidden" name="Img" value="<?php echo $row['Image'] ?>">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $No++;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>