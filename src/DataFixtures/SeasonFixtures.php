<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        ['number' => '1', 'year' => '2008', 'description' => 'La meilleure saison', 'program' => 'Breaking Bad'],
        ['number' => '2', 'year' => '2009', 'description' => '', 'program' => 'Breaking Bad'],
        ['number' => '3', 'year' => '2010', 'description' => '', 'program' => 'Breaking Bad'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $seasonInfo) {
            $season = new Season();
            $season->setNumber($seasonInfo['number']);
            $season->setYear($seasonInfo['year']);
            $season->setDescription($seasonInfo['description']);
            $season->setProgram($this->getReference('program_' . $seasonInfo['program']));
            $manager->persist($season);
            $this->addReference('season_' . $seasonInfo['number'], $season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}
