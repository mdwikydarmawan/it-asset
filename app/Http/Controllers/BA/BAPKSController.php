<?php

namespace App\Http\Controllers\BA;

use App\BAPKS;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\BA\UpdatePKSRequest;
use Illuminate\Support\Facades\Response;
use ZipArchive;
use File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PKSExport;


class BAPKSController extends Controller
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

        $ba_pks = DB::table('ba_pks')
                            ->select(   'ba_pks.id',
                                        'ba_pks.vendor_id',
                                        'ba_pks.pks_type_id',
                                        'ba_pks.pks_name',
                                        'ba_pks.pks_number',
                                        'ba_pks.pks_date',
                                        'ba_pks.pks_date_start',
                                        'ba_pks.pks_date_end',
                                        'ba_pks.fee',
                                        'ba_pks.status',
                                        'ba_pks.isHardCopy',
                                        'param_vendor.id AS vendor_id',
                                        'param_vendor.vendor_name',
                                        'param_pks.id AS pks_id',
                                        'param_pks.pks_type',
                                        'param_status.id AS status_id',
                                        'param_status.status_name',
                                        'ba_pks.isFile'
                                    )  
                            ->join('param_vendor', 'param_vendor.id', '=', 'ba_pks.vendor_id')
                            ->join('param_pks', 'param_pks.id', '=', 'ba_pks.pks_type_id')
                            ->join('param_status', 'param_status.id', '=', 'ba_pks.status')
                            ->get();

        return view('ba.pks.index',compact('ba_pks'))->with('i', (request()->input('page', 1) - 1) * 5);
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

        $param_vendor = DB::table('param_vendor')->select('param_vendor.id', 'param_vendor.vendor_name')->get();

        $param_pks = DB::table('param_pks')->select('param_pks.pks_type', 'param_pks.id')->get();

        $param_status = DB::table('param_status')->select('param_status.status_name', 'param_status.id')->get();

        return view('ba.pks.create', compact('param_vendor', 'param_pks', 'param_status'));
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        /*BAPKS::create($request->all());*/

        date_default_timezone_set('Asia/Jakarta');

        /*$this->validate($request, [
            'file' => 'required|mimes: pdf'
        ]);*/    

        $file = $request->file('file');
        $file2 = $request->file('file2');
        $file3 = $request->file('file3');
        $file4 = $request->file('file4');

        $folderName = $request->pks_number;
        $folderName = str_replace( "/", "",$folderName);

        if(!file_exists('upload_ba/pks/'.$folderName)){
            mkdir('upload_ba/pks/'.$folderName, 0777, true);
        }
        
        if($file){
            $name = $request->pks_name;
            $name = str_replace( "/", "",$name);
            $filename =  $name.' - 1' . '.' . $file->getClientOriginalExtension();
            $file->move('upload_ba/pks/'.$folderName.'/', $filename);
        }else{
            $filename = '';
        }

        if($file2){
            $name = $request->pks_name;
            $name = str_replace( "/", "",$name);
            $filename2 =  $name.' - 2' . '.' . $file2->getClientOriginalExtension();
            $file2->move('upload_ba/pks/'.$folderName.'/', $filename2);
        }else{
            $filename2 = '';
        }

        if($file3){
            $name = $request->pks_name;
            $name = str_replace( "/", "",$name);
            $filename3 =  $name.' - 3' . '.' . $file3->getClientOriginalExtension();
            $file3->move('upload_ba/pks/'.$folderName.'/', $filename3);
        }else{
            $filename3 = '';
        }

        if($file4){
            $name = $request->pks_name;
            $name = str_replace( "/", "",$name);
            $filename4 =  $name.' - 4' . '.' . $file4->getClientOriginalExtension();
            $file4->move('upload_ba/pks/'.$folderName.'/', $filename4);
        }else{
            $filename4 = '';
        }
        
        $values = array('id' => 0, 
                        'vendor_id' => $request->vendor_id,
                        'pks_type_id' => $request->pks_type_id,
                        'pks_name' => $request->pks_name,
                        'pks_number' => $request->pks_number,
                        'pks_date' => $request->pks_date,
                        'pks_date_start' => $request->pks_date_start,
                        'pks_date_end' => $request->pks_date_end,
                        'fee' => $request->fee,
                        'status' => $request->status,
                        'isHardCopy' => $request->isHardCopy,
                        'filename' => $filename, 
                        'filename2' => $filename2, 
                        'filename3' => $filename3, 
                        'filename4' => $filename4, 
                        'isFile' => ($file ? '1' : '0'),
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('ba_pks')->insert($values);

        return redirect()->route('ba.pks.index')->with('success','Data berhasil disimpan.');

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
        
        $ba_pks = DB::table('ba_pks')
                            ->where('ba_pks.id', $id)
                            ->select(   'ba_pks.id',
                                        'ba_pks.vendor_id',
                                        'ba_pks.pks_type_id',
                                        'ba_pks.pks_name',
                                        'ba_pks.pks_number',
                                        'ba_pks.pks_date',
                                        'ba_pks.pks_date_start',
                                        'ba_pks.pks_date_end',
                                        'ba_pks.fee',
                                        'ba_pks.status',
                                        'ba_pks.isHardCopy',
                                        'param_vendor.id AS vendor_id',
                                        'param_vendor.vendor_name',
                                        'param_pks.id AS pks_id',
                                        'param_pks.pks_type',
                                        'param_status.id AS status_id',
                                        'param_status.status_name',
                                        'ba_pks.isFile'
                                    )  
                            ->join('param_vendor', 'param_vendor.id', '=', 'ba_pks.vendor_id')
                            ->join('param_pks', 'param_pks.id', '=', 'ba_pks.pks_type_id')
                            ->join('param_status', 'param_status.id', '=', 'ba_pks.status')
                            ->first();

        $param_vendor = DB::table('param_vendor')->select('param_vendor.id', 'param_vendor.vendor_name')->get();

        $param_pks = DB::table('param_pks')->select('param_pks.pks_type', 'param_pks.id')->get();

        $param_status = DB::table('param_status')->select('param_status.status_name', 'param_status.id')->get();

        return view('ba.pks.edit', compact('ba_pks', 'param_pks', 'param_status', 'param_vendor'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePKSRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba')) {
            return abort(401);
        }

        /*$ba_pks = BAPKS::findOrFail($id);
        $ba_pks->update($request->all());*/

        /*BAPKS::create($request->all());*/

        date_default_timezone_set('Asia/Jakarta');   

        /*$this->validate($request, [
            'file' => 'required|mimes: pdf'
        ]);*/    

        $ba_pks = DB::table('ba_pks')
                            ->where('id', $id)
                            ->select(   'ba_pks.filename',
                                        'ba_pks.filename2',
                                        'ba_pks.filename3',
                                        'ba_pks.filename4'
                                    )  
                            ->first();

        $file = $request->file('file');
        $file2 = $request->file('file2');
        $file3 = $request->file('file3');
        $file4 = $request->file('file4');

        $folderName = $request->pks_number;
        $folderName = str_replace( "/", "",$folderName);

        if(!file_exists('upload_ba/pks/'.$folderName)){
            mkdir('upload_ba/pks/'.$folderName, 0777, true);
        }
        
        if($file){
            $name = $request->pks_name;
            $name = str_replace( "/", "",$name);
            $filename =  $name.' - 1' . '.' . $file->getClientOriginalExtension();
            $file->move('upload_ba/pks/'.$folderName.'/', $filename);
        }else{
            $filename = $ba_pks->filename;
        }

        if($file2){
            $name = $request->pks_name;
            $name = str_replace( "/", "",$name);
            $filename2 =  $name.' - 2' . '.' . $file2->getClientOriginalExtension();
            $file2->move('upload_ba/pks/'.$folderName.'/', $filename2);
        }else{
            $filename2 = $ba_pks->filename2;
        }

        if($file3){
            $name = $request->pks_name;
            $name = str_replace( "/", "",$name);
            $filename3 =  $name.' - 3' . '.' . $file3->getClientOriginalExtension();
            $file3->move('upload_ba/pks/'.$folderName.'/', $filename3);
        }else{
            $filename3 = $ba_pks->filename3;
        }

        if($file4){
            $name = $request->pks_name;
            $name = str_replace( "/", "",$name);
            $filename4 =  $name.' - 4' . '.' . $file4->getClientOriginalExtension();
            $file4->move('upload_ba/pks/'.$folderName.'/', $filename4);
        }else{
            $filename4 = $ba_pks->filename4;
        }
        
        $values = array('vendor_id' => $request->vendor_id,
                        'pks_type_id' => $request->pks_type_id,
                        'pks_name' => $request->pks_name,
                        'pks_number' => $request->pks_number,
                        'pks_date' => $request->pks_date,
                        'pks_date_start' => $request->pks_date_start,
                        'pks_date_end' => $request->pks_date_end,
                        'fee' => $request->fee,
                        'status' => $request->status,
                        'isHardCopy' => $request->isHardCopy,
                        'filename' => $filename, 
                        'filename2' => $filename2, 
                        'filename3' => $filename3, 
                        'filename4' => $filename4, 
                        'isFile' => ($file ? '1' : '0'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

        DB::table('ba_pks')->where('id', $id)->update($values);

        
        return redirect()->route('ba.pks.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(BAPKS $ba_pks, $id)
    {
        $ba_pks = DB::table('ba_pks')
                            ->where('ba_pks.id', $id)
                            ->select(   'ba_pks.id',
                                        'ba_pks.vendor_id',
                                        'ba_pks.pks_type_id',
                                        'ba_pks.pks_name',
                                        'ba_pks.pks_number',
                                        'ba_pks.pks_date',
                                        'ba_pks.pks_date_start',
                                        'ba_pks.pks_date_end',
                                        'ba_pks.fee',
                                        'ba_pks.status',
                                        'ba_pks.isHardCopy',
                                        'param_vendor.id AS vendor_id',
                                        'param_vendor.vendor_name',
                                        'param_pks.id AS pks_id',
                                        'param_pks.pks_type',
                                        'param_status.id AS status_id',
                                        'param_status.status_name',
                                        'ba_pks.isFile'
                                    )  
                            ->join('param_vendor', 'param_vendor.id', '=', 'ba_pks.vendor_id')
                            ->join('param_pks', 'param_pks.id', '=', 'ba_pks.pks_type_id')
                            ->join('param_status', 'param_status.id', '=', 'ba_pks.status')
                            ->first();

        return view('ba.pks.show',compact('ba_pks'));

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
        $applications = BAPKS::findOrFail($id);
        $applications->delete();

        return redirect()->route('ba.pks.index')->with('error','Data berhasil dihapus.');
    }

    public function export($id) 
    {

        $getData  = DB::table('ba_pks')->select('id', 'pks_number', 'pks_name')->where('id', '=', $id)->first();

        $headers = array(
            'Content-Type: application/octet-stream',
        );

        /*$fileName = $getData->filename;

        $file= public_path().'/upload_ba/pks/'.$fileName;

        return Response::download($file, $fileName, $headers);*/


        $zip = new ZipArchive;

        $name = $getData->pks_number;
        $name = str_replace( "/", "",$name);

        $title = $getData->pks_name;

        $fileName = $title.'.zip';

        if($zip->open(public_path().'/upload_ba/pks/'.$fileName, ZipArchive::CREATE) === TRUE){

            $files = File::files(public_path().'/upload_ba/pks/'.$name);

            foreach ($files as $key => $value) {

                $relativeNameInZipFile = basename($value);

                $zip->addFile($value, $relativeNameInZipFile);

            }

            $zip->close();

        }

        return response()->download(public_path().'/upload_ba/pks/'.$fileName);        

    }

    public function report()
    {
        return Excel::download(new PKSExport, 'PKSReport.xlsx');
    }
}
