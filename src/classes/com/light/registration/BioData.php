<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\registration;

/**
 * Description of BioData
 *
 * @author Imole Akpobome
 */
class BioData {

    private $firstName;
    private $otherName;
    private $lastName;
    private $dob;
    private $email;
    private $city;
    private $phoneno;
    private $country;

    public function __construct($firstName, $otherName, $lastName, $dob, $email, $city, $phoneno, $country) {
        $this->firstName = $firstName;
        $this->otherName = $otherName;
        $this->lastName = $lastName;
        $this->dob = $dob;
        $this->email = $email;
        $this->city = $city;
        $this->phoneno = $phoneno;
        $this->country = $country;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCity() {
        return $this->city;
    }

    public function getPhoneno() {
        return $this->phoneno;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setPhoneno($phoneno) {
        $this->phoneno = $phoneno;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getArray() {
        return [$this->firstName, $this->otherName, $this->lastName, $this->dob];
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getOtherName() {
        return $this->otherName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getDob() {
        return $this->dob;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setOtherName($otherName) {
        $this->otherName = $otherName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setDob($dob) {
        $this->dob = $dob;
    }

    public function __toString() {
        return "[$this->firstName,$this->otherName,$this->lastName,$this->dob]";
    }

}
