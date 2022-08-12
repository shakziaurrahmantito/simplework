@extends("main.main")
@section("title","Customer List")
@section("content")


<div class="col-md-10">

    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">
          <h3>Input Form</h3>
          <hr>

<!-- <form>       
  <div class="form-row">
    <div class="form-group col-md-2">
      <input type="text" class="form-control" name="find" placeholder="Bill No">
    </div>
    <div class="form-group col-md-2">
      <button type="button" class="btn btn-primary">Find</button>
    </div>
  </div> 
</form>

<hr> -->

<form method="post" id="myForm">
     @csrf
  <div class="form-row">

    <div class="form-group col-md-4">

      <select class="form-control" id="addProduct" required name="addProduct">

        <option value="">Add Product or Items</option>

          @foreach($getProducts as $data)

          <option value="{{$data['id']}}">{{$data['name']}}</option>

          @endforeach

      </select>

    </div>

    <div class="form-group col-md-4">
      <select class="form-control" required name="customerId">
        <option value="">Select a customer</option>
          @foreach($getCustomers as $data)
          <option value="{{$data['id']}}">{{$data['name']}}</option>
          @endforeach
      </select>
    </div>

    <div class="form-group col-md-4">
      <input type="date" class="form-control" required name="date">
    </div>

  </div>

    <table class="table">
      <thead>
        <tr>
          <th width="30%">Product Name</th>
          <th width="10%">Rate</th>
          <th width="10%">Qty</th>
          <th width="15%">Total Amount</th>
          <th width="10%">Discount(AMT)</th>
          <th width="25%">Net Amout</th>
        </tr>
      </thead>

      <tbody>





        
        

      </tbody>

      <tfoot>
        <tr>
          <td colspan="6">
            <hr>
          </td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <th align="right">Net Total</th>
          <td><input type="number" class="form-control" readonly id="netTotal" name="totalBillAmount"></td>
        </tr>

        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <th align="right">Discount Total</th>
          <td><input type="number" class="form-control" readonly id="discountTotal" name="totalDiscount"></td>
        </tr>

        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <th align="right">Paid Amount</th>
          <td><input type="number" value="0" min="1" class="form-control" id="paidAmount" onchange="cal()" name="paidAmount"></td>
        </tr>

        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <th align="right">Due Amount</th>
          <td><input type="number" onchange="cal()" class="form-control dueAmount" id="dueAmount" name="dueAmount" readonly></td>
        </tr>

      </tfoot>


    </table>

    <hr>
    <button type="submit" class="btn btn-primary float-right">Save Change</button>
  </form>


        
        </div>

      </div>
    </div>

      </div>
    </div>
  </section>



  <script type="text/javascript">




    $("#myForm").submit(function(){

      var form = $("#myForm").get(0);

      $.ajax({
        url : "{{Route('inventorieInsert')}}",
        method: "post",
        data : new FormData(form),
        contentType : false,
        processData : false,
        beforeSend : function(){
          $(document).find(".errror").text("");
        },
        success: function(data){
          if (data.status == 0) {
            alert("Data inserted successfully!");
            window.location = "{{url('/addInventories')}}";
          }
        }
      });

      return false;
      
    });






  
      function singleRowCal(id){
        var rate = $("#rate_"+id).text();
        var qty = $("#qty_"+id).val();
        $("#totalAmount_"+id).text(rate*qty);

        var totalAmount = $("#totalAmount_"+id).text();
        var discount = $("#discount_"+id).val();
        $("#netmsg_"+id).text(totalAmount-discount);

        var totalDiscount = 0;
        $(".discountAmount").each(function(data){
          totalDiscount += parseInt($(this).val());
        });
        $("#discountTotal").val(totalDiscount);


        var totalNet = 0;
        $(".netAmount").each(function(data){
          totalNet += parseInt($(this).text());
        });

        $("#netTotal").val(totalNet);
        $(".dueAmount").val(totalNet-totalDiscount);

  
         cal();
      }


      function cal(){

        var totalDiscount = 0;
        $(".discountAmount").each(function(data){
          totalDiscount += parseInt($(this).val());
        });

        var totalNet = 0;
        $(".netAmount").each(function(data){
          totalNet += parseInt($(this).text());
        });

        $(".dueAmount").val(totalNet-totalDiscount);

        var paidAmount = $("#paidAmount").val();
        var dueAmount = $("#dueAmount").val();

        $("#dueAmount").val(dueAmount-paidAmount);
      }




    $("#addProduct").change(function(){

      var productId = $("#addProduct").val();

      $.ajax({
        url : "{{url('/getProduct')}}",
        data : {
          productId : productId
        },
        success : function(data){

          var exists = $(document).find("#rate_"+data.product.id).length;

          if (exists == 0) {
            $("tbody").append('<tr><td>'+data.product.name+'</td><td id="rate_'+data.product.id+'">'+data.product.rate+'</td><td><input type="hidden" value="'+data.product.id+'" name="productId[]"><input type="hidden" value="'+data.product.rate+'" name="rate[]"><input type="number" min="1" onchange="singleRowCal('+data.product.id+')" class="form-control" id="qty_'+data.product.id+'" name="qty[]" value="1"></td><td id="totalAmount_'+data.product.id+'"></td><td><input type="number" min="0" onchange="singleRowCal('+data.product.id+')" class="form-control discountAmount" name="discount[]" id="discount_'+data.product.id+'" value="0"></td><td id="netmsg_'+data.product.id+'" class="netAmount"></td></tr>');
            singleRowCal(data.product.id);
          }else{
            alert("This item already added!");
          }
          

          

          



          
        }

      });


    });


    


    /*function calculation(qty , price, show){
        var order_qty1    = $("#order_qty"+qty).val();
        var order_price1  = $("#order_price"+price).val();
        $("#addTotal"+show).html(order_qty1*order_price1);

        var total = 0;

        $(".perTotal").each(function(){

          total += parseInt($(this).text());

        });

        $("#total").text(total);

    }



    $("#addProduct").click(function(){
        var count = $(".count").length;

          $("tbody").append();

      });




      $('tbody').on('click', '.btnRemove', function() {
          $(this).parent().parent().remove();
      });*/

    
      


      


  </script>



  <!--JavaScript Plugin-->
  <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
    } );
  </script>


@endsection