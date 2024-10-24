<!DOCTYPE html>
<html>
   <head>
      <title>
         VELOCIUM SYSTEM
      </title>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="icon" href="/favicon.png" type="image/x-icon" />
      <link rel="shortcut icon" href="/favicon.png" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
      <link href="{{asset('assets/fonts/Segoe-UI/FontSegoeUI.css')}}" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css?family=Rajdhani:400,600,700&amp;display=swap" rel="stylesheet" />
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet" />
      <link href="{{asset('assets/fonts/font-baroquescript.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/css/fixedColumns.dataTables.min.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/css/jquery-ui.css?version=04112022')}}" rel="stylesheet" />
      <link href="{{asset('assets/css/CustomDataTable.css?version=04112022')}}" rel="stylesheet" />
      <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/css/hover.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/css/paper-dashboard.css?version=3072023')}}" rel="stylesheet" />
      <link href="{{asset('assets/css/Custom.css?version=04112022')}}" rel="stylesheet" />
      <link href="{{asset('assets/css/search.css')}}" rel="stylesheet" />
      <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
      <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
      <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
      <script src="{{asset('assets/js/datatable/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('assets/js/datatable/dataTables.fixedColumns.min.js')}}"></script>
      <script src="{{asset('assets/js/ColReorderWithResize.js')}}"></script>
      <script src="{{asset('assets/js/datatable/jszip.min.js')}}"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="{{asset('assets/js/datatable/dataTables.buttons.min.js')}}"></script>
      <script src="{{asset('assets/js/datatable/pdfmake.min.js')}}"></script>
      <script src="{{asset('assets/js/datatable/vfs_fonts.js')}}"></script>
      <script src="{{asset('assets/js/datatable/buttons.html5.min.js')}}"></script>
      <script src="{{asset('assets/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.ui.autocomplete.html.js')}}"></script>
      <script src="{{asset('assets/js/jquery.timepicker.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('assets/js/jquery.mask.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('assets/js/CustomComboBox.js?version=04112022')}}"></script>
      <script src="{{asset('assets/js/jquery.floatThead.min.js')}}"></script>
      <script src="{{asset('assets/js/xlsx.full.min.js')}}"></script>
      <script src="MasterJs/GenexDataTable.js?version=04112022"></script>
      <script src="MasterJs/MasterPage.js?version=2"></script>
      <script src="MasterJs/MasterAPI.js?version=2"></script>
      <script src="{{asset('assets/js/themejs.js?version=2')}}"></script>
      <link href="{{asset('assets/css/Dashboard.css?v=8')}}" rel="stylesheet" />
      <script language="JavaScript" type="text/javascript">
         function CopyURL(id) {
             /* Get the text field */
             var copyText = $('#' + id).attr('data-val');
         
             /* Copy the text inside the text field */
             navigator.clipboard.writeText(copyText);
         
             /* Alert the copied text */
             OpenAlert("Link copied to clipboard");
         }
      </script>
      
     
      <style>
         .coin-marquee-header-signature, .coin-marquee-header {
         display: none;
         }
         .coin-marquee-header-signature svg {
         display: none;
         }
         .coin-marquee-container {
         width: 100% !important;
         background: rgba(255, 255, 255, 0.5);
         }
         .coin-marquee-wrapper {
         border: none !important;
         margin-top: 10px;
         }
      </style>
      <style>
         
         .sidebar {
    display: block; /* Ensure it's block */
    visibility: visible; /* Ensure it's visible */
}
         .main-panel {
             transition: margin-left 0.3s; /* Smooth transition for main content */
             margin-left: 0; /* Default margin */
         }
         .main-panel.active {
             margin-left: 250px; /* Shift main content when sidebar is open */
         }
         /* Hide sidebar toggle button on larger screens */
         @media (min-width: 768px) {
             .navbar-toggler {
                 display: none;
             }
         }
     </style>
   </head>
   <body>
      {{-- <form method="post" action="./Dashboard.aspx" id="form1"> --}}
      <div class="aspNetHidden">
         <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="XSFWzyjgWKxMECbLjth4TWAcQElX6rqAjpOB+IzHpxipu1xOK2Gy0pQRL6NajYv1icnfwel8lfuu8c86EbzCob0fG4pjAdP1cvnNtC8noxk=" />
      </div>
      <div class="aspNetHidden">
         <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="9AE45BA3" />
         <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="p9nSHb2pgYUMcqYI9zKLQX9JFPhpuGoR+vRqjr5zrrdVLoUxqzaJ1Ygi0wuA7IkrYsJlfzQyCD/jj1aPIpnDb1FS6KVe0TRLjmsZ6kyfSoq8lSQaSiy+bXD+G88mP/5OtVjSuJTwKYsB0NjFZhPirJ3Icga/PzZ2ePArBp2ECqSI9U8r/3sQx5Sr8Z/6a5maWo9BUDbSVTZrh2+zVchTUFaWaliDZwDUgNJWIuWVbPG0OpCmibkjsSQ/9Kv5bDliBHAqRUiLvaZjdFMoHlf5XXKLD81KN5Qip1uhlyHdaKCrXRvFnEoK/hwbbbLlpWm3hhaem5MB5wkRr/wiI7mNOA==" />
      </div>
      <div id="divloader" class="progressdiv" style="display: none"></div>
      <div class="otherdiv" id="otherdiv"></div>
      <div class="divalert" id="divalert" style="z-index: 9999999;">
         <a class="divalert-close" onclick="CloseAlert();">
         <img src="images/cancel.png" /></a>
         <div class="clear"></div>
         <div class="divalert-text" id="alerttext"></div>
         <div class="divalert-bottom">
            <input id="btnAlertOK" type="button" value="OK" onclick="CloseAlert();" class="divalert-ok" />
         </div>
      </div>
      <div class="modal-dialog modal-sm divpopup" id="divFTSDeposit" style="width: 400px; display: none;">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">FTS Deposit</h4>
               <button type="button" class="close" onclick="closediv();"><span aria-hidden="true">×</span></button>
            </div>
            <div class="divpopup-inner">
               <div class="row">
                  <div class="col-sm-12 col-xs-12">
                     <table class="tblwipitem">
                        <tr>
                           <th class="colhead" style="text-align: center;">
                              <img src="images/ftsqr.png" />
                           </th>
                        </tr>
                        <tr>
                           <td class="colval" style="text-align: center;">
                              <a id="urlcopyfts" class="linkcopy" onclick="CopyURL('urlcopyfts');" data-val="0x6fe6dDBf58f9a4295F7A0e1a5c993b4465b7644D">0x6fe6dDBf58f9a4295F7A0e1a5c993b4465b7644D&nbsp;<i class="fa fa-copy"></i></a>
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <div class="divpopbutton" style="text-align: center;">
               <input type="button" class="btn btn-default hvr-glow" value="Close" onclick="closediv();" />
            </div>
         </div>
      </div>
      <div class="modal-dialog modal-sm divpopup" id="divMsg" style="width: 700px; display: none;">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="popupMsgTitle">Message</h4>
               <button type="button" class="close" onclick="closediv();"><span aria-hidden="true">×</span></button>
            </div>
            <div class="divpopup-inner">
               <table class="table table-bordered table-hover popuptable" id="tblErrorMsg">
                  <thead>
                     <tr>
                        <th style="width: 200px;">Section</th>
                        <th>Message</th>
                     </tr>
                  </thead>
                  <tbody></tbody>
               </table>
            </div>
            <div class="clearfix"></div>
            <div class="divpopbutton">
               <input type="button" class="subbtn subbtn-close" value="Close" id="btnCloseMsg" onclick="closediv();" />
            </div>
         </div>
      </div>
      <div class="modal-dialog modal-sm divpopup" id="divNotification" style="width: 500px; display: none;">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Message From VELOCIUM SYSTEM</h4>
               <button type="button" class="close" onclick="closediv();"><span aria-hidden="true">×</span></button>
            </div>
            <div class="divpopup-inner">
               <h2 style="color: #ff6a00;" id="tdGlobalMsg"></h2>
            </div>
            <div class="clearfix"></div>
            <div class="divpopbutton">
               <input type="button" class="subbtn subbtn-close" value="Close" onclick="closediv();" />
            </div>
         </div>
      </div>
      <div id="divalertback" class="otherdiv" onclick="CloseAlert();" style="z-index: 999999;"></div>
      <input type="hidden" name="ctl00$HidPageRoleID" id="HidPageRoleID" value="0" />
      <input type="hidden" name="ctl00$HidHotLink" id="HidHotLink" value="0" />
      <input type="hidden" name="ctl00$HidPageID" id="HidPageID" value="0" />
      <input type="hidden" name="ctl00$HidMemberPKID" id="HidMemberPKID" value="6171" />
      <input type="hidden" name="ctl00$HidPageName" id="HidPageName" value="Data List" />
      <input type="hidden" name="ctl00$HidDateFormat" id="HidDateFormat" value="dd/MM/yyyy" />
      <input type="hidden" name="ctl00$HidCurrencyName" id="HidCurrencyName" />
      <input type="hidden" name="ctl00$hidCurrencyID" id="hidCurrencyID" value="1" />
      <input type="hidden" name="ctl00$HidWebURL" id="HidWebURL" value="https://fts.in.net/" />
      <input type="hidden" name="ctl00$HidVersionNo" id="HidVersionNo" value="10082021" />
      <div class="wrapper ">
     <!-- Sidebar -->
