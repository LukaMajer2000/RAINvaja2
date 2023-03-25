<h3>Control panel:</h3>
<a href="?Controller=users&action=add"><button>Add</button></a>
<a href="?Controller=users&action=deleteAll&id=<?php echo $_SESSION["USER_ID"]; ?>" onclick="return confirm('Are you sure?')"><button>Delete all</button></a>
<div>
  <table>


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
                <button>Display</button>
              </a>
            </td>
            <td>
              <a href="?Controller=users&action=edit&id=<?php echo $user->id; ?>">Edit</a>
            </td>
            <td>
              <a href="?Controller=users&action=delete&id=<?php echo $user->id; ?>">Delete</a>
            </td>
          </tr>
      <?php } ?>
    </tbody>


  </table>
</div>