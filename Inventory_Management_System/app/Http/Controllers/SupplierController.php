<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Service\SupplierService;

class SupplierController extends Controller
{
    public function __construct(SupplierService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= $this->service->getAllSuppliers();
        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone_number'=> 'required|string',
        ]);

        $supplier = $this->service->createSupplier($validated);

        return response()->json($supplier, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data =$this->service->getSuppliersById($id);
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
        $supplier = $this->service->getSuppliersById($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found.'], 404);
        }

        // Validate input
        $validated = $request->validate([
            'email'        => 'sometimes|required|email|unique:suppliers,email,' . $supplier->id,
            'name'  => 'required|string|max:255',
            'phone_number'=> 'required|string'
        ]);

        // Update via service
        $updatedSupplier = $this->service->updateSupplier($supplier, $validated);

        return response()->json([
            'message' => 'Supplier updated successfully.',
            'data'    => $updatedSupplier,
        ]);
    }

}
