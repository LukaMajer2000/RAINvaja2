<div  class="col-md-6 offset-md-3 text-center bg-light">
<h2>Edit user: <?php echo $user->username; ?></h2>
<form action="?Controller=users&action=editConfirm" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id">Id:</label><input type="text" name="id" value="<?php echo $user->id;?>" readonly/><br>
        <label for="username">Username:</label><input type="text" name="username" value="<?php echo $user->username;?>"/><br>
        <label for="firstname">Firstname:</label><input type="text" name="firstname" value="<?php echo $user->firstname;?>"/><br>
        <label for="surname">Surname:</label><input type="text" name="surname" value="<?php echo $user->surname;?>"/><br>
        <label for="email">E-mail:</label><input type="text" name="email" value="<?php echo $user->email;?>"/><br>
        <label for="address">Address:</label><input type="text" name="address" value="<?php echo $user->address;?>"/><br>
        <label for="post">Post:</label><input type="text" name="post" value="<?php echo $user->post;?>"/><br>
        <label for="phone">Phone:</label><input type="text" name="phone" value="<?php echo $user->phone;?>"/><br>
        <label for="gender">Gender:</label><input type="text" name="gender" value="<?php echo $user->gender;?>"/><br>
        <label for="birthday">Birthday:</label><input type="text" name="birthday" value="<?php echo $user->birthday;?>"/><br>
        <label for="isAdmin">Admin:</label><input type="text" name="isAdmin" value="<?php echo $user->isAdmin;?>"/><br>
        <input class="btn btn-secondary text-info bg-light " type="submit" name="confirm" value="Confirm"/>
    </div>
</form>
</div>