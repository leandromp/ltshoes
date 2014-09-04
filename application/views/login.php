<?php $this->load->view('cabecera'); ?>
 <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Iniciar Sesion</div>
            <?= form_open('empleados/login');?>
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="userid" class="form-control" placeholder="Usuario"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Identificarse</button>  
                    
                    <p><a href="#">Olvide Mi Contrase&ntilde;a</a></p>
                </div>
            </form>
        </div>


        <? $this->load->view('carabiner-js'); ?>

    </body>