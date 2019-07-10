<?php
// My stock app in PHP
// 6/29/3019
// Jeff Reeder
// This file opens a CSV file and displays it to webpage (duplicating "Transactions page" from old excel file)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//include("class_lib.php");

////////////////////////////////////////////    OPEN CSV FILE   ///////////////////////////////////////////////




//$filename = 'LowesExample-2.csv';
$filename = 'CiscoExample.csv';
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
   
   for ($col = 0; $col < 9; $col ++) {
        echo "<td>", $All_Stock_Data[$DisplayRow][$col], "</td>";
   }
   echo "</tr>";
}

echo "</table>";
echo "</pre>";



////////////////////////////////////////////////////////////////////////////////////////////////////////


$tableRow = 1;
$floatArrayTotalShares = array(0.0);

$floatArrayTransactedSharesColumn = array(0.0);
$floatArrayPricePerShareColumn = array(0.0);
$floatArrayFeesColumn = array(0.0);




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


    $TableRow = 14;

    /*
    echo "Getstock name is: ". getStockName($All_Stock_Data, $TableRow)."</br>";

    if (getTransactionType() == "Sell"){
        echo "Stock name function works! and the name is: ".getTransactionType() ."</br>";
    } else {
        echo "Stock name function DOES NOT work</br>";
    }
*/




    //grab type of transaction: "Buy", "Sell", "Div" or "Split"
    function getTransactionType() {
        global $All_Stock_Data, $TableRow;

        $TransactionType = array_column($All_Stock_Data, '2');	//grab column 3 "Type"
        array_shift($TransactionType);                           //chop off top header
        return $TransactionType[$TableRow];						        //return "Type"
    }





    for($Table_Row = 0; $Table_Row < $arrayLength; $Table_Row++) {

///////////////////////////////////////   START COMPANY 1    /////////////////////////////////////////////////

        //BUY CONDITION
        if ($All_Stock_Data[$Table_Row][2] == "Buy" && getStockName() == "Cisco Systems, Inc.") {
            $transacted_shares = $All_Stock_Data[$Table_Row][4];
            $total_shares_purchased += $All_Stock_Data[$Table_Row][4];
            $fees = $All_Stock_Data[$Table_Row][6];
            runningSharesTotalBuy($Table_Row);

            echo '</br>Row: ' . $Table_Row . ' Amount BUY: ' . $transacted_shares . ' Stock='. $All_Stock_Data[$Table_Row][3].
                ' Share Price= '.$All_Stock_Data[$Table_Row][5] .' Fees = ' . $fees. '<br>';
            echo " RUNNING TOTAL WORKS! (Don't fuck with it) == " .$runningTotal . "</br>";

            //We have zero shares (1st time) or we have bought/sold back to zero shares and will re-purchase (2nd time)
            if($cost_basis == 0){
                //do nothing first round
                echo "1st ROUND COST BASIS(zero) = ".$cost_basis . "</br>";
                echo " Fees = ". $fees."</br>";
                $cost_basis = ($fees + ($transacted_shares * $price_per_share));
                fees($fees,$running_fees_total);

                echo "We know this is first round so cost basis is = ".$cost_basis ."</br>";
                echo "average price/per share (WORKS buy, if(costbasis = 0)= ". averagePricePerShare() . "</br>";

            }
            //We are adding to original purchase with more shares
            else {
                addMoreShares($cost_basis,$cost_basis_previous);
                averagePricePerShare();
                echo "average price/per share (WORKS buy, else costbasis != 0) ". averagePricePerShare() . "</br>";
                echo "Test fees function call". fees($fees,$running_fees_total). "</br>";
            }
        }//end of BUY CONDITION
        //SELL CONDITION
        elseif ($All_Stock_Data[$Table_Row][2] == "Sell" && getStockName() == "Cisco Systems, Inc."){
            $sellAmt = $All_Stock_Data[$Table_Row][4];
            $total_shares_sold += $All_Stock_Data[$Table_Row][4];
            $fees = $All_Stock_Data[$Table_Row][6];
            echo '</br>Row: ' . $Table_Row . ' Amount SELL: ' . $sellAmt . ' Stock='. $All_Stock_Data[$Table_Row][3].
                ' Share Price= '.$All_Stock_Data[$Table_Row][5] .' Fees = ' . $fees. '<br>';

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
                    $sold_Shares = (($transacted_shares * $price_per_share) - $fees);
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
                    echo "Cost (92.22) ". $price_per_share * $transacted_shares."</br>";

                    $number_of_shares_before_sell = ($transacted_shares + $runningTotal);
                    echo " number_of_shares_before_sell = ". $number_of_shares_before_sell. "</br>";
                    echo " sold shares = ". $transacted_shares. "</br>";
                    echo " sold price_per_share = ". $price_per_share. "</br>";
                    echo " cost basis above = ". $cost_basis. "</br>";
                    //  91.36 = ((811.50 / 17.755954) * 2 shares)
                    $cost_of_transaction = (($cost_basis / $number_of_shares_before_sell) * $transacted_shares);
                    echo " cost of transaction (91.36) = ". $cost_of_transaction. "</br>";

                    //811.50 - 91.36 = 719.695
                    $cost_basis = $cost_basis - $cost_of_transaction;

                    // Real gain loss from sale (0.86)
                    // 92.22 - 91.36 = 0.86
                    $realized_gain_or_loss = (($price_per_share * $transacted_shares) - $cost_of_transaction);
                    echo " Realized gain/loss is = ". $realized_gain_or_loss."</br>";
                    $running_gain_loss_total += $realized_gain_or_loss;
                    echo " running total is NOT 0, so UPDATED cost basis after sale is = ". $cost_basis. "</br>";



                    $Profit_Loss = profitLoss($cost_basis, $cost_basis_previous,$Profit_Loss, $transacted_shares,$price_per_share,$runningTotal );


                    echo " Profit/loss on this sale is (incorrect should be negative?) = " . $Profit_Loss. "</br>";
                    echo "Test fees function call". fees($fees,$running_fees_total). "</br>";
                    echo " average price/per share (WORKS Sell, else sold SOME shares) ". averagePricePerShare() . "</br>";
                }

        }//end of SELL CONDITION
        //DIVIDEND CONDITION (or whatever)
        elseif ($All_Stock_Data[$Table_Row][2] == "Div" && getStockName() == "Cisco Systems, Inc."){
            $transacted_shares = $All_Stock_Data[$Table_Row][4];
            //$div_total += $All_Stock_Data[$Table_Row][4];
            //cho "DIV TOTAL IS: ". $div_total."</br>";
            $price_per_share = $All_Stock_Data[$Table_Row][5];
            $fees = $All_Stock_Data[$Table_Row][6];
            echo '</br>Row: ' . $Table_Row . ' Amount DIV =  ' . $transacted_shares . ' Stock='. $All_Stock_Data[$Table_Row][3].
                ' Share Price= '.$All_Stock_Data[$Table_Row][5] .' Fees = ' . $fees. '<br>';


            echo " Dividend transacted shares = ". $transacted_shares. "</br>";
            echo " Dividend price_per_share = ". $price_per_share. "</br>";
            echo " Total Dividend = ". $total_dividends_paid. "</br>";


            //getDividendAmount function call
            $total_dividends_paid = getDividendAmount($Table_Row, $All_Stock_Data);

            // calculate TOTAL DIVIDENDS PAID call goes here

            $All_dividends = getTotalDividend($total_dividends_paid);
            //$final_dividend += $total_dividends_paid;


            echo "</br>All dividends (after getTotalDividend call) = ".$All_dividends ."</br>";

            //getDividendMonth function call
            $DividendMonth = getDividendMonth($Table_Row);
            echo "</br>Month this dividend was paid is: ".$DividendMonth ."</br>";

            //fees function call
            echo "Test fees function call (Should be zero fees on dividend) ". fees($fees,$running_fees_total). "</br>";

        }// end of DIVIDEND CONDITION
        else {
            echo "Stock split or NOTHING</br>";
        }
