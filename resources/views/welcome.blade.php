@extends('layouts.skeleton')

@push('scripts')
    <script src="{{ elixir('js/welcome.js') }}"></script>
@endpush

@push('styles')
    <link href="{{ elixir('css/welcome.css') }}" rel="stylesheet">
@endpush

@section('container')

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h2 class="">
                Monitoramente online de Ruídos Sonoros
            </h2>
            <h3>Biblioteca - IFCE Campus Caucaia</h3>
        </div>
    </div>

    <div class="container container__content">
        <div class="row">
            <div class="col-md-6">
                <h2>Sobre o Projeto</h2>
                <p>
                    Este projeto de sistema embarcado foi desenvolvido para realizar 
		    o monitoramento em tempo real dos ruídos sonoros emitidos pelos 
		    usuários da Biblioteca do IFCE Campus Caucaia.
                </p>
                <h2>Base do Projeto: Wireless Monitor</h2>
                <p>
                    O projeto usa como plataforma base o software Wireless Monitor. 
					Software desenvolvido com objetivo de exibir valores obtidos
					de dispositivos IoT na nuvem.
                </p>
                <!--
				<div class="btn-group">
                    <a href="https://wm.sanusb.tk"
                        class="btn btn-info"
                        target="_blank">
                        Site Wireless Monitor
                    </a>
                    <a href="{{ url('https://github.com/atilacamurca') }}" class="btn btn-primary" target="_blank">Desenvolvedor do Wireless Monitor</a>
                </div>
				-->
            </div>
            <div class="col-md-6">
                <a href="https://youtu.be/OMpSB7Z2sR8" data-lity title="Watch Video">
                    <img alt="monitor"
                        src="{{ asset('img/welcome/create-temperature-monitor.png') }}"
                        class="img-rounded img-responsive img-shadow" />
                </a>
            </div>
        </div>        
    </div>

    <section class="integration">
        <div class="container">
            <div class="row margin-top margin-bottom text-center">
                <div class="col-md-12">
                    <h2>Componentes do Projeto</h2>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('img/welcome/nodemcu-esp8266.jpg') }}"
                        class="img-rounded integration-icon"/>
                    <p>
                        Microcontrolador NodeMCU ESP8266<br/>
                    </p>
                    <p>
                        Linguagem de desenvolvimento: C/C++ (na IDE Arduino)
                    </p>
                    <a href="https://cdn-shop.adafruit.com/product-files/2471/0A-ESP8266__Datasheet__EN_v4.3.pdf"
                        class="btn btn-success btn-lg" target="_blank">
                        <i class="fa fa-github"></i>
                        Data Sheet
                    </a>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('img/welcome/max4466.jpg') }}"
                        class="img-rounded integration-icon"/>
                    <p>
                        Microfone Elétrico com ganho ajustável MAX4466
                    </p>
                    <p>Ideal para captar alterações de som em maiores distancias</p>
                    <a href="https://cdn-shop.adafruit.com/datasheets/MAX4465-MAX4469.pdf"
                        class="btn btn-success btn-lg" target="_blank">
                        <i class="fa fa-github"></i>
                        Data Sheet
                    </a>
                </div>
            </div>            
        </div>
    </section>

    <section class="project">
        <div class="container">
            <div class="row margin-top margin-bottom text-center">
                <div class="col-md-4">
                    <i class="fa fa-4x fa-github"></i>
                    <h2>Código Fonte</h2>
                    <p>
                        Este projeto é livre, usa a licença GPLv3 e todo o seu código fonte está disponível para download
                    </p>
                    <a href="https://github.com/leocandido/sound-monitor"
                        class="btn btn-primary btn-lg"
                        target="_blank">
                        Download
                    </a>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-4x fa-book"></i>
                    <h2>Grupo SanUSB</h2>
                    <p>
                        A idéia para realização deste projeto foi adquirida através da filosofia ensinada no grupo SanSUB
                    </p>
                    <a href="http://sanusb.org/"
                        class="btn btn-primary btn-lg"
                        target="_blank">
                        Conheça o Grupo
                    </a>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-4x fa-file-o"></i>
                    <h2>Artigo</h2>
                    <p>
                        A idéia inicial para realização deste projeto, utilizando RaspberryPi, foi aceita e apresentada em evento organizado pela SBC
                    </p>
                    <a href="http://www.eripi.com.br/2017/images/anais/artigos/23.pdf"
                        class="btn btn-primary btn-lg"
                        target="_blank">
                        Publicação
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection