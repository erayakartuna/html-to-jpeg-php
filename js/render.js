

$(document).ready(function(){
    var i = 0;
    $('.'+content_class_name).each(function() {
        console.log(i);
        html2canvas(this,{
            onrendered: function (canvas) {
                //Set hidden field's value to image data (base-64 string)
                $('#'+form_id).append('<input type="hidden" rel="'+i+'" name="'+hidden_image_names+'[]" value="'+canvas.toDataURL("image/png")+'"/>');
                i++;
                console.log(i);
            }

        });

    });

    var timer = setInterval(function () {

        if(i == content.length){
            clearInterval(timer);
        }
    }, 1000);
});





