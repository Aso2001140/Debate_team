$(function () {
    //チャットを受信するajax
    get_data_once();
    //ブラウザバックを禁止する
    not_back();
    //ajaxでチャット内容を送信する
    sendtext();
    //タイマーの関数
    timer();
});

function get_data() {

    $.ajax({
        url: "result/ajax",
        dataType: "json",

        success: data => {
            $("#chat-data")
                .find(".chat-visible")
                .remove();
            //ポジションごとに文字の色を変更する
            let position = ''
            //SVGアイコンと色をポジションごとに設定する
            let svgicon = ''
            //チャットの吹き出しの色を変更する
            let chatcolor = ''
            for (let i = 0; i < data.chats.length; i++) {
                //時間の時と分を抽出
                const time = new Date(data.chats[i].created_at);
                let create_at = time.getHours() + ':' + time.getMinutes();
                if (time.getMinutes() < 10) {
                    create_at = time.getHours() + ':' + '0' + time.getMinutes();
                }

                if (data.chats[i].users_position === "賛成") {
                    position = 'text-danger'
                    svgicon =
                        '<span class="text-danger">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">\n' +
                        '  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>\n' +
                        '</svg>' +
                        '</span>'
                    chatcolor = 'chatcolor-agree'
                } else if (data.chats[i].users_position === "反対") {
                    position = 'text-primary'
                    svgicon =
                        '<span class="text-primary">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">\n' +
                        '  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>\n' +
                        '</svg>' +
                        '</span>'
                    chatcolor = 'chatcolor-denial'
                } else { //悪質なコメントの場合コチラに置き換える
                    position = 'text-success'
                    svgicon =
                        '<span class="text-success">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" className="bi bi-robot" viewBox="0 0 16 16">' +
                        '<path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5ZM3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.58 26.58 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.933.933 0 0 1-.765.935c-.845.147-2.34.346-4.235.346-1.895 0-3.39-.2-4.235-.346A.933.933 0 0 1 3 9.219V8.062Zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a24.767 24.767 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25.286 25.286 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135Z"/>' +
                        '<path d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2V1.866ZM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5Z"/>' +
                        '</svg>'
                    '</span>'
                    chatcolor = 'chatcolor-bot'
                }

                const html = `
                    <div class="chat-visible">
                        <div class="row mt-2 mb-2" id="chatalldata">
                            <div class="col-auto">
                                ${svgicon}
                                <span class="chat-body-user text-black fs-5 me-5 ms-2" id="user_name">${data.chats[i].user_name}</span>
                                <span class="chat-body-state fs-5 ${position}" id="users_positon">${data.chats[i].users_position}</span>
                            </div>
                            <div class="col-auto d-flex align-items-end">
                                <span class="chat-body-time text-secondary" id="created_at">${create_at}</span>
                            </div>
                        </div>
                        <div class="row mb-4 ms-3">
                            <div class="col-12 py-2" id="${chatcolor}">
                                <span class="chat-body-message fs-5" id="message">${data.chats[i].message}</span>
                            </div>
                        </div>
                    </div>
                        `;
                $("#chat-data").append(html).fadeIn();
            }
            let audio = new Audio()
            let audioList = ['../../audio/決定ボタンを押す44.mp3','../../audio/決定ボタンを押す50.mp3']
            audio.src = audioList[Math.floor( Math.random()*audioList.length )]
            audio.play()
        },
        error: () => {
            //alert("ajax Error");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
        }
    });

    //setTimeout("get_data()", 1500);
}

//送信ボタンが押された際リロードを挟まずにチャットを登録
function sendtext() {
    $('#chatform').submit(function (event) {
        // HTMLでの送信をキャンセル
        event.preventDefault();
        // 操作対象のフォーム要素を取得
        const $form = $(this);

        // 送信ボタンを取得
        // （後で使う: 二重送信を防止する。）
        const $button = $form.find('#submit');
        //テキスト欄を取得
        const $text = $form.find('#message');

        // 送信
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            //data形式を自動で認識、設定してくれる
            data: $form.serialize(),
            timeout: 400,

            // 送信前
            beforeSend: function (xhr, settings) {
                // ボタンを無効化し、二重送信を防止
                $button.attr('disabled', true);

            },
            // 応答後
            complete: function (xhr, textStatus) {
                // ボタンを有効化し、再送信を許可
                $button.attr('disabled', false);
                //テキストの内容を削除し再度チャットが打てるように
                $text.val('');
            },
            // 通信成功時の処理
            success: function () {

            },
            // 通信失敗時の処理
            error: function (xhr, textStatus, error) {

            }
        });

    });
}

function timer() {
    //ルームIDを取得
    const ROOMID = $('#room_id').val()
    //ルームの開始時間を取得
    const RoomTime = new Date($('#starttime').val());
    //現在の時間を取得
    let NowTime = new Date()
    RoomTime.setMinutes(RoomTime.getMinutes() + 15)
    //日時を取得比較用
    const d = Math.floor((NowTime - RoomTime) / (24 * 60 * 60 * 1000));
    //時間を取得比較用
    const h = Math.floor(((NowTime - RoomTime) % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
    //分を計算してマイナスを取り除く
    let m = Math.abs(Math.floor(((NowTime - RoomTime) % (24 * 60 * 60 * 1000)) / (60 * 1000)) % 60)-1;
    //秒を計算してマイナスを取り除く
    const s = Math.abs(Math.floor(((NowTime - RoomTime) % (24 * 60 * 60 * 1000)) / 1000) % 60 % 60);
    //タイマー部分に表示させる
    if(s===0){
        m++
    }
    $("#timer").text('残り '+m+'分'+s+'秒');
    //指定の時間に達しているかの比較
    if(NowTime > RoomTime){
        //投票画面に遷移
        clearTimeout();
        window.location.href = '/vote?roomid='+ROOMID;
    }
    //1秒間隔でタイマーを実行
    setTimeout('timer()', 1000);
}

function not_back() {
    //ブラウザバックを禁止する
    $(function () {
        history.pushState(null, null, null);

        $(window).on("popstate", function () {
            history.pushState(null, null, null);
        });
    });
}

function get_data_once() {
    var size = $('.chat-visible').length
    $.ajax({
        url: "result/ajax/chat_data",
        dataType: "json",
        success: data => {
            //チャットの要素数とチャットのサイズが違っていた場合は残りを表示させる。
            if(data.chat_size>size){
                get_data();
            }
        },
        error: (xhr, textStatus, errorThrown) => {

        }
    });
    setTimeout("get_data_once()", 2000);
}
