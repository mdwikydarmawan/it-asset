<?php

namespace App\Http\Controllers\Helpdesk;

use App\HelpdeskRecap;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Helpdesk\UpdateRecapsRequest;
use Illuminate\Support\Facades\Crypt;
use File;
use Illuminate\Support\Facades\Response;

class RecapsController extends Controller
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

        $helpdesk_recap =  DB::table('helpdesk_recap')
                                        ->select(   'helpdesk_recap.id',
                                                    'helpdesk_recap.file_name',
                                                    'helpdesk_recap.periode_start',
                                                    'helpdesk_recap.periode_end',
                                                    'helpdesk_recap.recap_information'
                                                )
                                        ->get();

        return view('help.recap.index',compact('helpdesk_recap'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        
        return view('help.recap.create');
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

        $this->validate($request, [
            'file' => 'required|mimes: xls,xlsx'
        ]);         

        if ($request->file('file')) {
            //UPLOAD FILE
            $file = $request->file('file');
            
            if($file){
                $filename =  'Periode ' . $request->periode_start . ' - ' . $request->periode_end . '.' . $file->getClientOriginalExtension();
                $file->move('upload_helpdesk/recap/', $filename);
            }else{
                return response()->json(['message'=>'Data is failed added']);
            }
            
            $values = array('id' => 0, 
                            'file_name' => $filename, 
                            'periode_start' => $request->periode_start, 
                            'periode_end' => $request->periode_end, 
                            'recap_information' => $request->recap_information,      
                            'created_at' => date('Y-m-d H:i:s'), 
                            'updated_at' => date('Y-m-d H:i:s')
                        );
            DB::table('helpdesk_recap')->insert($values);

        }         

        return redirect()->route('helpdesk.recap.index')->with('success','Data berhasil disimpan.');

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
        
        /*$helpdesk_recap = HelpdeskServer::findOrFail($id);*/

        $helpdesk_recap = DB::table('helpdesk_recap')
                           ->where('id', $id) 
                           ->select('id',
                                    'file_name',
                                    'periode_start',
                                    'periode_end',
                                    'recap_information')
                           ->first();

        return view('help.recap.edit', compact('helpdesk_recap'));

    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecapsRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        /*
        $server = HelpdeskServer::findOrFail($id);
        $server->update($dev_dev->all());
        */

        date_default_timezone_set('Asia/Jakarta');   

        $this->validate($request, [
            'file' => 'required|mimes: xls,xlsx'
        ]);         

        if ($request->file('file')) {
            //UPLOAD FILE
            $file = $request->file('file');
            
            if($file){
                $filename =  'Periode ' . $request->periode_start . ' - ' . $request->periode_end . '.' . $file->getClientOriginalExtension();
                $file->move('upload_helpdesk/recap/', $filename);
            }else{
                return response()->json(['message'=>'Data is failed added']);
            }
            
            $values = array('file_name' => $filename, 
                            'periode_start' => $request->periode_start, 
                            'periode_end' => $request->periode_end, 
                            'recap_information' => $request->recap_information,                                  
                            'updated_at' => date('Y-m-d H:i:s')
                        );
            DB::table('helpdesk_recap')->where('id', $id)->update($values);

        }

        return redirect()->route('helpdesk.recap.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(HelpdeskServer $helpdesk_recap, $id)
    {
        /*$helpdesk_recap = HelpdeskServer::findOrFail($id);*/

        $helpdesk_recap = DB::table('helpdesk_recap')
                           ->where('id', $id) 
                           ->select('id',
                                    'dc_id',
                                    'server_name',
                                    'server_ip_address',
                                    'serial_number', 
                                    'device_name',
                                    'server_username',
                                    'server_specification')
                           ->first();

        $password = DB::table('helpdesk_recap')
                           ->where('id', $id) 
                           ->select('server_password')
                           ->first();

        $server_password = Crypt::decryptString($password->server_password);

        $server_detail = DB::table('helpdesk_recap')
                           ->select('helpdesk_recap.id','helpdesk_recap.dc_id', 'param_dc.dc_name')
                           ->join('param_dc', 'param_dc.id', '=', 'helpdesk_recap.dc_id')
                           ->orderBy('helpdesk_recap.id', '=', $id)
                           ->get();

        return view('help.recap.show',compact('helpdesk_recap', 'server_detail', 'server_password'));

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

        return redirect()->route('helpdesk.recap.index')->with('error','Data berhasil dihapus.');
    }

    public function export($id) 
    {

        $getData  = DB::table('helpdesk_recap')->select('id', 'periode_start', 'periode_end')
                                                            ->where('id', '=', $id)
                                                            ->first();

        $headers = array(
            'Content-Type: application/octet-stream',
        );

        $fileName = 'Periode '.$getData->periode_start.' - '.$getData->periode_end;

        $file= public_path().'/upload_helpdesk/recap/'.$fileName.'.xlsx';
        return Response::download($file, $fileName.'.xlsx', $headers);

        //return response()->download(public_path().'/upload_ltkt/'.$strdate.'/'.$fileName);

    }

}
