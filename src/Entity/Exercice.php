<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Exercice
{
    use IdTrait;

    /**
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max="255")
     *
     * @ORM\Column(length=255, nullable=false, unique=true)
     */
    private $name;

    /**
     * @Assert\Type("string")
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\NotNull()
     * @ORM\ManyToMany(targetEntity="GroupeMusculaire")
     */
    private $groupesMusculaires;

    public function __construct(){
        $this->groupesMusculaires = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getGroupesMusculaires()
    {
        return $this->groupesMusculaires;
    }

    public function addGroupesMusculaires(GroupeMusculaire $groupe){
        if(!$this->groupesMusculaires->contains($groupe)){
            $this->groupesMusculaires->add($groupe);
        }
    }

    public function removeGroupeMusculaire(GroupeMusculaire $groupe){
        if($this->groupesMusculaire->contains($groupe)) {
            $this->groupesMusculaire->removeElement($groupe);
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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



}