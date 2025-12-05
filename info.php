<?php
echo "<h1>PHP Info Test</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server: " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p>Script Name: " . $_SERVER['SCRIPT_NAME'] . "</p>";

if (file_exists('css/sss.css')) {
    echo "<p style='color: green;'>CSS file exists</p>";
} else {
    echo "<p style='color: red;'>CSS file missing</p>";
}

if (file_exists('assets/apot.jpeg')) {
    echo "<p style='color: green;'>Logo file exists</p>";
} else {
    echo "<p style='color: red;'>Logo file missing</p>";
}
?>