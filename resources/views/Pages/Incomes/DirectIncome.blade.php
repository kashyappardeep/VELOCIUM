@include('includes.header');
<div class="content">
    <div class="row">
       <div class="col-md-12">
          <div class="card smallPageHeader">
             <div class="card-header ">
                <div class="divPageTitle">
                   <h5 id="pagetitle">Direct Income</h5>
                   <div class="btnRight"></div>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="form-group col-md-2">
                      <label class="lbl lbl1">Date :</label>
                      <select id="drodaterange" class="form-control custom-select" onchange="sowCustomDate(this.id);">
                         <option value="All">All</option>
                         <option value="This Calendar Year">This Calendar Year</option>
                         <option value="Last Calendar Year">Last Calendar Year</option>
                         <option value="Current Month">This Month</option>
                         <option value="Last Month">Last Month</option>
                         <option value="Current Week">This Week</option>
                         <option value="Custom">Custom</option>
                      </select>
                   </div>
                   <div id="divcustomdate" class="form-group col-md-4 divdaterange">
                      <div class="row">
                         <div class="form-group col-md-6">
                            <label class="lbl lbl1">From Date :</label>
                            <input type="text" id="txtfromdate" class="form-control hasDatepicker" placeholder="__/__/____">
                         </div>
                         <div class="form-group col-md-6">
                            <label class="lbl lbl1">To Date :</label>
                            <input type="text" id="txttodate" class="form-control hasDatepicker" placeholder="__/__/____">
                         </div>
                      </div>
                   </div>
                   <div class="form-group col-md-3 btn-t-padd div_btn_srch">
                      <label class="lbl lbl1">&nbsp;</label>
                      <input id="btnSearch" type="button" value="Search" class="btn btn-warning hvr-grow">
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                      <hr class="martop0">
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                      <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                         <div id="tbldata_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tbldata"></label></div>
                         <div class="dataTables_length" id="tbldata_length">
                            <label>
                               Show 
                               <select name="tbldata_length" aria-controls="tbldata" class="custom-select custom-select-sm form-control form-control-sm">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                               </select>
                               entries
                            </label>
                         </div>
                         <div class="dt-buttons">   <a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="tbldata" href="#"><span>PDF</span></a> <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="tbldata" href="#"><span>Excel</span></a> <a class="dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="tbldata" href="#"><span>CSV</span></a> </div>
                         <div class="dataTables_scroll">
                            <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                               <div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 977.333px; padding-right: 0px;">
                                  <table class="table table-striped table-bordered dataTable no-footer" style="width: 977.333px; margin-left: 0px;" role="grid">
                                     <thead>
                                        <tr role="row">
                                           {{-- <th style="width: 69.875px; cursor: pointer;" data-column-index="0" class="sorting_asc DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending">S.No.</th> --}}
                                           <th style="width:86.7708px; cursor: pointer; text-align: center;" data-column-index="1" class="sorting DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Date</th>
                                           <th data-column-index="2" class="sorting DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 269.021px; cursor: pointer; text-align: center;" aria-label="Referred User: activate to sort column ascending">Referred User</th>
                                  
                                           <th style="width: 234.8646px; text-align: center;" data-column-index="4" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Amount">Amount</th>
                                        </tr>
                                     </thead>
                                  </table>
                               </div>
                            </div>
                            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                               <table id="tbldata" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                  <thead>
                                     <tr role="row" style="height: 0px;">
                                        {{-- <th style="width: 69.875px; cursor: pointer; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" data-column-index="0" class="sorting_asc DTCR_tableHeader" aria-controls="tbldata" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">S.No.</div>
                                        </th> --}}
                                        <th style="width: 99.7708px; cursor: pointer; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" data-column-index="1" class="sorting DTCR_tableHeader" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Date</div>
                                        </th>
                                        <th data-column-index="2" class="sorting DTCR_tableHeader" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 398.021px; cursor: pointer; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Referred User: activate to sort column ascending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Referred User</div>
                                        </th>
                                        <th data-column-index="3" class="sorting_disabled" rowspan="1" colspan="1" style="width: 220.469px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Package">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Package</div>
                                        </th>
                                        <th style="width: 99.8646px; text-align: right; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" data-column-index="4" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Amount">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Amount</div>
                                        </th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @if ($direct_income)
                                    @foreach($direct_income as $income) 
                                        <tr class="odd">
                                            {{-- <td style="width: 99.7708px; cursor: pointer;" data-column-index="1" class="sorting DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">{{$income->created_at}}</td>
                                            <td data-column-index="2" class="sorting DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 398.021px; cursor: pointer;" aria-label="Referred User: activate to sort column ascending">{{$income->user->name}}</td>
                                            <td style="width: 99.8646px; text-align: right;" data-column-index="4" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Amount">{{$income->amount}}</td> 
                                        </tr> --}}
                                        <td style="width:86.7708px; cursor: pointer; text-align: center;" data-column-index="1" class="sorting DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">{{$income->created_at}}</td>
                                        <td data-column-index="2" class="sorting DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 269.021px; cursor: pointer; text-align: center;" aria-label="Referred User: activate to sort column ascending">{{$income->user->name}}</td>
                               
                                        <td style="width: 234.8646px; text-align: center;" data-column-index="4" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Amount">{{$income->amount}}</td>
                                     
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
             </div>
          </div>
       </div>
    </div>
    <script src="assets/js/search.js"></script>
    <script src="UserJs/Reports/DirectIncome.js?version=17082022"></script>
 </div>
@include('includes.footer');