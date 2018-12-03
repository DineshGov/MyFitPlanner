<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Muscle
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
     *
     * @ORM\ManyToOne(targetEntity="GroupeMusculaire", inversedBy="muscles")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $groupeMusculaire;

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

    /**
     * @return mixed
     */
    public function getGroupeMusculaire()
    {
        return $this->groupeMusculaire;
    }

    /**
     * @param mixed $groupeMusculaire
     */
    public function setGroupeMusculaire($groupeMusculaire)
    {
        $this->groupeMusculaire = $groupeMusculaire;
    }



}