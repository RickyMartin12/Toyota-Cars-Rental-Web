(function () {
    var mainPanelUtilizadores = "#main-panel-utilizadores";
    var mainPanelServicos = "#main-panel-servicos";
    var mainPanelNovoTransfer = "#main-panel-novo-transfer";
    var mainPanelDashboard = "#main-panel-dashboard";

    //Nav Utilizadores
    $("#nav-btn-utilizadores").click(function () {
        var panel = $(mainPanelUtilizadores);
        if (!panel.is(":visible")) {
            $(mainPanelNovoTransfer).hide();
            $(mainPanelServicos).hide();
            $(mainPanelDashboard).hide();
            panel.fadeIn(400);
        }
    });

    //Novo Utilizador
    $("#btn_clear_form_novo_utilizador").click(function () {
        var form = $("#form_novo_utilizador");
        clearForm(form);
        $('#form_novo_utilizador_notification').hide();
    });
    $("#btn_submit_form_novo_utilizador").click(function () {
        var form = $("#form_novo_utilizador");
        form.submit();
    });
    $('#form_novo_utilizador input').keydown(function (e) {



        if (e.keyCode == 13) {
            $('#form_novo_utilizador').submit();
        }
    });
    $("#form_novo_utilizador").submit(function (e) {
        var form = $(this);
        var formData = form.serializeArray();

        var nome = formData[0].value;
        var email = formData[1].value;
        var utilizador = formData[2].value;
        var password = formData[3].value;
        var operadorId = formData[4].value;

        var notificationAlert = $('#form_novo_utilizador_notification');
        notificationAlert.hide();

        var buttonCriar = $("#btn_submit_form_novo_utilizador");
        buttonCriar.attr("disabled", "disabled");

        //var isValid = false;
        var isValid = true;


        //@TODO
        //@TODO
        //@TODO
        //@TODO
        //@TODO VALIDATION

        //validation rules
        if (isValid == true) {
            $.ajax({
                url: 'json.php',
                type: 'POST',
                cache: false,
                data: {
                    'action': 5,
                    'nome': nome,
                    'email': email,
                    'utilizador': utilizador,
                    'password': password,
                    'operador_admin_id': operadorId
                },
                error: function (error) {
                    notificationAlert.text('Erro ao comunicar com o servidor. Tente mais tarde.').show();
                },
                success: function (data) {
                    data = JSON.parse(data);

                    if (data['success'] == true) {

                        notificationAlert.text('Sucesso!!').show().delay(4000).fadeOut();

                        var rowOutput = [
                            '<tr class="row-show-' + data['data'] + '" data-id="' + data['data'] + '">',
                            '<td class="name-' + data['data'] + '">' + nome + '</td>',
                            '<td>' + email + '</td>',
                            '<td>' + utilizador + '</td>',
                            '<td>***********</td>',
                            '<td>',
                            '<div style="float:right;" class="btn-group" role="group" aria-label="true">',
                            '<button type="button" class="btn btn-sm btn-danger button-delete" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                            '<button type="button" class="btn btn-sm btn-warning button-edit"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></button>',
                            '</td>',
                            '</tr>'
                        ].join(" ");

                        rowOutput += [
                            '<tr class="row-hidden-' + data['data'] + '" data-id="' + data['data'] + '">',
                            '<td>' + nome + '</td>',
                            '<td>' + email + '</td>',
                            '<td>' + utilizador + '</td>',
                            '<td><input class="form-control password-change" type="password" value=""/></td>',
                            '<td>',
                            '<div style="float:right;" aria-label="..." class="btn-group" role="group">',
                            '<button class="btn btn-sm btn-success button-save" type="button">',
                            '<span aria-hidden="true" class="glyphicon glyphicon-open-file"></span>',
                            '</button>',
                            '<button class="btn btn-sm btn-default button-close" type="button">',
                            '<span aria-hidden="true" class="glyphicon glyphicon-remove-sign"></span>',
                            '</button>',
                            '</div>',
                            '</td>',
                            '</tr>'
                        ].join(" ");

                        $('#tabela_utilizadores').append(rowOutput);

                        clearForm(form);
                        buttonCriar.removeAttr("disabled");
                        return;
                    }

                    notificationAlert.text(data['data']).show();
                    buttonCriar.removeAttr("disabled");
                }
            });
        }
        e.preventDefault();
    });

    //when delete button is clicked
    $(document).on("click", "#tabela_utilizadores .button-delete", function (e) {
        var button = $(this);
        var dataId = button.parent().parent().parent().data('id');
        var nome = $('.name-'+dataId).text();
        $('#apagar_utilizador_nome').text(nome);
        var modalElement = "#modal_apagar_utilizador";
        $(modalElement + " " + '#modal_apagar_utilizador_id').val(dataId);
        $(modalElement).modal('show');
    });

    //when edit button is clicked
    $(document).on("click", "#tabela_utilizadores .button-edit", function (e) {
        var button = $(this);
        var dataId = button.parent().parent().parent().data('id');

        $("#tabela_utilizadores " + ".row-show-" + dataId).hide();
        $("#tabela_utilizadores " + ".row-hidden-" + dataId).fadeIn(300);
    });

    //when close button is clicked
    $(document).on("click", "#tabela_utilizadores .button-close", function (e) {
        var button = $(this);
        var dataId = button.closest('tr').data('id');

        $("#tabela_utilizadores " + ".row-hidden-" + dataId).hide();
        $("#tabela_utilizadores " + ".row-show-" + dataId).fadeIn(300);
    });

    //when save button is clicked
    $(document).on("click", "#tabela_utilizadores .button-save", function (e) {
        var button = $(this);
        var dataId = button.closest('tr').data('id');
        var inputValue = $("#tabela_utilizadores " + ".row-hidden-" + dataId + " " + 'input').val();

        $.ajax({
            url: 'json.php',
            type: 'POST',
            cache: false,
            data: {
                'action': 6,
                'id': dataId,
                'password': inputValue
            },
            error: function (error) {

                 $('.back').fadeOut();
                 $("#avisos_cliente").modal();
                 $('.infocolor').addClass('w3-red').removeClass('w3-amber w3-green');
                 $('.mensagem_head').html('Aviso');
                 $('.mensagem_txt').html('A password não foi modificada, verifique a ligação e tente novamente.');
                 setTimeout(function(){ $("#avisos_cliente").modal('hide'); }, 5000);

            },
            success: function (data) {
                data = JSON.parse(data);

                if (data['success'] == true) {
                    $("#avisos_cliente").modal();
                    $('.infocolor').addClass('w3-green').removeClass('w3-red w3-amber');
                    $('.mensagem_head').html('Sucesso');
                    $('.mensagem_txt').html('A password foi alterada com successo.');
                    $('.btn-cancel').trigger('click');
                    $('html, body').animate({ scrollTop: 0 }, 500);
                    setTimeout(function(){ $("#avisos_cliente").modal('hide'); }, 2500);
                    $("#tabela_utilizadores " + ".row-hidden-" + dataId).hide();
                    $("#tabela_utilizadores " + ".row-show-" + dataId).fadeIn(300);
                } else {

                    $("#avisos_cliente").modal();
                    $('.infocolor').addClass('w3-amber').removeClass('w3-red w3-green');
                    $('.mensagem_head').html('Por favor, verifique:');
                    $('.mensagem_txt').html('A password inserida é igual, modifique e tente novamente.');
                    $('.btn-cancel').trigger('click');
                    $('html, body').animate({ scrollTop: 0 }, 500);
                    setTimeout(function(){ $("#avisos_cliente").modal('hide'); }, 2500);

                }
            }
        });
    });

    //when modal delete button is clicked
    $('#modal_apagar_utilizador .btn-danger').click(function () {
        var modalElement = "#modal_apagar_utilizador";
        var id = $('#modal_apagar_utilizador_id').val();
        $.ajax({
            url: 'json.php',
            type: 'POST',
            cache: false,
            data: {
                'action': 7,
                'id': id
            },
            error: function (error) {
                //console.log('error');
            },
            success: function (data) {
                data = JSON.parse(data);
                $(modalElement).modal('hide');
                if (data['success'] == true) {
                    $("#tabela_utilizadores " + ".row-show-" + id).remove();
                    $("#tabela_utilizadores " + ".row-hidden-" + id).remove();
                } else {
                    alert('error!');
                }
            }
        });
    });

    /**
     * Help Functions
     */
    function clearForm(form) {
        $(':input', form).each(function () {
            var type = this.type;
            var tag = this.tagName.toLowerCase();
            if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'email')
                this.value = "";
            else if (type == 'checkbox' || type == 'radio')
                this.checked = false;
            else if (tag == 'select')
                this.selectedIndex = -1;
        });
    };
}());