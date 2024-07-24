# Gerador e listador de relatórios - DOCX para PDF

Navbar -> Listagem de arquivos (PDFs gerados) e listagem de lojas (pode ser substituido por qualquer coisa com o banco de dados, é utilizado para substituir no relatório) <br>
Preencher relatório -> campos a serem preenchidos, e ao clicar em gerar, ele transforma de DOCX para PDF e apaga o DOCX
Adicionar loja -> adiciona uma loja ao banco de dados

## Obrigatoriedades:

Crie um arquivo .env na raiz do projeto e use copie o .env.example

Adicione corretamente o diretório python no .env
Inicialize o Environment::load('diretório do env') dentro do DocGenerator
