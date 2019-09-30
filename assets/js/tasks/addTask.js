$(function() {
    $('#exampleInputName').keyup( function(){
        $('#modalName').text($('#exampleInputName').val());
    });
  
    $('#exampleInputEmail').keyup( function(){
        $('#modalEmail').text($('#exampleInputEmail').val());
    });
  
    $('#exampleInputContant').keyup( function(){
        $('#modalTask').text($('#exampleInputContant').val());
    });
  
    $('#task-image').on('change', function() {
        if (this.files && this.files[0]) {
  
          var reader = new FileReader();
            
            reader.onload = function(e) { 
                $('.image-preview').attr('src', e.target.result);
  
                var oldWidth = $('.image-preview').width();
                var oldHeight = $('.image-preview').height();
                var wDest, hDest, ratio;
  
                if (oldWidth > oldHeight) {
                    ratio = oldWidth / 240;
                    wDest = Math.round(oldWidth / ratio);
                    hDest = Math.round(oldHeight / ratio);
                } else {
                    ratio = oldHeight / 320;
                    wDest = Math.round(oldWidth / ratio);
                    hDest = Math.round(oldHeight / ratio);
                }
    
                $('.image-preview').width(wDest);
                $('.image-preview').height(hDest);
            };
    
            reader.readAsDataURL(this.files[0]);
        }
    });
});