<?php

namespace App\Application\UseCase;

use App\Domain\Repository\EmployeeRepository;
use App\Domain\ValueObject\Id;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RemoveEmployeeUseCase implements ExecutableUseCase
{
    protected EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function execute(int $employeeId): void
    {
        $employee = $this->employeeRepository->findById(new Id($employeeId));

        if (!$employee) {
            throw new NotFoundHttpException('Invalid employee id');
        }

        $this->employeeRepository->remove($employee);
    }
}
