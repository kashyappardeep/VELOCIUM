@include('layouts.header');

<div class="content">
    <div class="row">
        <div class="col-md-12 text-right"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" id="pagetitle">All User List</h5>
                </div>
                <div class="card-body form_design">
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
                                                @foreach($alluser as $user)
                                                <tr>
                                                    <td>{{$user->referal_code}}</td>
                                                    <td>{{$user->name}}</td>
                                                    
                                                      
                                                        <td>{{$user->total_investment}}</td>
                                                        <td style="{{ $user->status == 0 ? 'color: rgb(247, 19, 19)' : 'color: rgb(27, 232, 27)' }}">
                                                            {{ $user->status == 0 ? 'InActive' : 'Active' }}</td>
                                                        <td>{{$user->created_at}}</td>
                                                   
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="dataTables_info" id="tbldata_info" role="status" 
                                aria-live="polite">Showing {{ $alluser->firstItem() }}
                                 to {{ $alluser->lastItem() }} of {{ $alluser->total() }} 
                                 entries
                                </div>
                                <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                                    {{ $alluser->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="divDataloader" style="text-align: center; display: none;">
                        <img src="images/smallLoader.gif">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="UserJs/Network/DirectTeam.js?version=17082022"></script>
</div>

@include('layouts.footer');
