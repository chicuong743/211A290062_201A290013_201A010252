$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
 //delete
        function removeRow(product_id,url){
            if(confirm('Bạn có chắc chắn xóa sản phẩm này không?')){
                  $.ajax({
                  url: url,
                  data: {product_id},
                  method: 'GET',
                  dataType:'JSON',
                  success: function (res){
                    if(res.success==true){
                        location.reload();
                    }
                  }
              }
              )
            }
        }
