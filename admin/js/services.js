function pagination(active, min, max) {

    var html = '';
    if (min == max || max == 0) {
        return html;
    }

    html += active != 1 ? '<li>' : '<li class="disabled">';
    html += [
        '<a href="#" aria-label="Previous" class="previousPageNumber">',
        '<span aria-hidden="true">&laquo;</span>',
        '</a>',
        '</li>'
    ].join(" ");

    for (var i = min; i <= max; i++) {
        html += '<li class="';
        if (active == i) {
            html += 'active';
        } else {
            html += 'eachPageNumber';
        }
        html += '"><a href="#">' + i + '</a>'
        html += '</li>';
    }

    html += active != max ? '<li>' : '<li class="disabled">';
    html += [
        '<a href="#" aria-label="Next" class="nextPageNumber">',
        '<span aria-hidden="true">&raquo;</span>',
        '</a>',
        '</li>'
    ].join(" ");

    return html;
}

function appendHtmlToTable(services) {

    var html = '';
    $.each(services, function (index, service) {

        html += '<tr>';

        html += [
            '<td>' + service['id'] + '</td>',
            '<td>' + moment(service['data_servico'] * 1000).format('DD/MM/YYYY') + '</td>',
            '<td>' + moment(service['hrs'] * 1000).format('HH:mm') + '</td>',
            '<td>' + service['servico'] + '</td>',
            '<td>' + service['nome_cl'] + '</td>',
            '<td>' + service['pax'] + '</td>'
        ].join(" ");

        var pago = 'Não';

        if (service['pag_staf'] == 'Sim' || service['pag_ope'] == 'Sim') {
            pago = 'Sim';
        }

        html += [
            '<td>' + pago + '</td>',
            '<td>' + service['estado'] + '</td>'
        ].join(" ");

        html += [
            '<td>',
            '<div class="btn-toolbar" role="toolbar">',
            '<div class="btn-group" role="group" aria-label="First group" data-id="' + service['id'] + '">',
            '<button type="button" class="btn btn-sm btn-primary">',
            '<span class="glyphicon glyphicon-edit"></span>',
            '</button>',
            '<button type="button" class="btn btn-sm btn-default btn-pdf">',
            '<span class="glyphicon glyphicon-print"></span>',
            '</button>',
            '<button type="button" class="btn btn-sm btn-default btn-email">',
            '<span class="glyphicon glyphicon-envelope"></span>',
            '</button>',
            '<button type="button" class="btn btn-sm btn-default btn-marker">',
            '<span class="glyphicon glyphicon-map-marker" style="color:#41aadb;"></span>',
            '</button>',
            '</div>',
            '</div>',
            '</td>'
        ].join(" ");

        html += '</tr>';
    });

    return html;
}

