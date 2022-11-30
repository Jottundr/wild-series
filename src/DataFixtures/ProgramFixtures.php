<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'Spider-Man', 'synopsis' => 'After being bitten by a genetically-modified spider, a shy teenager gains spider-like abilities that he uses to fight injustice as a masked superhero and face a vengeful enemy.', 'category' => 'Action'],
        ['title' => 'Spider-Man 2', 'synopsis' => 'Peter Parker is beset with troubles in his failing personal life as he battles a brilliant scientist named Doctor Otto Octavius.', 'category' => 'Action'],
        ['title' => 'The Lord of the Rings: The Fellowship of the Ring', 'synopsis' => 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.', 'category' => 'Fantastique'],
        ['title' => 'Saw', 'synopsis' => 'Two strangers awaken in a room with no recollection of how they got there, and soon discover they\'re pawns in a deadly game perpetrated by a notorious serial killer.', 'category' => 'Horreur'],
        ['title' => 'Toy Story', 'synopsis' => 'A cowboy doll is profoundly threatened and jealous when a new spaceman action figure supplants him as top toy in a boy\'s bedroom.', 'category' => 'Animation']
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $movie) {
            $program = new Program();
            $program->setTitle($movie['title']);
            $program->setSynopsis($movie['synopsis']);
            $program->setCategory($this->getReference('category_' . $movie['category']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
