<?php

namespace App\Http\Controllers\GuidanceDoc;

use App\GuidanceDoc;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\GuidanceDoc\UpdateGuidanceDocRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Response;

class GuidanceDocController extends Controller
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

        $guidanceDoc =  DB::table('guidance_document')
                                        ->select(   'id',
                                                    'doc_name',
                                                    'doc_function',
                                                    'filename',
                                                    'doc_date',
                                                    'uploaded_by'
                                                )
                                        ->orderBy('doc_name', 'ASC')
                                        ->get();

        return view('guidancedoc.guidancedoc.index',compact('guidanceDoc'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        
        return view('guidancedoc.guidancedoc.create');
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
                $file->move('upload_doc/', $filename);
            }else{
                return response()->json(['message'=>'Data is failed added']);
            }
            
            $values = array('id' => 0, 
                            'filename' => $filename, 
                            'doc_name' => $request->doc_name, 
                            'doc_function' => $request->doc_function, 
                            'doc_date' => date('Y-m-d H:i:s'),
                            'uploaded_by' => Auth::user()->name, 
                            'created_at' => date('Y-m-d H:i:s'), 
                            'updated_at' => date('Y-m-d H:i:s')
                        );
            DB::table('guidance_document')->insert($values);

        }         

        return redirect()->route('guidancedoc.guidancedoc.index')->with('success','Data berhasil disimpan.');

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

        $guidanceDoc =  DB::table('guidance_document')
                                        ->where('id', $id)
                                        ->select(   'id',
                                                    'doc_name',
                                                    'doc_function',
                                                    'filename',
                                                    'doc_date'
                                                )
                                        ->first();

        return view('guidancedoc.guidancedoc.edit', compact('guidanceDoc'));

    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGuidanceDocRequest $request, $id)
    {
        if (! Gate::allows('users_manage') && ! Gate::allows('users_ba') && ! Gate::allows('users_development') && ! Gate::allows('users_security') && ! Gate::allows('users_helpdesk')) {
            return abort(401);
        }

        date_default_timezone_set('Asia/Jakarta');   

        /*$this->validate($request, [
            'file' => 'required|mimes: xls,xlsx'
        ]);   */      

        if ($request->file('file')) {
            //UPLOAD FILE
            $file = $request->file('file');
            
            if($file){
                $filename =  $request->file('file')->getClientOriginalName();
                $file->move('upload_doc/', $filename);
            }else{
                return response()->json(['message'=>'Data is failed added']);
            }
            
            $values = array('filename' => $filename, 
                            'doc_name' => $request->doc_name, 
                            'doc_function' => $request->doc_function,  
                            'uploaded_by' => Auth::user()->name,                            
                            'updated_at' => date('Y-m-d H:i:s')
                        );
            DB::table('guidance_document')->where('id', $id)->update($values);

        }

        return redirect()->route('guidancedoc.guidancedoc.index')->with('success','Data berhasil diperbarui.');
    }

    public function show(GuidanceDoc $guidanceDoc, $id)
    {

        $guidanceDoc =  DB::table('guidance_document')
                                        ->where('id', $id)
                                        ->select(   'id',
                                                    'doc_name',
                                                    'doc_function',
                                                    'filename',
                                                    'doc_date'
                                                )
                                        ->first();

        return view('guidancedoc.guidancedoc.show',compact('guidanceDoc'));

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

        $getData  = DB::table('guidance_document')->select('id', 'filename')->where('id', '=', $id)->first();
        
        $file_path = public_path("upload_doc/".$getData->filename);
        if(File::exists($file_path)) File::delete($file_path);

        $applications = GuidanceDoc::findOrFail($id);
        $applications->delete();        

        return redirect()->route('guidancedoc.guidancedoc.index')->with('error','Data berhasil dihapus.');
    }

    public function export($id) 
    {

        $getData  = DB::table('guidance_document')->select('id', 'filename')->where('id', '=', $id)->first();

        $headers = array(
            'Content-Type: application/octet-stream',
        );

        $fileName = $getData->filename;

        $file= public_path().'/upload_doc/'.$getData->filename;
        return Response::download($file, $fileName, $headers);

        //return response()->download(public_path().'/upload_ltkt/'.$strdate.'/'.$fileName);

    }

}
