<style>
    @media(max-width:700px){
                #exampleModalLabel{
                    font-size: 20px!important;
                }
    }

    .btn-close:hover{
        border: none!important;
    }
</style>
<footer class="footer-section sticky-footer">
    <div class="container">
        <div class="footer-links">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-top-area">
                        <div class="left">
                            <a href="#">
                                <img src="{{asset('images/logo.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('images/goole_play_btn.png')}}" alt="">
                            </a>
                        </div>
                        <div class="right">
                            <ul class="links">
                                <li>
                                    <a type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal1">About</a>
                                </li>
                                <li>
                                    <a type="button"   data-bs-toggle="modal" data-bs-target="#exampleModal2">FAQs</a>
                                </li>
                                <li>
                                    <a href="mailto:info@expressforecst.com">Contact</a>
                                </li>
                                <li>
                                    <a href="#"   data-bs-toggle="modal" data-bs-target="#exampleModal">Terms of Service</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <hr class="hr2">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="copyr-text">
                            <span>
                                Copyright © {{date('Y')}}.All Rights Reserved By
                            </span>
                        <a href="#">{{str_replace('_', ' ', env('APP_NAME'))}}</a>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <ul class="footer-social-links">
                        <li>
                            <a href="#">
                                <i class="fab fa-twitter mt-2"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-facebook-f mt-2"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-instagram mt-2"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-dribbble mt-2"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modal Terms -->
<div class="modal fade text-justify" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><b class="text-uppercase">Acceptance of Terms</b></h1>
        <button type="button" class="btn-close bg-white border-0 ms-5 w-25  text-right text-danger font-weight-bolder" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
      <p>
         By accessing or using expressforecast, you agree to be bound by these Terms of Service. If you do not agree to these Terms, please do not use the Site. We reserve the right to modify these Terms at any time without prior notice. Your continued use of the Site after any modification constitutes your acceptance of the revised Terms.
     </p>

        <b>Use of the Site</b>
        <p>Expressforecast provides lottery predictions and analysis for educational and entertainment purposes only. We do not guarantee the accuracy, completeness, or timeliness of any information on the Site. We are not responsible for any loss or damage resulting from your reliance on any information on the Site. You agree not to use expressforecast for any illegal or unauthorized purpose. You also agree not to use expresforecast to transmit any content that is unlawful, harmful, threatening, abusive, harassing, defamatory, vulgar, obscene, or otherwise objectionable. </p>

        <b>Intellectual Property </b>
        <p>Expressforecast and its contents are owned by us or our licensors and are protected by intellectual property laws. You may not reproduce, modify, distribute, or publicly display any content from the Site without our prior written consent. </p><br/>

        <b>Links to Third-Party Websites </b>
        <p>Expressforecast may contain links to third-party websites that are not owned or controlled by us. We are not responsible for the content, privacy policies, or practices of any third-party websites. We recommend that you review the terms and policies of any third-party websites that you visit. </p>

        <b>Disclaimer of Warranties </b>
        <p>EXPRESSFORECAST AND ITS CONTENTS ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT. WE DO NOT WARRANT THAT THE SITE WILL BE UNINTERRUPTED OR ERROR-FREE, THAT DEFECTS WILL BE CORRECTED, OR THAT THE SITE OR THE SERVER THAT MAKES IT AVAILABLE ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. </p>

        <b>Limitation of Liability </b>
        <p>IN NO EVENT SHALL WE BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, OR CONSEQUENTIAL DAMAGES ARISING OUT OF OR IN CONNECTION WITH YOUR USE OF EXPRESSFORECAST OR YOUR RELIANCE ON ANY INFORMATION ON EXPRESSFORECAST, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. SOME STATES OR JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, SO THE ABOVE LIMITATION MAY NOT APPLY TO YOU. </p>

        <b>Indemnification </b>
        <p>You agree to indemnify and hold us harmless from and against any claims, damages, expenses, or losses arising out of or in connection with your use of the Site or your violation of these Terms. </p>

        <b>Governing Law  </b>
        <p>These Terms shall be governed by and construed in accordance with the laws of Nigeria without giving effect to any principles of conflicts of law. </p>

        <b>Dispute Resolution </b>
        <p>Any disputes arising out of or in connection with these Terms shall be resolved through binding arbitration in accordance with the rules of the Nigerian arbitration and judgment upon the award rendered by the arbitrator(s) may be entered in any court having jurisdiction thereof. </p>

        <b>Termination  </b>
        <p>We may terminate or suspend your access to Expressforecast at any time, without notice, for any reason, including without limitation, breach of these Terms. </p>

        <b>Miscellaneous </b>
        <p>These Terms constitute the entire agreement between you and us regarding your use of Expressforecast. If any provision of these Terms is found to be invalid or unenforceable, the remaining provisions shall remain in full force and effect. Our failure to enforce any right or provision of these Terms shall not be </p>

      </div>
    </div>
  </div>
