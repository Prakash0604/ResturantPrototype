@extends('index')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Users table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">S.N</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Transaction ID</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order Item</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order Date</th>
                      <th class="text-secondary opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $n=1;
                    @endphp
                    @forelse ($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">{{ $n }}</h6>
                                </div>
                              </div>
                        </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->transaction_id }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $user->user->name }}</p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->menu ? $user->menu->name : 'No menu available' }}</h6>
                            <p class="text-xs text-secondary mb-0">Rs.{{ $user->total_amount }}</p>
                          </div>
                      </td>

                      <td class="align-middle text-center text-sm">
                        @if ($user->status==1)
                        <span class="badge badge-sm bg-gradient-success">
                            Completed
                        </span>
                        @else
                        <span class="badge badge-sm bg-gradient-danger">
                            Pending
                        </span>
                        @endif
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                      </td>
                      @if ($user->status!=1)
                      <td class="align-middle">
                        <a href="javascript:;" class="btn btn-secondary orderId" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#modalId">
                          Update Status
                        </a>
                      </td>
                      @else
                      <td>
                          <p class="text-bold">Order Complete</p>
                      </td>
                      @endif
                    </tr>
                    @php
                        $n=$n+1;
                    @endphp
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
        </div>
      </div>
    </div>

    <div
    class="modal fade"
    id="modalId"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateStatus">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Transaction Status
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <select
                                class="form-select form-select-lg"
                                name="status"
                                id=""
                            >
                                <option selected>Select one</option>
                                <option value="0">Pending</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
                <button type="submit" id="submitbtn" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
    </div>
  </div>
  <script>
    $(document).ready(function(){
        $(".orderId").on("click",function(){
            let id=$(this).attr("data-id");
            console.log(id);
            $("#updateStatus").submit(function(e){
            e.preventDefault();
            $("#submitbtn").text("Updating...");
            $("#submitbtn").prop("disabled",true);
            let formdata=new FormData(this);
            $.ajax({
                method:"POST",
                url:"/admin/order/item/status/"+id,
                data:formdata,
                processData:false,
                contentType:false,
                success:function(data){
                    console.log(data);
                    if(data.success==true){
                        Swal.fire({
                            icon:"success",
                            title:"Status Updated",
                            showConfirmButton:false,
                            timer:1500,
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                }

            })
        })
        })

    })
  </script>
  @endsection


