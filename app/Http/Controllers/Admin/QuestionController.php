<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //$questions = Quiz::find($id)->questions;
        $quiz = Quiz::whereId($id)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.question.list', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $quiz = Quiz::find($id);
        return view('admin.question.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, $id)
    {
        //dd(Auth::user()->id);
        if($request->hasFile('image')) {
            $fileName = substr(Str::slug($request->question), 0, 210).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;

            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload
            ]);
            //$request->image = $fileNameWithUpload;
        }

        $createQuiz = Quiz::find($id);
        $createQuiz->admin_who_update = Auth::user()->id;
        $createQuiz->save();
        $createQuiz->questions()->create($request->post());

        return redirect()->route('questions.index', $id)->withSuccess('Soru Başarıyla Oluşturuldu');
        //return $request->post();
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
    public function edit($quiz_id, $question_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Quiz veya Soru Bulunamadı');
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quiz_id, $question_id)
    {
        if($request->hasFile('image')) {

            $deleteOldImg = Quiz::find($quiz_id)->questions()->whereId($question_id)->first();
            if(File::exists($deleteOldImg->image)) {
                File::delete(public_path($deleteOldImg->image));
            }

            $fileName = substr(Str::slug($request->question), 0, 210).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;

            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload
            ]);
        }

        $updateQuiz = Quiz::find($quiz_id);
        $updateQuiz->admin_who_update = Auth::user()->id;
        $updateQuiz->save();

        $updateQuiz->questions()->whereId($question_id)->first()->update($request->post());

        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id, $question_id)
    {
        $deleteImg = Quiz::find($quiz_id)->questions()->whereId($question_id)->first();
        if(File::exists($deleteImg->image)) {
            File::delete(public_path($deleteImg->image));
        }

        $deleteQuiz = Quiz::find($quiz_id);
        $deleteQuiz->admin_who_update = Auth::user()->id;
        $deleteQuiz->save();

        $deleteQuiz->questions()->whereId($question_id)->delete();
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Başarıyla Silindi');
    }
}
