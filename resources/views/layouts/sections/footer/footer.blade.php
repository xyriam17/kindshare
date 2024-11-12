@php
$containerFooter = (isset($configData['contentLayout']) && $configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
@endphp

<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
  <div class="{{ $containerFooter }}">
    <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
      <div class="text-body">
        © <script>document.write(new Date().getFullYear())</script>, made with ❤️ by <a href="#" target="_blank" class="footer-link">KindShare Team</a>
      </div>

    </div>
  </div>
</footer>
<!--/ Footer-->