</div>

<!-- Modal About -->
<div class="modal fade text-justify" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><b class="text-uppercase text-center  text-right text-danger font-weight-bolder">About Us</b></h1>
        <button type="button" class="btn-close bg-white border-0 ms-5 w-25  text-right text-danger font-weight-bolder" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
      <p class="lh-lg">
        Welcome to Expressforecast where we use advanced statistical models and data analysis to help you improve your chances of winning the lottery.

        At Expressforecast, we understand that playing the lottery is a popular pastime for many people, and we want to help you make the most of your investment. Our team of experts is dedicated to providing you with accurate and reliable lottery predictions, based on the latest data and trends.

        We use sophisticated algorithms to analyse past lottery results and identify patterns that can help us make predictions about future draws. Our models take into account a range of factors, including the frequency of numbers drawn, the distribution of numbers across different lottery games, and the probability of certain combinations appearing.

        We also provide a wealth of resources and tools to help you maximize your chances of winning the lottery. Expressforecast includes comprehensive guides and tutorials on lottery strategies and techniques, as well as latest results.

        At our Expressforecast, we are committed to providing you with the best possible service and helping you achieve your goals. Whether you are a casual player or a seasoned veteran, we are here to support you every step of the way and help you increase your chances of hitting the jackpot.

     </p>
      </div>
    </div>
  </div>
</div>


<!-- Modal FAQ -->
<div class="modal fade text-justify" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><b class="text-uppercase">FAQs</b></h1>
        <button type="button" class="btn-close bg-white border-0 ms-5 w-25 text-right text-danger font-weight-bolder" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">   
        <b>Q: How do you predict lottery numbers?</b>
        <p>A: Expressforecast uses a complex algorithm that analyzes past winning numbers, patterns, and trends to predict the most likely numbers to be drawn.</p>

        <b>Q: How accurate are your lottery predictions?</b>
        <p>A: Our predictions are not guaranteed, as lottery draws are ultimately based on chance. However, our algorithm has a proven track record of accurately predicting winning numbers.</p>

        <b>Q: Can you guarantee that I will win the lottery if I use your service?</b>
        <p>A: No, we cannot guarantee that you will win the lottery by using our service. Lottery draws are random and unpredictable, and no system or algorithm can guarantee a win.</p>

        <b>Q: What types of lotteries do you offer predictions for?</b>
        <p>A: We offer lottery predictions for a wide range of lotteries, including all Nigerian known lotteries.</p>

        <b>Q: How often are your lottery predictions updated?</b>
        <p>A: Our lottery predictions are updated on a regular basis, taking into account the latest winning numbers and any changes to the lottery rules.</p>

        <b>Q: Do you offer any other services besides lottery predictions?</b>
        <p>A: Yes, we also offer analysis and insights on lottery trends, tips and updates on the latest lottery draws and results.</p>

        <b>Q: How can I purchase lottery tickets through your site?</b>
        <p>A: We do not sell lottery tickets directly through our site. However, we provide links and information on where to purchase tickets for the lotteries we offer predictions for.</p>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>
<script src="{{asset('js/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<!-- <script src="{{asset('js/bootstrap.min.js')}}"></script> -->
<script src="{{asset('js/magnific-popup.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/countdown.min.js')}}"></script>
<!-- <script src="{{asset('js/bootstrap-popover-x.min.js')}}"></script> -->
<script src="{{asset('js/amd.js')}}"></script>
<script src="{{asset('js/nice-select.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>