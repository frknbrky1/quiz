<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Quizine Ait Sorular</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title float-end">
                <a href="{{ route('questions.create', $quiz->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Soru Oluştur</a>
            </h5>
            <h5 class="card-title">
                <a href="{{ route('quizzes.index') }}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Quizlere Dön</a>
            </h5>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th scope="col">Soru</th>
                        <th scope="col">Fotoğraf</th>
                        <th scope="col">1. Cevap</th>
                        <th scope="col">2. Cevap</th>
                        <th scope="col">3. Cevap</th>
                        <th scope="col">4. Cevap</th>
                        <th scope="col">Doğru Cevap</th>
                        <th scope="col" style="min-width: 75px">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($quiz->questions as $question)
                    <tr class="align-middle">
                        <td>{{ $question->question }}</td>
                        <td class="align-middle">
                            @if($question->image)
                                <a href="{{asset($question->image)}}" target="_blank" class="btn btn-sm btn-success" title="Resim">Görüntüle</a>
                            @endif
                        </td>
                        <td>{{ $question->answer1 }}</td>
                        <td>{{ $question->answer2 }}</td>
                        <td>{{ $question->answer3 }}</td>
                        <td>{{ $question->answer4 }}</td>
                        <td class="text-success">{{ substr($question->correct_answer, -1) }}. Cevap</td>
                        <td>
                            <a href="{{route('questions.edit', [$quiz->id, $question->id])}}" class="btn btn-sm btn-primary" title="Güncelle"><i class="fa fa-pen"></i></a>
                            <a href="{{route('questions.destroy', [$quiz->id, $question->id])}}" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
