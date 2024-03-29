@extends('header')

@section('head')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{asset('/js/app.js')}}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Plus:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
    <link rel="stylesheet" href="{{asset('js/theme.js')}}">

@endsection
@section('body')
    <div id="particles-js"></div>
    <div id="">
        <div class="container">
            <div class="fs-1 text-center">
                <h1>Choose Theme</h1>
                <h2>参加したいテーマを選択してください</h2>
            </div>
            <div class="text-center">
                <input type="button" class="  btn btn-outline-info btn-secondary border-secondary text-white "
                       value="戻る" onclick="location.href='{{url('/sgenre')}}'">
            </div>
            <div class="col text-center">
                <div class="fs-2" id="titles">
                    <p class="test">{{-- $room->r_id --}}</p>
                    <p class="titles">{{$category->title_id}}{{$category->c_name}}</p>
                </div>

            </div>

        </div>
    @foreach($room as $room_once)
        <!--テーマ選択-->
            <div class="text-center">
                <input type="button" class="text-warp w-75 h-25 mt-2 btn btn-secondary btn-outline-danger text-white"
                       data-bs-toggle="modal" data-bs-target="#dialog{{$room_once->t_id}}"
                       id="theme_btn" onclick="document.getElementById('dialog{{$room_once->t_id}}').show();"
                       value="{{$room_once->t_name}}">
            </div>


            <!-- Modal -->


            <div class="modal fade" id="dialog{{$room_once->t_id}}" tabindex="-1" aria-labelledby="exampleModalLabels"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="fs-3" id="exampleModalLabels">Choose Position</span>
                        </div>
                        <div class="modal-body">
                            <p class="">{{$room_once->t_name}}</p>

                            <p class="">※傍観者の中からランダムに投票権が付与されます。</p>
                        </div>
                        <div class="modal-footer">
                            {{-- 部屋IDとユーザーIDは前の画面から取得して状態のみこちらから指定する --}}
                            <input type="button" class="btn btn-outline-info btn-secondary border-secondary text-white "
                                   onclick="location.href='{{url('/standby/'.$room_once->r_id.'/'.$debater_flag)}}'"
                                   value="発言者">
                            <input type="button" class="btn btn-outline-info btn-secondary border-secondary text-white "
                                   onclick="location.href='{{url('/standby/'.$room_once->r_id.'/'.$bystander_flag)}}'"
                                   value="傍観者">
                            <button class="btn btn-outline-danger btn-secondary border-secondary text-white "
                                    data-bs-dismiss="modal">戻る
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach


    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src={{asset('js/theme.js')}}></script>
@endsection






