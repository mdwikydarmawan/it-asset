<?php

namespace App\Http\Controllers\OtherBilling;

use App\OtherBilling;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\OtherBilling\UpdateOtherBillingRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Response;

class OtherBillingController extends Controller
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

        $otherBilling =  DB::table('other_billing_payment')
                                        ->select(   'other_billing_payment.id',
                                                    'other_billing_payment.bill_title',
                                                    'other_billing_payment.bill_no',
                                                    'other_billing_payment.bill_date',
                                                    'other_billing_payment.vendor_id',
                                                    'other_billing_payment.nominal',
                                                    'other_billing_payment.information',
                                                    'other_billing_payment.created_by',
                                                    'other_billing_payment.isFile',
                                                    'other_billing_payment.isGA',
                                                    'other_billing_payment.filename',
                                                    'param_vendor.vendor_name'
                                                )
                                        ->join('param_vendor', 'param_vendor.id', '=', 'other_billing_payment.vendor_id')
                                        ->orderBy('bill_title', 'ASC')
                                        ->get();

        return view('billpayment.billpayment.index',compact('otherBilling'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_security') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        $param_vendor = DB::table('param_vendor')
                                        ->select(   'param_vendor.id',
                                                    'param_vendor.vendor_name'
                                                )                                        
                                        ->orderBy('param_vendor.vendor_name', 'ASC')
                                        ->get();
        
        return view('billpayment.billpayment.create', compact('param_vendor'));
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
            'file' => 'required|mimes: xls,xlsx'
        ]);*/         

        if ($request->file('file')) {
            //UPLOAD FILE
            $file = $request->file('file');
            
            if($file){
                $filename =  $request->file('file')->getClientOriginalName();
                $file->move('upload_billpayment/', $filename);
            }else{
                $filename =  '';
            }

            $values = array('id' => 0, 
                        'isFile' => ($file ? '1' : '0'),
                        'filename' => $filename, 
                        'bill_title' => $request->bill_title, 
                        'bill_no' => $request->bill_no, 
                        'bill_date' => $request->bill_date,
                        'vendor_id' => $request->vendor_id,
                        'nominal' => $request->nominal,
                        'information' => $request->information,
                        'created_by' => Auth::user()->name, 
                        'isGA' => $request->isGA, 
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );

            DB::table('other_billing_payment')->insert($values);

        }else{

            $values = array('id' => 0, 
                        'isFile' => '0',
                        'filename' => '', 
                        'bill_title' => $request->bill_title, 
                        'bill_no' => $request->bill_no, 
                        'bill_date' => $request->bill_date,
                        'vendor_id' => $request->vendor_id,
                        'nominal' => $request->nominal,
                        'information' => $request->information,
                        'created_by' => Auth::user()->name, 
                        'isGA' => $request->isGA, 
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );

            DB::table('other_billing_payment')->insert($values);
            
        }

        return redirect()->route('billpayment.billpayment.index')->with('success','Data berhasil disimpan.');
        

    }

    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_security') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }        

        $otherBilling =  DB::table('other_billing_payment')
                                        ->where('other_billing_payment.id', $id)
                                        ->select(   'other_billing_payment.id',
                                                    'other_billing_payment.bill_title',
                                                    'other_billing_payment.bill_no',
                                                    'other_billing_payment.bill_date',
                                                    'other_billing_payment.vendor_id',
                                                    'other_billing_payment.nominal',
                                                    'other_billing_payment.information',
                                                    'other_billing_payment.created_by',
                                                    'other_billing_payment.isFile',
                                                    'other_billing_payment.isGA',
                                                    'other_billing_payment.filename',
                                                    'param_vendor.vendor_name',
                                                    'other_billing_payment.created_at'
                                                )
                                        ->join('param_vendor', 'param_vendor.id', '=', 'other_billing_payment.vendor_id')
                                        ->orderBy('bill_title', 'ASC')
                                        ->first();

        $param_vendor = DB::table('param_vendor')
                                        ->select(   'param_vendor.id',
                                                    'param_vendor.vendor_name'
                                                )                                        
                                        ->orderBy('param_vendor.vendor_name', 'ASC')
                                        ->get();

        return view('billpayment.billpayment.edit', compact('otherBilling', 'param_vendor'));

    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOtherBillingRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_security') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        date_default_timezone_set('Asia/Jakarta');   

        /*$this->validate($request, [
            'file' => 'required|mimes: xls,xlsx'
        ]);   */      

        $originalFilename = DB::table('other_billing_payment')->select('filename')->where('id', $id)->first();

        if ($request->file('file')) {
            //UPLOAD FILE
            $file = $request->file('file');
            
            if($file){
                $filename =  $request->file('file')->getClientOriginalName();
                $file->move('upload_billpayment/', $filename);
            }else{
                $filename = $originalFilename->filename;
            }

            $values = array(
                            'isFile' => ($file ? '1' : '0'),
                            'filename' => $filename, 
                            'bill_title' => $request->bill_title, 
                            'bill_no' => $request->bill_no, 
                            'bill_date' => $request->bill_date,
                            'vendor_id' => $request->vendor_id,
                            'nominal' => $request->nominal,
                            'information' => $request->information,
                            'isGA' => $request->isGA, 
                            'created_by' => Auth::user()->name, 
                            'updated_at' => date('Y-m-d H:i:s')
                        );

        }else{

            $file = $request->file('file');
            
            if($file){
                $filename =  $request->file('file')->getClientOriginalName();
                $file->move('upload_billpayment/', $filename);
            }else{
                $filename = $originalFilename->filename;
            }

            $values = array(
                            'isFile' => ($file ? '1' : '0'),
                            'filename' => $filename, 
                            'bill_title' => $request->bill_title, 
                            'bill_no' => $request->bill_no, 
                            'bill_date' => $request->bill_date,
                            'vendor_id' => $request->vendor_id,
                            'nominal' => $request->nominal,
                            'information' => $request->information,
                            'isGA' => $request->isGA, 
                            'created_by' => Auth::user()->name, 
                            'updated_at' => date('Y-m-d H:i:s')
                        );

        }

        DB::table('other_billing_payment')->where('id', $id)->update($values);

        

        return redirect()->route('billpayment.billpayment.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(OtherBilling $otherBilling, $id)
    {

        $otherBilling =  DB::table('other_billing_payment')
                                        ->where('other_billing_payment.id', $id)
                                        ->select(   'other_billing_payment.id',
                                                    'other_billing_payment.bill_title',
                                                    'other_billing_payment.bill_no',
                                                    'other_billing_payment.bill_date',
                                                    'other_billing_payment.vendor_id',
                                                    'other_billing_payment.nominal',
                                                    'other_billing_payment.information',
                                                    'other_billing_payment.created_by',
                                                    'other_billing_payment.isFile',
                                                    'other_billing_payment.isGA',
                                                    'other_billing_payment.filename',
                                                    'param_vendor.vendor_name',
                                                    'other_billing_payment.created_at'
                                                )
                                        ->join('param_vendor', 'param_vendor.id', '=', 'other_billing_payment.vendor_id')
                                        ->orderBy('bill_title', 'ASC')
                                        ->first();

        return view('billpayment.billpayment.show',compact('otherBilling'));

    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_security') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        $originalFilename = DB::table('other_billing_payment')->select('filename')->where('id', $id)->first();
        
        $file_path = public_path("upload_billpayment/".$originalFilename->filename);
        if(File::exists($file_path)) File::delete($file_path);

        $applications = OtherBilling::findOrFail($id);
        $applications->delete();        

        return redirect()->route('billpayment.billpayment.index')->with('error','Data berhasil dihapus.');
    }

    public function export($id) 
    {

        $originalFilename = DB::table('other_billing_payment')->select('filename')->where('id', $id)->first();

        $headers = array(
            'Content-Type: application/octet-stream',
        );

        $fileName = $originalFilename->filename;

        $file= public_path().'/upload_billpayment/'.$originalFilename->filename;
        return Response::download($file, $fileName, $headers);

        //return response()->download(public_path().'/upload_ltkt/'.$strdate.'/'.$fileName);

    }

}
