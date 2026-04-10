<?php

function readCustomers($filename) {
    $customers = array();
    if (file_exists($filename)) {
        $file = fopen($filename, "r");
        while (($line = fgets($file)) !== false) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $data = explode(';', $line);
            if (count($data) >= 12) {
                $customers[] = array(
                    'id' => $data[0],
                    'first_name' => $data[1],
                    'last_name' => $data[2],
                    'email' => $data[3],
                    'university' => $data[4],
                    'address' => $data[5],
                    'city' => $data[6],
                    'state' => $data[7],
                    'country' => $data[8],
                    'zip' => $data[9],
                    'phone' => $data[10],
                    'sales' => $data[11]
                );
            }
        }
        fclose($file);
    }
    return $customers;
}

function readOrders($customer, $filename) {
    $orders = array();
    if (file_exists($filename)) {
        $file = fopen($filename, "r");
        while (($line = fgets($file)) !== false) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $data = explode(',', $line);
            if (count($data) >= 5) {
                if ($data[1] == $customer) {
                    $orders[] = array(
                        'order_id' => $data[0],
                        'customer_id' => $data[1],
                        'isbn' => $data[2],
                        'title' => $data[3],
                        'category' => $data[4]
                    );
                }
            }
        }
        fclose($file);
    }
    return $orders;
}

?>