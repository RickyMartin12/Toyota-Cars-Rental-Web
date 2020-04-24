(function () {
    /**
     GPS verification
     **/
    function unvalidateByGps() {
        $('#novo_transfer_form_group_morada-de-recolha_button-gps').removeClass('btn-warning').addClass('btn-default');
        $('#novo_transfer_form_group_morada-de-entrega_button-gps').removeClass('btn-warning').addClass('btn-default');
    }

    function validateByGps() {
        $('#novo_transfer_form_group_morada-de-recolha_button-gps').removeClass('btn-default').addClass('btn-warning');
        $('#novo_transfer_form_group_morada-de-entrega_button-gps').removeClass('btn-default').addClass('btn-warning');
    }

    function isValidateByGps() {
        return $('#novo_transfer_form_group_morada-de-recolha_button-gps').hasClass('btn-warning');
    }

    $('.selectpicker').selectpicker();
    //novo transfer form
    $('#novo_transfer_form').submit(function (e) {
        e.preventDefault();
    });

    //novo transfer form - Masks
    $('#novo_transfer_form_adultos').mask("00");
    $('#novo_transfer_form_criancas').mask("00");
    $('#novo_transfer_form_bebes').mask("00");
    $('#novo_transfer_form_retorno_adultos').mask("00");
    $('#novo_transfer_form_retorno_criancas').mask("00");
    $('#novo_transfer_form_retorno_bebes').mask("00");
    $('#novo_transfer_form_datetime').mask("00/00/0000 00:00", {
        placeholder: "__/__/____ __:__"
    });
    $('#novo_transfer_form_datetime-Chegada').mask("00/00/0000 00:00", {
        placeholder: "__/__/____ __:__"
    });
    $('#novo_transfer_form_telefone').mask("ZNNN NNN NNN NNN NN", {
        translation: {
            'Z': {
                pattern: /\+/,
                optional: true
            },
            'N': {
                pattern: /[0-9]/,
                optional: true
            }
        }
    });
    $('#novo_transfer_form_numero-quarto').mask("NNNNN", {
        translation: {
            'N': {
                pattern: /[0-9]/,
                optional: true
            }
        }
    });

    var asyncServicePriceCallback = function () {
        asyncServicePrice();
    }

    //on keyup
    $('#novo_transfer_form_adultos').keyup(asyncServicePriceCallback);
    $('#novo_transfer_form_criancas').keyup(asyncServicePriceCallback);
    $('#novo_transfer_form_bebes').keyup(asyncServicePriceCallback);
    $('#novo_transfer_form_retorno_adultos').keyup(asyncServicePriceCallback);
    $('#novo_transfer_form_retorno_criancas').keyup(asyncServicePriceCallback);
    $('#novo_transfer_form_retorno_bebes').keyup(asyncServicePriceCallback);

    //on keyup
    $('#novo_transfer_form_morada-de-recolha').keyup(function (e) {
        var currentElement = $(this);
        var currentValue = currentElement.val();
        currentElement.data('gps', ''); //reset data-gps
        var isRetornoOpen = $('#novo_transfer_form_retorno').val() == 1 ? true : false;
        if (isRetornoOpen) {
            $('#novo_transfer_form_retorno_morada-de-entrega').val(currentValue);
        }
    });
    //on keyup
    $('#novo_transfer_form_morada-de-entrega').keyup(function (e) {
        var currentElement = $(this);
        var currentValue = currentElement.val();
        currentElement.data('gps', ''); //reset data-gps
        var isRetornoOpen = $('#novo_transfer_form_retorno').val() == 1 ? true : false;
        if (isRetornoOpen) {
            $('#novo_transfer_form_retorno_morada-de-recolha').val(currentValue);
        }
    });




    //novo transfer form - Submit button
    $('#novo_transfer_form .btn-submit').click(function () {
        //clear input errors
        $('#novo_transfer_form .error-info').each(function (index, item) {
            $(item).html('').hide();
        });

        asyncServicePrice();

        var guardarDetalhesDoCliente = false;
        var readyForFocus = false;
        var passedValidation = true;


        //input values
        var servico = $('#novo_transfer_form_servico').val();
        var zonaDeRecolha = $.trim($('#novo_transfer_form_zona-de-recolha').val());
        var zonaDeEntrega = $.trim($('#novo_transfer_form_zona-de-entrega').val());
        var agendamento = $.trim($('#novo_transfer_form_datetime').val());
        var retorno = $('#novo_transfer_form_retorno').val() == 0 ? false : true;
        var clienteEmail = $.trim($('#novo_transfer_form_e-mail').val());
        var clienteNome = $.trim($('#novo_transfer_form_nome-cliente').val());
        var clienteTelefone = $.trim($('#novo_transfer_form_telefone').val());
        var clientePais = $.trim($('#novo_transfer_form_pais').val());
        var clienteQuarto = $.trim($('#novo_transfer_form_numero-quarto').val());
        var isAero = matchAero(zonaDeRecolha);


        //partida
        var moradaRecolhaElement = $('#novo_transfer_form_morada-de-recolha');
        var moradaRecolha = $.trim(moradaRecolhaElement.val());
        var moradaEntregaElement = $('#novo_transfer_form_morada-de-entrega');
        var moradaEntrega = $.trim(moradaEntregaElement.val());
        var isValidByGPS = isValidateByGps();
        if (isValidByGPS) {
            if (!isAero) {
                var moradaRecolhaGps = $.trim(moradaRecolhaElement.data('gps'));
            }
            var moradaEntregaGps = $.trim(moradaEntregaElement.data('gps'));
        }

        var numeroVoo = $.trim($('#novo_transfer_form_voo').val());
        var dateTimeChegada = $.trim($('#novo_transfer_form_datetime-Chegada').val());
        var numeroAdultos = $.trim($('#novo_transfer_form_adultos').val());
        var numeroCriancas = $.trim($('#novo_transfer_form_criancas').val());
        numeroCriancas = numeroCriancas.length == 0 ? 0 : numeroCriancas;
        var numeroBebes = $.trim($('#novo_transfer_form_bebes').val());
        numeroBebes = numeroBebes.length == 0 ? 0 : numeroBebes;
        var observacoes = $.trim($('#novo_transfer_form_observacoes').val());

        //retorno
        if (retorno) {
            var moradaRecolhaRetorno = $.trim($('#novo_transfer_form_retorno_morada-de-recolha').val());
            var moradaEntregaRetorno = $.trim($('#novo_transfer_form_retorno_morada-de-entrega').val());
            var numeroAdultosRetorno = $.trim($('#novo_transfer_form_retorno_adultos').val());
            var numeroCriancasRetorno = $.trim($('#novo_transfer_form_retorno_criancas').val());
            numeroCriancasRetorno = numeroCriancasRetorno.length == 0 ? 0 : numeroCriancasRetorno;
            var numeroBebesRetorno = $.trim($('#novo_transfer_form_retorno_bebes').val());
            numeroBebesRetorno = numeroBebesRetorno.length == 0 ? 0 : numeroBebesRetorno;
            var agendamentoRetorno = $.trim($('#novo_transfer_form_datetime_retorno').val());
            var observacoesRetorno = $.trim($('#novo_transfer_form_retorno_observacoes').val());
        }

        var formaDePagamento = $('#novo_transfer_form_forma-de-pagamento').val();
        var estadoDePagamento = $('#novo_transfer_form_estado-do-pagamento').val();
        var operadorId = $('#operador_admin_id').val();
        var username = $('#usernm').val();

        //validation
        if (servico.length == 0) {
            $('#novo_transfer_form_group_servico .error-info').html('Este campo é obrigatório.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_servico').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        }
        if (zonaDeRecolha.length == 0) {
            $('#novo_transfer_form_group_zona-de-recolha .error-info').html('Este campo é obrigatório.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_zona-de-recolha').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        }
        if (zonaDeEntrega.length == 0) {
            $('#novo_transfer_form_group_zona-de-entrega .error-info').html('Este campo é obrigatório.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_zona-de-entrega').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        }
        if (agendamento.length == 0) {
            $('#novo_transfer_form_group_datetime .error-info').html('Este campo é obrigatório.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_datetime').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        }
        if (clienteEmail.length != 0) {
            guardarDetalhesDoCliente = true;
            if (clienteEmail.length > 50) {
                $('#novo_transfer_form_group_e-mail .error-info').html('Este campo é grande demais. Deve ter 50 caracteres ou menos.').show();
                if (readyForFocus == false) {
                    $('#novo_transfer_form_e-mail').focus();
                    readyForFocus = true;
                }
                passedValidation = false;
            } else if (!isValidEmail(clienteEmail)) {
                $('#novo_transfer_form_group_e-mail .error-info').html('Este campo deve ser um email válido.').show();
                if (readyForFocus == false) {
                    $('#novo_transfer_form_e-mail').focus();
                    readyForFocus = true;
                }
                passedValidation = false;
            }
        }
        if (clienteNome.length == 0) {
            $('#novo_transfer_form_group_nome-cliente .error-info').html('Este campo é obrigatório.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_nome-cliente').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        } else if (clienteNome.length < 2) {
            $('#novo_transfer_form_group_nome-cliente .error-info').html('Este campo é pequeno demais. Deve ter 2 caracteres ou mais.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_nome-cliente').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        } else if (clienteNome.length > 50) {
            $('#novo_transfer_form_group_nome-cliente .error-info').html('Este campo é grande demais. Deve ter 50 caracteres ou menos.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_nome-cliente').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        }
        if (isAero == false && moradaRecolha.length == 0) {
            $('#novo_transfer_form_group_morada-de-recolha .error-info').html('Este campo é obrigatório.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_morada-de-recolha').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        }
        if (isAero == true) {
            if (numeroVoo.length == 0) {
                $('#novo_transfer_form_group_voo .error-info').html('Este campo é obrigatório.').show();
                if (readyForFocus == false) {
                    $('#novo_transfer_form_voo').focus();
                    readyForFocus = true;
                }
                passedValidation = false;
            }
            if (dateTimeChegada.length == 0) {
                $('#novo_transfer_form_group_datetime-chegada .error-info').html('Este campo é obrigatório.').show();
                if (readyForFocus == false) {
                    $('#novo_transfer_form_datetime-chegada').focus();
                    readyForFocus = true;
                }
                passedValidation = false;
            }
        }
        if (moradaEntrega.length == 0) {
            $('#novo_transfer_form_group_morada-de-entrega .error-info').html('Este campo é obrigatório.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_morada-de-entrega').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        }
        var errorAdultos = false;
        if (numeroAdultos.length == 0) {
            errorAdultos = true;
            $('#novo_transfer_form_group_adultos .error-info').html('Este campo é obrigatório.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_adultos').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        }
        if (numeroAdultos == 0 && errorAdultos == false) {
            $('#novo_transfer_form_group_adultos .error-info').html('Este valor deve ser maior ou igual a 1.').show();
            if (readyForFocus == false) {
                $('#novo_transfer_form_adultos').focus();
                readyForFocus = true;
            }
            passedValidation = false;
        }
        if (retorno == true) {
            if (agendamentoRetorno.length == 0) {
                $('#novo_transfer_form_group_datetime_retorno .error-info').html('Este campo é obrigatório.').show();
                if (readyForFocus == false) {
                    $('#novo_transfer_form_datetime_retorno').focus();
                    readyForFocus = true;
                }
                passedValidation = false;
            }
            if (moradaRecolhaRetorno.length == 0) {
                $('#novo_transfer_form_group_retorno_morada-de-recolha .error-info').html('Este campo é obrigatório.').show();
                if (readyForFocus == false) {
                    $('#novo_transfer_form_retorno_morada-de-recolha').focus();
                    readyForFocus = true;
                }
                passedValidation = false;
            }

            if (moradaEntregaRetorno.length == 0) {
                $('#novo_transfer_form_group_retorno_morada-de-entrega .error-info').html('Este campo é obrigatório.').show();
                if (readyForFocus == false) {
                    $('#novo_transfer_form_retorno_morada-de-entrega').focus();
                    readyForFocus = true;
                }
                passedValidation = false;
            }
            var errorAdultosRetorno = false;
            if (numeroAdultosRetorno.length == 0) {
                errorAdultosRetorno = true;
                $('#novo_transfer_form_group_retorno_adultos .error-info').html('Este campo é obrigatório.').show();
                if (readyForFocus == false) {
                    $('#novo_transfer_form_retorno_adultos').focus();
                    readyForFocus = true;
                }
                passedValidation = false;
            }
            if (numeroAdultosRetorno == 0 && errorAdultosRetorno == false) {
                $('#novo_transfer_form_group_retorno_adultos .error-info').html('Este valor deve ser maior ou igual a 1.').show();
                if (readyForFocus == false) {
                    $('#novo_transfer_form_retorno_adultos').focus();
                    readyForFocus = true;
                }
                passedValidation = false;
            }
        }
        if (!passedValidation) return;

        var formData = {
            'servico': servico,
            'zonaDeRecolha': zonaDeRecolha,
            'zonaDeEntrega': zonaDeEntrega,
            'agendamento': agendamento,
            'retorno': retorno,
            'isAero': isAero,
            'isValidByGps': isValidByGPS,
            'cliente_guardar': guardarDetalhesDoCliente,
            'cliente_email': clienteEmail,
            'cliente_nome': clienteNome,
            'cliente_telefone': clienteTelefone,
            'cliente_pais': clientePais,
            'cliente_quarto': clienteQuarto,
            'moradaEntrega': moradaEntrega,
            'adultos': numeroAdultos,
            'criancas': numeroCriancas,
            'bebes': numeroBebes,
            'observacoes': observacoes,
            'estadoDePagamento': estadoDePagamento,
            'formaDePagamento': formaDePagamento,
            'operadorId': operadorId,
            'username': username
        };

        if (isValidByGPS) {
            if (!isAero) {
                formData['moradaRecolhaGps'] = parseFloat(moradaRecolhaGps).toFixed(7);
            }
            formData['moradaEntregaGps'] = parseFloat(moradaEntregaGps).toFixed(7);
        }

        if (retorno) {
            formData['retorno_moradaRecolha'] = moradaRecolhaRetorno;
            formData['retorno_moradaEntrega'] = moradaEntregaRetorno;
            formData['retorno_adultos'] = numeroAdultosRetorno;
            formData['retorno_criancas'] = numeroCriancasRetorno;
            formData['retorno_bebes'] = numeroBebesRetorno;
            formData['retorno_observacoes'] = observacoesRetorno;
            formData['retorno_agendamento'] = agendamentoRetorno;
        }

        if (isAero) {
            formData['voo'] = numeroVoo;
            formData['horaChegadaVoo'] = dateTimeChegada;
        } else {
            formData['moradaRecolha'] = moradaRecolha;
        }
        formData['action'] = 4;
        
        $('.back').show();

        //Submit Ajax request
        $.ajax({
            url: 'json.php',
            type: 'POST',
            cache: false,
            data: formData,
            error: function (error) {
                 $('.back').fadeOut();
                 $("#avisos_cliente").modal();
                 $('.infocolor').addClass('w3-red').removeClass('w3-amber w3-green');
                 $('.mensagem_head').html('Aviso');
                 $('.mensagem_txt').html('O registo não foi guardado, verifique a ligação e volte a tentar.');
                 setTimeout(function(){ $("#avisos_cliente").modal('hide'); }, 5000);
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.success == true) {

                    var id = data.id;
                    var type= 'create';
                    var operador = $('#operador_nome_id').val();

                    $.ajax({
                        url: 'json.php',
                        type: 'POST',
                        cache: false,
                        data: {'id' : id, 'type' : type, 'operador': operador, 'action': 10},
                        error: function(error){


                            alert(error);                

                           alert('error');
                        },
                        success: function (data){
                            $('.back').fadeOut();

                            if(data != 200){
                            $("#avisos_cliente").modal();
                            $('.infocolor').addClass('w3-amber').removeClass('w3-red w3-green');
                            $('.mensagem_head').html('Sucesso mas ...');
                            $('.mensagem_txt').html('O registo foi criado com #ID'+id+', mas notificação não foi enviada.<br> Aguarde, a redireccionar para home');
                            $('.btn-cancel').trigger('click');
                            $('html, body').animate({ scrollTop: 0 }, 500);
                            setTimeout(function(){ $("#avisos_cliente").modal('hide'); location.href = "index.php";}, 2500);
                                return;
                            }
                            $("#avisos_cliente").modal();
                            $('.infocolor').addClass('w3-green').removeClass('w3-red w3-amber');
                            $('.mensagem_head').html('Sucesso');
                            $('.mensagem_txt').html('O registo foi criado com #ID'+id+', e notificação enviada.<br> Aguarde, a redireccionar para home');
                            $('.btn-cancel').trigger('click');
                            $('html, body').animate({ scrollTop: 0 }, 500);
                            setTimeout(function(){ $("#avisos_cliente").modal('hide'); location.href = "index.php";}, 2500);
                        }
                    });
                } else if (data.success == false) {
                    alert('error!!!');
                } else {
                    alert('error');
                }

                //alert(JSON.stringify(data));
                //Show error messages here!!!
            }
        });
    });


    /*novo transfer form - Cancel button
    $("#novo_transfer_form .btn-cancel").confirm({
        text: "Tem a certeza que pretende limpar o formulário?",
        title: "Atenção!",
        confirm: function (button) {
            console.log("Pronto para limpar o formulario");
        },
        confirmButton: "Limpar",
        cancelButton: "Cancelar",
        cancelButtonClass: "btn-default",
        confirmButtonClass: "btn-danger",
        dialogClass: "modal-dialog" 
    });

*/



$(".btn-cancel").click(function(){
$('#novo_transfer_form_servico').val('').change();
$('#novo_transfer_form_retorno, #novo_transfer_form_pais').val('0').change();
$('#novo_transfer_form_forma-de-pagamento').val('1').change();
});


    //Autocomplete clientes Email
    var clientesEngine = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            cache: false,
            wildcard: '%QUERY',
            url: 'json.php?q=%QUERY&t=email&action=2&i=' + $('meta[name="o-token"]').attr('content').split('.')[1],
            transform: function transform(response) {
                return $.map(response.results, function (result) {
                    return {
                        nome: result.nome,
                        email: result.email,
                        telefone: result.telefone,
                        quarto: result.quarto,
                        pais: result.pais
                    };
                });
            }
        }
    });
    $('#email-typeahead .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 0
    }, {
        display: 'email',
        source: clientesEngine,
        limit: 100
    });
    $('#email-typeahead .typeahead').bind('typeahead:select', function (ev, suggestion) {
        $('#novo_transfer_form_telefone').val(suggestion.telefone == 0 ? '' : suggestion.telefone);
        $('#novo_transfer_form_numero-quarto').val(suggestion.quarto == 0 ? '' : suggestion.quarto);
        $('#novo_transfer_form_pais').selectpicker('val', suggestion.pais);
        $("#nome-typeahead .typeahead").typeahead('val', suggestion.nome);
    });

    //Autocomplete clientes Email
    var clientesByNomeEngine = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            cache: false,
            wildcard: '%QUERY',
            url: 'json.php?q=%QUERY&action=2&t=nome&i=' + $('meta[name="o-token"]').attr('content').split('.')[1],
            transform: function transform(response) {
                return $.map(response.results, function (result) {
                    return {
                        nome: result.nome,
                        email: result.email,
                        telefone: result.telefone,
                        quarto: result.quarto,
                        pais: result.pais
                    };
                });
            }
        }
    });
    $('#nome-typeahead .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 0
    }, {
        display: 'nome',
        source: clientesByNomeEngine,
        limit: 100,
        templates: {
            suggestion: function (data) {
                return '<ul style="list-style-type:none"><li><strong>' + data.nome + '</strong></li><li>' + data.email + '</ul>';
            }
        }
    });
    $('#nome-typeahead .typeahead').bind('typeahead:select', function (ev, suggestion) {
        $('#novo_transfer_form_telefone').val(suggestion.telefone == 0 ? '' : suggestion.telefone);
        $('#novo_transfer_form_numero-quarto').val(suggestion.quarto == 0 ? '' : suggestion.quarto);
        $('#novo_transfer_form_pais').selectpicker('val', suggestion.pais);
        $("#email-typeahead .typeahead").typeahead('val', suggestion.email);
    });

    //Autocomplete zonas de recollha
    var zonasEngine1 = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: 'json.php',
            transform: function transform(response) {
                return $.map(response.results, function (result) {
                    return {
                        local: result.nome.length > 22 ? result.nome.substring(0, 22) + '...' : result.nome
                    };
                });
            },
            prepare: function (query, settings) {
                settings.url += '?q=' + query + "&action=" + 1 + "&c=" + $('#novo_transfer_form_servico').val() + "&i=" + $('#operador_admin_id').val() + "&p=" + $.trim($('#novo_transfer_form_zona-de-entrega').val());
                return settings;
            },
            cache: false
        }
    });
    var zonasEngine2 = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: 'json.php',
            transform: function transform(response) {
                return $.map(response.results, function (result) {
                    return {
                        local: result.nome.length > 22 ? result.nome.substring(0, 22) + '...' : result.nome
                    };
                });
            },
            prepare: function (query, settings) {
                settings.url += '?q=' + query + "&action=" + 1 + "&c=" + $('#novo_transfer_form_servico').val() + "&i=" + $('#operador_admin_id').val() + "&p=" + $.trim($('#novo_transfer_form_zona-de-recolha').val());
                return settings;
            },
            cache: false
        }
    });
    $('#zona-de-recolha-typeahead .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 0
    }, {
        display: 'local',
        source: zonasEngine1,
        limit: 100
    });
    $('#zona-de-entrega-typeahead .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 0
    }, {
        display: 'local',
        source: zonasEngine2,
        limit: 100
    });

    //Datetime Horario Chegada picker
    $('#datetimepickerHorarioChegada').datetimepicker({
        locale: 'pt',
        sideBySide: true,
        minDate: moment(),
        focusOnShow: true,
        ignoreReadonly: true
    });
    $('#novo_transfer_form_datetime-Chegada').click(function () {
        $('#datetimepickerHorarioChegada').data("DateTimePicker").show();
    });
    $('#novo_transfer_form_datetime-Chegada').focus(function () {
        $('#datetimepickerHorarioChegada').data("DateTimePicker").show();
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

    //Datetime Agendamento Retorno picker
    $('#datetimepickerAgendamentoRetorno').datetimepicker({
        locale: 'pt',
        sideBySide: true,
        minDate: moment(),
        focusOnShow: true,
        ignoreReadonly: true
    });
    $('#novo_transfer_form_datetime_retorno').click(function () {
        $('#datetimepickerAgendamentoRetorno').data("DateTimePicker").show();
    });
    $('#novo_transfer_form_datetime_retorno').focus(function () {
        $('#datetimepickerAgendamentoRetorno').data("DateTimePicker").show();
    });

    //Event when Zona de Recolha change
    $("#novo_transfer_form_zona-de-recolha").on("typeahead:change", function (e) {
        //try update price
        //@ASYNC
        asyncServicePrice();

        var value = $.trim($(this).val());
        var groupMoradaDeRecolhaElement = $('#novo_transfer_form_group_morada-de-recolha');
        var groupDatetimeChegadaElement = $('#novo_transfer_form_group_datetime-chegada');
        var groupVooElement = $('#novo_transfer_form_group_voo');
        var localFrequenteRecolhaElement = $('#novo_transfer_form_local-frequente-recolha');


        var moradaDeRecolhaElement = $('#novo_transfer_form_morada-de-recolha');
        moradaDeRecolhaElement.val('');
        moradaDeRecolhaElement.data('gps', '');
        $('#zona-de-entrega-typeahead .typeahead').typeahead('destroy').typeahead({
            hint: true,
            highlight: true,
            minLength: 0
        }, {
            display: 'local',
            source: zonasEngine2,
            limit: 100
        });

        if (matchAero(value)) { //is aeroporto
            groupMoradaDeRecolhaElement.addClass('hide');
            groupDatetimeChegadaElement.removeClass('hide');
            groupVooElement.removeClass('hide');

            if (!localFrequenteRecolhaElement.is(':disabled')) {
                localFrequenteRecolhaElement.attr("disabled", true);
                localFrequenteRecolhaElement.selectpicker('val', '');
                localFrequenteRecolhaElement.selectpicker('refresh');
            }
        } else {
            groupMoradaDeRecolhaElement.removeClass('hide');
            groupDatetimeChegadaElement.addClass('hide');
            groupVooElement.addClass('hide');

            if (localFrequenteRecolhaElement.is(':disabled')) {
                localFrequenteRecolhaElement.removeAttr("disabled");
                localFrequenteRecolhaElement.selectpicker('refresh');
            }

            //update Local frequente - Recolha (selectbox)
            asyncLocais($('#novo_transfer_form_local-frequente-recolha'), e.target.value);
        }
    });
    $("#novo_transfer_form_zona-de-entrega").on("typeahead:change", function (e) {

        //try update price
        //@ASYNC
        asyncServicePrice();

        var value = $.trim($(this).val());
        var moradeDeEntrega = $('#novo_transfer_form_morada-de-entrega');
        var localFrequenteEntregaElement = $('#novo_transfer_form_local-frequente-entrega');

        $('#zona-de-recolha-typeahead .typeahead').typeahead('destroy').typeahead({
            hint: true,
            highlight: true,
            minLength: 0
        }, {
            display: 'local',
            source: zonasEngine1,
            limit: 100
        });
        if (matchAero(value)) {
            moradeDeEntrega.val(value);
            moradaDeEntrega.data('gps', '');
            if (!localFrequenteEntregaElement.is(':disabled')) {
                localFrequenteEntregaElement.attr("disabled", true);
                localFrequenteEntregaElement.selectpicker('val', '');
                localFrequenteEntregaElement.selectpicker('refresh');
            }
        } else {
            if (matchAero(moradeDeEntrega.val())) { //Morada de Entrega
                moradeDeEntrega.val('');
            }

            if (localFrequenteEntregaElement.is(':disabled')) {
                localFrequenteEntregaElement.removeAttr("disabled");
                localFrequenteEntregaElement.selectpicker('refresh');
            }

            //update Local frequente - Recolha (selectbox)
            asyncLocais($('#novo_transfer_form_local-frequente-entrega'), e.target.value);
        }
    });


    $('#novo_transfer_form_local-frequente-recolha').on('changed.bs.select', function (e) {
        var optionSelected = $("#novo_transfer_form_local-frequente-recolha option:selected");
        var id = optionSelected.val();
        var value = optionSelected.text();

        var morada = optionSelected.data('morada');
        var gps = optionSelected.data('gps');
        var zona = optionSelected.data('zona');

        var moradaDeRecolhaElement = $('#novo_transfer_form_morada-de-recolha');
        if(value != "" && typeof morada != "undefined"){
            morada = value + ", " + morada;
        }

        moradaDeRecolhaElement.val(morada);
        moradaDeRecolhaElement.data('gps', gps);
        var zonaDeRecolha = $('#novo_transfer_form_zona-de-recolha');
        var isRetornoOpen = $('#novo_transfer_form_retorno').val() == 1 ? true : false;

        if(isRetornoOpen){
            $('#novo_transfer_form_retorno_morada-de-entrega').val(morada);
        }

        if(id == -1){
            zonaDeRecolha.typeahead('val', '');
            asyncLocais($('#novo_transfer_form_local-frequente-recolha'), '', -1);
            $('#novo_transfer_form_local-frequente-recolha').siblings("button span.filter-option").text('Selecione');
            $('#novo_transfer_form_group_morada-de-recolha').removeClass('hide');
            $('#novo_transfer_form_group_datetime-chegada').addClass('hide');
            $('#novo_transfer_form_group_voo').addClass('hide');
            return;
        }

        //update field
        if (zonaDeRecolha.val().length == 0) {

            if (zonaDeRecolha.val().toLowerCase() == zona.toLowerCase())
                return;

            zonaDeRecolha.typeahead('val', zona);
            if (matchAero(zona)) { //is aeroporto
                $('#novo_transfer_form_group_morada-de-recolha').addClass('hide');
                $('#novo_transfer_form_group_datetime-chegada').removeClass('hide');
                $('#novo_transfer_form_group_voo').removeClass('hide');
            } else {
                $('#novo_transfer_form_group_morada-de-recolha').removeClass('hide');
                $('#novo_transfer_form_group_datetime-chegada').addClass('hide');
                $('#novo_transfer_form_group_voo').addClass('hide');
            }

            //update Local frequente - Recolha (selectbox)
            asyncLocais($('#novo_transfer_form_local-frequente-recolha'), zona, id);
        }
    });
    $('#novo_transfer_form_local-frequente-entrega').on('changed.bs.select', function (e) {
        var optionSelected = $("#novo_transfer_form_local-frequente-entrega option:selected");
        var id = optionSelected.val();
        var morada = optionSelected.data('morada');
        var gps = optionSelected.data('gps');
        var zona = optionSelected.data('zona');
        var value = optionSelected.text();

        var moradaDeEntregaElement = $('#novo_transfer_form_morada-de-entrega');

        if(value != "" && typeof morada != "undefined"){
            morada = value + ", " + morada;
        }

        moradaDeEntregaElement.val(morada);
        moradaDeEntregaElement.data('gps', gps);
        var isRetornoOpen = $('#novo_transfer_form_retorno').val() == 1 ? true : false;
        var zonaDeEntrega = $('#novo_transfer_form_zona-de-entrega');

        if(isRetornoOpen){
            $('#novo_transfer_form_retorno_morada-de-recolha').val(morada);
        }

        if(id == -1){
            zonaDeEntrega.typeahead('val', '');
            asyncLocais($('#novo_transfer_form_local-frequente-entrega'), '', -1);
            $('#novo_transfer_form_local-frequente-entrega').siblings("button span.filter-option").text('Selecione');
            return;
        }

        //update field
        if (zonaDeEntrega.val().length == 0) {

            if (zonaDeEntrega.val().toLowerCase() == zona.toLowerCase())
                return;

            zonaDeEntrega.typeahead('val', zona);

            //update Local frequente - Recolha (selectbox)
            asyncLocais($('#novo_transfer_form_local-frequente-entrega'), zona, id);
        }
    });


    $('#novo_transfer_form_retorno').on('changed.bs.select', function (e) {
        //@async
        asyncServicePrice();

        var value = $(this).val();
        var panelDadosRetornoElement = $('#novo_transfer_dados_retorno');
        var moradaEntregaRetornoElement = $('#novo_transfer_form_retorno_morada-de-entrega');
        var moradaRecolhaRetornoElement = $('#novo_transfer_form_retorno_morada-de-recolha');
        var adultosElement = $('#novo_transfer_form_adultos');
        var criancasElement = $('#novo_transfer_form_criancas');
        var bebesElement = $('#novo_transfer_form_bebes');
        var observacoesElement = $('#novo_transfer_form_observacoes');
        var adultosRetornoElement = $('#novo_transfer_form_retorno_adultos');
        var criancasRetornoElement = $('#novo_transfer_form_retorno_criancas');
        var bebesRetornoElement = $('#novo_transfer_form_retorno_bebes');
        var observacoesRetornoElement = $('#novo_transfer_form_retorno_observacoes');
        var agendamentoRetornoElement = $('#novo_transfer_form_datetime_retorno');

        if (value == 1) {
            panelDadosRetornoElement.show();
            var zonaDeRecolha = $('#novo_transfer_form_zona-de-recolha').val();
            var isAero = matchAero(zonaDeRecolha);

            var moradaRecolha = $('#novo_transfer_form_morada-de-recolha').val();
            if (moradaEntregaRetornoElement.is(':disabled')) {
                moradaEntregaRetornoElement.removeAttr("disabled");
            }
            moradaEntregaRetornoElement.val(isAero == true ? zonaDeRecolha : moradaRecolha);

            var moradaEntrega = $('#novo_transfer_form_morada-de-entrega').val();
            if (moradaRecolhaRetornoElement.is(':disabled')) {
                moradaRecolhaRetornoElement.removeAttr("disabled");
            }
            moradaRecolhaRetornoElement.val(moradaEntrega);

            if (adultosRetornoElement.is(':disabled')) {
                adultosRetornoElement.removeAttr("disabled");
            }
            if (criancasRetornoElement.is(':disabled')) {
                criancasRetornoElement.removeAttr("disabled");
            }
            if (bebesRetornoElement.is(':disabled')) {
                bebesRetornoElement.removeAttr("disabled");
            }
            if (observacoesRetornoElement.is(':disabled')) {
                observacoesRetornoElement.removeAttr("disabled");
            }

            if (agendamentoRetornoElement.is(':disabled')) {
                agendamentoRetornoElement.removeAttr("disabled");
            }

            adultosRetornoElement.val(adultosElement.val());
            criancasRetornoElement.val(criancasElement.val());
            bebesRetornoElement.val(bebesElement.val());
            observacoesRetornoElement.val(observacoesElement.val());


        } else {
            panelDadosRetornoElement.hide();
        }
    });

    $('#novo_transfer_form_servico').on('changed.bs.select', function (event, clickedIndex, newValue, oldValue) {

        //reset values
        $('#zona-de-recolha-typeahead .typeahead').typeahead('val', '');
        $('#zona-de-entrega-typeahead .typeahead').typeahead('val', '');
        $('#novo_transfer_form_local-frequente-recolha').selectpicker('val', '');
        asyncLocais($('#novo_transfer_form_local-frequente-recolha'), '', -1, $('#novo_transfer_form_local-frequente-entrega'));
        $('#novo_transfer_form_local-frequente-entrega').selectpicker('val', '');

        $('#zona-de-recolha-typeahead .typeahead').typeahead('destroy').typeahead({
            hint: true,
            highlight: true,
            minLength: 0
        }, {
            display: 'local',
            source: zonasEngine1,
            limit: 100
        });
        $('#zona-de-entrega-typeahead .typeahead').typeahead('destroy').typeahead({
            hint: true,
            highlight: true,
            minLength: 0
        }, {
            display: 'local',
            source: zonasEngine2,
            limit: 100
        });

        //zona de recolha
        var zonaDeRecolhaElement = $('#novo_transfer_form_zona-de-recolha');
        if (zonaDeRecolhaElement.is(':disabled')) {
            zonaDeRecolhaElement.removeAttr("disabled");
        }

        //zona de entrega
        var zonaDeEntregaElement = $('#novo_transfer_form_zona-de-entrega');
        if (zonaDeEntregaElement.is(':disabled')) {
            zonaDeEntregaElement.removeAttr("disabled");
        }

        //Datetime picker
        var datetimeElement = $('#novo_transfer_form_datetime');
        if (datetimeElement.is(':disabled')) {
            datetimeElement.removeAttr("disabled");
        }

        //local frequente recolha checkbox
        var localFrequenteRecolhaElement = $('#novo_transfer_form_local-frequente-recolha');
        if (localFrequenteRecolhaElement.is(':disabled')) {
            localFrequenteRecolhaElement.removeAttr("disabled");
            localFrequenteRecolhaElement.selectpicker('refresh');
        }

        //local frequente entrega
        var localFrequenteEntregaElement = $('#novo_transfer_form_local-frequente-entrega');
        if (localFrequenteEntregaElement.is(':disabled')) {
            localFrequenteEntregaElement.removeAttr("disabled");
            localFrequenteEntregaElement.selectpicker('refresh');
        }

        //retorno
        var retornoElement = $('#novo_transfer_form_retorno');
        if (retornoElement.is(':disabled')) {
            retornoElement.removeAttr("disabled");
            retornoElement.selectpicker('refresh');
        }

        //Dados Cliente
        //email
        var clienteEmailElement = $('#novo_transfer_form_e-mail');
        if (clienteEmailElement.is(':disabled')) {
            clienteEmailElement.removeAttr("disabled");
        }

        //nome
        var clienteNomeElement = $('#novo_transfer_form_nome-cliente');
        if (clienteNomeElement.is(':disabled')) {
            clienteNomeElement.removeAttr("disabled");
        }

        //telefone
        var clienteTelefoneElement = $('#novo_transfer_form_telefone');
        if (clienteTelefoneElement.is(':disabled')) {
            clienteTelefoneElement.removeAttr("disabled");
        }

        //quarto
        var clienteQuartoElement = $('#novo_transfer_form_numero-quarto');
        if (clienteQuartoElement.is(':disabled')) {
            clienteQuartoElement.removeAttr("disabled");
        }

        //pais
        var clientePaisElement = $('#novo_transfer_form_pais');
        if (clientePaisElement.is(':disabled')) {
            clientePaisElement.removeAttr("disabled");
            $('#novo_transfer_form_pais').selectpicker('refresh');
        }

        //Dados de Partida
        //morada de Recolha
        var moradaRecolhaElement = $('#novo_transfer_form_morada-de-recolha');
        if (moradaRecolhaElement.is(':disabled')) {
            moradaRecolhaElement.removeAttr("disabled");
        }

        //button recolha GPS
        var buttonRecolhaGps = $('#novo_transfer_form_group_morada-de-recolha_button-gps');
        /*if (buttonRecolhaGps.is(':disabled')) {
            buttonRecolhaGps.removeAttr("disabled");
        }*/

        //Numero Voo
        var numeroVooElement = $('#novo_transfer_form_voo');
        if (numeroVooElement.is(':disabled')) {
            numeroVooElement.removeAttr("disabled");
        }

        //DatetimeChegada picker
        var datetimeChegadaElement = $('#novo_transfer_form_datetime-Chegada');
        if (datetimeChegadaElement.is(':disabled')) {
            datetimeChegadaElement.removeAttr("disabled");
        }

        //morada de Entrega
        var moradaEntregaElement = $('#novo_transfer_form_morada-de-entrega');
        if (moradaEntregaElement.is(':disabled')) {
            moradaEntregaElement.removeAttr("disabled");
        }

        //button Entrega GPS
        var buttonEntregaGps = $('#novo_transfer_form_group_morada-de-entrega_button-gps');
        /*if (buttonEntregaGps.is(':disabled')) {
            buttonEntregaGps.removeAttr("disabled");
        }*/

        //adultos
        var numeroAdultosElement = $('#novo_transfer_form_adultos');
        if (numeroAdultosElement.is(':disabled')) {
            numeroAdultosElement.removeAttr("disabled");
        }

        //criancas
        var numeroCriancasElement = $('#novo_transfer_form_criancas');
        if (numeroCriancasElement.is(':disabled')) {
            numeroCriancasElement.removeAttr("disabled");
        }

        //bebes
        var numeroBebesElement = $('#novo_transfer_form_bebes');
        if (numeroBebesElement.is(':disabled')) {
            numeroBebesElement.removeAttr("disabled");
        }

        //observacoes
        var observacoesElement = $('#novo_transfer_form_observacoes');
        if (observacoesElement.is(':disabled')) {
            observacoesElement.removeAttr("disabled");
        }

        //Dados de Pagamento
        //Forma de Pagamento
        var formaDePagamentoElement = $('#novo_transfer_form_forma-de-pagamento');
        if (formaDePagamentoElement.is(':disabled')) {
            formaDePagamentoElement.removeAttr("disabled");
            $('#novo_transfer_form_forma-de-pagamento').selectpicker('refresh');
        }
        //Estado do Pagamento
        var estadoDoPagamentoElement = $('#novo_transfer_form_estado-do-pagamento');
        if (estadoDoPagamentoElement.is(':disabled')) {
            estadoDoPagamentoElement.removeAttr("disabled");
            $('#novo_transfer_form_estado-do-pagamento').selectpicker('refresh');
        }
    });


    /**
     Helper Functions
     **/

    //check if email is valid
    function isValidEmail(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };

    function matchAero(value) {
        return (value.match(/Airpo/g) || value.match(/Aerop/g) || value.match(/airpo/g) || value.match(/aerop/g)) != null;
    }

    //@ASYNC
    function asyncLocais(select, zona, preSelection, otherSelect) {
        select.empty();
        if (otherSelect != null) {
            otherSelect.empty();
        }
        $.ajax({
            url: 'json.php',
            type: 'GET',
            cache: false,
            data: {
                'action': 0,
                'z': zona
            },
            error: function (error) {
                alert('error');
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.length != 0) {

                    select.append($('<option>', {'value' : -1, 'text' : ' '}));
                    if(otherSelect != null){
                        otherSelect.append($('<option>', {'value' : -1, 'text' : ' '}));
                    }

                    $.each(data, function (index, value) {
                        var newOption = {
                            'value': value.id,
                            'text': value.nome.length > 22 ? value.nome.substring(0, 22) + '...' : value.nome,
                            'data-morada': value.morada,
                            'data-gps': value.morada_gps,
                            'data-zona': value.zona
                        };
                        if (preSelection != null && value.id == preSelection) {
                            newOption['selected'] = true;
                        }
                        if (otherSelect != null) {
                            otherSelect.append($('<option>', newOption));
                        }
                        select.append($('<option>', newOption));
                    });
                } else {
                    select.attr("disabled", true);
                    if (otherSelect != null) {
                        otherSelect.attr("disabled", true);
                    }
                }
                if (otherSelect != null) {
                    otherSelect.selectpicker('refresh');
                }
                select.selectpicker('refresh');
            }
        });
    }

    /*
     get Service Price
     */
    function asyncServicePrice() {

        var elementValorDoServico = $('#valor-do-servico');
        var valor = '-/-';

        var operadorId = $('#operador_admin_id').val();
        var servico = $('#novo_transfer_form_servico').val();
        var recolha = $.trim($('#novo_transfer_form_zona-de-recolha').val());
        var entrega = $.trim($('#novo_transfer_form_zona-de-entrega').val());
        var adultos = $.trim($('#novo_transfer_form_adultos').val());
        adultos = adultos.length == 0 ? 0 : adultos;
        var criancas = $.trim($('#novo_transfer_form_criancas').val());
        criancas = criancas.length == 0 ? 0 : criancas;
        var bebes = $.trim($('#novo_transfer_form_bebes').val());
        bebes = bebes.length == 0 ? 0 : bebes;
        if (recolha.length == 0 || entrega.length == 0 || parseInt(adultos) <= 0) {
            elementValorDoServico.val(valor);
            return;
        }
        var retorno = $('#novo_transfer_form_retorno').val() == 0 ? false : true;
        if (retorno) {
            var adultosRetorno = $.trim($('#novo_transfer_form_retorno_adultos').val());
            adultosRetorno = adultosRetorno.length == 0 ? 0 : adultosRetorno;
            var criancasRetorno = $.trim($('#novo_transfer_form_retorno_criancas').val());
            criancasRetorno = criancasRetorno.length == 0 ? 0 : criancasRetorno;
            var bebesRetorno = $.trim($('#novo_transfer_form_retorno_bebes').val());
            bebesRetorno = bebesRetorno.length == 0 ? 0 : bebesRetorno;
            if (parseInt(adultosRetorno) <= 0) {
                elementValorDoServico.val(valor);
                return;
            }
            var passageiros_retorno = parseInt(adultosRetorno) + parseInt(criancasRetorno) + parseInt(bebesRetorno);
        }
        var passageiros = parseInt(adultos) + parseInt(criancas) + parseInt(bebes);
        var formData = {
            'id': operadorId,
            'servico': servico,
            'recolha': recolha,
            'entrega': entrega,
            'passageiros': passageiros,
            'retorno': retorno
        };

        if (retorno) {
            formData['retorno_passageiros'] = passageiros_retorno;
        }

        formData['action'] = 3;

        $.ajax({
            url: 'json.php',
            type: 'GET',
            cache: false,
            data: formData,
            error: function (error) {
            },
            success: function (total) {
                total = JSON.parse(total);
                if (total != 0) {
                    valor = total;
                }
                elementValorDoServico.val(valor);
            }
        });
    }


    //-----------------------------------------------------------------------------------------
    /** Google MAPS -GPS PART - MAPS **/

    var map, directionsDisplay, geocoder, directionsService;
    var startingPoint = {
        lat: 37.0909721,
        lng: -8.2233214
    }; //oseubackoffice

    var geocoder = new google.maps.Geocoder();
    var directionsService = new google.maps.DirectionsService();
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            startingPoint = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
        });
    }
    var endPoint = {
        lat: startingPoint.lat + 0.001,
        lng: startingPoint.lng + 0.001
    }; //point near

    google.maps.event.addDomListener(window, 'load', initMap);
    google.maps.event.addDomListener(window, "resize", resizingMap());

    function resizeMap() {
        if (typeof map == "undefined")
            return;

        setTimeout(function () {
            resizingMap();
        }, 400);
    }

    function resizingMap() {
        if (typeof map == "undefined")
            return;
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById("map-canvas"), {
            center: startingPoint,
            zoom: 14,
            scrollwheel: false,
            panControl: false,
            rotateControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            zoomControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT
            },
            fullscreenControl: false,
            styles: [{
                "featureType": "all",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "all",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "all",
                "elementType": "labels.text",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#000000"
                }]
            }, {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "administrative",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "administrative.country",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "administrative.province",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "administrative.locality",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "administrative.neighborhood",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "administrative.land_parcel",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{
                    "visibility": "on"
                }, {
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "landscape.man_made",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "landscape.natural",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "landscape.natural.landcover",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "landscape.natural.terrain",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.attraction",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.business",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.government",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.medical",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.place_of_worship",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.school",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.sports_complex",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#000000"
                }, {
                    "weight": 1
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#000000"
                }, {
                    "weight": 0.8
                }]
            }, {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels.text",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }, {
                    "hue": "#ff0000"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.highway.controlled_access",
                "elementType": "all",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "road.highway.controlled_access",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.highway.controlled_access",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "all",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.text",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "labels.text",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit.line",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit.station",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit.station.airport",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit.station.bus",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit.station.rail",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit.station.rail",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit.station.rail",
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit.station.rail",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "water",
                "elementType": "all",
                "stylers": [{
                    "visibility": "off"
                }]
            }]
        });

        directionsDisplay = new google.maps.DirectionsRenderer({
            map: map,
            draggable: true,
            preserveViewport: true
        });

        directionsDisplay.addListener('directions_changed', function (response) {
            var directions = directionsDisplay.getDirections();
            var points = JSON.parse(JSON.stringify(directions.request));

            var gpsRecolha = {
                lat: points.origin.lat,
                lng: points.origin.lng
            };
            var gpr = gpsRecolha.lat.toFixed(7) + "," + gpsRecolha.lng.toFixed(7);
            var gprElement = $('#gpsPontoDeRecolha');
            gprElement.val(gpr);
            gprElement.data('gps', gpr);

            var mpr = JSON.parse(JSON.stringify(directions.routes[0].legs[0].start_address).replace(", Portugal", ""));
            var mprElement = $('#moradaPontoDeRecolha');
            mprElement.val(mpr);
            mprElement.data('morada', mpr);

            var gpsEntrega = {
                lat: points.destination.lat,
                lng: points.destination.lng
            };

            var gpe = gpsEntrega.lat.toFixed(7) + "," + gpsEntrega.lng.toFixed(7);
            var gpeElement = $('#gpsPontoDeEntrega');
            gpeElement.val(gpe);
            gpeElement.data('gps', gpe);

            var mpe = JSON.parse(JSON.stringify(directions.routes[0].legs[0].end_address).replace(", Portugal", ""));
            var mpeElement = $('#moradaPontoDeEntrega');
            mpeElement.val(mpe);
            mpeElement.data('morada', mpe);

            $('#myMapModal').modal({
                show: true,
                keyboard: true
            });
        });
    }

    var ShowGoogleMaps = function () {
        var destination = startingPoint;
        var origin = endPoint;

        var gpsPontoDeEntregaFunc = function (dest, orig) {
            var moradaDeEntregaElement = $("#novo_transfer_form_morada-de-entrega");
            var localEntregaFrequenteGPS = moradaDeEntregaElement.data('gps');
            if (localEntregaFrequenteGPS.length != 0 && typeof localEntregaFrequenteGPS != "undefined" && localEntregaFrequenteGPS != null) {
                var cds2 = $.trim(localEntregaFrequenteGPS).split(',');
                map.setCenter(orig);
                directionsService.route({
                    destination: {
                        lat: parseFloat(cds2[0]),
                        lng: parseFloat(cds2[1])
                    },
                    origin: orig,
                    provideRouteAlternatives: true,
                    travelMode: 'DRIVING',
                    unitSystem: google.maps.UnitSystem.METRIC
                }, function (response, status) {
                    if (status == 'OK') {
                        directionsDisplay.setDirections(response);
                    }
                });
            } else if (moradaDeEntregaElement.val().length != 0) {
                geocoder.geocode({
                    'address': moradaDeEntregaElement.val()
                }, function (results, status) {
                    if (status == 'OK') {
                        if (results.length > 0) {
                            dest = results[0].geometry.location;
                        }
                    }
                    map.setCenter(orig);
                    directionsService.route({
                        destination: dest,
                        origin: orig,
                        provideRouteAlternatives: true,
                        travelMode: 'DRIVING',
                        unitSystem: google.maps.UnitSystem.METRIC
                    }, function (response, status) {
                        if (status == 'OK') {
                            directionsDisplay.setDirections(response);
                        }
                    });
                });
            } else {
                map.setCenter(orig);
                directionsService.route({
                    destination: dest,
                    origin: orig,
                    provideRouteAlternatives: true,
                    travelMode: 'DRIVING',
                    unitSystem: google.maps.UnitSystem.METRIC
                }, function (response, status) {
                    if (status == 'OK') {
                        directionsDisplay.setDirections(response);
                    }
                });
            }
        }

        var moradaDeRecolhaElement = $("#novo_transfer_form_morada-de-recolha");
        var localRecolhaFrequenteGPS = moradaDeRecolhaElement.data('gps');
        if (localRecolhaFrequenteGPS.length != 0 && typeof localRecolhaFrequenteGPS != "undefined" && localRecolhaFrequenteGPS != null) {
            var cds = $.trim(localRecolhaFrequenteGPS).split(',');
            gpsPontoDeEntregaFunc(
                destination, {
                    lat: parseFloat(cds[0]),
                    lng: parseFloat(cds[1])
                }
            );
        } else if (moradaDeRecolhaElement.val().length != 0) {
            geocoder.geocode({
                'address': moradaDeRecolhaElement.val()
            }, function (results, status) {
                if (status == 'OK') {
                    if (results.length > 0) {
                        origin = results[0].geometry.location;
                    }
                }

                gpsPontoDeEntregaFunc(
                    destination,
                    origin
                );
            });
        } else {
            gpsPontoDeEntregaFunc(
                destination,
                origin
            );
        }
    };

    $('#novo_transfer_form_group_morada-de-entrega_button-gps').click(ShowGoogleMaps);
    $('#novo_transfer_form_group_morada-de-recolha_button-gps').click(ShowGoogleMaps);

    $('#myMapModal').on('show.bs.modal', function () {
        resizeMap();
    });

    $('#myMapModal #searchPonto').click(function () {
        var moradaPontoDeRecolha = $('#myMapModal #moradaPontoDeRecolha').val();
        var gpsPontoDeRecolha = $('#myMapModal #gpsPontoDeRecolha').val();
        var moradaPontoDeEntrega = $('#myMapModal #moradaPontoDeEntrega').val();
        var gpsPontoDeEntrega = $('#myMapModal #gpsPontoDeEntrega').val();

        gpsPontoDeRecolha = gpsPontoDeRecolha.replace(/\s+/g, '');
        var origCoord = $.trim(gpsPontoDeRecolha).split(',');

        gpsPontoDeEntrega = gpsPontoDeEntrega.replace(/\s+/g, '');
        var destCoord = $.trim(gpsPontoDeEntrega).split(',');

        //VALIDATION
        if (origCoord.length == 2 && destCoord.length == 2) {
            var orig = {lat: parseFloat(origCoord[0]), lng: parseFloat(origCoord[1])};
            var dest = {lat: parseFloat(destCoord[0]), lng: parseFloat(destCoord[1])};

            map.setCenter(orig);
            directionsService.route({
                destination: dest,
                origin: orig,
                provideRouteAlternatives: true,
                travelMode: 'DRIVING',
                unitSystem: google.maps.UnitSystem.METRIC
            }, function (response, status) {
                if (status == 'OK') {
                    directionsDisplay.setDirections(response);
                }
            });
        }
    });

    $('#myMapModal #confirmarGps').click(function (e) {
        var moradaPontoDeRecolha = $('#myMapModal #moradaPontoDeRecolha').data('morada');
        var gpsPontoDeRecolha = $('#myMapModal #gpsPontoDeRecolha').data('gps');
        var moradaPontoDeEntrega = $('#myMapModal #moradaPontoDeEntrega').data('morada');
        var gpsPontoDeEntrega = $('#myMapModal #gpsPontoDeEntrega').data('gps');

        //TODO AEROPORTO ignore
        var moradaDeRecolhaElement = $('#novo_transfer_form_morada-de-recolha');
        moradaDeRecolhaElement.val(moradaPontoDeRecolha);
        moradaDeRecolhaElement.data('gps',gpsPontoDeRecolha);

        var moradaDeEntregaElement = $('#novo_transfer_form_morada-de-entrega');
        moradaDeEntregaElement.val(moradaPontoDeEntrega);
        moradaDeEntregaElement.data('gps',gpsPontoDeEntrega);

        //verification by GPS
        validateByGps();

        $('#myMapModal').modal('hide');
    });

    //--------- Helper Functions --------
    function cleanNovoTransferForm() {

    }
}());