<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use Validator;
use App\Http\Resources\UnitResource;

class UnitController extends BaseController
{

    function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $unit = Unit::paginate(10);
        return $this->sendResponse(UnitResource::collection($unit), 'list unit berhasil didapat');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_unit' => 'required|max:20|min:3|unique:unit,nama_unit',
        ]);
        if($validator->fails()){
            return $this->sendError('Validator error. ', $validator->errors());
        }
        $unit = Unit::create($input);
        return $this->sendResponse(new UnitResource($unit), 'unit berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unit = Unit::find($id);
        if(is_null($unit)){
            return $this->sendError('unit tidak ditemukan.');
        }
        return $this->sendResponse(new UnitResource($unit), 'unit ditemukan.');
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
    public function update(Request $request, Unit $unit) : JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_unit' => 'required|max:50|min:3',
        ]);
        if($validator->fails()){
            return $this->sendError('Validator error. ', $validator->errors());
        }
        $unit->nama_unit = $input['nama_unit'];
        $unit->save();
        return $this->sendResponse(new UnitResource($unit), 'unit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::find($id);
        if($unit){
            $unit->delete();
            return $this->sendResponse('unit berhasil dihapus.', 201);
        }
        return $this->sendError('unit tidak ditemukan.');
    }
}
