<x-app-layout>
    <x-slot name="header">Quiz Güncelle</x-slot>
    <div class="card">
        <div class="card-body">

            <a href="{{route('questions.index', $quiz->id)}}" class="btn btn-sm btn-warning float-end" title="Sorular"><i class="fa fa-question"></i> Quizin Soruları</a><br>
            <form method="POST" action="{{route('quizzes.update', $quiz->id)}}">
                @method('PUT')
                @csrf
                <input type="hidden" name="admin_who_update" value="{{Auth::user()->id}}">
                <div class="mb-3">
                    <label class="form-label">Quiz Başlığı*</label>
                    <input type="text" name="title" class="form-control" value="{{$quiz->title}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Quiz Açıklama</label>
                    <textarea name="description" class="form-control" rows="4">{{$quiz->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Quiz Durumu</label>
                    <select name="status" class="form-select form-select-sm">
                        <option @if($quiz->questions_count < 4) disabled @endif @if($quiz->status === 'publish') selected @endif value="publish">Aktif</option>
                        <option @if($quiz->status === 'passive') selected @endif value="passive">Pasif</option>
                        <option @if($quiz->status === 'draft') selected @endif value="draft">Taslak</option>
                    </select>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" @if($quiz->finished_at) checked @endif type="checkbox" id="isFinished">
                    <label class="form-check-label" for="isFinished">
                        Bitiş Tarihi olacak mı ?
                    </label>
                </div>
                <div class="mb-3" id="finishedInput" @if(!$quiz->finished_at) style="display: none" @endif>
                    <label class="form-label">Bitiş Tarihi</label>
                    <input type="datetime-local" name="finished_at" id="reqDate" class="form-control" @if($quiz->finished_at) value="{{date('Y-m-d\TH:i', strtotime($quiz->finished_at))}}" @endif>
                </div>
                <div class="mb-3 row justify-content-between">
                    <a href="{{ route('quizzes.index') }}" class="btn btn-danger btn-sm w-25">Vazgeç</a>
                    <button type="submit" class="btn btn-success btn-sm w-25">Quizi Güncelle</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
            $('#isFinished').change(function () {
                if($(this).is(':checked')) {
                    $('#finishedInput').show();
                    $("#reqDate").prop('required',true);
                }
                else {
                    $('#finishedInput').hide();
                    $("#reqDate").prop('required',false);
                }
            });
        </script>
    </x-slot>
</x-app-layout>
