<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $programRepository = $manager->getRepository(Program::class);
        $programCount = $programRepository->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();

        for ($i = 1; $i <= 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->firstName() . ' ' . $faker->lastName());

            for ($j = 1; $j <= 3; $j++) {
                $randomIndex = rand(0, $programCount - 1);
                $randomProgram = $programRepository->createQueryBuilder('p')
                    ->setFirstResult($randomIndex)
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();
                if ($randomProgram !== null) {
                    $actor->addProgram($randomProgram);
                }
            }

            $manager->persist($actor);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
