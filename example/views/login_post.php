<?php

if (!$url = $sp->loginPost("spid-saml-check", 0, 1, 1, null, true)) {
    echo "Already logged in !<br>";
    echo "<a href=\"/\">Home</a>";
} else {
    echo $url;
}
