@include('includes.header')
<style>
    .popup {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.popup-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 40%; /* Could be more or less, depending on screen size */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
@media (max-width: 768px) {
    .popup-content {
    
    width: 80%; /* Could be more or less, depending on screen size */
}
}

/* Styles for tablets (min-width: 769px and max-width: 1024px) */
@media (min-width: 769px) and (max-width: 1024px) {
    .popup-content {
    
    width: 80%; /* Could be more or less, depending on screen size */
}
}



</style>
<div class="content">
    <div class="row">
        <div class="offset-md-2 col-md-6">
            <div class="card smallPageHeader">
                <div class="card-header">
                    <div class="divPageTitle">
                        <h5>Activate/Upgrade My ID</h5>
                        <div class="btnRight"></div>
                        <div class="clearfix"></div>
                        {{-- @if(session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif --}}
                    </div>
                </div>
                <div class="row"  style="display: none;">
                    <div class="col-md-12 col-xs-12">
                        <div class="validate-box">
                            <ul></ul>
                        </div>
                    </div>
                </div>
                <div class="card-body form_design" >
                    <form action="{{ route('invest') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Please make the payment to this address: <span class="btn btn-warning hvr-glow" onclick="openQRCodePopup()"> Scan QR Code </span></label>
                                                <div class="d-flex align-items-center">
                                                    <p id="address" class="form-control" style="font-weight: bold; margin-right: 10px;">
                                                        0x85569E73c9223CBE9c99DcF40bbA654BDEA5Ec60
                                                    </p>
                                                    <i class="fas fa-copy" id="copyIcon" style="cursor: pointer;" title="Copy address"></i>
                                                </div>
                                            </div>
                                            <div id="qrCodePopup" class="popup">
                                                <div class="popup-content">
                                                    <span class="close" onclick="closeQRCodePopup()">&times;</span>
                                                    <h2>Scan QR Code</h2>
                                                    <img src="assets/img/QRCODE.jpg" alt="QR Code" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Package: *</label>
                                                <select name="package_id" class="form-control" required>
                                                    @foreach($all_packages as $package)
                                                        <option value="{{ $package->id }}">Package of ${{ $package->amount }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-warning hvr-glow">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/search.js"></script>
    <script src="UserJs/Network/ActivateMyID.js?version=4"></script>
</div>

@include('includes.footer')

<script>
    function openQRCodePopup() {
    document.getElementById("qrCodePopup").style.display = "block";
}

function closeQRCodePopup() {
    document.getElementById("qrCodePopup").style.display = "none";
}

// Close the popup when clicking outside of the popup content
window.onclick = function(event) {
    var popup = document.getElementById("qrCodePopup");
    if (event.target == popup) {
        popup.style.display = "none";
    }
}
</script>
<script>
    document.getElementById('copyIcon').addEventListener('click', function() {
        // Select the address text
        const addressElement = document.getElementById('address');
        const addressText = addressElement.innerText;

        // Create a temporary textarea to copy the address text
        const textarea = document.createElement('textarea');
        textarea.value = addressText;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);

        // Optional: Alert or show a message to indicate the address has been copied
        alert('Address copied to clipboard!');
    });
</script>

