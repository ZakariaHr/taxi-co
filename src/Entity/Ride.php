<?php

namespace App\Entity;

use App\Interfaces\RideInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Ride implements RideInterface
{
    public const RIDE_TAXI = 0;
    public const RIDE_BUS = 1;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $type = 0;

    /**
     * @ORM\Column(type="string")
     */
    private $make;


    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="ride")
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
     * @return Ride
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return bool
     */
    public function getType(): bool
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return Ride
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getMake(): string
    {
        return $this->make;
    }

    /**
     * @param string $make
     * @return Ride
     */
    public function setMake(string $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function getDisplayName(): string
    {
        return $this->id. ' - '. $this->make;
    }
}