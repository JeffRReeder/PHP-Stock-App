<?php
// My stock app in PHP
// 6/29/3019
// Jeff Reeder
// This file opens a CSV file and displays it to webpage (duplicating "Transactions page" from old excel file)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////    OPEN CSV FILE   ///////////////////////////////////////////////


//$filename = 'Use THIS ONE as test data - LOW-GE.csv';
$filename = 'WesternDigitalExample.csv';

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
   
   for ($col = 0; $col < 9; $col ++) {
        echo "<td>", $All_Stock_Data[$DisplayRow][$col], "</td>";
   }
   echo "</tr>";
}

echo "</table>";
echo "</pre>";

// Name of COMPANY under the "Stock" column name (index[3] or 4th column)//////////////////////////////
function getStockName($companyName, $All_Stock_Data, $TableRow) {
    $companyName = array_column($All_Stock_Data, '3');	//grab column 4 "company name"
    array_shift($companyName);                          //chop off top header
    return $companyName[$TableRow];						//return "company name"
}

////////////////////////////////////////////////////////////////////////////////////////////////////////


$tableRow = 1;
$floatArrayTotalShares = array(0.0);

$floatArrayTransactedSharesColumn = array(0.0);
$floatArrayPricePerShareColumn = array(0.0);
$floatArrayFeesColumn = array(0.0);


//Create FLOAT array for "Transacted Shares" column
for($x=1; $x < 20; $x++) {
    array_push($floatArrayTransactedSharesColumn, $All_Stock_Data[$x][4]);
}

//create FLOAT array for "Price Per Share" column
for($x=1; $x < 20; $x++) {
    //echo " answer is: ". $All_Stock_Data[$x][5]. "</br>";
    array_push($floatArrayPricePerShareColumn, $All_Stock_Data[$x][5]);
  
}

