<?php
require_once('Invoice.php');
require_once('Person.php');
require_once('TCPDF-main/tcpdf.php');


if(isset($_POST['formShow'])){
    if(isset($_POST['id']) && !empty($_POST['id'])){

        $conn = new mysqli("localhost", "root", "", "invoice") 
        or die ('Cannot connect to db');
        $id = $_POST['id'];
    
        $query1 = "SELECT * FROM faktury WHERE id=".$id;
        $query2 = "SELECT * FROM pozycje_faktury WHERE id_faktury=".$id;

        $items = [];

        if ($resultFromFaktury = $conn->query($query1)){
            while ($row = $resultFromFaktury->fetch_assoc()){

                $seller = new Person($row['nazwa_wystawcy'], $row['ulica_wystawcy'], $row['budynek_wystawcy'], $row['kod_wystawcy'], 
                $row['miasto_wystawcy'], $row['nip_wystawcy']);
          
                $customer = new Person($row['nazwa_odbiorcy'], $row['ulica_odbiorcy'], $row['budynek_odbiorcy'], $row['kod_odbiorcy'], 
                $row['miasto_odbiorcy'], $row['nip_odbiorcy']);  
          
                $date = $row['data_wystawienia'];
                $invoice_id = $row['numer_faktury'];
                $payment_method = $row['metoda_platnosci'];
            }
        }
        
        if ($resultFromPozycje = $conn->query($query2)){
            while ($row = $resultFromPozycje->fetch_assoc()){
                $item = new Item ($row['nazwa'], $row['cena_netto'], $row['stawka_vat'], $row['ilosc']);
                array_push($items, $item);
            }
        }

        $invoice = new Invoice ($seller, $customer, $items, $date, $invoice_id, $payment_method);
        $invoice->printInvoice();
    }
}
