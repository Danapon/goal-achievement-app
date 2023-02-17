<footer class="footer">
  <div class="footer_left">
    <p class="copyright">&copy; 2023 Danapon</p>
  </div>
  <div class="footer_center">
    <!-- ログイン後とログイン前で遷移先を変える -->
    @guest
    <a href="{{ url('/') }}"><img src="{{ asset('images/skelton.png') }}" alt="スケルトン" class="logo_image"></a>    
    @else
    <a href="{{ route('goals.index') }}"><img src="{{ asset('images/skelton.png') }}" alt="スケルトン" class="logo_image"></a>
    @endif
  </div>
  <div class="footer_right">
    <a href="https://twitter.com/Hope45284665"><img src="{{ asset('images/Pixelart-015-twitter.png') }}" alt="twitter" class="sns_twitter"></a>
    <a href="#"><img src="{{ asset('images/Pixelart-016-Instagram.png') }}" alt="instagram" class="sns_instagram"></a>
    <a href="#"><img src="{{ asset('images/Pixelart-017-Youtube.png') }}" alt="youtube" class="sns_youtube"></a>
  </div>
</footer>