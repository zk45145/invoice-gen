<?php

class Person{
    private $id;
    private $name;
    private $street;
    private $apartment_no;
    private $city;
    private $postcode;
    private $nip;

    public function __construct($name, $street, $apartment_no, $postcode, $city, $nip){
        $this->name = $name;
        $this->street = $street;
        $this->apartment_no = $apartment_no;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->nip = $nip;
    }
    

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getStreet(){
        return $this->street;
    }

    public function getApartmentNo(){
        return $this->apartment_no;
    }

    public function getCity(){
        return $this->city;
    }

    public function getPostcode(){
        return $this->postcode;
    }

    public function getNIP(){
        return $this->nip;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setStreet($street){
        $this->street = $street;
    }

    public function setApartmentNo($apartment_no){
        $this->apartment_no = $apartment_no;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function setPostcode($postcode){
        $this->postcode = $postcode;
    }

    public function setNIP($nip){
        $this->nip = $nip;
    }
}

