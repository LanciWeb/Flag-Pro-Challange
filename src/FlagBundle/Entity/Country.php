<?php

namespace FlagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="FlagBundle\Repository\CountryRepository")
 */
class Country
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="flagsrc", type="string", length=255, unique=true)
     */
    private $flagsrc;

    /**
     * @var string
     *
     * @ORM\Column(name="flagSet", type="string", length=255)
     */
    private $flagSet;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_recognized", type="boolean")
     */
    private $isRecognized;


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
     * Set name
     *
     * @param string $name
     *
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set flagsrc
     *
     * @param string $flagsrc
     *
     * @return Country
     */
    public function setFlagsrc($flagsrc)
    {
        $this->flagsrc = $flagsrc;

        return $this;
    }

    /**
     * Get flagsrc
     *
     * @return string
     */
    public function getFlagsrc()
    {
        return $this->flagsrc;
    }

    /**
     * Set flagSet
     *
     * @param string $flagSet
     *
     * @return Country
     */
    public function setFlagSet($flagSet)
    {
        $this->flagSet = $flagSet;

        return $this;
    }

    /**
     * Get flagSet
     *
     * @return string
     */
    public function getFlagSet()
    {
        return $this->flagSet;
    }

    /**
     * Set isRecognized
     *
     * @param boolean $isRecognized
     *
     * @return Country
     */
    public function setIsRecognized($isRecognized)
    {
        $this->isRecognized = $isRecognized;

        return $this;
    }

    /**
     * Get isRecognized
     *
     * @return bool
     */
    public function getIsRecognized()
    {
        return $this->isRecognized;
    }
}

