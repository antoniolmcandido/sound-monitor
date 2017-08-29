@extends('layouts.skeleton')

@push('scripts')
<script src="{{ elixir('js/welcome.js') }}"></script>
@endpush

@push('styles')
<link href="{{ elixir('css/welcome.css') }}" rel="stylesheet">
@endpush

@section('container')

    <div class="jumbotron jumbotron-gradient">
        <div class="container">
            <h2 class="">
                Bem vindo ao Wireless Monitor
            </h2>
            <h3>Monitoramento de dispositos IoT na nuvem</h3>
        </div>
    </div>

    <div class="container container__content">
        <div class="row">
            <div class="col-md-6">
                <h2>O que é um Monitor?</h2>
                <p>
                    Monitor é um componente interno do sistema criado pelo desenvolvedor
                    de acordo com suas necessidades, é o instrumento que possui os dados
                    coletados e os apresenta na interface da web.
                </p>
                <h2>Como criar um Monitor?</h2>
                <p>
                    Você pode criar um Monitor utilizando um dos modelos existentes, temperatura e
                    fotoresistores, ou criar o seu próprio.
                </p>
                <div class="btn-group">
                    <a href="https://sanusb-grupo.github.io/wireless-monitor/pt-br/plugin-development.html"
                       class="btn btn-info"
                       target="_blank">
                        Plugin para Desenvolvimento
                    </a>
                    <a href="{{ url('/monitor') }}" class="btn btn-primary">Modelos Disponíveis</a>
                </div>
            </div>
            <div class="col-md-6">
                <a href="https://youtu.be/iTczyDZeSWk" data-lity title="Watch Video">
                    <img alt="monitor"
                         src="{{ asset('img/welcome/create-temperature-monitor.png') }}"
                         class="img-rounded img-responsive img-shadow" />
                </a>
            </div>
        </div>

        <div class="row margin-top">
            <div class="col-md-6">
                <a href="https://youtu.be/UgcgAXTp-9c" data-lity title="Watch Video">
                    <img alt="monitor"
                         src="{{ asset('img/welcome/using-sdk.png') }}"
                         class="img-rounded img-responsive img-shadow" />
                </a>
            </div>
            <div class="col-md-6">
                <h2>Como enviar dados para o seu Monitor?</h2>
                <p>
                    Você pode usar JavaScript SDK que trabalha com vários Browsers
                    e NodeJS.
                </p>
                <p>A instalação é simples como no exemplo:</p>
                <pre>$ npm install --save wireless-monitor</pre>
                <h2>O que eu preciso para enviar os dados?</h2>
                <p>
                    Primeiro passo é juntar o seu <code>api_key</code> e o seu
                    <code>monitor_key</code>. Ambos são usados para autorizar o dispositivo IoT.
                </p>
                <div class="btn-group">
                    <a href="https://github.com/SanUSB-grupo/wm-sdk-js"
                       class="btn btn-info"
                       target="_blank">
                        Código fonte
                    </a>
                    <a href="https://sanusb-grupo.github.io/wm-sdk-js/en/api.html"
                       class="btn btn-primary"
                       target="_blank">
                        Documentação da API
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--
    <section class="integration">
        <div class="container">
            <div class="row margin-top margin-bottom text-center">
                <div class="col-md-12">
                    <h2>
                        Integrate Wireless Monitor with other JavaScript
                        Frameworks and Platforms
                    </h2>
                </div>
            </div>
            <div class="row margin-bottom text-center">
                <div class="col-md-4">
                    <img src="{{ asset('img/welcome/j5-logo.min.svg') }}" class="img-rounded integration-icon">
                    <p>
                        Johnny-Five is the JavaScript Robotics &amp; IoT Platform. Released by
                        <a href="http://www.bocoup.com/">Bocoup</a> in 2012, Johnny-Five
                        is maintained by a community of passionate software developers
                        and hardware engineers.
                    </p>
                    <a href="http://johnny-five.io/" class="btn btn-success"
                        target="_blank">
                        Integrate with Johnny-Five
                    </a>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('img/welcome/cylonjs-logo.min.svg') }}" class="img-rounded integration-icon">
                    <p>
                        Cylon.js is a JavaScript framework for robotics, physical computing, and the Internet of Things. It makes it incredibly easy to command robots and devices.
                    </p>
                    <a href="https://cylonjs.com/" class="btn btn-success"
                        target="_blank">
                        Integrate with CylonJS
                    </a>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('img/welcome/tessel-logo.min.svg') }}" class="img-rounded integration-icon">
                    <p>
                        Tessel is a completely open source and community-driven IoT and robotics development platform. It encompasses development boards, hardware module add-ons, and the software that runs on them.
                    </p>
                    <a href="https://tessel.io/" class="btn btn-success"
                        target="_blank">
                        Integrate with Tessel
                    </a>
                </div>
            </div>
        </div>
    </section>
    -->

    <div class="container container__content">
        <div class="row margin-top">
            <div class="col-md-6">
                <h2>Outras formas de enviar dados para o seu Monitor</h2>
                <p>
                    Você pode usar <a href="https://curl.haxx.se/" target="_blank">cURL</a> para enviar
                    dados e testar o seu monitor.
                </p>
                <p>
                    Isso pode ser útil para você aprender o processo passa-a-passo e para fins de depuração.
                </p>
                <h2>Manual passo-a-passo</h2>
                <p>
                    Ao chegar no endpoint <code>/api/authenticate</code>
                    você receberá o <code>token</code>. Use este <code>token</code>
                    toda vez que precisar acessar o endpoint <code>/api/send</code>.
                </p>
                <p>
                    Toda a comunicação é feita usando:
                    <a href="http://json.org/" target="_blank">JSON</a>,
                    um formato leve de troca de dados. JSON é um formato de texto
                    completamente independente de linguagens.
                </p>
                <div class="btn-group">
                    <a href="https://sanusb-grupo.github.io/wireless-monitor/pt-br/api-endpoints/post_api-authenticate.html"
                       class="btn btn-primary"
                       target="_blank">
                        Autenticação API
                    </a>
                    <a href="https://sanusb-grupo.github.io/wireless-monitor/pt-br/api-endpoints/post_api-send.html"
                       class="btn btn-primary"
                       target="_blank">
                        Envio API
                    </a>
                    <a href="https://sanusb-grupo.github.io/wireless-monitor/pt-br/api-endpoints/get_api-refresh-token.html"
                       class="btn btn-primary"
                       target="_blank">
                        Atualizar Token API
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <a href="https://youtu.be/Fo9e7soNsLE" data-lity title="Watch Video">
                    <img alt="monitor"
                         src="{{ asset('img/welcome/test-send-data.png') }}"
                         class="img-rounded img-responsive img-shadow" />
                </a>
            </div>
        </div>
    </div>


    <section class="project">
        <div class="container">
            <div class="row margin-top margin-bottom text-center">
                <div class="col-md-4">
                    <i class="fa fa-4x fa-github"></i>
                    <h2>Código Fonte</h2>
                    <p>
                        Este é projeto livre e de código aberto, que usa a licença
                        GPLv3.
                    </p>
                    <a href="https://github.com/sanusb-grupo/wireless-monitor"
                       class="btn btn-primary btn-lg"
                       target="_blank">
                        Abrir no Github
                    </a>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-4x fa-book"></i>
                    <h2>Documentação</h2>
                    <p>
                        Saiba mais sobre recursos, instalação e
                        desenvolvimento da API e dos Plugins.
                    </p>
                    <a href="https://sanusb-grupo.github.io/wireless-monitor/"
                       class="btn btn-primary btn-lg"
                       target="_blank">
                        Ver
                    </a>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-4x fa-file-o"></i>
                    <h2>Artigo</h2>
                    <p>
                        Leia o artigo que descreve como o projeto foi idealizado e desenvolvido.
                    </p>
                    <a href="https://github.com/atilacamurca/wireless-monitor-paper/blob/master/main.pdf"
                       class="btn btn-primary btn-lg"
                       target="_blank">
                        Ler
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
