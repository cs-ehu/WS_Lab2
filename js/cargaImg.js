
$(document).ready(function(){

	
    	$("#imgAdd").change(function(){
    		
    		 var input = this;
    		var url = $(this).val();

    		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
     {
        var reader = new FileReader();

        reader.onload = function (e) {
           $('#img').attr('src', e.target.result);
           $('#img').width(200);
        }
       reader.readAsDataURL(input.files[0]);
    }
    else
    {
      $('#img').attr('src', '/assets/no_preview.png');
      $('#img').width(200);
      $('#img').css("float","left");
      $('#img').css("position","relative");
    }
    	});

});
