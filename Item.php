<?php

class Item{
    private $id;
    private $name;
    private $net_price;
    private $vat;
    private $quantity;

    function __construct($name, $net_price, $vat, $quantity){
        $this->name = $name;
        $this->net_price = $net_price;
        $this->vat = $vat;
        $this->quantity = $quantity;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getNetPrice(){
        return $this->net_price;
    }

    public function getVat(){
        return $this->vat;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setNetPrice($net_price){
        $this->net_price = $net_price;
    }

    public function setVat($vat){
        $this->vat = $vat;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
}