<div class="sidebar" data-color="white" data-active-color="danger">
   <div class="menu-bar">
       <div class="logo">
           <a href="{{ route('admin.dashboard') }}">
               <img src="{{ asset('assets/img/logo.png') }}" alt style="max-width: 90%; width: 112px">
           </a>
       </div>
       <div class="sidebar-wrapper">
           <ul class="nav" id="sidebar">
               <li>
                   <a href="{{ route('admin.dashboard') }}">
                       <i class="fa fa-home"></i>
                       <p>Dashboard</p>
                   </a>
               </li>
               <li data-toggle="collapse" data-target="#Profile" class="collapsed">
                   <a><i class="fa fa-vcard"></i>Investment Request</a>
                   <ul class="sub-menu collapse" id="Profile">
                       <li><a href="{{ route('invest_req.index') }}">Pending</a></li>
                       <li><a href="{{ route('admin.active') }}">Active</a></li>
                       <li><a href="{{ route('admin.reject') }}">Reject</a></li>
                   </ul>
               </li>
               <li>
                   <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                       @csrf
                       <button type="submit" style="background: none; display: flex; color: #25e487; border: none;">
                           <i class="fa fa-sign-out"></i>
                           <p>Logout</p>
                       </button>
                   </form>
               </li>
           </ul>
       </div>
   </div>
