<?php

namespace App\Controller;

use App\Entity\BusinessContacts;
use App\Form\BusinessContactsType;
use App\Form\ImportType;
use App\Repository\BusinessContactsRepository;
use App\Repository\BusinessTypesRepository;
use App\Repository\PtOutsourceRepository;
use App\Repository\TennisVenuesRepository;
use App\Repository\UserRepository;
use App\Services\BusinessContactsImportService;
use App\Services\UserImportService;
use Doctrine\ORM\EntityManagerInterface;
use JeroenDesloovere\VCard\VCard;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/businesscontacts")
 */
class BusinessContactsController extends AbstractController
{
    /**
     * @Route("/", name="business_contacts_index", methods={"GET"})
     */
    public function index(BusinessContactsRepository $businessContactsRepository, BusinessTypesRepository $businessTypesRepository): Response
    {
        $business_contacts= $businessContactsRepository->findBy([
            'status' =>'Approved'
        ]);
        if($this->isGranted('ROLE_STAFF')){
            $business_contacts= $businessContactsRepository->findAll();
        }
        $business_categories= [] ;

        foreach ($businessTypesRepository->findAll() as $businessTypes){
            $business_categories[] = $businessTypes->getBusinessCategory();
        }
        $business_categories = array_unique($business_categories);
        return $this->render('business_contacts/index.html.twig', [
            'business_contacts' => $business_contacts,
            'categories'=>$business_categories
        ]);
    }

