<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAllCategories();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->service->getAllCategories();
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        return $this->service->createCategory($request->all());
    }

    public function show($id)
    {
        $category = $this->service->getCategoryById($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->service->getCategoryById($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        return $this->service->updateCategory($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->service->deleteCategory($id);
    }
}
