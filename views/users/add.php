<div  class="col-md-6 offset-md-3 text-center bg-light">
<h2>Add new user:</h2>
<form action="?Controller=users&action=save" method="POST">
    <div class="form-group">
        <label>Username:</label><input type="text" placegolder="Username" name="username" /> <br />
        <label>Password:</label><input type="password" placegolder="Password" name="password" /> <br />
        <input type="submit" name="submit" value="Add" /> <br />
    </div>
</form>
</div>