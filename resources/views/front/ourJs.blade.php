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

});








</script>