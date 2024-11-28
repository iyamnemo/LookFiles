<?php
include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contact = $_POST['contact_details'];
    $address = $_POST['home_address'];

    if (!empty($_FILES['profile_picture']['name'])) {
        $profile_picture = $_FILES['profile_picture']['name'];
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], "upload/$profile_picture");
        $sql = "UPDATE users SET contact_details='$contact', home_address='$address', profile_picture='$profile_picture' WHERE id=$user_id";
    } else {
        $sql = "UPDATE users SET contact_details='$contact', home_address='$address' WHERE id=$user_id";
    }

    $conn->query($sql);
    header('Location: dashboard.php');
}

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="file" name="profile_picture">
    <input type="text" name="contact_details" value="<?php echo $user['contact_details']; ?>" placeholder="Contact Details">
    <textarea name="home_address" placeholder="Home Address"><?php echo $user['home_address']; ?></textarea>
    <button type="submit">Save Changes</button>
</form>