    /**
     * @Route("/new", name="business_contacts_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BusinessContactsRepository $businessContactsRepository): Response
    {
        $businessContact = new BusinessContacts();
        $form = $this->createForm(BusinessContactsType::class, $businessContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessContactsRepository->add($businessContact, true);

            return $this->redirectToRoute('business_contacts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('business_contacts/new.html.twig', [
            'business_contact' => $businessContact,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/suggestion", name="business_contacts_suggestion", methods={"GET", "POST"})
     */
    public function suggestion(Request $request, BusinessContactsRepository $businessContactsRepository): Response
    {
        $businessContact = new BusinessContacts();
        $form = $this->createForm(BusinessContactsType::class, $businessContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessContactsRepository->add($businessContact, true);
            $businessContact->setStatus('Pending');

            return $this->redirectToRoute('business_contacts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('business_contacts/new.html.twig', [
            'business_contact' => $businessContact,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="business_contacts_show", methods={"GET"})
     */
    public function show(BusinessContacts $businessContact): Response
    {
        return $this->render('business_contacts/show.html.twig', [
            'business_contact' => $businessContact,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="business_contacts_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BusinessContacts $businessContact, BusinessContactsRepository $businessContactsRepository): Response
    {
        $form = $this->createForm(BusinessContactsType::class, $businessContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessContactsRepository->add($businessContact, true);

            return $this->redirectToRoute('business_contacts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('business_contacts/edit.html.twig', [
            'business_contact' => $businessContact,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="business_contacts_delete", methods={"POST"})
     */
    public function delete(Request $request, BusinessContacts $businessContact, BusinessContactsRepository $businessContactsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $businessContact->getId(), $request->request->get('_token'))) {
            $businessContactsRepository->remove($businessContact, true);
        }

        return $this->redirectToRoute('business_contacts_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route ("/export/business_contacts", name="business_contacts_export" )
     */
    public function businessContactsExport(BusinessContactsRepository $businessContactsRepository)
    {
        $data = [];
        $fileName = 'business_contacts_export.csv';
        $exported_date = new \DateTime('now');
        $exported_date = $exported_date->format('d-M-Y h:m');
        $count = 0;
        $business_contact_list = $businessContactsRepository->findAll();
        foreach ($business_contact_list as $business_contact) {
            $concatenatedNotes = "Exported from GRTS.com on: " . $exported_date;
            $data[] = [
                $business_contact->getFirstName(),
                $business_contact->getLastName(),
                $business_contact->getEmail(),
                $business_contact->getMobile(),
                $business_contact->getLandline(),
                $business_contact->getCompany(),
                $business_contact->getWebsite(),
                $business_contact->getAddressStreet(),
                $business_contact->getAddressCity(),
                $business_contact->getAddressPostCode(),
                $business_contact->getAddressCountry(),
                $business_contact->getGpsLocation(),
                $business_contact->getPublicPrivate(),
                $business_contact->getBusinessOrPerson(),
                $concatenatedNotes,
                $business_contact->getId()
            ];
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Business Contacts');
        $sheet->getCell('A1')->setValue('First Name');
        $sheet->getCell('B1')->setValue('Last Name');
        $sheet->getCell('C1')->setValue('Email');
        $sheet->getCell('D1')->setValue('Mobile1');
        $sheet->getCell('E1')->setValue('Business phone');
        $sheet->getCell('F1')->setValue('Company');
        $sheet->getCell('G1')->setValue('Website');
        $sheet->getCell('H1')->setValue('Business Street');
        $sheet->getCell('I1')->setValue('Business City');
        $sheet->getCell('J1')->setValue('Business PostalCode');
        $sheet->getCell('K1')->setValue('Business Country');
        $sheet->getCell('L1')->setValue('GPS Location');
        $sheet->getCell('M1')->setValue('Public or Private');
        $sheet->getCell('N1')->setValue('Business or Person');
        $sheet->getCell('O1')->setValue('Notes');
        $sheet->getCell('P1')->setValue('Id');

        $sheet->fromArray($data, null, 'A2', true);
        $total_rows = $sheet->getHighestRow();
        for ($i = 2; $i <= $total_rows; $i++) {
            $cell = "L" . $i;
            $sheet->getCell($cell)->getHyperlink()->setUrl("https://google.com");
        }
        $writer = new Csv($spreadsheet);
        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', sprintf('attachment;filename="%s"', $fileName));
        $response->headers->set('Cache-Control', 'max-age=0');
        return $response;
    }


    /**
     * @Route ("/import/business_contacts", name="business_contacts_import" )
     */
    public function businessContactsImport(Request $request, SluggerInterface $slugger, BusinessContactsRepository $businessContactsRepository, BusinessContactsImportService $businessContactsImportService): Response
    {
        $form = $this->createForm(ImportType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $importFile = $form->get('File')->getData();
            if ($importFile) {
                $originalFilename = pathinfo($importFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '.' . 'csv';
                try {
                    $importFile->move(
                        $this->getParameter('business_contact_attachments_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    die('Import failed');
                }
                $businessContactsImportService->importBusinessContacts($newFilename);
                return $this->redirectToRoute('business_contacts_index');
            }
        }
        return $this->render('business_contacts/import.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/create/Vcard/{id}", name="create_vcard")
     */
    public function createVcard(int $id, BusinessContactsRepository $businessContactsRepository)
    {
        $business_contact = $businessContactsRepository->find($id);
        $vcard = new VCard();
        $firstName = $business_contact->getFirstName();
        $lastName = $business_contact->getLastName();
        $company = $business_contact->getCompany();
        $website = $business_contact->getWebsite();
        $address = $business_contact->getAddressStreet();
        $addressCity = $business_contact->getAddressCity();
        $addressPostalCode = $business_contact->getAddressPostcode();
        $addressCountry = $business_contact->getAddressCountry();
        $notes = "GPS location: ". $business_contact->getGpsLocation();
        $vcard->addName($lastName, $firstName);
        $vcard->addEmail($business_contact->getEmail())
            ->addPhoneNumber($business_contact->getLandline(), 'work')
            ->addCompany($company)
            ->addURL($website)
            ->addNote($notes)
            ->addAddress($name = '', $extended = '', $street = $address, $city = $addressCity, $region = '', $zip = $addressPostalCode, $country = $addressCountry, $type = 'WORK;POSTAL');
        $vcard->download();
        return new Response(null);
    }


    /**
     * @Route("/gps/GoogleMap/show/{id}", name="show_location_google_maps", methods={"GET"})
     */
    public function showMap(int $id, BusinessContactsRepository $businessContactsRepository): Response
    {
        $business_contact = $businessContactsRepository->find($id);
        $get_latitude_longitude = explode(',', $business_contact->getGpsLocation());
        return $this->render('business_contacts/gpsGoogleMaps.html.twig', [
            'latitude' => $get_latitude_longitude[0],
            'longitude' => $get_latitude_longitude[1],
            'business' => $business_contact->getCompany()
        ]);
    }

    /**
     * @Route("/update/user/location", name="update_user_location", methods={"POST"})
     */
    public function updateLocation(BusinessContactsRepository $businessContactsRepository, EntityManagerInterface $manager): Response
    {
        $id = $_POST['id'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $gps = $latitude . ',' . $longitude;
        $business_contact = $businessContactsRepository->find($id);
        $business_contact->setGpsLocation($gps);
        $manager->flush();
        return new Response(null);
    }


    /**
     * @Route("/create/Vcard/{id}", name="create_business_contacts_vcard")
     *
     */
    public function createUseVcard(int $id, BusinessContactsRepository $businessContactsRepository)
    {
        $business_contact = $businessContactsRepository->find($id);
        $vcard = new VCard();
        $firstName = $business_contact->getFirstName();
        $lastName = $business_contact->getLastName();
        $company = $business_contact->getCompany();
        $address = $business_contact->getAddressStreet();
        $addressCity = $business_contact->getAddressCity();
        $addressPostCode = $business_contact->getAddressPostcode();
        $addressCountry = $business_contact->getAddressCountry();
        $notes = 'TBC';

        $vcard->addName($lastName, $firstName);
        $vcard->addEmail($business_contact->getEmail())
            ->addPhoneNumber($business_contact->getLandline(), 'work')
            ->addCompany($company)
            ->addAddress($name = '', $extended = '', $street = $address, $city = $addressCity, $region = '', $zip = $addressPostalCode, $country = $addressCountry, $type = 'WORK;POSTAL')
            ->addNote($notes);
        $vcard->download();
        return new Response(null);
    }
}
