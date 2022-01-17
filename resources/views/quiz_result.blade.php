<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Sonucu</x-slot>

    <div class="w-100 alert alert-warning">
        <div @if($quiz->my_result->point > 49) class="w-100 align-middle text-success" @else class="w-100 align-middle text-danger" @endif>
           <u>Puanın: <strong>{{$quiz->my_result->point}}</strong></u>
        </div>
        <div class="row">
            <div class="col-md-6 align-self-end">
                <a href="{{route('quiz.detail', $quiz->slug)}}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i>
                    Quiz Detayı
                </a>
            </div>
            <div class="col-md-6">
                <div class="w-100 align-middle text-success text-end">
                    <i>Doğru Sayın </i> <small><i class="fa fa-arrow-alt-circle-right ml-1 mr-2"></i></small>{{$quiz->my_result->correct}}
                </div>
                <div class="w-100 align-middle text-danger text-end">
                    <i>Yanlış Sayın </i> <small><i class="fa fa-arrow-alt-circle-right ml-2 mr-2"></i></small>{{$quiz->my_result->wrong}}
                </div>
            </div>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-text">
                @foreach($quiz->questions as $question)
                    @if($question->correct_answer == $question->my_answer->answer)
                        <div class="w-100 alert alert-success">
                    @else
                        <div class="w-100 alert alert-danger">
                    @endif
                        <strong>{{$loop->iteration}}) {{$question->question}}</strong>
                        <div class="row mt-2">
                            <div class="col-md-10">
                                @if($question->image)
                                    <img src="{{asset($question->image)}}" class="img-responsive" width="50%">
                                @endif
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="answer1-{{$question->id}}" value="answer1" @if($question->my_answer->answer == 'answer1') checked @endif disabled>
                                    <label class="form-check-label" for="answer1-{{$question->id}}">{{$question->answer1}}</label>@if($question->correct_answer == 'answer1') <i class="fa fa-check text-success"></i> @endif
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="answer2-{{$question->id}}" value="answer2" @if($question->my_answer->answer == 'answer2') checked @endif disabled>
                                    <label class="form-check-label" for="answer2-{{$question->id}}">{{$question->answer2}}</label>@if($question->correct_answer == 'answer2') <i class="fa fa-check text-success"></i> @endif
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="answer3-{{$question->id}}" value="answer3" @if($question->my_answer->answer == 'answer3') checked @endif disabled>
                                    <label class="form-check-label" for="answer3-{{$question->id}}">{{$question->answer3}}</label>@if($question->correct_answer == 'answer3') <i class="fa fa-check text-success"></i> @endif
                                </div>
                                <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{$question->id}}" id="answer4-{{$question->id}}" value="answer4" @if($question->my_answer->answer == 'answer4') checked @endif disabled>
                            <label class="form-check-label" for="answer4-{{$question->id}}">{{$question->answer4}}</label>@if($question->correct_answer == 'answer4') <i class="fa fa-check text-success"></i> @endif
                        </div>
                            </div>
                            <div class="col-md-2">
                                <small><i>Bu soruya <strong>%{{$question->true_percent}}</strong> oranında doğru cevap verildi.</i></small>
                            </div>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
