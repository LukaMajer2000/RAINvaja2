<div>
    <div>
        <div>
            <h2><?php echo $user->username; ?></h2>
            <span><?php echo "Name: " . $user->firstname . " " . $user->surname; ?></span>
        </div>
        <div>
            <?php
                echo "Username:" . $user->username . "<br>";
                echo "E-Mail:" . $user->email . "<br>";
                echo "Address:" . $user->address . "<br>";
                echo "Post:" . $user->post . "<br>";
                echo "Phone:" . $user->phone . "<br>";
                echo "Gender:" . $user->gender . "<br>";
                echo "Birthday:" . $user->birthday . "<br>";
                echo "Admin status:" . $user->isAdmin . "<br>";
            ?>
        </div>
    </div>
</div>