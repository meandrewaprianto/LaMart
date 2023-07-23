<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Kategori;
use Datatables;
use PDF;

class ProdukController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategori = Kategori::all();
        return view('produk.index', compact('kategori'));
    }

    public function listData()
    {
        $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
                        ->orderBy('produk.id_produk', 'desc')
                        ->get();
        $no = 0;
        $data = array();
        foreach($produk as $list) {
            $no++;
            $row = array();
            $row[] = "<input type='checkbox' class='ids' name='id[]' value='".$list->id_produk."'>";
            $row[] = $no;
            $row[] = $list->kode_produk;
            $row[] = $list->nama_produk;
            $row[] = $list->nama_kategori;
            $row[] = $list->merk;
            $row[] = "Rp. ".format_uang($list->harga_beli);
            $row[] = "Rp. ".format_uang($list->harga_jual);
            $row[] = $list->diskon."%";
            $row[] = $list->stok;
            $row[] = "<div class='btn-group'>
                        <a onclick='editForm(".$list->id_produk.")' class='btn btn-info btn-sm'><i class='fas fa-pen'></i></a>
                        &nbsp;&nbsp;
                        <a onclick='deleteData(".$list->id_produk.")' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>";
            $data[] = $row;
        }

        return Datatables::of($data)->escapeColumns([])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $jml = Produk::where('kode_produk', '=', $request['kode'])->count();

        if($jml < 1) {
            $produk = new Produk;
            $produk->kode_produk = $request['kode'];
            $produk->nama_produk = $request['nama'];
            $produk->id_kategori = $request['kategori'];
            $produk->merk        = $request['merk'];
            $produk->harga_beli  = $request['harga_beli'];
            $produk->diskon      = $request['diskon'];
            $produk->harga_jual  = $request['harga_jual'];
            $produk->stok        = $request['stok'];
            $produk->save();
            echo json_encode(array('msg' => 'success'));
        } else {
            echo json_encode(array('msg' => 'error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $produk = Produk::find($id);
        echo json_encode($produk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $produk = Produk::find($id);
        $produk->nama_produk = $request['nama'];
        $produk->id_kategori = $request['kategori'];
        $produk->merk        = $request['merk'];
        $produk->harga_beli  = $request['harga_beli'];
        $produk->diskon      = $request['diskon'];
        $produk->harga_jual  = $request['harga_jual'];
        $produk->stok        = $request['stok'];
        $produk->update();
        echo json_encode(array('msg' => 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $produk = Produk::find($id);
        $produk->delete();
    }

    public function deleteSelected(Request $request) {
        foreach($request['id'] as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }
    }

    public function printBarcode(Request $request) {
        $dataproduk = array();
        foreach($request['id'] as $id) {
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }
        $no = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
