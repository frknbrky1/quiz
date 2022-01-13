<x-app-layout>
    <x-slot name="header">{{$question->question}} Düzenle</x-slot>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('questions.update', [$question->quiz_id, $question->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Soru</label>
                    <textarea name="question" class="form-control" rows="4">{{$question->question}}</textarea>
                </div>
                <div class="mb-3 row">
                    <label class="form-label">Resim</label>
                    <div class="col-md-6 align-self-center">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6">
                        @if($question->image)
                            <a href="{{asset($question->image)}}" target="_blank">
                                <img src="{{asset($question->image)}}" class="img-responsive" width="150px">
                            </a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">1. Cevap</label>
                            <textarea name="answer1" class="form-control" rows="2">{{$question->answer1}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">2. Cevap</label>
                            <textarea name="answer2" class="form-control" rows="2">{{$question->answer2}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">3. Cevap</label>
                            <textarea name="answer3" class="form-control" rows="2">{{$question->answer3}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">4. Cevap</label>
                            <textarea name="answer4" class="form-control" rows="2">{{$question->answer4}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Doğru Cevap</label>
                    <select name="correct_answer" class="form-select form-select-sm">
                        <option @if($question->correct_answer === 'answer1') selected @endif value="answer1">1. Cevap
                        </option>
                        <option @if($question->correct_answer === 'answer2') selected @endif value="answer2">2. Cevap
                        </option>
                        <option @if($question->correct_answer === 'answer3') selected @endif value="answer3">3. Cevap
                        </option>
                        <option @if($question->correct_answer === 'answer4') selected @endif value="answer4">4. Cevap
                        </option>
                    </select>
                </div>
                <div class="mb-3 row justify-content-between">
                    <a href="{{route('questions.index', $question->quiz_id)}}" class="btn btn-danger btn-sm w-25">Vazgeç</a>
                    <button type="submit" class="btn btn-success btn-sm w-25">Soruyu Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
