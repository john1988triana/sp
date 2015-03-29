<section style="margin-top:83px;">
    <div class="msj alert alert-warning alert-danger" role="alert" style="display:none" id="alert2">
        <?php echo(validation_errors());?>
    </div>
    <div class="container body-admin">
        <label for="pass" class="error" id="pass_lb"></label>
    </div>
    <div class="container">
        <div class="row steps-center" style="">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="login-panel panel-registro panel panel-default">
                    <h3 class="text-center asi-funciona" style="color:#003333">Nueva Solicitud de Clase</h3>
					<div class="panel-body">
					<form id="search-form" role="form" class="form-horizontal" id="formRegUser" method="get">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="email">Correo electrónico</label>
                                    <input id="email" name="email" type="email" class="form-control" value="<?php echo (!empty($reg_email)?$reg_email:''); ?>" placeholder="Correo electrónico" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="search" type="submit" href="" class="btn-profe btn-login btn col-lg-12 " value="Buscar Usuario"></input>
                                </div>
                            </div>
                        </fieldset>
					</form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<div class="amigas-separator"></div>