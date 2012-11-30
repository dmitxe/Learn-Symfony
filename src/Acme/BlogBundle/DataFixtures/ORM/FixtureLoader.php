<?php

namespace Acme\BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
//use Company\BlogBundle\Entity\Category;
use Acme\BlogBundle\Entity\Post;
//use Company\BlogBundle\Entity\Tag;
use Acme\BlogBundle\Entity\User;
use Acme\BlogBundle\Entity\Role;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class FixtureLoader implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Создание пользователя
        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setEmail('john@example.com');
        $user->setUsername('root');
        $user->setSalt(md5(microtime()));

        // Шифрует и устанавливает пароль для пользователя,
        // эти настройки совпадают с конфигурационными файлами
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('123', $user->getSalt());
        $user->setPassword($password);

        // Создание ролей
        $role = new Role();
        $role->setName('ROLE_ADMIN');

        $role2 = new Role();
        $role2->setName('ROLE_EDITOR');

        $user->addRole($role);
        $user->addRole($role2);

        $manager->persist($user);
        $manager->flush();
    }
}
