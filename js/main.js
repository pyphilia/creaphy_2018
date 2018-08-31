
// init lightgallery
$("div").filter(function(){
  return this.id.match(/lightgallery[0-9]/);
}).each(function(){

  lightGallery(this);
})


var w = window.innerWidth;
var h = window.innerHeight;

$(document).ready(function(){


  $("#intro img").animate({opacity:1}, 800,function() {})
  $("#header").animate({marginLeft:0}, 800,function() {})


  function gallerySetUp() {

    $(".thumbnails").each(function(){
      $images = $(this).find("a img");
      $imgMargin = parseFloat($images.first().css("marginLeft"));

      $nbImage = $images.length;
      $contentW = $(".row .col-md-12 #lightgallery").width() - $nbImage*2*$imgMargin;

      // set images width
      $imgW = Math.floor($contentW/$nbImage);
      $images.each(function(i){
        $(this).css("width",$imgW)
      })

    })
  }


  // gallerySetUp();

  function categoryAnimation(id, className) {

    if(className == "right") {
      $marginRight = "-40px";
      $marginLeft = "-10px";
      $marginTop = "-25px";
    }
    else {
      $marginRight = "-20px";
      $marginLeft = "-40px";
      $marginTop = "-55px";
    }

    $id = "#"+id+" ";
    $($id + "h3 span").animate({opacity:1}, 800, function(){});
    $($id + "h3").animate({
      marginLeft:$marginLeft,
      marginRight: $marginRight,
      marginTop:$marginTop,
    },800,function(){
      // $(".category").fadeIn("slow",function(){
      // })
    })

    $($id + ".category img").animate({opacity:1}, 800, function(){});
    $($id + ".category span").animate({opacity:1},1500, function(){
      // $(".element1").fadeIn()
    });
  }




 // init waypoint
  $offset = 500;

  $wp =   $('div')
  .filter(function() {
    return this.id.match(/waypoint[0-9]/);
  }).each(function(){
    new Waypoint({
      element: this,
      handler: function() {

        categoryAnimation(this.element.id, this.element.className)
      },
      offset: $offset
    })
  })




});
