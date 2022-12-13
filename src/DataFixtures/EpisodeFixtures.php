<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        ['title' => 'Pilot', 'number' => '1', 'synopsis' => 'Diagnosed with terminal lung cancer, chemistry teacher Walter White teams up with former student Jesse Pinkman to cook and sell crystal meth.', 'season' => '1', 'program' => 'Breaking Bad'],
        ['title' => 'Cat\'s in the bag...', 'number' => '2', 'synopsis' => 'After their first drug deal goes terribly wrong, Walt and Jesse are forced to deal with a corpse and a prisoner. Meanwhile, Skyler grows suspicious of Walt\'s activities.', 'season' => '1', 'program' => 'Breaking Bad'],
        ['title' => '...and the bag\'s in the river', 'number' => '3', 'synopsis' => 'Walt and Jesse clean up after the bathtub incident before Walt decides what course of action to take with their prisoner Krazy-8.', 'season' => '1', 'program' => 'Breaking Bad'],
        ['title' => 'Cancer Man', 'number' => '4', 'synopsis' => 'Walt tells the rest of his family about his cancer. Jesse tries to make amends with his own parents.', 'season' => '1', 'program' => 'Breaking Bad'],
        ['title' => 'Gray matter', 'number' => '5', 'synopsis' => 'Walt rejects everyone who tries to help him with the cancer. Jesse tries his best to create Walt\'s meth, with the help of an old friend.', 'season' => '1', 'program' => 'Breaking Bad'],
        ['title' => 'Crazy handful of nothin\'', 'number' => '6', 'synopsis' => 'With the side effects and cost of his treatment mounting, Walt demands that Jesse finds a wholesaler to buy their drugs - which lands him in trouble.', 'season' => '1', 'program' => 'Breaking Bad'],
        ['title' => 'A no-rough-stuff-type deal', 'number' => '7', 'synopsis' => 'Walt and Jesse try to up their game by making more of the crystal every week for Tuco. Unfortunately, some of the ingredients they need are not easy to find. Meanwhile, Skyler realizes that her sister is a shoplifter.', 'season' => '1', 'program' => 'Breaking Bad'],
        ['title' => 'jhvfhgf', 'number' => '7', 'synopsis' => 'Dracarys', 'season' => '1', 'program' => 'Game Of Thrones'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $episodeInfo) {
            $episode = new Episode();
            $episode->setTitle($episodeInfo['title']);
            $episode->setNumber($episodeInfo['number']);
            $episode->setSynopsis($episodeInfo['synopsis']);
            $episode->setSeason($this->getReference($episodeInfo['program'] . 'season_' . $episodeInfo['season']));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }
}
