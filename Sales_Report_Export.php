<?php

require_once "config/session.php";
require_once "config/database.php";




echo<<<EOT



<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title> Sales Report</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
      #printPageButton {
        display: none;
        }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
    <div class="page-break">
       <div class="sale-head"> 
           <h1>Inventory Management System - Sales Report <button id="printPageButton" onClick="window.print();">Print</button></h1> 
           <strong> </strong>
       </div>
      <table class="table table-border">
        <thead>
          <tr>
              <th>#</th>
              <th>Product Name</th>
              <th>Stocks Buy Price</th>
              <th>Stcks Sale Price</th>
              <th>Profit</th>
              <th>Quantity</th>
              <th>Price</th>
          </tr>
        </thead>
        <tbody>

EOT;

$sql = "SELECT * , (SUM(qty) - SUM(quantity)) AS 'avlqty' , (SUM(qty) * (SUM(sale_price)-SUM(buy_price))) AS 'Profit' FROM `sales` LEFT JOIN `stocks` ON sales.stock_id = stocks.s_id LEFT JOIN `products` ON `stocks`.`pro_id` = `products`.`pro_id` GROUP BY stocks.s_id;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
$pval='';
$i = 0;
$total =0;
$proofit = 0;
while($row = $result->fetch_assoc()) {
$i++;

$total += $row["price"];
$proofit += $row["Profit"];

$newval = $row["pro_name"];
if ($pval==$newval){
  $name_val = "";

}else {
  $name_val = $row["pro_name"];
  $pval = $newval ;
  # code...
}


echo<<<EOT

    <tr>
       <td class="">#$i </td>
        <td class="desc"> <h6> $name_val </h6></td>
        <td class="text-right">{$row["buy_price"]}</td>
        <td class="text-right">{$row["sale_price"]}</td>
        <td class="text-right">{$row["Profit"]}</td>
        <td class="text-right">{$row["qty"]}</td>
        <td class="text-right">{$row["price"]}</td>
   </tr>

EOT;



}

echo<<<EOT
</tbody>
<tfoot>
<tr class="text-right">
  <td colspan="5"></td>
  <td colspan="1">Grand Total</td>
  <td> Rs. $total.00

 </td>
</tr>
<tr class="text-right">
  <td colspan="5"></td>
  <td colspan="1">Profit</td>
  <td> Rs. $proofit.00 </td>
</tr>
</tfoot>

EOT;


}


echo<<<EOT

       
      </table>
    </div>


</body>
</html>
EOT;







?>