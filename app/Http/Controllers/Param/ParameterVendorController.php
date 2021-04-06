<?php

namespace App\Http\Controllers\Param;

use App\ParameterVendor;
use App\ParameterPIC;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Param\ParameterVendorRequest;


class ParameterVendorController extends Controller
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

        $param_vendor = DB::table('param_vendor')
                            ->select(   'id',
                                        'vendor_name',
                                        'vendor_address',
                                        'vendor_telephone'
                                    )                                     
                            ->get();

        return view('param.vendor.index',compact('param_vendor'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        return view('param.vendor.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        if(isset($_POST['btnVendor'])){
            ParameterVendor::create($request->all());
            return redirect()->route('param.vendor.index')->with('success','Data berhasil disimpan.');
        }

        if(isset($_POST['btnPIC'])){
            ParameterPIC::create($request->all());
            return redirect()->route('param.vendor.show', $request->vendor_id)->with('success','Data berhasil disimpan.');
        }        

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
        
        $param_vendor = ParameterVendor::findOrFail($id);

        return view('param.vendor.edit', compact('param_vendor'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParameterVendorRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        if(isset($_POST['btnEditVendor'])){
            $param_vendor = ParameterVendor::findOrFail($id);
            $param_vendor->update($request->all());
            return redirect()->route('param.vendor.index')->with('success','Data berhasil diperbarui.');
        }

        if(isset($_POST['btnEditPIC'])){
            $param_pic = ParameterPIC::findOrFail($id);
            $param_pic->update($request->all());
            return redirect()->route('param.vendor.show', $request->vendor_id)->with('success','Data berhasil diperbarui.');
        }

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
    }

    public function show(ParameterVendor $param_vendor, $id)
    {
        $param_vendor = ParameterVendor::findOrFail($id);

        $param_pic = DB::table('param_pic')
                            ->where('param_pic.vendor_id', $id)
                            ->select(   
                                        'param_vendor.vendor_name',
                                        'param_pic.pic_name',
                                        'param_pic.id',
                                        'param_pic.pic_telephone',
                                        'param_pic.vendor_id'
                                    )    
                            ->join('param_vendor', 'param_vendor.id', '=', 'param_pic.vendor_id')                             
                            ->get();

        return view('param.vendor.show',compact('param_vendor', 'param_pic'));

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

        $applications = ParameterVendor::findOrFail($id);
        $applications->delete();

        return redirect()->route('param.vendor.index')->with('error','Data berhasil dihapus.');        
    }

    public function destroy_pic($id, $pic_id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        $applications = ParameterPIC::findOrFail($pic_id);
        $applications->delete();        

        return redirect()->route('param.vendor.show', $id)->with('error','Data berhasil dihapus.');
        
    }

    public function pic($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }
        
        return view('param.vendor.create_pic', compact('id', $id));
    }

    public function edit_pic($id, $pic_id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }
        
        $param_pic = ParameterPIC::findOrFail($pic_id);

        return view('param.vendor.edit_pic', compact('param_pic'));
    }

    public function detail_pic($id, $pic_id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }
        
        $param_pic = ParameterPIC::findOrFail($pic_id);

        return view('param.vendor.detail_pic', compact('param_pic'));
    }

}
