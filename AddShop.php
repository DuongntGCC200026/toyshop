<script>
    function Shop() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        var phone_pattern = /^(\(0\d{1,3}\)\d{7})|(0\d{9,10})$/;
        var f = document.form1;
        //name
        if (f.txtName.value == "") {
            alert("Enter Shop Name!");
            return false;
        }
        if (format.test(f.txtName.value)) {
            alert("The Shop Name does not contain special characters!");
            return false;
        }
        if (f.txtAdd.value == "") {
            alert("Enter Address!");
            return false;
        }
        if (f.txtPhone.value == "") {
            alert("Enter Phone!");
            return false;
        }
    }
</script>
<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('You must LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=?page=Login"/>';
} else {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != true) {
        echo "<script>alert('You are not administrator')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    } else {
?>
        <?php
        include_once("Connection.php");
        if (isset($_POST["btnAdd"])) {
            $name = $_POST["txtName"];
            $add = $_POST["txtAdd"];
            $phone = $_POST["txtPhone"];

            $sq = "SELECT * FROM public.shop WHERE shop_name = '$name'";
            $result = pg_query($conn, $sq);
            if (pg_num_rows($result) == 0) {
                pg_query($conn, "INSERT INTO shop (shop_name, shop_address, shop_phone) VALUES ('$name','$add','$phone')");
                echo "<script>alert('Adding successfully!');</script>";
                echo '<meta http-equiv= "refresh" content="0;URL=?page=ManagementShop"/>';
            } else {
                echo "<script>alert('Duplicate Shop name!');</script>";
            }
        }
        ?>

        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-3">
                    <h3>MANAGEMENT</h3>
                    <div class="list-group list-group-flush">
                        <a href="?page=ManagementCate" class="list-group-item list-group-item-action py-2">CATEGORY</a>
                        <a href="?page=ManagementSup" class="list-group-item list-group-item-action py-2">SUPPLIER</a>
                        <a href="?page=ManagementShop" class="list-group-item list-group-item-action py-2">SHOP</a>
                        <a href="?page=ManagementPro" class="list-group-item list-group-item-action py-2">PRODUCT</a>
                    </div>
                    <hr class="d-sm-none">

                </div>
                <div class="col-sm-9">
                    <h3 class="text-center">Adding new Shop</h3>
                    <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form" onsubmit="return Shop()">
                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Shop Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="text" name="txtAdd" id="txtAdd" class="form-control" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="text" name="txtPhone" id="txtPhone" class="form-control" placeholder="Phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-12 mt-3 mb-5">
                                <input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" />
                                <input type="button" class="btn btn-primary ms-3" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=AddShop'" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}
?>