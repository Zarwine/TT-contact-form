<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 5; $i++) {
            $contact = new Contact();
            $contact->setFirstname('Firstname')
                    ->setLastname("Lastname")
                    ->setMail("Monmail@mail.com")
                    ->setPhone("0606060606")
                    ->setContent("Votre site internet est magnifique !");

            $manager->persist($contact);
        }

        $manager->flush();
    }
}
