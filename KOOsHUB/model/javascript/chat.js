$(document).ready(function(){
    var connection = new WebSocket('ws://localhost:8080');
    connection.onopen = function(e){
        console.log('connected');
    };
    connection.onmessage = function(e){
        console.log(e.data);
        var data = JSON.parse(e.data);
        var row = '';
        var background = '';
        if(data.from == 'me'){
            row = 'row justify-content-end';
            background = 'text-dark alert-light';
        }else{
            row = 'row justify-content-start';
            background = 'alert-success';
        }
        var html_data = `<div class="${row_class}"><div class='col-sm-10'>
        <div class='shadow-sm-alert ${background_class}'><b>${data.from} - </b>${data.msg} <br>
        <div class="text-right"><small><i>${data.dt}</i></small></div></div></div></div>`;
        $('#message_area').append(html_data);
        $('#chat_box').val("");

    };
    $('#chat_form').parsley();
    $('#message_area').scrollTop($('#message_area')[0].scroll.Height);
    $('#chat_form').on('submit', function(event){
        event.preventDefault();
        if($('#chat_form').parsley().isValid()){
            var receiver_Id = $('#receiver_id').val();
            var info_Id = $('#info_id').val();
            var message = $('#chat_box').val();
            var data = {
                receiver_id : receiver_Id,
                info_id : info_Id,
                msg : message
            }
            $('#chat_btn').on('click', () => {
                ('#chat_box').textContent = '';
            })
            connection.send(JSON.stringify(data));
            $('#message_area').scrollTop($('#message_area')[0].scrollHeight);
        }
    });

});