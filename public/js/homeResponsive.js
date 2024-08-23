if(window.innerWidth < 1340){
    $('div.home-body-container').removeClass('container')
}
$(window).resize(function(){
    if(window.innerWidth < 1340){
        $('div.home-body-container').removeClass('container')
    }
    else{
        $('div.home-body-container').addClass('container')
    }
});

