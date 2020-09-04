<?php
require_once('Form.php');

class App
{

    private $form;
    private $menu = [
        [
            'name' => 'Strona główna',
            'href' => 'index.php'
        ],
        [
            'name' => 'Wystaw fakturę',
            'href' => 'get-inputs.php'
        ],
        [
            'name' => 'Lista wystawionych faktur',
            'href' => 'invoices-list.php'
        ]
    ];


    public function __construct()
    {
        $this->form = new Form();
    }

    public function printHeader()
    {
        print "<!DOCTYPE html>
               <html>
                    <head>
                        <title>Aplikacja do wystawiania faktur</title>
                        <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
                        <link rel=\"stylesheet\" href=\"css/style.css\">
                    </head>
                    <body>
                    <div><div><h1>Aplikacja do wystawiania faktur</h1></div>";


        return $this;
    }


    public function printFooter()
    {
        print "    </body>
               </html>";

        return $this;
    }


    public function printHeaderText(string $headerText)
    {
        print $this->form->getTag('h2', $headerText);

        return $this;
    }


    public function printMenu()
    {
        $menuToPrint = [];
        foreach ($this->menu as $position) {
            $menuToPrint[] = '<a class="nav-link link" href="' . $position['href'] . '">' . $position['name'] . '</a>';
        }

        $ret = '<div class="navbar navbar-expand-sm bg-light">';
        $ret .= '<ul class="nav nav-tabs">';
        foreach ($menuToPrint as $element) {
            $ret .= '<li class="nav-item">' . $element . '</li>';
        }
        $ret .= '</ul>';
        $ret .= '</div>';
        print $ret;

        return $this;
    }
}
