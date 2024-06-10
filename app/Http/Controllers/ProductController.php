<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;
    protected $categoryService;

    public function __construct(ProductService $service, CategoryService $categoryService)
    {
        $this->service = $service;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $products = $this->service->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();;
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'sku' => 'required|string|unique:products,sku',
            'description' => 'nullable|string',
            'photo' => 'nullable|image',
            'expiry_date' => 'nullable|date',
            'stock_quantity' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png|max:5120',
        ]);

        return $this->service->createProduct($validatedData);
    }

    public function show($id)
    {
        $product = $this->service->getProductById($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->service->getProductById($id);
        $categories = $this->categoryService->getAllCategories();;
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'sku' => 'required|string|unique:products,sku,'. $id,
            'description' => 'nullable|string',
            'photo' => 'nullable|image',
            'expiry_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png|max:5120',
            'stock_quantity' => 'required|numeric',
        ]);

        return $this->service->updateProduct($id, $validatedData);
    }

    public function destroy($id)
    {
        return $this->service->deleteProduct($id);
    }
}