(function () {

    $('#datetimepicker6').datetimepicker({
        ignoreReadonly: true, format: 'DD/MM/YYYY',
        locale: 'pt', widgetPositioning: {horizontal: 'right', vertical: 'bottom'}
    });
    $('#datetimepicker7').datetimepicker({
        ignoreReadonly: true, format: 'DD/MM/YYYY',
        locale: 'pt', useCurrent: false, widgetPositioning: {horizontal: 'right', vertical: 'bottom'} //Important! See issue #1075
    });
    $("#datetimepicker6").on("dp.change", function (e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker7").on("dp.change", function (e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });

    $(document).on("click", ".pagination li a", function (e) {
        e.preventDefault();
    });

    var filterServices = function (page, operador, service, status, id, ini, fim) {
        $.ajax({
            url: 'json.php',
            type: 'GET',
            cache: false,
            data: {
                'page': page,
                'operador': operador,
                'service': service,
                'status': status,
                'id': id,
                'ini': ini,
                'fim': fim,
                'action': 8
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
            success: function (data) {
                data = JSON.parse(data);

                var num_of_pages = data['num_of_pages'];
                $('#services__total').html(data['total_of_services'] + " resultados encontrados.");
                $('ul.pagination').html(pagination(page, 1, num_of_pages));
                $('#maxPage').val(num_of_pages);
                $('#services__table__body tr').remove();

                $('#services__table__body').append(appendHtmlToTable(data['services']));
            }
        });
    };

    $(document).on("click", ".pagination .eachPageNumber", function (e) {
        e.preventDefault();

        var page = $(this).find('a').html();
        var operador = $('#operador').val();

        var service = $.trim($('#filter_service').find("option:selected").text());
        service = service === "" ? -1 : service;

        var status = $.trim($('#filter_status').find("option:selected").text());
        status = status === "" ? -1 : status;

        var fim = $.trim($('#date_fim').val());
        fim = fim === "" ? -1 : fim;

        var ini = $.trim($('#date_ini').val());
        ini = ini === "" ? -1 : ini;

        var id = $.trim($('#filter_id').val());
        id = id === "" ? -1 : id;

        filterServices(page, operador, service, status, id, fim, ini);
    });

    //previous Page Number
    $(document).on("click", ".previousPageNumber", function (e) {
        e.preventDefault();

        if ($(this).parent().hasClass('disabled'))
            return;

        var page = $('ul.pagination li.active a').html();
        page = parseInt(page) - 1;
        if (page <= 0) {
            page = 1;
        }
        var operador = $('#operador').val();

        var service = $.trim($('#filter_service').find("option:selected").text());
        service = service === "" ? -1 : service;

        var status = $.trim($('#filter_status').find("option:selected").text());
        status = status === "" ? -1 : status;

        var fim = $.trim($('#date_fim').val());
        fim = fim === "" ? -1 : fim;

        var ini = $.trim($('#date_ini').val());
        ini = ini === "" ? -1 : ini;

        var id = $.trim($('#filter_id').val());
        id = id === "" ? -1 : id;

        filterServices(page, operador, service, status, id, fim, ini);
    });

    //next Page Number
    $(document).on("click", ".nextPageNumber", function (e) {
        e.preventDefault();

        if ($(this).parent().hasClass('disabled'))
            return;

        var page = $('ul.pagination li.active a').html();
        page = parseInt(page) + 1;

        var maxPage = parseInt($('#maxPage').val());
        if (page > maxPage) {
            page = maxPage;
        }
        var operador = $('#operador').val();

        var service = $.trim($('#filter_service').find("option:selected").text());
        service = service === "" ? -1 : service;

        var status = $.trim($('#filter_status').find("option:selected").text());
        status = status === "" ? -1 : status;

        var id = $.trim($('#filter_id').val());
        id = id === "" ? -1 : id;

        filterServices(page, operador, service, status, id);
    });

    $('#filter_service').on('changed.bs.select', function (e) {

        var page = 1;
        var operador = $('#operador').val();

        var service = $.trim($(this).find("option:selected").text());
        service = service === "" ? -1 : service;

        var status = $.trim($('#filter_status').find("option:selected").text());
        status = status === "" ? -1 : status;

        var fim = $.trim($('#date_fim').val());
        fim = fim === "" ? -1 : fim;

        var ini = $.trim($('#date_ini').val());
        ini = ini === "" ? -1 : ini;

        var id = $.trim($('#filter_id').val());
        id = id === "" ? -1 : id;

        filterServices(page, operador, service, status, id, fim, ini);
    });

    $('#filter_status').on('changed.bs.select', function (e) {
        var page = 1;
        var operador = $('#operador').val();

        var service = $.trim($('#filter_service').find("option:selected").text());
        service = service === "" ? -1 : service;

        var status = $.trim($(this).find("option:selected").text());
        status = status === "" ? -1 : status;

        var fim = $.trim($('#date_fim').val());
        fim = fim === "" ? -1 : fim;

        var ini = $.trim($('#date_ini').val());
        ini = ini === "" ? -1 : ini;

        var id = $.trim($('#filter_id').val());
        id = id === "" ? -1 : id;

        filterServices(page, operador, service, status, id, fim, ini);
    });

    $("#filter_id").keyup(function (e) {

        var id = $(this).val();

        if (id.length > 0 && id.length < 3) {
            return;
        }
        id = id === "" ? -1 : id;

        var page = 1;
        var operador = $('#operador').val();

        var service = $.trim($('#filter_service').find("option:selected").text());
        service = service === "" ? -1 : service;

        var fim = $.trim($('#date_fim').val());
        fim = fim === "" ? -1 : fim;

        var ini = $.trim($('#date_ini').val());
        ini = ini === "" ? -1 : ini;

        var status = $.trim($('#filter_status').find("option:selected").text());
        status = status === "" ? -1 : status;

        filterServices(page, operador, service, status, id, fim, ini);
    });

    $(document).on("click", "#services__table #services__table__body tr td button.btn-pdf", function () {
        var id = $(this).parent().data('id');
        $("#num").val(id);
        $("#mylangs").val();

        $("#pdf_modal").modal();

        //$("#pdf_modal").append('<form class="mypdf" style="display: none;" action="../operators/includes/services/requests/json/transfers.php" method="post" ><input hidden type="text" name="id" value="'+id+'"></form>');
        //setTimeout(function() {$(".mypdf").trigger("submit");}, 50);
    });


    $(document).on("click", "#services__table #services__table__body tr td button.btn-email", function () {
        var id = $(this).parent().data('id');
        setTimeout(function () {
            dataValue = "id=" + id;

            console.log(dataValue);

            $.ajax({
                url: '../operators/includes/services/requests/json/mail_transfers.php',
                data: dataValue,
                type: 'POST',
                success: function (data) {
                    console.log(data);
                    if (data == 0) {
                        $('.debug-url').html('Não foi possivel enviar email para elemento do staff: <b>' + id + '</b>, p.f verifique os dados inseridos no link: "Configuracoes -> Sistema".');
                        $("#mensagem_ko").trigger('click');
                    }
                    else if (data == 10) {
                        $('.debug-url').html('Não foi possivel enviar email para elemento do staff: <b>' + id + '</b>, p.f verifique os dados inseridos no link: "Staff -> Editar".');
                        $("#mensagem_ko").trigger('click');
                    }
                    else if (data == 110) {
                        $('.debug-url').html('Não foi possivel enviar email, o elemento do staff: <b>' + id + '</b> sem serviços atribuidos. p.f. atribua servicos.');
                        $("#mensagem_ko").trigger('click');
                    }
                    else if (data == 1111) {
                        $('.debug-url').html('Os Servicos foram enviados com sucesso, para o elemento do staff: <b>' + id + '</b>.');
                        $('.bt-' + id).addClass('btn-success');
                        $("#mensagem_ok").trigger('click');
                    }

                    else {
                        $('.debug-url').html('Erro, não definido!!');
                        $("#mensagem_ko").trigger('click');
                    }
                },
                error: function (data) {
                    $('.debug-url').html('Erro ao enviar dados para o elemento do staff: <b>' + id + '</b>, p.f. verifique o Acesso Internet.');
                    $("#mensagem_ko").trigger('click');
                }
            });

        }, 500);


    });


    $(document).on("click", "#services__table #services__table__body tr td button.btn-marker", function () {
        var id = $(this).parent().data('id');
        console.log('devolve minutos da coordenada do serviços');

    });

    $(document).on("click", "#services__table #services__table__body tr td button.btn-primary", function (e) {

        var id = $(this).parent().data('id');
        var operador = $('#operador').val();

        $.ajax({
            url: 'json.php',
            type: 'GET',
            cache: false,
            data: {
                'operador': operador,
                'id': id,
                'action': 9
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
            success: function (data) {
                data = JSON.parse(data);

                if (data.id) {
                    var servicesModal = $('#services__modal');
                    servicesModal.find('#services__modal__title').html('Serviço - #' + data.id);
                    servicesModal.find('#service_id').val(data.id);

                    //servico
                    var servicoElement = servicesModal.find('#novo_transfer_form_servico');
                    if (!servicoElement.is(':disabled')) {
                        servicoElement.attr("disabled", "disabled");
                    }
                    var serviceIndex = servicesModal.find("#novo_transfer_form_servico option:contains(" + data.servico + ")").val();
                    if (serviceIndex != '') {
                        servicoElement.selectpicker('val', serviceIndex);
                    } else {
                        servicoElement.selectpicker('val', '');
                    }
                    servicoElement.selectpicker('refresh');

                    //zona de recolha
                    var zonaDeRecolhaElement = servicesModal.find('#novo_transfer_form_zona-de-recolha');
                    zonaDeRecolhaElement.val(data.local_recolha);

                    //zona de entrega
                    var zonaDeEntregaElement = servicesModal.find('#novo_transfer_form_zona-de-entrega');
                    zonaDeEntregaElement.val(data.local_entrega);

                    //Datetime picker
                    var datetimeElement = servicesModal.find('#novo_transfer_form_datetime');
                    var oldDatetimeElement = $('#old-novo_transfer_form_datetime');
                    if (datetimeElement.is(':disabled')) {
                        datetimeElement.removeAttr("disabled");
                    }
                    datetimeElement.val(moment(data.hrs * 1000).format('DD/MM/YYYY HH:mm'));
                    oldDatetimeElement.val(moment(data.hrs * 1000).format('DD/MM/YYYY HH:mm'));


                    //local frequente recolha checkbox
                    servicesModal.find('#novo_transfer_form_local-frequente-recolha').parent().parent().parent().hide();

                    //local frequente entrega
                    servicesModal.find('#novo_transfer_form_local-frequente-entrega').parent().parent().parent().hide();

                    //retorno
                    servicesModal.find('#novo_transfer_form_retorno').parent().parent().parent().hide();

                    //Dados Cliente
                    //email
                    var clienteEmailElement = servicesModal.find('#novo_transfer_form_e-mail');
                    clienteEmailElement.val(data.email);

                    //nome
                    var clienteNomeElement = servicesModal.find('#novo_transfer_form_nome-cliente');
                    clienteNomeElement.val(data.nome_cl);

                    //telefone
                    var clienteTelefoneElement = servicesModal.find('#novo_transfer_form_telefone');
                    clienteTelefoneElement.val(data.telefone);

                    //quarto
                    var clienteQuartoElement = servicesModal.find('#novo_transfer_form_numero-quarto');
                    clienteQuartoElement.val(data.quarto);

                    //pais
                    var clientePaisElement = servicesModal.find('#novo_transfer_form_pais');
                    var clientePaisIndex = servicesModal.find("#novo_transfer_form_pais option:contains(" + data.pais + ")").val();
                    if (clientePaisIndex !== '') {
                        clientePaisElement.selectpicker('val', clientePaisIndex);
                    } else {
                        clientePaisElement.selectpicker('val', '');
                    }
                    clientePaisElement.selectpicker('refresh');

                    //Dados de Partida
                    //morada de Recolha
                    var moradaRecolhaElement = servicesModal.find('#novo_transfer_form_morada-de-recolha');
                    moradaRecolhaElement.val(data.morada_recolha);

                    //button recolha GPS
                    var buttonRecolhaGps = servicesModal.find('#novo_transfer_form_group_morada-de-recolha_button-gps');
                    buttonRecolhaGps.hide();

                    //Numero Voo
                    /*var numeroVooElement = $('#novo_transfer_form_voo');
                     if (numeroVooElement.is(':disabled')) {
                     numeroVooElement.removeAttr("disabled");
                     }*/

                    //DatetimeChegada picker
                    /* var datetimeChegadaElement = $('#novo_transfer_form_datetime-Chegada');
                     if (datetimeChegadaElement.is(':disabled')) {
                     datetimeChegadaElement.removeAttr("disabled");
                     }*/

                    var titleAddressElement = servicesModal.find('#novo_transfer_form_title_address');
                    titleAddressElement.html('Dados de Serviço');

                    //morada de Entrega
                    var moradaEntregaElement = servicesModal.find('#novo_transfer_form_morada-de-entrega');
                    moradaEntregaElement.val(data.morada_entrega);

                    //button Entrega GPS
                    var buttonEntregaGps = servicesModal.find('#novo_transfer_form_group_morada-de-entrega_button-gps');
                    buttonEntregaGps.hide();

                    //adultos
                    var numeroAdultosElement = servicesModal.find('#novo_transfer_form_adultos');
                    numeroAdultosElement.val(data.px);

                    //criancas
                    var numeroCriancasElement = servicesModal.find('#novo_transfer_form_criancas');
                    numeroCriancasElement.val(data.cr);

                    //bebes
                    var numeroBebesElement = servicesModal.find('#novo_transfer_form_bebes');
                    numeroBebesElement.val(data.bebe);


                    //observacoes
                    var observacoesElement = servicesModal.find('#novo_transfer_form_observacoes');
                    var oldObservacoesElement = $('#old-novo_transfer_form_observacoes');
                    if (observacoesElement.is(':disabled')) {
                        observacoesElement.removeAttr('disabled');
                    }
                    observacoesElement.val(data.obs);
                    oldObservacoesElement.val(data.obs);

                    //Dados de Pagamento
                    //Forma de Pagamento
                    var formaDePagamentoElement = servicesModal.find('#novo_transfer_form_forma-de-pagamento');
                    var oldFormaDePagamentoElement = $('#old-novo_transfer_form_forma-de-pagamento');
                    if (formaDePagamentoElement.is(':disabled')) {
                        formaDePagamentoElement.removeAttr("disabled");
                    }
                    var formaDePagamentoValue = data.cobrar_operador != "" ? 'Operador' : 'Motorista';
                    var formaDePagamentoIndex = servicesModal.find("#novo_transfer_form_forma-de-pagamento option:contains(" + formaDePagamentoValue + ")").val();
                    if (formaDePagamentoIndex !== '') {
                        formaDePagamentoElement.selectpicker('val', formaDePagamentoIndex);
                    } else {
                        formaDePagamentoElement.selectpicker('val', '');
                    }
                    formaDePagamentoElement.selectpicker('refresh');
                    oldFormaDePagamentoElement.val(formaDePagamentoIndex);

                    //Valor do Servico
                    var valorDoServicoElement = servicesModal.find('#valor-do-servico');
                    if (data.cobrar_direto != "") {
                        valorDoServicoElement.val(data.cobrar_direto);
                    } else if (data.cobrar_operador != "") {
                        valorDoServicoElement.val(data.cobrar_operador);
                    } else {
                        valorDoServicoElement.val('-/-');
                    }

                    //Estado do Pagamento
                    var estadoDoPagamentoElement = servicesModal.find('#novo_transfer_form_estado-do-pagamento');
                    var oldEstadoDoPagamentoElement = $('#old-novo_transfer_form_estado-do-pagamento');
                    if (estadoDoPagamentoElement.is(':disabled')) {
                        estadoDoPagamentoElement.removeAttr("disabled");
                    }
                    var estadoDoPagamentoIndex = servicesModal.find("#novo_transfer_form_estado-do-pagamento option:contains(" + data.estado + ")").val();

                    if (estadoDoPagamentoIndex !== '') {
                        estadoDoPagamentoElement.selectpicker('val', estadoDoPagamentoIndex);
                    } else {
                        estadoDoPagamentoElement.selectpicker('val', '');
                    }

                    estadoDoPagamentoElement.selectpicker('refresh');
                    oldEstadoDoPagamentoElement.val(estadoDoPagamentoIndex);

                    servicesModal.modal();
                }
            }
        });
    });

    //hide novo_transfer_form
    $('#novo_transfer_form').submit(function (e) {
        e.preventDefault();
    });

    //novo_transfer_form modal
    $('#services__modal .btn-success').click(function (e) {

        var servicesModal = $('#services__modal');

        var id = servicesModal.find('#service_id').val();
        var operador = $('#operador').val();
        var username = $('#username').val();

        var agendamentoUpdated = false;
        var agendamento = $.trim($('#novo_transfer_form_datetime').val());
        var oldAgendamento = $.trim($('#old-novo_transfer_form_datetime').val());
        if (agendamento !== oldAgendamento) {
            agendamentoUpdated = true;
        }

        var obsUpdated = false;
        var obs = $.trim($('#novo_transfer_form_observacoes').val());
        var oldObs = $.trim($('#old-novo_transfer_form_observacoes').val());
        if (obs !== oldObs) {
            obsUpdated = true;
        }

        var formaDePagamentoUpdated = false;
        var formaDePagamento = $('#novo_transfer_form_forma-de-pagamento').val();
        var oldFormaDePagamento = $('#old-novo_transfer_form_forma-de-pagamento').val();

        if (formaDePagamento !== oldFormaDePagamento) {
            formaDePagamentoUpdated = true;
        }

        var estadoDePagamentoUpdated = false;
        var estadoDePagamento = $('#novo_transfer_form_estado-do-pagamento').val();
        var oldEstadoDePagamento = $('#old-novo_transfer_form_estado-do-pagamento').val();
        if (estadoDePagamento !== oldEstadoDePagamento) {
            estadoDePagamentoUpdated = true;
        }

        if (!estadoDePagamentoUpdated && !formaDePagamentoUpdated && !agendamentoUpdated && !obsUpdated) {
            servicesModal.modal('hide');
            return;
        }

        $.ajax({
            url: 'json.php',
            type: 'GET',
            cache: false,
            data: {
                'operador': operador,
                'username': username,
                'id': id,
                'estadoDePagamentoUpdated': estadoDePagamentoUpdated,
                'estadoDePagamento': estadoDePagamento,
                'oldEstadoDePagamento': oldEstadoDePagamento,

                'formaDePagamentoUpdated': formaDePagamentoUpdated,
                'formaDePagamento': formaDePagamento,
                'oldFormaDePagamento': oldFormaDePagamento,

                'agendamentoUpdated': agendamentoUpdated,
                'agendamento': agendamento,
                'oldAgendamento': oldAgendamento,

                'obsUpdated': obsUpdated,
                'obs': obs,
                'oldObs': oldObs,

                'action': 12
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.success == true) {
                    servicesModal.modal('hide');
                }
            }
        });
    });

    //Datetime Agendamento picker
    $('#datetimepickerAgendamento').datetimepicker({
        locale: 'pt',
        sideBySide: true,
        minDate: moment(),
        focusOnShow: true,
        ignoreReadonly: true
    });



    $('#novo_transfer_form_datetime').click(function () {
        $('#datetimepickerAgendamento').data("DateTimePicker").show();
    });

    $('#novo_transfer_form_datetime').focus(function () {
        $('#datetimepickerAgendamento').data("DateTimePicker").show();
    });
}());