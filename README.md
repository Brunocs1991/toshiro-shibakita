# ⚔️ Toshiro Shibakita - Microsserviços com Docker ⚔️

Projeto prático de implementação de **Microsserviços** utilizando **Docker** e **Docker Compose**, seguindo as melhores práticas do mercado internacional.

## 📋 Sobre o Projeto

Este projeto demonstra a implementação de uma arquitetura de microsserviços utilizando:

- **PHP 8.2** com PHP-FPM
- **MySQL 8.0** como banco de dados
- **Nginx** como load balancer/reverse proxy
- **Docker** e **Docker Compose** para orquestração

A aplicação simula um sistema distribuído onde múltiplas instâncias de um serviço PHP compartilham o mesmo banco de dados, com balanceamento de carga através do Nginx.

## 🏗️ Arquitetura

```
┌─────────────────┐
│   Nginx (LB)    │ Porta 4500
│   Porta 4500    │
└────────┬────────┘
         │
    ┌────┴────┬──────────┬──────────┐
    │         │          │          │
┌───▼───┐ ┌──▼───┐ ┌───▼───┐ ┌───▼────┐
│ App 1 │ │ App 2│ │ App 3 │ │ MySQL  │
│ PHP   │ │ PHP  │ │ PHP   │ │  8.0   │
│ :9000 │ │ :9000│ │ :9000 │ │ :3306  │
└───┬───┘ └──┬───┘ └───┬───┘ └───┬────┘
    └────────┴──────────┴────────┘
```

## 🚀 Pré-requisitos

- Docker Engine 20.10+
- Docker Compose 2.0+
- Git (opcional)

## 📦 Instalação e Execução

### 1. Clone o repositório (ou baixe os arquivos)

```bash
git clone <seu-repositorio>
cd toshiro-shibakita
```

### 2. Execute o Docker Compose

```bash
docker-compose up -d
```

Este comando irá:

- Criar uma rede Docker personalizada
- Inicializar o banco de dados MySQL
- Criar 3 instâncias do serviço PHP
- Configurar o Nginx como load balancer

### 3. Acesse a aplicação

Abra seu navegador e acesse:

```
http://localhost:4500
```

## 🛠️ Comandos Úteis

### Ver logs dos serviços

```bash
docker-compose logs -f
```

### Ver logs de um serviço específico

```bash
docker-compose logs -f app1
docker-compose logs -f mysql
docker-compose logs -f nginx
```

### Parar os serviços

```bash
docker-compose stop
```

### Parar e remover containers

```bash
docker-compose down
```

### Parar, remover containers e volumes

```bash
docker-compose down -v
```

### Reconstruir as imagens

```bash
docker-compose build --no-cache
```

### Escalar serviços (exemplo: criar mais 2 instâncias do app1)

```bash
docker-compose up -d --scale app1=5
```

## 📁 Estrutura do Projeto

```
toshiro-shibakita/
│
├── app/                    # Aplicação PHP
│   ├── Dockerfile         # Dockerfile do serviço PHP
│   └── index.php          # Aplicação principal
│
├── nginx/                  # Configuração do Nginx
│   ├── Dockerfile         # Dockerfile do Nginx
│   └── default.conf       # Configuração do load balancer
│
├── banco.sql              # Script de criação do banco de dados
├── docker-compose.yml     # Orquestração dos serviços
├── .dockerignore          # Arquivos ignorados pelo Docker
├── .gitignore             # Arquivos ignorados pelo Git
└── README.md              # Este arquivo
```

## 🔧 Configurações

### Variáveis de Ambiente

As variáveis de ambiente podem ser configuradas no arquivo `docker-compose.yml`:

- `DB_HOST`: Host do banco de dados (padrão: mysql)
- `DB_USER`: Usuário do banco (padrão: root)
- `DB_PASSWORD`: Senha do banco (padrão: Senha123)
- `DB_NAME`: Nome do banco (padrão: meubanco)

### Portas

- **4500**: Nginx (Load Balancer)
- **3306**: MySQL (Banco de dados)

## 🎯 Funcionalidades

- ✅ Múltiplas instâncias do serviço PHP
- ✅ Load balancing com Nginx (round-robin)
- ✅ Banco de dados MySQL compartilhado
- ✅ Health checks para o MySQL
- ✅ Volumes persistentes para dados do MySQL
- ✅ Interface web moderna e responsiva
- ✅ Exibição do hostname do container que processou a requisição

## 🧪 Testando o Load Balancing

Para verificar o load balancing funcionando:

1. Acesse `http://localhost:4500` várias vezes
2. Observe que o campo "Host" muda entre diferentes containers
3. Cada requisição é distribuída entre os 3 serviços PHP

## 📊 Monitoramento

### Ver status dos containers

```bash
docker-compose ps
```

### Ver uso de recursos

```bash
docker stats
```

### Acessar o banco de dados diretamente

```bash
docker-compose exec mysql mysql -u root -pSenha123 meubanco
```

## 🐛 Troubleshooting

### Erro de conexão com o banco

- Verifique se o MySQL está saudável: `docker-compose ps`
- Verifique os logs: `docker-compose logs mysql`

### Porta 4500 já em uso

- Altere a porta no `docker-compose.yml` e `nginx/default.conf`

### Containers não iniciam

- Verifique se o Docker está rodando
- Execute `docker-compose down` e depois `docker-compose up -d`

## 📚 Conceitos Aplicados

- **Containerização**: Isolamento de aplicações em containers
- **Microsserviços**: Arquitetura distribuída com serviços independentes
- **Load Balancing**: Distribuição de carga entre múltiplas instâncias
- **Service Discovery**: Comunicação entre serviços via Docker networking
- **Health Checks**: Verificação de saúde dos serviços
- **Volumes**: Persistência de dados

## 🤝 Contribuindo

Sinta-se à vontade para fazer fork, melhorar e evoluir este projeto!

## 📝 Licença

Este projeto é parte do desafio da Digital Innovation One.

## 👨‍💻 Autor

Projeto desenvolvido como parte do desafio **Docker: Utilização prática no cenário de Microsserviços** da Digital Innovation One.

---

**Inspirado na história de Toshiro Shibakita** ⚔️
