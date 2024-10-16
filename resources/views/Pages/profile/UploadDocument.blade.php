@include('includes.header');

<div class="content">
    <div class="modal-dialog modal-sm divpopup" id="divValidateOTP" style="width: 400px; display: none;">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">Verify with OTP</h4>
             <button type="button" class="close" onclick="closediv();"><span aria-hidden="true">×</span></button>
          </div>
          <div class="divpopup-inner">
             <div class="row">
                <div class="col-sm-12 col-xs-12">
                   <div class="ctrl">
                      <label class="col-sm-12 lbl text-info">Enter OTP received on your registered email : </label>
                      <div class="col-sm-12">
                         <input type="text" class="form-control" id="txtKYCOTP">
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="clearfix"></div>
          <div class="divpopbutton" style="text-align: center;">
             <input type="button" class="subbtn" value="Validate" id="btnValidate">
             <input type="button" class="btn btn-default hvr-glow" value="Close" onclick="closediv();">
          </div>
       </div>
    </div>
    <div class="row" style="display: none;">
       <div class="offset-md-3 col-md-6">
          <h3 class="kycstatus fleft" style="font-weight: bold; margin-top: 10px; color: #ffffff;">KYC Status: <span><i class="fa fa-warning"></i> &nbsp;Pending</span></h3>
       </div>
    </div>
    <div class="row">
       <div class="offset-md-3 col-md-6">
          <div class="card smallPageHeader">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5>FTS 2.0 Wallet Address (BEP-20)</h5>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="col-sm-12">
                      <div class="row">
                         <div class="clearfix"></div>
                         <div class="form-group col-sm-12">
                            <label>Wallet Address : *</label>
                            <input type="text" class="form-control" id="txtWalletAddress20" style="text-transform: uppercase;">
                         </div>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12 text-right">
                      <input type="button" class="btn btn-warning hvr-glow" value="Submit" id="btnsaveWalletAddress20">
                   </div>
                </div>
             </div>
          </div>
          <div class="card smallPageHeader">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5>Update USDT (BEP-20) Wallet Address <span id="WalletAddressStatus"></span></h5>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="card-body form_design" id="divWalletAddress">
                <div class="row">
                   <div class="col-sm-12">
                      <div class="row">
                         <div class="clearfix"></div>
                         <div class="form-group col-sm-12">
                            <label>Wallet Address : *</label>
                            <input type="text" class="form-control" id="txtWalletAddress" style="text-transform: uppercase;">
                         </div>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12 text-right">
                      <input type="button" class="btn btn-warning hvr-glow" value="Submit" id="btnsaveWalletAddress">
                   </div>
                </div>
             </div>
          </div>
          {{-- <div class="card smallPageHeader" style="display: none;">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5>Update Aadhar Card <span id="aadharstatus"></span></h5>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="card-body form_design" id="divAAdharCard">
                <div class="row">
                   <div class="col-sm-12">
                      <div class="row">
                         <div class="ctrl" style="display: none;">
                            <label class="col-sm-12 col-xs-12 lbl">
                            Select Aadhar Front Side Image:
                            </label>
                            <div class="col-sm-12 col-xs-12" title="Select Aadhar Photo" id="divImage">
                               <div id="btnfileselect" class="UploadPhoto" style="background-image: url(images/NoImage.jpg);">
                                  <div id="btnFileSelectInner"></div>
                               </div>
                            </div>
                         </div>
                         <div class="ctrl" style="display: none;">
                            <label class="col-sm-12 col-xs-12 lbl">
                            Select Aadhar Back Side Image:
                            </label>
                            <div class="col-sm-12 col-xs-12" title="Select Aadhar Photo" id="divImageBack">
                               <div id="btnfileselectBack" class="UploadPhoto" style="background-image: url(images/NoImage.jpg);">
                                  <div id="btnFileSelectInnerBack"></div>
                               </div>
                            </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="form-group col-sm-12">
                            <label>Aadhar No : *</label>
                            <input type="text" class="form-control" id="txtAadharNo" style="text-transform: uppercase;">
                         </div>
                         <div class="clearfix"></div>
                         <div class="ctrl" style="display: none;">
                            <div class="col-sm-12">
                               <p class="msg">
                                  1. File Extension Allowed (.jpg, .jpeg, .png, .bmp)<br>
                                  2. Image size should not exceed 1 MB
                               </p>
                            </div>
                         </div>
                         <div class="clearfix"></div>
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
          <div class="card smallPageHeader">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5>Update FTS Address <span id="panstatus"></span></h5>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="card-body form_design" id="divPanCard">
                <div class="row">
                   <div class="col-sm-12">
                      <div class="row">
                         <div class="ctrl" style="display: none;">
                            <label class="col-sm-12 col-xs-12 lbl">
                            Select PAN Card Image:
                            </label>
                            <div class="col-sm-12 col-xs-12" title="Select Aadhar Photo" id="divImagePan">
                               <div id="btnfileselectPan" class="UploadPhoto" style="background-image: url(images/NoImage.jpg);">
                                  <div id="btnFileSelectInnerPan"></div>
                               </div>
                            </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="clearfix"></div>
                         <div class="form-group col-sm-12">
                            <label>FTS Address : *</label>
                            <input type="text" class="form-control" id="txtPANNo">
                         </div>
                         <div class="clearfix"></div>
                         <div class="ctrl" style="display: none;">
                            <div class="col-sm-12">
                               <p class="msg">
                                  1. File Extension Allowed (.jpg, .jpeg, .png, .bmp)<br>
                                  2. Image size should not exceed 1 MB
                               </p>
                            </div>
                         </div>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12 text-right">
                      <input type="button" class="btn btn-warning hvr-glow" value="Submit" id="btnsavePan">
                   </div>
                </div>
             </div>
          </div> --}}
          {{-- <div class="card smallPageHeader" style="display: none;">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5>Upload Bank Passbook/Cancelled Cheque <span id="bankstatus"></span></h5>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="card-body form_design" id="divBankDetail">
                <div class="row">
                   <div class="col-sm-12">
                      <div class="row">
                         <div class="form-group col-sm-12" title="Select Bank Image" id="divBankImage">
                            <label>
                            Select Bank Passbook Image:
                            </label>
                            <div id="btnfileselectBank" class="UploadPhoto normal" style="background-image: url(images/NoImage.jpg);">
                               <div id="btnFileSelectInnerBank"></div>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="form-group col-sm-12">
                            <label>Account Holder Name : *</label>
                            <input type="text" class="form-control" id="txtAcName">
                         </div>
                      </div>
                      <div class="row">
                         <div class="form-group col-sm-12">
                            <label>Account No. : *</label>
                            <input type="text" class="form-control" id="txtBankAcNo">
                         </div>
                      </div>
                      <div class="row">
                         <div class="form-group col-sm-12">
                            <label>Bank Name : *</label>
                            <input type="text" class="form-control" id="txtBankName">
                         </div>
                      </div>
                      <div class="row">
                         <div class="form-group col-sm-12">
                            <label>Bank Branch : *</label>
                            <input type="text" class="form-control" id="txtBankBranch">
                         </div>
                      </div>
                      <div class="row">
                         <div class="form-group col-sm-12">
                            <label>IFSC Code : *</label>
                            <input type="text" class="form-control" id="txtIFSCCode" style="text-transform: uppercase;">
                         </div>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12 text-right">
                      <input type="button" class="btn btn-warning hvr-glow" value="Submit" id="btnsaveBank">
                   </div>
                </div>
             </div>
          </div> --}}
       </div>
    </div>
    <iframe src="Upload.aspx" id="ifuploadfile" style="display: none;"></iframe>
    <script src="MasterJs/Attachment.js?v=1"></script>
    <script src="UserJs/Network/UploadDocument.js?version=22082024"></script>
 </div>

@include('includes.footer');