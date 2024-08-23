$(window).ready(function(){
    fetchNotifications()

    function fetchNotifications(){
        $('.notification-container').html('');

        $.ajax({
            type: 'get',
            url: '/fetchNotifications',
            success: function(response){
                //console.log(response.notifications);
                $.each(response.notifications, function(key, notification){
                    
                    $('.notification-container').append('\
                        <a href="/viewNotification/'+notification.id+'">\
                            <div class="w-100 notification p-2" id="notification'+notification.id+'">\
                                <div class="row">\
                                    <div class="col-md-1">\
                                    <input class="form-check-input" type="checkbox" id="checkbox'+notification.id+'" disabled>\
                                    </div>\
                                    <div class="col-md-2 name overflow-hidden">'+ notification.senderFName +' '+ notification.senderLName +'</div>\
                                    <div class="col-md-7 message px-2">'+ notification.message +'</div>\
                                    <div class="col-md-2 date overflow-hidden">'+ notification.created_at +'</div>\
                                </div>\
                            </div>\
                        </a>\
                    ');
                    var checkbox;
                    if(notification.status == "unread")
                    {
                        //$('#notification').removeClass('seen');
                        $('#notification'+notification.id).addClass('unseen');
                        $('#checkbox'+notification.id).attr('checked', false);
                        
                    }
                    if(notification.status == "seen")
                    {
                        //$('#notification').removeClass('unseen');
                        $('#notification'+notification.id).addClass('seen');
                        $('#checkbox'+notification.id).attr('checked', true);
                        
                    }
                })
            }
        })
    }
})