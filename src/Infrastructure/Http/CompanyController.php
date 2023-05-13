<?php

namespace App\Infrastructure\Http;

use App\Application\UseCase\CalculateAnnualSalaryForCompany;
use App\Application\UseCase\CreateFakeCompaniesUseCase;
use App\Application\UseCase\CreateFakeCompanyUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController
{
    private CreateFakeCompaniesUseCase $createFakeCompaniesUseCase;
    private CalculateAnnualSalaryForCompany $calculateAnnualSalaryForCompany;

    public function __construct(
        CreateFakeCompaniesUseCase $createFakeCompaniesUseCase,
        CalculateAnnualSalaryForCompany $calculateAnnualSalaryForCompany
    ) {
        $this->createFakeCompaniesUseCase = $createFakeCompaniesUseCase;
        $this->calculateAnnualSalaryForCompany = $calculateAnnualSalaryForCompany;
    }

    #[Route('/api/companies', methods: ['GET'])]
    public function all(): JsonResponse
    {
        $jsonData = [];
        $companies = $this->createFakeCompaniesUseCase->execute();

        // TODO: serializer
        foreach ($companies as $company) {
            $companyJsonData = [
                'id' => $company->getId()->getValue(),
                'name' => $company->getCompanyName()->getValue(),
                'employees' => [],
            ];

            foreach ($company->getEmployees() as $employee) {
                $companyJsonData['employees'][] = [
                    'id' => $employee->getId()->getValue(),
                    'email' => $employee->getEmail()->getValue(),
                    'gender' => $employee->getGender()->getValue(),
                    'fullName' => $employee->getEmployeeName()->getFullName(),
                    'salary' => $employee->getSalary()->getValueWithCurrency(),
                ];
            }

            $jsonData[] = $companyJsonData;
        }

        return new JsonResponse($jsonData, Response::HTTP_CREATED);
    }

    #[Route('/api/companies/annual-salary', methods: ['GET'])]
    public function calculateAnnualSalary(): JsonResponse
    {
        $totals = $this->calculateAnnualSalaryForCompany->execute();

        return new JsonResponse($totals, Response::HTTP_OK);
    }
}