</div>

<!-- Navbar -->
<div id="divMain" class="main-panel">
   <nav id="divnavbar" class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
       <div class="container-fluid">
           <div class="navbar-wrapper">
               <div class="navbar-toggle">
                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="navbar-toggler-bar bar1"></span>
                       <span class="navbar-toggler-bar bar2"></span>
                       <span class="navbar-toggler-bar bar3"></span>
                   </button>
               </div>
               <a class="navbar-brand">VELOCIUM SYSTEM</a>
           </div>
           <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div class="menu-bar">
       <div class="logo">
           <a href="{{ route('admin.dashboard') }}">
               <img src="{{ asset('assets/img/logo.png') }}" alt style="max-width: 90%; width: 112px">
           </a>
       </div>
       <div class="sidebar-wrapper">
           <ul class="nav" id="sidebar">
               <li>
                   <a href="{{ route('admin.dashboard') }}">
                       <i class="fa fa-home"></i>
                       <p>Dashboard</p>
                   </a>
               </li>
               <li data-toggle="collapse" data-target="#Profile" class="collapsed">
                   <a><i class="fa fa-vcard"></i>Investment Request</a>
                   <ul class="sub-menu collapse" id="Profile">
                       <li><a href="{{ route('invest_req.index') }}">Pending</a></li>
                       <li><a href="{{ route('admin.active') }}">Active</a></li>
                       <li><a href="{{ route('admin.reject') }}">Reject</a></li>
                   </ul>
               </li>
               <li>
                   <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                       @csrf
                       <button type="submit" style="background: none; display: flex; color: #25e487; border: none;">
                           <i class="fa fa-sign-out"></i>
                           <p>Logout</p>
                       </button>
                   </form>
               </li>
           </ul>
       </div>
   </div>
           </div>
       </div>
   </nav>
</div>
      @if(session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif 
                    @if (session('error'))
                    {{-- <div class="alert alert-danger" id="success-alert"> --}}
                     <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif