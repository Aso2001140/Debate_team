<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
<body>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"/>
            </svg>

        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link active">ジャンル選択</a></li>
            <li class="nav-item"><a href="#" class="nav-link">マイページ</a></li>
            <li class="nav-item"><a href="#" class="nav-link">ログイン</a></li>

        </ul>
    </header>
</div>
<div class="container w-75 shadow-lg">
    @foreach($user as $users)
        <div class="col-12 text-center h-auto fs-1 pb-4 pt-4" id="lanking">
            ランキング
        </div>

        <!-- 1st -->
        <div class="container shadow-lg">
            <div class="row border-bottom border-3 h-auto">
                <div class="col "></div>
                <div class="col  justify-content-center" id="1st">
                    <div class="text-center">
                        <span class="col fs-1 text-warning" id="icon1st">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                                 class="bi bi-award" viewBox="0 0 16 16">
                                <path
                                    d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
                                <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                            </svg>
                        </span>
                        <!--順位-->
                        <div hidden> {{$j=1}}</div>


                        <a class="fs-1 text-black">{{$j}}st</a>
                    </div>
                    <div class="text-center fs-2">
                        <a class="">{{$users[0]->name}}</a>
                        <a class="">{{$users[0]->u_point}}Pt</a>
                    </div>
                </div>

                <div class="col "></div>
            </div>
            <div class="row " id="2nd3rd">
                <!-- 2nd -->
                <div class="col border-end border-3">
                    <div class="col-auto  text-center ">
                        <div class="col text-center fs-2 ">
                            @if($users[1]->u_point==$users[0]->u_point)
                                <a class="text-black">{{$j}}st</a>
                            @else
                            <a class="text-black">{{$j=$j+1}}nd</a>
                                @endif
                        </div>
                        <a class="">{{$users[1]->name}}</a>
                        <a class="">{{$users[1]->u_point}}Pt</a>
                    </div>

                </div>
                <!-- 3rd -->
                <div class="col ">
                    <div class="col-auto  ">
                        <div class="col text-center fs-2">
                            @if($users[1]->u_point==$users[2]->u_point)
                                @if($j==1)
                                    <a class="text-black">{{$j}}st</a>
                                @elseif($j==2)
                                    <a class="text-black">{{$j}}nd</a>
                                    @endif
@else
                                <a class="text-black">{{$j=$j+1}}rd</a>
                            @endif

                        </div>
                        <div class="text-center">
                            <a class="">{{$users[2]->name}}</a>
                            <a class="">{{$users[2]->u_point}}Pt</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!--Other-->


<div class="container shadow-lg w-75 mt-4 ">
    <div class="row">

    @for($i = 3; $i <count($users); $i++)
        <div class="d-flex justify-content-center text-start border-bottom  border-3">
                    <span class="fs-4 ">

                        @if($users[$i]->u_point==$users[$i-1]->u_point)
                            @if($j==1)
                            {{$j}}st
                            @elseif($j==2)
                                {{$j}}nd
                            @elseif($j==3)
                                {{$j}}}rd
                            @else
                                {{$j}}th
                            @endif
                            {{$users[$i]->name}}
                            Point ：{{$users[$i]->u_point}}

                            @else

                             {{$j=$j+1}}th
                            {{$users[$i]->name}}
                            Point ：{{$users[$i]->u_point}}

                            @endif
                     </span>
        </div>
    @endfor

    </div>
</div>
@endforeach


<script src="{{mix('js/app.js')}}"></script>
</body>
</html>


