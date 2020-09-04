<?php
require_once('Form.php');
require_once('App.php');

$app = new App();
$form = new Form();
$app->printHeader();
$app->printHeaderText('Lista wystawionych faktur')->printMenu();

$conn = new mysqli("localhost", "root", "", "invoice")
or die ('Cannot connect to db');
$result = $conn->query("SELECT id, nazwa_odbiorcy, data_wystawienia, numer_faktury FROM faktury ORDER BY id DESC");
?>

    <table class="table">
        <tr>
            <td>
                <b>Id</b>
            </td>
            <td>
                <b>Klient</b>
            </td>
            <td>
                <b>Data wystawienia</b>
            </td>
            <td>
                <b>Nr faktury</b>
            </td>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <?php echo $row['id']; ?>
                </td>
                <td>
                    <?php echo $row['nazwa_odbiorcy']; ?>
                </td>
                <td>
                    <?php echo $row['data_wystawienia']; ?>
                </td>
                <td>
                    <?php echo $row['numer_faktury']; ?>
                </td>
                <td>
                    <form action="remove-from-db.php" method='post' style="display: inline;">
                        <input type='hidden' id='id' name='id' value="<?php echo $row['id']; ?>" />
                        <input type='submit' name='formDelete' id='formDelete' class='btn-danger' value='Usuń' />                   
                    </form>
                    <form action="show-from-db.php" method='post' style="display: inline;">
                        <input type='hidden' id='id' name='id' value="<?php echo $row['id']; ?>" />
                        <input type='submit' name='formShow' id='formShow' class='btn-primary' value='Wyświetl' />              
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

<?php
$app->printFooter();