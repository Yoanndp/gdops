<?php
include '../settings.php';
require_once '../libops.php';
require_once '../anubis.php';

$userName = unparty(htmlspecialchars($_POST['userName']));
$password = unparty(htmlspecialchars($_POST['password']));
$gv = htmlspecialchars($_POST['gameVersion']);
$bv = htmlspecialchars($_POST['binaryVersion']);

$_e = $OPS_SETTINGS['gdps']['security'];
$password = hash($_e['pass_algo'], $password . $_e['salt']);

$account = Accounts::get_by_auth($userName, $password);

if (!$account)
    die('-1');

$saveData = file_get_contents('../data/backups/' . $userName . '.backup');

$anubis = new Anubis();
$anubis->setKey($password);

echo $anubis->decrypt($saveData) . ";$gv;$bv;rekt;fool";