<div class="row">
    <div class="col-md-12">
        <h4>Teste o envio de dados com <code>curl</code></h4><hr>
        <p>
            Abra o seu terminal. Primeiro você precisa receber o seu token.
        </p>
        <pre>{{ $login_cmd }} {{ url('/api/authenticate') }}</pre>
        <p>
            A saída será algo como:
        </p>
        <pre>{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhcGlfa2V5IjoiOWY5NzRiZDMtODM3Ny00MzZmLWE2ZjItNjJiNmYwM2E2NWU0IiwibW9uaXRvcl9rZXkiOiI0MDRmYWZiOS02YzhiLTRkZTItOWEzNS04MWU4ZjJlMWMxZjciLCJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3MzQ1OTA3OSwiZXhwIjoxNDczNDYyNjc5LCJuYmYiOjE0NzM0NTkwNzksImp0aSI6IjkxMzkyZWM4ZjQ4NTM0YzlmZmI0YjNkMTk1Nzc5NmJlIn0.KkwLu-gWT9_cG9D0NgvID4c60MtlPSY-PtNAam5yfqI"}</pre>
        <p>
            Com o seu Token, você poderá enviar dados para o servidor.
            Você precisa passar o token no <code>Header</code> e um
            <code>data</code> parameter.
        </p>
        <pre>{{ $send_cmd }} {{ url('/api/send') }}</pre>
        <p>
            Lembre de trocar o campo &lt;TOKEN&gt; pelo token que você recebeu de
            <code>/api/authenticate</code>.
        </p>
        <p>
            <a href="#view" data-toggle="tab" class="btn btn-primary">
                Visualizar os dados
            </a>
            <a href="https://sanusb-grupo.github.io/wireless-monitor/pt-br/api-endpoints/index.html"
                class="btn btn-default"
                target="_blank">
                Documentação da API
            </a>
        </p>
    </div>
</div>
