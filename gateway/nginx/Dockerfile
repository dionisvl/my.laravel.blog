FROM nginx:1.25.3-alpine-slim

RUN apk add --no-cache curl bash

COPY ./gateway/nginx/snippets /etc/nginx/snippets
COPY ./gateway/nginx/conf.d /etc/nginx/conf.d

WORKDIR /app

HEALTHCHECK --interval=60s --timeout=50s --start-period=40s CMD curl --fail http://127.0.0.1/health || exit 1
