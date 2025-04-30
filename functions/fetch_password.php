<?php
session_start();
include("../includes/db.php"); // Make sure this file connects to your database

// Check if email is provided
if (isset($_POST['email'])) {
    // Sanitize the email input
    $email = mysqli_real_escape_string($con, $_POST['email']);
    
    // Query to fetch the user's name from the database
    $query = "SELECT customer_name FROM customers WHERE customer_email = '$email'";
    $result = mysqli_query($con, $query);
    
    // If email exists in the database
    if (mysqli_num_rows($result) > 0) {
        // Fetch the user's name
        $row = mysqli_fetch_assoc($result);
        $customer_name = $row['customer_name'];
        
        // Generate a random 8-character password with letters and numbers
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $random_password = substr(str_shuffle($characters), 0, 8); // Generate 8 character password
        
        // Update the database with the new password
        $update_query = "UPDATE customers SET customer_pass = '$random_password' WHERE customer_email = '$email'";
        if (mysqli_query($con, $update_query)) {
            // Send the data (new password and name) back to the frontend
            echo json_encode(array("status" => "success", "password" => $random_password, "name" => $customer_name));
        } else {
            // If there was an error updating the password
            echo json_encode(array("status" => "error", "message" => "Failed to update password"));
        }
    } else {
        // If email is not found
        echo json_encode(array("status" => "error", "message" => "No account found with this email"));
    }
} else {
    // If no email is provided
    echo json_encode(array("status" => "error", "message" => "Email is required"));
}
?>
