<?php

namespace App\DataFixtures;


use App\Entity\Ride;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RideFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $ridesData = [
            [
                'type' => Ride::RIDE_TAXI,
                'make' => 'Mercedes TAXI'
            ],
            [
                'type' => Ride::RIDE_TAXI,
                'make' => 'BMW TAXI'
            ],
            [
                'type' => Ride::RIDE_BUS,
                'make' => 'Red BUS'
            ],
            [
                'type' => Ride::RIDE_BUS,
                'make' => 'Blue BUS'
            ],
        ];

        foreach ($ridesData as $key => $ride) {
            $rideEntity = new Ride();
            $rideEntity->setType($ride['type'])
                ->setMake($ride['make']);

            $this->setReference('ride-'.($key+1), $rideEntity);

            $manager->persist($rideEntity);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}