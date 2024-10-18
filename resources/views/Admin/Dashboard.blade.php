{{-- include header --}}
@include('layouts.header');
               <div class="content">
                  <input type="hidden" name="ctl00$ContentPlaceHolder1$HidOrgTypeDashboard" id="HidOrgTypeDashboard" />
                  <div class="modal-dialog modal-sm divpopup" id="divShareLink" style="width: 400px; display: none;">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title">Share your link</h4>
                           <button type="button" class="close" onclick="closediv();"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="divpopup-inner">
                           <div class="row">
                              <div class="col-sm-12 col-xs-12">
                                 <table class="tblwipitem">
                                    <tr>
                                       <th class="colhead" id="divShareImg" style="text-align: center;"></th>
                                    </tr>
                                    <tr>
                                       <td class="colval" style="text-align: center;">
                                          <a id="urlcopy1" class="linkcopy" onclick="CopyURL('urlcopy1');" data-val="https://fts.in.net/Reg/RefID/FTS1014129">https://fts.in.net/Reg/RefID/FTS1014129&nbsp;<i class="fa fa-copy"></i></a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="colval" style="text-align: center;">Share on</td>
                                    </tr>
                                    <tr>
                                       <td class="colval" style="text-align: center; font-size: 20px;">
                                          <br/>
                                          <a target="_blank" href="whatsapp://send?text=https://fts.in.net//Reg/RefID/FTS1014129">
                                          <i class="fa fa-whatsapp"></i>
                                          </a>&nbsp;
                                          <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://fts.in.net//Reg/RefID/FTS1014129">
                                          <i class="fa fa-facebook-square"></i>
                                          </a>&nbsp;
                                          <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=https://fts.in.net//Reg/RefID/FTS1014129">
                                          <i class="fa fa-linkedin-square"></i>
                                          </a>&nbsp;
                                          <a target="_blank" href="https://twitter.com/intent/tweet?url=https://fts.in.net//Reg/RefID/FTS1014129&text=">
                                          <i class="fa fa-twitter-square"></i>
                                          </a>
                                          &nbsp;
                                          <a target="_blank" href="https://pinterest.com/pin/create/button/?url=https://fts.in.net//Reg/RefID/FTS1014129&media=&description=">
                                          <i class="fa fa-pinterest-square"></i>
                                          </a>
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
                  <div class="row">
                     <div class="col-md-12">
                        <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"></script>
                        <div id="coinmarketcap-widget-marquee" coins="1,1027,825,4687" currency="USD" theme="light" transparent="true" show-symbol-logo="true"></div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 text-right">
                        <a href="WithdrawalRequest.aspx" class="btn btn-warning">Claim My Earning</a>
                     </div>
                  </div>
               
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card " style="margin-top: 10px;">
                           <div class="card-header ">
                              <h5 class="card-title">Latest News</h5>
                           </div>
                           <div class="card-body " style="height: 200px; overflow: auto">
                              <div id="divnews"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <script src="assets/js/plugins/chartjs.min.js"></script>
                  <script src="UserJs/Dashboard/Dashboard.js?version=2"></script>
               </div>
              {{-- include footer --}}
              @include('layouts.footer');