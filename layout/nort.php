<?php

require_once "../config/database.php";
$sql = "SELECT * , (SUM(quantity)-SUM(qty)) AS 'avlqty' FROM `sales` LEFT JOIN `stocks` ON sales.stock_id = stocks.s_id LEFT JOIN `products` ON `stocks`.`pro_id` = `products`.`pro_id` GROUP BY stocks.s_id;";
$result = $conn->query($sql);
$alartt = "";
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if (!($row["s_alert"] > $row["avlqty"])) {
      continue;
    }
    $alartt .= '<li><hr class="dropdown-divider"></li><li class="notification-item"><i class="bi bi-exclamation-circle text-warning"></i><div><h4> ' . $row["pro_name"] . '  - #B' . $row["batch_no"] . ' -  Avl:(' . $row["avlqty"] . ')  </h4><p> ' . $row["s_alert"] . '</p></div></li>';
  }
}

?>
<li class="nav-item dropdown">
  <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-bell"></i>
  </a>
  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
    <li class="dropdown-header">
      Show all notifications
      <a href="Stocks_Alert.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
    </li>
    <?php echo $alartt; ?>
  </ul>
</li>