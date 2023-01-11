<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\DataTables\QuestionDatatable;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('role')=='user'){
            $questions=Question::orderby('question','asc')->select('id','question')->get();
            $name=array();
            foreach($questions as $question){
                $name += [$question->id=>$question->question];
            }
            return view('question.index_frontend')->with(compact('name'));
        }
        $datatable=new QuestionDatatable;
        return $datatable->render('question.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]); 
        $question=Question::create($request->all());
        if($question){
            if (request('file')){
                $name=uniqid().".".$request->file('file')->extension();
                $question->addMedia(request('file'))->usingName('question')->usingFileName($name)->toMediaCollection();
            }
            return response()->json([true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question=Question::with('user','edited_by')->find($question->id);
        return view('question.show')->with(compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('question.edit')->with(compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]); 
        $question->update($request->all());
        $question->edited_by=$request->user_id;
        $question->save();
        if($question){
            if (request('file')){
                $name=uniqid().".".$request->file('file')->extension();
                $question->addMedia(request('file'))->usingName('question')->usingFileName($name)->toMediaCollection();
            }
            return redirect(route('question.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Question $question)
    // {
    //     $status=$question->delete();
    //     return response()->json([true]);
    // }
        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $question=Question::find($request->id);
        $status=$question->delete();
        return response()->json([$status]);
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $question=Question::with('user')->find($request->search);
        return view('question.show')->with(compact('question'));
    }
}
