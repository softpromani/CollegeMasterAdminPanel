  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer mt-5">
    <div class="copyright">
      &copy; {{ date('Y') }} Copyright <strong><span>{{ config('college-admin.branding.app_name', 'College Master Admin') }}</span></strong>. All Rights Reserved
    </div>
    <div class="credits d-flex justify-content-center align-items-center gap-2 mt-1">
      <span class="badge bg-secondary-subtle text-dark border">
        Version <strong>v{{ \CollegeAdmin\CollegeAdmin::VERSION }}</strong>
      </span>
      <span>|</span>
      <span>{{ config('college-admin.branding.footer_text', 'College Master Admin Panel') }}</span>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
