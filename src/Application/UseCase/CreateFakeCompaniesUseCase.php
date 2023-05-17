<?php

namespace App\Application\UseCase;

use App\Domain\Entity\Company;
use App\Domain\Entity\Employee;
use App\Domain\Entity\Founder;
use App\Domain\Repository\CompanyRepository;
use App\Domain\Repository\EmployeeRepository;
use App\Domain\Repository\FounderRepository;
use App\Domain\ValueObject\CompanyName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\EmployeeName;
use App\Domain\ValueObject\Gender;
use App\Domain\ValueObject\Id;
use App\Domain\ValueObject\Salary;

class CreateFakeCompaniesUseCase implements ExecutableUseCase
{
    private CompanyRepository $companyRepository;
    private EmployeeRepository $employeeRepository;
    private FounderRepository $founderRepository;

    public function __construct(
        CompanyRepository $companyRepository,
        EmployeeRepository $employeeRepository,
        FounderRepository $founderRepository,
    ) {
        $this->companyRepository = $companyRepository;
        $this->employeeRepository = $employeeRepository;
        $this->founderRepository = $founderRepository;
    }

    /**
     * @return array<\App\Domain\Entity\Company>
     */
    public function execute(): array
    {
        return [
            $this->createGoogleCompany(),
            $this->createTwitterCompany(),
        ];
    }

    private function createGoogleCompany(): Company
    {
        $alexClareEmployee = new Employee(
            $this->employeeRepository->getNextId(),
            new Email('alex.clare@gmail.com'),
            new Gender('male'),
            new EmployeeName('Alex', 'Clare'),
            new Salary(2000, 'EUR'),
        );
        $this->employeeRepository->add($alexClareEmployee);

        $johnDoeEmployee = new Employee(
            $this->employeeRepository->getNextId(),
            new Email('john.doe@gmail.com'),
            new Gender('male'),
            new EmployeeName('John', 'Doe'),
            new Salary(4000, 'USD'),
        );
        $this->employeeRepository->add($johnDoeEmployee);

        $robertMartinEmployee = new Employee(
            $this->employeeRepository->getNextId(),
            new Email('robert.martin@gmail.com'),
            new Gender('male'),
            new EmployeeName('Robert', 'Martin'),
            new Salary(3000, 'USD'),
        );
        $this->employeeRepository->add($robertMartinEmployee);

        $founder = new Founder(
            $this->founderRepository->getNextId(),
            new Email('kris.roden@gmail.com'),
            new Gender('male'),
        );

        $this->founderRepository->add($founder);

        $googleCompany = new Company(
            $this->companyRepository->getNextId(),
            new CompanyName('Google'),
            $founder,
        );

        $googleCompany
            ->addEmployee($alexClareEmployee)
            ->addEmployee($johnDoeEmployee)
            ->addEmployee($robertMartinEmployee);

        $this->companyRepository->add($googleCompany);

        return $googleCompany;
    }

    private function createTwitterCompany(): Company
    {
        $alexClareEmployee = new Employee(
            $this->employeeRepository->getNextId(),
            new Email('alex.clare@gmail.com'),
            new Gender('male'),
            new EmployeeName('Alex', 'Clare'),
            new Salary(3000, 'USD'),
        );
        $this->employeeRepository->add($alexClareEmployee);

        $johnDoeEmployee = new Employee(
            $this->employeeRepository->getNextId(),
            new Email('john.doe@gmail.com'),
            new Gender('male'),
            new EmployeeName('John', 'Doe'),
            new Salary(1000, 'EUR'),
        );
        $this->employeeRepository->add($johnDoeEmployee);

        $robertMartinEmployee = new Employee(
            $this->employeeRepository->getNextId(),
            new Email('robert.martin@gmail.com'),
            new Gender('male'),
            new EmployeeName('Robert', 'Martin'),
            new Salary(2000, 'USD'),
        );
        $this->employeeRepository->add($robertMartinEmployee);

        $founder = new Founder(
            $this->founderRepository->getNextId(),
            new Email('mark.roden@gmail.com'),
            new Gender('male'),
        );

        $this->founderRepository->add($founder);

        $googleCompany = new Company(
            $this->companyRepository->getNextId(),
            new CompanyName('Twitter'),
            $founder,
        );

        $googleCompany
            ->addEmployee($alexClareEmployee)
            ->addEmployee($johnDoeEmployee)
            ->addEmployee($robertMartinEmployee);

        $this->companyRepository->add($googleCompany);

        return $googleCompany;
    }
}
