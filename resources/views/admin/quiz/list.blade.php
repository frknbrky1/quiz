<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title float-end">
                <a href="{{ route('quizzes.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Quiz oluştur</a>
            </h5>
            <form method="GET" action="">
                <div class="row">
                    <h6><i class="fa fa-search"></i><b> Tüm Quizlerde Ara</b></h6>
                    <div class="col-md-2">
                        <input type="text" name="title" placeholder="Quiz Adı.." value="{{request()->get('title')}}" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select form-select-sm" name="status" onchange="this.form.submit()">
                            <option value="">Durum Seçiniz</option>
                            <option @if(request()->get('status') == 'publish') selected @endif value="publish">Aktif</option>
                            <option @if(request()->get('status') == 'passive') selected @endif value="passive">Pasif</option>
                            <option @if(request()->get('status') == 'draft') selected @endif value="draft">Taslak</option>
                        </select>
                    </div>
                    @if(request()->get('title') || request()->get('status'))
                        <div class="col-md-2">
                            <a href="{{route('quizzes.index')}}" class="btn btn-secondary btn-sm">Sıfırla</a>
                        </div>
                    @endif
                </div>
            </form>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Quiz</th>
                        <th scope="col">Soru Sayısı</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Bitiş Tarihi</th>
                        <th scope="col">İşlemler</th>
                        <th scope="col">
                            <form method="GET" action="">
                                <div class="btn-group float-end" role="group" aria-label="Button group with nested dropdown">
                                    <button class="btn btn-sm btn-info" name="myCreate" value="{{Auth::user()->id}}"><b>Oluşturduklarım</b></button>
                                    <button class="btn btn-sm btn-light" name="myUpdate" value="{{Auth::user()->id}}"><b>Güncellediklerim</b></button>
                                    <a href="{{route('quizzes.index')}}" class="btn btn-sm btn-success" title="Sil"><b>Tüm Quizler</b></a>
                                </div>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td style="max-width: 445px">{{ $quiz->title }}</td>
                            <td>{{ $quiz->questions_count }}</td>
                            <td>
                                @switch($quiz->status)
                                    @case('publish')
                                        <span class="badge rounded-pill bg-success">Aktif</span>
                                    @break
                                    @case('passive')
                                        <span class="badge rounded-pill bg-danger">Pasif</span>
                                    @break
                                    @case('draft')
                                        <span class="badge rounded-pill bg-warning text-dark">Taslak</span>
                                    @break
                                @endswitch
                            </td>
                            <td>
                                <span title="{{ $quiz->finished_at }}">
                                    {{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() : '-' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{route('questions.index', $quiz->id)}}" class="btn btn-sm btn-warning" title="Sorular"><i class="fa fa-question"></i></a>
                                <a href="{{route('quizzes.edit', $quiz->id)}}" class="btn btn-sm btn-primary" title="Düzenle"><i class="fa fa-pen"></i></a>
                                <a href="{{route('quizzes.destroy', $quiz->id)}}" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></a>
                            </td>
                            <td>
                                <i style="font-size: smaller">
                                    <b>Oluşturan: </b>@if(\App\Models\User::find($quiz->admin_who_created)) {{\App\Models\User::find($quiz->admin_who_created)->name}} @endif
                                    <br>
                                    <b>Son Güncelleyen: </b>@if(\App\Models\User::find($quiz->admin_who_update)) {{\App\Models\User::find($quiz->admin_who_update)->name}} @endif
                                </i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $quizzes->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
