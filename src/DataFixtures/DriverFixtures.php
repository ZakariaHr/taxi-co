<?php

namespace App\DataFixtures;

use App\Entity\Driver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DriverFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $driversData = [
            [
                'name' => 'Adaline',
                'last_name' => 'Reichel',
                'type' => Driver::TAXI_DRIVER
            ],
            [
                'name' => 'Santa',
                'last_name' => 'Prosacco',
                'type' => Driver::TAXI_DRIVER
            ],
            [
                'name' => 'Noemy',
                'last_name' => 'Vandervort',
                'type' => Driver::BUS_DRIVER
            ],
            [
                'name' => 'Lexi',
                'last_name' => 'Johns',
                'type' => Driver::BUS_DRIVER
            ],
        ];

        foreach ($driversData as $key => $driver) {
            $driverEntity = new Driver();
            $driverEntity->setName($driver['name'])
                ->setSurname($driver['last_name'])
                ->setLicenceType($driver['type'])
                ->setUser($this->getReference('user-'.($key+1)));

            $this->setReference('driver-'.($key+1), $driverEntity);
            $manager->persist($driverEntity);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
