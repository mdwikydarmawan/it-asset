<?php

namespace App\Http\Controllers\Param;

use App\ParameterDc;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Param\ParameterDcRequest;


class ParameterDcController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_security') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        /*$permissions = Permission::all();

        return view('ba.permissions.index', compact('permissions'));*/

        $param_dc = DB::table('param_dc')
                            ->select(   'id',
                                        'dc_name',
                                        'dc_telephone',
                                        'dc_address'
                                    )                                     
                            ->get();

        return view('param.dc.index',compact('param_dc'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        return view('param.dc.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        ParameterDc::create($request->all());

        return redirect()->route('param.dc.index')->with('success','Data berhasil disimpan.');

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
        
        $param_dc = ParameterDc::findOrFail($id);

        return view('param.dc.edit', compact('param_dc'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParameterDcRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        $param_dc = ParameterDc::findOrFail($id);
        $param_dc->update($request->all());

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
        return redirect()->route('param.dc.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(ParameterDc $param_dc, $id)
    {
        $param_dc = ParameterDc::findOrFail($id);

        return view('param.dc.show',compact('param_dc'));

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
        $applications = ParameterDc::findOrFail($id);
        $applications->delete();

        return redirect()->route('param.dc.index')->with('error','Data berhasil dihapus.');
    }

}
