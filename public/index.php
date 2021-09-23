<?php
if (!session_id()) {
    session_start();
}
require_once '../app/init.php';
require_once '../app/fpdf184/fpdf.php';
$app = new App;
