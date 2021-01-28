<?php
  $page_title = 'Add Opportunity';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('accounts');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_opportunity'])){
   $req_fields = array('Opportunity','description','amount','stage');
   validate_fields($req_fields);
   if(empty($errors)){
     $Opportunity  = remove_junk($db->escape($_POST['Opportunity']));
     $p_desc  = remove_junk($db->escape($_POST['description']));
     $amount   = remove_junk($db->escape($_POST['amount']));
     $stage   = remove_junk($db->escape($_POST['stage']));
     $p_acc   =remove_junk($db->escape($_POST['account']));

     $query  = "INSERT INTO Opportunity (";
$query .=" accid,Opportunity,description,amount,stage";
$query .=") VALUES (";
$query .=
"'{$p_acc}','{$Opportunity}','{$p_desc}','{$amount}','{$stage}'";
     $query .=")";
     
     if($db->query($query)){
       $session->msg('s',"Opportunity added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to add Opportunity!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Opportunity</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="Opportunity" placeholder="Opportunity">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="account">
                      <option value="">Select Account Type</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['account'] ?></option>
                    <?php endforeach; ?>
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
                     <input type="number" class="form-control" name="amount" placeholder="Amount">
                 
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
              <button type="submit" name="add_opportunity" class="btn btn-danger">Add Opportunity</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
