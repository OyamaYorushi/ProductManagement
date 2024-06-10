<?php

namespace App\Services;

interface IProductMovementService
{
    public function createProductMovement(array $data): void;
    public static function updateProductStock(int $productId, int $quantity, string $type): void;
}
