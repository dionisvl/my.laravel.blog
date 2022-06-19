FROM nginx:1.21-alpine

RUN apk add --no-cache curl

COPY ./common/nginx/snippets /etc/nginx/snippets
#COPY ./common/nginx/conf.d /etc/nginx/conf.d

WORKDIR /app

HEALTHCHECK --interval=60s --timeout=50s --start-period=40s CMD curl --fail http://127.0.0.1/health || exit 1
