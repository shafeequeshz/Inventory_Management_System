<?php

namespace App\Service; 
use App\Models\Supplier;

class SupplierService 
{

    public function createSupplier(array $data)
    {
        return Supplier::create($data);
    }


    /**
     * Get all Suppliers.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllSuppliers()
    {
        return Supplier::all();
    }
    
    public function getSuppliersById($id)
    {
        return Supplier::find($id);
    }
    public function updateSupplier(Supplier $supplier, array $data)
    {
        $supplier->update($data);
        return $supplier;
    }
}