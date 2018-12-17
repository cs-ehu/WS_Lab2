
$(document).ready(function(){
	
    	$("#imgAdd").change(function(){
        $('#muestraImg').empty();
    		var img = $('<img id="dynamic"/>');
        var $input = $(this);
        var inputFiles = this.files;
        if(inputFiles == undefined || inputFiles.length == 0) return;
        var inputFile = inputFiles[0];
        var reader = new FileReader();
        reader.onload = function (e) {
          img.attr('src', e.target.result);
          img.width(200);
        }
       reader.readAsDataURL(inputFile);
      img.appendTo('#muestraImg');
    	});

      $("#imgAddNick").change(function(){
        $('#muestraImgNick').empty();
        var img = $('<img id="dynamic"/>');
        var $input = $(this);
        var inputFiles = this.files;
        if(inputFiles == undefined || inputFiles.length == 0) return;
        var inputFile = inputFiles[0];
        var reader = new FileReader();
        reader.onload = function (e) {
          img.attr('src', e.target.result);
          img.width(200);
        }
       reader.readAsDataURL(inputFile);
      img.appendTo('#muestraImgNick');
      });


});
