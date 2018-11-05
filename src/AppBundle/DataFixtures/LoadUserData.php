<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 28/10/2018
 * Time: 23:14
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends Fixture implements ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');
        $user1 = new User();
        $user1->setUsername('john_doe');
        $user1->setPassword($passwordEncoder->encodePassword($user1, 'Secure123!'));

        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('jane_doe');
        $user2->setPassword($passwordEncoder->encodePassword($user2, 'ExampleSecure321!'));

        $manager->persist($user2);

        $manager->flush();

    }

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

    }
}