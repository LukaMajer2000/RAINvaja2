<div class="col-md-6 offset-md-3 text-center bg-light">
<h3>Control panel:</h3>
<a href="?Controller=users&action=add"><button class="btn btn-secondary text-primary bg-light">Add</button></a>
<a href="?Controller=users&action=clean&id=<?php echo $_SESSION["USER_ID"]; ?>" onclick="return confirm('Are you sure?')"><button class="btn btn-secondary text-danger bg-light">Delete all</button></a>
<br></br>
<div>
  <table class="table table-bordered text-center">


    <thead>
      <tr>
        <th>Username</th>
        <th>Name</th>
        <th>More information</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>


    <tbody>
      <?php foreach ($users as $user) { ?>
          <tr>
            <td><?php echo $user->firstname . " " . $user->surname; ?></td>
            <td><?php echo $user->username; ?></td>
            <td>
              <a href="?Controller=users&action=display&id=<?php echo $user->id; ?>">
                <button class="btn btn-secondary text-info bg-light ">Display</button>
              </a>
            </td>
            <td>
              <button class="btn btn-secondary text-danger bg-light "><a href="?Controller=users&action=edit&id=<?php echo $user->id; ?>">Edit</a>
            </td>
            <td>
              <button class="btn btn-secondary text-danger bg-light "><a href="?Controller=users&action=delete&id=<?php echo $user->id; ?>">Delete</a>
            </td>
          </tr>
      <?php } ?>
    </tbody>


  </table>
</div>
</div>