<?php
include_once('../../../App/Autoloader.php');
Autoloader::sessionStarter();
$result = array();
$subtotaldata = null;
foreach ($_SESSION['factuurdata'] as $item) {
    if (is_array($item) || is_object($item)) {
        $call = new Order();
        $result = $call->InvoiceFetchClientInfo($item['o_id'], $item['u_id']);
        $call2 = new Product();
        $result2 = $call2->InvoiceFetchProducts($item['o_id'], $item['u_id']);
        $rng = $item['invoice_id'];
    }
}
?>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Project Supermarkt Invoice</title>
    <link rel="stylesheet" href="http://phptopdf.com/bootstrap.css">
    <style>
        @import url(http://fonts.googleapis.com/css?family=Bree+Serif);

        body, h1, h2, h3, h4, h5, h6 {
            font-family: 'Bree Serif', serif;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <h1>
<!--                <img class="img-thumbnail align-self-center" style="width:100px;height:100px;"-->
<!--                     src="../../../img/logo.jpg" alt="Missing image data">-->
                Project Supermarkt
            </h1>
        </div>
        <div class="col-xs-6 text-right">
            <h1>INVOICE</h1>
            <h1>
                <small>Invoice #<?= $rng ?></small>
            </h1>
        </div>
    </div>
    <?php foreach ($result as $row): ?>
        <div class="row">
            <div class="col-xs-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Order information :</h4>
                    </div>
                    <div class="panel-body">
                        <p>
                            Ordernummer : <?= $row['order_id'] ?><br>
                            Ordered on : <?= $row['orderdate'] ?><br>
                            Type delivery : <?php if ($row['type_delivery'] === '1') $type = "Producten Afhalen";
                            if ($row['type_delivery'] === '2') $type = "Producten Bezorgen" ?><?= $type ?><br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 col-xs-offset-2 text-right">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>To : <?= $row['honorifics'] ?> <?= $row['first_name'] ?> <?= $row['surname'] ?></a></h4>
                    </div>
                    <div class="panel-body">
                        <p>
                            Address: <?= $row['address'] ?> <?= $row['house number'] ?><br>
                            Postcode: <?= $row['postcode']?> <br>
                            Land: <?= $row['land']?><br>
                            State: <?= $row['state']?><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- / end client details section -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>
                <h4>Product nummer</h4>
            </th>
            <th>
                <h4>Product Name</h4>
            </th>
            <th>
                <h4>Qty</h4>
            </th>
            <th>
                <h4>Price per product</h4>
            </th>
            <th>
                <h4>Sub Total</h4>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result2 as $row):
            ?>
            <?php
            $productmultiplier = $row['price'] * $row['order_quantity'];
            $deliverprice = 0;
            $subtotaldata += $productmultiplier;
            $totaldata = $deliverprice + $subtotaldata / 100 * 121; ?>
            <tr>
                <td><?= $row['id_product'] ?></td>
                <td><?= $row['product_name'] ?></td>
                <td class="text-right"><?= $row['order_quantity'] ?></td>
                <td class="text-right"><?= $row['price'] ?></td>
                <td class="text-right"><?= number_format($productmultiplier, 2) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
            <p>
                <strong>
                    Sub Total : <br>
                    BTW : <br>
                    Total : <br>
                </strong>
            </p>
        </div>
        <div class="col-xs-2">
            <strong>
                € <?= number_format($subtotaldata, 2) ?><br>
                21% <br>
                € <?= number_format($totaldata, 2) ?> <br>
            </strong>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Bank details</h4>
                </div>
                <div class="panel-body">
                    <p>Your Name</p>
                    <p>Bank Name</p>
                    <p>SWIFT : --------</p>
                    <p>Account Number : --------</p>
                    <p>IBAN : --------</p>
                </div>
            </div>
        </div>
        <div class="col-xs-7">
            <div class="span7">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4>Contact Details</h4>
                    </div>
                    <div class="panel-body">
                        <p>
                            Email : info@projectsupermarkt.nl <br><br>
                            Mobile : 0627163484 <br><br><br>
                        </p>
                        <h4>Payment should be made by IDeal</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>