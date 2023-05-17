<?php

namespace App\Application\UseCase;

use App\Application\DataTransferObject\AnnualSalary;
use App\Application\Service\CurrencyConverterInterface;
use App\Domain\Repository\CompanyRepository;
use App\Domain\ValueObject\Id;
use App\Domain\ValueObject\Salary;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetAnnualSalaryForCompanyUseCase implements ExecutableUseCase
{
    private const NUMBER_OF_MONTH_IN_YEAR = 12;

    private CompanyRepository $companyRepository;
    private CurrencyConverterInterface $currencyConverter;

    public function __construct(
        CreateFakeCompaniesUseCase $createFakeCompaniesUseCase,
        CompanyRepository $companyRepository,
        CurrencyConverterInterface $currencyConverter
    ) {
        $createFakeCompaniesUseCase->execute();
        $this->companyRepository = $companyRepository;
        $this->currencyConverter = $currencyConverter;
    }

    public function execute(AnnualSalary $annualSalary): AnnualSalary
    {
        $this->assertValidAnnualSalary($annualSalary);
        $company = $this->companyRepository->findById(new Id($annualSalary->getIdCompany()));

        if (!$company) {
            throw new NotFoundHttpException('Invalid company id');
        }

        foreach ($company->getEmployeeSalaries() as $salary) {
            $value = $salary->getValue();

            if ($salary->getCurrency() !== $annualSalary->getCurrency()) {
                $value = $this->currencyConverter->convert(
                    $salary->getValue(),
                    $salary->getCurrency(),
                    $annualSalary->getCurrency()
                );
            }

            $annualSalary->setSalary($annualSalary->getSalary() + ($value * self::NUMBER_OF_MONTH_IN_YEAR));
        }

        return $annualSalary;
    }

    private function assertValidAnnualSalary(AnnualSalary $annualSalary): void
    {
        if (!$annualSalary->getIdCompany() || $annualSalary->getIdCompany() <= 0) {
            throw new \InvalidArgumentException('Invalid company id');
        }

        if (!$annualSalary->getCurrency() || !in_array($annualSalary->getCurrency(), Salary::VALID_CURRENCY_LIST, true)) {
            throw new \InvalidArgumentException('Invalid currency');
        }
    }
}
