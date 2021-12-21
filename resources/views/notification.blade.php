@extends("template.body")

@section('title')
    <title> Notification </title>
@endsection

@section('mainContent')
    <div class="text-center fs-2 my-3 fw-bold">
        Notification
    </div>
    <div class="container rounded" style="background-color: #191a1c;">
        <table>
            <th>
                <td style="width: 300px">Title</td>
                <td style="width: 700px">Synopsis</td>
                <td style="width: 100px">Total Page</td>
                <td style="width: 200px">Unfavorited At</td>
            </th>
            @php
                $dataNotif = DB::connection('conn_proyek')->table('notify')->where('id_user','=',Auth::user()->id)->get();
            @endphp
            @foreach ($dataNotif as $data)
                @php
                    $manga = DB::connection('conn_proyek')->table('manga')->where('id','=',$data->id_manga)->first();
                @endphp
                <tr>
                    <td></td>
                    <td>{{$manga->title}}</td>
                    <td>{{$manga->synopsis}}</td>
                    <td>{{$manga->total_page}}</td>
                    <td>{{$data->created_at}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
