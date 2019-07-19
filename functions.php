
<?php

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
    global $cost_basis, $Profit_Loss;

    $Profit_Loss =  $cost_basis_previous - $cost_basis;
    return $Profit_Loss;
}
//Average price per share = Cost Basis / total shares
function averagePricePerShare(){
    global $cost_basis, $runningTotal;
    $average_price_per_share = $cost_basis / $runningTotal;
    return $average_price_per_share;
}
function addMoreShares($cost_basis,$cost_basis_previous){
    global $cost_basis, $cost_basis_previous, $transacted_shares, $transacted_value, $Table_Row, $fees;

    $cost_basis_previous = $cost_basis;
    $cost_basis = ($fees + ($transacted_shares * getPricePerShare($Table_Row)));
    $transacted_value = $cost_basis;
    $cost_basis = $cost_basis + $cost_basis_previous;
}

function runningSharesTotalBuy($Table_Row){
    global $transacted_shares, $runningTotal;

    $transacted_shares = getTransactionShares($Table_Row);
    $runningTotal += $transacted_shares;
}
function runningSharesTotalSell($Table_Row){
    global $transacted_shares, $runningTotal;

    $transacted_shares = getTransactionShares($Table_Row);
    $runningTotal -= $transacted_shares;
}
function fees($fees, $running_fees_total){
    global $fees,$running_fees_total;

    $running_fees_total = $running_fees_total + $fees;
}
function getTotalDividend($total_dividends_paid){
    global $final_dividend, $total_dividends_paid;

    $final_dividend += $total_dividends_paid;
    return $final_dividend;
}
function getDividendAmount($Table_Row){
    global $DividendAmount;

    $DividendAmount = getTransactionShares($Table_Row) * getPricePerShare($Table_Row);
    return $DividendAmount;
}

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

function getYieldOnCostDividend(){
    global $DividendAmount,$cost_basis, $yield_on_cost;

    $yield_on_cost = (($DividendAmount) / ($cost_basis) * 100);
}

function getYieldOnCostOnSale(){
    global $Profit_Loss, $realized_gain_or_loss, $yield_on_cost_sell;

    $yield_on_cost_sell = (($realized_gain_or_loss) / ($Profit_Loss) * 100);
}
?>