<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $d_sale = find_by_id('sales',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","Id penjualan hilang.");
    redirect('sales.php');
  }
?>
<?php
  $delete_id = delete_by_id('sales',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","Penjualan telah dihapus.");
      redirect('sales.php');
  } else {
      $session->msg("d","Penghapusan penjualan gagal.");
      redirect('sales.php');
  }
?>
