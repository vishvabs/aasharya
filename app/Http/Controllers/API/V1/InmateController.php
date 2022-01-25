<?php

namespace App\Http\Controllers\API\V1;
use App\Http\Requests\InmateRequest;
use Illuminate\Http\Request;
use App\Models\Inmate;
use Illuminate\Support\Facades\DB;


class InmateController extends BaseController
{

    protected $inmate = '';
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Inmate $inmate)
    {
        $this->middleware('auth:api');
    //    $this->middleware('is_admin');
        $this->inmate = $inmate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inmate = $this->inmate->latest()->with('suh', 'district','ulb')->paginate(10);

        return $this->sendResponse($inmate, 'Inmate list');
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
        $inmate = DB::table('inmates')->get()->last()->id;

        return $this->sendResponse($inmate, 'Last Inmate Id');
    }

          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterInmate($suh, $from, $to)

    {
        if($suh == 0 && $from == 0 && $to == 0){
            $inmate = $this->inmate->latest()->with('suh', 'district','ulb')->get();
        }
        
        else if($suh != 0 && $from == 0 && $to ==0) {
            $inmate = $this->inmate->latest()->with('suh', 'district','ulb')->where(array(
                'suh_id' => $suh
            ))->get();
        }

        else if($suh != 0 && $from != 0 && $to !=0) {
            $inmate = $this->inmate->latest()->with('suh', 'district','ulb')->where(array(
                'suh_id' => $suh
            ))->whereBetween('created_at', [$from, $to])->get();
        }
        else if($suh == 0 && $from != 0 && $to !=0) {
            $inmate = $this->inmate->latest()->with('suh', 'district','ulb')->whereBetween('created_at', [$from, $to])->get();
        }
      
        
        
        // $arr = array();
        //  if($suh === 0){
        //     $inmate = $this->inmate->latest()->with('suh', 'district','ulb');
        //  }
        
         
        // $suh = DB::table('suhs')->where(array(
        //     'district_id' => $dis,
        //     'ulb_id' => $ulb))
        //     ->pluck('name', 'id');

        return $this->sendResponse($inmate, 'Filtered Inmate report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InmateRequest $request)
    {

        $inmate = $this->inmate->create([
            'district_id' => $request->get('district_id'),
            'ulb_id' => $request->get('ulb_id'),
            'suh_id' => $request->get('suh_id'),
            'genid' => $request->get('genid'),
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'category' => $request->get('category'),
            'type' => $request->get('type'),
            'age' => $request->get('age'),
            'special_abled' => $request->get('special_abled'),
            'father' => $request->get('father'),
            'mother' => $request->get('mother'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'idistrict' => $request->get('idistrict'),
            'pin' => $request->get('pin'),
            'id_type' => $request->get('id_type'),
            'id_no' => $request->get('id_no'),
            'birthmark' => $request->get('birthmark'),
            'know_person' => $request->get('know_person'),
            'know_mobile' => $request->get('know_mobile'),
            'vaccinated' => $request->get('vaccinated'),
            'desc' => $request->get('desc'),
            'photo' => $request->get('photo'),
            'created_by' => $request->get('created_by'),
        ]);

        

        return $this->sendResponse($inmate, 'Inmate Created Successfully');
    }



          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterInmatesuh($suh)
    {
        $inmate = DB::table('inmates')->where(array(
            'suh_id' => $suh))
            ->pluck('name', 'id');

        return $this->sendResponse($inmate, 'Filtered Inmate Id');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inmate = $this->inmate->with(['suh', 'ulb','district'])->findOrFail($id);

        return $this->sendResponse($inmate, 'Inmate Details');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterbySuh($id)
    {
        $suhid = DB::table('suhs')->where('user_id', $id)->first()->id;
        // $inmate =  DB::table('inmates')->with('suh', 'district','ulb')->where(array(
        //     'suh_id' => $suhid->id))->get();

        $inmate = $this->inmate->latest()->with('suh', 'district','ulb')->where('suh_id', $suhid)->get();

        return $this->sendResponse($inmate, 'Inmate Details of Suh');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterbyId($id)
    {
        $suhid = DB::table('suhs')->where('user_id', $id)->first()->id;
        $inmate = $this->inmate->latest()->with('suh', 'district','ulb')->where('suh_id', $suhid)->get();

        return $this->sendResponse($inmate, 'Inmate Details');
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
    public function update(InmateRequest $request, $id)
    {
        $inmate = $this->inmate->findOrFail($id);

        $inmate->update($request->all());

       
        return $this->sendResponse($inmate, 'Inmate Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            
        $inmate = $this->inmate->findOrFail($id);
        
       
        $inmate->delete();
        
        return $this->sendResponse($inmate, 'Inmate has been Deleted');
    }
}