//Create FLOAT array for "Fees" column
for($x=1; $x < 20; $x++) {
    //echo " answer is: ". $All_Stock_Data[$x][6]. "</br>";
    array_push($floatArrayFeesColumn, $All_Stock_Data[$x][6]);
  
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
echo "TESTING floatArrayFeesColumn[0] is: ". $floatArrayFeesColumn[0]. "</br>";
echo "TESTING floatArrayFeesColumn[1] is: ". $floatArrayFeesColumn[1]. "</br>";
echo "TESTING floatArrayFeesColumn[2] is: ". $floatArrayFeesColumn[2]. "</br>";
echo "TESTING floatArrayFeesColumn[3] is: ". $floatArrayFeesColumn[3]. "</br>";
echo "TESTING floatArrayFeesColumn[4] is: ". $floatArrayFeesColumn[4]. "</br>";
echo "TESTING floatArrayFeesColumn[5] is: ". $floatArrayFeesColumn[5]. "</br>";
(float)$num1 = $floatArrayFeesColumn[1];
(float)$num2 = $floatArrayFeesColumn[5];
//$num2 = $num2 + 10;
echo " The float array TEST result of " . $num1 . " + ". $num2 . " is: ". ($num1 - $num2) . "</br>";

echo "Var dump of: floatArrayTransactedSharesColumn";
echo "<pre>";
var_dump($floatArrayFeesColumn);
echo "</pre>";
echo "</br></br>";

//this makes data ALL FLOATS!!!!!!!!!!
$JeffTotalShares = array_map("floatval", $floatArrayTransactedSharesColumn); 
*/

/*
//stackoverflow code
$input_array = Array("1.1234", "3.123", "2.23E3", "2.23E-3");

$result = array_map("floatval", $input_array);

echo "<pre>";
var_dump($input_array);
var_dump($result);
echo "</pre>";
*/

//$JeffTotalShares = array(23, 18, 5, 8, 10, 16);

/*
$original = array(23, 18, 5, 8, 10, 16);

$total = array();
$runningSum = 0;

foreach ($original as $number) {
    $runningSum += $number;
    $total[] = $runningSum;
}
echo "<pre>";
var_dump($total);
echo "</pre>";
*/

//END of stackoverflow code

echo "</br> ------------------------------------START of logic----------------------------------<br>";
/////////////////////////////TESTING CODE AREA  ////////////////////////////////////////////
/*
echo "All stock STRING datat [0][0] is: " .$All_Stock_Data[0][0]. "</br>";
echo "All stock STRING datat [0][1] is: " .$All_Stock_Data[0][1]. "</br>";
echo "All stock STRING datat [0][2] is: " .$All_Stock_Data[0][2]. "</br>";
echo "All stock STRING datat [0][3] is: " .$All_Stock_Data[0][3]. "</br>";
echo "All stock STRING datat [0][4] is: " .$All_Stock_Data[0][4]. "</br>";
echo "All stock STRING datat [0][5] is: " .$All_Stock_Data[0][5]. "</br>";
echo "All stock STRING datat [0][6] is: " .$All_Stock_Data[0][6]. "</br>";
echo "All stock STRING datat [0][7] is: " .$All_Stock_Data[0][7]. "</br>";
echo "All stock STRING datat [0][8] is: " .$All_Stock_Data[0][8]. "</br>";

echo "</br>All stock STRING datat [1][0] is: " .$All_Stock_Data[1][0]. "</br>";
echo "All stock STRING datat [1][1] is: " .$All_Stock_Data[1][1]. "</br>";
echo "All stock STRING datat [1][2] is: " .$All_Stock_Data[1][2]. "</br>";
echo "All stock STRING datat [1][3] is: " .$All_Stock_Data[1][3]. "</br>";
echo "All stock STRING datat [1][4] is: " .$All_Stock_Data[1][4]. "</br>";
echo "All stock STRING datat [1][5] is: " .$All_Stock_Data[1][5]. "</br>";
echo "All stock STRING datat [1][6] is: " .$All_Stock_Data[1][6]. "</br>";
echo "All stock STRING datat [1][7] is: " .$All_Stock_Data[1][7]. "</br>";
echo "All stock STRING datat [1][8] is: " .$All_Stock_Data[1][8]. "</br>";

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
/*
echo"All_Stock_Data[2][2] is: ". $All_Stock_Data[2][2]. "</br>";
echo"All_Stock_Data[2][3] is: ". $All_Stock_Data[2][3]. "</br>";
echo"All_Stock_Data[2][4] is: ". $All_Stock_Data[2][4]. "</br>";
echo"All_Stock_Data[3][2] is: ". $All_Stock_Data[3][2]. "</br>";
echo"All_Stock_Data[3][3] is: ". $All_Stock_Data[3][3]. "</br>";
echo"All_Stock_Data[3][4] is: ". $All_Stock_Data[3][4]. "</br></br>";
*/


$buy_total = 0;
$sell_total = 0;
$div_total = 0;
    for($i=1; $i < $arrayLength; $i++) {
        
        /*
        //BUY CONDITION
        if ($All_Stock_Data[$i][2] == "Buy" && $All_Stock_Data[$i][3] == "Western Digital") {
            $buyAmt = $All_Stock_Data[$i][4];
            $buy_total += $All_Stock_Data[$i][4];
            echo 'Row: ' . ($i+1) . ' Amount BUY: ' . $buyAmt .' Stock=' . $All_Stock_Data[$i][3]. '<br>';
            echo '<pre>';
            echo 'Buy total is: ';
            var_dump ($buy_total);
            echo '</pre>';
        }
        //SELL CONDITION
        elseif ($All_Stock_Data[$i][2] == "Sell" && $All_Stock_Data[$i][3] == "Western Digital"){
            $sellAmt = $All_Stock_Data[$i][4];
            $sell_total += $All_Stock_Data[$i][4];
            echo 'Row: ' . ($i+1) . ' Amount SELL: ' . $sellAmt . ' Stock='. $All_Stock_Data[$i][3]. '<br>';
            echo '<pre>';
            echo 'Sell total is: ';
            var_dump ($sell_total);
            echo '</pre>';
        }
        //DIVIDEND CONDITION
        elseif ($All_Stock_Data[$i][2] == "Div" && $All_Stock_Data[$i][3] == "Western Digital"){
            $divAmt = $All_Stock_Data[$i][4];
            $div_total += $All_Stock_Data[$i][4];
            echo 'Row: ' . ($i+1) . ' Amount DIVIDEND: ' . $divAmt . ' Stock='. $All_Stock_Data[$i][3]. '<br>';
            echo '<pre>';
            echo 'Dividend total is: ';
            var_dump ($div_total);
            echo '</pre>';
        }
    */

    }//end of for loop
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $transacted_shares = 2.0;
    $price_per_share = 3.0;
    $runningTotal = 0.0;

    $cost_basis = 0.0;
    $cost_basis_previous = 0.0;
    $Profit_Loss = 0.0;
    $Average_price_per_share = 0.0;
    //$sum_total = 0.0;
    //$Share_sum_total = 0.0;

    for($Table_Row = 0; $Table_Row < 17; $Table_Row++) {

        //BUY CONDITION
        if ($All_Stock_Data[$Table_Row][2] == "Buy" && $All_Stock_Data[$Table_Row][3] == "Western Digital") {
            $transacted_shares = $All_Stock_Data[$Table_Row][4];
            $buy_total += $All_Stock_Data[$Table_Row][4];
            runningSharesTotalBuy($Table_Row);

            echo '</br>Row: ' . $Table_Row . ' Amount BUY: ' . $transacted_shares . ' Stock='. $All_Stock_Data[$Table_Row][3].
                ' Share Price= '.$All_Stock_Data[$Table_Row][5] .'<br>';
            echo " RUNNING TOTAL WORKS! (Don't fuck with it) == " .$runningTotal . "</br>";

            //We have zero shares (1st time) or we have bought/sold back to zero shares and will re-purchase (2nd time)
            if($cost_basis == 0){
                //do nothing first round
                echo "1st ROUND COST BASIS(zero) = ".$cost_basis . "</br>";
                $cost_basis = $transacted_shares * $price_per_share;
                echo "Now we know this is first round so cost basis is = ".$cost_basis ."</br>";
                $Average_price_per_share = averagePricePerShare();
                echo "TEST average price per share funciton TESTis ".$Average_price_per_share . "</br>";
            }
            //We are adding to original purchase with more shares
            else {
                addMoreShares($cost_basis,$cost_basis_previous);
                averagePricePerShare();
            }
        }//end of BUY CONDITION
        //SELL CONDITION
        elseif ($All_Stock_Data[$Table_Row][2] == "Sell" && $All_Stock_Data[$Table_Row][3] == "Western Digital"){
            $sellAmt = $All_Stock_Data[$Table_Row][4];
            $sell_total += $All_Stock_Data[$Table_Row][4];
            echo '</br>Row: ' . $Table_Row . ' Amount SELL: ' . $sellAmt . ' Stock='. $All_Stock_Data[$Table_Row][3].
                ' Share Price= '.$All_Stock_Data[$Table_Row][5] .'<br>';

            runningSharesTotalSell($Table_Row);
            echo " RUNNING TOTAL WORKS! (Don't fuck with it) == " .$runningTotal . "</br>";
            echo " SELL CONDITION cost basis from previous row is: ". $cost_basis. "</br>";

                //you have sold ALL shares and your cost basis is reset to zero.
                if ($runningTotal == 0.0){
                    $cost_basis_previous = $cost_basis;
                    $cost_basis = 0.0;
                    echo " RUNNING TOTAL = 0 (so set cost basis to 0),  cost basis= ". $cost_basis. "</br>";
                    echo "Cost basis previous is: ".$cost_basis_previous ."</br>";

                    //profit or loss = buy price/shares - sell price/shares
                    $sold_Shares = ($transacted_shares * $price_per_share);
                    echo "Sold Shares profit/loss = ". $sold_Shares. "</br>";
                    echo "Previous BOUGHT SHARES Cost Basis = ". $cost_basis_previous. "</br>";

                    // call profit loss function maybe?
                    $Profit_Loss = $sold_Shares - $cost_basis_previous;

                    echo " Profit/loss ". $sold_Shares. " - ". $cost_basis_previous." = " . $Profit_Loss. "</br>";
                    echo " New Average price per share (sold everything, should be zero) = " . $cost_basis. "</br>";

                }
                // you only sold SOME of your shares and recalculated cost basis, profit/loss, avg price/share
                else {
                    echo "cost basis TESTING IN ELSE IS: ". $cost_basis. "</br>";
                    $cost_basis_previous = $cost_basis;
                    $cost_basis = $cost_basis - ($transacted_shares * $price_per_share);
                    echo " running total is NOT 0, so UPDATED cost basis after sale is = ". $cost_basis. "</br>";
                    echo "CHECK FOR PROFIT/LOSS WHEN RUNNING TOTAL IS Changed. </br>";


                    $average_price_per_share = profitLoss($cost_basis, $cost_basis_previous,$Profit_Loss, $transacted_shares,$price_per_share,$runningTotal);


                    echo " Profit/loss on this sale is (incorrect should be negative?) = " . $Profit_Loss. "</br>";
                    echo " New Average price per share = (not finished) " . $average_price_per_share. "</br>";
                }

        }//end of SELL CONDITION
        //DIVIDEND CONDITION (or whatever)
        else {
            echo " </br>Row: " . $Table_Row . " NOTHING " . $All_Stock_Data[$Table_Row][3] . "</br>";
        }

    }


    function profitLoss($cost_basis, $cost_basis_previous,$Profit_Loss, $transacted_shares,$price_per_share,$runningTotal ){
        global $cost_basis, $Profit_Loss,$runningTotal;
        echo " PROFIT--LOSS function--------BEGIN----------------------------</br>";
        echo " PROFIT--LOSS function (cost basis previous) is: ".$cost_basis_previous ."</br>";
        echo " PROFIT--LOSS function (cost basis) is: ".$cost_basis ."</br>";
        echo " PROFIT--LOSS function (transacted_shares) is: ".$transacted_shares ."</br>";
        echo " PROFIT--LOSS function (price_per_share) is: ".$price_per_share ."</br>";


        $Profit_Loss =  $cost_basis - $cost_basis_previous;
        echo "INSIDE profit-loss function (Profit_Loss RECALCULATED) is: ". $Profit_Loss ."</br>";
        $average_price_per_share = (($cost_basis_previous + $Profit_Loss) / $runningTotal);
        echo "INSIDE profit-loss function (average price/share) is: ". $average_price_per_share ."</br>";


        echo "testing PROFIT--LOSS function--------END----------------------------</br>";
        return $average_price_per_share;
    }

    //Average price per share = Cost Basis / total shares
    function averagePricePerShare(){
        global $cost_basis, $runningTotal;

        echo "testing AVG Price/Share function--------BEGIN----------------------------</br>";
        echo "AVG PRICE/SHARE function (running total) is: ".$runningTotal ."</br>";
        echo "AVG PRICE/SHARE  function (cost basis) is: ".$cost_basis ."</br>";

        //echo "INSIDE averagePricePerShare function (price_per_share) is: ".$price_per_share ."</br>";
        $average_price_per_share = $cost_basis / $runningTotal;
        echo " AVG PRICE/SHARE New Average price per share = " . $average_price_per_share . "</br>";
        echo " AVG PRICE/SHARE  function--------END----------------------------</br>";
        return $average_price_per_share;
    }

    function addMoreShares($cost_basis,$cost_basis_previous)
    {
        global $cost_basis, $cost_basis_previous, $transacted_shares, $price_per_share;

        echo " ADD MORE SHARES function--------BEGIN----------------------------</br>";

        $cost_basis_previous = $cost_basis;
        echo " ADD MORE SHARES cost_basis_previous should be previous = " . $cost_basis_previous . "</br>";
        $cost_basis = $transacted_shares * $price_per_share;
        echo " ADD MORE SHARES transacted shares= " . $transacted_shares . "</br>";
        echo " ADD MORE SHARES price per share= " . $price_per_share . "</br>";
        echo " ADD MORE SHARES Cost basis (Either new shares or Dividend re-invest) " . $cost_basis . "</br>";
        $cost_basis = $cost_basis + $cost_basis_previous;
        echo " ADD MORE SHARES--CUMULATIVE Cost Basis= " . $cost_basis . "</br>";

        echo " ADD MORE SHARES function--------END----------------------------</br>";
    }




    function runningSharesTotalBuy($Table_Row){
        global $transacted_shares, $price_per_share, $runningTotal, $All_Stock_Data;

        $transacted_shares = $All_Stock_Data[$Table_Row][4];
        $price_per_share = $All_Stock_Data[$Table_Row][5];
        $runningTotal += $transacted_shares;
    }

    function runningSharesTotalSell($Table_Row){
        global $transacted_shares, $price_per_share, $runningTotal, $All_Stock_Data;

        $transacted_shares = $All_Stock_Data[$Table_Row][4];
        $price_per_share = $All_Stock_Data[$Table_Row][5];
        $runningTotal -= $transacted_shares;

    }
    //Average price per share = cost basis (how much you paid for stocks) / how many shares you own
    //cost basis: (cost of all shares and RE-invested dividends, NOT dividends taken as cash.)
    // Ex 100 shares of stock purchase for $1000, first year REINVESTED dividends $100, second year REINVESTED
    // dividends $200. If you sell at $1500 taxable gains is $200 ($1500 - $1300) instead of $500 ($1500 - $1000).
    // REINVESTED dividends are just like buying more shares increasing your total shares a.k.a cost basis
    //average_price_per_share = $cost_basis / $runningTotal;




    ////////////////////////////////////////////////////////////////////////////////////////////////////
    echo " Total bought is: ". $buy_total . "</br>";
    echo " Total sold is : " . $sell_total . "</br>";
    echo " Total stock (after buy/sell) is : " . $runningTotal . "</br>";
    echo " Total Dividend is: " . $div_total . "</br>";

    //$dividend_income = ($All_Stock_Data[8][4] * $All_Stock_Data[8][5]);
    //echo " Total Dividends paid out is: " . $dividend_income . "</br>";

    

    


    echo "--------------TEST------------TEST--------------TEST---------------TEST----------------</br>";


    echo "--------------TEST------------TEST--------------TEST---------------TEST----------------</br>";
/////////////////////////////END OF TESTING CODE AREA/////////////////////////////////////////

echo " -------------------------------END of logic---------------------------------------" . '<br>';


///////////////////////////////////////////////////////////////////////////////////////////////


//testing calculations-----------------------------------------------------------

//SELL cases: Make sure to recalculate realized gain/loss, total gain/loss, annual dividend, avg price/share. 

//Dividend cases:
//check if dividend is cashed out or reinvested
//if DIV are reinvested, then DIV is on 1st row, BUY is on 2nd row. (receive div, then buy more shares)
//"Transacted shares" is same for both DIV/BUY and brokerage is (TD OFI, TD ROTH, COMPUTER SHARE or EQUINITI).
//Must calculate dividend amount (increase total dividends collected), transacted shares (increase),
// fees (zero or increase).

//if DIV are cashed out (only 1 row, not 2), then INCREASE total div collected, transacted shares (DO NOTHING),
// fees (should be zero),
// and brokerage could be anything (but for now is most likely robinhood).



