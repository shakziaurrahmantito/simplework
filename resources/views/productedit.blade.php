@extends("main.main")
@section("title","Customer List")
@section("content")


<div class="col-md-10">

    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">
          <h3>Update Product</h3>
          <hr>

          <form method="post" id="myForm">
            @csrf

            <div class="alert alert-success msg" style="display: none;"></div>

            <div class="form-row">

              <input type="hidden" class="form-control" value="{{$getSingleDataProduct->id}}" name="id">

              <div class="col-md-12 my-2">
                <input type="number" class="form-control" value="{{$getSingleDataProduct->code}}" placeholder="Product code" name="code">
                <small id="code_error" class="errror text-muted"></small>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-12 my-2">
                <input type="text" class="form-control" value="{{$getSingleDataProduct->name}}" placeholder="Product name" name="name">
                <small id="name_error" class="errror text-muted"></small>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-12 my-2">
                <input type="number" class="form-control" value="{{$getSingleDataProduct->rate}}" placeholder="Product rate" name="rate">
                <small id="rate_error" class="errror text-muted"></small>
              </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Update</button>

          </form>
      </div>
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
        url : "{{Route('productUpdate')}}",
        method: "post",
        data : new FormData(form),
        contentType : false,
        processData : false,
        beforeSend : function(){
          $(document).find(".errror").text("");
        },
        success: function(data){

          if (data.status == 0) {
            $.each(data.message, function(prefix, values){
              $("#"+prefix+"_error").text(values);
            })
          }else{
            window.location = "{{url('/productlist')}}";
          }
        }
      });

      return false;
      
    });




    
  

  </script>



  <!--JavaScript Plugin-->
  <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
    } );
  </script>


@endsection