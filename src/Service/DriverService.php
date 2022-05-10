<?php

namespace App\Service;


use App\Entity\Booking;
use App\Entity\Driver;
use Doctrine\Persistence\ManagerRegistry;

final class DriverService
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getDriverForRideByDate(array $data): ?Driver
    {
        $booking = $this->doctrine
            ->getRepository(Booking::class)
            ->findOneBy(['ride' => $data['rides'], 'date' => $data['date']]);

        return $booking ? $booking->getDriver() : null;
    }

    public function isDriverAllowedToDriveVehicle(array $data): bool
    {
        return $data['ride']->getType() === $data['driver']->getLicenceType();
    }
}