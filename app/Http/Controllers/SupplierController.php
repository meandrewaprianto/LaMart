<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('supplier.index');
    }

    public function listData()
    {
        $supplier = Supplier::orderBy('id_supplier', 'desc')->get();
        
        $no = 0;
        $data = array();
        foreach($supplier as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nama;
            $row[] = $list->alamat;
            $row[] = $list->telpon;
            $row[] = "<div class='btn-group'>
                         <a onclick='editForm(".$list->id_supplier.")' class='btn btn-info btn-sm'><i class='fas fa-pen'></i></a>
                         &nbsp;&nbsp;
                         <a onclick='deleteData(".$list->id_supplier.")' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>
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
        $supplier = new Supplier;
        $supplier->nama = $request['nama'];
        $supplier->alamat = $request['alamat'];
        $supplier->telpon = $request['telpon'];
        $supplier->save();
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
        $supplier = Supplier::find($id);
        echo json_encode($supplier);

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
        $supplier = Supplier::find($id);
        $supplier->nama = $request['nama'];
        $supplier->alamat = $request['alamat'];
        $supplier->telpon = $request['telpon'];
        $supplier->update();
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
        $supplier = Supplier::find($id);
        $supplier->delete();
    }
}
