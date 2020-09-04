<?php
require_once('Form.php');
require_once('App.php');

$app = new App();
$form = new Form();
$app->printHeader();
$app->printHeaderText("Strona główna")->printMenu();
$text = '<p>Aplikacja generuje faktury w formacie pdf i zapisuje historię generowanych faktur. </br>W celu wystawienia faktury należy wejść w zakładkę "Wystaw 
fakturę" i uzupełnić dane.</br></br>Zadanie zostało zrealizowane dla potrzeb procesu rekrutacji. Do jego wykonania wykorzystano bibliotekę TCPDF.</p>';
echo $form->getTag("h4", $text);
$app->printFooter();