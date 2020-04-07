$(function() {

    // Slider Preview
    if ($(window).innerWidth() < 767) {
        Slider.initSliderStepsCards();
    }

    // Init Effects
    Effects.initLinkRel();

    // Btn Form Card clicked
    $('#btn-generate-card').click( function () {
        if (Validation.validateCardForm()){
            CardData.setCardData();
            Effects.switchScreenOnBox('#card-placeholder', '#card-canvas');
            $(".bottom-share.mobile").addClass('preview');

            if ($(window).innerWidth() >= 768) {
                Effects.switchScreenOnBox('.card-form', '.card-answer');
            } else  {
                Effects.switchScreenOnBox('.bottom-share.desktop', '.bottom-share.mobile');
                Effects.switchScreenOnBox('.card-form', '.card-answer');
            }

            // AJAX AQUI
            // CardData.sendCardData();
        }
    });

    // back-to-generate
    $('#back-to-generate, #back-to-generate-mobile').click( function () {
        $(".bottom-share.mobile").removeClass('preview');
        Effects.switchScreenOnBox('.card-answer', '.card-form');
        Effects.switchScreenOnBox('#card-canvas', '#card-placeholder');
    });

    // Remove error validation on focus field
    $('input, select').on('focus', function () {
        $('#form-generate-card .error-msg').text('');
        Util.removeRedBorderOnErrorInput(this);
    });

    // Init masks on form
    Util.initMasks();

    // Canvas Functions
    loadCanvasWithInputFile();

    function loadCanvasWithInputFile(){

        var canvas = document.getElementById('card-canvas');
        var ctx = canvas.getContext("2d");
        var fileinput = document.getElementById('file-chooser'); // input file
        var img = new Image();
        var defaultColor = Color.getDefaultColor();

        canvas.width = 600;
        canvas.height = 600;

        fileinput.onchange = function(evt) {
            var files = evt.target.files; // FileList object
            var file = files[0];
            if(file.type.match('image.*')) {
                var reader = new FileReader();
                // Read in the image file as a data URL.
                reader.readAsDataURL(file);
                reader.onload = function(evt){
                    if( evt.target.readyState == FileReader.DONE) {
                        img.src = evt.target.result;

                        $('#btn-generate-card').click( function () {
                            // Limpa o Canvas
                            ctx.clearRect(0, 0, canvas.width, canvas.height);

                            // Desenha imagem
                            ctx.drawImage(img,0,0, canvas.width, canvas.height);

                            // Desenha os quadrados
                            ctx.fillStyle = defaultColor;
                            ctx.beginPath();
                            ctx.fillRect(400, 0, 200, 600);
                            ctx.closePath();
                            ctx.fill();

                            ctx.fillStyle = "rgb(255,255,255)";
                            ctx.beginPath();
                            ctx.fillRect(250, 100, 300, 400);
                            ctx.closePath();
                            ctx.fill();

                            ctx.fillStyle = "rgb(0,0,0)";
                            ctx.beginPath();
                            ctx.fillRect(300, 360, 300, 8);
                            ctx.closePath();
                            ctx.fill();

                            // Escreve os textos
                            // Nome da empresa, ou da pessoa
                            var maxWidth = 250;
                            var lineHeight = 28;
                            var x = 280;
                            var y = 160;
                            var text = CardData.name;
                            ctx.fillStyle = "#282d39";
                            if (text.length <= 20) {
                                ctx.font = "36px Avenir Black";
                                lineHeight = 36;
                            } else {
                                ctx.font = "25px Avenir Black";
                            }
                            wrapText(ctx, text, x, y, maxWidth, lineHeight);

                            // Descrição do serviço ou promoção
                            if (text.length <= 20)
                                y = 235;
                            else
                                y = 250;
                            lineHeight = 24;
                            text = CardData.desc;
                            ctx.font = '18px Avenir Book';
                            ctx.fillStyle = '#282d39';
                            wrapText(ctx, text, x, y, maxWidth, lineHeight);

                            // Contato
                            y = 400;
                            text = 'Contato: ' + CardData.phone;
                            ctx.font = '16px Avenir Book';
                            ctx.fillStyle = '#282d39';
                            wrapText(ctx, text, x, y, maxWidth, lineHeight);

                            // Entrega
                            y = 430;
                            text = CardData.delivery;
                            ctx.font = '16px Avenir Book';
                            ctx.fillStyle = '#282d39';
                            wrapText(ctx, text, x, y, maxWidth, lineHeight);
                        })
                    }
                }

            }
        };
    }

    function wrapText(context, text, x, y, maxWidth, lineHeight){
        var words = text.split(' ');
        var line = '';

        for(var n = 0; n < words.length; n++) {
            var testLine = line + words[n] + ' ';
            var metrics = context.measureText(testLine);
            var testWidth = metrics.width;
            if (testWidth > maxWidth && n > 0) {
                context.fillText(line, x, y);
                line = words[n] + ' ';
                y += lineHeight;
            }
            else {
                line = testLine;
            }
        }
        context.fillText(line, x, y);
    }

});

const Color = {
    azul: "#379abb",
    amarelo: "#ffff00",
    verde: "#008000",
    laranja: "#d79f2e",
    vermelho: "#c64548",

    getDefaultColor: function () {
        if (CardData.color){
            if (CardData.color == 'azul')
                return this.azul;
            else if (CardData.color == 'amarelo')
                return this.amarelo;
            else if (CardData.color == 'verde')
                return this.verde;
            else if (CardData.color == 'laranja')
                return this.laranja;
            else if (CardData.color == 'vermelho')
                return this.vermelho;
        } else
            return this.vermelho;
    }

};

