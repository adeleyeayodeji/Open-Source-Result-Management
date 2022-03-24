/**
* main proccess function
*/
function proccess(file){
  $(".result").html("");
  
  //Preview Image
  var src = (window.URL ? URL : webkitURL).createObjectURL(file);
  $("#image").attr("src", src);
  
  //Proccess Image
  Tesseract.recognize(file)
  .progress(function(data){
    console.log(data);
    progress(data);
  })
  .then(function(data){
    console.log(data);
    result(data)
  })
  
}

/**
* progress function
*/
function progress(packet){
  var r = $(".result");
  
  if(r.length > 0 && r.find(".status").last().html() == packet.status){
    if('progress' in packet) {
      r.find("progress").last().val(packet.progress);
    }
    
  } else {    
    var tStatus = "<div class='status ten wide column'>" + packet.status +"</div>";
    var tProgress = "<div class='six wide column'>" + (typeof packet.progress == "undefined" ? "" : ("<progress value='" + packet.progress + "' max='1'>")) +"</div>";
                                                                                                      
    r.append(tStatus + tProgress);
  }
}

/**
* reporting function
*/
function result(data){
  var r = $(".result");
  //r.html("");
  r.append(
    "<div class='sixteen wide column output'>success" +
    "<div class='ui message'><pre>" + data.text +"</pre></div>" + 
    "</div>"
  );
  
}