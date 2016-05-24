<?php

namespace Application\Model\Entity;

class Reclamacion
{
    protected $id;
    protected $consumerType;
    protected $firstName;
    protected $lastName;
    protected $documentType;
    protected $documentNumber;
    protected $company;
    protected $businessName;
    protected $ruc;
    protected $homePhone;
    protected $mobilePhone;
    protected $email;
    protected $address1;
    protected $address2;
    protected $address3;
    protected $address4;
    protected $address5;
    protected $address6;
    protected $address7;
    protected $address8;
    protected $description;
    protected $detail;
    protected $acceptTerms;
    protected $isNotRobot;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getConsumerType()
    {
        return $this->consumerType;
    }

    /**
     * @param mixed $consumerType
     */
    public function setConsumerType($consumerType)
    {
        $this->consumerType = $consumerType;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @param mixed $documentType
     */
    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;
    }

    /**
     * @return mixed
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * @param mixed $documentNumber
     */
    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     * @param mixed $businessName
     */
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;
    }

    /**
     * @return mixed
     */
    public function getRuc()
    {
        return $this->ruc;
    }

    /**
     * @param mixed $ruc
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;
    }

    /**
     * @return mixed
     */
    public function getHomePhone()
    {
        return $this->homePhone;
    }

    /**
     * @param mixed $homePhone
     */
    public function setHomePhone($homePhone)
    {
        $this->homePhone = $homePhone;
    }

    /**
     * @return mixed
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * @param mixed $mobilePhone
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param mixed $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return mixed
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * @param mixed $address3
     */
    public function setAddress3($address3)
    {
        $this->address3 = $address3;
    }

    /**
     * @return mixed
     */
    public function getAddress4()
    {
        return $this->address4;
    }

    /**
     * @param mixed $address4
     */
    public function setAddress4($address4)
    {
        $this->address4 = $address4;
    }

    /**
     * @return mixed
     */
    public function getAddress5()
    {
        return $this->address5;
    }

    /**
     * @param mixed $address5
     */
    public function setAddress5($address5)
    {
        $this->address5 = $address5;
    }

    /**
     * @return mixed
     */
    public function getAddress6()
    {
        return $this->address6;
    }

    /**
     * @param mixed $address6
     */
    public function setAddress6($address6)
    {
        $this->address6 = $address6;
    }

    /**
     * @return mixed
     */
    public function getAddress7()
    {
        return $this->address7;
    }

    /**
     * @param mixed $address7
     */
    public function setAddress7($address7)
    {
        $this->address7 = $address7;
    }

    /**
     * @return mixed
     */
    public function getAddress8()
    {
        return $this->address8;
    }

    /**
     * @param mixed $address8
     */
    public function setAddress8($address8)
    {
        $this->address8 = $address8;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getAcceptTerms()
    {
        return $this->acceptTerms;
    }

    /**
     * @param mixed $acceptTerms
     */
    public function setAcceptTerms($acceptTerms)
    {
        $this->acceptTerms = $acceptTerms;
    }

    /**
     * @return mixed
     */
    public function getIsNotRobot()
    {
        return $this->isNotRobot;
    }

    /**
     * @param mixed $isNotRobot
     */
    public function setIsNotRobot($isNotRobot)
    {
        $this->isNotRobot = $isNotRobot;
    }
}