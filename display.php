<?php


require_once ('functions.php');

$filename = 'CiscoExample-with all columns.csv';

// The nested array to hold all the arrays
$All_Stock_Data = [];
// Open the file for reading
if (($h = fopen("{$filename}", "r")) !== FALSE)
{
    // Each line in the file is converted into an individual array that we call $data
    // The items of the array are comma separated
    while (($data = fgetcsv($h, 1000, ",")) !== FALSE)
    {
        // Each individual array is being pushed into the nested array
        $All_Stock_Data[] = $data;
    }
    // Close the file
    fclose($h);
}


// Display the code in a readable format
echo "<pre>";
// DISPLAY TABLE and Display to site with CSV data /////////////////////////
echo "<h2>Transactions Page (from CSV file)\n</h2>";
echo "<table border='1'><br />";
//Display table with 9 columns and rows == array length
$arrayLength = count($All_Stock_Data);
for ($DisplayRow = 0; $DisplayRow < $arrayLength; $DisplayRow ++) {
    echo "<tr>";

    for ($col = 0; $col < 18; $col ++) {
        echo "<td>", $All_Stock_Data[$DisplayRow][$col], "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "</pre>";

$All_Stock_Data[1][9] = $runningTotal;

echo "Testing input of a value to a spot: ". $All_Stock_Data[1][9]."</br></br>";

echo "All stock STRING datat [0][0] is: " .$All_Stock_Data[0][0]. "</br>";
echo "All stock STRING datat [0][1] is: " .$All_Stock_Data[0][1]. "</br>";
echo "All stock STRING datat [0][2] is: " .$All_Stock_Data[0][2]. "</br>";
echo "All stock STRING datat [0][3] is: " .$All_Stock_Data[0][3]. "</br>";
echo "All stock STRING datat [0][4] is: " .$All_Stock_Data[0][4]. "</br>";
echo "All stock STRING datat [0][5] is: " .$All_Stock_Data[0][5]. "</br>";
echo "All stock STRING datat [0][6] is: " .$All_Stock_Data[0][6]. "</br>";
echo "All stock STRING datat [0][7] is: " .$All_Stock_Data[0][7]. "</br>";
echo "All stock STRING datat [0][8] is: " .$All_Stock_Data[0][8]. "</br>";
echo "All stock STRING datat [0][9] is: " .$All_Stock_Data[0][9]. "</br>";
echo "All stock STRING datat [0][10] is: " .$All_Stock_Data[0][10]. "</br>";
echo "All stock STRING datat [0][11] is: " .$All_Stock_Data[0][11]. "</br>";
echo "All stock STRING datat [0][12] is: " .$All_Stock_Data[0][12]. "</br>";
echo "All stock STRING datat [0][13] is: " .$All_Stock_Data[0][13]. "</br>";
echo "All stock STRING datat [0][14] is: " .$All_Stock_Data[0][14]. "</br>";
echo "All stock STRING datat [0][15] is: " .$All_Stock_Data[0][15]. "</br>";
echo "All stock STRING datat [0][16] is: " .$All_Stock_Data[0][16]. "</br>";
echo "All stock STRING datat [0][17] is: " .$All_Stock_Data[0][17]. "</br>";
echo "All stock STRING datat [0][18] is: " .$All_Stock_Data[0][18]. "</br>";

echo "</br>All stock STRING datat [1][0] is: " .$All_Stock_Data[1][0]. "</br>";
echo "All stock STRING datat [1][1] is: " .$All_Stock_Data[1][1]. "</br>";
echo "All stock STRING datat [1][2] is: " .$All_Stock_Data[1][2]. "</br>";
echo "All stock STRING datat [1][3] is: " .$All_Stock_Data[1][3]. "</br>";
echo "All stock STRING datat [1][4] is: " .$All_Stock_Data[1][4]. "</br>";
echo "All stock STRING datat [1][5] is: " .$All_Stock_Data[1][5]. "</br>";
echo "All stock STRING datat [1][6] is: " .$All_Stock_Data[1][6]. "</br>";
echo "All stock STRING datat [1][7] is: " .$All_Stock_Data[1][7]. "</br>";
echo "All stock STRING datat [1][8] is: " .$All_Stock_Data[1][8]. "</br>";
echo "All stock STRING datat [1][9] is: " .$All_Stock_Data[1][9]. "</br>";
echo "All stock STRING datat [1][10] is: " .$All_Stock_Data[1][10]. "</br>";
echo "All stock STRING datat [1][11] is: " .$All_Stock_Data[1][11]. "</br>";
echo "All stock STRING datat [1][12] is: " .$All_Stock_Data[1][12]. "</br>";
echo "All stock STRING datat [1][13] is: " .$All_Stock_Data[1][13]. "</br>";
echo "All stock STRING datat [1][14] is: " .$All_Stock_Data[1][14]. "</br>";
echo "All stock STRING datat [1][15] is: " .$All_Stock_Data[1][15]. "</br>";
echo "All stock STRING datat [1][16] is: " .$All_Stock_Data[1][16]. "</br>";
echo "All stock STRING datat [1][17] is: " .$All_Stock_Data[1][17]. "</br>";
echo "All stock STRING datat [1][18] is: " .$All_Stock_Data[1][18]. "</br>";

echo "</br>All stock STRING datat [2][0] is: " .$All_Stock_Data[2][0]. "</br>";
echo "All stock STRING datat [2][1] is: " .$All_Stock_Data[2][1]. "</br>";
echo "All stock STRING datat [2][2] is: " .$All_Stock_Data[2][2]. "</br>";
echo "All stock STRING datat [2][3] is: " .$All_Stock_Data[2][3]. "</br>";
echo "All stock STRING datat [2][4] is: " .$All_Stock_Data[2][4]. "</br>";
echo "All stock STRING datat [2][5] is: " .$All_Stock_Data[2][5]. "</br>";
echo "All stock STRING datat [2][6] is: " .$All_Stock_Data[2][6]. "</br>";
echo "All stock STRING datat [2][7] is: " .$All_Stock_Data[2][7]. "</br>";
echo "All stock STRING datat [2][8] is: " .$All_Stock_Data[2][8]. "</br>";

echo "</br>All stock STRING datat [3][0] is: " .$All_Stock_Data[3][0]. "</br>";
echo "All stock STRING datat [3][1] is: " .$All_Stock_Data[3][1]. "</br>";
echo "All stock STRING datat [3][2] is: " .$All_Stock_Data[3][2]. "</br>";
echo "All stock STRING datat [3][3] is: " .$All_Stock_Data[3][3]. "</br>";
echo "All stock STRING datat [3][4] is: " .$All_Stock_Data[3][4]. "</br>";
echo "All stock STRING datat [3][5] is: " .$All_Stock_Data[3][5]. "</br>";
echo "All stock STRING datat [3][6] is: " .$All_Stock_Data[3][6]. "</br>";
echo "All stock STRING datat [3][7] is: " .$All_Stock_Data[3][7]. "</br>";
echo "All stock STRING datat [3][8] is: " .$All_Stock_Data[3][8]. "</br></br>";

// Display the code in a readable format
echo "<pre>";
// DISPLAY TABLE and Display to site with CSV data /////////////////////////
echo "<h2>Transactions Page (from CSV file)\n</h2>";
echo "<table border='1'><br />";
//Display table with 9 columns and rows == array length
$arrayLength = count($All_Stock_Data);
for ($DisplayRow = 0; $DisplayRow < $arrayLength; $DisplayRow ++) {
    echo "<tr>";

    for ($col = 0; $col < 18; $col ++) {
        echo "<td>", $All_Stock_Data[$DisplayRow][$col], "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "</pre>";