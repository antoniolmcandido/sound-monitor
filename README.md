# Monitoramento de Ruidos Sonoros Online

Aplicativo web para realizar o monitoramento de ruidos sonoros

em Bibliotecas de Instituições de Ensino

## Documentação

<https://github.com/antoniolmcandido/sound-monitor/>

## Como começar

Instale o composer de <getcomposer.org>

Instale as dependências

~~~bash
php composer.phar install
~~~

Crie o arquivo `.env`

~~~bash
cp .env.example .env
~~~

Gere a chave para JWT

~~~bash
php artisan key:generate
~~~

Migre os dados

~~~bash
php artisan migrate
~~~

Inicie o servidor local

~~~bash
php artisan serve
~~~

## Licença

Copyright (C) 2017 Candido

Grupo SanUSB <http://sanusb.org>

Este programa é um software livre: você pode redistribuí-lo e/ou modificar.
Está sob os termos da GNU General Public License, conforme publicado pela
Free Software Foundation, requer a versão 3 da Licença.

Este programa é distribuído na esperança de que seja útil,
Mas SEM QUALQUER GARANTIA; Sem a garantia implícita de
COMERCIALIZAÇÃO OU APTIDÃO PARA UM PROPÓSITO ESPECÍFICO. Veja o
GNU General Public License para obter mais detalhes.

Você deve ter recebido uma cópia da GNU General Public License
Junto com este programa. Caso contrário, veja <http://www.gnu.org/licenses/>.
