<?php

namespace App\Http\Controllers\API\V1;
use App\Http\Requests\SuhRequest;
use Illuminate\Http\Request;
use App\Models\Suh;
use Illuminate\Support\Facades\DB;

class SuhController extends BaseController
{

    protected $suh = '';
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Suh $suh)
    {
        $this->middleware('auth:api');
    //    $this->middleware('is_admin');
        $this->suh = $suh;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suh = $this->suh->latest()->with('user', 'district','ulb')->paginate(10);

        return $this->sendResponse($suh, 'Suh list');
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastId()
    {
        $suh = DB::table('suhs')->get()->last()->id;

        return $this->sendResponse($suh, 'Last SUH Id');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuhRequest $request)
    {
        $suh = $this->suh->create([
            'user_id' => $request->get('user_id'),
            'district_id' => $request->get('district_id'),
            'ulb_id' => $request->get('ulb_id'),
            'genid' => $request->get('genid'),
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'status' => $request->get('status'),
            'created_id' => $request->get('created_id'),
            'updated_id' => $request->get('updated_id'),
            'suh_status' => $request->get('suh_status'),
            'capacity' => $request->get('capacity'),
            'geo' => $request->get('geo'),
            'is_cctv' => $request->get('is_cctv'),
            'is_water' => $request->get('is_water'),
            'is_iso' => $request->get('is_iso'),
            'hygiene' => $request->get('hygiene'),
            'is_food' => $request->get('is_food'),
            'is_vaccination' => $request->get('is_vaccination'),
            'sma_name' => $request->get('sma_name'),
            'sma_payment' => $request->get('sma_payment'),
            'created_date' => $request->get('created_date'),
            'sma_date' => $request->get('sma_date'),
        ]);

        return $this->sendResponse($suh, 'SUH Created Successfully');
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
