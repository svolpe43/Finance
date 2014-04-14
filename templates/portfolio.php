<div>
    <h3>
        <small>Stock data is 15 minutes behind live time.</small>
    </h3>
</div>
<?php if(!empty($_GET["name"])) require("../templates/success.php");?>
<br>

<?php if($dummy != true) require("../templates/portfoliotable.php"); ?>

<?php if($SessionId != false) require("../templates/transaction_form.php"); ?>

<?php if($dummy != true) require("../templates/companyprofiles.php"); ?>

