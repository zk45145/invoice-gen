<?php
require_once('Form.php');
require_once('App.php');

$app = new App();
$form = new Form();
$app->printHeader();
$app->printHeaderText('Wystaw fakturę')->printMenu();
$paymentMethods = ['Gotówka', 'Przelew', 'Karta', 'Za pobraniem'];

echo "<div id='form'>";
echo $form->formBegin("save-to-db.php");
echo "<div style='width:20%; height:auto; margin:0px 20px; float:left;'>";
echo $form->getTag("h3", "Dane wystawcy");
echo $form->row(['Nazwa wystawcy', $form->input('nazwa-wystawcy', "Very Important Company")]);
echo $form->row(['Ulica', $form->input('ulica-wystawcy', "Unii Lubelskiej")]);
echo $form->row(['Nr budynku/lokalu', $form->input('budynek-wystawcy', "12")]);
echo $form->row(['Kod pocztowy', $form->input('kod-wystawcy', "71-123")]);
echo $form->row(['Miasto', $form->input('miasto-wystawcy', "Szczecin")]);
echo $form->row(['NIP', $form->input('nip-wystawcy', "3416771902")]);
echo "</div>";

echo "<div style='width:20%; height:auto; margin:0px 20px; float:left;'>";
echo $form->getTag("h3", "Dane odbiorcy");
echo $form->row(['Nazwa klienta', $form->input('nazwa-odbiorcy', "Czesław Miłosz")]);
echo $form->row(['Ulica', $form->input('ulica-odbiorcy', "Santocka")]);
echo $form->row(['Nr budynku/lokalu', $form->input('budynek-odbiorcy', "233/2")]);
echo $form->row(['Kod pocztowy', $form->input('kod-odbiorcy', "71-113")]);
echo $form->row(['Miasto', $form->input('miasto-odbiorcy', "Szczecin")]);
echo $form->row(['NIP', $form->input('nip-odbiorcy', "2361234456")]);
echo $form->row(['', '<br><br>']);
echo $form->row(['Metoda płatności', $form->select('metoda-platnosci', $paymentMethods)]);
echo "</div>";

echo "<div><br>";
echo $form->submit("   Wystaw fakturę   ");
echo "</div>";

echo "<div style='width:50%; float:right;'>";
echo $form->getTag("h3", "Pozycje na fakturze");

echo "<div id='nazwa_pozycji' style='width:50%;  float:left;'>";
echo $form->row(['Nazwa pozycji', $form->input('nazwa-pozycji0', "")]);
echo "</div>";

echo "<div id='cena_netto' style='width:20%; float:left;'>";
echo $form->row(['Cena netto w zł', $form->input('cena0', "", $type="number")]);
echo "</div>";

echo "<div id='stawka_vat' style='width:10%; float:left;'>";
echo $form->row(['VAT %', $form->input('podatek0', "", $type="number")]);
echo "</div>";

echo "<div id='ilosc' style='width:10%; float:left;'>";
echo $form->row(['Ilość', $form->input('ilosc0', "", $type="number")]);
echo "</div>";

echo $form->formEnd();
echo "</div>";
echo "<div style='text-align: center;'>";
echo '<button onclick="add()" class="btn btn-success" style="margin: 20px;">Dodaj pozycję</button>';
echo '<input type="hidden" value="0" id="total_rows"></input>';

$app->printFooter();
?>

<script>
function add(){
    var newInputNumber = parseInt($('#total_rows').val())+1;
    console.log(newInputNumber);
    var new_input="<input type='text' class='form-control' name='nazwa-pozycji"+newInputNumber+"'>";
    $('#nazwa_pozycji').append(new_input);
    $('#total_rows').val(newInputNumber);
    var new_input="<input type='number' class='form-control' name='cena"+newInputNumber+"'>";
    $('#cena_netto').append(new_input);
    $('#total_rows').val(newInputNumber);
    var new_input="<input type='number' class='form-control' name='podatek"+newInputNumber+"'>";
    $('#stawka_vat').append(new_input);
    $('#total_rows').val(newInputNumber);
    var new_input="<input type='number' class='form-control' name='ilosc"+newInputNumber+"'>";
    $('#ilosc').append(new_input);
    $('#total_rows').val(newInputNumber);
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
