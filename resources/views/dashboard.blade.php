<x-app-layout>
    <x-slot name="header">Anasayfa</x-slot>

    <div class="row">
        <div class="col-md-8">
            <div class="list-group">
                @foreach($quizzes as $quiz)
                    <a href="{{route('quiz.detail', $quiz->slug)}}" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$quiz->title}}</h5>
                            <small title="{{$quiz->finished_at}}"><i>{{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() : 'Son Tarih Yok' }}</i></small>
                        </div>
                        <p class="mb-1">{{Str::limit($quiz->description, 100)}}</p>
                        <small>Toplam {{$quiz->questions_count}} soru</small>
                    </a>
                @endforeach
                <div class="mt-2">
                    {{$quizzes->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            Abaculus velox pulchritudine est.
            The meditation of your justices will sit silently when you feel that enlightenment is the sinner.
        </div>
    </div>
</x-app-layout>
