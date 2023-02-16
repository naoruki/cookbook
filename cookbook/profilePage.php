
<div class="card">
  <div class="card-header">
   <h2>Hello! <?php echo $nameSession  ?></h2>
  </div>
  <div class="card-body">
    <?php 
        $result = DB::query("SELECT * FROM users 
        WHERE userID = %s",$userIDsession);
        foreach ($result as $row) 
        { 
    ?>
    <p class="card-text">Email : <?php echo $row['email'] ?></p>
    <?php $date=date_create($row['joinDate']); ?>
    <p class="card-text">Last Updated : <?php echo date_format($date,"d/m/Y H:i:s") ?></p>
    <?php }?>
  </div>
</div>