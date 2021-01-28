<?php
  $page_title = 'Edit product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product = find_by_id('opportunity',(int)$_GET['id']);
$all_categories = find_all('accounts');
if(!$product){
  $session->msg("d","Missing opportunity id.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['update-opp'])){
   $req_fields = array('opportunity');
   $req_fields = array('account');
   $req_fields = array('description');
   $req_fields = array('amount');
   $req_fields = array('stage');
    validate_fields($req_fields);

   if(empty($errors)){
     $opportunity  = remove_junk($db->escape($_POST['opportunity']));
     $accid = remove_junk($db->escape($_POST['account']));
     $description   = remove_junk($db->escape($_POST['description']));
     $amount   = remove_junk($db->escape($_POST['amount']));
     $stage  = remove_junk($db->escape($_POST['stage']));
    
       $query   = "UPDATE Opportunity SET";
        $query  .=" opportunity='{$opportunity}',description='{$description}',amount='{$amount}',
        stage='{$stage}',accid='{$accid}'";
     
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Opportunity updated ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Sorry failed to update!');
                 redirect('edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Update Opportunity</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="opportunity" value="<?php echo remove_junk($product['opportunity']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                  <select class="form-control" name="account">
            
                      <option value="">Select Account</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['account'] ?></option>
                    <?php endforeach; ?>
                    </select>
                 </select>
                  </div>
            
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-th-large"></i>
                     </span>
                     <input type="text" class="form-control" name="description" placeholder="Description">
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th"></i>
                     </span>
                     <input type="text" class="form-control" name="amount" placeholder="amount">
                 
                  </div>
                 </div>
                  
              <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-th"></i>
                      </span>
                      <select class="form-control" name="stage" placeholder="Stage">
                      <option value="">Select Stage</option>
                      <option> Discovery</option>
                      <option> Proposal</option>
                      <option> Shared</option>
                      <option> Negotiations</option>
                      </select>
                      
                   </div>
                  </div>
                    

                 
               </div>
              </div>
              <button type="submit" name="update-opp" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
