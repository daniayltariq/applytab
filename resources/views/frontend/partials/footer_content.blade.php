<footer class="footer">
    <div class="footer__wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="footer__info">
                        <div class="footer__info--logo">
                            <img src="{{ asset('frontend/assets/images/footer-logo.svg') }}" alt="image">
                        </div>
                        <div class="footer__info--content">
                            <p class="paragraph dark">@lang('footer_paragraph')</p>
                            <div class="social">
                                <ul>
                                    <li class="facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="linkedin"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li class="youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="footer__content-wrapper">
                        <div class="footer__list">
                            <ul>
                                <li>@lang('Explore')</li>
                                <li><a href="#">@lang('About')</a></li>
                                <li><a href="#">@lang('Our Team')</a></li>
                                <li><a href="#">@lang('Features')</a></li>
                                <li><a href="#">@lang('Blog')</a></li>
                                <li><a href="#">@lang('How It Works')</a></li>
                            </ul>
                        </div>

                        <div class="download-buttons">
                            <h5>@lang('Download')</h5>
                            <a href="#" class="google-play mb-5">
                                <i class="fab fa-google-play"></i>
                                <div class="button-content">
                                    <h6>@lang('GET IT ON') <span>Google Play</span></h6>
                                </div>
                            </a>
                            <a href="#" class="apple-store">
                                <i class="fab fa-apple"></i>
                                <div class="button-content">
                                    <h6>@lang('GET IT ON') <span>Apple Store</span></h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
