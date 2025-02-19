<?php

namespace App\Services;

use App\Repository\CompanyDetailsRepository;

class CompanyDetailsService
{
    private $photolocation;
    public function getCompanyDetails()
    {
        return $this->companyDetailsRepository->find(1);
    }

    public function __construct(CompanyDetailsRepository $companyDetailsRepository)
    {
        $this->companyDetailsRepository = $companyDetailsRepository;
    }


}