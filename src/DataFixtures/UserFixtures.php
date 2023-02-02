<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setPseudo('admin');

        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'password'
        );
        $admin->setPassword($hashedPassword);

        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $this->addReference('admin', $admin);

        $player = new User();
        $player->setPseudo('player');

        $hashedPassword = $this->passwordHasher->hashPassword(
            $player,
            'password'
        );
        $player->setPassword($hashedPassword);

        $player->setRoles(['ROLE_USER']);
        $manager->persist($player);
        $this->addReference('player', $player);

        $manager->flush();
    }
}
