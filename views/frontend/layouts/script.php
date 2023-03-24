
<!-- script -->
    <script src="./assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://kit.fontawesome.com/b829c5162c.js" crossorigin="anonymous"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/popper.js"></script>
    <script src="./assets/js/script.js"></script>
    <script>
            $(document).ready(function () {
                $(".delete_id").click(function(){
                    $id = $(this).data('id');
                    $("#delete_id").val($id);
                })
            });
    </script>
    <script>
           
            $('#description').summernote({
                placeholder: 'Write about your article',
                tabsize: 2,
                height: 120,
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
    </script>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="deletepost">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-warning text-danger fa-2x mb-3"></i>
        <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure "Delete"?</h1>
      </div>
      <div class="modal-footer m-auto">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>Cancle</button>
        <form action="./controllers/PostController.php" method="POST">
            <input type="hidden" name="id" id="delete_id" value="">
            <input type="hidden" name="action" value="delete">
            <button class="btn btn-success" type="submit"><i class="fas fa-check me-2"></i>Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>