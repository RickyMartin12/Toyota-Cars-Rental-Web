(function () {
    $('.collapse').collapse();

    $('#taxa_de_servico').change(function () {
        if ($(this).is(":checked")) {
            $('#valor').removeAttr('disabled');

            var tipoElement = $('#tipo');
            tipoElement.removeAttr("disabled");
            tipoElement.selectpicker('refresh');
        } else {
            $('#valor').attr('disabled', 'disabled');

            var tipoElement = $('#tipo');
            tipoElement.attr('disabled', 'disabled');
            tipoElement.selectpicker('refresh');
        }
        $('#taxa_de_servico').val($(this).is(':checked'));
    });

    $('#save-btn').click(function (e) {
        e.preventDefault();

        var taxa_de_servico = $('#taxa_de_servico').val();
        var tipo_taxa_de_servico = $('#tipo').val();
        var valor_taxa_de_servico = $('#valor').val();
        var operador = $('#operador').val();

        var formData = {
            'id': operador,
            'taxa': taxa_de_servico,
            'tipo': tipo_taxa_de_servico,
            'valor': valor_taxa_de_servico,
            'action': 13
        };

        $.ajax({
            url: 'json.php',
            type: 'POST',
            cache: false,
            data: formData,
            error: function (error) {
                console.log(JSON.stringify(error));
            }
        });
    });


}());