# Bobina Banking

Este é um aplicativo para automatizar o controle de estoque e distribuição de bobinas da minha equipe.

## About

Nossos agentes realizam a medição de consumo com faturamento e entrega de conta simultâneos. Esse é uma tarefa realizada mensalmente na residência de cada um de nossos clientes, que hoje são aproximadamente 300 mil.

Um dos fatores que garantem um serviço eficiente e ininterrupto é a disponibilidade controlada de suprimentos para o colaborador, sem faltar e nem sobrar. Esse controle era feito por meio de planilhas e recentemente foi integrado ao Google Forms, mas ainda exige interferência humana para manter os relatórios atualizados.

Surge então a necessidade de uma solução que assegure o devido manejo de suprimentos e que, por meio da automação de processos e segmentação de responsabilidades, disponibilize informações seguras atualizadas para tomada de decisões.

## Running
```bash
# Instale as dependências
composer install && npm install

# Construa os assets
npm run build

# Prepare o banco de dados
php artisan migrate --seed

# Inicie o servidor
php artisan serve
```
### Requirements
* PHP ^8.2
* NPM ^9.2

