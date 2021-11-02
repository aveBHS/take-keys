    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Take-Keys 2021</div>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/admin/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/admin/assets/demo/chart-area-demo.js"></script>
    <script src="/admin/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/admin/js/datatables-simple-demo.js"></script>
    <?php
    global $request;
    $_system_error = $request->getFlash("system_error");
    if(!is_null($_system_error)){
    ?>
        <script>
            swal("Системная ошибка", "<?=$_system_error?>", "error");
        </script>
    <?php } ?>
    </body>
</html>