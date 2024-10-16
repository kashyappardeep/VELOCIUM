@include('includes.header');
<div class="content">
    <div class="row">
       <div class="offset-md-2 col-md-6">
          <div class="card smallPageHeader">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5>Add Fund</h5>
                   <div class="btnRight">
                      <a id="btnView" href="DepositHistory.aspx" class="btn btn-danger hvr-sweep-to-right collapsed">
                      <i class="fa fa-fw fa-circle-thin topicon"></i>View History
                      </a>
                   </div>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="row" id="divValidateSummary" style="display: none;">
                <div class="col-md-12 col-xs-12">
                   <div class="validate-box">
                      <ul></ul>
                   </div>
                </div>
             </div>
             <div class="card-body form_design" id="divAddForm">
                <div class="row">
                   <div class="form-group col-md-12">
                      <div class="row">
                         <div class="form-group col-md-12">
                            <div class="clearfix"></div>
                            <div class="row">
                               <div class="form-group col-md-6">
                                  <label>Amount (USDT): *</label>
                                  <input id="txtAmount" type="text" class="form-control" maxlength="50">
                               </div>
                            </div>
                            <div class="row">
                               <div class="form-group col-md-12">
                                  <label>Transaction ID: *</label>
                                  <input id="txtTranID" type="text" class="form-control" maxlength="200">
                               </div>
                            </div>
                            <div class="row">
                               <div class="form-group col-md-12">
                                  <label>Remarks: </label>
                                  <input id="txtRemarks" type="text" class="form-control" maxlength="200">
                               </div>
                            </div>
                            <div class="row" style="display:none;">
                               <div class="form-group col-md-12">
                                  <label>Upload Screenshot: * </label>
                                  <div>
                                     <input type="button" id="btnfileselect" class="btn btn-info hvr-glow" value="Select File">
                                  </div>
                                  <div class="clearfix"></div>
                                  <a id="linkFileName" href="#" target="_blank"></a>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12 text-right">
                      <input type="button" class="btn btn-warning hvr-glow" value="Submit" id="btnsave">
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <iframe src="Upload.aspx" id="ifuploadfile" style="display: none;"></iframe>
    <script src="MasterJs/Attachment.js?v=1"></script>
    <script src="UserJs/Transactions/AddFund.js?version=04112022"></script>
 </div>

@include('includes.footer');



