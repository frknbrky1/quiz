<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i>
                    Quizlere Dön</a>
            </h5>
            <p class="card-text">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    Genel Bilgiler
                                </button>
                            </li>
                            @if(count($quiz->topTen) > 0)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        Top 10
                                    </button>
                                </li>
                            @endif
                            @if($quiz->my_result)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        Senin Bilgilerin
                                    </button>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                            <div class="tab-pane fade" id="top" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group">
                                    @foreach($quiz->topTen as $result)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <strong class="h4">{{$loop->iteration}}. </strong>
                                                <img class="h-8 w-8 rounded-full object-cover ml-3" src="{{$result->user->profile_photo_url}}">
                                                <div @if(auth()->user()->id == $result->user_id) class="ml-2 text-danger" @else  class="ml-2" @endif>{{$result->user->name}}</div>
                                            </div>
                                            <div>
                                                <span class="badge bg-success rounded-pill">{{$result->point}}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group">
                                    @if($quiz->my_result)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Puanınız:
                                            <span @if($quiz->my_result->point > 49) class='badge bg-info rounded-pill' @else class='badge bg-danger rounded-pill' @endif>{{$quiz->my_result->point}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Doğru / Yanlış Sayısı:
                                            <div>
                                                <span class="badge bg-success rounded-pill" title="Doğru">{{$quiz->my_result->correct}} Doğru</span>
                                                <span class="badge bg-danger rounded-pill" title="Yanlış">{{$quiz->my_result->wrong}} Yanlış</span>
                                            </div>
                                        </li>
                                    @endif
                                    @if($quiz->my_rank)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Sıralama:
                                            <span class="badge bg-primary rounded-pill">#{{$quiz->my_rank}}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        {{$quiz->description}}
                        @if($quiz->my_result)
                            <a href="{{route('quiz.join', $quiz->slug)}}" class="btn btn-warning btn-sm w-100 mt-2">
                                Quizi Görüntüle <i class="fas fa-eye"></i>
                            </a>
                        @elseif($quiz->finished_at > now() || $quiz->finished_at == null)
                            <a href="{{route('quiz.join', $quiz->slug)}}" class="btn btn-success btn-sm w-100 mt-2">
                                Quize Katıl <i class="fas fa-sign-in-alt"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>
