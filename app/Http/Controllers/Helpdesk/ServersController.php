<?php

namespace App\Http\Controllers\Helpdesk;

use App\HelpdeskServer;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Helpdesk\UpdateServersRequest;
use Illuminate\Support\Facades\Crypt;

class ServersController extends Controller
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

        /*$permissions = Permission::all();

        return view('ba.permissions.index', compact('permissions'));*/

        $helpdesk_server =  DB::table('helpdesk_server')
                                        ->select(   'helpdesk_server.id',
                                                    'helpdesk_server.dc_id',
                                                    'helpdesk_server.server_name',
                                                    'helpdesk_server.device_name',
                                                    'helpdesk_server.serial_number',
                                                    'helpdesk_server.server_specification',
                                                    'helpdesk_server.server_ip_address',
                                                    'helpdesk_server.server_username',
                                                    'helpdesk_server.server_password',
                                                    'helpdesk_server.label_name',
                                                    'helpdesk_server.label_information',
                                                    'param_dc.dc_name'
                                                )
                                        ->join('param_dc', 'param_dc.id', '=', 'helpdesk_server.dc_id')
                                        ->orderBy('helpdesk_server.server_name', 'ASC')
                                        ->get();

        return view('help.server.index',compact('helpdesk_server'))->with('i', (request()->input('page', 1) - 1) * 5);
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

        $dc_list = DB::table('param_dc')
                           ->select('param_dc.id','param_dc.dc_name')
                           ->orderBy('param_dc.dc_name', 'asc')
                           ->get();
        
        return view('help.server.create', compact('dc_list'));
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*HelpdeskServer::create($request->all());*/

        date_default_timezone_set('Asia/Jakarta');        

        $values = array('id' => 0, 
                        'dc_id' => $request->dc_id, 
                        'server_name' => $request->server_name, 
                        'server_ip_address' => $request->server_ip_address, 
                        'serial_number' => ($request->serial_number ? $request->serial_number : "") , 
                        'label_name' => $request->label_name, 
                        'label_information' => $request->label_information, 
                        'device_name' => $request->device_name, 
                        'server_username' => ($request->server_username ? $request->server_username : ''),
                        'server_password' => ($request->server_password ? Crypt::encryptString($request->server_password) : ''),                        
                        'server_specification' => $request->server_specification,                     
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );
        DB::table('helpdesk_server')->insert($values);

        return redirect()->route('helpdesk.server.index')->with('success','Data berhasil disimpan.');

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
        
        /*$helpdesk_server = HelpdeskServer::findOrFail($id);*/

        $helpdesk_server = DB::table('helpdesk_server')
                           ->where('id', $id) 
                           ->select('id',
                                    'dc_id',
                                    'server_name',
                                    'server_ip_address',
                                    'serial_number', 
                                    'device_name',
                                    'server_username',
                                    'label_name',
                                    'label_information',
                                    'server_specification')
                           ->first();

        $password = DB::table('helpdesk_server')
                           ->where('id', $id) 
                           ->select('server_password')
                           ->first();

        if($password->server_password != ''){
            $server_password = Crypt::decryptString($password->server_password);
        }else{
            $server_password = $password->server_password;
        }

        $server_detail = DB::table('helpdesk_server')
                           ->select('helpdesk_server.id','helpdesk_server.dc_id', 'param_dc.dc_name')
                           ->join('param_dc', 'param_dc.id', '=', 'helpdesk_server.dc_id')
                           ->where('helpdesk_server.id', '=', $id)
                           ->get();

        $dc_list = DB::table('param_dc')
                           ->select('param_dc.id','param_dc.dc_name')
                           ->orderBy('param_dc.dc_name', 'asc')
                           ->get();        

        return view('help.server.edit', compact('helpdesk_server', 'server_detail', 'dc_list', 'server_password'));

    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServersRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        /*
        $server = HelpdeskServer::findOrFail($id);
        $server->update($dev_dev->all());
        */

        $values = array('dc_id' => $request->dc_id, 
                        'server_name' => $request->server_name, 
                        'server_ip_address' => $request->server_ip_address, 
                        'serial_number' => ($request->serial_number ? $request->serial_number : ""), 
                        'device_name' => $request->device_name, 
                        'label_name' => $request->label_name, 
                        'label_information' => $request->label_information, 
                        'server_username' => ($request->server_username ? $request->server_username : ''),
                        'server_password' => ($request->server_password ? Crypt::encryptString($request->server_password) : ''),                        
                        'server_specification' => $request->server_specification,                     
                        'updated_at' => date('Y-m-d H:i:s')
                    );
        DB::table('helpdesk_server')->where('id', $id)->update($values);

        return redirect()->route('helpdesk.server.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(HelpdeskServer $helpdesk_server, $id)
    {
        /*$helpdesk_server = HelpdeskServer::findOrFail($id);*/

        $helpdesk_server = DB::table('helpdesk_server')
                           ->where('id', $id) 
                           ->select('id',
                                    'dc_id',
                                    'server_name',
                                    'server_ip_address',
                                    'serial_number', 
                                    'device_name',
                                    'server_username',
                                    'label_name',
                                    'label_information',
                                    'server_specification')
                           ->first();

        $password = DB::table('helpdesk_server')
                           ->where('id', $id) 
                           ->select('server_password')
                           ->first();

        if($password->server_password != ''){
            $server_password = Crypt::decryptString($password->server_password);
        }else{
            $server_password = $password->server_password;
        }

        $server_detail = DB::table('helpdesk_server')
                           ->select('helpdesk_server.id','helpdesk_server.dc_id', 'param_dc.dc_name')
                           ->join('param_dc', 'param_dc.id', '=', 'helpdesk_server.dc_id')
                           ->orderBy('helpdesk_server.id', '=', $id)
                           ->get();

        if($helpdesk_server->label_information == "PRODUCTION"){

            $applications_list = DB::table('dev_applications')
                                                   ->where('dev_applications.label_production', $id) 
                                                   ->select('dev_applications.id',
                                                            'dev_applications.application_name',
                                                            'dev_applications.dev_by',
                                                            'dev_applications.implementation_year',
                                                            'param_vendor.vendor_name')
                                                   ->join('param_vendor', 'param_vendor.id', '=', 'dev_applications.dev_by')
                                                   ->orderBy('application_name', 'ASC')
                                                   ->get();

        }elseif($helpdesk_server->label_information == "DEVELOPMENT"){

            $applications_list = DB::table('dev_applications')
                                                   ->where('dev_applications.label_development', $id) 
                                                   ->select('dev_applications.id',
                                                            'dev_applications.application_name',
                                                            'dev_applications.dev_by',
                                                            'dev_applications.implementation_year',
                                                            'param_vendor.vendor_name')
                                                   ->join('param_vendor', 'param_vendor.id', '=', 'dev_applications.dev_by')
                                                   ->orderBy('application_name', 'ASC')
                                                   ->get();

        }else{

            $applications_list = DB::table('dev_applications')
                                                   ->where('dev_applications.label_drc', $id) 
                                                   ->select('dev_applications.id',
                                                            'dev_applications.application_name',
                                                            'dev_applications.dev_by',
                                                            'dev_applications.implementation_year',
                                                            'param_vendor.vendor_name')
                                                   ->join('param_vendor', 'param_vendor.id', '=', 'dev_applications.dev_by')
                                                   ->orderBy('application_name', 'ASC')
                                                   ->get();
                                                   
        }

        return view('help.server.show',compact('helpdesk_server', 'server_detail', 'server_password', 'applications_list'));

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
        $applications = HelpdeskServer::findOrFail($id);
        $applications->delete();

        return redirect()->route('helpdesk.server.index')->with('error','Data berhasil dihapus.');
    }

}
