<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::withCount('questions');

        if(request()->get('title')) {
            $quizzes = $quizzes->where('title', 'LIKE', "%".request()->get('title')."%");
        }
        if(request()->get('status')) {
            $quizzes = $quizzes->where('status', request()->get('status'));
        }
        if(request()->get('myCreate')) {
            $quizzes = $quizzes->where('admin_who_created', request()->get('myCreate'));
        }
        if(request()->get('myUpdate')) {
            $quizzes = $quizzes->where('admin_who_update', request()->get('myUpdate'));
        }

        $quizzes = $quizzes->paginate(5);
        return view('admin.quiz.list', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.create');
        //return "create func";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request)
    {
        //dd($request->post());
        Quiz::create($request->post());
        return redirect()->route('quizzes.index')->withSuccess('Quiz Başarıyla oluşturuldu');
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
        $quiz = Quiz::with('topTen.user', 'results.user')->withCount('questions')->find($id) ?? abort(404, 'Quiz Bulunamadı.');

        return view('admin.quiz.show', compact('quiz'));
    }

    public function result_user($user_id, $quiz_id)
    {
        $quiz = Quiz::whereId($quiz_id)->with(array(
            'questions.answers' => function($query) use ($user_id) {
                $query->where('user_id', $user_id);
                },
                'results' => function($query) use ($user_id) {
                $query->where('user_id', $user_id)->with('user');
            }))->first() ?? abort(404, 'Quiz Bulunamadı.');

        return view('admin.quiz.user_result', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz Bulunamadı');
        $updateQuiz = Quiz::where('id', $id);
        $updateQuiz->update($request->except(['_method', '_token']));
        $updateQuiz->first()->update(['slug' => null]);
        //Quiz::find($id)->update($request->except(['_method', '_token']));
        return redirect()->route('quizzes.index')->withSuccess('Quiz Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz Bulunamadı');
        $quiz->delete();
        return redirect()->route('quizzes.index')->withSuccess('Quiz Silindi');
    }
}
