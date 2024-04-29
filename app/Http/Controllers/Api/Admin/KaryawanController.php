<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\KaryawanResource;
use App\Models\Karyawan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class KaryawanController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $karyawan = Karyawan::latest()->paginate(25);
        return $this->sendResponse(KaryawanResource::collection($karyawan), 'list karyawan berhasil didapat.');
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
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'npp_karyawan' => 'required|unique:karyawan,npp_karyawan|string|size:5',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validator error. ', $validator->errors());
        }
        $karyawan = Karyawan::create(['npp_karyawan' => $input['npp_karyawan']]);
        return $this->sendResponse(new KaryawanResource($karyawan), 'npp karyawan berhasil di simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $karyawan = Karyawan::find($id);
        if (is_null($karyawan)) {
            return $this->sendError('Npp Karyawan tidak ditemukan.');
        }
        return $this->sendResponse(new KaryawanResource($karyawan), 'show npp karyawan berhasil didapat.');
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
    public function update(Request $request, Karyawan $karyawan): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'npp_karyawan' => [
                'required',
                'string',
                'size:5',
                Rule::unique('karyawan')->ignore($karyawan->id)
            ],
            'taken' => 'required|boolean',
            'active' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return $this->sendError('validation error', $validator->errors());
        }
        $karyawan->npp_karyawan = $input['npp_karyawan'];
        $karyawan->taken = $input['taken'];
        $karyawan->active = $input['active'];
        $karyawan->save();
        return $this->sendResponse(new KaryawanResource($karyawan), 'Data Npp Karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = Karyawan::find($id);
        if ($karyawan) {
            $karyawan->delete();
            return $this->sendResponse('npp karyawan berhasil dihapus.', 201);
        }
        return $this->sendError('npp karyawan tidak ditemukan');
    }
}
