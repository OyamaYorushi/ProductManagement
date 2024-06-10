<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductMovement;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ProductMovementService implements IProductMovementService
{
    public function createProductMovement(array $data): void
    {
        DB::transaction(function () use ($data) {
            // Verifica se o produto existe
            $product = Product::find($data['product_id']);
            if (!$product) {
                throw new \Exception('Produto não encontrado');
            }

            // Verifica se o produto tem estoque suficiente
            if (($data['type'] === 'out' && $product->stock_quantity < $data['quantity']) || 
                ($data['type'] === 'in' && $product->stock_quantity + $data['quantity'] > $product->max_stock)) {
                throw new \Exception('Não é possível realizar essa movimentação devido à falta de estoque');
            }

            $movement = new ProductMovement();
            $movement->product_id = $data['product_id'];
            $movement->quantity = $data['quantity'];
            $movement->type = $data['type'];
            $movement->save();

            try {
                if ($data['type'] === 'in') {
                    $product->increment('stock_quantity', $data['quantity']);
                } else {
                    $product->decrement('stock_quantity', $data['quantity']);
                }
            } catch (ModelNotFoundException $e) {
                throw new \Exception('Falha ao gerar movimentação');
            }
        });
    }

    public static function updateProductStock(int $productId, int $quantity, string $type): void
    {
        DB::transaction(function () use ($productId, $quantity, $type) {
            // Verifica se o produto existe
            $product = Product::find($productId);
            if (!$product) {
                throw new \Exception('Produto não encontrado');
            }

            // Verifica se o produto tem estoque suficiente
            if (($type === 'out' && $product->stock_quantity < $quantity) || 
                ($type === 'in' && $product->stock_quantity + $quantity > $product->max_stock)) {
                throw new \Exception('Não é possível realizar essa movimentação devido à falta de estoque');
            }

            try {
                if ($type === 'in') {
                    $product->increment('stock_quantity', $quantity);
                } else {
                    $product->decrement('stock_quantity', $quantity);
                }
            } catch (ModelNotFoundException $e) {
                throw new \Exception('Falha ao gerar movimentação');
            }
        });
    }
}
