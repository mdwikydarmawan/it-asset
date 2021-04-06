<?php

namespace App\Http\Controllers\Dev;

use App\DevelopmentApplicationEnhancement;
use App\DevelopmentApplication;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Dev\UpdateApplicationsEnhancementsRequest;


class AppEnhancementsController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_development')) {
            return abort(401);
        }

        /*$permissions = Permission::all();

        return view('ba.permissions.index', compact('permissions'));*/

        $dev_applications_enhacement =  DB::table('dev_applications_enhancement')
                                        ->select(   'dev_applications_enhancement.id',
                                                    'dev_applications_enhancement.application_id',
                                                    'dev_applications_enhancement.live_date',
                                                    'dev_applications_enhancement.submit_date',
                                                    'dev_applications_enhancement.application_information',
                                                    'dev_applications_enhancement.title',
                                                    'dev_applications_enhancement.cr_number',
                                                    'dev_applications_enhancement.pic',
                                                    'dev_applications.application_name',
                                                    'param_pic.pic_name'
                                                )
                                        ->join('dev_applications', 'dev_applications_enhancement.application_id', '=', 'dev_applications.id' )
                                        ->join('param_pic', 'dev_applications_enhancement.pic', '=', 'param_pic.id')
                                        ->get();

        return view('dev.applications_enhancement.index',compact('dev_applications_enhacement'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_development')) {
            return abort(401);
        }

        $dev_applications = DB::table('dev_applications')
                           ->select('dev_applications.id','dev_applications.application_name', 'dev_applications.dev_by', 'param_vendor.vendor_name')
                           ->join('param_vendor', 'dev_applications.dev_by', '=', 'param_vendor.id')
                           ->orderBy('application_name', 'asc')
                           ->get();

        $pic = DB::table('param_pic')
                           ->select('param_pic.id','param_pic.pic_name', 'param_pic.pic_telephone', 'param_pic.vendor_id', 'param_vendor.vendor_name')
                           ->join('param_vendor', 'param_pic.vendor_id', '=', 'param_vendor.id')
                           ->orderBy('param_pic.pic_name', 'asc')
                           ->get();
        //DevelopmentApplication::all(['id','application_name', 'dev_by']);
        return view('dev.applications_enhancement.create', compact('dev_applications', 'pic'));
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        /*DevelopmentApplicationEnhancement::create($request->all());*/

        $values = array('id' => 0, 
                        'title' => $request->title, 
                        'cr_number' => $request->cr_number, 
                        'application_id' => $request->application_id, 
                        'request_date' => $request->request_date, 
                        'submit_date' => ($request->submit_date ? $request->submit_date : '0000-00-00'), 
                        'live_date' => ($request->live_date ? $request->live_date : '0000-00-00'), 
                        'user_owner' => $request->user_owner,
                        'pic' => $request->pic,       
                        'application_information' => $request->application_information,       
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('dev_applications_enhancement')->insert($values);

        return redirect()->route('dev.applications_enhancement.index')->with('success','Data berhasil disimpan.');

    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_development')) {
            return abort(401);
        }
        
        $dev_applications_enhacement = DevelopmentApplicationEnhancement::findOrFail($id);

        $dev_applications = DB::table('dev_applications')
                           ->select('dev_applications.id','dev_applications.application_name', 'dev_applications.dev_by', 'param_vendor.vendor_name')
                           ->join('param_vendor', 'dev_applications.dev_by', '=', 'param_vendor.id')
                           ->orderBy('application_name', 'asc')
                           ->get();

        $pic = DB::table('param_pic')
                           ->select('param_pic.id','param_pic.pic_name', 'param_pic.pic_telephone',  'param_pic.vendor_id', 'param_vendor.vendor_name')
                           ->join('param_vendor', 'param_pic.vendor_id', '=', 'param_vendor.id')
                           ->orderBy('param_pic.pic_name', 'asc')
                           ->get();

        $pic_data = DB::table('dev_applications_enhancement')
                           ->where('dev_applications_enhancement.id', $id) 
                           ->select('param_pic.pic_name', 'param_vendor.vendor_name', 'dev_applications_enhancement.pic')
                           ->join('param_pic', 'param_pic.id', '=', 'dev_applications_enhancement.pic')
                           ->join('param_vendor', 'param_vendor.id', '=', 'param_pic.vendor_id')                           
                           ->first();

        return view('dev.applications_enhancement.edit', compact('dev_applications_enhacement', 'dev_applications', 'pic', 'pic_data'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicationsEnhancementsRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_development')) {
            return abort(401);
        }

        /*$applications = DevelopmentApplicationEnhancement::findOrFail($id);
        $applications->update($dev_applications_enhacement->all());*/

        $values = array('title' => $request->title, 
                        'cr_number' => $request->cr_number, 
                        'application_id' => $request->application_id, 
                        'request_date' => $request->request_date, 
                        'submit_date' => ($request->submit_date ? $request->submit_date : '0000-00-00'), 
                        'live_date' => ($request->live_date ? $request->live_date : '0000-00-00'), 
                        'user_owner' => $request->user_owner,
                        'pic' => $request->pic,       
                        'application_information' => $request->application_information,       
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('dev_applications_enhancement')->where('id', $id)->update($values);

        return redirect()->route('dev.applications_enhancement.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(DevelopmentApplicationEnhancement $dev_applications_enhacement, $id)
    {
        $dev_applications_enhacement = DevelopmentApplicationEnhancement::findOrFail($id);

        $detail_application =   DB::table('dev_applications_enhancement')
                                        ->select('dev_applications_enhancement.id','dev_applications_enhancement.application_id', 'dev_applications.application_name', 'param_vendor.vendor_name')
                                        ->join('dev_applications', 'dev_applications_enhancement.application_id', '=', 'dev_applications.id')
                                        ->join('param_vendor', 'dev_applications.dev_by', '=', 'param_vendor.id')
                                        ->where('dev_applications_enhancement.id', '=', $id)
                                        ->get();

        /*$detail_pic = DB::table('dev_applications_enhancement')
                                ->select('dev_applications_enhancement.id','dev_applications_enhancement.pic', 'param_pic.pic_name', 'param_vendor.vendor_name')
                                ->join('param_pic', 'dev_applications_enhancement.pic', '=', 'param_pic.id')
                                ->join('param_vendor', 'param_pic.vendor_id', '=', 'param_vendor.id')
                                ->where('dev_applications_enhancement.id', '=', $id)
                                ->get();*/

        $detail_pic = DB::table('dev_applications_enhancement')
                           ->where('dev_applications_enhancement.id', $id) 
                           ->select('param_pic.pic_name', 'param_vendor.vendor_name', 'dev_applications_enhancement.pic')
                           ->join('param_pic', 'param_pic.id', '=', 'dev_applications_enhancement.pic')
                           ->join('param_vendor', 'param_vendor.id', '=', 'param_pic.vendor_id')                           
                           ->get();

        return view('dev.applications_enhancement.show',compact('dev_applications_enhacement', 'detail_application', 'detail_pic'));

    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_development')) {
            return abort(401);
        }
        $applications = DevelopmentApplicationEnhancement::findOrFail($id);
        $applications->delete();

        return redirect()->route('dev.applications_enhancement.index')->with('error','Data berhasil dihapus.');
    }

}
