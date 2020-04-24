<style>

.modal-content {
    background: #333;}

.modal-body{
background:#FFF;
}

.close{
color:#FFF;
opacity:1;
}

.debug-url
{
  color: #000;
}

@media (max-width: 375px)
{
  #Modalko .modal-body, #Modalok .modal-body, #Modalko2 .modal-body, #Modalok2 .modal-body {
    padding: 15px;
  }
}


</style>

<input type="hidden" id="mensagem_ok" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Modalok">
<div id="Modalok" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#5cb85c;"> <span class='glyphicon glyphicon-ok'></span> Sucesso</h4>
      </div>
      <div class="modal-body">
        <p class="debug-url"></p>
      </div>
      <div class="modal-footer">

      <p style='text-align:center; margin:0;'><img src="admin/definitions/upload/logo1.png" style="width:120px;"></p>
<!--
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-remove-sign'></span> Fechar</button>
-->
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="mensagem_ko" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Modalko">
<div id="Modalko" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#d9534f;"><span class='glyphicon glyphicon-warning-sign'></span> Aviso</h4>
      </div>
      <div class="modal-body">
        <p class="debug-url"></p>
      </div>
      <div class="modal-footer">

 <p style='text-align:center; margin:0;'><img src="admin/definitions/upload/logo1.png" style="width:120px;"></p>  

<!--
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-remove-sign'></span> Fechar</button>

-->
      </div>
    </div>
  </div>
</div>


    <div class="modal fade" id="a_reserve" tabindex="-1" role="dialog" aria-labelledby="clientes">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="color:#fff!important;" id="clientes__modal__title"><span class="glyphicon glyphicon-plus" style="color: #5bc0de;"></span> Adicionar Reserva </h4>
                </div>


                <div class="modal-body">
                  <div class="row">

                    <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <i class="fas fa-user"></i> - <label for="modelo">Nome:</label>
                        <input type="text" class="form-control" id="nome_reserva" placeholder="Nome da Pessoa">
                      </div>
                    </div>

                    <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <i class="fas fa-flag"></i> - <label for="modelo">Pais:</label>
                        <input type="text" class="form-control" id="pais" placeholder="Nome do Pais">
                      </div>
                    </div>

                    <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <i class="fas fa-id-card"></i> - <label for="modelo">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Endereço Electrónico">
                      </div>
                    </div>

                    <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <i class="fas fa-phone"></i> - <label for="modelo">Telefone:</label>
                        <input type="number" class="form-control" id="telefone" placeholder="Telefone/Telemovel">
                      </div>
                    </div>

                    <div class='col-md-6 col-xs-12'>
                  <div class="form-group">
                      <span class="glyphicon glyphicon-calendar"></span> Data de Reserva:
                      <div class='input-group date' id='data_reseva_dt'>
                          <input type='text' readonly class="form-control" name="data_reserva" id="data_reserva" placeholder="Data de Reserva" />
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                  </div>
            </div>

            <div class='col-md-6 col-xs-12'>
                  <div class="form-group">
                      <span class="fa fa-clock-o"></span> Hora de Reserva:
                      <div class='input-group date' id='hora_reseva_dt'>
                          <input type='text' readonly class="form-control" name="hora_reserva" id="hora_reserva" placeholder="Hora de Reserva" />
                          <span class="input-group-addon">
                              <span class="fa fa-clock-o"></span>
                          </span>
                      </div>
                  </div>
            </div>

            <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <i class="fas fa-car"></i> - <label for="modelo">Carro:</label>
                        <select id="car_id" class='form-control'></select>
                        <input type="hidden" id="id_carro_obs">
                      </div>
                    </div>

                    <div class="col-xs-12 col-md-12">
                     <div class="form-group">
                        <i class="fas fa-file"></i> - <label for="modelo">Observacao:</label>
                        <textarea class="form-control" rows="5" id="observacao"></textarea>
                      </div>
                    </div>
                  </div>
                </div>

                    
                <div class="modal-footer">
                	 <p style='text-align:center; margin:0;'><img src="admin/definitions/upload/logo1.png" class="logo-nav" style="width:68px;"></p>  
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"> </i><font class="hidden-xs"> Cancelar</font></button>
                    <button title="Guardar as alterações do serviço" type="button" class="btn btn-success" id="adicionar_reserva"> <span class="glyphicon glyphicon-save-file"></span><font class="hidden-xs"> Guardar</font></button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="adicionar_Comentario" tabindex="-1" role="dialog" aria-labelledby="comentario">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="color:#fff!important;"><span class="glyphicon glyphicon-plus" style="color: #5bc0de;"></span> Adicionar um novo comentário</h4>
                </div>


                <div class="modal-body">
                  <div class="row">
                    <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <i class="fas fa-car"></i> - <label for="modelo">Titulo:</label>
                        <input type="text" class="form-control" id="titulo" placeholder="Titulo do comentario">
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <i class="fas fa-user"></i> - <label for="modelo">Nome do Utilizador:</label>
                        <input type="text" class="form-control" id="username_comentario" placeholder="Nome do Utilizador">
                      </div>
                    </div>
                    <div class='col-md-12 col-xs-12'>
                      <div class="form-group">
                          <span class="glyphicon glyphicon-calendar"></span> Data do Comentario *
                          <div class='input-group date' id='data_comentario_dt'>
                              <input type='text' readonly class="form-control" id="data_comentario_value" />
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                      </div>
                    </div>

                    <div class="col-xs-12 col-md-12">
                     <div class="form-group">
                        <i class="fas fa-file"></i> - <label for="modelo">Descricao:</label>
                        <textarea class="form-control" rows="5" id="descricao_value"></textarea>
                      </div>
                    </div>

                    
			            </div>
                </div>
                <div class="modal-footer">
                	 <p style='text-align:center; margin:0;'><img src="admin/definitions/upload/logo1.png" class="logo-nav" style="width:68px;"></p>  
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"> </i><font class="hidden-xs"> Cancelar</font></button>
                    <button title="Guardar as alterações do serviço" type="button" class="btn btn-success" id="addit_comentario"> <span class="glyphicon glyphicon-save-file"></span><font class="hidden-xs"> Guardar</font></button>
                </div>
            </div>
        </div>
    </div>


