<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\PembelianDetail;
use App\Models\Produk;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier = Supplier::all();
        return view('pembelian.index', compact('supplier'));
    }

    public function listData() {
        
        $pembelian = Pembelian::leftJoin('supplier', 'supplier.id_supplier', '=', 'pembelian.id_supplier')
                     ->orderBy('pembelian.id_pembelian', 'desc')
                     ->get();
        
        $no = 0;
        $data = array();
 
        foreach($pembelian as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            // $row[] = tanggal_indonesia(substr($list->created_at, 0, 10), false); //
            $row[] = $list->nama;
            $row[] = $list->total_item;
            $row[] = "Rp. ".format_uang($list->total_harga);
            $row[] = $list->diskon."%";
            $row[] = "Rp. ".format_uang($list->bayar);
            $row[] = "<div class='btn-group'>
                        <a onclick='showDetail(".$list->id_pembelian.")' class='btn btn-info btn-sm'><i class='fas fa-eye'></i></a>
                        &nbsp;&nbsp;
                        <a onclick='deleteData(".$list->id_pembelian.")' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>
                     </div>";
            $data[] = $row;
        }
        $output = array("data" => $data);
        return response()->json($output);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        // echo date('w');exit();
        $pembelian = new Pembelian;
        $pembelian->id_supplier = $id;
        $pembelian->total_item = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon = 0;
        $pembelian->bayar = 0;
        $pembelian->save();

        session(['idpembelian' => $pembelian->id_pembelian]);
        session(['idsupplier' => $id]);

        return \Redirect::route('pembelian_detail.index');
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
        $pembelian = Pembelian::find($request['idpembelian']);

        if(empty($pembelian)){
            $request->session()->forget('idpembelian');
            $request->session()->forget('idsupplier');
            return \Redirect::route('pembelian.index');
        };

        $pembelian->total_item = $request['totalitem'];
        $pembelian->total_harga = $request['total'];
        $pembelian->diskon = $request['diskon'];
        $pembelian->bayar = $request['bayar'];
        $pembelian->update();

        $detail = PembelianDetail::where('id_pembelian', '=', $request['idpembelian'])->get();

        foreach($detail as $data) {
            $produk = Produk::where('kode_produk', '=', $data->kode_produk)->first();
            $produk->stok += $data->jumlah;
            $produk->update();
        }
        return \Redirect::route('pembelian.index');
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
        $detail = PembelianDetail::leftJoin('produk', 'produk.kode_produk', '=', 'pembelian_detail.kode_produk')
                                 ->where('id_pembelian', '=', $id)
                                 ->get();
        $no = 0;
        $data = array();
        foreach($detail as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->kode_produk;
            $row[] = $list->nama_produk;
            $row[] = "Rp. ".format_uang($list->harga_beli);
            $row[] = $list->jumlah;
            $row[] = "Rp. ".format_uang($list->harga_beli * $list->jumlah);
            $data[] = $row;
        }

        $output = array("data" => $data);
        return response()->json($output);
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
        $pembelian = Pembelian::find($id);
        $pembelian->delete();

        $detail = PembelianDetail::where('id_pembelian', '=', $id)->get();
        foreach($detail as $data) {
            $produk = Produk::where('kode_produk', '=', $data->kode_produk)->first();
            $produk->stok -= $data->jumlah;
            $produk->update();
            $data->delete();
        }
    }
}
