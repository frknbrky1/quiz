<x-app-layout>
    <x-slot name="header">Quiz Güncelle</x-slot>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('quizzes.update', $quiz->id)}}">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label class="form-label">Quiz Başlığı*</label>
                    <input type="text" name="title" class="form-control" value="{{$quiz->title}}" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Quiz Açıklama</label>
                    <textarea name="description" class="form-control" rows="4">{{$quiz->description}}</textarea>
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
                <div class="mb-3">
                    <button type="submit" class="btn btn-success btn-sm w-100">Quizi Güncelle</button>
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
