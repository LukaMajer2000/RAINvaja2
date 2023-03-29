<?php

include_once("header.php");

if(isset($_GET["adid"])){
    $adid = $_GET["adid"];
    if(isset($_SESSION["USER_ID"])){
        $id = $_SESSION["USER_ID"];
        $readOnly = "readonly";
        $res = mysqli_query($conn,"SELECT * FROM users WHERE id=$id");
        $row = mysqli_fetch_assoc($res);
    }else{
        $readOnly = "";
    }
}else{
    header("Location: index.php");
}

?>

<h2>Add new comment to post:</h2>
<div>
    <form method="post">
        <input id="ip" name="ip" type="hidden" type="text" value="<?php echo $_SERVER["REMOTE_ADDR"];?>"/>

        <label for="nickname">Ad ID:</label><input id="adid" type="text" name="adid" value="<?php echo $_GET["adid"];?>" <?php echo "readonly";?>/><br>

        <label for="nickname">User ID:</label><input id="user_id" type="text" name="user_id" placeholder="Guest" value="<?php if(isset($_SESSION["USER_ID"])){echo $row["id"];}?>" <?php echo "readonly";?>/><br>

        <label for="nickname">Nickname:</label><input id="nickname" type="text" name="nickname" placeholder="Nickname" value="<?php if(isset($_SESSION["USER_ID"])){echo $row["username"];}?>" <?php echo "readonly";?>/><br>

        <label for="email">E-Mail:</label><input id="email" type="text" name="email" value="<?php if(isset($_SESSION["USER_ID"])){echo $row["email"];}?>" <?php echo "readonly";?>/><br>

        <label for="content">Content:</label><textarea id="content" name="content" cols="20" rows="10"></textarea><br>

        <input id="send" type="submit" name="add" value="Add"/>
    </form>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".form-group form").submit(function(a){
            a.preventDefault();
            $.ajax({
                url: "/api/comments",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data){
                    location.href="ad.php?id=<?php echo $_GET["userid"];?>";
                }
            })
        })
    });
</script>