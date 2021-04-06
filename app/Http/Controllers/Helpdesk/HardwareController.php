<?php

namespace App\Http\Controllers\Helpdesk;

use App\HelpdeskHardware;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Helpdesk\UpdateHardwareRequest;
use Illuminate\Support\Facades\Crypt;

class HardwareController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        $helpdesk_hardware =  DB::table('helpdesk_hardware')
                                        ->select(   'helpdesk_hardware.id AS id_detail',
                                                    'helpdesk_hardware.hardware_id',
                                                    'helpdesk_hardware.hardware_total',
                                                    'helpdesk_hardware.hardware_information',
                                                    'param_hardware.id',
                                                    'param_hardware.param_hardware_name',
                                                    'helpdesk_hardware.created_at',
                                                    'helpdesk_hardware.updated_at'
                                                )
                                        ->join('param_hardware', 'param_hardware.id', '=', 'helpdesk_hardware.hardware_id')
                                        ->orderBy('param_hardware.param_hardware_name', 'ASC')
                                        ->get();

        return view('help.hardware.index',compact('helpdesk_hardware'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        $param_hardware =  DB::table('param_hardware')
                                        ->select(   'id',
                                                    'param_hardware_name',
                                                    'param_hardware_information',
                                                    'created_at',
                                                    'updated_at'
                                                )
                                        ->orderBy('param_hardware_name', 'ASC')
                                        ->get();
        
        return view('help.hardware.create', compact('param_hardware'));
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        

        date_default_timezone_set('Asia/Jakarta');        

        $values = array('id' => 0, 
                        'hardware_id' => $request->hardware_id, 
                        'hardware_total' => $request->hardware_total,
                        'hardware_information' => $request->hardware_information,
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('helpdesk_hardware')->insert($values);

        return redirect()->route('helpdesk.hardware.index')->with('success','Data berhasil disimpan.');

    }

    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        $helpdesk_hardware =  DB::table('helpdesk_hardware')
                                        ->where('helpdesk_hardware.id', $id)
                                        ->select(   'helpdesk_hardware.id AS id_detail',
                                                    'helpdesk_hardware.hardware_id',
                                                    'helpdesk_hardware.hardware_total',
                                                    'helpdesk_hardware.hardware_information',
                                                    'param_hardware.id',
                                                    'param_hardware.param_hardware_name',
                                                    'helpdesk_hardware.created_at',
                                                    'helpdesk_hardware.updated_at'
                                                )
                                        ->join('param_hardware', 'param_hardware.id', '=', 'helpdesk_hardware.hardware_id')
                                        ->first();

        $param_hardware =  DB::table('param_hardware')
                                        ->select(   'id',
                                                    'param_hardware_name',
                                                    'param_hardware_information',
                                                    'created_at',
                                                    'updated_at'
                                                )
                                        ->orderBy('param_hardware_name', 'ASC')
                                        ->get();

        return view('help.hardware.edit', compact('helpdesk_hardware', 'param_hardware'));

    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHardwareRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        $values = array('hardware_id' => $request->hardware_id, 
                        'hardware_total' => $request->hardware_total,
                        'hardware_information' => $request->hardware_information,
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('helpdesk_hardware')->where('id', $id)->update($values);

        return redirect()->route('helpdesk.hardware.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(HelpdeskHardware $helpdesk_hardware, $id)
    {        

        $helpdesk_hardware =  DB::table('helpdesk_hardware')
                                        ->where('helpdesk_hardware.id', $id)
                                        ->select(   'helpdesk_hardware.id AS id_detail',
                                                    'helpdesk_hardware.hardware_id',
                                                    'helpdesk_hardware.hardware_total',
                                                    'helpdesk_hardware.hardware_information',
                                                    'param_hardware.id',
                                                    'param_hardware.param_hardware_name',
                                                    'helpdesk_hardware.created_at',
                                                    'helpdesk_hardware.updated_at'
                                                )
                                        ->join('param_hardware', 'param_hardware.id', '=', 'helpdesk_hardware.hardware_id')
                                        ->first(); 

        return view('help.hardware.show',compact('helpdesk_hardware'));

    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }
        $applications = HelpdeskHardware::findOrFail($id);
        $applications->delete();

        return redirect()->route('helpdesk.hardware.index')->with('error','Data berhasil dihapus.');
    }

}
