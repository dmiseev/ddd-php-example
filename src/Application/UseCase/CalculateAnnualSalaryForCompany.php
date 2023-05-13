<?php

namespace App\Application\UseCase;

use App\Domain\Repository\CompanyRepository;

class CalculateAnnualSalaryForCompany
{
    private CreateFakeCompaniesUseCase $createFakeCompaniesUseCase;

    public function __construct(CreateFakeCompaniesUseCase $createFakeCompaniesUseCase)
    {
        $this->createFakeCompaniesUseCase = $createFakeCompaniesUseCase;
    }
    public function execute(): array
    {
        $totals = [];
        $companies = $this->createFakeCompaniesUseCase->execute();

        foreach ($companies as $company) {
            $totals[$company->getCompanyName()->getValue()] = $company->calculateAnnualSalary();
        }

        // TODO: use DTO
        return $totals;
    }
}