<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $usersData = [
            [
                'email' => 'test@email.co.uk',
                'ref' => 'user-0',
            ],
            [
                'email' => 'user-1@email.co.uk',
                'ref' => 'user-1',
            ],
            [
                'email' => 'user-2@email.co.uk',
                'ref' => 'user-2',
            ],
            [
                'email' => 'user-3@email.co.uk',
                'ref' => 'user-3',
            ],
            [
                'email' => 'user-4@email.co.uk',
                'ref' => 'user-4',
            ]
        ];

        foreach ($usersData as $user) {
            $userEntity = new User();
            $userEntity->setEmail($user['email'])
                ->setPassword($this->passwordEncoder->encodePassword(
                $userEntity,
                'password'
            ));

            $manager->persist($userEntity);

            $this->setReference($user['ref'], $userEntity);
        }


        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
