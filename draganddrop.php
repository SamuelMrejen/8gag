<?php
session_start();
require 'connexion.php';

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif', 'zip');
if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {
	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
    $newname = uniqid() . '.' . $extension;
	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}
	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'. $newname)){

        //move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/' . $newname);
		echo '{"status":"success"}';
        $stmt = $dbh->prepare('INSERT INTO pictures (name, date, ip_adress, id_user) VALUES (:name, NOW(), :ip_adress, :id_usr)');
        $stmt->execute([
            ':name' => $newname,
            ':ip_adress'=>$_SERVER['REMOTE_ADDR'],
            ':id_usr'=>$_SESSION['id_user']
            ]);
		exit;
	}
}
echo '{"status":"error"}';
exit;