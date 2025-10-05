<?php
echo "<h1>PHP Server is Working!</h1>";
echo "<p>Current PHP Version: " . phpversion() . "</p>";
echo "<p>Current Date and Time: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>Server Information:</p>";
echo "<ul>";
echo "<li>Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "</li>";
echo "<li>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</li>";
echo "<li>Request URI: " . $_SERVER['REQUEST_URI'] . "</li>";
echo "</ul>";
?>