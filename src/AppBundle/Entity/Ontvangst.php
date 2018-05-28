<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ontvangst
 *
 * @ORM\Table(name="bestelregel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ontvangstRepository")
 */
class Ontvangst
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Ontvangstdatum", type="date")
     */
    private $ontvangstdatum;

        // public function _toString(){
        //    return strval($this->ontvangstdatum);
        //}

    /**
     * @var int
     *
     * @ORM\Column(name="aantal", type="integer")
     */
    private $hoeveelheid;

    /**
     * @var string
     *
     * @ORM\Column(name="Kwaliteit", type="string", length=32)
     */
    private $kwaliteit;

    /**
     * @var int
     *
     * @ORM\Column(name="bestelordernummer", type="integer")
     */
    private $bestelordernummer;

    /**
     * @var string
     *
     * @ORM\Column(name="Omschrijving", type="string", length=32)
     */
    private $omschrijving;

    /**
     * @var string
     *
     * @ORM\Column(name="Leveranciersnaam", type="string", length=255)
     */
    private $leveranciersnaam;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Afgekeurd", type="boolean")
     */
    private $afgekeurd;


       /**
     * @var boolean
     *
     * @ORM\Column(name="ontvangen", type="boolean")
     */
    private $ontvangen;


    /**
     * Get ontvangen
     *
     * @return boolean
     */
    public function getontvangen()
    {
        return $this->ontvangen;
    }

 /**
     * Set ontvangen
     *
     * @param boolean $ontvangen
     *
     * @return ontvangen
     */
    public function setontvangen($ontvangen)
    {
        $this->ontvangen = $ontvangen;

        return $this;
    }


    /**
     * Get afgekeurd
     *
     * @return int
     */
    public function getafgekeurd()
    {
        return $this->afgekeurd;
    }

    /**
     * Set afgekeurd
     *
     * @param boolean $afgkeurd
     *
     * @return afgekeurd
     */
    public function setafgekeurd($afgekeurd)
    {
        $this->afgekeurd = $afgekeurd;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set iD
     *
     * @param integer $iD
     *
     * @return Ontvangst
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set ontvangstdatum
     *
     * @param integer $ontvangstdatum
     *
     * @return Ontvangst
     */
    public function setOntvangstdatum($ontvangstdatum)
    {
        $this->ontvangstdatum = $ontvangstdatum;

        return $this;
    }

    /**
     * Get ontvangstdatum
     *
     * @return int
     */
    public function getOntvangstdatum()
    {
        return $this->ontvangstdatum;
    }

    /**
     * Set hoeveelheid
     *
     * @param integer $hoeveelheid
     *
     * @return Ontvangst
     */
    public function setHoeveelheid($hoeveelheid)
    {
        $this->hoeveelheid = $hoeveelheid;

        return $this;
    }

    /**
     * Get hoeveelheid
     *
     * @return int
     */
    public function getHoeveelheid()
    {
        return $this->hoeveelheid;
    }

    /**
     * Set kwaliteit
     *
     * @param string $kwaliteit
     *
     * @return Ontvangst
     */
    public function setKwaliteit($kwaliteit)
    {
        $this->kwaliteit = $kwaliteit;

        return $this;
    }

    /**
     * Get kwaliteit
     *
     * @return string
     */
    public function getKwaliteit()
    {
        return $this->kwaliteit;
    }

    /**
     * Set bestelordernummer
     *
     * @param integer $bestelordernummer
     *
     * @return Ontvangst
     */
    public function setBestelordernummer($bestelordernummer)
    {
        $this->bestelordernummer = $bestelordernummer;

        return $this;
    }

    /**
     * Get bestelordernummer
     *
     * @return int
     */
    public function getbestelordernummer()
    {
        return $this->bestelordernummer;
    }

    /**
     * Set omschrijving
     *
     * @param string $omschrijving
     *
     * @return Ontvangst
     */
    public function setOmschrijving($omschrijving)
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * Get omschrijving
     *
     * @return string
     */
    public function getOmschrijving()
    {
        return $this->omschrijving;
    }

    /**
     * Set leveranciersnaam
     *
     * @param string $leveranciersnaam
     *
     * @return Ontvangst
     */
    public function setLeveranciersnaam($leveranciersnaam)
    {
        $this->leveranciersnaam = $leveranciersnaam;

        return $this;
    }

    /**
     * Get leveranciersnaam
     *
     * @return string
     */
    public function getLeveranciersnaam()
    {
        return $this->leveranciersnaam;
    }
}