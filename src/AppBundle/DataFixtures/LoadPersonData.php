<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 16/10/2018
 * Time: 12:07
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;



class LoadPersonData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $person1 = new Person();
        $person1->setFirstName('Tom');
        $person1->setLastName('Hanks');
        $person1->setDateOfBirth(new \DateTime('1957-12-10'));

        $manager->persist($person1);
        $manager->flush();
    }

}