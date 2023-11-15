<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Usaha;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DataUsahaController extends Controller
{
    public function index(Request $request)
    {
        //get data tabel usaha
        $dataUsaha = Usaha::select('id_usaha', 'nama_usaha', 'alamat_usaha', 'jenis_usaha', 'produk_usaha')
            ->where('nama_usaha', '!=', 'SEMUA')
            ->get();

        $modelHead = "Tambah Data Usaha";
        $active_page = "DATA USAHA";
        return view('contents.usaha', compact('active_page', 'modelHead', 'dataUsaha'));
    }

    public function simpanData(Request $request)
    {
        // dd($request->all());
        // Validasi data
        $validator = Validator::make(
            $request->all(),
            [
                'nama_usaha' => 'required',
                'alamat_usaha' => 'required',
                'jenis_usaha' => 'required',
                'produk_usaha' => 'required',
            ],
            [
                'nama_usaha.required' => 'Masukan nama usaha',
                'alamat_usaha.required' => 'Masukan alamat usaha',
                'jenis_usaha.required' => 'Masukan jenis usaha',
                'produk_usaha.required' => 'Masukan produk usaha',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Membuat UUID baru
        $idUsaha = Uuid::uuid4();

        $result = Usaha::create([
            'id_usaha' => $idUsaha,
            'nama_usaha' => $request->input('nama_usaha'),
            'alamat_usaha' => $request->input('alamat_usaha'),
            'jenis_usaha' => $request->input('jenis_usaha'),
            'produk_usaha' => $request->input('produk_usaha'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if ($result) {
            return redirect()->to('/data-usaha')->with('success', 'Data Usaha berhasil disimpan.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function editData(Request $request, $id)
    {
        // dd($id_usaha);
        // Validasi inputan jika diperlukan
        // Validate the form data
        $validatedData = $request->validate([
            'nama_usaha_edit' => 'required|string|max:255',
            'alamat_usaha_edit' => 'required|string',
            'jenis_usaha_edit' => 'required|string|max:255',
            'produk_usaha_edit' => 'required|string|max:255',
        ]);

        // Update the record in the database
        $usaha = Usaha::find($id);
        $usaha->update($validatedData);

        // Redirect atau berikan respons sukses kepada pengguna
        return redirect()->route('usaha')->with('success', 'Data usaha berhasil disimpan');
    }

    public function HapusData($id)
    {
        $data = Usaha::findOrFail($id);
        $data->delete();
        // dd($data);
        if ($data) {
            return redirect()->to('/data-usaha')->with('success', 'Data Usaha berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data usaha');
        }
    }
}
