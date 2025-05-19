<?php
// ---------------this php file will do an loging for all emails that was sent------------
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = isset($_POST["Name"]) ? htmlspecialchars($_POST["Name"]) : '';
    $email   = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : '';
    $message = isset($_POST["message"]) ? htmlspecialchars($_POST["message"]) : '';
    $date    = date("Y-m-d H:i:s");

    // Generate a unique message ID
    $messageId = uniqid("msg_"); // Example: msg_6637d2c5ec6b4

    $file = "submissions.csv";
    $isNewFile = !file_exists($file);

    $data = [$messageId, $name, $email, $message, $date];

    $handle = fopen($file, "a");

    if ($isNewFile) {
        fputcsv($handle, ["Message ID", "Name", "Email", "Message", "Date"]);
    }

    fputcsv($handle, $data);
    fclose($handle);

    echo "✅ Data saved with Message ID!";
    http_response_code(200);
} else {
    http_response_code(400);
    echo "❌ Invalid request.";
}
?>
