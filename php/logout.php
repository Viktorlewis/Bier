<?php
//BRON - Jonathan - Opdrachten - Howest
session_start();
session_unset();
session_destroy();

header("Location: ../index.php");