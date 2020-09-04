<?php
require_once('Person.php');
require_once('Item.php');

class Invoice{
    private $seller;
    private $customer;
    private $items = array();
    private $date;
    private $invoice_id;
    private $payment_method;

    public function __construct($seller, $customer, $items, $date, $invoice_id, $payment_method){
        $this->seller = $seller;
        $this->customer = $customer;
        $this->items = $items;
        $this->date = $date;
        $this->invoice_id = $invoice_id;
        $this->payment_method = $payment_method;
    }

    public function printInvoice(){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetMargins(PDF_MARGIN_LEFT+10, 8, PDF_MARGIN_RIGHT+10);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        if (@file_exists(dirname(__FILE__).'/lang/pol.php')) {
            require_once(dirname(__FILE__).'/lang/pol.php');
            $pdf->setLanguageArray($l);
        }
        
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->AddPage();

        $html = '<head>
        <style>
        h1{
            text-align: center;
        }
        </style>
        <h1>FAKTURA NR '. $this->invoice_id . '</h1><hr>
        <div id="seller" style="text-align: right;">
        <div style="font-weight: bold;">WYSTAWCA:</div>
          <div>' . $this->seller->getName() . '</div>
          <div>' . $this->seller->getStreet() . ' ' . $this->seller->getApartmentNo() . '</div>
          <div>' . $this->seller->getPostcode() . ' ' . $this->seller->getCity() . '</div>
          <div>NIP: ' . $this->seller->getNIP() . '</div>
        </div>
        <div id="customer">
        <table style="width: 50%;">
          <tr><td>ODBIORCA:</td> <td>' . $this->customer->getName() . '</td></tr>
          <tr><td>ADRES:</td> <td>' . $this->customer->getStreet() . ' ' . $this->customer->getApartmentNo() . '<br>' . $this->customer->getPostcode() . 
          ' ' . $this->customer->getCity() . '</td></tr>
          <tr><td>NIP:</td><td>' . $this->customer->getNIP() . '</td></tr>
          <tr><td>DATA WYSTAWIENIA:</td> <td>' . $this->date . '</td></tr>
          </table>
          <br><br><br><br>
        </div>
      <main>
        <table>
          <thead>
            <tr style="font-weight: bold;">
              <td>PRODUKT</td>
              <td>CENA NETTO</td>
              <td>ILOŚĆ</td>
              <td>WARTOŚĆ NETTO</td>
              <td>VAT</td>
              <td>WARTOŚĆ VAT</td>
              <td>WARTOŚĆ BRUTTO</td>
            </tr>

          </thead>
          <tbody>';

          $i = 0;
          $total_vat_all = 0;
          $total_netto_all = 0;
          $total_brutto_all = 0;

          while ($i<count($this->items))
          {
            $total_vat = $this->items[$i]->getNetPrice()*$this->items[$i]->getQuantity() * ($this->items[$i]->getVat()/100);
            $total_netto = $this->items[$i]->getNetPrice() * $this->items[$i]->getQuantity();
            $total_brutto = $total_vat + $total_netto;
            $total_vat_all += $total_vat;
            $total_netto_all += $total_netto;
            $total_brutto_all += $total_brutto;
            $html .= '
            <tr>
              <td>' . $this->items[$i]->getName() . '</td>
              <td>' . $this->items[$i]->getNetPrice() . ' zł</td>
              <td>' . $this->items[$i]->getQuantity() . '</td>
              <td>' . $total_netto . ' zł</td>
              <td>' . $this->items[$i]->getVat() . '%</td>
              <td>' . $total_vat . ' zł</td>
              <td>' . $total_brutto . ' zł</td>
            </tr>';
            $i++;
          }

          $html.='
            <br><br><br>
            <tr>
              <td colspan="6" style="font-weight: bold;">SUMA NETTO:</td>
              <td>' . $total_netto_all . ' zł</td>
            </tr>
            <tr>
              <td colspan="6" style="font-weight: bold;">WARTOŚĆ PODATKU VAT:</td>
              <td>' . $total_vat_all . ' zł</td>
            </tr>
            <tr>
              <td colspan="6"  style="font-weight: bold;">SUMA BRUTTO:</td>
              <td>' . $total_brutto_all . ' zł</td>
            </tr>
          </tbody>
        </table>
      </main>
      <br><p>Metoda płatności: ' . $this->payment_method . '</p><br><br><br>
      <footer>
        <p>Faktura została wygenerowana komputerowo i jest pełnoprawnym dokumentem - nie wymaga podpisu.
      </footer>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Faktura.pdf', 'I');
    }
}