<?php

namespace App\Http\Controllers\API\V1;
use App\Http\Requests\AttendanceRequest;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class AttendanceController extends BaseController
{

    protected $attendance = '';
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Attendance $attendance)
    {
        $this->middleware('auth:api');
    //    $this->middleware('is_admin');
        $this->attendance = $attendance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = $this->attendance->latest();

        return $this->sendResponse($attendance, 'attendance list');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $attendance = $this->attendance->pluck('name', 'id');

        return $this->sendResponse($attendance, 'attendance list');
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


    public function filterAttendance($id){
        $suhid = DB::table('suhs')->where('user_id', $id)->first()->id;
        // $inmate =  DB::table('inmates')->with('suh', 'district','ulb')->where(array(
        //     'suh_id' => $suhid->id))->get();

        $attendance = $this->attendance->latest()->with('inmate')->whereRelation('inmate', 'suh_id', '=', $suhid)->get();

        return $this->sendResponse($attendance, 'Attendace Details of Suh');
    }

    public function filterReport($id, $from, $to){

        $suhid = DB::table('suhs')->where('user_id', $id)->first()->id;

        if($id == 0 && $from == 0 && $to == 0){
            
            $attendance = $this->attendance->latest()->with('inmate')->get();
        }
        
        else if($id != 0 && $from == 0 && $to ==0) {

            $attendance = $this->attendance->latest()->with('inmate')->whereRelation('inmate', 'suh_id', '=', $suhid)->get();
        }

        else if($id != 0 && $from != 0 && $to !=0) {
          
            $attendance = $this->attendance->latest()->with('inmate')->whereRelation('inmate', 'suh_id', '=', $suhid)->whereBetween('created_at', [$from, $to])->get();
        }
        else if($id == 0 && $from != 0 && $to !=0) {
            $attendance = $this->attendance->latest()->with('inmate')->whereBetween('created_at', [$from, $to])->get();
        }

        return $this->sendResponse($attendance, 'Filtered Attendance report');


        
        // $inmate =  DB::table('inmates')->with('suh', 'district','ulb')->where(array(
        //     'suh_id' => $suhid->id))->get();

        $attendance = $this->attendance->latest()->with('inmate')->whereRelation('inmate', 'suh_id', '=', $suhid)->get();

        return $this->sendResponse($attendance, 'Attendace Details of Suh');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceRequest $request)
    {

         foreach($request['data'] as $data) {
          //   $attendance = new Attendance();
          //   $attendance->inmate_id = $data['inmate_id'];
          //   $attendance->created_by = $data['created_by'];
          //   $attendance->is_present = $data['is_present'];

             //return $this->sendResponse($data, 'Attendance Created Successfully');
             $attendance = $this->attendance->create([
                 'inmate_id' => $data['inmate_id'],
                 'created_by' => $data['created_by'],
                 'is_present' => $data['is_present'],
             ]);
         }
       // $data = json_decode($request, TRUE);
       

        

    return $this->sendResponse($attendance, 'Attendance Created Successfully');
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
