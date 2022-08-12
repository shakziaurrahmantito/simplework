<section class="container-fluid">
  <div class="row">
    <div class="col-md-2 bg-dark" style="min-height: 550px;">
      <div id="accordian">
        <ul class="list-unstyled side-menu my-3">
                
              <li class="p-1"><a href="#select-1" data-toggle="collapse"><i class="fa fa-user"></i>Setup</a>
                  <ul class="collapse <?php 

                  if(Request::path() == "/" || Request::path() == "listCategory" || Request::path() == "addsubCategory"|| Request::path() == "listsubCategory"|| Request::path() == "treecategory"){
                    echo "show";
                  }

                ?> list-unstyled ml-4" id="select-1" data-parent="#accordian">
                    <li><a href="{{url('/')}}">Add Category</a></li>
                    <li><a href="{{url('/listCategory')}}">Category List</a></li>
                    <li><a href="{{url('/addsubCategory')}}">Add Sub-category</a></li>
                    <li><a href="{{url('/listsubCategory')}}">List Sub-category</a></li>
                    <li><a href="{{url('/treecategory')}}">Tree-Category</a></li>
                  </ul>
              </li>


            

             


        </ul>
      </div>
  </div>