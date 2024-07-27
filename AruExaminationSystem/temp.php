function updateUser($connect, $email, $password, $role, $fullName) {
    // Hash the password
    $hashedPassword = md5($password);

    // Update user in the database
    $updateQuery = mysqli_query($connect, "UPDATE `users` SET `password`='$hashedPassword', `role`='$role', `fullName`='$fullName' WHERE `email`='$email'");
    if ($updateQuery) {
        return "User updated successfully.";
    } else {
        return "Failed to update user.";
    }
}

// Usage example
if (isset($_POST['update-function'])) {
    // Assuming $connect is your database connection
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $fullName = $_POST['fullName'];

    $result = updateUser($connect, $email, $password, $role, $fullName);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: users.php");
    exit();
}