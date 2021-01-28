<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $categorie = find_by_id('accounts',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing Account id.");
    redirect('categorie.php');
  }
?>
<?php
  $delete_id = delete_by_id('accounts',(int)$categorie['id']);
  if($delete_id){
      $session->msg("s","Account deleted.");
      redirect('categorie.php');
  } else {
      $session->msg("d","Account deletion failed.");
      redirect('categorie.php');
  }
?>
