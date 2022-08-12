@extends("main.main")
@section("title","Tree-category")
@section("content")


<div class="col-md-10">

    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">
          <h3>Tree-category</h3>
          <hr>

          <form method="post" id="myForm">
            @csrf

            <div class="alert alert-success msg" style="display: none;"></div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label font-weight-bold">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="unit_name" required="" disabled name="unit_name" placeholder="Enter name">
                <small id="name_error" class="errror text-muted"></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label font-weight-bold">Parent Category</label>
              <div class="col-sm-10">

                <select class="form-control" name="categoryid" id="categoryid">
                  <option value="">Select Parent Category</option>
                  @foreach($category as $data)
                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                  @endforeach
                </select>
                <small id="categoryid_error" class="errror text-muted"></small>

              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label font-weight-bold">Sub-category</label>
              <div class="col-sm-10">

                <select class="form-control" name="subcategoryid" id="subcategoryid">
                  <option value="">Select sub-category</option>
                </select>
                <small id="categoryid_error" class="errror text-muted"></small>
                
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label font-weight-bold">Ordering Nubmer</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="unit_name" required="" name="unit_name" disabled placeholder="Ordering Nubmer">
                <small id="name_error" class="errror text-muted"></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label font-weight-bold">Type</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="unit_name" required="" name="unit_name" disabled placeholder="Type">
                <small id="name_error" class="errror text-muted"></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label font-weight-bold">Banner(200x200)</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="unit_name" required="" name="unit_name" disabled placeholder="Banner(200x200)">
                <small id="name_error" class="errror text-muted"></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label font-weight-bold">Icon(32X32)</label>
              <div class="col-sm-10">
                <input type="text" disabled class="form-control" id="unit_name" required="" name="unit_name" placeholder="Icon(32X32)">
                <small id="name_error" class="errror text-muted"></small>
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

    $("#categoryid").change(function(){

        var categoryid = $("#categoryid").val();

        $.ajax({
        url : "{{url('/getsubcategorydata')}}",
        method: "get",
        data : {
            categoryid : categoryid
        },
        beforeSend : function(){
          $(document).find(".errror").text("");
        },
        success: function(data){
          $("#subcategoryid").html("");
          if (data.status == 0) {
            $("#subcategoryid").html("<option value=''>Select sub-category</option>");
            $.each(data.message, function(prefix, values){
              $("#subcategoryid").append("<option "+values.id+">"+values.name+"</option>");
            });

          }else{
            alert("Ops! something wrong");
          }
        }
      });

    });



    
    $("#myForm").submit(function(){

      var form = $("#myForm").get(0);

      /*$.ajax({
        url : "{{url('/link')}}",
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
      });*/

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