<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('You must LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=?page=Login"/>';
} else {

?>
<?php
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (isset($_GET['delcart']) && ($_GET['delcart']) == 1) unset($_SESSION['cart']);
if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
    array_splice($_SESSION['cart'], $_GET['delid'], 1);
}

if (isset($_POST['AddCart']) && ($_POST['AddCart'])) {
    $name = $_POST['ProName'];
    $cate = $_POST['CateName'];
    $sup = $_POST['SupName'];
    $price = $_POST['Price'];
    $img = $_POST['Img'];
    $qty = $_POST['Quantity'];

    $check = 0;

    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][0] == $name) {
            $check = 1;
            $newqty = $qty + $_SESSION['cart'][$i][3];
            $_SESSION['cart'][$i][3] = $newqty;
            break;
        }
    }
    
    if ($check == 0) {
        $cartItem = [$name, $cate, $sup, $qty, $price, $img];
        $_SESSION['cart'][] = $cartItem;
    }
}

function Showcart()
{
    if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) {
        if (sizeof($_SESSION['cart']) > 0) {
            $sum = 0;
            for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                $temp = $_SESSION['cart'][$i][3] * $_SESSION['cart'][$i][4];
                $sum += $temp;
                echo
                '<div class="card rounded-3 mb-4">
                <div class="card-body p-4">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-md-2 col-lg-2 col-xl-2">
                            <img src="Images/' . $_SESSION['cart'][$i][5] . ' "class="img-fluid rounded-3" alt="">
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                            <p class="lead fw-normal mb-2">' . $_SESSION['cart'][$i][0] . '</p>
                            <p><span class="text-muted">Category: </span>' . $_SESSION['cart'][$i][1] . '</p>
                            <p><span class="text-muted">Supplier: </span>' . $_SESSION['cart'][$i][2] . '</p>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                            <p><span class="text-muted">Quantity: </span>' . $_SESSION['cart'][$i][3] . '</p>
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                            <h6 class="mb-0">' . $temp . '$</h6>
                        </div>
                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                            <a href="?page=PersonalCart&&delid=' . $i . '"><i class="bi bi-trash fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>';
            }
            echo
            '<div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <a class="btn btn-warning" href="?page=PersonalCart&&delcart=1"></i>Remove All</a>
                    </div>
                    <div class="col-sm-6 text-end">
                        <h4>Total: ' . $sum . '$</h4>
                    </div>
                </div>
            </div>
        </div>';
        } else {
            echo '<div class="card-body">
                <div class="text-center fw-bold fst-italic">
                    Your cart is empty!
                </div>
            </div>';
        }
    }
}
?>

<div class="row">
    <div class="col-sm-3 mt-5">
        <h3>INFORMATION</h3>
        <div class="list-group list-group-flush">
            <a href="?page=PersonalCart" class="list-group-item list-group-item-action py-2">CART</a>
            <a href="?page=PersonalInf" class="list-group-item list-group-item-action py-2">PERSONAL</a>
        </div>
        <hr class="d-sm-none">

    </div>
    <div class="col-sm-9">
        <section class="h-100">
            <div class="h-100 py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-10">
                        <div class="mb-4">
                            <h3 class="text-black text-center">SHOPPING CART</h3>
                        </div>
                        <?php Showcart() ?>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="index.php" type="button" class="btn btn-primary btn-block btn-lg"><i class="bi bi-chevron-double-left"></i> Continue Shopping</a>
                                    </div>
                                    <div class="col-sm-6 text-end">
                                        <a href="#" type="button" class="btn btn-warning btn-block btn-lg ">Proceed to Pay <i class="bi bi-check-lg"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
}
?>