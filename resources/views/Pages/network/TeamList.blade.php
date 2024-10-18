@include('includes.header');
<div class="content">
    <div class="row">
       <div class="col-md-12">
          <div class="card smallPageHeader">
             <div class="card-header ">
                <div class="divPageTitle">
                   <h5 id="pagetitle">Team List</h5>
                   <div class="btnRight"></div>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="form-group col-md-2">
                      <label class="lbl lbl1">Level No :</label>
                      <select id="dropLevelNoSrch" class="form-control custom-select">
                         <option value="0">All</option>
                         <option value="1">Level-1</option>
                         <option value="2">Level-2</option>
                         <option value="3">Level-3</option>
                         <option value="4">Level-4</option>
                         <option value="5">Level-5</option>
                         <option value="6">Level-6</option>
                         <option value="7">Level-7</option>
                         <option value="8">Level-8</option>
                         <option value="9">Level-9</option>
                         <option value="10">Level-10</option>
                         <option value="11">Level-11</option>
                         <option value="12">Level-12</option>
                         <option value="13">Level-13</option>
                         <option value="14">Level-14</option>
                         <option value="15">Level-15</option>
                         <option value="16">Level-16</option>
                         <option value="17">Level-17</option>
                         <option value="18">Level-18</option>
                         <option value="19">Level-19</option>
                         <option value="20">Level-20</option>
                      </select>
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
                                           <th style="width: 69.7917px;" data-column-index="0" class="sorting_asc" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending">S.No.</th>
                                           <th data-column-index="1" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 184.292px;" aria-label="Level No.: activate to sort column ascending">Level No.</th>
                                           <th style="width: 99.5208px;" data-column-index="2" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="ID: activate to sort column ascending">ID</th>
                                           <th style="width: 99.6458px;" data-column-index="3" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Name</th>
                                           <th style="width: 49.9271px;" data-column-index="4" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Status</th>
                                           <th data-column-index="5" class="sorting_disabled" rowspan="1" colspan="1" style="width: 142.49px;" aria-label="Package">Package</th>
                                           <th data-column-index="6" class="sorting_disabled" rowspan="1" colspan="1" style="width: 194.333px;" aria-label="Total Direct">Total Direct</th>
                                        </tr>
                                     </thead>
                                  </table>
                               </div>
                            </div>
                            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                               <table id="tbldata" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                  <thead>
                                     <tr role="row" style="height: 0px;">
                                        <th style="width: 69.7917px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" data-column-index="0" class="sorting_asc" aria-controls="tbldata" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">S.No.</div>
                                        </th>
                                        <th data-column-index="1" class="sorting" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 184.292px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Level No.: activate to sort column ascending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Level No.</div>
                                        </th>
                                        <th style="width: 99.5208px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" data-column-index="2" class="sorting" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="ID: activate to sort column ascending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">ID</div>
                                        </th>
                                        <th style="width: 99.6458px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" data-column-index="3" class="sorting" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Name</div>
                                        </th>
                                        <th style="width: 49.9271px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" data-column-index="4" class="sorting" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Status</div>
                                        </th>
                                        <th data-column-index="5" class="sorting_disabled" rowspan="1" colspan="1" style="width: 142.49px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Package">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Package</div>
                                        </th>
                                        <th data-column-index="6" class="sorting_disabled" rowspan="1" colspan="1" style="width: 194.333px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Total Direct">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Total Direct</div>
                                        </th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <tr class="odd">
                                        <td valign="top" colspan="7" class="dataTables_empty">No data found</td>
                                     </tr>
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
    <script src="UserJs/Network/TeamList.js?version=05112022"></script>
 </div>

@include('includes.footer');