<?php

namespace App\Infrastructure\Http;

use App\Application\DataTransferObject\AnnualSalary;
use App\Application\UseCase\CreateFakeCompaniesUseCase;
use App\Application\UseCase\GetAnnualSalaryForCompanyUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController
{
    private CreateFakeCompaniesUseCase $createFakeCompaniesUseCase;
    private GetAnnualSalaryForCompanyUseCase $getAnnualSalaryForCompanyUseCase;

    public function __construct(
        CreateFakeCompaniesUseCase $createFakeCompaniesUseCase,
        GetAnnualSalaryForCompanyUseCase $getAnnualSalaryForCompanyUseCase
    ) {
        $this->createFakeCompaniesUseCase = $createFakeCompaniesUseCase;
        $this->getAnnualSalaryForCompanyUseCase = $getAnnualSalaryForCompanyUseCase;
    }

    #[Route('/api/companies', methods: ['GET'])]
    public function all(): JsonResponse
    {
        $jsonData = [];
        $companies = $this->createFakeCompaniesUseCase->execute();

        // TODO: use serializer
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

    #[Route('/api/companies/{id}/annual-salary', methods: ['GET'])]
    public function getAnnualSalary(int $id, Request $request): JsonResponse
    {
        $annualSalary = AnnualSalary::fromArray([
            'idCompany' => $id,
            'currency' => $request->query->get('currency', 'USD'),
        ]);

        $annualSalary = $this->getAnnualSalaryForCompanyUseCase->execute($annualSalary);

        // TODO: use serializer
        return new JsonResponse([
            'idCompany' => $annualSalary->getIdCompany(),
            'currency' => $annualSalary->getCurrency(),
            'salary' => $annualSalary->getSalary(),
        ], Response::HTTP_OK);
    }
}
