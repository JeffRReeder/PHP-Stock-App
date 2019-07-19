<?php
// My stock app in PHP
// 6/29/3019
// Jeff Reeder
// This file opens a CSV file and displays it to webpage (duplicating "Transactions page" from old excel file)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//include("class_lib.php");
////////////////////////////////////////////    OPEN CSV FILE   ///////////////////////////////////////////////
//$filename = 'LowesExample-2.csv';
//$filename = 'CiscoExample.csv';

require_once ('functions.php');

//$filename = '3Stockexample.csv';
//$filename = 'CiscoExample-with all columns.csv';
$filename = 'CiscoExampleNOhoneywell.csv';

//$filename = 'WesternDigitalExample.csv';
//$filename = 'WesternDigitalExample-2.csv';
//$filename = 'All Test Cases.csv';



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

    for ($col = 0; $col < 19; $col ++) {
        echo "<td>", $All_Stock_Data[$DisplayRow][$col], "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "</pre>";

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
*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
$transacted_shares = 2.0;
$transacted_value = 0.0;
$transacted_value_on_sell = 0.0;
$price_per_share = 3.0;
$fees = 0.0;
$running_fees_total = 0.0;
$runningTotal = 0.0; //this variable should be named "runningTotalShares"
$total_shares_purchased = 0.0;
$total_shares_sold = 0.0;
$cost_basis = 0.0;
$cost_basis_previous = 0.0;
$Profit_Loss = 0.0;
$total_dividends_paid = 0.0;
//might need variable named "AllDividendsPaid"????
$Average_price_per_share = 0.0;
$date = 0;
$yield_on_cost = 0.0;
$TableRow = 14;

/*
//grab type of transaction: "Buy", "Sell", "Div" or "Split"
    function getTransactionType() {
        global $All_Stock_Data, $TableRow;
        $TransactionType = array_column($All_Stock_Data, '2');	//grab column 3 "Type"
        array_shift($TransactionType);                           //chop off top header
        return $TransactionType[$TableRow];						        //return "Type"
    }

*/


for($Table_Row = 0; $Table_Row < $arrayLength; $Table_Row++) {
///////////////////////////////////////   START COMPANY 1    /////////////////////////////////////////////////
    //BUY CONDITION
    if ($All_Stock_Data[$Table_Row][2] == "Buy" && $All_Stock_Data[$Table_Row][3] == "Cisco Systems, Inc.") {

        getTransactionShares($Table_Row);

        //PREVIOUS SHARES column (8) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][8] = $runningTotal;

        //PREVIOUS COST column (11) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][11] = $cost_basis;


        $total_shares_purchased += $All_Stock_Data[$Table_Row][4];
        $fees = $All_Stock_Data[$Table_Row][6];
        runningSharesTotalBuy($Table_Row);
        echo '</br>Row: ' . $Table_Row . ' Amount BUY: ' . getTransactionShares($Table_Row) . ' Stock= '. $All_Stock_Data[$Table_Row][3].
            ' Share Price= '.$All_Stock_Data[$Table_Row][5] .' Fees = ' . $fees. '<br>';
        echo " RUNNING TOTAL WORKS! (Don't fuck with it) == " .$runningTotal . "</br>";

        //CUMULATIVE SHARES column (9) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][9] = $runningTotal;



        //We have zero shares (1st time) or we have bought/sold back to zero shares and will re-purchase (2nd time)
        if($cost_basis == 0){
            //when done with testing ECHO statements all you need is this code
            //$cost_basis = ($fees + (getTransactionShares($Table_Row) * $price_per_share));
            //averagePricePerShare();
            //fees($fees,$running_fees_total);


            //do nothing first round
            echo "1st ROUND COST BASIS(zero) = ".$cost_basis . "</br>";

            $cost_basis = ($fees + (getTransactionShares($Table_Row) * getPricePerShare($Table_Row)));
            fees($fees,$running_fees_total);
            echo "We know this is first round so cost basis is = ".$cost_basis ."</br>";


            //TRANSACTED VALUE [first buy] column (10) for DISPLAY (don't fuck with it)
            $All_Stock_Data[$Table_Row][10] = $cost_basis;

            //CUMULATIVE COST column (14) for DISPLAY (don't fuck with it)
            $All_Stock_Data[$Table_Row][14] = $cost_basis;

            echo "average price/per share (WORKS buy, if(costbasis = 0)= ". averagePricePerShare() . "</br>";
        }
        //We are adding to original purchase with more shares
        else {

            //when done with testing ECHO statements all you need is this code
            //addMoreShares($cost_basis,$cost_basis_previous);
            //averagePricePerShare();
            //fees($fees,$running_fees_total);

            addMoreShares($cost_basis,$cost_basis_previous);


            //CUMULATIVE COST column (14) for DISPLAY (don't fuck with it)
            $All_Stock_Data[$Table_Row][14] = $cost_basis;



            //TRANSACTED VALUE column (10) for DISPLAY (don't fuck with it)
            $All_Stock_Data[$Table_Row][10] = $transacted_value;


            echo "average price/per share (WORKS buy, else costbasis != 0) ". averagePricePerShare() . "</br>";
            echo "Test fees function call". fees($fees,$running_fees_total). "</br>";
        }
    }//end of BUY CONDITION
    //SELL CONDITION
    elseif ($All_Stock_Data[$Table_Row][2] == "Sell" && $All_Stock_Data[$Table_Row][3] == "Cisco Systems, Inc."){
        $sellAmt = $All_Stock_Data[$Table_Row][4];
        $total_shares_sold += $All_Stock_Data[$Table_Row][4];
        $fees = $All_Stock_Data[$Table_Row][6];
        echo '</br>Row: ' . $Table_Row . ' Amount SELL: ' . $sellAmt . ' Stock= '. $All_Stock_Data[$Table_Row][3].
            ' Share Price= '.$All_Stock_Data[$Table_Row][5] .' Fees = ' . $fees. '<br>';

        //PREVIOUS SHARES column (8) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][8] = $runningTotal;

        runningSharesTotalSell($Table_Row);
        echo " RUNNING TOTAL WORKS! (Don't fuck with it) == " .$runningTotal . "</br>";
        echo " SELL CONDITION cost basis from previous row is: ". $cost_basis. "</br>";

        //CUMULATIVE SHARES column (9) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][9] = $runningTotal;

        //PREVIOUS COST column (11) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][11] = $cost_basis;

        //you have sold ALL shares and your cost basis is reset to zero.
        if ($runningTotal == 0.0){
            $cost_basis_previous = $cost_basis;
            $cost_basis = 0.0;
            echo " RUNNING TOTAL = 0 (so set cost basis to 0),  cost basis= ". $cost_basis. "</br>";
            echo "Cost basis previous is: ".$cost_basis_previous ."</br>";
            //profit or loss = buy price/shares - sell price/shares
            $sold_Shares = ((getTransactionShares($Table_Row) * getPricePerShare($Table_Row)) - $fees);
            echo "Sold Shares profit/loss = ". $sold_Shares. "</br>";
            echo "Previous BOUGHT SHARES Cost Basis = ". $cost_basis_previous. "</br>";
            $Profit_Loss = $sold_Shares - $cost_basis_previous;
            $running_gain_loss_total += $Profit_Loss;
            // 172.28 - 224 = -51.72
            echo " Profit/loss ". $sold_Shares. " - ". $cost_basis_previous." = " . $Profit_Loss. "</br>";
            echo "Test fees function call". fees($fees,$running_fees_total). "</br>";
            echo " New Average price per share (WORKS! sold everything, should be zero) = " . $cost_basis. "</br>";
        }
        // you only sold SOME of your shares and recalculated cost basis, profit/loss, avg price/share
        else {
            $cost_basis_previous = $cost_basis;
            $transacted_value_on_sell = getPricePerShare($Table_Row) * getTransactionShares($Table_Row);

            //TRANSACTED VALUE column (10) for DISPLAY (don't fuck with it)
            $All_Stock_Data[$Table_Row][10] = $transacted_value_on_sell;


            echo "Cost (92.22) ". $transacted_value_on_sell."</br>";
            $number_of_shares_before_sell = (getTransactionShares($Table_Row) + $runningTotal);
            echo " number_of_shares_before_sell = ". $number_of_shares_before_sell. "</br>";
            echo " sold shares = ". getTransactionShares($Table_Row) . "</br>";
            echo " sold price_per_share = ". getPricePerShare($Table_Row). "</br>";
            echo " cost basis above = ". $cost_basis. "</br>";
            //  91.36 = ((811.50 / 17.755954) * 2 shares)
            $cost_of_transaction = (($cost_basis / $number_of_shares_before_sell) * getTransactionShares($Table_Row));
            echo " cost of transaction (91.36) = ". $cost_of_transaction. "</br>";

            //COST OF TRANSACTION column (12) for DISPLAY (don't fuck with it)
            $All_Stock_Data[$Table_Row][12] = $cost_of_transaction;

            //811.50 - 91.36 = 719.695
            $cost_basis = $cost_basis - $cost_of_transaction;
            // Real gain loss from sale (0.86)
            // 92.22 - 91.36 = 0.86
            $realized_gain_or_loss = ((getPricePerShare($Table_Row) * getTransactionShares($Table_Row)) - $cost_of_transaction);
            echo " Realized gain/loss is = ". $realized_gain_or_loss."</br>";
            $running_gain_loss_total += $realized_gain_or_loss;
            echo " running total is NOT 0, so UPDATED cost basis after sale is = ". $cost_basis. "</br>";
            $Profit_Loss = profitLoss($cost_basis, $cost_basis_previous,$Profit_Loss, getTransactionShares($Table_Row),getPricePerShare($Table_Row),$runningTotal );
            echo " Profit/loss on this sale is (incorrect should be negative?) = " . $Profit_Loss. "</br>";
            echo "Test fees function call". fees($fees,$running_fees_total). "</br>";
            echo " average price/per share (WORKS Sell, else sold SOME shares) ". averagePricePerShare() . "</br>";

            //COST OF TRANSACTION PER SHARE column (14) for DISPLAY (don't fuck with it)
            $All_Stock_Data[$Table_Row][13] = averagePricePerShare();

            //CUMULATIVE COST column (14) for DISPLAY (don't fuck with it)
            $All_Stock_Data[$Table_Row][14] = $cost_basis;

            //GAIN-LOSS FROM SALE column (15) for DISPLAY (don't fuck with it)
            $All_Stock_Data[$Table_Row][15] = $realized_gain_or_loss;


            getYieldOnCostOnSale();
            //YIELD ON COST column (16) for DISPLAY (don't fuck with it)
            $yield_on_cost_formatted = sprintf("%.2f%%",$yield_on_cost_sell);
            $All_Stock_Data[$Table_Row][16] = $yield_on_cost_formatted;

        }
    }//end of SELL CONDITION
    //DIVIDEND CONDITION (or whatever)
    elseif ($All_Stock_Data[$Table_Row][2] == "Div" && $All_Stock_Data[$Table_Row][3] == "Cisco Systems, Inc."){
        getTransactionShares($Table_Row);


        $fees = $All_Stock_Data[$Table_Row][6];
        echo '</br>Row: ' . $Table_Row . ' Amount DIV =  ' . getTransactionShares($Table_Row) . ' Stock= '.$All_Stock_Data[$Table_Row][3].
            ' Share Price= '.$All_Stock_Data[$Table_Row][5] .' Fees = ' . $fees. '<br>';
        echo " Dividend transacted shares = ". getTransactionShares($Table_Row) . "</br>";
        echo " Dividend price_per_share = ". getPricePerShare($Table_Row). "</br>";
        echo " Total Dividend = ". $total_dividends_paid. "</br>";

        //PREVIOUS SHARES column (8) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][8] = $runningTotal;
        //PREVIOUS SHARES column (9) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][9] = $runningTotal;
        //PREVIOUS COST column (11) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][11] = $cost_basis;
        //CUMULATIVE COST column (14) for DISPLAY (don't fuck with it)
        $All_Stock_Data[$Table_Row][14] = $cost_basis;


        echo " RUNNING TOTAL WORKS! (Don't fuck with it) == " .$runningTotal . "</br>";
        //getDividendAmount function call
        $total_dividends_paid = getDividendAmount($Table_Row);

        // calculate TOTAL DIVIDENDS PAID call goes here
        $All_dividends = getTotalDividend($total_dividends_paid);

        //$final_dividend += $total_dividends_paid;
        echo "</br>All dividends (after getTotalDividend call) = ".$All_dividends ."</br>";


        getYieldOnCostDividend();

        //TRANSACTED VALUE column (10) for DISPLAY
        $All_Stock_Data[$Table_Row][10] = $total_dividends_paid;

        //GAIN-LOSS FROM SALE column (15) for DISPLAY (don't fuck with it)
        $gain_loss_formatted = round($total_dividends_paid,3);
        //$gain_loss_formatted = sprintf("%.2f%%",$total_dividends_paid);
        $All_Stock_Data[$Table_Row][15] = $gain_loss_formatted;

        //YIELD ON COST column (16) for DISPLAY (don't fuck with it)
        $yield_on_cost_formatted = sprintf("%.2f%%",$yield_on_cost);
        $All_Stock_Data[$Table_Row][16] = $yield_on_cost_formatted;





        //getDividendMonth function call
        $DividendMonth = getDividendMonth($Table_Row);
        echo "</br>Month this dividend was paid is: ".$DividendMonth ."</br>";
        //fees function call
        echo "Test fees function call (Should be zero fees on dividend) ". fees($fees,$running_fees_total). "</br>";
    }// end of DIVIDEND CONDITION
    else {
        echo "</br>Stock split OR wrong company</br>";
        echo 'Row: ' . $Table_Row . ' Stock= '.$All_Stock_Data[$Table_Row][3]. '<br>';
    }
/////////////////////////////////////// END OF COMPANY 1    /////////////////////////////////////////////////
}// end of for loop




////////////////////////////////////////////////////////////////////////////////////////////////////
echo "</br>";
echo " Total shares purchased is: ". $total_shares_purchased . "</br>";
echo " Total shares sold is : " . $total_shares_sold . "</br>";
echo " Total stock (after buy/sell) is : " . $runningTotal . "</br>";
//echo " Total Dividends paid out is: " . $final_dividend . "</br>";
echo " Realized gain/loss is: " . $running_gain_loss_total. "</br>";
echo " Total fees on this stock are: " . $running_fees_total. "</br>";
echo " -------------------------------END of logic---------------------------------------" . '<br>';


////////////////////////////////////TEST TEST TEST TEST TEST//////////////////////////////////////////////////////
// Display the code in a readable format
echo "<pre>";
// DISPLAY TABLE and Display to site with CSV data /////////////////////////
echo "<h2>Transactions Page (from CSV file)\n</h2>";
echo "<table border='1'><br />";
//Display table with 9 columns and rows == array length
$arrayLength = count($All_Stock_Data);
for ($DisplayRow = 0; $DisplayRow < $arrayLength; $DisplayRow ++) {
    echo "<tr>";

    for ($col = 0; $col < 19; $col ++) {
        echo "<td>", $All_Stock_Data[$DisplayRow][$col], "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "</pre>";
