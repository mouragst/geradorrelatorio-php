# Gerador e listador de relatórios - DOCX para PDF

Navbar -> Listagem de arquivos (PDFs gerados) e listagem de lojas (pode ser substituido por qualquer coisa com o banco de dados, é utilizado para substituir no relatório) <br><br>
Preencher relatório -> campos a serem preenchidos, e ao clicar em gerar, ele transforma de DOCX para PDF e apaga o DOCX <br><br>
Adicionar loja -> adiciona uma loja ao banco de dados

## Requisitos para executar

PHP <br>
Python com biblioteca docx2pdf

## Como usar:

Crie um arquivo .env na raiz do projeto e copie o conteudo do .env.example<br>
Adicione corretamente o diretório python no .env <br>
Inicialize o Environment::load(__DIR__.'/../../') dentro do DocGenerator<br>
