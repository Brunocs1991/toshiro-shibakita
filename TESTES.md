# 🧪 Guia de Testes - Toshiro Shibakita

## Testando o Load Balancing

### 1. Teste Básico de Funcionamento

1. Inicie os serviços:
```bash
docker-compose up -d
```

2. Acesse `http://localhost:4500` no navegador

3. Recarregue a página várias vezes (F5)

4. Observe que o campo **Host** muda entre diferentes containers:
   - `toshiro-app1`
   - `toshiro-app2`
   - `toshiro-app3`

### 2. Teste via Linha de Comando

Use o comando `curl` para fazer múltiplas requisições:

```bash
# Linux/Mac
for i in {1..10}; do curl -s http://localhost:4500 | grep -o "Host:.*" | head -1; done

# Windows PowerShell
1..10 | ForEach-Object { (Invoke-WebRequest -Uri http://localhost:4500).Content | Select-String "Host:" | Select-Object -First 1 }
```

### 3. Verificar Logs dos Containers

```bash
# Ver logs de todos os serviços
docker-compose logs -f

# Ver logs de um serviço específico
docker-compose logs -f app1
docker-compose logs -f app2
docker-compose logs -f app3
docker-compose logs -f nginx
```

### 4. Testar Escalabilidade

Aumente o número de instâncias de um serviço:

```bash
docker-compose up -d --scale app1=5
```

Depois acesse `http://localhost:4500` e observe que mais instâncias do app1 estarão recebendo requisições.

### 5. Testar Resiliência

Pare um dos serviços e veja se o sistema continua funcionando:

```bash
# Parar app1
docker-compose stop app1

# Acesse http://localhost:4500 - deve continuar funcionando
# As requisições serão distribuídas apenas entre app2 e app3

# Reiniciar app1
docker-compose start app1
```

### 6. Verificar Status dos Containers

```bash
docker-compose ps
```

Todos os containers devem estar com status `Up` e `healthy` (para o MySQL).

### 7. Testar Conexão com Banco de Dados

```bash
# Acessar o MySQL diretamente
docker-compose exec mysql mysql -u root -pSenha123 meubanco

# Dentro do MySQL, execute:
SELECT * FROM dados ORDER BY DataCriacao DESC LIMIT 10;
```

### 8. Monitorar Uso de Recursos

```bash
docker stats
```

Isso mostra o uso de CPU, memória e rede de cada container.

### 9. Testar Health Check do MySQL

```bash
# Verificar se o health check está funcionando
docker inspect toshiro-mysql | grep -A 10 Health
```

### 10. Verificar Distribuição de Requisições

Execute múltiplas requisições e conte quantas vezes cada container respondeu:

```bash
# Linux/Mac
for i in {1..30}; do curl -s http://localhost:4500 | grep -o "Host:.*" | head -1; done | sort | uniq -c

# Windows PowerShell
$results = 1..30 | ForEach-Object { 
    $content = (Invoke-WebRequest -Uri http://localhost:4500).Content
    if ($content -match 'Host: ([^<]+)') { $matches[1] }
}
$results | Group-Object | Select-Object Name, Count
```

## Resultados Esperados

- ✅ Cada requisição deve ser distribuída entre os 3 serviços PHP
- ✅ O banco de dados deve persistir dados mesmo após reiniciar containers
- ✅ O sistema deve continuar funcionando mesmo se um serviço parar
- ✅ Os logs devem mostrar requisições sendo processadas por diferentes containers

