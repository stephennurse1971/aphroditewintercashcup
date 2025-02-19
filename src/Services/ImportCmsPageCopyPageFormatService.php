<?php


namespace App\Services;

use App\Entity\CmsCopyPageFormats;
use App\Repository\CmsCopyPageFormatsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ImportCmsPageCopyPageFormatService
{
    public function importCmsCopyPageFormats(string $fileName)
    {
        $name = '';
        $description = '';
        $uses = '';
        $pros = '';
        $cons = '';

        $filepath = $this->container->getParameter('cms_copy_page_formats_import_directory');
        $fullpath = $filepath . $fileName;
        $alldataFromCsv = [];
        $row = 0;
        if (($handle = fopen($fullpath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                if ($row == 0) {
                    $row++;
                    continue;
                }
                $num = count($data);
                $row++;
                for ($c = 0; $c < $num; $c++) {
                    $alldataFromCsv[$row][] = $data[$c];
                }
            }
            fclose($handle);
        }
        foreach ($alldataFromCsv as $oneLineFromCsv) {
            $entity =  trim($oneLineFromCsv[0]);
            $name = trim($oneLineFromCsv[1]);
            $description = trim($oneLineFromCsv[2]);
            $uses = trim($oneLineFromCsv[3]);
            $pros = trim($oneLineFromCsv[4]);
            $cons = trim($oneLineFromCsv[5]);

            $cms_copy_page_format = $this->cmsCopyPageFormatsRepository->findOneBy([
                'name' => $name
            ]);

            if (!$cms_copy_page_format and $entity== 'CMSCopyPageFormats') {
                $cms_copy_page_format = new CmsCopyPageFormats();
                $cms_copy_page_format->setName($name)
                    ->setDescription($description)
                    ->setUses($uses)
                    ->setPros($pros)
                    ->setCons($cons)
//                    ->setCode($code)
                ;
                $this->manager->persist($cms_copy_page_format);
                $this->manager->flush();
            }
        }
        $this->manager->flush();
        return null;
    }

    public function __construct(CmsCopyPageFormatsRepository $cmsCopyPageFormatsRepository, ContainerInterface $container, EntityManagerInterface $manager)
    {
        $this->container = $container;
        $this->manager = $manager;
        $this->cmsCopyPageFormatsRepository = $cmsCopyPageFormatsRepository;
    }
}
