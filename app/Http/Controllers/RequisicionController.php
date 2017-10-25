<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequisicionController extends Controller
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
        return View('requisicion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	return View('requisicion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_data = $request->all();
		$rules = [
            'rol_rqs'=> 'required',
			'asn_rqs'=> 'required',
			'jst_rqs'=> 'required',
			'tip_sol'=> 'required',
			'apr_com'=> 'required',
			'fec_apr_com'=> 'required',
			'prv_apr'=> 'required',
			'nom_rcp_rqs'=> 'required',
			'crg_rcp_rqs'=> 'required',
			'fec_rcp_rqs'=> 'required',
			'obs_rcp_rqs'=> 'required',
			'est_rqs'=> 'required'
			];
        $validate = Validator::make($post_data, $rules);
        if (!$validate->failed()){
			$requisicion = Requisicion::create($post_data);	 		
		}
		$requisicions = Requisicion::all();
		return view('requisicion.index')->with('requisicions', $requisicions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requisicions= Requisicion::find($requisicion);
		return view('requisicion.show')->with('requisicions', $requisicions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisicions = Requisicion::find($requisicion);
		return view('requisicion.edit')->with('requisicions', $requisicions);
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
        $post_data = $request->all();
		$rules = [
            'rol_rqs'=> 'required',
			'asn_rqs'=> 'required',
			'jst_rqs'=> 'required',
			'tip_sol'=> 'required',
			'apr_com'=> 'required',
			'fec_apr_com'=> 'required',
			'prv_apr'=> 'required',
			'nom_rcp_rqs'=> 'required',
			'crg_rcp_rqs'=> 'required',
			'fec_rcp_rqs'=> 'required',
			'obs_rcp_rqs'=> 'required',
			'est_rqs'=> 'required'
			];
        $validate = Validator::make($post_data, $rules);
        if (!$validate->failed()) {
            $requisicions = Requisicion::find($post_data['id']);
            $requisicions->rol_rqs = $post_data['rol_rqs'];
			$requisicions->asn_rqs = $post_data['asn_rqs'];
			$requisicions->jst_rqs = $post_data['jst_rqs'];
			$requisicions->tip_sol = $post_data['tip_sol'];
			$requisicions->apr_com = $post_data['apr_com'];
			$requisicions->fec_apr_com = $post_data['fec_apr_com'];
			$requisicions->prv_apr = $post_data['prv_apr'];
			$requisicions->nom_rcp_rqs = $post_data['nom_rcp_rqs'];
			$requisicions->crg_rcp_rqs = $post_data['crg_rcp_rqs'];
			$requisicions->fec_rcp_rqs = $post_data['fec_rcp_rqs'];
			$requisicions->obs_rcp_rqs = $post_data['obs_rcp_rqs'];
			$requisicions->est_rqs = $post_data['est_rqs'];
			return view('requisicion.show')->with('requisicions', $requisicions);
        }
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
