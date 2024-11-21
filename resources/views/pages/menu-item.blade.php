@extends('index')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <h1 class="text-center ">Menus Items</h1>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-success btn-lg bg-gray-100 mt-3 mb-3" data-bs-toggle="modal"
                data-bs-target="#modalId">
                    <i class="bi bi-plus-lg"></i>
                    Add Item
                </button>
                <a href="{{ url('/admin/category/list') }}" class="btn btn-secondary btn-lg bg-gray-100  mt-3 mb-3">

                    View Category

                    <i class="bi bi-arrow-right-circle-fill"></i>
                </a>

                <!-- Modal -->
                <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="add_item" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Add Items
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="mb-3">
                                            @csrf
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter Item name" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Images</label>
                                            <input type="file" name="images" class="form-control" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <input type="text" name="description" class="form-control"
                                                placeholder="Rich chocolate cake" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Price</label>
                                            <input type="number" name="price" class="form-control"
                                                placeholder="Enter the rate " />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Category</label>
                                            <select class="form-select form-select-lg" name="category">
                                                <option selected>Select one</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="btnsave">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Menu Item</h6>
                    </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-striped mb-0 table-bordered" id="fetch-menu-item-detail">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            S.N
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Image
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category</th>
                                        <th class="text-secondary opacity-7">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ===============================Edit Modal Start ==================================== --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateItem" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Edit Item
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="mb-3">
                                @csrf
                                <input type="hidden" name="id" id="item_id">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="edit_name" id="edit_name" class="form-control"
                                    placeholder="Enter Item name" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Images</label>
                                <input type="file" name="edit_images" id="edit_images" class="form-control" />
                                <div id="image">

                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea name="edit_description" id="edit_description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="number" name="edit_price" id="edit_price" class="form-control"
                                    placeholder="Enter the rate " />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <select class="form-select form-select-lg" id="edit_category" name="edit_category">
                                    <option selected>Select one</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnupdate">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===============================Edit Modal End ==================================== --}}

  </div>
  <!--Delete Modal-->
    <script>
        $(document).ready(function() {

            // DataTable
           var table= $("#fetch-menu-item-detail").DataTable({
                serverSide:true,
                processing:true,
                ajax:"{{ route('admin.menu_item') }}",
                columns:[
                    {
                        data:"DT_RowIndex", name:"DT_RowIndex"
                    },{
                        data:"image", name:"image"
                    },{
                        data:"name",name:"name"
                    },{
                        data:"description",name:"description"
                    },{
                        data:"price", name:"price"
                    },{
                        data:"category", name:"category"
                    },
                    {
                        data:"action", name:"action"
                    }
                ]
            })



            $("#add_item").submit(function(e) {
                e.preventDefault();
                $("#btnsave").text("Saving...");
                $("#btnsave").prop("disabled", true);
                var formdata = new FormData(this);
                // var formdata=$(this).serialize();
                console.log(formdata);
                $.ajax({
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/add/item') }}",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Saved Successfully",
                                showconfirmButton: false,
                                timer: 1500,
                            });
                           table.draw();
                           $("#modalId").modal("hide");
                           $("#add_item")[0].reset();
                        }
                        if (data.success == false) {
                            Swal.fire({
                                icon: "error",
                                title: data.message,
                                // showConfirmButton: false,

                            });

                            $("#add_item")[0].reset();
                            $("#btnsave").prop("disabled", false);
                            $("#btnsave").text("Save");
                        }
                    }
                })
            });

            $(document).on("click", ".editMenu", function(e) {
                var id = $(this).attr("data-id");
                $.ajax({
                    method: "get",
                    url: "{{ url('admin/edit/item') }}/" + id,
                    success: function(data) {
                        console.log(data);
                        $("#edit_name").val(data.message.name);
                        $("#edit_description").val(data.message.description);
                        $("#edit_price").val(data.message.price);
                        $("#edit_category").val(data.message.category_id);
                        $("#image").html(`
                            <img src="{{ asset('storage/food/') }}/${data.message.images}"alt="" width="100" height="100">
                        `);
                        $("#item_id").val(data.message.id);
                    }
                });
            });

            $("#updateItem").submit(function(e) {
                e.preventDefault();
                $("#btnupdate").text("Updating...");
                $("#btnupdate").prop("disabled", true);
                var formdata=new FormData(this);
                $.ajax({
                    method:"POST",
                    url:"{{ url('admin/edit/item') }}",
                    data:formdata,
                    processData:false,
                    contentType:false,
                    success:function(data){
                        console.log(data);
                        if(data.success==true){
                            Swal.fire({
                                icon:"success",
                                title:"Menu Updated Successfully",
                                showconfirmButton:false,
                                timer:1500,
                            });
                            $("input[type='text']").val("");
                            $("input[type='file']").val("");
                            $("input[type='textarea']").val("");
                            table.draw();
                            $("#editModal").modal("hide");
                        }
                        if(data.success==false){
                            Swal.fire({
                                icon:"warning",
                                title:data.message,
                                showConfirmButton:false,
                                timer:1500,
                            });
                            $("#updatebtn").prop("disabled",false);
                            $("#updatebtn").text("Update");
                        }
                    }
                })

            });
            $(document).on("click",".deleteMenu",function(){
                    var id=$(this).attr("data-id");
                    console.log(id);
                    // let input=$("#catid").val(id);
                    // console.log(input);
                    Swal.fire({
                        icon:"warning",
                        title:"Are you Sure ?",
                        text:"You won't be able to revert this !",
                        showCancelButton:true,
                        confirmButtonColor:"#3085d6",
                        confirmButtonText:"Yes,Delete it !",
                        cancelButtonColor:"#d33"
                    }).then((result)=>{
                        if(result.isConfirmed){
                            $.ajax({
                            method:"get",
                            url:"/admin/item/delete/"+id,
                            success:function(data){
                                // console.log(data);
                                if(data.success==true){
                                    Swal.fire({
                                        icon:"success",
                                        title:"Menu deleted",
                                        showConfirmButton:false,
                                        timer:1500,
                                    });
                                   table.draw();
                                }
                                if(data.success==false){
                                    Swal.fire({
                                        icon:"error",
                                        title:"Unable to delete ",
                                        text:"Alredy tagged in another menu",
                                        showConfirmButton:false,
                                        timer:1500
                                    });
                                    $(".btnDeleteConfirm").prop("disabled",false);
                                     $(".btnDeleteConfirm").text("Confirm Delete");
                                }
                            },
                            error:function(xhr){
                                console.log(xhr);

                            }
                        });
                        }
                    })
                })
        });
    </script>
@endsection
