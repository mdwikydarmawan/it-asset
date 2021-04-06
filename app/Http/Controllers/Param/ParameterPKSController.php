<?php

namespace App\Http\Controllers\Param;

use App\ParameterPKS;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Param\ParameterPKSRequest;


class ParameterPKSController extends Controller
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

        $param_pks = DB::table('param_pks')
                            ->select('id',
                                     'pks_type',
                                     'pks_type_information'
                                    )                                     
                            ->get();

        return view('param.pks.index',compact('param_pks'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        return view('param.pks.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        ParameterPKS::create($request->all());

        return redirect()->route('param.pkstype.index')->with('success','Data berhasil disimpan.');

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
        
        $param_pks = ParameterPKS::findOrFail($id);

        return view('param.pks.edit', compact('param_pks'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParameterPKSRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        $param_pks = ParameterPKS::findOrFail($id);
        $param_pks->update($request->all());

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
        return redirect()->route('param.pkstype.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(ParameterPKS $param_pks, $id)
    {
        $param_pks = ParameterPKS::findOrFail($id);

        return view('param.pks.show',compact('param_pks'));

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
        $applications = ParameterPKS::findOrFail($id);
        $applications->delete();

        return redirect()->route('param.pkstype.index')->with('error','Data berhasil dihapus.');
    }

}
