<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Service\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $data= $this->productService->getAllProducts();
        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'sometimes|required|string|max:255',
            'description'  => 'nullable|string',
            'supplier_id'  => 'sometimes|required|integer|exists:suppliers,id',
            'stock'        => 'sometimes|required|integer|min:0',
            'status'       => 'sometimes|required|in:available,out_of_stock',
        ]);

        $product = $this->productService->createProduct($validated);

        return response()->json([
            'message' => 'Product created successfully.',
            'data'    => $product,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data= $this->productService->getProductsById($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = $this->productService->getProductsById($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $validated = $request->validate([
            'name'         => 'sometimes|required|string|max:255',
            'description'  => 'nullable|string',
            'supplier_id'  => 'sometimes|required|integer|exists:suppliers,id',
            'stock'        => 'sometimes|required|integer|min:0',
            'status'       => 'sometimes|required|in:available,out_of_stock',
        ]);

        $updatedProduct = $this->productService->updateProduct($product, $validated);

        return response()->json([
            'message' => 'Product updated successfully.',
            'data'    => $updatedProduct,
        ]);
    }


}
