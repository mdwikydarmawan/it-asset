<?php

namespace App\Http\Controllers\Param;

use App\ParameterPic;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Param\ParameterPicRequest;


class ParameterPicController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        /*$permissions = Permission::all();

        return view('ba.permissions.index', compact('permissions'));*/

        $param_pic = DB::table('param_pic')
                            ->select(   
                                        'param_vendor.vendor_name',
                                        'param_pic.pic_name',
                                        'param_pic.pic_name_2',
                                        'param_pic.id',
                                        'param_pic.pic_telephone',
                                        'param_pic.pic_telephone_2'
                                    )    
                            ->join('param_vendor', 'param_vendor.id', '=', 'param_pic.vendor_id')                                 
                            ->get();

        return view('param.pic.index',compact('param_pic'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        $vendor_list = DB::table('param_vendor')
                           ->select('id','vendor_name')
                           ->orderBy('vendor_name', 'asc')
                           ->get();

        return view('param.pic.create', compact('vendor_list', $vendor_list));
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        /*ParameterPic::create($request->all());*/

        $values = array('id' => 0, 
                        'vendor_id' => $request->vendor_id,
                        'pic_name' => $request->pic_name,
                        'pic_telephone' => $request->pic_telephone,
                        'pic_name_2' => ($request->pic_name_2 ? $request->pic_name_2 : ''),
                        'pic_telephone_2' => ($request->pic_telephone_2 ? $request->pic_telephone_2 : ''),                        
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('param_pic')->insert($values);

        return redirect()->route('param.pic.index')->with('success','Data berhasil disimpan.');

    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }
        
        $param_pic = ParameterPic::findOrFail($id);

        $param_detail = DB::table('param_pic')
                            ->select(   
                                        'param_vendor.vendor_name',
                                        'param_pic.pic_name',
                                        'param_pic.id',
                                        'param_pic.pic_telephone'
                                    )    
                            ->join('param_vendor', 'param_vendor.id', '=', 'param_pic.vendor_id')    
                            ->where('param_pic.id', '=', $id)                             
                            ->get();

        $vendor_list = DB::table('param_vendor')
                           ->select('id','vendor_name')
                           ->orderBy('vendor_name', 'asc')
                           ->get();

        return view('param.pic.edit', compact('param_pic', 'param_detail', 'vendor_list'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParameterPicRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        /*$param_pic = ParameterPic::findOrFail($id);
        $param_pic->update($request->all());*/

        $values = array('id' => 0, 
                        'vendor_id' => $request->vendor_id,
                        'pic_name' => $request->pic_name,
                        'pic_telephone' => $request->pic_telephone,
                        'pic_name_2' => ($request->pic_name_2 ? $request->pic_name_2 : ''),
                        'pic_telephone_2' => ($request->pic_telephone_2 ? $request->pic_telephone_2 : ''),                        
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('param_pic')->where('id', $id)->update($values);

        /*$devApp->update([
                            'application_name' => $devApp->application_name,
                            'application_function' => $devApp->application_function,
                            'dc_location' => $devApp->dc_location,
                            'drc_location' => $devApp->drc_location,
                            'dev_by' => $devApp->dev_by,
                            'platform_os' => $devApp->platform_os,
                            'application_database' => $devApp->application_database,
                            'implementation_year' => $devApp->implementation_year,
                            'source_code' => $devApp->source_code
                        ]);*/

        /*return redirect()->route('dev.applications.index');*/
        return redirect()->route('param.pic.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(ParameterPic $param_pic, $id)
    {
        $param_pic = ParameterPic::findOrFail($id);

        $param_detail = DB::table('param_pic')
                            ->select(   
                                        'param_vendor.vendor_name',
                                        'param_pic.pic_name',
                                        'param_pic.id',
                                        'param_pic.pic_telephone'
                                    )    
                            ->join('param_vendor', 'param_vendor.id', '=', 'param_pic.vendor_id')                                 
                            ->get();

        return view('param.pic.show',compact('param_pic', 'param_detail'));

    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }
        $applications = ParameterPic::findOrFail($id);
        $applications->delete();

        return redirect()->route('param.pic.index')->with('error','Data berhasil dihapus.');
    }

}
