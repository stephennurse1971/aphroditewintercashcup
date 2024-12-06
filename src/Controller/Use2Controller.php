<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Form\ImportType;
use App\Form\UserType;
use App\Repository\BusinessContactsRepository;
use App\Repository\HealthRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use App\Services\BusinessContactsImportService;
use App\Services\UserIsHouseGuest;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


/**
 * @Route("/user")
 *
 */
class Use2Controller extends AbstractController
{
    /**
     * @Route("/index/singles", name="user_index_singles", methods={"GET"})
     * @Security("is_granted('ROLE_STAFF')")
     */
    public function indexSingles(UserRepository $userRepository, ProductRepository $servicesOfferedRepository): Response
    {
        $now = new \DateTime('now');
        $users = $userRepository->findBy([
            'playingSingles' => 1
        ]);

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'title' => 'Singles',
            'services' => $servicesOfferedRepository->findAll(),
            'now' => $now
        ]);
    }

    /**
     * @Route("/index/doubles", name="user_index_doubles", methods={"GET"})
     * @Security("is_granted('ROLE_STAFF')")
     */
    public function indexDoubles(UserRepository $userRepository, ProductRepository $servicesOfferedRepository): Response
    {
        $now = new \DateTime('now');
        $users = $userRepository->findBy([
            'playingDoubles' => 1
        ]);

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'title' => 'Doubles',
            'services' => $servicesOfferedRepository->findAll(),
            'now' => $now
        ]);
    }


    /**
     * @Route("/index/doubles_unmatched", name="user_index_doubles_unmatched", methods={"GET"})
     * @Security("is_granted('ROLE_STAFF')")
     */
    public function indexDoublesUnMatched(UserRepository $userRepository, ProductRepository $servicesOfferedRepository): Response
    {
        $now = new \DateTime('now');
        $users = $userRepository->findBy([
            'playingDoubles' => 1,
            'doublesPartner' => null
        ]);


        return $this->render('user/index.html.twig', [
            'users' => $users,
            'title' => 'Doubles - Unmatched',
            'services' => $servicesOfferedRepository->findAll(),
            'now' => $now
        ]);
    }

    /**
     * @Route("/index/not_paid", name="user_index_not_paid", methods={"GET"})
     * @Security("is_granted('ROLE_STAFF')")
     */
    public function indexNotPaid(UserRepository $userRepository, ProductRepository $servicesOfferedRepository): Response
    {
        $now = new \DateTime('now');
        $users = $userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'title' => 'Not Paid',
            'services' => $servicesOfferedRepository->findAll(),
            'now' => $now
        ]);
    }

    /**
     * @Route("/index/paid", name="user_index_paid", methods={"GET"})
     * @Security("is_granted('ROLE_STAFF')")
     */
    public function indexPaid(UserRepository $userRepository, ProductRepository $servicesOfferedRepository): Response
    {
        $now = new \DateTime('now');
        $users = $userRepository->findUsersWithNonZeroPaidAmount();

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'title' => 'Paid',
            'services' => $servicesOfferedRepository->findAll(),
            'now' => $now
        ]);
    }

    /**
     * @Route("/change_playing_singles_or_doubles/{singles_or_doubles}/{id}", name="change_playing_singles_or_doubles", methods={"GET", "POST"})
     */
    public function changePlayingSinglesOrDoubles(Request $request, $singles_or_doubles, User $user, EntityManagerInterface $manager): Response
    {
        $referer = $request->headers->get('Referer');
        $singles = $user->isPlayingSingles();
        $doubles = $user->isPlayingDoubles();

        if ($singles_or_doubles == "Singles") {
            if ($singles == false) {
                $user->setPlayingSingles(true);
                $manager->flush();
            }
            if ($singles == true) {
                $user->setPlayingSingles(false);
                $manager->flush();
            }
        }
        if ($singles_or_doubles == "Doubles") {
            if ($doubles == false) {
                $user->setPlayingDoubles(1);
                $manager->flush();
            }
            if ($doubles == true) {
                $user->setPlayingDoubles(0);
                $manager->flush();
            }
        }

        if ($singles_or_doubles == "Pay SN 50") {
            $user->setPaidTo('SN');
            $user->setPaidAmount('50');
            $manager->flush();
        }

        if ($singles_or_doubles == "Pay SN 80") {
            $user->setPaidTo('SN');
            $user->setPaidAmount('80');
            $manager->flush();
        }

        if ($singles_or_doubles == "Pay NR 50") {
            $user->setPaidTo('NR');
            $user->setPaidAmount('50');
            $manager->flush();
        }

        if ($singles_or_doubles == "Pay NR 100") {
            $user->setPaidTo('NR');
            $user->setPaidAmount('100');
            $manager->flush();
        }

        if ($singles_or_doubles == "Reset payments") {
            $user->setPaidTo(null);
            $user->setPaidAmount(null);
            $manager->flush();
        }

        return $this->redirect($referer);
    }

}