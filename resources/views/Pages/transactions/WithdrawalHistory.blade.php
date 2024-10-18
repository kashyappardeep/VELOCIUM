@include('includes.header');

<div class="content">
   
   <div class="row">
      <div class="col-md-12">
         <div class="card ">
            <div class="card-header ">
               <h5 class="card-title" id="pagetitle">Fund Withdrawal History</h5>
            </div>
            <div class="card-body form_design">
               <div class="row">
                  <div class="col-md-12">
                     <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        
                        <div class="dataTables_scroll">
                           <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                              <div class="dataTables_scrollHeadInner" style="box-sizing: content-box;  padding-right: 0px;">
                                 <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%; margin-left: 0px;" role="grid">
                                    <thead>
                                       <tr role="row" >
                                          <th data-column-index="0" class="sorting_asc DTCR_tableHeader thwidth1" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Date: activate to sort column descending">Date</th>
                                          {{-- <th data-column-index="1" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 437.01px;" aria-label="Transaction ID: activate to sort column ascending">Transaction ID</th> --}}
                                          <th  data-column-index="2" class="sorting_disabled thwidth2" rowspan="1" colspan="1" aria-label="Amount">Amount</th>
                                          <th data-column-index="3" class="sorting_disabled" rowspan="1" colspan="1" style="width: 181.604px;" aria-label="Status">Status</th>
                                       </tr>
                                    </thead>
                                 </table>
                              </div>
                           </div>
                           <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                              <table  class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                
                                 <tbody>
                                   @if ($histroy)
                                   @foreach($histroy as $histroy) 
                                   <tr class="odd">
                                       <td data-column-index="0" class="sorting_asc DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 394.531px; cursor: pointer;" aria-sort="ascending" aria-label="Date: activate to sort column descending" >{{$histroy->created_at}}</td>
                                       {{-- <td data-column-index="1" class="sorting" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 437.01px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Transaction ID: activate to sort column ascending" >00000000</td> --}}
                                       <td style="width: 195.8542px;" data-column-index="2" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Amount">{{$histroy->amount}}</td>
                                       @IF($histroy->status == 0)
                                       <td style="color : Yellow"  data-column-index="3" class="sorting_disabled" rowspan="1" colspan="1" style="width: 181.604px;" aria-label="Status">Pending</td> 
                                       @elseif ($histroy->status == 1)
                                       <td style="color : rgb(27, 232, 27)"  data-column-index="3" class="sorting_disabled" rowspan="1" colspan="1" style="width: 181.604px;" aria-label="Status">Complete</td> 
                                      @else
                                       <td style="color : rgb(247, 19, 19)"  data-column-index="3" class="sorting_disabled" rowspan="1" colspan="1" style="width: 181.604px;" aria-label="Status">Reject</td> 
                                       @endif
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                      <td valign="top" colspan="4" class="dataTables_empty">No data found</td>
                                   </tr>
                                   @endif
                                  
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="dataTables_info" id="tbldata_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div>
                        <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                           <ul class="pagination">
                              <li class="paginate_button page-item previous disabled" id="tbldata_previous"><a href="#" aria-controls="tbldata" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                              <li class="paginate_button page-item next disabled" id="tbldata_next"><a href="#" aria-controls="tbldata" data-dt-idx="1" tabindex="0" class="page-link">Next</a></li>
                           </ul>
                        </div>
                     </div>
                     <div id="divDataloader" style="text-align: center; display: none;">
                        <img src="images/smallLoader.gif">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <hr>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script src="UserJs/Transactions/DepositHistory.js?version=17082022"></script>
</div>

@include('includes.footer');