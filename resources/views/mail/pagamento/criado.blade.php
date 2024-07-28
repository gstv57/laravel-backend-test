<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .footer {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1 class="text-center">Olá {{$cliente->nome}},</h1>
        <p>Espero que você esteja bem!</p>
        <p>Para concluir o processo de [compra/inscrição/serviço], por favor, utilize o link abaixo para realizar o
            pagamento:</p>
        <div class="text-center">
            <a href="#" class="btn btn-primary btn-lg">Pagar Agora</a>
        </div>
        <p>Caso prefira, você pode acessar o link através do botão acima.</p>
        <p>Se você tiver qualquer dúvida ou precisar de assistência adicional, não hesite em nos contatar. Estamos aqui para
            ajudar!</p>
        <p>Agradecemos pela sua atenção e preferência.</p>
        <div class="footer">
            Atenciosamente,<br>
            PAGAMENTOS SA<br>
            DESENVOLVEDOR<br>
            PAGAMENTOS SA<br>
            (00) 0000-0000<br>
            suporte@pagamentosa.com<br>
            <a href="https://google.com.br">www.pagamentosa.com</a>
        </div>
    </div>
</body>
</html>