const Slider = {
    initSliderStepsCards: function () {
        $('#sliderStepsCards').lightSlider({
            item:1,
            slideMargin:5,
            loop:true,
            autoWidth: false,
            currentPagerPosition: 'middle',
            auto: true,
            pause: 3000,
            speed: 1000,
        });
    },
};

const Effects = {
    initLinkRel: function () {
        var top = 20;
        $('a[rel="rel"]').click(function(e){
            e.preventDefault();

            $('html, body').animate({
                scrollTop: $( $.attr(this, 'href') ).offset().top - top
            }, 500).css('overflow-scroll','true');
            return false;
        });
    },

    switchScreenOnBox: function (close, open) {
        $(close).removeClass('active');
        $(close).hide();
        $(open).fadeIn(500);
    }

};

const CardData = {

    name: '',
    desc: '',
    phone: '',
    delivery: '',
    email: '',
    newsletter: false,
    preview: false,

    setCardData: function () {
        try {
            this.name = $('#name-form').val();
            this.desc = $('#desc-form').val();
            this.phone = $('#phone-form').val();
            this.delivery = $('#delivery-form').val();
            this.email = $('#email-form').val();
            this.newsletter = $('#newsletter-form').is(':checked');
        } catch (e) {
            return false
        }
        return true;
    },

    sendCardData: function (){
        $.ajax({
            type: "POST",
            url: 'http://localhost::81/',
            dataType: 'json',
            data: {
                name: this.name,
                desc: this.desc,
                phone: this.phone,
                delivery: this.delivery,
                email: this.email,
                newsletter: this.newsletter
            },
            success: function (response) {
                console.log(response.status);
            }
        });
    },

};

const FinalCard = {
    downloadCard: function () {
        var canvas = document.getElementById("card-canvas");
        image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        var link = document.createElement('a');
        link.download = "my-image.png";
        link.href = image;
        link.click();
    }
};

const Validation = {

    errorFormElement: '#form-generate-card .error-msg',

    validateCardForm: function () {

        // Validate Name
        if (!$("#name-form").val()) {

            Util.addError(this.errorFormElement, 'Informe seu nome ou da sua empresa');
            Util.addRedBorderOnErrorInput('#name-form');
            return false;

        } else {

            var str = $("#name-form").val();
            str = str.replace(/\n/g, "");
            $("#name-form").val(str);

        }

        // Validate Desc
        if (!$("#desc-form").val()) {

            Util.addError(this.errorFormElement, 'Informe uma descrição para seu produto ou serviço');
            Util.addRedBorderOnErrorInput('#desc-form');
            return false;

        } else {

            var str = $("#desc-form").val();
            str = str.replace(/\n/g, "");
            $("#desc-form").val(str);

        }

        // Validate Phone
        if (!$("#phone-form").val()) {

            Util.addError(this.errorFormElement, "Informe seu telefone");
            Util.addRedBorderOnErrorInput('#phone-form');
            return false;

        } else {

            var lengthPhone = $("#phone-form").val().length;
            if (lengthPhone <= 10) {

                Util.addError(this.errorFormElement, "Seu Telefone está incompleto");
                Util.addRedBorderOnErrorInput('#phone-form');
                return false;

            }

        }

        // Validate Delivery
        if (!$("#delivery-form").val()) {

            Util.addError(this.errorFormElement, 'Informe a região de entrega/atendimento ou seu endereço');
            Util.addRedBorderOnErrorInput('#delivery-form');
            return false;

        } else {

            var str = $("#delivery-form").val();
            str = str.replace(/\n/g, "");
            $("#delivery-form").val(str);

        }

        // Validate E-mail
        if (!$("#email-form").val()) {

            Util.addError(this.errorFormElement, 'Informe seu e-mail');
            Util.addRedBorderOnErrorInput('#email-form');
            return false;

        }

        if (!Validation.validateEmail($("#email-form").val())) {

            Util.addError(this.errorFormElement, "E-mail em formato incorreto");
            Util.addRedBorderOnErrorInput('#email-form');
            Util.addRedBorderOnErrorInput('#confirm-email-form');
            return false;

        } else {

            var str = $("#email-form").val();
            str = str.replace(/\n/g, "");
            $("#email-form").val(str);

        }

        // Validate Color
        /*var selectedColor = $('#color-form').children("option:selected").val();
        if (!selectedColor) {

            Util.addError(this.errorFormElement, 'Selecione uma cor');
            Util.addRedBorderOnErrorInput('#color-form');
            return false;

        }*/

        // Validate File
        if ($('#file-chooser').get(0).files.length === 0) {

            Util.addError(this.errorFormElement, 'Selecione uma imagem do seu negócio');
            Util.addRedBorderOnErrorInput('#file-chooser');
            return false;

        }

        // Validate Terms
        if (!$('#info-form').is(':checked')){
            Util.addError(this.errorFormElement, 'Aceite as condições para continuar.');
            return false;
        }

        return true;

    },

    validateEmail: function(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    },

};

const Util = {

    addError: function (element, message) {
        $(element).text(message);
    },

    removeError: function (element) {
        $(element).text('');
    },

    addRedBorderOnErrorInput: function(element){
        $(element).addClass('error');
    },

    removeRedBorderOnErrorInput: function(element){
        $(element).removeClass('error');
    },

    initMasks: function () {
        $('#phone-form').mask('(99) 99999-9999');
    }

};
