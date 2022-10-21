<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script>
    function Updateproduct() {
        var validname = /^[A-Za-z]+|(\s)$/;
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        f = document.frmProduct;
        //name
        if (f.txtName.value == "") {
            alert("Enter Product Name please!");
            return false;
        }
        if (format.test(f.txtName.value)) {
            alert("The Product Name does not contain special characters!");
            return false;
        }
        //cate
        if (f.SupplierList.value == "0") {
            alert("Choose Supplier Name please!");
            return false;
        }
        if (f.CategoryList.value == "0") {
            alert("Choose Category Name please!");
            return false;
        }
        if (f.ShopList.value == "0") {
            alert("Choose Shop Name please!");
            return false;
        }
        //
        if (f.txtPrice.value == "") {
            alert("Enter Product Price please!");
            return false;
        }
        //small description
        if (f.txtShort.value != "Man" && f.txtShort.value != "Woman") {
            alert("Small description just is 'Man' or 'Woman'");
            return false;
        }
        //detailDescrip
        if (f.txtDetail.value == "") {
            alert("Enter detail description please!");
            return false;
        }
        //
        if (f.txtQty.value == "") {
            alert("Enter Product quantity please!");
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
                    <?php
                    include_once("Connection.php");
                    function bind_Category_List($conn, $selectedValue)
                    {
                        $sqlstring = "SELECT * FROM public.category";
                        $result = pg_query($conn, $sqlstring);
                        echo "<select name= 'CategoryList' class='form-control'>
                            <option value = '0'>Choose Category</option>";
                        while ($row = pg_fetch_array($result)) {
                            if ($row['cate_id'] == $selectedValue) {
                                echo "<option value ='" . $row['cate_id'] . "'selected>" . $row['cate_name'] . "</option>";
                            } else {
                                echo "<option value ='" . $row['cate_id'] . "'>" . $row['cate_name'] . "</option>";
                            }
                        }
                        echo "</select>";
                    }
                    function bind_Sup_List($conn, $selectedValue)
                    {
                        $sqlstring = "SELECT * FROM public.supplier";
                        $result = pg_query($conn, $sqlstring);
                        echo "<select name= 'SupplierList' class='form-control'>
                            <option value = '0'>Choose Supplier</option>";
                        while ($row = pg_fetch_array($result)) {
                            if ($row['sup_id'] == $selectedValue) {
                                echo "<option value ='" . $row['sup_id'] . "'selected>" . $row['sup_name'] . "</option>";
                            } else {
                                echo "<option value ='" . $row['sup_id'] . "'>" . $row['sup_name'] . "</option>";
                            }
                        }
                        echo "</select>";
                    }
                    function bind_Shop_List($conn, $selectedValue)
                    {
                        $sqlstring = "SELECT * FROM public.shop";
                        $result = pg_query($conn, $sqlstring);
                        echo "<select name= 'ShopList' class='form-control'>
                            <option value = '0'>Choose Shop</option>";
                        while ($row = pg_fetch_array($result)) {
                            if ($row['shop_id'] == $selectedValue) {
                                echo "<option value ='" . $row['shop_id'] . "'selected>" . $row['shop_name'] . "</option>";
                            } else {
                                echo "<option value ='" . $row['shop_id'] . "'>" . $row['shop_name'] . "</option>";
                            }
                        }
                        echo "</select>";
                    }
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                        $sqlstring = "SELECT * FROM public.product WHERE pro_id = '$id'";
                        $result = pg_query($conn, $sqlstring);
                        $row = pg_fetch_array($result);
                        $proID = $row['pro_id'];
                        $proName = $row['pro_name'];
                        $cate = $row['cate_id'];
                        $price = $row['price'];
                        $qty = $row['quatity'];
                        $img = $row['img'];
                        $Des = $row['descrip'];
                        $sup = $row['sup_id'];
                        $shop = $row['shop_id'];
                    ?>
                        <h3 class="text-center">Updating Product</h3>

                        <form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form" onsubmit="return Updateproduct()">
                            <div class="form-group">
                                <label for="txtTen" class="col-sm-2 control-label">Product ID(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" readonly value='<?php echo $proID; ?>' />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtTen" class="col-sm-2 control-label mt-3">Product Name(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='<?php echo $proName; ?>' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label mt-3">Supplier(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <?php echo bind_Sup_List($conn, $sup); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label mt-3">Category(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <?php echo bind_Category_List($conn, $cate); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label mt-3">Shop(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <?php echo bind_Shop_List($conn, $shop); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label mt-3">Quantity(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="number" min="1" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="<?php echo $qty; ?>" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lblGia" class="col-sm-2 control-label mt-3">Price(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="number" min="1" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price; ?>' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lblDetail" class="col-sm-2 control-label mt-3">Detail description(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <textarea name="txtDetail" rows="4" class="ckeditor"><?php echo $Des; ?></textarea>
                                    <script language="javascript">
                                        CKEDITOR.replace('txtDetail', {
                                            skin: 'kama',
                                            extraPlugins: 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar: [
                                                ['Source', 'DocProps', '-', 'Save', 'NewPage', 'Preview', '-', 'Templates'],
                                                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteWord', '-', 'Print', 'SpellCheck'],
                                                ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
                                                ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
                                                ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Subscript', 'Superscript'],
                                                ['OrderedList', 'UnorderedList', '-', 'Outdent', 'Indent', 'Blockquote'],
                                                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'],
                                                ['Link', 'Unlink', 'Anchor', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
                                                ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                                ['Style', 'FontFormat', 'FontName', 'FontSize'],
                                                ['TextColor', 'BGColor'],
                                                ['UIColor']
                                            ]
                                        });
                                    </script>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label mt-3">Image(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <img src='Images/<?php echo "$img" ?>' border='0' width="50" height="50" />
                                    <input type="file" name="txtImage" id="txtImage" class="form-control mt-3" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10  mt-3 mb-5">
                                    <input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
                                    <input type="button" class="btn btn-primary ms-4" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=ManagementPro'" />

                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST["btnUpdate"])) {
                            $id = $_POST["txtID"];
                            $proname = $_POST["txtName"];
                            $des = $_POST["txtDetail"];
                            $price = $_POST["txtPrice"];
                            $qty = $_POST["txtQty"];
                            $pic = $_FILES["txtImage"];
                            $category = $_POST["CategoryList"];
                            $sup = $_POST["SupplierList"];
                            $shop = $_POST["ShopList"];

                            if ($pic['name'] != "") {
                                if (
                                    $pic['type'] == "image/jpg" || $pic['type'] == "image/jpeg" || $pic['type'] == "image/png"
                                    || $pic['type'] == "image/gif"
                                ) {
                                    if ($pic['size'] <= 614400) {
                                        $sq = "SELECT * FROM public.product WHERE pro_id !='$id' AND pro_name = '$proname'";
                                        $result = pg_query($conn, $sq);
                                        if (pg_num_rows($result) == 0) {
                                            copy($pic['tmp_name'], "Images/" . $pic['name']);
                                            $filePic = $pic['name'];
                                            $sqlstring = "UPDATE product SET
                                                pro_name = '$proname',
                                                quatity = '$qty',
                                                price = '$price',
                                                img = '$filePic',
                                                descrip = '$des',
                                                sup_id = '$sup',
                                                cate_id = '$category',
                                                shop_id = '$shop'
                                                WHERE 
                                                pro_id = '$id'";
                                            pg_query($conn, $sqlstring);
                                            echo "<script>alert('Updating successfully!')</script>";
                                            echo '<meta http-equiv="refresh" content = "0, URL=?page=ManagementPro"/>';
                                        } else {
                                            echo "<script>alert('Duplicate product name')</script>";
                                        }
                                    } else {
                                        echo "<script>alert('Size of image too big')</script>";
                                    }
                                } else {
                                    echo "<script>alert('Image format is not correct')</script>";
                                }
                            } else {
                                $sq = "SELECT * FROM public.product WHERE pro_id !='$id' AND pro_name = '$proname'";
                                $result = pg_query($conn, $sq);
                                if (pg_num_rows($result) == 0) {
                                    $sqlstring = "UPDATE product SET
                                                pro_name = '$proname',
                                                quatity = '$qty',
                                                price = '$price',
                                                descrip = '$des',
                                                sup_id = '$sup',
                                                cate_id = '$category',
                                                shop_id = '$shop'
                                                WHERE 
                                                pro_id = '$id'";
                                    pg_query($conn, $sqlstring);
                                    echo "<script>alert('Updating successfully!')</script>";
                                    echo '<meta http-equiv="refresh" content = "0, URL=?page=ManagementPro"/>';
                                } else {
                                    echo "<script>alert('Duplicate product name')</script>";
                                }
                            }
                        }
                        ?>
                    <?php
                    } else {
                        echo '<meta http-equiv="refresh" content=0; URL=?page=ManagementPro"/>';
                    }
                    ?>
                </div>
            </div>
        </div>
<?php
    }
}
?>