<?php

include 'includes/book-utilities.inc.php';

$customers = readCustomers('data/customers.txt');

$selected_customer_id = null;
if (isset($_GET['customer_id'])) {
    $selected_customer_id = $_GET['customer_id'];
}
$selected_customer = null;
if ($selected_customer_id) {
    foreach ($customers as $c) {
        if ($c['id'] == $selected_customer_id) {
            $selected_customer = $c;
            break;
        }
    }
}
$orders = array();
if ($selected_customer_id) {
    $orders = readOrders($selected_customer_id, 'data/orders.txt');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>dc328023 Jiang Xingyu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/demo-styles.css">
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
    <script>
        $(function() {
            $('.sparkline').sparkline('html', {
                type: 'bar',
                barColor: '#3F51B5'
            });
        });
    </script>
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">

              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--7-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Customers</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table  mdl-shadow--2dp">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">Name</th>
                          <th class="mdl-data-table__cell--non-numeric">University</th>
                          <th class="mdl-data-table__cell--non-numeric">City</th>
                          <th>Sales</th>
                        </tr>
                      </thead>
                      <tbody>
<?php foreach ($customers as $c) { ?>
                        <tr>
                          <td class="mdl-data-table__cell--non-numeric"><a href="cisc3003-sugex10-after.php?customer_id=<?php echo htmlspecialchars($c['id']); ?>"><?php echo htmlspecialchars($c['first_name'] . ' ' . $c['last_name']); ?></a></td>
                          <td class="mdl-data-table__cell--non-numeric"><?php echo htmlspecialchars($c['university']); ?></td>
                          <td class="mdl-data-table__cell--non-numeric"><?php echo htmlspecialchars($c['city']); ?></td>
                          <td><span class="sparkline"><?php echo htmlspecialchars($c['sales']); ?></span></td>
                        </tr>
<?php } ?>                                              
                      </tbody>
                    </table>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              
            <div class="mdl-grid mdl-cell--5-col">
    

       
                  <!-- mdl-cell + mdl-card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Customer Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
<?php if ($selected_customer) { ?>
                        <h4><?php echo htmlspecialchars($selected_customer['first_name'] . ' ' . $selected_customer['last_name']); ?></h4>
                        <p>Email: <?php echo htmlspecialchars($selected_customer['email']); ?></p>
                        <p>University: <?php echo htmlspecialchars($selected_customer['university']); ?></p>
                        <p>Address: <?php 
                            $address_parts = array($selected_customer['address'], $selected_customer['city'], $selected_customer['state'], $selected_customer['country']);
                            $address_str = implode(', ', $address_parts);
                            if (!empty($selected_customer['zip'])) {
                                $address_str .= ', ' . $selected_customer['zip'];
                            }
                            echo htmlspecialchars($address_str);
                        ?></p>
                        <p>Phone: <?php echo htmlspecialchars($selected_customer['phone']); ?></p>
<?php } else { ?>
                        <p>Select a customer to view details.</p>
<?php } ?>
                    </div>    
                  </div>  <!-- / mdl-cell + mdl-card -->   

                  <!-- mdl-cell + mdl-card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Order Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">       
                               <table class="mdl-data-table  mdl-shadow--2dp">
                              <thead>
                                <tr>
                                  <th class="mdl-data-table__cell--non-numeric">Cover</th>
                                  <th class="mdl-data-table__cell--non-numeric">ISBN</th>
                                  <th class="mdl-data-table__cell--non-numeric">Title</th>
                                </tr>
                              </thead>
                              <tbody>
<?php if ($selected_customer_id) {
    if (count($orders) > 0) {
        foreach ($orders as $order) { ?>
                                <tr>
                                  <td class="mdl-data-table__cell--non-numeric"><img src="images/tinysquare/<?php echo htmlspecialchars($order['isbn']); ?>.jpg" alt="Cover" /></td>
                                  <td class="mdl-data-table__cell--non-numeric"><?php echo htmlspecialchars($order['isbn']); ?></td>
                                  <td class="mdl-data-table__cell--non-numeric"><?php echo htmlspecialchars($order['title']); ?></td>
                                </tr>
<?php   }
    } else { ?>
                                <tr>
                                  <td colspan="3" class="mdl-data-table__cell--non-numeric">No orders for this customer.</td>
                                </tr>
<?php }
} ?>                           
                              </tbody>
                            </table>
                        </div>    
                   </div>  <!-- / mdl-cell + mdl-card -->             


               </div>   
           
           
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 

<footer>
    <p style="text-align: center;">CISC3003 Web Programming: dc328023 Jiang Xingyu 2026</p>
</footer>

</body>
</html>