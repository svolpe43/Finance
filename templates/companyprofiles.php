<!--Stock Info-->
<div id="title">
<?php if ($dummy == true) echo "<h4>Some Sample Quotes</h4>";
      else echo "<h4>Company Details</h4>";
?>
</div>
<hr>
<div class="container">
    <ul class="nav nav-tabs">
        <?php foreach($companies as $company): ?>
          <li<?php if($company["ref"] == 1) echo " class='active'"?>>
                <a href="#tab<?=$company['ref']?>" data-toggle="tab"><?=$company["name"]?></a>
         </li>
        <? endforeach ?>
    </ul>
    <div class="tab-content">
        <?php foreach($companies as $company): ?>
            <div class="tab-pane<?php if($company['ref'] == 1) echo ' active'?>" id="tab<?= $company['ref']?>">
                <div><br>
                <?php extract($company);?>
                    <img src="<?= $data[0]['img'] ?>"><br>
                    <img src="<?= $data[1]['img']?>"><br><br>
                    <img src="<?= $data[6]['img']?>"><br><br>
                    <img src="<?= $data[7]['img']?>"><br>
                    <hr>
                    <p><strong><?php echo $data[3]["title"]; ?></strong></p>
                    <img src="<?= $data[3]['img']?>"><br><br><hr>
                    <p><strong><?php echo $data[2]["title"]; ?></strong></p>
                    <img src="<?= $data[2]['img']?>"><br><br>
                    <p><strong><?php echo $data[4]["title"]; ?></strong></p>
                    <img src="<?= $data[4]['img']?>"><br><br>
                </div>
            </div>
        <? endforeach ?>
    </div>
</div>
