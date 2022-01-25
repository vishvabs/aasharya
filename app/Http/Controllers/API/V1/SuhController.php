<?php

namespace App\Http\Controllers\API\V1;
use App\Http\Requests\SuhRequest;
use Illuminate\Http\Request;
use App\Models\Suh;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function list()
    {
        $suh = $this->suh->pluck('name', 'id');

        return $this->sendResponse($suh, 'Suh list');
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterSuh($dis, $ulb)
    {
        $suh = DB::table('suhs')->where(array(
            'district_id' => $dis,
            'ulb_id' => $ulb))
            ->pluck('name', 'id');

        return $this->sendResponse($suh, 'Filtered SUH Id');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuhRequest $request)
    {

        $user = DB::table('users')->insert(
            array('user_id' => $request->get('username'),
                  'is_admin' => 0,
                  'status' => $request->get('status'),
                  'createdby_id' => $request->get('created_id'),
                  'password' => Hash::make($request->get('password')),
                  'created_at' => now(),
                  'updated_at' => now(),)
        );

        $lastid = DB::table('users')->get()->last()->id;

        $suh = $this->suh->create([
            'user_id' => $lastid,
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


    public function filterby($dis,$ulb, $from, $to)

    {
        if($dis == 0 && $ulb == 0 &&$from == 0 && $to == 0){
            $suh = $this->suh->with('district','ulb')->get();
        }
        
        else if($dis != 0 && $ulb != 0 && $from == 0 && $to ==0) {
            $suh = $this->suh->with('district','ulb')->where(array(
                'district_id' => $dis,
                'ulb_id' => $ulb,
            ))->get();
        }

        else if($dis != 0 && $ulb != 0 && $from != 0 && $to != 0) {
            $suh = $this->suh->with('district','ulb')->where(array(
                'district_id' => $dis,
                'ulb_id' => $ulb
            ))->whereBetween('created_at', [$from, $to])->get();
        }
        else if($dis == 0 && $ulb == 0 && $from != 0 && $to !=0) {
            $suh = $this->suh->with('district','ulb')->whereBetween('created_at', [$from, $to])->get();
        }
      
        return $this->sendResponse($suh, 'Filtered Suh report');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suh = $this->suh->with(['user', 'ulb','district'])->findOrFail($id);

        return $this->sendResponse($suh, 'Suh Details');
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

    public function editData($id)
    {

        $suhid = DB::table('suhs')->where('user_id', $id)->first()->id;
        $suh = $this->suh->with(['user', 'ulb','district'])->findOrFail($suhid);

        return $this->sendResponse($suh, 'Suh Details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuhRequest $request, $id)
    {
        $suh = $this->suh->findOrFail($id);

        $suh->update($request->all());

        DB::table('users')->where('id', $request->get('user_id'))->update(
            array('user_id' => $request->get('username'),
                  'status' => $request->get('status'),
                  'password' => Hash::make($request->get('password')),
                  'updated_at' => now(),));  
        return $this->sendResponse($suh, 'Suh Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $suh = $this->suh->findOrFail($id);
        
        $user =  DB::table('users')->where('id', $suh->user_id);
        $user->delete();
        $suh->delete();
        
        return $this->sendResponse($suh, 'Suh has been Deleted');
    }
}
