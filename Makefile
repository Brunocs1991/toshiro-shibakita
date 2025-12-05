# Makefile para facilitar o gerenciamento do projeto Toshiro Shibakita

.PHONY: help up down build logs clean restart

help:
	@echo "⚔️  Toshiro Shibakita - Comandos Disponíveis:"
	@echo ""
	@echo "  make up       - Inicia todos os serviços"
	@echo "  make down     - Para e remove todos os containers"
	@echo "  make build    - Constrói as imagens Docker"
	@echo "  make logs     - Mostra os logs de todos os serviços"
	@echo "  make restart  - Reinicia todos os serviços"
	@echo "  make clean    - Remove containers, volumes e imagens"
	@echo "  make ps       - Lista os containers em execução"

up:
	docker-compose up -d
	@echo "✅ Serviços iniciados! Acesse http://localhost:4500"

down:
	docker-compose down
	@echo "✅ Serviços parados!"

build:
	docker-compose build --no-cache
	@echo "✅ Imagens construídas!"

logs:
	docker-compose logs -f

restart:
	docker-compose restart
	@echo "✅ Serviços reiniciados!"

clean:
	docker-compose down -v --rmi all
	@echo "✅ Limpeza concluída!"

ps:
	docker-compose ps

