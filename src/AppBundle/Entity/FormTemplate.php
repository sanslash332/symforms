<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * FormTemplate
 *
 * @ORM\Table(name="form_template")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormTemplateRepository")
 */
class FormTemplate
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="form")
     */
    private $questions;


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
     * @return FormTemplate
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
     * Set questions
     *
     * @param array $questions
     *
     * @return FormTemplate
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * Get questions
     *
     * @return array
     */
    public function getQuestions()
    {
        return $this->questions;
    }

public function __construct()
{
$this->questions=new ArrayCollection();

}

public function __toString()
{
return($this->getName());

}
}

