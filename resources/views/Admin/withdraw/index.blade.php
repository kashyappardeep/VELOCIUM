@include('layouts.header')

<div class="content">
    <div class="row">
       <div class="col-md-12">
          <div class="card ">
             <div class="card-header ">
                <h5 class="card-title text-center" id="pagetitle">Withdrawal Request History</h5>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="col-md-12">
                      <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer text-center">

                         <div class="dataTables_scroll">
                            <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                               <div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 100%; padding-right: 0px;">
                                  <table class="table table-striped table-bordered dataTable no-footer text-center" role="grid">
                                     <thead>
                                        <tr role="row">
                                           <th>Name</th>
                                           <th>Date</th>
                                           <th>Amount</th>
                                           <th>Status</th>
                                           <th>Action</th>
                                        </tr>
                                     </thead>
                                  </table>
                               </div>
                            </div>
                            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                               <table class="table table-striped table-bordered dataTable no-footer text-center" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                  <tbody>
                                    @if ($withdral_req->count() > 0)
                                    @foreach($withdral_req as $req) 
                                    <tr class="odd">
                                        <td>{{$req->user_req->referal_code}}</td>
                                        <td>{{$req->created_at}}</td>
                                        <td>{{$req->amount}}</td>
                                        <td style="color: {{ $req->status == 0 ? 'rgb(242, 233, 107)' : 'green' }}">
                                            {{ $req->status == 0 ? 'Pending...' : 'Approved' }}
                                        </td>
                                        <td class="sorting_disabled" style="width: 276.604px;" aria-label="Status">
                                            <!-- Form to trigger the PUT request -->
                                            <form action="{{ route('invest_req.update', $req->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT') <!-- Laravel's method spoofing to make this a PUT request -->
                                                <button type="submit" class="btn btn-danger hvr-sweep-to-right">Activate</button>
                                             </form>
                                             <form action="{{ route('reject_request',$req->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger hvr-sweep-to-right">Reject</button>
                                            </form>
                                            
                                        </td>
                                     </tr>
                                     @endforeach
                                     @else
                                     <tr class="odd">
                                       <td valign="top" colspan="5" class="dataTables_empty">No data found</td>
                                    </tr>
                                    @endif
                                  </tbody>
                               </table>
                            </div>
                         </div>

                         <!-- Pagination Links -->
                         <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                            {{ $withdral_req->links() }}
                         </div>

                      </div>
                      <div id="divDataloader" style="text-align: center; display: none;">
                         <img src="images/smallLoader.gif">
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>

@include('layouts.footer')
