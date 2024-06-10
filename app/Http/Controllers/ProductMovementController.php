<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductMovement;
use Illuminate\Http\Request;
use App\Services\IProductMovementService;
use Illuminate\Support\Facades\DB;

class ProductMovementController extends Controller
{
    protected $productMovementService;

    public function __construct(IProductMovementService $productMovementService)
    {
        $this->productMovementService = $productMovementService;
    }

    public function index()
    {
        $movements = ProductMovement::with('product')->get();
        return view('movements.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::all();
        return view('movements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out',
        ]);

        try {
            $this->productMovementService->createProductMovement([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'type' => $request->type,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('movements.index')->with('error', $e->getMessage());
        }

        return redirect()->route('movements.index')->with('success', 'Movimentação registrada com sucesso.');
    }

    public function topProductsChart()
    {
        $topProducts = ProductMovement::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->where('type', 'out')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        $labels = $topProducts->pluck('product.name');
        $quantities = $topProducts->pluck('total_quantity');

        $chartData = [
            'labels' => $labels,
            'quantities' => $quantities,
        ];

        return $chartData;
    }
}
