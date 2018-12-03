<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class GroupeMusculaire
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
     * @ORM\OneToMany(targetEntity="Muscle", cascade={"persist", "remove"}, mappedBy="groupeMusculaire")
     */
    private $muscles;

    public function __construct(){
        $this->muscles = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getMuscles()
    {
        return $this->muscles;
    }

    public function addMuscle(Muscle $muscle){
        if(!$this->muscles->contains($muscle)){
            $this->muscles->add($muscle);
        }
    }

    public function removeMuscle(Muscle $muscle){
        if($this->muscles->contains($muscle)) {
            $this->muscles->removeElement($muscle);
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