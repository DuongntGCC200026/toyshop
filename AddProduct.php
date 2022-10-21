<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script>
    function Product() {
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
        //img
        if (f.txtImage.value == "") {
            alert("Choose image please!");
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
        function bind_Category_List($conn)
        {
            $sqlstring = "SELECT * FROM public.category";
            $result = pg_query($conn, $sqlstring);
            echo "<select name= 'CategoryList' class='form-control'>
				<option value = '0'>Choose Category</option>";
            while ($row = pg_fetch_array($result)) {
                echo "<option value ='" . $row['cate_id'] . "'>" . $row['cate_name'] . "</option>";
            }
            echo "</select>";
        }
        function bind_Sup_List($conn)
        {
            $sqlstring = "SELECT * FROM public.supplier";
            $result = pg_query($conn, $sqlstring);
            echo "<select name= 'SupplierList' class='form-control'>
				<option value = '0'>Choose Supplier</option>";
            while ($row = pg_fetch_array($result)) {
                echo "<option value ='" . $row['sup_id'] . "'>" . $row['sup_name'] . "</option>";
            }
            echo "</select>";
        }
        function bind_Shop_List($conn)
        {
            $sqlstring = "SELECT * FROM public.shop";
            $result = pg_query($conn, $sqlstring);
            echo "<select name= 'ShopList' class='form-control'>
				<option value = '0'>Choose Shop</option>";
            while ($row = pg_fetch_array($result)) {
                echo "<option value ='" . $row['shop_id'] . "'>" . $row['shop_name'] . "</option>";
            }
            echo "</select>";
        }
        if (isset($_POST["btnAdd"])) {
            $proname = $_POST["txtName"];
            $des = $_POST["txtDetail"];
            $price = $_POST["txtPrice"];
            $qty = $_POST["txtQty"];
            $pic = $_FILES["txtImage"];
            $category = $_POST["CategoryList"];
            $sup = $_POST["SupplierList"];
            $shop = $_POST["ShopList"];

            if (
                $pic['type'] == "image/jpg" || $pic['type'] == "image/jpeg" || $pic['type'] == "image/png"
                || $pic['type'] == "image/gif"
            ) {
                if ($pic['size'] <= 614400) {
                    $sq = "SELECT * FROM public.product WHERE pro_name = '$proname'";
                    $result = pg_query($conn, $sq);
                    if (pg_num_rows($result) == 0) {
                        copy($pic['tmp_name'], "Images/" . $pic['name']);
                        $filePic = $pic['name'];
                        $sqlstring = "INSERT INTO product (pro_name,quatity,price,img,descrip,sup_id,cate_id,shop_id) 
                            VALUES ('$proname',$qty,$price,'$filePic','$des','$sup','$category','$shop')";
                        pg_query($conn, $sqlstring);
                        echo "<script>alert('Adding new product successfully!');</script>";
                        echo '<meta http-equiv="refresh" content = "0, URL=?page=ManagementPro"/>';
                    } else {
                        echo "<script>alert('Product ID or Product Name is already exist!');</script>";
                    }
                } else {
                    echo "<script>alert('Size of image too big!');</script>";
                }
            } else {
                echo "<script>alert('Image format is not correct!');</script>";
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
                    <h3 class="text-center">Adding new Product</h3>

                    <form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form" onsubmit="return Product()">
                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='' />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <?php bind_Sup_List($conn); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <?php bind_Category_List($conn); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <?php bind_Shop_List($conn); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="number" name="txtQty" id="txtQty" min="1" class="form-control" placeholder="Quantity" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="number" name="txtPrice" id="txtPrice" min="1" class="form-control" placeholder="Price" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lblDetail" class="col-sm-2 control-label mt-3">Detail description(*): </label>
                            <div class="col-sm-12">
                                <textarea name="txtDetail" rows="4" class="ckeditor"></textarea>
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
                            <div class="col-sm-12 mt-3">
                                <input type="file" name="txtImage" id="txtImage" class="form-control mt-3" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-12 mt-3 mb-5">
                                <input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" />
                                <input type="button" class="btn btn-primary ms-3" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=AddProduct'" />

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