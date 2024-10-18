<!DOCTYPE html>
<html lang="en">
   <head>
      <title>
         New Registration: Financial Transactions System
      </title>
      <meta charset="UTF-8" />
      <link rel="icon" href="{{ asset('assets/img/logo.png')}}" type="image/x-icon" />
      <link rel="shortcut icon" href="{{ asset('assets/img/logo.png')}}" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link href="{{ asset('assets/logincss/jquery-ui.css')}}" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('assets/logincss/bootstrap.min.css')}}" />
      <link rel="stylesheet" href="{{ asset('assets/logincss/font-awesome.min.css')}}" />
      <link rel="stylesheet" href="{{ asset('assets/logincss/register.css')}}" />
   </head>
   <body>
      <div id="divloader" class="progressdiv" style="z-index: 9999999; display: none;"></div>
      <div class="otherdiv" id="otherdiv"></div>
      <div class="divalert" id="divalert" style="z-index: 9999999;">
         <a class="divalert-close" onclick="closealert();">
         <img src="images/cancel.png" /></a>
         <div class="clear"></div>
         <div class="divalert-text" id="alerttext"></div>
         <div class="divalert-bottom">
            <input type="button" value="OK" onclick="closealert();" class="divalert-ok" />
         </div>
      </div>
      <div id="divalertback" class="otherdiv" onclick="closealert();" style="z-index: 999999;"></div>
      <div class="login_form">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6 col-md-12 col-sm-12 login_bg">
                  <div class="side_logo swingimage">
                     <img src="{{ asset('assets/img/logo.png')}}" style="width:150px;">
                  </div>
               </div>
               <div class="col-lg-6 col-md-12 col-sm-12 login-right-bg">
                  <form  action="{{ route('register') }}" method="POST" class="login100-form">
					@csrf
                     {{-- <div class="aspNetHidden">
                        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="o0XZP4ftuXA2cNHr1lHdxm+9gGFoZ7IzBVlZ6tfcA6/Ph04UGDNriKI5/2uGvstTabmh5029uYYEs+uY6To98vyS22UXVHv+Dq3y4rduJsY=" />
                     </div>
                     <div class="aspNetHidden">
                        <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="799CC77D" />
                        <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="MVwVGIvEe0qW0KEfyW1/EwxCZZU7cEwen0APfKJvPrCrAtzmJDe6jsCXKz50DrrAXjShr7D3mcZhpHRXu9HIhCBX79dN7zFnFO7WV1xmRjfI7tsaHbpkShg9KrNZ3vvl" />
                     </div> --}}
                     <input type="hidden" name="HidPosition" id="HidPosition" />
                     <img src="{{ asset('assets/img/logo.png')}}" class="mobile-logo" style="height: 90px;">
                     <span class="login100-form-title">Sign Up
                     </span>
                     <p class="login-text">Fields marked as star (*) are required</p>
                     <div class="row">
                        <div class="col-md-12">
							<fieldset>
							   <legend>Sponsor Detail</legend>
							   <div class="col-md-12">
								  <div class="row">
									 <div class="col-sm-6">
										<div class="ctrl">
										   <label>Sponsor ID: *</label>
										   <input type="text" id="sponsor" name="referal_by" value="{{ old('referal_by') }}" class="form-control " maxlength="50" value />
                                 @error('referal_by')
                                 <div class="text-danger">{{ $message }}</div>  <!-- Display validation error for name -->
                              @enderror
                              </div>
									 </div>
									 {{-- <div class="col-sm-6">
										<div class="ctrl">
										   <label class="lbl">Sponsor Name: </label>
										   <input type="text" id="txtSponsorName" class="form-control " maxlength="50" value readonly />
										</div>
									 </div> --}}
									 {{-- <div class="clearfix"></div> --}}
								  </div>
							   </div>
							</fieldset>
						 </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                           <fieldset>
                              <legend>Personal Detail</legend>
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-lg-2">
                                       <div class="ctrl">
                                          <label>Prefix: *</label>
										  <select id="dropPrefix" name="prefix" class="form-control" required>
											<option value="Mr." {{ old('prefix') == 'Mr.' ? 'selected' : '' }}>Mr</option>
											<option value="Ms." {{ old('prefix') == 'Ms.' ? 'selected' : '' }}>Ms</option>
											<option value="Mis." {{ old('prefix') == 'Mis.' ? 'selected' : '' }}>Mis</option>
											<option value="Dr." {{ old('prefix') == 'Dr.' ? 'selected' : '' }}>Dr</option>
											<option value="Prof." {{ old('prefix') == 'Prof.' ? 'selected' : '' }}>Prof</option>
										</select>
                              
                                       </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-lg-10">
                                       <div class="ctrl">
                                          <label>Your Full Name: *</label>
                                          <input type="text" name="name" value="{{ old('name') }}" required class="form-control " maxlength="50" />
                                          @error('name')
                                          <div class="text-danger">{{ $message }}</div>  <!-- Display validation error for name -->
                                       @enderror
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                       <div class="ctrl">
                                          <label>Password: *</label>
                                          <input type="password" name="password" required class="form-control" maxlength="20" />
                                          @error('password')
                                          <div class="text-danger">{{ $message }}</div>  <!-- Display validation error for name -->
                                       @enderror
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                       <div class="ctrl">
                                          <label>Confirm Password: *</label>
                                          <input type="password" name="password_confirmation" class="form-control " maxlength="20" />
                                          @error('password_confirmation')
                                          <div class="text-danger">{{ $message }}</div>  <!-- Display validation error for name -->
                                       @enderror
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6">
                                       <div class="ctrl">
                                          <label>Email: *</label>
                                          <input type="email" name="email" value="{{ old('email') }}" class="form-control" maxlength="50" />
                                          @error('email')
                                          <div class="text-danger">{{ $message }}</div>  <!-- Display validation error for name -->
                                       @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="ctrl">
                                          <label>Mobile No.: *</label>
                                          <input type="text" name="phone" value="{{ old('phone') }}" required class="form-control" maxlength="10" />
                                          @error('phone')
                                          <div class="text-danger">{{ $message }}</div>  <!-- Display validation error for name -->
                                       @enderror
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                        
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                           <div class="ctrl text-center">
                              <input type="submit" class="login100-form-btn full" value="Sign Up" />
                           </div>
                        </div>
                     </div>
                     <div class="text-center p-t-12">
                        <span class="txt1">Already have an account?
                        </span>
                        <a class="reg100-form-btn" href="{{ route('login') }}">Login</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      {{-- <div class="modal-dialog modal-sm divpopup" id="divOtp" style="width: 450px; display: none; background: #ffffff; border: 1px solid #e0e0e0;">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="divtitle">Validate OTP</h4>
               <button type="button" class="close" onclick="closediv();"><span aria-hidden="true">×</span></button>
            </div>
            <div class="divpopup-inner">
               <div>
                  <div class="row">
                     <label class="col-md-12 form-group">Enter the OTP, you have received on your email</label>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <label class="col-md-3 form-group">OTP: *</label>
                     <div class="col-md-6 form-group">
                        <input type="text" id="txtOTP" class="form-control" />
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-3"></div>
                     <div class="col-md-6">
                        <input type="button" class="login100-form-btn full" value="Validate" id="btnValidateOTP" />
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div> --}}
      <script src="{{ asset('assets/logincss/jquery-1.11.1.min.js') }}"></script>
      <script src="{{ asset('assets/logincss/bootstrap.min.js') }}"></script>
      <script src="{{ asset('assets/logincss/jquery-ui.js') }}"></script>
      {{-- <script src="{{ asset('assets/js/custom.js?version=08112022') }}"></script> --}}
   </body>
</html>
<script>
   // Function to get URL parameter value
function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Autofill the sponsor input field
document.addEventListener('DOMContentLoaded', function() {
    const referralCode = getUrlParameter('referral');
    if (referralCode) {
        const sponsorInput = document.getElementById('sponsor');
        sponsorInput.value = referralCode; // Set the sponsor input to the referral code
    }
});

   </script>