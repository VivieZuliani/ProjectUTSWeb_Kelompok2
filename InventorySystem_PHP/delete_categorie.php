<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $categorie = find_by_id('categories',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Id kategori hilang.");
    redirect('categorie.php');
  }
?>
<?php
  $delete_id = delete_by_id('categories',(int)$categorie['id']);
  if($delete_id){
      $session->msg("s","Kategori telah dihapus.");
      redirect('categorie.php');
  } else {
      $session->msg("d","Penghapusan kategori gagal.");
      redirect('categorie.php');
  }
?>
