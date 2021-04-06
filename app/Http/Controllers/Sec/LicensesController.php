<?php

namespace App\Http\Controllers\Sec;

use App\SecLicense;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Sec\UpdateLicenseRequest;
use DateTime;


class LicensesController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        $sec_license = DB::table('sec_license')
                                                ->select('sec_license.id',
                                                         'sec_license.license_name',
                                                         'sec_license.license_expired_date',
                                                         'sec_license.license_information',
                                                         'param_vendor.id AS id_vendor',
                                                         'param_vendor.vendor_name'
                                                        )
                                                ->join('param_vendor', 'param_vendor.id', '=', 'sec_license.vendor_id')
                                                ->get();

        return view('sec.license.index',compact('sec_license'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        $param_vendor = DB::table('param_vendor')
                            ->select(   
                                        'param_vendor.id',
                                        'param_vendor.vendor_name'
                                    )                              
                            ->get();

        return view('sec.license.create', compact('param_vendor'));
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

        if($request->license_expired_date != ''){

            $expired_date = new DateTime($request->license_expired_date);
            $final = $expired_date->modify('-3 months');
            $final = $final->format('Y-m-d');

        }else{

            $final = '0000-00-00';
        }

        $sec_license = DB::table('sec_license')->select(DB::raw('COUNT(id) as jumlah'))->where('license_notification_date', date('Y-m-d'))
                                               ->first();

        for($i = 1; $i <= $sec_license->jumlah; $i++){
            $hasil = DB::table('sec_license')->select('*')->where('license_notification_date', date('Y-m-d'))->get();
        }


        $values = array('id' => 0, 
                        'vendor_id' => $request->vendor_id,
                        'purchase_date' => $request->purchase_date,
                        'renual' => $request->renual,
                        'license_name' => $request->license_name,
                        'license_expired_date' => ($request->license_expired_date ? $request->license_expired_date : '0000-00-00'),
                        'license_notification_date' => $final,  
                        'license_information' => $request->license_information, 
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );
        DB::table('sec_license')->insert($values);

        return redirect()->route('sec.license.index')->with('success','Data berhasil disimpan.');

    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        date_default_timezone_set('Asia/Jakarta');
        
        $sec_license = DB::table('sec_license')
                                                ->where('sec_license.id', $id)
                                                ->select('sec_license.id',
                                                         'sec_license.vendor_id',
                                                         'sec_license.license_name',
                                                         'sec_license.purchase_date',
                                                         'sec_license.renual',
                                                         'sec_license.license_expired_date',
                                                         'sec_license.license_information',
                                                         'param_vendor.id AS id_vendor',
                                                         'param_vendor.vendor_name'
                                                        )
                                                ->join('param_vendor', 'param_vendor.id', '=', 'sec_license.vendor_id')
                                                ->first();

        $param_vendor = DB::table('param_vendor')
                            ->select(   
                                        'param_vendor.id',
                                        'param_vendor.vendor_name'
                                    )                              
                            ->get();

        return view('sec.license.edit', compact('sec_license', 'param_vendor'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLicenseRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        if($request->license_expired_date != '' || $request->license_expired_date != '0000-00-00'){

            $expired_date = new DateTime($request->license_expired_date);
            $final = $expired_date->modify('-3 months');
            $final = $final->format('Y-m-d');

        }else{

            $final = '0000-00-00';
        }

        $sec_license = DB::table('sec_license')->select(DB::raw('COUNT(id) as jumlah'))->where('license_notification_date', date('Y-m-d'))
                                               ->first();

        for($i = 1; $i <= $sec_license->jumlah; $i++){
            $hasil = DB::table('sec_license')->select('*')->where('license_notification_date', date('Y-m-d'))->get();
        }

        DB::table('sec_license')
                                ->where('id', $id)
                                ->update(array(
                                            'vendor_id' => $request->vendor_id,
                                            'purchase_date' => $request->purchase_date,
                                            'renual' => $request->renual,
                                            'license_name' => $request->license_name,
                                            'license_expired_date' => ($request->license_expired_date ? $request->license_expired_date : '0000-00-00'),
                                            'license_notification_date' => $final,  
                                            'license_information' => $request->license_information,
                                            'updated_at' => date('Y-m-d H:i:s')
                                        ));

        return redirect()->route('sec.license.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(SecLicense $sec_license, $id)
    {
        $sec_license = DB::table('sec_license')
                                                ->where('sec_license.id', $id)
                                                ->select('sec_license.id',
                                                         'sec_license.vendor_id',
                                                         'sec_license.license_name',
                                                         'sec_license.purchase_date',
                                                         'sec_license.renual',
                                                         'sec_license.license_expired_date',
                                                         'sec_license.license_information',
                                                         'param_vendor.id AS id_vendor',
                                                         'param_vendor.vendor_name'
                                                        )
                                                ->join('param_vendor', 'param_vendor.id', '=', 'sec_license.vendor_id')
                                                ->first();

        return view('sec.license.show',compact('sec_license'));

    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_security')) {
            return abort(401);
        }
        $sec_branch = SecLicense::findOrFail($id);
        $sec_branch->delete();

        return redirect()->route('sec.license.index')->with('error','Data berhasil dihapus.');
    }

}
