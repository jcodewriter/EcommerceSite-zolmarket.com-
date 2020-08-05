$(function () {

    /**
     * Some examples of how to use features.
     *
     **/
    var width = $(document).width();
    var os = 'desktop';
    if (width < 500) os = 'mobile';
    var auth_id = $('input[name=sender_id]').val();

    var webSocketConnection = new WebSocket('wss://www.zolmarket.com:5160?'+auth_id);
    webSocketConnection.onopen = function(e) {
        console.log("Connection established!");
    };

    webSocketConnection.onmessage = function(e) {
        var data = JSON.parse(e.data);
        var element = $(document).find('[name=conversation_id_'+data.conversation_id+']');
        if (data.type == 'txt'){
            if (element.length)
                ChatosExamle.Message.text(data.message, moment().format('LT'), 'received')
        }else if (data.type == 'img'){
            if (element.length)
                ChatosExamle.Message.image(data.message, moment().format('LT'), 'received')
        }else if (data.type == 'emoji'){
            if (element.length)
                ChatosExamle.Message.emoji(data.message, moment().format('LT'), 'received')
        }
        if (os == 'mobile')
            $(document).scrollTop(100000000);
        else    
            $('.messages_content_ondesktopaed').scrollTop(100000000)
    };

    var ChatosExamle = {
        Message: {
            text: function (message, time, type) {
                if (type == 'sent')
                    $('#message-list-'+os).append('<div class="message-list-item"><div class="message-list-item-row-'+type+'"><div class="user-message"><div class="message-text">'+message+'</div><span class="time" style="min-width: 55.8px;text-align: center;">'+time+'</span></div></div></div>');
                else
                    $('#message-list-'+os).append('<div class="message-list-item"><div class="message-list-item-row-'+type+'"><div class="user-avatar"><div class="message-user"><img src="http://localhost:1030/assets/img/user.png" alt="" class="img-profile"></div></div><div class="user-message"><div class="message-text">'+message+'</div><span class="time" style="min-width: 55.8px;text-align: center;">'+time+'</span></div></div></div>');
            },
            emoji: function (message, time, type) {
                if (type == 'sent')
                    $('#message-list-'+os).append('<div class="message-list-item"><div class="message-list-item-row-'+type+'"><div class="user-message"><div class="message-text">'+message+'</div><span class="time" style="min-width: 55.8px;text-align: center;">'+time+'</span></div></div></div>');
                else
                    $('#message-list-'+os).append('<div class="message-list-item"><div class="message-list-item-row-'+type+'"><div class="user-avatar"><div class="message-user"><img src="http://localhost:1030/assets/img/user.png" alt="" class="img-profile"></div></div><div class="user-message"><div class="message-text">'+message+'</div><span class="time" style="min-width: 55.8px;text-align: center;">'+time+'</span></div></div></div>');
            },
            image: function (message, time, type) {
                if (type == 'sent')
                    $('#message-list-'+os).append('<div class="message-list-item"><div class="message-list-item-row-'+type+'"><div class="user-message"><div class="message-text"><img src="'+message+'" class="img-thumbnail"></div><span class="time" style="min-width: 55.8px;text-align: center;">'+time+'</span></div></div></div>');
                else
                    $('#message-list-'+os).append('<div class="message-list-item"><div class="message-list-item-row-'+type+'"><div class="user-avatar"><div class="message-user"><img src="http://localhost:1030/assets/img/user.png" alt="" class="img-profile"></div></div><div class="user-message"><div class="message-text"><img src="'+message+'" class=""></div><span class="time" style="min-width: 55.8px;text-align: center;">'+time+'</span></div></div></div>');
            }
        },
        Image: {
            pick: function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    $('#form-control-image-box-'+os).css('display', 'block')
                    reader.onload = function (e) {
                        $('#blah-'+os).attr('src', e.target.result);
                        $('#btn-file-'+os).css('display', 'none')
                        $('#btn-emoji-'+os).css('display', 'none')
                        $("#remove-image-"+os).click(function(){
                            $('#blah-'+os).attr('src', '');
                            $('#form-control-image-box-'+os).css('display', 'none')
                            $('#btn-file-'+os).css('display', 'block')
                            $('#btn-emoji-'+os).css('display', 'block')
                        });
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    };

    // var SendingServer = 
    /* div tag editable */
    var editable = document.getElementById('message-'+os);
    editable.addEventListener('input', function() {
        if (this.textContent) {
            $('#btn-file-'+os).css('display', 'none')
            $('#btn-emoji-'+os).css('display', 'none')
        }else{
            $('#btn-file-'+os).css('display', 'block')
            $('#btn-emoji-'+os).css('display', 'block')
        }
    });
    /* div tag editable */

    /* form sumbit */
    $('form').submit(function (e) {
        e.preventDefault();
        var messageBox = $(this).find('#message-'+os);
        var message = messageBox.text();
        var childrens = messageBox.children();
        
        var imageBox = $(this).find('#blah-'+os);
        var imageSrc = imageBox.attr('src');
        console.log(imageBox)

        var form_data = new FormData();
        var data = {};
        $.each($(this).serializeArray(), function(i, field) {
            data[field.name] = field.value;
            form_data.append(field.name, field.value);
        });
        data['message'] = message;
        form_data.append((os == 'mobile'?"userfile_mobile":"userfile"), $('.file-input')[0].files[0]);

        if (childrens.length){
            data['message'] = messageBox.html();
            data['type'] = 'emoji';
            ChatosExamle.Message.emoji(messageBox.html(), moment().format('LT'), 'sent');
            messageBox.html('')
            if (os == 'mobile')
                $(document).scrollTop(100000000);
            else
                $('.messages_content_ondesktopaed').scrollTop(100000000)
            
            $.ajax({
                type: "POST",
                url: base_url + "Message_controller/send_message",
                data: data,
                success: function (response) {
                    
                }
            });
            webSocketConnection.send(JSON.stringify(data));
            
        }else{
            if (imageSrc){
                ChatosExamle.Message.image(imageSrc, moment().format('LT'), 'sent');
                imageBox.attr('src', '');
                messageBox.focus();
                $('.form-control-image-box').css('display', 'none');
                if (os == 'mobile')
                    $(document).scrollTop(100000000);
                else
                    $('.messages_content_ondesktopaed').scrollTop(100000000)
                $.ajax({
                    type: "POST",
                    url: base_url + (os == 'mobile'?"Message_controller/send_image_chat_mobile":"Message_controller/send_image_chat"),
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        data['message'] = response;
                        data['type'] = 'img';
                        webSocketConnection.send(JSON.stringify(data));
                    }
                });  
            }else{
                ChatosExamle.Message.text(message, moment().format('LT'), 'sent')
                messageBox.text('');
                messageBox.focus();
                // send message
                data['type'] = 'txt';
                if (os == 'mobile')
                    $(document).scrollTop(100000000);
                else
                    $('.messages_content_ondesktopaed').scrollTop(100000000)
                
                
                $.ajax({
                    type: "POST",
                    url: base_url + "Message_controller/send_message",
                    data: data,
                    success: function (response) {
                        
                    }
                });
                webSocketConnection.send(JSON.stringify(data));
            }
        }
        $('#btn-file-'+os).css('display', 'block')
        $('#btn-emoji-'+os).css('display', 'block')
        
    });

    /* form sumbit */

    $('#btn-file-'+os).on('click', function() {
        console.log("ehre")
        $('.file-input').trigger('click');
    });

    $(".file-input").change(function(){
        ChatosExamle.Image.pick(this);
    });

    $('#btn-emoji-'+os).click(function(){
        $('#emoji_'+os).css('display', 'block')
        $('#btn-file-'+os).css('display', 'none')
        $('#btn-emoji-'+os).css('display', 'none')
        $('#btn-send-'+os).css('display', 'none')
    })
       
    $('#emoji_'+os+' img').click(function () {
        $('#message-'+os).append($(this).clone())
        $('#emoji_'+os).css('display', 'none')
        $('#btn-emoji-'+os).css('display', 'block')
        $('#btn-send-'+os).css('display', 'block')
    })
});