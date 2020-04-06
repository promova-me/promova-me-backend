<!-- Section Preview Content  -->
<section class="preview-content" id="preview-content">
    <div class="container">

        <h1 class="title">
            Mão na massa
        </h1>


        <div class="row card-generator">

            <div class="col-md-6">
                <span class="anchor" id="formPayment"></span>

                <div class="card card-outline-secondary">
                    <div class="card-body">
                        <h3 class="text-center">Insira as informações</h3>
                        <hr>
                        <form class="form" role="form" autocomplete="off">
                            <div class="form-group">
                                <label for="empresa">Seu nome ou da sua empresa</label>
                                <input type="text" class="form-control" id="empresa" required="required">
                            </div>
                            <div class="form-group">
                                <label for="frase">Descrição do produto ou serviço</label>
                                <input type="text" class="form-control" id="frase" required="required">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone para contato</label>
                                <input type="tel" class="form-control" id="telefone" required="required">
                            </div>
                            <div class="form-group">
                                <label for="entrega">Região de entrega</label>
                                <input type="tel" class="form-control" id="entrega" required="required">
                            </div>
                            <div class="form-group">
                                <input type="file" id="file-chooser" class="file-chooser" accept="image/*" required="required" />
                            </div>
                            <!--<div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control" autocomplete="off" maxlength="20" pattern="\d{16}" title="Credit card number" required="">
                            </div>
                            <div class="form-group row">
                                <label class="col-md-12">Card Exp. Date</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="cc_exp_mo" size="0">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="cc_exp_yr" size="0">
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                        <option>2021</option>
                                        <option>2022</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required="" placeholder="CVC">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-12">Amount</label>
                            </div>
                            <div class="form-inline">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                    <input type="text" class="form-control text-right" id="exampleInputAmount" placeholder="39">
                                    <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                </div>
                            </div>-->
                            <hr>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Gerar Cartão</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="canvas-content">
                    <canvas class="card-canvas" id="card-canvas" width="600" height="600"> </canvas>
                </div>

                <button onclick="download_image()">
                    Download
                </button>
            </div>

        </div>
    </div>
</section>
