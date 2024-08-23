$(window).ready(function(){

    $(window).resize(function(){
        if($(window).width()>=900){
            $('#sidenav').css('width','230px');
        }
        else{
            $('#sidenav').css('width','0px');
        }    
        
        
    });

    
});

function hideSidenav(){
    $('#sidenav').css('width','0px')
    //document.getElementById('sidenav').style.width = "0px";
    //document.getElementById('sidenav-menu').style.width = "0";
    $('#btnShowSidenav').show();
}