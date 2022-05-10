<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Driver;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking/{driver}", name="driver_booking")
     * @param Driver $driver
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function getDriverBookings(Driver $driver, ManagerRegistry $doctrine): Response
    {
        $driverBookings = $doctrine->getRepository(Booking::class)->findBy(['driver' => $driver]);

        return $this->render('booking/booking.html.twig', ['driver' => $driver, 'bookings' => $driverBookings]);
    }
}