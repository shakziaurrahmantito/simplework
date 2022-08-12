@extends("main.main")
@section("title","Customer List")
@section("content")


<div class="col-md-10">
    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">
        <h3>Customer List</h3>
        <hr>
        <table id="example" class="display text-center" width="100%">
            <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                $i = 1;
              @endphp
              @foreach($getcustomer as $data)

              <tr>
                <td>{{$i++}}</td>
                <td>{{$data['name']}}</td>
                <td>{{$data['phone']}}</td>
                <td>{{$data['address']}}</td>
                <td>

                  <a href="cusEdit/{{$data['id']}}">
                    <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
                  </a>
                  <a onclick="return confirm('Are you sure delete?')" href=
                  "cusDel/{{$data['id']}}">
                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>


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
        url : "{{Route('custmoerInsert')}}",
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