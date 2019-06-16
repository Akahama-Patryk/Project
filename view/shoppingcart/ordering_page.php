<?php
include_once("../../App/Autoloader.php");
Autoloader::sessionStarter();
if (isset($_GET['RemoveProduct'])) {
    ShoppingCart::deleteCartProduct($_GET['RemoveProduct']);
    RedirectHandler::HTTP_301('shoppingcart');
}
// Empty cart.
if (isset($_GET['EmptyCart'])) {
    ShoppingCart::emptyCart();
    RedirectHandler::HTTP_301('shoppingcart');
}
if (isset($_POST['new_user_quantity']) && ($_POST['id_for_new_qty'])) {
    ShoppingCart::updateCartProduct($_POST['id_for_new_qty'], $_POST['new_user_quantity']);
}
if (!empty($_SESSION['login'])) {
    $loggedonuser = new User();
    $fetchingData = $loggedonuser->fetchUserInformation($_SESSION['login']);
}
$data = new User();
$result = $data->fetchLand();
if (isset($_POST['option']) && (!empty($_POST['option']))) {
    setcookie('cookie_option', $_POST['option'], time() + (86400 * 30), "/");
}
if (isset($_POST['submit']) && !empty($_SESSION['login'])) {

    $f_name = $_POST['f_name'];
    $honorifics = $_POST['option_user'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $hr_nr = $_POST['hr_nr'];
    $postcode = $_POST['postcode'];
    $land = $_POST['land'];
    $state = $_POST['state'];
    $m_nr = $_POST['m_nr'];
    $object = new User();
    $object->updateClientInformation($_POST['id'], $f_name, $honorifics, $surname, $email, $address, $hr_nr, $postcode, $land, $state, $m_nr);

    $ordering = new Order();
    $returningdata = $ordering->createOrder($_POST['id'], $_POST['option'], $_SESSION['payment_data']['totalprice']);
    $order_history = new Order();
    $saving_order_history = $order_history->createOrderHistory($returningdata, $_POST['id']);
}
if (isset($_POST['submit']) && empty($_SESSION['login'])) {
    $f_name = $_POST['f_name'];
    $honorifics = $_POST['option_user'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $hr_nr = $_POST['hr_nr'];
    $postcode = $_POST['postcode'];
    $land = $_POST['land'];
    $state = $_POST['state'];
    $m_nr = $_POST['m_nr'];
    $object = new User();
    $data = $object->createNonUser($f_name, $honorifics, $surname, $email, $address, $hr_nr, $postcode, $land, $state, $m_nr);
    $ordering = new Order();
    $returningdata = $ordering->createOrder($data, $_POST['option'], $_SESSION['payment_data']['totalprice']);
    $order_history = new Order();
    $saving_order_history = $order_history->createOrderHistory($returningdata, $data['user_id']);
}
?>
<html>
<head>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<body>
<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link" href="home">Homepage</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="login">Login page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Page</a>
    </li>
    <li class="nav-item">
        <?php
        if (User::AdminStatus() === true) {
            echo '<a class="nav-link" href="dashboard_admin">Dashboard Admin</a>';
        } else {
            echo '<a class="nav-link" href="dashboard">Dashboard</a>';
        };
        ?>
    </li>
</ul>
<h1>Order</h1>
<?php
if (isset($_SESSION['cart_inventory'])) {
    ShoppingCart::cartInventory();
} else {
    echo "Shopping Cart is empty. Please full it up!";
}
?>

<?php
if (!empty($_SESSION['login'])) {
foreach ($fetchingData

as $data) : ?>
<div class="card-body bg-light">
    <form class="form" role="form" autocomplete="off" id="formLogin" novalidate=""
          method="POST">
        <div class="form-group">
            <label for="f_name">First name</label>
            <input hidden type="text"
                   name="id"
                   id="id"
                   value="<?= $data['user_id'] ?>">
            <input type="text" class="form-control form-control-lg rounded-0"
                   name="f_name"
                   id="f_name" required
                   value="<?= $data['first_name'] ?>">
            <div class="invalid-feedback">Oops, you missed this one.</div>
        </div>
        <h6>Mr/Mrs or other</h6>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="option_user"
                   id="inlineCheckbox1" value="Mr">
            <label class="form-check-label" for="inlineCheckbox1">Mr</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="option_user"
                   id="inlineCheckbox1" value="Mrs">
            <label class="form-check-label" for="inlineCheckbox2">Mrs</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="option_user"
                   id="inlineCheckbox3" value="Other">
            <label class="form-check-label" for="inlineCheckbox3">Other</label>
        </div>
        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" class="form-control form-control-lg rounded-0"
                   name="surname"
                   id="surname" required
                   value="<?= $data['surname'] ?>">
            <div class="invalid-feedback">Oops, you missed this one.</div>
        </div>
        <div class="form-group">
            <label for="email">E-mail Address</label>
            <input type="email" class="form-control form-control-lg rounded-0"
                   name="email"
                   id="email" required
                   value="<?= $data['email'] ?>">
            <div class="invalid-feedback">Oops, you missed this one.</div>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control form-control-lg rounded-0"
                   name="address"
                   id="address" required
                   value="<?= $data['address'] ?>">
            <div class="invalid-feedback">Oops, you missed this one.</div>
        </div>
        <div class="form-group">
            <label for="hr_nr">House number</label>
            <input type="text" class="form-control form-control-lg rounded-0"
                   name="hr_nr"
                   id="hr_nr" required
                   value="<?= $data['house number'] ?>">
            <div class="invalid-feedback">Oops, you missed this one.</div>
        </div>
        <div class="form-group">
            <label for="postcode">Postcode</label>
            <input type="text" class="form-control form-control-lg rounded-0"
                   name="postcode" id="postcode" required
                   value="<?= $data['postcode'] ?>">
            <div class="invalid-feedback">Oops, you missed this one.</div>
        </div>
        <div class="form-group">
            <label for="land">Land</label>
            <select name="land">
                <option value="<?= $data["land"] ?>" disabled
                        selected><?= $data["land"] ?></option>
                <?php
                foreach ($result as $land) :
                    ?>
                    <option value="<?= $land['land_name'] ?>"><?= $land['land_name'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" class="form-control form-control-lg rounded-0"
                       name="state"
                       id="state" required
                       value="<?= $data['state'] ?>">
                <div class="invalid-feedback">Oops, you missed this one.</div>
            </div>
            <div class="form-group">
                <label for="m_nr">Mobile number</label>
                <input type="text" class="form-control form-control-lg rounded-0"
                       name="m_nr"
                       id="m_nr" required
                       value="<?= $data['mobile number'] ?>">
                <div class="invalid-feedback">Oops, you missed this one.</div>
            </div>

            <?php
            endforeach;
            } else {
            ?>
            <div class="card-body bg-light">
                <form class="form" role="form" autocomplete="off" id="formLogin" novalidate=""
                      method="POST">
                    <div class="form-group">
                        <label for="f_name">First name</label>
                        <input type="text" class="form-control form-control-lg rounded-0"
                               name="f_name"
                               id="f_name" required
                               value="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <h6>Mr/Mrs or other</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="option_user"
                               id="inlineCheckbox1" value="Mr">
                        <label class="form-check-label" for="inlineCheckbox1">Mr</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="option_user"
                               id="inlineCheckbox1" value="Mrs">
                        <label class="form-check-label" for="inlineCheckbox2">Mrs</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="option_user"
                               id="inlineCheckbox3" value="Other">
                        <label class="form-check-label" for="inlineCheckbox3">Other</label>
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control form-control-lg rounded-0"
                               name="surname"
                               id="surname" required
                               value="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail Address</label>
                        <input type="email" class="form-control form-control-lg rounded-0"
                               name="email"
                               id="email" required
                               value="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control form-control-lg rounded-0"
                               name="address"
                               id="address" required
                               value="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">
                        <label for="hr_nr">House number</label>
                        <input type="text" class="form-control form-control-lg rounded-0"
                               name="hr_nr"
                               id="hr_nr" required
                               value="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control form-control-lg rounded-0"
                               name="postcode" id="postcode" required
                               value="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">
                        <label for="land">Land</label>
                        <select name="land">
                            <?php
                            foreach ($result as $land) :
                                ?>
                                <option value="<?= $land['land_name'] ?>"><?= $land['land_name'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control form-control-lg rounded-0"
                                   name="state"
                                   id="state" required
                                   value="">
                            <div class="invalid-feedback">Oops, you missed this one.</div>
                        </div>
                        <div class="form-group">
                            <label for="m_nr">Mobile number</label>
                            <input type="text" class="form-control form-control-lg rounded-0"
                                   name="m_nr"
                                   id="m_nr" required
                                   value="">
                            <div class="invalid-feedback">Oops, you missed this one.</div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <h6>Producten afhalen of bezorgen</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="option"
                               id="inlineCheckbox1" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Producten Afhalen</label>
                        <input class="form-check-input" type="checkbox" name="option"
                               id="inlineCheckbox2" value="2">
                        <label class="form-check-label" for="inlineCheckbox2">Producten Bezorgen</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success btn-lg float-right">Next
                    </button>
                </form>
                <script type="text/javascript" src="script/font-awesome/font-awesome.js"></script>
</body>
</html>
