<script>
    function Checking() {
        var validname = /^[A-Za-z]+|(\s)$/;
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        var phone_pattern = /^(\(0\d{1,3}\)\d{7})|(0\d{9,10})$/;
        var f = document.form1;
        if (validname.test(f.txtCusname.value) == false || format.test(f.txtCusname.value)) {
            alert("The fullname does not contain special characters or number!");
            return false;
        }
        if (f.txtCurPass.value != "") {
            if ((f.txtPass.value).length <= 6 || (f.txtRepass.value).length <= 6) {
                alert("Password must be more than 6 characters!");
                return false;
            }
        }
        //identity
        if (format.test(f.txtIdentitycard.value)) {
            alert("The identity card does not contain special characters!");
            return false;
        }
        if (isNaN(f.txtIdentitycard.value)) {
            alert("The identity card does not contain characters!");
            return false;
        }
        //phone
        if (phone_pattern.test(f.txtCusphone.value) == false) {
            alert("The phone number is invalid!");
            return false;
        }
    }
</script>
<?php
include_once("Connection.php");
$query = "SELECT Cusname, Identitycard, Cusphone, Address 
                FROM customer WHERE Username = '" . $_SESSION["us"] . "'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$us = $_SESSION["us"];
$name = $row["Cusname"];
$iden = $row["Identitycard"];
$phone = $row["Cusphone"];
$address = $row["Address"];

if (isset($_POST['btnUpdate'])) {
    $crupass = $_POST["txtCurPass"];
    $passnew = $_POST["txtPass"];
    $repass = $_POST['txtRepass'];
    $name = $_POST["txtCusname"];
    $iden = $_POST["txtIdentitycard"];
    $phone = $_POST["txtCusphone"];
    $address = $_POST["txtAddress"];

    if ($crupass != "") {
        if ($passnew == "" || $repass == "") {
            echo "<script>alert('New password and confirm passwrod can not be blank!')</script>";
        } elseif ($passnew == $repass) {
            $sql = "SELECT Password FROM customer WHERE Username = '" . $_SESSION["us"] . "'";
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
            $oldpass = $rows["Password"];
            $tempPass = md5($crupass);

            if ($oldpass == $tempPass) {
                $pa = md5($passnew);
                $sq = "UPDATE customer
                SET Password = '$pa',
                    Cusname = '$name',
                    Identitycard = '$iden',
                    Cusphone = '$phone',
                    Address = '$address'
                WHERE Username ='" . $_SESSION['us'] . "'";
                mysqli_query($conn, $sq) or die(mysqli_error($conn));
                echo "<script>alert('Updating successfully!')</script>";
                echo '<meta http-equiv="refresh" content="5;URL=index.php"';
            } else {
                echo "<script>alert('Current password incorrect!')</script>";
            }
        } else {
            echo "<script>alert('New password and confirm password is incorrect!')</script>";
        }
    } else {
        $sq = "UPDATE customer
                    SET Cusname = '$name',
                        Identitycard = '$iden',
                        Cusphone = '$phone',
                        Address = '$address'
            WHERE Username ='" . $_SESSION['us'] . "'";
        mysqli_query($conn, $sq) or die(mysqli_error($conn));
        echo "<script>alert('Updating successfully!')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php"';
    }
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-3">
            <h3>INFORMATION</h3>
            <div class="list-group list-group-flush">
                <a href="?page=PersonalCart" class="list-group-item list-group-item-action py-2">CART</a>
                <a href="?page=PersonalInf" class="list-group-item list-group-item-action py-2">PERSONAL</a>
            </div>
            <hr class="d-sm-none">

        </div>
        <div class="col-sm-9">
            <h3 class="text-center">PERSONAL</h3>
            <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form" onsubmit="return Checking()">
                <div class="form-group">
                    <div class="col-sm-12 mt-5">
                        <input type="text" name="txtCusname" id="txtCusname" class="form-control" placeholder="Category ID" value='<?php echo $name; ?>'>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 mt-3">
                        <input type="password" name="txtCurPass" id="txtCurPass" class="form-control" placeholder="Current password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 mt-3">
                        <input type="password" name="txtPass" id="txtPass" class="form-control" placeholder="New password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 mt-3">
                        <input type="password" name="txtRepass" id="txtRepass" class="form-control" placeholder="Confirm password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 mt-3">
                        <input type="text" name="txtIdentitycard" id="txtIdentitycard" class="form-control" placeholder="Category Name" value='<?php echo $iden; ?>'>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 mt-3">
                        <input type="text" name="txtCusphone" id="txtCusphone" class="form-control" placeholder="Country" value='<?php echo $phone; ?>'>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 mt-3">
                        <input type="text" name="txtAddress" id="txtAddress" class="form-control" placeholder="Description" value='<?php echo $address; ?>'>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-12 mt-3 mb-5">
                        <input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
                        <input type="button" class="btn btn-primary ms-3" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=PersonalInf'" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>