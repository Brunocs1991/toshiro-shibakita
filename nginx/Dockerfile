FROM nginx:alpine

# Copiar configuração do Nginx
COPY default.conf /etc/nginx/conf.d/default.conf

EXPOSE 4500

CMD ["nginx", "-g", "daemon off;"]

