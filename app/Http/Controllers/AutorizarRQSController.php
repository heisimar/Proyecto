<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisicion;
use \Carbon\Carbon;

class AutorizarRQSController extends Controller
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
      $requisiciones = Requisicion::whereIn('rol_rqs',array(2))->get();
      $now = Carbon::now();
      return View('autorizarRQS.index')->with(compact('requisiciones','now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
	 * int id
     */
    public function create(int $id)
    {
		$productos = Producto::all();
		$proveedores = Proveedor::all();
		$requisicion = Requisicion::find($id);
        $acciones = AccionesRequisicion::where('est_ant_rqs_id','=',$requisicion->estadorequisicion->id)->get();
		return $acciones;
		return View('autorizarRQS.create')->with(compact('requisicion'));
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
    }
}
