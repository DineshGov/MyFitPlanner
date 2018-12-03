<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity()
 */
class User implements UserInterface
{
    use IdTrait;

    /**
     * @Assert\Email
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min="3", max="255")
     *
     * @ORM\Column(length=255, nullable=false, unique=true)
     */
    private $email;

    /**
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min="3", max="255")
     *
     * @ORM\Column(length=255, nullable=false, unique=false)
     */
    private $name;

    /**
     * @Assert\Type("string")
     * @Assert\Length(min="3", max="255")
     *
     * @ORM\Column(length=255, nullable=false, unique=false)
     */
    private $password;

    /**
     * @Assert\Type("string")
     * @Assert\Length(min="3", max="255")
     */
    private $rawPassword;

    /**
     * @Assert\Type("bool")
     *
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /**
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     *
     * @ORM\Column(type="float", precision=2, scale=2, nullable=true)
     */
    private $poids;

    /**
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     *
     * @ORM\Column(type="float", precision=2, scale=2, nullable=true)
     */
    private $taille;

    /**
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @Assert\Callback()
     */
    public function assertIsValid(ExecutionContextInterface $context){

        if(null === $this->getId() && null === $this->getRawPassword()){
            $context
                ->buildViolation('Vous devez définir un mot de passe')
                ->atPath('rawPassword')
                ->addViolation();
        }
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
    public function getRawPassword()
    {
        return $this->rawPassword;
    }

    /**
     * @param mixed $rawPassword
     */
    public function setRawPassword($rawPassword)
    {
        $this->rawPassword = $rawPassword;
    }

    /**
     * @return mixed
     */
    public function getisAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [
            $this->isAdmin ? 'ROLE_ADMIN' : 'ROLE_USER',
        ];
    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->rawPassword = null;
    }

    /**
     * @return mixed
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * @param mixed $poids
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    }

    /**
     * @return mixed
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * @param mixed $taille
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }


}