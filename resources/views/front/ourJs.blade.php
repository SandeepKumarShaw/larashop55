<script>
$(document).ready(function(){
      $("#CartMsg").hide();

  $("#findBtn").click(function(){
    var cat = $("#catID").val();
    var price = $('#priceID').val(); 
    if(price == ""){
    	price = 0;
    }   
    //alert(price);
    $.ajax({
      type: 'get',
      dataType: 'html',
      url: '{{url('/productsCat')}}',
      data: 'cat_id=' + cat + '&price=' + price,
      success:function(response){
        console.log(response);
        $("#productsData").html(response);
      }
    });
  });
  //Add to Cart
  $('.add_to_cart').click(function(e){
    e.preventDefault();
    var oldUrl = $(this).attr("href");
    var id = $(this).data("id");
          $.ajax({
              type:'get',
              data:'id=' + id,
              url:oldUrl,
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
  });
});
</script>