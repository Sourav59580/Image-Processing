<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
*:focus{
    box-shadow : none !important;
    outline : none !important;
}
</style>
</head>
<body>
<div class="container-fluid p-4 bg-light">
<div class="row main">
  <div class="col-md-3">
   <form>
   <h4>Create custom image</h4>
   <hr>
   <input type="number" id="width" placeholder="width" class="form-control mb-4" required="required">
   
    <input type="number" id="height" placeholder="height" class="form-control mb-4" required="required">
    
    <input type="color" id="color" class="form-control mb-4">
    
    <select id="format" class="form-control mb-4" required="required">
        <option>png</option>
        <option>jpeg</option>
        <option>gif</option>
    </select> 
    <button class="btn btn-primary generate-btn mb-4">Generate</button> 
  </form>
  <!-- image resize form -->
  <form id="resize-form">
       <h4>Resize image</h4>
       <hr>
       <input type="file" id="file-input" accept="image*/" name="file-input" class="form-control mb-4" >
       <input type="number" id="r-width" name="r-width" placeholder="width" class="form-control mb-4" required>
   
       <input type="number" id="r-height" name="r-height" placeholder="height" class="form-control mb-4" required>
    
       <button class="btn btn-primary resize-btn">Generate</button> 
    </form>
  </div>
  <div class="col-md-9 bg-white shadow-sm overflow-auto text-center"> 
    <div id="result" class="mt-5"></div>
    <div id="resize_img" class="mt-5"></div>
  </div>
</div>
</div>


<script>
$(document).ready(function(){
    $("#file-input").on("change",function(){
      var file = this.files[0];
      var url = URL.createObjectURL(file);
      var img = document.createElement("img");
      img.src = url;
      $("#result").html(img);
      img.onload = function(){   
       var o_width = img.width;
       var o_height = img.height;
       $("#r-width").on("input",function(){
           var type_width = Number(this.value);
           var rec_height = Math.floor((type_width/o_width)*o_height);
           $("#r-height").val(rec_height);
           img.width = type_width;
           img.height = rec_height;
       });
       $("#r-height").on("input",function(){
        var type_height = this.value;
        img.height = type_height;
       });
      }

     $("#resize-form").submit(function(e){
         e.preventDefault();
         var c_width = $("#r-width").val();
         var c_height = $("#r-height").val();
         $.ajax({
            type : "POST",
            url : "php/resize.php",
            data : new FormData(this),
            processData : false,
            contentType : false,
            cache : false,
            success : function(response){
             
             var link = "images/"+response.trim();;
             var a = document.createElement("A");
             a.href = link;
             a.download = response; 
             a.innerHTML="Download now"
             a.className = "btn btn-danger px-2 py-2";
             $("#result").append(a);
            } 
         });
     });




    });
});


</script>

<script>
$(document).ready(function(){
    $(".main").css({
        height : $(window).height()-50
    });
    $(window).resize(function(){
        $(".main").css({
        height : $(window).height()-50
    });
    })
    $(".generate-btn").click(function(e){
    e.preventDefault();
    var width = $("#width").val();
    var height = $("#height").val();
    var color = $("#color").val();
    var format = $("#format").val();
    var a = color[1]+color[2];
    var b = color[3]+color[4];
    var c = color[5]+color[6];
    
    var r = parseInt(a,16);
    var g = parseInt(b,16);
    var b = parseInt(c,16);
    //alert(r+","+g+","+b);
    $.ajax({
        type : "POST",
        url : "php/image.php",
        data : {
            width : width,
            height : height,
            red : r,
            green : g,
            blue : b,
            format : format
        },
        success : function(response){
            $("#result").html("");
            var name = response;
            var img = document.createElement("img");
            img.src="images/"+name;
            img.style.width="80%";
            img.style.marginLeft="10%";
            img.style.marginRight="10%";
            $("#result").append(img);

            var a = document.createElement("a");
            a.href = "images/"+name;
            a.download = name;
            a.innerHTML = "Download now";
            a.className = "btn btn-danger py-2 my-5";
            $("#result").append(a);
        }
    });




    });
});


</script>













</body>
</html>