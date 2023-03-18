</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- CKEditor 5 JavaScript -->
<script>
    ClassicEditor
        .create(document.querySelector('#editor')).then(editor => {
            editor.editing.view.change(writer => {
                writer.setStyle('min-height', '200px', editor.editing.view.document.getRoot());
            });
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<!-- Select all check box JavaScript -->
<script>
    function selectAll(source) {
        // Get all checkboxes in the table
        var checkboxes = document.querySelectorAll('#viewposts input[type="checkbox"]');

        // Set the "checked" property of each checkbox to the value of the "Select All" checkbox
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>

</body>

</html>