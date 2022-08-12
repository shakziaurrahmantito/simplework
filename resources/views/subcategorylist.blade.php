@extends("main.main")
@section("title","Sub-category List")
@section("content")


<div class="col-md-10">
    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">
        <h3>Sub-category List</h3>
        <hr>
        <table id="example" class="display text-center" width="100%">
            <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                $i = 1;
              @endphp
              @foreach($subcategory as $data)

              <tr>
                <td>{{$i++}}</td>
                <td>{{$data['name']}}</td>
                <td>{{$data->category['name']}}</td>
                <td>

                  <a href="">
                    <button disabled class="btn btn-primary"><i class="fa fa-edit"></i></button>
                  </a>
                  <a onclick="return confirm('Are you sure delete?')" href=
                  "">
                    <button disabled class="btn btn-danger"><i class="fa fa-trash"></i></button>
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


  




    
  

  </script>



  <!--JavaScript Plugin-->
  <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
    } );
  </script>


@endsection