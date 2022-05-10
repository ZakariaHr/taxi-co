<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Driver", inversedBy="bookings")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     */
    private $driver;


    /**
     * @ORM\ManyToOne(targetEntity="Ride", inversedBy="bookings")
     * @ORM\JoinColumn(name="ride_id", referencedColumnName="id")
     */
    private $ride;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Booking
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Driver
     */
    public function getDriver(): Driver
    {
        return $this->driver;
    }

    /**
     * @param Driver $driver
     * @return Booking
     */
    public function setDriver(Driver $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * @return Ride
     */
    public function getRide(): Ride
    {
        return $this->ride;
    }

    /**
     * @param Ride $ride
     * @return Booking
     */
    public function setRide(Ride $ride): self
    {
        $this->ride = $ride;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Booking
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }
}