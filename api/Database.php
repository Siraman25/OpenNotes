<?php

function connect(): mysqli {
    return mysqli_connect("host", "user", "pasword", "database");
}
