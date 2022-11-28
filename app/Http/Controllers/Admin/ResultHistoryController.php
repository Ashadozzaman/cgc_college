<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResultHistory;
use App\Models\Section;

class ResultHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['result_histories'] = ResultHistory::get();
        return view('admin.result-history.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['sections'] = Section::where('certificate_id',1)->where('id','<>',4)->get();
        return view('admin.result-history.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $validated = $request->validate([
            'section_id' => 'required|max:255',
            'session_id' => 'required',
            'total_seat' => 'required',
            'total_enrolled' => 'required',
            'total_appeared' => 'required',
            'pass' => 'required',
        ]);
        $total_seat = $request->total_seat;
        $total_enrolled = $request->total_enrolled;
        $total_appeared = $request->total_appeared;
        $pass = $request->pass;

        $ap = $request->ap;
        $a = $request->a;
        $am = $request->am;
        $b = $request->b;
        $c = $request->c;
        $d = $request->d;
        $fail = $request->fail;
        $absent = $request->absent;
        
        $total = $ap + $a + $am + $b + $c + $d + $fail + $absent;
        $resulthistory = ResultHistory::where('section_id',$request->section_id)->where('session_id',$request->session_id)->first();

        if($total_seat < $total_enrolled || $total_seat < $total_appeared || $total_seat < $pass || $total_enrolled < $total_appeared || $total_enrolled < $pass ||  $total_appeared < $pass || $total != $total_appeared){
            return back()->with('error','Sorry something wrong, Please check properly...!!');
        }else if(!empty($resulthistory)){
            return back()->with('error','Sorry this session and section is already created...!!');
        }
        // dd($data);
        ResultHistory::create($data);
        return redirect()->route('result_history.index')->with('success','Result history create Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['sections'] = Section::where('certificate_id',1)->where('id','<>',4)->get();
        $data['result_history'] = ResultHistory::findOrFail($id);
        return view('admin.result-history.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result_history = ResultHistory::findOrFail($id);
        $data = $request->except('_token');
        $validated = $request->validate([
            'section_id' => 'required|max:255',
            'session_id' => 'required',
            'total_seat' => 'required',
            'total_enrolled' => 'required',
            'total_appeared' => 'required',
            'pass' => 'required',
        ]);
        
        $resulthistory = ResultHistory::where('section_id',$request->section_id)->where('session_id',$request->session_id)->where('id','<>',$id)->first(); 

        if (!empty($resulthistory)) {
            return back()->with('error','Result history already created...!!');
        }
        $total_seat = $request->total_seat;
        $total_enrolled = $request->total_enrolled;
        $total_appeared = $request->total_appeared;
        $pass = $request->pass;

        $ap = $request->ap;
        $a = $request->a;
        $am = $request->am;
        $b = $request->b;
        $c = $request->c;
        $d = $request->d;
        $fail = $request->fail;
        $absent = $request->absent;
        
        $total = $ap + $a + $am + $b + $c + $d + $fail + $absent;
        if($total_seat < $total_enrolled || $total_seat < $total_appeared || $total_seat < $pass || $total_enrolled < $total_appeared || $total_enrolled < $pass ||  $total_appeared < $pass || $total != $total_appeared){
            return back()->with('error','Sorry something wrong, Please check properly...!!');
        }
        $result_history->update($data);
        return redirect()->route('result_history.index')->with('success','Result history update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $routine = ResultHistory::findOrFail($id);
        ResultHistory::destroy($id);
        return redirect()->route('result_history.index')->with('success','Result history delete Successfully!!');
    }
}
