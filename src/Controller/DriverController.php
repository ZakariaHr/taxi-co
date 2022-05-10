<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Form\Type\DriverRideCheckType;
use App\Form\Type\DriverRideHistoryType;
use App\Service\DriverService;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverController extends AbstractController
{
    /**
     * @Route("/drivers", name="drivers_list")
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function getDrivers(ManagerRegistry $doctrine): Response
    {
        $drivers = $doctrine->getRepository(Driver::class)
            ->findAll();

        return $this->render('driver/list.html.twig', ['drivers' => $drivers]);
    }

    /**
     * @Route("/history/driver/ride", name="driver_ride_history")
     * @param Request $request
     * @param DriverService $driverService
     * @return Response
     */
    public function driverRideHistory(Request $request, DriverService $driverService): Response
    {
        $driver = null;
        $form = $this->createForm(DriverRideHistoryType::class, null, [])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $driver = $driverService->getDriverForRideByDate($form->getData());
        }

        return $this->render('driver/driver_ride_history.html.twig', [
            'driver' => $driver, 'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/check/driver/ride", name="driver_ride_check")
     * @param Request $request
     * @param DriverService $driverService
     * @return Response
     */
    public function driverRideCheck(Request $request, DriverService $driverService): Response
    {
        $isDriverAllowedForVehicle = false;
        $form = $this->createForm(DriverRideCheckType::class, null, [])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $isDriverAllowedForVehicle = $driverService->isDriverAllowedToDriveVehicle($form->getData());
        }

        return $this->render('driver/driver_ride_check.html.twig', [
            'driverAllowedForVehicle' => $isDriverAllowedForVehicle, 'form' => $form->createView()
        ]);
    }
}