# Painel Administrativo - Blum Loja 🎮

## Uma aplicação web dinâmica desenvolvida para gerenciar produtos de uma loja de games. Este projeto foi construído para praticar operações de CRUD (Create, Read, Update, Delete) utilizando PHP, autenticação de sessões e integração com banco de dados MySQL via PDO.

#📝 Sobre o Projeto

## O sistema Blum permite o controle total de um inventário de produtos. O administrador pode cadastrar novos itens, editar informações existentes, visualizar a lista completa e excluir produtos, tudo protegido por um sistema de login seguro.

# Principais Funcionalidades:

Autenticação Segura: Login com verificação de senha criptografada (password_hash).

Gestão de Inventário: Cadastro e edição de nome, preço e caminho de imagens dos produtos.

Segurança de Sessão: Proteção de rotas administrativas para usuários não logados.

Interface Responsiva: Estilização moderna utilizando Tailwind CSS.

# 🛠️ Tecnologias Utilizadas

PHP 8.x: Linguagem principal para lógica de servidor e gerenciamento de sessões.

PDO (PHP Data Objects): Interface segura para comunicação com o banco de dados.

MySQL: Banco de dados relacional para armazenamento de usuários e produtos.

Tailwind CSS: Framework utilitário para estilização rápida e responsiva.

JavaScript: Utilizado para confirmações de ações críticas (como exclusão).

## 📂 Estrutura de Arquivos

index.php: Tela de login inicial.

cadastro.php: Formulário para novos usuários.

login.php / logout.php: Lógica de autenticação e encerramento de sessão.

admin_gerenciar.php: Painel principal com a lista de produtos.

admin_adicionar.php / admin_editar.php: Interfaces de criação e modificação.

conexao.php: Configuração central da conexão PDO.

# 🚀 Instruções de Instalação 

## Previos








1 Clone este repositório: 

``bash``

git clone https://github.com/kayomatheus/blum-loja-php.git

2 Configure o Banco de Dados:

Crie um banco de dados chamado frem_loja no seu MySQL (XAMPP/WAMP).

Crie as tabelas users (id, username, password_hash) e produtos (id, nome, preco, imagem_path, alt_text).

3 Ajuste a Conexão:

Verifique se as credenciais no arquivo conexao.php coincidem com o seu ambiente local.

4 Execute o Projeto:

Mova a pasta para o diretório htdocs (se usar XAMPP).

Acesse no navegador: http://localhost/nome-da-pasta/index.php.

# 📋 Pré-requisitos

Servidor local (XAMPP, WAMP ou Laragon).

PHP 7.4 ou superior.

Extensão PDO habilitada no PHP.

# 🚀 Melhorias Futuras

Implementação de Upload de Imagens direto pelo formulário (em vez de apenas o caminho).

Página de visualização pública dos produtos para clientes.

Criptografia de senhas no fluxo de cadastro (register.php).

Filtros de busca e paginação na lista de produtos.

# 📄 Licença

Este projeto está sob a licença MIT. Sinta-se livre para usar e modificar.

# 👤 Autor

Desenvolvido com foco em aprendizado Full-Stack por Kayo Matheus.
