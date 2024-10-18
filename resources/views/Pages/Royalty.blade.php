@include('includes.header');
<div class="content">
    <div class="row">
       <div class="col-md-12 text-right"></div>
    </div>
    <div class="row">
       <div class="col-md-12">
          <div class="card ">
             <div class="card-header ">
                <h5 class="card-title" id="pagetitle"> Royalty Rewards </h5>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="col-md-12">
                      <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                      
                         
                         <div class="dataTables_scroll">
                            <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                               <div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 977.333px; padding-right: 0px;">
                                  <table class="table table-striped table-bordered dataTable no-footer" style="width: 977.333px; margin-left: 0px;" role="grid">
                                     <thead>
                                        <tr role="row">
                                           {{-- <th style="width: 32.9896px;" data-column-index="0" class="sorting_asc" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending">S.No.</th> --}}
                                           <th style="width: 68.8333px;" data-column-index="1" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="ID: activate to sort column ascending">ID</th>
                                           <th data-column-index="2" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 184.573px;" aria-label="Name: activate to sort column ascending">Name</th>
                                           <th data-column-index="3" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 234.469px;" aria-label="Package: activate to sort column ascending">Team Business</th>
                                           <th style="width: 170.9479px" data-column-index="4" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Status">Reward</th>
                                        </tr>
                                     </thead>
                                  </table>
                               </div>
                            </div>
                            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                               <table id="tbldata" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                  
                                  <tbody>
                                    @foreach($Reward as $Reward) <!-- Change variable name to avoid confusion -->
                           <tr role="row" class="odd">
                              <td style="width: 59.8333px;" data-column-index="1" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" aria-label="ID: activate to sort column ascending">{{$Reward->id}}</td> 
                              <td data-column-index="2" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 160.573px;" aria-label="Name: activate to sort column ascending">{{$Reward->name}}</td> 
                                <td data-column-index="3" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 203.469px;" aria-label="Package: activate to sort column ascending">{{$Reward->team_business}}</td> 
                                    <td style="width: 146.9479px;" data-column-index="4" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Status">{{$Reward->reward}}</td>  
    </tr>
@endforeach

                                  </tbody>
                               </table>
                            </div>
                         </div>
                         
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
    <script src="UserJs/Network/DirectTeam.js?version=17082022"></script>
 </div>

@include('includes.footer');