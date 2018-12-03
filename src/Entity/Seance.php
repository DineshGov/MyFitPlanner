<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *
 * @UniqueEntity(fields={"user","date"})
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     uniqueConstraints={
 *     @UniqueConstraint(
 *     name="seanceJourUniquePerUser",
 *     columns={"user_id", "date"}
 *     )})
 */
class Seance
{
    use IdTrait;

    /**
     * @Assert\NotNull()
     *
     * @ORM\Column(type="date", nullable=false)
     */
    private $date;

    /**
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     *
     * @ORM\Column(nullable=true)
     */
    private $lieu;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Assert\Type("string")
     *
     * @ORM\Column(nullable=true, type="text")
     */
    private $commentaire;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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




}