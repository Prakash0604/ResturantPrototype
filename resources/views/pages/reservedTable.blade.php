@extends('index')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-secondary btn-lg bg-gray-100 text-dark" data-bs-toggle="modal"
            data-bs-target="#modalId">
                <i class="bi bi-plus-lg"></i>
                Add Table
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="addTable" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Add Table
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="mb-3">
                                        @csrf
                                        <label for="" class="form-label">Table Number</label>
                                        <input type="name" name="table_number" class="form-control"
                                            placeholder="Enter the table number" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Seat Capaicty</label>
                                        <input type="number" name="seat_capicity" class="form-control"
                                            placeholder="Enter the rate " />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Status</label>
                                        <select
                                            class="form-select form-select-lg"
                                            name="status"
                                            id=""
                                        >
                                            <option selected>Select one</option>
                                            <option  selected  value="Available">Available</option>
                                            <option value="Occupied">Occupied</option>
                                            <option value="Reserved">Reserved</option>
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
                <div class="card-header pb-0">
                    <h6>Menu Item</h6>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-bordered">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        S.N
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Table Number</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Seat Capicity
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n=1;
                                @endphp
                                @foreach ($tabledatas as $data)
                                    <tr>
                                        <td>{{ $n }}</td>
                                        <td>{{ $data->table_number }}</td>
                                        <td>{{ $data->seat_capicity }}</td>
                                        <td>
                                            @if ($data->status=='Available')
                                            <span class="badge badge-pill bg-success">{{ $data->status }}</span>
                                            @elseif($data->status=='Occupied')
                                            <span class="badge badge-pill bg-warning">{{ $data->status }}</span>
                                            @else
                                                <span class="badge badge-pill bg-danger">{{ $data->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a  class="btn btn-primary" >Edit</a>
                                            <a   class="btn btn-danger deleteTable" data-id="{{ $data->id }}" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">Delete</a>
                                        </td>
                                    </tr>
                                    @php
                                        $n=$n+1;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteTableData" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                      Delete Table
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <h4 class="text-danger">Are you sure you want to delete ?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="btndelete">Confirm Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#addTable").submit(function(event){
            event.preventDefault();
            $("#btnsave").text("Saving...");
            $("#btnsave").prop("disabled",true);
            let formdata=new FormData(this);
            $.ajax({
                method:"POST",
                url:"table/add",
                data:formdata,
                processData:false,
                contentType:false,
                success:function(data){
                    console.log(data);
                    if(data.success==true){
                        Swal.fire({
                            icon:"success",
                            title:"Table Saved successfully",
                            showConfirmButton:false,
                            timer:1500
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }else{
                        Swal.fire({
                            icon:"warning",
                            title:"Something went wrong ?",
                            showConfirmButton:false,
                            timer:1500
                        });
                        $("#btnsave").text("Save");
                        $("#btnsave").prop("disabled",false);
                    }

                }
            })
        });

        // Delete Table
        $(document).on('click','.deleteTable',function(){
            let id=$(this).attr("data-id");
            console.log(id);
            $("#deleteTableData").submit(function(event){
                event.preventDefault();
                $("#btndelete").text("Deleting...");
                $("#btndelete").prop("disabled",true);
                $.ajax({
                    method:"get",
                    url:"table/delete/"+id,
                    success:function(data){
                        console.log(data);
                        if(data.success==true){
                            Swal.fire({
                                icon:"success",
                                title:data.message,
                                showConfirmButton:false,
                                timer:1500
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        }
                        if(data.success==false){
                            Swal.fire({
                                icon:"warning",
                                title:data.message,
                                showConfirmButton:false,
                                timer:1500
                            });
                            $("#btndelete").text("Confirm Delete");
                            $("#btndelete").prop("disabled",false);
                        }
                    }
                })
            })
        })
    })
</script>

@endsection
