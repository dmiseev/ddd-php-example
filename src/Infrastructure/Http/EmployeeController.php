<?php

namespace App\Infrastructure\Http;

use App\Application\UseCase\RemoveEmployeeUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController
{
    protected RemoveEmployeeUseCase $removeEmployeeUseCase;

    public function __construct(RemoveEmployeeUseCase $removeEmployeeUseCase)
    {
        $this->removeEmployeeUseCase = $removeEmployeeUseCase;
    }

    #[Route('/api/employees/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->removeEmployeeUseCase->execute($id);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
