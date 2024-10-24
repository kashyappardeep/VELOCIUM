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
                  <form id="levelForm" method="GET" action="{{ route('TeamList') }}">
                     <div class="form-group col-md-2">
                         <label class="lbl lbl1">Level No :</label>
                         <select id="dropLevelNoSrch" name="level" class="form-control custom-select" onchange="document.getElementById('levelForm').submit();" style="    width: 100px;">
                             <option value="0" {{ $selectedLevel == 0 ? 'selected' : '' }}>All</option>
                             <option value="1" {{ $selectedLevel == 1 ? 'selected' : '' }}>Level-1</option>
                             <option value="2" {{ $selectedLevel == 2 ? 'selected' : '' }}>Level-2</option>
                             <option value="3" {{ $selectedLevel == 3 ? 'selected' : '' }}>Level-3</option>
                             <option value="4" {{ $selectedLevel == 4 ? 'selected' : '' }}>Level-4</option>
                             <option value="5" {{ $selectedLevel == 5 ? 'selected' : '' }}>Level-5</option>
                             <option value="6" {{ $selectedLevel == 6 ? 'selected' : '' }}>Level-6</option>
                             <option value="7" {{ $selectedLevel == 7 ? 'selected' : '' }}>Level-7</option>
                             <option value="8" {{ $selectedLevel == 8 ? 'selected' : '' }}>Level-8</option>
                             <option value="9" {{ $selectedLevel == 9 ? 'selected' : '' }}>Level-9</option>
                             <option value="10" {{ $selectedLevel == 10 ? 'selected' : '' }}>Level-10</option>
                             <option value="11" {{ $selectedLevel == 11 ? 'selected' : '' }}>Level-11</option>
                             <option value="12" {{ $selectedLevel == 12 ? 'selected' : '' }}>Level-12</option>
                             <option value="13" {{ $selectedLevel == 13 ? 'selected' : '' }}>Level-13</option>
                             <option value="14" {{ $selectedLevel == 14 ? 'selected' : '' }}>Level-14</option>
                             <option value="15" {{ $selectedLevel == 15 ? 'selected' : '' }}>Level-15</option>
                             <option value="16" {{ $selectedLevel == 16 ? 'selected' : '' }}>Level-16</option>
                             <option value="17" {{ $selectedLevel == 17 ? 'selected' : '' }}>Level-17</option>
                             <option value="18" {{ $selectedLevel == 18 ? 'selected' : '' }}>Level-18</option>
                             <option value="19" {{ $selectedLevel == 19 ? 'selected' : '' }}>Level-19</option>
                             <option value="20" {{ $selectedLevel == 20 ? 'selected' : '' }}>Level-20</option>
                         </select>
                     </div>
                 </form>
                 
                </div>
                <div class="row">
                  <div class="col-md-12">
                      <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                          <div class="dataTables_scroll">
                              <div class="dataTables_scrollBody" style="overflow: auto; max-height: 500px;">
                                  <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                      <thead>
                                          <tr>
                                              <th>ID</th>
                                              <th>Name</th>
                                              <th>Package</th>
                                              <th>Status</th>
                                              <th>Date of Activation</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach($allUsers  as $user)
                                          <tr>
                                              <td>{{$user->referal_code}}</td>
                                              <td>{{$user->name}}</td>
                                              @if($user->investmentHistory->isNotEmpty())
                                                  @php
                                                  $totalAmount = $user->investmentHistory->sum('amount');
                                                  @endphp
                                                  <td>{{$totalAmount}}</td>
                                                  <td style="{{ $user->status == 1 ? 'color: Yellow' : 'color: rgb(27, 232, 27)' }}">{{ $user->status == 1 ? 'Pending' : 'Active' }}</td>
                                                  <td>{{$user->created_at}}</td>
                                              @else
                                                  <td>0</td>
                                                  <td style="color: rgb(247, 19, 19)">Inactive</td>
                                                  <td>----</td>
                                              @endif
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          {{-- <div class="dataTables_info" id="tbldata_info" role="status" aria-live="polite">Showing {{ $DirectTeam->firstItem() }} to {{ $DirectTeam->lastItem() }} of {{ $DirectTeam->total() }} entries</div> --}}
                          {{-- <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                              {{ $DirectTeam->links('pagination::bootstrap-4') }}
                          </div> --}}
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