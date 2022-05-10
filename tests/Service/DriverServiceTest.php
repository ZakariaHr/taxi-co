<?php

namespace tests\Service;

use App\Entity\Booking;
use App\Entity\Driver;
use App\Entity\Ride;
use App\Repository\BookingRepository;
use App\Service\DriverService;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

class DriverServiceTest extends TestCase
{
    protected $rideMock;
    protected $bookingMock;
    protected $driverMock;

    public function setUp(): void
    {
        $this->rideMock = $this->createMock(Ride::class);
        $this->bookingMock = $this->createMock(Booking::class);
        $this->driverMock = $this->createMock(Driver::class);
    }

    /**
     * @dataProvider getDriverForRideByDateDataProvider
     * @param array $data
     * @param $findOneByResult
     * @param $expectedResult
     */
    public function testGetDriverForRideByDate(array $data, $findOneByResult, $expectedResult): void
    {
        $bookingRepo = $this->createMock(BookingRepository::class);
        $doctrineMock = $this->createMock(ManagerRegistry::class);

        $doctrineMock->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookingRepo);

        $bookingRepo->expects($this->once())
            ->method('findOneBy')
            ->willReturn($findOneByResult);

        if ($findOneByResult) {
            $this->bookingMock->expects($this->once())
                ->method('getDriver')
                ->willReturn($this->driverMock);
        }

        $driverService = new DriverService($doctrineMock);
        $result = $driverService->getDriverForRideByDate($data);

        $this->assertEquals($expectedResult, $result);
    }

    public function getDriverForRideByDateDataProvider(): \Generator
    {
        yield [
            ['rides' => $this->rideMock, 'date' => new \DateTime()], null, null
        ];

        yield [
            ['rides' => $this->rideMock, 'date' => new \DateTime()], $this->bookingMock, $this->driverMock
        ];
    }
}