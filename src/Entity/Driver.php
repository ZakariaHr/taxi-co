<?php

namespace App\Entity;

use App\Interfaces\DriverInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Driver implements DriverInterface
{
    public const TAXI_DRIVER = 0;
    public const BUS_DRIVER = 1;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $surname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $licenceType = 0;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="driver")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="driver")
     */
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return Driver
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Driver
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param $surname
     * @return Driver
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return bool
     */
    public function getLicenceType(): bool
    {
        return $this->licenceType;
    }

    /**
     * @param bool $licenceType
     * @return Driver
     */
    public function setLicenceType(bool $licenceType): self
    {
        $this->licenceType = $licenceType;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Driver
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getDriverFullname(): string
    {
        return $this->name . ' ' . $this->surname;
    }

}