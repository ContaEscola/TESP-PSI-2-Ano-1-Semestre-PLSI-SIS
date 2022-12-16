# TESP-PSI-2-Ano-1-Semestre-PLSI-SIS

Grupo B
2211893 - Pedro Henriques
2211904 - Pedro Norberto
2211900 - Rafael Bento

## Instruções 
1. Executar o script SQL "aerocontrol/db/tabelas.sql" (Em caso de erro, ir às definções do MySQL e alterar o "innodb-default-row-format" para "dynamic").
2. Executar o script SQL "aerocontrol/db/registos.sql"
3. Abrir o terminal e executar o "composer install" na base do projeto;
4. Executar o comando "php init" e selecionar a opção 1, no terminal.
5. Abrir o ficheiro common/config/main-local.php e alterar o dsn, substituir:

>'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
 
 por:
 
>'dsn' => 'mysql:host=localhost;dbname=aerocontrol',

6. Executar o comando ".\yii migrate --migrationPath=@yii/rbac/migrations" no terminal.
7. Executar o comando ".\yii migrate" no terminal

## Credenciais

### Admin

>username: Rafael
password: 12345678

### Funcionários

> username: Pedro
password: 12345678

>username: Manuel
password: 12345678

### Cliente

>username: Antonio
password: 12345678

>username: Joaquim
password: 12345678


# Known Issues

- Na gestão de restaurantes (backend), ao atualizar um restaurante quando remove o logo do file input, se existir já um na DB, este não atualiza a DB para ficar null.
