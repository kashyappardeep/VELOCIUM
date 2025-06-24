@include('includes.header')
<style>
    /* Modal Styles */
    #divValidateOTP {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        z-index: 1050;
        display: none;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }
    .modal-header {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-title { margin: 0; }
    .divpopup-inner { padding: 20px; }
    .divpopbutton {
        padding: 15px;
        border-top: 1px solid #ddd;
        text-align: center;
    }
    .subbtn, .btn {
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    .hvr-glow {
        transition: all 0.3s ease;
    }
    .hvr-glow:hover {
        box-shadow: 0px 0px 8px rgba(255, 255, 0, 0.8);
    }
    .content { padding: 20px; color: #000; } /* Adjusted color for better visibility */
    .kycstatus { margin-top: 10px; }
</style>
<div class="content">
    <!-- OTP Verification Modal -->
   <!-- Modal Structure -->
<div class="modal-dialog modal-sm divpopup" id="divValidateOTP"> <!-- Hidden by default -->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Verify with OTP</h4>
            <button type="button" class="close" onclick="closeModal();"><span aria-hidden="true">×</span></button>
        </div>
        <div class="divpopup-inner">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <label class="col-sm-12 lbl text-info">Enter OTP received on your registered email:</label>
                    <input type="text" class="form-control" id="txtKYCOTP">
                </div>
            </div>
        </div>
        <div class="divpopbutton">
            <input type="button" class="subbtn" value="Validate" id="btnValidate" onclick="validateOtp();">
            <input type="button" class="btn btn-default hvr-glow" value="Close" onclick="closeModal();">
        </div>
    </div>
</div>


    <!-- KYC Status and Wallet Address Update Section -->
    <!-- <div class="row">
        <div class="offset-md-3 col-md-6">
            <h3 class="kycstatus fleft" style="font-weight: bold;">
                KYC Status: <span><i class="fa fa-warning"></i></span>
            </h3>
        </div>
    </div> -->

    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card smallPageHeader">
                <div class="card-header">
                    <h5>Update USDT (BEP-20) Wallet Address <span id="WalletAddressStatus"></span></h5>
                </div>
                <div class="card-body form_design" id="divWalletAddress">
                    <div class="form-group">
                        <label>Wallet Address : *</label>
                        <input type="text" class="form-control" id="txtWalletAddress" style="text-transform: uppercase;">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-warning hvr-glow" onclick="openModal()">Send Otp</button>
                        <input type="button" class="btn btn-warning hvr-glow" value="Submit" id="btnSaveWalletAddress">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <iframe src="Upload.aspx" id="ifuploadfile" style="display: none;"></iframe>
</div>

<script src="path/to/your/js/Attachment.js"></script>
<script src="path/to/your/js/UploadDocument.js"></script>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Open Modal Function
    function openModal() {
    const modal = document.getElementById('divValidateOTP');
    if (modal) {
        console.log('Opening OTP Modal'); // Debugging statement
        modal.style.display = 'block'; // Set display to block
    } else {
        console.error('Modal element not found'); // Error handling if element is missing
    }
}
        // Function to close the modal
        function closeModal() {
    document.getElementById('divValidateOTP').style.display = 'none';
    document.getElementById('txtKYCOTP').value = ''; // Clear OTP input on close
}

    // Request OTP and then open modal
    function requestOtp() {
        const walletAddress = document.getElementById('txtWalletAddress').value;
        console.log('Requesting OTP for wallet address:', walletAddress);
        
        fetch('/request-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ wallet_address: walletAddress })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('OTP request response:', data);
            alert(data.message); // Show alert message
            
            // Open modal only if the request is successful
            if (data.success) {
        console.log('Data success is true, opening modal'); // Debugging statement
        openModal(); // Open modal after successful OTP request
    } else {
        console.log('Data success is false'); // Debugging statement
    }
        })
        .catch(error => {
            console.error('Error in OTP request:', error);
            alert('Failed to request OTP. Please try again.');
        });
    }

    // Validate OTP and Update Wallet Address
    function validateOtp() {
    const otp = document.getElementById('txtKYCOTP').value.trim();
    const walletAddress = document.getElementById('txtWalletAddress').value.trim();

    if (!otp) {
        alert('Please enter the OTP.');
        return;
    }

    fetch('/validate-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ otp: otp, wallet_address: walletAddress }) // Include wallet address here
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        
    })
    .catch(error => console.error('Error validating OTP:', error));
}


    // Event Listener to request OTP when clicking submit
    document.getElementById('btnSaveWalletAddress').addEventListener('click', requestOtp);
    document.getElementById('btnValidate').addEventListener('click', validateOtp);
</script>

@include('includes.footer')
