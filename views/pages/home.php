<div class="col-md-6 offset-md-3 text-center bg-light">
<?php
  if($user->username!="Empty" && $user->email!="Empty"){
    ?>
    <br>
    <h1>User <?php echo $user->username; ?> </h1>
    <p>
      <?php
        echo "Username:" . $user->username . "<br>";
        echo "E-Mail:" . $user->email . "<br>";
        echo "Address:" . $user->address . "<br>";
        echo "Post:" . $user->post . "<br>";
        echo "Phone:" . $user->phone . "<br>";
        echo "Gender:" . $user->gender . "<br>";
        echo "Birthday:" . $user->birthday . "<br>";
        /*echo "Admin STATUS!" . $user->isAdmin . "<br>";*/
      ?>
    </p>
    <?php
  } else {
    ?><p>Error, user doesn't exist!</p><?php
  }
?>
</div>