# Projeto Elevador em Laravel

Este projeto simula a lógica de um elevador usando estrutura de fila (FIFO), implementado com PHP (Laravel).

## 📦 Requisitos

- Laravel 10+
- PHP 8.1+
- SQLite (ou compatível)
- Blade (para interface)
- Artisan (CLI)
- Banco de dados para log de chamadas

## 🚀 Instalação

Clone o repositório e instale as dependências:

```bash
git clone <seu-repo-git>
cd elevador-projeto
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
```
- Configure o banco
Utilize SQLite ou ajuste para MySQL/PostgreSQL:
```bash
touch database/database.sqlite
```

- Rode as migrations
```bash
php artisan migrate
```
- Rode o Projeto
```bash
php artisan serve
```
### Testar Fila Qeue
```bash
php artisan elevador:testar
```
### Teste unitario
```bash
php artisan test
```


## INFOS
Funcionalidades implementadas
📌 Classe Elevador (app/Services/Elevador.php)
Atributos:
filaChamados (SplQueue)
andarAtual (int)
capacidade (int)

Métodos:

__construct(int $capacidade) – inicializa fila, capacidade e andar inicial

chamar(int $andar) – adiciona o andar à fila

mover() – remove o próximo andar da fila e atualiza andarAtual

getAndarAtual(): int – retorna o andar atual

getChamadosPendentes(): SplQueue – retorna cópia da fila de andares pendentes

📌 Interface Web (Blade)
Local: resources/views/elevador/index.blade.php

Funcionalidades:

Campo para inserir andar e chamar o elevador

Botão para mover o elevador

Lista dos andares pendentes

Exibição do andar atual

📌 Controller
Local: app/Http/Controllers/ElevadorController.php

Métodos:

index() – mostra a interface com estado atual

chamar(Request $request) – chama o elevador e registra log

mover() – move o elevador e registra log

Utiliza Session para manter o estado da fila entre requisições.

📌 Log de Movimentos
Tabela: movimentos_elevador

Criada com migration:

bash
Copiar
Editar
php artisan make:migration create_movimentos_elevador_table

Model: app/Models/MovimentoElevador.php

Ações registradas:

acao: 'chamar' ou 'mover'

andar: valor do andar chamado ou alcançado

🧪 Testes com Artisan
Um comando CLI está disponível para teste via terminal:

bash
Copiar
Editar

php artisan elevador:testar

Esse comando:
Cria uma instância do elevador
Chama andares (3, 5, 1)
Move o elevador três vezes
Exibe estado atual e fila

🔒 Observações
Não há verificação de máximo de capacidade (por simplicidade).
Interface básica, mas funcional. Pode ser estendida para Vue/React se desejado.
Banco pode ser ajustado para outros SGBDs facilmente.

