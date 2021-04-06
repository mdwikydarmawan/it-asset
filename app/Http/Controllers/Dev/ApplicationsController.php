<?php

namespace App\Http\Controllers\Dev;

use App\DevelopmentApplication;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Dev\UpdateApplicationsRequest;


class ApplicationsController extends Controller
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

        $dev_applications = DB::table('dev_applications')
                            ->select('dev_applications.id',
                                     'dev_applications.application_name',
                                     'dev_applications.application_function',
                                     'dev_applications.dev_by',
                                     'dev_applications.application_database',
                                     'dev_applications.implementation_year',
                                     'dev_applications.source_code',
                                     'param_vendor.vendor_name',
                                     'dev_applications.isMaintenance'
                                    )
                            ->join('param_vendor', 'param_vendor.id', '=', 'dev_applications.dev_by')
                            ->orderBy('dev_applications.application_name', 'ASC')
                            ->get();

        return view('dev.applications.index',compact('dev_applications'))->with('i', (request()->input('page', 1) - 1) * 5);
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

        $param_vendor = DB::table('param_vendor')
                            ->select(   
                                        'param_vendor.id',
                                        'param_vendor.vendor_name'
                                    )
                            ->orderBy('param_vendor.vendor_name', 'ASC')
                            ->get();

        $param_dc = DB::table('param_dc')
                            ->select(   
                                        'param_dc.id',
                                        'param_dc.dc_name'
                                    )
                            ->orderBy('param_dc.dc_name', 'ASC')
                            ->get();

        $param_label = DB::table('helpdesk_server')->select('id', 'label_name', 'server_name', 'label_information')
                                                   ->orderBy('label_name', 'ASC')
                                                   ->get();

        return view('dev.applications.create', compact('param_vendor', 'param_dc', 'param_label'));
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        $data = DB::table('param_pic')->where($select, $value)->get();

        $output = '<option value="">--Choose--</option>';

        foreach ($data as $row) {
            $output .= '<option value="'.$row->id.'">'.$row->pic_name.'</option>';
        }

        echo $output;
    }

    public function serverprod(Request $request)
    {
        $employee_id = $request->get('employee_id');

        $data = DB::table('helpdesk_server')->where('helpdesk_server.id', $employee_id)->join('param_dc', 'param_dc.id', '=', 'helpdesk_server.dc_id')->get();

        $dataCount = $data->count();

        if($dataCount > 0){

            $output = '  
              <div class="table-responsive">  
                   <table class="table table-bordered">';  

              foreach ($data as $row) {

                   $output .= '  
                        <tr>  
                             <td width="30%"><label>Data Center Location</label></td>  
                             <td width="70%">'.$row->dc_name.'</td>  
                        </tr>  
                        <tr>  
                             <td width="30%"><label>Data Center Telephone</label></td>  
                             <td width="70%">'.$row->dc_telephone.'</td>  
                        </tr>  
                        <tr>  
                             <td width="30%"><label>Data Center Address</label></td>  
                             <td width="70%">'.$row->dc_address.'</td>  
                        </tr>  
                        <tr>  
                             <td width="30%"><label>Server IP Address</label></td>  
                             <td width="70%">'.$row->server_ip_address.'</td>  
                        </tr> 
                        ';  
              }  
            
            $output .= "</table></div>";

        } else {

            $output = '  
                <div class="table-responsive">  
                   <table class="table table-bordered">  
                        <h4 class="modal-title">No Data :)</h4> 
                    </table>
                </div>'; 

        }

        echo $output; 
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        /*DevelopmentApplication::create($request->all());*/

        $values = array('id' => 0, 
                        'application_name' => $request->application_name, 
                        'application_function' => $request->application_function, 
                        'label_production' => $request->label_production, 
                        'label_drc' => ($request->label_drc ? $request->label_drc : ''), 
                        'label_development' => ($request->label_development ? $request->label_development : ''), 
                        'dev_by' => $request->dev_by, 
                        'pic' => $request->pic,
                        'application_database' => $request->application_database,
                        'source_code' => $request->source_code,
                        'implementation_year' => $request->implementation_year,
                        'isMaintenance' => $request->isMaintenance,                   
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('dev_applications')->insert($values);

        return redirect()->route('dev.applications.index')->with('success','Data berhasil disimpan.');

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
        
        $dev_applications = DevelopmentApplication::findOrFail($id);

        $param_detail = DB::table('dev_applications')
                            ->select(   
                                        'dev_applications.id',
                                        'param_vendor.vendor_name',                                        
                                        'dev_applications.dev_by',                                        
                                        'dev_applications.source_code',
                                        'param_vendor.id as vendor_id',
                                        'dev_applications.pic',
                                        'param_pic.pic_name',
                                        'dev_applications.label_production',
                                        'dev_applications.label_development',
                                        'dev_applications.label_drc',
                                        'dev_applications.source_code',
                                        'dev_applications.isMaintenance',
                                        'prod.label_name AS lprod',
                                        'prod.label_information AS lprod_info',
                                        'dev.label_name AS ldev',
                                        'prod.label_information AS ldev_info',
                                        'drc.label_name AS ldrc',
                                        'prod.label_information AS ldrc_info'
                                    )    
                            ->join('param_vendor', 'param_vendor.id', '=', 'dev_applications.dev_by')    
                            ->join('param_pic', 'param_pic.id', '=', 'dev_applications.pic')
                            ->join('helpdesk_server as prod', 'prod.id', '=', 'dev_applications.label_production')
                            ->join('helpdesk_server as dev', 'dev.id', '=', 'dev_applications.label_development', 'left')
                            ->join('helpdesk_server as drc', 'drc.id', '=', 'dev_applications.label_drc', 'left')                
                            ->where('dev_applications.id', '=', $id)                             
                            ->get();

        $vendor_list = DB::table('param_vendor')
                           ->select('id','vendor_name')
                           ->orderBy('vendor_name', 'asc')
                           ->get();

        $param_dc = DB::table('param_dc')
                            ->select(   
                                        'param_dc.id',
                                        'param_dc.dc_name'
                                    )                              
                            ->get();

        $param_label = DB::table('helpdesk_server')->select('id', 'label_name', 'server_name', 'label_information')
                                                   ->orderBy('label_name', 'ASC')
                                                   ->get();

        return view('dev.applications.edit', compact('dev_applications', 'param_detail', 'vendor_list', 'param_dc', 'param_label'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicationsRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_development')) {
            return abort(401);
        }

        /*$applications = DevelopmentApplication::findOrFail($id);
        $applications->update($devApp->all());*/

        $values = array('application_name' => $request->application_name, 
                        'application_function' => $request->application_function, 
                        'label_production' => $request->label_production, 
                        'label_drc' => ($request->label_drc ? $request->label_drc : ''), 
                        'label_development' => ($request->label_development ? $request->label_development : ''), 
                        'dev_by' => $request->dev_by, 
                        'pic' => $request->pic,
                        'application_database' => $request->application_database,
                        'source_code' => $request->source_code,
                        'implementation_year' => $request->implementation_year,
                        'isMaintenance' => $request->isMaintenance,
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('dev_applications')->where('id', $id)->update($values);

        return redirect()->route('dev.applications.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(DevelopmentApplication $dev_applications, $id)
    {
        $dev_applications = DevelopmentApplication::findOrFail($id);

        $param_detail = DB::table('dev_applications')
                            ->select(   
                                        'dev_applications.id',
                                        'param_vendor.vendor_name',                                        
                                        'dev_applications.dev_by',                                        
                                        'dev_applications.source_code',
                                        'param_vendor.id as vendor_id',
                                        'dev_applications.pic',
                                        'param_pic.pic_name',
                                        'dev_applications.label_production',
                                        'dev_applications.label_development',
                                        'dev_applications.label_drc',
                                        'dev_applications.source_code',
                                        'dev_applications.isMaintenance',
                                        'prod.label_name AS lprod',
                                        'prod.label_information AS lprod_info',
                                        'dev.label_name AS ldev',
                                        'dev.label_information AS ldev_info',
                                        'drc.label_name AS ldrc',
                                        'drc.label_information AS ldrc_info'
                                    )    
                            ->join('param_vendor', 'param_vendor.id', '=', 'dev_applications.dev_by')    
                            ->join('param_pic', 'param_pic.id', '=', 'dev_applications.pic')
                            ->join('helpdesk_server as prod', 'prod.id', '=', 'dev_applications.label_production')
                            ->join('helpdesk_server as dev', 'dev.id', '=', 'dev_applications.label_development', 'left')
                            ->join('helpdesk_server as drc', 'drc.id', '=', 'dev_applications.label_drc', 'left')                
                            ->where('dev_applications.id', '=', $id)                             
                            ->get();

        $vendor_list = DB::table('param_vendor')
                           ->select('id','vendor_name')
                           ->orderBy('vendor_name', 'asc')
                           ->get();

        $param_dc = DB::table('param_dc')
                            ->select(   
                                        'param_dc.id',
                                        'param_dc.dc_name'
                                    )                              
                            ->get();

        $param_label = DB::table('helpdesk_server')->select('id', 'label_name', 'server_name', 'label_information')
                                                   ->orderBy('label_name', 'ASC')
                                                   ->get();


        return view('dev.applications.show',compact('dev_applications', 'param_detail', 'vendor_list', 'param_dc', 'param_label'));

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
        $applications = DevelopmentApplication::findOrFail($id);
        $applications->delete();

        return redirect()->route('dev.applications.index')->with('error','Data berhasil dihapus.');
    }

}
