$(function() { 
    $("#btnSabe").click(function() { 
        html2canvas($("#app"), {
            onrendered: function(canvas) {
                theCanvas = canvas;


                canvas.toBlob(function(blob) {
                    saveAs(blob, "Dashboard.png"); 
                });
            }
        });
    });
});