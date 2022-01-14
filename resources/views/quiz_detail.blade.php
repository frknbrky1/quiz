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
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Katılımcı Sayısı
                                <span class="badge bg-info rounded-pill">14</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ortalama Puan
                                <span class="badge bg-info rounded-pill">65</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        {{$quiz->description}}
                    </div>
                </div>
            </p>
            <a href="#" class="btn btn-success btn-sm w-100">Quize Katıl <i class="fas fa-sign-in-alt"></i></a>
        </div>
    </div>
</x-app-layout>
