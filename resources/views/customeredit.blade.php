@extends("main.main")
@section("title","Customer List")
@section("content")


<div class="col-md-10">

    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">
          <h3>Update Customer</h3>
          <hr>

          <form method="post" id="myForm">
            @csrf

            <div class="alert alert-success msg" style="display: none;"></div>

            <div class="form-row">
              <input type="hidden" class="form-control" value="{{$getSingleData->id}}" name="id">
              <div class="col-md-12 my-2">
                <input type="text" class="form-control" value="{{$getSingleData->name}}" placeholder="Customer name" name="name">
                <small id="name_error" class="errror text-muted"></small>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-12 my-2">
                <input type="number" class="form-control" value="{{$getSingleData->phone}}" placeholder="Customer phone" name="phone">
                <small id="phone_error" class="errror text-muted"></small>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-12 my-2">
                <input type="text" class="form-control" value="{{$getSingleData->address}}" placeholder="Customer address" name="address">
                <small id="address_error" class="errror text-muted"></small>
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
        url : "{{Route('customerUpdate')}}",
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
            window.location = "{{url('/customerlist')}}";
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