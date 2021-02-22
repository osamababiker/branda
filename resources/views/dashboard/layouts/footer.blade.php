<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>جميع الحقوق محفوظة &copy; برندا <?php echo date('Y') ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-body text-right">اضغط على تسجيل خروج اذا كنت ترغب في انهاء هذه الجلسة</div>
  <div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">اغلاق</button>
    <form action="{{ route('logout') }}" method="post">
      @csrf
      <button type="submit" class="btn btn-primary">تسجيل خروج</button>
    </form>
  </div>
</div>
</div>
</div>


@include('dashboard/layouts/alert')
