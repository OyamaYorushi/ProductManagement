<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAllCategories()
    {
        return $this->model->all();
    }

    public function createCategory(array $data)
    {
        try {
            $existingCategory = Category::where('name', $data['name'])->first();

            if ($existingCategory) {
                return redirect()->back()->withErrors(['name' => 'Já existe uma categoria com o nome "'. $data['name']. '". Por favor, escolha outro nome.']);
            }

            DB::transaction(function () use ($data) {
                $this->model->create($data);
            }, 5);
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ocorreu um erro ao criar categoria.');
        }
        return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso.');
    }

    public function getCategoryById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(404, 'Categoria não encontrada');
        }
    }

    public function updateCategory(int $id, array $data)
    {
        $category = $this->model->find($id);

        try {

            if (!$category) {
                throw new \Exception('Categoria não encontrada');
            }
            if (!empty($data['name']) && $data['name']!= $category->name) {
                $existingCategory = $this->model->where('name', $data['name'])->where('id', '!=', $id)->first();

                if ($existingCategory) {
                    return redirect()->back()->withErrors(['name' => 'Já existe uma categoria com o nome "'. $data['name']. '". Por favor, escolha outro nome.']);
                }
            }

            DB::transaction(function () use ($id, $data) {
                $category = $this->model->find($id);
                if (!$category) {
                    throw new \Exception('Categoria não encontrada');
                }

                $category->update($data);
            }, 5);

            return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso.');

        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ocorreu um erro ao atualizar o categoria.');
        }
    }

    public function deleteCategory(int $id)
    {

        try {

            DB::transaction(function () use ($id) {
                $category = $this->model->find($id);
                if (!$category) {
                    throw new \Exception('Categoria não encontrada');
                }
    
                $category->delete();
            }, 5);
    
            return redirect()->route('categories.index')->with('success', 'Categoria deletada com sucesso.');

        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ocorreu um erro ao deletar o categoria.');;
        }
        
    }
}