/////////////////////////////////////// END OF COMPANY 1    /////////////////////////////////////////////////


    } // end of for loop

/////////////////////////////////////// FUNCTIONS (need to be moved to new file) /////////////////////


    // Name of COMPANY under the "Stock" column name (index[3] or 4th column)//////////////////////////////
    function getStockName() {
        global $All_Stock_Data, $TableRow;

        $companyName = array_column($All_Stock_Data, '3');	//grab column 4 "company name"
        array_shift($companyName);                           //chop off top header
        return $companyName[$TableRow];						        //return "company name"
    }


    function profitLoss($cost_basis, $cost_basis_previous,$Profit_Loss, $transacted_shares,$price_per_share,$runningTotal ){
        global $cost_basis, $Profit_Loss;
        echo " PROFIT--LOSS function--------BEGIN----------------------------</br>";
        echo " PROFIT--LOSS function (cost basis previous) is: ".$cost_basis_previous ."</br>";
        echo " PROFIT--LOSS function (cost basis) is: ".$cost_basis ."</br>";
        echo " PROFIT--LOSS function (transacted_shares) is: ".$transacted_shares ."</br>";
        echo " PROFIT--LOSS function (price_per_share) is: ".$price_per_share ."</br>";


        $Profit_Loss =  $cost_basis_previous - $cost_basis;
        echo "INSIDE profit-loss function (Profit_Loss RECALCULATED) is: ". $Profit_Loss ."</br>";
        echo "testing PROFIT--LOSS function--------END----------------------------</br>";

    }

    //Average price per share = Cost Basis / total shares
    function averagePricePerShare(){
        global $cost_basis, $runningTotal;

        $average_price_per_share = $cost_basis / $runningTotal;
        return $average_price_per_share;
    }

    function addMoreShares($cost_basis,$cost_basis_previous)
    {
        global $cost_basis, $cost_basis_previous, $transacted_shares, $price_per_share, $fees;

        echo " ADD MORE SHARES function--------BEGIN----------------------------</br>";

        $cost_basis_previous = $cost_basis;
        echo " ADD MORE SHARES cost_basis_previous should be previous = " . $cost_basis_previous . "</br>";
        $cost_basis = ($fees + ($transacted_shares * $price_per_share));
        echo " ADD MORE SHARES transacted shares= " . $transacted_shares . "</br>";
        echo " ADD MORE SHARES price per share= " . $price_per_share . "</br>";
        echo " ADD MORE SHARES Cost basis (Either new shares or Dividend re-invest) " . $cost_basis . "</br>";
        $cost_basis = $cost_basis + $cost_basis_previous;
        echo " ADD MORE SHARES--CUMULATIVE Cost Basis= " . $cost_basis . "</br>";

        echo " ADD MORE SHARES function--------END----------------------------</br>";
    }

    //$cost_basis = ($fees + ($transacted_shares * $price_per_share));


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

    function fees($fees, $running_fees_total){
        global $fees,$running_fees_total;
        echo " CALCULATE FEES function--------BEGIN----------------------------</br>";
        echo "Fees on this transaction are: ". $fees."</br>";
        $running_fees_total = $running_fees_total + $fees;
        echo "Total fees up to this point are:  ". $running_fees_total."</br>";
        echo " CALCULATE FEES function--------END----------------------------</br>";
    }

    //display dividend amount in table (under month column) = make into function

    function getDividendMonth($Table_Row){

        global $All_Stock_Data;

        echo "------------- START GET MONTH FUNCTION------------------------";
        $DividendMonth = $All_Stock_Data[$Table_Row][1];

        $StringTime = strtotime($DividendMonth);
        echo "</br>UNIX time from ".$DividendMonth ." is ".$StringTime . "</br>";
        $IntegerTime = getdate($StringTime);


        $month = $IntegerTime["mon"];
        echo "Month from ".$DividendMonth ." is: ". $month."</br>";
        echo "------------- END GET MONTH FUNCTION------------------------";
        return $month;
    }

    function getDividendAmount($Table_Row, $All_Stock_Data){

        global $All_Stock_Data;
        echo "GET DIV AMOUNT FUNCTION---------BEGIN---------------";
        $transacted_shares = $All_Stock_Data[$Table_Row][4];
        $price_per_share = $All_Stock_Data[$Table_Row][5];
        $DividendAmount = $transacted_shares * $price_per_share;

        echo "</br>Dividend amount is:" .$DividendAmount ."</br>";
        echo "GET DIV AMOUNT  FUNCTION---------END---------------";
        return $DividendAmount;
    }

    function getTotalDividend($total_dividends_paid){

        global $final_dividend, $total_dividends_paid;
        echo "</br>GET TOTAL DIVIDEND FUNCTION---------BEGIN---------------";

        //code from above
        $final_dividend += $total_dividends_paid;


        echo "</br>Final dividend  amount is:" .$final_dividend ."</br>";
        echo "GET TOTAL DIVIDEND  FUNCTION---------END---------------";
        return $final_dividend;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    echo "</br>";
    echo " Total shares purchased is: ". $total_shares_purchased . "</br>";
    echo " Total shares sold is : " . $total_shares_sold . "</br>";
    echo " Total stock (after buy/sell) is : " . $runningTotal . "</br>";
    echo " Total Dividends paid out is: " . $final_dividend . "</br>";
    echo " Realized gain/loss is: " . $running_gain_loss_total. "</br>";
    echo " Total fees on this stock are: " . $running_fees_total. "</br>";


echo " -------------------------------END of logic---------------------------------------" . '<br>';


////////////////////////////////////TEST TEST TEST TEST TEST///////////////////////////////////////////////////////////

