<?php

namespace App\DataFixtures;


use App\Entity\Booking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookingFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $bookingsData = [
            [
                'driver' => $this->getReference('driver-1'),
                'ride' => $this->getReference('ride-1'),
                'date' => (new \DateTime())->modify('-2 day')->settime(0,0)
            ],
            [
                'driver' => $this->getReference('driver-1'),
                'ride' => $this->getReference('ride-2'),
                'date' => (new \DateTime())->modify('-3 day')->settime(0,0)
            ],
            [
                'driver' => $this->getReference('driver-1'),
                'ride' => $this->getReference('ride-1'),
                'date' => (new \DateTime())->modify('-4 day')->settime(0,0)
            ],
            [
                'driver' => $this->getReference('driver-1'),
                'ride' => $this->getReference('ride-2'),
                'date' => (new \DateTime())->modify('-5 day')->settime(0,0)
            ],
            [
                'driver' => $this->getReference('driver-1'),
                'ride' => $this->getReference('ride-2'),
                'date' => (new \DateTime())->modify('-6 day')->settime(0,0)
            ],
            [
                'driver' => $this->getReference('driver-4'),
                'ride' => $this->getReference('ride-3'),
                'date' => (new \DateTime())->modify('-6 day')->settime(0,0)
            ],
        ];

        foreach ($bookingsData as $booking) {
            $bookingEntity = new Booking();
            $bookingEntity->setDriver($booking['driver'])
                ->setRide($booking['ride'])
                ->setDate($booking['date']);

            $manager->persist($bookingEntity);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}