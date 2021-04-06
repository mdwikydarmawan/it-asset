<?php

namespace App\Http\Controllers\Sec;

use App\SecBranch;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Sec\UpdateBranchRequest;


class BranchsController extends Controller
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

        $sec_branch = DB::table('sec_branch')
                            ->select('id',
                                     'branch_name',
                                     'branch_code',
                                     'branch_address',
                                     'branch_telephone',
                                     'branch_ip_telkom',
                                     'branch_ip_lintas',
                                     'branch_indihome_id',
                                     'link_main',
                                     'bw_main',
                                     'link_second',
                                     'bw_second',
                                     'link_inet',
                                     'bw_inet',
                                     'created_at',
                                     'updated_at'
                                    )
                            ->get();

        return view('sec.branch.index',compact('sec_branch'))->with('i', (request()->input('page', 1) - 1) * 5);
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

        return view('sec.branch.create');
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
                        'branch_name' => $request->branch_name, 
                        'branch_code' => $request->branch_code, 
                        'branch_address' => $request->branch_address, 
                        'branch_telephone' => $request->branch_telephone, 
                        'branch_ip_telkom' => $request->branch_ip_telkom, 
                        'branch_ip_lintas' => ($request->branch_ip_lintas ? $request->branch_ip_lintas : ''), 
                        'branch_indihome_id' => ($request->branch_indihome_id ? $request->branch_indihome_id : ''),
                        'link_main' => $request->link_main,
                        'bw_main' => $request->bw_main,
                        'link_second' => ($request->link_second ? $request->link_second : ''),
                        'bw_second' => ($request->bw_second ? $request->bw_second : ''),
                        'link_inet' => ($request->link_inet ? $request->link_inet : ''),
                        'bw_inet' => ($request->bw_inet ? $request->bw_inet : ''),
                        'created_at' => date('Y-m-d H:i:s'), 
                        'updated_at' => date('Y-m-d H:i:s')
                    );
        DB::table('sec_branch')->insert($values);

        return redirect()->route('sec.branch.index')->with('success','Data berhasil disimpan.');

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
        
        $sec_branch = SecBranch::findOrFail($id);

        return view('sec.branch.edit', compact('sec_branch'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_security')) {
            return abort(401);
        }

        DB::table('sec_branch')
                                ->where('id', $id)
                                ->update(array(
                                            'branch_name' => $request->branch_name, 
                                            'branch_code' => $request->branch_code, 
                                            'branch_address' => $request->branch_address, 
                                            'branch_telephone' => $request->branch_telephone, 
                                            'branch_ip_telkom' => $request->branch_ip_telkom, 
                                            'branch_ip_lintas' => ($request->branch_ip_lintas ? $request->branch_ip_lintas : ''), 
                                            'branch_indihome_id' => ($request->branch_indihome_id ? $request->branch_indihome_id : ''), 
                                            'link_main' => $request->link_main,
                                            'bw_main' => $request->bw_main,
                                            'link_second' => ($request->link_second ? $request->link_second : ''),
                                            'bw_second' => ($request->bw_second ? $request->bw_second : ''),
                                            'link_inet' => ($request->link_inet ? $request->link_inet : ''),
                                            'bw_inet' => ($request->bw_inet ? $request->bw_inet : ''),
                                            'updated_at' => date('Y-m-d H:i:s')
                                        ));

        return redirect()->route('sec.branch.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(SecBranch $sec_branch, $id)
    {
        $sec_branch = SecBranch::findOrFail($id);

        return view('sec.branch.show',compact('sec_branch'));

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
        $sec_branch = SecBranch::findOrFail($id);
        $sec_branch->delete();

        return redirect()->route('sec.branch.index')->with('error','Data berhasil dihapus.');
    }

}
