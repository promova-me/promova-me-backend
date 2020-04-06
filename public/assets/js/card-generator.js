$(function() {

    const $ = document.querySelector.bind(document);
    const fileChooser = $("#file-chooser");
    const empresa = $("#empresa");
    const frase = $("#frase");
    const telefone = $("#telefone");
    const entrega = $("#entrega");
    var c = $("#card-canvas");

    var ctx = c.getContext("2d");

    fileChooser.onchange = e => {
        const fileToUpload = e.target.files.item(0);

        const reader = new FileReader();
        reader.readAsDataURL(fileToUpload);
        reader.onload = e => (base_image.src = e.target.result);
    };

    make_base();

    function make_base() {
        var reader = new FileReader();

        base_image = new Image();

        base_image.onload = function () {

            // Desenha a Imagem no fundo
            ctx.drawImage(base_image, 0, 0, c.width, c.height);

            // Desenha os quadrados
            ctx.fillStyle = "rgb(196,30,73)";
            ctx.beginPath();
            ctx.fillRect (400, 0, 200, 600);
            ctx.closePath();
            ctx.fill();

            ctx.fillStyle = "rgb(255,255,255)";
            ctx.beginPath();
            ctx.fillRect (250, 100, 300, 400);
            ctx.closePath();
            ctx.fill();

            ctx.fillStyle = "rgb(0,0,0)";
            ctx.beginPath();
            ctx.fillRect (300, 360, 300, 8);
            ctx.closePath();
            ctx.fill();

            // Escreve os textos

            // Nome da empresa, ou da pessoa
            var maxWidth = 250;
            var lineHeight = 28;
            var x = 280;
            var y = 160;
            var text = empresa.value;
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
            text = frase.value;
            ctx.font = '18px Avenir Book';
            ctx.fillStyle = '#282d39';
            wrapText(ctx, text, x, y, maxWidth, lineHeight);

            // Contato
            y = 400;
            text = 'Contato: ' + telefone.value;
            ctx.font = '16px Avenir Book';
            ctx.fillStyle = '#282d39';
            wrapText(ctx, text, x, y, maxWidth, lineHeight);

            // Entrega
            y = 430;
            text = entrega.value;
            ctx.font = '16px Avenir Book';
            ctx.fillStyle = '#282d39';
            wrapText(ctx, text, x, y, maxWidth, lineHeight);
        };

    }

    function wrapText(context, text, x, y, maxWidth, lineHeight) {
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
})

function download_image(){
    var canvas = document.getElementById("card-canvas");
    image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
    var link = document.createElement('a');
    link.download = "my-image.png";
    link.href = image;
    link.click();
}