<input type="hidden" id="mensagem_ok2" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Modalok">
<div id="Modalok2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#5cb85c;"> <span class='glyphicon glyphicon-ok'></span> Sucesso</h4>
      </div>
      <div class="modal-body">
        <p class="debug-url"></p>
      </div>
      <div class="modal-footer">

      <p style='text-align:center; margin:0;'><img src="admin/definitions/upload/logo1.png" style="width:120px;"></p>
<!--
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-remove-sign'></span> Fechar</button>
-->
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="mensagem_ko2" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Modalko">
<div id="Modalko2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#d9534f;"><span class='glyphicon glyphicon-warning-sign'></span> Aviso</h4>
      </div>
      <div class="modal-body">
        <p class="debug-url"></p>
      </div>
      <div class="modal-footer">

 <p style='text-align:center; margin:0;'><img src="admin/definitions/upload/logo1.png" style="width:120px;"></p>  

 </div>
    </div>
  </div>
</div>



<input type="hidden" id="mensagem_ok3" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Modalok">
<div id="Modalok3" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#5cb85c;"> <span class='glyphicon glyphicon-ok'></span> Sucesso</h4>
      </div>
      <div class="modal-body">
        <p class="debug-url" style="color: #000"></p>
      </div>
      <div class="modal-footer">

      <p style='text-align:center; margin:0;'><img src="admin/definitions/upload/logo1.png" style="width:120px;"></p>
<!--
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-remove-sign'></span> Fechar</button>
-->
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="mensagem_ko3" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Modalko">
<div id="Modalko3" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#d9534f;"><span class='glyphicon glyphicon-warning-sign'></span> Aviso</h4>
      </div>
      <div class="modal-body">
        <p class="debug-url" style="color: #000"></p>
      </div>
      <div class="modal-footer">

 <p style='text-align:center; margin:0;'><img src="admin/definitions/upload/logo1.png" style="width:120px;"></p>  

 </div>
    </div>
  </div>
</div>