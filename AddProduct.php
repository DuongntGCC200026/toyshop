<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script>
    function Product() {
        var validname = /^[A-Za-z]+|(\s)$/;
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        f = document.frmProduct;
        //id
        if (f.txtID.value == "") {
            alert("Enter Product ID please!");
            return false;
        }
        if (format.test(f.txtID.value)) {
            alert("The Product ID does not contain special characters!");
            return false;
        }
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
        if (f.CategoryList.value == "0") {
            alert("Choose Category Name please!");
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
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
        echo "<script>alert('You are not administrator')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    } else {
?>
        <?php
        include_once("Connection.php");
        function bind_Category_List($conn)
        {
            $sqlstring = "SELECT CategoryID, CategoryName FROM category";
            $result = mysqli_query($conn, $sqlstring);
            echo "<select name= 'CategoryList' class='form-control'>
				<option value = '0'>Choose category</option>";
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<option value ='" . $row['CategoryID'] . "'>" . $row['CategoryName'] . "</option>";
            }
            echo "</select>";
        }
        if (isset($_POST["btnAdd"])) {
            $id = $_POST["txtID"];
            $proname = $_POST["txtName"];
            $short = $_POST["txtShort"];
            $detail = $_POST["txtDetail"];
            $price = $_POST["txtPrice"];
            $qty = $_POST["txtQty"];
            $pic = $_FILES["txtImage"];
            $category = $_POST["CategoryList"];

            if (
                $pic['type'] == "image/jpg" || $pic['type'] == "image/jpeg" || $pic['type'] == "image/png"
                || $pic['type'] == "image/gif"
            ) {
                if ($pic['size'] <= 614400) {
                    $sq = "SELECT * FROM product WHERE ProductID ='$id' or ProductName = '$proname'";
                    $result = mysqli_query($conn, $sq);
                    if (mysqli_num_rows($result) == 0) {
                        copy($pic['tmp_name'], "Images/" . $pic['name']);
                        $filePic = $pic['name'];
                        $sqlstring = "INSERT INTO product (
							ProductID, ProductName, CategoryID, Price, Quantity, Image, SmallDes, DetailDes, ProDate) 
                            VALUES	('$id','$proname','$category','$price',$qty,'$filePic','$short','$detail','" . date('Y-m-d H:i:s') . "')";
                        mysqli_query($conn, $sqlstring);
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
                            <div class="col-sm-12 mt-5">
                                <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" value='' />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='' />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <?php bind_Category_List($conn); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="number" name="txtPrice" id="txtPrice" min="1" class="form-control" placeholder="Price"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="text" name="txtShort" id="txtShort" class="form-control" placeholder="Short description" value='' />
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
                                <input type="number" name="txtQty" id="txtQty" min="1" class="form-control" placeholder="Quantity"/>
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