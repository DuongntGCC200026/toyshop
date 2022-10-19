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

        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-3">
                    <h3>MANAGEMENT</h3>
                    <div class="list-group list-group-flush">
                        <a href="?page=ManagementCate" class="list-group-item list-group-item-action py-2">CATEGORY</a>
                        <a href="?page=ManagementPro" class="list-group-item list-group-item-action py-2">PRODUCT</a>
                    </div>
                    <hr class="d-sm-none">

                </div>
                <div class="col-sm-9">
                    <?php
                    include_once("Connection.php");
                    function bind_Category_List($conn, $selectedValue)
                    {
                        $sqlstring = "SELECT CategoryID, CategoryName FROM category";
                        $result = mysqli_query($conn, $sqlstring);
                        echo "<select name= 'CategoryList' class='form-control'>
                            <option value = '0'>Choose category</option>";
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            if ($row['CategoryID'] == $selectedValue) {
                                echo "<option value ='" . $row['CategoryID'] . "'selected>" . $row['CategoryName'] . "</option>";
                            } else {
                                echo "<option value ='" . $row['CategoryID'] . "'>" . $row['CategoryName'] . "</option>";
                            }
                        }
                        echo "</select>";
                    }
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                        $sqlstring = "SELECT ProductID, ProductName, CategoryID, Price, Quantity, Image, SmallDes, DetailDes 
                                FROM product WHERE ProductID = '$id'";
                        $result = mysqli_query($conn, $sqlstring);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $proID = $row['ProductID'];
                        $proName = $row['ProductName'];
                        $cate = $row['CategoryID'];
                        $price = $row['Price'];
                        $qty = $row['Quantity'];
                        $img = $row['Image'];
                        $smDes = $row['SmallDes'];
                        $dtDes = $row['DetailDes'];
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
                                <label for="" class="col-sm-2 control-label mt-3">Product category(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <?php echo bind_Category_List($conn, $cate); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lblGia" class="col-sm-2 control-label mt-3">Price(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="number" min="1" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price; ?>' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lblShort" class="col-sm-2 control-label mt-3">Short description(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtShort" id="txtShort" class="form-control" placeholder="Short description" value='<?php echo $smDes; ?>' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lblDetail" class="col-sm-2 control-label mt-3">Detail description(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <textarea name="txtDetail" rows="4" class="ckeditor"><?php echo $dtDes; ?></textarea>
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
                                <label class="col-sm-2 control-label mt-3">Quantity(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="number" min="1" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="<?php echo $qty; ?>" />
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
                            $short = $_POST["txtShort"];
                            $detail = $_POST["txtDetail"];
                            $price = $_POST["txtPrice"];
                            $qty = $_POST["txtQty"];
                            $pic = $_FILES["txtImage"];
                            $category = $_POST["CategoryList"];

                            if ($pic['name'] != "") {
                                if (
                                    $pic['type'] == "image/jpg" || $pic['type'] == "image/jpeg" || $pic['type'] == "image/png"
                                    || $pic['type'] == "image/gif"
                                ) {
                                    if ($pic['size'] <= 614400) {
                                        $sq = "SELECT * FROM product WHERE ProductID !='$id' AND ProductName = '$proname'";
                                        $result = mysqli_query($conn, $sq);
                                        if (mysqli_num_rows($result) == 0) {
                                            copy($pic['tmp_name'], "Images/" . $pic['name']);
                                            $filePic = $pic['name'];
                                            $sqlstring = "UPDATE product SET
                                                ProductName = '$proname', 
                                                CategoryID = '$category', 
                                                Price = '$price', 
                                                Quantity = $qty, 
                                                Image = '$filePic', 
                                                SmallDes ='$short', 
                                                DetailDes = '$detail', 
                                                ProDate = '" . date('Y-m-d H:i:s') . "'
                                                WHERE 
                                                ProductID = '$id'";
                                            mysqli_query($conn, $sqlstring);
                                            echo "<script>alert('Updating successfully!')</script>";
                                            echo '<meta http-equiv="refresh" content = "5, URL=?page=ManagementPro"/>';
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
                                $sq = "SELECT * FROM product WHERE ProductID !='$id' AND ProductName = '$proname'";
                                $result = mysqli_query($conn, $sq);
                                if (mysqli_num_rows($result) == 0) {
                                    $sqlstring = "UPDATE product SET
                                                ProductName = '$proname', 
                                                CategoryID = '$category', 
                                                Price = '$price', 
                                                Quantity = $qty, 
                                                SmallDes ='$short', 
                                                DetailDes = '$detail', 
                                                ProDate = '" . date('Y-m-d H:i:s') . "'
                                                WHERE 
                                                ProductID = '$id'";
                                    mysqli_query($conn, $sqlstring);
                                    echo "<script>alert('Updating successfully!')</script>";
                                    echo '<meta http-equiv="refresh" content = "5, URL=?page=ManagementPro"/>';
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