@extends('index')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-secondary btn-lg bg-gray-100 text-dark" data-bs-toggle="modal"
                    data-bs-target="#modalId">
                    <i class="bi bi-plus-lg"></i>
                    Add Item
                </button>
                <!-- Modal -->
                {{-- ======================Add Event  Modal Start======================================= --}}

                <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="add_event" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Add event
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="mb-3">
                                            @csrf
                                            <label for="" class="form-label">Event Name</label>
                                            <input type="text" name="event_name" class="form-control"
                                                placeholder="Birthday party" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Images</label>
                                            <input type="file" name="event_images" class="form-control" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <textarea name="event_description" id="event_description" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Price</label>
                                            <input type="number" name="event_price" class="form-control"
                                                placeholder="Enter the rate " />
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

                {{-- ======================Add Event  Modal End======================================= --}}


                {{-- ======================List Event  Table======================================= --}}

                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Event Lists</h6>
                        <p class="text-danger">Note:Only 4 event are allowded to show in your website</p>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Image
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Event name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-secondary opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($events as $event)
                                        <tr>


                                            <td class="align-middle text-center text-sm">
                                                <div>
                                                    @if ($event->event_image != '')
                                                        <img src="{{ asset('storage/event/' . $event->event_image) }}"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                    @else
                                                        <img src="{{ asset('default/user.png') }}"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <h6>
                                                    {{ $event->event_name }}
                                                </h6>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <h6>{{ \Illuminate\Support\Str::limit($event->event_desc, 60, $end = '...') }}
                                                </h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <h6>Rs.{{ $event->event_price }}</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-dark badge badge-pill bg-gradient-{{ $event->status ? 'success' : 'danger' }} font-weight-bold">{{ $event->status ? 'Show' : 'Hide' }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a class="btn btn-primary editEvent" data-id="{{ $event->id }}"
                                                    data-bs-toggle="modal" data-bs-target="#editEvent">Edit</a>
                                                <a class="btn btn-danger deleteEvent" data-id="{{ $event->id }}"
                                                    data-bs-toggle="modal" data-bs-target="#deleteevent">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- ======================List Event  Table======================================= --}}

            </div>
        </div>
    </div>


    {{-- ======================Edit Event Modal Activate======================================= --}}
    <div class="modal fade" id="editEvent" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateEvent" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Edit event
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="mb-3">
                                @csrf
                                <label for="" class="form-label">Event Name</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="edit_event_name" id="edit_event_name" class="form-control"
                                    placeholder="Birthday party" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Images</label>
                                <input type="file" name="edit_event_images" id="edit_event_images"
                                    class="form-control" />
                                <div id="image">

                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea name="edit_event_description" id="edit_event_description" class="form-control" cols="30"
                                    rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="number" name="edit_event_price" id="edit_event_price" class="form-control"
                                    placeholder="Enter the rate " />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                                <select class="form-select form-select-lg" name="edit_status" id="edit_status">
                                    <option value="1">Show</option>
                                    <option value="0">Hide</option>
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
    {{-- ======================Edit Event Modal Activate======================================= --}}

   {{-- ======================Delete Event  Modal Start======================================= --}}

    <div class="modal fade" id="deleteevent" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="EventDelete" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Delete event
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <h5>Are your sure your want to delete ?</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger" id="btndelete">Confirm Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

       {{-- ======================Delete Event  Modal Stop======================================= --}}

    <script>
        $(document).ready(function() {
            // Event Add Function start
            $("#add_event").submit(function(e) {
                e.preventDefault();
                $("#btnsave").prop("disabled", true);
                $("#btnsave").text("Saving...");
                var formdata = new FormData(this);
                $.ajax({
                    method: "post",
                    url: "{{ url('admin/event/add') }}",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Event Added Successfully",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            $("#btnsave").prop("disabled", false);
                            $("#btnsave").text("Save");
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                            $("input[type='text']").val("");
                            $("input[type='file']").val("");
                            $("input[type='number']").val("");
                        }
                        if (data.success == false) {
                            Swal.fire({
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500,

                            });
                            $("#btnsave").prop("disabled", false);
                            $("#btnsave").text("Save");
                        }
                    }
                });
            });
            // Event Add Function End

            // ===============Event Edit Function Start ============

            $(document).on("click", '.editEvent', function() {
                var id = $(this).attr("data-id");
                console.log(id);
                $.ajax({
                    method: "get",
                    url: "{{ url('admin/event/edit') }}/" + id,
                    success: function(data) {
                        console.log(data);
                        $("#id").val(data.message.id);
                        $("#edit_event_name").val(data.message.event_name);
                        $("#edit_event_description").val(data.message.event_desc);
                        $("#edit_event_price").val(data.message.event_price);
                        $("#edit_status").val(data.message.status);
                        $("#image").html(` <img src="{{ asset('storage/event/') }}/` + data
                            .message.event_image +
                            `" class="rounded mt-2" alt=""  width="100" height="100" >`);
                    }
                });
            });
            // ===============Event Edit Function End ==============


            // ===============Event Update Function start ==============
            $("#updateEvent").submit(function(e) {
                e.preventDefault();
                $("#btnupdate").text("Updating...");
                $("#btnupdate").prop("disabled", true);
                var formdata = new FormData(this);
                $.ajax({
                    method: "POST",
                    url: "{{ url('admin/event/edit') }}",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Event Updated",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);

                        }
                        if (data.success == false) {
                            Swal.fire({
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500,

                            });
                            $("#btnupdate").prop("disabled", false);
                            $("#btnupdate").text("Update");
                        }
                    }
                })
            });
            // ===============Event Update Function End ==============



            // ===============Event Delete Function Start ==============
            $(document).on("click", ".deleteEvent", function() {
                var id = $(this).attr('data-id');
                console.log(id);
                $("#EventDelete").submit(function(e) {
                    e.preventDefault();
                    // console.log("click on confirm delete");
                    $("#btndelete").prop("disabled", true);
                    $("#btndelete").text("Deleting...");
                    $.ajax({
                        method: "get",
                        url: "{{ url('admin/event/delete') }}/" + id,
                        success: function(data) {
                            // console.log(data);
                            if (data.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Event has been deleted.",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }
                            if (data.success == false) {
                                Swal.fire({
                                    icon: "error",
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#btndelete").prop("disabled", false);
                                $("#btndelete").text("Confirm Delete");
                            }
                        }
                    });
                });
            });



            // ===============Event Delete Function End ==============
        });
    </script>
@endsection
