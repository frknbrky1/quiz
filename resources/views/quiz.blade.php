<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="card">
        <div class="card-body">
            <div class="card-text">
                <form method="POST" action="{{route('quiz.result', $quiz->slug)}}">
                    @csrf
                    @foreach($quiz->questions as $question)
                    <div class="w-100">
                        <strong>{{$loop->iteration}}) {{$question->question}}</strong>
                        @if($question->image)
                            <img src="{{asset($question->image)}}" class="img-responsive" width="50%">
                        @endif
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="{{$question->id}}" id="answer1-{{$question->id}}" value="answer1" required>
                            <label class="form-check-label" for="answer1-{{$question->id}}">{{$question->answer1}}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{$question->id}}" id="answer2-{{$question->id}}" value="answer2" required>
                            <label class="form-check-label" for="answer2-{{$question->id}}">{{$question->answer2}}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{$question->id}}" id="answer3-{{$question->id}}" value="answer3" required>
                            <label class="form-check-label" for="answer3-{{$question->id}}">{{$question->answer3}}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{$question->id}}" id="answer4-{{$question->id}}" value="answer4" required>
                            <label class="form-check-label" for="answer4-{{$question->id}}">{{$question->answer4}}</label>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
                    <button type="submit" class="btn btn-success btn-sm w-100 mt-3">
                        <i class="fas fa-flag-checkered fa-flip-horizontal"></i>
                        Sınavı Bitir
                        <i class="fas fa-flag-checkered"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
