<?php

namespace App\Http\Controllers\BA;

use App\BAPO;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\BA\UpdatePKSRequest;
use Illuminate\Support\Facades\Response;
use ZipArchive;
use File;


class BAPOController extends Controller
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

        $ba_po = DB::table('ba_po')
                                ->select('ba_po.id',
                                        'ba_po.po_no',
                                        'ba_po.po_date',
                                        'ba_po.vendor_id',
                                        'ba_po.pic',
                                        'ba_po.nominal',
                                        'ba_po.isPKS',
                                        'ba_po.po_title',
                                        'ba_po.pks_id',
                                        'ba_po.quotation_no',
                                        'ba_po.isPayment',
                                        'ba_po.payment_date',
                                        'ba_po.requirement',
                                        'param_vendor.id AS vendor_id',
                                        'param_vendor.vendor_name',
                                        'ba_pks.id AS pks_id',
                                        'ba_pks.pks_number',
                                        'ba_pks.pks_name',
                                        'ba_po.isFile',
                                        'ba_po.filename'
                                    )  
                            ->join('param_vendor', 'param_vendor.id', '=', 'ba_po.vendor_id')
                            ->join('ba_pks', 'ba_pks.id', '=', 'ba_po.pks_id', 'left')                            
                            ->get();

        return view('ba.po.index',compact('ba_po'))->with('i', (request()->input('page', 1) - 1) * 5);
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

        $param_status = DB::table('param_status')->select('id', 'status_name')->get();

        /*$ba_pks = DB::table('ba_pks')->select('ba_pks.pks_number', 'ba_pks.id', 'ba_pks.pks_name')->get();*/        

        return view('ba.po.create', compact('param_vendor', 'ba_pks', 'param_status'));
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        /*$data = DB::table('param_pic')->where($select, $value)->get();*/

        $data = DB::table('ba_pks')->where($select, $value)->get();

        $output = '<option value="">--Choose--</option>';

        foreach ($data as $row) {
            $output .= '<option value="'.$row->id.'">'.$row->pks_name.' - '.$row->pks_number.'</option>';
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

        date_default_timezone_set('Asia/Jakarta');   

        /*$this->validate($request, [
            'file' => 'required|mimes: pdf'
        ]);*/    

        $file = $request->file('file');
        
        if($file){
            $name = $request->po_title;
            $filename =  $name. '.' . $file->getClientOriginalExtension();
            $file->move('upload_ba/po/', $filename);
        }else{
            $filename = '';
        }

        if($request->payment_type == "Full Payment"){
        
            $values = array('id' => 0, 
                            'po_title' => $request->po_title,
                            'quotation_no' => $request->quotation_no,
                            'quotation_date' => $request->quotation_date,
                            'po_no' => $request->po_no,
                            'po_date' => $request->po_date,
                            'vendor_id' => $request->vendor_id,
                            'pic' => ($request->pic ? $request->pic : ''),
                            'nominal' => $request->nominal,
                            'isPKS' => $request->isPKS,
                            'pks_id' => ($request->pks_id ? $request->pks_id : ''),
                            'payment_type' => $request->payment_type,
                            'isPayment' => $request->isPayment,
                            'payment_date' => ($request->payment_date ? $request->payment_date : '0000-00-00'),
                            'isPayment1' => '',
                            'isPayment2' => '',
                            'isPayment3' => '',
                            'isPayment4' => '',
                            'isPayment5' => '',
                            'payment_date_1' => '0000-00-00',
                            'payment_date_2' => '0000-00-00',
                            'payment_date_3' => '0000-00-00',
                            'payment_date_4' => '0000-00-00',
                            'payment_date_5' => '0000-00-00',
                            'payment_status' => $request->payment_status,
                            'filename' => $filename,
                            'isFile' => ($file ? '1' : '0'),
                            'requirement' => $request->requirement, 
                            'created_at' => date('Y-m-d H:i:s'), 
                            'updated_at' => date('Y-m-d H:i:s')
                        );

            DB::table('ba_po')->insert($values);

        }else{

            $values = array('id' => 0, 
                            'po_title' => $request->po_title,
                            'quotation_no' => $request->quotation_no,
                            'quotation_date' => $request->quotation_date,
                            'po_no' => $request->po_no,
                            'po_date' => $request->po_date,
                            'vendor_id' => $request->vendor_id,
                            'pic' => ($request->pic ? $request->pic : ''),
                            'nominal' => $request->nominal,
                            'isPKS' => $request->isPKS,
                            'pks_id' => ($request->pks_id ? $request->pks_id : ''),
                            'payment_type' => $request->payment_type,
                            'isPayment' => '',
                            'payment_date' => '0000-00-00',
                            'isPayment1' => $request->isPayment1,
                            'isPayment2' => ($request->isPayment2 ? $request->isPayment2 : ''),
                            'isPayment3' => ($request->isPayment3 ? $request->isPayment3 : ''),
                            'isPayment4' => ($request->isPayment4 ? $request->isPayment4 : ''),
                            'isPayment5' => ($request->isPayment5 ? $request->isPayment5 : ''),
                            'payment_date_1' => ($request->payment_date_1 ? $request->payment_date_1 : '0000-00-00'),
                            'payment_date_2' => ($request->payment_date_2 ? $request->payment_date_2 : '0000-00-00'),
                            'payment_date_3' => ($request->payment_date_3 ? $request->payment_date_3 : '0000-00-00'),
                            'payment_date_4' => ($request->payment_date_4 ? $request->payment_date_4 : '0000-00-00'),
                            'payment_date_5' => ($request->payment_date_5 ? $request->payment_date_5 : '0000-00-00'),
                            'payment_status' => $request->payment_status,
                            'filename' => $filename, 
                            'isFile' => ($file ? '1' : '0'),
                            'requirement' => $request->requirement, 
                            'created_at' => date('Y-m-d H:i:s'), 
                            'updated_at' => date('Y-m-d H:i:s')
                        );

            DB::table('ba_po')->insert($values);

        }

        return redirect()->route('ba.po.index')->with('success','Data berhasil disimpan.');

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
        
        $ba_po = DB::table('ba_po')
                                ->where('ba_po.id', $id)
                                ->select('ba_po.id',
                                        'ba_po.po_no',
                                        'ba_po.po_date',
                                        'ba_po.vendor_id',
                                        'ba_po.pic',
                                        'ba_po.nominal',
                                        'ba_po.isPKS',
                                        'ba_po.po_title',
                                        'ba_po.pks_id',
                                        'ba_po.quotation_no',
                                        'ba_po.quotation_date',
                                        'ba_po.payment_type',
                                        'ba_po.isPayment',
                                        'ba_po.isPayment1',
                                        'ba_po.isPayment2',
                                        'ba_po.isPayment3',
                                        'ba_po.isPayment4',
                                        'ba_po.isPayment5',
                                        'ba_po.payment_date',
                                        'ba_po.payment_date_1',
                                        'ba_po.payment_date_2',
                                        'ba_po.payment_date_3',
                                        'ba_po.payment_date_4',
                                        'ba_po.payment_date_5',
                                        'ba_po.requirement',
                                        'param_vendor.id AS vendor_id',
                                        'param_vendor.vendor_name',
                                        'ba_pks.id AS pks_id',
                                        'ba_pks.pks_number',
                                        'ba_pks.pks_name',
                                        'ba_po.isFile',
                                        'ba_po.filename',
                                        'param_status.id AS status_id',
                                        'param_status.status_name',
                                        'ba_po.payment_status'
                                    )  
                            ->join('param_vendor', 'param_vendor.id', '=', 'ba_po.vendor_id')
                            ->join('param_status', 'param_status.id', '=', 'ba_po.payment_status')
                            ->join('ba_pks', 'ba_pks.id', '=', 'ba_po.pks_id', 'left')                            
                            ->first();

        $param_vendor = DB::table('param_vendor')->select('param_vendor.id', 'param_vendor.vendor_name')->get();

        $param_status = DB::table('param_status')->select('id', 'status_name')->get();

        $ba_pks = DB::table('ba_pks')->select('ba_pks.pks_number', 'ba_pks.id', 'ba_pks.pks_name')->get(); 

        return view('ba.po.edit', compact('ba_po', 'ba_pks', 'param_vendor', 'param_status'));
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

        $ba_po = DB::table('ba_po')->where('id', $id)->select('ba_po.filename')->first();        

        $file = $request->file('file');
        
        if($file){
            $name = $request->po_title;
            $filename =  $name. '.' . $file->getClientOriginalExtension();
            $file->move('upload_ba/po/', $filename);
        }else{
            $filename = $ba_po->filename;
        }
        
        if($request->payment_type == "Full Payment"){
        
            $values = array('po_title' => $request->po_title,
                            'quotation_no' => $request->quotation_no,
                            'quotation_date' => $request->quotation_date,
                            'po_no' => $request->po_no,
                            'po_date' => $request->po_date,
                            'vendor_id' => $request->vendor_id,
                            'pic' => ($request->pic ? $request->pic : ''),
                            'nominal' => $request->nominal,
                            'isPKS' => $request->isPKS,
                            'pks_id' => ($request->pks_id ? $request->pks_id : ''),
                            'payment_type' => $request->payment_type,
                            'isPayment' => $request->isPayment,
                            'payment_date' => ($request->payment_date ? $request->payment_date : '0000-00-00'),
                            'isPayment1' => '',
                            'isPayment2' => '',
                            'isPayment3' => '',
                            'isPayment4' => '',
                            'isPayment5' => '',
                            'payment_date_1' => '0000-00-00',
                            'payment_date_2' => '0000-00-00',
                            'payment_date_3' => '0000-00-00',
                            'payment_date_4' => '0000-00-00',
                            'payment_date_5' => '0000-00-00',
                            'payment_status' => $request->payment_status,
                            'filename' => $filename,
                            'isFile' => ($file ? '1' : '0'),
                            'requirement' => $request->requirement, 
                            'created_at' => date('Y-m-d H:i:s'), 
                            'updated_at' => date('Y-m-d H:i:s')
                        );

            DB::table('ba_po')->where('id', $id)->update($values);

        }else{

            $values = array('po_title' => $request->po_title,
                            'quotation_no' => $request->quotation_no,
                            'quotation_date' => $request->quotation_date,
                            'po_no' => $request->po_no,
                            'po_date' => $request->po_date,
                            'vendor_id' => $request->vendor_id,
                            'pic' => ($request->pic ? $request->pic : ''),
                            'nominal' => $request->nominal,
                            'isPKS' => $request->isPKS,
                            'pks_id' => ($request->pks_id ? $request->pks_id : ''),
                            'payment_type' => $request->payment_type,
                            'isPayment' => '',
                            'payment_date' => '0000-00-00',
                            'isPayment1' => $request->isPayment1,
                            'isPayment2' => ($request->isPayment2 ? $request->isPayment2 : ''),
                            'isPayment3' => ($request->isPayment3 ? $request->isPayment3 : ''),
                            'isPayment4' => ($request->isPayment4 ? $request->isPayment4 : ''),
                            'isPayment5' => ($request->isPayment5 ? $request->isPayment5 : ''),
                            'payment_date_1' => ($request->payment_date_1 ? $request->payment_date_1 : '0000-00-00'),
                            'payment_date_2' => ($request->payment_date_2 ? $request->payment_date_2 : '0000-00-00'),
                            'payment_date_3' => ($request->payment_date_3 ? $request->payment_date_3 : '0000-00-00'),
                            'payment_date_4' => ($request->payment_date_4 ? $request->payment_date_4 : '0000-00-00'),
                            'payment_date_5' => ($request->payment_date_5 ? $request->payment_date_5 : '0000-00-00'),
                            'payment_status' => $request->payment_status,
                            'filename' => $filename, 
                            'isFile' => ($file ? '1' : '0'),
                            'requirement' => $request->requirement, 
                            'created_at' => date('Y-m-d H:i:s'), 
                            'updated_at' => date('Y-m-d H:i:s')
                        );

            DB::table('ba_po')->where('id', $id)->update($values);

        }
        
        return redirect()->route('ba.po.index')->with('success','Data berhasil diperbarui.');
    }

    public function show($id)
    {
        $ba_po = DB::table('ba_po')
                            ->where('ba_po.id', $id)
                            ->select(   'ba_po.id',
                                        'ba_po.po_no',
                                        'ba_po.po_date',
                                        'ba_po.vendor_id',
                                        'ba_po.pic',
                                        'ba_po.nominal',
                                        'ba_po.isPKS',
                                        'ba_po.po_title',
                                        'ba_po.pks_id',
                                        'ba_po.quotation_no',
                                        'ba_po.quotation_date',
                                        'ba_po.payment_type',
                                        'ba_po.isPayment',
                                        'ba_po.isPayment1',
                                        'ba_po.isPayment2',
                                        'ba_po.isPayment3',
                                        'ba_po.isPayment4',
                                        'ba_po.isPayment5',
                                        'ba_po.payment_date',
                                        'ba_po.payment_date_1',
                                        'ba_po.payment_date_2',
                                        'ba_po.payment_date_3',
                                        'ba_po.payment_date_4',
                                        'ba_po.payment_date_5',
                                        'ba_po.requirement',
                                        'param_vendor.id AS vendor_id',
                                        'param_vendor.vendor_name',
                                        'ba_pks.id AS pks_id',
                                        'ba_pks.pks_number',
                                        'ba_pks.pks_name',
                                        'ba_po.isFile',
                                        'ba_po.filename',
                                        'param_status.id AS status_id',
                                        'param_status.status_name',
                                        'ba_po.payment_status'
                                    )  
                            ->join('param_vendor', 'param_vendor.id', '=', 'ba_po.vendor_id')
                            ->join('param_status', 'param_status.id', '=', 'ba_po.payment_status')
                            ->join('ba_pks', 'ba_pks.id', '=', 'ba_po.pks_id', 'left')                            
                            ->first();
        
        $param_vendor = DB::table('param_vendor')->select('param_vendor.id', 'param_vendor.vendor_name')->get();

        $param_status = DB::table('param_status')->select('id', 'status_name')->get();                            

        return view('ba.po.show',compact('ba_po', 'param_vendor', 'param_status'));

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
        $applications = BAPO::findOrFail($id);
        $applications->delete();

        return redirect()->route('ba.po.index')->with('error','Data berhasil dihapus.');
    }

    public function export_po($id) 
    {

        $getData  = DB::table('ba_po')->select('id', 'filename')->where('id', '=', $id)->first();

        $headers = array(
            'Content-Type: application/octet-stream',
        );

        $fileName = $getData->filename;

        $file= public_path().'/upload_ba/po/'.$fileName;

        return Response::download($file, $fileName, $headers);


        /*$zip = new ZipArchive;

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

        return response()->download(public_path().'/upload_ba/pks/'.$fileName); */       

    }

}
