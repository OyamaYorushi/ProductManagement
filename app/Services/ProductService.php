<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductService
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getAllProducts()
    {
        return $this->model->all();
    }

    public function createProduct(array $data)
    {
        try {
            DB::transaction(function () use ($data) {
                if (isset($data['photo'])) {
                    $data['photo'] = $data['photo']->store('photos', 'public');
                }

                $this->model->create($data);
            }, 5);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ocorreu um erro ao criar o produto.');
        }

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso.');
    }


    public function getProductById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (\Exception $e) {
            abort(404, 'Produto não encontrado');
        }
    }

    public function updateProduct(int $id, array $data)
    {
        try {
            DB::transaction(function () use ($id, $data) {
                $product = $this->model->find($id);
                if (!$product) {
                    throw new \Exception('Produto não encontrado');
                }

                if (isset($data['photo'])) {
                    $data['photo'] = $data['photo']->store('photos', 'public');
                }

                $product->update($data);
            }, 5);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ocorreu um erro ao atualizar o produto.');
        }

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso.');
    }


    public function deleteProduct(int $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $product = $this->model->find($id);
                if (!$product) {
                    throw new \Exception('Produto não encontrado');
                }

                $product->delete();
            }, 5);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ocorreu um erro ao deletar o produto.');
        }

        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso.');
    }

}
