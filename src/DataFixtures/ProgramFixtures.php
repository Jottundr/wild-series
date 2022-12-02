<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'Breaking Bad', 'synopsis' => 'A chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine with a former student in order to secure his family\'s future.', 'poster' => '', 'category' => 'Action'],
        ['title' => 'Game Of Thrones', 'synopsis' => 'Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.', 'poster' => '', 'category' => 'Fantastique'],
        ['title' => 'Stranger Things', 'synopsis' => 'When a young boy disappears, his mother, a police chief and his friends must confront terrifying supernatural forces in order to get him back.', 'poster' => '', 'category' => 'Aventure'],
        ['title' => 'American Horror Story', 'synopsis' => 'An anthology series centering on different characters and locations, including a house with a murderous past, an insane asylum, a witch coven, a freak show circus, a haunted hotel, a possessed farmhouse, a cult, the apocalypse, a slasher summer camp, a bleak beach town and desert valley, and NYC.', 'poster' => '', 'category' => 'Horreur'],
        ['title' => 'Naruto', 'synopsis' => 'Naruto Uzumaki, a mischievous adolescent ninja, struggles as he searches for recognition and dreams of becoming the Hokage, the village\'s leader and strongest ninja.', 'poster' => '', 'category' => 'Animation'],
        ['title' => 'Naruto Shippuden', 'synopsis' => 'Naruto Uzumaki, is a loud, hyperactive, adolescent ninja who constantly searches for approval and recognition, as well as to become Hokage, who is acknowledged as the leader and strongest of all ninja in the village.', 'poster' => '', 'category' => 'Animation'],
        ['title' => 'Bates Motel', 'synopsis' => 'A contemporary prequel to Psycho, giving a portrayal of how Norman Bates\' psyche unravels through his teenage years, and how deeply intricate his relationship with his mother, Norma, truly is.', 'poster' => '', 'category' => 'Horreur'],
        ['title' => 'Death Note', 'synopsis' => 'An intelligent high school student goes on a secret crusade to eliminate criminals from the world after discovering a notebook capable of killing anyone whose name is written into it.', 'poster' => '', 'category' => 'Animation'],
        ['title' => 'One Piece', 'synopsis' => 'Follows the adventures of Monkey D. Luffy and his pirate crew in order to find the greatest treasure ever left by the legendary Pirate, Gold Roger. The famous mystery treasure named "One Piece".', 'poster' => '', 'category' => 'Animation'],
        ['title' => 'Dark', 'synopsis' => 'A family saga with a supernatural twist, set in a German town where the disappearance of two young children exposes the relationships among four families.', 'poster' => '', 'category' => 'Fantastique'],
        ['title' => 'Wednesday', 'synopsis' => 'Follows Wednesday Addams\' years as a student, when she attempts to master her emerging psychic ability, thwart and solve the mystery that embroiled her parents.', 'poster' => 'wednesday.png', 'category' => 'Horreur'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $show) {
            $program = new Program();
            $program->setTitle($show['title']);
            $program->setSynopsis($show['synopsis']);
            $program->setCategory($this->getReference('category_' . $show['category']));
            $program->setPoster($show['poster']);
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
