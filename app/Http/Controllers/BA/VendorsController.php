<?php

namespace App\Http\Controllers\BA;

use App\DevelopmentVendorNonApp;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\BA\UpdateVendorsRequest;


class VendorsController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba')) {
            return abort(401);
        }

        /*$permissions = Permission::all();

        return view('ba.permissions.index', compact('permissions'));*/

        $param_vendor = DB::table('dev_vendor_non_app')
                            ->select(   'id',
                                        'vendor_name',
                                        'vendor_address',
                                        'vendor_telephone'
                                    )                                     
                            ->get();

        return view('ba.vendors_non_app.index',compact('param_vendor'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba')) {
            return abort(401);
        }
        return view('ba.vendors_non_app.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        DevelopmentVendorNonApp::create($request->all());

        return redirect()->route('ba.vendors_non_app.index')->with('success','Data berhasil disimpan.');

    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba')) {
            return abort(401);
        }
        
        $param_vendor = DevelopmentVendorNonApp::findOrFail($id);

        return view('ba.vendors_non_app.edit', compact('param_vendor'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorsRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba')) {
            return abort(401);
        }

        $param_vendor = DevelopmentVendorNonApp::findOrFail($id);
        $param_vendor->update($request->all());

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
        return redirect()->route('ba.vendors_non_app.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(DevelopmentVendorNonApp $param_vendor, $id)
    {
        $param_vendor = DevelopmentVendorNonApp::findOrFail($id);

        return view('ba.vendors_non_app.show',compact('param_vendor'));

    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba')) {
            return abort(401);
        }
        $applications = DevelopmentVendorNonApp::findOrFail($id);
        $applications->delete();

        return redirect()->route('ba.vendors_non_app.index')->with('error','Data berhasil dihapus.');
    }

}
