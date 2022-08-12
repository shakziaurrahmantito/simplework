@extends("main.main")
@section("title","Sub-category name")
@section("content")


<div class="col-md-10">

    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">
          <h3>Add sub-category</h3>
          <hr>

          <form method="post" id="myForm">
            @csrf

            <div class="alert alert-success msg" style="display: none;"></div>

            <div class="form-row">
              <div class="col-md-12 my-2">
                <input type="text" class="form-control" placeholder="Sub category name" name="name">
                <small id="name_error" class="errror text-muted"></small>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-12 my-2">
                <select class="form-control" name="categoryid">
                  <option value="">Select Category</option>
                  @foreach($category as $data)
                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                  @endforeach
                </select>
                <small id="categoryid_error" class="errror text-muted"></small>
              </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Save</button>

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
        url : "{{url('/insertsubCategory')}}",
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
            $("#myForm")[0].reset();
            $(".msg").css("display","block");
            $(".msg").text(data.message);
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