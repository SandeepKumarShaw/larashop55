$(function(){

// slick carousel
    $('.slider').slick({
        dots: false,
        vertical: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        verticalSwiping: true,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        infinite: true,
    });
});
//change thumnails
$(".prodthumb img").click(function(){
    var images = $(this).attr('src');
    // Change src attribute of image
    $('.bigpro_img').attr("src", images);
});
//Product Zoom
$(".bigpro_img").imagezoomsl();

// scroll to review
$(".scrollTo").on('click', function(e) {
 e.preventDefault();
 var target = $(this).attr('href');
 $('html, body').animate({
   scrollTop: ($(target).offset().top)
 }, 2000);
}); 
//Add to Cart On Product details page
$("#CartMsg").hide();
$('.add_to_cart_details').click(function(){
var id = $(this).data("id");
var url = $(this).data("url");

var qty = $(".qty-fill-details").val();
if(qty > 0){
    $.ajax({
          type:"get",
          data:"id=" + id + "&qty=" + qty,
          url:url + "/" + id,
          success:function(response){
            $("#CartMsg").show();
            console.log(response);
            $("#CartMsg").html(response.carMsg);                      
            setTimeout(function() {
                $('#CartMsg').fadeOut('fast');
            }, 2000);

            $('.cartCount').html(response.cartCount);

          }
    });

}else{
    alert('Please enter valid Quantity!')
}
});