<x-app-layout>
    <x-slot name="header">Quiz Oluştur</x-slot>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('quizzes.store')}}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Quiz Başlığı*</label>
                    <input type="text" name="title" class="form-control" required >
                </div>
                <div class="mb-3">
                    <label class="form-label">Quiz Açıklama</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" id="isFinished">
                    <label class="form-check-label" for="isFinished">
                        Bitiş Tarihi olacak mı ?
                    </label>
                </div>
                <div class="mb-3" id="finishedInput" style="display: none">
                    <label class="form-label">Bitiş Tarihi</label>
                    <input type="datetime-local" name="finished_at" class="form-control" >
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success btn-sm w-100">Quiz Oluştur</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
            $('#isFinished').change(function () {
                if($(this).is(':checked')) {
                    $('#finishedInput').show();
                }
                else {
                    $('#finishedInput').hide();
                }
            });
        </script>
    </x-slot>
</x-app-layout>
