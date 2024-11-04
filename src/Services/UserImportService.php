<?php


namespace App\Services;


use App\Entity\Import;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserImportService
{
    public function importUsers(string $fileName)
    {
        $filepath = $this->container->getParameter('users_attachments_directory');
        $fullpath = $filepath . $fileName;
        $alldatatsFromCsv = [];
        $row = 0;
        if (($handle = fopen($fullpath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row == 0) {
                    $row++;
                    continue;
                }
                $num = count($data);
                $row++;
                for ($c = 0; $c < $num; $c++) {
                    $alldatatsFromCsv[$row][] = $data[$c];
                }
            }
            fclose($handle);
        }

        foreach ($alldatatsFromCsv as $oneLineFromCsv) {
            $firstName = trim($oneLineFromCsv[0]);
            $lastName = trim($oneLineFromCsv[1]);
            $email = trim($oneLineFromCsv[2]);
            $mobile = trim($oneLineFromCsv[3]);
            $playingSingles = trim($oneLineFromCsv[4]);
            $playingDoubles = trim($oneLineFromCsv[5]);


            if ($email == '') {
                continue;
            }
            $find_user = $this->userRepository->findOneBy(['email' => $email]);
            if ($find_user) {
                continue;
            } else {
                $user = new User();
                $user->setPassword(
                    $this->userPasswordHasher->hashPassword(
                        $user,
                        $user->getPassword()
                    )
                );
                $user->setFirstName($firstName)
                    ->setLastName($lastName)
                    ->setEmail($email)
                    ->setMobile($mobile)
                    ->setPlayingSingles($playingSingles)
                    ->setPlayingDoubles($playingDoubles)
                    ->setRoles(['ROLE_USER'])
                ;
                $this->manager->persist($user);
                $this->manager->flush();
            }
        }

        return null;
    }

    public function __construct(UserPasswordHasherInterface $userPasswordHasher, ContainerInterface $container, \App\Repository\UserRepository $userRepository, EntityManagerInterface $manager)
    {
        $this->container = $container;
        $this->manager = $manager;
        $this->userRepository = $userRepository;
        $this->userPasswordHasher = $userPasswordHasher;
    }
}
