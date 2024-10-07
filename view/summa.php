<?PHP
$regno = 1;  // Start from 1
$type = 'ST';

for ($i = 0; $i < 10; $i++) {
    // Update register_number inside the loop
    $register_number = $type . str_pad($regno, 3, '0', STR_PAD_LEFT); // Padding with 0 for proper formatting
    print_r($register_number . "\n");
    $regno++;
}


?>