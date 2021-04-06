<?php

namespace App\Http\Controllers\Param;

use App\ParameterHardware;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Param\ParameterHardwareRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HardwareImport;

class ParameterHardwareController extends Controller
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

        $param_hardware = DB::table('param_hardware')
                            ->select(   'id',
                                        'param_hardware_asset_code',
                                        'param_hardware_name',
                                        'param_hardware_information'
                                    )                                     
                            ->get();

        return view('param.hardwares.index',compact('param_hardware'))->with('i', (request()->input('page', 1) - 1) * 5);
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

        return view('param.hardwares.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        ParameterHardware::create($request->all());
        return redirect()->route('param.hardwares.index')->with('success','Data berhasil disimpan.');

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
        
        $param_hardware = ParameterHardware::findOrFail($id);

        return view('param.hardwares.edit', compact('param_hardware'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParameterHardwareRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_helpdesk') && ! Gate::allows('users_security')) {
            return abort(401);
        }      

        $param_hardware = ParameterHardware::findOrFail($id);
        $param_hardware->update($request->all());
        return redirect()->route('param.hardwares.index')->with('success','Data berhasil diperbarui.');        
    }

    public function show(ParameterHardware $param_hardware, $id)
    {
        $param_hardware = ParameterHardware::findOrFail($id);

        return view('param.hardwares.show',compact('param_hardware', 'param_pic'));

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

        $applications = ParameterHardware::findOrFail($id);
        $applications->delete();

        return redirect()->route('param.hardwares.index')->with('error','Data berhasil dihapus.');        
    }

    public function import_excel(Request $request) 
    {
        // validasi
        /*$this->validate($request, [
            'file' => 'required|mimes: xls,xlsx'
        ]);*/

        Excel::import(new HardwareImport,request()->file('file'));

        return redirect()->route('param.hardwares.index')->with('success','Data berhasil di-upload.');
    }

}
