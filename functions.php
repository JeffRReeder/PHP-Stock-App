
<?php
/////////////////////////////////////// FUNCTIONS (need to be moved to new file) /////////////////////
// Name of COMPANY under the "Stock" column name (index[3] or 4th column)//////////////////////////////
function getStockName() {
global $All_Stock_Data, $TableRow;
$companyName = array_column($All_Stock_Data, '3');	//grab column 4 "company name"
array_shift($companyName);                           //chop off top header
return $companyName[$TableRow];						        //return "company name"
}

// get 5th column "Transacted shares"
function getTransactionShares($Table_Row) {
global $All_Stock_Data;

$transacted_shares = $All_Stock_Data[$Table_Row][4];
return $transacted_shares;
}

// get 6th column "Transacted price per share"
function getPricePerShare($Table_Row) {
global $All_Stock_Data;

$price_per_share = $All_Stock_Data[$Table_Row][5];
return $price_per_share;
}

function profitLoss($cost_basis, $cost_basis_previous,$Profit_Loss){
global $cost_basis, $Profit_Loss, $Table_Row;
echo " PROFIT--LOSS function--------BEGIN----------------------------</br>";
echo " PROFIT--LOSS function (cost basis previous) is: ".$cost_basis_previous ."</br>";
echo " PROFIT--LOSS function (cost basis Now) is: ".$cost_basis ."</br>";
echo " PROFIT--LOSS function (transacted_shares) is: ".getTransactionShares($Table_Row) ."</br>";
echo " PROFIT--LOSS function (price_per_share) is: ".getPricePerShare($Table_Row) ."</br>";
$Profit_Loss =  $cost_basis_previous - $cost_basis;
echo "INSIDE profit-loss function (Profit_Loss RECALCULATED) is: ". $Profit_Loss ."</br>";
echo " PROFIT--LOSS function--------END----------------------------</br>";
return $Profit_Loss;
}
//Average price per share = Cost Basis / total shares
function averagePricePerShare(){
global $cost_basis, $runningTotal;
$average_price_per_share = $cost_basis / $runningTotal;
return $average_price_per_share;
}
function addMoreShares($cost_basis,$cost_basis_previous)
{
global $cost_basis, $cost_basis_previous, $transacted_shares, $Table_Row, $fees;
echo " ADD MORE SHARES function--------BEGIN----------------------------</br>";
$cost_basis_previous = $cost_basis;
echo " ADD MORE SHARES cost_basis_previous should be previous = " . $cost_basis_previous . "</br>";
$cost_basis = ($fees + ($transacted_shares * getPricePerShare($Table_Row)));
echo " ADD MORE SHARES transacted shares= " . $transacted_shares . "</br>";
echo " ADD MORE SHARES price per share= " . getPricePerShare($Table_Row) . "</br>";
echo " ADD MORE SHARES Cost basis (Either new shares or Dividend re-invest) " . $cost_basis . "</br>";
$cost_basis = $cost_basis + $cost_basis_previous;
echo " ADD MORE SHARES--CUMULATIVE Cost Basis= " . $cost_basis . "</br>";
echo " ADD MORE SHARES function--------END----------------------------</br>";
}
//$cost_basis = ($fees + ($transacted_shares * $price_per_share));
function runningSharesTotalBuy($Table_Row){
global $transacted_shares, $price_per_share, $runningTotal, $All_Stock_Data;
$transacted_shares = getTransactionShares($Table_Row);
$price_per_share = getPricePerShare($Table_Row);
$runningTotal += $transacted_shares;
}
function runningSharesTotalSell($Table_Row){
global $transacted_shares, $price_per_share, $runningTotal, $All_Stock_Data;
$transacted_shares = getTransactionShares($Table_Row);
$price_per_share = getPricePerShare($Table_Row);
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
//$price_per_share = $All_Stock_Data[$Table_Row][5];
$DividendAmount = getTransactionShares($Table_Row) * getPricePerShare($Table_Row);
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
?>