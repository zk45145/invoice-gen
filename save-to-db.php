<?php
require_once('Person.php');
require_once('Item.php');
require_once('Invoice.php');
require_once('TCPDF-main/tcpdf.php');


// zbieranie danych z inputów:
$seller = new Person ($_POST['nazwa-wystawcy'], $_POST['ulica-wystawcy'], $_POST['budynek-wystawcy'], $_POST['kod-wystawcy'], $_POST['miasto-wystawcy'], $_POST['nip-wystawcy']);
$customer = new Person ($_POST['nazwa-odbiorcy'], $_POST['ulica-odbiorcy'], $_POST['budynek-odbiorcy'], $_POST['kod-odbiorcy'], $_POST['miasto-odbiorcy'], $_POST['nip-odbiorcy']);

$payment_method = $_POST['metoda-platnosci'];
$items = [];
$i = 0;

while (isset($_POST['nazwa-pozycji'.$i]) && ($_POST['nazwa-pozycji'.$i])) 
{
    $items[$i] = new Item($_POST['nazwa-pozycji'.$i], $_POST['cena'.$i], $_POST['podatek'.$i], $_POST['ilosc'.$i]);
    $i++;
}

//wyciąganie z bazy aktualnie najwyższego ID w celu nadania kolejnego numeru faktury
$max_id = 0;
try 
{
   $pdo = new PDO('mysql:host=localhost;dbname=invoice', 'root', '');
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
   $stmt = $pdo->query('SELECT MAX(id) as id FROM faktury');
   foreach($stmt as $row)
      {
          $max_id = $row['id'];
      }
      $stmt->closeCursor();
}
catch(PDOException $e) {
   echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
}


// generowanie kolejnego numeru faktury:
$date = date("Ymd"); 
$new_max_id = $max_id + 1;
$invoice_id = "FVT/".$date."/".$new_max_id;

// tworzenie obiektu Invoice - nowej faktury:
$date = date("Y-m-d");
$invoice = new Invoice($seller, $customer, $items, $date, $invoice_id, $payment_method);

// zapisywanie faktury w bazie danych - odporne na sql injection:
try
{
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$pdo = new PDO('mysql:host=localhost;dbname=invoice', 'root', '');
		$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$stmt = $pdo -> prepare('INSERT INTO `faktury` VALUES(
                :id,
				:nazwa_wystawcy,
				:ulica_wystawcy,
				:budynek_wystawcy,
				:kod_wystawcy,
				:miasto_wystawcy,
                :nip_wystawcy,
                :nazwa_odbiorcy,
				:ulica_odbiorcy,
				:budynek_odbiorcy,
				:kod_odbiorcy,
				:miasto_odbiorcy,
                :nip_odbiorcy,
				:metoda_platnosci,
				:data_wystawienia,
                :numer_faktury)');
            
        $stmt -> bindValue(':id', $new_max_id, PDO::PARAM_INT);
		$stmt -> bindValue(':nazwa_wystawcy', $_POST['nazwa-wystawcy'], PDO::PARAM_STR);
		$stmt -> bindValue(':ulica_wystawcy', $_POST['ulica-wystawcy'], PDO::PARAM_STR);
		$stmt -> bindValue(':budynek_wystawcy', $_POST['budynek-wystawcy'], PDO::PARAM_STR);
		$stmt -> bindValue(':kod_wystawcy', $_POST['kod-wystawcy'], PDO::PARAM_STR);
        $stmt -> bindValue(':miasto_wystawcy', $_POST['miasto-wystawcy'], PDO::PARAM_STR);
        $stmt -> bindValue(':nip_wystawcy', $_POST['nip-wystawcy'], PDO::PARAM_STR);
		$stmt -> bindValue(':nazwa_odbiorcy', $_POST['nazwa-odbiorcy'], PDO::PARAM_STR);
		$stmt -> bindValue(':ulica_odbiorcy', $_POST['ulica-odbiorcy'], PDO::PARAM_STR);
		$stmt -> bindValue(':budynek_odbiorcy', $_POST['budynek-odbiorcy'], PDO::PARAM_STR);
        $stmt -> bindValue(':kod_odbiorcy', $_POST['kod-odbiorcy'], PDO::PARAM_STR);
        $stmt -> bindValue(':miasto_odbiorcy', $_POST['miasto-odbiorcy'], PDO::PARAM_STR);
		$stmt -> bindValue(':nip_odbiorcy', $_POST['nip-odbiorcy'], PDO::PARAM_STR);
		$stmt -> bindValue(':metoda_platnosci', $payment_method, PDO::PARAM_STR);
        $stmt -> bindValue(':data_wystawienia', $date, PDO::PARAM_STR);
		$stmt -> bindValue(':numer_faktury', $invoice_id, PDO::PARAM_STR);
			
		$amount = $stmt -> execute();
	
		if($amount <= 0)
		{
			echo 'Wystapił błąd podczas dodawania rekordów';
		}
	}
}
catch(PDOException $e)
{
	echo 'Wystąpił błąd biblioteki PDO: ' . $e->getMessage();
}

    

//dodawanie pozycji faktury do bazy:
try
{
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
			$pdo = new PDO('mysql:host=localhost;dbname=invoice;', 'root', '');
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			$stmt = $pdo -> prepare('INSERT INTO `pozycje_faktury` (`id_pozycji`, `nazwa`, `cena_netto`, `stawka_vat`, `ilosc`, id_faktury)	VALUES(
				:id_pozycji,
				:nazwa,
				:cena_netto,
				:stawka_vat,
                :ilosc,
				:id_faktury)');
			
			$amount = 0;
			foreach($items as $item)
			{
				if(strlen($item->getName()) > 0)
				{
					$stmt -> bindValue(':id_pozycji', NULL, PDO::PARAM_INT);
					$stmt -> bindValue(':nazwa', $item->getName(), PDO::PARAM_STR);
					$stmt -> bindValue(':cena_netto', $item->getNetPrice(), PDO::PARAM_STR);
					$stmt -> bindValue(':stawka_vat', $item->getVat(), PDO::PARAM_STR);
					$stmt -> bindValue(':ilosc', $item->getQuantity(), PDO::PARAM_INT);
                    $stmt -> bindValue(':id_faktury', $new_max_id, PDO::PARAM_INT);
                    
					$amount += $stmt -> execute();
				}			
			}
	
			if($amount > 0)
			{
				//echo 'Wystapil blad podczas dodawania rekordow!';
			}
        }
    }
catch(PDOException $e)
{
    echo 'Wystapil blad biblioteki PDO: ' . $e->getMessage();
}

$invoice->printInvoice();




