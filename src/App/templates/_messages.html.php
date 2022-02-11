<?php
/** @var Session $session */

use Framework\Http\Session;

echo '<div>';
foreach ($session->consumeMessages() as $message) {
    echo("<div style='background-color: darkgray; padding: .5em; display: flex; justify-content: space-between;'>
<strong>$message</strong>
<span onclick='this.parentNode.remove()' style='cursor: pointer;'>&times;</span>
</div>");
}
echo '</div>';