<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Serie
{
    use IdTrait;

    /**
     * @Assert\Type("float")
     * @Assert\NotNull()
     * @Assert\GreaterThanOrEqual(0)
     *
     * @ORM\Column(type="float", precision=2, scale=2, nullable=false)
     */
    private $charge;

    /**
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
     * @Assert\NotNull()
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $repetition;

    /**
     * /**
     * @Assert\Type("int")
     * @Assert\NotNull()
     * @Assert\GreaterThanOrEqual(0)
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $repos;

    /**
     * @Assert\Type("text")
     *
     * @ORM\Column(nullable=true, type="text")
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="Seance")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $seance;

    /**
     * @Assert\NotNull()
     *
     * @ORM\ManyToOne(targetEntity="Exercice")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $exercice;

    /**
     * @return mixed
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @param mixed $charge
     */
    public function setCharge($charge)
    {
        $this->charge = $charge;
    }

    /**
     * @return mixed
     */
    public function getRepetition()
    {
        return $this->repetition;
    }

    /**
     * @param mixed $repetition
     */
    public function setRepetition($repetition)
    {
        $this->repetition = $repetition;
    }

    /**
     * @return mixed
     */
    public function getRepos()
    {
        return $this->repos;
    }

    /**
     * @param mixed $repos
     */
    public function setRepos($repos)
    {
        $this->repos = $repos;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return mixed
     */
    public function getSeance()
    {
        return $this->seance;
    }

    /**
     * @param mixed $seance
     */
    public function setSeance($seance)
    {
        $this->seance = $seance;
    }

    /**
     * @return mixed
     */
    public function getExercice()
    {
        return $this->exercice;
    }

    /**
     * @param mixed $exercice
     */
    public function setExercice($exercice)
    {
        $this->exercice = $exercice;
    }




}