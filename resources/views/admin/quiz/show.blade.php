<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('quizzes.index') }}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i>
                    Quizlere Dön
                </a>
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
                        </div>
                    </div>
                    <div class="col-md-8">
                        {{$quiz->description}}
                        <table class="table table-bordered  table-success table-striped mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Ad Soyad</th>
                                    <th scope="col">Puan</th>
                                    <th scope="col">Doğru</th>
                                    <th scope="col">Yanlış</th>
                                    <th scope="col">Cevapları</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quiz->results as $result)
                                    <tr>
                                        <td>{{$result->user->name}}</th>
                                        <td>{{$result->point}}</td>
                                        <td>{{$result->correct}}</td>
                                        <td>{{$result->wrong}}</td>
                                        <td>
                                            <a href="{{route('result.user', [$result->user->id, $quiz->id])}}" class="btn btn-warning btn-sm w-100 mt-2">
                                                Quizi Görüntüle <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>
