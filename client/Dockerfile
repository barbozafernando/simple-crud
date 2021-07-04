FROM node:11.1-alpine as develop-stage

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .