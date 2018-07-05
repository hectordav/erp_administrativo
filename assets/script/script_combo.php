<script type="text/javascript">
            $(document).ready(function() {
                $("#id_tipo").change(function() {
                    $("#id_tipo option:selected").each(function() {
                        id_tipo = $('#id_tipo').val();
                        $.post("<?php echo base_url(); ?>modelo/fill_marca", {
                            id_tipo : id_tipo
                        }, function(data) {
                            $("#id_marca").html(data);
                        });
                    });
                });
            });
        </script>