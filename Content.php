<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <h3 class=" mt-5">SUPPLIERS</h3>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action py-2">ALL</a>
                <?php
                $res = pg_query($conn, "SELECT * FROM public.supplier");
                if (!$res) {
                    die("Invalid query:  " . pg_errormessage($conn));
                }
                while ($row = pg_fetch_array($res)) {
                ?>
                    <a href="?page=SearchProduct&&sup_id=<?php echo $row['sup_id'] ?>" class="list-group-item list-group-item-action py-2 text-uppercase" ><?php echo $row['sup_name']; ?></a>
                <?php
                }
                ?>
            </div>
            <hr class="d-sm-none">  

            <h3 class="mt-5">CATEGORIES</h3>  
            <div class="list-group list-group-flush">
                <?php
                $res = pg_query($conn, "SELECT * FROM public.category");
                if (!$res) {
                    die("Invalid query:  " . pg_errormessage($conn));
                }
                while ($row = pg_fetch_array($res)) {
                ?>
                    <a href="?page=SearchProduct&&cate_id=<?php echo $row['cate_id'] ?>" class="list-group-item list-group-item-action py-2 text-uppercase"><?php echo $row['cate_name']; ?></a>
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
                $res = pg_query($conn, "SELECT * FROM product a, supplier b, category d
                                                    WHERE a.sup_id = b.sup_id AND a.cate_id = d.cate_id");
                if (!$res) {
                    die("Invalid query:  " . pg_errormessage($conn));
                }
                while ($row = pg_fetch_array($res)) {
                    if ($No <= 18) {
                ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                            <div class='container-fluid'>
                                <div class=" mx-auto col-md-6 col-10" id="card" style="background-color: white;">
                                    <img class='mx-auto' id="img-thumbnail" src="Images/<?php echo $row['img'] ?>" width="200px" height="250px" />
                                    <div class=" text-center mx-auto" id="card-body">
                                        <div class='cvp'>
                                            <h5 class="card-title font-weight-bold mt-3 text-uppercase"><?php echo $row['pro_name'] ?></h5>
                                            <p class="card-text"><?php echo $row['price'] ?>$</p>
                                            <a href="?page=ViewPro&&id=<?php echo $row['pro_id']; ?>" class="btn px-auto" id="details">view details</a><br />
                                            <form action="?page=PersonalCart" method="POST">
                                                <input type="hidden" name="Quantity" value="1">
                                                <input class="btn px-auto" id="cart" type="submit" name="AddCart" value="ADD TO CART">
                                                <input type="hidden" name="ProName" value="<?php echo $row['pro_name'] ?>">
                                                <input type="hidden" name="CateName" value="<?php echo $row['cate_name'] ?>"> 
                                                <input type="hidden" name="SupName" value="<?php echo $row['sup_name'] ?>">
                                                <input type="hidden" name="Price" value="<?php echo $row['price'] ?>">
                                                <input type="hidden" name="Img" value="<?php echo $row['img'] ?>">
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