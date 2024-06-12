<?php

namespace App\Http\Controllers;

use App\BrtEta;
use App\BrtRoutes;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $schedules = Schedule::all();
        return view('home')->with(['schedules' => $schedules]);
    }

    public function review()
    {
        return view('review');
    }

    public function search()
    {
        return view('search');
    }

    public function location($bid)
    {

        $schedule = Schedule::where('location_from', $bid)->orWhere('location_to', $bid)->get();

        return view('location')->with([ 'schedules' => $schedule]);
    }


    public function book($bid)
    {

        $schedule = Schedule::where('id', $bid)->first();
        $departure = BrtRoutes::where('name', $schedule->location_from)->first();
        $arrival = BrtRoutes::where('name',  $schedule->location_to)->first();

        $brtroutes = BrtRoutes::all()->pluck('name','id');


        $eta = BrtEta::where('route_id',$departure->id)->where('dest_id',$arrival->id)->first();



        return view('book')->with(['departure' => $departure,'arrival' => $arrival,'eta' => $eta, 'brtroutes' => $brtroutes]);
    }

    public function track()
    {
        $brtroutes = BrtRoutes::all()->pluck('name','gname');
        return view('track')->with(['brtroutes' => $brtroutes]);
    }

    public function brteta()
    {
        $brtroutes = BrtRoutes::all()->pluck('name','id');
        return view('eta')->with(['brtroutes' => $brtroutes]);
    }

    public function finaleta($id,$dest)
    {
        $departure = BrtRoutes::where('id', $id)->first();
        $arrival = BrtRoutes::where('id',  $dest)->first();

        $eta = BrtEta::where('route_id',$id)->where('dest_id',$dest)->first();

        $brtroutes = DB::table('brt_routes')
            ->select('name')
            ->where('id', '<',  $id)
            ->where('id', '>',  $dest)
            ->get();

        //dd($brtroutes);

        if($brtroutes->isEmpty()){
            $brtroutes = DB::table('brt_routes')
                ->select('name')
                ->where('id', '>',  $id)
                ->where('id', '<',  $dest)
                ->get();
        }

        return view('etabrt')->with(['departure' => $departure,'arrival' => $arrival,'eta' => $eta,'brtroutes' => $brtroutes]);
    }

    public function geteta(Request $request)
    {
        $rules = [
            'departure_terminal' => 'required|integer',
            'destination_terminal' => 'required|integer|different:departure_terminal',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {


            //$eta = BrtEta::where('route_id',$request->departure_terminal)->where('route_id',$request->destination_terminal)->first();
            //$brtroutes = BrtRoutes::whereBetween('route_id', array($request->departure_terminal2, $request->destination_terminal));

            //return view('etabrt')->with(['eta' => $eta,'brtroutes' => $brtroutes]);
            $url = url('/finaleta/'.$request->departure_terminal.'/'.$request->destination_terminal);
            $response = array(
                'success' => true,
                'message' => 'Validation Failed',
                'url' => $url,
                'errors'=>$validator->errors(),
            );
            return response()->json($response);
        }

        $response = array(
            'success' => false,
            'message' => 'Validation Failed',
            'errors'=>$validator->errors(),
        );
        return response()->json($response);
    }

    public function getsearch(Request $request)
    {
        $rules = [
            'search' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {



            $url = url('/search/'.$request->search);
            $response = array(
                'success' => true,
                'message' => 'Validation Failed',
                'url' => $url,
                'errors'=>$validator->errors(),
            );
            return response()->json($response);
        }

        $response = array(
            'success' => false,
            'message' => 'Validation Failed',
            'errors'=>$validator->errors(),
        );
        return response()->json($response);
    }


    public function trackbrt(Request $request)
    {
        $rules = [
            'departure_terminal' => 'required|integer',
            'destination_terminal' => 'required|integer|different:departure_terminal',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {


            //$eta = BrtEta::where('route_id',$request->departure_terminal)->where('route_id',$request->destination_terminal)->first();
            //$brtroutes = BrtRoutes::whereBetween('route_id', array($request->departure_terminal2, $request->destination_terminal));

            //return view('etabrt')->with(['eta' => $eta,'brtroutes' => $brtroutes]);
            $url = url('/finaleta/'.$request->departure_terminal.'/'.$request->destination_terminal);
            $response = array(
                'success' => true,
                'message' => 'Validation Failed',
                'url' => $url,
                'errors'=>$validator->errors(),
            );
            return response()->json($response);
        }

        $response = array(
            'success' => false,
            'message' => 'Validation Failed',
            'errors'=>$validator->errors(),
        );
        return response()->json($response);
    }
}
