<?php

namespace App\Http\Controllers;

use App\Models\CategoryBarang;
use App\Http\Requests\StoreCategoryBarangRequest;
use App\Http\Requests\UpdateCategoryBarangRequest;

class CategoryBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryBarang = CategoryBarang::latest()->get();

        return view('master.category-barang.index', compact('categoryBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.category-barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryBarangRequest $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255'
        ]);

        CategoryBarang::create($validateData);

        toast()->success('Berhasil', 'Category Barang Berhasil di tambahkan');
        return redirect('/category-barang')->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryBarang $categoryBarang)
    {
        return view('master.category-barang.edit', compact('categoryBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryBarangRequest $request, CategoryBarang $categoryBarang)
    {
        try {
            $rules = [
                'name' => 'required|max:255'
            ];

            $validateData = $request->validate($rules);

            $categoryBarang->update($validateData);

            alert()->success('Berhasil', 'Category Barang Berhasil diubah');
            return redirect('/category-barang')->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryBarang $categoryBarang)
    {
        CategoryBarang::destroy($categoryBarang->id);

        toast()->success('Berhasil', 'Category Barang Berhasil dihapus');
        return redirect('/category-barang')->withInput();
    }
}
