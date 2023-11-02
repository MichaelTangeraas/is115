<?php

// Function to clean a string
function clean_string($input)
{
    // Remove any HTML or PHP tags
    $cleaned = strip_tags($input);

    // Convert special characters to HTML entities
    $cleaned = htmlspecialchars($cleaned, ENT_QUOTES, 'UTF-8');

    return $cleaned;
}

// Function to encrypt text using Caesar Cipher
function caesar_encrypt($text, $shift)
{
    // Clean the input text before processing
    $text = clean_string($text);

    $result = '';

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        if (ctype_alpha($char)) {
            $ascii_offset = ord(ctype_upper($char) ? 'A' : 'a');
            $result .= chr(($ascii_offset + ((ord($char) + $shift - $ascii_offset) % 26)));
        } else {
            $result .= $char;
        }
    }

    return $result;
}

// Function to decrypt text using Caesar Cipher
function caesar_decrypt($text, $shift)
{
    // Clean the input text before processing
    $text = clean_string($text);

    return caesar_encrypt($text, 26 - $shift);
}

// Check if a POST request has been made
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if encryption form was submitted
    if (isset($_POST['encrypt_text']) && isset($_POST['shift_value'])) {
        $encrypt_text = $_POST['encrypt_text'];
        $shift_value = (int)$_POST['shift_value'];

        // Encrypt the text
        $encrypted_text = caesar_encrypt($encrypt_text, $shift_value);
    }

    // Check if decryption form was submitted
    if (isset($_POST['decrypt_text']) && isset($_POST['shift_value'])) {
        $decrypt_text = $_POST['decrypt_text'];
        $shift_value = (int)$_POST['shift_value'];

        // Decrypt the text
        $decrypted_text = caesar_decrypt($decrypt_text, $shift_value);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 5.4</title>
</head>

<h1>Module 5.4</h1>
<p>In module 5.4, we are creating a system for encrypting and decrypting string values.
    <br />
    To demonstrate this, I have created a simple system that encrypts and decrypts a string values using the "caesar cipher" method of encryption.
    <br />
    Caesar Cipher is a simple encryption method that shifts each letter in the alphabet by a certain value.
    <br />
    To decypher the text, you simply shift the letters back by the same value.
</p>

<hr />

<p><b>Disclaimer: This solution does not encrypt norwegian letters (like æøå), and several special characters (like éã).</b></p>

<h2>Caesar Cipher Encryption</h2>
<?php if (isset($encrypted_text)) : ?>
    <!-- Display encrypted text if available -->
    <p>Encrypted Text: <?php echo $encrypted_text; ?></p>
<?php else : ?>
    <!-- Display encryption form if not submitted -->
    <form method="post">
        Enter text to encrypt: <input type="text" name="encrypt_text" required>
        Enter shift value: <input type="number" name="shift_value" min="1" max="25" required>
        <input type="submit" value="Encrypt">
    </form>
<?php endif; ?>

<h2>Caesar Cipher Decryption</h2>
<?php if (isset($decrypted_text)) : ?>
    <!-- Display decrypted text if available -->
    <p>Decrypted Text: <?php echo $decrypted_text; ?></p>
<?php else : ?>
    <!-- Display decryption form if not submitted -->
    <form method="post">
        Enter text to decrypt: <input type="text" name="decrypt_text" required>
        Enter shift value: <input type="number" name="shift_value" min="1" max="25" required>
        <input type="submit" value="Decrypt">
    </form>
<?php endif; ?>

<hr />

<!-- Reset button -->
<form method="post">
    <input type="submit" value="Reset">
</form>


<hr />

<p><a href="../">Click here to go back to Module 5 dashboard</a></p>

</body>

</html>