<?php

if(isset($_POST['formDelete'])){
if(isset($_POST['id']) && !empty($_POST['id'])){

    $conn = new mysqli("localhost", "root", "", "invoice") 
    or die ('Cannot connect to db');
    $id = $_POST['id'];

    // Opcja 1: całkowite usunięcie danych faktury z bazy:
    $resultFromInvoices = $conn->query("DELETE FROM faktury WHERE id =".$id);
    $resultFromItems = $conn->query("DELETE FROM pozycje_faktury WHERE id_faktury =".$id);

    // Opcja 2: ukrycie faktury zamiast usuwania:
    // $result = $conn->query("UPDATE faktury SET czy_usunieta = 1 WHERE id=".$id);
    }
}
header("Location: invoices-list.php");