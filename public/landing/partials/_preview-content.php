<!-- Section Preview Content  -->
<?php
$colors = array('Azul','Amarelo','Laranja','Verde','Vermelho');
?>
<section class="preview-content" id="preview-content">
    <div class="container">

        <h1 class="title">
            Mão na massa
        </h1>


        <div class="card-generator">

            <div class="row box">

                <div id="form-anchor"></div>

                <div class="col-md-6">
                    <div class="card-form">
                        <h4 class="title-form">Vamos começar? <br>Insira as informações</h4>

                        <form id="form-generate-card">

                            <div class="form-group">
                                <input type="text" placeholder="Seu nome ou da sua empresa" tabindex="1" class="form-control" id="name-form" maxlength="30" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Descrição do produto ou serviço" tabindex="2" class="form-control" id="desc-form" maxlength="50" required="required">
                            </div>
                            <div class="form-group">
                                <input type="tel" placeholder="Telefone para contato" tabindex="3" class="form-control" id="phone-form" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Região de entrega" tabindex="4" class="form-control" id="delivery-form" required="required">
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="E-mail" class="form-control" tabindex="5" id="email-form" required="required">
                            </div>
                            <!--<div class="form-group">
                                <select class="form-control" id="color-form" tabindex="5">
                                    <option selected disabled value="">Escolha uma cor desejada</option>
                                    <?php
                            /*                                    foreach ($colors as $color){ */?>
                                        <option value="<?/*= strtolower($color) */?>"><?/*= $color */?></option>
                                        <?php
                            /*                                    } */?>
                                </select>
                            </div>-->
                            <div class="form-group">
                                <input type="file" tabindex="5" id="file-chooser" class="file-chooser form-control" accept="image/*" required="required" />
                            </div>
                            <span class="error-msg"></span>

                            <div class="form-group">
                                <ul class="terms">
                                    <li>
                                        <input class="styled-checkbox" tabindex="6" id="info-form" type="checkbox" value="value1">
                                        <label for="info-form"><span>Aceito compartilhar minhas informações com o Promova.me</span></label>
                                    </li>
                                    <li>
                                        <input class="styled-checkbox" tabindex="7" id="newsletter-form" type="checkbox" value="value1">
                                        <label for="newsletter-form">Quero receber novidades e dicas em meu e-mail</label>
                                    </li>
                                </ul>
                            </div>
                            <a class="cta cta-orange" id="btn-generate-card" tabindex="8">
                                <span>Gerar Grátis</span>
                            </a>
                        </form>
                    </div>

                    <div class="card-answer">
                        <div class="img-check">
                            <img src="/assets/images/check.png" alt="">
                        </div>
                        <h3 class="title">Pronto! Você gerou com sucesso sua imagem promocional.</h3>

                        <div class="bottom-share desktop" id="bottom-share">
                            <div class="share-content">
                                <h3 class="title-share">Compartilhe sua imagem ou baixe agora</h3>
                                <div class="share-links">
                                    <div class="line">
                                        <a id="facebook" onclick="FinalCard.redirectToSocialMedia('facebook','desktop')">
                                            <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                            <span>Facebook</span>
                                        </a>
                                        <a id="instagram" onclick="FinalCard.redirectToSocialMedia('instagram','desktop')">
                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                            <span>Instagram</span>
                                        </a>
                                    </div>
                                    <div class="line">
                                        <a id="whatsapp" onclick="FinalCard.redirectToSocialMedia('whatsapp','desktop')">
                                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                            <span>WhatsaApp</span>
                                        </a>
                                        <a id="download" onclick="FinalCard.downloadCard()">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            <span>Download</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <a class="cta cta-orange" id="back-to-generate">
                                <span>Gerar novamente</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 canvas-content">
                    <canvas class="card-canvas" id="card-canvas"> </canvas>
                    <img src="/assets/images/placeholder.png" alt="" class="placeholder" id="card-placeholder">
                    <div class="look-how">
                        <h5>Insira as informações e veja como ficará sua imagem</h5>
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                </div>

                <div class="bottom-share mobile" id="bottom-share">
                    <div class="share-content">
                        <h3 class="title-share">Compartilhe sua imagem ou baixe agora</h3>
                        <div class="share-links">
                            <div class="line">
                                <a id="facebook" onclick="FinalCard.redirectToSocialMedia('facebook','mobile')">
                                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                    <span>Facebook</span>
                                </a>
                                <a id="instagram" onclick="FinalCard.redirectToSocialMedia('instagram','mobile')">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                    <span>Instagram</span>
                                </a>
                            </div>
                            <div class="line">
                                <a id="whatsapp" onclick="FinalCard.redirectToSocialMedia('whatsapp','mobile')">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                    <span>WhatsaApp</span>
                                </a>
                                <a id="download" onclick="FinalCard.downloadCard()">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <span>Download</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <a class="cta cta-orange" id="back-to-generate-mobile">
                        <span>Gerar novamente</span>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>
