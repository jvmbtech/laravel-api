# API LARAVEL

![Static Badge](https://img.shields.io/badge/status-em_desenvolvimento-brightgreen?style=for-the-badge)


> Uma API para gerenciamento de usuários implementada em PHP8.2, Laravel12 e persistência com SQLite.

## Funcionalidades

- [x] Autenticação com JWT (login com email e password)
- [x] Gestão de usuários (cadastro, listagem, edição e remoção)
- [x] Gestão de endereços de usuários (listagem, cadastro)
- [ ] Edição de endereço de usuário
- [ ] Remoção de endereço de um usuário
- [ ] Atribuição de permição de amdin para usuários

## Rodando a aplicação

#### Configurando o ambiente
Será necessário instalar o [Composer](https://getcomposer.org/download/).

Após instalar o composer, siga as [instruções](https://laravel.com/docs/12.x/installation) para instalação do php(8.2 ou superior) e do Laravel. 

Depois de concluir as instalações, faça o clone do repositório.
Segue exemplo com https:
```bash
git clone https://github.com/jvmbtech/laravel-api.git
```

Acesse o folder onde o projeto foi clonado e instale as dependências do mesmo com o comando:
```bash
composer install
```

#### JWT_SECRET
No folder da aplicação, identifique o arquivo .env que armazena as variáveis de ambiente.

Caso não tenha o arquivo '.env', copie o arquivo '.env.example' e renomeie esta cópia para ser o seu '.env'.

Abra o arquivo '.env' no seu editor de texto e localize a variável JWT_SECRET, sete um valor para esta variável. Exemplo:
```
JWT_SECRET=insira-um-valor-aqui-para-ser-a-sua-chave-secreta 
```

#### Banco de Dados
Após a instalação das dependências, rode as migrations para configurar o banco de dados:
```bash
php artisan migrate
```

Opcionalmente você também pode rodar o seeder para preencher o banco com alguns dados para testes:
```bash
php artisan db:seed
```

#### Subindo a API
Após a conclusão da configuração do ambiente vamos subir a api.

Rode a aplicação utilzando o comando:
```bash
php artisan serve --port=8000
```
A api vai estar rodando em `http://localhost:8000/api` do seu computador.

Para verificar se a aplicação está funcionando corretamente é possível fazer uma requisição `GET` para o endpoint `/api/status`.
Segue um exemplo utlizando cURL: 
```bash
curl http://127.0.0.1:8000/api/status
```

A resposta do endpoint deve ser o JSON:
```json
{ "status" : "up" }
```

##### Obs:
Caso tenha rodado o seeder do banco, poderá testar o login o usuário padrão:
```
{ "email": "test@example.com", "password": "admin" }
```

## Testes
Rode os testes da plicação utilizando o comando:
```bash
php artisan test
```

## Endpoints

| Método  | URL                              | Body
| ------- | -------------------------------- | ----
| GET     | /api/status                      |
| POST    | /api/login                       | { "email": "string", "password": "string" }
| GET     | /api/users                       |
| GET     | /api/users/{user_id}             |
| POST    | /api/users                       | { "name": "string", "email": "string", "password": "string", "cpf": "string", "phone": "string", "cellphone": "string" }
| PUT     | /api/users/{user_id}             |
| DELETE  | /api/users/{user_id}             |
| GET     | /api/users/{user_id}/addresses   |
| POST    | /api/users/{user_id}/addresses   | { "user_id": "int", "street": "string", "number": "string", "neighborhood": "string", "complement": "string", "postal_code": "string" }
