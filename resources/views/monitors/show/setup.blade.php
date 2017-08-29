<div class="row">
    <div class="col-md-4">
        <div class="box box-solid box-danger">
            <div class="box-header">
                <h3 class="box-title">Passo 1</h3>
            </div>
            <div class="box-body">
                <img src="{{asset('img/chip.png')}}" class="img-responsive" />
                <h4 class="text-center">
                    Configurando o seu dispositivo IoT
                </h4>
                <p>
                    Você necessitará de um dispositivo IoT com acesso a Internet.
                    Alguns exemplos:
                </p>
                <ul>
                    <li>ESP 8266</li>
                    <li>Arduino com Ethernet Shield</li>
                    <li>Arduino com Wi-Fi Shield</li>
                </ul>
                <p>
                    Então você vai precisar coletar os dados com algum tipo de sensor.
                </p>
                <a href="https://sanusb-grupo.github.io/wireless-monitor/pt-br/index.html"
                    class="btn btn-primary btn-block"
                    target="_blank">
                    Veja a documentação
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Passo 2</h3>
            </div>
            <div class="box-body">
                <img src="{{asset('img/cloud.png')}}" class="img-responsive" />
                <h4 class="text-center">
                    Autenticando o seu dispositivo
                </h4>
                <pre>{{ $auth_json }}</pre>
                <p>
                    A <code>api_key</code> identifica o seu usuário, e
                    a <code>monitor_key</code> indentifica o dispositivo.
                </p>
                <p>
                    Para autenticar você deve fazer uma requisição POST
                    para o endpoint <code>/api/authenticate</code>.
                    Depois disso receberá um <code>token</code>.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">Passo 3</h3>
            </div>
            <div class="box-body">
                <img src="{{asset('img/computer.png')}}" class="img-responsive" />
                <h4 class="text-center">
                    Visualizando os dados
                </h4>
                <p>
                    Envie algum dado do seu dispositivo IoT. Faça uma requisição POST
                    para o endpoint <code>/api/send</code> usando o seu <code>token</code>
                    no cabeçalho, <code>Authorization: Bearer &lt;token&gt;</code>.
                </p>
                <p>
                    Para ver os dados, clique no botão a seguir.
                </p>
                <a href="#view" data-toggle="tab" class="btn btn-primary btn-block">
                    Visualizar os dados
                </a>
            </div>
        </div>
    </div>
</div>
