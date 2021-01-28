<?php
  $page_title = 'Edit categorie';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $categorie = find_by_id('accounts',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing categorie id.");
    redirect('categorie.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('account');
  $req_field = array('email');
  $req_field = array('address');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['account']));
  $email = remove_junk($db->escape($_POST['email']));
  $address = remove_junk($db->escape($_POST['address']));
  if(empty($errors)){
        $sql = "UPDATE accounts SET account='{$cat_name}',email='{$email}',postalAddress='{$address}'";
       $sql .= " WHERE id='{$categorie['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated Categorie");
       redirect('categorie.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('categorie.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('categorie.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing <?php echo remove_junk(ucfirst($categorie['account']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_categorie.php?id=<?php echo (int)$categorie['id'];?>">
  <div class="form-group">
    <input type="text" class="form-control" name="account" value="<?php echo remove_junk(ucfirst($categorie['account']));?>">
    <input type="text" class="form-control" name="email" value="<?php echo remove_junk(ucfirst($categorie['email']));?>">
    <input type="text" class="form-control" name="address" value="<?php echo remove_junk(ucfirst($categorie['postalAddress']));?>">
           </div>
           <button type="submit" name="edit_cat" class="btn btn-primary">Update Account</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
