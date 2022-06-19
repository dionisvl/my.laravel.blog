FROM nginx:1.21-alpine

RUN apk add --no-cache curl

COPY ./common/nginx/conf.d /etc/nginx/conf.d

WORKDIR /app

#COPY ./public ./public

HEALTHCHECK --interval=60s --timeout=30s --start-period=20s CMD curl --fail http://127.0.0.1/health || exit 1
