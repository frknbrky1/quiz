<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Quizlere Dön</a>
            </h5>
            <p class="card-text">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group">
                            @if($quiz->my_result)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Puanınız:
                                    <span class="badge bg-warning rounded-pill">{{$quiz->my_result->point}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Doğru / Yanlış Sayısı:
                                    <div>
                                        <span class="badge bg-success rounded-pill" title="Doğru">{{$quiz->my_result->correct}} Doğru</span>
                                        <span class="badge bg-danger rounded-pill" title="Yanlış">{{$quiz->my_result->wrong}} Yanlış</span>
                                    </div>
                                </li>
                            @endif
                            @if($quiz->finished_at)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Son Katılım Tarihi
                                    <span class="badge bg-info rounded-pill" title="{{$quiz->finished_at}}">{{$quiz->finished_at->diffForHumans()}}</span>
                                </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Soru Sayısı
                                <span class="badge bg-info rounded-pill">{{$quiz->questions_count}}</span>
                            </li>
                            @if($quiz->details)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Katılımcı Sayısı
                                    <span class="badge bg-info rounded-pill">{{$quiz->details['join_count']}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Ortalama Puan
                                    <span class="badge bg-info rounded-pill">{{$quiz->details['avarage']}}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-8">
                        {{$quiz->description}}
                        @if($quiz->my_result)
                            <a href="{{route('quiz.join', $quiz->slug)}}" class="btn btn-warning btn-sm w-100 mt-2">Quizi Görüntüle <i class="fas fa-eye"></i></a>
                        @else
                            <a href="{{route('quiz.join', $quiz->slug)}}" class="btn btn-success btn-sm w-100 mt-2">Quize Katıl <i class="fas fa-sign-in-alt"></i></a>
                        @endif
                    </div>
                </div>
            </p>
        </div>
    </div>
</x-app-layout>
