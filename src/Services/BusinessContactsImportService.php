<?php


namespace App\Services;


use App\Entity\BusinessContacts;
use App\Entity\Import;
use App\Repository\BusinessContactsRepository;
use App\Repository\BusinessTypesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BusinessContactsImportService
{
    public function importBusinessContacts(string $fileName)
    {
        $filepath = $this->container->getParameter('business_contact_attachments_directory');
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
            $email = trim(strtolower($oneLineFromCsv[2]));
            $mobile1 = trim(strtolower($oneLineFromCsv[3]));
            $businessPhone = trim(strtolower($oneLineFromCsv[4]));
            $company = trim($oneLineFromCsv[5]);
            $website = trim($oneLineFromCsv[6]);
            $businessAddressStreet = trim($oneLineFromCsv[7]);
            $businessAddressCity = trim($oneLineFromCsv[8]);
            $businessAddressPostCode = trim($oneLineFromCsv[9]);
            $businessAddressCountry = trim($oneLineFromCsv[10]);
            $GpsLocation = trim($oneLineFromCsv[11]);
            $publicOrPrivate = trim($oneLineFromCsv[12]);
            $businessOrPerson = trim($oneLineFromCsv[13]);

            if ($email == '') {
                continue;
            }
            $find_business_contact = $this->businessContactsRepository->findOneBy(['email' => $email]);
            if ($find_business_contact) {
                continue;
            } else {
                $business_type =  $this->businessTypesRepository->find(4);
                $business_contact = new BusinessContacts();
                $business_contact->setFirstName($firstName)
                    ->setLastName($lastName)
                    ->setEmail($email)
                    ->setMobile($mobile1)
                    ->setLandline($businessPhone)
                    ->setCompany($company)
                    ->setWebsite($website)
                    ->setAddressStreet($businessAddressStreet)
                    ->setAddressCity($businessAddressCity)
                    ->setAddressPostCode($businessAddressPostCode)
                    ->setAddressCountry($businessAddressCountry)
                    ->setGpsLocation($GpsLocation)
                    ->setPublicPrivate($publicOrPrivate)
                    ->setBusinessOrPerson($businessOrPerson)
                    ->setBusinessType($business_type);
                $this->manager->persist($business_contact);
                $this->manager->flush();
            }
        }

        return null;
    }

    public function __construct(BusinessTypesRepository $businessTypesRepository,ContainerInterface $container, BusinessContactsRepository $businessContactsRepository, EntityManagerInterface $manager)
    {
        $this->container = $container;
        $this->manager = $manager;
        $this->businessContactsRepository = $businessContactsRepository;
        $this->businessTypesRepository = $businessTypesRepository;
    }
}
